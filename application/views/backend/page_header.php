<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="icon" type="image/ico" href="<?=base_url('awedget/assets/img/favicon.ico');?>" />
    <title><?=$meta_title?> | BFRI </title>
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
                                    <a href="<?=base_url('dashboard');?>"> <i class="icon-custom-home"></i> <span class="title">Dashboard</span></a>
                                </li>

                                <!-- My Requisition section -->
                                <li class="start <?=backend_activate_menu_class('my_requisition')?>">
                                    <a href="<?=base_url('my_requisition');?>"> <i class="fa fa-tag"></i> <span class="title">My Requisition</span> <span class="badge badge-danger pull-right"><?=$user_ntfy?></span></a>
                                </li>

                                <?php
                                    if ($this->ion_auth->in_group(array('sm'))) {
                                       $nt = $req_ntfy->sm + $req_ntfy->apv;
                                    } elseif ($this->ion_auth->in_group(array('do'))) {
                                       $nt = $req_ntfy->do;
                                    } else {
                                       $nt = 0;
                                    }
                                ?>

                                <?php if($this->ion_auth->in_group(array('admin','do','sm'))){ ?>
                                <li class="start <?=backend_activate_menu_class('requisition')?>"> <a href="javascript:;"><i class="fa fa-tags"></i> <span class="title">Requisition</span> <span class="selected"></span> <span class="badge badge-danger pull-right"><?=$nt?></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">
                                        <?php if ($this->ion_auth->in_group(array('sm'))) { ?>
                                        <li> <a href="<?=base_url('requisition/request_list');?>">Pending  List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$req_ntfy->sm?></span></a></li>
                                        <li> <a href="<?=base_url('requisition/approve_list');?>">Approved List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$req_ntfy->apv?></span></a> </li>
                                        <?php } else { ?>
                                        <li> <a href="<?=base_url('requisition/request_list');?>">Pending  List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$nt?></span></a></li>
                                        <li> <a href="<?=base_url('requisition/approve_list');?>">Approved List </a> </li>
                                        <?php } ?>

                                        <li> <a href="<?=base_url('requisition/rejected_list');?>">Rejected List </a> </li>
                                        <li> <a href="<?=base_url('requisition/delivered_list');?>">Delivered List </a> </li>
                                    </ul>
                                </li>
                                <?php } ?>

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

                                <!-- Direct Purchase section -->
                                <?php if($this->ion_auth->in_group(array('admin','sm','do'))){ ?>
                                <li class="start <?=backend_activate_menu_class('direct_purchase')?>">
                                    <a href="<?=base_url('direct_purchase');?>"> <i class="fa fa-tag"></i> <span class="title"> Direct Purchase</span></a>
                                </li>
                                <?php } ?>

                                <!-- Purchase section -->
                                <?php if($this->ion_auth->in_group(array('admin','sm','do'))){ ?>
                                <li class="start <?=backend_activate_menu_class('purchase')?>"> <a href="javascript:;"><i class="fa fa-tags"></i> <span class="title">Purchase</span> <span class="selected"></span> <span class="badge badge-danger pull-right"><?=$pn + $per_ntfy->ret?></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">
                                        <li> <a href="<?=base_url('purchase');?>"> Purchase List </a> </li>

                                        <?php if($this->ion_auth->in_group(array('sm'))){ ?>
                                        <li> <a href="<?=base_url('purchase/purchase_pending');?>">Pending List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$per_ntfy->sm + $per_ntfy->sm2;?></span></a> </li>
                                        <li> <a href="<?=base_url('purchase/purchase_approved');?>">Approved List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$per_ntfy->sm1;?></span></a> </li>
                                        <?php } else { ?>
                                        <li> <a href="<?=base_url('purchase/purchase_pending');?>">Pending List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$pn?></span></a> </li>
                                        <li> <a href="<?=base_url('purchase/purchase_approved');?>">Approved List </a> </li>
                                        <?php } ?>
                                        <li> <a href="<?=base_url('purchase/purchase_rejected');?>">Rejected List </a> </li>
                                        <li> <a href="<?=base_url('purchase/purchase_received');?>">Received List </a> </li>
                                        <li> <a href="<?=base_url('purchase/return_list');?>">Return List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$per_ntfy->ret;?></span> </a> </li>
                                    </ul>
                                </li>
                                <?php } ?>

                                <!-- Stock In section -->
                                <?php
                                    $pn1 = 0;
                                    if (in_array($unit_id, array(2,3,4)) && $this->ion_auth->in_group(array('sm'))) {
                                        $pn = $stk_ntfy->div_sm;
                                        $pn1 = $stk_ntfy->ds;
                                    } elseif (in_array($unit_id, array(2,3,4)) && $this->ion_auth->in_group(array('do'))) {
                                        $pn = $stk_ntfy->div_do;
                                        $pn1 = $stk_ntfy->ds;
                                    } elseif ($this->ion_auth->in_group(array('sm'))) {
                                        $pn = $stk_ntfy->sm + $stk_ntfy->sm1 + $stk_ntfy->sm2;
                                     } elseif ($this->ion_auth->in_group(array('do'))) {
                                        $pn = $stk_ntfy->do + $stk_ntfy->do1;
                                     } else if ($this->ion_auth->in_group(array('admin'))) {
                                       $pn = $stk_ntfy->dg;
                                    } else {
                                       $pn = 0;
                                    }
                                ?>
                                <?php if($this->ion_auth->in_group(array('admin','sm','do'))){ ?>
                                <li class="start <?=backend_activate_menu_class('stock_in')?>"> <a href="javascript:;"><i class="fa fa-tags"></i> <span class="title">Stock In</span> <span class="selected"></span> <span class="badge badge-danger pull-right"><?=$pn + $pn1?></span> <span class="arrow"></span> </a>
                                    <ul class="sub-menu">
                                        <?php if(!in_array($unit_id, array(1,2,3,4))){ ?>
                                            <li> <a href="<?=base_url('stock_in');?>"> Stock In List </a> </li>
                                        <?php } ?>

                                        <?php if(!in_array($unit_id, array(1,2,3,4)) && $this->ion_auth->in_group(array('sm'))){ ?>
                                        <li> <a href="<?=base_url('stock_in/purchase_pending');?>">Pending List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$stk_ntfy->sm + $stk_ntfy->sm2;?></span></a> </li>
                                        <li> <a href="<?=base_url('stock_in/purchase_approved');?>">Approved List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$stk_ntfy->sm1;?></span></a> </li>
                                        <?php } else { ?>
                                        <li> <a href="<?=base_url('stock_in/purchase_pending');?>">Pending List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$pn?></span></a> </li>
                                        <li> <a href="<?=base_url('stock_in/purchase_approved');?>">Approved List <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$stk_ntfy->ds;?></span></a> </li>
                                        <?php } ?>
                                        <li> <a href="<?=base_url('stock_in/purchase_rejected');?>">Rejected List </a> </li>
                                        <li> <a href="<?=base_url('stock_in/purchase_received');?>">Received List </a> </li>
                                    </ul>
                                </li>
                                <?php } ?>

                                <!-- Report section -->
                                <?php if($this->ion_auth->in_group(array('admin','do','sm'))){ ?>
                                <li class="start <?=backend_activate_menu_class('reports')?>"><a
                                        href="<?=base_url('reports/index')?>"> <i class="fa fa-th"></i><span class="title">Reports</span> </a>
                                </li>
                                <li class="start <?=activate_menu_method('dynamic_report')?>">
                                    <a href="<?=base_url('reports/dynamic_report')?>"> <i class="fa fa-th"></i><span class="title">Dynamic Report</span> </a>
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
                                        <li> <a href="<?=base_url('items');?>"> Item List </a> </li>
                                        <li> <a href="<?=base_url('items/stock');?>"> Stock List </a> </li>
                                        <li> <a href="<?=base_url('items/low_stock');?>"> Low Stock <span class="badge badge-danger" style="float: right; margin-right: 10px;"><?=$low?></span></a> </li>
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
                                        <li> <a href="<?=base_url('general_setting/item_locker');?>">Item Locker</a></li>
                                        <li> <a href="<?=base_url('general_setting/locker_setup');?>">Locker Setup</a></li>
                                        <li> <a href="<?=base_url('general_setting/room_setup');?>">Room Setup</a></li>
                                        <li> <a href="<?=base_url('general_setting/sub_categories');?>">Sub Categories</a></li>
                                        <li> <a href="<?=base_url('general_setting/categories');?>"> Categories</a></li>
                                        <li> <a href="<?=base_url('general_setting/item_unit');?>"> Item Unit</a></li>
                                        <li> <a href="<?=base_url('general_setting/department');?>"> Department</a></li>
                                        <li> <a href="<?=base_url('general_setting/designation');?>"> Designation</a>
                                        <li> <a href="<?=base_url('general_setting/units');?>"> Division </a>
                                        <li> <a href="<?=base_url('general_setting/division_type');?>"> Division Type </a>
                                        <!-- <li> <a href="<?=base_url('general_setting/group');?>"> Group</a> -->
                                        </li>
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
