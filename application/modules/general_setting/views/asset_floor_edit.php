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
            <div class="grid simple horizontal">
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
                  echo form_open_multipart(uri_string(), $attributes);?>
                  <div class="row form-row">
                     <div class="col-md-4">
                        <label class="form-label">Floor Name <span class="required">*</span></label>
                        <?php echo form_error('floor_name'); ?>
                        <input name="floor_name" type="text" value="<?=set_value('floor_name', $info->floor_name)?>" class="form-control input-sm" placeholder="">
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Branch</label>
                        <?php $divs = $this->db->where('status', 1)->get('branches')->result(); ?>
                        <select name="branch_id" class="form-control input-sm" required>
                           <option value="">-- Select One --</option>
                           <?php foreach ($divs as $key => $value) { ?>
                              <option <?= ($info->unit_id == $value->id)? 'selected' : '' ?> value="<?=$value->id?>"><?=$value->name_en?></option>
                           <?php } ?>
                           <option value="0">Others</option>
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <?php echo form_error('status'); ?>
                        <input type="radio" name="status" id="" class="group_control" value="1" <?= ($info->status==1)? 'checked' : '' ?>>
                        Active &nbsp;&nbsp;
                        <input type="radio" name="status" id="" class="group_control" value="0" <?= ($info->status==0)? 'checked' : '' ?>>
                        Inactive
                     </div>
                  </div>

                  <div class="form-actions">
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Update</button>
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