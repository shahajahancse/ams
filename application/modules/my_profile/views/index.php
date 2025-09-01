<?php
$username = $info->username;
$scout_id = $info->scout_id;
$name = $info->first_name;
$name_bn = $info->full_name_bn;
$father = $info->father_name;
$father_bn = $info->father_name_bn;
$mother = $info->mother_name;
$mother_bn = $info->mother_name_bn;
$gender = $info->gender;
$dob = $info->dob !='0000-00-00' ? date('d F, Y', strtotime($info->dob)): '';
$blood_group = $info->bg_name_en;
$phone = $info->phone;
$phone2 = $info->phone2;
$emergency_phone = $info->phone_emergency;
$email = $info->email !='' ? $info->email: '';
$nid = $info->nid;

$religion_id = $info->religion_id;
$birth_id = $info->birth_id;
$occupation = $info->occupation_name;

$passport_no = $info->passport_no;
$passport_date_issue = $info->pass_date_issue;
$passport_date_expiry = $info->pass_date_expiry;
$passport_place_issue = $info->pass_place_issue;
$passport_place_birth = $info->pass_place_birth;

$pre_village  = $info->pre_village_house;
$pre_village_bn  = $info->pre_village_house_bn;
$pre_rode     = $info->pre_road_block;
$pre_rode_bn  = $info->pre_road_block_bn;

$pre_division = $info->pre_div_name;
$pre_district = $info->pre_district_name;
$pre_up_th    = $info->pre_up_th_name;
$pre_po       = $info->pre_post_office;

//generate a string for present addresss
$full_pre_add = '';

if($pre_village != '')
  $full_pre_add .= $pre_village . ', ';

if($pre_rode != '')
  $full_pre_add .= $pre_rode . ', ';

if($pre_up_th != '')
  $full_pre_add .= $pre_up_th . ', ';

if($pre_district != '' && $pre_division != '' && $pre_division != $pre_district)
  $full_pre_add .= $pre_district . ', ';
else if($pre_district != '')
  $full_pre_add .= $pre_district;

if($pre_division != '' && $pre_division != $pre_district)
  $full_pre_add .= $pre_division;
//END- generate a string for present address

$per_village  = $info->per_village_house;
$per_village_bn = $info->per_village_house_bn;
$per_rode     = $info->per_road_block;
$per_rode_bn  = $info->per_road_block_bn;
$per_division = $info->per_div_name;
$per_district = $info->per_district_name;
$per_up_th    = $info->per_up_th_name;
$per_po       = $info->per_post_office;

//generate a string for permanent addresss
$full_perm_addre = '';

if($per_village != '')
  $full_perm_addre .= $per_village . ', ';

if($per_rode != '')
  $full_perm_addre .= $per_rode . ', ';

if($per_up_th != '')
  $full_perm_addre .= $per_up_th . ', ';

if($per_district != '' && $per_division != '' && $per_division != $per_district)
  $full_perm_addre .= $per_district . ', ';
else if($per_district != '')
  $full_perm_addre .= $per_district;

if($per_division != '' && $per_division != $per_district)
  $full_perm_addre .= $per_division;
//END- generate a string for permanent address

$scout_designation = $info->scout_designation;
$curr_institute = $info->institute_name;
$curr_class     = $info->curr_class;
$curr_role_no   = $info->curr_role_no;



$last_update = $info->last_login !='' ? date('d F, Y', $info->last_login): '';
$created_date = $info->created_on !='' ? date('d F, Y', $info->created_on): '';

$is_verify = $info->is_verify;
$sc_join_date = $info->join_date !='0000-00-00' ? date('d F, Y', strtotime($info->join_date)): '';
$sc_section_name = $info->sc_section_id;
$section_name = get_scout_section($info->sc_section_id);
$sc_region_name = $info->region_name;
$sc_district_name = $info->dis_name;
$sc_upazila_name = $info->upa_name;
$sc_group_name = $info->grp_name;
$sc_unit_name = $info->unit_name;
$sc_badge_id = $info->sc_badge_id;

$sc_cub   = $info->sc_cub =='Yes'? $info->sc_cub:'No';
$sc_scout = $info->sc_scout =='Yes'? $info->sc_scout:'No';
$sc_rover = $info->sc_rover =='Yes'? $info->sc_rover:'No';

$sc_badge_name = $info->badge_type_name_bn;
$sc_role_name = $info->role_type_name_bn;

$profile_img = $info->profile_img;
$path = base_url().'profile_img/';
if($profile_img != NULL){
  $img_url = $path.$profile_img;
}else{
  $img_url = $path.'no-img.png';
}

