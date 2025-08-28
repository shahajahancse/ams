<style type="text/css">
  label.head{ color: #0aa699; font-size: 14px; margin-bottom: -25px; font-weight: bold; background: #fff;padding: 5px 10px; display: inline-block; position: absolute; top:-18px; left: 15px; border:1px solid #0aa699; }
  .margin-top{margin-top:20px;}
</style>
<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> রিপোর্ট </a> </li>
      <li><?=$meta_title?></li>
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
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            <?php 
            $attributes = array('id' => 'validate', 'target'=>'_blank');
            echo form_open_multipart("reports/others_employee_result", $attributes);?>

            <div class="row">
              <div class="col-md-8">
                <div style="text-align: center; border:1px solid #0aa699; padding:25px 15px 15px 15px; margin:0 -15px; position: relative; ">
                  <div id="error" style="display: none;">
                    <div class="alert alert-danger">এই রিপোর্ট দেখার জন্য লাল চিহ্নিত ফিল্ড গুলো পূরণ করুন।</div>
                  </div>
                  <label class="head">ফলাফল প্রদর্শনের ফিল্টারিং ফিল্ড সমূহ</label>
                  <div class="row form-row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label pull-left"> অন্যান্য ডাটা টাইপ</label>
                        <?php echo form_error('data_sheet_type');
                        $more_attr = 'class="form-control input-sm" id="dataSheetType"';
                        echo form_dropdown('data_sheet_type', $data_type, set_value('data_sheet_type', $this->input->post('data_sheet_type')), $more_attr);
                        ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label pull-left">ডাটার স্ট্যাটাস </label>
                        <?php echo form_error('status');
                        $more_attr = 'class="form-control input-sm"';
                        echo form_dropdown('status', $datasheet_status, set_value('status'), $more_attr);
                        ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-md-12" style="text-align: center; border:1px solid #0aa699; padding:10px 5px 20px 5px; position: relative; margin-top: 40px">
                    <label class="head">ফলাফল প্রদর্শনের বাটন সমূহ</label> 

                    <button type="submit" name="btnsubmit" value="pdf_others_employee" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> অন্যান্য ব্যাক্তিগত রিপোর্ট </button>
                  </div>
                </div>
              </div> <!-- /col-md-8 -->

            </div>
            <?php form_close(); ?>
          </div>
        </div>
      </div>

    </div> <!-- END ROW -->
  </div>


  <script>
    $(document).ready(function(){

    function validFunc1() {
      var datasheet = document.getElementById("dataSheetType").value;
      submitOK = "true";

      if (datasheet == '') {        
        $("#dataSheetType").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }else{
        $("#validate").submit();
      }
    }

    // https://www.quora.com/How-can-I-check-if-an-input-field-has-a-certain-text-value-with-JavaScript
  </script>
