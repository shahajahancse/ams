<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <?=$module_name?> </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('general_setting/upazila_thana')?>" class="btn btn-success btn-xs btn-mini"> Upazila Thana List</a>  
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
              $attributes = array('id' => 'up_th_validate');
              echo form_open_multipart(base_url()."general_setting/upazila_thana_add",$attributes); ?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Select Division</label>
                  <?php echo form_error('division'); ?>
                  <?php echo form_dropdown('division',$division, set_value('division'), 'id="division" class="form-control input-sm"');?>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Select Disteict</label>
                  <select name="district" <?=set_value('division')?> class="distirict_val form-control input-sm" id="district">
                     <option value="">-- Select One --</option>
                  </select>
                </div>
              </div>

              <br>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Upazial Thana (English)</label>
                  <?php echo form_error('up_th_name'); ?>
                  <input name="up_th_name" id="up_th_name" type="text" value="<?=set_value('up_th_name')?>" class="form-control input-sm" placeholder="e.g. Mohammadpur">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Upazial Thana (Bangla)</label>
                  <?php echo form_error('up_th_name_bn'); ?>
                  <input name="up_th_name_bn" id="up_th_name_bn" type="text" value="<?=set_value('up_th_name_bn')?>"  class="form-control input-sm" placeholder="উদাহরণ: মোহাম্মদপুর">
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Upazial Thana GEO Code</label>
                  <?php echo form_error('up_th_geo'); ?>
                  <input name="up_th_geo" id="up_th_geo" type="number" value="<?=set_value('up_th_geo')?>" class="form-control input-sm" placeholder="e.g. 10">
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
      $('#up_th_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        division: {
            required: true
         },
         district: {
            required: true
         },
         up_th_name: {
            required: true
         },
         up_th_name_bn: {
            required: false
         },
         up_th_geo: {
            required: false,
            minlength: 2,
            maxlength: 2
         },
      },

    });
   });   
</script>