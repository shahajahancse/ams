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
                <a href="<?=base_url('acl/group_type')?>" class="btn btn-primary btn-xs btn-mini"> Group Type List</a>  
              </div>
             </div>
             <div class="grid-body">
              <?php echo form_open_multipart("acl/edit_group_type/".$info->id);?>
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Group Type English</label>
                  <?php echo form_error('group_type_en'); ?>
                  <input name="group_type_en" id="group_type_en" type="text" value="<?=set_value('group_type_en', $info->group_type_en)?>" class="form-control input-sm" placeholder="Group Type Name English">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Description</label>
                  <?php echo form_error('type_description'); ?>
                  <input name="type_description" id="type_description" type="text" value="<?=set_value('type_description', $info->type_description)?>" class="form-control input-sm" placeholder="Group Type Description">
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Group Type Bangla</label>
                  <?php echo form_error('group_type_bn'); ?>
                  <input name="group_type_bn" id="group_type_bn" value="<?=set_value('group_type_bn', $info->group_type_bn)?>" type="text" class="form-control input-sm" placeholder="গ্রুপ টাইপ বাংলা">
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