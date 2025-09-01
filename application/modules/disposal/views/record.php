<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('disposal')?>" class="active"> <?=$module_title?> </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('disposal')?>" class="btn btn-blueviolet btn-xs btn-mini"> Disposal List</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate');
                  echo form_open_multipart("disposal/record", $attributes);?>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Asset Name</label>
                        <input type="hidden" name="asset_id" value="<?=set_value('asset_id', $asset_info->id)?>">
                        <input type="text" class="form-control input-sm" value="<?=set_value('asset_name', $asset_info->item_name)?>" readonly>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Original Cost</label>
                        <input type="text" class="form-control input-sm" value="<?=set_value('original_cost', $asset_info->cost)?>" readonly>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Accumulated Depreciation</label>
                        <input type="text" class="form-control input-sm" value="<?=set_value('accumulated_depreciation', $accumulated_depreciation)?>" readonly>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Net Book Value</label>
                        <input type="text" class="form-control input-sm" value="<?=set_value('net_book_value', $asset_info->cost - $accumulated_depreciation)?>" readonly>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Disposal Date <span class="required">*</span></label>
                        <input name="disposal_date" type="date" value="<?=set_value('disposal_date', $disposal_info->disposal_date ?? '')?>" class="form-control input-sm" required>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Disposal Type <span class="required">*</span></label>
                        <select name="disposal_type" class="form-control input-sm" required>
                           <option value="">-- Select One --</option>
                           <option value="Sale" <?=set_value('disposal_type', $disposal_info->disposal_type ?? '') == 'Sale' ? 'selected' : ''?>>Sale</option>
                           <option value="Write-off" <?=set_value('disposal_type', $disposal_info->disposal_type ?? '') == 'Write-off' ? 'selected' : ''?>>Write-off</option>
                           <option value="Obsolescence" <?=set_value('disposal_type', $disposal_info->disposal_type ?? '') == 'Obsolescence' ? 'selected' : ''?>>Obsolescence</option>
                           <option value="Damage" <?=set_value('disposal_type', $disposal_info->disposal_type ?? '') == 'Damage' ? 'selected' : ''?>>Damage</option>
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Sale Proceeds</label>
                        <input name="sale_proceeds" type="number" step="0.01" value="<?=set_value('sale_proceeds', $disposal_info->sale_proceeds ?? '')?>" class="form-control input-sm">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control input-sm" rows="3"><?=set_value('notes', $disposal_info->notes ?? '')?></textarea>
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
         disposal_date: { required: true },
         disposal_type: { required: true },
      }
   });
   });
</script>