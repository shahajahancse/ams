<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
         <div class="row page-titles">
            <div class="col-md-5 align-self-center">
               <h3 class="text-themecolor"><?=$module_title?></h3>
            </div>
            <div class="col-md-7 align-self-center">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                  <li class="breadcrumb-item active"><?=$module_title?></li>
               </ol>
            </div>
         </div>
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card card-outline-info">
                     <div class="card-header">
                        <h4 class="m-b-0 text-white">Record Asset Transfer</h4>
                     </div>
                     <div class="card-body">
                        <?php echo form_open_multipart("asset_movement/record", array('class' => 'form-horizontal', 'id' => 'asset_movement_form', 'novalidate' => 'novalidate'));?>
                           <div class="form-body">
                              <hr>
                              <div class="row p-t-20">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label">Asset Name</label>
                                       <input type="text" class="form-control" value="<?=$asset_info->item_name?>" readonly>
                                       <input type="hidden" name="asset_id" value="<?=$asset_info->id?>">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label">Transfer Date <span class="text-danger">*</span></label>
                                       <input type="date" name="transfer_date" class="form-control" value="<?=set_value('transfer_date', (isset($movement_info->transfer_date) ? $movement_info->transfer_date : date('Y-m-d')))?>" required>
                                    </div>
                                 </div>
                              </div>
                              <!--/row-->
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label">From Branch</label>
                                       <select name="from_branch_id" class="form-control custom-select" required>
                                          <option value="">Select Branch</option>
                                          <?php foreach ($branches as $branch): ?>
                                             <option value="<?=$branch->id?>" <?=set_select('from_branch_id', $branch->id, (isset($asset_info->branch_id) && $asset_info->branch_id == $branch->id))?>><?=$branch->branch_name?></option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label">From Department</label>
                                       <select name="from_department_id" class="form-control custom-select" required>
                                          <option value="">Select Department</option>
                                          <?php foreach ($departments as $department): ?>
                                             <option value="<?=$department->id?>" <?=set_select('from_department_id', $department->id, (isset($asset_info->department_id) && $asset_info->department_id == $department->id))?>><?=$department->dept_name?></option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <!--/row-->
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label">To Branch <span class="text-danger">*</span></label>
                                       <select name="to_branch_id" class="form-control custom-select" required>
                                          <option value="">Select Branch</option>
                                          <?php foreach ($branches as $branch): ?>
                                             <option value="<?=$branch->id?>" <?=set_select('to_branch_id', $branch->id)?>>
                                                <?=$branch->branch_name?>
                                             </option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label">To Department <span class="text-danger">*</span></label>
                                       <select name="to_department_id" class="form-control custom-select" required>
                                          <option value="">Select Department</option>
                                          <?php foreach ($departments as $department): ?>
                                             <option value="<?=$department->id?>" <?=set_select('to_department_id', $department->id)?>>
                                                <?=$department->dept_name?>
                                             </option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <!--/row-->
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label class="control-label">Notes</label>
                                       <textarea name="notes" class="form-control" rows="3"><?=set_value('notes')?></textarea>
                                    </div>
                                 </div>
                              </div>
                              <!--/row-->
                           </div>
                           <div class="form-actions">
                              <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> Save</button>
                              <button type="button" class="btn btn-inverse">Cancel</button>
                           </div>
                        <?php echo form_close();?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php $this->load->view('backend/footer'); ?>
         <script src="<?=base_url()?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
         <script src="<?=base_url()?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
         <script>
            $(function() {
                // Date Picker
                $('.datepicker').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: 'yyyy-mm-dd'
                });

                // Form Validation
                $("#asset_movement_form").validate({
                    rules: {
                        transfer_date: {
                            required: true
                        },
                        from_branch_id: {
                            required: true
                        },
                        from_department_id: {
                            required: true
                        },
                        to_branch_id: {
                            required: true
                        },
                        to_department_id: {
                            required: true
                        }
                    },
                    messages: {
                        transfer_date: {
                            required: "Please select a transfer date"
                        },
                        from_branch_id: {
                            required: "Please select the source branch"
                        },
                        from_department_id: {
                            required: "Please select the source department"
                        },
                        to_branch_id: {
                            required: "Please select the destination branch"
                        },
                        to_department_id: {
                            required: "Please select the destination department"
                        }
                    }
                });
            });
         </script>