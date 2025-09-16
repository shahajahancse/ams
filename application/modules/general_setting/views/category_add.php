<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <?=$module_name?> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                  <a href="<?=base_url('general_setting/categories')?>" class="btn btn-info btn-xs btn-mini"> Category List</a>
                  </div>
               </div>
               <div class="grid-body" style="overflow-x: hidden;">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert"></a>
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <?php if($this->session->flashdata('error')):?>
                     <div class="alert alert-error">
                        <?php echo $this->session->flashdata('error');?>
                     </div>
                  <?php endif; ?>

                  <?php
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart("general_setting/category_add", $attributes);?>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Category Name </label>
                        <input name="cate_name" type="text" value="<?=set_value('cate_name')?>" class="form-control input-sm" placeholder="">
                        <?php echo form_error('cate_name'); ?>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Status </label>
                        <?php echo form_error('status'); ?>
                        <div class="form-group">
                           <label class="radio-inline">
                              <input type="radio" name="status" value="Enable" <?=set_radio('status', 'Enable', set_value('status', 'Enable'))?> checked>
                              Active
                           </label>
                           <label class="radio-inline">
                              <input type="radio" name="status" value="Disable" <?=set_radio('status', 'Disable', set_value('status', 'Disable'))?>>
                              Inactive
                           </label>
                        </div>
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
