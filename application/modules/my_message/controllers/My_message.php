<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_message extends Backend_Controller {

	public function __construct(){
		parent::__construct();

		if (!$this->ion_auth->logged_in()):
			redirect('login');
		endif;
		if (!$this->ion_auth->is_admin()):
			redirect('dashboard');
		endif;
		
		$this->load->model('My_message_model');
	}

	public function index(){
      //Load page       
		$this->data['page_title'] = 'My Message';
		$this->data['subview'] = 'index';
		$this->load->view('backend/_layout_main', $this->data);
	}

	public function blank(){
		$this->data['page_heading'] = 'Blank Page';
		$this->data['subview'] = 'dashboard/blank';
		$this->load->view('backend/_layout_main', $this->data);
	}	

}