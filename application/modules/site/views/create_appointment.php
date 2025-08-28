<div class="container w-75">
	<div class="secondary_sc_content">
      <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>
      <div class="container">
         <div class="row">

            <div class="col-md-12">
               <div id="infoMessage"><?php echo $message;?></div>
               <?php echo validation_errors(); ?>
            </div>

            <div class="col-md-12">
               <?php 
               $attributes = array('id' => 'jsvalidate');
               echo form_open_multipart("create-appointment",$attributes);
               ?>
               <fieldset >      
                  <legend>Schedule Info</legend>
                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Schedule Type <span class='required'>*</span></label>
                        <?php echo form_error('schedule_type');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('schedule_type', $type_dd, set_value('schedule_type'), $more_attr);
                        ?>
                     </div>
                     <div class="col-md-6">
                     <label class="form-label">Proposed Datatime <span class='required'>*</span></label>
                        <?php echo form_error('date');?>
                        <input name="date" value="<?=set_value('date')?>" type="text" class="form-control datetimepicker" placeholder="" required>
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-6">
                        <label class="form-label">Schedule Title <span class='required'>*</span></label>
                        <?php echo form_error('title');?>
                        <input type="text" name="title" value="<?=set_value('title')?>" class="form-control input-sm" placeholder="" required>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Organization </label>
                        <?php echo form_error('organization');?>
                        <input type="text" name="organization" value="<?=set_value('organization')?>" class="form-control input-sm" placeholder="">
                     </div>
                  </div>

                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label">Venue <span class='required'>*</span></label>
                        <?php echo form_error('venue');?>
                        <input type="text" name="venue" value="<?=set_value('venue')?>" class="form-control input-sm" placeholder="" required>
                     </div>
                     <div class="col-md-12">
                        <label class="form-label">Purpose <span class='required'>*</span></label>
                        <?php echo form_error('purpose');?>
                        <input type="text" name="purpose" value="<?=set_value('purpose')?>" class="form-control input-sm" placeholder="" required>
                     </div>
                  </div>

                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Send Request</button>
                     </div>
                  </div>
                  <?php echo form_close();?>

               </fieldset>

               <br>
            </div>

         </div>
      </div> <!-- /row -->
   </div> <!-- /container -->

</div>
</div>