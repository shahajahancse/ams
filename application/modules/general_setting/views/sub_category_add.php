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
                     <a href="<?=base_url('general_setting/sub_categories')?>" class="btn btn-success btn-xs btn-mini"> Sub Category List</a>
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart("general_setting/sub_category_add", $attributes);?>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Select Category</label>
                        <?php echo form_error('cate_id'); ?>
                        <?php echo form_dropdown('cate_id',$categories, set_value('cate_id'), 'class="form-control input-sm"');?>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Sub Category Name </label>
                        <?php echo form_error('sub_cate_name'); ?>
                        <input name="sub_cate_name" type="text" value="<?=set_value('sub_cate_name')?>" class="form-control input-sm" placeholder="">
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

<script type="text/javascript">
   $(document).ready(function() {
      $('#jsvalidate').validate({
      // focusInvalid: false,
      ignore: "",
      rules: {
      	cate_id: {
            required: true
         },
         sub_cate_name: {
            required: true
         }
      }
   });

   });
</script>
