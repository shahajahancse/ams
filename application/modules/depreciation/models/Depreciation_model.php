<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Depreciation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_depreciation_parameters() {
        $this->db->select('adp.*, i.item_name, dm.method_name');
        $this->db->from('asset_depreciation_parameters adp');
        $this->db->join('items i', 'i.id = adp.asset_id', 'LEFT');
        $this->db->join('depreciation_methods dm', 'dm.id = adp.method_id', 'LEFT');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_depreciation_parameters_by_asset_id($asset_id) {
        $this->db->select('adp.*, i.item_name, dm.method_name');
        $this->db->from('asset_depreciation_parameters adp');
        $this->db->join('items i', 'i.id = adp.asset_id', 'LEFT');
        $this->db->join('depreciation_methods dm', 'dm.id = adp.method_id', 'LEFT');
        $this->db->where('adp.asset_id', $asset_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Function to get depreciation schedule for an asset
    public function get_depreciation_schedule($asset_id) {
        $this->db->where('asset_id', $asset_id);
        $this->db->order_by('schedule_date', 'ASC');
        $query = $this->db->get('asset_depreciation_schedule');
        return $query->result();
    }

    // Function to save depreciation schedule (called by calculation function)
    public function save_depreciation_schedule($data) {
        $this->db->insert_batch('asset_depreciation_schedule', $data);
        return $this->db->affected_rows();
    }

    // Function to clear existing depreciation schedule for an asset
    public function clear_depreciation_schedule($asset_id) {
        $this->db->where('asset_id', $asset_id);
        $this->db->delete('asset_depreciation_schedule');
        return $this->db->affected_rows();
    }

}