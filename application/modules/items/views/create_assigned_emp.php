
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
                  <div class="row form-row" id="assigned_emp">
                     <div class="col-md-12">
                        <h4 class="semi-bold">Assigned Employee/Custodian</h4>
                        <hr>
                     </div>
                     <div class="row"  style="margin-left: 0px;">
                        <div class="col-md-4">
                           <label class="form-label">Select Employee/Custodian <span  class="required">*</span></label>
                           <?php $users = $this->db->where('status', 1)->get('users')->result(); ?> 
                           <select name="user_id" id="user_id" class="select2 form-control input-sm" style="width: 100%;"  >
                              <option value="">-- Select One --</option>
                              <?php foreach ($users as $key => $value) { ?>
                                 <option value="<?=$value->id?>"> <?=$value->first_name ?> </option>
                              <?php } ?>
                              <option value="0">Others</option>
                           </select>
                        </div>
                     </div>
                     <br>
                     <div class="row" style="margin-left: 0px;">
                        <div class="col-md-3">
                           <label class="form-label">Branch <span  class="required">*</span></label>
                           <?php $divs = $this->db->where('status', 1)->get('units')->result(); ?>
                           <select name="branch_id" class="select2 form-control input-sm"  >
                              <option value="">-- Select One --</option>
                              <?php foreach ($divs as $key => $value) { ?>
                                 <option value="<?=$value->id?>"><?=$value->name_en?></option>
                              <?php } ?>
                              <option value="0">Others</option>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <label class="form-label">Department <span  class="required">*</span></label>
                           <select name="dept_id" id="dept_id" class="select2 form-control input-sm"  >
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
                           <select name="floor_id" id="floor_id" class="select2 form-control input-sm"  >
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
                           <select name="room_id" id="room_id" class="select2 form-control input-sm"  >
                              <option value="">-- Select One --</option>
                              <?php foreach ($rooms as $key => $value) { ?>
                                 <option value="<?=$value->id?>"> <?=$value->name_en ?> </option>
                              <?php } ?>
                              <option value="0">Others</option>
                           </select>
                        </div>
                     </div>

                      <br>
                     <div class="container mt-3">
                        <div id="assetRows">
                        <button type="button" class="btn btn-success btn-mini" id="addMore"><i class="fa fa-plus"></i> Add</button>

                           <div class="row asset-row" style="margin-left:0px; margin-bottom:10px;">
                              <div class="col-md-1 d-flex align-items-end">
                                 <label class="form-label">.</label>
                                 <button type="button" class="btn btn-danger btn-mini removeRow"><i class="fa fa-trash-o"></i></button>
                              </div>
                              <div class="col-md-2">
                                 <label class="form-label">Select Category <span class="required">*</span></label>
                                 <select name="category_id[]" class="select2 form-control input-sm">
                                    <option value="">-- Select One --</option>
                                    <?php $categories = $this->db->where('status', 'Enable')->get('item_categories')->result(); ?>
                                    <?php foreach ($categories as $category) { ?>
                                       <option value="<?=$category->id?>"><?=$category->category_name?></option>
                                    <?php } ?>
                                    <option value="0">Others</option>
                                 </select>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-label">Select Sub Category <span class="required">*</span></label>
                                 <select name="sub_category_id[]" class="select2 form-control input-sm">
                                    <option value="">-- Select One --</option>
                                    <?php $sub_categories = $this->db->where('status', 1)->get('item_sub_categories')->result(); ?>
                                    <?php foreach ($sub_categories as $sub_category) { ?>
                                       <option value="<?=$sub_category->id?>"><?=$sub_category->sub_cate_name?></option>
                                    <?php } ?>
                                    <option value="0">Others</option>
                                 </select>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-label">Select Asset <span class="required">*</span></label>
                                 <select name="asset_id[]" class="select2 form-control input-sm">
                                    <option value="">-- Select One --</option>
                                    <?php $assets = $this->db->where('asset_status', 1)->get('items')->result(); ?>
                                    <?php foreach ($assets as $asset) { ?>
                                       <option value="<?=$asset->id?>"><?=$asset->item_name?></option>
                                    <?php } ?>
                                    <option value="0">Others</option>
                                 </select>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-label">Asset Tag <span class="required">*</span></label>
                                 <input type="text" name="asset_tag[]" class="form-control input-sm" />
                              </div>


                           </div>
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
   // Add new row
   $('#addMore').click(function () {
      let newRow = $('.asset-row:first').clone();
      newRow.find('input').val(''); // clear inputs
      newRow.find('select').val('').trigger('change'); // reset selects
      $('#assetRows').append(newRow);
   });

   // Remove row
   $(document).on('click', '.removeRow', function () {
      if ($('.asset-row').length > 1) {
         $(this).closest('.asset-row').remove();
      } else {
         alert("At least one row is required.");
      }
   });
});
</script>
