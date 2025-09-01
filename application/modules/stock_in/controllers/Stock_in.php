<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_in extends Backend_Controller {
   var $userID;

   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'Stock In';
      $this->load->model('Stock_in_model');
      $this->userSessID = $this->session->userdata('user_id');
   }

   public function index($offset=0){
      $limit = 25;
      //Results
      $status = array();
      if($this->ion_auth->in_group(array('do'))){
         $status = array(2,3,4,5,6,7,8,9,10,11,12);
      } else if ($this->ion_auth->in_group(array('admin'))) {
         $status = array(3,5,6,7,8,9,10,11,12);
      } else {
         $status = array(1,2,3,4,5,6,7,8,9,10,11,12);
      }
      $results = $this->Stock_in_model->get_purchase($limit, $offset, $status, $this->unit_id);
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('stock_in/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'Entry List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }
   // item purchase create here
   public function create(){
      $fiscal_year = $this->Common_model->get_current_fiscal_year();
      $this->data['fiscal_year'] = $fiscal_year->fiscal_year_name;
      //Validation
      $this->form_validation->set_rules('title', 'title','required|trim|max_length[255]');
      //Validate and input data
      if ($this->form_validation->run() == true){
         $user = $this->ion_auth->user()->row();

         $attachmentname='';
         if ($_FILES['attachment']) {
            $config['upload_path'] = './attachment/';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf';
            $config['max_size'] = 10240000;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('attachment')) {
                $data = $this->upload->data();
                $originalFileName = $data['file_name'];

                // Generate a unique file name
                $uniqueFileName = uniqid() . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);

                // Move the uploaded file to the destination with the unique file name
                $destination = base_url('attachment/') . $uniqueFileName;
                rename($config['upload_path'] . $originalFileName, $config['upload_path'] . $uniqueFileName);
                $attachmentname=$uniqueFileName;
            }
         }

         $form_data = array(
            'title'           => $this->input->post('title'),
            'division_id'     => $this->input->post('division_id'),
            'unit_id'         => $user->unit_id,
            'amount'          => 0,
            'f_year_id'       => $fiscal_year->id,
            'status'          => 1,
            'is_received'     => 1,
            'description'     => $this->input->post('description'),
            'created_by'      => $user->id,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
            'attachment'      => $attachmentname
         );

         if($this->Common_model->save('item_stock_in', $form_data)){
            $insert_id = $this->db->insert_id();
            for ($i=0; $i<sizeof($_POST['item_id']); $i++) {
               $form_data2 = array(
                  'unit_id'            => $user->unit_id,
                  'stock_in_id'        => $insert_id,
                  'item_id'            => $_POST['item_id'][$i],
                  'cat_id'             => $_POST['item_cat_id'][$i],
                  'sub_cat_id'         => $_POST['item_sub_cat_id'][$i],
                  'quantity'           => $_POST['qty_request'][$i],
                  'approve_qty'        => 0,
                  'remark'             => $_POST['remark'][$i]
               );
               $this->Common_model->save('item_stock_in_details', $form_data2);
            }
            $this->session->set_flashdata('success', 'Create Requisition successfully.');
            redirect("stock_in");
         }
      }

      //Dropdown
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->data['info'] = $this->Common_model->get_user_details();

      //Load view
      $this->data['meta_title'] = 'Stock Entry Form';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function edit($id){
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->db->where('id', $id);
      $this->data['info']=$this->db->get('item_stock_in')->row();
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name, sc.sub_cate_name');
      $this->db->from('item_stock_in_details ri');
      $this->db->join('items i', 'i.id = ri.item_id');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id');
      $this->db->join('item_categories c', 'c.id = i.cat_id');
      $this->db->join('item_sub_categories sc', 'sc.id = i.sub_cat_id');
      $this->db->where('stock_in_id', $id);
      $this->data['purchase_item_data'] = $this->db->get()->result();

      $this->data['meta_title'] = 'Stock edit Form';
      $this->data['subview'] = 'edit';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function update($id){
      $form_data = array(
         'status'       => $_POST['status'],
         'updated_at'   => date('Y-m-d H:i:s'),
         'description'  => $_POST['description'],
      );

      $this->db->where('id', $id);
      if ($this->db->update('item_stock_in', $form_data)) {
         for ($i=0; $i < sizeof($_POST['hide_id']); $i++) {
            $form_data2 = array(
               'quantity'       => $_POST['quantity'][$i],
            );
            $this->db->where('id', $_POST['hide_id'][$i]);
            $this->db->update('item_stock_in_details', $form_data2);
         }
      }else{
         $this->session->set_flashdata('error', 'Update Requisition failed.');
      }
      $this->session->set_flashdata('success', 'Update Requisition successfully.');
      redirect("stock_in");
   }
   public function details($id){
      if (!$this->Common_model->exists('item_stock_in', 'id', $id)) {
         show_404('stock_in - details - exitsts', TRUE);
      }

      //Results
      $this->db->where('id', $id);
      $this->data['info']=$this->db->get('item_stock_in')->row();
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name, sc.sub_cate_name');
      $this->db->from('item_stock_in_details ri');
      $this->db->join('items i', 'i.id = ri.item_id');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id');
      $this->db->join('item_categories c', 'c.id = i.cat_id');
      $this->db->join('item_sub_categories sc', 'sc.id = i.sub_cat_id');
      $this->db->where('stock_in_id', $id);
      $this->data['purchase_item_data'] = $this->db->get()->result();

      // Load page
      $this->data['meta_title'] = 'Stock Details';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }
   // item purchase create end

   public function purchase_pending($offset=0){
      $limit = 25;
      $status = array();
      if ($this->ion_auth->in_group(array('do')) && in_array($this->unit_id, array(2,3,4))){
         $status = array(5);
         $results = $this->Stock_in_model->get_purchase($limit, $offset, $status, null, $this->unit_id);
      } else if ($this->ion_auth->in_group(array('sm')) && in_array($this->unit_id, array(2,3,4))){
         $status = array(3);
         $results = $this->Stock_in_model->get_purchase($limit, $offset, $status, null, $this->unit_id);
      } else if ($this->ion_auth->in_group(array('do'))){
         $status = array(2,8);
         $results = $this->Stock_in_model->get_purchase($limit, $offset, $status, $this->unit_id);
      } else if ($this->ion_auth->in_group(array('admin'))) {
         $status = array(6,11);
         $results = $this->Stock_in_model->get_purchase($limit, $offset, $status);
      } else {
         $status = array(1,4,8,11);
         $results = $this->Stock_in_model->get_purchase($limit, $offset, $status, $this->unit_id);
      }

      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      $this->data['pagination'] = create_pagination('stock_in/purchase_pending/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['meta_title'] = 'Pending List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function purchase_approved($offset=0){
      $limit = 25;
      $status = array(7);
      if ($this->ion_auth->in_group(array('do')) && in_array($this->unit_id, array(2,3,4))){
         $results = $this->Stock_in_model->get_purchase($limit, $offset, $status, null, $this->unit_id);
      } else if ($this->ion_auth->in_group(array('sm')) && in_array($this->unit_id, array(2,3,4))){
         $results = $this->Stock_in_model->get_purchase($limit, $offset, $status, null, $this->unit_id);
      } else if ($this->ion_auth->in_group(array('do'))){
         $results = $this->Stock_in_model->get_purchase($limit, $offset, $status, $this->unit_id);
      } else if ($this->ion_auth->in_group(array('admin'))) {
         $results = $this->Stock_in_model->get_purchase($limit, $offset, $status);
      } else {
         $results = $this->Stock_in_model->get_purchase($limit, $offset, array(11), $this->unit_id);
      }
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      $this->data['pagination'] = create_pagination('stock_in/purchase_approved/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['meta_title'] = 'Approved List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function purchase_rejected($offset=0){
      $limit = 25;
      if (in_array($this->unit_id, array(2,3,4))) {
         $results = $this->Stock_in_model->get_purchase($limit, $offset, 10);
      } else {
         $results = $this->Stock_in_model->get_purchase($limit, $offset, 10, $this->unit_id);
      }
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      $this->data['pagination'] = create_pagination('stock_in/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['meta_title'] = 'Rejected List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function purchase_received($offset=0){
      $limit = 25;
      if (in_array($this->unit_id, array(2,3,4))) {
         $results = $this->Stock_in_model->get_purchase($limit, $offset, array(9,11));
      } else {
         $results = $this->Stock_in_model->get_purchase($limit, $offset, array(9), $this->unit_id);
      }
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      $this->data['pagination'] = create_pagination('stock_in/purchase_received/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      $this->data['meta_title'] = 'Received List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   // item purchase approve process here
   public function ap_status($id){
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->data['info'] = $this->db->where('id', $id)->get('item_stock_in')->row();
      // dd($this->data['info']);
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name, sc.sub_cate_name');
      $this->db->from('item_stock_in_details ri');
      $this->db->join('items i', 'i.id = ri.item_id');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id');
      $this->db->join('item_categories c', 'c.id = i.cat_id');
      $this->db->join('item_sub_categories sc', 'sc.id = i.sub_cat_id');
      $this->db->where('stock_in_id', $id);
      $this->data['purchase_item_data'] = $this->db->get()->result();
      $this->data['meta_title'] = 'Stock edit Form';
      $this->data['subview'] = 'edited';
      $this->load->view('backend/_layout_main', $this->data);
   }
   public function change_status($id){
      $user = $this->ion_auth->user()->row();
      $form_data = array(
         'status'       => $_POST['status'],
         'description'  => $_POST['description'],
         'updated_at'   => date('Y-m-d H:i:s'),
      );
      if ($this->ion_auth->in_group(array('do')) && in_array($this->unit_id, array(2,3,4))) {
         $form_data['division_do_id'] = $user->user_id;
      } elseif ($this->ion_auth->in_group(array('sm')) && in_array($this->unit_id, array(2,3,4))) {
         $form_data['division_sm_id'] = $user->user_id;
      } else if ($this->ion_auth->in_group(array('do'))) {
         $form_data['do_id'] = $user->user_id;
      } else {
         $form_data['director_id'] = $user->user_id;
      }

      $this->db->where('id', $id);
      if($this->db->update('item_stock_in' , $form_data)){
         for ($i=0; $i<sizeof($_POST['hide_id']); $i++) {
            $form_data2 = array(
               'approve_qty'       => $_POST['approve_qty'][$i]
            );
            $this->db->where('id', $_POST['hide_id'][$i]);
            $this->db->update('item_stock_in_details', $form_data2);
         }
         $this->session->set_flashdata('success', 'Update successfully.');
         redirect("stock_in/purchase_pending");
      }
   }

   public function received($id){
      $user = $this->session->userdata();

      $form_data = array(
         'is_received'  => 2,
         'status'       => 9,
         'updated_at'   => date('Y-m-d H:i:s'),
      );
      $this->db->where('id', $id);
      if ($this->db->update('item_stock_in', $form_data)) {

         $division_id = $this->db->where('id', $id)->get('item_stock_in')->row()->division_id;
         $records =  $this->db->where('stock_in_id', $id)->get('item_stock_in_details')->result();

         foreach($records as $p){
            $div_items = $this->db->where('unit_id',$division_id)->where('item_id',$p->item_id)->get('item_stocks')->row();
            // minus division stock
            $daa = array(
               'stock_out'  => $div_items->stock_out + $p->approve_qty,
               'balance'    => $div_items->balance - $p->approve_qty,
               'updated_by' => $user['user_id'],
               'updated_at' => date('Y-m-d H:i:s'),
            );

            $this->db->where('unit_id',$division_id)->where('item_id',$p->item_id);
            $this->db->update('item_stocks',$daa);

            $ddd = array(
               'unit_id'      => $division_id,
               'item_id'      => $div_items->item_id,
               'cat_id'       => $div_items->cat_id,
               'sub_cat_id'   => $div_items->sub_cat_id,
               'qty'          => $p->approve_qty,
               'status'       => 6,  // stock out to requisition
               'updated_by'   => $user['user_id'],
               'updated_at'   => date('Y-m-d H:i:s'),
            );
            $this->db->insert('item_stocks_details', $ddd);

            // plus user division stock
            $items = $this->db->where('unit_id',$user['unit_id'])->where('item_id',$p->item_id)->get('item_stocks')->row();
            if (!empty($items)) {
               $aa = array(
                  'stock_in'   => $items->stock_in + $p->approve_qty,
                  'balance'    => $items->balance + $p->approve_qty,
                  'updated_by' => $user['user_id'],
                  'updated_at' => date('Y-m-d H:i:s'),
               );
               $this->db->where('unit_id',$user['unit_id'])->where('item_id',$p->item_id);
               $this->db->update('item_stocks',$aa);
            } else {
               $it = $this->db->where('id', $p->item_id)->get('items')->row();
               $aa = array(
                  'unit_id'    => $user['unit_id'],
                  'item_id'    => $p->item_id,
                  'cat_id'     => $it->cat_id,
                  'sub_cat_id' => $it->sub_cat_id,
                  'stock_in'   => $p->approve_qty,
                  'stock_out'  => 0,
                  'balance'    => $p->approve_qty,
                  'order_level'=> $it->order_level,
                  'updated_by' => $user['user_id'],
                  'updated_at' => date('Y-m-d H:i:s'),
               );
               $this->db->insert('item_stocks', $aa);
            }

            // plus user stock
            $dd = array(
               'unit_id'      => $user['unit_id'],
               'item_id'      => $p->item_id,
               'cat_id'       => $p->cat_id,
               'sub_cat_id'   => $p->sub_cat_id,
               'qty'          => $p->approve_qty,
               'status'       => 4,  // stock in
               'updated_by'   => $user['user_id'],
               'updated_at'   => date('Y-m-d H:i:s'),
            );
            $this->db->insert('item_stocks_details', $dd);
         }
         $this->session->set_flashdata('success', 'Update successfully.');
         redirect("stock_in");
      }
   }

   public function in_received($id){
      $user = $this->session->userdata();

      $form_data = array(
         'is_received'  => 2,
         'status'       => 11,
         'updated_at'   => date('Y-m-d H:i:s'),
      );
      $this->db->where('id', $id);
      if ($this->db->update('item_stock_in', $form_data)) {
         $records =  $this->db->where('stock_in_id', $id)->get('item_stock_in_details')->result();
         foreach($records as $p){
            $div_items = $this->db->where('unit_id',$this->unit_id)->where('item_id',$p->item_id)->get('item_stocks')->row();
            if (!empty($div_items)) {   // purchase division stock
               $aa = array(
                  'stock_in'   => $div_items->stock_in + $p->approve_qty,
                  'balance'    => $div_items->balance + $p->approve_qty,
                  'updated_by' => $user['user_id'],
                  'updated_at' => date('Y-m-d H:i:s'),
               );
               $this->db->where('unit_id',$user['unit_id'])->where('item_id',$p->item_id);
               $this->db->update('item_stocks',$aa);
            } else {   // division stock
               $it = $this->db->where('id', $p->item_id)->get('items')->row();
               $aa = array(
                  'unit_id'    => $user['unit_id'],
                  'item_id'    => $p->item_id,
                  'cat_id'     => $it->cat_id,
                  'sub_cat_id' => $it->sub_cat_id,
                  'stock_in'   => $p->approve_qty,
                  'stock_out'  => 0,
                  'balance'    => $p->approve_qty,
                  'order_level'=> $it->order_level,
                  'updated_by' => $user['user_id'],
                  'updated_at' => date('Y-m-d H:i:s'),
               );
               $this->db->insert('item_stocks', $aa);
            }

            // plus user division stock
            $dd = array(
               'unit_id'      => $user['unit_id'],
               'item_id'      => $p->item_id,
               'cat_id'       => $p->cat_id,
               'sub_cat_id'   => $p->sub_cat_id,
               'qty'          => $p->approve_qty,
               'status'       => 4,  // stock in
               'updated_by'   => $user['user_id'],
               'updated_at'   => date('Y-m-d H:i:s'),
            );
            $this->db->insert('item_stocks_details', $dd);
         }
         $this->session->set_flashdata('success', 'Update successfully.');
         redirect("stock_in");
      };
   }

   function print_stock_in( $id ) {
      //Results
      $this->db->where('id', $id);
      $this->data['info']=$this->db->get('item_stock_in')->row();
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name, sc.sub_cate_name');
      $this->db->from('item_stock_in_details ri');
      $this->db->join('items i', 'i.id = ri.item_id');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id');
      $this->db->join('item_categories c', 'c.id = i.cat_id');
      $this->db->join('item_sub_categories sc', 'sc.id = i.sub_cat_id');
      $this->db->where('stock_in_id', $id);
      $this->data['items'] = $this->db->get()->result();

      // Generate PDF
      $this->data['headding'] = 'Stock in';
      $html = $this->load->view('pdf_print_stock_in', $this->data, true);
      $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
      $mpdf->WriteHtml($html);
      $mpdf->output();
   }
   // item purchase approve process end
}
