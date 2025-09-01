<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
            <li> <a href="<?=base_url('acl')?>" class="active"> <?=$module_title; ?> </a></li>
            <li><?=$meta_title; ?></li>
        </ul>

        <div class="row">
            <div class="col-md-8">
                <div class="grid simple horizontal">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?=base_url('acl')?>" class="btn btn-blueviolet btn-xs btn-mini"> User List</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php echo form_open("acl/create_user", array('id' => 'js_validate'));?>
                        <div class="row form-row">
                            <div class="col-md-6">
                                <label class="form-label">Full Name <span style="color:red">*</span></label>
                                <?php echo form_error('full_name'); ?>
                                <?php echo form_input($full_name);?>
                            </div>
                            <?php $units = $this->db->get('units')->result(); ?>
                            <div class="col-md-6">
                                <label class="form-label">Division <span style="color:red">*</span></label>
                                <?php echo form_error('unit_id'); ?>
                                <select name="unit_id" id="unit_id" class="form-control input-sm select2">
                                    <option value="">Select Division</option>
                                    <?php foreach($units as $unit):?>
                                    <option value="<?=$unit->id?>" <?=set_select('unit_id', $unit->id)?>><?=$unit->name_en?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-6">
                                <label class="form-label">NID <span style="color:red">*</span> <small>(Username)</small></label>
                                <?php echo form_error('identity'); ?>
                                <?php echo form_input($identity);?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
                                <?php echo form_error('phone'); ?>
                                <?php echo form_input($phone);?>
                            </div>
                        </div>

                        <div class="row form-row">
                            <?php $departments = $this->db->get('department')->result(); ?>
                            <div class="col-md-6">
                                <label class="form-label">Department <span style="color:red">*</span></label>
                                <?php echo form_error('dept_id'); ?>
                                <select name="dept_id" id="dept_id" class="form-control input-sm select2">
                                    <option value="">Select Department</option>
                                    <?php foreach($departments as $d):?>
                                    <option value="<?=$d->id?>" <?=set_select('dept_id', $d->id)?>><?=$d->dept_name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <?php $designations = $this->db->get('designation')->result(); ?>
                            <div class="col-md-6">
                                <label class="form-label">Designation <span style="color:red">*</span></label>
                                <?php echo form_error('desig_id'); ?>
                                <select name="desig_id" id="desig_id" class="form-control input-sm select2">
                                    <option value="">Select Designation</option>
                                    <?php foreach($designations as $des):?>
                                    <option value="<?=$des->id?>" <?=set_select('desig_id', $des->id)?>><?=$des->desig_name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-6">
                                <label class="form-label"><?php echo lang('create_user_email_label', 'email');?></label>
                                <?php echo form_error('email'); ?>
                                <?php echo form_input($email);?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status <span style="color:red">*</span></label>
                                <select name="status" id="status" class="form-control input-sm select2">
                                    <option value="">Select one</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-4">
                                <label class="form-label">User Type</label>
                                <?php echo form_error('group_id'); ?>
                                <?php $groups = $this->db->get('groups')->result(); ?>
                                <select name="group_id" id="group_id" class="form-control input-sm">
                                    <option value="">Select User Type</option>
                                    <?php foreach($groups as $group):?>
                                    <option value="<?=$group->id?>"><?=$group->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label
                                    class="form-label"><?php echo lang('create_user_password_label', 'password');?></label>
                                <?php echo form_error('password'); ?>
                                <?php echo form_input($password);?>
                            </div>
                            <div class="col-md-4">
                                <label
                                    class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                                <?php echo form_error('password_confirm'); ?>
                                <?php echo form_input($password_confirm);?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="pull-right">
                                <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                            </div>
                        </div>
                        <?php echo form_close();?>

                    </div> <!-- END GRID BODY -->
                </div> <!-- END GRID -->
            </div>
        </div> <!-- END ROW -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // JS Validation
        $('#js_validate').validate({
            // focusInvalid: false,
            ignore: "",
            rules: {
                full_name: {
                    required: true
                },
                phone: {
                    // required: true,
                    number: true,
                    minlength: 11,
                    maxlength: 11
                },
                unit_id: {
                    required: true
                },
                identity:{
                    required: true,
                    // number: true,
                    minlength: 3,
                    remote: {
                        url: hostname +"common/ajax_exists_nid/",
                        type: "post",
                        data: {
                            inputData: function() {
                                return $( "#identity" ).val();
                            },
                        }
                    }
                },
                dept_id: {
                    // required: true
                },
                designation_id: {
                    // required: true
                },
                email: {
                    // required: true
                },
            },
            messages: {
                identity: {
                    remote: jQuery.format("Already used!")
                },
            },
            invalidHandler: function(event, validator) {
                //display error alert on form submit
            },

            errorPlacement: function(label, element) { // render error placement for each input type
                $('<span class="error"></span>').insertAfter(element).append(label)
                var parent = $(element).parent('.input-with-icon');
                parent.removeClass('success-control').addClass('error-control');
            },

            highlight: function(element) { // highlight error inputs
                var parent = $(element).parent();
                parent.removeClass('success-control').addClass('error-control');
            },

            unhighlight: function(element) { // revert the change done by highlight
            },

            success: function(label, element) {
                var parent = $(element).parent('.input-with-icon');
                parent.removeClass('error-control').addClass('success-control');
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
