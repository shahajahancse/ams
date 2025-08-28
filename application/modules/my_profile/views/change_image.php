<link rel="stylesheet" href="<?php print HTTP_CROP_PATH; ?>css/cropper.css">
<style type="text/css">
  .edit-pen{ position: absolute; color: #01579B; background: #fff; padding: 5px; box-shadow: 1px 1px 1px 1px #eee; border-radius: 17px; right: 65px; bottom: 10px; border: 1px solid #f1f1f1;
  }
</style>

<div class="page-content"> 
 <div class="content">  
   <div class="row">

    <div class="col-md-12 col-sm-12" style="margin-top: 20px;">
     <div class="grid simple horizontal">
      <div class="grid-title">
       <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
       <div class="pull-right">                
        <a href="<?=base_url('my_profile')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Profile</a> 
      </div>
    </div>
    <div class="grid-body">
     <?php if($this->session->flashdata('success')):?>
      <div class="alert alert-success">
       <?php echo $this->session->flashdata('success');;?>
     </div>
   <?php endif; ?>
   <?php echo form_open_multipart(uri_string());?>

   <div class="row form-row">
    <div class="col-md-6">
     <div class="form-group">
        <input type="hidden" name="hide_img" id="profile-avatar-url" value="">
        <?php
        if($info->profile_img != NULL){
          $url = base_url('profile_img/').$info->profile_img;
        }else{
          $url = HTTP_IMAGES_PATH .'no-img.png';
        }
        ?>
        <img src="<?php print $url;?>" alt="image" title="Click on the image for change" data-toggle="modal" data-target="#avatar-modal" id="render-avatar" class="circular-fix has-shadow border marg-top10" data-ussuid="<?php print base64_encode(0);?>" data-backdrop="static" data-keyboard="false" data-upltype="avatar" style="width:150px; height:150px; max-width: 150px; max-height: 150px; border: 2px solid black; padding: 3px;"><br>
    </div>
  </div>
  <div class="col-md-6">
   <div class="form-group">
    <label>Note:</label>                          
    <ul>
      <li>Click on the image</li>
      <li>Choose image file (Allowed file type <strong>png</strong>, <strong>jpg</strong>, <strong>jpeg</strong>)</li>
      <li>Then <strong>crop</strong> and <strong>save</strong></li>
      <li>Finally click <strong>upload</strong> button</li>
     <li>Image should be passport size <strong>(Display your ID Card)</strong></li>
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
</div> <!-- </end row> -->
</div>
</div>

<?php $this->load->view('profileAvatar'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.js"></script>
<script src="<?php print HTTP_CROP_PATH; ?>js/cropper.js"></script>
<script src="<?php print HTTP_CROP_PATH; ?>js/main.js"></script>


