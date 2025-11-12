<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Movement extends Backend_Controller {

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_title'] = 'Asset Movement';
      $this->load->model('Common_model');
      $this->load->model('Movement_model'); // Will create this model next
   }

   public function index(){
      $this->data['results'] = $this->Movement_model->get_all_movements();
      $this->data['meta_title'] = 'Asset Movement List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function record($asset_id = NULL){
      // Validation and form submission logic
      $this->form_validation->set_rules('asset_id', 'Asset ID', 'required|trim');
      $this->form_validation->set_rules('movement_date', 'Movement Date', 'required|trim');
      $this->form_validation->set_rules('from_location', 'From Location', 'trim');
      $this->form_validation->set_rules('to_location', 'To Location', 'trim');
      $this->form_validation->set_rules('from_custodian', 'From Custodian', 'trim');
      $this->form_validation->set_rules('to_custodian', 'To Custodian', 'trim');

      if ($this->form_validation->run() == true) {
         $form_data = array(
            'asset_id'        => $this->input->post('asset_id'),
            'movement_date'   => $this->input->post('movement_date'),
            'from_location'   => $this->input->post('from_location'),
            'to_location'     => $this->input->post('to_location'),
            'from_custodian'  => $this->input->post('from_custodian'),
            'to_custodian'    => $this->input->post('to_custodian'),
            'notes'           => $this->input->post('notes'),
            'created_by'      => $this->session->userdata('user_id')
         );

         $this->Common_model->save('asset_movements', $form_data);
         $this->session->set_flashdata('success', 'Asset movement recorded successfully.');
         redirect('movement');
      }

      // Fetch asset info
      $this->data['asset_info'] = $this->db->get('items')->result();
      // Fetch custodians (users)
      $this->data['custodians'] = $this->ion_auth->users()->result();
      // office list
      $this->data['branches'] = $this->db->where('status', 1)->get('branches')->result();

      $this->data['meta_title'] = 'Record Asset Movement';
      $this->data['subview'] = 'record';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function forward($status, $data_id){
      $id = (int) decrypt_url($data_id);

      $this->data['info'] = $this->Movement_model->get_info($id);
      $this->data['details'] = $this->Movement_model->get_status_details($id);
      // dd($this->data['info']);

      $this->data['meta_title'] = 'Record Asset Movement';
      $this->data['subview'] = 'forward';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function forward_status_update($data_id){
      $id = (int) decrypt_url($data_id);
      $status = $this->input->post('status');
      $forward = $this->input->post('forward');
      $remarks = $this->input->post('remarks');

      if (empty($forward)) {
         $user_id = null;
      } else {
         $user_id = $this->db->where('role_id', $forward)->where('fb_type_id', 1)->get('approval_role_manage')->row()->user_id;
      }

      $data = array(
         'asset_id' => $id,
         'status'   => $status,
         'fb_user_id' => $user_id,
         'notes'    => $remarks,
         'created_at' => date('Y-m-d H:i:s'),
         'created_by' => $this->session->userdata('user_id'),
         'updated_at' => date('Y-m-d H:i:s'),
         'updated_by' => $this->session->userdata('user_id')
      );
      if ($status == 0) {
         $this->db->insert('asset_movement_history', $data);
      } else {
         $data1 = array(
            'status' => $status,
            'desk_id' => $user_id,
            'updated_by' => $this->session->userdata('user_id'),
            'updated_at' => date('Y-m-d H:i:s'),
         );
         $this->db->where('id', $id)->update('asset_movements', array('status' => $status));
         $this->db->insert('asset_movement_history', $data);
      }

      $this->session->set_flashdata('success', 'Status updated successfully.');
      redirect('movement');
   }

}
