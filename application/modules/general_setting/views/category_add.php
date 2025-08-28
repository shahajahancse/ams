<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <?=$module_name?> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-8">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                  <a href="<?=base_url('general_setting/categories')?>" class="btn btn-success btn-xs btn-mini"> Category List</a>
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

                  <?php
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart("general_setting/category_add", $attributes);?>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Select Division <span class="required">*</span></label>
                        <?php $divs = $this->db->where('type', 2)->get('units')->result(); ?>
                        <select name="division_id" class="form-control input-sm" required>
                           <option value="">-- Select One --</option>
                           <?php foreach ($divs as $key => $value) { ?>
                              <option value="<?=$value->id?>"><?=$value->name_en?></option>
                           <?php } ?>
                           <option value="7">Others</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Category Name </label>
                        <?php echo form_error('cate_name'); ?>
                        <input name="cate_name" type="text" value="<?=set_value('cate_name')?>" class="form-control input-sm" placeholder="">
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
