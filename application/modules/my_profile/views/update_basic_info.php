<?php
$path = base_url().'profile_img/';
if($info->profile_img != NULL){
 $img_url = $path.$info->profile_img;
}else{
 $img_url = $path.'no-img.png';
}

$display_edu='';
$display_org='';
if($info->member_id == 1 || $info->member_id == 2){ 
 $display_edu = "display: block;";
 $display_org = "display: none;";
}else if($info->member_id == 8 || $info->member_id == 12 || $info->member_id == 10 || $info->member_id == 9 || $info->member_id == 13){
 $display_edu = "display: none;";
 $display_org = "display: block;";
}
?> 
<style type="text/css">
 .info{margin-left: 25px; color: black;}
 /*.required {color: red; font-size: 20px;}*/
</style>

<div class="page-content"> 
  <div class="content">  

    <div class="row">
      <div class="col-md-2 col-sm-2" style="margin:0 0px;">
        <div class="user-profile-pic" style="margin-top: 20px;"> 
          <img width="100" height="100" data-src-retina="<?=$img_url?>" data-src="<?=$img_url?>" src="<?=$img_url?>" alt="" style="border: 5px solid #ccc;">
        </div>
        <div class="user-mini-description"  style="font-size: 150%;"><h2 class="text-success semi-bold"> BS ID</h2></div>
        <div class="user-mini-description" style="font-size: 150%;"><h2 class="text-success semi-bold" ><?=$info->scout_id;?> </h2></div>
      </div>

      <div class="col-md-10 col-sm-10" style="margin-top: 20px;">
        <div class="grid simple horizontal">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">                
              <a href="<?=base_url('my_profile')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Profile</a> 
            </div>
          </div>
          <div class="grid-body">
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');;?>
              </div>
            <?php endif; ?>

            <?php 
            $attributes = array('id' => 'basic_update_validation');
            echo form_open_multipart(base_url()."my_profile/update_basic_info", $attributes);?>

            <div class="row">
              <h4 class="margin_left_15 semi-bold">Personal Information</h4>
              <div class="col-md-12">
                <div class="row form-row">
                  <div class="col-md-3">
                    <label class="form-label">Full Name (English) <span class='required'>*</span></label>
                    <?php echo form_error('first_name'); ?>
                    <input type="text" name="first_name" class="form-control input-sm" value="<?=set_value('first_name', $info->first_name)?>">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Full Name (Bangla) <span class='required'>*</span></label>
                    <?php echo form_error('full_name_bn'); ?>
                    <input type="text" name="full_name_bn" class="bangla form-control input-sm" value="<?=set_value('full_name_bn', $info->full_name_bn)?>" contenteditable="TRUE">
                  </div>
                  <div class="col-md-4">
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
                  <div class="col-md-2">
                    <label class="form-label">Religion <span class='required'>*</span></label>
                    <?php echo form_error('religion_id');
                    $more_attr = 'class="form-control input-sm"';
                    echo form_dropdown('religion_id', $religions, set_value('religion_id', $info->religion_id), $more_attr);
                    ?>
                  </div>                  
                </div>

                <div class="row form-row">
                  <div class="col-md-3">
                    <label class="form-label">Father's Name (English) <span class='required'>*</span></label>
                    <?php echo form_error('father_name'); ?>
                    <input type="text" name="father_name" class="form-control input-sm" value="<?=set_value('father_name', $info->father_name)?>">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Father's Name (Bangla) <span class='required'>*</span></label>
                    <?php echo form_error('father_name_bn'); ?>
                    <input type="text" name="father_name_bn" class="bangla form-control input-sm" value="<?=set_value('father_name_bn', $info->father_name_bn)?>" contenteditable="TRUE">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Mobile No. <span class='required'>*</span></label>
                    <?php echo form_error('phone'); ?>
                    <input name="phone" value="<?=set_value('phone', $info->phone)?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Gender <span class='required'>*</span></label>
                    <?php echo form_error('gender'); ?>
                    <input type="radio" name="gender" value="Male" <?=set_value('gender',$info->gender)=='Male'?'checked':'';?>> <span style="color: black; font-size: 14px;">Male</span> 
                    <input type="radio" name="gender" value="Female" <?=set_value('gender',$info->gender)=='Female'?'checked':'';?>> <span style="color: black; font-size: 14px;">Female</span>
                    <input type="radio" name="gender" value="Others" <?=set_value('gender',$info->gender)=='Others'?'checked':'';?>> <span style="color: black; font-size: 14px;">Others</span>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-3">
                    <label class="form-label">Mother's Name (English) <span class='required'>*</span></label>
                    <?php echo form_error('mother_name'); ?>
                    <input type="text" name="mother_name"  class="form-control input-sm" value="<?=set_value('mother_name', $info->mother_name)?>">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Mother's Name (Bangla) <span class='required'>*</span></label>
                    <?php echo form_error('mother_name_bn'); ?>
                    <input type="text" name="mother_name_bn"  class="bangla form-control input-sm" value="<?=set_value('mother_name_bn', $info->mother_name_bn)?>" contenteditable="TRUE">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Email Address</label>
                    <?php echo form_error('email'); ?>
                    <input name="email" value="<?=set_value('email', $info->email)?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Blood Group</label>
                    <?php echo form_error('blood_group');
                    $more_attr = 'class="form-control input-sm" ';
                    echo form_dropdown('blood_group', $blood_group, set_value('blood_group', $info->blood_group), $more_attr);
                    ?>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-2">
                    <label class="form-label">National ID</label>
                    <?php echo form_error('nid'); ?>
                    <input name="nid" value="<?=set_value('nid', $info->nid)?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label class="form-label">Birth ID</label>
                    <?php echo form_error('birth_id'); ?>
                    <input name="birth_id" value="<?=set_value('birth_id', $info->birth_id)?>" type="text" class="form-control input-sm" placeholder="">
                  </div> 
                  <div class="col-md-2">
                    <label class="form-label">Telephone No.</label>
                    <?php echo form_error('phone2'); ?>
                    <input name="phone2" value="<?=set_value('phone2', $info->phone2)?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Emergency Contact</label>
                    <?php echo form_error('phone_emergency'); ?>
                    <input name="phone_emergency" value="<?=set_value('phone_emergency', $info->phone_emergency)?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-3">
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
              </div>
            </div> <!-- /row -->

            <div class="row">
              <div class="col-md-7">
                <div class="row form-row">
                  <h4 class="margin_left_15 semi-bold">Address Information</h4>
                  <div class="col-md-6">      
                    <h5 class="semi-bold"><em>Present Address</em></h5> <br>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label">Village Name/House No (EN) <span class='required'>*</span></label>
                        <?php echo form_error('pre_village_house'); ?>
                        <input type="text" name="pre_village_house" class="form-control input-sm" value="<?=set_value('pre_village_house', $info->pre_village_house)?>">
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Village Name/House No (BN) <span class='required'>*</span></label>
                        <?php echo form_error('pre_village_house_bn'); ?>
                        <input type="text" name="pre_village_house_bn" class="bangla form-control input-sm" value="<?=set_value('pre_village_house_bn', $info->pre_village_house_bn)?>" contenteditable="TRUE">
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Road/Block/Sector (EN) <span class='required'>*</span></label>
                        <?php echo form_error('pre_road_block'); ?>
                        <input type="text" name="pre_road_block" class="form-control input-sm" value="<?=set_value('pre_road_block', $info->pre_road_block)?>">
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Road/Block/Sector (BN) <span class='required'>*</span></label>
                        <?php echo form_error('pre_road_block_bn'); ?>
                        <input type="text" name="pre_road_block_bn" class="bangla form-control input-sm" value="<?=set_value('pre_road_block_bn', $info->pre_road_block_bn)?>" contenteditable="TRUE">
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
                        <?php echo form_error('pre_district_id');
                        $more_attr = 'class="distirict_val form-control input-sm" id="district"';
                        echo form_dropdown('pre_district_id', $districts, set_value('pre_district_id', $info->pre_district_id), $more_attr);
                        ?>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Upazila/Thana <span class='required'>*</span></label>
                        <?php echo form_error('pre_upa_tha_id');
                        $more_attr = 'class="upazila_thana_val form-control input-sm" ';
                        echo form_dropdown('pre_upa_tha_id', $upazilas, set_value('pre_upa_tha_id', $info->pre_upa_tha_id), $more_attr);
                        ?>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Post Office</label>
                        <?php echo form_error('pre_post_office'); ?>
                        <input type="text" name="pre_post_office" class="form-control input-sm" value="<?=set_value('pre_post_office', $info->pre_post_office)?>">
                      </div>
                    </div>
                  </div> 
                  <div class="col-md-6">
                    <h5 class="semi-bold"><em>Permanent Addess</em></h5>
                    <h5 class="semi-bold"><input type="checkbox" id="same_as" name="same_as" value="Yes"> Same as present address</h5>
                    <div class="row form-row">
                      <div class="col-md-12">
                        <label class="form-label">Village Name/House No (EN) </label>
                        <?php echo form_error('per_village_house'); ?>
                        <input type="text" name="per_village_house" class="form-control input-sm" value="<?=set_value('per_village_house', $info->per_village_house)?>">
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Village Name/House No (BN) </label>
                        <?php echo form_error('per_village_house_bn'); ?>
                        <input type="text" name="per_village_house_bn" class="bangla form-control input-sm" value="<?=set_value('per_village_house_bn', $info->per_village_house_bn)?>" contenteditable="TRUE">
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Road/Block/Sector (EN)</label>
                        <?php echo form_error(' per_road_block'); ?>
                        <input type="text" name=" per_road_block" class="form-control input-sm" value="<?=set_value('per_road_block', $info->per_road_block)?>">
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Road/Block/Sector (BN) </label>
                        <?php echo form_error('per_road_block_bn'); ?>
                        <input type="text" name="per_road_block_bn" class="bangla form-control input-sm" value="<?=set_value('per_road_block_bn', $info->per_road_block_bn)?>" contenteditable="TRUE">
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
                  <h4 class="margin_left_15 semi-bold">Passport Information</h4>
                  <div class="col-md-6">
                    <label class="form-label">Passport No</label>
                    <?php echo form_error('passport_no'); ?>
                    <input name="passport_no" value="<?=set_value('passport_no', $info->passport_no)?>" type="text" class="form-control input-sm" placeholder="" style="text-transform: uppercase;">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Date of Issue</label>
                    <?php echo form_error('pass_date_issue'); ?>
                    <input name="pass_date_issue" value="<?=set_value('pass_date_issue', $info->pass_date_issue != NULL ? date_bangla_format($info->pass_date_issue):'')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Date of Expiry</label>
                    <?php echo form_error('pass_date_expiry'); ?>
                    <input name="pass_date_expiry" value="<?=set_value('pass_date_expiry', $info->pass_date_expiry != NULL ? date_bangla_format($info->pass_date_expiry):'')?>" type="text" class="form-control input-sm datetime" placeholder="DD-MM-YYYY">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Place of Issue</label>
                    <?php echo form_error('pass_place_issue'); ?>
                    <input name="pass_place_issue" value="<?=set_value('pass_place_issue', $info->pass_place_issue)?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Place of Birth</label>
                    <?php echo form_error('pass_place_birth'); ?>
                    <input name="pass_place_birth" value="<?=set_value('pass_place_birth', $info->pass_place_birth)?>" type="text" class="form-control input-sm" placeholder="">
                  </div>
                </div>

                <div class="row form-row">
                  <h5 class="margin_left_15 semi-bold"><em>Other's Information</em></h5>
                  <div id="eduDiv" style="<?=$display_edu?>">
                    <div class="col-md-12">
                      <label class="form-label">Currnet Institute</label>
                      <select class="instituteSelect2 form-control" name="curr_institute_id" id="curr_institute_id"></select>
                      <script>
                        var $newOption = $("<option></option>").val("<?php echo $info->curr_institute_id;?>").text("<?php echo $info->institute_name;?>");
                        $("#curr_institute_id").append($newOption).trigger('change');
                      </script>
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

                  <div id="orgDiv" style="<?=$display_org?>">
                    <div class="col-md-12">
                      <label class="form-label">Scout Designation (For Adult Leader)</label>
                      <input name="scout_designation" value="<?=set_value('scout_designation', $info->scout_designation)?>" type="text" class="form-control input-sm" placeholder="">
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">Present Organization / Office / Business Name</label>
                      <input name="curr_org" value="<?=set_value('curr_org', $info->curr_org)?>" type="text" class="form-control input-sm" placeholder="">
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">Present Designation</label>
                      <input name="curr_desig" value="<?=set_value('curr_desig', $info->curr_desig)?>" type="text" class="form-control input-sm" placeholder="">
                    </div>
                  </div>
                </div>
              </div>

            </div> <!-- /row -->

            <div class="form-actions">  
              <div class="pull-right">
                <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-small btn-cons'"); ?>
                <a href="<?=base_url('my_profile')?>" class="btn btn-white btn-small btn-cons">Cancel</a>
              </div>
            </div>

            <?php echo form_close();?>

          </div> <!-- END GRID BODY -->    
        </div> <!-- END GRID -->        
      </div>  <!-- END GRID BODY -->              
    </div> <!-- END GRID -->
  </div>  <!-- </content> -->
