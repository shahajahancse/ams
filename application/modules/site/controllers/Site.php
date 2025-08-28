<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'classes/BanglaConverter.php';

class Site extends Frontend_Controller {
   var $userSessID;
   var $img_path;

	function __construct (){
		parent::__construct();
      $this->userSessID = $this->session->userdata('user_id');
      $this->img_path = realpath(APPPATH . '../uploads/identity_docs');
      // print_r($this->session->all_userdata());   
      // print_r($this->lang);
      // $this->load->model('dashboard/Dashboard_model'); 
      // $this->load->model('offices/Offices_model'); 
   } 

   public function index(){
      $this->data['meta_title'] = 'Home';
      $this->data['subview'] = 'index';
      $this->load->view('frontend/_layout_main', $this->data);
   }

   public function pass_queue(){
      $this->data['results'] = $this->Site_model->get_approve_pass();
      // print_r($results); exit;

      $this->data['meta_title'] = 'Pass Queue | Technical and Madrasah Education Division';
      $this->load->view('pass_queue', $this->data);
   }

   public function create_appointment(){
      if (!$this->ion_auth->logged_in()){
         redirect('/');
      }
      
      // print_r($user);
      // print_r($this->session->all_userdata()); 

      //Validation
      $this->form_validation->set_rules('title', 'title','required|trim|max_length[255]');
      // $this->form_validation->set_rules('mobile_no', 'mobile no', 'required|trim');
      $this->form_validation->set_rules('date', 'date and time', 'required|trim');
      $this->form_validation->set_rules('venue', 'venue', 'required|trim');
      $this->form_validation->set_rules('purpose', 'purpose', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $user = $this->ion_auth->user()->row();
         $form_data = array(
            'author'          => $user->id,
            'schedule_type'   => $this->input->post('schedule_type'),
            'title'           => $this->input->post('title'),
            'organization'    => $this->input->post('organization'),
            'mobile_no'       => $user->phone,
            'email'           => $user->username,
            'date'            => $this->input->post('date'),
            'venue'           => $this->input->post('venue'),
            'purpose'         => $this->input->post('purpose')
            );

         // print_r($form_data); exit;
         if($this->Common_model->save('appointment', $form_data)){           
            $this->session->set_flashdata('success', 'Create schedule successfully.');
            redirect("my-appointment");
         }
      }

      //Dropdown
      $this->data['type_dd'] = $this->Common_model->get_schedule_type();

      //view
      $this->data['meta_title'] = 'Create Appointment';
      $this->data['subview'] = 'create_appointment';
      $this->load->view('frontend/_layout_main', $this->data);
   }  

   public function my_appointment(){
      if (!$this->ion_auth->logged_in()){
         redirect('/');
      }

      //Results
      $this->data['results'] = $this->Site_model->get_my_appointment();

      //view
      $this->data['meta_title'] = 'My Appointment';
      $this->data['subview'] = 'my_appointment';
      $this->load->view('frontend/_layout_main', $this->data);
   }

