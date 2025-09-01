   <style type="text/css">
      .btn-cons{font-size: 20px;}
   </style>
   <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
      .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#000000;background-color:#E0FFEB; vertical-align: middle;}
      .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
      .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right; width: 150px;}
      .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
   </style>

<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('purchase')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right"> </div>
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
                     echo form_open_multipart('requisition/change_status/'.$info->id, $attributes);
                  ?>
                  <!-- purchase title info -->
                  <div class="row">
                     <div class="col-md-12">
                        <fieldset >
                           <legend>Requisition Information</legend>
                           <?php
                              $status = '<span class="label label-secondary">Pending</span>';
                              if ($info->status == 2) {
                                 $status = '<span class="label label-warning">On process</span>';
                              }else if($info->status == 3){
                                 $status = '<span class="label label-primary">SM Approve</span>';
                              }else if($info->status == 4){
                                 $status = '<span class="label label-info">Back User From DO</span>';
                              }else if($info->status == 5){
                                 $status = '<span class="label label-blueviolet">Approve</span>';
                              }else if($info->status == 6){
                                 $status = '<span class="label label-primary">Delivered</span>';
                              }else if($info->status == 7){
                                 $status = '<span class="label label-danger">Rejected</span>';
                              } else {
                                 $status = '<span class="label label-secondary">Draft/Delete</span>';
                              }
                           ?>

                           <div class="row">
                              <div class="col-md-12">
                                 <table class="tg" width="100%">
                                    <tr>
                                       <th class="tg-khup">Title </th>
                                       <td class="tg-ywa9"><?=$info->title?></td>
                                       <th class="tg-khup">Status</th>
                                       <td class="tg-ywa9"><?=$status?></td>
                                       <th class="tg-khup">Date</th>
                                       <td class="tg-ywa9"><?= date('d-m-Y', strtotime($info->created_at)); ?></td>
                                    </tr>
                                    <tr>
                                       <th class="tg-khup"> Applicant</th>
                                       <td colspan='2' class="tg-ywa9"><?=$userDetails['user_info']->first_name?></td>
                                       <th class="tg-khup"> Designation </th>
                                       <td colspan='2' class="tg-ywa9"><?=$userDetails['user_info']->desig_name?></td>
                                    </tr>
                                 </table>
                              </div>
                           </div>
                        </fieldset>
                     </div>
                  </div>
                  <!-- purchase title info -->

                  <!-- change purchase status (app, reject)-->
                  <div class="row form-row">
                     <?php if($this->ion_auth->in_group(array('sm'))) { ?>
                     <div class="col-md-6" style="margin-bottom: 20px;: ">
                        <label class="form-label">Status Type <span class='required'>*</span></label>
                        <input type="radio" name="status" value="2" <?=$info->status=='2'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong> Draft &nbsp;</strong></span>

                        <input type="radio" name="status" value="3" <?=$info->status=='2'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>Forward To DO &nbsp;</strong></span>

                        <input type="radio" name="status" value="7" <?=$info->status=='7'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>Reject</strong></span>
                        <div id="typeerror"></div>
                     </div>
                     <?php } ?>

                     <?php if($this->ion_auth->in_group(array('do'))) { ?>
                     <div class="col-md-6" style="margin-bottom: 20px;: ">
                        <label class="form-label">Status Type <span class='required'>*</span></label>
                        <input type="radio" name="status" value="5" <?=$info->status=='3'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>Approved</strong></span>
                        <input type="radio" name="status" value="4" <?=$info->status=='4'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>Back To user</strong></span>
                        <input type="radio" name="status" value="7" <?=$info->status=='7'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>Reject</strong></span>
                        <div id="typeerror"></div>
                     </div>
                     <?php } ?>
                  </div>
                  <!-- change purchase status (app, reject)-->

                  <div class="row form-row">
                     <div class="col-md-12">
                        <style type="text/css">td{color: black; font-size: 15px;}</style>
                        <fieldset>
                           <legend>Requisition List</legend>
                           <style type="text/css">
                              #appRowDiv td{padding: 5px; border-color: #ccc;}
                              #appRowDiv th{padding: 5px;text-align:left;border-color: #ccc; color: black;}
                           </style>
                           <div id="msgPerson"> </div>
                           <table width="100%" border="1" id="appRowDiv">
                              <tr>
                                 <th width="20%">Item Name <span class="required">*</span></th>
                                 <th width="15%">Qty. Request</th>
                                 <th width="15%"> Qty. Correction </th>
                                 <th width="10%"> Unit </th>
                                 <th width="20%">Remark</th>
                              </tr>

                              <?php foreach($purchase_item_data as $item){
                                 $qty_approve = $item->qty_approve == 0 ? $item->qty_request : $item->qty_approve;
                              ?>
                              <tr>
                                 <td><?=$item->item_name?></td>
                                 <td><?=$item->qty_request?>  <?=$item->unit_name?></td>
                                 <td><input name="qty_approve[]"  value="<?=$qty_approve?>" class="form-control input-sm"></td>
                                 <td><?=$item->unit_name?></td>
                                 <td><?=$item->remark?></td>
                                 <input type="hidden" name="hide_id[]" value="<?=$item->id?>">
                              </tr>
                              <?php } ?>
                           </table>
                        </fieldset>
                     </div>
                     <div class="col-md-12">
                        <label for=""> Description </label>
                        <textarea name="description" class="form-control input-sm" rows="3" ><?=$info->description?></textarea>
                     </div>
                     <div class="col-md-12">
                        <div class="pull-right">
                           <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                        </div>
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
$category_data = '';
foreach ($categories as $key => $value) {
   $category_data .= '<option value="'.$key.'">'.$value.'</option>';
}
?>

