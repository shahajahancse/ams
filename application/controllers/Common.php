<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends Backend_Controller {
   var $userID;
   // var $img_path;

   //var $img_orginal_path;
   //var $img_thumb_path;

   public function __construct(){
      parent::__construct();
      // if (!$this->ion_auth->logged_in()):
      //    redirect('login');
      // endif;

      $this->data['module_title'] = 'Common Module';
      $this->userID = $this->session->userdata('user_id');
      $this->load->model('Common_model');
      $this->load->model('Cropper_model');
      // $this->img_path = realpath(APPPATH . '../profile_img');

      //$this->img_orginal_path = realpath(APPPATH . '../temp_dir/');
      //$this->img_thumb_path = realpath(APPPATH . '../temp_dir/_thumb/');

      // echo '<pre>';
      // print_r($this->session->all_userdata());
   }

   function ajax_get_category_by_division($id){
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($this->Common_model->ajax_get_category_by_division($id)));
   }

   function ajax_get_sub_category_by_category($id){
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($this->Common_model->get_sub_category_by_cate_id($id)));
   }

   function ajax_get_item_by_sub_category($id){
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($this->Common_model->get_items_by_sub_cate_id($id)));
   }

   /****************************** Cropper **********************/
   public function upload() {
      $json = array();
      $avatar_src = $this->input->post('avatar_src');
      $avatar_data = $this->input->post('avatar_data');
      $avatar_file = $_FILES['avatar_file'];
      //$ussid = $this->input->post('ussid');
      $upltype = $this->input->post('upltype');

      $originalPath = ROOT_UPLOAD_PATH; //$this->img_orginal_path;
      $thumbPath = ROOT_UPLOAD_PATH.'_thumb/'; //$this->img_thumb_path;
      $urlPath =  HTTP_USER_PROFILE_THUMB_PATH; //$this->img_thumb_path;

      $thumb = $this->Cropper_model->setDst($thumbPath);
      $this->Cropper_model->setSrc($avatar_src);
      $data = $this->Cropper_model->setData($avatar_data);
      // set file
      $avatar_path = $this->Cropper_model->setFile($avatar_file, $originalPath);
      // crop
      $this->Cropper_model->crop($avatar_path, $thumb, $data);

      // response
      // 'ussid' => $ussid,
      $json = array(
         'state'  => 200,
         'message' => $this->Cropper_model->getMsg(),
         'result' => $this->Cropper_model->getResult(),
         'thumb' => $this->Cropper_model->getThumbResult(),
         'upltype' => $upltype,
         'urlPath' => $urlPath,
         );
      echo json_encode($json);
   }

   // upload prifile avatar Crop Image
   public function uploadCropImg() {
      $json = array();
      $image_url = $this->input->post('image_url');
      $user_id = base64_decode($this->input->post('member_id'));
      $upltype = $this->input->post('upltype');
      if (!empty($user_id) && !empty($upltype) && $upltype=='avatar') {
         $this->Common_model->seturl($image_url);
         //$this->Common_model->setUserID($user_id);
         //$this->Common_model->setProfilePicture();
         $json['success'] = 'success';
      }  else {
         $json['success'] = 'failed';
      }
      header('Content-Type: application/json');
      echo json_encode($json);
   }
  public function ajax_get_item_by_id($id){
   $this->db->where('id', $id);
   $query = $this->db->get('items');

   $data['items'] = $query->row();
   $user_id=$this->session->userdata('user_id');
   $data['status'] = 'no';

   $this->db->where('user_id', $user_id);
   $this->db->order_by('id', 'DESC');
   $query = $this->db->get('requisitions');

   foreach ($query->result() as $key => $value) {
      $this->db->where('requisition_id', $value->id);
      $query2 = $this->db->get('requisition_item');
         foreach ($query2->result() as $key2 => $value2) {
            if ($value2->item_id == $id) {
               $data['requisition_qty'] = $value2->qty_approve;
               $data['requisition'] = date('Y-m-d', strtotime($value->created));
               $data['status'] = 'yes';
               break;
            }
       }
       if ( $data['status'] =='yes'){
          break;
       }
   };
   $availability_enjoy=0;
   foreach ($query->result() as $key => $value) {
      $this->db->where('requisition_id', $value->id);
      $query2 = $this->db->get('requisition_item');
         foreach ($query2->result() as $key2 => $value2) {
            if ($value2->item_id == $id) {
              $availability_enjoy=$availability_get+$value2->qty_approve;
            }
       }
   };

   $availability_get=$this->Common_model->get_item_availability($user_id,$id);
   $data['availability_enjoy']=$availability_enjoy;
   $data['availability_get']=$availability_get;

   echo json_encode($data);
  }

   function ajax_exists_nid(){
      $item = $_POST['inputData'];
      $this->db->from('users');
      $this->db->where('username', $item);
      $query = $this->db->get()->row();

      if (empty($query)) {
         echo 'true';
      }else{
         echo 'false';
      }
   }
}
