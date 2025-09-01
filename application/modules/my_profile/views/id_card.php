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
$districtEn = $info->dis_name_en;
$phone2 = $info->phone2;
$emergency_phone = $info->phone_emergency;
$email = $info->email !='' ? $info->email: '';
$nid = $info->nid;
$passport_no = $info->passport_no;
$religion_id = $info->religion_id;
$birth_id = $info->birth_id;
$occupation = $info->occupation_name;

$pre_village  = $info->pre_village_house;
$pre_rode     = $info->pre_road_block;
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
$per_rode     = $info->per_road_block;
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

$curr_institute = $info->institute_name;
$curr_class     = $info->curr_class;
$curr_role_no   = $info->curr_role_no;

$last_update = $info->last_login !='' ? date('d F, Y', $info->last_login): '';
$created_date = $info->created_on !='' ? date('d F, Y', $info->created_on): '';

$is_verify = $info->is_verify;
$sc_join_date = $info->join_date !='0000-00-00' ? date('d F, Y', strtotime($info->join_date)): '';
$sc_section_name = $info->sc_section_id;
$member_type = $info->member_type_name;
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

if($info->dis_name != NULL){
  $exp = explode(',', $info->dis_name);
  $sc_district_name = $exp[1];
}else{
  $sc_district_name = '';
}

if($info->sc_section_id <= 3){
  $member_section = $member_type. ' ('.$section_name.')';
}else{
  $member_section = $member_type;
}

//qr code text
$qr_code_text = 'Name: ' . $info->first_name . ' ('. $info->scout_id .')';
?>     
<style type="text/css">    
  .id_box{border: 1px solid #b44dff; width: 350px; height: 210px; border-bottom: 5px solid #1aa326;color: black;}
  .id_box_back{border: 1px solid #b44dff; width: 350px; height: 210px; border-top: 5px solid #7030a0;color: black;}

  .id_header{border: 1px solid black; width: 100%; height: 55px; background-color:#7030a0; border-bottom: 5px solid #1aa326;}
  .id_logo{float: left; width: 200px; border: 0px solid yellow; margin: 8px 10px;}
  .id_logo_blood{float: right;width: 33px;height: 41px;padding: 13px 0px 0px 5px;margin: 5px 10px;font-weight: bold;color: white;border: 0px solid yellow;background-image: url(<?= base_url('awedget/assets/img/blood_drop.png');?>); background-repeat: no-repeat;background-size: 8mm 10mm;}

  .id_left_content{float: left; border: 0px solid black; width: 92px; height: 120px; margin: 8px 10px;}
  .id_profile_img{border: 1px solid #ccc; width: 83px; height: 83px; margin-bottom: 6px; }
  .id_bs{text-align: center;font-weight: bold; font-size:11px; }
  .id_scout_id{text-align: center;font-weight: bold; font-size: 15px;}

  .id_right_content{float: right; border: 0px solid black; width: 215px; height: 120px; margin: 5px 10px 0 8px;}
  .id_label_name{font-size: 11px;}
  .id_label_value{font-size: 12px; font-weight: bold; margin-bottom: 1px;}


  .id_back_left_content{float: left; border: 0px solid black; width: 240px; height: 75px; margin: 8px 0px 0px 10px;}

  .id_back_right_content{float: right; border: 0px solid black; width: 75px; height: 75px; margin: 8px 10px 0 0px;}
  .id_group{margin:0 10px 5px 10px;}
  .id_label_present_add{font-size: 11px; text-align: center;}
  .id_label_present_add_value{font-size: 12px; text-align: center;}
  .id_clear{clear: both;}
  .id_expaire{width: 130px; border: 0px solid black; float: left; margin-top: 0px; margin-left: 10px; margin-bottom: 0px;}
  .id_expaire_text{font-size: 10px;display: block;}
  .id_found{width: 160px; border: 0px solid black; float: right; text-align: right; margin-right: 10px;margin-top: 0px;}
  .id_found_text{padding-left: 20%;  font-size: 10px;display: block;}
  .id_footer{height: 19px; background-color: #1aa326; font-size: 12px; text-align: center; padding-top: 2px;color: white; font-weight: bold;}
</style>
<div class="page-content">     
 <div class="content">  
  <ul class="breadcrumb" style="margin-bottom: 20px;">
   <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
   <li> <a href="<?=base_url('my_profile')?>" class="active"> <?=$module_title; ?> </a></li>
   <li><?=$meta_title; ?> </li>
 </ul>

 <div class="row">
   <div class="col-md-12">
    <div class="grid simple horizontal">
     <div class="grid-title">
      <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
      <div class="pull-right">  
        <a href="<?=base_url('my_profile')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Profile</a>   
      </div>
    </div>

    <div class="grid-body">

      <div class="row">
        <?php if($profile_img != NULL && $districtEn != ''){ ?>       

        <div class="col-md-12">
          <!-- Note: "Download Scout ID" card pdf features currently under construction. <br><br> -->
          <a href="<?=base_url('my_profile/pdf_id_card')?>" target="_blank" class="btn btn-success"> Download Scout ID Card</a>
        </div>    

        <?php }else{ ?>

        <div class="alert alert-warning">
         <h4 class="semi-bold">ID card is not being generated because your picture/image, scouts district name (english) are not yet fulfilled. <br>
          Please contact your group admin.</h4>
        </div>

        <?php } ?>

      </div>  <!-- END GRID BODY -->              
    </div> <!-- END GRID -->
  </div>

</div> <!-- END ROW -->
</div>
</div>
</div>