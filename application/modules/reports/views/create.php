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
              <?php echo form_open_multipart("scouts_member/create");?>
              <div class="row">

                <div class="col-md-8">
                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label"><?php echo lang('edit_user_fname_label', 'first_name');?></label>
                      <?php echo form_error('first_name'); ?>
                      <input name="first_name" id="first_name" type="text" value="<?=set_value('first_name', $this->input->post('first_name'))?>" class="form-control input-sm" placeholder="e.g. 'Mohammad Ataul'">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label"><?php echo lang('create_user_lname_label', 'last_name');?></label>
                      <?php echo form_error('last_name'); ?>
                      <input name="last_name" id="last_name" type="text" value="<?=set_value('last_name', $this->input->post('last_name'))?>" class="form-control input-sm" placeholder="e.g. 'Mostafa'">
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
                      <?php echo form_error('phone'); ?>
                      <input name="phone" id="phone" type="text" value="<?=set_value('phone', $this->input->post('phone'))?>" class="form-control input-sm" placeholder="e.g. '01XXXXXXXXX'">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label"><?php echo lang('create_user_email_label', 'email');?></label>
                      <?php echo form_error('email'); ?>
                      <input name="email" id="email" type="text" value="<?=set_value('email', $this->input->post('email'))?>" class="form-control input-sm" placeholder="e.g. example@example.com">
                    </div>
                  </div>

                  <div class="row form-row">
                    <div class="col-md-6">
                      <label class="form-label"><?php echo lang('create_user_password_label', 'password');?></label>
                      <?php echo form_error('password'); ?>
                      <input name="password" id="password" type="text" class="form-control input-sm" placeholder="Password minimum 8 character">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                      <?php echo form_error('password_confirm'); ?>
                      <input name="password_confirm" id="password_confirm" type="text" class="form-control input-sm" placeholder="Confirm Password minimum 8 character">
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label"> Select Scout Section</label>
                      <?php echo form_error('appr_group'); ?>
                      <?php 
                        $more_attr = 'class="select2 form-control"';
                        echo form_dropdown('appr_group', $scout_group, set_value('appr_group', $this->input->post('appr_group')), $more_attr);
                      ?>
                    </div>
                  </div>

                  <br>

                  <div class="row form-row">
                    <div class="col-md-12">
                      <label class="form-label">Status</label>
                      <?php echo form_error('active'); ?>
                      <input type="radio"  name="active" value="0" <?=set_value('active', $this->input->post('active'))==0?'checked':'';?>> Inactive <br>
                      <input type="radio" name="active" value="1" <?=set_value('active', $this->input->post('active'))==1?'checked':'';?>> Active/Verified <br>
                      <input type="radio" name="active" value="2" <?=set_value('active', $this->input->post('active'))==2?'checked':'';?>> Disable <br>
                      <input type="radio" name="active" value="3" <?=set_value('active', $this->input->post('active'))==3?'checked':'';?>> Postpond <br>
                      <input type="radio" name="active" value="4" <?=set_value('active', $this->input->post('active'))==4?'checked':'';?>> Reject
                    </div>
                  </div>
                </div>

              </div>


              <div class="form-actions">  
                <div class="pull-right">
                  <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                  <!-- <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button> -->
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