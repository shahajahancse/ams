<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('general_setting')?>" class="active"> General Setting </a> </li>
         <li> <a href="<?=base_url('general_setting/asset_floors')?>" class="active"> Asset Floors List </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('general_setting/asset_floors')?>" class="btn btn-info btn-xs btn-mini"> Asset Floors List</a>
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate');
                  echo form_open_multipart("general_setting/asset_floors_add", $attributes);?>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Floor Name <span class="required">*</span></label>
                        <?php echo form_error('floor_name'); ?>
                        <input name="floor_name" type="text" value="<?=set_value('floor_name')?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Branch</label>
                        <?php
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('unit_id', $branches, set_value('unit_id'), $more_attr);
                        ?>
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

<script type="text/javascript">
   $(document).ready(function() {
      $('#validate').validate({
      // focusInvalid: false,
      ignore: "",
      rules: {
         floor_name: { required: true }
      }
   });
   });
</script>