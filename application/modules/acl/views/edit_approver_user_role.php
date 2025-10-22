<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('acl/approver_user_role')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
             </div>
             <div class="grid-body">
              <?php echo form_open("acl/edit_approver_user_role/".$info->id);?>
              <div><?=validation_errors() ?></div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Name</label>
                  <input name="name" id="name" type="text" class="form-control input-sm" placeholder="Name" value="<?=$info->name?>">
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
                  <label class="form-label">SL</label>
                  <input name="sl" id="sl" type="text" class="form-control input-sm" placeholder="SL" value="<?=$info->sl?>">
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