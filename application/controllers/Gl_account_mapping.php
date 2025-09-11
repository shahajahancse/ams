<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gl_account_mapping extends Backend_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Gl_account_mapping_model', 'mapping_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->data['mappings'] = $this->mapping_model->get_mappings();
        $this->data['subview'] = 'gl_account_mapping/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add() {
        $this->data['categories'] = $this->mapping_model->get_all_categories();

        $this->form_validation->set_rules('category_id', 'Category', 'required|is_unique[gl_account_mapping.category_id]');
        $this->form_validation->set_rules('asset_cost_account', 'Asset Cost Account', 'required');
        $this->form_validation->set_rules('accumulated_depreciation_account', 'Accumulated Depreciation Account', 'required');
        $this->form_validation->set_rules('depreciation_expense_account', 'Depreciation Expense Account', 'required');
        $this->form_validation->set_rules('gain_loss_on_disposal_account', 'Gain/Loss on Disposal Account', 'required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'category_id' => $this->input->post('category_id'),
                'asset_cost_account' => $this->input->post('asset_cost_account'),
                'accumulated_depreciation_account' => $this->input->post('accumulated_depreciation_account'),
                'depreciation_expense_account' => $this->input->post('depreciation_expense_account'),
                'gain_loss_on_disposal_account' => $this->input->post('gain_loss_on_disposal_account')
            );
            $this->mapping_model->create_mapping($data);
            redirect('gl_account_mapping');
        }

        $this->data['subview'] = 'gl_account_mapping/add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id) {
        $this->data['mapping'] = $this->mapping_model->get_mapping($id);
        $this->data['categories'] = $this->mapping_model->get_all_categories();

        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('asset_cost_account', 'Asset Cost Account', 'required');
        $this->form_validation->set_rules('accumulated_depreciation_account', 'Accumulated Depreciation Account', 'required');
        $this->form_validation->set_rules('depreciation_expense_account', 'Depreciation Expense Account', 'required');
        $this->form_validation->set_rules('gain_loss_on_disposal_account', 'Gain/Loss on Disposal Account', 'required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'category_id' => $this->input->post('category_id'),
                'asset_cost_account' => $this->input->post('asset_cost_account'),
                'accumulated_depreciation_account' => $this->input->post('accumulated_depreciation_account'),
                'depreciation_expense_account' => $this->input->post('depreciation_expense_account'),
                'gain_loss_on_disposal_account' => $this->input->post('gain_loss_on_disposal_account')
            );
            $this->mapping_model->update_mapping($id, $data);
            redirect('gl_account_mapping');
        }

        $this->data['subview'] = 'gl_account_mapping/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function delete($id) {
        $this->mapping_model->delete_mapping($id);
        redirect('gl_account_mapping');
    }
}