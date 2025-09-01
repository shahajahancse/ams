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
<style type="text/css">
    #appRowDiv td{padding: 5px; border-color: #ccc;}
    #appRowDiv th{padding: 5px;text-align:left;border-color: #ccc; color: black;}
</style>

<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
            <li><a href="<?=base_url('requisition')?>" class="active"><?=$module_name?></a></li>
            <li><?=$meta_title; ?></li>
        </ul>
        <div class="row">
            <div class="grid simple horizontal">
                <div class="grid-title">
                    <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                    <div class="pull-right">
                     <a href="<?=base_url('my_requisition')?>" class="btn btn-blueviolet btn-xs btn-mini">Requisition List</a>
                    </div>
                </div>

                <div class="grid-body">
                    <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');;?>
                        </div>
                    <?php endif; ?>

                    <?php  echo validation_errors();
                        $attributes = array('id' => 'jsvalidate');
                        echo form_open_multipart('my_requisition/edit/'.$info->id, $attributes);
                    ?>

                    <!-- title here -->
                    <div class="row">
                        <div class="col-md-12">
                        <fieldset >
                            <!-- <legend>Change Approval</legend> -->
                            <?php
                                $status = '<span class="label label-secondary">Draft</span>';
                                if ($info->status == 2) {
                                    $status = '<span class="label label-warning">On process</span>';
                                }else if($info->status == 3){
                                    $status = '<span class="label label-primary">SM Approve</span>';
                                }else if($info->status == 4){
                                    $status = '<span class="label label-info">Back User From DO</span>';
                                }else if($info->status == 5){
                                    $status = '<span class="label label-success">DO Approve</span>';
                                }else if($info->status == 6){
                                    $status = '<span class="label label-primary">Delivery </span>';
                                }else if($info->status == 7){
                                    $status = '<span class="label label-important">Rejected</span>';
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

                    <!-- change status -->
                    <div class="row form-row">>
                        <div class="col-md-9" style="margin-bottom: 20px;: ">
                        <label class="form-label">Status Type <span class='required'>*</span></label>
                        <input type="radio" name="status" value="1" <?=$info->status=='1'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>Draft</strong></span>

                        <?php if($this->ion_auth->in_group(array('sm'))){ ?>
                        <input type="radio" name="status" value="3" <?=$info->status=='2'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>Forward DO Sir</strong></span>
                        <?php } else { ?>
                            <input type="radio" name="status" value="2" <?=$info->status=='2'?'checked':'';?>> <span style="color: black; font-size: 14px;"><strong>Forward Store Keeper</strong></span>
                        <?php } ?>

                        <div id="typeerror"></div>
                        </div>
                    </div>
                    <!-- change status -->

                    <!-- item details here -->
                    <div class="row form-row">
                        <div class="col-md-12">
                        <style type="text/css">td{color: black; font-size: 15px;}</style>
                        <fieldset>
                            <!-- <legend>Purchase List</legend> -->
                            <div id="msgPerson"> </div>
                            <table width="100%" border="1" id="appRowDiv">
                                <tr>
                                    <th width="20%">Item Name <span class="required">*</span></th>
                                    <th width="15%">Qty. Request</th>
                                    <th width="15%"> Qty. Correction </th>
                                    <th width="10%"> Unit </th>
                                    <th width="20%">Remark</th>
                                    <th width="8%"> <a id="addRow" class="label label-success"><i class="fa fa-plus-circle"></i> Add More</a> </th>
                                </tr>

                                <?php foreach($items as $item){ ?>
                                <tr>
                                    <td><?=$item->item_name?></td>
                                    <td><?=$item->qty_request?>  <?=$item->unit_name?></td>
                                    <td><input name="qty_request[]"  value="<?=$item->qty_request?>" class="form-control input-sm"></td>
                                    <td><?=$item->unit_name?></td>
                                    <td><?=$item->remark?></td>
                                    <td> <a class="label label-important" onclick="deleteRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>
                                    <input type="hidden" name="hide_id[]" value="<?=$item->id?>">
                                    <input type="hidden" name="cat_id[]" value="<?=$item->cat_id?>">
                                    <input type="hidden" name="sub_cat_id[]" value="<?=$item->sub_cat_id?>">
                                    <input type="hidden" name="item_id[]" value="<?=$item->item_id?>">
                                    <input type="hidden" name="des[]" value="<?=$item->remark?>">
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
        </div> <!-- END ROW -->
    </div>
</div>

<?php
    $category_data = '';
    foreach ($categories as $key => $value) {
        $category_data .= '<option value="'.$key.'">'.$value.'</option>';
    }
?>

<script>
    // Add multiple person
    $("#addRow").click(function(e) {
        addNewRow();
    });
    //remove row
    function deleteRow(id) {
        $(id).closest("tr").remove();
    }
    function removeRow(id) {
        $(id).closest("tr").remove();
    }
    //add row function
    //add row function
    function addNewRow() {
        var items = '';
        items += '<tr>';
        items += '<td><select name="cat_id[]" class="form-control input-sm" onchange="category_dd(this)" ><?php echo $category_data;?></select></td>';

        items += '<td><select name="sub_cat_id[]" class="subcategory form-control input-sm" onchange="subcategory(this)" ><option value="">Select One</option></select></td>';

        items += '<td><select name="item_id[]" id="item_id" class="item_id form-control input-sm"><option value="">Select One</option></select></td>';

        items += '<td><input style="width: 82px;" name="qty_request[]" value="" type="number" class="form-control input-sm qtyr"></td>';

        items += '<td><textarea name="des[]" class="form-control input-sm" ></textarea></td>';

        items += '<td> <a class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';

        items += '<input type="hidden" name="hide_id[]" value="">';
        items += '</tr>';

        $('#appRowDiv tr:last').after(items);
    }

    function category_dd(el) {
        var sub = $(el).closest('tr').find('.subcategory');
        var id = $(el).val();
        var item = '<option value=""> -Select Sub Category- </option>';
        $.ajax({
            type: "POST",
            data: {
                type: 1
            },
            url: hostname + "common/ajax_get_sub_category_by_category/" + id,
            success: function(func_data) {
                $.each(func_data, function(id, name) {
                    item += '<option value="' + name.id + '">' + name.sub_cate_name + '</option>';
                });
                // Ensure that the correct row is targeted by using a more specific selector
                sub.empty();
                sub.append(item);
            }
        });
    }

    function subcategory(el) {
        var sub = $(el).closest('tr').find('.item_id');
        var id = $(el).val();
        var item = '<option value=""> -Select Item- </option>';
        $.ajax({
            type: "POST",
            data: {
                type: 1
            },
            url: hostname + "common/ajax_get_item_by_sub_category/" + id,
            success: function(func_data) {
                $.each(func_data, function(id, name) {
                    item += '<option value="' + name.id + '">' + name.item_name + '</option>';
                });
                sub.empty();
                sub.append(item);
            }
        });
    }
</script>



<script type="text/javascript">
    $(document).ready(function() {
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
</script>
