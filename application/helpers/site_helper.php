<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('date_db_format')) {
   function date_db_format($item) {  
      if($item != NULL){
         return date('Y-m-d', strtotime($item));
      }else{
         return '0000-00-00';
      }      
   }
}

if (!function_exists('date_bangla_format')) {
   function date_bangla_format($item) {  
      if($item == NULL){
         return '';
      }elseif($item != '0000-00-00'){
         return date('d-m-Y', strtotime($item));
      }else{
         return '';
      }
   }
}

if (!function_exists('date_browse_format')) {
   function date_browse_format($item) {      
      if($item != '0000-00-00'){
         return date('d-m-Y', strtotime($item));
      }else{
         return '';
      }
   }
}

if (!function_exists('date_detail_format')) {
   function date_detail_format($item) {   
      if($item != '0000-00-00'){
         return date('d F, Y', strtotime($item));
      }else{
         return '';
      }         
   }
}

if (!function_exists('date_sort_form')) {
   function date_sort_form($item) {   
      if($item != '0000-00-00'){
         return date('d M, Y', strtotime($item));
      }else{
         return '';
      }         
   }
}

if (!function_exists('get_scout_section')) {
   function get_scout_section($type) {
      if($type == 1){
         $data = "Cub Scout";
      }else if($type == 2){
         $data = "Scout";
      }else if($type == 3){
         $data = "Rover Scout";
      }else if($type == 4){
         $data = "Not Applicable";      
      }else{
         $data = "";
      }
      return $data;
   }
}

if (!function_exists('get_scout_progress')) {
   function get_scout_progress($type) {
      if($type == 1){
         $data = "Cub Progress";
      }else if($type == 2){
         $data = "Scout Progress";
      }else if($type == 3){
         $data = "Rover Scout Progress";
      }else if($type == 4){
         $data = "Adult Leader Progress";      
      }else{
         $data = "";
      }
      return $data;
   }
}

if (!function_exists('get_religion')) {
   function get_religion($type) {
      if($type == 1){
         $data = "Islam";
      }else if($type == 2){
         $data = "Hinduism";
      }else if($type == 3){
         $data = "Chrishtianity";
      }else if($type == 4){
         $data = "Buddhism";
      }else if($type == 5){
         $data = "Sikhism";
      }else if($type == 6){
         $data = "Jainism";
      }else if($type == 7){
         $data = "Judaism";
      }else{
         $data = "";
      }
      return $data;
   }
}

if (!function_exists('func_region_type')) {
   function func_region_type($item) {
      if($item == 'divisional'){
         $data = "Divisional Region";
      }elseif($item == 'special'){
         $data = "Special Region";  
      }else{
         $data = "";
      }
      return $data;
   }
}

if (!function_exists('get_scout_unit_type')) {
   function get_scout_unit_type($type) {
      if($type == 1){
         $data = "কাব দল";
      }elseif($type == 2){
         $data = "স্কাউট দল";
      }elseif($type == 3){
         $data = "রোভার স্কাউট দল";
      }else if($type == 4){
         $data = "গার্ল-ইন কাব";
      }else if($type == 5){
         $data = "গার্ল-ইন স্কাউট";
      }else if($type == 6){
         $data = "গার্ল-ইন রোভার স্কাউট";      
      }else{
         $data = "";
      }
      return $data;
   }
}
if (!function_exists('get_scout_unit_type_en')) {
   function get_scout_unit_type_en($type) {
      if($type == 1){
         $data = "Cub teams";
      }elseif($type == 2){
         $data = "Scout team";
      }elseif($type == 3){
         $data = "Rover Scout team";
      }else if($type == 4){
         $data = "Girl-in-Cab";
      }else if($type == 5){
         $data = "Girl-in Scout";
      }else if($type == 6){
         $data = "Girl-in-Rover Scout";      
      }else{
         $data = "";
      }
      return $data;
   }
}

