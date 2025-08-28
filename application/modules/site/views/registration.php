<div class="container w-75">
	<div class="secondary_sc_content">

		<div class="container">
			<div class="row">

				<div id="logreg-forms">
					<div id="infoMessage"><?php //echo $message;?></div>
					<?php echo validation_errors(); ?>
					<?php 
					// registration_validate
					$attributes = array('class' => 'form-signup', 'id' => '');
					echo form_open_multipart("registration", $attributes);
					?>

					<h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Register New Account </h1>
					
					<div class="row form-row" style="margin-bottom: 5px;">
						<div class="col-md-6">
							<label>Name <span class="required">*</span></label>
							<?=form_input($full_name)?>
							<!-- <input type="text" class="form-control" placeholder="" required="" autofocus=""> -->
						</div>
						<div class="col-md-6">
							<label>Mobile No <span class="required">*</span></label>
							<?=form_input($phone)?> 
							<!-- <input type="text" class="form-control" placeholder="" required="" autofocus=""> -->
						</div>
					</div>

					<div class="row form-row" style="margin-bottom: 5px;">
						<div class="col-md-6">
							<label>Organizaiton/Office Name</label>
							<input type="text" name="org_prof_name" class="form-control" placeholder=""  autofocus="">
						</div>
						<div class="col-md-6">
							<label>Identity (NID/Passport)</label>							
							<input type="file" name="userfile">
							<span style="font-size: 11px; color: red;">File Type: png, jpg, pdf only allowed</span>
						</div>
					</div>

					<div class="row form-row" style="margin-bottom: 5px;">
						<div class="col-md-12">
							<label>Email Address <span class="required">*</span></label>
							<?=form_input($identity)?>
						</div>
					</div>

					<div class="row form-row">
						<div class="col-md-6">
							<label>Password <span class="required">*</span></label>
							<?=form_password($password)?>
						</div>
						<div class="col-md-6">
							<label>Password Confirm <span class="required">*</span></label>
							<?=form_input($password_confirm)?>
						</div>
					</div>

					<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-user-plus"></i> Create Account </button>
					<a href="<?=base_url('login')?>" id="cancel_signup"><i class="fa fa-user"></i> I have already an account.</a>
					<?php echo form_close();?>
					<br>

				</div>

			</div> <!-- /row -->
		</div> <!-- /container -->

	</div>
</div>
