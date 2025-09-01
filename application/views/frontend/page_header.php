<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Digital Schedule Management System <?php //lang('site_meta_title')?></title>
   <link rel="icon" type="image/ico" href="<?=base_url();?>awedget/assets/img/favicon.ico"/>
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>fwedget/assets/bootstrap-4.0.0-alpha.6/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
   <link href="<?=base_url();?>fwedget/assets/bootstrap-gallery/grid/gallery-grid.css" rel="stylesheet" type="text/css"/>
   <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
   <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>fwedget/assets/css/style.css">

   <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> -->
   <!-- <script src="<?=base_url();?>fwedget/assets/plugins/jquery-3.3.1.min.js" type="text/javascript"></script> -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script type="text/javascript">var hostname='<?php echo base_url();?>';</script>
   <style type="text/css">
      
   </style>
</head>

<body>

   <!-- <div id="fb-root"></div> -->
   <!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script> -->

   <div class="sc_main_container">

      <div class="sc_header">
         <div class="container w-75">
            <div class="d-flex justify-content-end">
               <div class="mr-auto p-2 text-white font-weight-bold d-none d-sm-block">Digital Work Schedule Management System</div>
               <?php /* ?>
               <?php if($this->session->userdata('site_lang') == 'english' ){ ?>
               <div class="p-2 text-white"><a href="<?=base_url()?>switchlang/bangla" class="badge badge-warning text-white card-link py-2 px-2" style="border-radius: 0;">Bangla</a></div>
               <?php }else{ ?> 
               <div class="p-2 text-white"><a href="<?=base_url()?>switchlang/english" class="badge badge-warning text-white card-link py-2 px-2" style="border-radius: 0;">English</a></div>
               <?php } ?>
               <?php */ ?>

               <?php if (!$this->ion_auth->logged_in()): ?>
                  <div class="p-2"><span class="badge badge-success py-2 px-2" style="border-radius: 0;"><a href="<?=base_url('login')?>" class="text-white card-link">Login</a></span></div>
                  <div class="p-2"><span class="badge badge-success  py-2 px-2" style="border-radius: 0;"><a href="<?=base_url('registration')?>" class="text-white card-link">Register</a></span></div>

               <?php else: ?>
                  <span style="margin-top: 6px;color: #fff">
                     <?php //if($this->session->userdata('site_lang') == 'english' ){ ?>
                     <a style="color: #fff;text-decoration: none;" href="<?=base_url('dashboard')?>">Login as <strong><?php echo $this->session->userdata("first_name"); ?></strong></a>
                     <?php //} else { ?>
                     <!-- <a style="color: #fff;text-decoration: none;" href="<?=base_url('my-account')?>"> লগইন আছেন <?php echo $this->session->userdata("full_name_bn"); ?></a> -->
                     <?php //} ?>
                  </span>
               <?php endif; ?>
               <!-- <div class="p-2"><span class="badge badge-success badge-pill py-2 px-2">English</span></div> -->
            </div>
         </div>
      </div>

      <div class="container w-75">
         <div class="row secondary_sc_content px-2 py-4">  
          <!-- <div class=" px-4 py-4"> -->

