<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depreciation extends Backend_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('depreciation_model', 'dep_model');
        $this->load->library('form_validation');
        $this->data['module_title'] = 'Depreciation';
    }

    public function index() {
        $this->data['meta_title'] = 'Run Depreciation';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function run_depreciation() {
        $this->dep_model->run_monthly_depreciation();
        $this->session->set_flashdata('success', 'Monthly depreciation has been run successfully.');
        redirect('depreciation');
    }

}