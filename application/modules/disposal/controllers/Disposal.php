<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposal extends Backend_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('disposal_model', 'dis_model');
        $this->load->library('form_validation');
        $this->data['module_title'] = 'Disposal';
    }

    public function index() {
        $this->data['disposed_assets'] = $this->dis_model->get_disposed_assets();
        $this->data['meta_title'] = 'Disposed Assets';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function record($asset_id) {
        $this->data['asset'] = $this->dis_model->get_asset_details($asset_id);
        $this->data['meta_title'] = 'Record Disposal';
        $this->data['subview'] = 'record';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function save_disposal() {
        $asset_id = $this->input->post('asset_id');
        $disposal_data = array(
            'disposal_date' => $this->input->post('disposal_date'),
            'disposal_type' => $this->input->post('disposal_type'),
            'sale_proceeds' => $this->input->post('sale_proceeds'),
            'asset_status' => 'Disposed'
        );

        $this->dis_model->update_asset($asset_id, $disposal_data);
        $this->dis_model->generate_disposal_journal_entry($asset_id);

        $this->session->set_flashdata('success', 'Asset disposal recorded successfully.');
        redirect('disposal');
    }

}