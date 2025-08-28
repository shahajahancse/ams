   <style type="text/css">
.btn-cons {
    font-size: 20px;
}
   </style>
   <div class="page-content">
       <div class="content">
           <ul class="breadcrumb">
               <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
               <li><a href="<?=base_url('requisition')?>" class="active"><?=$module_name?></a></li>
               <li><?=$meta_title;?></li>
           </ul>

           <style type="text/css">
           .tg {
               border-collapse: collapse;
               border-spacing: 0;
               border: 0px solid red;
           }

           .tg td {
               font-size: 14px;
               padding: 5px 5px;
               border-style: solid;
               border-width: 1px;
               overflow: hidden;
               word-break: normal;
               border-color: #bbb;
               color: #000000;
               background-color: #E0FFEB;
               vertical-align: middle;
           }

           .tg th {
               font-size: 14px;
               font-weight: bold;
               padding: 3px 5px;
               border-style: solid;
               border-width: 1px;
               overflow: hidden;
               word-break: normal;
               border-color: #bbb;
               color: #493F3F;
               background-color: #bce2c5;
               text-align: center;
           }

           .tg .tg-khup {
               background-color: #efefef;
               vertical-align: top;
               color: black;
               text-align: right;
               width: 150px;
           }

           .tg .tg-ywa9 {
               background-color: #ffffff;
               vertical-align: top;
               color: black;
           }
           </style>

           <div class="row">
               <div class="col-md-12">
                   <div class="grid simple horizontal">
                       <div class="grid-title">
                           <h4><span class="semi-bold"><?=$meta_title;?></span></h4>
                           <div class="pull-right">
                               <!-- <a href="<?=base_url('appointment')?>" class="btn btn-blueviolet btn-xs btn-mini"> Appointment List</a>   -->
                           </div>
                       </div>
                       <div class="grid-body">

                           <?php if ($this->session->flashdata('success')): ?>
                           <div class="alert alert-success">
                               <?=$this->session->flashdata('success');?>
                           </div>
                           <?php endif;?>

                           <?php
echo validation_errors();
$attributes = array('id' => 'jsvalidate');
echo form_open_multipart(uri_string(), $attributes);
?>

                           <div class="row">
                               <div class="col-md-12">
                                   <fieldset>
                                       <legend>Chnage Approval</legend>


                                       <?php
