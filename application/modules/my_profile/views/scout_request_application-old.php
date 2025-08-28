<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <!-- <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li> -->
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>
               <div class="grid-body">
                  <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  $attributes = array('id' => 'scout_request_validation');
                  echo form_open_multipart("scout-application-request", $attributes);?>

                  <div class="row">
                     <div class="col-md-12">   
                        <div class="alert alert-info alert-block fade in">        
                          <h4 class="alert-heading semi-bold"><i class="icon-warning-sign"></i> Thank you for registration.</h4>
                          <p class="semi-bold"> To be an online scout member please provide your basic personal and scout information below.</p>
                        </div>
                        <h4 style="font-weight: bold;">Personal Information</h4>
                     </div>          
                  </div>

                  <div class="row">
                     <div class="col-md-7">
                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Full Name (English) <span class='required'>*</span></label>
                              <?php echo form_error('first_name'); ?>
                              <input type="text" name="first_name" class="form-control input-sm" value="<?=set_value('first_name', $info->first_name)?>">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Date of Birth <span class='required'>*</span></label>
                              <?php echo form_error('day'); echo form_error('month'); echo form_error('year'); ?>
                              <div class="row form-row">
                                  <?php 
                                    $dob=explode('-', $info->dob);
                                    $day  =$dob[2];
                                    $month=$dob[1]; 
                                    $year =$dob[0];  
                                  ?>
                                 <div class="col-md-4" style="">
                                    <?php echo form_dropdown('day', $days, set_value('day',$day), 'class="form-control input-sm"'); ?>
                                 </div>
                                 <div class="col-md-4" style="padding-left:0;">
                                    <?php echo form_dropdown('month', $months, set_value('month',$month), 'class="form-control input-sm"'); ?>
                                 </div>
                                 <div class="col-md-4" style="padding-left:0;">
                                    <?php echo form_dropdown('year', $years, set_value('year',$year), 'class="form-control input-sm"'); ?>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="row form-row">
                           <div class="col-md-6">
                              <label class="form-label">Full Name (Bangla)</label>
                              <?php echo form_error('full_name_bn'); ?>
                              <input type="text" name="full_name_bn" class="form-control input-sm" value="<?=set_value('full_name_bn', $info->full_name_bn)?>">
                           </div>
                           <div class="col-md-6">
                              <label class="form-label">Religion <span class='required'>*</span></label>
                              <?php echo form_error('religion_id');
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('religion_id', $religions, set_value('religion_id', $info->religion_id), $more_attr);
                              ?>
                           </div>
                        </div>

                        <div class="row form-row">
                          <div class="col-md-6">
                           <label class="form-label">Father's Name (English) <span class='required'>*</span></label>
                           <?php echo form_error('father_name'); ?>
                           <input type="text" name="father_name" class="form-control input-sm" value="<?=set_value('father_name', $info->father_name)?>">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Father's Name (Bangla)</label>
                           <?php echo form_error('father_name_bn'); ?>
                           <input type="text" name="father_name_bn" class="form-control input-sm" value="<?=set_value('father_name_bn', $info->father_name_bn)?>">
                        </div>
                     </div>

                     <div class="row form-row">
                      <div class="col-md-6">
                        <label class="form-label">Mother's Name (English) <span class='required'>*</span></label>
                        <?php echo form_error('mother_name'); ?>
                        <input type="text" name="mother_name"  class="form-control input-sm" value="<?=set_value('mother_name', $info->mother_name)?>">
                     </div> 
                     <div class="col-md-6">
                        <label class="form-label">Mother's Name (Bangla)</label>
                        <?php echo form_error('mother_name_bn'); ?>
                        <input type="text" name="mother_name_bn"  class="form-control input-sm" value="<?=set_value('mother_name_bn',$info->mother_name_bn)?>">
                     </div>
                  </div>

                  <div class="row form-row">
                   <div class="col-md-6">      
                     <h5 class="semi-bold">Present Address</h5> <br>
                     <div class="row form-row">
                       <div class="col-md-12">
                         <label class="form-label">Village/House <span class='required'>*</span></label>
                         <?php echo form_error('pre_village_house'); ?>
                         <input type="text" name="pre_village_house" class="form-control input-sm" value="<?=set_value('pre_village_house', $info->pre_village_house)?>">
                      </div>
                      <div class="col-md-12">
                         <label class="form-label">Road/Block/Sector <span class='required'>*</span></label>
                         <?php echo form_error('pre_road_block'); ?>
                         <input type="text" name="pre_road_block" class="form-control input-sm" value="<?=set_value('pre_road_block', $info->pre_road_block)?>">
                      </div>
                      <div class="col-md-12">
                         <label class="form-label">Division <span class='required'>*</span></label>
                         <?php echo form_error('pre_division_id');
                         $more_attr = 'class="form-control input-sm" id="division"';
                         echo form_dropdown('pre_division_id', $divisions, set_value('pre_division_id', $info->pre_division_id), $more_attr);
                         ?>
                      </div>
                      <div class="col-md-12">
                          <label class="form-label">District <span class='required'>*</span></label>
                         <?php echo form_error('pre_district_id'); ?>

                          <select name="pre_district_id" class="distirict_val form-control input-sm" id="district">
                             <option value="">-- Select One --</option>
                          </select>
                     </div>
                     <div class="col-md-12">
                        <label class="form-label">Upazila/Thana <span class='required'>*</span></label>
                        <?php echo form_error('pre_upa_tha_id'); ?>
                         <select name="pre_upa_tha_id" class="upazila_thana_val form-control input-sm">
                             <option value="">-- Select One --</option>
                          </select>
                     </div>
                    <div class="col-md-12">
                     <label class="form-label">Post Office</label>
                     <?php echo form_error('pre_post_office'); ?>
                     <input type="text" name="pre_post_office" class="form-control input-sm" value="<?=set_value('pre_post_office', $info->pre_post_office)?>">
                  </div>
           </div>
        </div> 
        <div class="col-md-6">
          <h5 class="semi-bold">Permanent Addess</h5>
          <h5 class="semi-bold"><input type="checkbox" id="same_as" name="same_as" value="Yes"> Same as present address</h5>
          <div class="row form-row">
            <div class="col-md-12">
              <label class="form-label">Village/House</label>
              <?php echo form_error('per_village_house'); ?>
              <input type="text" name="per_village_house" class="form-control input-sm" value="<?=set_value('per_village_house', $info->per_village_house)?>">
           </div>
           <div class="col-md-12">
              <label class="form-label">Road/Block/Sector</label>
              <?php echo form_error(' per_road_block'); ?>
              <input type="text" name=" per_road_block" class="form-control input-sm" value="<?=set_value('per_road_block', $info->per_road_block)?>">
           </div>
           <div class="col-md-12">
              <label class="form-label">Division</label>
              <?php echo form_error('per_division_id');
              $more_attr = 'class="form-control input-sm" id="division2"';
              echo form_dropdown('per_division_id', $divisions, set_value('per_division_id', $info->per_division_id), $more_attr);
              ?>
           </div>
           <div class="col-md-12">
              <label class="form-label">District</label>
             <?php echo form_error('per_district_id');
              $more_attr = 'class="distirict_val2 form-control input-sm" id="district2"';
              echo form_dropdown('per_district_id', $districts, set_value('per_district_id', $info->per_district_id), $more_attr);
              ?>
         </div>
         <div class="col-md-12">
            <label class="form-label">Upazila/Thana</label>
            <?php echo form_error('per_upa_tha_id');
              $more_attr = 'class="upazila_thana_val2 form-control input-sm" ';
              echo form_dropdown('per_upa_tha_id', $upazilas, set_value('per_upa_tha_id', $info->per_upa_tha_id), $more_attr);
            ?>
         </div>
         <div class="col-md-12">
          <label class="form-label">Post Office</label>
          <?php echo form_error('per_post_office'); ?>
          <input type="text" name="per_post_office" class="form-control input-sm" value="<?=set_value('per_post_office',$info->per_post_office)?>">
       </div>
    </div>
