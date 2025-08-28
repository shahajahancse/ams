<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Direct_purchase_model extends CI_Model {

   public function __construct() {
      parent::__construct();
   }

   public function get_purchase($limit=1000, $offset=0, $unit_id=null, $status=array()) {
      $this->db->select('p.*, u.first_name');
      $this->db->from('item_purchases p');
      $this->db->join('users u', 'u.id = p.created_by', 'LEFT');
      $this->db->where('p.type', 2);

      if (!empty($unit_id)) {
         $this->db->where('p.unit_id', $unit_id);
      }
      if (!empty($status)) {
         $this->db->where_in('p.status', $status);
      }

      $this->db->order_by('p.id', 'DESC');
      $query = $this->db->get();
      $result['rows'] = $query->result();

        // count query
      $this->db->select('COUNT(*) as count');
      $this->db->from('item_purchases');
      $this->db->where('type', 2);

      if (!empty($unit_id)) {
         $this->db->where('unit_id', $unit_id);
      }
      if (!empty($status)) {
         $this->db->where_in('status', $status);
      }
      $query = $this->db->get()->result();
      $tmp = $query;
      $result['num_rows'] = $tmp[0]->count;

      return $result;
   }

   public function get_info($id) {
      $this->db->select('p.*, u.first_name');
      $this->db->from('purchase p');
      $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
      $this->db->where('p.id', $id);
      $query = $this->db->get()->row();

      return $query;
   }

   public function get_items($id) {
      $this->db->select('pi.*, i.item_name, iu.unit_name, c.category_name');
      $this->db->from('purchase_item pi');
      $this->db->join('items i', 'i.id = pi.pur_item_id', 'LEFT');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
      $this->db->join('categories c', 'c.id = i.cat_id', 'LEFT');
      $this->db->where('pi.purchase_id', $id);
      $query = $this->db->get()->result();

      return $query;
   }
}
