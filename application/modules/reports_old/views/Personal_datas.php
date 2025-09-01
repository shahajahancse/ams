<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Personal_datas extends Backend_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Personal_datas_model');
		$this->load->model('Common_model');
        $this->load->model('general_setting/General_setting_model');
        $this->load->model('exam_names/Exam_names_model');

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
    }

    public function index(){

    	$this->data['meta_title'] = 'title';
		$this->data['subview'] = 'create';
    	$this->load->view('backend/_layout_main', $this->data);
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
		return ucwords($this->uri->segment(1)).'_model';
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

		$data['printcolumn']=array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add' );
		
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

        $data['printcolumn']=array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add', 'gender');
        
        // $search_data = array(''); , $search_data = NULL

        $data['all_list'] = $this->$thismodel->get_all_data_sheet($typid);
        $data['districts'] = $this->General_setting_model->get_district();
        $data['designation'] = $this->Common_model->get_designation();

        $data['meta_title'] = lang('jonoprothinidhi_report');

        $data['subview'] = 'jonoprothinidhi_report';
        $this->load->view('backend/_layout_main', $data);
    }

    public function kormokorta_report()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        $thismodel=$this->this_model();
        
        $typid=2;

        $data['printcolumn']=array('name_bangla', 'national_id', 'district_name', 'up_th_name', 'desig_name', 'present_add', 'gender');
        
        // $search_data = array(''); , $search_data = NULL

        $data['all_list'] = $this->$thismodel->get_all_data_sheet($typid);
        $data['districts'] = $this->General_setting_model->get_district();
        $data['designation'] = $this->Common_model->get_designation();

        $data['meta_title'] = lang('kormokorta_report');

        $data['subview'] = 'kormokorta_report';
        $this->load->view('backend/_layout_main', $data);
    }

    public function jonoprothinidhi_report_summ()
    {
        $data['userDetails'] = $this->Common_model->get_user_details();
        $thismodel=$this->this_model();
        
        $typid=1; 

        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','1');
        $data['total_data']=$cnt[0]['cnt'];

        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','curr_desig_id=1');
        $data['total_charman']=$cnt[0]['cnt'];

        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','curr_desig_id=6');
        $data['total_mayor']=$cnt[0]['cnt'];

        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','curr_desig_id=2');
        $data['total_member_normal']=$cnt[0]['cnt'];

        $cnt = $this->$thismodel->get_all('count(*) as cnt','personal_datas','curr_desig_id=4');
        $data['vice_charirman']=$cnt[0]['cnt'];
	

        $data['meta_title'] = lang('jonoprothinidhi_report_summ');

        $data['subview'] = 'jonoprothinidhi_report_summ';
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
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

    function ajax_promotion_del($id){
        $this->Common_model->delete('per_promotion', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }
    function ajax_education_del($id){
        $this->Common_model->delete('per_education', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }
    function ajax_nilg_training_del($id){
        $this->Common_model->delete('per_nilg_training', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }
    function ajax_local_training_del($id){
        $this->Common_model->delete('per_local_org_training', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }
    function ajax_foreign_training_del($id){
        $this->Common_model->delete('per_foreign_org_training', 'id', $id);
        echo 'এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলা হয়েছে।';
    }

}
