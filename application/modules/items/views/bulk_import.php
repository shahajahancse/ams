<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('items')?>" class="active"> Items </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('items')?>" class="btn btn-info btn-xs btn-mini"> Items List</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if(isset($error)):?>
                     <div class="alert alert-danger">
                        <?php echo $error;?>
                     </div>
                  <?php endif; ?>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'import_form');
                  echo form_open_multipart("items/bulk_import", $attributes);?>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Select Excel/CSV File <span class="required">*</span></label>
                        <input type="file" name="asset_file" class="form-control input-sm" required>
                        <p class="help-block">Allowed types: .xls, .xlsx, .csv (Max 2MB)</p>
                     </div>
                  </div>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" name="submit" value="upload" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Upload & Import</button>
                     </div>
                  </div>

                  <?php echo form_close();?>

               </div>  <!-- END GRID BODY -->
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>