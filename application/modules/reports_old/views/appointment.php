<style type="text/css">
  label.head{ color: #0aa699; font-size: 14px; margin-bottom: -25px; font-weight: bold; background: #fff;padding: 5px 10px; display: inline-block; position: absolute; top:-18px; left: 15px; border:1px solid #0aa699; }
  .margin-top{margin-top:20px;}
</style>

<div class="page-content">     
 <div class="content">  
  <ul class="breadcrumb">
   <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
   <li><a href="<?=base_url('reports/appointment')?>" class="active"><?=$module_name?></a></li>
   <li><?=$meta_title; ?></li>
 </ul>

 <div class="row">
   <div class="col-md-12">
    <div class="grid simple horizontal">
     <div class="grid-title">
      <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
      <div class="pull-right">                
       <!-- <a href="<?=base_url('appointment')?>" class="btn btn-blueviolet btn-xs btn-mini"> Appointment List</a>   -->
     </div>
   </div>
   <div class="grid-body">                  
    <?php if($this->session->flashdata('success')):?>
      <div class="alert alert-success">
        <?php echo $this->session->flashdata('success');?>
      </div>
    <?php endif; ?>

    <?php 
    $attributes = array('id' => 'validate', 'target' => '_blank');
    echo form_open_multipart("reports/appointment_result", $attributes);?>

    <div class="row">
      <div class="col-md-8">
        <div style="text-align: center; border:1px solid #0aa699; padding:25px 15px 15px 15px; margin:0 -15px; position: relative; ">
          <div id="error" style="display: none;">
            <div class="alert alert-danger">Please fillup red level fields</div>
          </div>
          <label class="head">Results Filter</label>
          <div class="row form-row">
            <!-- <div class="col-md-6">
              <div class="form-group">
                <label class="form-label pull-left"> Appointment Type</label>
                <?php echo form_error('financing_id');
                $more_attr = 'class="form-control input-sm" id="financing_id"';
                        //echo form_dropdown('financing_id', $financing_list, set_value('financing_id', $this->input->post('financing_id')), $more_attr);
                ?>
              </div>
            </div> -->
            <div class="col-md-3">
              <div class="form-group">
                <label class="form-label">Start Date</label>
                <input name="start_date" id="start_date" type="date" value="" class="form-control input-sm datetime" placeholder="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="form-label">End Date</label>
                <input name="end_date" id="end_date" type="date" value="" class="form-control input-sm datetime" placeholder="">
              </div>
            </div>
          </div>
        </div>

        <div class="row form-row">
          <div class="col-md-12" style="text-align: center; border:1px solid #0aa699; padding:10px 5px 20px 5px; position: relative; margin-top: 40px">
            <label class="head">Display Result Button</label> 
            <button type="submit" name="btnsubmit" value="pdf_daily_appointment" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> Daily Appointment List </button>
            <button type="submit" name="btnsubmit" value="pdf_appointment" onclick="return validFunc2()" class="btn btn-info btn-cons margin-top"> Appointment List </button>
            <!-- <a href="http://www.example.com" target="_blank">Example.com in a new tab</a> -->
          </div>
        </div>
      </div> <!-- /col-md-8 -->

    </div>

    <?php echo form_close();?>

  </div>  <!-- END GRID BODY -->              
</div> <!-- END GRID -->
</div>

</div> <!-- END ROW -->

</div>
</div>

<script>
    // var hostname='<?php echo base_url('reports/training_result');?>';

    function validFunc1() {
      // var field = document.getElementById("financing_id").value;
      var startdate = document.getElementById("start_date").value;
      // var enddate = document.getElementById("end_date").value;
      submitOK = "true";

      if (startdate == '') {        
        $("#start_date").css("border", "1px solid red");
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

    function validFunc2() {
      // var field = document.getElementById("financing_id").value;
      var startdate = document.getElementById("start_date").value;
      var enddate = document.getElementById("end_date").value;
      submitOK = "true";

      if (startdate == '') {        
        $("#start_date").css("border", "1px solid red");
        submitOK = "false";
      }
      if (enddate == '') {        
        $("#end_date").css("border", "1px solid red");
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

    // https://www.quora.com/How-can-I-check-if-an-input-field-has-a-certain-text-value-with-JavaScript
  </script>
