<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Movement_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_movements() {
        $this->db->select('am.*, i.item_name, fb.name_en from_location, tb.name_en to_location, u_from.first_name as from_custodian_fname, u_from.last_name as from_custodian_lname, u_to.first_name as to_custodian_fname, u_to.last_name as to_custodian_lname, u_created.first_name as created_by_fname, u_created.last_name as created_by_lname');
        $this->db->from('asset_movements am');
        $this->db->join('items i', 'i.id = am.asset_id', 'LEFT');
        $this->db->join('branches fb', 'fb.id = am.from_location', 'LEFT');
        $this->db->join('branches tb', 'tb.id = am.to_location', 'LEFT');
        $this->db->join('users u_from', 'u_from.id = am.from_custodian', 'LEFT');
        $this->db->join('users u_to', 'u_to.id = am.to_custodian', 'LEFT');
        $this->db->join('users u_created', 'u_created.id = am.created_by', 'LEFT');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_info($id) {
        $this->db->select('am.*, i.item_name, fb.name_en from_location, tb.name_en to_location, u_from.first_name as from_custodian_fname, u_from.last_name as from_custodian_lname, u_to.first_name as to_custodian_fname, u_to.last_name as to_custodian_lname, u_created.first_name as created_by_fname, u_created.last_name as created_by_lname');
        $this->db->from('asset_movements am');
        $this->db->join('items i', 'i.id = am.asset_id', 'LEFT');
        $this->db->join('branches fb', 'fb.id = am.from_location', 'LEFT');
        $this->db->join('branches tb', 'tb.id = am.to_location', 'LEFT');
        $this->db->join('users u_from', 'u_from.id = am.from_custodian', 'LEFT');
        $this->db->join('users u_to', 'u_to.id = am.to_custodian', 'LEFT');
        $this->db->join('users u_created', 'u_created.id = am.created_by', 'LEFT');
        $this->db->where('am.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_status_details($id) {
        $this->db->select("am.*, cu.first_name AS created_by_name", FALSE);
        $this->db->from('asset_movement_history am');
        $this->db->join('users cu', 'cu.id = am.created_by', 'LEFT');
        $this->db->where('am.asset_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }


}