//qr code text
$qr_code_text = 'Name: ' . $info->first_name . ' ('. $info->scout_id .')';
?>     
<style type="text/css">
  .info{margin-left: 25px; color: black;}
  .dt_label{margin-left: 10px; width: 150px; display: block; float: left; color: #796b6b;}
  .dt_data{margin-left: 20px; color: black;}
</style>
<style type="text/css">
  .card7{background-color: #7030a0;border-top: 4px solid #1aa326;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);border:none;
  }
  .card27{background-color: #ffffff;border: px solid #7030a0;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  }
  .header7{width: 100%;padding: 13px 0;background-color: #7030a0;}
  .divider27{width: 80%;padding: 7px;background-color: #ffffff;margin: -10px auto;display: block;}
  /*.logo7 img{margin: 0 auto;display: block;padding: 20px;}*/
  .divider7{width: 100%;border: 2px solid #1aa326;margin-top: ;}
  .divider8{width: 100%;border: 2px solid #7030a0;margin-top: ;}
  .card-info7{background-image: url('awedget/assets/img/transprent_logo.png');background-repeat: no-repeat;background-position: center;  background-size: 105px;}
  .footer7{width: 100%;color: #ffffff;padding-bottom: 3px;text-align: center;font-size: 15px;background-color: #7030a0;}
  .id_card{margin: 0px 5px 0px 5px; color: black; font-size: 11px;}
  .table-bordered tr.bg-success th{ background-color: #a7afaf !important; color:#ffffff;}
  .semi-bold{ color:#0aa699;margin-top: 15px}
  /*.id_card tr{margin: 0px 5px 0px 5px;}*/
  /*.id_card th{width: 93px; text-align: right; padding-bottom: 6px; vertical-align: top}
  .id_card td{padding-left: 10px;padding-bottom: 6px; }*/
</style>

<div class="page-content"> 
  <div class="content">  

    <!-- <div class="row">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="item active">
            <img src="https://www.w3schools.com/bootstrap/chicago.jpg" alt="Los Angeles" style="width:100%;">
          </div>
          <div class="item">
            <img src="https://www.w3schools.com/bootstrap/ny.jpg" alt="Chicago" style="width:100%;">
          </div>
          <div class="item">
            <img src="https://www.w3schools.com/bootstrap/la.jpg" alt="New York" style="width:100%;">
          </div>
        </div>
      </div>
    </div> -->


    <div class="row">
      <div class="col-md-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
          <?php 
            $slid = 0; 
            foreach ($slider as $slide) { 
              $slid++;
              $img_path = base_url().'slider_img/';
              if($slide->image_file != NULL){
                $src= $img_path.$slide->image_file;
                // echo "<img src='$src'>";
              }
            ?>          
            <div class="item <?=$slid == 1?'active':''?>">
              <img src="<?=$src?>" alt="Slider" style="width:100%;">
              <!-- <div class="carousel-caption">
                <h3>Los Angeles</h3>
                <p>LA is always so much fun!</p>
              </div> -->
            </div>
          <?php } ?>            
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div> <!-- /carousel -->
        <!-- <div class=" tiles white col-md-12 no-padding">
          <div class="tiles green cover-pic-wrapper">           
            <div class="overlayer bottom-right"> </div>
            <img src="<?=base_url('awedget/assets/img/cover_pic.png')?>" alt="">
          </div>
        </div> -->
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">      
        <div class="tiles white">
          <div class="row">
            <div class="col-md-2 col-sm-2" style="margin:0 20px;">
              <div class="user-profile-pic"> <img style="max-height:150px; max-width: 150px; height: auto; " data-src-retina="<?=$img_url?>" data-src="<?=$img_url?>" src="<?=$img_url?>" alt=""></div>
              <?php if($scout_id != NULL){ ?>
              <div class="user-mini-description"  style="font-size: 150%;"><h2 class="text-success semi-bold"> BS ID</h2></div>
              <div class="user-mini-description" style="font-size: 150%;"><h2 class="text-success semi-bold" ><?=$scout_id;?> </h2></div>
              <?php } ?>
            </div>
            <div class="col-md-9 user-description-box col-sm-9">
              <div class="row">
                <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                     <?php echo $this->session->flashdata('success');;?>
                  </div>
                <?php endif; ?>
              </div>
              <div class="row">
                <div class="pull-left" style="width: 60%; border:0px solid red;">
                  <h4 class="semi-bold no-margin" ><?=$name;?></h4>
                  <h6 class="no-margin" style="font-weight: bold;"><?=$info->member_type_name;?></h6>  
                </div>              

                <div class="pull-right">    
                    <?php if($scout_id != NULL){ ?>
                    <a href="<?=base_url('my_profile/id_card')?>" class="btn btn-blueviolet btn-xs btn-mini"><i class="fa fa-download"></i> Scout ID Card</a>   
                    <?php } ?>       
                    <a href="<?=base_url('my_profile/change_image')?>" class="btn btn-blueviolet btn-xs btn-mini"><i class="fa fa-user"></i> Change Image</a>
                    <a href="<?=base_url('my_profile/change_username')?>" class="btn btn-blueviolet btn-xs btn-mini"><i class="fa fa-refresh"></i> Change Username</a>
                    <a href="<?=base_url('my_profile/change_password')?>" class="btn btn-blueviolet btn-xs btn-mini"><i class="fa fa-key"></i> Change Password</a>
                </div>
              </div>
                            
              <div class="row" style="margin-top: 20px;">
                <div class="col-md-6">
                  <p><i class="fa fa-circle"></i>Login Username or Email <br>
                    <span class="info"><?=$username?></span> </p>                  
                  <p><i class="fa fa-circle"></i> Date of Birth <br>
                    <span class="info"><?=$dob?></span> </p>
                  <p><i class="fa fa-circle"></i>Last Login <br> 
                    <span class="info"><?=$last_update?></span> </p>
                </div>
                <div class="col-md-6">
                  <p><i class="fa fa-globe"></i>Online Join Date <br> 
                    <span class="info"><?=$created_date?></span> </p>
                  <p><i class="fa fa-globe"></i>Scout Group Name <br>
                    <span class="info"><?=$sc_group_name?></span> </p>
                  <p><i class="fa fa-globe"></i>Scout Region  <br>
                    <span class="info"><?=$sc_region_name?></span> </p>                  
                </div>
              </div>
            </div>            

          </div> <!--/row -->
          
          <?php if(!$this->ion_auth->is_guest()){ ?>
          <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-tabs" id="tab-01">
                <li class="active"><a href="#tab_basic">Basic</a></li>
                <li><a href="#tab_scouts">Scouts</a></li>
                <!-- <li><a href="#tab_progress">My Progress</a></li> -->
                <li><a href="#achievement">Achievement</a></li>
                <li><a href="#tab_education">Education</a></li>
                <li><a href="#activities">Activities</a></li>
                <!-- <li><a href="#tab_training">Training</a></li>
                <li><a href="#tab_events">Events</a></li>
                <li><a href="#tab_award">Award</a></li> -->
                <li><a href="#tab_blood_donation">Blood Donation</a></li>
                <li class=""><a href="#tab_id_card" style="display: none;">ID Card</a></li>
                <!-- <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown"  href="javascript:;"> Setting <b class="caret"></b> </a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Download as PDF</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="text-error">Disable Account</a></li>
                  </ul>
                </li> -->
              </ul>

              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_basic">
                  <div class="row column-seperation">
                    <div class="col-md-12" style="margin-bottom: 20px;">
                      <h3><span class="semi-bold pull-left">Basic Information</span> </h3>
                      <div class="pull-right">
                         <a href="<?=base_url('my_profile/update_basic_info')?>" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i> Update Basic Info</a> 
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <p> <span class="dt_label">Full Name</span>
                        <span class="dt_data"><?=$name?></span> </p>
                      <p> <span class="dt_label">Full Name (Bangla)</span>
                        <span class="dt_data"><?=$name_bn?></span> </p>
                      <p> <span class="dt_label">Father's Name</span>
                        <span class="dt_data"><?=$father?></span> </p>
                      <p> <span class="dt_label">Father's Name (Bangla)</span>
                        <span class="dt_data"><?=$father_bn?></span> </p>
                      
                      <p> <span class="dt_label">Mother's Name</span>
                        <span class="dt_data"><?=$mother?></span> </p> 
                      <p> <span class="dt_label">Mother's Name (Bangla)</span>
                        <span class="dt_data"><?=$mother_bn?></span> </p>
                      <p> <span class="dt_label">Gender </span>
                        <span class="dt_data"><?=$info->gender?></span> </p>
                      <p> <span class="dt_label">Religion </span>
                        <span class="dt_data"><?=get_religion($info->religion_id)?></span> </p>
                      <p> <span class="dt_label">Date of Birth </span>
                        <span class="dt_data"><?=$dob?></span> </p>
                      
                      <p> <span class="dt_label">Blood Group </span>
                        <span class="dt_data"><?=$blood_group?></span> </p>
                      <p> <span class="dt_label">National ID</span> 
                        <span class="dt_data"><?=$nid?></span> </p>
                      <p> <span class="dt_label">Passport No</span> 
                        <span class="dt_data"><?=$passport_no?></span> </p>  
                      <p> <span class="dt_label">Birth ID</span>
                        <span class="dt_data"><?=$birth_id?></span> </p>
                      
                      <p> <span class="dt_label">Mobile Number</span> 
                        <span class="dt_data"><?=$phone?></span> </p>
                      <p> <span class="dt_label">Phone Number</span> 
                        <span class="dt_data"><?=$phone2?></span> </p>
                      <p> <span class="dt_label">Emergency Phone No</span> 
                        <span class="dt_data"><?=$emergency_phone?></span> </p>
                      <p> <span class="dt_label">Email Address</span>
                        <span class="dt_data"><?=$email?></span> </p>

                      <p> <span class="dt_label">Occupation </span>
                        <span class="dt_data"><?= empty($info->occp_others)?$info->occupation_name:$info->occp_others?></span> </p>
                      
                      <h5> <span class="dt_label"><b>Passport Information</b></span> 
                        <span class="dt_data">: :</span></h5>
                      <p> <span class="dt_label">Passport No</span>
                        <span class="dt_data"><?=$passport_no?></span> </p>
                      <p> <span class="dt_label">Date of Issue</span>
                        <span class="dt_data"><?=$passport_date_issue != NULL ? date_bangla_format($passport_date_issue):'';?></span> </p>
                      <p> <span class="dt_label">Date of Expiry</span>
                        <span class="dt_data"><?=$passport_date_expiry != NULL ? date_bangla_format($passport_date_expiry):'';?></span> </p>
                      <p> <span class="dt_label">Place of Issue</span>
                        <span class="dt_data"><?=$passport_place_issue?></span> </p>
                      <p> <span class="dt_label">Place of Birth</span>
                        <span class="dt_data"><?=$passport_place_birth?></span> </p>
                    </div>
                    <div class="col-md-6">

                      <h5> <span class="dt_label"><b>Present Address</b></span>
                        <span class="dt_data">: :</span></h5> 
                      <p> <span class="dt_label">Village/House (EN)</span>
                        <span class="dt_data"><?=$pre_village?></span></p>
                      <p> <span class="dt_label">Village/House (BN)</span>
                        <span class="dt_data"><?=$pre_village_bn?></span></p>
                      <p> <span class="dt_label">Road/Block (EN)</span>
                        <span class="dt_data"><?=$pre_rode?></span></p>    
                      <p> <span class="dt_label">Road/Block (BN)</span>
                        <span class="dt_data"><?=$pre_rode_bn?></span></p>   
                      <p> <span class="dt_label">Division </span>
                        <span class="dt_data"><?=$pre_division?></span></p>
                      <p> <span class="dt_label">District </span>
                        <span class="dt_data"><?=$pre_district?></span></p>
                      <p> <span class="dt_label">Upazilla / Thana</span>
                        <span class="dt_data"><?=$pre_up_th?></span> </p>
                      <p> <span class="dt_label">Post Office</span>
                        <span class="dt_data"><?=$pre_po?></span> </p>

                     <h5> <span class="dt_label"><b>Permanent Address</b></span> 
                        <span class="dt_data">: :</span></h5>
                      <p> <span class="dt_label">Village/House (EN)</span>
                        <span class="dt_data"><?=$per_village?></span></p>
                      <p> <span class="dt_label">Village/House (BN)</span>
                        <span class="dt_data"><?=$per_village_bn?></span></p>
                      <p> <span class="dt_label">Road/Block (EN)</span>
                        <span class="dt_data"><?=$per_rode?></span></p>
                      <p> <span class="dt_label">Road/Block (BN)</span>
                        <span class="dt_data"><?=$per_rode_bn?></span></p>    
                      <p> <span class="dt_label">Division </span>
                        <span class="dt_data"><?=$per_division?></span></p>
                      <p> <span class="dt_label">District </span>
                        <span class="dt_data"><?=$per_district?></span></p>
                      <p> <span class="dt_label">Upazilla / Thana</span>
                        <span class="dt_data"><?=$per_up_th?></span> </p>
                      <p> <span class="dt_label">Post Office</span>
                        <span class="dt_data"><?=$per_po?></span> </p>

                      <p> <span class="dt_label">Created Date</span>
                        <span class="dt_data"><?=$created_date?></span> </p>
                      <p> <span class="dt_label">Last Update </span>
                        <span class="dt_data"><?=$last_update?></span> </p>
                     
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="tab_scouts">
                  <div class="row column-seperation">
                    <div class="col-md-12" style="margin-bottom: 20px;">
                      <h3><span class="semi-bold pull-left">Current Scouts Information</span> </h3>
                      <!-- <a href="<?=base_url('my_profile/update')?>" class="btn btn-primary btn-xs btn-mini pull-right"><i class="fa fa-edit"></i> Update Scout Info</a>    -->                   
                    </div>
                    
                    <div class="col-md-12">
                      <p> <span class="dt_label">Scout ID</span> 
                        <span class="dt_data"><?=$scout_id?></span> </p>
                      <p> <span class="dt_label">Member Type</span> 
                        <span class="dt_data"><?=$info->member_type_name;?></span> </p>
                      <p> <span class="dt_label">Scout Section</span>
                        <span class="dt_data"><?=$section_name?></span> </p>
                      <p> <span class="dt_label">Date of Joining</span>
                        <span class="dt_data"><?=$sc_join_date?></span> </p>
                      <p> <span class="dt_label">Scout Badge  </span>
                        <span class="dt_data"><?=$sc_badge_name?></span> </p>
                      <p> <span class="dt_label">Scout Role </span>
                        <span class="dt_data"><?=$sc_role_name?></span> </p>
                      <p> <span class="dt_label">Unit Name </span>
                        <span class="dt_data"><?=$sc_unit_name?></span> </p>
                      <p> <span class="dt_label">Group Name </span>
                        <span class="dt_data"><?=$sc_group_name?></span> </p>
                      <p> <span class="dt_label">Upazila </span>
                        <span class="dt_data"><?= $sc_upazila_name?></span> </p>
                      <p> <span class="dt_label">District </span>
                        <span class="dt_data"><?= $sc_district_name?></span> </p>
                      <p> <span class="dt_label">Region </span>
                        <span class="dt_data"><?= $sc_region_name?></span> </p>
                      <p> <span class="dt_label">Scout Designation </span>
                        <span class="dt_data"><?=$scout_designation?></span> </p>
                      <p> <span class="dt_label">Current Institute </span>
                        <span class="dt_data"><?=$curr_institute?></span> </p>
                      <p> <span class="dt_label">Current Class </span>
                        <span class="dt_data"><?=$curr_class?></span> </p>
                      <p> <span class="dt_label">Current Roll No </span>
                        <span class="dt_data"><?=$curr_role_no?></span> </p>
                    </div>
                    <!-- <div class="col-md-6">
                      <p> <span class="dt_label">Cub Scouts Experience </span>
                        <span class="dt_data"><?=$sc_cub?></span> </p>
                      <p> <span class="dt_label">Scouts Experience </span>
                        <span class="dt_data"><?=$sc_scout?></span> </p>
                      <p> <span class="dt_label">Rover Scouts Experience </span>
                        <span class="dt_data"><?=$sc_rover?></span> </p>
                      
                    </div> -->

                    
                  <?php if($info->sc_cub == 'Yes'){ ?>
                    <div class="col-md-12" style="margin-bottom: 20px;">
                      <h3><span class="semi-bold pull-left">Cub Scouts Experience</span> </h3>
                      <?php /* ?>
                      <?php if($sc_cub=='Yes'){?>
                      <a href="<?=base_url('my_profile/cub_experience/'.$info->id)?>" class="btn btn-primary btn-xs btn-mini pull-right"> Update</a> 
                      <?php } ?>
                      <?php */ ?>
                    </div>
                 
                    
                    <div class="col-md-12">
                      <p> <span class="dt_label">Scout Section</span>
                        <span class="dt_data">Cub Scout</span> </p>
                      <p> <span class="dt_label">Cub Scouts Experience</span>
                        <span class="dt_data"><?=$sc_cub?></span> </p>
                      <?php if(!empty($cub_info)){ ?>
                      <p> <span class="dt_label">Date of Joining</span>
                        <span class="dt_data"><?=$cub_info->join_date?></span> </p>
                      <p> <span class="dt_label">Scout Badge  </span>
                        <span class="dt_data"><?=$cub_info->badge_type_name_bn?></span> </p>
                      <p> <span class="dt_label">Scout Role </span>
                        <span class="dt_data"><?=$cub_info->role_type_name_bn?></span> </p>
                      <p> <span class="dt_label">Unit Name </span>
                        <span class="dt_data"><?=$cub_info->unit_name?></span> </p>
                      <p> <span class="dt_label">Group Name </span>
                        <span class="dt_data"><?=$cub_info->grp_name?></span> </p>
                      <p> <span class="dt_label">Upazila </span>
                        <span class="dt_data"><?= $cub_info->upa_name?></span> </p>
                      <p> <span class="dt_label">District </span>
                        <span class="dt_data"><?= $cub_info->dis_name?></span> </p>
                      <p> <span class="dt_label">Region </span>
                        <span class="dt_data"><?= $cub_info->region_name?></span> </p>
                      <?php } ?>
                    </div>

                <?php } ?>
                <?php if($info->sc_scout == 'Yes'){ ?>
                     <div class="col-md-12" style="margin-bottom: 20px;">
                      <h3><span class="semi-bold pull-left">Scouts Experience</span> </h3>
                      <?php if($sc_scout=='Yes'){?>
                      <a href="<?=base_url('my_profile/scout_experience/'.$info->id)?>" class="btn btn-primary btn-xs btn-mini pull-right"> Update</a> 
                      <?php } ?>

                    </div>
                    
                    <div class="col-md-12">
                      <p> <span class="dt_label">Scout Section</span>
                        <span class="dt_data">Scout</span> </p>
                      <p> <span class="dt_label">Scout Experience</span>
                        <span class="dt_data"><?=$sc_scout?></span> </p>
                      <?php if(!empty($scout_info)){ ?>
                      <p> <span class="dt_label">Date of Joining</span>
                        <span class="dt_data"><?=$scout_info->join_date?></span> </p>
                      <p> <span class="dt_label">Scout Badge  </span>
                        <span class="dt_data"><?=$scout_info->badge_type_name_bn?></span> </p>
                      <p> <span class="dt_label">Scout Role </span>
                        <span class="dt_data"><?=$scout_info->role_type_name_bn?></span> </p>
                      <p> <span class="dt_label">Unit Name </span>
                        <span class="dt_data"><?=$scout_info->unit_name?></span> </p>
                      <p> <span class="dt_label">Group Name </span>
                        <span class="dt_data"><?=$scout_info->grp_name?></span> </p>
                      <p> <span class="dt_label">Upazila </span>
                        <span class="dt_data"><?= $scout_info->upa_name?></span> </p>
                      <p> <span class="dt_label">District </span>
                        <span class="dt_data"><?= $scout_info->dis_name?></span> </p>
                      <p> <span class="dt_label">Region </span>
                        <span class="dt_data"><?= $scout_info->region_name?></span> </p>
                      <?php } ?>
                    </div>

                <?php } ?>
                <?php if($info->sc_rover == 'Yes'){ ?>

                     <div class="col-md-12" style="margin-bottom: 20px;">
                      <h3><span class="semi-bold pull-left">Rover Scouts Experience</span> </h3>
                      <?php if($sc_rover=='Yes'){?>
                      <a href="<?=base_url('my_profile/rover_experience/'.$info->id)?>" class="btn btn-primary btn-xs btn-mini pull-right"> Update</a> 
                      <?php } ?>

                    </div>
                    
                    <div class="col-md-12">
                      <p> <span class="dt_label">Scout Section</span>
                        <span class="dt_data">Rover Scout</span> </p>
                      <p> <span class="dt_label">Rover Scouts Experience</span>
                        <span class="dt_data"><?=$sc_rover?></span> </p>
                      <?php if(!empty($rover_info)){ ?>
                      <p> <span class="dt_label">Date of Joining</span>
                        <span class="dt_data"><?=$rover_info->join_date?></span> </p>
                      <p> <span class="dt_label">Scout Badge  </span>
                        <span class="dt_data"><?=$rover_info->badge_type_name_bn?></span> </p>
                      <p> <span class="dt_label">Scout Role </span>
                        <span class="dt_data"><?=$rover_info->role_type_name_bn?></span> </p>
                      <p> <span class="dt_label">Unit Name </span>
                        <span class="dt_data"><?=$rover_info->unit_name?></span> </p>
                      <p> <span class="dt_label">Group Name </span>
                        <span class="dt_data"><?=$rover_info->grp_name?></span> </p>
                      <p> <span class="dt_label">Upazila </span>
                        <span class="dt_data"><?= $rover_info->upa_name?></span> </p>
                      <p> <span class="dt_label">District </span>
                        <span class="dt_data"><?= $rover_info->dis_name?></span> </p>
                      <p> <span class="dt_label">Region </span>
                        <span class="dt_data"><?= $rover_info->region_name?></span> </p>
                      <?php } ?>
                    </div>
                <?php } ?>
                  </div>
                </div>                

                <div class="tab-pane" id="achievement">
                  <div class="row">
                    <div class="col-md-12">
                    <h3><span class="semi-bold">Achievement</span></h5>

                    <table class="profile_table" width="100%">
                      <caption>Training</caption>
                      <tr>
                         <th width="10">SL</th>
                         <th>Training Name</th>
                         <th>Course Name</th>
                         <th>Course Number</th>
                         <th width="90">Start Date</th>
                         <th width="90">End Date</th>
                         <th width="110">Certificate No</th>
                         <th width="100">Issue Date</th>
                      </tr>
                          <?php 
                            $i=0;
                            foreach ($trainings as $row) {
                              $i++; 
                          ?>
                          <tr>
                            <td><?=$i?></td>
                            <td><?=$row->training_name?></td>
                            <td><?=$row->course_id == 100 ? $row->other_course_name : $row->course_name?></td>
                            <td><?=$row->course_number?></td>
                            <td><?=date_bangla_format($row->start_date)?></td>
                            <td><?=date_bangla_format($row->end_date)?></td>
                            <td><?=$row->certificate_no?></td>
                            <td><?=date_bangla_format($row->issue_date)?></td>
                          </tr>
                          <?php } ?>  
                    </table>

                    </br></br>
                    <?php /*
                    <table class="profile_table" width="100%">
                      <caption>
                        Award Information 
                        <a href="<?=base_url('my_profile/update_award')?>" class="btn btn-primary btn-xs btn-mini pull-right"><i class="fa fa-edit"></i> Update Award Info</a>
                      </br>
                      </caption>
                         <tr class="bg-success">
                            <th width="250" class="text-center">Award Name</th>
                            <th width="200" class="text-center">Certificate No</th>
                            <th width="200" class="text-center">Achived Date</th>
                         </tr>
                         <?php foreach ($my_award as $row) { ?>
                         <tr>
                          <td class="text-center"><?= $row->award_name; ?></td>
                          <td class="text-center"><?=$row->certificate_no?></td>
                          <td class="text-center"><?=date_bangla_format($row->achived_date)?></td>
                        <?php } ?>
                     </table>
                    */ ?>

                    </div>
                  </div>                        
                </div>

                <div class="tab-pane" id="tab_education">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>
                          <span class="semi-bold">Education/Academic Information</span> 
                          <a href="<?=base_url('my_profile/update_education')?>" class="btn btn-primary btn-xs btn-mini pull-right"><i class="fa fa-edit"></i> Update Education Info</a>
                      </h3>
                    
                      <table class="profile_table" width="100%">
                           <tr class="bg-success">
                              <th width="5%" class="text-left">SL</th>
                              <th width="30%" class="text-left">Education / Exam</th>
                              <th width="40%" class="text-left">Institute / University / Board</th>
                              <th width="20%" class="text-left">Result</th>
                              <th width="30%" class="text-center">Passing Year</th>
                           </tr>
                           <?php 
                           $sl=0;
                           foreach ($my_education as $row) { 
                            $sl++;
                          ?>
                           <tr>
                            <td><?=$sl?></td>
                            <td><?=$row->edu_level_name; ?></td>
                            <td><?=$row->institute_board?></td>
                            <td><?=$row->result?></td>
                            <td class="text-center"><?=$row->pass_year?></td>
                          <?php } ?>
                       </table>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="tab_training">
                  <div class="row">
                    <div class="col-md-12">
                    <h3><span class="semi-bold">My Training Information</span> </h3>
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-success">
                            <th style="width:2%"> SL </th>
                            <th style="width:38%">Training Name</th>
                            <th style="width:15%">From Date</th>
                            <th style="width:15%">To Date</th>
                            <th style="width:15%">Duration</th>
                            <th style="width:15%">Type</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(!empty($training)){
                            $i=0;
                            foreach ($training as $row) {
                              ?>
                            <tr>
                              <td class="v-align-middle"><?=++$i?></td>
                              <td class="v-align-middle"><?php echo $this->Common_model->explote_array($this->Common_model->get_dd_training_list(),$row->training_name);?></td>
                              <td class="v-align-middle"><?=date_bangla_format($row->training_start_date)?></td>
                              <td class="v-align-middle"><?=date_bangla_format($row->training_end_date)?></td>
                              <td class="v-align-middle"><?=$row->training_duration?></td>
                              <td class="v-align-middle"><?=$row->training_type?></td>
                            </tr>
                              <?php
                            }
                          }?>
                        
                        </tbody>
                      </table>
                    </div>
                  </div>                        
                </div>

                <div class="tab-pane" id="tab_events">
                  <div class="row">
                    <div class="col-md-12">
                    <h3><span class="semi-bold">My Events Information</span> </h3>
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-success">
                            <th style="width:2%"> SL </th>
                            <th style="width:38%">Event Name</th>
                            <th style="width:15%">Venu</th>
                            <th style="width:15%">From Date</th>
                            <th style="width:15%">To Date</th>
                            <th style="width:15%">Event Type</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(!empty($event)){
                            $i=0;
                            foreach ($event as $row) {
                              ?>
                            <tr>
                              <td class="v-align-middle"><?=++$i?></td>
                              <td class="v-align-middle"><?=$row->event_title?></td>
                              <td class="v-align-middle"><?=$row->event_venu?></td>
                              <td class="v-align-middle"><?=date_bangla_format($row->event_start_date)?></td>
                              <td class="v-align-middle"><?=date_bangla_format($row->event_end_date)?></td>
                              <td class="v-align-middle"><?=$row->event_type?></td>
                            </tr>
                              <?php
                            }
                          }?>
                        
                        </tbody>
                      </table>
                    </div>
                  </div>                        
                </div> 

                <div class="tab-pane" id="activities">
                  <div class="row">
                    <div class="col-md-12">
                    <h3><span class="semi-bold">Activities</span></h5>


                    </br></br>

                      <table class="profile_table" width="100%">
                      <caption>ক্যাম্প রেকর্ডের বিবরণ</caption>
                         <tr class="bg-success">
                            <th>ক্রম</th>
                            <th>সেকসন</th>
                            <th>ক্যাম্পের নাম</th>
                            <th>স্থান</th>
                            <th>সনদ নং</th>
                            <th>ক্যাম্প তারিখ</th>
                            <th>মূল্যায়নকারী</th>
                            <th>যাচাইকারী</th>
                         </tr>
                         <?php for($i=0;$i<sizeof($camping);$i++){ ?>
                      
                          <tr>
                            <td><?=$i+1?></td>
                            <td><?=get_scout_section($camping[$i]->section_id); ?></td>
                            <td><?=$camping[$i]->camp_name; ?></td>
                            <td><?=$camping[$i]->area; ?></td>
                            <td><?=$camping[$i]->certificate_no; ?></td>
                            <td><?=date_bangla_format($camping[$i]->camp_date); ?></td>
                            <td><?=$camping[$i]->examiner_id; ?></td>
                            <td><?=$camping[$i]->scout_id; ?></td>
                            
                          </tr>
                          <?php } ?>  
                    </table>

                    </br></br>

                    
                    <table class="profile_table" width="100%">
                      <caption>প্রশিক্ষণ রেকর্ডের বিবরণ</caption>
                         <tr class="bg-success">
                            <th>ক্রম</th>
                            <th>সেকসন</th>
                            <th>ব্যাজ</th>
                            <th>প্রশিক্ষণের নাম</th>
                            <th>সনদ নং</th>
                            <th>প্রশিক্ষণের তারিখ</th>
                            <th>মূল্যায়নকারী</th>
                            <th>যাচাইকারী</th>
                         </tr>
                         <?php for($i=0;$i<sizeof($badge_training);$i++){ ?>
                      
                          <tr>
                            <td><?=$i+1?></td>
                            <td><?=get_scout_section($badge_training[$i]->section_id); ?></td>
                            <td><?=$badge_training[$i]->badge_type_name_bn; ?></td>
                            <td><?=$badge_training[$i]->training_name; ?></td>
                            <td><?=$badge_training[$i]->certificate_no; ?></td>
                            <td><?=date_bangla_format($badge_training[$i]->training_date); ?></td>
                            <td><?=$badge_training[$i]->examiner_id; ?></td>
                            <td><?=$badge_training[$i]->scout_id; ?></td>
                            
                          </tr>
                          <?php } ?>  
                    </table>

                    </br></br>

                    
                    <table class="profile_table" width="100%">
                      <caption>পদোন্নতির বিবরণ</caption>
                         <tr class="bg-success">
                            <th>ক্রম</th>
                            <th>সেকসন</th>
                            <th>রোল</th>
                            <th>পদোন্নতির শুরুর তারিখ</th>
                            <th>পদোন্নতির শেষ তারিখ</th>
                            <th>ব্যাজ</th>
                            <th>মূল্যায়নকারী</th>
                            <th>যাচাইকারী</th>
                         </tr>
                         <?php for($i=0;$i<sizeof($promotion);$i++){ ?>
                      
                          <tr>
                            <td><?=$i+1?></td>
                            <td><?=get_scout_section($promotion[$i]->section_id); ?></td>
                            <td><?=$promotion[$i]->role_type_name_bn; ?></td>
                            <td><?=date_bangla_format($promotion[$i]->from_date); ?></td>
                            <td><?=date_bangla_format($promotion[$i]->to_date); ?></td>
                            <td><?=$promotion[$i]->badge_type_name_bn; ?></td>
                            <td><?=$promotion[$i]->examiner_id; ?></td>
                            <td><?=$promotion[$i]->scout_id; ?></td>
                            
                          </tr>
                          <?php } ?>  
                    </table>


                    </div>
                  </div>                        
                </div>               

                <div class="tab-pane" id="tab_award">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>
                          <span class="semi-bold">My Achived Award Information</span> 
                          <a href="<?=base_url('my_profile/update_award')?>" class="btn btn-primary btn-xs btn-mini pull-right"><i class="fa fa-edit"></i> Update Award Info</a>
                      </h3>
                    
                      <table width="70%"  class="table table-bordered">
                           <tr class="bg-success">
                              <th width="250" class="text-center">Award Name</th>
                              <th width="200" class="text-center">Certificate No</th>
                              <th width="200" class="text-center">Achived Date</th>
                           </tr>
                           <?php foreach ($my_award as $row) { ?>
                           <tr>
                            <td class="text-center"><?= $row->award_name; ?></td>
                            <td class="text-center"><?=$row->certificate_no?></td>
                            <td class="text-center"><?=date_bangla_format($row->achived_date)?></td>
                          <?php } ?>
                       </table>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="tab_blood_donation">
                  <div class="row column-seperation">
                    <div class="col-md-12" style="margin-bottom: 20px;">
                      <h3><span class="semi-bold pull-left">Blood Donation Information</span> </h3>
                      <a href="<?=base_url('my_profile/update_donation')?>" class="btn btn-primary btn-xs btn-mini pull-right"><i class="fa fa-edit"></i> Update Blood Donation</a>                      
                    </div>
                    
                    <div class="col-md-6">
                      <p> <span class="dt_label">Blood Group</span> 
                        <span class="dt_data"><?=$blood_group?></span> </p>
                      <p> <span class="dt_label">Donate Interested</span>
                        <span class="dt_data"><?=$info->blood_donate_interested?></span> </p>
                      <p> <span class="dt_label">Last Donate Date</span>
                        <span class="dt_data"><?=date_detail_format($info->last_donate_date)?></span> </p>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="tab_id_card" style="display: none;">
                  <!-- <a href="<?php echo base_url('pdf/Idcard_pdf'); ?>" class="btn btn-primary btn-xs btn-mini pull-right"><i class="fa fa-building-o"></i> Generate PDF</a> -->
                  <div class="row">
                    <div class="col-md-5">
                      <div class="card7" style="width: 315px; height: 179px font-family: 'Open Sans';">
                        <div>
                          <div style="float: left;margin:5px 10px 0px 15px;"> <img src="fwedget/assets/images/scout_logo.png" height="40"></div>                          
                          <div class="pull-right" style="margin:8px 10px 0px 15px;"><p class="img-thu" class="rounded" style="height: 37px; width: 32px; color: white; padding-top: 10px; font-size: 16px; text-align: center; background-image: url(<?= base_url('awedget/assets/img/blooddrop.png')?>); background-repeat: no-repeat;"><?= $info->bg_name_en ?></p></div>
                        </div>
                        <div  style="clear: both;"></div>
                        <?php
                        if($sc_district_name !=NULL){
                          $exp = explode(',', $sc_district_name);
                          $exp = $exp[1];
                        }else{
                          $exp = '';
                        }

                        ?>
                          <div style="margin:0px 10px 3px 60px; color: white; clear: both;"><?=$exp?></div>

                        <div  style="clear: both;"></div>

                        <!-- <div class="logo7"><img src="awedget/assets/img/scout_logo.png" style="height: 40px; width: 260px; margin: 5px 0;"></div> -->
                        <div class="" style="overflow: hidden; margin: 0 20px;" >
                        
                        
                          </div>
                        <div class="divider7"></div>

                        <div style="color: black; background-color: white; font-size: 15px; text-align: center; padding: 5px 0px 0px 0px;"><b>Bangladesh Scout ID: <?=$info->scout_id?> </b></div>
                        
                        <div class="card-info7" style="padding: 7px 20px ; font-size: 10px; background-color: #ffffff;">
                          <div class="row row-form">
                            <div style="width: 100%;">
                              <div style="clear: both;"></div>
                              <div style="width: 16%; float: left;">
                                <img src="<?= $img_url ?>" class="img-thu rounded" style="height: 50px; width: 100%;" >
                              </div>
                              <div style="width: 69%; float: left;">
                                <table class="id_card">
                                  <tr>
                                    <th>Name:</th>
                                    <td><b><?=$info->first_name?></b></td>
                                  </tr>
                                  <!-- <tr>
                                    <th>Name (Bangla):</th>
                                    <td><?=$info->full_name_bn?></td>
                                  </tr> -->
                                  <tr>
                                    <th>Father Name:</th>
                                    <td><?=$info->father_name?></td>
                                  </tr>
                                  <tr>
                                    <th>Mother Name:</th>
                                    <td><?=$info->mother_name?></td>
                                  </tr>
                                  <tr>
                                    <th>Date of Birth:</th>
                                    <td><?= date('d F, Y', strtotime($info->dob))?></td>
                                  </tr>
                                  <tr>
                                    <th>Member Since:&nbsp;</th>
                                    <td><?= date('d F, Y', strtotime($info->join_date)) ?></td>
                                  </tr>
                                </table>
                              </div>
                              <div style="width: 15%; float: left; padding-top: 15px;">
                                <div id="qrcode" style="width: 100%;"></div>
                              </div>
                            </div>
                            
                          </div>
                        </div>  
                        <div class="divider8"></div>
                        <!-- <div class="footer7"><span class="text-center">www.scout.gov.bd</span></div> -->
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="card7" style="width: 315px; height: 179px; font-family: 'Open Sans';">
                        <div class="header7"></div>
                        <div class="divider27"></div>
                        <div class="card-info7" style="padding-top: -15px; font-size: 10px; background-color: #ffffff; height: 155px;">
                          <!-- <h3 class="text-center" style="font-size: bold;">Instructions</h3> -->
                          <div style="padding: 10px 20px;; font-size: bold; color: black; font-size: 12px;">
                            <span class="justify-content-left"><b>Section: &nbsp;</b><?= $section_name ?></span> 
                            <br>
                            <span class="justify-content-left"><b>Institute Name: &nbsp;</b><?= $curr_institute ?></span> 
                            <br>
                            <span class="justify-content-left"><b>Group Name: &nbsp;</b><?= $sc_group_name ?></span> 
                            <br>
                            <span class="justify-content-left"><b>Present Address:</b> <?= $full_pre_add ?></span> <br>
                            <!-- <span class="justify-content-left"><b>Permanent Address:</b> <?= $full_perm_addre ?></span> <br> -->
                            <span class="justify-content-left" style="padding-left: 20%; padding-top: 10px; font-size: 10px;">If found, please return to BDSCOUT.</span> <br>
                            <!-- <span class="justify-content-left">This card is not transferable and if found please return it to the contact mentioned.</span> <br><br> -->
                            <!-- <span class="text-center" style="text-align: center;">Issue Date : 01-12-17</span> <br> -->
                            <span class="text-center" style="padding-left: 22%; padding-top: ; font-size: 10px;">Expire Date : 
                                <?php 
                                // echo date('Y-m-d', strtotime($info->join_date));
                                // echo $created_on = $info->created_on; 
                                 // echo $created_on = strtotime($info->created_on); 
                                  echo date_detail_format(date('Y-m-d', strtotime("+5 years", $info->created_on)));
                                ?>
                            </span> <br>
                            <!-- <span class="text-center">Preserve the card carefully.</span> -->
                          </div>
                          <!-- <div><img src="awedget/assets/img/signature.png" style="padding-bottom: 5px; padding-left:30px;"></div> -->
                        </div> 
                        <!-- <div class="divider8"></div> -->
                        <div class="footer7"><span class="text-center">scouts.gov.bd</span></div>
                        <input type="hidden" name="qr_code_text" id="qr_code_text" value="<?= $qr_code_text ?>">
                      </div>
                    </div>
                  </div>
                </div>

              </div> <!-- /tab-content -->
            </div> <!-- /end tab col -->
          </div>

          <?php } ?>

        </div> <!-- /tiles -->
      </div>
    </div> <!--/row -->

  </div>  <!--/content -->
</div>

<script type="text/javascript" src="<?= base_url('awedget/assets/js/qrcode.min.js') ?>"></script>

<script type="text/javascript">
  var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: $('#qr_code_text').val(),
    width: 35,
    height: 35,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
  });
</script>







<?php /*
  <!-- <div class="tab-pane" id="tab_progress">
    <div class="row">
      <div class="col-md-12">
      <h3><span class="semi-bold">My Progress</span></h5>

      </br></br>
      
      <table class="profile_table" width="100%">
        <caption>ব্যাজ অর্জনের বিবরণ</caption>
           <tr class="bg-success">
              <th>ক্রম</th>
              <th>সেকসন</th>
              <th>ব্যাজ</th>
              <th>বিবরণ</th>
              <th>অর্জনের তারিখ</th>
              <th>মূল্যায়নকারী</th>
              <th>যাচাইকারী</th>
           </tr>
           <?php for($i=0;$i<sizeof($badge_details);$i++){ ?>
        
            <tr>
              <td><?=$i+1?></td>
              <td><?=get_scout_section($badge_details[$i]->section_id); ?></td>
              <td><?=$badge_details[$i]->badge_type_name_bn; ?></td>
              <td><?=$badge_details[$i]->questions; ?></td>
              <td><?=date_bangla_format($badge_details[$i]->achive_date); ?></td>
              <td><?=$badge_details[$i]->examiner_id; ?></td>
              <td><?=$badge_details[$i]->scout_id; ?></td>
              
            </tr>
            <?php } ?>  
      </table>

      </br></br>

      
      <table class="profile_table" width="100%">
        <caption>পারদর্শিতা ব্যাজ অর্জনের বিবরণ</caption>
           <tr class="bg-success">
              <th>ক্রম</th>
              <th>সেকসন</th>
              <th>ব্যাজ</th>
              <th>গ্রউপ</th>
              <th>অর্জনের তারিখ</th>
              <th>অতিরিক্ত ব্যাজ </th>
              <th>মূল্যায়নকারী</th>
              <th>যাচাইকারী</th>
           </tr>
           <?php for($i=0;$i<sizeof($expertness);$i++){ ?>
        
            <tr>
              <td><?=$i+1?></td>
              <td><?=get_scout_section($expertness[$i]->section_id); ?></td>
              <td><?=$expertness[$i]->badge_type_name_bn; ?></td>
              <td><?=$expertness[$i]->expert_group_name; ?></td>
              <td><?=date_bangla_format($expertness[$i]->achive_date); ?></td>
              <td><?=$expertness[$i]->extra_badge; ?></td>
              <td><?=$expertness[$i]->examiner_id; ?></td>
              <td><?=$expertness[$i]->scout_id; ?></td>
              
            </tr>
            <?php } ?>  
      </table>

      </br></br>

      
      <table class="profile_table" width="100%">
        <caption>দীক্ষা / ব্যাজ অর্জনের তারিখ ও বিবরণ</caption>
           <tr class="bg-success">
              <th>ক্রম</th>
              <th>সেকসন</th>
              <th>ব্যাজ</th>
              <th>গ্রহণের তারিখ</th>
              <th>মূল্যায়নকারী</th>
              <th>যাচাইকারী</th>
           </tr>
           <?php for($i=0;$i<sizeof($achievement);$i++){ ?>
        
            <tr>
              <td><?=$i+1?></td>
              <td><?=get_scout_section($achievement[$i]->section_id); ?></td>
              <td><?=$achievement[$i]->badge_type_name_bn; ?></td>
              <td><?=date_bangla_format($achievement[$i]->achive_date); ?></td>
              <td><?=$achievement[$i]->examiner_id; ?></td>
              <td><?=$achievement[$i]->scout_id; ?></td>
              
            </tr>
            <?php } ?>  
      </table>

      </br></br>

      
      <table class="profile_table" width="100%">
        <caption>ক্যাম্প রেকর্ডের বিবরণ</caption>
           <tr class="bg-success">
              <th>ক্রম</th>
              <th>সেকসন</th>
              <th>ক্যাম্পের নাম</th>
              <th>স্থান</th>
              <th>সনদ নং</th>
              <th>ক্যাম্প তারিখ</th>
              <th>মূল্যায়নকারী</th>
              <th>যাচাইকারী</th>
           </tr>
           <?php for($i=0;$i<sizeof($camping);$i++){ ?>
        
            <tr>
              <td><?=$i+1?></td>
              <td><?=get_scout_section($camping[$i]->section_id); ?></td>
              <td><?=$camping[$i]->camp_name; ?></td>
              <td><?=$camping[$i]->area; ?></td>
              <td><?=$camping[$i]->certificate_no; ?></td>
              <td><?=date_bangla_format($camping[$i]->camp_date); ?></td>
              <td><?=$camping[$i]->examiner_id; ?></td>
              <td><?=$camping[$i]->scout_id; ?></td>
              
            </tr>
            <?php } ?>  
      </table>

      </br></br>

      
      <table class="profile_table" width="100%">
        <caption>প্রশিক্ষণ রেকর্ডের বিবরণ</caption>
           <tr class="bg-success">
              <th>ক্রম</th>
              <th>সেকসন</th>
              <th>ব্যাজ</th>
              <th>প্রশিক্ষণের নাম</th>
              <th>সনদ নং</th>
              <th>প্রশিক্ষণের তারিখ</th>
              <th>মূল্যায়নকারী</th>
              <th>যাচাইকারী</th>
           </tr>
           <?php for($i=0;$i<sizeof($badge_training);$i++){ ?>
        
            <tr>
              <td><?=$i+1?></td>
              <td><?=get_scout_section($badge_training[$i]->section_id); ?></td>
              <td><?=$badge_training[$i]->badge_type_name_bn; ?></td>
              <td><?=$badge_training[$i]->training_name; ?></td>
              <td><?=$badge_training[$i]->certificate_no; ?></td>
              <td><?=date_bangla_format($badge_training[$i]->training_date); ?></td>
              <td><?=$badge_training[$i]->examiner_id; ?></td>
              <td><?=$badge_training[$i]->scout_id; ?></td>
              
            </tr>
            <?php } ?>  
      </table>

      </br></br>

      
      <table class="profile_table" width="100%">
        <caption>দৈহিক ও স্বাস্থ্যগত রেকর্ডের বিবরণ</caption>
           <tr class="bg-success">
              <th>ক্রম</th>
              <th>সেকসন</th>
              <th>বর্ষ</th>
              <th>উচ্চতা</th>
              <th>ওজন</th>
              <th>বুকের মাপ</th>
              <th>বিঘত</th>
              <th>হাতের মাপ</th>
              <th>হৃদ স্পন্দন</th>
              <th>তাপমাত্রা</th>
              <th>মূল্যায়নকারী</th>
              <th>যাচাইকারী</th>
           </tr>
           <?php for($i=0;$i<sizeof($health);$i++){ ?>
        
            <tr>
              <td><?=$i+1?></td>
              <td><?=get_scout_section($health[$i]->section_id); ?></td>
              <td><?=$health[$i]->years; ?></td>
              <td><?=$health[$i]->height; ?></td>
              <td><?=$health[$i]->weight; ?></td>
              <td><?=$health[$i]->chest_size; ?></td>
              <td><?=$health[$i]->span; ?></td>
              <td><?=$health[$i]->hand_size; ?></td>
              <td><?=$health[$i]->heartbeat; ?></td>
              <td><?=$health[$i]->temperature; ?></td>
              <td><?=$health[$i]->examiner_id; ?></td>
              <td><?=$health[$i]->scout_id; ?></td>
              
            </tr>
            <?php } ?>  
      </table>

      </br></br>

      
      <table class="profile_table" width="100%">
        <caption>বিদ্যালয়ের ক্রমোন্নতি তথ্য বিবরণ</caption>
           <tr class="bg-success">
              <th>ক্রম</th>
              <th>সেকসন</th>
              <th>বর্ষ</th>
              <th>শ্রেণী</th>
              <th>রোল নং</th>
              <th>প্রাপ্ত নম্বর</th>
              <th>মূল্যায়নকারী</th>
              <th>যাচাইকারী</th>
           </tr>
           <?php for($i=0;$i<sizeof($institute);$i++){ ?>
        
            <tr>
              <td><?=$i+1?></td>
              <td><?=get_scout_section($institute[$i]->section_id); ?></td>
              <td><?=$institute[$i]->years; ?></td>
              <td><?=$institute[$i]->class_name; ?></td>
              <td><?=$institute[$i]->roll_no; ?></td>
              <td><?=$institute[$i]->total_unmber; ?></td>
              <td><?=$institute[$i]->examiner_id; ?></td>
              <td><?=$institute[$i]->scout_id; ?></td>
              
            </tr>
            <?php } ?>  
      </table>

      </br></br>

      
      <table class="profile_table" width="100%">
        <caption>পদোন্নতির বিবরণ</caption>
           <tr class="bg-success">
              <th>ক্রম</th>
              <th>সেকসন</th>
              <th>রোল</th>
              <th>পদোন্নতির শুরুর তারিখ</th>
              <th>পদোন্নতির শেষ তারিখ</th>
              <th>ব্যাজ</th>
              <th>মূল্যায়নকারী</th>
              <th>যাচাইকারী</th>
           </tr>
           <?php for($i=0;$i<sizeof($promotion);$i++){ ?>
        
            <tr>
              <td><?=$i+1?></td>
              <td><?=get_scout_section($promotion[$i]->section_id); ?></td>
              <td><?=$promotion[$i]->role_type_name_bn; ?></td>
              <td><?=date_bangla_format($promotion[$i]->from_date); ?></td>
              <td><?=date_bangla_format($promotion[$i]->to_date); ?></td>
              <td><?=$promotion[$i]->badge_type_name_bn; ?></td>
              <td><?=$promotion[$i]->examiner_id; ?></td>
              <td><?=$promotion[$i]->scout_id; ?></td>
              
            </tr>
            <?php } ?>  
      </table>

      </br></br>

      
      <table class="profile_table" width="100%">
        <caption>গ্রুপ ত্যাগের বিবরণ</caption>
           <tr class="bg-success">
              <th>ক্রম</th>
              <th>সেকসন</th>
              <th>গ্রুপ ত্যাগের তারিখ</th>
              <th>গ্রুপ ত্যাগের কারণ</th>
              <th>মূল্যায়নকারী</th>
              <th>যাচাইকারী</th>
           </tr>
           <?php for($i=0;$i<sizeof($resign);$i++){ ?>
        
            <tr>
              <td><?=$i+1?></td>
              <td><?=get_scout_section($resign[$i]->section_id); ?></td>
              <td><?=$resign[$i]->resign_date; ?></td>
              <td><?=$resign[$i]->resign_reason; ?></td>
              <td><?=$resign[$i]->examiner_id; ?></td>
              <td><?=$resign[$i]->scout_id; ?></td>
              
            </tr>
            <?php } ?>  
      </table>

      </div>
    </div>                        
  </div> -->

  */ ?>
