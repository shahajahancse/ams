<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('reports/index')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>

                <div class="grid-body">
                    <fieldset class="col-md-12">
                        <legend>Report Filtering</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Report Type</label>
                                    <select name="report_type" id="report_type" class="form-control input-sm">
                                        <option value="">Select Report Type</option>
                                        <option value="1">Requisition Report</option>
                                        <option value="2">Purchase Report</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Select Office</label>
                                    <select name="unit_id" id="unit_id" class="form-control input-sm">
                                        <option value="">Select Office</option>
                                        <?php $id = ''; if($this->ion_auth->in_group(array('badmin','sm'))){
                                            $id = $this->session->userdata('unit_id');
                                            $users = $this->db->where('id', $id)->get('units')->result();
                                        } else {
                                            $users = $this->db->get('units')->result();
                                        }
                                        foreach ($users as $key => $value) {?>
                                            <option <?= $id==$value->id? 'selected':''?> value="<?=$value->id?>"><?=$value->name_en?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Select User</label>
                                    <select name="user_id" id="user_id" class="form-control input-sm">
                                        <option value="">Select User</option>
                                        <?php
                                        if($this->ion_auth->in_group(array('badmin','sm'))){
                                            $id = $this->session->userdata('unit_id');
                                            $users = $this->db->where('unit_id', $id)->get('users')->result();
                                        } else {
                                            $users = $this->db->get('users')->result();
                                        }
                                        foreach ($users as $key => $value) {?>
                                            <option value="<?=$value->id?>"><?=$value->first_name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Select Fiscal Year</label>
                                    <select name="fiscal_year" id="fiscal_year" class="form-control input-sm">
                                        <option value="">Select Fiscal Year</option>
                                        <?php
                                            $fascial=$this->db->get('fiscal_year')->result();
                                            foreach ($fascial as $key => $value) {
                                                if ($value != null) {
                                                    echo '<option ' . ($value->active==1?"selected":"") . ' value="' . $value->id . '">' . $value->fiscal_year_name . '</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Select Product</label>
                                    <select name="product_id" id="product_id" class="form-control input-sm">
                                        <option value="">Select Product</option>
                                        <?php
                                            $products = $this->db->get('items')->result();
                                            foreach ($products as $key => $value) {
                                                if ($value != null) {
                                                    echo '<option value="' . $value->id . '">' . $value->item_name . '</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Select From Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control input-sm"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Select To Date</label>
                                    <input type="date" name="to_date" id="to_date" class="form-control input-sm"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Select Report Status</label>
                                    <select name="report_status" id="report_status" class="form-control input-sm">
                                        <option value="">Select Report Status</option>
                                        <option value="1">Pending</option>
                                        <option value="2">Approved</option>
                                        <option value="3">Rejected</option>
                                        <option value="4">Delivered</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-12">
                        <legend>Report View</legend>
                        <a onclick="print_report()" class="btn btn-primary" style="float: right;"><i class="fa fa-print"></i> Print</a>
                        <div class="row">
                            <!-- <div class="col-md-12">
                                <h3>Show raw</h3>
                                <div class="col-md-12" id="raw_report_view" style="border: 1px solid gray;padding: 11px;border-radius: 6px;">
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <h3>Show report</h3>
                                <div id="report_view" class="col-md-12" style="border: 1px solid gray;padding: 11px;border-radius: 6px;background: white;"></div>
                            </div>
                        </div>
                    </fieldset>
                </div> <!-- /grid-body -->
            </div> <!-- /grid -->
         </div>
      </div> <!-- /row-fluid -->
   </div> <!-- /content -->
</div> <!-- /page-content -->

<script>
    $('#report_type,#user_id,#fiscal_year,#product_id,#from_date,#to_date,#report_status').change(function() {
        $('#report_view').html('');

        var report_type = $('#report_type').val();
        var user_id = $('#user_id').val();
        var fiscal_year = $('#fiscal_year').val();
        var product_id = $('#product_id').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var report_status = $('#report_status').val();



        var url='<?php echo base_url('reports/get_dynamic_report/'); ?>'

        $.ajax({
            type: "POST",
            data: {
                report_type:report_type,
                user_id:user_id,
                fiscal_year:fiscal_year,
                product_id:product_id,
                from_date:from_date,
                to_date:to_date,
                report_status:report_status
            },
            url: url,
            success: function(data)
            {
                $('#report_view').html(data);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert(error);
            }
        });

    });
</script>

<script>
     function print_report() {
        var printContents = document.getElementById('report_view').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
