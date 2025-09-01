<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> Manage User </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('scouts_member/all')?>" class="btn btn-success btn-xs btn-mini"> Scouts Member List</a>  
              </div>
             </div>
             <div class="grid-body">
            <?php echo form_open(uri_string());?>
            <div><?php echo validation_errors(); ?></div>
              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('edit_user_fname_label', 'first_name');?></label>
                  <?php echo form_error('first_name'); ?>
                  <input name="first_name" id="first_name" type="text" value="<?=set_value('first_name', $user->first_name)?>" class="form-control input-sm" placeholder="First Name">
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_lname_label', 'last_name');?></label>
                  <?php echo form_error('last_name'); ?>
                  <input name="last_name" id="last_name" type="text" value="<?=set_value('last_name', $user->last_name)?>" class="form-control input-sm" placeholder="Last Name">
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
                  <?php echo form_error('phone'); ?>
                  <input name="phone" id="phone" type="text" value="<?=set_value('phone', $user->phone)?>" class="form-control input-sm" placeholder="Phone Number">
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_email_label', 'email');?></label>
                  <?php echo form_error('email'); ?>
                  <input name="email" id="email" type="text" value="<?=set_value('email', $user->email)?>" class="form-control input-sm" placeholder="Email Address">
                </div>
              </div>


              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_password_label', 'password');?></label>
                  <?php echo form_error('password'); ?>
                  <input name="form3FirstName" id="form3FirstName" type="text"  class="form-control input-sm" placeholder="Password">
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                  <?php echo form_error('password_confirm'); ?>
                  <input name="password_confirm" id="password_confirm" type="text"  class="form-control input-sm" placeholder="Confirm Password">
                </div>
              </div>

              <div class="form-actions">  
                <div class="pull-right">
                  <?php echo form_submit('submit', lang('edit_user_submit_btn'), "class='btn btn-primary btn-cons'"); ?>
                </div>
              </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>