if ($info->status == 2) {
    $status = '<span class="label label-success">Approved</span>';
} elseif ($info->status == 3) {
    $status = '<span class="label">Rejected</span>';
} else {
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
                                                       <td class="tg-ywa9"><?=$status?>
                                                           <?php
if ($info->is_delivered == 1) {
    echo '<span class="label label-success">Delivered</span>';
}

?>

                                                           <!-- </td>
                                          <th class="tg-khup"> Fiscal Year</th>
                                          <td class="tg-ywa9"><?=$info->fiscal_year_name?></td> -->
                                                   </tr>
                                                   <tr>
                                                       <th class="tg-khup"> Created </th>
                                                       <td class="tg-ywa9">
                                                           <?=date('d M, Y h:i A', strtotime($info->created));?></td>
                                                       <th class="tg-khup"> Updated </th>
                                                       <td class="tg-ywa9">
                                                           <?=date('d M, Y h:i A', strtotime($info->updated));?></td>
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
                                                   <tr>
                                                       <th class="tg-khup">Attachment </th>
                                                       <?php if ($info->attachment != '') {?>

                                                       <td class="tg-ywa9"><iframe
                                                               src="<?=base_url('attachment/') . $info->attachment?>"
                                                               frameborder="0"></iframe> </td>
                                                       <?php } else {echo '<td class="tg-ywa9">No File</td>';}?>
                                                   </tr>
                                               </table>
                                           </div>
                                       </div>
                                   </fieldset>

                               </div>
                           </div>

                           <br>

                           <div class="row form-row">
                               <div class="col-md-3" style="margin-bottom: 20px;: ">
                                   <label class="form-label">Status Type <span class='required'>*</span></label>
                                   <?php echo form_error('status');
$pw = $this->ion_auth->get_permission();
?>
                                   <input type="radio" name="status" value="1"
                                       <?=$info->status == '1' ? 'checked' : '';?>
                                       <?=(in_array(1, $pw) ? '' : 'disabled')?>> <span
                                       style="color: black; font-size: 14px;"><strong>Pending</strong></span>
                                   <input type="radio" name="status" value="2"
                                       <?=$info->status == '2' ? 'checked' : '';?>
                                       <?=(in_array(2, $pw) ? '' : 'disabled')?>> <span
                                       style="color: black; font-size: 14px;"><strong>Approve</strong></span>
                                   <input type="radio" name="status" value="3"
                                       <?=$info->status == '3' ? 'checked' : '';?>
                                       <?=(in_array(3, $pw) ? '' : 'disabled')?>> <span
                                       style="color: black; font-size: 14px;"><strong>Reject</strong></span>
                                   <div id="typeerror"></div>
                               </div>

                               <div class="col-md-4" style="margin-bottom: 20px;: ">
                                   <?php
                                    $group_id = $this->ion_auth->get_group_id();
                                    $group_name = $this->ion_auth->get_group_name();
                                    ?>
                                   <label class="form-label">Send To <span class='required'>*</span></label>

                                   <input style="visibility: hidden" type="radio" disabled name="desk_id"
                                       value=" <?=$group_id?>" checked> <span
                                       style="visibility: hidden"><?=$group_name?></span> &nbsp;&nbsp;

                                   <?php echo form_error('status');
                                        $pw = $this->ion_auth->get_pw();
                                        foreach ($pw as $key => $value) {
                                            if ($this->ion_auth->get_group_id() == $value) {
                                                continue;
                                            }
                                            $this->db->where('id', $value);
                                            $query = $this->db->get('groups')->row();
                                            if ($query) {
                                                echo '<input type="radio" name="desk_id" value="' . $query->id . '" >' . $query->name . ' &nbsp;&nbsp;';
                                            }
                                        }
                                    ?>

                                   <div id="typeerror"></div>

                               </div>
                               <div class="col-md-4">
                                   <table class="table table-bordered col-md-12">
                                       <thead>
                                           <tr>
                                               <th>Approver Name</th>
                                               <th>Role</th>
                                               <th>Remark</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <?php
foreach ($final_appruver as $key => $value) {
    $this->db->select('first_name');
    $this->db->where('id', $value->id);
    $query = $this->db->get('users')->row();

    $this->db->select('name');
    $this->db->where('id', $value->role);
    $query2 = $this->db->get('groups')->row();
    echo '<tr><td>' . $query->first_name . '</td><td>' . $query2->name . '</td><td>' . $value->Remark . '</td></tr>';

}
?>
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-md-4">
                                   <table class="table table-bordered col-md-12">
                                       <thead>
                                           <tr>
                                               <th>Verifier Name</th>
                                               <th>Role</th>
                                               <th>Remark</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <?php
foreach ($approve_reject_user as $key => $value) {
    $this->db->select('first_name');
    $this->db->where('id', $value->id);
    $query = $this->db->get('users')->row();

    $this->db->select('name');
    $this->db->where('id', $value->role);
    $query2 = $this->db->get('groups')->row();
    echo '<tr><td>' . $query->first_name . '</td><td>' . $query2->name . '</td><td>' . $value->Remark . '</td></tr>';
}
?>
                                       </tbody>
                                   </table>
                               </div>
                           </div>

                           <div class="row form-row">
                               <div class="col-md-12">
                                   <style type="text/css">
                                   td {
                                       color: black;
                                       font-size: 15px;
                                   }
                                   </style>
                                   <fieldset>
                                       <legend>Requisition List</legend>
                                       <style type="text/css">
                                       #appRowDiv td {
                                           padding: 5px;
                                           border-color: #ccc;
                                       }

                                       #appRowDiv th {
                                           padding: 5px;
                                           text-align: center;
                                           border-color: #ccc;
                                           color: black;
                                       }
                                       </style>
                                       <div id="msgPerson"> </div>
                                       <table width="100%" border="1" id="appRowDiv">
                                           <tr>
                                               <th width="20%">Item Name <span class="required">*</span></th>
                                               <th width="15%">Qty. Request</th>
                                               <th width="15%"> Qty. Correction </th>
                                               <th width="15%"> Qty. Approve </th>
                                               <th width="15%"> Qty. Available </th>
                                               <th width="20%">Remark</th>
                                           </tr>
                                           <?php foreach ($items as $item) {?>
                                           <tr>
                                               <td><?=$item->item_name?></td>
                                               <td><?=$item->qty_request?> <?=$item->unit_name?></td>

                                               <td><input <?= ($this->ion_auth->in_group('Store Keeper'))?'readonly':'' ?> onkeyup='changeStatus(this)' onchange='changeStatus(this)'
                                                       max="<?=$item->quantity?>" name="qty_approve[]"
                                                       value="<?=$item->qty_approve?>" type="number"
                                                       class="form-control input-sm qt_correction"></td>

                                               <td><input disabled max="<?=$item->quantity?>"
                                                       value="<?=$item->qty_approve?>" type="number"
                                                       class="form-control input-sm qt_approve"></td>

                                               <td><span class="qt_available_text"><?=$item->quantity?> </span>
                                                   <?=$item->unit_name?> <input type="hidden" class="qt_available"
                                                       value="<?=$item->quantity?>"></td>
                                               <td><?=$item->remark?></td>
                                               <input type="hidden" name="hide_id[]" value="<?=$item->id?>">
                                           </tr>
                                           <?php }?>
                                       </table>
                                   </fieldset>
                               </div>
                           </div>
                           <label for="">Remark</label>
                           <textarea name="Personal_Remark" id=""
                               style="width: -webkit-fill-available;height: 84px;"></textarea>


                           <div class="form-actions">
                               <div class="pull-right">

                                   <?php
