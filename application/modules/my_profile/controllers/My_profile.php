<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_profile extends Backend_Controller {	
   var $userID;
   var $img_path;
   var $qr_path;

   var $img_orginal_path;
   var $img_thumb_path;

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_title'] = 'My Profile';
      $this->load->model('Common_model');
      $this->load->model('My_profile_model');
      $this->userID = $this->session->userdata('user_id');
      $this->img_path = realpath(APPPATH . '../profile_img');
      $this->qr_path = realpath(APPPATH . '../qrcode_img');

      $this->img_orginal_path = realpath(APPPATH . '../temp_dir/');
      $this->img_thumb_path = realpath(APPPATH . '../temp_dir/_thumb/');

      // echo '<pre>';
      // print_r($this->session->all_userdata());
   }   

   public function index(){

   //echo _MPDF_PATH;	
   // echo _MPDF_URI;	
      $this->data['info'] = $this->My_profile_model->get_info($this->userID); 
      $this->data['cub_info'] = $this->My_profile_model->get_expreance_info($this->userID, 1);
      $this->data['scout_info'] = $this->My_profile_model->get_expreance_info($this->userID, 2);
      $this->data['rover_info'] = $this->My_profile_model->get_expreance_info($this->userID, 3); 
      $this->data['my_award'] = $this->My_profile_model->get_my_award($this->userID);
      $this->data['my_education'] = $this->My_profile_model->get_my_education($this->userID);  
      $this->data['training'] = $this->My_profile_model->get_scout_training_approved(); 
      $this->data['event'] = $this->My_profile_model->get_scout_event_approved();
      $this->data['slider'] = $this->My_profile_model->get_slider();

      $form_data = array(
         'scout_id'        => $this->userID,
         'section_id'      => $this->data['info']->sc_section_id
         );

      $this->data['badge_details']  = $this->My_profile_model->get_badge_details($form_data);
      $this->data['expertness']     = $this->My_profile_model->get_badge_details_expertness($form_data);
      // $this->data['achievement']    = $this->My_profile_model->get_badge_details_achievement($form_data);
      $this->data['camping']        = $this->My_profile_model->get_badge_details_camping($form_data);
      $this->data['badge_training'] = $this->My_profile_model->get_badge_details_training($form_data);
      $this->data['health']         = $this->My_profile_model->get_badge_details_health($form_data);
      $this->data['institute']      = $this->My_profile_model->get_badge_details_institute($form_data);
      $this->data['promotion']      = $this->My_profile_model->get_badge_details_promotion($form_data);
      $this->data['resign']         = $this->My_profile_model->get_badge_details_resign($form_data);

      // Achivement = training
      $this->data['trainings'] = $this->My_profile_model->get_trainings($this->userID);

        //Load page       
      $this->data['meta_title'] = 'My Profile';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   // for generate pdf
   public function id_card(){
      $this->data['info'] = $this->My_profile_model->get_info($this->userID);
      // echo '<pre>';
      // print_r($this->data['info']); exit;
      // if($this->data['info']->qr_img == NULL){
         // echo 'hello';
         $this->qrcode_generator($this->data['info']->id);
         // redirect('my_profile/id_card');
      // }
      //Load page       
      $this->data['meta_title'] = 'Scout ID Card';
      $this->data['subview'] = 'id_card';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   public function pdf_id_card(){
      // redirect('my_profile'); 
      $this->data['info'] = $this->My_profile_model->get_info($this->userID);
      // echo $this->data['info']->scout_id; exit;        

      //Generate HTML
      $html = $this->load->view('pdf_id_card_front', $this->data, true);
      $html2 = $this->load->view('pdf_id_card_back', $this->data, true);    

      $mpdf = new mPDF('', array(349, 225), 10, 'arial', 0, 0, 0, 0);
      $file_name ="scout-id-".$this->data['info']->scout_id.".pdf";
      
      //$mpdf->showImageErrors = true;
      //$mpdf->debug = true;
      //$mpdf->img_dpi = 72;

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);
      $mpdf->AddPage(); // Adds a new page in Landscape orientation
      $mpdf->WriteHTML($html2);

      //download it for 'D'. 
      $mpdf->Output($file_name, 'I');
   }

   public function pdf_test(){
      $this->data['info'] = $this->My_profile_model->get_info($this->userID);
      
      // new mPDF($mode, $format, $font_size, $font, $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer, $orientation);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      $html = $this->load->view('pdf_test', $this->data, true);
      // $html = $this->load->view('pdf_id_card', $this->data,true);    
      $file_name = "scout-id-".$this->data['info']->scout_id.".pdf";

      $mpdf->WriteHTML($html);
      $mpdf->Output($file_name, 'I'); // opens in browser
      //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
   }

   public function pdf_html(){
      $this->data['info'] = $this->My_profile_model->get_info($this->userID);
      // echo $this->data['info']->scout_id; exit;  
      $this->load->view('pdf_html', $this->data); 
   }   

   public function cub_experience($id){
      redirect('dashboard');
      
      $this->data['info'] = $this->My_profile_model->get_expreance_info($id, 1);

      if(!empty($info)){
         $memberID = $this->data['info']->member_id;
         $sectionID = $this->data['info']->section_id;
      }else{
         $memberID = '';
         $sectionID = '';
      }

      $this->form_validation->set_rules('join_date', 'join date', 'required|trim');
      $this->form_validation->set_rules('sc_badge_id', 'request badge', 'trim');
      $this->form_validation->set_rules('sc_role_id', 'request role', 'trim');
      $this->form_validation->set_rules('sc_region_id', 'scout region', 'trim');
      $this->form_validation->set_rules('sc_district_id', 'scout district', 'trim');
      $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila', 'trim');
      $this->form_validation->set_rules('sc_group_id', 'scout group', 'trim');
      $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');        

      // Run after validation
      if ($this->form_validation->run() == true){            
         $form_data = array(             
            'scout_id'          => $id,
            'join_date'         => date_db_format($this->input->post('join_date')),
            'member_id'         => $this->input->post('member_id'),
            'section_id'        => $this->input->post('sc_section_id'),
            'sc_badge_id'       => $this->input->post('sc_badge_id'),
            'sc_role_id'        => $this->input->post('sc_role_id'),
            'sc_region_id'      => $this->input->post('sc_region_id'),
            'sc_district_id'    => $this->input->post('sc_district_id'),
            'sc_upa_tha_id'     => $this->input->post('sc_upa_tha_id'),
            'sc_group_id'       => $this->input->post('sc_group_id'),
            'sc_unit_id'        => $this->input->post('sc_unit_id')
            );

         if(!empty($this->data['info'])){
            if($this->Common_model->edit('scout_experience', $this->data['info']->id, 'id', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('My_profile');
            }
         }else{
            if($this->Common_model->save('scout_experience', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('My_profile');
            } 
         }            
      }

      //dropdown
      $this->data['regions'] = $this->Common_model->get_regions(); 
      $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
      $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana(); 
      $this->data['scout_group'] = $this->Common_model->get_scout_group_office(); 
      $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      $this->data['scout_badges'] = $this->Common_model->get_badges($memberID, $sectionID);
      $this->data['scout_roles'] = $this->Common_model->get_roles($memberID, $sectionID);

      $this->data['meta_title'] = 'Update Cub Scout Experience Infomation';
      $this->data['subview'] = 'experience';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_experience($id){
      $this->data['info'] = $this->My_profile_model->get_expreance_info($id,2);

      if(!empty($info)){
         $memberID = $this->data['info']->member_id;
         $sectionID = $this->data['info']->section_id;
      }else{
         $memberID = '';
         $sectionID = '';
      }

      $this->form_validation->set_rules('join_date', 'join date', 'required|trim');
      $this->form_validation->set_rules('sc_badge_id', 'request badge', 'trim');
      $this->form_validation->set_rules('sc_role_id', 'request role', 'trim');
      $this->form_validation->set_rules('sc_region_id', 'scout region', 'trim');
      $this->form_validation->set_rules('sc_district_id', 'scout district', 'trim');
      $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila', 'trim');
      $this->form_validation->set_rules('sc_group_id', 'scout group', 'trim');
      $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');        

      // Run after validation
      if ($this->form_validation->run() == true){
         $form_data = array(             
            'scout_id'          => $id,
            'join_date'         => date_db_format($this->input->post('join_date')),
            'member_id'         => $this->input->post('member_id'),
            'section_id'        => $this->input->post('sc_section_id'),
            'sc_badge_id'       => $this->input->post('sc_badge_id'),
            'sc_role_id'        => $this->input->post('sc_role_id'),
            'sc_region_id'      => $this->input->post('sc_region_id'),
            'sc_district_id'    => $this->input->post('sc_district_id'),
            'sc_upa_tha_id'     => $this->input->post('sc_upa_tha_id'),
            'sc_group_id'       => $this->input->post('sc_group_id'),
            'sc_unit_id'        => $this->input->post('sc_unit_id')
            );

         if(!empty($this->data['info'])){
            if($this->Common_model->edit('scout_experience', $this->data['info']->id, 'id', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('my_profile');
            }
         }else{
            if($this->Common_model->save('scout_experience', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('my_profile');
            } 
         }            
      }

        //dropdown
      $this->data['regions'] = $this->Common_model->get_regions(); 
      $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
      $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana(); 
      $this->data['scout_group'] = $this->Common_model->get_scout_group_office(); 
      $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      $this->data['scout_badges'] = $this->Common_model->get_badges($memberID, $sectionID);
      $this->data['scout_roles'] = $this->Common_model->get_roles($memberID, $sectionID);

      $this->data['meta_title'] = 'Update Scout Experience Infomation';
      $this->data['subview'] = 'experience';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function rover_experience($id){
      $this->data['info'] = $this->My_profile_model->get_expreance_info($id,3);

      if(!empty($info)){
         $memberID = $this->data['info']->member_id;
         $sectionID = $this->data['info']->section_id;
      }else{
         $memberID = '';
         $sectionID = '';
      }

      $this->form_validation->set_rules('join_date', 'join date', 'required|trim');
      $this->form_validation->set_rules('sc_badge_id', 'request badge', 'trim');
      $this->form_validation->set_rules('sc_role_id', 'request role', 'trim');
      $this->form_validation->set_rules('sc_region_id', 'scout region', 'trim');
      $this->form_validation->set_rules('sc_district_id', 'scout district', 'trim');
      $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila', 'trim');
      $this->form_validation->set_rules('sc_group_id', 'scout group', 'trim');
      $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');        

      // Run after validation
      if ($this->form_validation->run() == true){            
         $form_data = array(             
            'scout_id'          => $id,
            'join_date'         => date_db_format($this->input->post('join_date')),
            'member_id'         => $this->input->post('member_id'),
            'section_id'        => $this->input->post('sc_section_id'),
            'sc_badge_id'       => $this->input->post('sc_badge_id'),
            'sc_role_id'        => $this->input->post('sc_role_id'),
            'sc_region_id'      => $this->input->post('sc_region_id'),
            'sc_district_id'    => $this->input->post('sc_district_id'),
            'sc_upa_tha_id'     => $this->input->post('sc_upa_tha_id'),
            'sc_group_id'       => $this->input->post('sc_group_id'),
            'sc_unit_id'        => $this->input->post('sc_unit_id')
            );

         if(!empty($this->data['info'])){
            if($this->Common_model->edit('scout_experience', $this->data['info']->id, 'id', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('my_profile');
            }
         }else{
            if($this->Common_model->save('scout_experience', $form_data)){
               $this->session->set_flashdata('message', $this->ion_auth->messages() );
               redirect('my_profile');
            } 
         }
      }

      //dropdown
      $this->data['regions'] = $this->Common_model->get_regions(); 
      $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
      $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana(); 
      $this->data['scout_group'] = $this->Common_model->get_scout_group_office(); 
      $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      $this->data['scout_badges'] = $this->Common_model->get_badges($memberID, $sectionID);
      $this->data['scout_roles'] = $this->Common_model->get_roles($memberID, $sectionID);

      //Load view
      $this->data['meta_title'] = 'Update Rover Scout Experience Infomation';
      $this->data['subview'] = 'experience';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function update_award(){
      $this->form_validation->set_rules('award_id[]', 'award id','required|trim');
      $this->form_validation->set_rules('certificate_no[]', 'certificate no', 'required|trim');
      $this->form_validation->set_rules('achived_date[]', 'achived date', 'required|trim');

      if ($this->form_validation->run() == true){
         for ($i=0; $i<sizeof($_POST['award_id']); $i++) { 
            $exists = $this->My_profile_model->exists_data('award_to_scouts', 'scout_id', $this->userID, 'award_id', $_POST['award_id'][$i]);
            if($exists==false){
               $data_exists = $this->Common_model->exists('award_to_scouts', 'id', $_POST['hide_id'][$i]);
               if($data_exists){
                  $award_data = array(
                     'award_id'         => $_POST['award_id'][$i],
                     'certificate_no'   => $_POST['certificate_no'][$i],
                     'achived_date'     => date_db_format($_POST['achived_date'][$i]),
                     ); 
                  $this->Common_model->edit('award_to_scouts', $_POST['hide_id'][$i], 'id', $award_data);
               }else{
                  $award_data = array(
                     'scout_id'          => $this->userID,
                     'award_id'          => $_POST['award_id'][$i],
                     'certificate_no'    => $_POST['certificate_no'][$i],
                     'achived_date'      => date_db_format($_POST['achived_date'][$i]),
                     );
                  $this->Common_model->save('award_to_scouts', $award_data);
               }
            }else{
               $award_data = array(
                  'award_id'         => $_POST['award_id'][$i],
                  'certificate_no'   => $_POST['certificate_no'][$i],
                  'achived_date'     => date_db_format($_POST['achived_date'][$i]),
                  ); 
               $this->Common_model->edit('award_to_scouts', $_POST['hide_id'][$i], 'id', $award_data); 
            } 
         }
      }

      $this->data['my_award'] = $this->My_profile_model->get_my_award($this->userID);
      $this->data['award_list'] = $this->My_profile_model->get_award_list(); 
      $this->data['award_dropdown_list'] = $this->My_profile_model->get_award_dropdown_list();     
      
      //Load page       
      $this->data['meta_title'] = 'Update Award Information';
      $this->data['subview'] = 'update_award';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function update_education(){
      
      $this->form_validation->set_rules('edu_level_id[]', 'education level','required|trim');
      $this->form_validation->set_rules('institute_board[]', 'institute ', 'trim');
      $this->form_validation->set_rules('pass_year[]', 'pass year ', 'trim');         

      if ($this->form_validation->run() == true){
         // Education 
         for ($i=0; $i<sizeof($_POST['edu_level_id']); $i++) { 
            //check exists data
            @$data_edu_exists = $this->Common_model->exists('educations', 'id', $_POST['hide_exam_id'][$i]);
            if($data_edu_exists){
               $education_data = array(
                  'edu_level_id'    => $_POST['edu_level_id'][$i],
                  'institute_board' => $_POST['institute_board'][$i],
                  'result'          => $_POST['result'][$i],
                  'pass_year'       => $_POST['pass_year'][$i],
                  ); 
               $this->Common_model->edit('educations', $_POST['hide_exam_id'][$i], 'id', $education_data);
            }else{
               $education_data = array(
                  'scout_id'        => $this->userID,
                  'edu_level_id'    => $_POST['edu_level_id'][$i],
                  'institute_board' => $_POST['institute_board'][$i],
                  'result'          => $_POST['result'][$i],
                  'pass_year'       => $_POST['pass_year'][$i],
                  );
               $this->Common_model->save('educations', $education_data);
            }
         }

         redirect('my_profile');

         // for ($i=0; $i<sizeof($_POST['edu_level_id']); $i++) { 
         //    $exists = $this->My_profile_model->exists_data('educations', 'scout_id', $this->userID, 'edu_level_id', $_POST['edu_level_id'][$i]);
         //    if($exists==false){
         //       $data_exists = $this->Common_model->exists('educations', 'id', $_POST['hide_id'][$i]);
         //       if($data_exists){
         //          $edu_data = array(
         //             'edu_level_id'     => $_POST['edu_level_id'][$i],
         //             'institute_id'     => $_POST['institute_id'][$i]!=NULL?$_POST['institute_id'][$i]:$_POST['hide_institute_id'][$i],
         //             'pass_year'        => $_POST['pass_year'][$i],
         //             );
         //          $this->Common_model->edit('educations', $_POST['hide_id'][$i], 'id', $edu_data);
         //          redirect('my_profile');
         //       }else{
         //          $edu_data = array(
         //             'scout_id'          => $this->userID,
         //             'edu_level_id'      => $_POST['edu_level_id'][$i],
         //             'institute_id'      => $_POST['institute_id'][$i],
         //             'pass_year'         => $_POST['pass_year'][$i],
         //             );
         //          $this->Common_model->save('educations', $edu_data);
         //          redirect('my_profile');
         //       }
         //    }else{
         //       $edu_data = array(
         //          'edu_level_id'     => $_POST['edu_level_id'][$i],
         //          'institute_id'     => $_POST['institute_id'][$i]!=NULL?$_POST['institute_id'][$i]:$_POST['hide_institute_id'][$i],
         //          'pass_year'        => $_POST['pass_year'][$i],
         //          );
         //       $this->Common_model->edit('educations', $_POST['hide_id'][$i], 'id', $edu_data); 
         //       redirect('my_profile');
         //    } 
         // }
      }

      $this->data['my_education'] = $this->My_profile_model->get_my_education($this->userID);
      $this->data['education_level_list'] = $this->My_profile_model->get_education_level_list(); 
      $this->data['education_level_dropdown_list'] = $this->My_profile_model->get_education_dropdown_list();     
      
      //Load page       
      $this->data['meta_title'] = 'Update Education Information';
      $this->data['subview'] = 'update_education';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function guest_test(){
      exit;
      $this->data['info'] = $this->My_profile_model->get_info($this->userID);
      // print_r($this->data['info']); 
      $user_id = $this->data['info']->id;

      $this->data['divisions'] = $this->Common_model->get_division();

      //Load view
      $this->data['meta_title'] = 'Application to be an online scout member';
      $this->data['subview'] = 'guest_test';
      $this->load->view('backend/_layout_main', $this->data);
   } 

   public function scout_request_application(){
      $this->data['info'] = $this->My_profile_model->get_info($this->userID);
      $user_id = $this->data['info']->id;

      // validate form input        
      $this->form_validation->set_rules('first_name', 'full name (English)', 'required|trim');
      $this->form_validation->set_rules('full_name_bn', 'full name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('father_name', 'father name (English)', 'required|trim');
      $this->form_validation->set_rules('father_name_bn', 'father name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('mother_name', 'mother name (English)', 'required|trim');
      $this->form_validation->set_rules('mother_name_bn', 'mother name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('day', 'day', 'required|trim');
      $this->form_validation->set_rules('month', 'month', 'required|trim');
      $this->form_validation->set_rules('year', 'year', 'required|trim');
      $this->form_validation->set_rules('gender', 'gender', 'required|trim'); 
      $this->form_validation->set_rules('religion_id', 'religion', 'required|trim');       
      $this->form_validation->set_rules('blood_group', 'blood group', 'trim');
      $this->form_validation->set_rules('phone', 'mobile number', 'required|trim');
      $this->form_validation->set_rules('email', 'email', 'valid_email|trim');

      // $this->form_validation->set_rules('nid', 'nid', 'trim');
      // $this->form_validation->set_rules('birth_id', 'birth id', 'trim'); 
      // // $this->form_validation->set_rules('phone2', 'telephone', 'trim');       
      // $this->form_validation->set_rules('passport_no', 'passport no', 'trim');
      // $this->form_validation->set_rules('phone_emergency', 'phone emergency', 'trim');
      // $this->form_validation->set_rules('occupation_id', 'occupation', 'trim');
      // $this->form_validation->set_rules('occp_others', 'other occupation', 'trim');

      $this->form_validation->set_rules('pre_village_house', 'present village/house (English)', 'required|trim');
      $this->form_validation->set_rules('pre_village_house_bn', 'present village/house (Bangla)', 'required|trim');
      $this->form_validation->set_rules('pre_road_block', 'present road/block (English)', 'required|trim');
      $this->form_validation->set_rules('pre_road_block_bn', 'present road/block (Bangla)', 'required|trim');
      $this->form_validation->set_rules('pre_division_id', 'present division', 'required|trim');
      $this->form_validation->set_rules('pre_district_id', 'present district', 'required|trim');
      $this->form_validation->set_rules('pre_upa_tha_id', 'present upazila / thana', 'required|trim');
      $this->form_validation->set_rules('pre_post_office', 'present post office', 'trim');

      // $this->form_validation->set_rules('same_as', 'same as', 'trim');

      // $this->form_validation->set_rules('per_village_house', 'permanent village/house', 'trim');
      // $this->form_validation->set_rules('per_road_block', 'permanent road/block', 'trim');
      // $this->form_validation->set_rules('per_division_id', 'permanent division', 'trim');
      // $this->form_validation->set_rules('per_district_id', 'permanent district', 'trim');
      // $this->form_validation->set_rules('per_upa_tha_id', 'permanent upazila / thana', 'trim');
      // $this->form_validation->set_rules('per_post_office', 'permanent post office', 'trim');

      // $this->form_validation->set_rules('facebook', 'facebook', 'trim');
      // $this->form_validation->set_rules('google', 'google', 'trim');
      // $this->form_validation->set_rules('linkedin', 'linkedin', 'trim');
      // $this->form_validation->set_rules('skype', 'skype', 'trim');

      $this->form_validation->set_rules('curr_institute_id', 'curr institute', 'trim');
      $this->form_validation->set_rules('curr_class', 'curr class', 'trim');
      $this->form_validation->set_rules('curr_role_no', 'curr role no', 'trim');

      $this->form_validation->set_rules('sc_cub', 'cub scouts', 'trim');
      $this->form_validation->set_rules('sc_scout', 'Scouts', 'trim');
      $this->form_validation->set_rules('sc_rover', 'rover scouts', 'trim');

      $this->form_validation->set_rules('join_date', 'join date', 'required|trim');
      $this->form_validation->set_rules('sc_section_id', 'request sction', 'required|trim');
      $this->form_validation->set_rules('member_id', 'Member Type', 'required|trim');
      $this->form_validation->set_rules('sc_badge_id', 'request badge', 'trim');
      $this->form_validation->set_rules('sc_role_id', 'request role', 'trim');
      $this->form_validation->set_rules('sc_region_id', 'scout region', 'required|trim');
      $this->form_validation->set_rules('sc_district_id', 'scout district', 'required|trim');
      $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila', 'trim');
      $this->form_validation->set_rules('sc_group_id', 'scout group', 'required|trim');
      $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');        
      $this->form_validation->set_rules('userfile', 'profile image required', '');

      if(@$_FILES['userfile']['size'] > 0){
         $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      }

        // Run after validation
      if ($this->form_validation->run() == true){
         $dob = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
         $form_data = array(
            'is_request'        => '1',
            'first_name'        => $this->input->post('first_name'),
            'full_name_bn'      => $this->input->post('full_name_bn'),
            'father_name'       => $this->input->post('father_name'),
            'father_name_bn'    => $this->input->post('father_name_bn'),
            'mother_name'       => $this->input->post('mother_name'),
            'mother_name_bn'    => $this->input->post('mother_name_bn'),
            'dob'               => $dob,
            'gender'            => $this->input->post('gender'),
            'blood_group'       => $this->input->post('blood_group'),
            'phone'             => $this->input->post('phone'),
            'email'             =>  $this->input->post('email'),               
            'religion_id'       => $this->input->post('religion_id'),

            'pre_village_house' => $this->input->post('pre_village_house'),
            'pre_village_house_bn' => $this->input->post('pre_village_house_bn'),
            'pre_road_block'    => $this->input->post('pre_road_block'),
            'pre_road_block_bn' => $this->input->post('pre_road_block_bn'),
            'pre_division_id'   => $this->input->post('pre_division_id'),
            'pre_district_id'   => $this->input->post('pre_district_id'),
            'pre_upa_tha_id'    => $this->input->post('pre_upa_tha_id'),
            'pre_post_office'   => $this->input->post('pre_post_office'),          
            
            'is_interested'     => $this->input->post('is_interested'),
            'sc_cub'            => $this->input->post('is_interested')==0?$this->input->post('sc_cub'):NULL,
            'sc_scout'          => $this->input->post('is_interested')==0?$this->input->post('sc_scout'):NULL,
            'sc_rover'          => $this->input->post('is_interested')==0?$this->input->post('sc_rover'):NULL,
            'curr_institute_id' => $this->input->post('curr_institute_id'),
            'curr_class'        => $this->input->post('curr_class'),
            'curr_role_no'      => $this->input->post('curr_role_no'),
            'curr_org'          =>  $this->input->post('curr_org'),
            'curr_desig'        =>  $this->input->post('curr_desig'),
            'join_date'         => date_db_format($this->input->post('join_date')),
            'sc_section_id'     => $this->input->post('sc_section_id'),
            'member_id'         => $this->input->post('member_id'),
            'sc_badge_id'       => $this->input->post('is_interested')==0?$this->input->post('sc_badge_id'):NULL,
            'sc_role_id'        => $this->input->post('is_interested')==0?$this->input->post('sc_role_id'):NULL,
            'sc_region_id'      => $this->input->post('sc_region_id'),
            'sc_district_id'    => $this->input->post('sc_district_id'),
            'sc_upa_tha_id'     => $this->input->post('sc_upa_tha_id'),
            'sc_group_id'       => $this->input->post('sc_group_id'),
            'sc_unit_id'        => $this->input->post('sc_unit_id')
            );
         // Image Upload
         if($_FILES['userfile']['size'] > 0){
            $new_file_name = time().'-'.$_FILES["userfile"]['name'];
            $config['allowed_types']= 'jpg|png|jpeg';
            $config['upload_path']  = $this->img_path;
            $config['file_name']    = $new_file_name;
            $config['max_size']     = 600;

            $this->load->library('upload', $config);
            //upload file to directory
            if($this->upload->do_upload()){
               $uploadData = $this->upload->data();
               $config = array(
                  'source_image' => $uploadData['full_path'],
                  'new_image' => $this->img_path,
                  'maintain_ratio' => TRUE,
                  'width' => 300,
                  'height' => 300
                  );
               $this->load->library('image_lib',$config);
               $this->image_lib->initialize($config);
               $this->image_lib->resize();

               $uploadedFile = $uploadData['file_name'];
               // print_r($uploadedFile);
            }else{
               $this->data['message'] = $this->upload->display_errors();
            }
         }

         if($_FILES['userfile']['size'] > 0){
            $form_data['profile_img'] = $uploadedFile;
         }


         if($this->Common_model->edit('users', $this->userID, 'id', $form_data)){
            $this->session->set_flashdata('success', 'Thank You! Your request sent successfully.');
            redirect('dashboard');
         }
      }

      //dropdown
      $this->data['days'] = $this->Common_model->get_days(); 
      $this->data['months'] = $this->Common_model->get_months(); 
      $this->data['years'] = $this->Common_model->get_years();
      $this->data['religions'] = $this->Common_model->set_religion();
      $this->data['blood_group'] = $this->Common_model->get_blood_group();
      $this->data['divisions'] = $this->Common_model->get_division(); 
      $this->data['districts'] = $this->Common_model->get_district(); 
      $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
      // $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
      // $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana(); 
      // $this->data['scout_group'] = $this->Common_model->get_scout_group_office(); 
      // $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
      // $this->data['scout_section'] = $this->Common_model->set_scout_section_basic();
      // $this->data['institute'] = $this->Common_model->get_scout_institute();
      // $this->data['scout_badges'] = $this->Common_model->get_badges();
      // $this->data['scout_roles'] = $this->Common_model->get_roles($this->data['info']->sc_section_id);
      // $this->data['occupation'] = $this->Common_model->get_occupations();
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      $this->data['regions'] = $this->Common_model->get_regions(); 

      //Load view
      $this->data['meta_title'] = 'Application to be an online scout member';
      $this->data['subview'] = 'scout_request_application';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_request_application_update(){
      $this->data['info'] = $this->My_profile_model->get_info($this->userID);
      $user_id = $this->data['info']->id;

      // validate form input        
      $this->form_validation->set_rules('first_name', 'full name (English)', 'required|trim');
      $this->form_validation->set_rules('full_name_bn', 'full name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('father_name', 'father name (English)', 'required|trim');
      $this->form_validation->set_rules('father_name_bn', 'father name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('mother_name', 'mother name (English)', 'required|trim');
      $this->form_validation->set_rules('mother_name_bn', 'mother name (Bangla)', 'required|trim');
      $this->form_validation->set_rules('day', 'day', 'required|trim');
      $this->form_validation->set_rules('month', 'month', 'required|trim');
      $this->form_validation->set_rules('year', 'year', 'required|trim');
      $this->form_validation->set_rules('gender', 'gender', 'required|trim'); 
      $this->form_validation->set_rules('religion_id', 'religion', 'required|trim');       
      $this->form_validation->set_rules('blood_group', 'blood group', 'trim');
      $this->form_validation->set_rules('phone', 'mobile number', 'required|trim');
      $this->form_validation->set_rules('email', 'email', 'valid_email|trim');

      // $this->form_validation->set_rules('nid', 'nid', 'trim');
      // $this->form_validation->set_rules('birth_id', 'birth id', 'trim'); 
      // // $this->form_validation->set_rules('phone2', 'telephone', 'trim');       
      // $this->form_validation->set_rules('passport_no', 'passport no', 'trim');
      // $this->form_validation->set_rules('phone_emergency', 'phone emergency', 'trim');
      // $this->form_validation->set_rules('occupation_id', 'occupation', 'trim');
      // $this->form_validation->set_rules('occp_others', 'other occupation', 'trim');

      $this->form_validation->set_rules('pre_village_house', 'present village/house (English)', 'required|trim');
      $this->form_validation->set_rules('pre_village_house_bn', 'present village/house (Bangla)', 'required|trim');
      $this->form_validation->set_rules('pre_road_block', 'present road/block (English)', 'required|trim');
      $this->form_validation->set_rules('pre_road_block_bn', 'present road/block (Bangla)', 'required|trim');
      $this->form_validation->set_rules('pre_division_id', 'present division', 'required|trim');
      $this->form_validation->set_rules('pre_district_id', 'present district', 'required|trim');
      $this->form_validation->set_rules('pre_upa_tha_id', 'present upazila / thana', 'required|trim');
      $this->form_validation->set_rules('pre_post_office', 'present post office', 'trim');

      // $this->form_validation->set_rules('same_as', 'same as', 'trim');

      // $this->form_validation->set_rules('per_village_house', 'permanent village/house', 'trim');
      // $this->form_validation->set_rules('per_road_block', 'permanent road/block', 'trim');
      // $this->form_validation->set_rules('per_division_id', 'permanent division', 'trim');
      // $this->form_validation->set_rules('per_district_id', 'permanent district', 'trim');
      // $this->form_validation->set_rules('per_upa_tha_id', 'permanent upazila / thana', 'trim');
      // $this->form_validation->set_rules('per_post_office', 'permanent post office', 'trim');

      // $this->form_validation->set_rules('facebook', 'facebook', 'trim');
      // $this->form_validation->set_rules('google', 'google', 'trim');
      // $this->form_validation->set_rules('linkedin', 'linkedin', 'trim');
      // $this->form_validation->set_rules('skype', 'skype', 'trim');

      $this->form_validation->set_rules('curr_institute_id', 'curr institute', 'trim');
      $this->form_validation->set_rules('curr_class', 'curr class', 'trim');
      $this->form_validation->set_rules('curr_role_no', 'curr role no', 'trim');

      $this->form_validation->set_rules('sc_cub', 'cub scouts', 'trim');
      $this->form_validation->set_rules('sc_scout', 'Scouts', 'trim');
      $this->form_validation->set_rules('sc_rover', 'rover scouts', 'trim');

      $this->form_validation->set_rules('join_date', 'join date', 'required|trim');
      $this->form_validation->set_rules('sc_section_id', 'request sction', 'required|trim');
      $this->form_validation->set_rules('member_id', 'Member Type', 'required|trim');
      $this->form_validation->set_rules('sc_badge_id', 'request badge', 'trim');
      $this->form_validation->set_rules('sc_role_id', 'request role', 'trim');
      $this->form_validation->set_rules('sc_region_id', 'scout region', 'required|trim');
      $this->form_validation->set_rules('sc_district_id', 'scout district', 'required|trim');
      $this->form_validation->set_rules('sc_upa_tha_id', 'scout upazila', 'trim');
      $this->form_validation->set_rules('sc_group_id', 'scout group', 'required|trim');
      $this->form_validation->set_rules('sc_unit_id', 'scout unit', 'trim');        
      $this->form_validation->set_rules('userfile', 'profile image required', '');

      if(@$_FILES['userfile']['size'] > 0){
         $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      }

        // Run after validation
      if ($this->form_validation->run() == true){
         $dob = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
         $form_data = array(
            'first_name'        => $this->input->post('first_name'),
            'full_name_bn'      => $this->input->post('full_name_bn'),
            'father_name'       => $this->input->post('father_name'),
            'father_name_bn'    => $this->input->post('father_name_bn'),
            'mother_name'       => $this->input->post('mother_name'),
            'mother_name_bn'    => $this->input->post('mother_name_bn'),
            'dob'               => $dob,
            'gender'            => $this->input->post('gender'),
            'blood_group'       => $this->input->post('blood_group'),
            'phone'             => $this->input->post('phone'),
            'email'             =>  $this->input->post('email'),               
            'religion_id'       => $this->input->post('religion_id'),

            'pre_village_house' => $this->input->post('pre_village_house'),
            'pre_village_house_bn' => $this->input->post('pre_village_house_bn'),
            'pre_road_block'    => $this->input->post('pre_road_block'),
            'pre_road_block_bn' => $this->input->post('pre_road_block_bn'),
            'pre_division_id'   => $this->input->post('pre_division_id'),
            'pre_district_id'   => $this->input->post('pre_district_id'),
            'pre_upa_tha_id'    => $this->input->post('pre_upa_tha_id'),
            'pre_post_office'   => $this->input->post('pre_post_office'),          
            
            'is_interested'     => $this->input->post('is_interested'),
            'sc_cub'            => $this->input->post('is_interested')==0?$this->input->post('sc_cub'):NULL,
            'sc_scout'          => $this->input->post('is_interested')==0?$this->input->post('sc_scout'):NULL,
            'sc_rover'          => $this->input->post('is_interested')==0?$this->input->post('sc_rover'):NULL,
            'curr_institute_id' => $this->input->post('curr_institute_id'),
            'curr_class'        => $this->input->post('curr_class'),
            'curr_role_no'      => $this->input->post('curr_role_no'),
            'curr_org'          =>  $this->input->post('curr_org'),
            'curr_desig'        =>  $this->input->post('curr_desig'),
            'join_date'         => date_db_format($this->input->post('join_date')),
            'sc_section_id'     => $this->input->post('sc_section_id'),
            'member_id'         => $this->input->post('member_id'),
            'sc_badge_id'       => $this->input->post('is_interested')==0?$this->input->post('sc_badge_id'):NULL,
            'sc_role_id'        => $this->input->post('is_interested')==0?$this->input->post('sc_role_id'):NULL,
            'sc_region_id'      => $this->input->post('sc_region_id'),
            'sc_district_id'    => $this->input->post('sc_district_id'),
            'sc_upa_tha_id'     => $this->input->post('sc_upa_tha_id'),
            'sc_group_id'       => $this->input->post('sc_group_id'),
            'sc_unit_id'        => $this->input->post('sc_unit_id'),
            );
         // Image Upload
         if($_FILES['userfile']['size'] > 0){
            $new_file_name = time().'-'.$_FILES["userfile"]['name'];
            $config['allowed_types']= 'jpg|png|jpeg';
            $config['upload_path']  = $this->img_path;
            $config['file_name']    = $new_file_name;
            $config['max_size']     = 600;

            $this->load->library('upload', $config);
            //upload file to directory
            if($this->upload->do_upload()){
               $uploadData = $this->upload->data();
               $config = array(
                  'source_image' => $uploadData['full_path'],
                  'new_image' => $this->img_path,
                  'maintain_ratio' => TRUE,
                  'width' => 300,
                  'height' => 300
                  );
               $this->load->library('image_lib',$config);
               $this->image_lib->initialize($config);
               $this->image_lib->resize();

               $uploadedFile = $uploadData['file_name'];
               // print_r($uploadedFile);
            }else{
               $this->data['message'] = $this->upload->display_errors();
            }
         }

         if($_FILES['userfile']['size'] > 0){
            $form_data['profile_img'] = $uploadedFile;
         }


         if($this->Common_model->edit('users', $this->userID, 'id', $form_data)){
            $this->session->set_flashdata('success', 'Thank You! Your request sent successfully.');
            redirect('dashboard');
         }
      }

      //dropdown
      $this->data['days'] = $this->Common_model->get_days(); 
      $this->data['months'] = $this->Common_model->get_months(); 
      $this->data['years'] = $this->Common_model->get_years();
      $this->data['religions'] = $this->Common_model->set_religion();
      $this->data['blood_group'] = $this->Common_model->get_blood_group();
      $this->data['divisions'] = $this->Common_model->get_division(); 
      $this->data['districts'] = $this->Common_model->get_district(); 
      $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
      // $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
      // $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana(); 
      // $this->data['scout_group'] = $this->Common_model->get_scout_group_office(); 
      // $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
      // $this->data['scout_section'] = $this->Common_model->set_scout_section_basic();
      // $this->data['institute'] = $this->Common_model->get_scout_institute();
      // $this->data['scout_badges'] = $this->Common_model->get_badges();
      // $this->data['scout_roles'] = $this->Common_model->get_roles($this->data['info']->sc_section_id);
      // $this->data['occupation'] = $this->Common_model->get_occupations();

      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();

      $this->data['scout_badges'] = $this->Common_model->get_badges($this->data['info']->member_id, $this->data['info']->sc_section_id);
      $this->data['scout_roles'] = $this->Common_model->get_roles($this->data['info']->member_id, $this->data['info']->sc_section_id);

      $this->data['regions'] = $this->Common_model->get_regions(); 
      $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
      $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana(); 
      $this->data['scout_group'] = $this->Common_model->get_scout_group_office(); 
      $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();

      //Load view
      $this->data['meta_title'] = 'Application Update';
      $this->data['subview'] = 'scout_request_application_update';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function update_basic_info(){
      $this->data['info'] = $this->My_profile_model->get_info($this->userID);
      $user_id = $this->data['info']->id;
       
      // validate form input        
      $this->form_validation->set_rules('first_name', 'full name', 'required|trim');
      $this->form_validation->set_rules('full_name_bn', 'full name bangla', 'trim');
      $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
      $this->form_validation->set_rules('father_name_bn', 'father name bangla', 'trim');
      $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');
      $this->form_validation->set_rules('mother_name_bn', 'mother name bangla', 'trim');
      $this->form_validation->set_rules('day', 'day', 'required|trim');
      $this->form_validation->set_rules('month', 'month', 'required|trim');
      $this->form_validation->set_rules('year', 'year', 'required|trim');
      $this->form_validation->set_rules('gender', 'gender', 'required|trim'); 
      $this->form_validation->set_rules('religion_id', 'religion', 'required|trim');       
      $this->form_validation->set_rules('blood_group', 'blood group', 'trim');
      $this->form_validation->set_rules('phone', 'mobile number', 'required|trim');
      $this->form_validation->set_rules('email', 'email', 'valid_email|trim');

      $this->form_validation->set_rules('nid', 'nid', 'trim');
      $this->form_validation->set_rules('birth_id', 'birth id', 'trim'); 
      $this->form_validation->set_rules('phone2', 'telephone', 'trim');       
      $this->form_validation->set_rules('passport_no', 'passport no', 'trim');
      $this->form_validation->set_rules('phone_emergency', 'phone emergency', 'trim');
      $this->form_validation->set_rules('occupation_id', 'occupation', 'trim');
      $this->form_validation->set_rules('occp_others', 'others occupation', 'trim');

      $this->form_validation->set_rules('pre_village_house', 'present village/house', 'required|trim');      
      $this->form_validation->set_rules('pre_road_block', 'present road/block', 'required|trim');
      $this->form_validation->set_rules('pre_division_id', 'present division', 'required|trim');
      $this->form_validation->set_rules('pre_district_id', 'present district', 'required|trim');
      $this->form_validation->set_rules('pre_upa_tha_id', 'present upazila / thana', 'required|trim');
      $this->form_validation->set_rules('pre_post_office', 'present post office', 'required|trim');

      $this->form_validation->set_rules('same_as', 'same as', 'trim');

      $this->form_validation->set_rules('per_village_house', 'permanent village/house', 'trim');
      $this->form_validation->set_rules('per_road_block', 'permanent road/block', 'trim');
      $this->form_validation->set_rules('per_division_id', 'permanent division', 'trim');
      $this->form_validation->set_rules('per_district_id', 'permanent district', 'trim');
      $this->form_validation->set_rules('per_upa_tha_id', 'permanent upazila / thana', 'trim');
      $this->form_validation->set_rules('per_post_office', 'permanent post office', 'trim');

      $this->form_validation->set_rules('curr_institute_id', 'curr institute', 'trim');
      $this->form_validation->set_rules('curr_class', 'curr class', 'trim');
      $this->form_validation->set_rules('curr_role_no', 'curr role no', 'trim');

      // Run after validation
      if ($this->form_validation->run() == true){
         $dob = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
         $form_data = array(
            'first_name'        => $this->input->post('first_name'),
            'full_name_bn'      => $this->input->post('full_name_bn'),
            'father_name'       => $this->input->post('father_name'),
            'father_name_bn'    => $this->input->post('father_name_bn'),
            'mother_name'       => $this->input->post('mother_name'),
            'mother_name_bn'    => $this->input->post('mother_name_bn'),
            'dob'               => $dob,
            'gender'            => $this->input->post('gender'),
            'blood_group'       => $this->input->post('blood_group'),
            'phone'             => $this->input->post('phone'),
            'phone2'            => $this->input->post('phone2'),
            'passport_no'       => strtoupper($this->input->post('passport_no')),
            'pass_date_issue'   => date_db_format($this->input->post('pass_date_issue')),
            'pass_date_expiry'  => date_db_format($this->input->post('pass_date_expiry')),
            'pass_place_issue'  => $this->input->post('pass_place_issue'),
            'pass_place_birth'  => $this->input->post('pass_place_birth'),
            'phone_emergency'   => $this->input->post('phone_emergency'),
            'nid'               => $this->input->post('nid'),
            'birth_id'          => $this->input->post('birth_id'),
            'email'             => $this->input->post('email'),
            'occupation_id'     => $this->input->post('occupation_id'),
            'occp_others'       => $this->input->post('occupation_id')=='Other'?$this->input->post('occp_others'):NULL,
            'religion_id'       => $this->input->post('religion_id'),

            'pre_village_house' => $this->input->post('pre_village_house'),
            'pre_village_house_bn' => $this->input->post('pre_village_house_bn'),
            'pre_road_block'    => $this->input->post('pre_road_block'),
            'pre_road_block_bn' => $this->input->post('pre_road_block_bn'),
            'pre_division_id'   => $this->input->post('pre_division_id'),
            'pre_district_id'   => $this->input->post('pre_district_id'),
            'pre_upa_tha_id'    => $this->input->post('pre_upa_tha_id'),
            'pre_post_office'   => $this->input->post('pre_post_office'),

            'per_village_house' => $this->input->post('per_village_house'),
            'per_village_house_bn' => $this->input->post('per_village_house_bn'),
            'per_road_block'    => $this->input->post('per_road_block'),
            'per_road_block_bn' => $this->input->post('per_road_block_bn'),
            'per_division_id'   => $this->input->post('per_division_id'),
            'per_district_id'   => $this->input->post('per_district_id'),
            'per_upa_tha_id'    => $this->input->post('per_upa_tha_id'),
            'per_post_office'   => $this->input->post('per_post_office'),
            'scout_designation' => $this->input->post('scout_designation'),         
            'curr_institute_id' => $this->input->post('curr_institute_id'),
            'curr_class'        => $this->input->post('curr_class'),
            'curr_role_no'      => $this->input->post('curr_role_no'),
            );
            // Image Upload
         if($this->Common_model->edit('users', $this->userID, 'id', $form_data)){
            func_activity_log(2, 'Basic Infomation Update ID :'.$user_id); //1=C, 2=U, 3=D, 4=V, 5=G
            $this->session->set_flashdata('success', 'Thank You! Your request sent successfully.');
            redirect('my_profile');
         }
      }

      //dropdown
      $this->data['days'] = $this->Common_model->get_days(); 
      $this->data['months'] = $this->Common_model->get_months(); 
      $this->data['years'] = $this->Common_model->get_years();
      $this->data['blood_group'] = $this->Common_model->get_blood_group();
      $this->data['divisions'] = $this->Common_model->get_division(); 
      $this->data['districts'] = $this->Common_model->get_district(); 
      $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
      $this->data['regions'] = $this->Common_model->get_regions(); 
      $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
      $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana(); 
      $this->data['scout_group'] = $this->Common_model->get_scout_group_office(); 
      $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      $this->data['institute'] = $this->Common_model->get_scout_institute();
      $this->data['religions'] = $this->Common_model->set_religion();
      $this->data['scout_badges'] = $this->Common_model->get_badges($this->data['info']->sc_section_id);
      $this->data['scout_roles'] = $this->Common_model->get_roles($this->data['info']->sc_section_id);
      $this->data['occupation'] = $this->Common_model->get_occupations();

      //Load view
      $this->data['meta_title'] = 'Update Basic Infomation';
      $this->data['subview'] = 'update_basic_info';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function update_donation(){
      $this->form_validation->set_rules('blood_donate_interested', 'Blood Donate Interested', 'required|trim');
      $this->form_validation->set_rules('last_donate_date', 'Last Donate Date', 'trim');          

      if ($this->form_validation->run() == true){
         $form_data = array(
            'last_donate_date'         => $this->input->post('last_donate_date') == NULL ? '0000-00-00':date_db_format($this->input->post('last_donate_date')),
            'blood_donate_interested'  => $this->input->post('blood_donate_interested')
            );

         // echo '<pre>';
         // print_r($form_data); exit;

         if($this->Common_model->edit('users', $this->userID, 'id', $form_data)){
            $this->session->set_flashdata('success', 'Your information update successfully.');
            redirect('my_profile');
         }
      }

      $this->data['info'] = $this->My_profile_model->get_info($this->userID);

      //Load view
      $this->data['meta_title'] = 'Update Blood Donation Infomation';
      $this->data['subview'] = 'update_blood_donation_info';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function submited_info(){
      // echo 'hello';  exit;
      $this->data['info'] = $this->My_profile_model->get_info($this->userID);

      //Load view
      $this->data['meta_title'] = 'Your Sumbited Infomation';
      $this->data['subview'] = 'submited_info';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   public function change_image(){
      $this->form_validation->set_rules('hide_img', 'profile image required', 'trim');

      $this->data['info'] = $this->My_profile_model->get_info($this->userID);      
      //print_r($this->data['info']->id); exit;

      if ($this->form_validation->run() == true){
         $id = $this->data['info']->id;

         //Copy image, rename and remove from temp directory
         if($this->input->post('hide_img') != NULL){
            $file_name = $this->input->post('hide_img');
            $tmp = explode('.', $file_name);
            $file_extension = end($tmp);                          

            //Copy file and rename 
            $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
            // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
            $newfile = $id.'.'.$file_extension;

            //Update table image field
            if($this->Common_model->set_profile_image($id, $newfile)){
               $saveDir = $this->img_path.'/'.$newfile;
               if (copy($file, $saveDir)) {
                  // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                  @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                  @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                  @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                  @unlink($this->img_thumb_path.'\\'.$file_name);
                  
                  $this->session->set_flashdata('success', 'Image update successfully.');
                  redirect('my_profile');
               }

            }
         }
      }

      //Load view
      $this->data['meta_title'] = 'Change Profile Image';
      $this->data['subview'] = 'change_image';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function change_image_old(){
      // $this->form_validation->set_rules('hide_img', 'profile image required', 'trim');
      $this->form_validation->set_rules('userfile', 'profile image required', 'required|trim');

      $this->data['info'] = $this->My_profile_model->get_info($this->userID);      
      //print_r($this->data['info']->id); exit;

      if(@$_FILES['userfile']['size'] > 0){
         $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      }

      if ($this->form_validation->run() == true){
         
         if($_FILES['userfile']['size'] > 0){
            $new_file_name = $this->userID;
            $config['allowed_types']= 'jpg|png|jpeg';
            $config['upload_path']  = $this->img_path;
            $config['file_name']    = $new_file_name;
            $config['max_size']     = 1024;

            $this->load->library('upload', $config);

            //upload file to directory
            if($this->upload->do_upload()){
               $uploadData = $this->upload->data();
               $config = array(
                  'source_image' => $uploadData['full_path'],
                  'new_image' => $this->img_path,
                  'maintain_ratio' => TRUE,
                  'width' => 200,
                  'height' => 200
                  );
               $this->load->library('image_lib',$config);
               $this->image_lib->initialize($config);
               $this->image_lib->resize();

               $uploadedFile = $uploadData['file_name'];
               // print_r($uploadedFile);
               if(file_exists($this->img_path.'/'.$this->data['info']->profile_img)){
                  unlink($this->img_path.'/'.$this->data['info']->profile_img);
               }

               $form_data = array('profile_img' => $uploadedFile);

               if($this->Common_model->edit('users', $this->userID, 'id', $form_data)){
                  func_activity_log(2, 'Profile Image change ID :'.$this->data['info']->id); //1=C, 2=U, 3=D, 4=V, 5=G
                  $this->session->set_flashdata('success', 'Image update successfully.');
                  redirect('my_profile');
               }
               //$this->data['message'] = 'Image has been uploaded successfully.';
            }else{
               $this->data['message'] = $this->upload->display_errors();
            }
         }
      }

      //Load view
      $this->data['meta_title'] = 'Change Profile Image';
      $this->data['subview'] = 'change_image_old';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function change_password(){      
      $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
      $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
      $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

      $user = $this->ion_auth->user()->row();

      if($this->form_validation->run() == true){
         $identity = $this->session->userdata('identity');
         $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
         if($change){
            //if the password was successfully changed
            func_activity_log(2, 'Change password'); //1=C, 2=U, 3=D, 4=V, 5=G
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            // $this->logout();
         }else{
            $this->session->set_flashdata('success', $this->ion_auth->errors());
            // redirect('my_profile');
         }
      }
      // display the form
      // set the flash data error message if there is one
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
      $this->data['old_password'] = array(
       'name' => 'old',
       'id'   => 'old',
       'type' => 'password',
       'class' => 'form-control input-sm',
       'autocomplete' => 'off',
       'placeholder' => '',
       );
      $this->data['new_password'] = array(
       'name'    => 'new',
       'id'      => 'new',
       'type'    => 'password',
       'class' => 'form-control input-sm',
       'placeholder' => '',
       'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
       );
      $this->data['new_password_confirm'] = array(
       'name'    => 'new_confirm',
       'id'      => 'new_confirm',
       'type'    => 'password',
       'class' => 'form-control input-sm',
       'placeholder' => '',
       'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
       );
      $this->data['user_id'] = array(
       'name'  => 'user_id',
       'id'    => 'user_id',
       'type'  => 'hidden',
       'value' => $user->id,
       );

      $this->data['info'] = $this->My_profile_model->get_info($this->userID);

      //Load page       
      $this->data['meta_title'] = 'Change Password';
      $this->data['subview'] = 'change_password';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function change_username(){      
      $this->data['info'] = $this->My_profile_model->get_info($this->userID);      

      // Validate field
      if($this->input->post('identity') != $this->data['info']->username) {
         $is_unique =  '|is_unique[users.username]';
      } else {
         $is_unique =  '';
      }
      $this->form_validation->set_rules('identity', 'Username', 'required|callback_username_valid|trim'.$is_unique);

      if($this->form_validation->run() === TRUE){
         $data = array('username' => strtolower($this->input->post('identity')));
         //Update username
         $change = $this->My_profile_model->update_username($data, $this->data['info']->id);
         if ($change){
            $this->session->set_flashdata('success', 'Username change successfully.');
            func_activity_log(2, 'Change username ID: '.$this->data['info']->id); //1=C, 2=U, 3=D, 4=V, 5=G
            redirect('my_profile');
         }else{
            $this->session->set_flashdata('success', $this->ion_auth->errors());
         }
      }

      // display the form
      // set the flash data error message if there is one
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      $this->data['user_id'] = array(
       'name'  => 'user_id',
       'id'    => 'user_id',
       'type'  => 'hidden',
       'value' => $this->data['info']->id,
       );

      //Load page       
      $this->data['meta_title'] = 'Change Username';
      $this->data['subview'] = 'change_username';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function qrcode_generator($id){
      // echo FCPATH;
      $info = $this->Scouts_member_model->get_info($id);
      //echo '<pre>';
      //print_r($info); exit;
      $scout_id 	= $info->scout_id;
      $url        = base_url("user/").$scout_id;
 
      $codeContents = 'URL: '.$url."\n"; 

      $data['img_url']="";
      $this->load->library('ciqrcode');
      $qr_image=$id.'.png';
      // print_r($codeContents); exit();

      $params['data'] = $codeContents;
      $params['level'] = 'H';
      $params['size'] = 8;
      $params['savename'] = $this->qr_path."/".$qr_image;

      if($this->ciqrcode->generate($params)){

         $this->Scouts_member_model->set_scout_qrcode($id, $qr_image);
         $data['img_url']=$qr_image;
      }

      //$this->load->view('qrcode', $data);
      return true;
   }

   // public function qrcode_generator($id){
   //    $info = $this->Scouts_member_model->get_info($id);
   //    // echo '<pre>';
   //    // print_r($info); exit;

   //    // here our data 
   //    $name         = $info->first_name;
   //    $scout_id     = $info->scout_id; 
   //    $phone        = '(+88)'.$info->phone;               
   //    $orgName      = 'Bangladesh Scouts'; 
   //    $email        = $info->email; 
   //    $url          = "http://173.212.223.213/scouts/user/".$scout_id;

   //    // if not used - leave blank! 
   //    $addressLabel     = 'Present Address';
   //    $addressCo        = $info->pre_village_house; 
   //    $addressStreet    = $info->pre_road_block;
   //    $addressTown      = $info->pre_district_name;
   //    $addressRegion    = $info->pre_div_name;
   //    $addressPostCode  = $info->per_post_office;
   //    $addressCountry   = 'Bangladesh'; 

   //    // we building raw data 
   //    $codeContents  = 'BEGIN:VCARD'."\n"; 
   //    $codeContents  .= 'VERSION:2.1'."\n";  
  
   //    $codeContents .= 'FN:'.$name."\n";
   //    // $codeContents .= 'TITLE: '."Senior Software Enginner\n";
   //    $codeContents .= 'KIND:individual'."\n";  
     
   //    $codeContents .= 'GENDER;TYPE=F:Female'."\n";  

   //    $codeContents .= 'PID: '.$name."\n";  
   //    $codeContents .= 'URL: '.$url."\n"; 
   //    $codeContents .= 'ORG: '.$orgName."\n"; 
   //    $codeContents .= 'TEL;WORK;VOICE: '.$phone."\n"; 
   //    $codeContents .= 'EMAIL: '.$email."\n";
   //    $codeContents .= 'PHOTO;JPEG:https://upload.wikimedia.org/wikipedia/commons/3/3d/Erika_Mustermann_2010.jpg'."\n";

   //    $codeContents .= 'ADR;'. 
   //    'LABEL="'.$addressLabel.'": ' 
   //    .$addressCo.';' 
   //    .$addressStreet.';' 
   //    .$addressTown.';' 
   //    .$addressRegion.';'
   //    .$addressPostCode.';' 
   //    .$addressCountry 
   //    ."\n"; 
   //    $codeContents .= 'END:VCARD'; 

   //    $data['img_url']="";
   //    $this->load->library('ciqrcode');
   //    $qr_image=$id.'.png';
   //    // print_r($codeContents); exit();
   //    $params['data'] = $codeContents;
   //    $params['level'] = 'H';
   //    $params['size'] = 8;
   //    $params['savename'] =FCPATH."qrcode_img/".$qr_image;

   //    if($this->ciqrcode->generate($params)){

   //       $this->Scouts_member_model->set_scout_qrcode($id, $qr_image);
   //       $data['img_url']=$qr_image;
   //    }

   //    return true;

   //    //$this->load->view('qrcode', $data);
   // }

   public function file_check($str){
      $this->load->helper('file');
      $allowed_mime_type_arr = array('image/jpeg','image/png','image/x-png');
      $mime = get_mime_by_extension($_FILES['userfile']['name']);
      $file_size = 524288; 
      $size_kb = '512 KB';

      if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
         if(!in_array($mime, $allowed_mime_type_arr)){                
            $this->form_validation->set_message('file_check', 'Please select only jpg, jpeg, png file.');
            return false;
         }elseif($_FILES["userfile"]["size"] > $file_size){
            $this->form_validation->set_message('file_check', 'Maximum file size '.$size_kb);
            return false;
         }else{
            return true;
         }
      }else{
         $this->form_validation->set_message('file_check', 'Please choose a image file to upload.');
         return false;
      }
   }

   function ajax_award_del($id){
      $this->Common_model->delete('award_to_scouts', 'id', $id);
      echo 'Remove this information from database completely.';
   }

   function ajax_education_del($id){
      $this->Common_model->delete('educations', 'id', $id);
      echo 'Remove this information from database completely.';
   }

   public function username_valid($str){
        // alpha_dash_space
        // return (!preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
      if (! preg_match('/^\S*$/', $str)) {
         $this->form_validation->set_message('username_valid', 'The %s field may only contain alpha characters & no white spaces.');
         return FALSE;
      } else {
         return TRUE;
      }
   }

   // M_PDF 7.x
   // public function save_pdf()
   // { 
   //    //load mPDF library
   //    $this->load->library('m_pdf'); 

   //    //now pass the data//
   //    // $data['mobiledata'] = $this->pdf->mobileList();
   //    $this->data['tuly'] = 'Saima Islam Tuly';
   //    // $this->data['info'] = $this->My_profile_model->get_info($this->userID);
   //    $html=$this->load->view('save_pdf', $this->data, true); 
   //    //load the pdf.php by passing our data and get all data in $html varriable.
   //    $pdfFilePath ="webpreparations-".time().".pdf"; 

   //    //actually, you can pass mPDF parameter on this load() function
   //    // $pdf = $this->m_pdf->load('"en-GB-x","A4","","",10,10,10,10,6,3');
   //    $pdf = $this->M_pdf->load();

   //    //generate the PDF!
   //    $stylesheet = '<style>'.file_get_contents('awedget/assets/css/style.css').'</style>';
   //    // apply external css
   //    $pdf->WriteHTML($stylesheet,1);
   //    $pdf->WriteHTML($html, 2);
   //    //offer it to user via browser download! (The PDF won't be saved on your server HDD)
   //    //'D' for download
   //    $pdf->Output($pdfFilePath, 'I');
   //    // exit;
   // }

}