<script type="text/javascript">
   $(document).ready(function() {
      //Load First row
      // addNewRow();

      // JS Validation
      $('#jsvalidate').validate({
         // focusInvalid: false,
         ignore: "",
         rules: {
            title: { required: true }
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
      // id="category_'+sl+'"
      var sl=$('#count').val();
      var items = '';
      items+= '<tr>';
      // items+= '<td><input type="hidden" name="sl[]" value="1" ></td>';
      items+= '<td><select name="item_cate_id[]" class="form-control input-sm" id="category_'+sl+'" ><?php echo $category_data;?></select></td>';
      items+= '<td><select name="item_sub_cat_id[]"  id="subcategory_'+sl+'" class="sub_category_val_'+sl+' form-control input-sm"><option value="">-- Select One --</option></select></td>';
      items+= '<td><select name="pur_item_id[]" class="item_val_'+sl+' form-control input-sm"><option value="">-- Select One --</option></select></td>';
      items+= '<td><input name="pur_quantity[]" value="" type="text" class="form-control input-sm"></td>';
      items+= '<td> <textarea name="pur_remark[]" value=""  type="text" class="form-control input-sm"></textarea></td>';
      items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
      items+= '</tr>';
      $('#count').val(sl+1);
      $('#appRowDiv tr:last').after(items);
      category_dd(sl);
      subcategory_dd(sl);
   }

   function category_dd(sl){
      //Category Dropdown
      $('#category_'+sl).change(function(){
         $('.sub_category_val_'+sl).addClass('form-control input-sm');
         $('.sub_category_val_'+sl+' > option').remove();
         var id = $('#category_'+sl).val();

         $.ajax({
            type: "POST",
            url: hostname +"common/ajax_get_sub_category_by_category/" + id,
            success: function(func_data)
            {
               // console.log(func_data);
               $.each(func_data,function(id,name)
               {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.sub_category_val_'+sl).append(opt);
               });
            }
         });
      });
   }

   function subcategory_dd(sl){
      //Category Dropdown
      $('#subcategory_'+sl).change(function(){
         $('.item_val_'+sl).addClass('form-control input-sm');
         $(".item_val_"+sl+"> option").remove();
         var id = $('#subcategory_'+sl).val();

         $.ajax({
            type: "POST",
            url: hostname +"common/ajax_get_item_by_sub_category/" + id,
            success: function(func_data)
            {
               $.each(func_data,function(id,name)
               {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.item_val_'+sl).append(opt);
               });
            }
         });
      });
   }
</script>
