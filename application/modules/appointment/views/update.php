<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('appointment')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
<?php
   if($info->schedule_type == 'Invitation') {
      $displayAppDiv = 'display:none;';
      $displayInvDiv = 'display:block;';
   }else{
      $displayAppDiv = 'display:block;';
      $displayInvDiv = 'display:none;';
   }
?>
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('appointment')?>" class="btn btn-blueviolet btn-xs btn-mini"> Appointment List</a>  
                  </div>
               </div>
               <div class="grid-body">

                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  
                  <?php 
                  echo validation_errors(); 
                  $attributes = array('id' => 'jsvalidate');
                  echo form_open_multipart(uri_string(), $attributes);

                  $start_date = date('Y-m-d', strtotime($info->date));
                  $start_time = date('h:i A', strtotime($info->date));
                  $end_date = date('Y-m-d', strtotime($info->date_end));
                  $end_time = date('h:i A', strtotime($info->date_end));
                  ?>

                  <div class="row">
                     <div class="col-md-8">
                        <fieldset >      
                           <legend>Schedule Info</legend>
                           <div class="row form-row">
                              <div class="col-md-3">
                                 <label class="form-label">Schedule Type <span class='required'>*</span></label>
                                 <?php echo form_error('schedule_type');
                                 $more_attr = 'class="form-control input-sm" id="schedule_type"';
                                 echo form_dropdown('schedule_type', $type_dd, set_value('schedule_type', $info->schedule_type), $more_attr);
                                 ?>
                              </div>
                              <div class="col-md-3" style="width: 20%;">
                                 <label class="form-label">Start Date <span class='required'>*</span></label>
                                 <?php echo form_error('start_date');?>
                                 <input name="start_date" value="<?=set_value('start_date', $start_date)?>" type="text" class="form-control input-sm datepicker" placeholder="">
                              </div>
                              <div class="col-md-2">
                                 <label class="form-label">Start Time <span class='required'>*</span></label>
                                 <?php echo form_error('start_time');?>
                                 <input name="start_time" value="<?=set_value('start_time', $start_time)?>" type="text" class="form-control input-sm timepicker" placeholder="">
                              </div>
                              <div class="col-md-3" style="width: 20%;">
                                 <label class="form-label">End Date <span class='required'>*</span></label>
                                 <?php echo form_error('end_date');?>
                                 <input name="end_date" value="<?=set_value('end_date', $end_date)?>" type="text" class="form-control input-sm datepicker" placeholder="">
                              </div>
                              <div class="col-md-2">
                                 <label class="form-label">End Time <span class='required'>*</span></label>
                                 <?php echo form_error('end_time');?>
                                 <input name="end_time" value="<?=set_value('end_time', $end_time)?>" type="text" class="form-control input-sm timepicker" placeholder="">
                              </div>
                           </div>
                           
                           <div class="row form-row">
                              <div class="col-md-6">
                                 <label class="form-label">Schedule Title / Event Name <span class='required'>*</span></label>
                                 <?php echo form_error('title');?>
                                 <input type="text" name="title" value="<?=set_value('title', $info->title)?>" class="form-control input-sm" placeholder="">
                              </div> 
                              <div class="col-md-6">
                                 <label class="form-label">Venue <span class='required'>*</span></label>
                                 <?php echo form_error('venue');?>
                                 <input type="text" name="venue" value="<?=set_value('venue', $info->venue)?>" class="form-control input-sm" placeholder="">
                              </div>
                              <div class="col-md-12">
                                 <label class="form-label">Purpose</label>
                                 <?php echo form_error('purpose');?>            
                                 <textarea name="purpose" class="form-control"><?=set_value('purpose', $info->purpose)?></textarea>
                              </div>
                           </div>

                        </fieldset>
                     </div>

                     <div class="col-md-4">
                        <fieldset>      
                           <legend>Contact Person</legend>
                           <div class="row form-row">
                              <div class="col-md-12">
                                 <label class="form-label">Name </label>
                                 <?php echo form_error('person_name');?>
                                 <input type="text" name="person_name" value="<?=set_value('person_name', $info->person_name)?>" class="form-control input-sm" placeholder="">
                              </div>                              
                              <div class="col-md-6">
                                 <label class="form-label">Mobile No </label>
                                 <?php echo form_error('person_mobile_no');?>
                                 <input type="text" name="person_mobile_no" value="<?=set_value('person_mobile_no', $info->person_mobile_no)?>" class="form-control input-sm" placeholder="">
                              </div>
                              <div class="col-md-6">
                                 <label class="form-label">Email</label>
                                 <?php echo form_error('person_email');?>
                                 <input type="text" name="person_email" value="<?=set_value('person_email', $info->person_email)?>" class="form-control input-sm" placeholder="">
                              </div>
                              <div class="col-md-12">
                                 <label class="form-label">Organization/Office Name</label>
                                 <?php echo form_error('organization');?>
                                 <input type="text" name="organization" value="<?=set_value('organization', $info->organization)?>" class="form-control input-sm" placeholder="">
                              </div>
                           </div>
                        </fieldset>
                     </div>
                  </div>

                  <br>

                  <div class="row form-row">
                     <div class="col-md-12 appointmentDiv" style="<?=$displayAppDiv?>">
                        <fieldset>      
                           <legend>Appointment Person List</legend>
                           <!-- <span><em style="color: #f73838; font-size: 15px;">Minimum 1 person information must be enter. Click <strong>Add More</strong> button for creating add more person. </em></span> -->

                           <style type="text/css">
                              #appRowDiv td{padding: 5px; border-color: #ccc;}
                              #appRowDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}                        
                           </style>                              
                           <div id="msgPerson"> </div>
                           <table width="100%" border="1" id="appRowDiv">
                              <tr>
                                 <th width="20%">Name <span class="required">*</span></th>
                                 <th width="20%">Designation</th>
                                 <th width="20%">Office/Address</th>
                                 <th width="15%">Mobile No</th>
                                 <th width="8%"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </th>
                              </tr>
                              <?php foreach ($persons as $row) { ?>
                              <tr>
                                 <td><input name="name[]" value="<?=$row->name?>" type="text" class="form-control input-sm"></td></td>
                                 <td><input name="designation[]" value="<?=$row->designation?>" type="text" class="form-control input-sm"></td>
                                 <td><input name="office_address[]" value="<?=$row->office_address?>" type="text" class="form-control input-sm"></td>
                                 <td><input name="mobile_no[]" value="<?=$row->mobile_no?>" type="text" class="form-control input-sm"></td>
                                 <td width="100"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowPersonFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> Remove</a> </td>
                                 <input type="hidden" name="hide_name[]" value="<?=$row->id?>">
                              </tr>
                              <?php } ?>
                              <tr></tr>
                           </table>
                           
                        </fieldset>
                     </div>

                     <div class="col-md-12 invitationDiv" style="<?=$displayInvDiv?>">
                        <fieldset>      
                           <legend>Invitation Information</legend>
                           <div class="col-md-4">
                              <label class="form-label">Name of Chair <span class='required'>*</span></label>
                              <?php echo form_error('event_name_chair');?>
                              <input type="text" name="event_name_chair" value="<?=set_value('event_name_chair', $info->event_name_chair)?>" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Name of Chief Guest </label>
                              <?php echo form_error('event_chief_guest');?>
                              <input type="text" name="event_chief_guest" value="<?=set_value('event_chief_guest', $info->event_chief_guest)?>" class="form-control input-sm" placeholder="">
                           </div>
                           <div class="col-md-4">
                              <label class="form-label">Name of Special Guest </label>
                              <?php echo form_error('event_special_guest');?>
                              <input type="text" name="event_special_guest" value="<?=set_value('event_special_guest', $info->event_special_guest)?>" class="form-control input-sm" placeholder="">
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
      //Load First row
      // addNewRow();

      // JS Validation
      $('#jsvalidate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            schedule_type: { required: true },
            title: { required: true },            
            venue: { required: true },
            start_date: { required: true },
            start_time: { required: true },
            end_date: { required: true },
            end_time: { required: true }
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


   // Hide/Show Function
   // $('.invitationDiv').hide();
   $('#schedule_type').change(function(){
      var id = $('#schedule_type').val();
      // alert(id);
      if(id == 'Invitation'){
         $('.invitationDiv').show();
         $('.appointmentDiv').hide();
      }else{
         $('.invitationDiv').hide();
         $('.appointmentDiv').show();
      }
   });


   // Add multiple person
   $("#addRow").click(function(e) {
      addNewRow();
   }); 
   //remove row
   function removeRow(id){ 
      $(id).closest("tr").remove();
   }
   //add row function
   function addNewRow(){
      var items = '';
      items+= '<tr>';
      items+= '<td><input name="name[]" value="" type="text" class="form-control input-sm"></td>';
      items+= '<td><input name="designation[]" value="" type="text" class="form-control input-sm"></td>';
      items+= '<td><input name="office_address[]" value="" type="text" class="form-control input-sm"></td>';
      items+= '<td><input name="mobile_no[]" value="" type="text" class="form-control input-sm"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
      items+= '</tr>';

      $('#appRowDiv tr:last').after(items);
      //scout_id_select2_dd();
   } 

   function removeRowPersonFunc(id){ 
      var dataId = $(id).attr("data-id");

      if (confirm("Are you sure you want to delete this information from database?") == true) {
         $.ajax({
          type: "POST",
          url: hostname+"appointment/ajax_app_person_del/"+dataId,
          success: function (response) {
            $("#msgPerson").addClass('alert alert-success').html(response);
            $(id).closest("tr").remove();
         }
      });
      }
   }
</script>  