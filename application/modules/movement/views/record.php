<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('movement')?>" class="active"> <?=$module_title?> </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('movement')?>" class="btn btn-info btn-xs btn-mini"> Movement List</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate');
                  echo form_open_multipart("movement/record", $attributes);?>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Asset Name</label>
                        <input type="hidden" name="asset_id" value="<?=set_value('asset_id', $asset_info->id)?>">
                        <input type="text" class="form-control input-sm" value="<?=set_value('asset_name', $asset_info->item_name)?>" readonly>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Movement Date <span class="required">*</span></label>
                        <input name="movement_date" type="date" value="<?=set_value('movement_date')?>" class="form-control input-sm" required>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">From Location</label>
                        <input name="from_location" type="text" value="<?=set_value('from_location')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">To Location</label>
                        <input name="to_location" type="text" value="<?=set_value('to_location')?>" class="form-control input-sm">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">From Custodian</label>
                        <select name="from_custodian" class="form-control input-sm">
                           <option value="">-- Select Custodian --</option>
                           <?php foreach ($custodians as $custodian) { ?>
                              <option value="<?=$custodian->id?>" <?=set_value('from_custodian') == $custodian->id ? 'selected' : ''?>><?=$custodian->first_name . ' ' . $custodian->last_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">To Custodian</label>
                        <select name="to_custodian" class="form-control input-sm">
                           <option value="">-- Select Custodian --</option>
                           <?php foreach ($custodians as $custodian) { ?>
                              <option value="<?=$custodian->id?>" <?=set_value('to_custodian') == $custodian->id ? 'selected' : ''?>><?=$custodian->first_name . ' ' . $custodian->last_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control input-sm" rows="3"><?=set_value('notes')?></textarea>
                     </div>
                  </div>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
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
      $('#validate').validate({
      ignore: "",
      rules: {
         movement_date: { required: true },
      }
   });
   });
</script>