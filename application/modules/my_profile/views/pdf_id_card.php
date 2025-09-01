<?php 
$scout_id = $info->scout_id;
$name = $info->first_name;
$father = $info->father_name;
$mother = $info->mother_name;
$dob = $info->dob != '0000-00-00' ? date('d F, Y', strtotime($info->dob)): '';
$blood_group = $info->bg_name_en;
$member_type = $info->member_type_name;
$section_name = get_scout_section($info->sc_section_id);
$sc_group_name = $info->grp_name;
// echo $info->dis_name; exit;
if($info->dis_name != NULL){
  $exp = explode(',', $info->dis_name);
  $sc_district_name = $exp[1];
}else{
  $sc_district_name = '';
}

$profile_img = $info->profile_img;
$path = base_url().'profile_img/';
if($profile_img != NULL){
  $img_url = $path.$profile_img;
}else{
  $img_url = $path.'no-img.png';
}

if($info->sc_section_id <= 3){
  $member_section = $member_type. ' ('.$section_name.')';
}else{
  $member_section = $member_type;
}

//generate a string for present addresss
$pre_village  = $info->pre_village_house;
$pre_rode     = $info->pre_road_block;
$pre_division = $info->pre_div_name;
$pre_district = $info->pre_district_name;
$pre_up_th    = $info->pre_up_th_name;
$pre_po       = $info->pre_post_office;

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
?> 
<!DOCTYPE html>
<html>
<head>
  <title>Download or Save Scout ID Card</title> 
  <style type="text/css">    
    .id_box{border: 1px solid #b44dff; width: 350px; height: 190px; border-bottom: 5px solid #1aa326;}
    .id_box_back{border: 1px solid #b44dff; width: 350px; height: 190px; border-top: 5px solid #7030a0;}

    .id_header{border: 0px solid black; width: 100%; height: 55px; background-color:#7030a0; border-bottom: 5px solid #1aa326;}
    .id_logo{float: left; width: 200px; border: 0px solid yellow; margin: 8px 10px;}
    .id_logo_blood{float: right; width: 30px; height:25px; padding: 15px 0px 0px 3px; margin: 0px 10px; auto;font-weight: bold;color: white;border: 0px solid yellow;background-image: url(<?= base_url('awedget/assets/img/blood_drop.png');?>); background-repeat: no-repeat;background-size: 24mm 30mm;}

    .id_left_content{float: left; border: 0px solid black; width: 92px; height: 120px; margin: 8px 10px;}
    .id_profile_img{border: 1px solid #ccc; width: 85px; height: 85px; margin-bottom: 6px; }
    .id_bs{text-align: center;font-weight: bold; font-size:11px; }
    .id_scout_id{text-align: center;font-weight: bold; font-size: 15px;}

    .id_right_content{float: right; border: 0px solid black; width: 215px; height: 120px; margin: 0px 10px 0 8px;}
    .id_label_name{font-size: 11px;}
    .id_label_value{font-size: 12px; font-weight: bold; margin-bottom: 1px;}


    .id_back_left_content{float: left; border: 0px solid black; width: 240px; height: 90px; margin: 8px 10px;}

    .id_back_right_content{float: right; border: 0px solid black; width: 80px; height: 90px; margin: 0px 10px auto 8px;}
    .id_group{margin:0 10px 5px 10px;}
    .id_label_present_add{font-size: 11px; text-align: center;}
    .id_label_present_add_value{font-size: 12px; text-align: center;}
    .id_clear{clear: both;}
    .id_expaire{width: 130px; border: 0px solid black; float: left; margin-top: 5px; margin-left: 10px; margin-bottom: 5px;}
    .id_expaire_text{padding-left: 22%; padding-top: ; font-size: 10px;}
    .id_found{width: 160px; border: 0px solid black; float: right; text-align: right; margin-top: 0px; margin-right: 10px;}
    .id_found_text{padding-left: 20%; padding-top: 10px; font-size: 10px;}
    .id_footer{height: 15px; background-color: #1aa326; font-size: 12px; text-align: center; padding-top: 2px;color: white; font-weight: bold;}
  </style>
</head>
<body>  
  <div class="id_box">
    <div class="id_header">
      <div class="id_logo"> <img src="<?=base_url('awedget/assets/img/id_card_logo.png')?>" height="40"> </div>
      <div class="id_logo_blood"> <?=$blood_group?></div>
    </div>
    <div class="id_left_content">
      <div class="id_profile_img">
        <img src="<?= $img_url ?>" style="height: 80px; width: 80px;padding: 2px;" >
      </div>
      <div class="id_bs">BS ID</div>
      <div class="id_scout_id"><?=$scout_id?></div>
    </div>
    <div class="id_right_content">
      <div class="id_label_name">Name</div>
      <div class="id_label_value"><?=$name?></div>
      <div class="id_label_name">Father</div>
      <div class="id_label_value"><?=$father?></div>
      <div class="id_label_name">Mother</div>
      <div class="id_label_value"><?=$mother?></div>
      <div class="id_label_name">Date of Birth</div>
      <div class="id_label_value"><?=$dob?></div>
    </div>
  </div>

  <br><br>

  <div class="id_box_back">
    <div class="id_back_left_content">
      <div class="id_label_name">Scout Member Type</div>
      <div class="id_label_value"><?=$member_section?></div>
      <div class="id_label_name">Scout District</div>
      <div class="id_label_value"><?=$sc_district_name?></div>
      <div class="id_label_name">Scout Group</div>
      <div class="id_label_value"><?=$sc_group_name?></div>
    </div>
    <div class="id_back_right_content">
      <?php if($info->qr_img != NULL){?>
      <img src="<?=base_url('qrcode_img/'.$info->qr_img)?>" class="img-thu rounded" style="height: 80px; width: 80px" >
      <?php } ?>
    </div>

    <div class="id_clear"></div>
    <div class="id_label_present_add"> Present Address</div>
    <div class="id_label_present_add_value"> <?=$full_pre_add?></div>

    <div class="id_expaire">
      <span class="id_expaire_text">Expire Date : <br>
        <?= date_detail_format(date('Y-m-d', strtotime("+5 years", $info->created_on)));?>
      </span>
    </div>
    <div class="id_found">
      <span class="id_found_text">If found, please return to</span> 
      <span class="id_found_text"> Bangladesh Scouts</span>
    </div>
    <div class="id_clear"></div>
    <div class="id_footer">scouts.gov.bd</div>
  </div>

</body>
</html>