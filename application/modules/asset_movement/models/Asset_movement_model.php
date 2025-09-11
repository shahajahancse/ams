<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_movement_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_movements() {
        $this->db->select('amh.*, i.item_name, fb.branch_name as from_branch_name, fdep.dept_name as from_department_name, tb.branch_name as to_branch_name, tdep.dept_name as to_department_name, u.first_name, u.last_name');
        $this->db->from('asset_movement_history amh');
        $this->db->join('items i', 'i.id = amh.asset_id', 'LEFT');
        $this->db->join('branches fb', 'fb.id = amh.from_branch_id', 'LEFT');
        $this->db->join('departments fdep', 'fdep.id = amh.from_department_id', 'LEFT');
        $this->db->join('branches tb', 'tb.id = amh.to_branch_id', 'LEFT');
        $this->db->join('departments tdep', 'tdep.id = amh.to_department_id', 'LEFT');
        $this->db->join('users u', 'u.id = amh.transferred_by_user_id', 'LEFT');
        $this->db->order_by('amh.transfer_date', 'DESC');
        return $this->db->get()->result();
    }

    public function get_movement_by_asset_id($asset_id) {
        $this->db->where('asset_id', $asset_id);
        $this->db->order_by('transfer_date', 'DESC');
        $this->db->limit(1); // Get the latest movement for pre-filling 'from' fields
        return $this->db->get('asset_movement_history')->row();
    }
}
