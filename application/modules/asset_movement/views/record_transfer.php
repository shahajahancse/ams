<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('asset_movement')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?> for <?=$asset_info->item_name?></span></h4>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if(validation_errors()):?>
                     <div class="alert alert-danger">
                        <?php echo validation_errors();?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate');
                  echo form_open("asset_movement/record", $attributes);?>
                  <input type="hidden" name="asset_id" value="<?=$asset_info->id?>">

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Transfer Date <span class="required">*</span></label>
                        <input name="transfer_date" type="date" class="form-control input-sm" required>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">From Branch <span class="required">*</span></label>
                        <?php 
                        $more_attr = 'class="form-control input-sm" required';
                        echo form_dropdown('from_branch_id', $branches, set_value('from_branch_id', $asset_info->branch_id), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">From Department <span class="required">*</span></label>
                        <?php 
                        $more_attr = 'class="form-control input-sm" required';
                        echo form_dropdown('from_department_id', $departments, set_value('from_department_id', $asset_info->department_id), $more_attr);
                        ?>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">To Branch <span class="required">*</span></label>
                        <?php 
                        $more_attr = 'class="form-control input-sm" required';
                        echo form_dropdown('to_branch_id', $branches, set_value('to_branch_id'), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">To Department <span class="required">*</span></label>
                        <?php 
                        $more_attr = 'class="form-control input-sm" required';
                        echo form_dropdown('to_department_id', $departments, set_value('to_department_id'), $more_attr);
                        ?>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                     </div>
                  </div>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Record Transfer</button>
                     </div>
                  </div>

                  <?php echo form_close();?>

               </div>
            </div>
         </div>
      </div>

   </div>
</div>