

<div class="container w-75">
	<div class="secondary_sc_content">
      <style type="text/css">
         /* sign in FORM */
         #logreg-forms{
            width:350px;
            margin:10vh auto;
            background-color:#f3f3f3;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
         }
         #logreg-forms form {
            width: 100%;
            max-width: 320px;
            padding: 15px;
            margin: auto;
         }
      </style>
      <div class="container">
         <div class="row">
            <div id="logreg-forms">
                  <?php 
                  // login_validate
                  $attributes = array('class' => 'form-signin', 'id' => '');
                  echo form_open_multipart("login", $attributes);
                  ?>
                  <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Login </h1>
                  <div id="infoMessage"><?php echo $message;?></div>
                  <label>Email </label>
                  <?=form_input($identity)?>
                  <!-- <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus=""> -->
                  <br>
                  <label>Password</label>
                  <?=form_password($password)?>
                  <!-- <input type="password" id="inputPassword" class="form-control" placeholder="Password" required=""> -->

                  <button class="btn btn-success btn-block" type="submit"><i class="fa fa-sign-in"></i> Login in</button>
                  <!-- <a href="#" id="forgot_pswd">Forgot password?</a> -->
                  <hr>

                  <a href="<?=base_url('registeration')?>" class="btn btn-primary btn-block"><span style="color: white;"><i class="fa fa-user-plus"></i> Create New Account</span></a>
               </form>

               <?php /* ?>
               <form action="/reset/password/" class="form-reset">
                  <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
                  <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                  <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
               </form>
               <?php */ ?>
            </div>

         </div> <!-- /row -->
      </div> <!-- /container -->

   </div>
</div>