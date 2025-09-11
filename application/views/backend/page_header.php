<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="icon" type="image/ico" href="<?=base_url('awedget/assets/img/favicon.ico');?>" />
    <title><?=$meta_title?> | AMS </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="<?=base_url();?>awedget/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css"
        media="screen" />
    <meta content="Mysoftheaven (BD) Ltd." name="author" />
    <link href="<?=base_url();?>awedget/assets/plugins/jquery-superbox/css/style.css" rel="stylesheet" type="text/css"
        media="screen" />
    <link href="<?=base_url();?>awedget/assets/plugins/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet"
        type="text/css" media="screen" />
    <link href="<?=base_url();?>awedget/assets/plugins/fullcalendar/dist/fullcalendar.print.min.css" rel="stylesheet"
        type="text/css" media="print" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
   <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet"
    type="text/css" media="screen"/>
   <link href="<?=base_url();?>awedget/assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="<?=base_url();?>awedget/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <!-- Datepicker -->
    <link href="<?=base_url();?>awedget/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"
        type="text/css" />

    <link href="<?=base_url();?>awedget/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url();?>awedget/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="<?=base_url();?>awedget/assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet"
        type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=base_url();?>awedget/assets/plugins/ios-switch/ios7-switch.css" type="text/css"
        media="screen">
    <link href="<?=base_url();?>awedget/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet"
        type="text/css" media="screen" />

    <link href="<?=base_url();?>awedget/assets/plugins/boostrap-3.3.7/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?=base_url();?>awedget/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet"
        type="text/css" />
    <link href="<?=base_url();?>awedget/assets/css/animate.min.css" rel="stylesheet" type="text/css" />

    <link href="<?=base_url();?>awedget/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>awedget/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>awedget/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css" rel="stylesheet">
    <script type="text/javascript">
    var hostname = '<?php echo base_url();?>';
    </script>

</head> <!-- END HEAD -->
<style>
    .select2-container{
        display: inline-table !important;
    }
