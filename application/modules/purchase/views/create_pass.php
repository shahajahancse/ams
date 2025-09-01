<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('my_appointment/host_person')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-8">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('pass/host_person')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Pass List</a>  
                  </div>
               </div>
               <div class="grid-body">
                  <div><?php //echo validation_errors(); ?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php echo form_open("my_appointment/create_pass");?>

                  <div class="row form-row">
                     <div class="col-md-12">
                        <label class="form-label"> Select Host Person</label>
                        <?php echo form_error('host_id'); 
                        $more_attr = 'class="form-control"';
                        echo form_dropdown('host_id', $host_persons, set_value('host_id'), $more_attr);
                        ?>
                     </div>

                     <div class="col-md-12">
                        <label class="form-label">Reason</label>
                        <?php echo form_error('reason'); ?>
                        <input type="text" name="reason" class="form-control input-sm" placeholder="" value="<?=set_value('reason')?>">
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

   </div> <!-- /content -->
</div> <!-- /page-content -->
