<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Disposal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_disposals() {
        $this->db->select('ad.*, i.item_name, u.first_name, u.last_name');
        $this->db->from('asset_disposals ad');
        $this->db->join('items i', 'i.id = ad.asset_id', 'LEFT');
        $this->db->join('users u', 'u.id = ad.created_by', 'LEFT');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_disposal_by_asset_id($asset_id) {
        $this->db->select('ad.*, i.item_name, u.first_name, u.last_name');
        $this->db->from('asset_disposals ad');
        $this->db->join('items i', 'i.id = ad.asset_id', 'LEFT');
        $this->db->join('users u', 'u.id = ad.created_by', 'LEFT');
        $this->db->where('ad.asset_id', $asset_id);
        $query = $this->db->get();
        return $query->row();
    }

}