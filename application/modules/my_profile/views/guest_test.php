<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>
               <div class="grid-body">

                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>
                  <?php 
                  $attributes = array('id' => 'scout_request_validation');
                  echo form_open_multipart("", $attributes);?>

                  <div class="row">
                     <div class="col-md-12">   
                        <div class="alert alert-info alert-block fade in">        
                           <h4 class="alert-heading semi-bold"><i class="icon-warning-sign"></i> Thank you for registration.</h4>
                           <p class="semi-bold"> To be an online scout member please provide your personal and scout information below.</p>
                        </div>                        
                     </div>          
                  </div>

                  <div class="row">
                     <h4 class="margin_left_15 semi-bold">Personal Information</h4>
                     <div class="col-md-7">
                       
                        <div class="row form-row">
                           <div class="col-md-12">      
                              <h5 class="semi-bold" style="font-style: italic;text-decoration: underline;">Present Address</h5>
                              <div class="row form-row">
       
                                 <div class="col-md-6">
                                    <label class="form-label">Division <span class='required'>*</span></label>
                                    <?php echo form_error('pre_division_id');
                                    $more_attr = 'class="form-control input-sm" id="division"';
                                    echo form_dropdown('pre_division_id', $divisions, set_value('pre_division_id'), $more_attr);
                                    ?>
                                 </div>
                                 <div class="col-md-6">
                                    <label class="form-label">District <span class='required'>*</span></label>
                                    <?php echo form_error('pre_district_id'); ?>
                                    <select name="pre_district_id" class="distirict_val form-control input-sm" id="district">
                                       <option value="">-- Select One --</option>
                                    </select>
                                 </div>

                              </div>
                           </div> 
                        </div>
                     </div> <!-- //col-md-7 -->

       
                  </div> <!-- //personel info row -->


    

                  <div class="row">
                     
                
                  </div> <!-- //Institute and scout info -->


                  <div class="form-actions">  
                     <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-cons" onclick="return confirm('Are you sure all information is correct?')"><i class="icon-ok"></i> Save and Send Request </button>
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
  

}); 

</script>