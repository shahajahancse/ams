<?php

class Assets extends CI_Controller {

    public function view($id)
    {
        $asset_id = (int) $id;
        $this->db->select('i.*, i.acquisition_date, i.serial_number, i.warranty_information, sup.name as supplier_name, CONCAT(cust.first_name, " ", cust.last_name) as custodian_name, branch.unit_name as branch_name, dept.dept_name as department_name, floor.floor_name as floor_name, room.room_name as room_name');
        $this->db->from('items i');
        $this->db->join('suppliers sup', 'sup.id=i.supplier_id', 'LEFT'); // Join with suppliers table
        $this->db->join('users cust', 'cust.id=i.custodian_id', 'LEFT'); // Join with users table for custodian
        $this->db->join('office_unit branch', 'branch.id=i.branch_id', 'LEFT'); // Join for branch
        $this->db->join('departments dept', 'dept.id=i.department_id', 'LEFT'); // Join for department
        $this->db->join('asset_floors floor', 'floor.id=i.floor_id', 'LEFT'); // Join for floor
        $this->db->join('asset_rooms room', 'room.id=i.room_id', 'LEFT'); // Join for room
        $this->db->where('i.id', $id);
        $asset_info = $this->db->get()->row();
        // dd($asset_info);

        if (!$asset_info) {
            show_404();
        }

        $data['asset'] = $asset_info;
        $data['meta_title'] = 'Asset Details';
        $data['subview'] = 'asset_details';
        $this->load->view('backend/_layout_main', $data);
    }

}

