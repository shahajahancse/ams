<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_logs extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;
        $this->data['module_title'] = 'Activity Logs';
        $this->load->model('Common_model');  
        $this->load->model('Activitylog_model');    
    }

    public function index($offset=0){
      $limit = 25;

      //Check authentication
      if($this->ion_auth->is_admin()){
         // Superadmin
         $results = $this->Activitylog_model->get_activity_logs($limit, $offset);

         //echo '<pre>'; print_r($results);exit;
         //Dropdown
       
        $this->data['regions'] = $this->Common_model->get_regions();
         // print_r($this->data['regions']) ; exit();
         $this->data['scouts_district'] = array(''=>'Scouts District');  
         $this->data['scouts_upazila'] = array(''=>'Scouts Upazila');   
         $this->data['scouts_group'] = array(''=>'Scouts Group'); 

      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //Dropdown
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();
      //pagination
      $this->data['pagination'] = create_pagination('activity_logs/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
   
      
      // Load page
      $this->data['meta_title'] = 'Activity Logs';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************activity_logs_pdf function pdf start**************/
    public function activity_logs_pdf($offset=0){
        $limit = 25;

      //Check authentication
      if($this->ion_auth->is_admin()){
         // Superadmin
         $results = $this->Activitylog_model->get_activity_logs($limit, $offset);
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];
      
      //...............................................................................
      $this->data['meta_title'] = "Activity Logs";
      $html = $this->load->view('activity_logs_pdf', $this->data, true);   
      $file_name ="activity_logs_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************activity_logs_pdf function pdf End**************/
}