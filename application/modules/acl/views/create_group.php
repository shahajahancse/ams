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
             </div>
             <div class="grid-body">
              <?php echo form_open_multipart("acl/create_group");?>
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
                  <label class="form-label"><?php echo lang('create_group_name_label', 'group_name');?></label>
                  <div><?php echo form_error('group_name'); ?></div>
                  <?php echo form_input($group_name);?>
                </div>
                <div class="col-md-6">
                  <label class="form-label"><?php echo lang('create_group_desc_label', 'description');?></label>
                  <div><?php echo form_error('description'); ?></div>
                    <?php echo form_input($description);?>
                </div>
              </div>

              <div class="form-actions">  
                <div class="pull-right">
                  <?php echo form_submit('submit', lang('create_group_submit_btn'), "class='btn btn-primary btn-cons'"); ?>
                </div>
              </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>