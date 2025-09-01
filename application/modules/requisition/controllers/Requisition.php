<?php defined('BASEPATH') or exit('No direct script access allowed');

class Requisition extends Backend_Controller
{
    public $userID;
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_name'] = 'Requisition';
        $this->load->model('Requisition_model');
        $this->userSessID = $this->session->userdata('user_id');
    }

    public function index($offset = 0)
    {
        $limit = 25;
        $results = $this->Requisition_model->get_requisition($limit, $offset, $status);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('requisition/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load view
        $this->data['meta_title'] = 'Requisition List';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function request_list($offset = 0)
    {
        $limit = 25;
        $status = array();
        if($this->ion_auth->in_group(array('do'))){
            $status = array(3);
        } else {
            $status = array(2);
        }
        $results = $this->Requisition_model->get_requisition($limit, $offset, $status);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        $this->data['pagination'] = create_pagination('requisition/request_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['meta_title'] = 'Pending Requisition List';
        $this->data['subview'] = 'request_list';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function approve_list($offset = 0)
    {
        $limit = 25;
        $status = array();
        if($this->ion_auth->in_group(array('do'))){
            $status = array(5);
        } else {
            $status = array(3,5);
        }
        $results = $this->Requisition_model->get_requisition($limit, $offset, $status);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];
        //pagination
        $this->data['pagination'] = create_pagination('requisition/approve_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        // Load view
        $this->data['meta_title'] = 'Approved Requisition List';
        $this->data['subview'] = 'approve_list';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function delivered_list($offset = 0)
    {
        $limit = 25;
        $status = array(6);
        $results = $this->Requisition_model->get_requisition($limit, $offset, $status);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('requisition/delivered_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load view
        $this->data['meta_title'] = 'Delivered Requisition List';
        $this->data['subview'] = 'delivered_list';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function rejected_list($offset = 0)
    {
        $limit = 25;
        $status = array(7);
        $results = $this->Requisition_model->get_requisition($limit, $offset, $status);
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        $this->data['pagination'] = create_pagination('requisition/rejected_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);
        $this->data['meta_title'] = 'Rejected Requisition List';
        $this->data['subview'] = 'rejected_list';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function change_status($id)
    {
        if (!$this->Common_model->exists('item_requisitions', 'id', $id)) {
            show_404('requisition - update - exitsts', true);
        }
        //Validation
        $this->form_validation->set_rules('status', ' status', 'required|trim');
        //Validate and input data
        if ($this->form_validation->run() == true) {
            $user = $this->ion_auth->user()->row();
            $desk_id = 3;
            $desk_id = 3;
            if(in_array($_POST['status'], array(4,5))){
                $desk_id = 1;
            } else if ($_POST['status'] == 6) {
                $desk_id = 4;
            } else if ($_POST['status'] == 8) {
                $desk_id = 5;
            }

            $form_data = array(
                'desk_id'      => $desk_id,
                'status'       => $_POST['status'],
                'description'  => $_POST['description'],
                'updated_at'   => date('Y-m-d H:i:s'),
            );
            if ($this->ion_auth->in_group(array('jd'))) {
                $form_data['asst_id'] = $user->user_id;
            } else if($this->ion_auth->in_group(array('dg'))) {
                $form_data['director_id'] = $user->user_id;
            }
            $this->db->where('id', $id);
            if($this->db->update('item_requisitions' , $form_data)){
                for ($i=0; $i<sizeof($_POST['hide_id']); $i++) {
                    $form_data2 = array(
                        'qty_approve'   => $_POST['qty_approve'][$i]
                    );
                    $this->db->where('id', $_POST['hide_id'][$i]);
                    $this->db->update('item_requisition_details', $form_data2);
                }
                $this->session->set_flashdata('success', 'Update requisition successfully.');
                redirect("requisition/request_list");
            }
        } else {
            redirect('requisition/ap_status/'.$id,'refresh');
        }
    }
    public function ap_status($id){
        $this->data['categories'] = $this->Common_model->get_categories();
        $this->data['info'] = $this->db->where('id', $id)->get('item_requisitions')->row();

        $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name, sc.sub_cate_name');
        $this->db->from('item_requisition_details ri');
        $this->db->join('items i', 'i.id = ri.item_id');
        $this->db->join('item_unit iu', 'iu.id = i.unit_id');
        $this->db->join('item_categories c', 'c.id = i.cat_id');
        $this->db->join('item_sub_categories sc', 'sc.id = i.sub_cat_id');
        $this->db->where('requisition_id', $id);
        $this->data['purchase_item_data'] = $this->db->get()->result();
        $this->data['meta_title'] = 'Requisition Approve Form';
        $this->data['subview'] = 'edited';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function received($id){
        $this->data['categories'] = $this->Common_model->get_categories();
        $this->data['info'] = $this->db->where('id', $id)->get('item_requisitions')->row();

        $this->db->select('ri.*, i.item_name, iu.unit_name, c.category_name, sc.sub_cate_name');
        $this->db->from('item_requisition_details ri');
        $this->db->join('items i', 'i.id = ri.item_id');
        $this->db->join('item_unit iu', 'iu.id = i.unit_id');
        $this->db->join('item_categories c', 'c.id = i.cat_id');
        $this->db->join('item_sub_categories sc', 'sc.id = i.sub_cat_id');
        $this->db->where('requisition_id', $id);
        $this->data['purchase_item_data'] = $this->db->get()->result();
        $this->data['meta_title'] = 'Requisition Delivery Form';
        $this->data['subview'] = 'received';
        $this->load->view('backend/_layout_main', $this->data);
    }
    public function delivery_product($id)
    {
        $info = $this->Requisition_model->get_info($id);
        if (!$this->Common_model->exists('item_requisitions', 'id', $id)) {
            show_404('requisition - delivery_product - exitsts', true);
        }

        if ($_POST['status'] == 6) {
            $unit_id = $info->unit_id;
            $this->db->trans_start();
            for ($i=0; $i<sizeof($_POST['hide_id']); $i++) {
                $qty_approve = $_POST['qty_approve'][$i];
                $item_id = $_POST['item_id'][$i];
                $row = $this->db->where('unit_id', $unit_id)->where('item_id', $item_id)->get('item_stocks')->row();
                if ($row->balance >= $qty_approve) {
                    $form_data = array(
                        'stock_out'  => $row->stock_out + $qty_approve,
                        'balance'    => $row->balance - $qty_approve,
                        'updated_by' => $info->user_id,
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->where('unit_id', $unit_id)->where('item_id', $item_id);
                    $this->db->update('item_stocks', $form_data);
                    $form_data1 = array(
                        'unit_id'       => $info->unit_id,
                        'item_id'       => $item_id,
                        'cat_id'        => $_POST['cat_id'][$i],
                        'sub_cat_id'   => $_POST['sub_cat_id'][$i],
                        'qty'           => $qty_approve,
                        'status'        => 3,
                        'updated_by'    => $info->user_id,
                        'updated_at'    => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('item_stocks_details', $form_data1);
                } else {
                    $this->db->trans_rollback(); // Rollback if there was an error
                    $this->session->set_flashdata('error', 'Stock not enough.');
                    redirect("requisition/approve_list");
                }
            }

            $form_data2 = array(
                'status'       => 6,
                'is_delivered' => 2,
                'updated_at'   => date('Y-m-d H:i:s'),
            );
            $this->Common_model->edit('item_requisitions', $id, 'id', $form_data2);

            $this->db->trans_complete(); // Automatically commits if no error
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback(); // Rollback if there was an error
            } else {
                $this->session->set_flashdata('success', 'Product delivery successfully.');
            }
            redirect("requisition/approve_list");
        } else {
            $this->data['info'] = $info;
            redirect("requisition/approve_list");
        }

        //Results
        $this->data['info'] = $info;
        $this->data['items'] = $this->Requisition_model->get_req_items($id);

        //Load view
        $this->data['meta_title'] = 'Delivery Product';
        $this->data['subview'] = 'delivery_product';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id){

        if (!$this->Common_model->exists('item_requisitions', 'id', $id)) {
            show_404('My_requisition - details - exitsts', TRUE);
        }
        //Results
        $this->data['info'] = $this->Requisition_model->get_info($id);
        $this->data['items'] = $this->Requisition_model->get_req_items($id);

        // Load page
        $this->data['meta_title'] = 'Requisition Details';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }











    public function pin_check($str)
    {
        $id = $this->input->post('hide_req_id');
        $pin = $this->input->post('pincode');

        $num_row = $this->db->where('id', $id)->where('pin_code', $pin)->get('item_requisitions')->num_rows();

        if ($num_row >= 1) {
            return true;
        } else {
            $this->form_validation->set_message('pin_check', "PIN Code '$str' is not valid");
            return false;
        }
    }

}
