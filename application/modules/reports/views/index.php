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
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <?php
                  $attributes = array('id' => 'validate', 'target'=>'_blank');
                  echo form_open("reports/index", $attributes);?>

                  <fieldset class="col-md-12">
                     <legend>Report Filtering</legend>
                     <div id="error" style="display: none;">
                        <div class="alert alert-danger">Please fill up red level input filtering field.</div>
                     </div>

                     <div class="row">
                        <div class="col-md-3" style="padding-right: 5px; padding-left: 15px;">
                           <label>Select Office</label>
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
                        <div class="col-md-3" style="padding-right: 5px; padding-left: 10px;">
                           <label for="user_id"> Select User</label>
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
                        <div class="col-md-3" style="padding-right: 5px; padding-left: 10px;">
                           <label for="fiscal_year"> Select Fascial Year</label>
                           <select name="fiscal_year" class="form-control input-sm" id="fiscal_year">
                              <option value="">-- Select fascial year --</option>
                              <?php
                              $fascial=$this->db->get('fiscal_year')->result();
                              foreach ($fascial as $key => $value) {
                                 if ($value != null) {
                                    echo '<option ' . ($value->active==1?"selected":"") . ' value="' . $value->id . '">' . $value->fiscal_year_name . '</option>';
                                 }
                              } ?>
                           </select>
                        </div>
                        <div class="col-md-3" style="padding-right: 10px; padding-left: 1px;">
                           <div class="col-md-6" style="padding-right: 5px; padding-left: 10px;">
                              <label for="date_from">From Date</label>
                              <input name="from_date" type="date" id="from_date" class="form-control input-sm">
                           </div>
                           <div class="col-md-6" style="padding-right: 5px; padding-left: 10px;">
                              <label for="date_from">To Date</label>
                              <input name="to_date" type="date" id="to_date" class="form-control input-sm">
                           </div>
                        </div>
                     </div>
                 </fieldset>

                  <!-- Item Report -->
                  <fieldset class="col-md-12">
                     <legend>Item Report</legend>
                     <button type="submit" name="btnsubmit" value="item_report" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Item Report </button>
                     <button type="submit" name="btnsubmit" value="low_inventory" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Low Inventory </button>
                      <button type="submit" name="btnsubmit" value="item_excel" class="btn btn-info btn-cons"><i class="fa fa-list"></i> Item Excel </button>
                       <button type="submit" name="btnsubmit" value="low_excel" class="btn btn-info btn-cons"><i class="fa fa-list"></i> Low Inventory Excel </button>
                  </fieldset>
                  <!-- Requisition Report -->
                  <fieldset class="col-md-12">
                     <legend>Requsition Report</legend>
                     <button type="submit" name="btnsubmit" value="request_requisition"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Request Requisition </button>
                     <button type="submit" name="btnsubmit" value="approve_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Approve Requisition </button>
                     <button type="submit" name="btnsubmit" value="rejected_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Rejected Requisition </button>
                     <button type="submit" name="btnsubmit" value="delivered_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Delivered Requisition </button>
                     <br>
                     <button type="submit" name="btnsubmit" value="request_requisition_excel"  class="btn btn-info btn-cons"><i class="fa fa-list"></i> Request Excel </button>
                     <button type="submit" name="btnsubmit" value="approve_requisition_excel"  class="btn btn-info btn-cons"><i class="fa fa-list"></i> Approve Excel </button>
                     <button type="submit" name="btnsubmit" value="rejected_requisition_excel"  class="btn btn-info btn-cons"><i class="fa fa-list"></i> Rejected Excel </button>
                     <button type="submit" name="btnsubmit" value="delivered_requisition_excel"  class="btn btn-info btn-cons"><i class="fa fa-list"></i> Delivered Excel </button>

                  </fieldset>
                  <!-- Purchase Report -->
                  <fieldset class="col-md-12">
                     <legend>Purchase Report</legend>
                     <button type="submit" name="btnsubmit" value="request_purchase"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Request Purchase </button>
                     <button type="submit" name="btnsubmit" value="approve_purchase"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Approve Purchase </button>
                     <button type="submit" name="btnsubmit" value="rejected_purchase"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Rejected Purchase </button>
                     <button type="submit" name="btnsubmit" value="recceived_purchase"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Recceived Purchase </button>
                     <br>
                     <button type="submit" name="btnsubmit" value="request_purchase_excel"  class="btn btn-info btn-cons"> Request Purchase Excel</button>
                     <button type="submit" name="btnsubmit" value="approve_purchase_axcel"  class="btn btn-info btn-cons"> Approve Purchase Excel</button>
                     <button type="submit" name="btnsubmit" value="rejected_purchase_axcel"  class="btn btn-info btn-cons"> Rejected Purchase Excel</button>
                     <button type="submit" name="btnsubmit" value="recceived_purchase_axcel"  class="btn btn-info btn-cons"> Recceived Purchase Excel</button>
                  </fieldset>
                  <!-- Staff Report -->
                  <fieldset class="col-md-12">
                     <legend>Staff Report</legend>
                     <button type="submit" onclick="return validFunc()" name="btnsubmit" value="user_request_requisition"  class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Request Requisition </button>
                        <button type="submit" onclick="return validFunc()" name="btnsubmit" value="user_approve_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Approve Requisition </button>
                     <button type="submit" onclick="return validFunc()" name="btnsubmit" value="user_rejected_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Rejected Requisition </button>
                     <button type="submit" onclick="return validFunc()" name="btnsubmit" value="user_delivered_requisition" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Delivered Requisition </button>
                     <br>
                     <button type="submit" onclick="return validFunc()" name="btnsubmit" value="user_request_excel"  class="btn btn-info btn-cons"> Request User Excel </button>
                     <button type="submit" onclick="return validFunc()" name="btnsubmit" value="user_approve_excel" class="btn btn-info btn-cons"> Approve User Excel </button>
                     <button type="submit" onclick="return validFunc()" name="btnsubmit" value="user_rejected_excel" class="btn btn-info btn-cons"> Rejected User Excel </button>
                     <button type="submit" onclick="return validFunc()" value="user_delivered_excel" class="btn btn-info btn-cons" name="btnsubmit" > Delivered User Excel </button>
                  </fieldset>
                  <div class="clearfix"></div>
                  <?php form_close(); ?>
               </div> <!-- /grid-body -->
            </div> <!-- /grid -->
         </div>
      </div> <!-- /row-fluid -->
   </div> <!-- /content -->
</div> <!-- /page-content -->

<script>
   function validFunc() {
      var user_id = document.getElementById("user_id").value;
      submitOK = "true";
      if (user_id == '') {
        $("#user_id").css("border", "1px solid red");
        submitOK = "false";
      }
      if (submitOK == "false") {
        $("#error").show();
        return false;
      }
   }
</script>

<script>
   function smr_region() {
      // var field = document.getElementById("financing_id").value;
      var startDate = document.getElementById("date_from").value;
      var endDate = document.getElementById("date_to").value;
      submitOK = "true";
      if (startDate == '') {
         $("#date_from").css("border", "1px solid red");
         submitOK = "false";
      }
      if (endDate == '') {
         $("#date_to").css("border", "1px solid red");
         submitOK = "false";
      }
      if (submitOK == "false") {
         $("#error").show();
         return false;
      }else{
         $("#validate").submit();
      }
   }
</script>
