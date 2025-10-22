<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('acl/create_approval_type')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
             </div>
             <div class="grid-body">
              <?php echo form_open("acl/edit_approval_process/".$info->id);?>
              <div><?=validation_errors() ?></div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Name</label>
                  <input name="name" id="name" type="text" class="form-control input-sm" placeholder="Name" value="<?=$info->name?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Forward Type</label>
                  <?php
                  $options = array('only_forward'  => 'Only Forward', 'forward_backward'    => 'Forward Backward', 'multi_forward'   => 'Multi Forward', 'multi_forward_backward'   => 'Multi Forward Backward');
                  echo form_dropdown('forward_type', $options, $info->forward_type, 'class="form-control"');
                  ?>
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">FB URL</label>
                  <input name="fb_url" id="fb_url" type="text" class="form-control input-sm" placeholder="FB URL" value="<?=$info->fb_url?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Status</label>
                  <?php
                  $options = array(1  => 'Active', 0    => 'Inactive');
                  echo form_dropdown('status', $options, $info->status, 'class="form-control"');
                  ?>
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-12">
                  <label class="form-label">Remarks</label>
                  <textarea name="remarks" id="remarks" class="form-control" rows="3"><?=$info->remarks?></textarea>
                </div>
              </div>

              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary btn-cons">Save</button>
                </div>
              </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>
