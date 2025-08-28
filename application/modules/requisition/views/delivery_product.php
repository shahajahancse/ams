   <div class="page-content">     
      <div class="content">  
         <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
            <li><a href="<?=base_url('requisition')?>" class="active"><?=$module_name?></a></li>
            <li><?=$meta_title; ?></li>
         </ul>

         <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
            .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
            .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
            .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right; width: 150px;}
            .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
         </style>  

         <div class="row">
            <div class="col-md-12">
               <div class="grid simple horizontal">
                  <div class="grid-title">
                     <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                     <div class="pull-right">                
                        <!-- <a href="<?=base_url('appointment')?>" class="btn btn-blueviolet btn-xs btn-mini"> Appointment List</a>   -->
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
                     ?>

                     <div class="row">
                        <div class="col-md-12">
                           <fieldset >      
                              <legend>Verify Code</legend>
                              <div class="row form-row">
                                 <div class="col-md-3">
                                    <label class="form-label">PIN Code <span class='required'>*</span></label>
                                    <input type="text" name="pincode" class="form-control" placeholder="PIN Code">
                                    <input type="hidden" name="hide_req_id" value="<?=$info->id?>">
                                 </div>
                              </div>

                              <?php
                              if($info->status == 2) {
                                 $status = '<span class="label label-success">Approved</span>';
                              }elseif($info->status == 3) {
                                 $status = '<span class="label">Rejected</span>';
                              }else{
                                 $status = '<span class="label label-important">Pending</span>';
                              }
                              ?>

                              <div class="row">
                                 <div class="col-md-12">
                                    <table class="tg" width="100%">
                                       <tr>
                                          <th class="tg-khup"> Requisition Title </th>
                                          <td class="tg-ywa9"><?=$info->title?></td>
                                          <th class="tg-khup"> Status </th>
                                          <td class="tg-ywa9"><?=$status?></td>
                                          <th class="tg-khup">  </th>
                                          <td class="tg-ywa9"></td>
                                       </tr> 
                                       <tr>
                                          <th class="tg-khup"> Created </th>
                                          <td class="tg-ywa9"><?=date('d M, Y h:i A', strtotime($info->created)); ?></td>
                                          <th class="tg-khup"> Updated </th>
                                          <td class="tg-ywa9"><?=date('d M, Y h:i A', strtotime($info->updated)); ?></td>
                                          <th class="tg-khup"> </th>
                                          <td class="tg-ywa9"></td>
                                       </tr> 
                                       <tr>
                                          <th class="tg-khup"> Applicant Name </th>
                                          <td class="tg-ywa9"><?=$info->first_name?></td>
                                          <th class="tg-khup"> Designation </th>
                                          <td class="tg-ywa9"><?=$info->desig_name?></td>
                                          <th class="tg-khup"> Department </th>
                                          <td class="tg-ywa9"><?=$info->dept_name?></td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                     </div>

                     <br>

                     <div class="row form-row">
                        <div class="col-md-12">
                           <fieldset>      
                              <legend>Requisition List</legend>
                              <style type="text/css">
                                 #appRowDiv td{padding: 5px; border-color: #ccc;}
                                 #appRowDiv th{padding: 5px;text-align:center;border-color: #ccc; color: black;}
                              </style>                              
                              <div id="msgPerson"> </div>
                              <table width="100%" border="1" id="appRowDiv">
                                 <tr>
                                    <th width="20%">Item Name <span class="required">*</span></th>
                                    <th width="20%">Qty. Request</th>
                                    <th width="20%"> Qty. Approve </th>
                                    <th width="20%">Remark</th>
                                 </tr>
                                 <?php foreach($items as $item){ ?>
                                 <tr>
                                    <td><?=$item->item_name?></td>
                                    <td><?=$item->qty_request?></td>
                                    <td><?=$item->qty_approve?></td>
                                    <td><?=$item->remark?></td>
                                    <input type="hidden" name="hide_id[]" value="<?=$item->id?>">
                                 </tr>
                                 <?php } ?>
                              </table>

                           </fieldset>
                        </div>

                     </div>


                     <div class="form-actions">  
                        <div class="pull-right">
                           <button type="submit" class="btn btn-primary btn-cons" onclick="return confirm('Are you sure you want delivery product?');"><i class="icon-ok"></i> Release Product </button>
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
            status: { required: true }
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



   // Add multiple person
   // $("#addRow").click(function(e) {
   //    addNewRow();
   // }); 
   // //remove row
   // function removeRow(id){ 
   //    $(id).closest("tr").remove();
   // }
   // //add row function
   // function addNewRow(){
   //    var items = '';
   //    items+= '<tr>';
   //    items+= '<td><input name="name[]" value="" type="text" class="form-control input-sm"></td>';
   //    items+= '<td><input name="designation[]" value="" type="text" class="form-control input-sm"></td>';
   //    items+= '<td><input name="office_address[]" value="" type="text" class="form-control input-sm"></td>';
   //    items+= '<td><input name="mobile_no[]" value="" type="text" class="form-control input-sm"></td>';
   //    items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
   //    items+= '</tr>';

   //    $('#appRowDiv tr:last').after(items);
   //    //scout_id_select2_dd();
   // } 

   // function removeRowPersonFunc(id){ 
   //    var dataId = $(id).attr("data-id");

   //    if (confirm("Are you sure you want to delete this information from database?") == true) {
   //       $.ajax({
   //         type: "POST",
   //         url: hostname+"appointment/ajax_app_person_del/"+dataId,
   //         success: function (response) {
   //          $("#msgPerson").addClass('alert alert-success').html(response);
   //          $(id).closest("tr").remove();
   //       }
   //    });
   //    }
   // }
</script>  