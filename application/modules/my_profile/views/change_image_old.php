<?php
$scout_id = $info->scout_id;

$path = base_url().'profile_img/';
if($info->profile_img != NULL){
   $img_url = $path.$info->profile_img;
}else{
   $img_url = $path.'no-img.png';
}
?>    
<style type="text/css">
   .info{margin-left: 25px; color: black;}
</style>

<div class="page-content"> 
   <div class="content">  
      <div class="row">
         <div class="col-md-12">
            <div class="tiles white">
               <div class="row">
                  <div class="col-md-2 col-sm-2" style="margin:0 20px;">
                     <div class="user-profile-pic" style="margin-top: 20px;"> 
                        <img width="100" height="100" data-src-retina="<?=$img_url?>" data-src="<?=$img_url?>" src="<?=$img_url?>" alt="" style="border: 5px solid #ccc;">
                     </div>
                     <?php if($scout_id != NULL){ ?>
                     <div class="user-mini-description" style="font-size: 150%;"><h2 class="text-success semi-bold"> BS ID</h2></div>
                     <div class="user-mini-description" style="font-size: 150%;"><h2 class="text-success semi-bold" ><?=$scout_id;?> </h2></div>
                     <?php } ?>

                     <div style="clear: both;"></div>

                     <div class="container" id="crop-avatar">
                         <!-- Current avatar -->
                         <!-- <div class="avatar-view" title="Change the avatar">
                           <img src="<?=base_url()?>awedget/assets/croper/img/picture.jpg" alt="Avatar">
                         </div> -->
                     <!-- Cropping modal -->
                         <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                           <div class="modal-dialog modal-lg">
                             <div class="modal-content">
                               <form class="avatar-form" action="<?=base_url();?>awedget/assets/croper/crop.php" enctype="multipart/form-data" method="post">
                                 <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                 </div>
                                 <div class="modal-body">
                                   <div class="avatar-body">

                                     <!-- Upload image and data -->
                                     <div class="avatar-upload">
                                       <input type="hidden" class="avatar-src" name="avatar_src">
                                       <input type="hidden" class="avatar-data" name="avatar_data">
                                       <label for="avatarInput">Local upload</label>
                                       <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                                     </div>

                                     <!-- Crop and preview -->
                                     <div class="row">
                                       <div class="col-md-9">
                                         <div class="avatar-wrapper"></div>
                                       </div>
                                       <div class="col-md-3">
                                         <div class="avatar-preview preview-lg"></div>
                                         <div class="avatar-preview preview-md"></div>
                                         <div class="avatar-preview preview-sm"></div>
                                       </div>
                                     </div>

                                     <div class="row avatar-btns">
                                       <div class="col-md-9">
                                         <div class="btn-group">
                                           <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees">Rotate Left</button>
                                           <button type="button" class="btn btn-primary" data-method="rotate" data-option="-15">-15deg</button>
                                           <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30">-30deg</button>
                                           <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45">-45deg</button>
                                         </div>
                                         <div class="btn-group">
                                           <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees">Rotate Right</button>
                                           <button type="button" class="btn btn-primary" data-method="rotate" data-option="15">15deg</button>
                                           <button type="button" class="btn btn-primary" data-method="rotate" data-option="30">30deg</button>
                                           <button type="button" class="btn btn-primary" data-method="rotate" data-option="45">45deg</button>
                                         </div>
                                       </div>
                                       <div class="col-md-3">
                                         <button type="submit" class="btn btn-primary btn-block avatar-save">Done</button>
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                               </form>
                             </div>
                           </div>
                         </div><!-- /.modal -->

                         <!-- Loading state -->
                         <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                       </div>


                  </div>

                  <div class="col-md-9 col-sm-9" style="margin-top: 20px;">
                     <div class="grid simple horizontal">
                        <div class="grid-title">
                           <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                           <div class="pull-right">                
                              <a href="<?=base_url('my_profile')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Profile</a> 
                           </div>
                        </div>
                        <div class="grid-body">
                           <div><?php //echo validation_errors(); ?></div>
                           <?php if($this->session->flashdata('success')):?>
                              <div class="alert alert-success">
                                 <a class="close" data-dismiss="alert">&times;</a>
                                 <?php echo $this->session->flashdata('success');;?>
                              </div>
                           <?php endif; ?>
                           <?php //echo form_open_multipart("my_profile/change_image");?>
                           <?php echo form_open_multipart(uri_string());?>

                           <div class="row form-row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Profile Image Upload</label>
                                    <div><?php echo form_error('userfile'); ?></div>
                                    <input type="file" name="userfile">                  
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Note:</label>                          
                                    <ul>
                                       <li>Image should be passport size <strong>(Display your ID Card)</strong></li>
                                       <li>Allowed file type <strong>jpg</strong>, <strong>png</strong>, <strong>jpeg</strong></li>
                                       <li>Maximun file size <strong>512 KB</strong></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>

                           <div class="form-actions">  
                              <div class="pull-right">
                                 <?php echo form_submit('submit', 'Upload', "class='btn btn-primary btn-small btn-cons'"); ?>
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


