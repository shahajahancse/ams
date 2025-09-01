<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends Backend_Controller {

	public function __construct(){
		parent::__construct();	
		//$this->load->model('Common_model');
		// $this->load->model('Shop_model');
		
		// print_r($this->session->all_userdata());
	}

	public function index(){
		if ($this->ion_auth->logged_in()){
			redirect('dashboard');
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
				'type'  => 'text',
				'id'    => 'identity',
				'class' => 'form-control',
				'placeholder' => 'Registered email or username or scout ID',
				'value' => $this->form_validation->set_value('identity'),
			);			
			$this->data['password'] = array('name' => 'password',
				'type' => 'password',
				'id'   => 'password-field',
				'class' => 'form-control',
				'placeholder' => 'Password',
			);
			
			$this->data['meta_title'] = 'Login';
			$this->data['subview'] = 'index';
	    	$this->load->view('login/_layout_main', $this->data);
		}
	}

	// log the user out
	public function logout()
	{
		// log the user out
		$logout = $this->ion_auth->logout();
		
		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('adminlogin');
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
	
}
