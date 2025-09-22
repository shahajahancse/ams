<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('items')?>" class="active"> <?=$module_title; ?> </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>
      <!-- < ?php dd($asset)?> -->
      <!-- < ?php dd($asset)?> -->
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
                  echo form_open_multipart("items/edit/".encrypt_url($id), $attributes);?>
                  <div>
                     <h4><b>Asset Info</b></h4>
                     <hr>
                  </div>
                  <div class="row form-row">
                     <input type="hidden" name="data_id" value="<?= $id ?>" id="data_id">
                     <div class="col-md-3">
                        <label class="form-label">Select Category <span  class="required">*</span></label>
                        <?php $cat = $this->db->get('item_categories')->result(); ?>
                        <select name="category_id" class="form-control input-sm"  id="category_id">
                           <option value="">-- Select One --</option>
                           <?php foreach ($cat as $key => $value) { ?>
                              <option value="<?=$value->id?>" <?php echo $asset->category_id == $value->id ? 'selected' : '' ?> > <?=$value->category_name?></option>
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
                        <select name="type" id="type" class="form-control input-sm" id="type"  >
                           <option value="" >--Select Type--</option>
                           <option value="1" <?php echo set_select('type', '1', $asset->type == '1'); ?>>Depriciation</option>
                           <option value="2" <?php echo set_select('type', '2', $asset->type == '2'); ?>>Non Depriciation</option>
                           <option value="3" <?php echo set_select('type', '3', $asset->type == '3'); ?>>Fixed</option>
                        </select>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Value Type <span  class="required">*</span></label>
                        <select name="value_type" id="value_type" class="form-control input-sm"  >
                           <option value="">-- Select Type --</option>
                           <option value="1" <?php echo set_select('value_type', '1', $asset->value_type == '1'); ?>>Amount</option>
                           <option value="2" <?php echo set_select('value_type', '2', $asset->value_type == '2'); ?>>Percentage</option>
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
                        <label class="form-label">Item Name <span  class="required">*</span></label>
                        <?php echo form_error('item_name'); ?>
                        <input name="item_name" id="item_name" type="text" value="<?= $asset->item_name ?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Select Unit <span  class="required">*</span></label>
                        <?php echo form_error('unit_id');?>
                        <select name="unit_id" id="unit_id" class="form-control input-sm">
                           <option value="">-- Select One --</option>
                           <?php foreach ($units as $key => $value) { ?>
                              <option <?php echo $asset->unit_id == $value->id ? 'selected' : '' ?> value="<?=$value->id?>" ><?=$value->unit_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Acquisition Date <span  class="required">*</span></label>
                        <input name="acquisition_date" id="acquisition_date" type="date" value="<?= $asset->acquisition_date ?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Manufacture Date <span  class="required">*</span></label>
                        <input name="manufacture_date" id="manufacture_date" type="date" value="<?= $asset->manufacture_date ?>" class="form-control input-sm">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-2">
                        <label class="form-label">Orginal Cost <span  class="required">*</span></label>
                        <input name="original_cost" id="original_cost" type="number" step="0.01" value="<?= set_value('original_cost', $asset->original_cost) ?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Capitalized Cost <span  class="required">*</span></label>
                        <input name="capitalized_cost" id="capitalized_cost" type="number" step="0.01" value="<?= set_value('capitalized_cost', $asset->capitalized_cost) ?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Serial Number <span  class="required">*</span></label>
                        <input name="serial_number" id="serial_number" type="text" value="<?= set_value('serial_number', $asset->serial_number) ?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Item Image <span  class="required">*</span></label>
                        <input type="file" name="asset_image" value="<?= set_value('asset_image', $asset->asset_image) ?>" id="asset_image" class="form-control input-sm" accept=".jpg, .jpeg, .png" />
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Warranty</label>
                        <input name="warranty_months" id="warranty_months" type="file" value="<?= set_value('warranty_months', $asset->warranty_months) ?>" class="form-control input-sm">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-8">
                        <label class="form-label">Asset Specification</label>
                        <textarea name="description" id="description" class="form-control input-sm" rows="3"><?= set_value('description', $asset->description) ?></textarea>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Asset Status <span  class="required">*</span></label>
                        <select name="asset_status" class="form-control input-sm" id="asset_status">
                           <option value="">-- Select One --</option>
                           <option value="1" <?= set_select('asset_status', 1, $asset->asset_status == 1) ?>>In Use</option>
                           <option value="2" <?= set_select('asset_status', 2, $asset->asset_status == 2) ?>>Under Maintenance</option>
                           <option value="3" <?= set_select('asset_status', 3, $asset->asset_status == 3) ?>>Disposed</option>
                           <option value="4" <?= set_select('asset_status', 4, $asset->asset_status == 4) ?>>Retired</option>
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
                              <option value="<?=$supplier->id?>" <?= set_select('supplier_id', $supplier->id, $asset->supplier_id == $supplier->id) ?>><?=$supplier->name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Email </label>
                        <input name="email" id="email" type="email" value="<?= set_value('email', $asset->email) ?>" class="form-control input-sm" readonly>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Phone Number</label>
                        <input name="phone" id="phone" type="text" value="<?= set_value('phone', $asset->phone) ?>" class="form-control input-sm" readonly>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Address</label>
                        <input name="address" id="address" type="text" value="<?= set_value('address', $asset->address) ?>" class="form-control input-sm" readonly>
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
                        <select name="branch_id" class="form-control input-sm" id="branch_id"  >
                           <option value="">-- Select One --</option>
                           <?php foreach ($divs as $key => $value) { ?>
                              <option value="<?=$value->id?>" <?= (($asset->branch_id == $value->id ) ? 'selected' : '') ?>><?=$value->name_en?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Department <span  class="required">*</span></label>
                        <select name="dept_id" id="dept_id" class="form-control input-sm"  >
                        <?php $dept = $this->db->where('status', 1)->get('departments')->result(); ?>
                           <option value="">-- Select One --</option>
                           <?php foreach ($dept as $key => $value) { ?>
                              <option value="<?= $value->id ?>" <?= (($asset->dept_id == $value->id) ? 'selected' : '')  ?>><?=$value->dept_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Floor <span  class="required">*</span></label>
                        <?php $floor = $this->db->where('status', 1)->get('asset_floors')->result(); ?> 
                        <select name="floor_id" id="floor_id" class="form-control input-sm"  >
                           <option value="">-- Select One --</option>
                           <?php foreach ($floor as $key => $value) { ?>
                              <option value="<?=$value->id?>" <?= set_select('floor_id', $value->id, $asset->floor_id == $value->id) ?>><?=$value->floor_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Room <span  class="required">*</span></label>
                        <?php $rooms = $this->db->where('status', 1)->get('item_rooms')->result(); ?> 
                        <select name="room_id" id="room_id" class="form-control input-sm"  >
                           <option value="">-- Select One --</option>
                           <?php foreach ($rooms as $key => $value) { ?>
                              <option value="<?=$value->id?>" <?= set_select('room_id', $value->id, $asset->room_id == $value->id) ?>> <?=$value->name_en ?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Assigned Employee/Custodian <span  class="required">*</span></label>
                        <?php $users = $this->db->where('status', 1)->get('users')->result(); ?> 
                        <select name="user_id" id="user_id" class="form-control input-sm"  >
                           <option value="">-- Select One --</option>
                           <?php foreach ($users as $key => $value) { ?>
                              <option value="<?=$value->id?>" <?= set_select('user_id', $value->id, $asset->user_id == $value->id) ?>> <?=$value->first_name ?></option>
                           <?php } ?>
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
                           $custom_field = $this->db->where('asset_id', $id)->get('asset_custom_field_values')->row();
                           switch ($field->field_type) {
                              case 'text':
                                 echo '<input name="'.$field_name.'" type="text" value="'.$field_value.'" class="form-control input-sm" '. (($field->is_  == 1) ? ' required' : '') .'>';
                              break;
                              case 'number':
                                 echo '<input name="'.$field_name.'" type="number" value="'.$field_value.'" class="form-control input-sm" '. (($field->is_  == 1) ? ' required' : '') .'>';
                              break;
                              case 'date':
                                 echo '<input name="'.$field_name.'" type="date" value="'.$field_value.'" class="form-control input-sm" '. (($field->is_  == 1) ? ' required' : '') .'>';
                              break;
                              case 'dropdown':
                                 echo '<select name="'.$field_name.'" class="form-control input-sm" '. (($field->is_  == 1) ? ' required' : '') .'>';
                                 echo '<option value="">-- Select --</option>';
                                 $options = explode(',', $field->options);
                                 foreach ($options as $option) {
                                    $option = trim($option);
                                    echo '<option value="'.$option.'" '.set_select($field_name, $option, (isset($custom_field) && $custom_field->field_value == $option)).'>'.$option.'</option>';
                                 }
                                 echo '</select>';
                              break;
                              case 'textarea':
                                 echo '<textarea name="'.$field_name.'" class="form-control input-sm" rows="3" '. (($field->is_  == 1) ? ' required' : '') .'>'.$field_value.'</textarea>';
                              break;
                           }
                        ?>
                     </div>
                  </div>
                  <?php endforeach; ?>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Update</button>
                     </div>
                  </div>

                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->
            </div> <!-- END GRID -->
         </div>
      </div> 
   </div>
      
</div>

<script type="text/javascript">
   $(document).ready(function() {

      $('#validate').validate({
         ignore: "",
         rules: {
            category_id: { required : true },
            sub_cat_id: {  required: true },
            item_name: {  required: true },
            unit_id: {  required: true },
            type: {  required: true },
         }
      });
   });
</script>

<script>

   $(document).ready(function() {



      $('#category_id').on('change', function () {
         let id = $(this).val();
         if (id !== '') {
            $.ajax({
               url: "<?= base_url('items/get_sub_category_by_category') ?>",
               type: "POST",
               data: { id: id },
               dataType: "json",
               success: function (response) {
                  $('#sub_category').empty().append('<option value="">-- Select Sub Category --</option>');
                  $.each(response, function (i, item) {
                     $('#sub_category').append('<option value="' + item.id + '">' + item.sub_cate_name + '</option>');
                  });
               }
            });
         } else {
            $('#sub_category').html('<option value="">-- Select Sub Category --</option>');
         }
      });      
      $('#category_id').change();

      let selectedCategory = "<?= $asset->category_id ?>";
      let selectedSubCat   = "<?= $asset->sub_cat_id ?>";
      if (selectedCategory !== "") {
         $.ajax({
            url: "<?= base_url('items/get_sub_category_by_category') ?>",
            type: "POST",
            data: { id: selectedCategory },
            dataType: "json",
            success: function (response) {
               $('#sub_category').empty().append('<option value="">-- Select Sub Category --</option>');
               $.each(response, function (i, item) {
                  let isSelected = (item.id == selectedSubCat) ? 'selected' : '';
                  $('#sub_category').append('<option value="' + item.id + '" ' + isSelected + '>' + item.sub_cate_name + '</option>');
               });
            }
         });
      }
      
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
         }
      });
      
      $('#type').change();

      $('#value_type').on('change', function () {
         let type = $(this).val();
         if (type !== '') {

            $.ajax({
                  url: "<?= base_url('general_setting/getOptions') ?>",
                  type: "POST",
                  data: { type: type },
                  dataType: "json",
                  success: function (response) {
                     $('#rate').empty().append('<option value="">-- Select one--</option>');
                     $.each(response, function (key, value) {
                        $('#rate').append('<option value="' + key + '">' + value + '</option>');
                     });
                  }
            });
         } else {
            $('#rate').html('<option value="">-- Select one--</option>');
         }
      });
      let selectedValueType = "<?= $asset->value_type ?>";
      let selectedRate      = "<?= $asset->rate ?>";
      if (selectedValueType !== "") {
         $.ajax({
            url: "<?= base_url('general_setting/getOptions') ?>",
            type: "POST",
            data: { type: selectedValueType },
            dataType: "json",
            success: function (response) {
               $('#rate').empty().append('<option value="">-- Select one--</option>');
               $.each(response, function (key, value) {
                  let isSelected = (key == selectedRate) ? 'selected' : '';
                  $('#rate').append('<option value="' + key + '" ' + isSelected + '>' + value + '</option>');
               });
            }
         });
      }
      $('#value_type').change();
      $('#asset_status').on('change', function () {
         branch = "<?= $asset->branch_id ?>";
         dept = "<?= $asset->dept_id ?>";
         floor = "<?= $asset->floor_id ?>";
         room = "<?= $asset->room_id ?>";
         user = "<?= $asset->user_id ?>";
         let id = $(this).val();
         if (id == 3 || id == 4) {
            $('#assigned_emp').slideUp(1000,function(){
               $('#branch_id').val('');
               $('#dept_id').val(null);
               $('#floor_id').val(null);
               $('#room_id').val(null);
               $('#user_id').val(null);
               $(this).hide();
            });
         }else{
            $('#assigned_emp').slideDown(1000,function(){
               $('#branch_id').val(branch);
               $('#dept_id').val(dept);
               $('#floor_id').val(floor);
               $('#room_id').val(room);
               $('#user_id').val(user);
               $(this).show();
            });
         }
      });
      
      $('#supplier_id').on('change', function () {
         let id = $(this).val();
         if (id !== '') {
            $.ajax({
               url: "<?= base_url('items/get_supplier_info') ?>",
               type: "POST",
               data: { id: id },
               dataType: "json",
               success: function (response) {
                  $('#email').val(response.email);
                  $('#phone').val(response.phone);
                  $('#address').val(response.address);
               }
            });
         } else {
            $('#email, #phone, #address').val('');
         }
      });

      // $('#branch_id').change(function() {
      //    var branch_id = $(this).val();
      //    if (branch_id) {
      //       $.ajax({
      //          url: '<?=base_url('items/get_floors_by_branch/');?>',
      //          data: {id: branch_id},
      //          type: 'POST',
      //          dataType: 'json',
      //          success: function(data) {
      //             $('#floor_id').empty();
      //             $('#floor_id').append('<option value="">-- Select Floor --</option>');
      //             $.each(data, function(key, value) {
      //                $('#floor_id').append('<option value="' + value.id + '">' + value.floor_name + '</option>');
      //             });
      //          }
      //       });
      //    } else {
      //       $('#floor_id').empty();
      //       $('#floor_id').append('<option value="">-- Select Floor --</option>');
      //       $('#room_id').empty();
      //       $('#room_id').append('<option value="">-- Select Room --</option>');
      //    }
      // });

      // $('#floor_id').change(function() {
      //    var floor_id = $(this).val();
      //    if (floor_id) {
      //       $.ajax({
      //          url: '<?=base_url('items/get_rooms_by_floor/');?>',
      //          data: {id: floor_id},
      //          type: 'POST',
      //          dataType: 'json',
      //          success: function(data) {
      //             $('#room_id').empty();
      //             $('#room_id').append('<option value="">-- Select Room --</option>');
      //             $.each(data, function(key, value) {
      //                $('#room_id').append('<option value="' + value.id + '">' + value.room_name + '</option>');
      //             });
      //          }
      //       });
      //    } else {
      //       $('#room_id').empty();
      //       $('#room_id').append('<option value="">-- Select Room --</option>');
      //    }
      // });
      $('#supplier_id').change();
      $('#asset_status').change();
   });
</script>


