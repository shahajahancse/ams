<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model {

  public function __construct() {
    parent::__construct();
  }
  public function get_items(){
    $this->db->select('i.*, c.category_name, u.unit_name, s.balance, units.name_en');
    $this->db->from('items i');
    $this->db->join('item_stocks s', 's.item_id=i.id', 'LEFT');
    $this->db->join('item_categories c', 'c.id=i.cat_id', 'LEFT');
    $this->db->join('item_unit u', 'u.id=i.unit_id', 'LEFT');
    $this->db->join('units', 'units.id=s.unit_id', 'LEFT');
    if(!empty($this->input->post('unit_id'))){
      $this->db->where('s.unit_id', $this->input->post('unit_id'));
    }
    $this->db->order_by('s.unit_id', 'ASC');
    $this->db->order_by('i.id', 'ASC');
    $query = $this->db->get()->result();
    return $query;
  }
  public function get_low_inventory_items(){
    $this->db->select('i.*, c.category_name, u.unit_name, s.balance, s.order_level, units.name_en');
    $this->db->from('items i');
    $this->db->join('item_stocks s', 's.item_id=i.id', 'LEFT');
    $this->db->join('item_categories c', 'c.id=i.cat_id', 'LEFT');
    $this->db->join('item_unit u', 'u.id=i.unit_id', 'LEFT');
    $this->db->join('units', 'units.id=s.unit_id', 'LEFT');
    if(!empty($this->input->post('unit_id'))){
      $this->db->where('s.unit_id', $this->input->post('unit_id'));
    }
    $this->db->order_by('s.unit_id', 'ASC');
    $this->db->order_by('i.id', 'ASC');
    $this->db->where('s.balance <= s.order_level');
    $query = $this->db->get()->result();
    return $query;
  }

  public function get_requisition($status = array()){
    $data = array();
    $this->db->select('r.*, u.first_name, dp.dept_name, dg.desig_name');
    $this->db->from('item_requisitions r');
    $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
    $this->db->join('department dp', 'dp.id = u.dept_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id = u.desig_id', 'LEFT');
    if(!empty($status)){
      $this->db->where_in('r.status', $status);
    }
    if(!empty($this->input->post('unit_id'))){
      $this->db->where('r.unit_id', $this->input->post('unit_id'));
    }
    if(!empty($this->input->post('user_id'))){
      $this->db->where('r.user_id', $this->input->post('user_id'));
    }
    if(!empty($this->input->post('fiscal_year'))){
      $this->db->where('r.f_year_id', $this->input->post('fiscal_year'));
    }
    if(!empty($this->input->post('from_date')) && !empty($this->input->post('to_date'))){
      $from = $this->input->post('from_date');
      $to = $this->input->post('to_date');
      $this->db->where('DATE(r.created_at) BETWEEN "'. $from. '" AND "'. $to.'"');
    }
    $data['summary'] = $this->db->get()->result();

    foreach($data['summary'] as $key => $value)
    {
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name');
      $this->db->from('item_requisition_details ri');
      $this->db->join('items i', 'i.id = ri.item_id', 'LEFT');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
      $this->db->join('item_categories c', 'c.id = i.cat_id', 'LEFT');
      $this->db->where('ri.requisition_id', $value->id);
      $data['details'][$key] = $this->db->get()->result();
    }
    return $data;
  }

  public function get_purchase($status = array()){
    $data = array();

    $this->db->select('r.*, u.first_name, dp.dept_name, dg.desig_name');
    $this->db->from('item_purchases r');
    $this->db->join('users u', 'u.id = r.created_by', 'LEFT');
    $this->db->join('department dp', 'dp.id = u.dept_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id = u.desig_id', 'LEFT');
    if(!empty($status)){
      $this->db->where_in('r.status', $status);
    }
    if(!empty($this->input->post('unit_id'))){
      $this->db->where('r.unit_id', $this->input->post('unit_id'));
    }
    if(!empty($this->input->post('user_id'))){
      $this->db->where('r.created_by', $this->input->post('user_id'));
    }
    if(!empty($this->input->post('fiscal_year'))){
      $this->db->where('r.f_year_id', $this->input->post('fiscal_year'));
    }
    if(!empty($this->input->post('from_date')) && !empty($this->input->post('to_date'))){
      $from = $this->input->post('from_date');
      $to = $this->input->post('to_date');
      $this->db->where('DATE(r.created_at) BETWEEN "'. $from. '" AND "'. $to.'"');
    }
    $data['summary'] = $this->db->get()->result();

    foreach($data['summary'] as $key=>$value)
    {
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name');
      $this->db->from('	item_purchase_details ri');
      $this->db->join('items i', 'i.id = ri.pur_item_id', 'LEFT');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
      $this->db->join('item_categories c', 'c.id = i.cat_id', 'LEFT');
      $this->db->where('ri.purchase_id', $value->id);
      $data['details'][$key] = $this->db->get()->result();
    }
    return $data;
  }

  public function get_user_report($status = array()){
    $data = array();
    $this->db->select('r.*, u.first_name, dp.dept_name, dg.desig_name');
    $this->db->from('item_requisitions r');
    $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
    $this->db->join('department dp', 'dp.id = u.dept_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id = u.desig_id', 'LEFT');
    if(!empty($status)){
      $this->db->where_in('r.status', $status);
    }
    if(!empty($this->input->post('unit_id'))){
      $this->db->where('r.unit_id', $this->input->post('unit_id'));
    }
    if(!empty($this->input->post('user_id'))){
      $this->db->where('r.user_id', $this->input->post('user_id'));
    }
    if(!empty($this->input->post('fiscal_year'))){
      $this->db->where('r.f_year_id', $this->input->post('fiscal_year'));
    }
    if(!empty($this->input->post('from_date')) && !empty($this->input->post('to_date'))){
      $from = $this->input->post('from_date');
      $to = $this->input->post('to_date');
      $this->db->where('DATE(r.created_at) BETWEEN "'. $from. '" AND "'. $to.'"');
    }
    $data['summary'] = $this->db->get()->result();

    foreach($data['summary'] as $key=>$value)
    {
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name');
      $this->db->from('item_requisition_details ri');
      $this->db->join('items i', 'i.id = ri.item_id', 'LEFT');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
      $this->db->join('item_categories c', 'c.id = i.cat_id', 'LEFT');
      $this->db->where('ri.requisition_id', $value->id);
      $data['details'][$key] = $this->db->get()->result();
    }
    return $data;
  }


















  public function get_item_report($status = array(), $product_id){
    $data = array();
    $this->db->select('r.*, u.first_name, dp.dept_name, dg.desig_name');
    $this->db->from('item_requisition_details rd');
    $this->db->join('item_requisitions r', 'r.id = rd.requisition_id', 'LEFT');
    $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
    $this->db->join('department dp', 'dp.id = u.dept_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id = u.desig_id', 'LEFT');
    $this->db->where('rd.item_id', $product_id);
    if(!empty($status)){
      $this->db->where_in('r.status', $status);
    }
    if(!empty($this->input->post('unit_id'))){
      $this->db->where('r.unit_id', $this->input->post('unit_id'));
    }
    if(!empty($this->input->post('user_id'))){
      $this->db->where('r.user_id', $this->input->post('user_id'));
    }
    if(!empty($this->input->post('fiscal_year'))){
      $this->db->where('r.f_year_id', $this->input->post('fiscal_year'));
    }
    if(!empty($this->input->post('from_date')) && !empty($this->input->post('to_date'))){
      $from = $this->input->post('from_date');
      $to = $this->input->post('to_date');
      $this->db->where('DATE(r.created_at) BETWEEN "'. $from. '" AND "'. $to.'"');
    }
    $data['summary'] = $this->db->get()->result();

    foreach($data['summary'] as $key=>$value)
    {
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name');
      $this->db->from('item_requisition_details ri');
      $this->db->join('items i', 'i.id = ri.item_id', 'LEFT');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
      $this->db->join('item_categories c', 'c.id = i.cat_id', 'LEFT');
      $this->db->where('ri.requisition_id', $value->id);
      $this->db->where('ri.item_id', $product_id);
      $data['details'][$key] = $this->db->get()->result();
    }
    return $data;
  }

  public function get_purchase_request($status = array(), $product_id){
    $data = array();
    $this->db->select('r.*, u.first_name, dp.dept_name, dg.desig_name');
    $this->db->from('item_purchase_details rd');
    $this->db->join('item_purchases r', 'r.id = rd.purchase_id', 'LEFT');
    $this->db->join('users u', 'u.id = r.created_by', 'LEFT');
    $this->db->join('department dp', 'dp.id = u.dept_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id = u.desig_id', 'LEFT');
    $this->db->where('rd.pur_item_id', $product_id);

    if(!empty($status)){
      $this->db->where_in('r.status', $status);
    }
    if(!empty($this->input->post('unit_id'))){
      $this->db->where('r.unit_id', $this->input->post('unit_id'));
    }
    if(!empty($this->input->post('user_id'))){
      $this->db->where('r.created_by', $this->input->post('user_id'));
    }
    if(!empty($this->input->post('fiscal_year'))){
      $this->db->where('r.f_year_id', $this->input->post('fiscal_year'));
    }
    if(!empty($this->input->post('from_date')) && !empty($this->input->post('to_date'))){
      $from = $this->input->post('from_date');
      $to = $this->input->post('to_date');
      $this->db->where('DATE(r.created_at) BETWEEN "'. $from. '" AND "'. $to.'"');
    }
    $data['summary'] = $this->db->get()->result();

    foreach($data['summary'] as $key=>$value)
    {
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name');
      $this->db->from('item_purchase_details ri');
      $this->db->join('items i', 'i.id = ri.pur_item_id', 'LEFT');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
      $this->db->join('item_categories c', 'c.id = i.cat_id', 'LEFT');
      $this->db->where('ri.purchase_id', $value->id);
      $this->db->where('ri.pur_item_id', $product_id);
      $data['details'][$key] = $this->db->get()->result();
    }
    return $data;
  }






  public function get_requisition_delivered(array $inputs){
    $data = array();

    $this->db->select('r.*, u.first_name, dp.dept_name, dg.desig_name');
    $this->db->from('item_requisitions r');
    $this->db->join('users u', 'u.id = r.user_id', 'LEFT');
    $this->db->join('department dp', 'dp.id = u.dept_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id = u.desig_id', 'LEFT');
    $this->db->where('r.is_delivered', 1);

    if($inputs['user_id'] && $inputs['user_id'] != ''){
      $this->db->where('r.user_id', $inputs['user_id']);
    }

    if($inputs['fiscal_year'] && $inputs['fiscal_year'] != ''){
      $this->db->where('r.f_year_id', $inputs['fiscal_year']);
    }

    if($inputs['start_date'] && $inputs['end_date']){
      $this->db->where('DATE(r.created) BETWEEN "'. $inputs['start_date']. '" AND "'. $inputs['end_date'].'"');
    }
    $data['summary'] = $this->db->get()->result();

    foreach($data['summary'] as $key=>$value)
    {
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name');
      $this->db->from('item_requisition_details ri');
      $this->db->join('items i', 'i.id = ri.item_id', 'LEFT');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id', 'LEFT');
      $this->db->join('categories c', 'c.id = i.cat_id', 'LEFT');
      $this->db->where('ri.requisition_id', $value->id);
      $data['details'][$key] = $this->db->get()->result();
    }

    return $data;
  }

  public function get_smr_upazila($startDate=NULL, $endDate=NULL) {
    $sql = "SELECT `sc_upa_tha_id` AS upazila_id , `count_member` AS total_member, `count_group` AS total_sc_group, `upa_name_en` FROM (
    SELECT * FROM (SELECT `sc_upa_tha_id`, COUNT(scout_id) AS count_member FROM `users` WHERE `scout_id` IS NOT NULL AND DATE(FROM_UNIXTIME(created_on)) >= '$startDate' AND DATE(FROM_UNIXTIME(created_on)) <= '$endDate' GROUP BY `sc_upa_tha_id`) as user_count_tbl
    INNER JOIN (SELECT `grp_scout_upa_id`, COUNT(id) AS count_group FROM `office_groups` GROUP BY `grp_scout_upa_id`) AS group_count_tbl ON user_count_tbl.sc_upa_tha_id=group_count_tbl.grp_scout_upa_id ) as new_tbl
    INNER JOIN office_upazila as sou ON sou.id = new_tbl.sc_upa_tha_id ORDER BY total_member DESC";

    $query = $this->db->query($sql)->result();

      // count query
      // $this->db->select('sc_region_id, sc_group_id, COUNT(scout_id) as count, FROM_UNIXTIME(created_on) AS created');
      // $this->db->where('scout_id IS NOT NULL', NULL);
      // $this->db->where('member_id !=', 0);,
      // $this->db->where('status', 1);
      // $this->db->where('gender != ', NULL);
      // if($startDate){
      //    $this->db->where('DATE(FROM_UNIXTIME(created_on)) >=', $startDate);
      // }
      // if($endDate){
      //    $this->db->where('DATE(FROM_UNIXTIME(created_on)) <=', $endDate);
      // }
      // if($region_id != NULL){
      //    $this->db->where('sc_region_id', $region_id);
      // }
      // if($sc_district_id != NULL){
      //    $this->db->where('sc_district_id', $sc_district_id);
      // }
      // if($sc_upa_tha_id != NULL){
      //    $this->db->where('sc_upa_tha_id', $sc_upa_tha_id);
      // }
      // if($sc_group_id != NULL){
      //    $this->db->where('sc_group_id', $sc_group_id);
      // }
      // $this->db->group_by('sc_region_id');
      // $q = $this->db->get('users')->result();


      // $tmp = $q;
      // $ret['count'] = $tmp[0]->count;
      // echo $this->db->last_query(); exit;
    return $query;
  }

  public function get_smr_district($startDate, $endDate, $disType=NULL) {
    if($disType != NULL){
     $where = 'WHERE dis_type = '.$disType;
   }else{
     $where = 'WHERE 1';
   }
   $sql = "SELECT `sc_district_id` AS district_id , `count_member` AS total_member, `count_group` AS total_sc_group, `dis_name_en`, `dis_type` FROM (
   SELECT * FROM (SELECT `sc_district_id`, COUNT(scout_id) AS count_member FROM `users` WHERE `scout_id` IS NOT NULL AND DATE(FROM_UNIXTIME(created_on)) >= '$startDate' AND DATE(FROM_UNIXTIME(created_on)) <= '$endDate' GROUP BY `sc_district_id`) as user_count_tbl
   INNER JOIN (SELECT `grp_scout_dis_id`, COUNT(id) AS count_group FROM `office_groups` GROUP BY `grp_scout_dis_id`) AS group_count_tbl ON user_count_tbl.sc_district_id=group_count_tbl.grp_scout_dis_id ) as new_tbl
   INNER JOIN office_district as sod ON sod.id = new_tbl.sc_district_id $where ORDER BY total_member DESC";

   $query = $this->db->query($sql)->result();

      // echo $this->db->last_query(); exit;
   return $query;
 }

 public function get_smr_region($startDate=NULL, $endDate=NULL) {

  $sql = "SELECT `sc_region_id` AS region_id , `count_member` AS total_member, `count_group` AS total_sc_group, `region_name_en` FROM (
  SELECT * FROM (SELECT `sc_region_id`, COUNT(scout_id) AS count_member FROM `users` WHERE `scout_id` IS NOT NULL AND DATE(FROM_UNIXTIME(created_on)) >= '$startDate' AND DATE(FROM_UNIXTIME(created_on)) <= '$endDate' GROUP BY `sc_region_id`) as user_count_tbl
  INNER JOIN (SELECT `grp_region_id`, COUNT(id) AS count_group FROM `office_groups` GROUP BY `grp_region_id`) AS group_count_tbl ON user_count_tbl.sc_region_id=group_count_tbl.grp_region_id ) as new_tbl
  INNER JOIN office_region as sor ON sor.id = new_tbl.sc_region_id ORDER BY total_member DESC";

      // $sql = "SELECT `sc_region_id` AS region_id , `count_member` AS total_member, `region_name_en` FROM ( SELECT `sc_region_id`, COUNT(scout_id) AS count_member FROM `users` WHERE `scout_id` IS NOT NULL AND DATE(FROM_UNIXTIME(created_on)) >= '$startDate' AND DATE(FROM_UNIXTIME(created_on)) <= '$endDate' GROUP BY `sc_region_id`) as user_count_tbl
      // INNER JOIN office_region as sor ON sor.id = user_count_tbl.sc_region_id ORDER BY total_member DESC";

  $query = $this->db->query($sql)->result();

  return $query;
}

