<div class="page-content">
  <div class="content">
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url('general_setting/division_type')?>" class="btn btn-blueviolet btn-xs btn-mini">List</a>
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
              echo form_open_multipart("general_setting/division_type_edit/".$info->id, $attributes);?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Name Bangla <span style="color:red">*</span></label>
                  <?php echo form_error('name_bn'); ?>
                  <input name="name_bn" id="name_bn" type="text" value="<?=set_value('name_bn', $info->name_bn)?>" class="form-control input-sm" placeholder="">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Name English <span style="color:red">*</span></label>
                  <?php echo form_error('name_en'); ?>
                  <input name="name_en" id="name_en" type="text" value="<?=set_value('name_en', $info->name_en)?>" class="form-control input-sm" placeholder="">
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
         address_bn: {
            required: true
         },
         address_en: {
            required: true
         },
      },

    });
   });
</script>
