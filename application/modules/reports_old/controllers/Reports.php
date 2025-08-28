<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Reports extends Backend_Controller {
	
    function __construct() {
        parent::__construct();   
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         redirect('dashboard');
     }

     $this->data['module_name'] = 'Reports';

        // $this->load->library('form_validation');
       // $this->load->model('Personal_datas_model');
     $this->load->model('Reports_model');
     $this->load->model('Common_model');
       // $this->load->model('general_setting/General_setting_model');
       // $this->load->model('exam_names/Exam_names_model');
 }

 public function index(){
    redirect('dashboard');    	
}

public function test_pdf(){
    $this->data['headding'] = 'test';
    $html = $this->load->view('pdf_test', $this->data, true);

        //Generate PDF
    $mpdf = new mPDF('', 'A4', 10, 'kalpurush', 10, 10, 10, 5);
    $mpdf->WriteHtml($html);
    $mpdf->output();
        // $mpdf->output('report.pdf', "D");
}

public function appointment(){
        // $this->data['division'] = $this->Common_model->get_division();
        // $this->data['financing_list'] = $this->Common_model->get_financing(); 

        //Load View
    $this->data['meta_title'] = 'Appointment Report';
    $this->data['subview'] = 'appointment';
    $this->load->view('backend/_layout_main', $this->data);
}

public function training(){
        // $this->data['division'] = $this->Common_model->get_division();
    $this->data['financing_list'] = $this->Common_model->get_financing(); 

        //Load View
    $this->data['meta_title'] = 'প্রশিক্ষণ রিপোর্ট';
    $this->data['subview'] = 'training';
    $this->load->view('backend/_layout_main', $this->data);
}