public function get_scout_member($limit=1000, $offset=0) {
 $this->db->select('id, scout_id, first_name,  phone, email, active, profile_img');
 $this->db->from('users ');

  if($this->input->get('region') != NULL){
    $this->db->where('sc_region_id', $this->input->get('region'));
  }
  if($this->input->get('district') > '0'){
    $this->db->where('sc_district_id', $this->input->get('district'));
  }
  if($this->input->get('upazila') > '0'){
    $this->db->where('sc_upa_tha_id', $this->input->get('upazila'));
  }
  if($this->input->get('group') > '0'){
    $this->db->where('sc_group_id', $this->input->get('group'));
  }

  $this->db->limit($limit);
  $this->db->offset($offset);

  $result['rows'] = $this->db->get()->result();
          // count query
  $this->db->select('COUNT(*) as count');
  $this->db->from('users');
  if($this->input->get('region') != NULL){
    $this->db->where('sc_region_id', $this->input->get('region'));
  }
  if($this->input->get('district') > '0'){
    $this->db->where('sc_district_id', $this->input->get('district'));
  }
  if($this->input->get('upazila') > '0'){
    $this->db->where('sc_upa_tha_id', $this->input->get('upazila'));
  }
  if($this->input->get('group') > '0'){
    $this->db->where('sc_group_id', $this->input->get('group'));
  }

  $tmp = $this->db->get()->result();
  $result['num_rows'] = $tmp[0]->count;

  return $result;
}

