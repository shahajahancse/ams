<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> General Setting</li>
      <li> <?=$meta_title; ?> </li>
    </ul>

    <div class="row">
     <div class="col-md-8">
      <div class="grid simple horizontal">
        <div class="grid-title">
          <h4><span class="semi-bold"><?=$meta_title?></span></h4>
          <div class="pull-right">                
            <a href="<?=base_url('general_setting/committee_type')?>" class="btn btn-blueviolet btn-xs btn-mini"> Committee Type List</a>  
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
          echo form_open_multipart(uri_string(), $attributes);
          ?>

          <div class="row form-row">
            <div class="col-md-6">
              <label class="form-label">Scouts Office Type</label>
              <?php echo form_error('office_type_id');
              $more_attr = 'class="form-control input-sm"';
              echo form_dropdown('office_type_id', $scouts_office, set_value('office_type_id', $info->office_type_id), $more_attr);
              ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Committee Type Name</label>
              <?php echo form_error('committee_type_name'); ?>
              <input name="committee_type_name" type="text" value="<?=set_value('committee_type_name', $info->committee_type_name)?>" class="form-control input-sm" placeholder="">
            </div>
          </div>

          <div class="row form-row">
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <?php echo form_error('status'); ?>
              <input type="radio" name="status" id="" class="group_control" value="1" <?=set_value('status', $info->status)==1?'checked':'';?>> Enable &nbsp;&nbsp;
              <input type="radio" name="status" id="" class="group_control" value="0" <?=set_value('status', $info->status)==0?'checked':'';?>> Disable
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
        office_type_id: {
          required: true
        },
        committee_type_name: {
          required: true
        },
        status: {
          required: true
        }
      }

    });
  });   
</script>