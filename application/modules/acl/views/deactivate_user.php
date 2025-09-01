<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?php echo sprintf(lang('deactivate_subheading'), $user->email);?> </span></h4>
             </div>
             <div class="grid-body">
              <?php echo form_open("acl/deactivate/".$user->id);?>

              <div class="row form-row">
                <div class="col-md-6">
                  <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
                  <input type="radio" name="confirm" value="yes" checked="checked" />
                  <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
                  <input type="radio" name="confirm" value="no" />
                </div>
              </div>

            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_hidden($csrf); ?>
                <?php echo form_hidden(array('id'=>$user->id)); ?>                   
                <?php echo form_submit('submit', 'Deactive User', "class='btn btn-primary btn-cons'"); ?>
              </div>
            </div>
          <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->

  </div>
</div>