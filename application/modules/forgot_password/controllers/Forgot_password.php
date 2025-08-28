<?php defined('BASEPATH') OR exit('No direct script access allowed');
include 'classes/SMSClient.php';

class Forgot_password extends Backend_Controller {
	var $smsUser;
	public function __construct(){
		parent::__construct();	
		if ($this->ion_auth->logged_in()){
			redirect('dashboard');
		}

		$this->smsUser = new SMSClient('1587652994', '^Rl:_w=[', 'http://www.sms4bd.net');
		$this->load->helper('string');
	}

	public function index(){
		// setting validation rules by checking whether identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email'){
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}else{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}

		if ($this->form_validation->run() == true){
			// $identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->input->post('identity');
			$where = "username='$identity'";
			$userinfo = $this->ion_auth->where($where)->users()->row();
			
			$code  = random_string('numeric', 6);
			// $mailBody = 'Your verify code : '.$code;
			// if(!empty($userinfo->phone)){
			// 	$config['protocol']    = 'smtp';
			// 	$config['smtp_host']    = 'ssl://smtp.gmail.com';
			// 	$config['smtp_port']    = '465';
			// 	$config['smtp_timeout'] = '7';
			// 	$config['smtp_user']    = 'testingemail9400@gmail.com';
			// 	$config['smtp_pass']    = 'te12345678';
			// 	$config['charset']    = 'utf-8';
			// 	$config['newline']    = "\r\n";
	  //       $config['mailtype'] = 'text'; // or html
	  //       $config['validation'] = TRUE; // bool whether to validate email or not      

	  //       $this->email->initialize($config);

	  //       $this->email->from('testingemail9400@gmail.com', 'Scouts');
	  //       $this->email->to('mostafa.csit@gmail.com'); 

	  //       $this->email->subject('Forgot password verify code.');
	  //       $this->email->message($mailBody);  

	  //       $this->email->send();
	  //    }

	  //    $form_data = array(
	  //    	'verify_code' => $code 
	  //    	);
	  //    if($this->Common_model->edit('users', $userinfo->id, 'id', $form_data)){
	  //    	redirect("forgot_password/verify_change_password"); 
			// 			//we should display a confirmation page here instead of the login page
	  //    }


	     // if(!empty($userinfo->phone)){

	     // 	$phone ='+88'.$userinfo->phone;
	    	// 	// $code  = random_string('numeric', 6);
	     // 	$message='Your Verify Code: '.$code .' (Bangladesh Scouts)';

	     // 	$response = $this->smsUser->SendSMS("softheaven", $phone, $message, date('Y-m-d H:i:s'), SMSType::UCS2);
	     // 	$result = $response->StatusMessage;  

	     // 	if($result = 'Accepted'){
	     // 		$newdata = array(
	     // 			'forget_id'  => $userinfo->id,
	     // 			'verify_code' => $code 
	     // 			);


	     // 		$this->session->set_userdata($newdata);

	     // 	}else{
	     // 		$this->session->set_flashdata('message', 'Sorry');
	     // 	}

			if(!empty($userinfo)){
				$newdata = array(
					'forget_id'  => encrypt_url($userinfo->id),
					'verify_code'=> encrypt_url($code)
					);
				$this->session->set_userdata($newdata);
				// print_r($this->session->all_userdata()); exit;
				redirect("forgot_password/get_verification_code"); 

			}else{
				if($this->config->item('identity', 'ion_auth') != 'email'){
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}else{
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');


			// run the forgotten password method to email an activation code to the user
			// $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			// if ($forgotten){
			// 	// if there were no errors
			// 	$this->session->set_flashdata('message', $this->ion_auth->messages());
			// 	redirect("login"); //we should display a confirmation page here instead of the login page
			// }else{
			// 	$this->session->set_flashdata('message', $this->ion_auth->errors());
			// 	redirect("index");
			// }

			// $this->data['info'] = $userinfo;

			// // if ( $this->config->item('identity', 'ion_auth') != 'email' ){
			// // 	$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			// // }else{
			// // 	$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			// // }

			// // // set any errors and display the form
			// // $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			// $this->data['meta_title'] = 'Get a verification code';
			// $this->data['subview'] = 'get_verification_code';
			// $this->load->view('login/_layout_main', $this->data);
			}
			
		}


		$this->data['identity'] = array(
			'name' => 'identity',
			'id' => 'identity',
			'class' => 'form-control',
			'placeholder' => '',
			);

		//view
		$this->data['meta_title'] = 'Forgot Password';
		$this->data['subview'] = 'index';
		$this->load->view('login/_layout_main', $this->data);
	}