if (!function_exists('scout_group_office_type')) {
   function scout_group_office_type($type) {
      if($type == 1){
         $result = "Close Group";
      }else{
         $result = "Open Group";
      }
      return $result;
   }
}

if (!function_exists('migrate_verify_status')) {
   function migrate_verify_status($item) {      
      if($item == 'Approved'){
         $result = "<span class='label label-success'>Accept</span>";
      }elseif($item == 'Reject'){      
         $result = "<span class='label label-important'>Reject</span>";
      }else{
         $result = "<span class='label label-warning'>Pending</span>";
      }
      return $result;
   }
}

if (!function_exists('award_status')) {
   function award_status($item) {      
      if($item == 'Approved'){
         $result = "<span class='label label-success'>Accept</span>";
      }elseif($item == 'Reject'){      
         $result = "<span class='label label-important'>Reject</span>";
      }else{
         $result = "<span class='label label-warning'>Pending</span>";
      }
      return $result;
   }
}

if (!function_exists('get_member_type')) {
   function get_member_type($item) {      
      if($item == '1'){
         $result = "New Applicant";
      }elseif($item == '2'){
         $result = "Scout";
      }elseif($item == '3'){
         $result = "Adult Leader";
      }elseif($item == '4'){
         $result = "Professional Executive";
      }elseif($item == '5'){
         $result = "Warrant";
      }elseif($item == '6'){
         $result = "Non-Warrant";
      }elseif($item == '7'){
         $result = "Support Staff";          
      }else{
         $result = '';
      }

      return $result;
   }
}

if (!function_exists('set_office_type')) {
   function set_office_type($item) {      
      if($item == '1'){
         $result = "National";
      }elseif($item == '2'){
         $result = "Region";
      }elseif($item == '3'){
         $result = "District";
      }elseif($item == '4'){
         $result = "Upazila";
      }elseif($item == '5'){
         $result = "Scout Group";    
      }else{
         $result = '';
      }

      return $result;
   }
}

if (!function_exists('get_event_level')) {
   function get_event_level($item) {      
      if($item == '1'){
         $result = "National";
      }elseif($item == '2'){
         $result = "International";
      }elseif($item == '3'){
         $result = "Region";
      }elseif($item == '4'){
         $result = "District";      
      }else{
         $result = '';
      }

      return $result;
   }
}

if (!function_exists('get_event_participant_type')) {
   function get_event_participant_type($item) {      
      if($item == '1'){
         $result = "Participant";
      }elseif($item == '2'){
         $result = "Volunteer";
      }elseif($item == '3'){
         $result = "Official";
      }elseif($item == '4'){
         $result = "Leader"; 
      }elseif($item == '5'){
         $result = "Not Allowed";     
      }else{
         $result = '';
      }

      return $result;
   }
}


// if (!function_exists('get_member_status')) {
//    function get_member_status($item) {      
//       if($item == '1'){
//          $result = "Current";
//       }elseif($item == '2'){
//          $result = "Archive";
//       }elseif($item == '3'){
//          $result = "Delete";
//       }else{
//          $result = "";
//       }

//       return $result;
//    }
// }

function event_verify_status($item) {      
   if($item == 'Approved'){
      $result = "<span class='label label-success'>Accept</span>";
   }elseif($item == 'Reject'){      
      $result = "<span class='label label-important'>Reject</span>";
   }else{
      $result = "<span class='label label-warning'>Pending</span>";
   }
   return $result;
}

function service_request_status($item) {      
   if($item == 'Complete'){
      $result = "<span class='label label-success'>Complete</span>";
   }elseif($item == 'Processing'){      
      $result = "<span class='label label-important'>On Process</span>";
   }elseif($item == 'Reject'){      
      $result = "<span class='label'>Cancel</span>";
   }elseif($item == 'Pending'){
      $result = "<span class='label label-warning'>Pending</span>";
   }
   
   return $result;
}

