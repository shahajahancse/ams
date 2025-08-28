<body class="error-body no-top" style="background: url(<?=base_url('awedget/assets/img/inventeory.png');?>) no-repeat center center fixed; -webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;">
	<div class="container">
		<div class="row login-container login_register column-seperation">  
			<?php 
			$attributes = array('id' => 'verify_validate');
			echo form_open("forgot_password/verify_change_password", $attributes);
			?>
			<div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4 box_reg"> 
				<h4 class="box_title">Technical and Madrasah Education Division (BCCT)</h4>
        		<img src="<?=base_url('awedget/assets/img/govt-logo.png');?>" class="box_img img-responsive"  width="50">
				<h4 class="box_title">Forgot Password Verify Code</h4>
				<div id="infoMessage"><?php echo $message;?></div>
				<h4 class="box_title2">Please check your email for verify code.</h4>
				<br>

				<div class="row">
					<div class="col-md-12">
						<label>Verify code</label>
						<?php echo form_error('verify_code')?>
						<div class="input-group" >
							<span class="input-group-addon addonExtra"> <i class="fa fa-key"></i> </span>
							<input type="text" class="form-control" name="verify_code" value="<?=set_value('verify_code')?>" placeholder="6 Digit">   
						</div>
					</div>

					<div class="col-md-12">
						<label>New Password</label>
						<?php //echo form_error('new')?>
						<div class="input-group">
							<span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
							<input type="password" class="form-control" name="new" id="new" placeholder="Password minimum 8 character">   
						</div>
					</div>

					<div class="col-md-12">
						<label>Re-Type Password</label>
						<?php //echo form_error('new_confirm')?>
						<div class="input-group">
							<span class="input-group-addon addonExtra"> <i class="fa fa-lock"></i> </span>
							<input type="password" class="form-control" name="new_confirm" placeholder="Re-Type Password">   
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