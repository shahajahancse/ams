<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('my_requisition')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>

      <style type="text/css">
         /*#appointment, #invitation { display: none; }*/
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('my_requisition')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Requisition List</a>  
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
                  echo form_open_multipart("my_requisition/create",$attributes);
                  echo validation_errors();
                  ?>

                  <div class="row">
                     <div class="col-md-12">
                        <fieldset >      
                           <legend>Requisition Information</legend>

                           <div class="row form-row" style="font-size: 16px; color: black;">
                              <div class="col-md-4">
                                 Applicant Name: <strong><?=$info['user_info']->first_name?></strong> 
                              </div>
                              <div class="col-md-4">
                                 Designation Name: <strong><?=$info['user_info']->desig_name?></strong> 
                              </div>
                              <div class="col-md-4">
                                 Department Name: <strong><?=$info['user_info']->dept_name?></strong> 
                              </div>
                           </div>

                           <div class="row form-row">
                              <div class="col-md-6">
                                 <label class="form-label">Requisition Title <span class='required'>*</span></label>
                                 <?php echo form_error('title');?>
                                 <input name="title" value="<?=set_value('title')?>" type="text" class="form-control input-sm" placeholder="">
                              </div>
                              <div class="col-md-12">
                              <p style="text-align: center; color: black; font-size: 18px;">The products / materials described below are intended to be supplied for official use. </p>
                              </div>
                           </div>

                           <div class="row form-row">
                              <div class="col-md-12"> 
                                 <h4 class="semi-bold margin_left_15">Item List <em style="color: #f73838; font-size: 15px;">Click <strong>Add More</strong> button for adding more item. </em></h4>
                                 <style type="text/css">
                                    #appRowDiv td{padding: 5px; border-color: #ccc;}
                                    #appRowDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}                        
                                 </style>                              
                                 <div class="col-md-12" >
                                    <table width="100%" border="1" id="appRowDiv" style="border:1px solid #a09e9e;">
                                       <tr>
                                          <th width="20%">Item Name <span class="required">*</span></th>
                                          <th width="20%">Qty. Request</th>
                                          <th width="20%">Remark</th>
                                          <th width="8%"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> Add More</a> </th>
                                       </tr>
                                       <tr></tr>
                                    </table>
                                 </div>
                              </div>
                              
                              <div class="invitationDiv"> 
                                 <h4 class="semi-bold margin_left_15">Invitation Information</h4>
                                 <div class="col-md-4">
                                    <label class="form-label">Name of Chair <span class='required'>*</span></label>
                                    <?php echo form_error('event_name_chair');?>
                                    <input type="text" name="event_name_chair" value="<?=set_value('event_name_chair')?>" class="form-control input-sm" placeholder="">
                                 </div>
                                 <div class="col-md-4">
                                    <label class="form-label">Name of Chief Guest </label>
                                    <?php echo form_error('event_chief_guest');?>
                                    <input type="text" name="event_chief_guest" value="<?=set_value('event_chief_guest')?>" class="form-control input-sm" placeholder="">
                                 </div>
                                 <div class="col-md-4">
                                    <label class="form-label">Name of Special Guest </label>
                                    <?php echo form_error('event_special_guest');?>
                                    <input type="text" name="event_special_guest" value="<?=set_value('event_special_guest')?>" class="form-control input-sm" placeholder="">
                                 </div>
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

<?php
$item_data = '';
foreach ($items as $key => $value) {
   $item_data .= '<option value="'.$key.'">'.$value.'</option>';
}
?>

<script type="text/javascript">
   $(document).ready(function() {
      //Load First row
      addNewRow();

      // JS Validation
      $('#jsvalidate').validate({
         // focusInvalid: false, 
         ignore: "",
         rules: {
            title: { required: true },
            schedule_type: { required: true },
            date: { required: true },
            date_end: { required: true },
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
         }
      });
   });   


   // 'name[]': { required: true },
   // event_title: { required: "#officeOther:selected" },
   // event_date: { required: true },
   // event_name_chair: { required: true }


   // Hide/Show Function
   $('.invitationDiv').hide();
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
      items+= '<td><select name="item_id[]" class="form-control input-sm" ><?php echo $item_data;?></select></td>';
      items+= '<td><input name="qty_request[]" value="" type="text" class="form-control input-sm"></td>';
      items+= '<td><input name="remark[]" value="" type="text" class="form-control input-sm"></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
      items+= '</tr>';

      $('#appRowDiv tr:last').after(items);
      //scout_id_select2_dd();
   } 

</script>  