<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('disposal')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?> for <?=$asset->item_name?></span></h4>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php echo form_open("disposal/save_disposal");?>
                  <input type="hidden" name="asset_id" value="<?=$asset->id?>">

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Disposal Date <span class="required">*</span></label>
                        <input name="disposal_date" type="date" class="form-control input-sm" required>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Disposal Type <span class="required">*</span></label>
                        <select name="disposal_type" class="form-control input-sm" required>
                           <option value="Sale">Sale</option>
                           <option value="Write-off">Write-off</option>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Sale Proceeds</label>
                        <input name="sale_proceeds" type="number" step="0.01" class="form-control input-sm">
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
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Record Disposal</button>
                     </div>
                  </div>

                  <?php echo form_close();?>

               </div>
            </div>
         </div>
      </div>

   </div>
</div>