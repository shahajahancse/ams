
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
                     <div class="col-md-2">
                        <label class="form-label">Asset Type<span  class="required">*</span></label>
                        <?php echo form_error('type'); ?>
                        <select name="type" id="type" class="form-control input-sm">
                           <option value="">--Select Type--</option>
                           <option value="1">Depriciation</option>
                           <option value="2">Non Depriciation</option>
                           <option value="3">Fixed</option>
                        </select>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Value Type <span  class="required">*</span></label>
                        <select name="value_type" id="value_type" class="form-control input-sm"  >
                           <option value="">-- Select Type --</option>
                           <option value="1">Amount</option>
                           <option value="2">Percentage</option>
                        </select>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Amount/Percentage <span  class="required">*</span></label>
                        <select name="rate" id="rate" class="form-control input-sm"  >
                           <option value="">-- Select --</option>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">


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
                     <div class="col-md-3">
                        <label class="form-label">Acquisition Date <span  class="required">*</span></label>
                        <input name="acquisition_date" id="acquisition_date" type="date" value="<?=set_value('acquisition_date')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Manufacture Date <span  class="required">*</span></label>
                        <input name="manufacture_date" id="manufacture_date" type="date" value="<?=set_value('manufacture_date')?>" class="form-control input-sm">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-2">
                        <label class="form-label">Orginal Cost <span  class="required">*</span></label>
                        <input name="original_cost" id="original_cost" type="number" step="0.01" value="<?=set_value('original_cost')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Capitalized Cost <span  class="required">*</span></label>
                        <input name="capitalized_cost" id="capitalized_cost" type="number" step="0.01" value="<?=set_value('capitalized_cost')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Serial Number <span  class="required">*</span></label>
                        <input name="serial_number" id="serial_number" type="text" value="<?=set_value('serial_number')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Asset Image <span  class="required">*</span></label>
                        <input type="file" name="asset_image" id="asset_image" class="form-control input-sm" accept=".jpg,.jpeg,.png" />
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Warranty</label>
                        <input name="warranty_months" id="warranty_months" type="file" value="<?=set_value('warranty_months')?>" class="form-control input-sm">
                     </div>
                  </div>

                  <div class="row form-row">

                     <div class="col-md-8">
                        <label class="form-label">Asset Specification</label>
                        <textarea name="description" id="description" class="form-control input-sm" rows="3"><?=set_value('description')?></textarea>
                     </div>
                                          
                     <div class="col-md-4">
                        <label class="form-label">Asset Status <span  class="required">*</span></label>
                        <select name="asset_status" class="form-control input-sm" id="asset_status">
                           <option value="">-- Select One --</option>
                           <option value="1">In Use</option>
                           <option value="2">Under Maintenance</option>
                           <option value="3">Disposed</option>
                           <option value="4">Retired</option>
                        </select>
                     </div>
                  </div>
                  <div class="row form-row">
                     <div class="col-md-12">
                        <h4 class="semi-bold">Supplier Info</h4>
                        <hr>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control input-sm">
                           <option value="">-- Select Supplier --</option>
                           <?php foreach ($suppliers as $supplier) { ?>
                              <option value="<?=$supplier->id?>"><?=$supplier->name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Email </label>
                        <input name="email" id="email" type="email" value="<?=set_value('email')?>" class="form-control input-sm" readonly>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Phone Number</label>
                        <input name="phone" id="phone" type="text" value="<?=set_value('phone')?>" class="form-control input-sm" readonly>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Address</label>
                        <input name="address" id="address" type="text" value="<?=set_value('address')?>" class="form-control input-sm" readonly>
                     </div>
                     
                  </div>
                  <div class="row form-row" id="assigned_emp">
                     <div class="col-md-12">
                        <h4 class="semi-bold">Assigned Employee/Custodian</h4>
                        <hr>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Branch <span  class="required">*</span></label>
                        <?php $divs = $this->db->where('status', 1)->get('units')->result(); ?>
                        <select name="branch_id" class="form-control input-sm"  >
                           <option value="">-- Select One --</option>
                           <?php foreach ($divs as $key => $value) { ?>
                              <option value="<?=$value->id?>"><?=$value->name_en?></option>
                           <?php } ?>
                           <option value="0">Others</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Department <span  class="required">*</span></label>
                        <select name="dept_id" id="dept_id" class="form-control input-sm"  >
                        <?php $dept = $this->db->where('status', 1)->get('departments')->result(); ?>
                           <option value="">-- Select One --</option>
                           <?php foreach ($dept as $key => $value) { ?>
                              <option value="<?=$value->id?>"><?=$value->dept_name?></option>
                           <?php } ?>
                           <option value="0">Others</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Floor <span  class="required">*</span></label>
                        <?php $floor = $this->db->where('status', 1)->get('asset_floors')->result(); ?> 
                        <select name="floor_id" id="floor_id" class="form-control input-sm"  >
                           <option value="">-- Select One --</option>
                           <?php foreach ($floor as $key => $value) { ?>
                              <option value="<?=$value->id?>"><?=$value->floor_name?></option>
                           <?php } ?>
                           <option value="0">Others</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Room <span  class="required">*</span></label>
                        <?php $rooms = $this->db->where('status', 1)->get('item_rooms')->result(); ?> 
                        <select name="room_id" id="room_id" class="form-control input-sm"  >
                           <option value="">-- Select One --</option>
                           <?php foreach ($rooms as $key => $value) { ?>
                              <option value="<?=$value->id?>"> <?=$value->name_en ?> </option>
                           <?php } ?>
                           <option value="0">Others</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Assigned Employee/Custodian <span  class="required">*</span></label>
                        <?php $users = $this->db->where('status', 1)->get('users')->result(); ?> 
                        <select name="user_id" id="user_id" class="form-control input-sm"  >
                           <option value="">-- Select One --</option>
                           <?php foreach ($users as $key => $value) { ?>
                              <option value="<?=$value->id?>"> <?=$value->first_name ?> </option>
                           <?php } ?>
                           <option value="0">Others</option>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-12">
                        <h4 class="semi-bold">Custom Fields </h4>
                     </div>
                  </div>
                  <?php foreach ($custom_fields as $field): ?>
                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label"><?=$field->field_name?> <?=($field->is_  == 1) ? '<span  class="required">*</span>' : ''?> <span  class="required">*</span></label>
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
                  </div>
                  <?php endforeach; ?>

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
         type: { required : true },
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

   $(document).ready(function() {
      $('#branch_id').change(function() {
         var branch_id = $(this).val();
         if (branch_id) {
            $.ajax({
               url: '<?=base_url('items/get_floors_by_branch/');?>',
               data: {id: branch_id},
               type: 'POST',
               dataType: 'json',
               success: function(data) {
                  $('#floor_id').empty();
                  $('#floor_id').append('<option value="">-- Select Floor --</option>');
                  $.each(data, function(key, value) {
                     $('#floor_id').append('<option value="' + value.id + '">' + value.floor_name + '</option>');
                  });
               }
            });
         } else {
            $('#floor_id').empty();
            $('#floor_id').append('<option value="">-- Select Floor --</option>');
            $('#room_id').empty();
            $('#room_id').append('<option value="">-- Select Room --</option>');
         }
      });

      $('#floor_id').change(function() {
         var floor_id = $(this).val();
         if (floor_id) {
            $.ajax({
               url: '<?=base_url('items/get_rooms_by_floor/');?>',
               data: {id: floor_id},
               type: 'POST',
               dataType: 'json',
               success: function(data) {
                  $('#room_id').empty();
                  $('#room_id').append('<option value="">-- Select Room --</option>');
                  $.each(data, function(key, value) {
                     $('#room_id').append('<option value="' + value.id + '">' + value.room_name + '</option>');
                  });
               }
            });
         } else {
            $('#room_id').empty();
            $('#room_id').append('<option value="">-- Select Room --</option>');
         }
      });
   });
</script>

<script>
   $(document).ready(function () {
      $('#value_type').on('change', function () {
         let type = $(this).val();
         if (type !== '') {
            $.ajax({
               url: "<?= base_url('general_setting/getOptions') ?>",
               type: "POST",
               data: { type: type },
               dataType: "json",
               success: function (response) {
                  $('#rate').empty();
                  $('#rate').append('<option value="">-- Select one --</option>');
                  $.each(response, function (key, value) {
                     $('#rate').append('<option value="' + key + '">' + value + '</option>');
                  });
               }
            });
         } else {
            $('#rate').html('<option value="">-- Select one--</option>');
         }
      });
   });
</script>

<!-- // get  supplier info [email,phone,address] -->
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
</script>

<!-- // get  dept by branch -->
<script>
   $(document).ready(function () {
      $('#branch_id').on('change', function () {
         let id = $(this).val();
         if (id !== '') {
            $.ajax({
               url: "<?= base_url('general_setting/getDeptByBranch') ?>",
               type: "POST",
               data: { id: id },
               dataType: "json",
               success: function (response) {
                  $('#dept_id').empty();
                  $('#dept_id').append('<option value="">-- Select oned --</option>');
                  $.each(response, function (key, value) {
                     $('#dept_id').append('<option value="' + key + '">' + value + '</option>');
                  });
               }
            });
         } else {
            $('#dept_id').html('<option value="">-- Select oned --</option>');
         }
      });
   });
</script>
<script>
   $(document).ready(function () {
      $('#asset_status').on('change', function () {
         let id = $(this).val();
         if (id == 3 || id == 4) {
            $('#assigned_emp').slideUp(1000,function(){
               $(this).hide();
            });
         }else{
            $('#assigned_emp').slideDown(1000,function(){
               $(this).show();
            });
         }
      });
   });
</script>

<script>
   $(document).ready(function () {
      $('#type').on('change',function(){
         type = $(this).val();
         value_type = "<?php echo $asset->value_type ?>";
         rate = "<?php echo $asset->rate ?>";
         if(type == 3){
            $('#value_type').append('<option value="0" selected>0</option>');
            $('#rate').append('<option value="0" selected>0</option>');
         }else{
            $('#value_type').val(value_type);
            setTimeout(function(){ $('#rate').val(rate); }, 1000);
            $('#value_type').change();
            $('#value_type option[value="0"]').remove();
            $('#rate option[value="0"]').remove();
         }
      });
   });
</script>
