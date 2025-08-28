<body class="error-body no-top" style="background: url(<?=base_url();?>awedget/assets/img/loginBG.png) center;">
   <style type="text/css">
      .input-group{margin-bottom: 15px; width: 100%}
      label{font-weight: bold;}
      .addonExtra{border: 1px solid #5fbb78; background-color:#5fbb78; width: 40px;}
      .addonExtra i {color:white;}
      .box_reg{background-color: rgba(255,255,255,0.8); padding: 30px;}
      .box_img{display: block;margin-left: auto;margin-right: auto; height: 90px;}
      .box_title{font-weight: bold; text-align: center;}
      .box_title2{text-align: center; }
   </style>
   <div class="container">
      <div class="row login-container column-seperation">  
         <form action="<?=base_url('forgot_password/verify_change_password')?>" method="post" autocomplete="on">
            <div class="col-md-6 col-sm-6 col-sm-offset-3 col-md-offset-3 box_reg"> 
               <img src="<?=base_url();?>awedget/assets/img/scouts-logo.gif" class="box_img">
               <h2 class="box_title">Bangladesh Scouts</h2>
               <h4 class="box_title2">Please check your mobile. Put your verify code then change password</h4>
               <div class="clearfix"></div>

               <div id="infoMessage"><?php echo $message;?></div>

               
                 <div class="row">
		            <div class="col-md-6">
		               <label>Your verify code</label>
		               <?php echo form_error('verify_code')?>
		               <div class="input-group" >
		                  <span class="input-group-addon addonExtra"> <i class="fa fa-book"></i> </span>
		                  <input type="text" class="form-control" name="verify_code" value="<?=set_value('verify_code')?>" placeholder="Your verify code">   
		               </div>
		            </div>
		            <div class="col-md-6">
		               
		            </div>
		         </div>

		         <div class="row">
		            <div class="col-md-6">
		               <label>Password</label>
		               <?php echo form_error('new')?>
		               <div class="input-group">
		                  <span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
		                  <input type="password" class="form-control" name="new" placeholder="Password">   
		               </div>
		            </div>

		            <div class="col-md-6">
		               <label>Re-Type Password</label>
		               <?php echo form_error('new_confirm')?>
		               <div class="input-group">
		                  <span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
		                  <input type="re_type_password" class="form-control" name="new_confirm" placeholder="Re-Type Password">   
		               </div>
		            </div>
		         </div>
         		<div style="margin-top:10px; margin-bottom: 30px;" class="form-group">
	             	<div class="controls">
			              <a href="<?=base_url('login')?>" class="pull-left" style="color: blue;">I have already an account</a>
			              <?php echo form_submit('submit', 'Submit', "class='btn btn-primary btn-cons pull-right'"); ?>
		           	</div>
		        </div> 
              </div>
           </div>
     </div>
  </form>
</div>
</div>