<div class="page-content">     
  <div class="content">      
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-10">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('scouts_member/all')?>" class="btn btn-primary btn-xs btn-mini"> Scouts Member List</a>  
              </div>
             </div>
             <div class="grid-body">
            <?php echo form_open(uri_string());?>
            <!-- <div><?php //echo validation_errors(); ?></div> -->
            <div class="row">

              <div class="col-md-8">
                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label"><?php echo lang('edit_user_fname_label', 'first_name');?></label>
                    <?php echo form_error('first_name'); ?>
                    <input name="first_name" id="first_name" type="text" value="<?=set_value('first_name', $info->first_name)?>" class="form-control input-sm" placeholder="First Name">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label"><?php echo lang('create_user_lname_label', 'last_name');?></label>
                    <?php echo form_error('last_name'); ?>
                    <input name="last_name" id="last_name" type="text" value="<?=set_value('last_name', $info->last_name)?>" class="form-control input-sm" placeholder="Last Name">
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
                    <?php echo form_error('phone'); ?>
                    <input name="phone" id="phone" type="text" value="<?=set_value('phone', $info->phone)?>" class="form-control input-sm" placeholder="Phone Number">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label"><?php echo lang('create_user_email_label', 'email');?></label>
                    <?php echo form_error('email'); ?>
                    <input name="email" id="email" type="text" value="<?=set_value('email', $info->email)?>" class="form-control input-sm" placeholder="Email Address">
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-6">
                    <label class="form-label"><?php echo lang('create_user_password_label', 'password');?></label>
                    <?php echo form_error('password'); ?>
                    <input name="password" id="password" type="text" class="form-control input-sm" placeholder="Password">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                    <?php echo form_error('password_confirm'); ?>
                    <input name="password_confirm" id="password_confirm" type="text" class="form-control input-sm" placeholder="Confirm Password">
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
                      echo form_dropdown('appr_group', $scout_group, set_value('appr_group', $info->appr_group), $more_attr);
                    ?>
                  </div>
                </div>

                <br>

                <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">Status</label>
                    <?php echo form_error('active'); ?>
                    <input type="radio"  name="active" value="0" <?=set_value('active', $info->active)==0?'checked':'';?>> Inactive <br>
                    <input type="radio" name="active" value="1" <?=set_value('active', $info->active)==1?'checked':'';?>> Active/Verified <br>
                    <input type="radio" name="active" value="2" <?=set_value('active', $info->active)==2?'checked':'';?>> Disable <br>
                    <input type="radio" name="active" value="3" <?=set_value('active', $info->active)==3?'checked':'';?>> Postpond <br>
                    <input type="radio" name="active" value="4" <?=set_value('active', $info->active)==4?'checked':'';?>> Reject
                  </div>
                </div>
              </div>

            </div>
            

              <div class="form-actions">  
                <div class="pull-right">
                  <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                </div>
              </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>