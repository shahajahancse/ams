<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
     <!--  <li> <?=$module_name?> </li> -->
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('general_setting/occupation')?>" class="btn btn-blueviolet btn-xs btn-mini"> Occupation List</a>  
              </div>
             </div>
             <div class="grid-body">
              <!-- <form id="form_traditional_validation" action="#"> -->
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php //echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <a class="close" data-dismiss="alert">&times;</a>
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>

              <?php 
              $attributes = array('id' => 'occupation_validate');
              echo form_open_multipart("general_setting/occupation_edit/".$info->id, $attributes);?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Occupation Name (English)</label>
                  <?php echo form_error('occupation_name'); ?>
                  <input name="occupation_name" id="occupation_name" type="text" value="<?=set_value('occupation_name', $info->occupation_name)?>" class="form-control input-sm" placeholder="e.g. Student">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Occupation Name (Bangla)</label>
                  <?php echo form_error('occupation_name_bn'); ?>
                  <input name="occupation_name_bn" id="occupation_name_bn" type="text" value="<?=set_value('occupation_name_bn', $info->occupation_name_bn)?>" class="form-control input-sm" placeholder="উদাহরণ: ছাত্র">
                </div>
              </div>

              <div class="row">
              	<div class="col-md-6">
                    <label class="form-label">Status</label>
                    <?php echo form_error('status'); ?>
                    <input type="radio" name="status" id="" class="group_control" value="1" <?=set_value('is_current', $info->status)==1?'checked':'';?>> Enable &nbsp;&nbsp;
                    <input type="radio" name="status" id="" class="group_control" value="0" <?=set_value('is_current', $info->status)==0?'checked':'';?>> Disable
                 </div>
              </div>


              <div class="form-actions">  
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
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
      $('#occupation_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         occupation_name: {
            required: true
         },
         occupation_name_bn: {
            required: false
         },

         status: {
            required: true
         },
      },

    });
   });   
</script>