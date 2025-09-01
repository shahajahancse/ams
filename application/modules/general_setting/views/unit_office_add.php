<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> Manage User </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?>bbbbb</span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('scouts_member/all')?>" class="btn btn-success btn-xs btn-mini"> Scouts Member List</a>  
              </div>
             </div>
             <div class="grid-body">
              <!-- <form id="form_traditional_validation" action="#"> -->
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <a class="close" data-dismiss="alert">&times;</a>
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>
              <?php echo form_open_multipart("scouts_member/add");?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_fname_label', 'first_name');?></label>
                  <?php echo form_error('first_name'); ?>
                  <input name="first_name" id="first_name" type="text"  class="form-control input-sm" placeholder="First Name">
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_lname_label', 'last_name');?></label>
                  <?php echo form_error('last_name'); ?>
                  <input name="last_name" id="last_name" type="text"  class="form-control input-sm" placeholder="Last Name">
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
                  <?php echo form_error('phone'); ?>
                  <input name="phone" id="phone" type="text" class="form-control input-sm" placeholder="Phone Number">
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_email_label', 'email');?></label>
                  <?php echo form_error('email'); ?>
                  <input name="email" id="email" type="text"  class="form-control input-sm" placeholder="Email Address">
                </div>
              </div>


              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_password_label', 'password');?></label>
                  <select name="form3Gender" id="form3Gender" class="select2 form-control"  >
                          <option value="1">Male</option>
                          <option value="2">Female</option>
                        </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                  <?php echo form_error('password_confirm'); ?>
                  <input name="password_confirm" id="password_confirm" type="text"  class="form-control input-sm" placeholder="Confirm Password">
                </div>
              </div>

            <div class="form-actions">  
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
              </div>
            </div>
          <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>