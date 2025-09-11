<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbs_integration_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('cbs_integration');
    }

    public function get_mappings() {
        $this->db->select('gam.*, ic.category_name');
        $this->db->from('gl_account_mapping gam');
        $this->db->join('item_categories ic', 'gam.category_id = ic.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_mapping($id) {
        return $this->db->get_where('gl_account_mapping', array('id' => $id))->row_array();
    }

    public function create_mapping($data) {
        return $this->db->insert('gl_account_mapping', $data);
    }

    public function update_mapping($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('gl_account_mapping', $data);
    }

    public function delete_mapping($id) {
        return $this->db->delete('gl_account_mapping', array('id' => $id));
    }

    public function get_all_categories() {
        return $this->db->get('item_categories')->result_array();
    }

    public function generate_capitalization_journal_entry($asset_id) {
        $asset = $this->db->get_where('items', array('id' => $asset_id))->row();
        if (!$asset) {
            log_cbs_integration_event('capitalization_journal_entry', 'error', 'Asset not found for ID: ' . $asset_id);
            return false;
        }

        $mapping = $this->db->get_where('gl_account_mapping', array('category_id' => $asset->category_id))->row();
        if (!$mapping) {
            log_cbs_integration_event('capitalization_journal_entry', 'error', 'GL account mapping not found for category ID: ' . $asset->category_id);
            return false; // Or handle error
        }

        $entry_date = $asset->acquisition_date ? $asset->acquisition_date : date('Y-m-d');
        $description = 'Asset capitalization for ' . $asset->item_name;

        // Debit entry
        $debit_entry = array(
            'entry_date' => $entry_date,
            'asset_id' => $asset_id,
            'gl_account' => $mapping->asset_cost_account,
            'debit' => $asset->cost,
            'credit' => 0,
            'description' => $description,
            'entry_type' => 'capitalization'
        );
        $this->db->insert('journal_entries', $debit_entry);

        // Credit entry
        $credit_entry = array(
            'entry_date' => $entry_date,
            'asset_id' => $asset_id,
            'gl_account' => 'Capitalization Credit Account', // Placeholder
            'debit' => 0,
            'credit' => $asset->cost,
            'description' => $description,
            'entry_type' => 'capitalization'
        );
        $this->db->insert('journal_entries', $credit_entry);

        log_cbs_integration_event('capitalization_journal_entry', 'success', 'Journal entry generated for asset ID: ' . $asset_id);
        return true;
    }

    public function get_journal_entries() {
        return $this->db->get('journal_entries')->result_array();
    }

    public function get_reconciliation_data() {
        $this->db->select('gl_account, SUM(debit) as total_debit, SUM(credit) as total_credit');
        $this->db->group_by('gl_account');
        $query = $this->db->get('journal_entries');
        return $query->result_array();
    }
}