	public function get_verification_code(){
		$user_id = (int) decrypt_url($this->session->userdata('forget_id'));
		// Check Exists
		if(!$this->Common_model->exists('users', 'id', $user_id)){
			show_404('forgot_password - get_verification_code - exists', TRUE);
		} 

		// $this->data['verify_code'] = $this->session->userdata('verify_code');// exit;			
		$where = "id='$user_id'";
		$userinfo = $this->ion_auth->where($where)->users()->row();

		//Display email or mobile number for send code
		if(filter_var($userinfo->username, FILTER_VALIDATE_EMAIL) && filter_var($userinfo->email, FILTER_VALIDATE_EMAIL)){
			$this->data['emails'] = array(
				encrypt_url($userinfo->username) => func_imp_email($userinfo->username), 
				encrypt_url($userinfo->email) => func_imp_email($userinfo->email)
				);
			//echo $key = array_search ('1', $this->data['emails']); exit;
			$this->form_validation->set_rules('email', 'Select at least one email address.', 'required');

		}elseif(filter_var($userinfo->username, FILTER_VALIDATE_EMAIL)){
			$this->data['emails'] = array(encrypt_url($userinfo->username) => func_imp_email($userinfo->username));
			$this->form_validation->set_rules('email', 'Select email address.', 'required');

		}elseif(filter_var($userinfo->email, FILTER_VALIDATE_EMAIL)){
			$this->data['emails'] = array(encrypt_url($userinfo->email) => func_imp_email($userinfo->email));
			$this->form_validation->set_rules('email', 'Select email address.', 'required');
		}	

		//validate and send code
		if ($this->form_validation->run() == true){
			//Run
			if($user_id != $userinfo->id){
				redirect('forget-password');
			}

			//echo decrypt_url($this->input->post('email')); exit;
			if($this->sendForgotCode($this->session->userdata('forget_id'), $this->input->post('email'), $this->session->userdata('verify_code'))){
				redirect("forgot_password/verify_change_password");
			}
		}

		//view
		$this->data['meta_title'] = 'Get a verification code';
		$this->data['subview'] = 'get_verification_code';
		$this->load->view('login/_layout_main', $this->data);
	}

	public function sendForgotCode($userID, $email, $code){
		//Decrypt userid
		$userID = (int) decrypt_url($userID);
		// Check Exists
		if(!$this->Common_model->exists('users', 'id', $userID)){
			show_404('forgot_password - sendForgotCode - exists', TRUE);
		} 
		//Decrypt method
		$email = decrypt_url($email);
		$code  = decrypt_url($code);

		$mailBody = "Hello, \r\n\r\n We received a request to reset your scouts password. \r\n Your verify code: ".$code."\r\n\r\n Thanky You!";

		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'testingemail9400@gmail.com'; //bdscouts.noreply@gmail.com > bdScouts*7
		$config['smtp_pass']    = 'te12345678';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
      $config['mailtype'] = 'text'; // or html
      $config['validation'] = TRUE; // bool whether to validate email or not      

      $this->email->initialize($config);

      $this->email->from('testingemail9400@gmail.com', 'TMED Inventroy');
      $this->email->to($email); 

      $this->email->subject('Forgot password verify code.');
      $this->email->message($mailBody);  

      //send mail
      $this->email->send();

      //Insert db
      $form_data = array( 'verify_code' => $code);

      if($this->Common_model->edit('users', $userID, 'id', $form_data)){
      	return TRUE;
	   	// redirect("forgot_password/verify_change_password"); 
      }
   }


   public function verify_change_password(){
   	$this->form_validation->set_rules('verify_code', 'Varify Code', 'required');
   	$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
   	$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

   	if ($this->form_validation->run() == TRUE){
   		$forget_id 		= decrypt_url($this->session->userdata('forget_id'));
   		$verify_code 	= decrypt_url($this->session->userdata('verify_code'));

   		if($verify_code == $this->input->post('verify_code')){
   			$change = $this->ion_auth->forget_change_password($forget_id, $this->input->post('new'));

   			if ($change){
					//if the password was successfully changed
   				$this->session->set_flashdata('message', $this->ion_auth->messages());
   				redirect("login");
   			} else {
   				$this->session->set_flashdata('message', $this->ion_auth->errors());
   			}
   			
   		}else{
   			$this->session->set_flashdata('message', '<div class="alert alert-warning"> <i class="fa fa-warning"></i> Your verify code no match.</div>');
   		}
   	}

   	$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

   	//view
   	$this->data['meta_title'] = 'Verify Code and Change Password';
   	$this->data['subview'] = 'verify';
   	$this->load->view('login/_layout_main', $this->data);
   }
}
