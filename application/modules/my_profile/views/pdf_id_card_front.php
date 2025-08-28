<?php 
// echo '<pre>';
// print_r($info); exit;
$scout_id = $info->scout_id;
$blood_group = $info->bg_name_en;
$name = $info->first_name;
$sc_district_name_en = $info->dis_name_en;
$sc_group_name = $info->grp_name;

if($info->expire_date != NULL){
  $expire_date = date('d M, Y', strtotime($info->expire_date));  
}else{
  $expire_date = date('d M, Y', strtotime("31-12-2020"));  
}



//Profile image
$profile_img_url = '';
$path = FCPATH.'profile_img/';
if($info->profile_img != NULL){
  $profile_img_url = $path.$info->profile_img;
}else{
  $profile_img_url = $path.'no-img.png';
}

//Scouts member section
$member_type_section = '';
if($info->member_id == 2){
  if($info->sc_section_id <= 3){
    $member_type_section = get_scout_section($info->sc_section_id);
  }else{
    $member_type_section = '';
  }
}elseif($info->member_id == 8){
  $member_type_section = 'Adult Leader';
}elseif($info->member_id == 9){
  $member_type_section = 'Professional Executive';
}elseif($info->member_id == 10){
  $member_type_section = $info->role_type_name_en;
}elseif($info->member_id == 12){
  $member_type_section = $info->role_type_name_en;
}elseif($info->member_id == 13){
  $member_type_section = 'Support Staff';
}

//echo $full_pre_add; exit;
//echo 'hello'; exit;
//echo FCPATH; exit;
?> 


<!DOCTYPE html>
<html>
<head>
  <title>Download or Save Scout ID Card</title> 
</head>
<body>  
  <div height="100%" width="100%" style="background: #FFFFFF
  url('<?=FCPATH?>awedget/assets/img/id_card/front.png'); background-repeat: no-repeat; background-image-resolution: 72dpi; border: 0px solid black;">
  <div style="float: left;border: 0px solid red; width: 400px;">
  <img src="<?=$profile_img_url ?>" style="height: 315px; width: 315px;margin: 265px 0 0 33px;padding: 3px;border: 2px solid black;">
    <div style="margin: 30px 0 0 0px;text-align:center;font-family: arial;font-weight: bold; font-size: 35pt;border: 0px solid red;">BS ID</div>
    <div style="border: 0.2mm solid purple; margin: 0px 0 0 50px; border-radius: 20mm; width: 70mm; height: 15mm; padding: 3mm; font-family: arial; font-size: 45pt; color: white; background-color: purple; font-kerning: auto;  font-weight: bold; text-align: center;">
      <?=$scout_id?>
    </div>
  </div>

  <div style="float: left;border: 0px solid yellow; position: absolute;">
    <div style="border: 0px solid black; margin-left:760px; padding-top:110px; width: 30mm; height: 20mm; font-size: 30pt; color: white; font-weight: bold;"><?=$blood_group?></div>

    <div style="height: 535px;">
      <div style="border:0px solid black; margin: 90px 0 0 0px; width: 230mm; font-size: 45pt;color: black; font-family: arial;font-weight: bold;"><?=$name?></div>
      <div style="border: 0px solid black; margin: 0px 0 0 0px; width: 200mm;; font-size: 30pt;color: #006400; font-family: arial;font-weight: bold;"><?=$member_type_section?></div>
      <div style="border: 0px solid black; margin: 10px 0 0 0px; width: 230mm; font-size: 35pt;color: blue; font-family: arial;font-weight: bold;"><?=$sc_group_name?></div>
      <div style="border: 0px solid black; margin: 0px 0 0 0px; width: 230mm;  font-size: 30pt;color: #00008B; font-family: arial;font-weight: bold;"><?=$sc_district_name_en?></div>
    </div>

    <div style="border: 0px solid black; height: 50px; margin-top: 10px; margin-right: 40px; font-size: 33pt; font-family: arial; font-weight: bold; color: red; float: right; text-align: right;">
      <span> Expire Date: </span>
      <span style="border: 0px solid black; font-size: 33pt;"> <?=$expire_date?> </span>
    </div>
  </div>
</div>

</body>
</html>