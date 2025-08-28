<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('acl')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('acl/access_level')?>" class="btn btn-success btn-xs btn-mini"> Access Level List</a>  
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
              <?php echo form_open("acl/edit_access_level/".$info->id);?>

              <div class="row form-row">
                <div class="col-md-4">
                  <label class="form-label">Select Task</label>
                  <?php echo form_error('task_register_id'); ?>
                  <?php 
                    $more_attr = 'class="select2 form-control"';
                    echo form_dropdown('task_register_id', $task_register, set_value('task_register_id', $info->task_register_id), $more_attr);
                  ?>
                </div>
                <div class="col-md-4">
                  <label class="form-label"> Select Group</label>
                  <?php echo form_error('groups_id'); ?>
                  <?php 
                    $more_attr = 'class="select2 form-control"';
                    echo form_dropdown('groups_id', $groups, set_value('groups_id', $info->groups_id), $more_attr);
                  ?>
                </div>

                <div class="col-md-4">
                  <label class="form-label"> Select Group Type</label>
                  <?php echo form_error('groups_type_id'); ?>
                  <?php 
                    $more_attr = 'class="select2 form-control"';
                    echo form_dropdown('groups_type_id', $groups_type, set_value('groups_type_id', $info->groups_type_id), $more_attr);
                  ?>
                </div>
              </div>

              <br>

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