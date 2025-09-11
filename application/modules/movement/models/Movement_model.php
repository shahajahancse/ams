<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Movement_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_movements() {
        $this->db->select('i.item_name, am.movement_date, am.from_location, am.to_location, u_from.first_name as from_custodian_fname, u_from.last_name as from_custodian_lname, u_to.first_name as to_custodian_fname, u_to.last_name as to_custodian_lname, am.notes, u_created.first_name as created_by_fname, u_created.last_name as created_by_lname');
        $this->db->from('asset_movements am');
        $this->db->join('items i', 'i.id = am.asset_id', 'LEFT');
        $this->db->join('users u_from', 'u_from.id = am.from_custodian', 'LEFT');
        $this->db->join('users u_to', 'u_to.id = am.to_custodian', 'LEFT');
        $this->db->join('users u_created', 'u_created.id = am.created_by', 'LEFT');
        $query = $this->db->get();
        return $query->result();
    }

}