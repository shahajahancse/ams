<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Acl extends Backend_Controller {

	public function __construct(){
        parent::__construct();

        $this->data['module_title'] = 'Access Control';
        $this->load->model('Acl_model');

        if(!$this->ion_auth->logged_in()){
            redirect('login');
        }
    }

    public function index($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->Acl_model->get_users($limit, $offset);
        // print_r($results); exit;

        $this->data['users'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        foreach ($this->data['users'] as $k => $user){
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        //pagination
        $this->data['pagination'] = create_pagination('acl/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //Load page
        $this->data['meta_title'] = 'All Users';
        $this->data['subview'] = 'index';
        $this->load->view('backend/_layout_main', $this->data);
    }

    function acl_excel() {
        $results = $this->Acl_model->get_users($limit, $offset);
        $this->data['users'] = $results['rows'];
        foreach ($this->data['users'] as $k => $user){
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        // Generate PDF
        $this->data['headding'] = 'User List';
        $this->load->view('acl_excel', $this->data, true);
    }

    /******************** Access Level *********************/
    public function access_level(){
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['results'] = $this->Acl_model->get_access_level();

        //Load page
        $this->data['meta_title'] = 'Access Level';
        $this->data['subview'] = 'access_level';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function create_access_level(){
        // validate form input
        $this->form_validation->set_rules('task_register_id', 'select task register', 'required');
        $this->form_validation->set_rules('groups_id', 'select group', 'required');
        $this->form_validation->set_rules('groups_role_id', 'select group role', 'required');
        $this->form_validation->set_rules('groups_type_id', 'select group type', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'task_register_id' => $this->input->post('task_register_id'),
                'groups_id' => $this->input->post('groups_id'),
                'groups_role_id' => $this->input->post('groups_role_id'),
                'groups_type_id' => $this->input->post('groups_type_id')
                );

            // print_r($form_data); exit;
            if($this->Common_model->save('access_level', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'create access level ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'New access insert successfully.');
                redirect('acl/access_level');
            }
        }

        // Dropdown
        $this->data['task_register'] = $this->Acl_model->get_dd_task_register();
        $this->data['groups'] = $this->Acl_model->get_dd_groups();
        // $this->data['groups_role'] = $this->Acl_model->get_dd_groups_role();
        $this->data['groups_type'] = $this->Acl_model->get_dd_groups_type();

        // Load View
        $this->data['meta_title'] = 'Create Access Level';
        $this->data['subview'] = 'create_access_level';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit_access_level($id){
        // validate form input
        $this->form_validation->set_rules('task_register_id', 'select task register', 'required');
        $this->form_validation->set_rules('groups_id', 'select group', 'required');
        $this->form_validation->set_rules('groups_role_id', 'select group role', 'required');
        $this->form_validation->set_rules('groups_type_id', 'select group type', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'task_register_id' => $this->input->post('task_register_id'),
                'groups_id' => $this->input->post('groups_id'),
                'groups_role_id' => $this->input->post('groups_role_id'),
                'groups_type_id' => $this->input->post('groups_type_id')
                );

            // print_r($form_data); exit;
            if($this->Common_model->edit('access_level', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'create access level update ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('acl/access_level');
            }
        }

        // Dropdown
        $this->data['task_register'] = $this->Acl_model->get_dd_task_register();
        $this->data['groups'] = $this->Acl_model->get_dd_groups();
        // $this->data['groups_role'] = $this->Acl_model->get_dd_groups_role();
        $this->data['groups_type'] = $this->Acl_model->get_dd_groups_type();

        // Get details data
        $this->data['info'] = $this->Acl_model->get_access_level_info($id);

        // Load View
        $this->data['meta_title'] = 'Edit Access Level';
        $this->data['subview'] = 'edit_access_level';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /******************** Task Register *********************/
    public function task_register(){
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['results'] = $this->Acl_model->get_task_register();

        //Load page
        $this->data['meta_title'] = 'Task_Register';
        $this->data['subview'] = 'task_register';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // create a new Task Register
    public function create_task_register(){
        // validate form input
        $this->form_validation->set_rules('task_name_en', 'task name english', 'required');
        $this->form_validation->set_rules('task_name_bn', 'task name bangla', 'required');
        $this->form_validation->set_rules('controller_name', 'controller name', 'required');
        $this->form_validation->set_rules('controller_function', 'function name', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'task_name_en' => $this->input->post('task_name_en'),
                'task_name_bn' => $this->input->post('task_name_bn'),
                'controller_name' => $this->input->post('controller_name'),
                'controller_function' => $this->input->post('controller_function')
            );

            // print_r($form_data); exit;
            if($this->Common_model->save('task_register', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'New task insert ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'New task insert successfully.');
                redirect('acl/task_register');
            }
        }

        // echo '<pre>';
        $this->load->library('controllerlist');
        // print_r($this->controllerlist->getControllers());
        $this->data['controllers'] = $this->controllerlist->getControllers();

        $this->data['meta_title'] = 'Create Task Register';
        $this->data['subview'] = 'create_task_register';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // create a new Task Register
    public function edit_task_register($id){
        // validate form input
        $this->form_validation->set_rules('task_name_en', 'task name english', 'required');
        $this->form_validation->set_rules('task_name_bn', 'task name bangla', 'required');
        $this->form_validation->set_rules('controller_name', 'controller name', 'required');
        $this->form_validation->set_rules('controller_function', 'function name', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'task_name_en' => $this->input->post('task_name_en'),
                'task_name_bn' => $this->input->post('task_name_bn'),
                'controller_name' => $this->input->post('controller_name'),
                'controller_function' => $this->input->post('controller_function')
            );

            // print_r($form_data); exit;
            if($this->Common_model->edit('task_register', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, ' task insert update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('acl/task_register');
            }
        }

        // echo '<pre>';
        $this->load->library('controllerlist');
        // print_r($this->controllerlist->getControllers());
        $this->data['controllers'] = $this->controllerlist->getControllers();
        $this->data['info'] = $this->Acl_model->get_task_register_info($id);

        $this->data['meta_title'] = 'Edit Task Register';
        $this->data['subview'] = 'edit_task_register';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /******************** User *********************/
    // create a new user
    public function create_user()
    {
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;
        $this->form_validation->set_rules('full_name', 'full name', 'required');
        $this->form_validation->set_rules('unit_id', 'Branch', 'required');
        $this->form_validation->set_rules('identity', 'NID', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('dept_id', 'Department', 'required');
        $this->form_validation->set_rules('desig_id', 'Designation', 'required');

        if ($this->form_validation->run() == true) {
            $email    = strtolower($this->input->post('email'));
            $identity = $this->input->post('identity');
            $password = $this->input->post('password');
            $unit_id = $this->input->post('unit_id');
            $row = $this->db->where('id', $unit_id)->get('units')->row();

            $data = array(
                'first_name' => ucwords($this->input->post('full_name')),
                'unit_id'    => $this->input->post('unit_id'),
                'type'       => $row->type,
                'group_id'   => $this->input->post('group_id'),
                'username'   => $this->input->post('identity'),
                'phone'      => $this->input->post('phone'),
                'dept_id'    => $this->input->post('dept_id'),
                'desig_id'   => $this->input->post('desig_id'),
                'status'     => $this->input->post('status'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $data)) {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('acl');
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->data['full_name'] = array(
                'name'  => 'full_name',
                'id'    => 'full_name',
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'value' => $this->form_validation->set_value('full_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'class' => 'form-control input-sm',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'class' => 'form-control input-sm',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            // Load Page
            $this->data['meta_title'] = $this->lang->line('create_user_heading');
            $this->data['subview'] = 'create_user';
            $this->load->view('backend/_layout_main', $this->data);
        }
    }


    // edit a user
    public function edit_user($id){

        if (!$this->ion_auth->logged_in() || (!($this->ion_auth->is_admin()) && !($this->ion_auth->user()->row()->id == $id))){
            redirect('dashboard');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups=$this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('full_name', 'full name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim');
        $this->form_validation->set_rules('unit_id', 'Branch', 'required');
        $this->form_validation->set_rules('dept_id', 'Department', 'required');
        $this->form_validation->set_rules('desig_id', 'Designation', 'required');

        if (isset($_POST) && !empty($_POST)){

            if($this->input->post('active')){
                $active = $this->input->post('active');
            }else{
                $active = 1;
            }

            if ($this->input->post('password')){
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE){
                if ($_FILES['profile_img']) {
                    $config['upload_path'] = './profile_img/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['max_size'] = 10240000;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('profile_img')) {
                        $data = $this->upload->data();
                        $originalFileName = $data['file_name']; // Keep the original file name

                        // Generate a unique file name
                        $uniqueFileName = uniqid() . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);

                        // Move the uploaded file to the destination with the unique file name
                        $destination = base_url('profile_img/') . $uniqueFileName;
                        rename($config['upload_path'] . $originalFileName, $config['upload_path'] . $uniqueFileName);

                        $data = array(
                            'first_name'    => $this->input->post('full_name'),
                            'unit_id'       => $this->input->post('unit_id'),
                            'email'         => $this->input->post('email'),
                            'phone'         => $this->input->post('phone'),
                            'dept_id'       => $this->input->post('dept_id'),
                            'desig_id'      => $this->input->post('desig_id'),
                            'status'        => $this->input->post('status'),
                            'active'        => $active,
                            'profile_img'   => $uniqueFileName
                        );
                    }else{
                        $data = array(
                            'first_name' => $this->input->post('full_name'),
                            'unit_id'    => $this->input->post('unit_id'),
                            'email'      => $this->input->post('email'),
                            'phone'      => $this->input->post('phone'),
                            'dept_id'    => $this->input->post('dept_id'),
                            'desig_id'   => $this->input->post('desig_id'),
                            'status'     => $this->input->post('status'),
                            'active'     => $active
                        );
                    }
                }else{
                    $data = array(
                        'first_name' => $this->input->post('full_name'),
                        'unit_id'    => $this->input->post('unit_id'),
                        'email'      => $this->input->post('email'),
                        'phone'      => $this->input->post('phone'),
                        'dept_id'    => $this->input->post('dept_id'),
                        'desig_id'   => $this->input->post('desig_id'),
                        'status'     => $this->input->post('status'),
                        'active'     =>$active
                    );
                }

                // update the password if it was posted
                if ($this->input->post('password')){
                    $data['password'] = $this->input->post('password');
                }
                if($this->input->post('group')){
                    $groupData = $this->input->post('group');
                    // dd($groupData);
                    $this->ion_auth->remove_from_group('', $id);
                    $this->ion_auth->add_to_group($groupData, $id);
                }


                // check to see if we are updating the user
                if($this->ion_auth->update($user->id, $data)){
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages() );
                    if ($this->ion_auth->is_admin()){
                        redirect('acl');
                    }else{
                        redirect('dashboard');
                    }
                }else{
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors() );
                    if ($this->ion_auth->is_admin()){
                        redirect('all');
                    }else{
                        redirect('dashboard');
                    }
                }
            }
        }

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name'  => 'first_name',
            'id'    => 'first_name',
            'type'  => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name'  => 'last_name',
            'id'    => 'last_name',
            'type'  => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->data['company'] = array(
            'name'  => 'company',
            'id'    => 'company',
            'type'  => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('company', $user->company),
        );
        $this->data['phone'] = array(
            'name'  => 'phone',
            'id'    => 'phone',
            'type'  => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id'   => 'password',
            'class' => 'form-control',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id'   => 'password_confirm',
            'class' => 'form-control',
            'type' => 'password'
        );

        $this->data['department'] = $this->Acl_model->get_department();
        $this->data['designation'] = $this->Acl_model->get_designation();

        //Load Page
        $this->data['title'] = $this->lang->line('edit_user_heading');
        $this->data['meta_title'] = 'Edit User';
        $this->data['subview'] = 'edit_user';
        $this->load->view('backend/_layout_main', $this->data);
    }


    /******************** GROUP TYPE *********************/
    public function group_type(){
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['results'] = $this->Acl_model->get_group_type();

        //Load page
        $this->data['meta_title'] = 'Group Type';
        $this->data['subview'] = 'group_type';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // create a new ROLE group
    public function create_group_type(){

        // validate form input
        $this->form_validation->set_rules('group_type_en', 'group type', 'required');
        $this->form_validation->set_rules('group_type_bn', 'গ্রুপ টাইপ বাংলা', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'group_type_en' => $this->input->post('group_type_en'),
                'group_type_bn' => $this->input->post('group_type_bn'),
                'type_description' => $this->input->post('type_description')
                );

            // print_r($form_data); exit;
            if($this->Common_model->save('groups_type', $form_data)){
                $this->session->set_flashdata('success', 'New group type insert successfully.');
                redirect('acl/group_type');
            }
        }

        $this->data['meta_title'] = 'Create Group Type';
        $this->data['subview'] = 'create_group_type';
        $this->load->view('backend/_layout_main', $this->data);

    }

    public function edit_group_type($id){

        $this->form_validation->set_rules('group_type_en', 'group type name', 'required');
        $this->form_validation->set_rules('group_type_bn', 'গ্রুপ টাইপ বাংলা', 'required');

        $this->data['info'] = $this->Acl_model->get_group_type_info($id);
        // print_r($this->data['info']); exit;

        if ($this->form_validation->run() == true){

            $form_data = array(
                'group_type_en' => $this->input->post('group_type_en'),
                'group_type_bn' => $this->input->post('group_type_bn'),
                'type_description' => $this->input->post('type_description')
                );

            // print_r($form_data); exit;
            if($this->Common_model->edit('groups_type', $id, 'id', $form_data)){
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('acl/group_type');
            }
        }

        $this->data['meta_title'] = 'Edit Group Type';
        $this->data['subview'] = 'edit_group_type';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /******************** ROLE GROUP *********************/
    public function role_group(){
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['results'] = $this->Acl_model->get_role_group();

        //Load page
        $this->data['meta_title'] = 'Role Group Name';
        $this->data['subview'] = 'role_group';
        $this->load->view('backend/_layout_main', $this->data);
    }

    // create a new ROLE group
    public function create_role_group(){

        // validate form input
        $this->form_validation->set_rules('role_name_en', 'role group english', 'required');
        $this->form_validation->set_rules('role_name_bn', 'role group bangla', 'required');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'role_name_en' => $this->input->post('role_name_en'),
                'role_name_bn' => $this->input->post('role_name_bn'),
                'role_description' => $this->input->post('role_description')
                );

            // print_r($form_data); exit;
            if($this->Common_model->save('groups_role', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'New role insert ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'New role insert successfully.');
                redirect('acl/role_group');
            }
        }

        // $this->data['info'] = $this->My_profile_model->get_info($this->id);

        $this->data['meta_title'] = 'Create Role Group';
        $this->data['subview'] = 'create_role_group';
        $this->load->view('backend/_layout_main', $this->data);

    }

    public function edit_role_group($id){

        $this->form_validation->set_rules('role_name_en', 'role group english', 'required');
        $this->form_validation->set_rules('role_name_bn', 'role group bangla', 'required');

        $this->data['info'] = $this->Acl_model->get_role_group_info($id);
        // print_r($this->data['info']); exit;

        if ($this->form_validation->run() == true){

            $form_data = array(
                'role_name_en' => $this->input->post('role_name_en'),
                'role_name_bn' => $this->input->post('role_name_bn'),
                'role_description' => $this->input->post('role_description')
            );

                // print_r($form_data); exit;
            if($this->Common_model->edit('groups_role', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'role update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('acl/role_group');
            }
        }

        $this->data['meta_title'] = 'Edit Role Group';
        $this->data['subview'] = 'edit_role_group';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /******************** GROUP Name *********************/
    public function group_name(){
            // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
        $this->data['results'] = $this->Acl_model->get_group_name();

            //Load page
        $this->data['meta_title'] = 'Group Name';
        $this->data['subview'] = 'group_name';
        $this->load->view('backend/_layout_main', $this->data);
    }


    // create a new group
    public function create_group(){

            // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE){
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if($new_group_id) {
                    // check to see if we are creating the group
                    // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('acl/group_name');
            }
        }else{
                // display the create group form
                // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name'  => 'group_name',
                'id'    => 'group_name',
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'value' => $this->form_validation->set_value('group_name'),
                );
            $this->data['description'] = array(
                'name'  => 'description',
                'id'    => 'description',
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'value' => $this->form_validation->set_value('description'),
                );

            $this->data['meta_title'] = $this->lang->line('create_group_title');
            $this->data['subview'] = 'create_group';
            $this->load->view('backend/_layout_main', $this->data);
        }
    }



    // edit a group
    public function edit_group($id)
    {
            // bail if no group id given
        if(!$id || empty($id)) {
            redirect('dashboard');
        }

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('dashboard');
        }

        $group = $this->ion_auth->group($id)->row();

                // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');
        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect('acl/group_name');
            }
        }

                // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                // pass the user to the view
        $this->data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') || $this->config->item('default_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->data['group_name'] = array(
            'name'    => 'group_name',
            'id'      => 'group_name',
            'class'   => 'form-control input-sm',
            'type'    => 'text',
            'value'   => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );
        $this->data['group_description'] = array(
            'name'  => 'group_description',
            'id'    => 'group_description',
            'class' => 'form-control input-sm',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $this->data['meta_title'] = $this->lang->line('edit_group_title');
        $this->data['subview'] = 'edit_group';
        $this->load->view('backend/_layout_main', $this->data);
    }


    // activate the user
    public function activate($id, $code=false){
        if ($code !== false){
            $activation = $this->ion_auth->activate($id, $code);
        }else if ($this->ion_auth->is_admin()){
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation){
                // redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("acl");
        }else{
                // redirect them to the forgot password page
                // $this->session->set_flashdata('message', $this->ion_auth->errors());
                // redirect("login/forgot_password");

            redirect("acl");
        }
    }

    // deactivate the user
    public function deactivate($id = NULL){
            // if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
            //     // redirect them to the home page because they must be an administrator to view this
            //     return show_error('You must be an administrator to view this page.');
            // }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE){
                // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();

                //Load Page
            $this->data['meta_title'] = 'Deactivate User';
            $this->data['subview'] = 'deactivate_user';
            $this->load->view('backend/_layout_main', $this->data);

        }else{
                // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes'){
                    // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')){
                    show_error($this->lang->line('error_csrf'));
                }

                    // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
                    $this->ion_auth->deactivate($id);
                }
            }

                // redirect them back to the auth page
            redirect('acl');
        }
    }

    public function user_delete($id){
      if($this->ion_auth->is_admin()){
         $this->Acl_model->user_destroy($id);
         $this->session->set_flashdata('success', 'Delete region successfully.');
         redirect("acl");
      }else{
         redirect('dashboard');
      }
    }


public function _get_csrf_nonce(){
    $this->load->helper('string');
    $key   = random_string('alnum', 8);
    $value = random_string('alnum', 20);
    $this->session->set_flashdata('csrfkey', $key);
    $this->session->set_flashdata('csrfvalue', $value);

    return array($key => $value);
}

public function _valid_csrf_nonce(){
    $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
    if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue')){
        return TRUE;
    }else{
        return FALSE;
    }
}

}
