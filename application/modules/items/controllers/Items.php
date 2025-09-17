<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends Backend_Controller {

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_title'] = 'Items';
      $this->load->model('Common_model');
      $this->load->model('Items_model');
      $this->load->model('custom_fields/custom_fields_model');
      $this->load->model('cbs_integration/Cbs_integration_model', 'cbs_model');
   }

   public function index(){
      $this->data['results'] = $this->Items_model->get_items();
      // Load page
      $this->data['meta_title'] = 'All Items';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function create(){
      //Validation
      // $this->form_validation->set_rules('division_id', 'select division', 'required|trim');
      $this->form_validation->set_rules('cat_id', 'select category', 'required|trim');
      $this->form_validation->set_rules('sub_cat_id', 'select sub category', 'required|trim');
      $this->form_validation->set_rules('item_name', 'item name', 'required|trim');


      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'branch_id'        => $this->input->post('branch_id'),
            'category_id'      => $this->input->post('cat_id'),
            'sub_cat_id'       => $this->input->post('sub_cat_id'),
            'item_name'        => $this->input->post('item_name'),
            'description'      => $this->input->post('description'),
            'unit_id'          => $this->input->post('unit_id'),
            'type'             => $this->input->post('type'),
            'status'           => $this->input->post('status'),
            'acquisition_date' => $this->input->post('acquisition_date'),
            'serial_number'    => $this->input->post('serial_number'),
            'warranty_months'  => $this->input->post('warranty_months'),
            'asset_status'     => $this->input->post('asset_status'),
            'supplier_id'      => $this->input->post('supplier_id'),
            'original_cost'    => $this->input->post('original_cost'),
            'capitalized_cost' => $this->input->post('capitalized_cost'),
         );

         if($this->Common_model->save('items', $form_data)){
            $insert_id = $this->db->insert_id();
            $this->cbs_model->generate_capitalization_journal_entry($insert_id);
            // Save custom field values
            $custom_fields_definitions = $this->custom_fields_model->get_custom_fields();
            foreach ($custom_fields_definitions as $field) {
               $field_name = 'custom_field_' . $field->id;
               $field_value = $this->input->post($field_name);
               if ($field_value !== null) { 
               $this->custom_fields_model->save_asset_custom_field_value($insert_id, $field->id, $field_value);
               }
            }
            $this->session->set_flashdata('success', 'Item created successfully.');
            redirect('items');
         }
      }
      //Dropdown
      $this->data['units']      = $this->Common_model->get_units();
      $this->data['suppliers']  = $this->db->get('suppliers')->result(); 
      $this->data['custodians'] = $this->ion_auth->users()->result();
      $this->data['branches']   = $this->Common_model->get_dropdown('office_unit', 'unit_name', 'id');
      $this->data['custom_fields'] = $this->custom_fields_model->get_custom_fields();

      // Load page
      $this->data['meta_title'] = 'Add Asset Form';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function get_sub_category_by_category(){
      $this->db->where('cate_id', $_POST['id']);
      $query = $this->db->get('item_sub_categories');
      $sub_category = $query->result();
      echo json_encode($sub_category);
   }

   public function get_item_by_sub_category(){
      $this->db->where('sub_cat_id', $_POST['id']);
      $query = $this->db->get('items');
      $sub_category = $query->result();
      echo json_encode($sub_category);
   }

   public function get_locker_by_room_id(){
      $unit_id = $this->session->userdata('unit_id');
      $this->db->where('unit_id', $unit_id);
      $this->db->where('room_id', $_POST['id']);
      $query = $this->db->get('item_lockers');
      $sub_category = $query->result();
      echo json_encode($sub_category);
   }

   public function get_floors_by_branch($branch_id){
      $this->db->where('unit_id', $branch_id);
      $query = $this->db->get('asset_floors');
      echo json_encode($query->result());
   }

   public function get_rooms_by_floor($floor_id){
      $this->db->where('floor_id', $floor_id);
      $query = $this->db->get('asset_rooms');
      echo json_encode($query->result());
   }

   public function edit($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('items', 'id', $dataID)) {
         show_404('items - edit - exitsts', TRUE);
      }

      //Validation
      $this->form_validation->set_rules('branch_id', 'select branch', 'required|trim');
      $this->form_validation->set_rules('cat_id', 'select category', 'required|trim');
      $this->form_validation->set_rules('sub_cat_id', 'select sub category', 'required|trim');
      $this->form_validation->set_rules('item_name', 'item name', 'required|trim');
      $this->form_validation->set_rules('unit_id', 'select unit', 'required|trim');
      // New fields validation
      $this->form_validation->set_rules('acquisition_date', 'acquisition date', 'trim');
      $this->form_validation->set_rules('supplier_id', 'supplier', 'trim');
      $this->form_validation->set_rules('serial_number', 'serial number', 'trim');
      $this->form_validation->set_rules('warranty_months', 'warranty months', 'integer|trim');
      $this->form_validation->set_rules('asset_status', 'asset status', 'trim');


      if ($this->form_validation->run() == true){
         $form_data = array(
            'cat_id'          => $this->input->post('cat_id'),
            'sub_cat_id'      => $this->input->post('sub_cat_id'),
            'item_name'       => $this->input->post('item_name'),
            'unit_id'         => $this->input->post('unit_id'),
            'type'            => $this->input->post('type'),
            'order_level'     => $this->input->post('order_level'),
            'status'          => $this->input->post('status'),
            'description'     => $this->input->post('description'),
            'acquisition_date'=> $this->input->post('acquisition_date'),
            'cost'            => $this->input->post('cost'),
            'supplier_id'     => $this->input->post('supplier_id'),
            'serial_number'   => $this->input->post('serial_number'),
            'warranty_months' => $this->input->post('warranty_months'),
            'asset_status'    => $this->input->post('asset_status'),
            'branch_id'       => $this->input->post('branch_id'),
         );

         if($this->Common_model->edit('items', $dataID, 'id', $form_data)){
            $unit_id = $this->session->userdata('unit_id');
            // Save custom field values
            $custom_fields_definitions = $this->custom_fields_model->get_custom_fields();
            foreach ($custom_fields_definitions as $field) {
               $field_name = 'custom_field_' . $field->id;
               $field_value = $this->input->post($field_name);
               if ($field_value !== null || $this->custom_fields_model->get_asset_custom_field_value($dataID, $field->id)) {
                  $this->custom_fields_model->save_asset_custom_field_value($dataID, $field->id, $field_value);
               }
            }
            $this->session->set_flashdata('success', 'Informatioin update successfully.');
            redirect('items');
         }
      }

      //Dropdown
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->data['sub_categories'] = $this->Common_model->get_sub_categories();
      $this->data['units'] = $this->Common_model->get_units();
      $this->data['info'] = $this->Items_model->get_info($dataID);
      $this->data['suppliers'] = $this->db->get('suppliers')->result(); // Fetch suppliers
      $this->data['branches'] = $this->Common_model->get_dropdown('office_unit', 'unit_name', 'id');

      $this->data['custom_fields'] = $this->custom_fields_model->get_custom_fields();
      $this->data['asset_custom_field_values'] = $this->custom_fields_model->get_asset_custom_field_values($dataID);

      // Load page
      $this->data['meta_title'] = 'Edit Item Form';
      $this->data['subview'] = 'edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   function delete($id) {
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }
      $this->data['info'] = $this->Items_model->delete($id);

      $this->session->set_flashdata('success', 'Item delete successfully.');
      redirect('items');
   }

   public function details($id){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $encriptID = (int) decrypt_url($id);

      $this->data['users'] = $this->ion_auth->user()->row();

      $this->data['complain'] = $this->Complain_model->get_info($encriptID);
        // $this->data['scout_member_list'] = $this->Complain_model->get_scout_member_list($id);
        // $this->data['scout_member'] = $this->Complain_model->get_scout_member($id, $this->data['users']->id);

      $this->data['meta_title'] = 'Details Feedback on Complain';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function low_stock(){
      $unit_id = $this->session->userdata('unit_id');
      $this->db->select('i.*, c.category_name, sc.sub_cate_name, u.unit_name, s.balance, b.name_en');
      $this->db->from('items i');
      $this->db->join('item_categories c', 'c.id=i.cat_id', 'LEFT');
      $this->db->join('item_sub_categories sc', 'sc.id=i.sub_cat_id', 'LEFT');
      $this->db->join('item_unit u', 'u.id=i.unit_id', 'LEFT');
      $this->db->join('item_stocks s', 's.item_id=i.id', 'LEFT');
      $this->db->join('units b', 'b.id=s.unit_id', 'LEFT');
      $this->db->where('i.order_level > s.balance');
      if (!empty($unit_id)) {
         $this->db->where('s.unit_id', $unit_id);
      }
      $this->db->order_by('i.id', 'ASC');
      $query = $this->db->get()->result();
      $this->data['results'] = $query;

      // Load page
      $this->data['meta_title'] = 'Low Items List';
      $this->data['subview'] = 'low_stock';
      $this->load->view('backend/_layout_main', $this->data);
   }

   // ================== Stock Items ==================
   public function stock(){
      $unit_id = $this->session->userdata('unit_id');
      $this->data['results'] = $this->Items_model->get_item_stocks($unit_id);
      // Load page
      $this->data['meta_title'] = 'Stock Items';
      $this->data['subview'] = 'stock';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function stock_details($id){
      $id = (int) decrypt_url($id);
      $info = $this->Items_model->get_stock_info($id, $this->session->userdata('unit_id'));
      $this->data['results'] = $this->Items_model->get_stock_details($info->item_id, $info->unit_id);

      // Load page
      $this->data['info'] = $info;
      $this->data['meta_title'] = 'Stock Items Details';
      $this->data['subview'] = 'stock_details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function stock_adjust(){
      $unit_id = $this->session->userdata('unit_id');
      $this->data['results'] = $this->Items_model->get_items();

      // Load page
      $this->data['meta_title'] = 'Stock Adjust';
      $this->data['subview'] = 'stock_adjust';
      $this->load->view('backend/_layout_main', $this->data);
   }
   function ajax_all_adjust() {
      $unit_id = $this->session->userdata('unit_id');
      $ids = $this->input->post('ids');
      // Start transaction
      $this->db->trans_start();
      // Insert new data
      foreach ($ids as $key => $id) {
         $order = $_POST['order'][$key];
         $qty = ($this->input->post('stock'.$id)) ? $this->input->post('stock'.$id) : 0;
         $check = $this->db->where('unit_id', $unit_id)->where('item_id', $id)->get('item_stocks')->row();
         if (!empty($check)) { // update
            $data1 = array(
               'stock_in' => $check->stock_in + ($qty),
               'balance' => $check->balance + ($qty),
               'updated_by' => $this->session->userdata('user_id'),
               'updated_at' => date('Y-m-d H:i:s'),
            );
            $this->db->where('unit_id', $unit_id)->where('item_id', $id)->update('item_stocks', $data1);
         } else { // insert
            $data2 = array(
               'unit_id' => $unit_id,
               'item_id' => $id,
               'cat_id' => $this->input->post('cat'.$id),
               'sub_cat_id' => $this->input->post('sub_cat'.$id),
               'stock_in' => $check->stock_in + ($qty),
               'balance' => $check->balance + ($qty),
               'order_level' => $order,
               'updated_by' => $this->session->userdata('user_id'),
               'updated_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('item_stocks', $data2);
         }

         // Insert stock details
         if (empty($qty)) {
            continue;
         }
         $data = array(
            'unit_id' => $unit_id,
            'item_id' => $id,
            'cat_id' => $this->input->post('cat'.$id),
            'sub_cat_id' => $this->input->post('sub_cat'.$id),
            'qty' => $qty,
            'status' => 1, // item adjusted
            'remarks' => $this->input->post('remarks'.$id),
            'updated_by' => $this->session->userdata('user_id'),
            'updated_at' => date('Y-m-d H:i:s'),
         );
         $this->db->insert('item_stocks_details', $data);
      }
      // Complete transaction (automatically commits or rolls back)
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
         echo 'error';
      } else {
         echo 'success';
      }
   }

   function ajax_single_adjust() {
      $unit_id = $this->session->userdata('unit_id');
      $id = $this->input->post('id');
      $order = $this->input->post('order');
      $cat = $this->input->post('cat');
      $sub_cat = $this->input->post('sub_cat');
      $qty = $this->input->post('stock');
      $this->db->trans_start();
      $check = $this->db->where('unit_id', $unit_id)->where('item_id', $id)->get('item_stocks')->row();
      if (!empty($check)) { // update
         $data1 = array(
            'stock_in' => $check->stock_in + ($qty),
            'balance' => $check->balance + ($qty),
            'updated_by' => $this->session->userdata('user_id'),
            'updated_at' => date('Y-m-d H:i:s'),
         );
         $this->db->where('unit_id', $unit_id)->where('item_id', $id)->update('item_stocks', $data1);
      } else { // insert
         $data2 = array(
            'unit_id' => $unit_id,
            'item_id' => $id,
            'cat_id' => $cat,
            'sub_cat_id' => $sub_cat,
            'stock_in' => $check->stock_in + ($qty),
            'balance' => $check->balance + ($qty),
            'order_level' => $order,
            'updated_by' => $this->session->userdata('user_id'),
         );
         $this->db->insert('item_stocks', $data2);
      }

      // Insert stock details
      $data = array(
         'unit_id' => $unit_id,
         'item_id' => $id,
         'cat_id' => $cat,
         'sub_cat_id' => $sub_cat,
         'qty' => $qty,
         'status' => 1, // item adjusted
         'remarks' => $this->input->post('remarks'),
         'updated_by' => $this->session->userdata('user_id'),
         'updated_at' => date('Y-m-d H:i:s'),
      );
      $this->db->insert('item_stocks_details', $data);

      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
         echo 'error';
      } else {
         echo 'success';
      }
   }

   function print_stock_in( $id ) {
      //Results
      $info = $this->Items_model->get_stock_info($id, $this->session->userdata('unit_id'));
      $this->data['items'] = $this->Items_model->get_stock_details($info->item_id, $info->unit_id);

      // Generate PDF
      $this->data['info'] = $info;
      $this->data['headding'] = 'Stock in';
      $html = $this->load->view('pdf_print_stock_in', $this->data, true);
      $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
      $mpdf->WriteHtml($html);
      $mpdf->output();
   }
   // ================== Stock Items end ==================

   /*************details_pdf function pdf start**************/
   public function details_pdf($id=0){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $encriptID = (int) decrypt_url($id);

      $this->data['users'] = $this->ion_auth->user()->row();

      $this->data['complain'] = $this->Complain_model->get_info($encriptID);

      //...............................................................................
      $this->data['meta_title'] = "Details Feedback on Complain";
      $html = $this->load->view('details_pdf', $this->data, true);
      $file_name ="details_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'.
      $mpdf->Output($file_name, "D");
   }
   /*************details_pdf function pdf End**************/

   // public function generate_qr_code($id) {
   //    $this->load->library('ciqrcode'); // Load the Ciqrcode library

   //    $asset_id = (int) decrypt_url($id); // Decrypt the asset ID

   //    // Fetch asset information
   //    $asset_info = $this->Items_model->get_info($asset_id);

   //    if (!$asset_info) {
   //       show_404(); // Asset not found
   //    }

   //    // Prepare data for QR code
   //    // You can customize this string to include more asset information
   //    $qr_data = "Asset ID: " . $asset_info->id . "\n";
   //    $qr_data .= "Name: " . $asset_info->item_name . "\n";
   //    $qr_data .= "Serial: " . $asset_info->serial_number . "\n";
   //    $qr_data .= "Location: " . $asset_info->branch_name . ", " . $asset_info->department_name . ", " . $asset_info->floor_name . ", " . $asset_info->room_name . "\n";
   //    $qr_data .= "Status: " . $asset_info->asset_status . "\n";
   //    $qr_data .= "Cost: " . $asset_info->cost . "\n";
   //    $qr_data .= "Acquisition Date: " . $asset_info->acquisition_date . "\n";
   //    $qr_data .= "Supplier: " . $asset_info->supplier_name . "\n";
   //    $qr_data .= "Custodian: " . $asset_info->custodian_name . "\n";
   //    $qr_data .= "Warranty (Months): " . $asset_info->warranty_months . "\n";


   //    // QR code generation parameters
   //    $params['data'] = $qr_data;
   //    $params['level'] = 'H'; // Error correction level: L, M, Q, H
   //    $params['size'] = 10; // Size of the QR code (1-10)
   //    $params['savename'] = FCPATH . 'qrcode_img/' . $asset_info->id . '_qrcode.png'; // Save to qrcode_img directory

   //    // Ensure the qrcode_img directory exists
   //    if (!is_dir(FCPATH . 'qrcode_img')) {
   //       mkdir(FCPATH . 'qrcode_img', 0777, TRUE);
   //    }

   //    $this->ciqrcode->generate($params);

   //    // Redirect to display the QR code or download it
   //    // For now, let's redirect to a simple view that displays the image
   //    $this->data['qr_code_path'] = base_url('qrcode_img/' . $asset_info->id . '_qrcode.png');
   //    $this->data['meta_title'] = 'Asset QR Code';
   //    $this->data['subview'] = 'qr_code_display'; // A new view to create
   //    $this->load->view('backend/_layout_main', $this->data);
   // }
   public function generate_qr_code($id)
   {
      $this->load->library('ciqrcode'); // Load QR library

      $asset_id = (int) decrypt_url($id); // Decrypt asset ID if needed
      $asset_info = $this->Items_model->get_info($asset_id);
      // dd($asset_info);

      if (!$asset_info) {
         show_404();
      }

      // QR code should contain a URL (link to details page)
      $qr_data = base_url('assets/view/' . $asset_info->id);

      // Ensure the directory exists
      if (!is_dir(FCPATH . 'qrcode_img')) {
         mkdir(FCPATH . 'qrcode_img', 0777, TRUE);
      }

      // QR generation parameters
      $params['data'] = $qr_data;
      $params['level'] = 'H'; // Error correction
      $params['size'] = 10;
      $params['savename'] = FCPATH . 'qrcode_img/' . $asset_info->id . '_qrcode.png';

      $this->ciqrcode->generate($params);

      // Send path to view
      $this->data['qr_code_path'] = base_url('qrcode_img/' . $asset_info->id . '_qrcode.png');
      $this->data['meta_title'] = 'Asset QR Code';
      $this->data['subview'] = 'qr_code_display';
      $this->load->view('backend/_layout_main', $this->data);
   }

    public function bulk_import() {
        $this->data['meta_title'] = 'Bulk Import Assets';
        $this->data['subview'] = 'bulk_import'; // View for the upload form

        if ($this->input->post('submit')) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'xls|xlsx|csv';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('asset_file')) {
                $this->data['error'] = $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();
                $file_path = $upload_data['full_path'];

                $this->load->model('Items_import_model'); // Load the new import model
                $import_result = $this->Items_import_model->import_assets($file_path);

                if ($import_result['status'] == 'success') {
                    $this->session->set_flashdata('success', $import_result['message']);
                    redirect('items');
                } else {
                    $this->data['error'] = $import_result['message'];
                }
            }
        }

        $this->load->view('backend/_layout_main', $this->data);
    }

    public function bulk_export() {
        $this->load->library('excel'); // Load PHPExcel library
        $this->load->helper('download'); // For force_download

        $assets = $this->Items_model->get_items(); // Fetch all asset data

        if (empty($assets)) {
            $this->session->set_flashdata('error', 'No assets found to export.');
            redirect('items');
        }

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        // Set headers
        $headers = [
            'ID', 'Item Name', 'Description', 'Division ID', 'Category ID', 'Sub Category ID',
            'Unit ID', 'Type', 'Order Level', 'Status', 'Acquisition Date', 'Cost', 'Book Value',
            'Supplier ID', 'Serial Number', 'Warranty Months', 'Custodian ID',
            'Asset Status', 'Branch ID', 'Department ID', 'Floor ID', 'Room ID',
            'Depreciation Method', 'Useful Life', 'Salvage Value', 'Disposal Date', 'Disposal Type', 'Sale Proceeds'
        ];
        $col = 0;
        foreach ($headers as $header) {
            $sheet->setCellValueByColumnAndRow($col, 1, $header);
            $col++;
        }

        // Add data
        $row = 2;
        foreach ($assets as $asset) {
            $col = 0;
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->id);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->item_name);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->description);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->cat_id);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->sub_cat_id);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->unit_id);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->type);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->status);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->acquisition_date);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->supplier_id);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->serial_number);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->warranty_months);
            // $sheet->setCellValueByColumnAndRow($col++, $row, $asset->custodian_id);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->asset_status);
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->branch_id);
            $row++;
        }

        // Set active sheet index to the first sheet, so Excel opens this sheet first
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="assets_export_' . date('YmdHis') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }


    // get supplier info with ajax 

    public function get_supplier_info(){
        $id = $this->input->post('id');
        $supplier = $this->Items_model->get_supplier_info($id);
        echo json_encode($supplier);
    }
}