</div> <!-- </page-content> -->

<script type="text/javascript">
 $(document).ready(function() {
  $('#basic_update_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
        first_name: {
          required: true
        },
        full_name_bn: {
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
        father_name_bn: {
          required: true
        },
        mother_name: {
          required: true
        }, 
        mother_name_bn: {
          required: true
        },  
        nid:{
          number: true,
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
        pre_village_house_bn:{
          required: true
        },
        pre_road_block:{
          required: true
        },  
        pre_road_block_bn:{
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
        pre_up_th_id: {
          required: true
        },
        pre_post_office: {
          required: true
        },

      },

    });
}); 

 $(document).ready(function(){
  $("#same_as").click(function(){
    if ($('input[name=same_as]:checked').val() == "Yes" ) {
      var pre_village_house = $("input[name*='pre_village_house']").val();
      var pre_village_house_bn = $("input[name*='pre_village_house_bn']").val();
      var pre_road_block    = $("input[name*='pre_road_block']").val();
      var pre_road_block_bn    = $("input[name*='pre_road_block_bn']").val();
      var pre_division_id   = $("select[name*='pre_division_id']").val();
      var pre_district_id   = $("select[name*='pre_district_id']").val();
      var pre_upa_tha_id    = $("select[name*='pre_upa_tha_id']").val();
      var pre_post_office   = $("input[name*='pre_post_office']").val();

      $("input[name*='per_village_house']").val(pre_village_house);
      $("input[name*='per_village_house_bn']").val(pre_village_house_bn);
      $("input[name*='per_road_block']").val(pre_road_block);
      $("input[name*='per_road_block_bn']").val(pre_road_block_bn);
      $("select[name*='per_division_id']").val(pre_division_id);
      $("select[name*='per_district_id']").val(pre_district_id);
      $("select[name*='per_upa_tha_id']").val(pre_upa_tha_id);
      $("input[name*='per_post_office']").val(pre_post_office);
    } else {
      var blank='';

      $("input[name*='per_village_house']").val(blank);
      $("input[name*='per_village_house_en']").val(blank);
      $("input[name*='per_road_block']").val(blank);
      $("input[name*='per_road_block_en']").val(blank);
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

<?php if(!empty($info->occp_others)){?>
<script type="text/javascript">
  $('#occp_others').show();
</script>
<?php } ?>
