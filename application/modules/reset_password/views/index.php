<body class="error-body no-top" style="background: url(<?=base_url();?>awedget/assets/img/loginBG.png) center;">
<style type="text/css">
  .input-group{margin-bottom: 15px; width: 100%}
  label{font-weight: bold;}
  .addonExtra{border: 1px solid #5fbb78; background-color:#5fbb78; width: 40px;}
  .addonExtra i {color:white;}
</style>
<div class="container">
  <div class="row login-container column-seperation">  
      <form action="<?=base_url("reset_password/index/".$code)?>" method="post" autocomplete="on">
         <div class="col-md-7 col-sm-7 col-sm-offset-2 col-md-offset-2" style="background-color: rgba(255,255,255,0.8); padding: 30px; "> 
            <img src="<?=base_url();?>awedget/assets/img/scouts-logo.gif" height="90" style="display: block; width: 90px; margin-left: auto;margin-right: auto; float: left; ">
            <h1 style="font-weight: bold; text-align: center; float: left; margin: 25px 0 0 10px;">Bangladesh Scouts</h1>
            <div class="clearfix"></div>
            <h4 style="text-align: center; font-weight: bold;">Reset Password</h4>

            <div class="row">
               <div class="col-md-6">
                  <label>New Password</label>
                  <?php echo form_error('new')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
                     <input type="password" class="form-control" name="new" placeholder="New Password">   
                  </div>
               </div>
               
               <div class="col-md-6">
                  <label>Repeat Password</label>
                  <?php echo form_error('new_confirm')?>
                  <div class="input-group">
                     <span class="input-group-addon addonExtra"><i class="fa fa-lock"></i></span>
                     <input type="password" class="form-control" name="new_confirm" placeholder="Retype Password Confirm">
                  </div>
               </div>
            </div>
            
            <?php echo form_input($user_id);?>
            <?php echo form_hidden($csrf); ?>

            <div style="margin-top:10px; margin-bottom: 30px;" class="form-group">
               <div class="controls">
                  <a href="<?=base_url('login')?>" class="pull-left" style="color: blue;">I have already an account</a>
                  <?php echo form_submit('submit', 'Reset Password', "class='btn btn-primary pull-right'"); ?>
               </div>
            </div>

         </div>
      </form>
  </div>
</div>