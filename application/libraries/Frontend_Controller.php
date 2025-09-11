<?php
class Frontend_Controller extends MY_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->ci_minifier->init('0');

		// $this->session->sess_destroy();
		// if($this->session->userdata('site_lang')) {
		// 	$this->lang->load('scouts', $this->session->userdata('site_lang'));
		// } else {
		// 	$this->session->set_userdata('site_lang', 'bangla');
			// $this->lang->load('scouts', 'bangla');
		// }
		$this->lang->load('scouts', 'english');

		$this->form_validation->set_error_delimiters('<div class="alert alert-warning"> <i class="fa fa-warning"></i> ', '</div>');
		$this->load->model('Site_model');
		$this->load->model('Common_model');

		$this->data['meta_title'] = 'Asset Management System';
		$this->data['meta_keywords'] = 'AMS';
		$this->data['meta_description'] = 'Asset Management System';

		$this->data['contact_email'] = '';
		$this->data['contact_phone'] = '';
		$this->data['domain_title'] = '';
	}
}
