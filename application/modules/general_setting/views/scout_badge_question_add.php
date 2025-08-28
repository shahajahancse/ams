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
                <a href="<?=base_url('general_setting/scout_badge_question')?>" class="btn btn-blueviolet btn-success btn-xs btn-mini"> Scout Badge Question List</a>  
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
              $attributes = array('id' => 'scout_badge_validate');
              echo form_open_multipart("general_setting/scout_badge_question_add", $attributes);?>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Select Section</label>
                  <?php echo form_error('section_id'); ?>
                  <?php echo form_dropdown('section_id',$section, set_value('section_id'), 'class="form-control input-sm"');?>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Select Badge Type</label>
                  <?php echo form_error('badge_type_id'); ?>
                  <?php echo form_dropdown('badge_type_id', $badge_type, set_value('badge_type_id'), 'class="form-control input-sm sc_badge_val"');?>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Description (Bangla)</label>
                  <?php echo form_error('questions'); ?>
                  <input name="questions" id="questions" type="text" value="<?=set_value('questions')?>" class="form-control input-sm" placeholder="">
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
      $('#scout_badge_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
      	badge_id: {
            required: true
         },
         questions: {
            required: true
         },
      },

    });
   });   
</script>