public function get_scout_member_pdf() {
  $this->db->select('id, scout_id, first_name,  phone, email, active, profile_img');
  $this->db->from('users ');

  if($this->input->get('region') != NULL){
   $this->db->where('sc_region_id', $this->input->get('region'));
 }
 if($this->input->get('district') > '0'){
   $this->db->where('sc_district_id', $this->input->get('district'));
 }
 if($this->input->get('upazila') > '0'){
   $this->db->where('sc_upa_tha_id', $this->input->get('upazila'));
 }
 if($this->input->get('group') > '0'){
   $this->db->where('sc_group_id', $this->input->get('group'));
 }

 $result['rows'] = $this->db->get()->result();

 return $result;
}

public function get_region() {
        // result query
  $this->db->select('r.*, d.div_name');
  $this->db->from('office_region r');
  $this->db->join('division d', 'd.id=r.region_div_id', 'LEFT');
  $query = $this->db->get()->result();

  return $query;
}
public function get_scout_district($region_id=NULL) {
        // result query
  $this->db->select('od.*, d.div_name, ds.district_name, r.region_name');
  $this->db->from('office_district od');
  $this->db->join('division d', 'd.id = od.dis_div_id', 'LEFT');
  $this->db->join('district ds', 'ds.id = od.dis_dis_id', 'LEFT');
  $this->db->join('office_region r', 'r.id = od.dis_scout_region_id', 'LEFT');

  if($this->input->get('region') != NULL){
   $this->db->where('od.dis_scout_region_id', $this->input->get('region'));
 }

 $query = $this->db->get()->result();
 return $query;
}
public function get_scout_upazila() {
        // result query
  $this->db->select('ou.*, r.region_name, od.dis_name');
  $this->db->from('office_upazila ou');
  $this->db->join('office_region r', 'r.id = ou.upa_region_id', 'LEFT');
        $this->db->join('office_district od', 'od.id = ou.upa_scout_dis_id', 'LEFT');       //4-10-17

        if($this->input->get('region') != NULL){
         $this->db->where('ou.upa_region_id', $this->input->get('region'));
       }
       if($this->input->get('district') > '0'){
         $this->db->where('ou.upa_scout_dis_id', $this->input->get('district'));
       }
       $query = $this->db->get()->result();
       return $query;
     }
     public function get_scout_group() {
        // result query
       $this->db->select('og.*, r.region_name, od.dis_name, ou.upa_name');
       $this->db->from('office_groups og');
       $this->db->join('office_region r', 'r.id = og.grp_region_id', 'LEFT');
       $this->db->join('office_district od', 'od.id = og.grp_scout_dis_id', 'LEFT');
       $this->db->join('office_upazila ou', 'ou.id = og.grp_scout_upa_id', 'LEFT');

       if($this->input->get('region') != NULL){
        $this->db->where('og.grp_region_id', $this->input->get('region'));
      }
      if($this->input->get('district') > '0'){
        $this->db->where('og.grp_scout_dis_id', $this->input->get('district'));
      }
      if($this->input->get('upazila') > '0'){
        $this->db->where('og.grp_scout_upa_id', $this->input->get('upazila'));
      }


      $query = $this->db->get()->result();
      return $query;
    }

    public function get_scout_unit( ) {
        // result query
      $this->db->select('u.*, r.region_name, od.dis_name, ou.upa_name, og.grp_name');
      $this->db->from('office_unit u');
      $this->db->join('office_groups og', 'og.id = u.unit_sc_grp_id', 'LEFT');
      $this->db->join('office_upazila ou', 'ou.id = u.unit_scout_upa_id', 'LEFT');
      $this->db->join('office_district od', 'od.id = u.unit_scout_dis_id', 'LEFT');
      $this->db->join('office_region r', 'r.id = u.unit_region_id', 'LEFT');
      if($this->input->get('region') != NULL){
       $this->db->where('u.unit_region_id', $this->input->get('region'));
     }
     if($this->input->get('district') > '0'){
       $this->db->where('u.unit_scout_dis_id', $this->input->get('district'));
     }
     if($this->input->get('upazila') > '0'){
       $this->db->where('u.unit_scout_upa_id', $this->input->get('upazila'));
     }
     if($this->input->get('group') > '0'){
       $this->db->where('u.unit_sc_grp_id', $this->input->get('group'));
     }
     $query = $this->db->get()->result();
     return $query;
   }
   public function get_national_committee() {
        // result query
    $this->db->select('cn.*');
    $this->db->from('committee_exe_national cn');
       // $this->db->join('committee_session cs', 'cs.id=cn.comm_session_id', 'LEFT');
    $this->db->order_by('cn.id', 'DESC');
    $query = $this->db->get()->result();

    return $query;
  }
  public function get_region_committee() {
        // result query
    $this->db->select('cr.*,or.region_name');
    $this->db->from('committee_exe_region cr');
        //$this->db->join('committee_session cs', 'cs.id = cr.comm_session_id', 'LEFT');
    $this->db->join('office_region or', 'or.id = cr.office_region_id', 'LEFT');
    $this->db->order_by('cr.id', 'DESC');
    $query = $this->db->get()->result();

    return $query;
  }
  public function get_district_committee($region_id=NULL) {
        // result query
    $this->db->select('cd.*,  or.region_name, od.dis_name');
    $this->db->from('committee_exe_district cd');
        //$this->db->join('committee_session cs', 'cs.id = cd.comm_session_id', 'LEFT');
    $this->db->join('office_district od', 'od.id = cd.office_district_id', 'LEFT');
    $this->db->join('office_region or', 'or.id = cd.office_region_id', 'LEFT');
    $this->db->order_by('cd.id', 'DESC');

    if($region_id){
     $this->db->where('cd.office_region_id', $region_id);
     $query = $this->db->get()->result();
   }else{
     $query = $this->db->get()->result();
   }

   return $query;
 }
 public function get_upazila_thana_committee($region_id=NULL, $sc_district_id=NULL) {
        // result query
  $this->db->select('cu.*,  or.region_name, od.dis_name, ou.upa_name');
  $this->db->from('committee_exe_upazila cu');
        //$this->db->join('committee_session cs', 'cs.id = cu.comm_session_id', 'LEFT');
  $this->db->join('office_upazila ou', 'ou.id = cu.office_region_id', 'LEFT');
  $this->db->join('office_district od', 'od.id = cu.office_district_id', 'LEFT');
  $this->db->join('office_region or', 'or.id = cu.office_region_id', 'LEFT');
  $this->db->order_by('cu.id', 'DESC');

  if($region_id){
   $this->db->where('cu.office_region_id', $region_id);
   $query = $this->db->get()->result();
            // echo $this->db->last_query(); exit;
 }elseif($sc_district_id){
   $this->db->where('cu.office_district_id', $sc_district_id);
   $query = $this->db->get()->result();
 }else{
   $query = $this->db->get()->result();
 }
 return $query;
}
public function get_scout_group_committee($region_id=NULL, $sc_district_id=NULL, $sc_upa_tha_id=NULL) {
        // result query
  $this->db->select('csg.*, or.region_name, od.dis_name, ou.upa_name, og.grp_name');
  $this->db->from('committee_exe_scout_group csg');
  $this->db->join('office_groups og', 'og.id = csg.office_sc_group_id', 'LEFT');
  $this->db->join('office_upazila ou', 'ou.id = csg.office_upa_tha_id', 'LEFT');
  $this->db->join('office_district od', 'od.id = csg.office_district_id', 'LEFT');
  $this->db->join('office_region or', 'or.id = csg.office_region_id', 'LEFT');
  $this->db->order_by('csg.id', 'DESC');

  if($region_id){
   $this->db->where('csg.office_region_id', $region_id);
   $query = $this->db->get()->result();
 }elseif($sc_district_id){
   $this->db->where('csg.office_district_id', $sc_district_id);
   $query = $this->db->get()->result();
 }elseif($sc_upa_tha_id){
   $this->db->where('csg.office_upa_tha_id', $sc_upa_tha_id);
   $query = $this->db->get()->result();
            // echo $this->db->last_query(); exit;
 }else{
   $query = $this->db->get()->result();
        }//echo '<pre>'; print_r($query);die();
        return $query;
}

      public function get_current_region_from_committee($user_id=null) {
        // result query
        $this->db->select('mr.committee_id, er.office_region_id, er.is_current');
        $this->db->from('committee_member_region mr');
        $this->db->join('committee_exe_region er', 'er.id = mr.committee_id', 'LEFT');
        $this->db->where('mr.member_scout_id', $user_id);
        $this->db->order_by('mr.committee_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        return $query;
      }

      public function get_current_district_from_committee($user_id=null) {
        // result query
        $this->db->select('md.committee_id, ed.office_region_id, ed.office_district_id, ed.is_current');
        $this->db->from('committee_member_district md');
        $this->db->join('committee_exe_district ed', 'ed.id = md.committee_id', 'LEFT');
        $this->db->where('md.member_scout_id', $user_id);
        $this->db->order_by('md.committee_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        return $query;
      }
      public function get_current_upazila_thana_from_committee($user_id=null) {
        // result query
        $this->db->select('mu.committee_id, eu.office_region_id, eu.office_district_id, eu.office_upa_tha_id, eu.is_current');
        $this->db->from('committee_member_upazila mu');
        $this->db->join('committee_exe_upazila eu', 'eu.id = mu.committee_id', 'LEFT');
        $this->db->where('mu.member_scout_id', $user_id);
        $this->db->order_by('mu.committee_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->row();
        // echo $this->db->last_query(); exit;
        return $query;
      }
      public function get_data_for_traing() {
        $this->db->select('*');
        $this->db->from('training');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
      }
      public function get_data_for_event() {
        $this->db->select('*');
        $this->db->from('events');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();

        return $query;
      }
      public function get_members_count_by_sc_section_id($sc_section_id,$gender) {
        // count query
        $this->db->select('COUNT(*) as count,gender');
        $this->db->from('users');
       // $this->db->group_by('gender');
        $this->db->where('sc_section_id',$sc_section_id);
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

      public function get_members_count_by_sc_section_id_and_sc_role_id($sc_section_id,$gender,$sc_role_id) {
        // count query
        $this->db->select('COUNT(*) as count,gender');
        $this->db->from('users');
       // $this->db->group_by('gender');
        $this->db->where('sc_section_id',$sc_section_id);
        $this->db->where('gender',$gender);
        $this->db->where('sc_role_id',$sc_role_id);
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
      public function get_members_count_groupby_sc_badge_id($sc_section_id) {
        // count query
        $this->db->select('COUNT(CASE WHEN u.gender="Male" THEN u.id END ) as count_male, COUNT(CASE WHEN u.gender="Female" THEN u.id END) as count_female, COUNT(CASE WHEN u.gender="Others" THEN u.id END) as count_other,COUNT(u.id) as count_total, bt.badge_type_name_bn');
        $this->db->from('users u');
        $this->db->join('scout_badge sb', 'u.sc_badge_id =sb.id', 'LEFT');
        $this->db->join('badge_type bt', 'sb.badge_type_id = bt.id', 'LEFT');

        $this->db->where('u.sc_section_id',$sc_section_id);
        //$this->db->where('sb.section_id',$sc_section_id);
        $this->db->group_by('u.sc_badge_id');
        //$this->db->group_by('u.gender');
        //$this->db->where('gender',$gender);
        //$this->db->where('sc_role_id',$sc_role_id);
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
       public function get_unit_count_groupby_unit_type() {
        // count query
        $this->db->select('COUNT(u.id) as count_total, u.unit_type');
        $this->db->from('office_unit u');
        $this->db->group_by('u.unit_type');
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
        /* echo '<pre>';
         print_r($result);
         exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

         return $result;
       }
       public function get_unit_count_year_wise_groupby_unit_type() {
        // count query
        $this->db->select('COUNT(CASE WHEN YEAR(u.unit_created)=date("Y") THEN u.id END ) as count_now,COUNT(CASE WHEN YEAR(u.unit_created)="2016" THEN u.id END ) as count_prev, u.unit_type');
        $this->db->from('office_unit u');
        $this->db->group_by('u.unit_type');
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
        /* echo '<pre>';
         print_r($result);
         exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

         return $result;
       }
       public function get_member_count_year_wise_groupby_sc_section_id($sc_section_id) {
        // count query
        $this->db->select('
         COUNT(CASE WHEN YEAR(u.join_date)=date("Y") THEN u.id END ) as count_now,
         COUNT(CASE WHEN YEAR(u.join_date)="2016" THEN u.id END ) as count_prev,
         bt.badge_type_name_bn');
        $this->db->from('users u');
        $this->db->join('scout_badge sb', 'u.sc_badge_id =sb.id', 'LEFT');
        $this->db->join('badge_type bt', 'sb.badge_type_id = bt.id', 'LEFT');
        $this->db->where('u.sc_section_id',$sc_section_id);
        //$this->db->where('sb.section_id',$sc_section_id);
        $this->db->group_by('u.sc_badge_id');
        $q = $this->db->get()->result();

        $result = array();
        $result = $q;
      /* echo '<pre>';
         print_r($result);
         exit;*/
     //  $result['gender'] = $result['gender'];
        //$result['count'] = $result[0]->count;

         return $result;
       }

     }
