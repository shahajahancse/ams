<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_fields extends Backend_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        } elseif (!$this->ion_auth->is_admin()) {
            show_error('You must be an administrator to view this page.');
        }
        $this->load->model('custom_fields/custom_fields_model');
        $this->data['module_title'] = 'Custom Fields';
    }

    public function index() {
        $this->data['custom_fields'] = $this->custom_fields_model->get_custom_fields();
        $this->data['meta_title'] = 'Manage Custom Fields';
        $this->data['subview'] = 'custom_fields/index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function create() {
        $this->form_validation->set_rules('field_name', 'Field Name', 'required|trim');
        $this->form_validation->set_rules('field_type', 'Field Type', 'required|trim');
        $this->form_validation->set_rules('is_required', 'Is Required', 'trim');
        $this->form_validation->set_rules('options', 'Options', 'trim');

        if ($this->form_validation->run() == true) {
            $data = [
                'field_name' => $this->input->post('field_name'),
                'field_type' => $this->input->post('field_type'),
                'is_required' => $this->input->post('is_required') ? 1 : 0,
                'options' => $this->input->post('options')
            ];
            if ($this->custom_fields_model->save_custom_field($data)) {
                $this->session->set_flashdata('success', 'Custom field created successfully.');
                redirect('custom_fields');
            } else {
                $this->session->set_flashdata('error', 'Error creating custom field.');
            }
        }

        $this->data['meta_title'] = 'Create Custom Field';
        $this->data['subview'] = 'custom_fields/create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id) {
        $custom_field = $this->custom_fields_model->get_custom_field($id);
        if (!$custom_field) {
            show_404();
        }

        $this->form_validation->set_rules('field_name', 'Field Name', 'required|trim');
        $this->form_validation->set_rules('field_type', 'Field Type', 'required|trim');
        $this->form_validation->set_rules('is_required', 'Is Required', 'trim');
        $this->form_validation->set_rules('options', 'Options', 'trim');

        if ($this->form_validation->run() == true) {
            $data = [
                'field_name' => $this->input->post('field_name'),
                'field_type' => $this->input->post('field_type'),
                'is_required' => $this->input->post('is_required') ? 1 : 0,
                'options' => $this->input->post('options')
            ];
            if ($this->custom_fields_model->save_custom_field($data, $id)) {
                $this->session->set_flashdata('success', 'Custom field updated successfully.');
                redirect('custom_fields');
            } else {
                $this->session->set_flashdata('error', 'Error updating custom field.');
            }
        }

        $this->data['custom_field'] = $custom_field;
        $this->data['meta_title'] = 'Edit Custom Field';
        $this->data['subview'] = 'custom_fields/edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function delete($id) {
        if ($this->custom_fields_model->delete_custom_field($id)) {
            $this->session->set_flashdata('success', 'Custom field deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Error deleting custom field.');
        }
        redirect('custom_fields');
    }
}