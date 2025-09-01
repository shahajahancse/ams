<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Activitylog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_activity_logs($limit=1000, $offset=0, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_scout_group_id=NULL, $status=NULL) {
         //echo 'hello'; exit;
        $this->db->select('al.*, u.is_office, u.username, u.scout_id, u.first_name, at.name, on.nhq_office_name, or.region_name, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('activity_logs al');
        $this->db->join('users u', 'u.id = al.user_id', 'LEFT');
        $this->db->join('activity_types at', 'at.id = al.activity_type_id', 'LEFT');     
        $this->db->join('office_groups og', 'og.id = al.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = al.sc_upazila_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = al.sc_district_id', 'LEFT');
        $this->db->join('office_region or', 'or.id = al.sc_region_id', 'LEFT'); 
        $this->db->join('office_nhq on', 'on.id = al.sc_nhq_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('al.id', 'DESC');

        // Search Filter
        if($this->input->get('region') != NULL){
            $this->db->where('u.sc_region_id', $this->input->get('region')); 
        }
        if($this->input->get('district') > '0'){
            $this->db->where('u.sc_district_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > '0'){
            $this->db->where('u.sc_upa_tha_id', $this->input->get('upazila'));     
        }
        if($this->input->get('sgroup') > '0'){
            $this->db->where('u.sc_group_id', $this->input->get('sgroup'));     
        }
        if($this->input->get('memberType') > '0'){
            $this->db->where('u.member_id', $this->input->get('memberType'));     
        }
        if($this->input->get('scoutID') != NULL){
            $this->db->where('u.scout_id', $this->input->get('scoutID')); 
        }
        if($this->input->get('name') != NULL){
            $this->db->like('u.first_name', $this->input->get('name'));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('u.username', $this->input->get('username')); 
        }
        if($this->input->get('gender') != NULL){
            $this->db->where('u.gender', $this->input->get('gender')); 
        }
        if($this->input->get('section') != NULL){
            $this->db->where('u.sc_section_id', $this->input->get('section')); 
        }

        //Data Access
        /*if($region_id){
            $this->db->where('u.sc_region_id', $region_id);
        }elseif($sc_district_id){
            $this->db->where('u.sc_district_id', $sc_district_id);
        }elseif($sc_upa_tha_id){
            $this->db->where('u.sc_upa_tha_id', $sc_upa_tha_id);
        }elseif($sc_scout_group_id){
            $this->db->where('u.sc_group_id', $sc_scout_group_id);                    
        }*/
        $query = $this->db->get()->result();     
        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('activity_logs');

        // Search Filter
        /*if($this->input->get('region') != NULL){
            $this->db->where('sc_region_id', $this->input->get('region')); 
        }
        if($this->input->get('district') > '0'){
            $this->db->where('sc_district_id', $this->input->get('district'));     
        }
        if($this->input->get('upazila') > '0'){
            $this->db->where('sc_upa_tha_id', $this->input->get('upazila'));     
        }
        if($this->input->get('sgroup') > '0'){
            $this->db->where('sc_group_id', $this->input->get('sgroup'));     
        }
        if($this->input->get('memberType') > '0'){
            $this->db->where('member_id', $this->input->get('memberType'));     
        }
        if($this->input->get('scoutID') != NULL){
            $this->db->where('scout_id', $this->input->get('scoutID')); 
        }
        if($this->input->get('name') != NULL){
            $this->db->like('first_name', $this->input->get('name'));
        }
        if($this->input->get('username') != NULL){
            $this->db->where('username', $this->input->get('username')); 
        }
        if($this->input->get('gender') != NULL){
            $this->db->where('gender', $this->input->get('gender')); 
        }
        if($this->input->get('section') != NULL){
            $this->db->where('sc_section_id', $this->input->get('section')); 
        }*/

        //Data Access
        /*if($region_id){
            $this->db->where('sc_region_id', $region_id);
        }elseif($sc_district_id){
            $this->db->where('sc_district_id', $sc_district_id);
        }elseif($sc_upa_tha_id){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }elseif($sc_scout_group_id){
            $this->db->where('sc_group_id', $sc_scout_group_id);                    
        }*/
        $query = $this->db->get()->result();

        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

}