</div>
</div>
</div>

<div class="col-md-5">

 <div class="row form-row">
   <div class="col-md-6">
     <label class="form-label">Gender <span class='required'>*</span></label>
     <?php echo form_error('gender'); ?>
     <input type="radio" name="gender" value="Male" <?=set_value('gender',$info->gender)=='Male'?'checked':'';?>> <span style="color: black; font-size: 14px;">Male</span> 
     <input type="radio" name="gender" value="Female" <?=set_value('gender',$info->gender)=='Female'?'checked':'';?>> <span style="color: black; font-size: 14px;">Female</span>
     <input type="radio" name="gender" value="Others" <?=set_value('gender',$info->gender)=='Others'?'checked':'';?>> <span style="color: black; font-size: 14px;">Others</span>
  </div>
  <div class="col-md-6">
     <label class="form-label">Blood Group</label>
     <?php echo form_error('blood_group');
     $more_attr = 'class="form-control input-sm" ';
     echo form_dropdown('blood_group', $blood_group, set_value('blood_group', $info->blood_group), $more_attr);
     ?>
  </div>
</div>

<div class="row form-row">
  <div class="col-md-6">
    <label class="form-label">National ID</label>
    <?php echo form_error('nid'); ?>
    <input name="nid" value="<?=set_value('nid', $info->nid)?>" type="text" class="form-control input-sm" placeholder="">
 </div>
 <div class="col-md-6">
   <label class="form-label">Birth ID</label>
   <?php echo form_error('birth_id'); ?>
   <input name="birth_id" value="<?=set_value('birth_id', $info->birth_id)?>" type="text" class="form-control input-sm" placeholder="">
