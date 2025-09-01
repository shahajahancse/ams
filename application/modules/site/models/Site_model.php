<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($table) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('status', 1);
        $query = $this->db->get()->result();        

        return $query;
    }
     public function get_info($table, $id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from($table);
        $query = $this->db->get()->row();        

        return $query;
    }

    public function get_my_appointment() {
        $this->db->select('*');
        $this->db->from('appointment');
        $this->db->where('author', $this->session->userdata('user_id'));
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_appointment_info($id) {
        $this->db->select('*');
        $this->db->from('appointment');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_approve_pass() {
      // result query
      $this->db->select('p.*, h.host_name, h.host_designation, u.first_name, u.phone, u.email');
      $this->db->from('pass p');
      $this->db->join('host_person h', 'h.id = p.host_id', 'LEFT');
      $this->db->join('users u', 'u.id=p.user_id', 'LEFT');
      $this->db->where('p.status', 1);
      $this->db->where('DATE(p.created)', date('Y-m-d'));
      $this->db->order_by('p.id', 'ASC');
      // $this->db->limit(5);

      $query = $this->db->get()->result();

      return $query;
   }

}
