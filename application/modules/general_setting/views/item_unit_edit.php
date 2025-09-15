

<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
     <!--  <li> <?=$module_name?> </li> -->
      <li><?=$meta_title; ?></li>
    </ul>
  
    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('general_setting/item_unit')?>" class="btn btn-info btn-xs btn-mini"> Item Unit List</a>  

              </div>
             </div>
             <div class="grid-body">
              <?php 
              $attributes = array('id' => 'item_unit_validate');
              echo form_open_multipart("general_setting/item_unit_edit/".$info->id, $attributes);?>
              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Item unit</label>
                  <?php echo form_error('item_unit_name'); ?>
                  <input name="unit_name" id="unit_name" type="text" value="<?=set_value('unit_name', $info->unit_name)?>" class="form-control input-sm" placeholder="">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <?php echo form_error('status'); ?>
                    <input type="radio" name="status" id="" class="group_control" value="Enable" <?=set_value('is_current', $info->status)=="Enable"?'checked':'';?>> Active &nbsp;&nbsp;
                    <input type="radio" name="status" id="" class="group_control" value="Disable" <?=set_value('is_current', $info->status)=="Disable"?'checked':'';?>> Inactive
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
      $('#item_unit_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         item_unit_name: {
            required: true
         },
      },

    });
   });   
</script>