</div> 
</div>

<div class="row form-row">
 <div class="col-md-6">
   <label class="form-label">Mobile No. <span class='required'>*</span></label>
   <?php echo form_error('phone'); ?>
   <input name="phone" value="<?=set_value('phone', $info->phone)?>" type="text" class="form-control input-sm" placeholder="">
</div>
<div class="col-md-6">
   <label class="form-label">Telephone No.</label>
   <?php echo form_error('phone2'); ?>
   <input name="phone2" value="<?=set_value('phone2', $info->phone2)?>" type="text" class="form-control input-sm" placeholder="">
</div> 
</div>

<div class="row form-row">
  <div class="col-md-6">
    <label class="form-label">Passport No</label>
    <?php echo form_error('passport_no'); ?>
    <input name="passport_no" value="<?=set_value('passport_no', $info->passport_no)?>" type="text" class="form-control input-sm" placeholder="">
 </div>
 <div class="col-md-6">
   <label class="form-label">Email</label>
   <?php echo form_error('email'); ?>
   <input name="email" value="<?=set_value('email', $info->email)?>" type="text" class="form-control input-sm" placeholder="xyz@example.com">
</div> 
</div>

<div class="row form-row">
  <div class="col-md-6">
    <label class="form-label">Emergency Contact No.</label>
    <?php echo form_error('phone_emergency'); ?>
    <input name="phone_emergency" value="<?=set_value('phone_emergency', $info->phone_emergency)?>" type="text" class="form-control input-sm" placeholder="">
 </div>
 <div class="col-md-6">
    <label class="form-label">Occupation</label>
    <?php echo form_error('occupation_id');
    $more_attr = 'class="form-control input-sm" id="occupation"';
    echo form_dropdown('occupation_id', $occupation, set_value('occupation_id', $info->occupation_id), $more_attr);
    ?>
 </div> 
</div>
<div class="row form-row" id='occp_others'>
  <div class="col-md-12">
    <label class="form-label">Other Occupation</label>
    <?php echo form_error('occp_others'); ?>
    <input name="occp_others" value="<?=set_value('occp_others', $info->occp_others)?>" type="text" class="form-control input-sm" placeholder="">
 </div>
