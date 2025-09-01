<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Depreciation extends Backend_Controller {

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_title'] = 'Depreciation';
      $this->load->model('Common_model');
      $this->load->model('Depreciation_model'); // Will create this model next
   }

   public function index(){
      // This will list all assets with their depreciation parameters, if any
      $this->data['results'] = $this->Depreciation_model->get_all_depreciation_parameters();
      $this->data['meta_title'] = 'Depreciation Parameters';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function add($asset_id = NULL){
      // Form to add/edit depreciation parameters for a specific asset
      // If asset_id is provided, pre-fill form with existing data

      // Fetch depreciation methods
      $this->data['depreciation_methods'] = $this->db->get('depreciation_methods')->result();

      // Fetch asset info
      $this->data['asset_info'] = $this->db->where('id', $asset_id)->get('items')->row();

      // Load existing depreciation parameters if editing
      $this->data['depreciation_info'] = $this->Depreciation_model->get_depreciation_parameters_by_asset_id($asset_id);

      // Validation and form submission logic will go here
      $this->form_validation->set_rules('asset_id', 'Asset ID', 'required|trim');
      $this->form_validation->set_rules('method_id', 'Depreciation Method', 'required|trim');
      $this->form_validation->set_rules('useful_life_years', 'Useful Life (Years)', 'integer|trim');
      $this->form_validation->set_rules('useful_life_units', 'Useful Life (Units)', 'integer|trim');
      $this->form_validation->set_rules('salvage_value', 'Salvage Value', 'numeric|trim');
      $this->form_validation->set_rules('depreciation_start_date', 'Depreciation Start Date', 'required|trim');


      if ($this->form_validation->run() == true) {
         $form_data = array(
            'asset_id'                => $this->input->post('asset_id'),
            'method_id'               => $this->input->post('method_id'),
            'useful_life_years'       => $this->input->post('useful_life_years'),
            'useful_life_units'       => $this->input->post('useful_life_units'),
            'salvage_value'           => $this->input->post('salvage_value'),
            'depreciation_start_date' => $this->input->post('depreciation_start_date')
         );

         if ($this->data['depreciation_info']) { // Update existing
            $this->Common_model->edit('asset_depreciation_parameters', $this->data['depreciation_info']->id, 'id', $form_data);
            $this->session->set_flashdata('success', 'Depreciation parameters updated successfully.');
         } else { // Add new
            $this->Common_model->save('asset_depreciation_parameters', $form_data);
            $this->session->set_flashdata('success', 'Depreciation parameters added successfully.');
         }
         redirect('depreciation');
      }


      $this->data['meta_title'] = 'Add/Edit Depreciation Parameters';
      $this->data['subview'] = 'add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   // Function to calculate depreciation (will be called by a cron job or manually)
   public function calculate_depreciation(){
      $this->load->helper('date'); // For date manipulation

      $depreciation_parameters = $this->Depreciation_model->get_all_depreciation_parameters();

      foreach ($depreciation_parameters as $param) {
         // Get asset details
         $asset = $this->db->where('id', $param->asset_id)->get('items')->row();
         if (!$asset || empty($asset->cost)) {
            log_message('error', 'Asset or cost not found for depreciation calculation for asset ID: ' . $param->asset_id);
            continue;
         }

         // Clear existing schedule for this asset
         $this->Depreciation_model->clear_depreciation_schedule($param->asset_id);

         $schedule_data = [];
         $accumulated_depreciation = 0;
         $net_book_value = $asset->cost;

         $start_date = new DateTime($param->depreciation_start_date);
         $current_date = clone $start_date;

         $cost = $asset->cost;
         $salvage_value = $param->salvage_value ?? 0;
         $useful_life_years = $param->useful_life_years;

         if ($useful_life_years <= 0) {
             log_message('error', 'Useful life years is zero or negative for asset ID: ' . $param->asset_id);
             continue;
         }

         $depreciable_base = $cost - $salvage_value;

         // Straight-Line Method
         if ($param->method_name == 'Straight-Line Method') {
            $annual_depreciation = $depreciable_base / $useful_life_years;
            $monthly_depreciation = $annual_depreciation / 12;

            for ($i = 0; $i < ($useful_life_years * 12); $i++) {
               $depreciation_amount = $monthly_depreciation;
               $accumulated_depreciation += $depreciation_amount;
               $net_book_value = $cost - $accumulated_depreciation;

               // Ensure net book value does not go below salvage value
               if ($net_book_value < $salvage_value) {
                   $depreciation_amount = $depreciable_base - (($i - 1) * $monthly_depreciation); // Adjust last depreciation amount
                   $net_book_value = $salvage_value;
                   $accumulated_depreciation = $cost - $salvage_value;
               }

               $schedule_data[] = [
                  'asset_id'                 => $param->asset_id,
                  'schedule_date'            => $current_date->format('Y-m-d'),
                  'depreciation_amount'      => round($depreciation_amount, 2),
                  'accumulated_depreciation' => round($accumulated_depreciation, 2),
                  'net_book_value'           => round($net_book_value, 2)
               ];
               $current_date->modify('+1 month');
            }
         }
         // TODO: Implement Written Down Value (WDV) / Declining Balance Method
         // TODO: Implement Units of Production Method

         if (!empty($schedule_data)) {
            $this->Depreciation_model->save_depreciation_schedule($schedule_data);
         }
      }
      $this->session->set_flashdata('success', 'Depreciation schedules calculated successfully.');
      redirect('depreciation'); // Redirect back to the depreciation list
   }

}