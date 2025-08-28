<body class="error-body no-top" style="background: url(<?=base_url('awedget/assets/img/inventeory.png');?>) no-repeat center center fixed; -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
  <div class="container">
    <div class="row login-container login_register column-seperation">  
      <?php 
      $attributes = array('id' => 'get_verification_code_validate');
      echo form_open("forgot_password/get_verification_code", $attributes);
      ?>
      <div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4 box_reg"> 
        <h4 class="box_title">Technical and Madrasah Education Division (BCCT)</h4>
        <img src="<?=base_url('awedget/assets/img/govt-logo.png');?>" class="box_img img-responsive"  width="50">
        <h4 class="box_title">Get a verification code</h4>
        <div id="infoMessage"><?php echo $message;?></div>
        
        <div class="row">
          <div class="col-md-12" style="margin-top: 15px; margin-bottom: 10px;">
            <?php 
            $disabled = 'disabled';
            if(!empty($emails)){ 
              $disabled='';
              ?>
              <label>We will send a verification code to </label>            
              <br>
              <?php 
              foreach ($emails as $key => $value) {
                echo '<input id="email'.$key.'" name="email" type="radio" value="'.$key.'" class="group_control" />
                <label for="email'.$key.'" class="inline">'.$value.'</label>';
                echo '<div class="clearfix"></div>';
              }
            }else{
              echo '<label>Could not find email address for you.</label>';
            }
          //echo $verify_code; 
            ?>

            <label for="email" class="error" style="display: none;"></labe>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6"> </div>
            <div class="col-md-6">
              <div class="input-group">
                <?php echo form_submit('submit', 'Send Code', "class='btn btn-primary btn-cons pull-right $disabled'"); ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <a href="<?=base_url('registration')?>" class="register">Register new account  </a>
            </div>
            <div class="col-md-6">
              <a href="<?=base_url('login')?>" class="forget">Login my account</a>
            </div>
          </div>

        </div>

      </form>
    </div>
  </div>