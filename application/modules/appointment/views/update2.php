<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('appointment')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('appointment')?>" class="btn btn-blueviolet btn-xs btn-mini"> Appointment List</a>  
                     <a href="<?=base_url('appointment/details/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini">Details</a>    
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart(uri_string(), $attributes);
                  ?>
                  
                  <div class="row">
                     <div class="col-md-6">
                        <fieldset>      
                           <legend>Personal/Program Info</legend>
                           <div class="row form-row">
                              <div class="col-md-12">
                                 <label class="form-label">Name/Title <span class='required'>*</span></label>
                                 <?php echo form_error('title');?>
                                 <input type="text" name="title" value="<?=set_value('title', $info->title)?>" class="form-control input-sm" placeholder="">
                              </div>                              
                              <div class="col-md-6">
                                 <label class="form-label">Mobile No <span class='required'>*</span></label>
                                 <?php echo form_error('mobile_no');?>
                                 <input type="text" name="mobile_no" value="<?=set_value('mobile_no', $info->mobile_no)?>" class="form-control input-sm" placeholder="">
                              </div>
                              <div class="col-md-6">
                                 <label class="form-label">Email</label>
                                 <?php echo form_error('email');?>
                                 <input type="text" name="email" value="<?=set_value('email', $info->email)?>" class="form-control input-sm" placeholder="">
                              </div>
                              <div class="col-md-12">
                                 <label class="form-label">Organization</label>
                                 <?php echo form_error('organization');?>
                                 <input type="text" name="organization" value="<?=set_value('organization', $info->organization)?>" class="form-control input-sm" placeholder="">
                              </div>
                           </div>
                        </fieldset>
                     </div>

                     <div class="col-md-6">
                        <fieldset >      
                           <legend>Schedule Info</legend>
                           <div class="row form-row">
                              <div class="col-md-6">
                                 <label class="form-label">Schedule Type <span class='required'>*</span></label>
                                 <?php echo form_error('schedule_type');
                                 $more_attr = 'class="form-control input-sm"';
                                 echo form_dropdown('schedule_type', $type_dd, set_value('schedule_type', $info->schedule_type), $more_attr);
                                 ?>
                              </div>
                              <div class="col-md-6">
                                 <label class="form-label">Datatime <span class='required'>*</span></label>
                                 <?php echo form_error('date');?>
                                 <input name="date" value="<?=set_value('date', $info->date)?>" type="text" class="form-control input-sm datetimepicker" placeholder="">
                              </div>
                              <div class="col-md-12">
                                 <label class="form-label">Venue <span class='required'>*</span></label>
                                 <?php echo form_error('venue');?>
                                 <input type="text" name="venue" value="<?=set_value('venue', $info->venue)?>" class="form-control input-sm" placeholder="">
                              </div>
                              <div class="col-md-12">
                                 <label class="form-label">Purpose</label>
                                 <?php echo form_error('purpose');?>
                                 <input type="text" name="purpose" value="<?=set_value('purpose', $info->purpose)?>" class="form-control input-sm" placeholder="">
                              </div>

                           </div>

                        </fieldset>
                     </div>
                  </div>

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div>
                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>

<script type="text/javascript">
   $(document).ready(function() {
      $('#jsvalidate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            title: { required: true },
            mobile_no: { required: true },
            schedule_type: { required: true },
            date: { required: true },
            venue: { required: true }
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
         },

      });
   });   
</script>