</style>
<?php  if($this->router->fetch_class('my_message') == 'my_message'){ ?>

<body class="inner-menu-always-open" style="font-family: sans-serif;">
    <?php }else{ ?>

    <body class="">
        <?php } ?>
        <div class="header navbar navbar-inverse ">
            <div class="navbar-inner">
                <div class="header-seperation">
                    <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
                        <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu" class="">
                                <div class="iconset top-menu-toggle-white"></div>
                            </a>
                        </li>
                    </ul>

                    <a href="<?=base_url('dashboard')?>"> <img style="height: 60px;width: 250px;" src="<?=base_url('awedget/assets/img/bfri.png')?>" alt=""></a>
                    <ul class="nav pull-right notifcation-center">
                        <li class="dropdown" id="header_task_bar"> </li>
                    </ul>
                </div>

                <div class="header-quick-nav">
                    <div class="pull-left">
                        <ul class="nav quick-section">
                            <li class="quicklinks"> <a href="javascript:;" class="" id="layout-condensed-toggle" style="color: #8dc641;"> <i class="fa fa-bars" style="font-size: 22px; color: #8dc641 !important;"></i> </a>
                            </li>
                        </ul>
                    </div>

                    <!-- BEGIN CHAT TOGGLER -->
                    <div class="pull-right">
                        <div class="chat-toggler">
                            <a>
                                <div class="user-details">
                                    <div class="username">
                                        <span class="bold" style="margin-left: 20px;"><?=$userDetails['user_info']->first_name?></span>
                                        <span style="font-size: 12px; font-weight: bold; margin-right:10px">(<?=$userDetails['user_info']->username;?>)</span>
                                    </div>
                                </div>
                            </a>
                            <?php
                                $path = base_url().'profile_img/';
                                if($userDetails['user_info']->profile_img != NULL){
                                    $img_url = $path.$userDetails['user_info']->profile_img;
                                }else{
                                    $img_url = $path.'no-img.png';
                                }
                            ?>
                            <div class="profile-pic"> <img src="<?=$img_url?>" alt="Profile Image" data-src="<?=$img_url?>" data-src-retina="<?=$img_url?>" width="35" height="35" />
                            </div>
                        </div>

                        <ul class="nav quick-section" style="margin-left: 0px;">
                            <li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right "
                                    href="javascript:;" id="user-options"> <i class="fa fa-cog" style="font-size: 22px; color: #8dc641 !important;"></i> </a>
                                <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                                    <li class="divider"></li>
                                    <li><a href="<?=base_url('acl/edit_user').'/'.$userDetails['user_info']->id?>"><i class="fa fa-user"></i> Profile</a></li>
                                    <li><a href="<?=base_url('logout')?>"><i class="fa fa-power-off"></i> Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div> <!-- END CHAT TOGGLER -->
                </div> <!-- END TOP NAVIGATION MENU -->
            </div> <!-- END TOP NAVIGATION BAR -->
        </div> <!-- END HEADER -->


        <?php $low = 0; ?>
        <!-- BEGIN CONTAINER -->
        <div class="page-container row-fluid">
            <?php if($this->router->fetch_class('my_message') == 'my_message'){ ?>
            <div class="page-sidebar mini mini-mobile" id="main-menu" data-inner-menu="1">
                <div class="page-sidebar-wrapper">
                    <?php }else{ ?>
                    <div class="page-sidebar" id="main-menu">
                        <div class="page-sidebar-wrapper" id="main-menu-wrapper">
                            <?php } ?>
                            <div class="user-info-wrapper"
                                style=" padding-bottom: 10px; border-bottom: 1px solid #db0424;">
                                <div class="user-info" style="background-color: white; ">
                                    <span style="color: #683091">Login as:</span>
                                    <span class="label label-success">
                                        <?php  ;
                                        $t=$this->ion_auth->groupe($this->session->userdata['user_id']);

                                        ?>
                                        <strong><?= $t->name ?></strong></span>
                                </div>
                            </div>

                            <!-- BEGIN SIDEBAR MENU -->
                            <ul class="pull-left">
                                <li class="start <?=backend_activate_menu_class('dashboard')?>">
                                    <a href="<?=base_url('dashboard');?>"> <i class="icon-custom-home"></i> <span class="title">Asset Dashboard</span></a>
                                </li>
                                <!-- Purchase section -->
                                <?php
                                    if ($this->ion_auth->in_group(array('sm'))) {
                                       $pn = $per_ntfy->sm + $per_ntfy->sm1 + $per_ntfy->sm2 + $per_ntfy->ret;
                                    } elseif ($this->ion_auth->in_group(array('do'))) {
                                       $pn = $per_ntfy->do + $per_ntfy->do1;
                                    } else if ($this->ion_auth->in_group(array('admin'))) {
                                       $pn = $per_ntfy->dg;
                                    } else {
                                       $pn = 0;
                                    }
                                    $unit_id = $this->session->userdata('unit_id');
                                ?>

                                <!-- New Asset Management Sub-menu -->
                                <li class="start <?=backend_activate_menu_class('depreciation')?> <?=backend_activate_menu_class('disposal')?> <?=backend_activate_menu_class('movement')?>">
                                    <a href="javascript:;"> <i class="fa fa-money"></i><span class="title">Asset Management</span> <span class="selected"></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">
                                        <li> <a href="<?=base_url('depreciation');?>"><i class="fa fa-info"></i> Depreciation </a> </li>
                                        <li> <a href="<?=base_url('disposal');?>"><i class="fa fa-plus-square-o"></i> Disposal </a> </li>
                                        <li> <a href="<?=base_url('movement');?>"> <i class="fa fa-plus-square"></i> Movement </a> </li>
                                        <li> <a href="<?=base_url('qrimages');?>"><i class="fa fa-tags"></i> Generate Asset Tags </a> </li>
                                        <li> <a href="<?=base_url('excel_import');?>"> <i class="fa fa-arrow-down"></i> Import Assets </a> </li>
                                        <li> <a href="<?=base_url('assets/export');?>"> <i class="fa fa-arrow-up"></i> Export Assets </a> </li>
                                    </ul>
                                </li>

                                <!-- Report section -->
                                <?php if($this->ion_auth->in_group(array('admin','do','sm'))){ ?>
                                    <li class="start <?=backend_activate_menu_class('cbs_integration')?>">
                                        <a href="javascript:;"> <i class="fa fa-money"></i><span class="title">CBS Integration</span> <span class="selected"></span> <span class="arrow"></span> </a>
                                        <ul class="sub-menu">
                                            <li> <a href="<?=base_url('cbs_integration/gl_account_mapping');?>"> <i class="fa fa-globe"></i> GL Account Mapping </a> </li>
                                            <li> <a href="<?=base_url('cbs_integration/reconciliation_report');?>"> <i class="fa fa-file-text"></i> Reconciliation Report </a> </li>
                                        </ul>
                                    </li>
                                    <li class="start <?=backend_activate_menu_class('reports')?>"> <a href="javascript:;"> <i class="fa fa-th"></i><span class="title">Reports</span> <span class="selected"></span> <span class="arrow"></span> </a>
                                        <ul class="sub-menu">
                                            <li> <a href="<?=base_url('reports/asset_register_report');?>"><i class="fa fa-file-text"></i> Asset Register Report </a> </li>
                                            <li> <a href="<?=base_url('reports/depreciation_schedule_report');?>"><i class="fa fa-file-text"></i> Depreciation Schedule Report </a> </li>
                                            <li> <a href="<?=base_url('reports/disposal_gain_loss_report');?>"> <i class="fa fa-file-text"></i> Disposal Gain/Loss Report </a> </li>
                                            <li> <a href="<?=base_url('reports/asset_movement_history_report');?>"> <i class="fa fa-file-text"></i> Asset Movement History Report </a> </li>
                                            <li> <a href="<?=base_url('reports/custom_asset_report');?>"> <i class="fa fa-file-text"></i> Custom Asset Report </a> </li>
                                        </ul>
                                    </li>
                                <?php } ?>

                                <?php if($this->ion_auth->in_group(array('admin','do','sm'))){
                                    $low = $this->Common_model->count_low_stock();
                                } ?>
                                <!-- Item Setup section -->
                                <?php if($this->ion_auth->in_group(array('admin','do','sm'))){ ?>
                                <li class="start <?=backend_activate_menu_class('items')?>">
                                    <a href="javascript:;"> <i class="fa fa-tags"></i><span class="title">Item Setup </span> <span class="selected"></span> <span class="badge badge-danger pull-right"><?=$low?></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">
                                        <li> <a href="<?=base_url('items');?>"><i class="fa fa-list"></i> Item List </a> </li>
                                        <li> <a href="<?=base_url('items/stock');?>"><i class="fa fa-list"></i> Stock List </a> </li>
                                        <li> <a href="<?=base_url('items/low_stock');?>"><i class="fa fa-list"></i> Low Stock <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$low?></span></a> </li>
                                    </ul>
                                </li>
                                <?php } ?>

                                <!-- General Setting  -->
                                <?php if($this->ion_auth->in_group(array('admin','do','sm'))){ ?>
                                <li class="start <?=backend_activate_menu_class('general_setting')?>"> <a
                                        href="javascript:;"> <i class="fa fa-cogs"></i> <span class="title">General
                                            Setting</span> <span class="selected"></span> <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li> <a href="<?=base_url('general_setting/item_locker');?>"><i class="fa fa-file"></i>Item Locker</a></li>
                                        <li> <a href="<?=base_url('general_setting/locker_setup');?>"><i class="fa fa-lock"></i> Locker Setup</a></li>
                                        <li> <a href="<?=base_url('general_setting/room_setup');?>"> <i class="fa fa-home"></i> Room Setup</a></li>
                                        <li> <a href="<?=base_url('general_setting/sub_categories');?>"> <i class="fa fa-list"></i> Sub Categories</a></li>
                                        <li> <a href="<?=base_url('general_setting/categories');?>"> <i class="fa fa-bars"></i> Categories</a></li>
                                        <li> <a href="<?=base_url('general_setting/item_unit');?>"><i class="fa fa-th-list"></i> Item Unit</a></li>
                                        <li> <a href="<?=base_url('general_setting/department');?>"> Department</a></li>
                                        <li> <a href="<?=base_url('general_setting/designation');?>"> Designation</a>
                                        <li> <a href="<?=base_url('general_setting/units');?>"> Division </a>
                                        <li> <a href="<?=base_url('general_setting/division_type');?>"> Division Type </a>
                                        <!-- <li> <a href="<?=base_url('general_setting/group');?>"> Group</a> -->
                                        </li>
                                        <li> <a href="<?=base_url('custom_fields');?>"> Custom Fields</a></li>
                                    </ul>
                                </li>
                                <?php } ?>

                                <!-- User ACL -->
                                <?php if($this->ion_auth->in_group(array('admin','do'))){ ?>
                                <li class="start <?=backend_activate_menu_class('acl')?>"> <a href="javascript:;"> <i
                                            class="fa fa-key"></i> <span class="title">Access Control</span> <span
                                            class="selected"></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">
                                        <li> <a href="<?=base_url('acl');?>"> User List </a> </li>
                                    </ul>
                                </li>
                                <?php } ?>
                                <li class="start"><a href="<?=base_url('logout')?>">
                                        <i class="fa fa-power-off"></i>
                                        <span class="title">Log Out</span> </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                            <!-- END SIDEBAR MENU -->
                        </div>
                    </div>

                    <a href="#" class="scrollup">Scroll</a>

                    <div class="footer-widget">
                        <div class="copyrights pull-left" style="width: 50%">
                        </div>
                        <div class="copyrights pull-right" style="width: 50%">
                        </div>
                    </div>
                <!-- END SIDEBAR -->
