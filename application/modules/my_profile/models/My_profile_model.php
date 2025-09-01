<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_profile_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // public function set_profile_image($id, $fileName){
    //     $data = array(
    //         'profile_img' => $fileName
    //     );
    //     $this->db->where('id', $id);
    //     $this->db->update('users', $data);

    //     return true;
    // }

    public function get_info($id) {
        $this->db->select('u.id, u.blood_donate_interested, u.last_donate_date, u.scout_id, u.member_id, u.username, u.first_name, u.father_name, u.mother_name, u.gender, u.dob, u.nid, u.birth_id, u.phone, u.email, u.join_date, u.sc_section_id, u.created_on, u.last_login, FROM_UNIXTIME(u.last_login) as lastlogin, u.is_verify, u.sc_badge_id, u.sc_role_id, u.profile_img, u.qr_img, u.occupation_id, u.occp_others, u.is_interested, u.phone_emergency, u.blood_group, u.is_request, u.is_verify, u.sc_section_id, u.sc_region_id, u.sc_district_id, u.sc_upa_tha_id, u.sc_group_id, u.sc_unit_id, u.full_name_bn, u.father_name_bn, u.mother_name_bn, u.phone2, u.phone_emergency, u.passport_no, u.pass_date_issue, u.pass_date_expiry, u.pass_place_issue, u.pass_place_birth, u.religion_id, u.occp_others, u.sc_cub, u.sc_scout, u.sc_rover, u.pre_village_house, u.pre_village_house_bn, u.pre_road_block, u.pre_road_block_bn, u.pre_division_id, u.pre_district_id, u.pre_upa_tha_id, u.pre_post_office, u.per_village_house, u.per_village_house_bn, u.per_road_block, u.per_road_block_bn,  u.per_division_id, u.per_district_id, u.per_upa_tha_id, u.per_post_office, u.scout_designation, u.curr_institute_id, u.curr_class,  u.curr_role_no, u.curr_org, u.curr_desig, u.expire_date, oc.occupation_name, bg.bg_name_en, dv.div_name as pre_div_name, dv2.div_name as per_div_name, ds.district_name as pre_district_name, ds2.district_name as per_district_name, ut.up_th_name as pre_up_th_name, ut2.up_th_name as per_up_th_name, po.po_name as pre_po_name, po2.po_name as per_po_name, r.region_name, od.dis_name, od.dis_name_en, ou.upa_name, og.grp_name, og.grp_address, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn, rt.role_type_name_en, it.name as institute_name, mt.member_type_name');
        $this->db->from('users u');
        $this->db->join('blood_group bg', 'bg.id=u.blood_group', 'LEFT');
        $this->db->join('occupation oc', 'oc.id=u.occupation_id', 'LEFT');
        $this->db->join('upazila_thana ut', 'ut.id=u.pre_upa_tha_id', 'LEFT');
        $this->db->join('upazila_thana ut2', 'ut2.id=u.per_upa_tha_id', 'LEFT');
        $this->db->join('district ds', 'ds.id=u.pre_district_id', 'LEFT');
        $this->db->join('district ds2', 'ds2.id=u.per_district_id', 'LEFT');
        $this->db->join('division dv', 'dv.id=u.pre_division_id', 'LEFT');
        $this->db->join('division dv2', 'dv2.id=u.per_division_id', 'LEFT');
        $this->db->join('post_office po', 'po.id=u.pre_post_office', 'LEFT');
        $this->db->join('post_office po2', 'po2.id=u.per_post_office', 'LEFT');
        $this->db->join('office_unit unit', 'unit.id = u.sc_unit_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = u.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = u.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = u.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = u.sc_region_id', 'LEFT');
        $this->db->join('institute it', 'it.id = u.curr_institute_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = u.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sb.badge_type_id', 'LEFT');        
        $this->db->join('member_type mt', 'mt.id = u.member_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = u.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
        $this->db->where('u.id', $id);

        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_expreance_info($id, $section) {
        $this->db->select('se.*, r.region_name, od.dis_name, ou.upa_name, og.grp_name, unit.unit_name, bt.badge_type_name_bn, rt.role_type_name_bn');
        $this->db->from('scout_experience se');
        $this->db->join('office_unit unit', 'unit.id = se.sc_unit_id', 'LEFT');
        $this->db->join('office_groups og', 'og.id = se.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = se.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = se.sc_district_id', 'LEFT');
        $this->db->join('scout_badge sb', 'sb.id = se.sc_badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sb.badge_type_id', 'LEFT');
        $this->db->join('scout_role so', 'so.id = se.sc_role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = so.role_type_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = se.sc_region_id', 'LEFT');        
        $this->db->where('se.scout_id', $id);
        $this->db->where('se.section_id', $section);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_my_award($id) {
        // result query
        $this->db->select('as.*, sa.award_name');
        $this->db->from('award_to_scouts as');
        $this->db->join('scout_award sa', 'as.award_id=sa.id', 'LEFT');
        $this->db->where('scout_id', $id);

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_my_education($id) {
        // result query
        $this->db->select('ed.*, el.edu_level_name, it.name');
        $this->db->from('educations ed');
        $this->db->join('education_level el', 'el.id=ed.edu_level_id', 'LEFT');
        $this->db->join('institute it', 'it.id=ed.institute_id', 'LEFT');
        $this->db->where('scout_id', $id);

        $query = $this->db->get()->result();

        return $query;
    }
    
    public function get_award_list() {
        // result query
        $this->db->select('*');
        $this->db->from('scout_award');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_slider() {
        // result query
        $this->db->select('*');
        $this->db->from('slider');    
        $this->db->where('status', 1);

        $query = $this->db->get()->result();

        return $query;
    }

    public function get_education_level_list() {
        // result query
        $this->db->select('*');
        $this->db->from('education_level');
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get()->result();

        return $query;
    }
    public function get_award_dropdown_list() {
        // result query
        $this->db->select('*');
        $this->db->from('scout_award');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['award_name'];
        }
        return $data;
    }

    public function get_education_dropdown_list() {
        // result query
        $this->db->select('*');
        $this->db->from('education_level');
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['edu_level_name'];
        }
        return $data;
    }
    public function exists_data($table, $field1, $item1, $field2, $item2 ) {
      $this->db->from($table);
      $this->db->where($field1, $item1);
      $this->db->where($field2, $item2);
      $query = $this->db->get();

      return ($query->num_rows() >= 1);
   }
   
   public function get_institute($keyword) {
        $this->db->select('id, name');
        $this->db->from('institute');
        $this->db->where("name LIKE '%$keyword%'");
		$this->db->limit('10');

        $query = $this->db->get()->result();
		//print_r($query);exit;
		$storearr=array();
		for($i=0;$i<sizeof($query);$i++)
		{
			$storearr[]=array('id'=>$query[$i]->id,'name'=>$query[$i]->name);
		}
        //echo $this->db->last_query(); exit;

        return $storearr;
    }
	public function get_scoutlist($keyword) {
        $this->db->select('id, first_name as name, scout_id');
        $this->db->from('users u');
        $this->db->where("first_name LIKE '%$keyword%'");
		$this->db->limit('10');

        $query = $this->db->get()->result();
		//print_r($query);exit;
		$storearr=array();
		for($i=0;$i<sizeof($query);$i++)
		{
			$storearr[]=array('id'=>$query[$i]->id,'name'=>$query[$i]->scout_id.' - '.$query[$i]->name);
		}
        //echo $this->db->last_query(); exit;

        return $storearr;
    }

    public function get_scout_event_approved() {

        $this->users= $this->ion_auth->user()->row();

        $this->db->select('e.*, es.comments');
        $this->db->from('events e');
        $this->db->join('event_to_scouts es', 'e.id=es.event_id');
        $this->db->where('e.event_end_date >',date('Y-m-d'));
        // $this->db->where('e.sc_region_id', $this->users->sc_region_id);
        // $this->db->where('e.sc_district_id', $this->users->sc_district_id);
        // $this->db->where('e.sc_upa_tha_id', $this->users->sc_upa_tha_id);
        // $this->db->where('e.sc_group_id', $this->users->sc_group_id);
        $this->db->where('es.scout_id', $this->users->id);
        $this->db->where('es.status', 'Approved');
        $this->db->order_by('e.id', 'DESC');
        $query = $this->db->get()->result();
        
        return $query;
    }

   public function get_scout_training_approved() {

        $this->users= $this->ion_auth->user()->row();

        $this->db->select('e.*, es.comments');
        $this->db->from('training e');
        $this->db->join('training_to_scouts es', 'e.id=es.training_id');
        $this->db->where('e.training_end_date <',date('Y-m-d'));
        
        // $this->db->where('e.sc_region_id', $this->users->sc_region_id);
        // $this->db->where('e.sc_district_id', $this->users->sc_district_id);
        // $this->db->where('e.sc_upa_tha_id', $this->users->sc_upa_tha_id);
        // $this->db->where('e.sc_group_id', $this->users->sc_group_id);
        $this->db->where('es.scout_id', $this->users->id);
        $this->db->where('es.status', 'Approved');
        $this->db->order_by('e.id', 'DESC');
        $query = $this->db->get()->result();
       
        return $query;
       
    }

    public function get_badge_details($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn, sb.questions, p.achive_date, p.badge_id, p.question_id');
        $this->db->from('prog_badge_question_value p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');        
        $this->db->join('scout_badge_question sb', 'sb.id = p.question_id', 'LEFT');
        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_expertness($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn, sb.expert_group_name, p.achive_date, p.badge_id, p.expert_group_id, p.extra_badge');
        $this->db->from('prog_badge_expertness p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');        
        $this->db->join('scout_expertness_group sb', 'sb.id = p.expert_group_id', 'LEFT');
        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_trainings($data) {
        $this->db->select('p.*, c.course_name');
        $this->db->from('prog_training p');
        $this->db->join('scout_progress_course c', 'c.id = p.course_id', 'LEFT');
        $this->db->where('p.scout_id', $data);
        $this->db->order_by('p.id', 'DESC');
        
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_badge_details_achievement($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn,  p.achive_date, p.badge_id');
        $this->db->from('prog_badge_achievement p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_camping($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, p.area,  p.camp_date,  p.camp_name, p.certificate_no');
        $this->db->from('prog_camping p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

     public function get_badge_details_training($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn,  p.training_date, p.badge_id, p.training_name, p.certificate_no');
        $this->db->from('prog_training p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_health($form_data) {
        $this->db->select('h.*,au.id as ex_id, u.scout_id as scout_id2, au.scout_id as examiner_id,');
        $this->db->from('prog_physical_health h');
        $this->db->join('users u', 'u.id = h.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = h.examiner_id', 'LEFT');
        $this->db->where('h.scout_id',$form_data['scout_id']);
        $this->db->where('h.status',1);
        // $this->db->where('h.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }


    public function get_badge_details_institute($form_data) {
        $this->db->select('h.*,au.id as ex_id, u.scout_id as scout_id2, au.scout_id as examiner_id,');
        $this->db->from('prog_institute_promotion h');
        $this->db->join('users u', 'u.id = h.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = h.examiner_id', 'LEFT');
        $this->db->where('h.scout_id',$form_data['scout_id']);
        $this->db->where('h.status',1);
        // $this->db->where('h.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

     public function get_badge_details_promotion($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id, bt.badge_type_name_bn,  p.from_date, p.badge_id,  p.role_id, p.to_date, rt.role_type_name_bn');
        $this->db->from('prog_section_promotion p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->join('scout_badge sbg', 'sbg.id = p.badge_id', 'LEFT');
        $this->db->join('badge_type bt', 'bt.id = sbg.badge_type_id', 'LEFT');
        $this->db->join('scout_role sr', 'sr.id = p.role_id', 'LEFT');
        $this->db->join('role_type rt', 'rt.id = sr.role_type_id', 'LEFT');
        
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function get_badge_details_resign($form_data) {
        $this->db->select('p.id, p.section_id, p.status, au.id as ex_id, u.scout_id, au.scout_id as examiner_id,  p.resign_date,  p.resign_reason');
        $this->db->from('prog_group_resign p');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->join('users au', 'au.id = p.examiner_id', 'LEFT');
        $this->db->where('p.scout_id',$form_data['scout_id']);
        $this->db->where('p.status',1);
        // $this->db->where('p.section_id',$form_data['section_id']);     
        
        $query = $this->db->get()->result();
        //echo $this->db->last_query();

        return $query;
    }

    public function update_username($data, $user_id){
        $this->db->where('id', $user_id);
        if($this->db->update('users', $data)){
            return true;
        }else{
            return false;
        }
    }

}
