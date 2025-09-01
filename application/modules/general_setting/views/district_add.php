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
                <a href="<?=base_url('general_setting/district')?>" class="btn btn-success btn-xs btn-mini"> District List</a>  
              </div>
             </div>
             <div class="grid-body">
              <!-- <form id="form_traditional_validation" action="#"> -->
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <a class="close" data-dismiss="alert">&times;</a>
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>

              <?php 
              $attributes = array('id' => 'district_validate');
              echo form_open_multipart("general_setting/district_add", $attributes);?>

              <div class="row form-row">
              	<div class="col-md-6">
                  <label class="form-label">Select Division</label>
                  <?php echo form_error('division'); ?>
                  <?php echo form_dropdown('division',$division, set_value('division'), 'id="division" class="select2 form-control input-sm"');?>
                </div>

                <div class="col-md-6">
                  <label class="form-label">GEO Code</label>
                  <?php echo form_error('div_geo'); ?>
                  <input name="district_geo" id="district_geo" type="number" value="<?=set_value('district_geo')?>" class="form-control input-sm" placeholder="e.g. 10">
                </div>
              </div>

              <div class="row form-row">
              	<div class="col-md-6">
                  <label class="form-label">District Name (English)</label>
                  <?php echo form_error('district_name'); ?>
                  <input name="district_name" id="district_name" type="text" value="<?=set_value('district_name')?>" class="form-control input-sm" placeholder="e.g. Dhaka">
                </div>

              	<div class="col-md-6">
                  <label class="form-label">District Name (Bangla)</label>
                  <?php echo form_error('district_name_bn'); ?>
                  <input name="district_name_bn" id="district_name_bn" type="text" value="<?=set_value('district_name_bn')?>" class="form-control input-sm" placeholder="উদাহরণ: ঢাকা">
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
      $('#district_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
      	division: {
            required: true
         },
         district_name: {
            required: true
         },
         district_name_bn: {
            required: false
         },
         district_geo: {
            required: false,
            minlength: 2,
            maxlength: 2
         },
      },

    });
   });   
</script>