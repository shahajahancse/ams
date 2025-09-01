
      <div class="container w-75">
        <div class="secondary_sc_content">
            <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=lang('feedback-form')?></p>
          
              <?php 
                 $attributes = array('id' => 'compalien_validation');
                 echo form_open("site/complain", $attributes);
              ?>
              <div class="container">
                 <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                 
                  <div class="row">
                    
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 pt-2">
                        <div class="row">
                          <div class="col-md-12">
                          <div class="form-group">
                            <label for="formGroupExampleInput"><?=lang('site_complain_name')?></label>
                            <?php echo form_error('name'); ?>
                            <input type="text" name="name" class="form-control" id="" <?=set_value('name')?> placeholder="">
                          </div>
                          </div>
                          <div class="col-md-12">
                          <div class="form-group">
                            <label for="formGroupExampleInput"><?=lang('site_complain_mobile_number')?></label>
                            <?php echo form_error('mobile'); ?>
                            <input type="text" name="mobile" class="form-control" <?=set_value('mobile')?> id="" placeholder="">
                          </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                            <label for="formGroupExampleInput"><?=lang('site_complain_email_address')?></label>
                            <?php echo form_error('email'); ?>
                            <input type="text" name="email" class="form-control" <?=set_value('email')?> id="" placeholder="">
                          </div> 
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                            <label for="formGroupExampleInput"><?=lang('site_complain_address')?></label>
                            <?php echo form_error('address'); ?>
                            <input type="text" name="address" class="form-control" <?=set_value('address')?> id="" placeholder="">
                          </div> 
                          </div>
                          </div>  
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12 pt-2">
                      
                        <div class="form-group">
                            <label for="exampleTextarea" lass="form-label"><?=lang('site_complain_feedback_details')?></label>
                            <?php echo form_error('details'); ?>
                            <textarea class="form-control" name="details" id="exampleTextarea" <?=set_value('details')?> rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn text-white pull-right" style="background-color: #1aa326;"><div class="lead"><?=lang('send')?></div></button>
                    </div>
                </div> <!-- end of row -->
            </div>
          <?php echo form_close();?>
        <div class="py-3"></div>
      </div>
    </div>

    <script type="text/javascript">
$(document).ready(function() {
  $('#compalien_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         name: {
            required: true
         },
         mobile: {
            required: true,
            number: true,
            minlength: 11,
            maxlength: 11
         },
         email: {
          required: true,
            email:true
         },
         address: {
            required: true
         },
         details: {
            required: true
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
});   
</script>