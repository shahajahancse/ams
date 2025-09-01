<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends Backend_Controller {
   var $userID;

   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'Appointment';
      $this->load->model('Appointment_model');
      $this->load->model('my_appointment/My_appointment_model');
      $this->userSessID = $this->session->userdata('user_id');
   }

   public function index($offset=0){
      $limit = 25;
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         redirect('dashboard');
      }

      //Results
      $results = $this->Appointment_model->get_list($limit, $offset); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('appointment/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'All Appointment List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function approved_list($offset=0){
      $limit = 25;
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         redirect('dashboard');
      }

      //Results
      $results = $this->Appointment_model->get_list($limit, $offset, 1); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('appointment/approved_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'Approved Appointment List';
      $this->data['subview'] = 'approved_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function rejected_list($offset=0){
      $limit = 25;
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         redirect('dashboard');
      }

      //Results
      $results = $this->Appointment_model->get_list($limit, $offset, 2); 
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('appointment/rejected_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'Rejected Appointment List';
      $this->data['subview'] = 'rejected_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function approve($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('appointment', 'id', $dataID)) { 
         show_404('appointment - approve - exitsts', TRUE);
      }

      $info = $this->Appointment_model->get_info($dataID); 
      $schudule_date = date('l, F d, Y', strtotime($info->date));
      $schudule_time = date('h:i A', strtotime($info->date));
      $venue = $info->venue;
      if($info->author){
         $name = $info->first_name;
         $phone = $info->phone;
      }else{
         $name = $info->person_name;
         $phone = $info->person_mobile_no;
      }


      if ($dataID){
         if($this->ion_auth->is_sec_admin()){
            $this->Common_model->edit('appointment', $dataID, 'id', array('status' => 1));
            $mobile = '+88'.$phone;
            $message = 'Dear '.$name.', Your requested appointment approved. On Date: '.$schudule_date.' at Time: '.$schudule_time.' Venue at '.$venue.'. Thank You!';
            $this->send_sms($mobile, $message);
            $this->session->set_flashdata('success', 'Secretary approved the appointment request.');

         }elseif($this->ion_auth->is_ps_admin()){
            $this->Common_model->edit('appointment', $dataID, 'id', array('status_ps' => 1));
            $this->session->set_flashdata('success', 'PS approved the appointment request.');

         }elseif($this->ion_auth->is_po_admin()){
            $this->Common_model->edit('appointment', $dataID, 'id', array('status_po' => 1));
            $this->session->set_flashdata('success', 'PO approved the appointment request.');
         }
         // Send Message
         // $mobile = '+88'.$this->input->post('phone');
         // $message = 'This is test digital schedule system.';
         // $this->send_sms($mobile, $message);

         // Send Mail
         // $this->send_mail(); 
      }
      redirect('appointment');
   }

   public function reject($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('appointment', 'id', $dataID)) { 
         show_404('appointment - reject - exitsts', TRUE);
      }

      if ($dataID){
         if($this->ion_auth->is_sec_admin()){
            $this->Common_model->edit('appointment', $dataID, 'id', array('status' => 2));
            $this->session->set_flashdata('success', 'Secretary reject the appointment request.');

         }elseif($this->ion_auth->is_ps_admin()){
            $this->Common_model->edit('appointment', $dataID, 'id', array('status_ps' => 2));
            $this->session->set_flashdata('success', 'PS reject the appointment request.');

         }elseif($this->ion_auth->is_po_admin()){
            $this->Common_model->edit('appointment', $dataID, 'id', array('status_po' => 2));
            $this->session->set_flashdata('success', 'PO reject the appointment request.');
         }
      }
      redirect('appointment');
   }

   public function details($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('appointment', 'id', $dataID)) { 
         show_404('appointment - details - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->Appointment_model->get_info($dataID); 
      // if($this->data['info']->schedule_type == 'Appointment'){
      $this->data['persons'] = $this->My_appointment_model->get_appointment_persons($this->data['info']->id); 
      // }

      // Load page
      $this->data['meta_title'] = 'Appointment Details';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function update($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         redirect('dashboard');
      }

      // $dataID = $id; //exit;
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('appointment', 'id', $dataID)) { 
         show_404('appointment - update - exitsts', TRUE);
      }

      //Validation      
      $this->form_validation->set_rules('title', 'schedule title / event name','required|trim|max_length[255]');
      $this->form_validation->set_rules('start_date', 'start date', 'required|trim');
      $this->form_validation->set_rules('start_time', 'start time', 'required|trim');
      $this->form_validation->set_rules('end_date', 'end date', 'required|trim');
      $this->form_validation->set_rules('end_time', 'end time', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $start_time = date("H:i", strtotime($this->input->post('start_time')));
         $end_time = date("H:i", strtotime($this->input->post('end_time')));

         $form_data = array(
            'schedule_type'   => $this->input->post('schedule_type'),
            'title'           => $this->input->post('title'),
            'date'            => $this->input->post('start_date').' '.$start_time,
            'date_end'        => $this->input->post('end_date').' '.$end_time,
            'venue'           => $this->input->post('venue'),
            'purpose'         => $this->input->post('purpose'),
            'person_name'     => $this->input->post('person_name'),
            'person_mobile_no'=> $this->input->post('person_mobile_no'),
            'person_email'    => $this->input->post('person_email'),
            'organization'    => $this->input->post('organization')
            );

         // Schedule Type Invitation
         if($this->input->post('schedule_type') == 'Invitation'){
            $form_data['event_name_chair']   = $this->input->post('event_name_chair');
            $form_data['event_chief_guest']  = $this->input->post('event_chief_guest');
            $form_data['event_special_guest']= $this->input->post('event_special_guest');
         }

         // print_r($form_data); exit;
         if($this->Common_model->edit('appointment',  $dataID, 'id', $form_data)){

            // Person Data 
            for ($i=0; $i<sizeof($_POST['name']); $i++) {
               //check exists data
               @$data_person_exists = $this->Common_model->exists('appointment_person', 'id', $_POST['hide_name'][$i]);
               if($data_person_exists){
                  $person_data = array(
                     'name'            => $_POST['name'][$i],
                     'designation'     => $_POST['designation'][$i],           
                     'office_address'  => $_POST['office_address'][$i],
                     'mobile_no'       => $_POST['mobile_no'][$i]
                     ); 
                  $this->Common_model->edit('appointment_person', $_POST['hide_name'][$i], 'id', $person_data);
               }else{
                  $person_data = array(
                     'data_id'         => $dataID,
                     'name'            => $_POST['name'][$i],
                     'designation'     => $_POST['designation'][$i],           
                     'office_address'  => $_POST['office_address'][$i],
                     'mobile_no'       => $_POST['mobile_no'][$i]
                     );
                  $this->Common_model->save('appointment_person', $person_data);

               }
            }

            $this->session->set_flashdata('success', 'Update information successfully.');
            redirect("appointment");
         }
      }

      //Dropdown
      $this->data['type_dd'] = $this->Common_model->get_schedule_type(); 

      //Results
      $this->data['info'] = $this->Appointment_model->get_info($dataID); 
      $this->data['persons'] = $this->Appointment_model->get_app_person($dataID); 

      // print_r($this->data['persons']); exit;
      // if($this->data['info']->schedule_type == 'Appointment'){
         
      // }
      
      //Load view
      $this->data['meta_title'] = 'Update Appointment';
      $this->data['subview'] = 'update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function create(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin())){
         redirect('/');
      }

      //Validation
      $this->form_validation->set_rules('title', 'schedule title / event name','required|trim|max_length[255]');
      // $this->form_validation->set_rules('mobile_no', 'mobile no', 'required|trim');
      $this->form_validation->set_rules('start_date', 'start date', 'required|trim');
      $this->form_validation->set_rules('start_time', 'start time', 'required|trim');
      $this->form_validation->set_rules('end_date', 'end date', 'required|trim');
      $this->form_validation->set_rules('end_time', 'end time', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $start_time = date("H:i", strtotime($this->input->post('start_time')));
         $end_time = date("H:i", strtotime($this->input->post('end_time')));

         $form_data = array(
            'schedule_type'   => $this->input->post('schedule_type'),
            'title'           => $this->input->post('title'),
            'date'            => $this->input->post('start_date').' '.$start_time,
            'date_end'        => $this->input->post('end_date').' '.$end_time,
            'venue'           => $this->input->post('venue'),
            'purpose'         => $this->input->post('purpose'),
            'person_name'     => $this->input->post('person_name'),
            'person_mobile_no'=> $this->input->post('person_mobile_no'),
            'person_email'    => $this->input->post('person_email'),
            'organization'    => $this->input->post('organization')
            );

         // Schedule Type Invitation
         if($this->input->post('schedule_type') == 'Invitation'){
            $form_data['event_name_chair']   = $this->input->post('event_name_chair');
            $form_data['event_chief_guest']  = $this->input->post('event_chief_guest');
            $form_data['event_special_guest']= $this->input->post('event_special_guest');
         }

         // echo '<pre>';
         // print_r($form_data); exit;
         // print_r($_POST); exit;

         if($this->Common_model->save('appointment', $form_data)){     
            // Send Message
            $mobile = '+88'.$this->input->post('phone');
            $message = 'Your appointment request send admin successfully. Please wait for confirmation sms. Thank You!';
            //$this->send_sms($mobile, $message);

            // Send Mail
            // $this->send_mail();

            // Schedule Type Appointment
            if($this->input->post('schedule_type') == 'Appointment'){
               $insert_id = $this->db->insert_id();
               // Insert Scout Unit under a group

               for ($i=0; $i<sizeof($_POST['name']); $i++) { 
                  $form_data2 = array(
                     'data_id'         => $insert_id,
                     'name'            => $_POST['name'][$i],
                     'designation'     => $_POST['designation'][$i],           
                     'office_address'  => $_POST['office_address'][$i],
                     'mobile_no'       => $_POST['mobile_no'][$i]
                     );
                  $this->Common_model->save('appointment_person', $form_data2);
               }
            }

            $this->session->set_flashdata('success', 'Create schedule successfully.');
            redirect("appointment");
         }
      }

      //Dropdown
      $this->data['type_dd'] = $this->Common_model->get_schedule_type(); 

      //Load view
      $this->data['meta_title'] = 'Create Appointment';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function delete($id){  
      //Check Authentication
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('appointment', 'id', $dataID)) { 
         show_404('appointment - delete - exitsts', TRUE);
      }

      //Delete data
      if($this->Appointment_model->appointment_destroy($dataID)){
         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Appointmetn delete successfully.');
         redirect("appointment");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("appointment");   
      }
   }

   function send_sms($mobile, $message){
      $api_key = "C20019945dde54c4697d80.43761214";
      $contacts = $mobile;
      $senderid = '8804445629106';
      $sms = $message;

      $URL = "http://sms.nanoitworld.com/smsapi?api_key=".urlencode($api_key)."&type=text&contacts=".urlencode($contacts)."&senderid=".urlencode($senderid)."&msg=".urlencode($sms);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$URL);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch, CURLOPT_POST, 0);
      try{
         $output = $content=curl_exec($ch);
        // print_r($output);
      }catch(Exception $ex){
         $output = "-100";
      }
      return $output; 
   }

   public function send_mail(){
      //Load email library
      $this->load->library('email');

      // $mailBody = "Hello, \r\n\r\n We received a request to reset your scouts password. \r\n Your verify code: \r\n\r\n Thanky You!";
      // ssl://smtp.gmail.com
      $mailBody = "Test mail digital schedule.";

      $config['protocol']     = 'smtp';
      $config['smtp_host']    = 'ssl://smtp.gmail.com';
      $config['smtp_port']    = '465';
      $config['smtp_ssl']     = 'tls';
      $config['smtp_timeout'] = '7';
      $config['smtp_user']    = 'testingemail9400@gmail.com'; //testingemail9400@gmail.com > te12345678
      $config['smtp_pass']    = 'te12345678';
      $config['charset']      = 'utf-8';
      $config['newline']      = "\r\n";
      $config['mailtype']     = 'text'; // or html
      $config['validation']   = TRUE; // bool whether to validate email or not      

      $this->email->initialize($config);

      $this->email->from('testingemail9400@gmail.com', 'Digital Schedule');
      $this->email->to('mostafa.csit@gmail.com'); 

      $this->email->subject('Account Activation - Digiatal Schedule');
      $this->email->message($mailBody);  

      // Send Mail
      if($this->email->send()){
         echo 'Email sent.';
      } else {
         show_error($this->email->print_debugger());
      }
   }

   function ajax_app_person_del($id){
      $this->Common_model->delete('appointment_person', 'id', $id);
      echo 'This information remove from database.';
   }

}