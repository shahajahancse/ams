<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_requisition_model extends CI_Model {

   public function __construct() {
      parent::__construct();
   }

   public function get_my_requisition($limit=1000, $offset=0, $status=NULL) {
      $this->db->select('*');
      $this->db->from('item_requisitions');
      $this->db->where('user_id', $this->session->userdata('user_id'));
      if($status){
         $this->db->where('status', $status);
      }
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get()->result();
      $result['rows'] = $query;

        // count query
      $q = $this->db->select('COUNT(*) as count');
      $this->db->from('item_requisitions');
      $this->db->where('user_id', $this->session->userdata('user_id'));
      if($status){
         $this->db->where('status', $status);
      }
      $query = $this->db->get()->result();
      $tmp = $query;
      $result['num_rows'] = $tmp[0]->count;

      return $result;
   }

   public function get_info($id) {
      $this->db->select('r.*, u.first_name, dp.dept_name, dg.desig_name, f.fiscal_year_name');
      $this->db->from('item_requisitions r');
      $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
      $this->db->join('department dp', 'dp.id = u.dept_id', 'LEFT');
      $this->db->join('designation dg', 'dg.id = u.desig_id', 'LEFT');
      $this->db->join('fiscal_year f', 'f.id = r.f_year_id', 'LEFT');
      $this->db->where('r.id', $id);
      $query = $this->db->get()->row();
      return $query;
   }

   public function get_req_items($id) {
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name');
      $this->db->from('item_requisition_details ri');
      $this->db->join('items i', 'i.id = ri.item_id', 'LEFT');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
      $this->db->join('item_categories c', 'c.id = i.cat_id', 'LEFT');
      $this->db->where('ri.requisition_id', $id);
      $query = $this->db->get()->result();

      return $query;
   }


   public function get_appointment_persons($id) {
      $this->db->select('*');
      $this->db->from('appointment_person');
      $this->db->where('data_id', $id);
      $query = $this->db->get()->result();

      return $query;
   }


   public function get_list($limit=1000, $offset=0, $status=NULL){
      $this->db->select('*');
      $this->db->from('appointment');
      if($status){
         $this->db->where('status', $status);
      }
      $this->db->order_by('date', 'DESC');
      $query = $this->db->get()->result();
      $result['rows'] = $query;

        // count query
      $q = $this->db->select('COUNT(*) as count');
      $this->db->from('appointment');
      if($status){
         $this->db->where('status', $status);
      }
      $query = $this->db->get()->result();
      $tmp = $query;
      $result['num_rows'] = $tmp[0]->count;

      return $result;
   }




   public function get_my_pass($limit = 1000, $offset = 0, $user_id) {
      // result query
      $this->db->select('p.*, h.host_name, h.host_designation, u.first_name, u.phone, u.email');
      $this->db->from('pass p');
      $this->db->join('host_person h', 'h.id = p.host_id', 'left');
      $this->db->join('users u', 'u.id=p.user_id', 'LEFT');
      $this->db->limit($limit);
      $this->db->offset($offset);
      $this->db->order_by('p.id', 'DESC');
      $this->db->where('p.user_id', $user_id);
      $result['rows'] = $this->db->get()->result();

      // count query
      $q = $this->db->select('COUNT(*) as count');
      $this->db->from('pass');
      $this->db->where('user_id', $user_id);
      $tmp = $this->db->get()->result();
      $result['num_rows'] = $tmp[0]->count;

      return $result;
   }

   public function get_dd_host_persons(){
      $data[''] = '-- Select Host Person --';
      $this->db->select('id, CONCAT(host_name, " (",host_designation," )") as text');
      $this->db->from('host_person');
      // $this->db->order_by('task_name_en', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['text'];
      }

      return $data;
   }

   public function appointment_destroy($id) {
      // Delete row
      if($this->db->delete('appointment', array('id' => $id))){
         return TRUE;
      }else{
         return FALSE;
      }
   }

}
