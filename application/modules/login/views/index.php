
<style>
    .log_top {
        display: flex;
        flex-direction: row;
        position: relative;
        padding: 6px 33px;
        background: #99ad6363;
        margin: 0;
        justify-content: center;
        align-items: center;
        gap: 23px;
    }

    .log_top img {
        width: 85px;
        height: 76px;
    }

    .log_top span {
        font-size: 45px;
        color: #ffffff;
        font-weight: bold;
        align-self: center;
        font-family: sans-serif;
        text-align: center;
    }

    @media screen and (max-width: 900px) {
        .log_top span {
            font-size: 40px;
        }
    }
    @media screen and (max-width: 820px) {
        .log_top span {
            font-size: 35px;
        }
    }

    @media screen and (max-width: 767px) {
        .log_top span {
            font-size: 30px;
        }
    }
    @media screen and (max-width: 742px) {
        .log_top span {
            font-size: 30px;
        }
    }
    @media screen and (max-width: 662px) {
        .log_top span {
            font-size: 25px;
        }

    }
    @media screen and (max-width: 582px) {
        .log_top span {
            font-size: 20px;
        }

    }
    @media screen and (max-width: 502px) {
        .log_top span {
            font-size: 15px;
        }

    }
</style>

<body class="error-body no-top" style="background: url(<?=base_url('awedget/assets/img/inventeory.png');?>) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <div class="col-md-12 log_top">
        <img src="<?=base_url();?>awedget/assets/img/govt-logo.png" class="img-responsive">
        <span>Bangladesh Forest Research Institute (BFRI)</span>

        <img src="<?=base_url();?>awedget/assets/img/bfri_logo.png" class="img-responsive">
    </div>
    <div class="container">
        <div class="row login-container login_register column-seperation" style="margin: 15% auto 20px auto;">
            <?php $attributes = array('id' => 'login_validate'); echo form_open("login/index", $attributes); ?>
            <div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4 box_reg">
                <h4 class="box_title">Inventory Management System</h4>
                <div id="infoMessage"><?php echo $message;?></div>

                <div class="row">
                    <div class="col-md-12" style="margin-top: 15px; margin-bottom: 10px;">
                        <label>Email or Username</label>
                        <?php echo form_error('identity')?>
                        <div class="input-group">
                            <span class="input-group-addon addonExtra"> <i class="fa fa-user" style="color:white;"></i>
                            </span>
                            <?=form_input($identity)?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style=" margin-bottom: 15px;">
                        <label>Login Password</label>
                        <?php echo form_error('password')?>
                        <div class="input-group">
                            <span class="input-group-addon addonExtra"><i class="fa fa-key"
                                    style="color:white;"></i></span>
                            <?=form_password($password)?>
                            <span toggle="#password-field"
                                class="fa fa-fw fa-eye field-icon-eye toggle-password"></span>
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

                <div class="row" style="margin-bottom: 0px;">
                    <div class="col-md-6">
                        <!-- <a href="<?=base_url('forgot-password')?>" class="forget"><?php echo lang('login_forgot_password');?></a> -->
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

