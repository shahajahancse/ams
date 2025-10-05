<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depreciation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('cbs_integration');
        $this->load->model('cbs_integration/Cbs_integration_model', 'cbs_model');
    }

    public function run_monthly_depreciation() {
        $assets = $this->db->get_where('items', array('asset_status !=' => 'Disposed', 'asset_status !=' => 'Retired'))->result();

        foreach ($assets as $asset) {
            // Check if the asset is already fully depreciated
            if ($asset->book_value <= $asset->salvage_value) {
                continue;
            }

            $monthly_depreciation = 0;
            if ($asset->depreciation_method == 'straight-line') {
                $yearly_depreciation = ($asset->original_cost - $asset->salvage_value) / $asset->useful_life;
                $monthly_depreciation = $yearly_depreciation / 12;
            } elseif ($asset->depreciation_method == 'wdv') {
                // Assuming a depreciation rate of 20% for WDV
                $depreciation_rate = 0.20;
                $yearly_depreciation = $asset->book_value * $depreciation_rate;
                $monthly_depreciation = $yearly_depreciation / 12;
            }

            // Ensure book value does not go below salvage value
            if ($asset->book_value - $monthly_depreciation < $asset->salvage_value) {
                $monthly_depreciation = $asset->book_value - $asset->salvage_value;
            }

            if ($monthly_depreciation > 0) {
                $new_book_value = $asset->book_value - $monthly_depreciation;

                // Log the depreciation
                $log_data = array(
                    'asset_id' => $asset->id,
                    'depreciation_date' => date('Y-m-d'),
                    'amount' => $monthly_depreciation,
                    'book_value' => $new_book_value
                );
                $this->db->insert('depreciation_log', $log_data);

                // Update the asset's book value
                $this->db->where('id', $asset->id);
                $this->db->update('items', array('book_value' => $new_book_value));

                // Generate journal entry
                $this->generate_depreciation_journal_entry($asset->id, $monthly_depreciation);
            }
        }
        log_cbs_integration_event('monthly_depreciation', 'success', 'Monthly depreciation run completed successfully.');
        return true;
    }

    public function generate_depreciation_journal_entry($asset_id, $amount) {
        $asset = $this->db->get_where('items', array('id' => $asset_id))->row();
        if (!$asset) {
            log_cbs_integration_event('depreciation_journal_entry', 'error', 'Asset not found for ID: ' . $asset_id);
            return false;
        }

        $mapping = $this->db->get_where('gl_account_mapping', array('category_id' => $asset->category_id))->row();
        if (!$mapping) {
            log_cbs_integration_event('depreciation_journal_entry', 'error', 'GL account mapping not found for category ID: ' . $asset->category_id);
            return false; // Or handle error
        }

        $entry_date = date('Y-m-d');
        $description = 'Monthly depreciation for ' . $asset->item_name;

        // Debit entry
        $debit_entry = array(
            'entry_date' => $entry_date,
            'asset_id' => $asset_id,
            'gl_account' => $mapping->depreciation_expense_account,
            'debit' => $amount,
            'credit' => 0,
            'description' => $description,
            'entry_type' => 'depreciation'
        );
        $this->db->insert('journal_entries', $debit_entry);

        // Credit entry
        $credit_entry = array(
            'entry_date' => $entry_date,
            'asset_id' => $asset_id,
            'gl_account' => $mapping->accumulated_depreciation_account,
            'debit' => 0,
            'credit' => $amount,
            'description' => $description,
            'entry_type' => 'depreciation'
        );
        $this->db->insert('journal_entries', $credit_entry);

        log_cbs_integration_event('depreciation_journal_entry', 'success', 'Journal entry generated for asset ID: ' . $asset_id);
        return true;
    }

    public function get_depreciation_schedule($asset_id) {
        $asset = $this->db->get_where('items', array('id' => $asset_id))->row();
        // dd($asset);
        if (!$asset) {
            return [];
        }

        $schedule = [];
        $remaining_cost = $asset->original_cost;
        $accumulated_depreciation = 0;

        for ($month = 1; $month <= ($asset->useful_life * 12); $month++) {
            $monthly_depreciation = 0;
            if ($asset->depreciation_method == 'straight-line') {
                $yearly_depreciation = ($asset->original_cost - $asset->salvage_value) / $asset->useful_life;
                $monthly_depreciation = $yearly_depreciation / 12;
            } elseif ($asset->depreciation_method == 'wdv') {
                // Assuming a fixed depreciation rate for WDV for simplicity
                // In a real scenario, this rate might be more dynamic or configurable
                $depreciation_rate = 0.20; // 20% annual rate
                $monthly_depreciation = ($remaining_cost * $depreciation_rate) / 12;
            }

            // Ensure book value does not go below salvage value
            if (($remaining_cost - $monthly_depreciation) < $asset->salvage_value) {
                $monthly_depreciation = $remaining_cost - $asset->salvage_value;
            }

            $remaining_cost -= $monthly_depreciation;
            $accumulated_depreciation += $monthly_depreciation;

            $schedule[] = [
                'month' => $month,
                'depreciation_amount' => $monthly_depreciation,
                'accumulated_depreciation' => $accumulated_depreciation,
                'net_book_value' => $remaining_cost
            ];

       

            if ($remaining_cost <= $asset->salvage_value) {
                break; // Asset fully depreciated
            }
        }
        return $schedule;
    }

    public function get_all_depreciation_parameters() {
        $this->db->select('*');
        return $this->db->get('items')->result();
    }

    public function get_accumulated_depreciation_up_to_date($asset_id, $date) {
        $this->db->select_sum('amount');
        $this->db->where('asset_id', $asset_id);
        $this->db->where('depreciation_date <=', $date);
        $query = $this->db->get('depreciation_log');
        $result = $query->row();
        return ($result->amount) ? $result->amount : 0;
    }
}