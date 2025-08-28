<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Direct_purchase extends Backend_Controller {
   var $userID;

   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'Purchase';
      $this->load->model('Direct_purchase_model');
      $this->userId = $this->session->userdata('user_id');
      $this->unit_id = $this->session->userdata('unit_id');
   }

   public function index($offset=0){
      $limit = 25;
      //Results
      $results = $this->Direct_purchase_model->get_purchase($limit, $offset, $this->unit_id);
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('direct_purchase/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'Direct Purchase List';
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
         // form data
         $form_data = array(
            'unit_id'         => $user->unit_id,
            'supplier_name'   => $this->input->post('title'),
            'amount'          => 0,
            'f_year_id'       => $fiscal_year->id,
            'desk_id'         => 1,
            'status'          => 6,  // 6 for complete
            'type'            => 2,  // 2 for direct purchase
            'is_received'     => 2,  // 2 for received
            'description'     => $this->input->post('description'),
            'created_by'      => $user->id,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
            'attachment'      => $attachmentname
         );

         if($this->Common_model->save('item_purchases', $form_data)){  // save item purchase
            $insert_id = $this->db->insert_id();
            for ($i=0; $i<sizeof($_POST['item_id']); $i++) {
               $form_data2 = array(
                  'unit_id'            => $user->unit_id,
                  'purchase_id'        => $insert_id,
                  'pur_item_id'        => $_POST['item_id'][$i],
                  'pur_quantity'       => $_POST['qty_request'][$i],
                  'pur_approve'        => $_POST['qty_request'][$i],
                  'pur_fiscal_year_id' => $fiscal_year->id,
                  'pur_remark'         => $_POST['remark'][$i]
               );
               $this->Common_model->save('item_purchase_details', $form_data2); // save item purchase details

               $items = $this->db->where('unit_id',$user->unit_id)->where('item_id',$_POST['item_id'][$i])->get('item_stocks')->row();
               if (!empty($items)) {
                  // update item stock
                  $aa = array(
                     'stock_in'   => $items->stock_in + $_POST['qty_request'][$i],
                     'balance'    => $items->balance + $_POST['qty_request'][$i],
                     'updated_by' => $user->unit_id,
                     'updated_at' => date('Y-m-d H:i:s'),
                  );
                  $this->db->where('unit_id',$user->unit_id)->where('item_id',$_POST['item_id'][$i]);
                  $this->db->update('item_stocks',$aa);
               } else {
                  // insert
                  $it = $this->db->where('id',$_POST['item_id'][$i])->get('items')->row();
                  $aa = array(
                     'unit_id'      => $user->unit_id,
                     'item_id'      => $_POST['item_id'][$i],
                     'cat_id'       => $it->cat_id,
                     'sub_cat_id'   => $it->sub_cat_id,
                     'stock_in'   => $items->stock_in + $_POST['qty_request'][$i],
                     'stock_out'  => 0,
                     'balance'    => $items->balance + $_POST['qty_request'][$i],
                     'order_level' => $it->order_level,
                     'updated_by' => $user->unit_id,
                     'updated_at'   => date('Y-m-d H:i:s'),
                  );
                  $this->db->insert('item_stocks', $aa);
               }
               // insert item stock details
               $dd = array(
                  'unit_id'      => $user->unit_id,
                  'item_id'      => $_POST['item_id'][$i],
                  'cat_id'       => $items->cat_id ? $items->cat_id : $it->cat_id,
                  'sub_cat_id'   => $items->sub_cat_id ? $items->sub_cat_id : $it->sub_cat_id,
                  'qty'          => $_POST['qty_request'][$i],
                  'status'       => 5,  // 5 for direct purchase
                  'updated_by'   => $user->id,
                  'updated_at'   => date('Y-m-d H:i:s'),
               );
               $this->db->insert('item_stocks_details', $dd);
            }

            $this->session->set_flashdata('success', 'Create successfully.');
            redirect("direct_purchase");
         }
      }

      //Dropdown
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->data['info'] = $this->Common_model->get_user_details();

      //Load view
      $this->data['meta_title'] = 'Purchase Entry Form';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function details($id){
      if (!$this->Common_model->exists('item_purchases', 'id', $id)) {
         show_404('Purchase - details - exitsts', TRUE);
      }

      //Results
      $this->db->where('id', $id);
      $this->data['info']=$this->db->get('item_purchases')->row();
      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name, sc.sub_cate_name');
      $this->db->from('item_purchase_details ri');
      $this->db->join('items i', 'i.id = ri.pur_item_id');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id');
      $this->db->join('item_categories c', 'c.id = i.cat_id');
      $this->db->join('item_sub_categories sc', 'sc.id = i.sub_cat_id');
      $this->db->where('purchase_id', $id);
      $this->data['purchase_item_data'] = $this->db->get()->result();

      // Load page
      $this->data['meta_title'] = 'Purchase Details';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }
   // item purchase create end

   // item purchase approve process here
   public function change_status($id){
      $user = $this->ion_auth->user()->row();
      $desk_id = 1;
      if($this->ion_auth->in_group(array('do')) && $_POST['status'] == 3){
         $desk_id = 3;
      }

      $form_data = array(
         'desk_id'      => $desk_id,
         'status'       => $_POST['status'],
         'description'  => $_POST['description'],
         'updated_at'   => date('Y-m-d H:i:s'),
      );
      if ($this->ion_auth->in_group(array('do'))) {
         $form_data['do_id'] = $user->user_id;
      } else {
         $form_data['director_id'] = $user->user_id;
      }

      $this->db->where('id', $id);
      if($this->db->update('item_purchases' , $form_data)){
         for ($i=0; $i<sizeof($_POST['hide_id']); $i++) {
            $form_data2 = array(
               'pur_approve'       => $_POST['pur_approve'][$i]
            );
            $this->db->where('id', $_POST['hide_id'][$i]);
            $this->db->update('item_purchase_details', $form_data2);
         }
         $this->session->set_flashdata('success', 'Update Purchase successfully.');
         redirect("direct_purchase");
      }
   }
   public function received($id){
      $user = $this->session->userdata();

      $form_data = array(
         'is_received'  => 2,
         'status'       => 6,
         'updated_at'   => date('Y-m-d H:i:s'),
      );
      $this->db->where('id', $id);
      if ($this->db->update('item_purchases', $form_data)) {

         $this->db->where('purchase_id', $id);
         $purchase_data = $this->db->get('item_purchase_details')->result();

         foreach($purchase_data as $p){
            $items = $this->db->where('unit_id',$user['unit_id'])->where('item_id',$p->pur_item_id)->get('item_stocks')->row();
            $aa = array(
               'stock_in'   => $items->stock_in + $p->pur_approve,
               'balance'    => $items->balance + $p->pur_approve,
               'updated_by' => $user['user_id'],
               'updated_at' => date('Y-m-d H:i:s'),
            );

            $this->db->where('unit_id',$user['unit_id'])->where('item_id',$p->pur_item_id);
            $this->db->update('item_stocks',$aa);
            $dd = array(
               'unit_id'      => $user['unit_id'],
               'item_id'      => $items->item_id,
               'cat_id'       => $items->cat_id,
               'sub_cat_id'   => $items->sub_cat_id,
               'qty'          => $p->pur_approve,
               'status'       => 2,
               'updated_by'   => $user['user_id'],
               'updated_at'   => date('Y-m-d H:i:s'),
            );
            $this->db->insert('item_stocks_details', $dd);
         }
         $this->session->set_flashdata('success', 'Update Purchase successfully.');
         redirect("direct_purchase");
      };
   }

   public function print_direct($id){
      //Results
      $this->db->where('id', $id);
      $this->data['info']=$this->db->get('item_purchases')->row();

      $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name, sc.sub_cate_name');
      $this->db->from('item_purchase_details ri');
      $this->db->join('items i', 'i.id = ri.pur_item_id');
      $this->db->join('item_unit iu', 'iu.id = i.unit_id');
      $this->db->join('item_categories c', 'c.id = i.cat_id');
      $this->db->join('item_sub_categories sc', 'sc.id = i.sub_cat_id');
      $this->db->where('purchase_id', $id);
      $this->data['items'] = $this->db->get()->result();
      // Generate PDF
      $this->data['headding'] = 'Direct Purchase';
      $html = $this->load->view('pdf_print_direct', $this->data, true);
      $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
      $mpdf->WriteHtml($html);
      $mpdf->output();
   }
   // item purchase approve process end
}
