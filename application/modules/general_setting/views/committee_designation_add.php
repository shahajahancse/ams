<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> General Setting </li>
      <li> <?=$meta_title?> </li>
    </ul>

    <div class="row">
     <div class="col-md-8">
      <div class="grid simple horizontal">
       <div class="grid-title">
        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
        <div class="pull-right">                
          <a href="<?=base_url('general_setting/committee_designation')?>" class="btn btn-blueviolet btn-xs btn-mini"> Committee Designation List</a>  
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
        echo form_open_multipart("general_setting/committee_designation_add", $attributes);?>

        <div class="row form-row">
          <div class="col-md-6">
            <label class="form-label">Committee Designation</label>
            <?php echo form_error('committee_designation_name'); ?>
            <input name="committee_designation_name" id="committee_designation_name" type="text" value="<?=set_value('committee_designation_name')?>" class="form-control input-sm" placeholder="">
          </div>

          <div class="col-md-6">
            <label class="form-label">Check Office</label>
            <?php echo form_error('officeType[]');
            foreach ($scouts_office as $value) {
              $checked = null;
              ?>
              <div style="color: black; font-weight: bold;">
                <input type="checkbox" name="officeType[]" value="<?=$value['id']?>" <?php echo $checked;?> > <?=$value['office_type_name']?>
              </div>
              <?php } ?>
              <label for="officeType[]" class="error" style="display: none;">Please check at least one.</labe>
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
      // focusInvalid: false, 
      ignore: "",
      rules: {
       committee_designation_name: {
        required: true
      },
      'officeType[]': {
        required: true
      }
    },
    invalidHandler: function (event, validator) {
      //display error alert on form submit    
    },

    errorPlacement: function (label, element) { 
      // render error placement for each input type            
      $('<span class="error"></span>').insertAfter(element).append(label)
      var parent = $(element).parent('.input-with-icon');
      parent.removeClass('success-control').addClass('error-control');  
    },

    highlight: function (element) { // hightlight error inputs
      var parent = $(element).parent();
      parent.removeClass('success-control').addClass('error-control'); 
    },

    unhighlight: function (element) { 
      // revert the change done by hightlight
    },

    success: function (label, element) {
      var parent = $(element).parent('.input-with-icon');
      parent.removeClass('error-control').addClass('success-control'); 
    },

    submitHandler: function (form) {
      form.submit(); 
    }

  });
});   
</script>