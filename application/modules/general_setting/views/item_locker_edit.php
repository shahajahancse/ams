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
                <a href="<?=base_url('general_setting/item_locker')?>" class="btn btn-info btn-xs btn-mini">List</a>
              </div>
             </div>
             <div class="grid-body">
              <?php
              $attributes = array('id' => 'department_validate');
              echo form_open_multipart("general_setting/item_locker_edit/".$info->id, $attributes);?>

              <div class="row form-row">
                <div class="col-md-4">
                  <?php $cats = $this->db->get('item_categories')->result();?>
                  <label class="form-label">Category <span style="color:red">*</span></label>
                  <?php echo form_error('category_id'); ?>
                  <select name="category_id" onchange="SubCat(this.value)" class="form-control input-sm">
                    <option value="">select one</option>
                    <?php foreach ($cats as $key => $cr) { ?>
                      <option <?= $info->cat_id == $cr->id? 'selected':'' ?> value="<?= $cr->id ?>"><?= $cr->category_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Sub Category <span style="color:red">*</span></label>
                  <?php echo form_error('sub_cat'); ?>
                  <select name="sub_cat" id="sub_cat" class="form-control input-sm" onchange="items(this.value)">
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
                      <option <?= $info->room_no == $r->id? 'selected':'' ?> value="<?= $r->id ?>"><?= $r->name_en ?></option>
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
                  <div class="form-group">
                    <label class="radio-inline">
                      <input type="radio" name="status" value="1" <?= $info->status==1? 'checked':'' ?>>
                      Active
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="status" value="2" <?= $info->status==2? 'checked':'' ?>>
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

<script>

  var selectedSubCat = <?= isset($info->sub_cat_id) ? $info->sub_cat_id : '' ?>;
  var selectedItem   = <?= isset($info->item_id)    ? $info->item_id : '' ?>;
  var selectedLocker = <?= isset($info->locker_no)  ? $info->locker_no : '' ?>;

  function SubCat(id){
    $.ajax({
      type: "POST",
      url: "<?=base_url('items/get_sub_category_by_category/');?>",
      data: {id:id},
      success: function(data){
        var parsedData = JSON.parse(data);
        $('#sub_cat').empty().append('<option value="">select one</option>');
        parsedData.forEach(function(item){
          var selected = (item.id == selectedSubCat) ? 'selected' : '';
          $('#sub_cat').append('<option value="' + item.id + '" ' + selected + '>' + item.sub_cate_name + '</option>');
        });

        // load items if sub category already selected
        if (selectedSubCat) {
          $('#sub_cat').change();
          // items(selectedSubCat);
        }
      }
    });
  }

  function items(id){
    $.ajax({
      type: "POST",
      url: "<?=base_url('items/get_item_by_sub_category/');?>",
      data: {id:id},
      success: function(data){
        var parsedData = JSON.parse(data);
        $('#item_id').empty().append('<option value="">select one</option>');
        parsedData.forEach(function(item){
          var selected = (item.id == selectedItem) ? 'selected' : '';
          $('#item_id').append('<option value="' + item.id + '" ' + selected + '>' + item.item_name + '</option>');
        });
      }
    });
  }

  function rooms(id){
    $.ajax({
      type: "POST",
      url: "<?=base_url('items/get_locker_by_room_id/');?>",
      data: {id:id},
      success: function(data){
        var parsedData = JSON.parse(data);
        $('#locker_no').empty().append('<option value="">select one</option>');
        parsedData.forEach(function(item){
          var selected = (item.id == selectedLocker) ? 'selected' : '';
          $('#locker_no').append('<option value="' + item.id + '" ' + selected + '>' + item.name_en + '</option>');
        });
      }
    });
  }

  $(document).ready(function(){
    var catId  = "<?= $info->cat_id ?? '' ?>";
    var roomId = "<?= $info->room_no ?? '' ?>";

    if (catId) {
      SubCat(catId);
    }
    if (roomId) {
      rooms(roomId);
    }
  });
</script>
