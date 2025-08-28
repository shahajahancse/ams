<?php 
$father = $info->father_name;
$mother = $info->mother_name;
$phone = $info->phone;
$issue_date = date('d F, Y', $info->created_on); 
$dob = $info->dob != '0000-00-00' ? date('d F, Y', strtotime($info->dob)): '';

$qr_img = $info->qr_img;
$path = FCPATH.'qrcode_img/';

//QR Code image
if($qr_img != NULL){
  $qr_img_url = $path.$qr_img;
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
</head>
<body>  

  <div height="100%" width="100%" style="background: #FFFFFF
  url('<?=FCPATH?>awedget/assets/img/id_card/back.png'); background-repeat: no-repeat; background-image-resolution: 72dpi; border: 0px solid black;">
  <div style="float: left;border: 0px solid red; width: 800px; margin:10px 30px 0 80px; padding-top: 10px; ">
    <div style="border: 0px solid red; margin: 60px 0 0 0px; font-size: 30pt; color: #666666; font-family: arial;font-weight: bold; ">Father's Name</div>
    <div style="border: 0px solid black; margin: 0px 0 0 0px; font-size: 35pt;color: black; font-family: arial;font-weight: bold;"><?=$father?></div>

    <div style="border: 0px solid red; margin: 10px 0 0 0px; font-size: 30pt; color: #666666; font-family: arial;font-weight: bold; ">Mother's Name</div>
    <div style="border: 0px solid black; margin: 0px 0 0 0px; font-size: 35pt;color: black;  font-family: arial;font-weight: bold;"><?=$mother?></div>

    <div style="border: 0px solid red; margin: 10px 0 0 0px; font-size: 30pt; color: #666666; font-family: arial;font-weight: bold; ">Contact Number</div>
    <div style="border: 0px solid black; margin: 0px 0 0 0px; height: 60px; font-size: 35pt;color: black;  font-family: arial;font-weight: bold;"><?=$phone?></div> 
    <div style="border: 0px solid red; margin: 10px 0 0 0px; font-size: 30pt; color: #666666; font-family: arial;font-weight: bold; ">Present Address</div>   
  </div>

  <div style="float: left;border: 0px solid yellow; width: 410px;">
    <div style="border: 0px solid red; margin:20px 0px 0 10px; padding-top: 80px; width: 380px; height: 380px;">
      <?php if($info->qr_img != NULL){?>
      <img src="<?=$qr_img_url; ?>" style="height: 380px; width: 380px" >
      <?php } ?>  
    </div>

  </div>

  <div style="float: left;border: 0px solid red; width: 100%; margin:0px 30px 0 80px; padding-top: 10px; ">
  <div style="border: 0px solid black; font-size: 30pt;color: black;  font-family: arial;font-weight: bold; height: 200px;"><?=$full_pre_add?> </div>

    <div style="border: 0px solid red; margin: 0px 0 0 0px; font-size: 30pt; color: #666666; font-family: arial;font-weight: bold; ">Issue Date: <span style="color: black;"><?=$issue_date?></span></div>    
  </div>

</div>


</body>
</html>