</div>

<!-- <div class="row form-row">
 <div class="col-md-12">
    <label class="form-label">Change Password</label>
    <?php echo form_error('password'); ?>
    <input name="password" id="password" type="text" class="form-control input-sm" placeholder="8 character">
 </div>
</div> -->

<div class="row">
  <div class="col-md-12">  
   <img width="50" height="50" data-src-retina="<?php //$img_url?>" data-src="<?php //$img_url?>" src="<?php //$img_url?>" alt="">

   <div class="form-group">
     <label>Profile Image</label>
     <div><?php echo form_error('userfile'); ?></div>
     <input type="file" name="userfile">                  
     <p class="help-block">File type jpg, png, jpeg, gif and maximun file size 1 MB.</p>
  </div>
</div>
</div>

<div class="row form-row">
  <div class="col-md-6">
    <label class="form-label">Facebook</label>
    <?php echo form_error('facebook'); ?>
    <input name="facebook" value="<?=set_value('facebook')?>" type="text" class="form-control input-sm" placeholder="https://...">
 </div>  
 <div class="col-md-6">
    <label class="form-label">Google+</label>
    <?php echo form_error('google'); ?>
    <input name="google" value="<?=set_value('google')?>" type="text" class="form-control input-sm" placeholder="https://...">
 </div>
 <div class="col-md-6">
   <label class="form-label">Linkedin</label>
   <?php echo form_error('linkedin'); ?>
   <input name="linkedin" value="<?=set_value('linkedin')?>" type="text" class="form-control input-sm" placeholder="https://...">
</div> 
<div class="col-md-6">
   <label class="form-label">Skype</label>
   <?php echo form_error('skype'); ?>
   <input name="skype" value="<?=set_value('skype')?>" type="text" class="form-control input-sm" placeholder="https://...">
</div> 
</div>

</div> 

<div class="row">          
  <div class="col-md-12">        
    <h4 style="font-weight: bold;">Institute & Scout Information</h4>
 </div>

 <div class="col-md-12">
     <input type="radio" class="is_interested" name="is_interested" value="0" checked> <span style="color: black; font-size: 14px;">I am already a scout Member</span>  &nbsp; &nbsp;  
     <input type="radio" class="is_interested" name="is_interested" value="1"> <span style="color: black; font-size: 14px;">I am interested</span>
  </div>
</div>

<div class="col-md-4">
    <h5 style="font-weight: bold;">Institute Information</h5>

    <div class="row form-row"> 
       <div class="col-md-12">
          <label class="form-label">Currnet Institute</label>
          <?php echo form_error('curr_institute_id');
          //$more_attr = 'class=" form-control select2-ajax-institute" ';
         // echo form_dropdown('curr_institute_id', $institute, set_value('curr_institute_id', $info->curr_institute_id), $more_attr);
          ?>
		  <!-- <input <?=$more_attr?> type='text' placeholder='select item' style="padding:0; margin:0;" /> -->
        <select class="instituteSelect2 form-control" name="curr_institute_id"></select>
       </div> 
       <div class="col-md-12">
           <label class="form-label">Current Class</label>
           <?php echo form_error('curr_class'); ?>
           <input name="curr_class" value="<?=set_value('curr_class', $info->curr_class)?>" type="text" class="form-control input-sm" placeholder="">
        </div> 

        <div class="col-md-12">
           <label class="form-label">Current Roll No</label>
           <?php echo form_error('curr_role_no'); ?>
           <input name="curr_role_no" value="<?=set_value('curr_role_no', $info->curr_role_no)?>" type="text" class="form-control input-sm" placeholder="">
        </div> 
       
    </div>
</div>

