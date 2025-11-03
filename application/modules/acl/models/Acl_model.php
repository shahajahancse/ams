<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Acl_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user_data($id) {
        $query = $this->db->select('u.id, u.password, u.email, u.created_on, u.last_login, u.first_name, u.last_name, u.company, u.phone, ug.group_id, g.description ')
                ->join('users_groups ug', 'ug.user_id = u.id', 'left')
                ->join('groups g', 'g.id = ug.user_id', 'left')
                ->limit(1)
                ->order_by('u.id', 'ASC')
                ->get_where('users u', array('u.id' => $id));
        return $query->row();
    }

    public function get_users($limit = 1000, $offset = 0) {
        // result query
        $this->db->select('u.id, u.username, u.first_name, u.phone, u.email, u.created_on, u.last_login, u.active, dp.dept_name, dg.desig_name, un.name_en');
        $this->db->from('users u');
        $this->db->join('units un', 'un.id = u.unit_id', 'LEFT');
        $this->db->join('departments dp', 'dp.id = u.dept_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = u.desig_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('u.id', 'ASC');
        if($this->input->get('name') != NULL){
            $this->db->like('u.first_name', $this->input->get('name'));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('u.email', $this->input->get('username'));
        }
        $this->db->where_not_in('u.id', array(1,2));
        $result['rows'] = $this->db->get()->result();

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        if($this->input->get('name') != NULL){
            $this->db->like('first_name', $this->input->get('name'));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('email', $this->input->get('username'));
        }
        $this->db->where_not_in('id', array(1,2));
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    public function get_department(){
        $data[''] = 'Select Department';
        $this->db->select('id, dept_name');
        $this->db->from('departments');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['dept_name'];
        }

        return $data;
    }

    public function get_designation(){
        $data[''] = 'Select Department';
        $this->db->select('id, desig_name');
        $this->db->from('designation');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['desig_name'];
        }

        return $data;
    }

    public function get_access_level() {
        // count query
        $this->db->select('al.id, tr.task_name_en, tr.task_name_bn, g.name, g.description, gr.role_name_en, gr.role_name_bn, gt.group_type_en, gt.group_type_bn');
        $this->db->from('access_level al');
        $this->db->join('task_register tr', 'tr.id=al.task_register_id', 'LEFT');
        $this->db->join('groups g', 'g.id=al.groups_id', 'LEFT');
        $this->db->join('groups_role gr', 'gr.id=al.groups_role_id', 'LEFT');
        $this->db->join('groups_type gt', 'gt.id=al.groups_type_id', 'LEFT');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_access_level_info($id) {
        $query = $this->db->from('access_level')->where('id', $id)->get()->row();
        return $query;
    }

    public function get_task_register() {
        // count query
        $this->db->select('id, task_name_en, task_name_bn, controller_name, controller_function');
        $this->db->from('task_register');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_task_register_info($id) {
        $query = $this->db->from('task_register')->where('id', $id)->get()->row();
        return $query;
    }

    public function get_group_type() {
        // count query
        $this->db->select('id, group_type_en, group_type_bn, type_description');
        $this->db->from('groups_type');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_group_type_info($id) {
        $query = $this->db->from('groups_type')->where('id', $id)->get()->row();
        return $query;
    }

    public function get_role_group() {
        // count query
        $this->db->select('id, role_name_en, role_name_bn, role_description');
        $this->db->from('groups_role');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_role_group_info($id) {
        $query = $this->db->from('groups_role')->where('id', $id)->get()->row();
        return $query;
    }

    public function get_group_name() {
        // count query
        $this->db->select('id, name, description');
        $this->db->from('groups');
        $query = $this->db->get()->result();

        return $query;
    }


    public function get_dd_task_register(){
        $data[''] = 'Select Task Register';
        $this->db->select('id, task_name_en, task_name_bn');
        $this->db->from('task_register');
        $this->db->order_by('task_name_en', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['task_name_en'];
        }

        return $data;
    }

    public function get_dd_groups(){
        $data[''] = 'Select Groups';
        $this->db->select('id, description');
        $this->db->from('groups');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['description'];
        }

        return $data;
    }

    public function get_dd_groups_role(){
        $data[''] = 'Select Groups Role';
        $this->db->select('id, role_name_en, role_name_bn');
        $this->db->from('groups_role');
        $this->db->order_by('role_name_en', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['role_name_en'];
        }

        return $data;
    }

    public function get_dd_groups_type(){
        $data[''] = 'Select Groups Type';
        $this->db->select('id, group_type_en, group_type_bn');
        $this->db->from('groups_type');
        $this->db->order_by('group_type_en', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['group_type_en'];
        }

        return $data;
    }

    public function user_destroy($id) {
        $query = $this->db->delete('users', array('id' => $id));
        return $query;
    }

    public function get_approver_user_roles($limit = 1000, $offset = 0) {
        $this->db->select('*');
        $this->db->from('approver_user_role');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('id', 'ASC');
        $result['rows'] = $this->db->get()->result();

        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('approver_user_role');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    public function get_permissions($limit = 1000, $offset = 0) {
        $this->db->select('*');
        $this->db->from('permissions');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('id', 'ASC');
        $result['rows'] = $this->db->get()->result();

        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('permissions');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    public function get_approver_user_role_info($id) {
        $query = $this->db->from('approver_user_role')->where('id', $id)->get()->row();
        return $query;
    }

    public function approval_role_manages($id) {
        $this->db->select('arm.*, u.first_name, aur.name as role_name, afbt.name as fb_type_name');
        $this->db->from('approval_role_manage arm');
        $this->db->join('users u', 'u.id = arm.user_id');
        $this->db->join('approver_user_role aur', 'aur.id = arm.role_id');
        $this->db->join('approve_forward_backward_type afbt', 'afbt.id = arm.fb_type_id');
        $this->db->where('arm.fb_type_id', $id);
        $this->db->order_by('arm.id', 'ASC');
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_approval_role_manages($limit = 1000, $offset = 0) {
        $this->db->select('arm.*, u.first_name, aur.name as role_name, afbt.name as fb_type_name');
        $this->db->from('approval_role_manage arm');
        $this->db->join('users u', 'u.id = arm.user_id');
        $this->db->join('approver_user_role aur', 'aur.id = arm.role_id');
        $this->db->join('approve_forward_backward_type afbt', 'afbt.id = arm.fb_type_id');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('arm.id', 'ASC');
        $result['rows'] = $this->db->get()->result();

        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('approval_role_manage');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    public function get_approval_role_manage_info($id) {
        $query = $this->db->from('approval_role_manage')->where('id', $id)->get()->row();
        return $query;
    }

    public function get_users_for_dropdown(){
        $data[''] = 'Select User';
        $this->db->select('id, first_name');
        $this->db->from('users');
        $this->db->order_by('first_name', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['first_name'];
        }

        return $data;
    }

    public function get_approver_roles_for_dropdown(){
        $data[''] = 'Select Role';
        $this->db->select('id, name');
        $this->db->from('approver_user_role');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['name'];
        }

        return $data;
    }

    public function get_approve_forward_backward_types($limit = 1000, $offset = 0) {
        $this->db->select('*');
        $this->db->from('approve_forward_backward_type');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('id', 'ASC');
        $result['rows'] = $this->db->get()->result();

        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('approve_forward_backward_type');
        $tmp = $this->db->get()->result();
        $result['num_rows'] = $tmp[0]->count;
        return $result;
    }

    public function get_approve_forward_backward_type_info($id) {
        $query = $this->db->from('approve_forward_backward_type')->where('id', $id)->get()->row();
        return $query;
    }

    public function get_approve_forward_backward_type_for_dropdown(){
        $data[''] = 'Select Type';
        $this->db->select('id, name');
        $this->db->from('approve_forward_backward_type');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();

         foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['name'];
        }

        return $data;
    }

}
