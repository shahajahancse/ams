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
                     <a href="<?=base_url('general_setting/sub_categories')?>" class="btn btn-info btn-xs btn-mini"> Sub Category List</a>
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <a class="close" data-dismiss="alert"></a>
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <?php if($this->session->flashdata('error')):?>
                     <div class="alert alert-error">
                        <a class="close" data-dismiss="alert"></a>
                        <?php echo $this->session->flashdata('error');?>
                     </div>
                  <?php endif; ?>

                  <?php
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart("general_setting/sub_category_edit/{$sub_categorie->id}", $attributes); ?>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Select Category</label>
                        <?php echo form_error('cate_id');?>
                        <select name="cate_id" id="cate_id">
                           <option value="">Select Category</option>
                           <?php
                           $categorie = $this->db->get('item_categories')->result();
                           foreach ($categorie as $key => $value) {
                              ?>
                              <option value="<?=$value->id?>" <?=($sub_categorie->cate_id == $value->id) ? 'selected' : ''?>><?=$value->category_name?></option>
                              <?php
                           }
                           ?>
                        </select>

                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Sub Category Name </label>
                        <?php echo form_error('sub_cate_name'); ?>
                        <input name="sub_cate_name" type="text" value="<?=$sub_categorie->sub_cate_name?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <?php echo form_error('status'); ?>
                        <div class="form-group">
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1" <?=($sub_categorie->status == 1) ? 'checked' : ''?>>
                                Active
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="0" <?=($sub_categorie->status == 2) ? 'checked' : ''?>>
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
