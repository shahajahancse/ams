<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gl_account_mapping_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
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
}