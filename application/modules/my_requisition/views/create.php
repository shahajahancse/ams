<div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
            <li><a href="<?=base_url('purchase')?>" class="active"><?=$module_name?></a></li>
            <li><?=$meta_title; ?></li>
        </ul>

        <style>
        .resizable {
            background: white;
            width: fit-content;
            height: fit-content;
            position: sticky;
            top: 100px;
            left: 100px;
            display: none;
        }

        .resizable .resizers {
            width: 100%;
            height: 100%;
            border: 3px solid #4286f4;
            box-sizing: border-box;
        }

        .resizable .resizers .resizer {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            /*magic to turn square into circle*/
            background: white;
            border: 3px solid #4286f4;
            position: absolute;
        }

        .resizable .resizers .resizer.top-left {
            left: -5px;
            top: -5px;
            cursor: nwse-resize;
            /*resizer cursor*/
        }

        .resizable .resizers .resizer.top-right {
            right: -5px;
            top: -5px;
            cursor: nesw-resize;
        }

        .resizable .resizers .resizer.bottom-left {
            left: -5px;
            bottom: -5px;
            cursor: nesw-resize;
        }

        .resizable .resizers .resizer.bottom-right {
            right: -5px;
            bottom: -5px;
            cursor: nwse-resize;
        }
        </style>
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

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?=base_url('my_requisition')?>" class="btn btn-blueviolet btn-xs btn-mini"> My
                                Requisition List</a>
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
                                <fieldset>
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
                                        <div class="col-md-4">
                                            <label class="form-label">Requisition Title <span
                                                    class='required'>*</span></label>
                                            <?php echo form_error('title');?>
                                            <input name="title" value="<?=set_value('title')?>" type="text"
                                                class="form-control input-sm" placeholder="">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Urgent Status<span
                                                    class='required'>*</span></label>
                                            <?php echo form_error('title');?>
                                            <input type="checkbox" name="urgent_status">
                                        </div>
                                        <div class="col-md-6" style="color: black; font-weight: bold;">
                                            <label class="form-label">Attached Document</label>
                                            <input type="file" name="attachment" id="attachment"
                                                accept="application/pdf, image/*">
                                            <div class='resizable' id='resizablec'>
                                                <div class='resizers'>
                                                    <div id="preview-container"
                                                        style="position: sticky;height: -webkit-fill-available;display: flex;">
                                                        <iframe id="preview" frameborder="0" scrolling="auto"></iframe>
                                                    </div>
                                                    <div class='resizer top-left'></div>
                                                    <div class='resizer top-right'></div>
                                                    <div class='resizer bottom-left'></div>
                                                    <div class='resizer bottom-right'></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <h4 class="semi-bold margin_left_15">Item List
                                                <em style="color: #f73838; font-size: 15px;">Click <strong>Add More</strong> button for adding more item. </em>
                                            </h4>
                                            <input type="hidden" value="1" id="count">
                                            <table width="100%" border="1" id="appRowDiv"
                                                style="border:1px solid #a09e9e;">
                                                <tr>
                                                    <th width="20%">Category<span class="required">*</span></th>
                                                    <th width="20%">Sub Category <span class="required">*</span>
                                                    </th>
                                                    <th width="20%">Item Name <span class="required">*</span></th>
                                                    <th width="20%">Quantity</th>
                                                    <th width="20%">Remark</th>
                                                    <th width="8%"> <a id="addRow" class="label label-success"><i class="fa fa-plus-circle"></i> Add More</a> </th>
                                                </tr>
                                                <tr></tr>
                                            </table>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <label for=""> Description </label>
                                <textarea name="description" class="form-control input-sm" rows="3"><?=$info->description?></textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-info btn-cons" name="submit_type" value="save"><i
                                        class="icon-ok"></i> Save</button>
                                <button type="submit" class="btn btn-primary btn-cons" name="submit_type"
                                    value="send"><i class="icon-ok"></i> Send</button>
                            </div>
                        </div>
                        <?php echo form_close();?>
                    </div> <!-- END GRID BODY -->
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

<script>
    function makeResizableDiv(div) {
        const element = document.querySelector(div);
        const resizers = document.querySelectorAll(div + ' .resizer')
        const minimum_size = 20;
        let original_width = 0;
        let original_height = 0;
        let original_x = 0;
        let original_y = 0;
        let original_mouse_x = 0;
        let original_mouse_y = 0;
        for (let i = 0; i < resizers.length; i++) {
            const currentResizer = resizers[i];
            currentResizer.addEventListener('mousedown', function(e) {
                e.preventDefault()
                original_width = parseFloat(getComputedStyle(element,
                        null)
                    .getPropertyValue('width').replace('px', ''));
                original_height = parseFloat(getComputedStyle(element,
                        null)
                    .getPropertyValue('height').replace('px', ''));
                original_x = element.getBoundingClientRect().left;
                original_y = element.getBoundingClientRect().top;
                original_mouse_x = e.pageX;
                original_mouse_y = e.pageY;
                window.addEventListener('mousemove', resize)
                window.addEventListener('mouseup', stopResize)
            })

            function resize(e) {
                if (currentResizer.classList.contains('bottom-right')) {
                    const width = original_width + (e.pageX - original_mouse_x);
                    const height = original_height + (e.pageY - original_mouse_y)
                    if (width > minimum_size) {
                        element.style.width = width + 'px'
                    }
                    if (height > minimum_size) {
                        element.style.height = height + 'px'
                    }
                } else if (currentResizer.classList.contains('bottom-left')) {
                    const height = original_height + (e.pageY -
                        original_mouse_y)
                    const width = original_width - (e.pageX - original_mouse_x)
                    if (height > minimum_size) {
                        element.style.height = height + 'px'
                    }
                    if (width > minimum_size) {
                        element.style.width = width + 'px'
                        element.style.left = original_x + (e.pageX -
                            original_mouse_x) + 'px'
                    }
                } else if (currentResizer.classList.contains('top-right')) {
                    const width = original_width + (e.pageX - original_mouse_x)
                    const height = original_height - (e.pageY -
                        original_mouse_y)
                    if (width > minimum_size) {
                        element.style.width = width + 'px'
                    }
                    if (height > minimum_size) {
                        element.style.height = height + 'px'
                        element.style.top = original_y + (e.pageY -
                            original_mouse_y) + 'px'
                    }
                } else {
                    const width = original_width - (e.pageX - original_mouse_x)
                    const height = original_height - (e.pageY -
                        original_mouse_y)
                    if (width > minimum_size) {
                        element.style.width = width + 'px'
                        element.style.left = original_x + (e.pageX -
                            original_mouse_x) + 'px'
                    }
                    if (height > minimum_size) {
                        element.style.height = height + 'px'
                        element.style.top = original_y + (e.pageY -
                            original_mouse_y) + 'px'
                    }
                }
            }

            function stopResize() {
                window.removeEventListener('mousemove', resize)
            }
        }
    }
    makeResizableDiv('.resizable')
