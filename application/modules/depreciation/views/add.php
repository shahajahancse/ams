<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('depreciation')?>" class="active"> <?=$module_title?> </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('depreciation')?>" class="btn btn-blueviolet btn-xs btn-mini"> Depreciation List</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate');
                  echo form_open_multipart("depreciation/add", $attributes);?>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Asset Name</label>
                        <input type="hidden" name="asset_id" value="<?=set_value('asset_id', $asset_info->id)?>">
                        <input type="text" class="form-control input-sm" value="<?=set_value('asset_name', $asset_info->item_name)?>" readonly>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Depreciation Method <span class="required">*</span></label>
                        <select name="method_id" class="form-control input-sm" required>
                           <option value="">-- Select One --</option>
                           <?php foreach ($depreciation_methods as $method) { ?>
                              <option value="<?=$method->id?>" <?=set_value('method_id', $depreciation_info->method_id ?? '') == $method->id ? 'selected' : ''?>><?=$method->method_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Useful Life (Years)</label>
                        <input name="useful_life_years" type="number" value="<?=set_value('useful_life_years', $depreciation_info->useful_life_years ?? '')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Useful Life (Units - for Production Method)</label>
                        <input name="useful_life_units" type="number" value="<?=set_value('useful_life_units', $depreciation_info->useful_life_units ?? '')?>" class="form-control input-sm">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Salvage Value</label>
                        <input name="salvage_value" type="number" step="0.01" value="<?=set_value('salvage_value', $depreciation_info->salvage_value ?? '')?>" class="form-control input-sm">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Depreciation Start Date <span class="required">*</span></label>
                        <input name="depreciation_start_date" type="date" value="<?=set_value('depreciation_start_date', $depreciation_info->depreciation_start_date ?? '')?>" class="form-control input-sm" required>
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
         method_id: { required: true },
         depreciation_start_date: { required: true },
      }
   });
   });
</script>