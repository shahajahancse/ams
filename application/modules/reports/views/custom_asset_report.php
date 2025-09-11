<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('reports')?>" class="active"> Reports </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('error')):?>
                     <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error');?>
                     </div>
                  <?php endif; ?>

                  <?php echo form_open("reports/generate_custom_asset_report");?>
                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label">Select Columns for Report:</label>
                        <div class="checkbox check-success">
                            <input type="checkbox" name="columns[]" value="id" id="col_id">
                            <label for="col_id">ID</label>

                            <input type="checkbox" name="columns[]" value="item_name" id="col_item_name">
                            <label for="col_item_name">Item Name</label>

                            <input type="checkbox" name="columns[]" value="description" id="col_description">
                            <label for="col_description">Description</label>

                            <input type="checkbox" name="columns[]" value="acquisition_date" id="col_acquisition_date">
                            <label for="col_acquisition_date">Acquisition Date</label>

                            <input type="checkbox" name="columns[]" value="cost" id="col_cost">
                            <label for="col_cost">Cost</label>

                            <input type="checkbox" name="columns[]" value="book_value" id="col_book_value">
                            <label for="col_book_value">Book Value</label>

                            <input type="checkbox" name="columns[]" value="depreciation_method" id="col_depreciation_method">
                            <label for="col_depreciation_method">Depreciation Method</label>

                            <input type="checkbox" name="columns[]" value="useful_life" id="col_useful_life">
                            <label for="col_useful_life">Useful Life</label>

                            <input type="checkbox" name="columns[]" value="salvage_value" id="col_salvage_value">
                            <label for="col_salvage_value">Salvage Value</label>

                            <input type="checkbox" name="columns[]" value="serial_number" id="col_serial_number">
                            <label for="col_serial_number">Serial Number</label>

                            <input type="checkbox" name="columns[]" value="asset_status" id="col_asset_status">
                            <label for="col_asset_status">Asset Status</label>

                            <input type="checkbox" name="columns[]" value="disposal_date" id="col_disposal_date">
                            <label for="col_disposal_date">Disposal Date</label>

                            <input type="checkbox" name="columns[]" value="disposal_type" id="col_disposal_type">
                            <label for="col_disposal_type">Disposal Type</label>

                            <input type="checkbox" name="columns[]" value="sale_proceeds" id="col_sale_proceeds">
                            <label for="col_sale_proceeds">Sale Proceeds</label>

                            <!-- Add more columns as needed -->
                        </div>
                     </div>
                  </div>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Generate Report</button>
                     </div>
                  </div>

                  <?php echo form_close();?>

               </div>
            </div>
         </div>
      </div>

   </div>
</div>