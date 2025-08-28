<?php $scout_id = $info->scout_id; ?>
<div class="page-content"> 
   <div class="content">  
      <!-- <div class="row"> -->
         <!-- <div class="col-md-12"> -->
            <!-- <div class="tiles white"> -->
               <div class="row">
                  <div class="col-md-2 col-sm-2" style="margin:0 20px;">
                     <div class="user-profile-pic" style="margin-top: 20px;"> 
                        <img width="100" height="100" data-src-retina="<?=$img_url?>" data-src="<?=$img_url?>" src="<?=$img_url?>" alt="" style="border: 5px solid #ccc;">
                     </div>
                     <div class="user-mini-description"  style="font-size: 150%;"><h2 class="text-success semi-bold"> BS ID</h2></div>
                     <div class="user-mini-description" style="font-size: 150%;"><h2 class="text-success semi-bold" ><?=$scout_id;?> </h2></div>
                  </div>

                  <div class="col-md-9 col-sm-9" style="margin-top: 20px;">
                     <div class="grid simple horizontal">
                        <div class="grid-title">
                           <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                           <div class="pull-right">                
                              <a href="<?=base_url('my_profile')?>" class="btn btn-primary btn-xs btn-mini"> My Profile</a> 
                           </div>
                        </div>
                        <div class="grid-body">
                           <div><?php echo $message;?></div>
                           <?php if($this->session->flashdata('success')):?>
                              <div class="alert alert-success">
                                 <a class="close" data-dismiss="alert">&times;</a>
                                 <?php echo $this->session->flashdata('success');;?>
                              </div>
                           <?php endif; ?>
                           <?php echo form_open('change_password');?>

                           <div class="row">
                              <div class="col-md-16">
                                 <div class="row form-row">
                                    <div class="col-md-12">
                                        <label class="form-label">Old Password <span class="required"> * </span></label>
                                       <?php echo form_error('old'); ?>
                                       <?php echo form_input($old_password);?>
                                    </div>
                                    <div class="col-md-12">
                                       <label class="form-label">New Password <span class="required"> * </span></label>
                                       <?php echo form_error('new'); ?>
                                       <?php echo form_input($new_password);?>
                                    </div>  
                                    <div class="col-md-12">
                                       <label class="form-label">New Password Confirm <span class="required"> * </span></label>
                                       <?php echo form_error('new_confirm'); ?>
                                       <?php echo form_input($new_password_confirm);?>
                                    </div>     
                                 </div>
                              </div>
                           </div> <!-- /row -->

                           <div class="form-actions">  
                              <div class="pull-right">
                                  <?php echo form_input($user_id);?>
                                 <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-small btn-cons'"); ?>
                                 <a href="<?=base_url('my_profile')?>" class="btn btn-white btn-small btn-cons">Cancel</a>
                              </div>
                           </div>
                           <?php echo form_close();?>
                        </div>  <!-- END GRID BODY -->              
                     </div> <!-- END GRID -->
                  </div> <!-- </end col 9> -->
               </div>
            <!-- </div> -->
         <!-- </div>   -->
      <!-- </div> --> <!-- </end row> -->
   </div>
</div>