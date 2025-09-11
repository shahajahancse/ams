<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbs_integration extends Backend_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cbs_integration_model', 'cbs_model');
        $this->load->library('form_validation');
        $this->data['module_title'] = 'CBS Integration';
    }

    public function gl_account_mapping() {
        $this->data['mappings'] = $this->cbs_model->get_mappings();
        $this->data['meta_title'] = 'GL Account Mapping';
        $this->data['subview'] = 'gl_account_mapping/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function add_gl_account_mapping() {
        $this->data['categories'] = $this->cbs_model->get_all_categories();

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
            $this->cbs_model->create_mapping($data);
            redirect('cbs_integration/gl_account_mapping');
        }

        $this->data['meta_title'] = 'Add GL Account Mapping';
        $this->data['subview'] = 'gl_account_mapping/add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit_gl_account_mapping($id) {
        $this->data['mapping'] = $this->cbs_model->get_mapping($id);
        $this->data['categories'] = $this->cbs_model->get_all_categories();

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
            $this->cbs_model->update_mapping($id, $data);
            redirect('cbs_integration/gl_account_mapping');
        }

        $this->data['meta_title'] = 'Edit GL Account Mapping';
        $this->data['subview'] = 'gl_account_mapping/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function delete_gl_account_mapping($id) {
        $this->cbs_model->delete_mapping($id);
        redirect('cbs_integration/gl_account_mapping');
    }

    public function export_journal_entries() {
        $this->load->helper('csv');
        $journal_entries = $this->cbs_model->get_journal_entries();
        $filename = 'journal_entries_'.date('Ymd').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // file creation
        $file = fopen('php://output', 'w');

        $header = array("ID", "Entry Date", "Asset ID", "GL Account", "Debit", "Credit", "Description", "Entry Type");
        fputcsv($file, $header);

        foreach ($journal_entries as $key=>$line){
            fputcsv($file,$line);
        }

        fclose($file);
        exit;
    }

    public function reconciliation_report() {
        $this->data['report_data'] = $this->cbs_model->get_reconciliation_data();
        $this->data['meta_title'] = 'Reconciliation Report';
        $this->data['subview'] = 'reconciliation_report';
        $this->load->view('backend/_layout_main', $this->data);
    }
}