   public function appointment_details($id){
      if (!$this->ion_auth->logged_in()){
         redirect('/');         
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('appointment', 'id', $dataID)) { 
         show_404('appointment - delete - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->Site_model->get_appointment_info($dataID);

      //view
      $this->data['meta_title'] = 'Appointment Details';
      $this->data['subview'] = 'appointment_details';
      $this->load->view('frontend/_layout_main', $this->data);
   }

   public function my_account(){
      if (!$this->ion_auth->logged_in()){
         redirect('/');
      }
      
      // Result
      $this->data['info'] = $this->ion_auth->user()->row();

      //view
      $this->data['meta_title'] = 'My Account Information';
      $this->data['subview'] = 'my_account';
      $this->load->view('frontend/_layout_main', $this->data);
   }

   public function registration(){     
      //echo strlen('Congratulations! You have successfully registered with the BCCT Digital Schedule System. Please check mail for account activation. '); 
      //echo $name = ucwords('a mosrafa');
      //$mailBody = "Dear ".$name.", \r\n\r\n Welcome to BCCT \r\n Thanks your for registration with us. \r\n\r\n If you want to get appointment please login to your account. \r\n\r\n\r\n\r\n Thank You!"; 
      // Send Mail
      //$this->send_mail($mailBody); 

      if ($this->ion_auth->logged_in()){
         redirect('dashboard');
      }

      // Ion Config Table
      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      // validate form input
      $this->form_validation->set_rules('full_name', 'full name', 'required|trim');
      if($identity_column!=='email'){
         $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'valid_email');
      }else{
         $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
      }

      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|numeric|trim');
      $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');

      if(@$_FILES['userfile']['size'] > 0){
         $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      }

      if ($this->form_validation->run() == true){
         $email    = strtolower($this->input->post('email'));
         $identity = ($identity_column==='email') ? $email : strtolower($this->input->post('identity'));
         $password = $this->input->post('password');

         $additional_data = array(
            'first_name'    => $this->input->post('full_name'),
            'org_prof_name' => $this->input->post('org_prof_name'),
            'phone'         => $this->input->post('phone')
            );

         // Image Upload
         if($_FILES['userfile']['size'] > 0){
            $new_file_name = time().'-'.$_FILES["userfile"]['name'];
            $config['allowed_types']= 'jpg|png|jpeg';
            $config['upload_path']  = $this->img_path;
            $config['file_name']    = $new_file_name;
            $config['max_size']     = 60000;

            $this->load->library('upload', $config);
            //upload file to directory
            if($this->upload->do_upload()){
               $uploadData = $this->upload->data();
               // $config = array(
               //    'source_image' => $uploadData['full_path'],
               //    'new_image' => $this->img_path,
               //    'maintain_ratio' => TRUE,
               //    'width' => 300,
               //    'height' => 300
               //    );
               // $this->load->library('image_lib',$config);
               // $this->image_lib->initialize($config);
               // $this->image_lib->resize();

               $uploadedFile = $uploadData['file_name'];
               // print_r($uploadedFile);
            }else{
               $this->data['message'] = $this->upload->display_errors();
            }
         }

         if($_FILES['userfile']['size'] > 0){
            $additional_data['identity_doc'] = $uploadedFile;
         }

         // echo '<pre>';
         // print_r($this->input->post()); exit;
      }

      if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data)){
         // Send Message
         $mobile = '+88'.$this->input->post('phone');
         $message = 'Congratulations! You have successfully registered with the BCCT Digital Schedule System. Please check your mail for BCCT account activation link.';
         // $this->send_sms($mobile, $message);

         // Send Mail
         //$this->send_mail(); 

         // check to see if we are creating the user
         // redirect them back to the admin page
         $this->session->set_flashdata('message', $this->ion_auth->messages());
         redirect("login");
      }else{
         // display the create user form
         // set the flash data error message if there is one
         $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

         //Form Fields
         $this->data['full_name'] = array('name' => 'full_name',
            'type'  => 'text',
            'class' => 'form-control',
            'placeholder' => '',
            'value' => $this->form_validation->set_value('full_name'),
            'required' => 'required',
            );
         // $this->data['identity'] = array('name' => 'identity',
         //    'type'  => 'email',
         //    'class' => 'form-control',
         //    'id'    => 'identity',
         //    'placeholder' => '',
         //    'value' => $this->form_validation->set_value('identity'),
         //    'style' => 'text-transform: lowercase;',
         //    'required' => 'required',
         //    );  

         $this->data['identity'] = array(
            'name'   => 'email',
            'type'   => 'email',
            'class'  => 'form-control',
            'id'     => 'email',
            'placeholder' => '',
            'value' => $this->form_validation->set_value('email'),
            );

         $this->data['phone'] = array('name' => 'phone',
            'type'  => 'tel',
            'class' => 'form-control',
            'placeholder' => '11 Digit',
            'value' => $this->form_validation->set_value('phone'),
            'required' => 'required',
            );
         $this->data['password'] = array('name' => 'password',
            'type' => 'password',
            'id'   => 'password-field',
            'class' => 'form-control',
            'placeholder' => '',
            'required' => 'required',
            );
         $this->data['password_confirm'] = array('name' => 'password_confirm',
            'type'  => 'password',
            'id'    => 'password-field-conf',
            'class' => 'form-control',
            'placeholder' => '',
            'value' => $this->form_validation->set_value('password_confirm'),
            'required' => 'required',
            );

         //view
         $this->data['meta_title'] = 'Registration';
         $this->data['subview'] = 'registration';
         $this->load->view('frontend/_layout_main', $this->data);
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

   public function send_mail($mailBody){
      //Load email library
      $this->load->library('email');

      // $mailBody = "Hello, \r\n\r\n We received a request to reset your scouts password. \r\n Your verify code: \r\n\r\n Thanky You!";
      // ssl://smtp.gmail.com

      $config['protocol']     = 'smtp';
      $config['smtp_host']    = 'mail.mysoftheaven.com';
      $config['smtp_port']    = '587';
      $config['smtp_ssl']     = 'tls';
      $config['smtp_timeout'] = '7';
      $config['smtp_user']    = 'noreply@mysoftheaven.com'; //testingemail9400@gmail.com > te12345678
      $config['smtp_pass']    = 'noreply@0077';
      $config['charset']      = 'utf-8';
      $config['newline']      = "\r\n";
      $config['mailtype']     = 'text'; // or html
      $config['validation']   = TRUE; // bool whether to validate email or not      

      $this->email->initialize($config);

      $this->email->from('mostafa@mysoftheaven.com', 'Digital Schedule');
      $this->email->to('mostafa.csit@gmail.com'); 

      $this->email->subject('Account Verification - Digiatal Schedule');
      $this->email->message($mailBody);  

      // Send Mail
      $this->email->send();

      // if($this->email->send()){
      //    echo 'Email sent.';
      // } else {
      //    show_error($this->email->print_debugger());
      // }

   }


   public function login(){
      if ($this->ion_auth->logged_in()){
         redirect('my-account');
      }

      //validate form input
      $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
      $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

      if ($this->form_validation->run() == true){
         // check to see if the user is logging in
         // check for "remember me"
         $remember = (bool) $this->input->post('remember');

         if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)){
            //if the login is successful
            //redirect them back to the home page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            // echo 'Login';
            // print_r($this->session->all_userdata()); exit;
            //$user_groups = $this->ion_auth->get_users_groups()->result();
            // echo '<pre>';
            //print_r($user_groups[0]->id); //exit;
            // redirect('my-account');
            redirect('dashboard');
         }else{
            // if the login was un-successful
            // redirect them back to the login page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
               redirect('login'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
         }else{
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['identity'] = array('name' => 'identity',
               'type'  => 'email',
               'id'    => 'identity',
               'class' => 'form-control',
               'placeholder' => 'Email address',
               'value' => $this->form_validation->set_value('identity'),
               );          
            $this->data['password'] = array('name' => 'password',
               'type' => 'password',
               'id'   => 'password-field',
               'class' => 'form-control',
               'placeholder' => 'Password',
               );
            
            //view
            $this->data['meta_title'] = 'Login';
            $this->data['subview'] = 'login';
            $this->load->view('frontend/_layout_main', $this->data);
         }
      }

      // log the user out
      public function logout() {
         // log the user out
         $logout = $this->ion_auth->logout();

         // redirect them to the login page
         $this->session->set_flashdata('message', $this->ion_auth->messages());
         redirect('/');
      }

      // activate the user
      public function activate($id, $code=false){
         if ($code !== false){
            $activation = $this->ion_auth->activate($id, $code);
         }else if ($this->ion_auth->is_admin()){
            $activation = $this->ion_auth->activate($id);
         }

         if ($activation){
            // redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("login");
         }else{
            // redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("forgot_password");
         }
      }

      public function user_manual(){
         $this->data['meta_title'] = 'User Manual';
         $this->data['subview'] = 'user_manual';
         $this->load->view('frontend/_layout_main', $this->data);
      }

      public function contact(){
         $this->data['meta_title'] = 'Contact';
         $this->data['subview'] = 'contact';
         $this->load->view('frontend/_layout_main', $this->data);
      }

      // public function sendemail(){
      //    $this->data['setting'] = $this->Common_model->get_info('setting');
      //    $this->load->library('email');
      //    $this->email->initialize(array(
      //       'protocol' => 'smtp',
      //       'smtp_host' => 'smtp.sendgrid.net',
      //       'smtp_user' => 'sendgridusername',
      //       'smtp_pass' => 'sendgridpassword',
      //       'smtp_port' => 587,
      //       'crlf' => "\r\n",
      //       'newline' => "\r\n"
      //       ));

      //    $this->email->from($this->input->post('email'), $this->input->post('name'));
      //    $this->email->to($this->data['setting']->contact_email);
      //    $this->email->subject($this->input->post('subject'));
      //    $this->email->message($this->input->post('message'));
      //    $this->email->send();

      //    // echo $this->email->print_debugger();
      //    redirect('contact-us');
      // }      

      public function success(){   
         $this->data['meta_title'] = 'Feedback Form';        
         $this->data['subview'] = 'success';
         $this->load->view('frontend/_layout_main', $this->data);
      } 

      public function not_found(){
         $this->data['meta_title'] = 'Not found';        
         $this->data['subview'] = 'not_found';
         $this->load->view('not_found', $this->data);
      }

      public function err404(){
         $this->data['meta_title'] = 'Page not found';
         $this->data['subview'] = 'err404';
         $this->load->view('frontend/_layout_main', $this->data);
      }

      public function switchlang($language = NULL){
         $this->session->set_userdata('site_lang', $language);
         redirect($_SERVER['HTTP_REFERER']);
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

      function ajax_exists_identity(){
         // echo 'true';
         $item = $_POST['inputData'];
         $result = $this->Common_model->exists('users', 'username', $item);

         if ($result == 0) {
            echo 'true';
         }else{
            echo 'false';
         }
      }

   }