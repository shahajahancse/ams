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
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php if($this->session->flashdata('error')):?>
                     <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error');;?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate');
                  echo form_open_multipart("cbs_integration/generate_and_export", $attributes);?>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Start Date <span class="required">*</span></label>
                        <input name="start_date" type="date" value="<?=set_value('start_date')?>" class="form-control input-sm" required>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">End Date <span class="required">*</span></label>
                        <input name="end_date" type="date" value="<?=set_value('end_date')?>" class="form-control input-sm" required>
                     </div>
                  </div>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Generate & Export CSV</button>
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
         start_date: { required: true },
         end_date: { required: true },
      }
   });
   });
</script>