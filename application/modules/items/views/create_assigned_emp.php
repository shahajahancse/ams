<style>
   .input-sm {
      height: 30px;
      padding: 0px 0px;
      font-size: 12px;
      line-height: 1.5;
      border-radius: 3px;
   }
</style>

<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <?=$module_title?> </li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('items/assigned_emp')?>" class="btn btn-info btn-xs btn-mini"> Assets List</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;overflow:hidden;">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?= $this->session->flashdata('success'); ?>
                     </div>
                  <?php endif; ?>
                  <?php if($this->session->flashdata('error')):?>
                     <div class="alert alert-error">
                        <?= $this->session->flashdata('error'); ?>
                     </div>
                  <?php endif; ?>

                  <?php 
                  $form_action = !empty($assigned_emps->id) ? "items/emp_asset_create/".$assigned_emps->id : "items/emp_asset_create";
                  echo form_open_multipart($form_action, ['id' => 'validate']); 
                  ?>

                  <div class="row form-row" id="assigned_emp">
                     <div class="col-md-12">
                        <h4 class="semi-bold">Assigned Employee/Custodian</h4>
                        <hr>
                     </div>

                     <div class="row" style="margin-left: 0px;">
                        <div class="col-md-6">
                           <label class="form-label">Select Employee/Custodian <span class="required">*</span></label>
                           <?php $users = $this->db->where('status', 1)->get('users')->result(); ?> 
                           <select name="user_id" id="user_id" class="select2 form-control input-sm" style="width: 100%;">
                              <option value="">-- Select One --</option>
                              <?php foreach ($users as $value) { ?>
                                 <option value="<?= $value->id ?>" <?= !empty($assigned_emps->emp_id) && $assigned_emps->emp_id == $value->id ? 'selected' : '' ?>>
                                    <?= $value->first_name ?>
                                 </option>
                              <?php } ?>
                           </select>
                        </div>

                        <div class="col-md-6">
                           <label class="form-label">Select Assets <span class="required">*</span></label>
                           <?php $assets = $this->db->where('asset_status', 1)->get('items')->result(); ?> 
                           <select name="asset_ids[]" id="asset_ids" class="select2 form-control input-sm" style="width: 100%;" multiple>
                              <option value="" disabled>-- Select One --</option>
                              <?php 
                              $selected_assets = !empty($assigned_emps->asset_ids) ? json_decode($assigned_emps->asset_ids) : [];
                              foreach ($assets as $value) { ?>
                                 <option value="<?= $value->id ?>" <?= in_array($value->id, $selected_assets) ? 'selected' : '' ?>>
                                    <?= $value->item_name ?>
                                 </option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-6" style="margin-top:10px;">
                        <label class="form-label">Remarks</label>
                        <textarea class="form-control" name="remarks" placeholder="Remarks" rows="2"><?= !empty($assigned_emps->remarks) ? $assigned_emps->remarks : '' ?></textarea>
                     </div>
                  </div>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" id="emp_asset_submit" class="btn btn-primary btn-cons"><?= !empty($assigned_emps->id) ? 'Update' : 'Save' ?></button>
                     </div>
                  </div>
                  <?php echo form_close(); ?>
               </div>  <!-- END GRID BODY -->
            </div> <!-- END GRID -->
         </div>
      </div> <!-- END ROW -->
   </div>
</div>

<script type="text/javascript">
   $(document).ready(function() {
      $('#validate').validate({
         ignore: "",
         rules: {
            "user_id": { required: true },
            "asset_ids[]": { required: true },
         },
      });
   });

   $(document).on('click', '#emp_asset_submit', function(e) {
      e.preventDefault();
      var confirmation = confirm('Are you sure you want to submit?');
      if (confirmation) {
         $('#validate').submit();
      }
   });
</script>
