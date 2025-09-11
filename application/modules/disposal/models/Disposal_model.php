<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('cbs_integration');
    }

    public function get_disposed_assets() {
        return $this->db->get_where('items', array('asset_status' => 'Disposed'))->result();
    }

    public function get_asset_details($asset_id) {
        return $this->db->get_where('items', array('id' => $asset_id))->row();
    }

    public function update_asset($asset_id, $data) {
        $this->db->where('id', $asset_id);
        return $this->db->update('items', $data);
    }

    public function generate_disposal_journal_entry($asset_id) {
        $asset = $this->get_asset_details($asset_id);
        if (!$asset) {
            log_cbs_integration_event('disposal_journal_entry', 'error', 'Asset not found for ID: ' . $asset_id);
            return false;
        }

        $mapping = $this->db->get_where('gl_account_mapping', array('category_id' => $asset->category_id))->row();
        if (!$mapping) {
            log_cbs_integration_event('disposal_journal_entry', 'error', 'GL account mapping not found for category ID: ' . $asset->category_id);
            return false; // Or handle error
        }

        $entry_date = $asset->disposal_date;
        $description = 'Asset disposal for ' . $asset->item_name;

        // 1. Credit the Asset Cost Account
        $credit_asset = array(
            'entry_date' => $entry_date,
            'asset_id' => $asset_id,
            'gl_account' => $mapping->asset_cost_account,
            'debit' => 0,
            'credit' => $asset->cost,
            'description' => $description,
            'entry_type' => 'disposal'
        );
        $this->db->insert('journal_entries', $credit_asset);

        // 2. Debit the Accumulated Depreciation Account
        $accumulated_depreciation = $this->get_accumulated_depreciation($asset_id);
        $debit_accumulated_depreciation = array(
            'entry_date' => $entry_date,
            'asset_id' => $asset_id,
            'gl_account' => $mapping->accumulated_depreciation_account,
            'debit' => $accumulated_depreciation,
            'credit' => 0,
            'description' => $description,
            'entry_type' => 'disposal'
        );
        $this->db->insert('journal_entries', $debit_accumulated_depreciation);

        // 3. Debit Cash/Bank for Sale Proceeds
        if ($asset->sale_proceeds > 0) {
            $debit_cash = array(
                'entry_date' => $entry_date,
                'asset_id' => $asset_id,
                'gl_account' => 'Cash/Bank', // Placeholder
                'debit' => $asset->sale_proceeds,
                'credit' => 0,
                'description' => $description,
                'entry_type' => 'disposal'
            );
            $this->db->insert('journal_entries', $debit_cash);
        }

        // 4. Calculate and record Gain/Loss on Disposal
        $gain_loss = ($asset->sale_proceeds + $accumulated_depreciation) - $asset->cost;
        if ($gain_loss != 0) {
            $gl_account = ($gain_loss > 0) ? $mapping->gain_loss_on_disposal_account : $mapping->gain_loss_on_disposal_account;
            $debit = ($gain_loss < 0) ? abs($gain_loss) : 0;
            $credit = ($gain_loss > 0) ? $gain_loss : 0;

            $gain_loss_entry = array(
                'entry_date' => $entry_date,
                'asset_id' => $asset_id,
                'gl_account' => $gl_account,
                'debit' => $debit,
                'credit' => $credit,
                'description' => $description,
                'entry_type' => 'disposal'
            );
            $this->db->insert('journal_entries', $gain_loss_entry);
        }

        log_cbs_integration_event('disposal_journal_entry', 'success', 'Journal entry generated for asset ID: ' . $asset_id);
        return true;
    }

    public function get_accumulated_depreciation($asset_id) {
        $this->db->select_sum('amount');
        $this->db->where('asset_id', $asset_id);
        $query = $this->db->get('depreciation_log');
        $result = $query->row();
        return ($result->amount) ? $result->amount : 0;
    }

    public function get_all_disposals() {
        $this->db->select('id, item_name, cost, book_value, disposal_date, disposal_type, sale_proceeds, category_id');
        $this->db->where('asset_status', 'Disposed');
        return $this->db->get('items')->result();
    }
}