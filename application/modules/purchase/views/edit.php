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
            <li><a href="<?=base_url('requisition')?>" class="active"><?=$module_name?></a></li>
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
                        echo form_open_multipart('purchase/update/'.$info->id, $attributes);
                     ?>

                     <div class="row">
                        <div class="col-md-12">
                           <fieldset >
                              <legend>Change Approval</legend>
                              <?php
                                 $status = '<span class="label label-secondary">Draft</span>';
                                 if ($row->status == 2) {
                                       $status = '<span class="label label-warning">On process</span>';
                                 }else if($row->status == 3){
                                       $status = '<span class="label label-primary">Back SM From JD</span>';
                                 }else if($row->status == 4){
                                       $status = '<span class="label label-info">Back SM From DG</span>';
                                 }else if($row->status == 5){
                                       $status = '<span class="label label-blueviolet">Approve JD</span>';
                                 }else if($row->status == 6){
                                       $status = '<span class="label label-warning">Back JD From DG</span>';
                                 }else if($row->status == 7){
                                       $status = '<span class="label label-success">Approve DG</span>';
                                 }else if($row->status == 8){
                                       $status = '<span class="label label-important">Rejected</span>';
                                 }
                              ?>

                              <div class="row">
                                 <div class="col-md-12">
                                    <table class="tg" width="100%">
                                       <tr>
                                          <th class="tg-khup"> Title Name</th>
                                          <td class="tg-ywa9"><?=$info->supplier_name?></td>
                                          <th class="tg-khup"> Status </th>
                                          <td class="tg-ywa9"><?=$status?></td>
                                       </tr>

                                       <tr>
                                          <th class="tg-khup"> Created </th>
                                          <td class="tg-ywa9"><?=date('d-m-Y', strtotime($info->created_at)); ?></td>
                                          <th class="tg-khup"> Updated </th>
                                          <td class="tg-ywa9"><?= empty($info->updated_at) ? '' : date('d-m-Y', strtotime($info->updated_at)); ?></td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                     </div>

                     <div class="row form-row">
                        <?php if($this->ion_auth->in_group(array('sm','badmin'))) { ?>
                        <div class="col-md-3" style="margin-bottom: 20px;: ">
                           <label class="form-label">Status Type <span class='required'>*</span></label>
                           <input type="radio" name="status" value="1" <?=$info->status=='1'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>Draft</strong></span>
                           <input type="radio" name="status" value="2" <?=$info->status=='2'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>Forward DO</strong></span>
                           <div id="typeerror"></div>
                        </div>
                        <?php } ?>
                     </div>

                     <div class="row form-row">
                        <div class="col-md-12">
                           <style type="text/css">td{color: black; font-size: 15px;}</style>
                           <fieldset>
                              <legend>Purchase List</legend>
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

                                 <?php foreach($purchase_item_data as $item){ ?>
                                 <tr>
                                    <td><?=$item->item_name?></td>
                                    <td><?=$item->pur_quantity?>  <?=$item->unit_name?></td>
                                    <td><input name="pur_quantity[]"  value="<?=$item->pur_quantity?>" class="form-control input-sm"></td>
                                    <td><?=$item->unit_name?></td>
                                    <td><?=$item->pur_remark?></td>
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
            // $('<span class="error"></span>').insertAfter(element).append(label)
            // var parent = $(element).parent('.input-with-icon');
            // parent.removeClass('success-control').addClass('error-control');

            if (element.attr("name") == "status") {
               label.insertAfter("#typeerror");
            } else {
               $('<span class="error"></span>').insertAfter(element).append(label)
               var parent = $(element).parent('.input-with-icon');
               parent.removeClass('success-control').addClass('error-control');
            }
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