function func_service_assign_office_type($item) {      
   if($item == '1'){
      $result = "Scouts Region";
   }elseif($item == '2'){
      $result = "Scouts District";
   }elseif($item == '3'){
      $result = "Scouts Upazila";
   }elseif($item == '4'){
      $result = "Scouts Group";     
   }else{
      $result = '';
   }
   
   return $result;
}

// function func_custom_adult_badge($item) {      
//    if($item == '86,95,104'){
//       $result = "েসিক কোর্স সম্পন্ন";
//    }elseif($item == '87,96,105'){
//       $result = "অ্যাডভান্স কোর্স সম্পন্ন";
//    }elseif($item == '88,97,106'){
//       $result = "স্কিল কোর্স সম্পন্ন";
//    }elseif($item == '89,98,107'){
//       $result = "উডব্যাজার";
//    }elseif($item == '90,99,108'){
//       $result = "সিএএলটি সম্পন্ন";
//    }elseif($item == '91,100,109'){
//       $result = "সহকারী লিডার ট্রেনার";
//    }elseif($item == '92,101,110'){
//       $result = "সিএলটি সম্পন্ন";
//    }elseif($item == '93,102,111'){
//       $result = "লিডার ট্রেনার";     
//    }else{
//       $result = '';
//    }
   
//    return $result;
// }

function func_imp_email($item) {
   $exp = explode('@', $item);
   return substr($exp[0], 0, 3).'........@'.$exp[1];
}

if (!function_exists('func_activity_log')) {
   function func_activity_log($act_id, $msg){
      $CI =& get_instance();

      $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
      $data = array('user_id' => $CI->session->userdata('user_id'), 
         'activity_type_id' => $act_id, 
         'message' => $msg,                      
         'sc_nhq_id' => $CI->session->userdata('sc_nhq_id'), 
         'sc_region_id' => $CI->session->userdata('sc_region_id'), 
         'sc_district_id' => $CI->session->userdata('sc_district_id'), 
         'sc_upazila_id' => $CI->session->userdata('sc_upazila_id'), 
         'sc_group_id' => $CI->session->userdata('sc_group_id'), 
         'ip_address' => $ip,
         'created' => date('Y-m-d H:i:s'),
         'user_agent' => $_SERVER['HTTP_USER_AGENT']
         );

      if($CI->ion_auth->is_scout_member()){
         $data['office_type_id'] = NULL;
         $CI->db->insert('activity_logs', $data);

      }elseif($CI->ion_auth->is_group_admin()){
         $data['office_type_id'] = '5';
         $CI->db->insert('activity_logs', $data);

      }elseif($CI->ion_auth->is_upazila_admin()){
         $data['office_type_id'] = '4';
         $CI->db->insert('activity_logs', $data);

      }elseif($CI->ion_auth->is_district_admin()){
         $data['office_type_id'] = '3';
         $CI->db->insert('activity_logs', $data);

      }elseif($CI->ion_auth->is_region_admin()){
         $data['office_type_id'] = '2';
         $CI->db->insert('activity_logs', $data);

      }elseif($CI->ion_auth->is_admin()){
         $data['office_type_id'] = '1';
         $CI->db->insert('activity_logs', $data);
      }
   }
}


if (!function_exists('date_dayname_format')) {
   function date_dayname_format($item) {      
      if($item != '0000-00-00'){
         // return date('d M Y', strtotime($item));
         return date_format(date_create($item), "d M Y");
      }else{
         return '';
      }
   }
}

if (!function_exists('date_bangla_calender_format')) {
   function date_bangla_calender_format($item) {      
      $currentDate = date_dayname_format($item);
      $engDATE = array('1','2','3','4','5','6','7','8','9','0','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');
      $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার' );
      $convertedDATE = str_replace($engDATE, $bangDATE, $currentDate);
      return $convertedDATE;
   }
}

function eng2bng($item) {      
   return BanglaConverter::en2bn($item);
}

function bng2eng($item) {      
   return BanglaConverter::bn2en($item);
}
