<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <style type="text/css">
      .list-group .leftMenuGroupItem{background-color: #ea5f64;border-color: #ec1c24;padding: .3rem 1.25rem;}
      .list-group i{margin-right:5px}
    </style>
    <?php if ($this->ion_auth->logged_in()): ?>
    <?php /* <div class="log-in-form2 bg-default px-0">
       <div class="list-group">
           <a href="<?=base_url('my-account')?>" class="list-group-item list-group-item-action active leftMenuGroupItem" style=""><i class="fa fa-user fa-1x fa-fw" aria-hidden="true"></i> My Account</a>
       </div>
       <div class="list-group" style="margin-top: 10px;">
           <a href="<?=base_url('my-appointment')?>" class="list-group-item list-group-item-action active leftMenuGroupItem"><i class="fa fa-user fa-1x fa-fw" aria-hidden="true"></i> My Appointment </a>
       </div>
       <div class="list-group" style="margin-top: 10px;">
           <a href="<?=base_url('create-appointment')?>" class="list-group-item list-group-item-action active leftMenuGroupItem"><i class="fa fa-user fa-1x fa-fw" aria-hidden="true"></i> Create Appointment </a>
       </div>
       <div class="list-group" style="margin-top: 10px;">
           <a href="<?=base_url('logout')?>" class="list-group-item list-group-item-action active leftMenuGroupItem"><i class="fa fa-user fa-1x fa-fw" aria-hidden="true"></i> Logout </a>
       </div>
    </div>
    <div class="py-3"></div>
    <?php */ ?>
    <?php endif; ?>

    <div class="log-in-form2 bg-default px-0">
      <div class="list-group" style="font-size:14px;">
        <a href="#" class="list-group-item list-group-item-action active"><strong><?=lang('site_important_link')?></strong></a>
        <a href="http://www.mopme.gov.bd/" class="list-group-item list-group-item-action list-group-item-success" target="_blank"><?=lang('site_portal_mopme')?></a>
        <a href="http://www.moedu.gov.bd/" class="list-group-item list-group-item-action list-group-item-success" target="_blank"><?=lang('site_portal_moedu')?></a>
        <a href="http://www.infokosh.gov.bd/" class="list-group-item list-group-item-action list-group-item-success" target="_blank"><?=lang('site_portal_infokosh')?></a>
        <a href="http://online.forms.gov.bd/" class="list-group-item list-group-item-action list-group-item-success" target="_blank"><?=lang('site_portal_forms')?> </a>
        <a href="http://উত্তরাধিকার.বাংলা/" class="list-group-item list-group-item-action list-group-item-success" target="_blank"><?=lang('site_portal_inheritance')?></a>        
      </div>
    </div>
    <?php /* ?>
    <div class="py-3"></div>
    <div class="log-in-form2 bg-default px-0">
       <div class="list-group">
           <a href="<?=base_url()?>complain" class="list-group-item list-group-item-action  active"><i class="fa fa-comments fa-1x fa-fw" aria-hidden="true" style="margin-right:10px"></i><?=lang('site_page_right')?> </a>
       </div>
    </div>
    <?php */ ?>
  </div>