if ($info->status != 2) {?>
                                   <button type="submit" class="btn btn-info btn-cons" name="submit_type"
                                       value="save"><i class="icon-ok"></i>
                                       Save</button>
                                   <button type="submit" class="btn btn-primary btn-cons" name="submit_type"
                                       value="send"><i class="icon-ok"></i>
                                       Send</button>
                                   <?php } elseif ($info->is_delivered == 0) {
    $pr = $this->ion_auth->get_permission();
    $delivered = 'disabled';
    if (in_array(4, $pr)) {
        $delivered = '';
    }
    ;
    ?>
                                   <?=anchor("requisition/delivery_product/" . encrypt_url($info->id), 'Delivery Product', array('class' => 'btn btn-blueviolet btn-mini', $delivered => $delivered))?>
                                   <?php } else {?>
                                   <p class="text-success">Already Delivered</p>

                                   <?php }?>
                               </div>
                           </div>
                           <?php echo form_close(); ?>

                       </div> <!-- END GRID BODY -->
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
            status: {
                required: true
            }
        },

        invalidHandler: function(event, validator) {
            //display error alert on form submit
        },

        errorPlacement: function(label, element) { // render error placement for each input type
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

        highlight: function(element) { // hightlight error inputs
            var parent = $(element).parent();
            parent.removeClass('success-control').addClass('error-control');
        },

        unhighlight: function(element) { // revert the change done by hightlight

        },

        success: function(label, element) {
            var parent = $(element).parent('.input-with-icon');
            parent.removeClass('error-control').addClass('success-control');
        },

        submitHandler: function(form) {
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


   <script>
function changeStatus(el) {
    var qt_correction = el;
    var qt_approve = el.closest("tr").querySelector(".qt_approve");
    var qt_available = el.closest("tr").querySelector(".qt_available");
    if (Math.round(qt_correction.value) > Math.round(qt_available.value)) {
        alert("Qty. Correction cannot be greater than Qty. Available");
        qt_correction.value = qt_available.value;
        qt_approve.value = qt_correction.value;
    } else {
        qt_approve.value = qt_correction.value;
    }
}
   </script>