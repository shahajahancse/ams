<?php
	if(!empty($info)){
		$join_date = $info->join_date;
    $member_id = $info->member_id;
    $section_id = $info->section_id;
		$sc_badge_id = $info->sc_badge_id;
		$sc_role_id = $info->sc_role_id;
		$sc_upa_tha_id = $info->sc_upa_tha_id;
		$sc_region_id = $info->sc_region_id;
		$sc_district_id = $info->sc_district_id;
		$sc_group_id = $info->sc_group_id;
		$sc_unit_id = $info->sc_unit_id;
	}else{
		$join_date = date('d-m-Y');
    $member_id = NULL;
    $section_id = NULL;
		$sc_badge_id = NULL;
		$sc_role_id = NULL;
		$sc_upa_tha_id = NULL;
		$sc_region_id = NULL;
		$sc_district_id = NULL;
		$sc_group_id = NULL;
		$sc_unit_id = NULL;
	}
 ?>

<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('scouts_member')?>" class="active">  </a></li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  $attributes = array('id' => 'scout_member_validation');
                  echo form_open_multipart(uri_string(),$attributes);
                  ?>


                  <div class="row">
                     <div class="col-md-12">
                        <h5 style="font-weight: bold;">Scout Information</h5>
                       
                        <div class="row form-row">
                           <div class="col-md-4">
                              <label class="form-label">Scout Join Date <span class="required">*</span></label>
                              <?php echo form_error('join_date'); ?>
                              <input name="join_date" value="<?=set_value('join_date', date_browse_format($join_date))?>" type="text" class="form-control input-sm datetime pull-left" placeholder="DD-MM-YYYY" style="width: 80%;">
                              <span class="pull-left"> <i class="fa fa-calendar" style="font-size: 22px; padding-top: 2px; padding-left: 5px;"></i> </span>
                           </div>
                           <div class="col-md-4">
                             <label class="form-label">Member Type</label>
                             <?php echo form_error('member_id'); ?>
                             <?php echo form_dropdown('member_id',$member_type, set_value('member_id', $member_id), 'id="member_id" class="form-control input-sm"');?>
                           </div>    
                        </div>
                        <div class="row form-row">              
                           <div class="col-md-4">
                              <label class="form-label">Scout Section Type <span class="required">*</span></label>
                              <?php echo form_error('sc_section_id');
                              $more_attr = 'class="form-control input-sm" id="sc_section"';
                              echo form_dropdown('sc_section_id', $scout_section, set_value('sc_section_id', $section_id), $more_attr);
                              ?>
                           </div> 
                                                      
                           <div class="col-md-4">
                              <label class="form-label">Scout Badge</label>
                              <?php echo form_error('sc_badge_id');
                              $more_attr = 'class="sc_badge_val form-control input-sm" id="sc_badge"';
                              echo form_dropdown('sc_badge_id', $scout_badges, set_value('sc_badge_id', $sc_badge_id), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Scout Role</label>
                              <?php echo form_error('sc_role_id');
                              $more_attr = 'class="sc_role_val form-control input-sm" id="sc_role"';
                              echo form_dropdown('sc_role_id', $scout_roles, set_value('sc_role_id', $sc_role_id), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Select Scout Region</label>
                              <?php 
                              echo form_error('sc_region_id');
                              $more_attr = 'class="form-control input-sm" id="region"';
                              echo form_dropdown('sc_region_id', $regions, set_value('sc_region_id', $sc_region_id), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Select Scout District</label>
                              <?php 
                              echo form_error('sc_district_id');
                              $more_attr = 'class="sc_district_val form-control input-sm" id="sc_district"';
                              echo form_dropdown('sc_district_id', $scout_districts, set_value('sc_district_id', $sc_district_id), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Select Scout Upazila/Thana</label>
                              <?php 
                              echo form_error('sc_upa_tha_id');
                              $more_attr = 'class="sc_upazila_thana_val form-control input-sm"  id="sc_upazila_thana"';
                              echo form_dropdown('sc_upa_tha_id', $scout_upazila_thana, set_value('sc_upa_tha_id', $sc_upa_tha_id), $more_attr);
                              ?>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Select Scout Group</label>
                              <?php echo form_error('sc_group_id'); ?>
                              <?php 
                              echo form_error('sc_group_id');
                              $more_attr = 'class="sc_group_val form-control input-sm" id="sc_unit"';
                              echo form_dropdown('sc_group_id', $scout_group, set_value('sc_group_id', $sc_group_id), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <input type="hidden" name="unit_id_name" id="unit_id_name" value="<?=$sc_unit_id?>">
                           <?php echo form_error('sc_unit_id'); ?>
                           <div class="unit_list" style=""></div>  
                        </div>
                     </div>
                  </div>

               </div>
            </div>

            <div class="form-actions">  
               <div class="pull-right">
                  <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Update</button>
               </div>
            </div>
            <?php echo form_close();?>

         </div>  <!-- END GRID BODY -->              
      </div> <!-- END GRID -->
   </div>

</div> <!-- END ROW -->

<script type="text/javascript">
 $(document).ready(function() {
  $('#scout_member_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
      
     join_date: {
        required: true
     },
    
     sc_badge_id: {
        required: false
     },
     sc_role_id: {
        required: false
     },
     sc_region_id: {
        required: false
     },
     sc_district_id: {
        required: false
     },
     sc_upa_tha_id: {
        required: false
     },
     sc_group_id: {
        required: false
     }
  },
});
}); 

</script>
