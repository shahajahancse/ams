<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cbs_integration_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function generate_journal_entries($start_date, $end_date) {
        $journal_entries = [];

        // 1. Asset Capitalization Entries
        // Assuming acquisition date is the trigger for capitalization
        $this->db->select('id, item_name, cost, acquisition_date');
        $this->db->where('acquisition_date >=', $start_date);
        $this->db->where('acquisition_date <=', $end_date);
        $acquisitions = $this->db->get('items')->result();

        foreach ($acquisitions as $acq) {
            $journal_entries[] = [
                'Date'        => $acq->acquisition_date,
                'Description' => 'Asset Capitalization: ' . $acq->item_name,
                'Account_Debit' => 'Asset Cost Account', // Placeholder
                'Account_Credit' => 'Cash/Bank or Accounts Payable', // Placeholder
                'Amount'      => $acq->cost,
                'Asset_ID'    => $acq->id
            ];
        }

        // 2. Monthly/Periodic Depreciation Posting
        // Fetch depreciation schedule entries within the date range
        $this->db->select('ads.schedule_date, ads.depreciation_amount, ads.asset_id, i.item_name');
        $this->db->from('asset_depreciation_schedule ads');
        $this->db->join('items i', 'i.id = ads.asset_id', 'LEFT');
        $this->db->where('ads.schedule_date >=', $start_date);
        $this->db->where('ads.schedule_date <=', $end_date);
        $depreciations = $this->db->get()->result();

        foreach ($depreciations as $dep) {
            $journal_entries[] = [
                'Date'        => $dep->schedule_date,
                'Description' => 'Depreciation Expense: ' . $dep->item_name,
                'Account_Debit' => 'Depreciation Expense Account', // Placeholder
                'Account_Credit' => 'Accumulated Depreciation Account', // Placeholder
                'Amount'      => $dep->depreciation_amount,
                'Asset_ID'    => $dep->asset_id
            ];
        }

        // 3. Asset Disposal Entries
        // Fetch disposal entries within the date range
        $this->db->select('ad.disposal_date, ad.sale_proceeds, ad.asset_id, i.item_name, i.cost');
        $this->db->from('asset_disposals ad');
        $this->db->join('items i', 'i.id = ad.asset_id', 'LEFT');
        $this->db->where('ad.disposal_date >=', $start_date);
        $this->db->where('ad.disposal_date <=', $end_date);
        $disposals = $this->db->get()->result();

        foreach ($disposals as $disp) {
            // Need to calculate accumulated depreciation up to disposal date for gain/loss
            $this->load->model('Depreciation_model');
            $depreciation_schedule_at_disposal = $this->Depreciation_model->get_depreciation_schedule($disp->asset_id);
            $accumulated_depreciation_at_disposal = 0;
            foreach ($depreciation_schedule_at_disposal as $sch) {
                if ($sch->schedule_date <= $disp->disposal_date) {
                    $accumulated_depreciation_at_disposal = $sch->accumulated_depreciation;
                } else {
                    break; // Assuming schedule is ordered by date
                }
            }

            $net_book_value = $disp->cost - $accumulated_depreciation_at_disposal;
            $gain_loss = $disp->sale_proceeds - $net_book_value;

            // Debit Cash/Bank (for proceeds)
            $journal_entries[] = [
                'Date'        => $disp->disposal_date,
                'Description' => 'Asset Disposal Proceeds: ' . $disp->item_name,
                'Account_Debit' => 'Cash/Bank Account', // Placeholder
                'Account_Credit' => 'Asset Cost Account', // Placeholder (temporary, will be adjusted by other entries)
                'Amount'      => $disp->sale_proceeds,
                'Asset_ID'    => $disp->asset_id
            ];

            // Debit Accumulated Depreciation
            $journal_entries[] = [
                'Date'        => $disp->disposal_date,
                'Description' => 'Asset Disposal - Accumulated Depreciation: ' . $disp->item_name,
                'Account_Debit' => 'Accumulated Depreciation Account', // Placeholder
                'Account_Credit' => 'Asset Cost Account', // Placeholder (temporary)
                'Amount'      => $accumulated_depreciation_at_disposal,
                'Asset_ID'    => $disp->asset_id
            ];

            // Credit Asset Cost
            $journal_entries[] = [
                'Date'        => $disp->disposal_date,
                'Description' => 'Asset Disposal - Asset Cost: ' . $disp->item_name,
                'Account_Debit' => 'Asset Cost Account', // Placeholder (temporary)
                'Account_Credit' => 'Asset Cost Account', // Placeholder
                'Amount'      => $disp->cost,
                'Asset_ID'    => $disp->asset_id
            ];

            // Gain/Loss
            if ($gain_loss != 0) {
                $entry_type = ($gain_loss > 0) ? 'Gain' : 'Loss';
                $account_debit = ($gain_loss > 0) ? 'Gain on Disposal Account' : 'Loss on Disposal Account'; // Placeholder
                $account_credit = ($gain_loss > 0) ? 'Asset Cost Account' : 'Asset Cost Account'; // Placeholder

                $journal_entries[] = [
                    'Date'        => $disp->disposal_date,
                    'Description' => 'Asset Disposal - ' . $entry_type . ': ' . $disp->item_name,
                    'Account_Debit' => $account_debit,
                    'Account_Credit' => $account_credit,
                    'Amount'      => abs($gain_loss),
                    'Asset_ID'    => $disp->asset_id
                ];
            }
        }

        return $journal_entries;
    }

    public function array_to_csv($array, $headers = true) {
        if (!is_array($array) || empty($array)) {
            return '';
        }

        $output = '';

        // Add headers
        if ($headers) {
            $output .= implode(',', array_keys($array[0])) . "\n";
        }

        // Add data
        foreach ($array as $row) {
            $output .= implode(',', array_values($row)) . "\n";
        }

        return $output;
    }

}
