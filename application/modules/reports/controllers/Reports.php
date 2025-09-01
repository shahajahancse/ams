<?php defined('BASEPATH') OR exit('No direct script access allowed');
  // include 'classes/BanglaConverter.php';
class Reports extends Backend_Controller {

	public function __construct(){
    parent::__construct();

    $this->data['module_name'] = $this->data['module_title'] = 'Reports';
    if (!$this->ion_auth->logged_in()):
      redirect('login');
    endif;
    $pr=$this->ion_auth->get_permission();
    if (!in_array('5', $pr)) {
      redirect('dashboard');
    }
    $this->load->model('Reports_model');
  }

  public function index(){
    // Validation
    $this->form_validation->set_rules('fiscal_year', 'btnsubmit', 'required');
    if($this->form_validation->run() == true){
      $btn_submit = $this->input->post('btnsubmit');
      $this->data['date_from'] = $this->input->post('from_date');
      $this->data['date_to'] = $this->input->post('to_date');
      $this->data['unit_id'] = $this->input->post('unit_id');
      $this->data['user_id'] = $this->input->post('user_id');
      $this->data['fiscal_year'] = $this->input->post('fiscal_year');

      // Item Results
      if( $btn_submit == 'item_report') {
        $this->data['results'] = $this->Reports_model->get_items();
        // Generate PDF
        $this->data['headding'] = 'Item Report';
        $html = $this->load->view('pdf_item_report', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
      }

      // Item low Results
      if( $btn_submit == 'low_inventory') {
        $this->data['date_from'] = $this->input->post('date_from');
        $this->data['date_to'] = $this->input->post('date_to');

        // Results
        $this->data['results'] = $this->Reports_model->get_low_inventory_items();

        // Generate PDF
        $this->data['headding'] = 'Low Inventory Item Report';
        $html = $this->load->view('pdf_low_inventory_item', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }

      if ($btn_submit == 'item_excel') {
        $this->data['results'] = $this->Reports_model->get_items();
        // Generate PDF
        $this->data['headding'] = 'Item Report';
        $this->load->view('item_excel', $this->data, true);
      }
      if ($btn_submit == 'low_excel') {
        $this->data['results'] = $this->Reports_model->get_low_inventory_items();
        // Generate PDF
        $this->data['headding'] = 'Low Item Report';
        $this->load->view('low_excel', $this->data, true);
      }

      // requisition report
      if( $btn_submit == 'request_requisition') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(2,3,4);
        $this->data['results'] = $this->Reports_model->get_requisition($arr);
        // Generate PDF
        $this->data['headding'] = 'Request Requisition';
        $html = $this->load->view('pdf_request_requisition', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }else if( $btn_submit == 'approve_requisition') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(5);
        $this->data['results'] = $this->Reports_model->get_requisition($arr);
        // Generate PDF
        $this->data['headding'] = 'Approve Requisition';
        $html = $this->load->view('pdf_request_requisition', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }else if( $btn_submit == 'rejected_requisition') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(7);
        $this->data['results'] = $this->Reports_model->get_requisition($arr);
        // Generate PDF
        $this->data['headding'] = 'Rejected Requisition';
        $html = $this->load->view('pdf_request_requisition', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }else if( $btn_submit == 'delivered_requisition') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(6);
        $this->data['results'] = $this->Reports_model->get_requisition($arr);
        // Generate PDF
        $this->data['headding'] = 'Delivered Requisition';
        $html = $this->load->view('pdf_request_requisition', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }

      // Requisition Excel
      if ($btn_submit == 'request_requisition_excel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(2,3,4);
        $this->data['results'] = $this->Reports_model->get_requisition($arr);
        // Generate PDF
        $this->data['headding'] = 'Request Requisition';
        $this->load->view('excel_rard', $this->data);
      } else if ($btn_submit == 'approve_requisition_excel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(5);
        $this->data['results'] = $this->Reports_model->get_requisition($arr);
        // Generate PDF
        $this->data['headding'] = 'Approve Requisition';
        $this->load->view('excel_rard', $this->data, true);
      } else if ($btn_submit == 'rejected_requisition_excel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(7);
        $this->data['results'] = $this->Reports_model->get_requisition($arr);
        // Generate PDF
        $this->data['headding'] = 'Rejected Requisition';
        $this->load->view('excel_rard', $this->data, true);
      } else if ($btn_submit == 'delivered_requisition_excel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(6);
        $this->data['results'] = $this->Reports_model->get_requisition($arr);
        // Generate PDF
        $this->data['headding'] = 'Delivered Requisition';
        $this->load->view('excel_rard', $this->data, true);
      }

      // purchase report
      if( $btn_submit == 'request_purchase') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(2,3,4,8);
        $this->data['results'] = $this->Reports_model->get_purchase($arr);
        // Generate PDF
        $this->data['headding'] = 'Request Purchase';
        $html =  $this->load->view('pdf_request_purchase', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }else if( $btn_submit == 'approve_purchase') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(5);
        $this->data['results'] = $this->Reports_model->get_purchase($arr);
        // Generate PDF
        $this->data['headding'] = 'Approve Purchase';
        $html =  $this->load->view('pdf_request_purchase', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }else if( $btn_submit == 'rejected_purchase') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(7);
        $this->data['results'] = $this->Reports_model->get_purchase($arr);
        // Generate PDF
        $this->data['headding'] = 'Rejected Purchase';
        $html =  $this->load->view('pdf_request_purchase', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }else if( $btn_submit == 'recceived_purchase') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        $this->data['type'] = 4;
        // Results
        $arr = array(6);
        $this->data['results'] = $this->Reports_model->get_purchase($arr);
        // Generate PDF
        $this->data['headding'] = 'Purchase Received';
        $html =  $this->load->view('pdf_request_purchase', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }

      // purchase Excel
      if( $btn_submit == 'request_purchase_excel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(2,3,4,8);
        $this->data['results'] = $this->Reports_model->get_purchase($arr);
        // Generate PDF
        $this->data['headding'] = 'Request Purchase';
        $this->load->view('excel_prard', $this->data, true);
      }else if( $btn_submit == 'approve_purchase_axcel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(5);
        $this->data['results'] = $this->Reports_model->get_purchase($arr);
        // Generate PDF
        $this->data['headding'] = 'Approve Purchase';
        $this->load->view('excel_prard', $this->data, true);
      }else if( $btn_submit == 'rejected_purchase_axcel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(7);
        $this->data['results'] = $this->Reports_model->get_purchase($arr);
        // Generate PDF
        $this->data['headding'] = 'Rejected Purchase';
        $this->load->view('excel_prard', $this->data, true);
      }else if( $btn_submit == 'recceived_purchase_axcel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        $this->data['type'] = 4;
        // Results
        $arr = array(6);
        $this->data['results'] = $this->Reports_model->get_purchase($arr);
        // Generate PDF
        $this->data['headding'] = 'Purchase Received';
        $this->load->view('excel_prard', $this->data);
      }

      // user report
      if( $btn_submit == 'user_request_requisition') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(2,3,4);
        $this->data['results'] = $this->Reports_model->get_user_report($arr);
        // Generate PDF
        $this->data['headding'] = 'Request Requisition';
        $html = $this->load->view('pdf_request_requisition', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }else if( $btn_submit == 'user_approve_requisition') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(5);
        $this->data['results'] = $this->Reports_model->get_user_report($arr);
        // Generate PDF
        $this->data['headding'] = 'Approve Requisition';
        $html = $this->load->view('pdf_request_requisition', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }else if( $btn_submit == 'user_rejected_requisition') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(7);
        $this->data['results'] = $this->Reports_model->get_user_report($arr);
        // Generate PDF
        $this->data['headding'] = 'Rejected Requisition';
        $html = $this->load->view('pdf_request_requisition', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }else if( $btn_submit == 'user_delivered_requisition') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(6);
        $this->data['results'] = $this->Reports_model->get_user_report($arr);
        // Generate PDF
        $this->data['headding'] = 'Delivered Requisition';
        $html = $this->load->view('pdf_request_requisition', $this->data, true);
        $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
        $mpdf->WriteHtml($html);
        $mpdf->output();
        exit();
      }

      // user excel
      if( $btn_submit == 'user_request_excel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(2,3,4);
        $this->data['results'] = $this->Reports_model->get_user_report($arr);
        // Generate PDF
        $this->data['headding'] = 'Request Requisition';
        $html = $this->load->view('excel_ruard', $this->data, true);
      }else if( $btn_submit == 'user_approve_excel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(5);
        $this->data['results'] = $this->Reports_model->get_user_report($arr);
        // Generate PDF
        $this->data['headding'] = 'Approve Requisition';
        $html = $this->load->view('excel_ruard', $this->data, true);
      }else if( $btn_submit == 'user_rejected_excel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(7);
        $this->data['results'] = $this->Reports_model->get_user_report($arr);
        // Generate PDF
        $this->data['headding'] = 'Rejected Requisition';
        $html = $this->load->view('excel_ruard', $this->data, true);
      }else if( $btn_submit == 'user_delivered_excel') {
        $this->data['date_from'] = $this->input->post('from_date');
        $this->data['date_to'] = $this->input->post('to_date');
        // Results
        $arr = array(6);
        $this->data['results'] = $this->Reports_model->get_user_report($arr);
        // Generate PDF
        $this->data['headding'] = 'Delivered Requisition';
        $html = $this->load->view('excel_ruard', $this->data, true);
      }
    }

    $this->data['users'] = $this->Common_model->get_users();
    $this->data['meta_title'] = 'Reports';
    $this->data['subview'] = 'index';
    $this->load->view('backend/_layout_main', $this->data);
  }

  public function dynamic_report() {
    $this->data['meta_title'] = 'Dynamic Reports';
    $this->data['subview'] = 'dynamic/dynamic_report';
    $this->load->view('backend/_layout_main', $this->data);
  }

  public function get_dynamic_report() {
    $report_type = $this->input->post('report_type');
    $user_id = $this->input->post('user_id');
    $fiscal_year = $this->input->post('fiscal_year');
    $product_id = $this->input->post('product_id');
    $from_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    $status = $this->input->post('report_status');

    if ($report_type == 1) {
      $arr = array();
      if (!empty($status) && $status == 4) {
        $this->data['headding'] = 'Delivered List';
        $arr = array(6);
      } else if (!empty($status) && $status == 3) {
        $this->data['headding'] = 'Approved List';
        $arr = array(5);
      } else if (!empty($status) && $status == 2) {
        $this->data['headding'] = 'Rejected List';
        $arr = array(7);
      } else if (!empty($status) && $status == 1) {
        $this->data['headding'] = 'Request List';
        $arr = array(2,3,4);
      }
      if (!empty($product_id)) {
        $this->data['results'] = $this->Reports_model->get_item_report($arr, $product_id);
      } else {
        $this->data['results'] = $this->Reports_model->get_requisition($arr);
      }
      echo $this->load->view('pdf_request_requisition', $this->data, true);
      exit();
      // echo $this->load->view('pdf_delivered_requisition', $this->data, true);
    }else{
      $arr = array();
      if (!empty($status) && $status == 4) {
        $this->data['headding'] = 'Received List';
        $arr = array(6);
      } else if (!empty($status) && $status == 3) {
        $this->data['headding'] = 'Approved List';
        $arr = array(5);
      } else if (!empty($status) && $status == 2) {
        $this->data['headding'] = 'Rejected List';
        $arr = array(7);
      } else if (!empty($status) && $status == 1) {
        $this->data['headding'] = 'Pending List';
        $arr = array(2,3,4,8);
      }
      if (!empty($product_id)) {
        $this->data['results'] = $this->Reports_model->get_purchase_request($arr, $product_id);
      } else {
        $this->data['results'] = $this->Reports_model->get_purchase($arr);
      }
      echo $this->load->view('pdf_request_requisition', $this->data, true);
      exit();
    }
  }
}
