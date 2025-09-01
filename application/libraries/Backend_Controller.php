<?php
include 'classes/BanglaConverter.php';

class Backend_Controller extends MY_Controller{
	var $userSessID;
	// var $officeSess;

	function __construct (){
		parent::__construct();
		$this->ci_minifier->init(0);

		$this->session->set_userdata('site_lang', 'english');
		$this->lang->load('scouts', 'english');
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning"> <i class="fa fa-warning"></i> ', '</div>');
		$this->lang->load('auth');
		$this->data['meta_title'] = 'Page Title';
		$this->data['domain_title'] = 'BCCT';
		$this->load->model('Common_model');
		$this->userSessID = $this->session->userdata('user_id');
		$this->unit_id = $this->session->userdata('unit_id');
      	$this->data['userDetails'] = $this->Common_model->get_user_details();

		$this->data['user_ntfy'] = 0;
		$this->data['req_ntfy'] = 0;
		$this->data['per_ntfy'] = 0;
		$this->data['stk_ntfy'] = 0;
		if ($this->ion_auth->logged_in()) {
			$this->data['user_ntfy'] = $this->Common_model->user_ntfy($this->userSessID);
			$this->data['req_ntfy'] = $this->Common_model->req_ntfy();
			$this->data['per_ntfy'] = $this->Common_model->per_ntfy();
			$this->data['stk_ntfy'] = $this->Common_model->stk_ntfy();
		}
    }
}
