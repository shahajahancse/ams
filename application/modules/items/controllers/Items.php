<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . "libraries/PHPExcel.php";
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

   public function create() {
      // dd($_POST);
      // Validation rules
      $this->form_validation->set_rules('category_id', 'Select category', 'required|trim');
      $this->form_validation->set_rules('sub_cat_id', 'Select sub category', 'required|trim');
      $this->form_validation->set_rules('type', 'Select type', 'required|trim');
      $this->form_validation->set_rules('value_type', 'Select value type', 'required|trim');
      $this->form_validation->set_rules('rate', 'Enter rate', 'required|trim|numeric');
      $this->form_validation->set_rules('item_name', 'Item name', 'required|trim');
      $this->form_validation->set_rules('unit_id', 'Select unit', 'required|trim');
      $this->form_validation->set_rules('asset_image', 'Item image', 'trim');
      $this->form_validation->set_rules('description', 'Item description', 'trim');
      $this->form_validation->set_rules('acquisition_date', 'Acquisition date', 'trim');
      $this->form_validation->set_rules('manufacture_date', 'Manufacture date', 'trim');
      $this->form_validation->set_rules('original_cost', 'Original cost', 'trim|numeric');
      $this->form_validation->set_rules('capitalized_cost', 'Capitalized cost', 'trim|numeric');
      $this->form_validation->set_rules('serial_number', 'Serial number', 'trim');
      $this->form_validation->set_rules('warranty_months', 'Warranty months', 'trim');
      $this->form_validation->set_rules('asset_status', 'Asset status', 'trim');
      $this->form_validation->set_rules('supplier_id', 'Supplier', 'trim');
      $status = $this->input->post('asset_status');
      if ($status == 1 || $status == 2) {
         $this->form_validation->set_rules('branch_id', 'Branch', 'required');
         $this->form_validation->set_rules('dept_id', 'Department', 'required');
         $this->form_validation->set_rules('floor_id', 'Floor', 'required');
         $this->form_validation->set_rules('room_id', 'Room', 'required');
         $this->form_validation->set_rules('user_id', 'User', 'required');
      }
      if ($this->form_validation->run() == true) {
         // Upload image if exists
         $asset_image = null;
         $warranty_months = null;
         if (!empty($_FILES['asset_image']['name'])) {
            $upload_path = './uploads/items/';
            if (!file_exists($upload_path)) {
               mkdir($upload_path, 0777, true);
            }
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = time() . '_' . $_FILES['asset_image']['name'];
            // dd($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('asset_image')) {
               $this->session->set_flashdata('error', $this->upload->display_errors());
               redirect('items/create');
            } else {
               $upload_data = $this->upload->data();
               $asset_image = $upload_data['file_name'];
            }
         }
         if (!empty($_FILES['warranty_months']['name'])) {
            $upload_path = './uploads/items/';
            if (!file_exists($upload_path)) {
               mkdir($upload_path, 0777, true);
            }
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = time() . '_' . $_FILES['warranty_months']['name'];
            // dd($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('warranty_months')) {
               $this->session->set_flashdata('error', $this->upload->display_errors());
               redirect('items/create');
            } else {
               $upload_data = $this->upload->data();
               $form_data['warranty_months'] = $upload_data['file_name'];
            }
         }
         // Prepare form data
         $form_data = array(
            'category_id'      => $this->input->post('category_id'),
            'sub_cat_id'       => $this->input->post('sub_cat_id'),
            'type'             => $this->input->post('type'),
            'value_type'       => $this->input->post('value_type'),
            'rate'             => $this->input->post('rate'),
            'item_name'        => $this->input->post('item_name'),
            'unit_id'          => $this->input->post('unit_id'),
            'asset_image'      => $asset_image,
            'warranty_months'   => $warranty_month,
            'description'      => $this->input->post('description'),
            'acquisition_date' => $this->input->post('acquisition_date'),
            'manufacture_date' => $this->input->post('manufacture_date'),
            'original_cost'    => $this->input->post('original_cost'),
            'capitalized_cost' => $this->input->post('capitalized_cost'),
            'serial_number'    => $this->input->post('serial_number'),
            'asset_status'     => $this->input->post('asset_status'),
            'supplier_id'      => $this->input->post('supplier_id'),
         );
         if ($status == 1 || $status == 2) {
            $form_data = array_merge($form_data, array(
               'branch_id' => $this->input->post('branch_id'),
               'dept_id'   => $this->input->post('dept_id'),
               'floor_id'  => $this->input->post('floor_id'),
               'room_id'   => $this->input->post('room_id'),
               'user_id'   => $this->input->post('user_id'),
            ));
         }

         // dd($form_data);
         // Save data
         if ($this->Common_model->save('items', $form_data)) {
            $insert_id = $this->db->insert_id();

            // Generate journal entry
            $this->cbs_model->generate_capitalization_journal_entry($insert_id);

            // Save custom fields
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
      // else{
      //    dd($_POST);
      // }

      // Dropdowns
      $this->data['units'] = $this->Common_model->get_units();
      $this->data['suppliers'] = $this->db->get('suppliers')->result();
      $this->data['custodians'] = $this->ion_auth->users()->result();
      $this->data['branches'] = $this->Common_model->get_dropdown('office_unit', 'unit_name', 'id');
      $this->data['custom_fields'] = $this->custom_fields_model->get_custom_fields();

      // Load page
      $this->data['meta_title'] = 'Add Asset Form';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function edit($id){
      $dataID = (int) decrypt_url($id); //exit;
      // dd($dataID);
      if (!$this->Common_model->exists('items', 'id', $dataID)) {
         show_404('items - edit - exitsts', TRUE);
      }
      //Validation
      $this->form_validation->set_rules('category_id', 'Select category', 'required|trim');
      $this->form_validation->set_rules('sub_cat_id', 'Select sub category', 'required|trim');
      $this->form_validation->set_rules('type', 'Select type', 'required|trim');
      $this->form_validation->set_rules('value_type', 'Select value type', 'required|trim');
      $this->form_validation->set_rules('rate', 'Enter rate', 'required|trim|numeric');
      $this->form_validation->set_rules('item_name', 'Item name', 'required|trim');
      $this->form_validation->set_rules('unit_id', 'Select unit', 'required|trim');
      $this->form_validation->set_rules('asset_image', 'Item image', 'trim');
      $this->form_validation->set_rules('description', 'Item description', 'trim');
      $this->form_validation->set_rules('acquisition_date', 'Acquisition date', 'trim');
      $this->form_validation->set_rules('manufacture_date', 'Manufacture date', 'trim');
      $this->form_validation->set_rules('original_cost', 'Original cost', 'trim|numeric');
      $this->form_validation->set_rules('capitalized_cost', 'Capitalized cost', 'trim|numeric');
      $this->form_validation->set_rules('serial_number', 'Serial number', 'trim');
      $this->form_validation->set_rules('warranty_months', 'Warranty months', 'trim');
      $this->form_validation->set_rules('asset_status', 'Asset status', 'trim');
      $this->form_validation->set_rules('supplier_id', 'Supplier', 'trim');
      $status = $this->input->post('asset_status');
      if ($status == 1 || $status == 2) {
         $this->form_validation->set_rules('branch_id', 'Branch', 'required');
         $this->form_validation->set_rules('dept_id', 'Department', 'required');
         $this->form_validation->set_rules('floor_id', 'Floor', 'required');
         $this->form_validation->set_rules('room_id', 'Room', 'required');
         $this->form_validation->set_rules('user_id', 'User', 'required');
      }
      if ($this->form_validation->run() == true){
         $form_data = array(
            'category_id'      => $this->input->post('category_id'),
            'sub_cat_id'       => $this->input->post('sub_cat_id'),
            'type'             => $this->input->post('type'),
            'value_type'       => $this->input->post('value_type'),
            'rate'             => $this->input->post('rate'),
            'item_name'        => $this->input->post('item_name'),
            'unit_id'          => $this->input->post('unit_id'),
            'asset_image'      => $asset_image,
            'warranty_months'  => $warranty_month,
            'description'      => $this->input->post('description'),
            'acquisition_date' => $this->input->post('acquisition_date'),
            'manufacture_date' => $this->input->post('manufacture_date'),
            'original_cost'    => $this->input->post('original_cost'),
            'capitalized_cost' => $this->input->post('capitalized_cost'),
            'serial_number'    => $this->input->post('serial_number'),
            'asset_status'     => $this->input->post('asset_status'),
            'supplier_id'      => $this->input->post('supplier_id'),
         );
         if ($status == 1 || $status == 2) {
            $form_data = array_merge($form_data, array(
               'branch_id' => $this->input->post('branch_id'),
               'dept_id'   => $this->input->post('dept_id'),
               'floor_id'  => $this->input->post('floor_id'),
               'room_id'   => $this->input->post('room_id'),
               'user_id'   => $this->input->post('user_id'),
            ));
         }

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
      $this->data['units'] = $this->Common_model->get_units();
      $this->data['suppliers'] = $this->db->get('suppliers')->result();
      $this->data['custodians'] = $this->ion_auth->users()->result();
      $this->data['branches'] = $this->Common_model->get_dropdown('office_unit', 'unit_name', 'id');
      $this->data['custom_fields'] = $this->custom_fields_model->get_custom_fields();
      // Load page
      $this->data['meta_title'] = 'Edit Asset Form';
      $this->data['subview'] = 'edit';
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
      if ($_SERVER['HTTP_HOST'] === 'localhost') {
         $base = 'http://192.168.0.220/ams/';
      } else {
         $base = base_url();
      }
      // $base = base_url();


      // Full URL
      $qr_data = $base . 'assets/view/' . $id;

      // dd($qr_data);

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



   public function bulk_export()
   {
      // Load PHPExcel library wrapper
      $this->load->library('excel'); 

      $assets = $this->Items_model->get_items();

      if (empty($assets)) {
         $this->session->set_flashdata('error', 'No assets found to export.');
         redirect('items');
      }

      // Create new PHPExcel object
      $objPHPExcel = new PHPExcel();
      $sheet = $objPHPExcel->setActiveSheetIndex(0);

      // Define headers
      $headers = [
         'Branch Name','Department Name','Floor Name','Room Name','Custodian','Category Name','Sub Category Name','Item Name','Unit Name',
         'Acquisition Date','Manufacturer Date','Original Cost','Capitalized Cost','Serial/Batch Number','Asset Type','Value Type', 'Amount/Percentage','Description','Supplier Name', 'Asset Status'
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
         switch ($asset->type) {
            case 1:
               $type = 'Depreciation';
               break;
            case 2:
               $type = 'Non-Depreciation';
               break;
            case 3:
               $type = 'Fixed';
               break;
            default:
               $type = '';
         }
         switch ($asset->value_type){
            case 1:
               $value_type = 'Amount';
               break;
            case 2:
               $value_type = 'Percentage';
               break;
            default:
               $value_type = '';
         }
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->branch_name);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->dept_name);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->floor_name);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->room_name);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->user_name);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->category_name);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->sub_cate_name);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->item_name);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->unit_name);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->acquisition_date);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->manufacture_date);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->original_cost);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->capitalized_cost);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->serial_number);
         $sheet->setCellValueByColumnAndRow($col++, $row, $type);
         $sheet->setCellValueByColumnAndRow($col++, $row, $value_type);
         if ($asset->value_type == 1) {
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->rate . ' Tk');
         } else {
            $sheet->setCellValueByColumnAndRow($col++, $row, $asset->rate . ' %');
         }
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->description);
         $sheet->setCellValueByColumnAndRow($col++, $row, $asset->supplier_name);
         switch ($asset->asset_status) {
            case 1:
               $sheet->setCellValueByColumnAndRow($col++, $row, 'In Use');
               break;
            case 2:
               $sheet->setCellValueByColumnAndRow($col++, $row, 'Maintenance');
               break;
            case 3:
               $sheet->setCellValueByColumnAndRow($col++, $row, 'Disposed');
               break;
            case 4:
               $sheet->setCellValueByColumnAndRow($col++, $row, 'Retired');
               break;
            
            default:
               $sheet->setCellValueByColumnAndRow($col++, $row, '');
         }
         $row++;
      }
      // ===== Add Borders =====
      $lastCol = PHPExcel_Cell::stringFromColumnIndex(count($headers) - 1);
      $lastRow = $row - 1;
      $styleArray = [
         'borders' => [
            'allborders' => [
               'style' => PHPExcel_Style_Border::BORDER_THIN,
               'color' => ['argb' => 'FF000000'],
            ],
         ],
      ];
      $sheet->getStyle("A1:{$lastCol}{$lastRow}")->applyFromArray($styleArray);
      // ===== Clear Buffer =====
      while (ob_get_level() > 0) {
         ob_end_clean();
      }
      // File name
      $filename = "assets_export_" . date('YmdHis') . ".xlsx";
      // Headers for download
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header("Content-Disposition: attachment;filename=\"$filename\"");
      header('Cache-Control: max-age=0');
      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
      header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
      header('Cache-Control: cache, must-revalidate');
      header('Pragma: public');

      // Save file to output
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
