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
                <a href="<?=base_url('general_setting/scout_role')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scout Role List</a>  
              </div>
             </div>
             <div class="grid-body">
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>

              <?php 
              $attributes = array('id' => 'scout_badge_validate');
              echo form_open_multipart("general_setting/scout_role_edit/".$info->id, $attributes);?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Member Type</label>
                  <?php echo form_error('member_id'); ?>
                  <?php echo form_dropdown('member_id',$member_type, set_value('member_id',$info->member_id), 'id="member_id" class="form-control input-sm"');?>
                </div>
              	<div class="col-md-6">
                  <label class="form-label">Select Section</label>
                  <?php echo form_error('section_id'); ?>
                  <?php echo form_dropdown('section_id',$section, set_value('section_id', $info->section_id), 'id="sc_section" class="form-control input-sm"');?>
                </div>

               
              </div>

              <div class="row form-row">
                 <div class="col-md-6">
                  <label class="form-label">Select Role Type</label>
                  <?php echo form_error('role_type_id'); ?>
                  <?php echo form_dropdown('role_type_id', $role_type, set_value('role_type_id', $info->role_type_id), 'id="role_type_id" class="form-control input-sm"');?>
                  <!-- <label class="form-label">Role Name (Bangla)</label>
                  <?php //echo form_error('role_name_bn'); ?>
                  <input name="role_name_bn" id="role_name_bn" type="text" value="<?php //echo set_value('role_name_bn', $info->role_name)?>" class="form-control input-sm" placeholder=""> -->
                </div>
              
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <?php echo form_error('status'); ?>
                    <input type="radio" name="status" id="" class="group_control" value="1" <?=set_value('is_current', $info->status)==1?'checked':'';?>> Enable &nbsp;&nbsp;
                    <input type="radio" name="status" id="" class="group_control" value="0" <?=set_value('is_current', $info->status)==0?'checked':'';?>> Disable
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
      $('#scout_role_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
      	section_id: {
            required: true
         },
         role_type_id: {
            required: true
         },

         status: {
            required: true
         },

      },

    });
   });   
</script>