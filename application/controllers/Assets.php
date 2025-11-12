<?php

class Assets extends CI_Controller {

    public function view($id)
    {
        $asset_id = (int) decrypt_url($id);
        // dd($asset_id);
        $this->db->select('i.*,unit.unit_name,sup.*, cat.category_name, sub_cat.sub_cate_name');
        $this->db->from('items i');
        $this->db->join('item_categories cat', 'cat.id = i.category_id', 'LEFT'); 
        $this->db->join('item_sub_categories sub_cat', 'sub_cat.id    = i.sub_cat_id', 'LEFT'); 
        $this->db->join('suppliers sup',   'sup.id    = i.supplier_id', 'LEFT'); 
        // $this->db->join('users cust',      'cust.id   = i.user_id','LEFT');        
        $this->db->join('item_unit unit',  'unit.id   = i.unit_id',     'LEFT'); 
        $this->db->join('units branch',    'branch.id = i.branch_id',   'LEFT'); 
        $this->db->join('departments dept','dept.id   = i.dept_id',     'LEFT'); 
        // $this->db->join('asset_floors floor', 'floor.id  = i.floor_id',    'LEFT'); 
        // $this->db->join('item_rooms room',    'room.id   = i.room_id',     'LEFT'); 
        $this->db->where('i.id', $asset_id);
        $asset_info = $this->db->get()->row();
        // dd($asset_info);

        if (!$asset_info) {
            show_404();
        }

        $data['asset'] = $asset_info;
        $data['meta_title'] = 'Asset Details';
        $this->load->view('asset_details', $data);

    }

}

