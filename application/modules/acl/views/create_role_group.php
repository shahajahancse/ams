<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('acl/group_name')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('acl/role_group')?>" class="btn btn-primary btn-xs btn-mini"> Role Group List</a>  
              </div>
             </div>
             <div class="grid-body">
              <?php echo form_open_multipart("acl/create_role_group");?>
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <a class="close" data-dismiss="alert">&times;</a>
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Role Name</label>
                  <?php echo form_error('role_name_en'); ?>
                  <input name="role_name_en" id="role_name_en" type="text" class="form-control input-sm" placeholder="Role Group Name English" value="<?=set_value('role_name_en')?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Description</label>
                  <?php echo form_error('role_description'); ?>
                  <input name="role_description" id="role_description" type="text" class="form-control input-sm" placeholder="Role Group Description">
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Role Name Bangla</label>
                  <?php echo form_error('role_name_bn'); ?>
                  <input name="role_name_bn" id="role_name_bn" type="text" class="form-control input-sm" placeholder="রোল নাম বাংলা" value="<?=set_value('role_name_bn')?>">
                </div>
                <div class="col-md-6"> </div>
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