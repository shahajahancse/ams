<?php
$scout_id = $info->scout_id; 
$profile_img = $info->profile_img;
$path = base_url().'profile_img/';
if($profile_img != NULL){
 $img_url = $path.$profile_img;
}else{
 $img_url = $path.'no-img.png';
}
?>
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
                     <div class="user-mini-description"  style="font-size: 150%;"><h2 class="text-success semi-bold"> BS ID</h2></div>
                     <div class="user-mini-description" style="font-size: 150%;"><h2 class="text-success semi-bold" ><?=$scout_id;?> </h2></div>
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
                           <div><?php //echo $message;?></div>
                           <?php if($this->session->flashdata('success')):?>
                              <div class="alert alert-success">
                                 <?php echo $this->session->flashdata('success');;?>
                              </div>
                           <?php endif; ?>
                           <?php 
                           $attributes = array('id' => 'username_validate');
                           echo form_open('my_profile/change_username', $attributes);?>

                           <div class="row">
                              <div class="col-md-8">
                                 <h5 class="semi-bold">Current Username: <strong><?=$info->username?></strong></h5>
                                 <label class="form-label">Username or Email <span class="required">*</span> <span style="margin-left: 20px; color: black; font-weight: bold;"><span id="mask_username"></span></span></label> 
                                 <?php echo form_error('identity'); ?>                      
                                 <input name="identity" id="identity" type="text" value="<?=set_value('identity', $info->username)?>" class="form-control input-sm" placeholder="Example: email or username" style="text-transform: lowercase; width: 300px;">
                              </div>
                           </div> <!-- /row -->
                           <br>

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
           </div>
        </div>  
     </div>  <!-- </end row -->
  </div>
</div>


<script type="text/javascript">
   $(document).ready(function() {
      $.validator.addMethod("noSpace", function(value, element) { 
         return value.indexOf(" ") < 0 && value != ""; 
      }, "No space allowed use underscore symbol like ' _ '");

      $('#username_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         identity: {
            required: true, 
            noSpace: true,
            minlength: 3,
            remote: {
               url: hostname +"offices/ajax_exists_identity/",
               type: "post",
               data: {
                  inputData: function() {
                     return $( "#identity" ).val();
                  }
               }
            }         
         }
      },

      messages: {
         identity: {
            required: "Username required.",
            remote: jQuery.format("Already in use! Please try again.")
         }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
         $('<span class="error"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');  
      },

      highlight: function (element) { // hightlight error inputs
         var parent = $(element).parent();
         parent.removeClass('success-control').addClass('error-control'); 
      },

      unhighlight: function (element) { // revert the change done by hightlight

      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function (form) {
         form.submit(); 
      }
   });

   // onChange Method
   $('#identity').keyup(function(){
      // $('#mask_username').html($('#identity').val());
      $('#mask_username').html($(this).val().toLowerCase());
   });
});   
</script>
