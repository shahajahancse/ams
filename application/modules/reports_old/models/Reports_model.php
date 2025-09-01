<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Reports_model extends CI_Model {
    /**
     * This model is using into the students controller
     * Load : $this->load->model('studentmodel');
     */
    function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

    public function get_daily_appointment_list($startDate) {
        // result query
        $this->db->select('a.*');
        $this->db->from('appointment a');  
        $this->db->where('date(a.date)', $startDate);
        $this->db->order_by('a.date', 'DESC');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_appointment_list($startDate = NULL, $endDate = NULL) {
        // result query
        $this->db->select('a.*');
        $this->db->from('appointment a');  
        // $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        // $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        // $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        // if($financing_id){
        //     $this->db->where('financing_id', $financing_id);
        // }
        if($startDate){
            $this->db->where('date(a.date) >=', $startDate);
        }
        if($endDate){
            $this->db->where('date(a.date_end) <=', $endDate);
        }
        $this->db->order_by('a.date', 'DESC');
        // $this->db->group_by('t.id');
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;

        return $query;
    }

    public function get_completed_training_list($financing_id = NULL, $startDate = NULL, $endDate = NULL) {
        // result query
        $this->db->select('t.*, tc.course_title, f.finance_name');
        $this->db->from('training_management t');  
        $this->db->join('training_users tu', 'tu.training_id = t.id', 'LEFT');
        $this->db->join('training_course tc', 'tc.id = t.course_id', 'LEFT');
        $this->db->join('financing f', 'f.id = t.financing_id', 'LEFT');
        if($financing_id){
            $this->db->where('financing_id', $financing_id);
        }
        if($startDate){
            $this->db->where('start_date >=', $startDate);
        }
        if($endDate){
            $this->db->where('start_date <=', $endDate);
        }
        $this->db->order_by('t.id', 'DESC');
        $this->db->group_by('t.id');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_data_sheet($typeID, $status = NULL) {

        // result query        
        $this->db->select('pd.*, ds.dis_name_bn, ut.upa_name_bn, o.org_name, dg.desig_name, TIMESTAMPDIFF(YEAR,pd.date_of_birth,CURDATE()) AS age');
        $this->db->from('personal_datas pd');        
        $this->db->join('districts ds', 'ds.id=pd.per_dis_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id=pd.upa_tha_id', 'LEFT');
        $this->db->join('organizations o', 'o.id=pd.curr_org_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id=pd.curr_desig_id', 'LEFT');
        $this->db->where('pd.data_sheet_type', $typeID);   
        if(!empty($status)){
            $this->db->where('pd.status', $status);
        }else{
            $this->db->where('pd.status', 1);
        }

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_count_representative($dataType, $officeType, $status = NULL, $division=NULL, $district=NULL, $upazila=NULL, $union=NULL) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('data_sheet_type', $dataType);
        $this->db->where('office_type_id', $officeType);
        
        if(!empty($division)){
            $this->db->where('division_id', $division);
        }
        if(!empty($district)){
            $this->db->where('district_id', $district);
        }
        if(!empty($upazila)){
            $this->db->where('upa_tha_id', $upazila);
        }
        if(!empty($union)){
            $this->db->where('union_id', $union);
        }

        if(!empty($status)){
            $this->db->where('status', $status);
        }else{
            $this->db->where('status', 1);
        }

        $tmp = $this->db->get('personal_datas')->result();
        // echo $this->db->last_query(); exit;        
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_list_personal_data($dataType, $officeType, $division=NULL, $district=NULL, $upazila=NULL, $union=NULL) {
        $this->db->select('pd.national_id, pd.name_bangla, pd.telephone_mobile, o.org_name, dg.desig_name');
        $this->db->from('personal_datas pd');
        $this->db->join('organizations o', 'o.id = pd.curr_org_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = pd.curr_desig_id', 'LEFT');
        $this->db->where('pd.data_sheet_type', $dataType);
        $this->db->where('pd.office_type_id', $officeType);
        $this->db->where('pd.status', 1);

        if(!empty($division)){
            $this->db->where('pd.division_id', $division);
        }
        if(!empty($district)){
            $this->db->where('pd.district_id', $district);
        }
        if(!empty($upazila)){
            $this->db->where('pd.upa_tha_id', $upazila);
        }
        if(!empty($union)){
            $this->db->where('pd.union_id', $union);
        }

        $query = $this->db->get()->result();
        //echo $this->db->last_query();
        return $query;
    }

    public function get_count_rep_by_gender($dataType, $gender) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('data_sheet_type', $dataType);
        $this->db->where('gender', $gender);
        $this->db->where('status', 1);
        $tmp = $this->db->get('personal_datas')->result();
        // echo $this->db->last_query(); exit;        
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_count_age($dataType, $age) {
        $ret = 0;

        $query = $this->db->query("SELECT id, data_sheet_type, name_bangla, date_of_birth, YEAR(CURDATE()) - YEAR(date_of_birth) AS age, COUNT(id) as total FROM personal_datas WHERE data_sheet_type = '$dataType' GROUP BY age HAVING age = '$age'");
        // echo $this->db->last_query(); exit;     

        if($query->num_rows() > 0){
            $row = $query->result_array();
            $ret = $row[0]['total']; //exit;
        }   
        // print_r($ret); exit;
        return $ret;
    }

    public function get_count_elected($dataType, $elected) {
        $ret = 0;

        $query = $this->db->query("SELECT id, data_sheet_type, name_bangla, how_much_elected, COUNT(id) as total FROM personal_datas WHERE data_sheet_type = '$dataType' group BY how_much_elected HAVING how_much_elected = '$elected'");
        // echo $this->db->last_query(); exit;     

        if($query->num_rows() > 0){
            $row = $query->result_array();
            $ret = $row[0]['total']; //exit;
        }   
        // print_r($ret); exit;
        return $ret;
    }

    public function get_count_rep_examp($dataType, $exam_id) {

        $this->db->select('ed.data_id, ed.edu_exam_id, ex.exam_name, pd.data_sheet_type, COUNT(edu_exam_id) as total');
        $this->db->from('per_education ed');
        $this->db->join('personal_datas pd', 'pd.id = ed.data_id', 'LEFT');
        $this->db->join('exam_names ex', 'ex.id = ed.edu_exam_id', 'LEFT');
        $this->db->where('pd.data_sheet_type', $dataType);   
        // $this->db->group_by('ed.edu_exam_id');             
        $this->db->where('ed.edu_exam_id', $exam_id);
        $tmp = $this->db->get()->result();

        // echo $this->db->last_query(); exit;        
        $ret['count'] = $tmp[0]->total;
        return $ret;
    }

    public function get_nilg_course_complete_list($dataType, $course_id) {

        $this->db->select('nt.data_id, pd.data_sheet_type, pd.name_bangla, pd.curr_attend_date, pd.national_id, pd.telephone_mobile, nt.nilg_course_id, dg.desig_name, o.org_name, ds.dis_name_bn, ut.upa_name_bn, uni.uni_name_bn, ds2.dis_name_bn AS district_name');
        $this->db->from('per_nilg_training nt');
        $this->db->join('personal_datas pd', 'pd.id = nt.data_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = pd.curr_desig_id', 'LEFT');
        $this->db->join('organizations o', 'o.id = pd.curr_org_id', 'LEFT');
        $this->db->join('districts ds', 'ds.id = pd.district_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id = pd.upa_tha_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = pd.union_id', 'LEFT');

        $this->db->join('districts ds2', 'ds2.id=pd.per_dis_id', 'LEFT');
        // $this->db->join('training_course tc', 'tc.id = nt.nilg_course_id', 'LEFT');
        $this->db->where('pd.data_sheet_type', $dataType);   
        // $this->db->group_by('ed.edu_exam_id');             
        $this->db->where('nt.nilg_course_id', $course_id);
        $query = $this->db->get()->result();

        // echo $this->db->last_query(); exit;        
        // $ret['count'] = $tmp[0]->total;
        return $query;
    }


    public function get_many_times_elected($dataType) {

        $this->db->select('nt.data_id, pd.data_sheet_type, pd.name_bangla, pd.how_much_elected, nt.nilg_course_id, dg.desig_name, o.org_name, ds.dis_name_bn, ut.upa_name_bn, uni.uni_name_bn');
        $this->db->from('per_nilg_training nt');
        $this->db->join('personal_datas pd', 'pd.id = nt.data_id', 'LEFT');
        $this->db->join('designation dg', 'dg.id = pd.curr_desig_id', 'LEFT');
        $this->db->join('organizations o', 'o.id = pd.curr_org_id', 'LEFT');
        $this->db->join('districts ds', 'ds.id = pd.district_id', 'LEFT');
        $this->db->join('upazilas ut', 'ut.id = pd.upa_tha_id', 'LEFT');
        $this->db->join('unions uni', 'uni.id = pd.union_id', 'LEFT');
        $this->db->where('pd.data_sheet_type', $dataType);   
        $this->db->where('pd.how_much_elected >', '1');
        $query = $this->db->get()->result();

        // echo $this->db->last_query(); exit;        
        // $ret['count'] = $tmp[0]->total;
        return $query;
    }





    public function get_count_by_designation($id) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('curr_desig_id', $id);        
        $tmp = $this->db->get('personal_datas')->result();
        // echo $this->db->last_query(); exit;        
        $ret['count'] = $tmp[0]->count;
        return $ret;
    }

    public function get_item_info($table, $id, $field) {
      $query = $this->db->from($table)
      ->where($field, $id)
      ->get()->row();
      return $query;
  } 

  public function get_data($table, $id=NULL, $field=NULL) {
    $this->db->from($table);
    if(!empty($id)){
        $this->db->where($field, $id);
    }
    $query=$this->db->get()->result();
    return $query;
}

public function get_divisions($division_id=NULL) {
    $this->db->select('*');        
    if(!empty($division_id)){
        $this->db->where('id', $division_id);
    }
    $this->db->order_by('sort_order', 'ASC');
    $query =  $this->db->get('divisions');

    return $query->result();
}

public function get_edu_qualification() {
    $this->db->select('id, exam_name');        
    $this->db->order_by('exam_name', 'ASC');
    $query =  $this->db->get('exam_names');

    return $query->result();
}


public function get_info($id) {
        // result query 
    $query = array();

    $this->db->select('pd.*, ms.marital_status_name, ds.dis_name_bn, ut.upa_name_bn,
        o1.org_name AS first_org_name, o2.org_name AS current_org_name,
        dg1.desig_name AS first_desig_name, dg2.desig_name AS current_desig_name
        ');
    $this->db->from('personal_datas pd');        

    $this->db->join('districts ds', 'ds.id = pd.district_id', 'LEFT');
    $this->db->join('upazilas ut', 'ut.id = pd.upa_tha_id', 'LEFT');
    $this->db->join('organizations o1', 'o1.id = pd.first_org_id', 'LEFT');
    $this->db->join('organizations o2', 'o2.id = pd.curr_org_id', 'LEFT');
    $this->db->join('designation dg1', 'dg1.id = pd.first_desig_id', 'LEFT');
    $this->db->join('designation dg2', 'dg2.id = pd.curr_desig_id', 'LEFT');
    $this->db->join('marital_status ms', 'ms.id=pd.marital_status_id');

    $this->db->where('pd.id', $id);                

    $query['info'] = $this->db->get()->row();

        //Experience
    $this->db->select('e.*, o.org_name AS exp_org_name, dg.desig_name AS exp_desig_name');
    $this->db->from('per_experience e');        
    $this->db->join('organizations o', 'o.id = e.exp_org_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id = e.exp_desig_id', 'LEFT');        
    $this->db->where('e.data_id', $id);                
    $query['experience'] = $this->db->get()->result();

        //Promotion
    $this->db->select('p.*, o.org_name AS pro_org_name, dg.desig_name AS pro_desig_name');
    $this->db->from('per_promotion p');        
    $this->db->join('organizations o', 'o.id = p.promo_org_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id = p.promo_desig_id', 'LEFT');        
    $this->db->where('p.data_id', $id);                
    $query['promotion'] = $this->db->get()->result();

        //Education
    $this->db->select('ed.*, ex.exam_name, s.sub_name, b.board_name');
    $this->db->from('per_education ed');
    $this->db->join('exam_names ex', 'ex.id = ed.edu_exam_id', 'LEFT');
    $this->db->join('subjects s', 's.id = ed.edu_subject_id', 'LEFT');        
    $this->db->join('boards b', 'b.id = ed.edu_board_id', 'LEFT');        
    $this->db->where('ed.data_id', $id);                
    $query['education'] = $this->db->get()->result();

        // NILG Training
    $this->db->select('nt.*, n.course_name, dg.desig_name AS nilg_training_desig_name');
    $this->db->from('per_nilg_training nt');        
    $this->db->join('nilg_trainings n', 'n.id = nt.nilg_course_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id = nt.nilg_desig_id', 'LEFT');        
    $this->db->where('nt.data_id', $id);                
    $query['nilg_training'] = $this->db->get()->result();

        // Local Training
    $this->db->select('lot.*, n.course_name AS local_course_name');
    $this->db->from('per_local_org_training lot');        
    $this->db->join('nilg_trainings n', 'n.id = lot.local_course_id', 'LEFT');
    $this->db->where('lot.data_id', $id);                
    $query['local_training'] = $this->db->get()->result();

        // Local Training
    $this->db->select('fot.*, n.course_name AS foreign_course_name');
    $this->db->from('per_foreign_org_training fot');        
    $this->db->join('nilg_trainings n', 'n.id = fot.foreign_course_id', 'LEFT');
    $this->db->where('fot.data_id', $id);                
    $query['foreign_training'] = $this->db->get()->result();

        // echo $this->db->last_query(); exit;
    return $query;
}

// , array $search
public function get_all_data_sheet($typeID) {

        // result query        
    $this->db->select('pd.*, ds.dis_name_bn, ut.upa_name_bn, o.org_name, dg.desig_name, TIMESTAMPDIFF(YEAR,pd.date_of_birth,CURDATE()) AS age');
    $this->db->from('personal_datas pd');        
    $this->db->join('districts ds', 'ds.id=pd.district_id', 'LEFT');
    $this->db->join('upazilas ut', 'ut.id=pd.upa_tha_id', 'LEFT');
    $this->db->join('organizations o', 'o.id=pd.curr_org_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id=pd.curr_desig_id', 'LEFT');
    $this->db->where('pd.data_sheet_type', $typeID);   
    $this->db->where('pd.status', 1);

    if($this->input->get('national_id') != NULL){
        $this->db->where('pd.national_id', $this->input->get('national_id'));     
    }

    if($this->input->get('district') != NULL){
        $this->db->where('pd.district_id', $this->input->get('district'));     
    }

    if($this->input->get('upazilas') > '0'){
        $this->db->where('pd.upa_tha_id', $this->input->get('upazilas'));     
    }

    if($this->input->get('designation') != NULL){
        $this->db->where('pd.curr_desig_id', $this->input->get('designation'));     
    }

    if($this->input->get('gender') != NULL){
        $this->db->where('pd.gender', $this->input->get('gender'));     
    }

    $query = $this->db->get()->result_array();
    return $query;
}

public function get_all_data_by_org_type($typeID, $org_type_id) {

        // result query        
        // $this->db->select('pd.id, pd.data_sheet_type, pd.name_bangla, pd.national_id, o.org_name, o.org_type_id, ot.type_name, dg.desig_name');
    $this->db->select('COUNT(*) as org_count');
    $this->db->from('personal_datas pd');
    $this->db->join('organizations o', 'o.id=pd.curr_org_id', 'LEFT');
    $this->db->join('organization_type ot', 'ot.id=o.org_type_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id=pd.curr_desig_id', 'LEFT');
    $this->db->where('pd.data_sheet_type', $typeID); 
    $this->db->where('o.org_type_id', $org_type_id); 
    $this->db->where('pd.status', 1);

    $query = $this->db->get()->result_array();
        // echo $this->db->last_query(); exit;
    return $query;
}

public function get_not_yet_training() {


        // result query        
    $this->db->select('pd.id, pd.name_bangla, pd.national_id, pd.present_add, pd.gender, ds.dis_name_bn, ut.upa_name_bn, o.org_name, dg.desig_name');
    $this->db->from('personal_datas pd');        
    $this->db->join('districts ds', 'ds.id=pd.district_id', 'LEFT');
    $this->db->join('upazilas ut', 'ut.id=pd.upa_tha_id', 'LEFT');
    $this->db->join('organizations o', 'o.id=pd.curr_org_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id=pd.curr_desig_id', 'LEFT');
    $this->db->where('pd.id not in (SELECT data_sheet_id FROM `trainers` GROUP BY data_sheet_id)', NULL, FALSE);
    $this->db->where('pd.status', 1);
    
    if($this->input->get('national_id') != NULL){
        $this->db->where('pd.national_id', $this->input->get('national_id'));     
    }

    if($this->input->get('district') != NULL){
        $this->db->where('pd.district_id', $this->input->get('district'));     
    }

    if($this->input->get('upazilas') > '0'){
        $this->db->where('pd.upa_tha_id', $this->input->get('upazilas'));     
    }

    if($this->input->get('designation') != NULL){
        $this->db->where('pd.curr_desig_id', $this->input->get('designation'));     
    }

    if($this->input->get('gender') != NULL){
        $this->db->where('pd.gender', $this->input->get('gender'));     
    }

    $query = $this->db->get()->result_array();
        //echo $this->db->last_query(); exit;
    return $query;
}
public function got_training() {


        // result query        
    $this->db->select('pd.id, pd.name_bangla, pd.national_id, pd.present_add, pd.gender, ds.dis_name_bn, ut.upa_name_bn, o.org_name, dg.desig_name');
    $this->db->from('personal_datas pd');        
    $this->db->join('districts ds', 'ds.id=pd.district_id', 'LEFT');
    $this->db->join('upazilas ut', 'ut.id=pd.upa_tha_id', 'LEFT');
    $this->db->join('organizations o', 'o.id=pd.curr_org_id', 'LEFT');
    $this->db->join('designation dg', 'dg.id=pd.curr_desig_id', 'LEFT');
    $this->db->where('pd.id in (SELECT data_sheet_id FROM `trainers` GROUP BY data_sheet_id)', NULL, FALSE);

    if($this->input->get('national_id') != NULL){
        $this->db->where('pd.national_id', $this->input->get('national_id'));     
    }

    if($this->input->get('district') != NULL){
        $this->db->where('pd.district_id', $this->input->get('district'));     
    }

    if($this->input->get('upazilas') > '0'){
        $this->db->where('pd.upa_tha_id', $this->input->get('upazilas'));     
    }

    if($this->input->get('designation') != NULL){
        $this->db->where('pd.curr_desig_id', $this->input->get('designation'));     
    }

    if($this->input->get('gender') != NULL){
        $this->db->where('pd.gender', $this->input->get('gender'));     
    }

    $query = $this->db->get()->result_array();
        //echo $this->db->last_query(); exit;
    return $query;
}

public function exam_count($id){
    $this->db->select('COUNT(*) as cnt');
    $this->db->from('per_education');
    $this->db->where('edu_exam_id', $id);
    $query = $this->db->get()->row();
    return $query->cnt;
}

public function exam_cnt(){
       // $query = $this->db->query('SELECT COUNT(id) as data_cnt, `edu_exam_id` FROM `per_education` WHERE 1 GROUP by edu_exam_id');   
    $this->db->select('COUNT(per_education.id) as data_cnt, per_education.edu_exam_id, exam_names.exam_name');
    $this->db->from('per_education');     
    $this->db->join('exam_names', 'exam_names.id = per_education.edu_exam_id', 'LEFT');
    $this->db->group_by('per_education.edu_exam_id');
    $query = $this->db->get()->result();
    return $query;
        // return $query;
}


public function get_all($select,$from,$where){
    $sql = "SELECT $select FROM $from where $where";

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
       return $query->result_array();
   }
}
public function get_cur_all($id, $from){

  $dt=$this->get_all('*',$from,'id='.$id);
  return $dt;
}
public function getcolumnlist(){
  $sql = "SHOW COLUMNS FROM personal_datas";

  $query = $this->db->query($sql);
  if ($query->num_rows() > 0) {
   return $query->result_array();
}
}
public function get_districts_by_divisions(){
    $sql = "SELECT *, GROUP_CONCAT(id) as distids, GROUP_CONCAT(name_bn) as distnames FROM `districts` group by division_id ";

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
       return $query->result_array();
   }
}

    // public function get_district_by_div_id($id){
    //     $data['0'] = 'Select District';
    //     $this->db->select('id, dis_name_bn');
    //     $this->db->from('district');
    //     $this->db->where('div_id', $id);
    //     $this->db->where('status',1);
    //     $this->db->order_by('dis_name_bn', 'ASC');
    //     $query = $this->db->get();

    //     foreach ($query->result_array() AS $rows) {
    //         $data[$rows['id']] = $rows['dis_name_bn'];
    //     }

    //     return $data;
    // }

    // public function get_upa_tha_by_dis_id($id){
    //     $data['0'] = 'Select thana/upazila';
    //     $this->db->select('id, dis_id, upa_name_bn');
    //     $this->db->from('upazilas');
    //     $this->db->where('dis_id',$id);
    //     $this->db->where('status',1);
    //     $this->db->order_by('upa_name_bn', 'ASC');
    //     $query = $this->db->get();

    //     foreach ($query->result_array() AS $rows) {
    //         $data[$rows['id']] = $rows['upa_name_bn'];
    //     }

    //     return $data;
    // }

    // public function get_organization_by_up_th_id($id){
    //     $data['0'] = 'Select Organization';
    //     $this->db->select('id, org_up_th_id, org_name');
    //     $this->db->from('organizations');
    //     $this->db->where('org_up_th_id', $id);
    //     $this->db->order_by('org_name', 'ASC');
    //     $query = $this->db->get();

    //     // echo $this->db->last_query(); exit;

    //     foreach ($query->result_array() AS $rows) {
    //         $data[$rows['id']] = $rows['org_name'];
    //     }
    //     // print_r($data); exit;
    //     return $data;
    // }

}
