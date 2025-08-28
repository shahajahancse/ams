<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function count_data($tf = NULL, $from_date = NULL, $to_date = NULL, $unit_id = NULL) {
        $this->db->select("
            COUNT(CASE WHEN r.status = 7 THEN 1 END) AS rej,
            COUNT(CASE WHEN r.status = 6 THEN 1 END) AS apv1,
            COUNT(CASE WHEN r.status = 5 THEN 1 END) AS apv,
            COUNT(CASE WHEN r.status = 4 THEN 1 END) AS pen2,
            COUNT(CASE WHEN r.status = 3 THEN 1 END) AS pen1,
            COUNT(CASE WHEN r.status = 2 THEN 1 END) AS pen,
        ");
        if ($tf) {
            $this->db->where('r.unit_id', $this->session->userdata('unit_id'));
        }
        if (!empty($unit_id)) {
            $this->db->where('r.unit_id', $unit_id);
        }
        if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('DATE(r.created_at) BETWEEN "'. $from_date. '" AND "'. $to_date.'"');
        }
        $row = $this->db->get('item_requisitions r')->row();
        return $row;
    }

    public function count_data_parches($tf = NULL, $from_date = NULL, $to_date = NULL, $unit_id = NULL) {
        $this->db->select("
            COUNT(CASE WHEN r.status = 7 THEN 1 END) AS rej,
            COUNT(CASE WHEN r.status = 6 THEN 1 END) AS apv1,
            COUNT(CASE WHEN r.status = 5 THEN 1 END) AS apv,

            COUNT(CASE WHEN r.status = 8 THEN 1 END) AS pen1,
            COUNT(CASE WHEN r.status = 4 THEN 1 END) AS pen2,
            COUNT(CASE WHEN r.status = 3 THEN 1 END) AS pen3,
            COUNT(CASE WHEN r.status = 2 THEN 1 END) AS pen4,
        ");
        if ($tf) {
            $this->db->where('r.unit_id', $this->session->userdata('unit_id'));
        }
        if (!empty($unit_id)) {
            $this->db->where('r.unit_id', $unit_id);
        }
        if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('DATE(r.created_at) BETWEEN "'. $from_date. '" AND "'. $to_date.'"');
        }
        $row = $this->db->get('item_purchases r')->row();
        return $row;
    }







    public function get_count_data($status = 'all') {
        $results = $this->get_requisition($limit, $offset, $status);
        $own_req= $this->get_own_request($this->userSessID , $status);
        $d = array_merge($results['rows'], $own_req);
        $d = array_map("unserialize", array_unique(array_map("serialize", $d)));
        return count($d);
    }
    public function get_requisition($limit=1000, $offset=0, $status=NULL) {
        $desk_arr=[];
        $desk_arr[]=$this->ion_auth->get_group_id();
        if(in_array('6', $this->ion_auth->get_permission())){
            $ta=1;
        }
        $this->db->select('r.*, u.first_name, dp.dept_name, f.fiscal_year_name');
        $this->db->from('requisitions as r');
        $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
        $this->db->join('department dp', 'dp.id = u.dept_id', 'LEFT');
        $this->db->join('fiscal_year f', 'f.id = r.f_year_id', 'LEFT');
        if($status != 'all'){
           $this->db->where('r.status', $status);
        }
        if($ta!=1){
            $this->db->where_in('r.desk_id', $desk_arr);
        }
        $this->db->where('r.is_save', 0);


        $this->db->order_by('r.id', 'DESC');
        $query = $this->db->get()->result();

        $result['rows'] = $query;
        $this->db->from('requisitions');
        if($status){
           $this->db->where('status', $status);
        }
        $query = $this->db->get()->result();
        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        return $result;
     }
     public function get_own_request($user_id,$status=NULL) {
        $this->db->select('r.*, u.first_name, dp.dept_name, f.fiscal_year_name');
        $this->db->from('requisitions as r');
        $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
        $this->db->join('department dp', 'dp.id = u.dept_id', 'LEFT');
        $this->db->join('fiscal_year f', 'f.id = r.f_year_id', 'LEFT');
        $this->db->where('r.user_id', $user_id);
        if($status != 'all'){
           $this->db->where('r.status', $status);
        }
        $this->db->order_by('r.id', 'DESC');
        $query = $this->db->get()->result();
        return $query;
     }



    public function get_count_data_parches($status = 'all') {
        $results = $this->get_parches($status);
        $own_req= $this->get_own_request_parches($this->userSessID , $status);
        $d = array_merge($results['rows'], $own_req);
        $d = array_map("unserialize", array_unique(array_map("serialize", $d)));
        return count($d);
    }
    public function get_parches($status=NULL) {
        $desk_arr=[];
        $desk_arr[]=$this->ion_auth->get_group_id();
        if(in_array('6', $this->ion_auth->get_permission())){
            $ta=1;
        }

        $this->db->select('r.*');
        $this->db->from('purchase as r');
        if($status != 'all'){
           $this->db->where('r.status', $status);
        }
        if($ta!=1){
            $this->db->where_in('r.desk_id', $desk_arr);
        }

        $this->db->order_by('r.id', 'DESC');
        $query = $this->db->get()->result();

        $result['rows'] = $query;
        $this->db->from('purchase');
        if($status){
           $this->db->where('status', $status);
        }
        $query = $this->db->get()->result();
        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;
        return $result;
     }
     public function get_own_request_parches($user_id,$status=NULL) {
        $this->db->select('r.*');
        $this->db->from('purchase as r');
        $this->db->where('r.user_id', $user_id);
        if($status != 'all'){
           $this->db->where('r.status', $status);
        }
        $this->db->order_by('r.id', 'DESC');
        $query = $this->db->get()->result();
        return $query;
     }







    public function get_members_count() {
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $q = $this->db->get()->result();

        $tmp = $q;
        $ret['num_rows'] = $tmp[0]->count;

        return $ret;
    }

    public function get_count_online_register($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('member_id !=', 0);
        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $tmp = $this->db->get('users')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }
    // public function get_count_online_register_today() {
    //     $tmp = $this->db->select('COUNT(*) as count')->where('member_id !=', 0)->where('created_on', strtotime(date('Y-m-d')))->get('users')->result();
    //     // echo $this->db->last_query(); exit;
    //     $ret['count'] = $tmp[0]->count;
    //     return $ret;
    // }
    // public function get_count_online_register_this_month() {
    //     $tmp = $this->db->select('COUNT(*) as count')->where('member_id !=', 0)->where('STR_TO_DATE(created_on, "%m")', date('m'))->get('users')->result();
    //     echo $this->db->last_query(); exit;
    //     $ret['count'] = $tmp[0]->count;
    //     return $ret;
    // }

    public function get_count_member_by_office($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL) {
        // count query
        //, u.sc_district_id, od.dis_name, ou.upa_name, og.grp_name
        $this->db->select('COUNT(u.id) as count_id');
        $this->db->from('users u');
        $this->db->where('u.scout_id IS NOT NULL', NULL);
        $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        if($region_id != NULL){
            $this->db->where('u.sc_region_id', $region_id);
            $this->db->group_by('u.sc_district_id');
            // $this->db->having('u.sc_district_id > 0');
        }
        if($sc_district_id != NULL){
            $this->db->where('u.sc_district_id', $sc_district_id);
            $this->db->group_by('u.sc_upa_tha_id');
            // $this->db->having('u.sc_upa_tha_id > 0');
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('u.sc_upa_tha_id', $sc_upa_tha_id);
            $this->db->group_by('u.sc_group_id');
        }
        // echo $this->db->last_query(); exit;
        // $this->db->where("HAVING COUNT(u.id) > 0");
        // $this->db->having('COUNT(count_id) > 0');
        $q = $this->db->get()->result();
        // $tmp = $q;
        // $ret['count'] = $tmp[0]->count;

        return $q;
    }

    public function get_scouts_gorup($sc_upazila_id=NULL){
        $this->db->select('id, grp_name');
        $this->db->from('office_groups');
        if($sc_upazila_id != NULL){
            $this->db->where('grp_scout_upa_id', $sc_upazila_id);
        }
        $q = $this->db->get()->result();

        return $q;
    }

    public function get_scouts_upazila_name($sc_district_id=NULL){
        $this->db->select('id, upa_name');
        $this->db->from('office_upazila');
        if($sc_district_id != NULL){
            $this->db->where('upa_scout_dis_id', $sc_district_id);
        }
        $q = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $q;
    }

    public function get_scouts_district_name($sc_region_id=NULL){
        $this->db->select('id, dis_name_en');
        $this->db->from('office_district');
        if($sc_region_id != NULL){
            $this->db->where('dis_scout_region_id', $sc_region_id);
        }
        $q = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $q;
    }

    public function get_count_scouts_member_by_office_id($region=NULL, $district=NULL, $upazila=NULL, $group=NULL){
        $this->db->select('COUNT(*) as count');
        $this->db->where('scout_id IS NOT NULL', NULL);
        if(!empty($region)){
            $this->db->where('sc_region_id', $region);
        }
        if(!empty($district)){
            $this->db->where('sc_district_id', $district);
        }
        if(!empty($upazila)){
            $this->db->where('sc_upa_tha_id', $upazila);
        }
        if(!empty($group)){
            $this->db->where('sc_group_id', $group);
        }

        $tmp = $this->db->get('users')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_count_member_by_office_test($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL) {
        // count query
        //, u.sc_district_id, od.dis_name, ou.upa_name, og.grp_name
        $this->db->select('COUNT(u.id) as count_id, u.sc_district_id, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('users u');
        $this->db->where('u.scout_id IS NOT NULL', NULL);
        $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        if($region_id != NULL){
            $this->db->where('u.sc_region_id', $region_id);
            $this->db->group_by('u.sc_district_id');
            // $this->db->having('u.sc_district_id > 0');
        }
        if($sc_district_id != NULL){
            $this->db->where('u.sc_district_id', $sc_district_id);
            $this->db->group_by('u.sc_upa_tha_id');
            // $this->db->having('u.sc_upa_tha_id > 0');
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('u.sc_upa_tha_id', $sc_upa_tha_id);
            $this->db->group_by('u.sc_group_id');
            //$this->db->group_by('og.grp_name');
            // $this->db->where("HAVING COUNT(u.sc_group_id) > 0");
        }
        // echo $this->db->last_query(); exit;
        // $this->db->having('COUNT(count_id) > 0');
        $q = $this->db->get()->result();
        // $tmp = $q;
        // $ret['count'] = $tmp[0]->count;

        return $q;
    }


    public function get_count_online_members($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->where('scout_id IS NOT NULL', NULL);
        // $this->db->where('member_id !=', 0);
        // $this->db->where('status', 1);
        $this->db->where('gender != ', NULL);
        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $q = $this->db->get('users')->result();
        // echo $this->db->last_query(); exit;
        $tmp = $q;
        $ret['count'] = $tmp[0]->count;

        return $ret;
    }

    public function get_count_online_members_by_gender($gender) {
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('scout_id IS NOT NULL', NULL);
        // $this->db->where('member_id !=', 0);
        // $this->db->where('sc_section_id IS NOT NULL', NULL);
        $this->db->where('gender', $gender);
        $q = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        $tmp = $q;
        $ret['count'] = $tmp[0]->count;

        return $ret;
    }




    public function get_count_by_member_type($memberType) {
        $result = array();
        // count query
        $this->db->select('COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('member_id', $memberType);
        $this->db->where('scout_id IS NOT NULL', NULL);
        $q = $this->db->get()->result();

        $result = $q;
        $result['count'] = $result[0]->count;

        return $result;
    }


    public function get_count_event_total() {
        // count query
        $tmp = $this->db->select('COUNT(*) as count')->get('events')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }
    public function get_count_event_total_by_level($level) {
        // count query
        $tmp = $this->db->select('COUNT(*) as count')->where('event_level', $level)->get('events')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_count_online_member_by_region($region_id) {
        // count query
        $tmp = $this->db->select('COUNT(*) as count')->where('scout_id IS NOT NULL', NULL)->where('gender !=', NULL)->where('sc_region_id', $region_id)->get('users')->result();
        // echo $this->db->last_query(); exit;
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_censes_by_member_id_section_id_gender($member_id, $sc_section_id, $gender, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        $result = array();
        $this->db->select('COUNT(*) as count, gender');
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('member_id', $member_id);
        $this->db->where('sc_section_id', $sc_section_id);
        $this->db->where('gender', $gender);
        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $q = $this->db->get('users')->result();
        //echo $this->db->last_query(); //exit;
        $result = $q;
        $result['count'] = $result[0]->count;
        return $result;
    }

    public function get_censes_by_member_id_gender($member_id, $gender, $region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL, $sc_group_id=NULL) {
        $result = array();
        $this->db->select('COUNT(*) as count,gender');
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('member_id', $member_id);
        $this->db->where('gender', $gender);
        if($region_id != NULL){
            $this->db->where('sc_region_id', $region_id);
        }
        if($sc_district_id != NULL){
            $this->db->where('sc_district_id', $sc_district_id);
        }
        if($sc_upa_tha_id != NULL){
            $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
        }
        if($sc_group_id != NULL){
            $this->db->where('sc_group_id', $sc_group_id);
        }
        $q = $this->db->get('users')->result();
        $result = $q;
        $result['count'] = $result[0]->count;
        return $result;
    }

    public function get_members_count_by_sc_section_id($sc_section_id, $gender) {
        // count query
        $this->db->select('COUNT(*) as count,gender');
        $this->db->from('users');
       // $this->db->group_by('gender');

        $this->db->where('sc_section_id', $sc_section_id);
        $this->db->where('scout_id IS NOT NULL', NULL);
        $this->db->where('gender', $gender);
        //$this->db->where('YEAR(join_date)',$year);
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
       //echo '<pre>';
         // print_r($result);
         // exit;
     //  $result['gender'] = $result['gender'];
        $result['count'] = $result[0]->count;

        return $result;
    }
     public function get_members_count_by_member_type($member_type,$gender) {
        // count query
        $this->db->select('COUNT(*) as count,gender');
        $this->db->from('users');
       // $this->db->group_by('gender');
        $this->db->where('member_id',$member_type);
        $this->db->where('gender',$gender);
        //$this->db->where('YEAR(join_date)',$year);
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
       //echo '<pre>';
         // print_r($result);
         // exit;
     //  $result['gender'] = $result['gender'];
        $result['count'] = $result[0]->count;

        return $result;
    }

    public function get_scout_info($user_id){
        $this->db->select('u.id, scout_id, r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name');
        $this->db->from('users u');
        $this->db->join('office_unit unit', 'unit.id = u.sc_unit_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.sc_region_id', 'LEFT');
        $this->db->where('u.id', $user_id);
        $query = $this->db->get()->row();

        return $query;
    }
    public function get_members_count_by_sc_region_id($sc_region_id) {
        // count query
        $this->db->select('COUNT(CASE WHEN u.gender="Male" THEN u.id END ) as count_male, COUNT(CASE WHEN u.gender="Female" THEN u.id END) as count_female, COUNT(CASE WHEN u.gender="Others" THEN u.id END) as count_other,COUNT(u.id) as count_total,u.sc_section_id');
        $this->db->from('users u');
       // $this->db->group_by('gender');
        $this->db->where('u.scout_id IS NOT NULL');
        $this->db->where('u.sc_region_id', $sc_region_id);
        //$this->db->where('gender',$gender);
        $this->db->group_by('u.sc_section_id');
        $q = $this->db->get()->result();

        //echo $this->db->last_query(); exit;
        $result = array();
        $result = $q;
        /*echo '<pre>';
        print_r($result);
        exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

        return $result;
    }

    public function get_members_count_by_sc_district_id($sc_district_id) {
        // count query
        $this->db->select('COUNT(CASE WHEN u.gender="Male" THEN u.id END ) as count_male, COUNT(CASE WHEN u.gender="Female" THEN u.id END) as count_female, COUNT(CASE WHEN u.gender="Others" THEN u.id END) as count_other,COUNT(u.id) as count_total, u.sc_section_id');
        $this->db->from('users u');
       // $this->db->group_by('gender');
        $this->db->where('u.scout_id IS NOT NULL');
        $this->db->where('u.sc_district_id',$sc_district_id);
        //$this->db->where('gender',$gender);
        $this->db->group_by('u.sc_section_id');
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
        /*echo '<pre>';
        print_r($result);
        exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

        return $result;
    }
    public function get_members_count_by_sc_upa_tha_id($sc_upa_tha_id) {
        // count query
        $this->db->select('COUNT(CASE WHEN u.gender="Male" THEN u.id END ) as count_male, COUNT(CASE WHEN u.gender="Female" THEN u.id END) as count_female, COUNT(CASE WHEN u.gender="Others" THEN u.id END) as count_other,COUNT(u.id) as count_total,u.sc_section_id');
        $this->db->from('users u');
       // $this->db->group_by('gender');
        $this->db->where('u.scout_id IS NOT NULL');
        $this->db->where('u.sc_upa_tha_id',$sc_upa_tha_id);
        //$this->db->where('gender',$gender);
        $this->db->group_by('u.sc_section_id');
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
        /*echo '<pre>';
        print_r($result);
        exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

        return $result;
    }
    public function get_members_count_by_sc_group_id($sc_group_id) {
        // count query
        $this->db->select('COUNT(CASE WHEN u.gender="Male" THEN u.id END ) as count_male, COUNT(CASE WHEN u.gender="Female" THEN u.id END) as count_female, COUNT(CASE WHEN u.gender="Others" THEN u.id END) as count_other,COUNT(u.id) as count_total,u.sc_section_id');
        $this->db->from('users u');
       // $this->db->group_by('gender');
        $this->db->where('u.scout_id IS NOT NULL');
        $this->db->where('u.sc_group_id',$sc_group_id);
        //$this->db->where('gender',$gender);
        $this->db->group_by('u.sc_section_id');
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
        /*echo '<pre>';
        print_r($result);
        exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

        return $result;
    }

    public function get_region_office_by_user($userID){
        $this->db->select('office_id');
        $this->db->from('users_region');
        $this->db->where('user_id', $userID);
        $query = $this->db->get()->row();

        return $query;
    }

}
