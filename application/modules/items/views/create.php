
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
                     <a href="<?=base_url('items')?>" class="btn btn-info btn-xs btn-mini"> Assets List</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <?php if($this->session->flashdata('error')):?>
                     <div class="alert alert-error">
                        <?php echo $this->session->flashdata('error');?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate');
                  echo form_open_multipart("items/create", $attributes);?>
                  <div>
                     <h4><b>Asset Info</b></h4>
                     <hr>
                  </div>
                  <div class="row form-row">
                     <div class="col-md-3">
                        <label class="form-label">Select Category <span  class="required">*</span></label>
                        <?php $cat = $this->db->get('item_categories')->result(); ?>
                        <select name="category_id" onchange="getSubCategory(this.value)" class="form-control input-sm"  >
                           <option value="">-- Select One --</option>
                           <?php foreach ($cat as $key => $value) { ?>
                              <option value="<?=$value->id?>"><?=$value->category_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Select Sub Category <span  class="required">*</span></label>
                        <?php echo form_error('sub_cat_id'); ?>
                        <select name="sub_cat_id" class="sub_category_val form-control input-sm" id="sub_category"  >
                           <option value="">-- Select One --</option>
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Asset Name <span  class="required">*</span></label>
                        <?php echo form_error('item_name'); ?>
                        <input name="item_name" id="item_name" type="text" value="<?=set_value('item_name')?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Select Unit <span  class="required">*</span></label>
                        <?php echo form_error('unit_id');?>
                        <select name="unit_id" id="unit_id" class="form-control input-sm">
                           <option value="">-- Select One --</option>
                           <?php foreach ($units as $key => $value) { ?>
                              <option value="<?=$value->id?>" <?= ($value->id == set_value('unit_id', '')) ? 'selected' : '' ?>><?=$value->unit_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-3">
                        <label class="form-label">Orginal Cost <span  class="required">*</span></label>
                        <input name="original_cost" id="original_cost" type="number" step="0.01" value="<?=set_value('original_cost')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Capitalized Cost <span  class="required">*</span></label>
                        <input name="capitalized_cost" id="capitalized_cost" type="number" step="0.01" value="<?=set_value('capitalized_cost')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Serial Number <span  class="required">*</span></label>
                        <input name="serial_number" id="serial_number" type="text" value="<?=set_value('serial_number')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Acquisition Date <span  class="required">*</span></label>
                        <input name="acquisition_date" id="acquisition_date" type="date" value="<?=set_value('acquisition_date')?>" class="form-control input-sm">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-3">
                        <label class="form-label">Manufacture Date <span  class="required">*</span></label>
                        <input name="manufacture_date" id="manufacture_date" type="date" value="<?=set_value('manufacture_date')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Asset Image <span  class="required">*</span></label>
                        <input type="file" name="asset_image" id="asset_image" class="form-control input-sm" value="<?=set_value('asset_image')?>" accept=".jpg,.jpeg,.png" />
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Warranty</label>
                        <input name="warranty_months" id="warranty_months" type="file" value="<?=set_value('warranty_months')?>" class="form-control input-sm">
                     </div>
                                                               
                     <div class="col-md-3">
                        <label class="form-label">Asset Status <span  class="required">*</span></label>
                        <select name="asset_status" class="form-control input-sm" id="asset_status">
                           <option value="">-- Select One --</option>
                           <option value="1" <?= (set_value('asset_status') == '1') ? 'selected' : '' ?>>In Stock</option>
                           <option value="2" <?= (set_value('asset_status') == '2') ? 'selected' : '' ?>>Under Maintenance</option>
                           <option value="3" <?= (set_value('asset_status') == '3') ? 'selected' : '' ?>>Disposed</option>
                           <option value="4" <?= (set_value('asset_status') == '4') ? 'selected' : '' ?>>Retired</option>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Asset Specification</label>
                        <textarea name="description" id="description" class="form-control input-sm" rows="3"><?=set_value('description')?></textarea>
                     </div>

                     <div class="col-md-2">
                        <label class="form-label">Asset Type<span  class="required">*</span></label>
                        <?php echo form_error('type'); ?>
                        <select name="type" id="type" class="form-control input-sm">
                           <option value="">--Select Type--</option>
                           <option value="1" <?= (set_value('type') == '1') ? 'selected' : '' ?>>Depriciation</option>
                           <option value="2" <?= (set_value('type') == '2') ? 'selected' : '' ?>>Non Depriciation</option>
                           <option value="3" <?= (set_value('type') == '3') ? 'selected' : '' ?>>Fixed</option>
                        </select>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Method <span  class="required">*</span></label>
                        <select name="value_type" id="value_type" class="form-control input-sm"  >
                           <option value="">-- Select Method --</option>
                           <option value="1" >Straight-Line Method (SlM)</option>
                           <option value="2">Written Down Value (WDV)</option>
                           <option value="3">Units of Production Method (Future)</option>
                        </select>
                     </div>
                     <div class="col-md-2" id="residual_cost_div" style="display: none;">
                        <label class="form-label">R.Cost <span  class="required">*</span> </label>
                        <input name="residual_cost" id="residual_cost" type="number" step="10"  class="form-control input-sm">
                     </div>
                     <div class="col-md-2" id="life_year_div" style="display: none;">
                        <label class="form-label">Life Year <span  class="required">*</span> </label>
                        <input name="life_year" id="life_year" type="number" step="10"  class="form-control input-sm">
                     </div>
                     <div class="col-md-2" id="rate_div" style="display: none;">
                        <label class="form-label">Rate<span  class="required">*</span> </label>
                        <input name="rate" id="rate" type="number" step="10"  class="form-control input-sm">
                     </div>
                  </div>
                  
                  <div class="row form-row">
                     <div class="col-md-12">
                        <h4 class="semi-bold">Supplier Info</h4>
                        <hr>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Supplier <span  class="required">*</span></label>
                        <select name="supplier_id" id="supplier_id" class="form-control input-sm">
                           <option value="">-- Select Supplier --</option>
                           <?php foreach ($suppliers as $supplier) { ?>
                              <option value="<?=$supplier->id?>"><?=$supplier->name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Email </label>
                        <input name="email" id="email" type="email" class="form-control input-sm" readonly>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Phone Number</label>
                        <input name="phone" id="phone" type="text" class="form-control input-sm" readonly>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Address</label>
                        <input name="address" id="address" type="text"  class="form-control input-sm" readonly>
                     </div>
                     
                  </div>
                  <div class="row form-row">
                     <div class="col-md-12">
                        <h4 class="semi-bold">Custom Fields </h4>
                     </div>
                     <?php foreach ($custom_fields as $field): ?>
                     <div class="col-md-4">
                        <label class="form-label"><?=$field->field_name?> <?=($field->is_  == 1) ? '' : ''?> </label>
                        <?php
                        $field_name = 'custom_field_' . $field->id;
                        $field_value = set_value($field_name); // For validation errors
                        switch ($field->field_type) {
                           case 'text':
                              echo '<input name="'.$field_name.'" type="text" value="'.$field_value.'" class="form-control input-sm" '. (($field->is_  == 1) ? ' ' : '') .'>';
                              break;
                           case 'number':
                              echo '<input name="'.$field_name.'" type="number" value="'.$field_value.'" class="form-control input-sm" '. (($field->is_  == 1) ? ' ' : '') .'>';
                              break;
                           case 'date':
                              echo '<input name="'.$field_name.'" type="date" value="'.$field_value.'" class="form-control input-sm" '. (($field->is_  == 1) ? ' ' : '') .'>';
                              break;
                           case 'dropdown':
                              echo '<select name="'.$field_name.'" class="form-control input-sm" '. (($field->is_  == 1) ? ' ' : '') .'>';
                              echo '<option value="">-- Select --</option>';
                              $options = explode(',', $field->options);
                              foreach ($options as $option) {
                                 $option = trim($option);
                                 echo '<option value="'.$option.'" '.set_select($field_name, $option).'>'.$option.'</option>';
                              }
                              echo '</select>';
                              break;
                           case 'textarea':
                              echo '<textarea name="'.$field_name.'" class="form-control input-sm" rows="3" '. (($field->is_  == 1) ? ' ' : '') .'>'.$field_value.'</textarea>';
                              break;
                        }
                        ?>
                     </div>
                     <?php endforeach; ?>
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
            category_id: {  required: true },
            sub_cat_id: {  required: true },
            item_name: {  required: true },
            unit_id: { required : true },
            original_cost: { required : true },
            capitalized_cost: { required : true },
            serial_number: { required : true },
            acquisition_date: { required : true },
            manufacture_date: { required : true },
            expire_date: { required : true },
            asset_status: { required: true },
            asset_image: { required: true },
            type: { required: true },
            value_type: { required: true },
            residual_cost: {
               required: {
                  depends: function() { var v = $('#value_type').val(); return v == '1' || v == '2'; }
               }
            },
            life_year: {
               required: {
                  depends: function() { return $('#value_type').val() == '1'; }
               }
            },
            rate: {
               required: {
                  depends: function() { return $('#value_type').val() == '2'; }
               }
            },
            quantity: { required : true },
            supplier_id: { required : true },
            status: { required : true },           
         }
      });
   });
