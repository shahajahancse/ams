<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
     <!--  <li> <?=$module_name?> </li> -->
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('general_setting/supplier')?>" class="btn btn-info btn-xs btn-mini"> Supplier List</a>  
              </div>
             </div>
             <div class="grid-body" style="overflow-x: hidden;">
              <?php 
              $attributes = array('id' => 'supplier_validate');
              echo form_open_multipart("general_setting/supplier_add", $attributes);?>

              <div class="row form-row">
                <div class="col-md-4">
                  <label class="form-label">Name</label>
                  <?php echo form_error('name'); ?>
                  <input name="name" id="name" type="text" value="<?=set_value('name')?>" class="form-control input-sm" placeholder="">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Phone</label>
                  <?php echo form_error('phone'); ?>
                  <input name="phone" id="phone" type="text" value="<?=set_value('phone')?>" class="form-control input-sm" placeholder="">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Email</label>
                  <?php echo form_error('email'); ?>
                  <input name="email" id="email" type="email" value="<?=set_value('email')?>" class="form-control input-sm" placeholder="">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Address</label>
                  <?php echo form_error('address'); ?>
                  <textarea name="address" id="address" type="text" value="<?=set_value('address')?>" class="form-control input-sm" placeholder=""></textarea>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Status</label>
                  <?php echo form_error('status'); ?>
                  <input type="radio" name="status" id="" class="group_control" value="1" <?=set_value('status', '1')?'checked':'';?>>
                  Active &nbsp;&nbsp;
                  <input type="radio" name="status" id="" class="group_control" value="0" <?=set_value('status', '0')?'checked':'';?>>
                  Inactive
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
      $('#supplier_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         name: {
            required: true
         },
         phone: {
            required: true
         },
         email: {
            required: true,
            email: true
         },
         address: {
            required: true
         },
         status: {
            required: true
         },
      },

    });
   });   
</script>

