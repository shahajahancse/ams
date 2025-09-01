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
                <a href="<?=base_url('general_setting/badge_type')?>" class="btn btn-blueviolet btn-xs btn-mini"> Badge Type List</a>  
              </div>
             </div>
             <div class="grid-body">
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>

              <?php 
              $attributes = array('id' => 'badge_type_validate');
              echo form_open_multipart("general_setting/badge_type_add", $attributes);?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Badge Type Name BN</label>
                  <?php echo form_error('badge_type_name_bn'); ?>
                  <?php echo form_input('badge_type_name_bn', set_value('badge_type_name_bn'), 'id="badge_type_name_bn" class="form-control input-sm"');?>
                </div>
              	<div class="col-md-6">
                  <label class="form-label">Badge Type Name EN</label>
                  <?php echo form_error('badge_type_name_en'); ?>
                  <?php echo form_input('badge_type_name_en', set_value('badge_type_name_en'), 'id="badge_type_name_en" class="form-control input-sm"');?>
                </div>
                
              </div>

              <div class="row form-row">
              	<div class="col-md-12">
                  <label class="form-label">Badge Logo</label>
                  <?php echo form_error('badge_logo'); ?>
                  <input name="badge_logo" id="badge_logo" type="file" value="<?=set_value('badge_logo')?>" >
                  <p class="help-block">File type jpg, png, jpeg, gif and maximun file size 1 MB.</p>
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
      $('#badge_type_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
      	badge_type_name_bn: {
            required: true
         },
         badge_type_name_en: {
            required: false
         },
         badge_logo: {
            required: false
         },

      },

    });
   });   
</script>