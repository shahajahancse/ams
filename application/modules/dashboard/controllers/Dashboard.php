<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Backend_Controller {
	var $userData;

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('login');
		}

		$this->data['module_name'] = 'Dashboard';
		$this->load->model('Dashboard_model');
		$this->load->model('requisition/Requisition_model');
		$this->userData = $this->Common_model->get_user_details();
	}

	public function index(){
		$tf = false;
		if(!$this->ion_auth->in_group(array('admin'))){
            $tf = true;
        }
		$r = $this->Dashboard_model->count_data($tf);
		$this->data['total_data'] = $r->apv+$r->rej+$r->apv1+$r->pen+$r->pen1+$r->pen2;

		$this->data['total_pending'] = $r->pen + $r->pen1 + $r->pen2;
		$this->data['total_approve'] = $r->apv + $r->apv1;
		$this->data['total_rejected'] = $r->rej;

		$p = $this->Dashboard_model->count_data_parches($tf);
		$this->data['total_datap'] = $p->apv+$p->rej+$p->apv1+$p->pen1+$p->pen2+$p->pen3+$p->pen4;
		$this->data['total_pendingp'] = $p->pen1 + $p->pen2 + $p->pen3 + $p->pen4;
		$this->data['total_approvep'] = $p->apv + $p->apv1;
		$this->data['total_rejectedp'] = $p->rej;

		// Load Page
		$this->data['user'] = $this->userData['user_info'];
		$this->data['meta_title'] = 'Dashboard';
		if($this->ion_auth->in_group(array('staff'))){
			$this->data['subview'] = 'user_dashboard';
		} else {
			$this->data['subview'] = 'admin_dashboard';
		}
		$this->load->view('backend/_layout_main', $this->data);
	}

	public function ajax_get_data(){
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$unit_id = $this->input->post('unit_id');

		$r = $this->Dashboard_model->count_data(null, $from_date, $to_date, $unit_id);
		$this->data['total_data'] = $r->apv+$r->rej+$r->apv1+$r->pen+$r->pen1+$r->pen2+$r->pen3+$r->pen4+$r->pen5;
		$this->data['total_pending'] = $r->pen + $r->pen1 + $r->pen2 + $r->pen3 + $r->pen4 + $r->pen5;
		$this->data['total_approve'] = $r->apv + $r->apv1;
		$this->data['total_rejected'] = $r->rej;

		$p = $this->Dashboard_model->count_data_parches(null, $from_date, $to_date, $unit_id);
		$this->data['total_datap'] = $p->apv+$p->rej+$p->apv1+$p->pen+$p->pen1+$p->pen2+$p->pen3+$p->pen4;
		$this->data['total_pendingp'] = $p->pen + $p->pen1 + $p->pen2 + $p->pen3 + $p->pen4;
		$this->data['total_approvep'] = $p->apv + $p->apv1;
		$this->data['total_rejectedp'] = $p->rej;

		if ($this->data['total_data'] != 0) {
			$this->data['per_pending'] = ($this->data['total_pending'] / $this->data['total_data']) * 100;
			$this->data['per_approve'] = ($this->data['total_approve'] / $this->data['total_data']) * 100;
			$this->data['per_rejected'] = ($this->data['total_rejected'] / $this->data['total_data']) * 100;
		}else{
			$this->data['per_pending'] = 0;
			$this->data['per_approve'] = 0;
			$this->data['per_rejected'] = 0;
		}

		if ($this->data['total_datap'] != 0) {
			$this->data['per_pendingp'] = ($this->data['total_pendingp'] / $this->data['total_datap']) * 100;
			$this->data['per_approvep'] = ($this->data['total_approvep'] / $this->data['total_datap']) * 100;
			$this->data['per_rejectedp'] = ($this->data['total_rejectedp'] / $this->data['total_datap']) * 100;
		}else{
			$this->data['per_pendingp'] = 0;
			$this->data['per_approvep'] = 0;
			$this->data['per_rejectedp'] = 0;
		}
		echo json_encode($this->data);
	}



	public function ajaxevent(){
		if (!$this->ion_auth->logged_in()){
			redirect('login');
		}

		$session_data = $this->session->userdata('user_id');  // get id of author
		//$this->db->where('author', $session_data); // get data 'where' author=session.id
		$result =  $this->db->where('status', 1)->get('appointment')->result_array();
		// print_r($result); exit;
		print_r(json_encode($result));
	}
	public function no_assign(){
			//Load page
		$this->data['meta_title'] = 'No Assign';
		$this->data['subview'] = 'no_assign';
		$this->load->view('backend/_layout_main', $this->data);
	}

}
