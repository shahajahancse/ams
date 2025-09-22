<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Items_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function get_stock_info($id, $unit_id = NULL) {
        $this->db->select('s.*, i.item_name, c.category_name, sc.sub_cate_name, u.name_en as branch_name');
        $this->db->from('item_stocks s');
        $this->db->join('item_categories c', 'c.id=s.cat_id', 'LEFT');
        $this->db->join('item_sub_categories sc', 'sc.id=s.sub_cat_id', 'LEFT');
        $this->db->join('items i', 'i.id=s.item_id', 'LEFT');
        $this->db->join('units u', 'u.id=s.unit_id', 'LEFT');
        $this->db->where('s.id', $id);
        $this->db->where('s.unit_id', $unit_id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_item_stocks($unit_id = NULL) {
        $this->db->select('s.*, i.item_name, i.order_level, c.category_name, sc.sub_cate_name, u.name_en as branch_name');
        $this->db->from('item_stocks s');
        $this->db->join('item_categories c', 'c.id=s.cat_id', 'LEFT');
        $this->db->join('item_sub_categories sc', 'sc.id=s.sub_cat_id', 'LEFT');
        $this->db->join('items i', 'i.id=s.item_id', 'LEFT');
        $this->db->join('units u', 'u.id=s.unit_id', 'LEFT');
        if ($unit_id) {
            $this->db->where('s.unit_id', $unit_id);
        }
        $this->db->order_by('i.id', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_stock_details($item_id, $unit_id) {
        $this->db->select('s.*, i.item_name, c.category_name, sc.sub_cate_name, u.name_en as branch_name');
        $this->db->from('item_stocks_details s');
        $this->db->join('items i', 'i.id=s.item_id', 'LEFT');
        $this->db->join('item_categories c', 'c.id=s.cat_id', 'LEFT');
        $this->db->join('item_sub_categories sc', 'sc.id=s.sub_cat_id', 'LEFT');
        $this->db->join('units u', 'u.id=s.unit_id', 'LEFT');
        $this->db->where('s.item_id', $item_id);
        $this->db->where('s.unit_id', $unit_id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_items(){
        $unit_id = $this->session->userdata('unit_id');
        $this->db->select('i.*, i.acquisition_date, i.serial_number, branch.name_en as branch_name,   c.category_name, sc.sub_cate_name, u.unit_name, sup.name as supplier_name,users.first_name as user_name, asset_floors.floor_name, item_rooms.name_en as room_name,');
        $this->db->from('items i');
        $this->db->join('units branch', 'branch.id=i.branch_id', 'LEFT'); // Join for branch
        $this->db->join('item_categories c', 'c.id=i.category_id', 'LEFT');
        $this->db->join('item_sub_categories sc', 'sc.id=i.sub_cat_id', 'LEFT');
        $this->db->join('item_unit u', 'u.id = i.unit_id', 'LEFT');
        $this->db->join('users', 'users.id = i.user_id', 'LEFT');
        $this->db->join('asset_floors', 'asset_floors.id = i.floor_id', 'LEFT');
        $this->db->join('item_rooms', 'item_rooms.id = i.room_id', 'LEFT');
        $this->db->join('suppliers sup', 'sup.id=i.supplier_id', 'LEFT'); // Join with suppliers table
        $this->db->order_by('i.id', 'ASC');
        $this->db->group_by('i.id');
        $query = $this->db->get()->result();
        // dd($query);
        return $query;
    }
    public function get_item($id){
        $unit_id = $this->session->userdata('unit_id');
        $this->db->select('i.*, i.acquisition_date, i.serial_number, branch.name_en as branch_name,   c.category_name, sc.sub_cate_name, u.unit_name, sup.name as supplier_name,users.first_name as user_name, asset_floors.floor_name, item_rooms.name_en as room_name,');
        $this->db->from('items i');
        $this->db->join('units branch', 'branch.id=i.branch_id', 'LEFT'); // Join for branch
        $this->db->join('item_categories c', 'c.id=i.category_id', 'LEFT');
        $this->db->join('item_sub_categories sc', 'sc.id=i.sub_cat_id', 'LEFT');
        $this->db->join('item_unit u', 'u.id = i.unit_id', 'LEFT');
        $this->db->join('users', 'users.id = i.user_id', 'LEFT');
        $this->db->join('asset_floors', 'asset_floors.id = i.floor_id', 'LEFT');
        $this->db->join('item_rooms', 'item_rooms.id = i.room_id', 'LEFT');
        $this->db->join('suppliers sup', 'sup.id=i.supplier_id', 'LEFT'); // Join with suppliers table
        $this->db->where('i.id', $id);
        $this->db->order_by('i.id', 'ASC');
        $this->db->group_by('i.id');
        $query = $this->db->get()->result();
        // dd($query);
        return $query[0];
    }

    public function get_data() {
        $this->db->select('*');
        $this->db->from('items');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_info($id) {
        $this->db->select('i.*, i.acquisition_date, i.serial_number, sup.name as supplier_name,  branch.unit_name as branch_name');
        $this->db->from('items i');
        $this->db->join('suppliers sup', 'sup.id=i.supplier_id', 'LEFT'); // Join with suppliers table
        $this->db->join('office_unit branch', 'branch.id=i.branch_id', 'LEFT'); // Join for branch
        $this->db->where('i.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('items');
        return TRUE;
    }


    // supplier info 

    public function get_supplier_info($id){
        $query = $this->db->where('id', $id)->get('suppliers')->row();
        return $query;
    }

}
