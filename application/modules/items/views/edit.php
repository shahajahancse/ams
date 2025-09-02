<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('items')?>" class="active"> <?=$module_title; ?> </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('items')?>" class="btn btn-blueviolet btn-xs btn-mini"> Item List</a>
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php
                  $attributes = array('id' => 'validate');
                  echo form_open_multipart(uri_string(), $attributes);
                  ?>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Select Division <span class="required">*</span></label>
                        <?php $divs = $this->db->where('type', 2)->get('units')->result(); ?>
                        <select name="division_id" class="form-control input-sm" required>
                           <option value="">-- Select One --</option>
                           <?php foreach ($divs as $key => $value) { ?>
                              <option <?= ($info->division_id == $value->id)? 'selected' : '' ?> value="<?=$value->id?>"><?=$value->name_en?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Select Category <span class="required">*</span></label>
                        <?php echo form_error('cat_id');
                        $more_attr = 'class="form-control input-sm" id="category"';
                        echo form_dropdown('cat_id', $categories, set_value('cat_id', $info->cat_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-3">
                        <label class="form-label">Select Sub Category <span class="required">*</span></label>
                        <?php echo form_error('sub_cat_id');
                        $more_attr = 'class="sub_category_val form-control input-sm" id="sub_category" required';
                        echo form_dropdown('sub_cat_id', $sub_categories, set_value('sub_cat_id', $info->sub_cat_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Type <span class="required">*</span></label>
                        <?php echo form_error('type'); ?>
                        <select name="type" id="type" class="form-control input-sm">
                           <option value="1" <?=set_value('type', $info->type)==1?'selected':'';?>>Consumable</option>
                           <option value="2" <?=set_value('type', $info->type)==2?'selected':'';?>>Non-Consumable</option>
                           <option value="3" <?=set_value('type', $info->type)==3?'selected':'';?>>Permanent</option>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Item Name <span class="required">*</span></label>
                        <?php echo form_error('item_name'); ?>
                        <input name="item_name" type="text" value="<?=set_value('item_name', $info->item_name)?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Select Unit <span class="required">*</span></label>
                        <?php echo form_error('unit_id');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('unit_id', $units, set_value('unit_id', $info->unit_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Order Level </label>
                        <?php echo form_error('order_level'); ?>
                        <input name="order_level" type="text" value="<?=set_value('order_level', $info->order_level)?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <?php echo form_error('status'); ?>
                        <select name="status" id="status" class="form-control input-sm">
                           <option value="1" <?=set_value('status', $info->status)==1?'selected':'';?>>Active</option>
                           <option value="2" <?=set_value('status', $info->status)==0?'selected':'';?>>Inactive</option>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label">Item Specification</label>
                        <textarea name="description" class="form-control input-sm" rows="3"><?=$info->description?></textarea>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Acquisition Date</label>
                        <input name="acquisition_date" type="date" value="<?=set_value('acquisition_date', $info->acquisition_date)?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Cost</label>
                        <input name="cost" type="number" step="0.01" value="<?=set_value('cost', $info->cost)?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" class="form-control input-sm">
                           <option value="">-- Select Supplier --</option>
                           <?php foreach ($suppliers as $supplier) { ?>
                              <option value="<?=$supplier->id?>" <?=set_value('supplier_id', $info->supplier_id) == $supplier->id ? 'selected' : ''?>><?=$supplier->name?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Serial Number</label>
                        <input name="serial_number" type="text" value="<?=set_value('serial_number', $info->serial_number)?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Warranty (Months)</label>
                        <input name="warranty_months" type="number" value="<?=set_value('warranty_months', $info->warranty_months)?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Custodian</label>
                        <select name="custodian_id" class="form-control input-sm">
                           <option value="">-- Select Custodian --</option>
                           <?php foreach ($custodians as $custodian) { ?>
                              <option value="<?=$custodian->id?>" <?=set_value('custodian_id', $info->custodian_id) == $custodian->id ? 'selected' : ''?>><?=$custodian->first_name . ' ' . $custodian->last_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Asset Status</label>
                        <select name="asset_status" class="form-control input-sm">
                           <option value="In Use" <?=set_value('asset_status', $info->asset_status) == 'In Use' ? 'selected' : ''?>>In Use</option>
                           <option value="Under Maintenance" <?=set_value('asset_status', $info->asset_status) == 'Under Maintenance' ? 'selected' : ''?>>Under Maintenance</option>
                           <option value="Disposed" <?=set_value('asset_status', $info->asset_status) == 'Disposed' ? 'selected' : ''?>>Disposed</option>
                           <option value="Retired" <?=set_value('asset_status', $info->asset_status) == 'Retired' ? 'selected' : ''?>>Retired</option>
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Branch</label>
                        <?php
                        $more_attr = 'class="form-control input-sm" id="branch_id"';
                        echo form_dropdown('branch_id', $branches, set_value('branch_id', $info->branch_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Department</label>
                        <?php
                        $more_attr = 'class="form-control input-sm" ';
                        echo form_dropdown('department_id', $departments, set_value('department_id', $info->department_id), $more_attr);
                        ?>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Floor</label>
                        <?php
                        $more_attr = 'class="form-control input-sm" id="floor_id"';
                        echo form_dropdown('floor_id', $floors, set_value('floor_id', $info->floor_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Room</label>
                        <?php
                        $more_attr = 'class="form-control input-sm" id="room_id"';
                        echo form_dropdown('room_id', $rooms, set_value('room_id', $info->room_id), $more_attr);
                        ?>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-12">
                        <h4 class="semi-bold">Custom Fields</h4>
                     </div>
                  </div>
                  <?php foreach ($custom_fields as $field): ?>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label"><?=$field->field_name?> <?=($field->is_required == 1) ? '<span class="required">*</span>' : ''?></label>
                        <?php
                        $field_name = 'custom_field_' . $field->id;
                        $field_value = '';
                        foreach ($asset_custom_field_values as $asset_field_value) {
                            if ($asset_field_value->custom_field_id == $field->id) {
                                $field_value = $asset_field_value->field_value;
                                break;
                            }
                        }
                        $field_value = set_value($field_name, $field_value); // For validation errors and existing values

                        switch ($field->field_type) {
                            case 'text':
                                echo '<input name="'.$field_name.'" type="text" value="'.$field_value.'" class="form-control input-sm" '. (($field->is_required == 1) ? 'required' : '') .'>';
                                break;
                            case 'number':
                                echo '<input name="'.$field_name.'" type="number" value="'.$field_value.'" class="form-control input-sm" '. (($field->is_required == 1) ? 'required' : '') .'>';
                                break;
                            case 'date':
                                echo '<input name="'.$field_name.'" type="date" value="'.$field_value.'" class="form-control input-sm" '. (($field->is_required == 1) ? 'required' : '') .'>';
                                break;
                            case 'dropdown':
                                echo '<select name="'.$field_name.'" class="form-control input-sm" '. (($field->is_required == 1) ? 'required' : '') .'>';
                                echo '<option value="">-- Select --</option>';
                                $options = explode(',', $field->options);
                                foreach ($options as $option) {
                                    $option = trim($option);
                                    echo '<option value="'.$option.'" '.set_select($field_name, $option, ($field_value == $option)).'>'.$option.'</option>';
                                }
                                echo '</select>';
                                break;
                            case 'textarea':
                                echo '<textarea name="'.$field_name.'" class="form-control input-sm" rows="3" '. (($field->is_required == 1) ? 'required' : '') .'>'.$field_value.'</textarea>';
                                break;
                        }
                        ?>
                     </div>
                  </div>
                  <?php endforeach; ?>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                        <a href="<?=base_url('items/generate_qr_code/' . encrypt_url($info->id))?>" class="btn btn-info btn-cons" target="_blank"><i class="fa fa-qrcode"></i> Generate QR Code</a>
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
      // focusInvalid: false,
      ignore: "",
      rules: {
         cat_id: { required: true },
         sub_cat_id: { required: true },
         item_name: { required: true },
         unit_id: { required: true },
         status: {required: true}
      }
   });

      $('#branch_id').change(function() {
         var branch_id = $(this).val();
         if (branch_id) {
            $.ajax({
               url: '<?=base_url('items/get_floors_by_branch/');?>' + branch_id,
               type: 'POST',
               dataType: 'json',
               success: function(data) {
                  $('#floor_id').empty();
                  $('#floor_id').append('<option value="">-- Select Floor --</option>');
                  $.each(data, function(key, value) {
                     $('#floor_id').append('<option value="' + value.id + '">' + value.floor_name + '</option>');
                  });
                  // Set selected floor if editing
                  var selected_floor = '<?=set_value('floor_id', $info->floor_id)?>';
                  if (selected_floor) {
                     $('#floor_id').val(selected_floor).trigger('change');
                  }
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
               url: '<?=base_url('items/get_rooms_by_floor/');?>' + floor_id,
               type: 'POST',
               dataType: 'json',
               success: function(data) {
                  $('#room_id').empty();
                  $('#room_id').append('<option value="">-- Select Room --</option>');
                  $.each(data, function(key, value) {
                     $('#room_id').append('<option value="' + value.id + '">' + value.room_name + '</option>');
                  });
                  // Set selected room if editing
                  var selected_room = '<?=set_value('room_id', $info->room_id)?>';
                  if (selected_room) {
                     $('#room_id').val(selected_room);
                  }
               }
            });
         } else {
            $('#room_id').empty();
            $('#room_id').append('<option value="">-- Select Room --</option>');
         }
      });

      // Trigger change on branch_id and floor_id on page load if values exist
      var initial_branch_id = '<?=set_value('branch_id', $info->branch_id)?>';
      if (initial_branch_id) {
         $('#branch_id').val(initial_branch_id).trigger('change');
      }
   });
</script>
