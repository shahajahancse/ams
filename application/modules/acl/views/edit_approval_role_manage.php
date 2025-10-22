<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('acl/approval_role_manage')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
             </div>
             <div class="grid-body">
              <?php echo form_open("acl/edit_approval_role_manage/".$info->id);?>
              <div><?=validation_errors() ?></div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">User</label>
                  <?php echo form_dropdown('user_id', $users, $info->user_id, 'class="form-control"'); ?>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Role</label>
                  <?php echo form_dropdown('role_id', $roles, $info->role_id, 'class="form-control"'); ?>
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">FB Type</label>
                  <?php echo form_dropdown('fb_type_id', $fb_types, $info->fb_type_id, 'class="form-control"'); ?>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Type</label>
                  <?php 
                  $options = array('approver'  => 'Approver', 'reviewer'    => 'Reviewer', 'verifier'   => 'Verifier');
                  echo form_dropdown('type', $options, $info->type, 'class="form-control"');
                  ?>
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Access Forward</label>
                  <input name="access_forward" id="access_forward" type="text" class="form-control input-sm" placeholder="Access Forward" value="<?=$info->access_forward?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Access Backward</label>
                  <input name="access_backward" id="access_backward" type="text" class="form-control input-sm" placeholder="Access Backward" value="<?=$info->access_backward?>">
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