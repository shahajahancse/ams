<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('scouts_member/all')?>" class="btn btn-primary btn-xs btn-mini"> Scouts Member List</a>  
              </div>
             </div>
             <div class="grid-body">
              <!-- <form id="form_traditional_validation" action="#"> -->
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">                      
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>
              <?php echo form_open_multipart("acl/create_user");?>

              <div class="row">
                <div class="col-md-8">

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">First Name</label>
                      <?php echo form_error('first_name'); ?>
                      <input name="first_name" id="first_name" type="text" class="form-control input-sm" value="<?=set_value('first_name')?>">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Last Name</label>
                      <?php echo form_error('last_name'); ?>
                      <input name="last_name" id="last_name" type="text"  class="form-control input-sm" value="<?=set_value('last_name')?>">
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">Date of Birth</label>
                      <?php echo form_error('dob'); ?>
                      <input name="dob" id="datetime" type="text" class="form-control input-sm datetime" value="<?=set_value('dob')?>">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Gender</label>
                      <?php echo form_error('gender'); ?>
                      <input type="radio" name="gender" value="Male" <?=$this->input->post('Male')=='Male'?'checked':'';?>> Male 
                      <input type="radio" name="gender" value="Female" <?=$this->input->post('Female')=='Female'?'checked':'';?>> Female
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">Phone Number</label>
                      <?php echo form_error('phone'); ?>
                      <input name="phone" id="phone" type="text" class="form-control input-sm" value="<?=set_value('phone')?>">
                    </div>                    
                    
                  </div>

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label">Present Addess</label>
                      <?php echo form_error('present_add'); ?>
                      <textarea name="present_add" rows="" cols="30"><?=set_value('present_add')?></textarea>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Permanent Address</label>
                      <?php echo form_error('permanent_add'); ?>
                      <textarea name="permanent_add" rows="" cols="30"><?=set_value('permanent_add')?></textarea>
                    </div>
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
                      <?php echo form_error('phone'); ?>
                      <?php //echo form_input($phone);?>
                      <input name="last_name" id="last_name" type="text"  class="form-control input-sm" value="<?=set_value('last_name')?>">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label"><?php echo lang('create_user_email_label', 'email');?></label>
                      <?php echo form_error('email'); ?>
                      <?php //echo form_input($email);?>
                      <input name="last_name" id="last_name" type="text"  class="form-control input-sm" value="<?=set_value('last_name')?>">
                    </div>
                  </div>


                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label"><?php echo lang('create_user_password_label', 'password');?></label>
                      <?php echo form_error('password'); ?>
                      <?php //echo form_input($password);?>
                      <input name="last_name" id="last_name" type="passowrd"  class="form-control input-sm" value="<?=set_value('last_name')?>">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                      <?php echo form_error('password_confirm'); ?>
                      <?php //echo form_input($password_confirm);?>
                      <input name="last_name" id="last_name" type="passowrd"  class="form-control input-sm" value="<?=set_value('last_name')?>">
                    </div>
                  </div>
                </div>

              </div>


            <div class="form-actions">  
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                <!-- <button type="button" class="btn btn-white btn-cons">Cancel</button> -->
              </div>
            </div>
          <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>