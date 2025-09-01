<!DOCTYPE html>
<html>
<head>
  <title>PDF Scout ID Card Download</title> 

</head>
<body>
<?php echo $info->dis_name;
$sc_district_name = $info->dis_name;?>
<?php
            if($sc_district_name !=NULL){
              $exp = explode(',', $sc_district_name);
              $exp = $exp[1];
            }else{
              $exp = '';
            }

            ?>
<div id="container">
    <h1>Welcome to CodeIgniter!</h1>
    <h2>আমার সোনার বাংলা</h2>
    <h3><?php echo $exp;?></h3>
 
    <div id="body">
        <p>The page you are looking at is being generated dynamically by CodeIgniter.</p>
 
        <p>If you would like to edit this page you'll find it located at:</p>
application/views/welcome_message.php
        <p>The corresponding controller for this page is found at:</p>
application/controllers/Welcome.php
        <p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
    </div>
 
</div>
 
</body>
</html>