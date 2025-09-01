<body class="error-body no-top" style="background-color: #ccc;">
  <div class="container">
    <div class="row login-container login_register column-seperation">  
      <?php 
      $attributes = array('id' => 'login_validate');
      echo form_open("adminlogin/index", $attributes);
      ?>
      <div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4 box_reg"> 
        <img src="<?=base_url('awedget/assets/img/Digital-Schedule-Logo.png');?>" class="box_img img-responsive" style="height:65px;">
        <h4 class="box_title">Login to you account</h4>
        <div id="infoMessage"><?php echo $message;?></div>
        
        <div class="row">
          <div class="col-md-12" style="margin-top: 15px; margin-bottom: 10px;">
            <label>Email Address</label>
            <?php echo form_error('identity')?>
            <div class="input-group">
              <span class="input-group-addon addonExtra"> <i class="fa fa-user" style="color:white;"></i> </span>
              <?=form_input($identity)?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" style=" margin-bottom: 15px;">
            <label>Login Password</label>
            <?php echo form_error('password')?>
            <div class="input-group">
              <span class="input-group-addon addonExtra"><i class="fa fa-key" style="color:white;"></i></span>
              <?=form_password($password)?>
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon-eye toggle-password"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 hidden-sm hidden-xs">
            <div class="input-group">
              <div class="checkbox checkbox check-success pull-left">
                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                <label for="remember" style="color: black; font-weight: bold;">Remember Me</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <?php echo form_submit('submit', 'Login', "class='btn btn-primary btn-cons pull-right'"); ?>
            </div>
          </div>
        </div>

        <!-- <div class="row">
          <div class="col-md-6">
            <a href="<?=base_url('registration')?>" class="register">Register new account  </a>
          </div>
          <div class="col-md-6">
            <a href="<?=base_url('#')?>" class="forget"><?php echo lang('login_forgot_password');?></a>
          </div>
        </div> -->

        <div class="clearfix"></div>
        <div class="a2i">
          <span style="text-decoration: underline;">কারিগরি সহায়তায় </span> 
          <br><strong>মাইসফট হেভেন বিডি লিঃ</strong> <br>
          <img src="<?php echo base_url('awedget/assets/img/mysoft-logo.png')?>" width="75" style="margin-top: 10px;">
        </div>
      </div>

    </form>
  </div>
</div>