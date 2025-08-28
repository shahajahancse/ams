<div class="page-content"> 
   <div class="content">  
      <div class="row">
         <div class="col-md-12">
            <div class="tiles white">
               <div class="row">
                  <div class="col-md-12 col-sm-12" style="margin-top: 20px;">
                     <div class="grid simple horizontal">
                        <div class="grid-title">
                           <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                           <div class="pull-right">                
                              <a href="<?=base_url('my_profile')?>" class="btn btn-primary btn-xs btn-mini"> My Profile</a> 
                           </div>
                        </div>
                        <div class="grid-body">
                           <div><?php //echo validation_errors(); ?></div>
                           <?php if($this->session->flashdata('success')):?>
                              <div class="alert alert-success">
                                 <?php echo $this->session->flashdata('success');;?>
                              </div>
                           <?php endif; ?>
                           <?php 
                           $attributes = array('id' => 'profile_basic_info_validation');
                           echo form_open(uri_string('my_profile/update_donation'));?>

                           <div class="row">
                              <?php //echo $userDetails['user_info']->is_request; ?>
                              <div class="col-md-12">
                                 <div class="row form-row">
                                    <div class="col-md-4">
                                       <label class="form-label">Last Donate Date<span class="required"> * </span></label>
                                       <?php echo form_error('last_donate_date'); ?>
                                       <input type="text" name="last_donate_date" class="form-control input-sm datetime" value="<?=set_value('last_donate_date', date_browse_format($info->last_donate_date))?>" placeholder="DD-MM-YYYY">
                                    </div>
                                    <div class="col-md-4">
                                       <label class="form-label">Blood Donate Interested <span class="required"> * </span></label>
                                       <?php echo form_error('gender'); ?>
                                       <input type="radio" name="blood_donate_interested" value="Yes" <?=$info->blood_donate_interested=='Yes'?'checked':'';?>> <span style="color: black; font-size: 14px;">Yes</span> 
                                       <input type="radio" name="blood_donate_interested" value="No" <?=$info->blood_donate_interested=='No'?'checked':'';?>> <span style="color: black; font-size: 14px;">No</span>
                                    </div>
                                 </div>
                              </div>
                           </div> <!-- /row -->

                           <div class="form-actions">  
                              <div class="pull-right">
                                 <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-small btn-cons'"); ?>
                                 <a href="<?=base_url('my_profile')?>" class="btn btn-white btn-small btn-cons">Cancel</a>
                              </div>
                           </div>
                           <?php echo form_close();?>
                        </div>  <!-- END GRID BODY -->              
                     </div> <!-- END GRID -->
                  </div> <!-- </end col 9> -->
               </div>
            </div>
         </div>  
      </div> <!-- </end row> -->
   </div>
</div>