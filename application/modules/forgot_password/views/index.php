<body class="error-body no-top" style="background: url(<?=base_url('awedget/assets/img/inventeory.png');?>) no-repeat center center fixed; -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
  <div class="container">
    <div class="row login-container login_register column-seperation">  
      <?php 
      $attributes = array('id' => 'login_validate');
      echo form_open("forgot-password", $attributes); 
      ?>
      <div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4 box_reg"> 
        <h4 class="box_title">Inventeory (BCCT)</h4>
        <img src="<?=base_url('awedget/assets/img/govt-logo.png');?>" class="box_img img-responsive"  width="50">
        <h4 class="box_title">Forgot Password</h4>
        <div id="infoMessage"><?php echo $message;?></div>
        
        <div class="row">
          <div class="col-md-12" style="margin-top: 15px; margin-bottom: 10px;">
            <label>Put your email or username</label>
            <?php echo form_error('identity')?>
            <div class="input-group">
              <span class="input-group-addon addonExtra"> <i class="fa fa-user" style="color:white;"></i> </span>
              <?=form_input($identity)?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6"> </div>
          <div class="col-md-6">
            <div class="input-group">
              <?php echo form_submit('submit', 'Submit', "class='btn btn-primary btn-cons pull-right'"); ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <a href="<?=base_url('login')?>" class="forget">Login my account</a>
          </div>
        </div>

      </div>

    </form>
  </div>
</div>