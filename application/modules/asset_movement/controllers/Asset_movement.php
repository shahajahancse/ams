<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_movement extends Backend_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('asset_movement/Asset_movement_model');
        $this->data['module_title'] = 'Asset Movement';
    }

    public function index() {
        // List all asset movements
        $this->data['results'] = $this->Asset_movement_model->get_all_movements();
        $this->data['meta_title'] = 'Asset Movement History';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function record($asset_id = NULL) {
        // Form to record asset transfer
        $this->data['asset_info'] = $this->db->where('id', $asset_id)->get('items')->row();
        if (!$this->data['asset_info']) {
            $this->session->set_flashdata('error', 'Asset not found.');
            redirect('items'); // Redirect to items list if asset not found
        }

        // Fetch branches and departments for dropdowns
        $this->data['branches'] = $this->Common_model->get_all_branches(); // Assuming this function exists
        $this->data['departments'] = $this->Common_model->get_all_departments(); // Assuming this function exists

        // Load existing movement info if editing (unlikely for transfers, but good practice)
        $this->data['movement_info'] = $this->Asset_movement_model->get_movement_by_asset_id($asset_id);

        $this->form_validation->set_rules('asset_id', 'Asset', 'required|trim');
        $this->form_validation->set_rules('transfer_date', 'Transfer Date', 'required|trim');
        $this->form_validation->set_rules('from_branch_id', 'From Branch', 'required|trim');
        $this->form_validation->set_rules('from_department_id', 'From Department', 'required|trim');
        $this->form_validation->set_rules('to_branch_id', 'To Branch', 'required|trim');
        $this->form_validation->set_rules('to_department_id', 'To Department', 'required|trim');
        $this->form_validation->set_rules('notes', 'Notes', 'trim');

        if ($this->form_validation->run() == TRUE) {
            $form_data = array(
                'asset_id'              => $this->input->post('asset_id'),
                'transfer_date'         => $this->input->post('transfer_date'),
                'from_branch_id'        => $this->input->post('from_branch_id'),
                'from_department_id'    => $this->input->post('from_department_id'),
                'to_branch_id'          => $this->input->post('to_branch_id'),
                'to_department_id'      => $this->input->post('to_department_id'),
                'transferred_by_user_id'=> $this->ion_auth->user()->row()->id, // Logged-in user
                'notes'                 => $this->input->post('notes')
            );

            if ($this->data['movement_info']) {
                // Update existing (unlikely for transfers, but possible for corrections)
                $this->Common_model->edit('asset_movement_history', $this->data['movement_info']->id, 'id', $form_data);
                $this->session->set_flashdata('success', 'Asset movement updated successfully.');
            } else {
                // Save new movement record
                $this->Common_model->save('asset_movement_history', $form_data);
                
                // Update asset's current location in 'items' table
                $this->db->where('id', $this->input->post('asset_id'))
                         ->update('items', [
                             'branch_id'    => $this->input->post('to_branch_id'),
                             'department_id'=> $this->input->post('to_department_id')
                         ]);

                $this->session->set_flashdata('success', 'Asset movement recorded successfully and asset location updated.');
            }
            redirect('asset_movement');
        }

        $this->data['meta_title'] = 'Record Asset Movement';
        $this->data['subview'] = 'record_transfer';
        $this->load->view('backend/_layout_main', $this->data);
    }
}