public function appointment_result(){
    $this->form_validation->set_rules('start_date', 'start date', 'trim|required');
    $this->form_validation->set_rules('end_date', 'end date', 'trim');

    // print_r($this->input->post()); exit;

    if($this->form_validation->run() == true){
            // $district=$this->input->post('district');
            // $upazila=$this->input->post('upazila');
            // $data_sheet_type = $this->input->post('data_sheet_type');
        // $financing_id = $this->input->post('financing_id');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        if($this->input->post('btnsubmit') == 'pdf_daily_appointment') {
                // echo 'Hello'; exit;
            // if(!empty($financing_id)){
            //     $this->data['finance_info'] = $this->Common_model->get_info('financing', $financing_id);
            // }
            $this->data['results'] = $this->Reports_model->get_daily_appointment_list($start_date);
            // print_r($this->data['results']);exit;

            $this->data['headding'] = 'দৈনিক কর্মসূচি';
            $html = $this->load->view('pdf_daily_appointment', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'kalpurush', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_appointment') {
                // echo 'Hello'; exit;
            // if(!empty($financing_id)){
            //     $this->data['finance_info'] = $this->Common_model->get_info('financing', $financing_id);
            // }
            $this->data['results'] = $this->Reports_model->get_appointment_list($start_date, $end_date);
            // print_r($this->data['results']);exit;

            $this->data['headding'] = 'কর্মসূচি';
            $html = $this->load->view('pdf_appointment', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'kalpurush', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }
    }
}


public function employee(){        
    $this->data['division'] = $this->Common_model->get_division();
    $this->data['designations'] = $this->Common_model->get_data('designation');
    $this->data['course_list'] = $this->Common_model->get_nilg_course(); 

    $this->data['data_type'] = array(''=>'-ডাটার ধরণ নির্বাচন করুন-', '2' => 'কর্মকর্তা', '3' => 'কর্মচারী');
    $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        //Load View
    $this->data['meta_title'] = 'কর্মকর্তা/কর্মচারীর রিপোর্ট';
    $this->data['subview'] = 'employee';
    $this->load->view('backend/_layout_main', $this->data);
}

public function employee_result(){
    $this->form_validation->set_rules('data_sheet_type', 'division', 'trim|required');

    if($this->form_validation->run() == true){
        $this->data['division_info'] = $this->Common_model->get_info('divisions', $this->input->post('division_id'));
        $this->data['district_info'] = $this->Common_model->get_info('districts', $this->input->post('district_id'));
        $this->data['upazila_info'] = $this->Common_model->get_info('upazilas', $this->input->post('upazila_id'));     
        $this->data['union_info'] = $this->Common_model->get_info('unions', $this->input->post('union_id'));         

        $data_sheet_type = $this->input->post('data_sheet_type');
        $division_id = $this->input->post('division_id');
        $district_id = $this->input->post('district_id');
        $upazila_id = $this->input->post('upazila_id');
        $union_id = $this->input->post('union_id');
        $course_id = $this->input->post('course_id');
        $status = $this->input->post('status');
            // $district=$this->input->post('district');
            // $upazila=$this->input->post('upazila');
            // $course_id = $this->input->post('course_id');

        if($this->input->post('btnsubmit') == 'pdf_emp_number_divisional') {
            $data_arr = [];
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            if(!empty($division_id)){
                $this->data['division_list'] = $this->Reports_model->get_divisions($division_id);
            }else{
                $this->data['division_list'] = $this->Reports_model->get_divisions();
            }

            foreach ($this->data['division_list'] as $item) {
                $data_arr[$item->id]['city_c'] = $this->Reports_model->get_count_representative($data_sheet_type, 5, $status, $item->id);
                $data_arr[$item->id]['zila_p'] = $this->Reports_model->get_count_representative($data_sheet_type, 4, $status, $item->id);
                $data_arr[$item->id]['upazila_p'] = $this->Reports_model->get_count_representative($data_sheet_type, 3, $status, $item->id);
                $data_arr[$item->id]['pourasava'] = $this->Reports_model->get_count_representative($data_sheet_type, 2, $status, $item->id);
                $data_arr[$item->id]['union_p'] = $this->Reports_model->get_count_representative($data_sheet_type, 1, $status, $item->id);
            }
            $this->data['result_data'] = $data_arr;
            $this->data['data_status'] = $status;
                // print_r($this->data['division_list']);
                // exit;

            $this->data['headding'] = 'বিভাগওয়ারী '.$this->data['type_details'].'র সংখ্যা ভিত্তিক রিপোর্ট';
            $html = $this->load->view('pdf_emp_number_divisional', $this->data, true);
                // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_emp_number_district') {
            $data_arr = [];
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            if(!empty($division_id)){
                $this->data['district_list'] = $this->Reports_model->get_data('districts', $division_id, 'dis_div_id');
            }else{
                $this->data['district_list'] = $this->Reports_model->get_data('districts');
            }

            foreach ($this->data['district_list'] as $item) {
                $data_arr[$item->id]['city_c'] = $this->Reports_model->get_count_representative($data_sheet_type, 5, $status, $division_id, $item->id);
                $data_arr[$item->id]['zila_p'] = $this->Reports_model->get_count_representative($data_sheet_type, 4, $status, $division_id, $item->id);
                $data_arr[$item->id]['upazila_p'] = $this->Reports_model->get_count_representative($data_sheet_type, 3, $status, $division_id, $item->id);
                $data_arr[$item->id]['pourasava'] = $this->Reports_model->get_count_representative($data_sheet_type, 2, $status, $division_id, $item->id);
                $data_arr[$item->id]['union_p'] = $this->Reports_model->get_count_representative($data_sheet_type, 1, $status, $division_id, $item->id);
            }
            $this->data['result_data'] = $data_arr;
            $this->data['data_status'] = $status;
                // print_r($this->data['division_list']);
                // exit;

            $this->data['headding'] = 'জেলাওয়ারী '.$this->data['type_details'].'র সংখ্যা ভিত্তিক রিপোর্ট';
            $html = $this->load->view('pdf_emp_number_district', $this->data, true);
                // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_emp_number_upazila') {
            $data_arr = [];
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            if(!empty($district_id)){
                $this->data['upazila_list'] = $this->Reports_model->get_data('upazilas', $district_id, 'upa_dis_id');
            }

            foreach ($this->data['upazila_list'] as $item) {
                $data_arr[$item->id]['upazila_p'] = $this->Reports_model->get_count_representative($data_sheet_type, 3, $status, NULL, NULL, $item->id);
                $data_arr[$item->id]['pourasava'] = $this->Reports_model->get_count_representative($data_sheet_type, 2, $status, NULL, NULL, $item->id);
                $data_arr[$item->id]['union_p'] = $this->Reports_model->get_count_representative($data_sheet_type, 1, $status, NULL, NULL, $item->id);
            }
            $this->data['result_data'] = $data_arr;
            $this->data['data_status'] = $status;
                // print_r($this->data['division_list']);
                // exit;

            $this->data['headding'] = 'উপজেলাওয়ারী '.$this->data['type_details'].'র সংখ্যা ভিত্তিক রিপোর্ট';
            $html = $this->load->view('pdf_emp_number_upazila', $this->data, true);
                // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_emp_number_union') {
            $data_arr = [];
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            if(!empty($upazila_id)){
                $this->data['union_list'] = $this->Reports_model->get_data('unions', $upazila_id, 'uni_upa_id');
            }

            foreach ($this->data['union_list'] as $item) {
                $data_arr[$item->id]['union_p'] = $this->Reports_model->get_count_representative($data_sheet_type, 1, $status, NULL, NULL, NULL, $item->id);
            }
            $this->data['result_data'] = $data_arr;
            $this->data['data_status'] = $status;
                // print_r($this->data['division_list']);
                // exit;

            $this->data['headding'] = 'ইউনিয়নওয়ারী '.$this->data['type_details'].'র সংখ্যা ভিত্তিক রিপোর্ট';
            $html = $this->load->view('pdf_emp_number_union', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_employee') {
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }
            $this->data['results'] = $this->Reports_model->get_data_sheet($data_sheet_type, $status);
            $this->data['total'] = count($this->data['results']);

            $this->data['headding'] = 'কর্মকর্তা/কর্মচারী রিপোর্ট';
            $html = $this->load->view('pdf_nilg_employee', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_number_designation') {
            $data_arr = []; 
                // echo 'hello'; exit;

            foreach ($this->input->post('designations') as $key => $val) {
                $data_arr[$val]['design'] = $this->Reports_model->get_item_info('designation', $val, 'id');
                $data_arr[$val]['total'] = $this->Reports_model->get_count_by_designation($val); 
                    // print_r($data_arr[$val]['total']); exit;
            }

            $this->data['results'] = $data_arr;
                // print_r($this->data['division_list']); // exit;

            $this->data['headding'] = 'কর্মকর্তা/কর্মচারীর পদবির সংখ্যা ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_nilg_number_designation', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_number_education') {
            $data_arr = [];
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            $this->data['edu_qualif_list'] = $this->Reports_model->get_edu_qualification();

            foreach ($this->data['edu_qualif_list'] as $value) {
                $data_arr[$value->id]['edu_name'] = $this->Reports_model->get_item_info('exam_names', $value->id, 'id');
                $data_arr[$value->id]['total'] = $this->Reports_model->get_count_rep_examp($data_sheet_type, $value->id);
            }
            $this->data['results'] = $data_arr;

            $this->data['headding'] = $this->data['type_details'].'র শিক্ষাগত যোগ্যতা ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_nilg_number_education', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_number_gender') {
            $data_arr = [];

            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            $data_arr['gender_male'] = $this->Reports_model->get_count_rep_by_gender($data_sheet_type, 'Male');
            $data_arr['gender_female'] = $this->Reports_model->get_count_rep_by_gender($data_sheet_type, 'Female');                
            $this->data['results'] = $data_arr;
                //print_r($this->data['results']); exit;

            $this->data['headding'] = $this->data['type_details'].'র  নারী/পরুষ ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_nilg_number_gender', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_number_age') {
            $data_arr = [];

            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            $start_age = 18;
            for($i=$start_age; $i < 60; $i++) { 
                $data_arr[$i] = $this->Reports_model->get_count_age($data_sheet_type, $i);
            }

            $this->data['results'] = $data_arr;
                //print_r($this->data['results']); exit;

            $this->data['headding'] = $this->data['type_details'].'র বয়স ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_nilg_number_age', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_nilg_course_complete') {
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            $this->data['course_info'] = $this->Common_model->get_info('training_course', $course_id);
            $this->data['results'] = $this->Reports_model->get_nilg_course_complete_list($data_sheet_type, $course_id);

                // print_r($this->data['results']); exit;

            $this->data['headding'] = $this->data['type_details'].' এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণের তালিকা';
            $html = $this->load->view('pdf_nilg_nilg_course_complete', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");



        }elseif($this->input->post('btnsubmit') == 'pdf_emp_list_city') {
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            $this->data['results'] = $this->Reports_model->get_list_personal_data($data_sheet_type, 5, NULL, $district_id);

            $this->data['headding'] = 'সিটি কর্পোরেশনের '.$this->data['type_details'].' তালিকা';
            $html = $this->load->view('pdf_datasheet_list', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_emp_list_district') {
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            $this->data['results'] = $this->Reports_model->get_list_personal_data($data_sheet_type, 4, NULL, $district_id);

            $this->data['headding'] = 'জেলা পরিষদের '.$this->data['type_details'].' তালিকা';
            $html = $this->load->view('pdf_datasheet_list', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_emp_list_upazila') {
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            $this->data['results'] = $this->Reports_model->get_list_personal_data($data_sheet_type, 3, NULL, NULL, $upazila_id);

            $this->data['headding'] = 'উপজেলা পরিষদের '.$this->data['type_details'].' তালিকা';
            $html = $this->load->view('pdf_datasheet_list', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_emp_list_pourashava') {
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            $this->data['results'] = $this->Reports_model->get_list_personal_data($data_sheet_type, 2, NULL, NULL, $upazila_id);

            $this->data['headding'] = 'পৌরসভার '.$this->data['type_details'].' তালিকা';
            $html = $this->load->view('pdf_datasheet_list', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_emp_list_union') {
            if($data_sheet_type == 2){
                $this->data['type_details'] = 'কর্মকর্তা';
            }elseif($data_sheet_type == 3){
                $this->data['type_details'] = 'কর্মচারী';
            }

            $this->data['results'] = $this->Reports_model->get_list_personal_data($data_sheet_type, 1, NULL, NULL, NULL, $union_id);

            $this->data['headding'] = 'ইউনিয়ন পরিষদের '.$this->data['type_details'].' তালিকা';
            $html = $this->load->view('pdf_datasheet_list', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }else{
                // echo 'hello'; 

        }
    }
}

public function nilg_employee(){
        // $this->data['division'] = $this->Common_model->get_division();
    $this->data['data_type'] = array(''=>'-ডাটার ধরণ নির্বাচন করুন-', '4' => 'এনআইএলজি কর্মকর্তা', '5' => 'এনআইএলজি কর্মচারী');
    $this->data['designations'] = $this->Common_model->get_data('designation');
    $this->data['course_list'] = $this->Common_model->get_nilg_course(); 
    $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        //Load View
    $this->data['meta_title'] = 'এনআইএলজি কর্মকর্তা/কর্মচারীর রিপোর্ট';
    $this->data['subview'] = 'nilg_employee';
    $this->load->view('backend/_layout_main', $this->data);
}

public function nilg_employee_result(){
    $this->form_validation->set_rules('data_sheet_type', 'division', 'trim|required');

    if($this->form_validation->run() == true){
            // $district=$this->input->post('district');
            // $upazila=$this->input->post('upazila');
        $data_sheet_type = $this->input->post('data_sheet_type');
        $course_id = $this->input->post('course_id');
        $status = $this->input->post('status');

        if($this->input->post('btnsubmit') == 'pdf_nilg_employee') {
            if($data_sheet_type == 4){
                $this->data['type_details'] = 'এনআইএলজি কর্মকর্তা';
            }elseif($data_sheet_type == 5){
                $this->data['type_details'] = 'এনআইএলজি কর্মচারী';
            }
            $this->data['results'] = $this->Reports_model->get_data_sheet($data_sheet_type, $status);
            $this->data['total'] = count($this->data['results']);
            $this->data['data_status'] = $status;

            $this->data['headding'] = 'এনআইএলজি কর্মকর্তা/কর্মচারী রিপোর্ট';
            $html = $this->load->view('pdf_nilg_employee', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_number_designation') {
            $data_arr = []; 
                // echo 'hello'; exit;

            foreach ($this->input->post('designations') as $key => $val) {
                $data_arr[$val]['design'] = $this->Reports_model->get_item_info('designation', $val, 'id');
                $data_arr[$val]['total'] = $this->Reports_model->get_count_by_designation($val); 
                    // print_r($data_arr[$val]['total']); exit;
            }

            $this->data['results'] = $data_arr;
                // print_r($this->data['division_list']); // exit;

            $this->data['headding'] = 'এনআইএলজি কর্মকর্তা/কর্মচারীর পদবির সংখ্যা ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_nilg_number_designation', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_number_education') {
            $data_arr = [];
            if($data_sheet_type == 4){
                $this->data['type_details'] = 'এনআইএলজি কর্মকর্তা';
            }elseif($data_sheet_type == 5){
                $this->data['type_details'] = 'এনআইএলজি কর্মচারী';
            }

            $this->data['edu_qualif_list'] = $this->Reports_model->get_edu_qualification();

            foreach ($this->data['edu_qualif_list'] as $value) {
                $data_arr[$value->id]['edu_name'] = $this->Reports_model->get_item_info('exam_names', $value->id, 'id');
                $data_arr[$value->id]['total'] = $this->Reports_model->get_count_rep_examp($data_sheet_type, $value->id);
            }
            $this->data['results'] = $data_arr;

            $this->data['headding'] = $this->data['type_details'].'র শিক্ষাগত যোগ্যতা ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_nilg_number_education', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_number_gender') {
            $data_arr = [];

            if($data_sheet_type == 4){
                $this->data['type_details'] = 'এনআইএলজি কর্মকর্তা';
            }elseif($data_sheet_type == 5){
                $this->data['type_details'] = 'এনআইএলজি কর্মচারী';
            }

            $data_arr['gender_male'] = $this->Reports_model->get_count_rep_by_gender($data_sheet_type, 'Male');
            $data_arr['gender_female'] = $this->Reports_model->get_count_rep_by_gender($data_sheet_type, 'Female');                
            $this->data['results'] = $data_arr;
                //print_r($this->data['results']); exit;

            $this->data['headding'] = $this->data['type_details'].'র  নারী/পরুষ ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_nilg_number_gender', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_number_age') {
            $data_arr = [];

            if($data_sheet_type == 4){
                $this->data['type_details'] = 'এনআইএলজি কর্মকর্তা';
            }elseif($data_sheet_type == 5){
                $this->data['type_details'] = 'এনআইএলজি কর্মচারী';
            }

            $start_age = 18;
            for($i=$start_age; $i < 60; $i++) { 
                $data_arr[$i] = $this->Reports_model->get_count_age($data_sheet_type, $i);
            }

            $this->data['results'] = $data_arr;
                //print_r($this->data['results']); exit;

            $this->data['headding'] = $this->data['type_details'].'র বয়স ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_nilg_number_age', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_nilg_nilg_course_complete') {
            if($data_sheet_type == 4){
                $this->data['type_details'] = 'কর্মকর্তাদের';
            }elseif($data_sheet_type == 5){
                $this->data['type_details'] = 'কর্মচারীদের ';
            }

            $this->data['course_info'] = $this->Common_model->get_info('training_course', $course_id);
            $this->data['results'] = $this->Reports_model->get_nilg_course_complete_list($data_sheet_type, $course_id);

                // print_r($this->data['results']); exit;

            $this->data['headding'] = $this->data['type_details'].' এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণের তালিকা';
            $html = $this->load->view('pdf_nilg_nilg_course_complete', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");
        }

    }
}


public function others_employee(){
        // $this->data['division'] = $this->Common_model->get_division();
    $this->data['data_type'] = array(''=>'-ডাটার ধরণ নির্বাচন করুন-', '6' => 'উন্নয়ন সহযোগী প্রতিষ্ঠান', '7' => 'এনজিও', '8' => 'অন্যান্য প্রতিষ্ঠান');
    $this->data['designations'] = $this->Common_model->get_data('designation');
    $this->data['course_list'] = $this->Common_model->get_nilg_course(); 
    $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        //Load View
    $this->data['meta_title'] = 'অন্যান্য ব্যাক্তিগত রিপোর্ট';
    $this->data['subview'] = 'others_employee';
    $this->load->view('backend/_layout_main', $this->data);
}

public function others_employee_result(){
    $this->form_validation->set_rules('data_sheet_type', 'datasheet type', 'trim|required');

    if($this->form_validation->run() == true){
            // $district=$this->input->post('district');
            // $upazila=$this->input->post('upazila');
        $data_sheet_type = $this->input->post('data_sheet_type');
        $course_id = $this->input->post('course_id');
        $status = $this->input->post('status');

        if($this->input->post('btnsubmit') == 'pdf_others_employee') {
            if($data_sheet_type == 6){
                $this->data['type_details'] = 'উন্নয়ন সহযোগী প্রতিষ্ঠান';
            }elseif($data_sheet_type == 7){
                $this->data['type_details'] = 'এনজিও';
            }elseif($data_sheet_type == 8){
                $this->data['type_details'] = 'অন্যান্য প্রতিষ্ঠান';
            }
            $this->data['results'] = $this->Reports_model->get_data_sheet($data_sheet_type, $status);
            $this->data['total'] = count($this->data['results']);
            $this->data['data_status'] = $status;

            $this->data['headding'] = 'অন্যান্য ব্যাক্তিগত রিপোর্ট';
            $html = $this->load->view('pdf_others_employee', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }

    }
}


public function representative(){
    $this->data['division'] = $this->Common_model->get_division();
    $this->data['designations'] = $this->Common_model->get_data('designation');
        // print_r($this->data['designations']); exit;

    $this->data['course_list'] = $this->Common_model->get_nilg_course(); 
    $this->data['datasheet_status'] = $this->Common_model->get_datasheet_status();

        //Load View
    $this->data['meta_title'] = 'জনপ্রতিনিধির রিপোর্ট';
    $this->data['subview'] = 'representative';
    $this->load->view('backend/_layout_main', $this->data);
}

public function representative_result(){
    $this->form_validation->set_rules('division', 'division', 'trim');
    $this->form_validation->set_rules('district', 'district', 'trim');
    $this->form_validation->set_rules('upazila', 'upazila', 'trim');

    if($this->form_validation->run() == true){
            // $district=$this->input->post('district');
            // $upazila=$this->input->post('upazila');
        $this->data['division_info'] = $this->Common_model->get_info('divisions', $this->input->post('division_id'));
        $this->data['district_info'] = $this->Common_model->get_info('districts', $this->input->post('district_id'));
        $this->data['upazila_info'] = $this->Common_model->get_info('upazilas', $this->input->post('upazila_id'));        
        $this->data['union_info'] = $this->Common_model->get_info('unions', $this->input->post('union_id'));    
        $division_id = $this->input->post('division_id');
        $district_id = $this->input->post('district_id');
        $upazila_id = $this->input->post('upazila_id');
        $union_id = $this->input->post('union_id');
        $course_id = $this->input->post('course_id');
        $status = $this->input->post('status');


        if($this->input->post('btnsubmit') == 'pdf_rep_number_divisional') {
            $data_arr = [];
            if(!empty($division_id)){
                $this->data['division_list'] = $this->Reports_model->get_divisions($division_id);
            }else{
                $this->data['division_list'] = $this->Reports_model->get_divisions();
            }

            foreach ($this->data['division_list'] as $item) {
                $data_arr[$item->id]['city_c'] = $this->Reports_model->get_count_representative(1, 5, $status, $item->id);
                $data_arr[$item->id]['zila_p'] = $this->Reports_model->get_count_representative(1, 4, $status, $item->id);
                $data_arr[$item->id]['upazila_p'] = $this->Reports_model->get_count_representative(1, 3, $status, $item->id);
                $data_arr[$item->id]['pourasava'] = $this->Reports_model->get_count_representative(1, 2, $status, $item->id);
                $data_arr[$item->id]['union_p'] = $this->Reports_model->get_count_representative(1, 1, $status, $item->id);
            }
            $this->data['result_data'] = $data_arr;
            $this->data['data_status'] = $status;
                // print_r($this->data['division_list']);
                // exit;

            $this->data['headding'] = 'বিভাগওয়ারী জনপ্রতিনিধির সংখ্যা ভিত্তিক রিপোর্ট';
            $html = $this->load->view('pdf_rep_number_divisional', $this->data, true);
                // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_number_district') {
            $data_arr = [];
            if(!empty($division_id)){
                $this->data['district_list'] = $this->Reports_model->get_data('districts', $division_id, 'dis_div_id');
            }else{
                $this->data['district_list'] = $this->Reports_model->get_data('districts');
            }

            foreach ($this->data['district_list'] as $item) {
                $data_arr[$item->id]['city_c'] = $this->Reports_model->get_count_representative(1, 5, $status, $division_id, $item->id);
                $data_arr[$item->id]['zila_p'] = $this->Reports_model->get_count_representative(1, 4, $status, $division_id, $item->id);
                $data_arr[$item->id]['upazila_p'] = $this->Reports_model->get_count_representative(1, 3, $status, $division_id, $item->id);
                $data_arr[$item->id]['pourasava'] = $this->Reports_model->get_count_representative(1, 2, $status, $division_id, $item->id);
                $data_arr[$item->id]['union_p'] = $this->Reports_model->get_count_representative(1, 1, $status, $division_id, $item->id);
            }
            $this->data['result_data'] = $data_arr;
            $this->data['data_status'] = $status;
                // print_r($this->data['division_list']);
                // exit;

            $this->data['headding'] = 'জেলাওয়ারী জনপ্রতিনিধির সংখ্যা ভিত্তিক রিপোর্ট';
            $html = $this->load->view('pdf_rep_number_district', $this->data, true);
                // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_number_upazila') {
            $data_arr = [];
            if(!empty($district_id)){
                $this->data['upazila_list'] = $this->Reports_model->get_data('upazilas', $district_id, 'upa_dis_id');
            }

            foreach ($this->data['upazila_list'] as $item) {
                $data_arr[$item->id]['upazila_p'] = $this->Reports_model->get_count_representative(1, 3, $status, NULL, NULL, $item->id);
                $data_arr[$item->id]['pourasava'] = $this->Reports_model->get_count_representative(1, 2, $status, NULL, NULL, $item->id);
                $data_arr[$item->id]['union_p'] = $this->Reports_model->get_count_representative(1, 1, $status, NULL, NULL, $item->id);
            }
            $this->data['result_data'] = $data_arr;
            $this->data['data_status'] = $status;
                // print_r($this->data['division_list']);
                // exit;

            $this->data['headding'] = 'উপজেলাওয়ারী জনপ্রতিনিধির সংখ্যা ভিত্তিক রিপোর্ট';
            $html = $this->load->view('pdf_rep_number_upazila', $this->data, true);
                // $html= $this->load->view('pdf_number_elected_representative', $this->data, true);

            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_number_union') {
            $data_arr = [];
            if(!empty($upazila_id)){
                $this->data['union_list'] = $this->Reports_model->get_data('unions', $upazila_id, 'uni_upa_id');
            }

            foreach ($this->data['union_list'] as $item) {
                $data_arr[$item->id]['union_p'] = $this->Reports_model->get_count_representative(1, 1, $status, NULL, NULL, NULL, $item->id);
            }
            $this->data['result_data'] = $data_arr;
            $this->data['data_status'] = $status;
                // print_r($this->data['division_list']);
                // exit;

            $this->data['headding'] = 'ইউনিয়নওয়ারী জনপ্রতিনিধির সংখ্যা ভিত্তিক রিপোর্ট';
            $html = $this->load->view('pdf_rep_number_union', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_number_designation') {
            $data_arr = [];            

            foreach ($this->input->post('designations') as $key => $val) {
                $data_arr[$val]['design'] = $this->Reports_model->get_item_info('designation', $val, 'id');
                $data_arr[$val]['total'] = $this->Reports_model->get_count_by_designation($val); 
                    //print_r($data_arr[$val]['total']); exit;
            }

            $this->data['results'] = $data_arr;
                // print_r($this->data['division_list']); // exit;

            $this->data['headding'] = 'জনপ্রতিনিধির পদবির সংখ্যা ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_rep_number_designation', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_number_education') {
            $data_arr = [];
            $this->data['edu_qualif_list'] = $this->Reports_model->get_edu_qualification();

            foreach ($this->data['edu_qualif_list'] as $value) {
                $data_arr[$value->id]['edu_name'] = $this->Reports_model->get_item_info('exam_names', $value->id, 'id');
                $data_arr[$value->id]['total'] = $this->Reports_model->get_count_rep_examp(1, $value->id);
            }
            $this->data['results'] = $data_arr;

            $this->data['headding'] = 'জনপ্রতিনিধির শিক্ষাগত যোগ্যতা ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_rep_number_education', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_number_gender') {
            $data_arr = [];

            $data_arr['gender_male'] = $this->Reports_model->get_count_rep_by_gender(1, 'Male');
            $data_arr['gender_female'] = $this->Reports_model->get_count_rep_by_gender(1, 'Female');                
            $this->data['results'] = $data_arr;
                //print_r($this->data['results']); exit;

            $this->data['headding'] = 'জনপ্রতিনিধির নারী/পরুষ ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_rep_number_gender', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_number_age') {
            $data_arr = [];
            $start_age = 18;
            for ($i=$start_age; $i < 60; $i++) { 
                $data_arr[$i] = $this->Reports_model->get_count_age('1', $i);
            }

            $this->data['results'] = $data_arr;
                //print_r($this->data['results']); exit;

            $this->data['headding'] = 'জনপ্রতিনিধির বয়স ভিত্তিক রির্পোট';
            $html = $this->load->view('pdf_rep_number_age', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_number_elected') {
            $data_arr = [];
            $start = 1;
                // for ($i=$start; $i < 6; $i++) { 
                //     $data_arr[$i] = $this->Reports_model->get_count_elected('1', $i);
                // }

            $this->data['results'] = $this->Reports_model->get_many_times_elected('1');
                // $this->data['results'] = $data_arr;
                //print_r($this->data['results']); exit;

            $this->data['headding'] = 'জনপ্রতিনিধির একাধিকবার নির্বাচিতদের রির্পোট';
            $html = $this->load->view('pdf_rep_number_elected', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_nilg_course_complete') {
            $this->data['course_info'] = $this->Common_model->get_info('training_course', $course_id);
            $this->data['results'] = $this->Reports_model->get_nilg_course_complete_list('1', $course_id);

            $this->data['headding'] = 'জনপ্রতিনিধির এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণের তালিকা';
            $html = $this->load->view('pdf_rep_nilg_course_complete', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
                // $mpdf->output('report.pdf', "D");

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_list_city') {
            $this->data['results'] = $this->Reports_model->get_list_personal_data(1, 5, NULL, $district_id);

            $this->data['headding'] = 'সিটি কর্পোরেশনের জনপ্রতিনিধির তালিকা';
            $html = $this->load->view('pdf_datasheet_list', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_list_district') {
            $this->data['results'] = $this->Reports_model->get_list_personal_data(1, 4, NULL, $district_id);

            $this->data['headding'] = 'জেলা পরিষদের জনপ্রতিনিধির তালিকা';
            $html = $this->load->view('pdf_datasheet_list', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_list_upazila') {
            $this->data['results'] = $this->Reports_model->get_list_personal_data(1, 3, NULL, NULL, $upazila_id);

            $this->data['headding'] = 'উপজেলা পরিষদের জনপ্রতিনিধির তালিকা';
            $html = $this->load->view('pdf_datasheet_list', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_list_pourashava') {
            $this->data['results'] = $this->Reports_model->get_list_personal_data(1, 2, NULL, NULL, $upazila_id);

            $this->data['headding'] = 'পৌরসভার জনপ্রতিনিধির তালিকা';
            $html = $this->load->view('pdf_datasheet_list', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();

        }elseif($this->input->post('btnsubmit') == 'pdf_rep_list_union') {
            $this->data['results'] = $this->Reports_model->get_list_personal_data(1, 1, NULL, NULL, NULL, $union_id);

                // print_r($this->input->post());
                // echo '<pre>';
                // print_r($this->data['results']); exit;

            $this->data['headding'] = 'ইউনিয়ন পরিষদের জনপ্রতিনিধির তালিকা';
            $html = $this->load->view('pdf_datasheet_list', $this->data, true);

                //Generate PDF
            $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
            $mpdf->WriteHtml($html);
            $mpdf->output();
        }

    }
}


public function details($id){

    $results = $this->Personal_datas_model->get_info($id);

    $this->data['info'] = $results['info'];
    $this->data['experience'] = $results['experience'];
    $this->data['promotion'] = $results['promotion'];
    $this->data['education'] = $results['education'];
    $this->data['nilg_training'] = $results['nilg_training'];
    $this->data['local_training'] = $results['local_training'];
    $this->data['foreign_training'] = $results['foreign_training'];

    $this->data['meta_title'] = 'বাক্তিগত ডাটা সীটের বিস্তারিত তথ্য';
    $this->data['subview'] = 'details';
    $this->load->view('backend/_layout_main', $this->data);
}

public function get_columns()
{
  $thismodel=$this->this_model();

  $columslist=$this->$thismodel->getcolumnlist();
  $filtercolumns=array();
  for($i=0;$i<sizeof($columslist);$i++)
  {
     if($columslist[$i]['Field']=='id') continue;
     $filtercolumns[]=$columslist[$i];
 }
 return $filtercolumns;
}

public function this_model()
{
        // return $this->->load->model('Personal_datas_model');
  return ucwords('Personal_datas_model');
}

public function this_table()
{
  return $this->uri->segment(1);
}


public function add() {
    	//Validation
   $this->form_validation->set_rules('name_bangla', 'name bangla', 'required|trim');
   $this->form_validation->set_rules('name_english', 'name english', 'required|trim');
   $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
   $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');
   $this->form_validation->set_rules('date_of_birth', 'date of birth', 'required|trim');
   $this->form_validation->set_rules('gender', 'gender', 'required|trim');
   $this->form_validation->set_rules('marital_status_id', 'marital status', 'required|trim');
   $this->form_validation->set_rules('telephone_mobile', 'phone number', 'required|trim');
   $this->form_validation->set_rules('permanent_add', 'permanent address', 'required|trim');
   $this->form_validation->set_rules('present_add', 'present address', 'required|trim');

   $this->form_validation->set_rules('data_sheet_type', 'data sheet type', 'required|trim');
   $this->form_validation->set_rules('division_id', 'division ', 'required|trim');
   $this->form_validation->set_rules('district_id', 'district ', 'required|trim');
   $this->form_validation->set_rules('upa_tha_id', 'upazial thana', 'required|trim');
   $this->form_validation->set_rules('first_org_id', 'first organization', 'required|trim');
   $this->form_validation->set_rules('first_desig_id', 'first designation', 'required|trim');
   $this->form_validation->set_rules('first_attend_date', 'first attend date', 'required|trim');
   $this->form_validation->set_rules('curr_org_id', 'current organization', 'required|trim');
   $this->form_validation->set_rules('curr_desig_id', 'current designation', 'required|trim');
   $this->form_validation->set_rules('curr_attend_date', 'current attend date', 'required|trim');

   $this->form_validation->set_rules('national_id', 'national id', 'required|trim|is_unique[personal_datas.national_id]');
   $this->form_validation->set_rules('password', 'password', 'required|trim');

   $nid = $this->input->post('national_id');
   $email    = strtolower($this->input->post('email'));
   $identity = $nid;
   $password = $this->input->post('password');


   if ($this->form_validation->run() == true){
    $form_data = array(
        'data_sheet_type' => $this->input->post('data_sheet_type'),
        'name_bangla' => $this->input->post('name_bangla'),
        'name_english' => $this->input->post('name_english'),
        'father_name' => $this->input->post('father_name'),
        'mother_name' => $this->input->post('mother_name'),
        'national_id' => $nid,
        'gender' => $this->input->post('gender'),
        'date_of_birth' => $this->input->post('date_of_birth'),
        'marital_status_id' => $this->input->post('marital_status_id'),
        'son_number' => $this->input->post('son_number'),
        'daughter_number' => $this->input->post('daughter_number'),
        'division_id' => $this->input->post('division_id'),
        'district_id' => $this->input->post('district_id'),
        'upa_tha_id' => $this->input->post('upa_tha_id'),
        'telephone_mobile' => $this->input->post('telephone_mobile'),
        'email' => $email,
        'permanent_add' => $this->input->post('permanent_add'),
        'present_add' => $this->input->post('present_add'),                
        'first_org_id' => $this->input->post('first_org_id'),
        'first_desig_id' => $this->input->post('first_desig_id'),
        'first_attend_date' => $this->input->post('first_attend_date'),
        'curr_org_id' => $this->input->post('curr_org_id'),
        'curr_desig_id' => $this->input->post('curr_desig_id'),
        'curr_attend_date' => $this->input->post('curr_attend_date'),
        'how_much_elected' => $this->input->post('how_much_elected'),
        'job_per_date' => $this->input->post('job_per_date'),
        'retirement_prl_date' => $this->input->post('retirement_prl_date'),
        'retirement_date' => $this->input->post('retirement_date'),
        'created' => date('Y-m-d')        
        );          
            // print_r($form_data); exit;

    if($this->Common_model->save('personal_datas', $form_data)){   

                //last personal data id
       $lastID = $this->db->insert_id();

                //insert user table
       $additional_data = array(
        'nid'        => $nid,
        'first_name' => $this->input->post('name_bangla'),
        'username'   => $identity,
        'email'      => $email,
        'user_type'  => '3',
        'active'     => 1
        );
       $this->ion_auth->register($identity, $password, $email, $additional_data);

                // Experiance 
       for ($i=0; $i<sizeof($_POST['exp_org_id']); $i++) { 
           $experience_data = array(
            'data_id' => $lastID,
            'exp_org_id' => $_POST['exp_org_id'][$i],
            'exp_desig_id' => $_POST['exp_desig_id'][$i],
            'exp_duration' => $_POST['exp_duration'][$i],
            );
           $this->Common_model->save('per_experience', $experience_data);
       }

                // Promotion 
       for ($i=0; $i<sizeof($_POST['promo_desig_id']); $i++) { 
        $promotion_data = array(
            'data_id' => $lastID,
            'promo_desig_id' => $_POST['promo_desig_id'][$i],
            'promo_org_id' => $_POST['promo_org_id'][$i],
            'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
            'promo_comments' => $_POST['promo_comments'][$i],
            );
        $this->Common_model->save('per_promotion', $promotion_data);
    }

                // Education 
    for ($i=0; $i<sizeof($_POST['edu_exam_id']); $i++) { 
        $education_data = array(
            'data_id' => $lastID,
            'edu_exam_id' => $_POST['edu_exam_id'][$i],
            'edu_pass_year' => $_POST['edu_pass_year'][$i],
            'edu_subject_id' => $_POST['edu_subject_id'][$i],
            'edu_board_id' => $_POST['edu_board_id'][$i],
            );
        $this->Common_model->save('per_education', $education_data);
    }

                // NILG training
    for ($i=0; $i<sizeof($_POST['nilg_desig_id']); $i++) { 
        $local_org_data = array(
            'data_id' => $lastID,
            'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
            'nilg_course_id' => $_POST['nilg_course_id'][$i],
            'nilg_time_duration' => $_POST['nilg_time_duration'][$i],
            'nilg_duration' => $_POST['nilg_duration'][$i],
            );
        $this->Common_model->save('per_nilg_training', $local_org_data);
    }

                // Local organization training
    for ($i=0; $i<sizeof($_POST['local_course_id']); $i++) { 
        $local_org_data = array(
            'data_id' => $lastID,
            'local_course_id' => $_POST['local_course_id'][$i],
            'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
            'local_time_duration' => $_POST['local_time_duration'][$i],
            'local_duration' => $_POST['local_duration'][$i],
            );
        $this->Common_model->save('per_local_org_training', $local_org_data);
    }

                // Foreign organization training
    for ($i=0; $i<sizeof($_POST['foreign_course_id']); $i++) { 
        $foreign_org_data = array(
            'data_id' => $lastID,
            'foreign_course_id' => $_POST['foreign_course_id'][$i],
            'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
            'foreign_time_duration' => $_POST['foreign_time_duration'][$i],
            'foreign_duration' => $_POST['foreign_duration'][$i],
            );
        $this->Common_model->save('per_foreign_org_training', $foreign_org_data);
    }


    $this->session->set_flashdata('success', 'New presonal data insert successfully.');
    redirect($this->this_table().'/all/'.$this->input->post('data_sheet_type'));
}
}

$data['userDetails'] = $this->Common_model->get_user_details();
$users_groups = $this->ion_auth_model->get_users_groups()->result();
$groups_array = array();
foreach ($users_groups as $group){
    $groups_array[$group->id] = $group->description;
}
$this->data['userGroups'] = implode(',', $groups_array);

$data['organization_type'] = $this->Common_model->get_organization_type();
$data['organizations'] = $this->Common_model->get_organizations();
$data['designation'] = $this->Common_model->get_designation();
$data['marital_status'] = $this->Common_model->get_marital_status();
$data['nilg_trainings'] = $this->Common_model->get_nilg_trainings();

$data['divisions'] = $this->Common_model->get_division();         
$data['districts'] = $this->General_setting_model->get_district(); 
$data['exams'] = $this->Exam_names_model->get_all('*','exam_names','1');
$data['subjects'] = $this->Exam_names_model->get_all('*','subjects','1');
$data['boards'] = $this->Exam_names_model->get_all('*','boards','1');

        // View
$data['meta_title'] = lang('personal_data_sheet_add');
$data['subview'] = 'add';
$this->load->view('backend/_layout_main', $data);
}

public function edit($id){
    $this->data['userDetails'] = $this->Common_model->get_user_details();

        //Validation
    $this->form_validation->set_rules('name_bangla', 'name bangla', 'required|trim');
    $this->form_validation->set_rules('name_english', 'name english', 'required|trim');
    $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
    $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');
    $this->form_validation->set_rules('date_of_birth', 'date of birth', 'required|trim');
    $this->form_validation->set_rules('gender', 'gender', 'required|trim');
    $this->form_validation->set_rules('marital_status_id', 'marital status', 'required|trim');
    $this->form_validation->set_rules('telephone_mobile', 'phone number', 'required|trim');
    $this->form_validation->set_rules('permanent_add', 'permanent address', 'required|trim');
    $this->form_validation->set_rules('present_add', 'present address', 'required|trim');

        // $this->form_validation->set_rules('data_sheet_type', 'data sheet type', 'required|trim');
        // $this->form_validation->set_rules('division_id', 'division ', 'required|trim');
        // $this->form_validation->set_rules('district_id', 'district ', 'required|trim');
        // $this->form_validation->set_rules('upa_tha_id', 'upazial thana', 'required|trim');
        // $this->form_validation->set_rules('first_org_id', 'first organization', 'required|trim');
        // $this->form_validation->set_rules('first_desig_id', 'first designation', 'required|trim');
        // $this->form_validation->set_rules('first_attend_date', 'first attend date', 'required|trim');
        // $this->form_validation->set_rules('curr_org_id', 'current organization', 'required|trim');
        // $this->form_validation->set_rules('curr_desig_id', 'current designation', 'required|trim');
        // $this->form_validation->set_rules('curr_attend_date', 'current attend date', 'required|trim');

    if ($this->form_validation->run() == true){
        $form_data = array(
                // 'data_sheet_type' => $this->input->post('data_sheet_type'),
            'name_bangla' => $this->input->post('name_bangla'),
            'name_english' => $this->input->post('name_english'),
            'father_name' => $this->input->post('father_name'),
            'mother_name' => $this->input->post('mother_name'),
            'gender' => $this->input->post('gender'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'marital_status_id' => $this->input->post('marital_status_id'),
            'son_number' => $this->input->post('son_number'),
            'daughter_number' => $this->input->post('daughter_number'),
            'division_id' => $this->input->post('division_id'),
            'district_id' => $this->input->post('district_id'),
            'upa_tha_id' => $this->input->post('upa_tha_id'),
            'telephone_mobile' => $this->input->post('telephone_mobile'),
            'email' => $this->input->post('email'),
            'permanent_add' => $this->input->post('permanent_add'),
            'present_add' => $this->input->post('present_add'),                
            'first_org_id' => $this->input->post('first_org_id'),
            'first_desig_id' => $this->input->post('first_desig_id'),
            'first_attend_date' => $this->input->post('first_attend_date'),
            'curr_org_id' => $this->input->post('curr_org_id'),
            'curr_desig_id' => $this->input->post('curr_desig_id'),
            'curr_attend_date' => $this->input->post('curr_attend_date'),
            'how_much_elected' => $this->input->post('how_much_elected'),
            'job_per_date' => $this->input->post('job_per_date'),
            'retirement_prl_date' => $this->input->post('retirement_prl_date'),
            'retirement_date' => $this->input->post('retirement_date'),
            'modified' => date('Y-m-d')        
            ); 

            // echo '<pre>';
            // print_r($_POST);
             // print_r($form_data); exit;

        if($this->Common_model->edit('personal_datas', $id, 'id', $form_data)){

                    // Experiance 
            for ($i=0; $i<sizeof($_POST['exp_org_id']); $i++) { 
                        //check exists data
                $data_exists = $this->Common_model->exists('per_experience', 'id', $_POST['hide_exp_id'][$i]);
                if($data_exists){
                    $data = array(
                        'exp_org_id' => $_POST['exp_org_id'][$i],
                        'exp_desig_id' => $_POST['exp_desig_id'][$i],
                        'exp_duration' => $_POST['exp_duration'][$i],
                        ); 
                    $this->Common_model->edit('per_experience', $_POST['hide_exp_id'][$i], 'id', $data);
                }else{
                    $data = array(
                        'data_id' => $id,
                        'exp_org_id' => $_POST['exp_org_id'][$i],
                        'exp_desig_id' => $_POST['exp_desig_id'][$i],
                        'exp_duration' => $_POST['exp_duration'][$i],
                        );
                    $this->Common_model->save('per_experience', $data);
                }
            }

                    // Promotion 
            for ($i=0; $i<sizeof($_POST['promo_desig_id']); $i++) { 
                        //check exists data
                $data_exists = $this->Common_model->exists('per_promotion', 'id', $_POST['hide_promo_id'][$i]);
                if($data_exists){
                    $data = array(
                        'promo_desig_id' => $_POST['promo_desig_id'][$i],
                        'promo_org_id' => $_POST['promo_org_id'][$i],
                        'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
                        'promo_comments' => $_POST['promo_comments'][$i],
                        ); 
                    $this->Common_model->edit('per_promotion', $_POST['hide_promo_id'][$i], 'id', $data);
                }else{
                    $data = array(
                        'data_id' => $id,
                        'promo_desig_id' => $_POST['promo_desig_id'][$i],
                        'promo_org_id' => $_POST['promo_org_id'][$i],
                        'promo_salary_ratio' => $_POST['promo_salary_ratio'][$i],
                        'promo_comments' => $_POST['promo_comments'][$i],
                        );
                    $this->Common_model->save('per_promotion', $data);
                }
            }

                    // Education 
            for ($i=0; $i<sizeof($_POST['edu_exam_id']); $i++) { 
                        //check exists data
                $data_exists = $this->Common_model->exists('per_education', 'id', $_POST['hide_edu_id'][$i]);
                if($data_exists){
                    $data = array(
                        'edu_exam_id' => $_POST['edu_exam_id'][$i],
                        'edu_pass_year' => $_POST['edu_pass_year'][$i],
                        'edu_subject_id' => $_POST['edu_subject_id'][$i],
                        'edu_board_id' => $_POST['edu_board_id'][$i],
                        ); 
                    $this->Common_model->edit('per_education', $_POST['hide_edu_id'][$i], 'id', $data);
                }else{
                    $data = array(
                        'data_id' => $id,
                        'edu_exam_id' => $_POST['edu_exam_id'][$i],
                        'edu_pass_year' => $_POST['edu_pass_year'][$i],
                        'edu_subject_id' => $_POST['edu_subject_id'][$i],
                        'edu_board_id' => $_POST['edu_board_id'][$i],
                        );
                    $this->Common_model->save('per_education', $data);
                }
            }

                    // NILG Training 
            for ($i=0; $i<sizeof($_POST['nilg_desig_id']); $i++) { 
                        //check exists data
                $data_exists = $this->Common_model->exists('per_nilg_training', 'id', $_POST['hide_nilg_training_id'][$i]);
                if($data_exists){
                    $data = array(
                        'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
                        'nilg_course_id' => $_POST['nilg_course_id'][$i],
                        'nilg_time_duration' => $_POST['nilg_time_duration'][$i],
                        'nilg_duration' => $_POST['nilg_duration'][$i],
                        ); 
                    $this->Common_model->edit('per_nilg_training', $_POST['hide_nilg_training_id'][$i], 'id', $data);
                }else{
                    $data = array(
                        'data_id' => $id,
                        'nilg_desig_id' => $_POST['nilg_desig_id'][$i],
                        'nilg_course_id' => $_POST['nilg_course_id'][$i],
                        'nilg_time_duration' => $_POST['nilg_time_duration'][$i],
                        'nilg_duration' => $_POST['nilg_duration'][$i],
                        );
                    $this->Common_model->save('per_nilg_training', $data);
                }
            }

                    // Local Training 
            for ($i=0; $i<sizeof($_POST['local_course_id']); $i++) { 
                        //check exists data
                $data_exists = $this->Common_model->exists('per_local_org_training', 'id', $_POST['hide_local_training_id'][$i]);
                if($data_exists){
                    $data = array(
                        'local_course_id' => $_POST['local_course_id'][$i],
                        'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                        'local_time_duration' => $_POST['local_time_duration'][$i],
                        'local_duration' => $_POST['local_duration'][$i],
                        ); 
                    $this->Common_model->edit('per_local_org_training', $_POST['hide_local_training_id'][$i], 'id', $data);
                }else{
                    $data = array(
                        'data_id' => $id,
                        'local_course_id' => $_POST['local_course_id'][$i],
                        'local_training_org_name_adds' => $_POST['local_training_org_name_adds'][$i],
                        'local_time_duration' => $_POST['local_time_duration'][$i],
                        'local_duration' => $_POST['local_duration'][$i],
                        );
                    $this->Common_model->save('per_local_org_training', $data);
                }
            }

                    // Foreign Training 
            for ($i=0; $i<sizeof($_POST['foreign_course_id']); $i++) { 
                        //check exists data
                $data_exists = $this->Common_model->exists('per_foreign_org_training', 'id', $_POST['hide_foreign_training_id'][$i]);
                if($data_exists){
                    $data = array(
                        'foreign_course_id' => $_POST['foreign_course_id'][$i],
                        'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                        'foreign_time_duration' => $_POST['foreign_time_duration'][$i],
                        'foreign_duration' => $_POST['foreign_duration'][$i],
                        ); 
                    $this->Common_model->edit('per_foreign_org_training', $_POST['hide_foreign_training_id'][$i], 'id', $data);
                }else{
                    $data = array(
                        'data_id' => $id,
                        'foreign_course_id' => $_POST['foreign_course_id'][$i],
                        'foreign_training_org_name_adds' => $_POST['foreign_training_org_name_adds'][$i],
                        'foreign_time_duration' => $_POST['foreign_time_duration'][$i],
                        'foreign_duration' => $_POST['foreign_duration'][$i],
                        );
                    $this->Common_model->save('per_foreign_org_training', $data);
                }
            }

            $this->session->set_flashdata('success', 'Update information successfully.');
            redirect('personal_datas/edit/'.$id);
        }
    }


    $results = $this->Personal_datas_model->get_info($id);

    $this->data['info'] = $results['info'];
    $this->data['experience'] = $results['experience'];
    $this->data['promotion'] = $results['promotion'];
    $this->data['education'] = $results['education'];
    $this->data['nilg_training'] = $results['nilg_training'];
    $this->data['local_training'] = $results['local_training'];
    $this->data['foreign_training'] = $results['foreign_training'];


    $this->data['organization_type'] = $this->Common_model->get_organization_type();
    $this->data['organizations'] = $this->Common_model->get_organizations();
    $this->data['designation'] = $this->Common_model->get_designation();
    $this->data['marital_status'] = $this->Common_model->get_marital_status();
    $this->data['nilg_trainings'] = $this->Common_model->get_nilg_trainings();

    $this->data['divisions'] = $this->Common_model->get_division();         
    $this->data['districts'] = $this->Common_model->get_district();    
    $this->data['up_thanas'] = $this->Common_model->get_upazila_thana();  
        // $this->data['districts'] = $this->General_setting_model->get_district(); 

    $this->data['exams_2'] = $this->Common_model->get_exams();
    $this->data['subjects_2'] = $this->Common_model->get_subjects();
    $this->data['boards_2'] = $this->Common_model->get_boards();

    $this->data['exams'] = $this->Exam_names_model->get_all('*','exam_names','1');
    $this->data['subjects'] = $this->Exam_names_model->get_all('*','subjects','1');
    $this->data['boards'] = $this->Exam_names_model->get_all('*','boards','1');

        // View
    $this->data['meta_title'] = lang('personal_data_sheet_edit');
    $this->data['subview'] = 'edit';
    $this->load->view('backend/_layout_main', $this->data);
}



public function all($typid=1)
{
   $data['userDetails'] = $this->Common_model->get_user_details();
   $thismodel=$this->this_model();
		// ,'district_id','present_add','curr_desig_id'

   $data['printcolumn']=array('name_bangla', 'national_id', 'dis_name_bn', 'upa_name_bn', 'desig_name', 'present_add' );

   $data['all_list'] = $this->$thismodel->get_all_data_sheet($typid);

   if($typid==1)
    $data['meta_title'] = lang('personal_datas_gov_list');
else
 $data['meta_title'] = lang('personal_datas_emp_list');

$data['subview'] = 'all';
$this->load->view('backend/_layout_main', $data);
}   

public function jonoprothinidhi_report()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();

    $typid=1;

    $data['printcolumn']=array('name_bangla', 'national_id', 'dis_name_bn', 'upa_name_bn', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

    $data['all_list'] = $this->$thismodel->get_all_data_sheet($typid);
        // $data['districts'] = $this->General_setting_model->get_district();
    $data['districts'] = $this->Common_model->get_district();
    $data['designation'] = $this->Common_model->get_designation();

    $data['meta_title'] = lang('jonoprothinidhi_report');

    $data['subview'] = 'jonoprothinidhi_report';
    $this->load->view('backend/_layout_main', $data);
}

public function individual_report()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();

    $typid=1;

    $data['printcolumn']=array('name_bangla', 'national_id', 'dis_name_bn', 'upa_name_bn', 'how_much_elected', 'age', 'gender');

        // $search_data = array(''); , $search_data = NULL

    $data['all_list'] = $this->$thismodel->get_all_data_sheet($typid);
        // $data['districts'] = $this->General_setting_model->get_district();
    $data['districts'] = $this->Common_model->get_district();
    $data['designation'] = $this->Common_model->get_designation();

    $data['meta_title'] = 'Individual Report';

    $data['subview'] = 'individual_report';
    $this->load->view('backend/_layout_main', $data);
}

public function no_training_yet()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();

    $typid=1;

    $data['printcolumn']=array('name_bangla', 'national_id', 'dis_name_bn', 'upa_name_bn', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

    $data['all_list'] = $this->$thismodel->get_not_yet_training();
        // $data['districts'] = $this->General_setting_model->get_district();
    $data['districts'] = $this->Common_model->get_district();
    $data['designation'] = $this->Common_model->get_designation();

    $data['meta_title'] = lang('no_training_yet');

    $data['subview'] = 'no_training_yet';
    $this->load->view('backend/_layout_main', $data);
}
public function got_training()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();

    $typid=1;

    $data['printcolumn']=array('name_bangla', 'national_id', 'dis_name_bn', 'upa_name_bn', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

    $data['all_list'] = $this->$thismodel->got_training();
    $data['districts'] = $this->General_setting_model->get_district();
    $data['designation'] = $this->Common_model->get_designation();

    $data['meta_title'] = lang('got_training');

    $data['subview'] = 'no_training_yet';
    $this->load->view('backend/_layout_main', $data);
}

public function kormokorta_report()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();

    $typid=2;

    $data['printcolumn']=array('name_bangla', 'national_id', 'dis_name_bn', 'upa_name_bn', 'desig_name', 'present_add', 'gender');

        // $search_data = array(''); , $search_data = NULL

    $data['all_list'] = $this->$thismodel->get_all_data_sheet($typid);
    $data['districts'] = $this->General_setting_model->get_district();
    $data['designation'] = $this->Common_model->get_designation();

    $data['meta_title'] = lang('kormokorta_report');

    $data['subview'] = 'kormokorta_report';
    $this->load->view('backend/_layout_main', $data);
}

public function trainer_reports_sum()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','1');
    $data['total_data']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','1');
    $data['total_count']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=4');
    $data['buniad_count']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=5');
    $data['proshason_count']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=6');
    $data['aien_count']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=15');
    $data['Basic_Computer_Application_Literacy']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=17');
    $data['Basic_Training_Course']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=20');
    $data['Computer_Application_English_Language']=$cnt[0]['cnt'];
    
    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=18');
    $data['Training_on_Disaster_Control_Management']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=14');
    $data['audit_apotti_nispotti']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=6');
    $data['ayinbidi_obohito_koron']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=25');
    $data['bidhi_bebostapona_o_hisab_nirikha']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=7');
    $data['union_porisod_bebosthapona']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=19');
    $data['u_parisod_ayn_O_prosason_refregeration']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=21');
    $data['up_bidhimalasamuho_obohitokoron']=$cnt[0]['cnt'];


    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=12');
    $data['nambi_bebosthapona']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=24');
    $data['ppr_training']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=05');
    $data['prosason_obohitokoron_course']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=23');
    $data['foundaion_traing']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=22');
    $data['bi_60_tomo_bunniadi_course']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=08');
    $data['bises_prosikhon']=$cnt[0]['cnt'];


    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=04');
    $data['bunadi_prosikhon_course']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=13');
    $data['moulo_office_prosason']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=26');
    $data['moulik_prosikhon']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=11');
    $data['tho_exicutive_megistate_prosikhon']=$cnt[0]['cnt'];
    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=10');
    $data['_tomo_bunniadi_course']=$cnt[0]['cnt'];
    $cnt = $this->$thismodel->get_all('distinct data_sheet_id,count(*) as cnt','trainers','nilg_training_id=9');
    $data['tomo_ayn_O_prosason_course']=$cnt[0]['cnt'];


    $cnt = $this->Common_model->get_all('count(*) as cnt','nilg_trainings','1');
    $data['total_course']=$cnt[0]['cnt'];


    $data['no_course']=$data['total_data']-$data['total_count'];

    $data['meta_title'] = lang('proshikkhon_report_summary');
    $data['subview'] = 'trainer_reports_sum';
    $this->load->view('backend/_layout_main', $data);
}

public function exam_report()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','1');
    $data['total_data']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','1');
    $data['total_data']=$cnt[0]['cnt'];

    $data['exams'] = $this->$thismodel->get_all('*','exam_names',1);
    $data['exam_cnt'] = $this->$thismodel->exam_cnt();

    $exam_count[] = '';
    for ($i=0; $i < count($data['exam_cnt']); $i++) { 
        $exam_count[] = $data['exam_cnt'][$i]->data_cnt;
    }

        //echo $data['total_data_count'] = $exam_count;// exit;

    $data['meta_title'] = 'শিক্ষা ভিত্তিক রিপোর্ট';

    $data['subview'] = 'exam_report';
    $this->load->view('backend/_layout_main', $data);
}    

public function jonoprothinidhi_report_summ()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();

    $typid=1;

    $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 1);
    $data['union'] = $org_counter[0]['org_count'];

    $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 2);
    $data['upazila'] = $org_counter[0]['org_count'];

    $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 3);
    $data['zila'] = $org_counter[0]['org_count'];

    $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 4);
    $data['pouroshova'] = $org_counter[0]['org_count'];

    $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 5);
    $data['city_corporation'] = $org_counter[0]['org_count'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1"');
    $data['total_data']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=1');
    $data['total_charman']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=6');
    $data['total_mayor']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=2');
    $data['total_member_normal']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=4');
    $data['vice_charirman']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=18');
    $data['office_sohokari']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=27');
    $data['com_mudrakhorik']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=12');
    $data['union_somajkormi']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=17');
    $data['upo_sohokari_prokusoli']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=46');
    $data['upzela_ekhademic_super']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=31');
    $data['upzela_ekhademic_supervisor']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=33');
    $data['upzela_nirbahi_officer']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=29');
    $data['upzela_poriber_porikolpona_sohokari']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=37');
    $data['upzela_polli_unnoyon']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=20');
    $data['ten']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=24');
    $data['eleven']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=30');
    $data['twelve']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=42');
    $data['tharteen']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=25');
    $data['fourteen']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=21');
    $data['fiften']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=51');
    $data['sixten']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=45');
    $data['seventeen']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=10');
    $data['eighteen']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=8');
    $data['nineteen']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=7');
    $data['twenty']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=14');
    $data['twentyone']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=26');
    $data['twentytwo']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=1');
    $data['twentythree']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=48');
    $data['twentyfour']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=28');
    $data['twentyfive']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=22');
    $data['twentysix']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=44');
    $data['twentyseven']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=15');
    $data['twentyeight']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=11');
    $data['twentynine']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=47');
    $data['tharty']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=34');
    $data['thartyone']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=13');
    $data['thartytwo']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=43');
    $data['thartythree']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=5');
    $data['thartyfour']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=4');
    $data['thartyfive']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=6');
    $data['thartysix']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=50');
    $data['thartyseven']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=9');
    $data['thartyeight']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=3');
    $data['thartynine']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=32');
    $data['fourtyone']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=49');
    $data['fourtytwo']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=40');
    $data['fourtythree']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=16');
    $data['fourtyfour']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=41');
    $data['fourtyfive']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=23');
    $data['fourtysix']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=19');
    $data['fourtyseven']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=35');
    $data['fourtyeight']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=36');
    $data['fourtynine']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="1" and curr_desig_id=39');
    $data['fifty']=$cnt[0]['cnt'];

    $data['meta_title'] = lang('jonoprothinidhi_report_summ'); 

    $data['subview'] = 'jonoprothinidhi_report_summ';
    $this->load->view('backend/_layout_main', $data);
}

public function kormokorta_report_summ()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2"');
    $data['total_data']=$cnt[0]['cnt'];

    $typid=2;

    $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 1);
    $data['union'] = $org_counter[0]['org_count'];

    $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 2);
    $data['upazila'] = $org_counter[0]['org_count'];

    $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 3);
    $data['zila'] = $org_counter[0]['org_count'];

    $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 4);
    $data['pouroshova'] = $org_counter[0]['org_count'];

    $org_counter = $this->$thismodel->get_all_data_by_org_type($typid, 5);
    $data['city_corporation'] = $org_counter[0]['org_count'];

        // Other's data
    $data['other_data'] = $data['total_data'] - ($data['union']+$data['upazila']+$data['zila']+$data['pouroshova']+$data['city_corporation']);


    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2"');
    $data['total_data']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=1');
    $data['total_charman']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=6');
    $data['total_mayor']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=2');
    $data['total_member_normal']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=4');
    $data['vice_charirman']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=18');
    $data['office_sohokari']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=27');
    $data['com_mudrakhorik']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=12');
    $data['union_somajkormi']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=17');
    $data['upo_sohokari_prokusoli']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=46');
    $data['upzela_ekhademic_super']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=31');
    $data['upzela_ekhademic_supervisor']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=33');
    $data['upzela_nirbahi_officer']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=29');
    $data['upzela_poriber_porikolpona_sohokari']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=37');
    $data['upzela_polli_unnoyon']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=20');
    $data['ten']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=24');
    $data['eleven']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=30');
    $data['twelve']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=42');
    $data['tharteen']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=25');
    $data['fourteen']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=21');
    $data['fiften']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=51');
    $data['sixten']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=45');
    $data['seventeen']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=10');
    $data['eighteen']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=8');
    $data['nineteen']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=7');
    $data['twenty']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=14');
    $data['twentyone']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=26');
    $data['twentytwo']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=1');
    $data['twentythree']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=48');
    $data['twentyfour']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=28');
    $data['twentyfive']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=22');
    $data['twentysix']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=44');
    $data['twentyseven']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=15');
    $data['twentyeight']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=11');
    $data['twentynine']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=47');
    $data['tharty']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=34');
    $data['thartyone']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=13');
    $data['thartytwo']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=43');
    $data['thartythree']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=5');
    $data['thartyfour']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=4');
    $data['thartyfive']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=6');
    $data['thartysix']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=50');
    $data['thartyseven']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=9');
    $data['thartyeight']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=3');
    $data['thartynine']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=32');
    $data['fourtyone']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=49');
    $data['fourtytwo1']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=40');
    $data['fourtythree']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=16');

    $data['fourtyfour']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=41');
    $data['fourtyfive']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=23');
    $data['fourtysix']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=19');
    $data['fourtyseven']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=35');
    $data['fourtyeight']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=36');
    $data['fourtynine']=$cnt[0]['cnt'];

    $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','data_sheet_type="2" and curr_desig_id=39');
    $data['fifty']=$cnt[0]['cnt'];

    $data['meta_title'] = 'কর্মকর্তা/কর্মচারীর সামারি রিপোর্ট'; 

    $data['subview'] = 'kormokorta_report_summ';
    $this->load->view('backend/_layout_main', $data);
}


public function dbdateformat($dt)
{
  $tmpdt=$dt;
  $dt=explode('-',$dt);
  if(sizeof($dt)>1)
     return $dt[2].'-'.$dt[1].'-'.$dt[0];
 else
     return $tmpdt;
}
public function getpostdate()
{
  $thismodel=$this->this_model();
  $data['allcolumns'] = $this->$thismodel->getcolumnlist();

  $accountInfo=array();
  for($i=0;$i<sizeof($data['allcolumns']);$i++)
  {
     if($data['allcolumns'][$i]['Type']=='date')
        $accountInfo[$data['allcolumns'][$i]['Field']]=$this->dbdateformat($this->input->post($data['allcolumns'][$i]['Field'], TRUE));
    else
        $accountInfo[$data['allcolumns'][$i]['Field']]=$this->input->post($data['allcolumns'][$i]['Field'], TRUE);
}   
		//print_r($accountInfo);exit;
return $accountInfo;
}

    //This function is use for Listing all account head.
public function return_columnsonly()
{
  $thismodel=$this->this_model();
  $columns=$this->$thismodel->getcolumnlist();
  $colarray=array();
  for($i=0;$i<sizeof($columns);$i++)
  {
     $colarray[]=$columns[$i]['Field'];
 }
 return $colarray;
}

public function delete(){
  $thismodel=$this->this_model();
  $id = $this->input->get('id'); 
  if ($this->db->delete($this->this_table(), array('id' => $id))) {
    $this->session->set_flashdata('message', 'Deleted Successful'); 
    redirect($this->this_table().'/all');
}

}

function ajax_get_nid(){
        // echo 'true';
    $id = $_POST['nid'];
    echo $this->Common_model->exists_national_id($id);
}

function ajax_get_district_by_div($id){
    header('Content-Type: application/x-json; charset=utf-8');
    echo (json_encode($this->Personal_datas_model->get_district_by_div_id($id)));
}

function ajax_get_upa_tha_by_dis($dis_id){
    	// echo $dis_id; exit;
    header('Content-Type: application/x-json; charset=utf-8');
    		// print_r($this->$thismodel->get_upa_tha_by_dis_id($dis_id));

    echo (json_encode($this->Personal_datas_model->get_upa_tha_by_dis_id($dis_id)));
}

function ajax_get_organization_by_up_th_id($id){
    header('Content-Type: application/x-json; charset=utf-8');
    echo (json_encode($this->Personal_datas_model->get_organization_by_up_th_id($id)));
}

function ajax_experiance_del($id){
    $this->Common_model->delete('per_experience', 'id', $id);
    echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
}

function ajax_promotion_del($id){
    $this->Common_model->delete('per_promotion', 'id', $id);
    echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
}
function ajax_education_del($id){
    $this->Common_model->delete('per_education', 'id', $id);
    echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
}
function ajax_nilg_training_del($id){
    $this->Common_model->delete('per_nilg_training', 'id', $id);
    echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
}
function ajax_local_training_del($id){
    $this->Common_model->delete('per_local_org_training', 'id', $id);
    echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
}
function ajax_foreign_training_del($id){
    $this->Common_model->delete('per_foreign_org_training', 'id', $id);
    echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
}

public function trainer_reports()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();
    $select='t.id, nt.course_name, pd.name_bangla, t.entry_date, pd.national_id, pd.data_sheet_type';
    $from='`trainers` t, nilg_trainings nt, personal_datas pd';
    $where='t.`nilg_training_id`=nt.id and t.`data_sheet_id`=pd.id';

        //$data['printcolumn']=$this->return_columnsonly();
    $data['printcolumn']=array('id','course_name','name_bangla', 'data_sheet_type', 'national_id', 'entry_date');
        //print_r($data['printcolumn']);exit;array('id');

    $data['all_courses'] = $this->Common_model->get_all('*','nilg_trainings','1');
    $data['course_name_id']=array('id','course_name',$data['all_courses']);

    $data['t_date']=$data['from_date'] = '';
    if ($this->input->post('from_date', TRUE)) {

        $data['from_date']=$startdate=$this->input->post('from_date', TRUE);
        $where=$where." and prosikkhon_start_date>='$startdate'";
    }
    if($this->input->post('t_date', TRUE))
    {
        $data['t_date']=$enddate=$this->input->post('t_date', TRUE);
        $where=$where." and prosikkhon_start_date<='$enddate'";
    }

    if($this->input->post('course_name_id', TRUE))
    {
        $course_name_id=$this->input->post('course_name_id', TRUE);
        $where=$where." and nt.id='$course_name_id'";
    }
    else
    {
        $hid=$data['course_name_id'][2][0]['id'];
        $where=$where." and nt.id='$hid'";
    }

    $data['all_list'] = $this->Common_model->get_all($select,$from,$where);

    $data['meta_title'] = lang('trainers_list');
    $data['subview'] = 'reports';
    $this->load->view('backend/_layout_main', $data);
}

public function bochor_onujaI_proshikhon_report()
{
    $data['userDetails'] = $this->Common_model->get_user_details();
    $thismodel=$this->this_model();
        //$data['Year']=array('id','course_name',$data['all_courses']);

        //$data['Year']=$data['Year'] = '';
        //var Year = document.getElementById('Year').value
        //$year=$this->select->post('Year');
        //print_r($year);
    if($_POST)
        $year=$this->input->post('Year');
    else
       $year=date('Y');
        //print_r($year);

   $data['course_names'] = $this->Common_model->get_all('course_name,course_duration_day,prosikkhon_start_date','nilg_trainings',"YEAR(prosikkhon_start_date)= '$year'");
        //$data['course_names']=$this->$cnt;
        //echo '<pre>';
//print_r($cnt);
    //exit;
   $data['meta_title'] = lang('proshikkhon_report_summary');
   $data['subview'] = 'bochor_onujaI_proshikhon_report';
   $this->load->view('backend/_layout_main', $data);
}

}
