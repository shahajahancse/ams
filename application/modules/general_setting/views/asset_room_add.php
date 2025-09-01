<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('general_setting')?>" class="active"> General Setting </a> </li>
         <li> <a href="<?=base_url('general_setting/asset_rooms')?>" class="active"> Asset Rooms List </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('general_setting/asset_rooms')?>" class="btn btn-blueviolet btn-xs btn-mini"> Asset Rooms List</a>
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <?php $attributes = array('id' => 'validate');
                  echo form_open_multipart("general_setting/asset_rooms_add", $attributes);?>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Room Name <span class="required">*</span></label>
                        <?php echo form_error('room_name'); ?>
                        <input name="room_name" type="text" value="<?=set_value('room_name')?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Floor <span class="required">*</span></label>
                        <?php
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('floor_id', $floors, set_value('floor_id'), $more_attr);
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
         room_name: { required: true },
         floor_id: { required: true }
      }
   });
   });
</script>