</script>
<script>
   function getSubCategory(id){
      $.ajax({
         type: "POST",
         url: "<?=base_url('items/get_sub_category_by_category/');?>",
         data: {id:id},
         success: function(data){
            var parsedData = JSON.parse(data);
            $('#sub_category').empty();
            $('#sub_category').append(`<option value="">-- Select Sub Category --</option>`);
            parsedData.forEach(function(item){
               $('#sub_category').append('<option value="' + item.id + '">' + item.sub_cate_name + '</option>');
            });
         }
      });

   }
</script>

<script>
   $(document).ready(function () {
      $('#supplier_id').on('change', function () {
         var id = $(this).val();
         $.ajax({
            type: "POST",
            url: "<?=base_url('items/get_supplier_info/');?>",
            data: {id:id},
            success: function(data){
               var parsedData = JSON.parse(data);
               $('#email').val(parsedData.email);
               $('#phone').val(parsedData.phone);
               $('#address').val(parsedData.address);
            }
         });
      });
   });

   $(document).ready(function () {
      // $('#residual_cost_div').hide();
      // $('#life_year_div').hide();
      // $('#rate_div').hide();
      $('#value_type').on('change', function () {

         var method = $(this).val();
         if(method == 1){
            $('#residual_cost_div').fadeIn(400);
            $('#life_year_div').fadeIn(400);
            $('#rate_div').fadeOut(400);
         } else if(method == 2){
            $('#residual_cost_div').fadeIn(400);
            $('#rate_div').fadeIn(400);
            $('#life_year_div').fadeOut(400);
         }else{
            $('#residual_cost_div').fadeOut(400);
            $('#life_year_div').fadeOut(400);
            $('#rate_div').fadeOut(400);
         }
      });
   });
</script>