<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('reports/scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>           
               </div>

               <div class="grid-body">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  
                  <?php 
                  $attributes = array('id' => 'validate', 'target'=>'_blank');
                  echo form_open("reports/scouts_member", $attributes);?>

                  <fieldset class="col-md-12">      
                     <legend>Report Filtering</legend>
                     <div id="error" style="display: none;">
                        <div class="alert alert-danger">Please fill up red level input filtering field.</div>
                     </div>
                     <?php $this->load->view('scouts_member_filter')?>
                  </fieldset> 

                  <fieldset class="col-md-12">      
                     <legend>Report Button (Number)</legend>

                     <button type="submit" name="btnsubmit" value="smr_region" onclick="return smr_region()" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Top Scouts Member Registration By Region </button>

                     <button type="submit" name="btnsubmit" value="smr_district" onclick="return smr_region()" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Top Scouts Member Registration By District </button>

                     <button type="submit" name="btnsubmit" value="smr_upazila" onclick="return smr_region()" class="btn btn-blueviolet btn-cons"><i class="fa fa-list"></i> Top Scouts Member Registration By Upazila </button>
                     
                  </fieldset> 

                  <div class="clearfix"></div>
                  <?php form_close(); ?>
               </div> <!-- /grid-body -->
            </div> <!-- /grid -->
         </div>
      </div> <!-- /row-fluid -->

   </div> <!-- /content -->
</div> <!-- /page-content -->

<script>
   function smr_region() {
      // var field = document.getElementById("financing_id").value;
      var startDate = document.getElementById("date_from").value;
      var endDate = document.getElementById("date_to").value;
      submitOK = "true";

      // if (field == '') {        
      //   $("#financing_id").css("border", "1px solid red");
      //   submitOK = "false";
      // }
      if (startDate == '') {        
         $("#date_from").css("border", "1px solid red");
         submitOK = "false";
      }
      if (endDate == '') {        
         $("#date_to").css("border", "1px solid red");
         submitOK = "false";
      }

      if (submitOK == "false") {
         $("#error").show();
         return false;
      }else{
         // window.open(hostname);
         $("#validate").submit();
      }
   }
</script>