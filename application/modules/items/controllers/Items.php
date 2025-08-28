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
      $this->form_validation->set_rules('division_id', 'select division', 'required|trim');
      $this->form_validation->set_rules('cat_id', 'select category', 'required|trim');
      $this->form_validation->set_rules('sub_cat_id', 'select sub category', 'required|trim');
      $this->form_validation->set_rules('item_name', 'item name', 'required|trim');
      $this->form_validation->set_rules('unit_id', 'select unit', 'required|trim');
      $this->form_validation->set_rules('order_level', 'order level', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'division_id'   => $this->input->post('division_id'),
            'cat_id'        => $this->input->post('cat_id'),
            'sub_cat_id'    => $this->input->post('sub_cat_id'),
            'item_name'     => $this->input->post('item_name'),
            'unit_id'       => $this->input->post('unit_id'),
            'type'          => $this->input->post('type'),
            'order_level'   => $this->input->post('order_level'),
            'status'        => $this->input->post('status'),
            'description'   => $this->input->post('description')
         );

         if($this->Common_model->save('items', $form_data)){
            $insert_id = $this->db->insert_id();
            if ($this->ion_auth->in_group(array('do', 'sm'))) {
               $data = array(
                  'unit_id'        => $this->session->userdata('unit_id'),
                  'item_id'        => $insert_id,
                  'cat_id'         => $this->input->post('cat_id'),
                  'sub_cat_id'     => $this->input->post('sub_cat_id'),
                  'order_level'    => $this->input->post('order_level'),
               );
               $this->Common_model->save('item_stocks', $data);
            } else {
               $units = $this->db->get('units')->result();
               foreach ($units as $key => $v) {
                  $data = array(
                     'unit_id'        => $v->id,
                     'item_id'        => $insert_id,
                     'cat_id'         => $this->input->post('cat_id'),
                     'sub_cat_id'     => $this->input->post('sub_cat_id'),
                     'order_level'    => $this->input->post('order_level'),
                  );
                  $this->Common_model->save('item_stocks', $data);
               }
            }
            $this->session->set_flashdata('success', 'Item created successfully.');
            redirect('items');
         }
      }
      //Dropdown
      $this->data['units'] = $this->Common_model->get_units();

      // Load page
      $this->data['meta_title'] = 'Add Item Form';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function get_sub_category_by_category($id){
      $dataID = $id;
      $this->db->where('cate_id', $dataID);
      $query = $this->db->get('item_sub_categories');
      $sub_category = $query->result();
      echo json_encode($sub_category);
   }

   public function get_item_by_sub_category($id){
      $dataID = $id;
      $this->db->where('sub_cat_id', $dataID);
      $query = $this->db->get('items');
      $sub_category = $query->result();
      echo json_encode($sub_category);
   }

   public function get_locker_by_room_id($id){
      $unit_id = $this->session->userdata('unit_id');
      $dataID = $id;
      $this->db->where('unit_id', $unit_id);
      $this->db->where('room_id', $dataID);
      $query = $this->db->get('item_lockers');
      $sub_category = $query->result();
      echo json_encode($sub_category);
   }

   public function edit($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('items', 'id', $dataID)) {
         show_404('items - edit - exitsts', TRUE);
      }

      //Validation
      $this->form_validation->set_rules('division_id', 'select division', 'required|trim');
      $this->form_validation->set_rules('cat_id', 'select category', 'required|trim');
      $this->form_validation->set_rules('sub_cat_id', 'select sub category', 'required|trim');
      $this->form_validation->set_rules('item_name', 'item name', 'required|trim');
      $this->form_validation->set_rules('unit_id', 'select unit', 'required|trim');
      $this->form_validation->set_rules('order_level', 'order level', 'required|trim');

      if ($this->form_validation->run() == true){
         $form_data = array(
            'division_id'   => $this->input->post('division_id'),
            'cat_id'        => $this->input->post('cat_id'),
            'sub_cat_id'    => $this->input->post('sub_cat_id'),
            'item_name'     => $this->input->post('item_name'),
            'unit_id'       => $this->input->post('unit_id'),
            'type'          => $this->input->post('type'),
            'order_level'   => $this->input->post('order_level'),
            'status'        => $this->input->post('status'),
            'description'   => $this->input->post('description')
         );

         if($this->Common_model->edit('items', $dataID, 'id', $form_data)){
            $unit_id = $this->session->userdata('unit_id');
            if ($this->ion_auth->in_group(array('do', 'sm'))) {
               $data = array(
                  'cat_id'         => $this->input->post('cat_id'),
                  'sub_cat_id'     => $this->input->post('sub_cat_id'),
                  'order_level'    => $this->input->post('order_level'),
               );
               $this->db->where('unit_id', $unit_id)->where('item_id', $dataID)->update('item_stocks', $data);
            } else {
               $units = $this->db->get('units')->result();
               foreach ($units as $key => $v) {
                  $data = array(
                     'cat_id'         => $this->input->post('cat_id'),
                     'sub_cat_id'     => $this->input->post('sub_cat_id'),
                     'order_level'    => $this->input->post('order_level'),
                  );
                  $this->db->where('unit_id', $v->id)->where('item_id', $dataID)->update('item_stocks', $data);
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
      if (empty($qty)) {
         continue;
      }
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

}