<div class="col-md-8">
  <h5 style="font-weight: bold;">Scout Information</h5>
  <div class="row form-row" id="expreance">
        <div class="col-md-4">
          <h5 class="semi-bold"><input type="checkbox" <?=set_value('sc_cub',$info->sc_cub)=='Yes'?'checked':'';?> id="sc_cub" name="sc_cub" value="Yes"> Cub Scouts Experience</h5>
        </div>
        <div class="col-md-4">
          <h5 class="semi-bold"><input type="checkbox" <?=set_value('sc_scout',$info->sc_scout)=='Yes'?'checked':'';?> id="sc_scout" name="sc_scout" value="Yes"> Scouts Experience</h5>
        </div>
        <div class="col-md-4">
          <h5 class="semi-bold"><input type="checkbox" <?=set_value('sc_rover',$info->sc_rover)=='Yes'?'checked':'';?> id="sc_rover" name="sc_rover" value="Yes"> Rover Scouts Experience</h5>
        </div>
  </div>
  <div class="row form-row">
      <div class="col-md-4">
        <label class="form-label">Scout Join Date <span class='required'>*</span></label>
        <?php echo form_error('join_date'); ?>
        <input name="join_date" value="" type="text" class="form-control input-sm datetime pull-left" placeholder="DD-MM-YYYY" style="width: 80%;">
        <span class="pull-left"> <i class="fa fa-calendar" style="font-size: 22px; padding-top: 2px; padding-left: 5px;"></i> </span>
     </div>
     <div class="col-md-4">
        <label class="form-label">Member Type</label>
        <?php echo form_error('member_id'); ?>
        <?php echo form_dropdown('member_id',$member_type, set_value('member_id'), 'id="member_id" class="form-control input-sm"');?>
      </div>
     <div class="col-md-4">
        <label class="form-label">Scout Section Type <span class='required'>*</span></label>
        <?php echo form_error('sc_section_id');
        $more_attr = 'class="form-control input-sm" id="sc_section"';
        echo form_dropdown('sc_section_id', $scout_section, set_value('sc_section_id', $info->sc_section_id), $more_attr);
        ?>
     </div> 

     <div class="col-md-6" id="sc_badge_hidden">
        <label class="form-label">Scout Badge</label>
        <?php echo form_error('sc_badge_id'); ?>
        <select name="sc_badge_id" class="sc_badge_val form-control input-sm" id="sc_badge">
          <option value="">-- Select One --</option>
        </select>
     </div>
     <div class="col-md-6" id="sc_role_hidden">
        <label class="form-label">Scout Role</label>
        <?php echo form_error('sc_role_id');?>
        <select name="sc_role_id" class="sc_role_val form-control input-sm" id="sc_role">
          <option value="">-- Select One --</option>
        </select>
     </div>
  </div>


<div class="row form-row">
    <div class="col-md-6">
      <label class="form-label">Select Scout Region <span class='required'>*</span></label>
      <?php 
      echo form_error('sc_region_id');
      $more_attr = 'class="form-control input-sm" id="region"';
      echo form_dropdown('sc_region_id', $regions, set_value('sc_region_id'), $more_attr);
      ?>
   </div>
   <div class="col-md-6">
      <label class="form-label">Select Scout District <span class='required'>*</span></label>
      <?php echo form_error('sc_district_id'); ?>
      <select name="sc_district_id" class="sc_district_val form-control input-sm" id="sc_district">
        <option value="">-- Select One --</option>
     </select>
  </div>
</div>


<div class="row form-row">
   <div class="col-md-6">
     <label class="form-label">Select Scout Upazila/Thana</label>
     <?php echo form_error('sc_upa_tha_id'); ?>
     <select name="sc_upa_tha_id" class="sc_upazila_thana_val form-control input-sm"  id="sc_upazila_thana">
       <option value="">-- Select One --</option>
    </select>
 </div>

 <div class="col-md-6">
    <label class="form-label">Select Scout Group <span class='required'>*</span></label>    
    <?php echo form_error('sc_group_id'); ?>
    <select name="sc_group_id" class="sc_group_val form-control input-sm" id="sc_unit">
      <option value="">-- Select One --</option>
   </select>
