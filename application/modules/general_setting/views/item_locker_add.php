<div class="page-content">
  <div class="content">
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
     <!--  <li> <?=$module_name?> </li> -->
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-9">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('general_setting/item_locker')?>" class="btn btn-blueviolet btn-xs btn-mini">List</a>
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
              $attributes = array('id' => 'department_validate');
              echo form_open_multipart("general_setting/item_locker_add", $attributes);?>

              <div class="row form-row">
                <div class="col-md-4">
                  <?php $cats = $this->db->get('item_categories')->result();?>
                  <label class="form-label">Category <span style="color:red">*</span></label>
                  <?php echo form_error('cat_id'); ?>
                  <select name="cat_id" onchange="SubCat(this.value)" class="form-control input-sm">
                    <option value="">select one</option>
                    <?php foreach ($cats as $key => $cr) { ?>
                      <option value="<?= $cr->id ?>"><?= $cr->category_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Sub Category <span style="color:red">*</span></label>
                  <?php echo form_error('sub_cat'); ?>
                  <select name="sub_cat" id="sub_cat" onchange="items(this.value)" class="form-control input-sm">
                    <option value="">select one</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Item <span style="color:red">*</span></label>
                  <?php echo form_error('item_id'); ?>
                  <select name="item_id" id="item_id" class="form-control input-sm">
                    <option value="">select one</option>
                  </select>
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-4">
                  <?php $rooms = $this->db->get('item_rooms')->result();?>
                  <label class="form-label">Room <span style="color:red">*</span></label>
                  <?php echo form_error('room_no'); ?>
                  <select name="room_no" onchange="rooms(this.value)" class="form-control input-sm">
                    <option value="">select one</option>
                    <?php foreach ($rooms as $key => $r) { ?>
                      <option value="<?= $r->id ?>"><?= $r->name_en ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Locker <span style="color:red">*</span></label>
                  <?php echo form_error('locker_no'); ?>
                  <select name="locker_no" id="locker_no" class="form-control input-sm">
                    <option value="">select one</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Status <span style="color:red">*</span></label>
                  <?php echo form_error('status'); ?>
                  <select name="status" class="form-control input-sm">
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                  </select>
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

<script>
   function rooms(id){
      $.ajax({
         type: "POST",
         url: "<?=base_url('items/get_locker_by_room_id/');?>"+id,
         success: function(data){
             var parsedData = JSON.parse(data);
             $('#locker_no').empty();
             parsedData.forEach(function(item){
                 $('#locker_no').append('<option value="' + item.id + '">' + item.name_en + '</option>');
             })
         }
      })

   }
</script>

<script>
   function items(id){
      $.ajax({
         type: "POST",
         url: "<?=base_url('items/get_item_by_sub_category/');?>"+id,
         success: function(data){
             var parsedData = JSON.parse(data);
             $('#item_id').empty();
             parsedData.forEach(function(item){
                 $('#item_id').append('<option value="' + item.id + '">' + item.item_name + '</option>');
             })
         }
      })

   }
</script>

<script>
   function SubCat(id){
      $.ajax({
         type: "POST",
         url: "<?=base_url('items/get_sub_category_by_category/');?>"+id,
         success: function(data){
             var parsedData = JSON.parse(data);
             $('#sub_cat').empty();
             parsedData.forEach(function(item){
                 $('#sub_cat').append('<option value="' + item.id + '">' + item.sub_cate_name + '</option>');
             })
         }
      })

   }
</script>

<script type="text/javascript">
   $(document).ready(function() {
      $('#department_validate').validate({
      // focusInvalid: false,
      ignore: "",
      rules: {
         name_bn: {
            required: true
         },
         name_en: {
            required: true
         },
      },

    });
   });
</script>
