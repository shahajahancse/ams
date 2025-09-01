
<style>
   .input-sm {
      height: 30px;
      padding: 0px 0px;
      font-size: 12px;
      line-height: 1.5;
      border-radius: 3px;
   }
</style>


<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <?=$module_title?> </li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('items')?>" class="btn btn-blueviolet btn-xs btn-mini"> Items List</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate');
                  echo form_open_multipart("items/create", $attributes);?>
                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Select Division <span class="required">*</span></label>
                        <?php $divs = $this->db->where('type', 2)->get('units')->result(); ?>
                        <select name="division_id" class="form-control input-sm" required>
                           <option value="">-- Select One --</option>
                           <?php foreach ($divs as $key => $value) { ?>
                              <option value="<?=$value->id?>"><?=$value->name_en?></option>
                           <?php } ?>
                           <option value="0">Others</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Select Category <span class="required">*</span></label>
                        <?php $cat = $this->db->get('item_categories')->result(); ?>
                        <select name="cat_id" onchange="getSubCategory(this.value)" class="form-control input-sm" required>
                           <option value="">-- Select One --</option>
                           <?php foreach ($cat as $key => $value) { ?>
                              <option value="<?=$value->id?>"><?=$value->category_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Select Sub Category <span class="required">*</span></label>
                        <?php echo form_error('sub_cat_id'); ?>
                        <select name="sub_cat_id" class="sub_category_val form-control input-sm" id="sub_category" required>
                           <option value="">-- Select One --</option>
                        </select>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Item Type <span class="required">*</span></label>
                        <?php echo form_error('type'); ?>
                        <select name="type" id="type" class="form-control input-sm">
                           <option value="1">Consumable</option>
                           <option value="2">Non-Consumable</option>
                           <option value="3">Permanent</option>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Item Name <span class="required">*</span></label>
                        <?php echo form_error('item_name'); ?>
                        <input name="item_name" type="text" value="<?=set_value('item_name')?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Select Unit <span class="required">*</span></label>
                        <?php echo form_error('unit_id');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('unit_id', $units, set_value('unit_id'), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Order Level <span class="required">*</span></label>
                        <?php echo form_error('order_level'); ?>
                        <input name="order_level" id="order_level" type="number" value="<?=set_value('order_level')?>" class="form-control input-sm" >
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Status <span class="required">*</span></label>
                        <?php echo form_error('status'); ?>
                        <select name="status" id="status" class="form-control input-sm">
                           <option value="1">Active</option>
                           <option value="2">Inactive</option>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label">Item Specification</label>
                        <textarea name="description" class="form-control input-sm" rows="3"><?=set_value('description')?></textarea>
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
      $('#validate').validate({
      ignore: "",
      rules: {
         cat_id: { required: true },
         sub_cat_id: { required: true },
         item_name: { required: true },
         unit_id: { required: true },
         order_level: { order_level: true },
         type: { required: true },
         status: { required: true },
      }
   });
   });
</script>
<script>
   function getSubCategory(id){
      $.ajax({
         type: "POST",
         url: "<?=base_url('items/get_sub_category_by_category/');?>"+id,
         success: function(data){
             var parsedData = JSON.parse(data);
             $('#sub_category').empty();
             parsedData.forEach(function(item){
                 $('#sub_category').append('<option value="' + item.id + '">' + item.sub_cate_name + '</option>');
             })
         }
      })

   }
</script>
