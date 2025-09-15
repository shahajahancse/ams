<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('cbs_integration/gl_account_mapping')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('cbs_integration/gl_account_mapping')?>" class="btn btn-info btn-xs btn-mini"> GL Account Mapping List</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if(validation_errors()):?>
                     <div class="alert alert-danger">
                        <?php echo validation_errors();?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate');
                  echo form_open("cbs_integration/edit_gl_account_mapping/".$mapping['id'], $attributes);?>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Select Category <span class="required">*</span></label>
                        <?php 
                        $more_attr = 'class="form-control input-sm" required';
                        echo form_dropdown('category_id', $categories, set_value('category_id', $mapping['category_id']), $more_attr);
                        ?>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Asset Cost Account <span class="required">*</span></label>
                        <input name="asset_cost_account" type="text" value="<?=set_value('asset_cost_account', $mapping['asset_cost_account'])?>" class="form-control input-sm" placeholder="" required>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Accumulated Depreciation Account <span class="required">*</span></label>
                        <input name="accumulated_depreciation_account" type="text" value="<?=set_value('accumulated_depreciation_account', $mapping['accumulated_depreciation_account'])?>" class="form-control input-sm" placeholder="" required>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Depreciation Expense Account <span class="required">*</span></label>
                        <input name="depreciation_expense_account" type="text" value="<?=set_value('depreciation_expense_account', $mapping['depreciation_expense_account'])?>" class="form-control input-sm" placeholder="" required>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Gain/Loss on Disposal Account <span class="required">*</span></label>
                        <input name="gain_loss_on_disposal_account" type="text" value="<?=set_value('gain_loss_on_disposal_account', $mapping['gain_loss_on_disposal_account'])?>" class="form-control input-sm" placeholder="" required>
                     </div>
                  </div>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div>

                  <?php echo form_close();?>

               </div>
            </div>
         </div>
      </div>

   </div>
</div>