</div>
</div>


<div class="col-md-12">
  <input type="hidden" name="unit_id_name" id="unit_id_name" value="<?=$info->sc_unit_id?>">
 <?php echo form_error('sc_unit_id'); ?>
 <div class="unit_list" style=""></div>  
</div>

</div>
</div>
</div>


</div>

<div class="form-actions">  
 <div class="pull-right">
   <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Send </button>
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
	   
	   	

      $('#scout_request_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         first_name: {
            required: true
         },
         day: {
            required: true
         },
         month: {
            required: true
         },
         year: {
            required: true
         },
         gender: {
            required: true
         },
         blood_group: {
            required: false
         },
         religion_id: {
            required: true
         },         
         father_name: {
            required: true
         },
         mother_name: {
            required: true
         },
         nid:{
            number: false,
         },
         birth_id:{
            number: true,
         },
         phone:{
            required: true,
            number: true,
            minlength: 11,
            maxlength: 11
         },         
         email: {            
            email:true
         }, 
         pre_village_house:{
            required: true
         },
         pre_road_block:{
            required: true
         },        
         pre_division_id: {
            required: true
         },
         pre_district_id: {
            required: true
         },
         pre_upa_tha_id: {
            required: true
         },
         pre_post_office: {
            required: false
         },
         
         join_date: {
            required: true
         },
         member_id: {
            required: true
         },
         sc_section_id: {
            required: true
         },
         sc_badge_id: {
            required: false
         },
         sc_role_id: {
            required: false
         },
         sc_region_id: {
            required: true
         },
         sc_district_id: {
            required: true
         },
         sc_upa_tha_id: {
            required: false
         },
         sc_group_id: {
            required: true
         },
         sc_unit_id: {
            required: false
         }
       },

      
      });
   }); 

   $(document).ready(function(){
      $("#same_as").click(function(){
        if ($('input[name=same_as]:checked').val() == "Yes" ) {
            var pre_village_house = $("input[name*='pre_village_house']").val();
            var pre_road_block    = $("input[name*='pre_road_block']").val();
            var pre_division_id   = $("select[name*='pre_division_id']").val();
            var pre_district_id   = $("select[name*='pre_district_id']").val();
            var pre_upa_tha_id      = $("select[name*='pre_upa_tha_id']").val();
            var pre_post_office   = $("input[name*='pre_post_office']").val();

           $("input[name*='per_village_house']").val(pre_village_house);
           $("input[name*='per_road_block']").val(pre_road_block);
           $("select[name*='per_division_id']").val(pre_division_id);
           $("select[name*='per_district_id']").val(pre_district_id);
           $("select[name*='per_upa_tha_id']").val(pre_upa_tha_id);
           $("input[name*='per_post_office']").val(pre_post_office);
        } else {
          var blank='';

          $("input[name*='per_village_house']").val(blank);
          $("input[name*='per_road_block']").val(blank);
          $("select[name*='per_division_id']").val(blank);
          $("select[name*='per_district_id']").val(blank);
          $("select[name*='per_upa_tha_id']").val(blank);
          $("input[name*='per_post_office']").val(blank);
            
        }
     });
  });  
</script>

<script type="text/javascript">
  $('#occp_others').hide();
  $('#occupation').change(function(){
      var id = $('#occupation').val();
      if(id=='Other'){
        $('#occp_others').show();
      }else{
        $('#occp_others').hide();
      }
   });
</script>

<script type="text/javascript">
  $('.is_interested').change(function(){
      var value=document.querySelector("input[name=is_interested]:checked").value;
      if(value==0){
        $('#sc_badge_hidden').show();
        $('#sc_role_hidden').show();
        $('#expreance').show();
      }else{
        $('#sc_badge_hidden').hide();
        $('#sc_role_hidden').hide();
        $('#expreance').hide();
      }
   });
</script>