</script>

<script>
    const attachmentInput = document.getElementById('attachment');
    const previewIframe = document.getElementById('preview');
    const previewContainer = document.getElementById('preview-container');
    const resizablec = document.getElementById('resizablec');
    attachmentInput.addEventListener('change', () => {
        resizablec.style.display = 'block';
        const file = attachmentInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener('load', () => {
                previewIframe.src = reader.result;
            });
            reader.readAsDataURL(file);
        }
    });
    $(function() {
        $("#preview-container").resizable({
            handles: "se",
            minHeight: 200,
            minWidth: 200
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        //Load First row
        addNewRow();

        // JS Validation
        $('#jsvalidate').validate({
            // focusInvalid: false,
            ignore: "",
            rules: {
                title: {
                    required: true
                }
            },

            invalidHandler: function(event, validator) {
                //display error alert on form submit
            },

            errorPlacement: function(label, element) { // render error placement for each input type
                $('<span class="error"></span>').insertAfter(element).append(label)
                var parent = $(element).parent('.input-with-icon');
                parent.removeClass('success-control').addClass('error-control');
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

    $('.invitationDiv').hide();
    $('#schedule_type').change(function() {
        var id = $('#schedule_type').val();
        // alert(id);
        if (id == 'Invitation') {
            $('.invitationDiv').show();
            $('.appointmentDiv').hide();
        } else {
            $('.invitationDiv').hide();
            $('.appointmentDiv').show();
        }
    });


    // Add multiple person
    $("#addRow").click(function(e) {
        addNewRow();
    });
    //remove row
    function removeRow(id) {
        $(id).closest("tr").remove();
    }
    //add row function
    //add row function
    function addNewRow() {
        var sl = $('#count').val();
        var items = '';
        items += '<tr>';
        items += '<td><select name="cat_id[]" class="form-control input-sm" id="category_' + sl +
            '" ><?php echo $category_data;?></select></td>';
        items += '<td><select name="sub_cat_id[]"  id="subcategory_' + sl + '" class="sub_category_val_' + sl +
            ' form-control input-sm"><option value="">Select One</option></select></td>';
        items += '<td><select name="item_id[]" id="item_' + sl + '" class="item_val_' + sl +
            ' form-control input-sm"><option value="">Select One</option></select></td>';

        items += '<td><input style="width: 82px;" name="qty_request[]" value="" type="number" class="form-control input-sm qtyr"></td>';

        items += '<td><input name="remark[]" value="" class="form-control input-sm">';
        items += '<td> <a class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> Remove </a></td>';
        items += '</tr>';
        $('#count').val(sl + 1);
        $('#appRowDiv tr:last').after(items);
        category_dd(sl);
        subcategory_dd(sl);
    }

    function category_dd(sl) {
        $('#category_' + sl).change(function() {
            $('#subcategory_' + sl + '').empty();
            var id = $('#category_' + sl).val();
            var item = '<option value=""> -Select Sub Category- </option>';
            $.ajax({
                type: "POST",
                data: {
                    type: 1
                },
                url: hostname + "common/ajax_get_sub_category_by_category/" + id,
                success: function(func_data) {
                    $.each(func_data, function(id, name) {
                        item += '<option value="' + name.id + '">' + name.sub_cate_name +
                            '</option>';
                    });
                    $('#subcategory_' + sl + '').append(item).select2();
                }
            });
        });
    }

    function subcategory_dd(sl) {
        $('#subcategory_' + sl).change(function() {
            var id = $('#subcategory_' + sl).val();
            $('#item_' + sl).empty();
            var item = '<option value=""> -Select Sub Category- </option>';
            $.ajax({
                type: "POST",
                data: {
                    type: 1
                },
                url: hostname + "common/ajax_get_item_by_sub_category/" + id,
                success: function(func_data) {
                    var item = ''
                    $.each(func_data, function(id, name) {
                        item += '<option value="' + name.id + '">' + name.item_name +
                            '</option>';
                    });
                    $('#item_' + sl + '').append(item).select2();
                }
            });
        });
    }
</script>
