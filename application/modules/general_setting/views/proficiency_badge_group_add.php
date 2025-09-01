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
                <a href="<?=base_url('general_setting/proficiency_badge_group')?>" class="btn btn-blueviolet btn-success btn-xs btn-mini"> Proficiency Badge Group List</a>  
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
              // $attributes = array('id' => 'scout_expertness_group_validation');
              echo form_open_multipart("general_setting/proficiency_badge_group_add");?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Select Section</label>
                  <?php echo form_error('section_id'); ?>
                  <?php echo form_dropdown('section_id',$section, set_value('section_id'), ' class="form-control input-sm"');?>
                </div>
               
                <div class="col-md-6">
                  <label class="form-label">Proficiency Badge Group Name</label>
                  <?php echo form_error('prof_badge_group_name'); ?>
                  <input name="prof_badge_group_name" id="prof_badge_group_name" type="text" value="<?=set_value('prof_badge_group_name')?>" class="form-control input-sm" placeholder="">
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

<!-- <script type="text/javascript">
   $(document).ready(function() {
      $('#scout_expertness_group_validation').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
      	badge_id: {
            required: true
         },
         expert_group_name: {
            required: true
         },
      },

    });
   });   
</script> -->