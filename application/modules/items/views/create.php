
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

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Acquisition Date</label>
                        <input name="acquisition_date" type="date" value="<?=set_value('acquisition_date')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Cost</label>
                        <input name="cost" type="number" step="0.01" value="<?=set_value('cost')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" class="form-control input-sm">
                           <option value="">-- Select Supplier --</option>
                           <?php foreach ($suppliers as $supplier) { ?>
                              <option value="<?=$supplier->id?>"><?=$supplier->name?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Serial Number</label>
                        <input name="serial_number" type="text" value="<?=set_value('serial_number')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Warranty (Months)</label>
                        <input name="warranty_months" type="number" value="<?=set_value('warranty_months')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Custodian</label>
                        <select name="custodian_id" class="form-control input-sm">
                           <option value="">-- Select Custodian --</option>
                           <?php foreach ($custodians as $custodian) { ?>
                              <option value="<?=$custodian->id?>"><?=$custodian->first_name . ' ' . $custodian->last_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Asset Status</label>
                        <select name="asset_status" class="form-control input-sm">
                           <option value="In Use">In Use</option>
                           <option value="Under Maintenance">Under Maintenance</option>
                           <option value="Disposed">Disposed</option>
                           <option value="Retired">Retired</option>
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Branch</label>
                        <?php
                        $more_attr = 'class="form-control input-sm" id="branch_id"';
                        echo form_dropdown('branch_id', $branches, set_value('branch_id'), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Department</label>
                        <?php
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('department_id', $departments, set_value('department_id'), $more_attr);
                        ?>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Floor</label>
                        <?php
                        $more_attr = 'class="form-control input-sm" id="floor_id"';
                        echo form_dropdown('floor_id', $floors, set_value('floor_id'), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Room</label>
                        <?php
                        $more_attr = 'class="form-control input-sm" id="room_id"';
                        echo form_dropdown('room_id', $rooms, set_value('room_id'), $more_attr);
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
                        $field_value = set_value($field_name); // For validation errors
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
                                    echo '<option value="'.$option.'" '.set_select($field_name, $option).'>'.$option.'</option>';
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

   $(document).ready(function() {
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
               }
            });
         } else {
            $('#room_id').empty();
            $('#room_id').append('<option value="">-- Select Room --</option>');
         }
      });
   });
</script>
