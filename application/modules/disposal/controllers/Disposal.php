<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Disposal extends Backend_Controller {

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_title'] = 'Asset Disposal';
      $this->load->model('Common_model');
      $this->load->model('Disposal_model'); // Will create this model next
      $this->load->model('depreciation/Depreciation_model'); // To get accumulated depreciation
   }

   public function index(){
      $this->data['results'] = $this->Disposal_model->get_all_disposals();
      $this->data['meta_title'] = 'Asset Disposal List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function record($asset_id = NULL){
      // Form to record asset disposal

      // Fetch asset info
      $this->data['asset_info'] = $this->db->where('id', $asset_id)->get('items')->row();

      // Fetch accumulated depreciation for the asset
      $this->data['accumulated_depreciation'] = 0;
      $depreciation_schedule = $this->Depreciation_model->get_depreciation_schedule($asset_id);
      if ($depreciation_schedule) {
          // Get the latest accumulated depreciation
          $last_entry = end($depreciation_schedule);
          $this->data['accumulated_depreciation'] = $last_entry->accumulated_depreciation;
      }

      // Load existing disposal info if editing (though disposal is usually a one-time event)
      $this->data['disposal_info'] = $this->Disposal_model->get_disposal_by_asset_id($asset_id);


      // Validation and form submission logic
      $this->form_validation->set_rules('asset_id', 'Asset ID', 'required|trim');
      $this->form_validation->set_rules('disposal_date', 'Disposal Date', 'required|trim');
      $this->form_validation->set_rules('disposal_type', 'Disposal Type', 'required|trim');
      $this->form_validation->set_rules('sale_proceeds', 'Sale Proceeds', 'numeric|trim');

      if ($this->form_validation->run() == true) {
         $form_data = array(
            'asset_id'        => $this->input->post('asset_id'),
            'disposal_date'   => $this->input->post('disposal_date'),
            'disposal_type'   => $this->input->post('disposal_type'),
            'sale_proceeds'   => $this->input->post('sale_proceeds'),
            'notes'           => $this->input->post('notes'),
            'created_by'      => $this->session->userdata('user_id')
         );

         if ($this->data['disposal_info']) { // Update existing
            $this->Common_model->edit('asset_disposals', $this->data['disposal_info']->id, 'id', $form_data);
            $this->session->set_flashdata('success', 'Asset disposal updated successfully.');
         } else { // Add new
            $this->Common_model->save('asset_disposals', $form_data);
            $this->session->set_flashdata('success', 'Asset disposal recorded successfully.');
         }
         redirect('disposal');
      }

      $this->data['meta_title'] = 'Record Asset Disposal';
      $this->data['subview'] = 'record';
      $this->load->view('backend/_layout_main', $this->data);
   }

   // Function to calculate gain/loss (can be part of record function or a separate view)
   public function calculate_gain_loss($asset_id){
       // This will be implemented in the view or as part of the record function
       // Net Book Value = Original Cost - Accumulated Depreciation
       // Gain/Loss = Sale Proceeds - Net Book Value
   }

}