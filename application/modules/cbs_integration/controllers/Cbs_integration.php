<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cbs_integration extends Backend_Controller {

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_title'] = 'CBS Integration';
      $this->load->model('Common_model');
      $this->load->model('Cbs_integration_model'); // Will create this model next
      $this->load->helper('download'); // For CSV export
   }

   public function index(){
      $this->data['meta_title'] = 'Generate & Export Journal Entries';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function generate_and_export(){
      $this->form_validation->set_rules('start_date', 'Start Date', 'required|trim');
      $this->form_validation->set_rules('end_date', 'End Date', 'required|trim');

      if ($this->form_validation->run() == true) {
         $start_date = $this->input->post('start_date');
         $end_date = $this->input->post('end_date');

         $journal_entries = $this->Cbs_integration_model->generate_journal_entries($start_date, $end_date);

         if (empty($journal_entries)) {
            $this->session->set_flashdata('error', 'No journal entries found for the selected date range.');
            redirect('cbs_integration');
         }

         // Generate CSV
         $filename = 'journal_entries_' . date('Ymd_His') . '.csv';
         $csv_data = $this->Cbs_integration_model->array_to_csv($journal_entries);

         force_download($filename, $csv_data);

      } else {
         $this->index(); // Reload the form with validation errors
      }
   }

}