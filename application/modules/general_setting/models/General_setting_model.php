<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class General_setting_model extends CI_Model {

       public function __construct() {
       parent::__construct();
       }

       public function get_sub_categories($id=null) {
              // result query
              $this->db->select('sc.*, c.category_name');
              $this->db->from('item_sub_categories sc');
              $this->db->join('item_categories c', 'c.id=sc.cate_id');
              if($id){
                     $this->db->where('sc.id', $id);
              }
              $query = $this->db->get()->result();
              return $query;
       }

       public function get_categories($id=null) {
              // result query
              $this->db->select('*');
              $this->db->from('item_categories');
              if($id){
                     $this->db->where('id', $id);
              }
              $query = $this->db->get()->result();
              return $query;
       }

       public function get_item_unit() {
              // result query
              $this->db->select('*');
                     // $this->db->where('is_delete',0);
              $this->db->from('item_unit');
              $query = $this->db->get()->result();
              return $query;
       }

       public function get_designation() {
                     // result query
              $this->db->select('*');
                     // $this->db->where('is_delete',0);
              $this->db->from('designation');
              $query = $this->db->get()->result();

              return $query;
       }

       public function get_department() {
                     // result query
              $this->db->select('*');
                     // $this->db->where('is_delete',0);
              $this->db->from('department');
              $query = $this->db->get()->result();

              return $query;
       }

 public function get_upazila_thana($limit = 1000, $offset = 0, $division=NULL, $district=NULL) {
        // result query
    $this->db->select('ut.id, ut.div_id, ut.dis_id, ut.up_th_name, ut.up_th_name_bn, ut.up_th_geo, ut.status, dv.div_name, ds.district_name');
    $this->db->from('upazila_thana ut');
    $this->db->join('division dv', 'dv.id=ut.div_id');
    $this->db->join('district ds', 'ds.id=ut.dis_id');
    $this->db->where('ut.is_delete', 0);
    if($this->input->get('division') != NULL){
      $this->db->where('ut.div_id', $this->input->get('division'));
   }
   if($this->input->get('district') != NULL){
      $this->db->where('ut.dis_id', $this->input->get('district'));
   }
   $this->db->limit($limit);
   $this->db->offset($offset);
   $this->db->order_by('ut.id', 'DESC');

   $result['rows'] = $this->db->get()->result();

        // count query
   $q = $this->db->select('COUNT(*) as count');
   $this->db->where('is_delete', 0);
   if($this->input->get('division') != NULL){
      $this->db->where('div_id', $this->input->get('division'));
   }
   if($this->input->get('district') != NULL){
      $this->db->where('dis_id', $this->input->get('district'));
   }
   $this->db->from('upazila_thana');

   $tmp = $this->db->get()->result();
   $result['num_rows'] = $tmp[0]->count;

   return $result;

}

public function get_occupation() {
        // result query
 $this->db->select('*');
 $this->db->where('is_delete',0);
 $this->db->from('occupation');
 $query = $this->db->get()->result();

 return $query;
}

public function get_badge_type() {
        // result query
 $this->db->select('*');
 $this->db->where('is_delete',0);
 $this->db->from('badge_type');
 $query = $this->db->get()->result();

 return $query;
}

public function get_role_type() {
        // result query
 $this->db->select('*');
 $this->db->where('is_delete',0);
 $this->db->from('role_type');
 $query = $this->db->get()->result();

 return $query;
}





public function get_committee_type() {
        // result query
 $this->db->select('ct.*, ot.office_type_name');
 $this->db->from('committee_type ct');
 $this->db->join('office_type ot','ot.id = ct.office_type_id','LEFT');
 $this->db->where('ct.status', 1);
 $query = $this->db->get()->result();

 return $query;
}

public function get_committee_designation() {
        // result query
 $this->db->select('cd.*, ot.office_type_name, d.department_name');
 $this->db->from('committee_designation cd');
 $this->db->join('office_type ot','ot.id = cd.office_id','LEFT');
 $this->db->join('department d','d.id = cd.department_id', 'LEFT');
 $this->db->where('cd.is_delete', 0);
 $query = $this->db->get()->result();

 return $query;
}

public function get_scout_badge() {
        // result query
 $this->db->select('sb.*, mt.member_type_name, bt.badge_type_name_bn');
 $this->db->from('scout_badge sb');
 $this->db->join('member_type mt','sb.member_id=mt.id', 'LEFT');
 $this->db->join('badge_type bt','sb.badge_type_id=bt.id', 'LEFT');
 $this->db->where('sb.is_delete',0);
 $this->db->order_by('id', 'DESC');
 $query = $this->db->get()->result();

 return $query;
}


public function get_scout_badge_question() {
        // result query
 $this->db->select('bg.*, bt.badge_type_name_bn');
 $this->db->from('scout_badge_question bg');
        // $this->db->join('scout_badge b', 'bg.badge_id=b.id');
 $this->db->join('badge_type bt','bg.badge_type_id=bt.id', 'LEFT');
 $this->db->where('bg.is_delete', 0);
 $query = $this->db->get()->result();

 return $query;
}

public function scout_expertness_group() {
        // result query
 $this->db->select('bg.*, bt.badge_type_name_bn');
 $this->db->from('scout_expertness_group bg');
        // $this->db->join('scout_badge b', 'bg.badge_id=b.id');
 $this->db->join('badge_type bt','bg.badge_type_id=bt.id', 'LEFT');
 $this->db->where('bg.is_delete',0);
 $query = $this->db->get()->result();

 return $query;
}


    // -----proficiency badge ------
public function proficiency_badge() {
        // result query
 $this->db->select('spb.*, spbg.prof_badge_group_name');
 $this->db->from('scout_prof_badge spb');
 $this->db->join('scout_prof_badge_group spbg','spbg.id=spb.prof_badge_id', 'LEFT');
        // $this->db->join('scout_badge b', 'bg.badge_id=b.id');
 $this->db->where('spb.is_delete',0);
 $query = $this->db->get()->result();

 return $query;
}

// ----- close proficiency badge group------


// -----proficiency badge group------
public function proficiency_badge_group() {
        // result query
 $this->db->select('pbg.*');
 $this->db->from('scout_prof_badge_group pbg');
        // $this->db->join('scout_badge b', 'bg.badge_id=b.id');
        // $this->db->join('badge_type bt','bg.badge_type_id=bt.id', 'LEFT');
 $this->db->where('pbg.is_delete',0);
 $query = $this->db->get()->result();

 return $query;
}

// ----- close proficiency badge group------


// -----Progress Course------
public function progress_course() {
        // result query
 $this->db->select('spc.*');
 $this->db->from('scout_progress_course spc');
        // $this->db->join('scout_badge b', 'bg.badge_id=b.id');
        // $this->db->join('badge_type bt','bg.badge_type_id=bt.id', 'LEFT');
 $this->db->where('spc.is_delete',0);
 $query = $this->db->get()->result();

 return $query;
}

// ----- close proficiency badge group------


public function get_scout_role() {
        // result query
 $this->db->select('sr.*, mt.member_type_name, rt.role_type_name_bn');
 $this->db->from('scout_role sr');
 $this->db->join('member_type mt','sr.member_id=mt.id', 'LEFT');
 $this->db->join('role_type rt', 'sr.role_type_id=rt.id', 'LEFT');
        // $this->db->join('scout_badge b', 'sr.sc_badge_id=b.id', 'LEFT'); b.badge_name_bn,
 $this->db->where('sr.is_delete',0);
 $this->db->order_by('id', 'DESC');
 $query = $this->db->get()->result();

 return $query;
}

public function get_post_office() {
        // result query
 $this->db->select('p.id, p.dis_id, p.po_name, p.code, p.status, ds.district_name');
 $this->db->from('post_office p');
 $this->db->join('district ds', 'ds.id=p.dis_id');

 $query = $this->db->get()->result();

 return $query;
}

public function get_district($limit = 1000, $offset = 0, $division=NULL) {
        // result query
  $this->db->select('di.id, di.div_id, di.district_name, di.district_name_bn, di.district_geo, di.status, dv.div_name');
  $this->db->from('district di');
  $this->db->join('division dv', 'dv.id=di.div_id');
  $this->db->where('di.is_delete', 0);
  if($this->input->get('division') != NULL){
   $this->db->where('di.div_id', $this->input->get('division'));
}
$this->db->limit($limit);
$this->db->offset($offset);
$this->db->order_by('di.id', 'DESC');

$result['rows'] = $this->db->get()->result();

        // count query
$q = $this->db->select('COUNT(*) as count');
$this->db->where('is_delete', 0);
if($this->input->get('division') != NULL){
   $this->db->where('div_id', $this->input->get('division'));
}
$this->db->from('district');

$tmp = $this->db->get()->result();
$result['num_rows'] = $tmp[0]->count;

return $result;

}

public function get_division() {
        // result query
 $this->db->select('di.id, di.div_name, di.div_name_bn, di.status, di.div_geo');
 $this->db->from('division di');
 $this->db->where('di.is_delete', 0);
 $query = $this->db->get()->result();

 return $query;
}


public function get_proficiency_badge_group_by_id($id=NULL){
      // $field= $this->session->userdata('site_lang')=='bangla'?'district_name_bn':'district_name';
   $data['0'] ='-Select One- ';
   $this->db->select("id, prof_badge_group_name");
   $this->db->from('scout_prof_badge_group');
   if($id != NULL){
      $this->db->where('section_id', $id);
   }
   $this->db->order_by('id', 'ASC');
   $query = $this->db->get();

   foreach ($query->result_array() AS $rows) {
      $data[$rows['id']] = $rows['prof_badge_group_name'];
   }
   return $data;
}


public function get_institute($limit = 1000, $offset = 0) {
        // result query
 $this->db->select('in.name, in.division, in.district, in.upazila, in.institute_type, el.edu_level_name');
 $this->db->from('institute in');
 $this->db->join('education_level el', 'el.id = in.education_level', 'left');
 $this->db->limit($limit);
 $this->db->offset($offset);
 $this->db->order_by('in.id', 'DESC');
        // $query = $this->db->get();
        // echo $this->db->last_query(); exit;
 $result['rows'] = $this->db->get()->result();

        // count query
 $q = $this->db->select('COUNT(*) as count');
 $this->db->from('institute');

 $tmp = $this->db->get()->result();
 $result['num_rows'] = $tmp[0]->count;

 return $result;
}

public function get_info($table,$id) {
 $query = $this->db->from($table)
 ->where('id', $id)
 ->get()->row();
 return $query;
}

function delete($id) {

 $info = $this->get_info($id);

        // if(file_exists($img_path.$info->image_file)){
        //    @unlink($img_path.$info->image_file);
        //    @unlink($img_path_thumbs.$info->image_file);
        // }

 $this->db->where('id', $id);
 $this->db->delete('');

 return TRUE;
}

}
