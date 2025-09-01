<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_requisition extends Backend_Controller {
   var $userID;
   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'My Requisition';
      $this->load->model('My_requisition_model');
      $this->userId = $this->session->userdata('user_id');
   }

   public function index($offset=0){
      $limit = 25;
      $results = $this->My_requisition_model->get_my_requisition($limit, $offset);
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('my_requisition/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
      // Load view
      $this->data['meta_title'] = 'My Requisition List';
      $this->data['subview'] = 'index';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function create(){
      $fiscal_year = $this->Common_model->get_current_fiscal_year();
      $this->data['fiscal_year'] = $fiscal_year->fiscal_year_name;
      // dd($_POST);
      //Validation
      $this->form_validation->set_rules('title', 'title','required|trim|max_length[255]');
      //Validate and input data
      if ($this->form_validation->run() == true){
         $user = $this->ion_auth->user()->row();
         $approve_reject_user= [];
         $final_appruver= [];
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

         if ($_POST['submit_type']=='save'){
            $status = 1;
            $desk_id = 1;
         }else{
            $status = 2;
            $desk_id = 2;
         }
         if ($_POST['urgent_status']){
            $urgent_status = 2;
         }else{
            $urgent_status = 1;
         }

         $sl = $this->db->order_by('id', 'desc')->limit(1)->get('item_requisitions')->row();
         if (!$sl) {
            $sl = '00000001';
         } else {
            $sl = sprintf('%08d', $sl->pin_code + 1);
         }

         $form_data = array(
            'unit_id'       => $user->unit_id,
            'user_id'       => $user->id,
            'department_id' => ($user->dept_id)? $user->dept_id:'',
            'title'         => $this->input->post('title'),
            'status'        => $status,
            'desk_id'       => $desk_id,
            'pin_code'      => $sl,
            'f_year_id'     => $fiscal_year->id,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'is_delivered'  => 1,
            'urgent_status' => $urgent_status,
            'attachment'    => $attachmentname,
            'description'   => $this->input->post('description'),
         );

         if($this->Common_model->save('item_requisitions', $form_data)){
            $insert_id = $this->db->insert_id();
            for ($i=0; $i<sizeof($_POST['item_id']); $i++) {
               if (!empty($_POST['item_id'][$i]) && !empty($_POST['qty_request'][$i])) {
                  $form_data2 = array(
                     'unit_id'            => $user->unit_id,
                     'requisition_id'     => $insert_id,
                     'item_id'            => $_POST['item_id'][$i],
                     'cat_id'             => $_POST['cat_id'][$i],
                     'sub_cat_id'         => $_POST['sub_cat_id'][$i],
                     'dept_id'            => ($user->dept_id)?$user->dept_id:'',
                     'fiscal_year_id'     => $fiscal_year->id,
                     'qty_request'        => $_POST['qty_request'][$i],
                     'remark'             => $_POST['remark'][$i]
                  );
                  $this->Common_model->save('item_requisition_details', $form_data2);
               }
            }
            $this->session->set_flashdata('success', 'Create Requisition successfully.');
            redirect("my_requisition");
         }
      }

      //Dropdown
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->data['info'] = $this->Common_model->get_user_details();

      //Load view
      $this->data['meta_title'] = 'Requisition Entry Form';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function edit($id)
   {
      $fiscal_year = $this->Common_model->get_current_fiscal_year();
      $this->data['fiscal_year'] = $fiscal_year->fiscal_year_name;

      if (!$this->Common_model->exists('item_requisitions', 'id', $id)) {
         show_404('requisition - update - exitsts', true);
      }

      //Validation
      $this->form_validation->set_rules('status', ' status', 'required|trim');
      if ($this->form_validation->run() == true){
         $user = $this->ion_auth->user()->row();
         $form_data = array(
            'status'       => $this->input->post('status'),
            'description'  => $this->input->post('description'),
            'desk_id'      => ($this->input->post('status') == 1)? 1:2,
            'updated_at'   => date('Y-m-d H:i:s'),
         );

         $this->db->where('id', $id);
         if ($this->db->update('item_requisitions', $form_data)) {
            for ($i = 0; $i < sizeof($_POST['hide_id']); $i++) {
               if (!empty($_POST['hide_id'][$i])) {
                  $form_data2 = array(
                     'qty_request' => $_POST['qty_request'][$i],
                  );
                  $this->db->where('id', $_POST['hide_id'][$i]);
                  $this->db->update('item_requisition_details', $form_data2);
               } else {
                  $form_data2 = array(
                     'unit_id'            => $user->unit_id,
                     'requisition_id'     => $id,
                     'item_id'            => $_POST['item_id'][$i],
                     'cat_id'             => $_POST['cat_id'][$i],
                     'sub_cat_id'         => $_POST['sub_cat_id'][$i],
                     'dept_id'            => ($user->dept_id)?$user->dept_id:'',
                     'fiscal_year_id'     => $fiscal_year->id,
                     'qty_request'        => $_POST['qty_request'][$i],
                     'remark'             => $_POST['des'][$i]
                  );
                  $this->Common_model->save('item_requisition_details', $form_data2);
               }
            }
            $this->session->set_flashdata('success', 'Update information successfully.');
            redirect("my_requisition");
         } else {
            $this->session->set_flashdata('error', 'Update information failed.');
            redirect("my_requisition");
         }
      }

      //Results
      $this->data['categories'] = $this->Common_model->get_categories();
      $this->data['info'] = $this->My_requisition_model->get_info($id);
      $this->data['items'] = $this->My_requisition_model->get_req_items($id);
      // dd($this->data['items']);
      $this->data['meta_title'] = 'Update Requisition';
      $this->data['subview'] = 'edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function details($id){

      if (!$this->Common_model->exists('item_requisitions', 'id', $id)) {
         show_404('My_requisition - details - exitsts', TRUE);
      }
      //Results
      $this->data['info'] = $this->My_requisition_model->get_info($id);
      $this->data['items'] = $this->My_requisition_model->get_req_items($id);

      // Load page
      $this->data['meta_title'] = 'Requisition Details';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   // report print
   public function print_requisition($id){
      // Item Results
      //Results
      $this->data['info'] = $this->My_requisition_model->get_info($id);
      $this->data['items'] = $this->My_requisition_model->get_req_items($id);
      // Generate PDF
      $this->data['headding'] = 'Requisition';
      $html = $this->load->view('pdf_print', $this->data, true);
      $mpdf = new mPDF('', 'A4', 10, '', 10, 10, 10, 5);
      $mpdf->WriteHtml($html);
      $mpdf->output();
   }
   /************************************ Old **********************************/

}
