<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('custom_fields')?>" class="active"> Custom Fields </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('custom_fields')?>" class="btn btn-info btn-xs btn-mini"> Custom Fields List</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if($this->session->flashdata('success')):
                     ?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');
                     ?>
                     </div>
                  <?php endif;
                  ?>
                  <?php if($this->session->flashdata('error')):
                     ?>
                     <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error');
                     ?>
                     </div>
                  <?php endif;
                  ?>

                  <?php echo form_open('custom_fields/create');
                  ?>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Field Name <span class="required">*</span></label>
                        <?php echo form_error('field_name');
                        ?>
                        <input name="field_name" type="text" value="<?=set_value('field_name')?>" class="form-control input-sm" placeholder="e.g., Asset Color">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Field Type <span class="required">*</span></label>
                        <?php echo form_error('field_type');
                        ?>
                        <select name="field_type" class="form-control input-sm" required onchange="toggleOptions(this.value)">
                           <option value="">-- Select Type --</option>
                           <option value="text" <?=set_select('field_type', 'text')?>>Text</option>
                           <option value="number" <?=set_select('field_type', 'number')?>>Number</option>
                           <option value="date" <?=set_select('field_type', 'date')?>>Date</option>
                           <option value="dropdown" <?=set_select('field_type', 'dropdown')?>>Dropdown</option>
                           <option value="textarea" <?=set_select('field_type', 'textarea')?>>Textarea</option>
                        </select>
                     </div>
                  </div>

                  <div class="row form-row" id="options_row" style="display:none;">
                     <div class="col-md-12">
                        <label class="form-label">Options (comma-separated for Dropdown)</label>
                        <?php echo form_error('options');
                        ?>
                        <input name="options" type="text" value="<?=set_value('options')?>" class="form-control input-sm" placeholder="Option1, Option2, Option3">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Is Required?</label>
                        <input type="checkbox" name="is_required" value="1" <?=set_checkbox('is_required', '1')?>>
                     </div>
                  </div>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
                     </div>
                  </div>

                  <?php echo form_close();
                  ?>

               </div>  <!-- END GRID BODY -->
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>

<script type="text/javascript">
function toggleOptions(fieldType) {
    if (fieldType === 'dropdown') {
        document.getElementById('options_row').style.display = 'block';
    } else {
        document.getElementById('options_row').style.display = 'none';
    }
}
// Call on page load to handle pre-filled values
document.addEventListener('DOMContentLoaded', function() {
    var fieldTypeSelect = document.querySelector('select[name="field_type"]');
    toggleOptions(fieldTypeSelect.value);
});
</script>