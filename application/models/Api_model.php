<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

   public function __construct() {
      parent::__construct();
   }

   public function get_banbeis_institute(){
      $this->db->select('id, name, eiin');
      $this->db->from('institute');
      // $this->db->where('id', $id);
      // $this->db->limit(10000);
      $query = $this->db->get()->result_array();

      return $query;
   }

   public function get_institute($keyword) {
      $this->db->select('id, name');
      $this->db->from('institute');
      $this->db->where("name LIKE '%$keyword%'");
      $this->db->limit('10');

      $query = $this->db->get()->result();
      //print_r($query);exit;
      $storearr=array();
      for($i=0;$i<sizeof($query);$i++){
        $storearr[]=array('id'=>$query[$i]->id,'name'=>$query[$i]->name);
      }
      //echo $this->db->last_query(); exit;

      return $storearr;
    }


   /*********************** Training ************************/
   public function get_my_training($id) {
        $this->db->select('ts.*, t.training_name, t.training_center, t.training_type, t.training_start_date');
        $this->db->from('training_to_scouts ts');
        $this->db->join('training t', 't.id=ts.training_id');
        $this->db->where('ts.scout_id', $id);
        $this->db->where('ts.status', 'Approved');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_training_info($id) {
        $this->db->select('e.*,r.region_name, od.dis_name, ou.upa_name, og.grp_name, tr.trainer_name');
        $this->db->from('training e');
        $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = e.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
        $this->db->join('trainer tr', 'tr.id = e.trainer_id', 'LEFT');
        $this->db->where('e.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function upcomming_training($id) {
        $this->users= $this->ion_auth->user($id)->row();
        $this->db->select('*');
        $this->db->where('training_start_date >',date('Y-m-d'));
        if($this->users->sc_section_id==NULL){
            $this->db->like('training_notify', 'NULL');
        }
        // $this->db->where('sc_region_id', $this->users->sc_region_id);
        // $this->db->where('sc_district_id', $this->users->sc_district_id);
        // $this->db->where('sc_upa_tha_id', $this->users->sc_upa_tha_id);
        // $this->db->where('sc_group_id', $this->users->sc_group_id);
        $this->db->from('training');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        $results_arr=array();

        foreach ($query as  $item) {
            $notify=explode(',', $item->training_notify);
            if(!empty(in_array('All', $notify)) OR !empty(in_array($this->users->sc_section_id, $notify))){
               $results_arr[]=$item; 
            }
        }

        return $results_arr;
    }

    public function get_training_member($id, $scout_id) {
        $this->db->select('*');
        $this->db->from('training_to_scouts');
        $this->db->where('training_id', $id);
        $this->db->where('scout_id', $scout_id);
        $query = $this->db->get()->row();
        return $query;
    }

   /*********************** Events ************************/
    public function get_my_events($id) {
        $this->db->select('es.*, e.event_title, e.event_venu, e.event_type, e.event_start_date');
        $this->db->from('event_to_scouts es');
        $this->db->join('events e', 'e.id=es.event_id');
        $this->db->where('es.scout_id', $id);
        $this->db->where('es.status', 'Approved');
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_events_info($id) {
        $this->db->select('e.id, e.event_title, e.event_venu,e.event_details, e.event_start_date,e.event_end_date,e.event_type,e.event_notify,r.region_name, od.dis_name, ou.upa_name, og.grp_name');
        $this->db->from('events e');
        $this->db->join('office_groups og', 'og.id = e.sc_group_id', 'LEFT');
        $this->db->join('office_upazila ou', 'ou.id = e.sc_upa_tha_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = e.sc_district_id', 'LEFT');
        $this->db->join('office_region r', 'r.id = e.sc_region_id', 'LEFT');
        $this->db->where('e.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function upcomming_event($id) {
       $this->users= $this->ion_auth->user($id)->row();
        $this->db->select('*');
        $this->db->from('events');
        if($this->users->sc_section_id==NULL){
            $this->db->like('event_notify', 'NULL');
        }
        $this->db->where('event_start_date >',date('Y-m-d'));
        // $this->db->where('sc_region_id', $this->users->sc_region_id);
        // $this->db->where('sc_district_id', $this->users->sc_district_id);
        // $this->db->where('sc_upa_tha_id', $this->users->sc_upa_tha_id);
        // $this->db->where('sc_group_id', $this->users->sc_group_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();
        
        $results_arr=array();

        foreach ($query as  $item) {
            $notify=explode(',', $item->event_notify);
            if(!empty(in_array('All', $notify)) OR !empty(in_array($this->users->sc_section_id, $notify))){
               $results_arr[]=$item; 
            }
        }

        return $results_arr;
    }

    public function get_scout_member($id, $scout_id) {
        $this->db->select('*');
        $this->db->from('event_to_scouts');
        $this->db->where('event_id', $id);
        $this->db->where('scout_id', $scout_id);
        $query = $this->db->get()->row();
        return $query;
    }

   public function get_service_info($id){
      $this->db->select('id, service_name');
      $this->db->from('service_list');
      $this->db->where('id', $id);
      $query = $this->db->get()->row();

      return $query;
   }

   /*********************** Award ************************/

   public function get_my_award($id) {
        // result query
        $this->db->select('as.*, sa.award_name');
        $this->db->from('award_to_scouts as');
        $this->db->join('scout_award sa', 'as.award_id=sa.id', 'LEFT');
        $this->db->where('scout_id', $id);

        $query = $this->db->get()->result();

        return $query;
    }
	

   public function search_blood_donate($blood, $div, $dis, $up) {
      $date = date('Y-m-d', strtotime('-90 days'));

        $this->db->select('u.first_name, u.full_name_bn, u.scout_id, u.profile_img, u.phone, ut.up_th_name, ds.district_name,ut.up_th_name_bn, ds.district_name_bn, (YEAR(NOW()) - YEAR(u.dob)) AS age');
        $this->db->from('users u');
        $this->db->where('u.pre_division_id', $div);
        if(!empty($dis)){
           $this->db->where('u.pre_district_id', $dis); 
        }
        if(!empty($up)){
          $this->db->where('u.pre_upa_tha_id', $up); 
        }
        $this->db->where('u.scout_id IS NOT NULL', NULL);
        // $this->db->where('scout_id', 'IS NOT NULL');
        $this->db->where('u.blood_group', $blood);
        $this->db->where('u.blood_donate_interested', 'yes');
        $this->db->where('u.last_donate_date <=', $date);
        $this->db->where('(YEAR(NOW()) - YEAR(u.dob)) >=', 18);
        $this->db->join('upazila_thana ut', 'ut.id=u.pre_upa_tha_id', 'LEFT');
        $this->db->join('district ds', 'ds.id=u.pre_district_id', 'LEFT');
        $this->db->limit(500);
        $query = $this->db->get()->result();        

      return $query;
   }

}
