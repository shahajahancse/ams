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
            echo form_open_multipart("reports/nilg_employee_result", $attributes);?>

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
                        <label class="form-label pull-left"> এনআইএলজি কর্মকর্তা/কর্মচারী ডাটা টাইপ</label>
                        <?php echo form_error('data_sheet_type');
                        $more_attr = 'class="form-control input-sm" id="dataSheetType"';
                        echo form_dropdown('data_sheet_type', $data_type, set_value('data_sheet_type', $this->input->post('data_sheet_type')), $more_attr);
                        ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label pull-left">এনআইএলজি প্রশিক্ষণ কোর্স </label>
                        <?php echo form_error('course_id');
                        $more_attr = 'class="form-control input-sm" id="courseid"';
                        echo form_dropdown('course_id', $course_list, set_value('course_id'), $more_attr);
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

                    <button type="submit" name="btnsubmit" value="pdf_nilg_employee" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> এনআইএলজি কর্মকর্তা/কর্মচারী রিপোর্ট </button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_number_designation" class="btn btn-info btn-cons margin-top"> পদবি ভিত্তিক রির্পোট</button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_number_education" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top">শিক্ষাগত যোগ্যতা ভিত্তিক রির্পোট</button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_number_gender" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> নারী/পরুষ ভিত্তিক রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_number_age" onclick="return validFunc1()" class="btn btn-info btn-cons margin-top"> বয়স ভিত্তিক রিপোর্ট</button>

                    <button type="submit" name="btnsubmit" value="pdf_nilg_nilg_course_complete"  onclick="return validFunc4()" class="btn btn-info btn-cons margin-top"> এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষণের তালিকা</button>

                  </div>
                </div>
              </div> <!-- /col-md-8 -->

              <div class="col-md-4">
                <div style="padding: 5px 15px 15px 15px; background:#eee; font-style: italic;">
                  <label class="form-label">পদবি সমূহ</label> 
                  <div style="border:1px solid #0aa699; padding: 4px 0; background: #0aa699; color: #fff;">
                    <div class="row-fluid">
                      <div class="checkbox check-danger">
                        <input id="checkboxall" type="checkbox" value="1">
                        <label for="checkboxall" style="color: #fff">সব নির্বাচন করুন</label>
                      </div>
                    </div>
                    <div id="budget_sub_head_id2" style="max-height: 350px; overflow-y: scroll; background: #fff; padding-top: 5px;">

                      <?php foreach ($designations as $row) { ?>
                      <div class="row-fluid">
                        <div class="checkbox check-primary">
                          <input id="checkbox<?=$row->id?>" type="checkbox" name="designations[]" class="select" value="<?=$row->id?>">
                          <label for="checkbox<?=$row->id?>"><?=$row->desig_name?></label>
                        </div>
                      </div>
                      <?php } ?>

                    </div>
                  </div>
                </div>
              </div>

            </div>
            <?php form_close(); ?>
          </div>
        </div>
      </div>

    </div> <!-- END ROW -->
  </div>


  <script>
    $(document).ready(function(){
    $('#checkboxall').click(function(){
        if($(this).is(":checked"))
          $('.select').prop('checked',true);
        else
          $('.select').prop('checked',false);
      });
    });

    function validFunc1() {
      var datasheet = document.getElementById("dataSheetType").value;
      // var district = document.getElementById("district").value;
      // var upazila = document.getElementById("upazila").value;
      submitOK = "true";

      if (datasheet == '') {        
        $("#dataSheetType").css("border", "1px solid red");
        submitOK = "false";
      }
      // if (district == '') {        
      //   $("#district").css("border", "1px solid red");
      //   submitOK = "false";
      // }
      // if (upazila == '') {        
      //   $("#upazila").css("border", "1px solid red");
      //   submitOK = "false";
      // }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }else{
        $("#validate").submit();
      }
    }

    function validFunc2() {
      var division = document.getElementById("division").value;
      var district = document.getElementById("district").value;
      submitOK = "true";

      if (division == '') {
        // alert("The name may have no more than 10 characters");
        $("#division").css("border", "1px solid red");
        submitOK = "false";
      }
      if (district == '') {
        // alert("The name may have no more than 10 characters");
        $("#district").css("border", "1px solid red");
        submitOK = "false";
      }

      if (submitOK == "false") {
        $("#error").show();
        return false;
      }else{
        $("#validate").submit();
      }
    }

    function validFunc3() {
      var division = document.getElementById("division").value;
      var district = document.getElementById("district").value;
      var upazila = document.getElementById("upazila").value;
      submitOK = "true";

      if (division == '') {
        // alert("The name may have no more than 10 characters");
        $("#division").css("border", "1px solid red");
        submitOK = "false";
      }
      if (district == '') {
        // alert("The name may have no more than 10 characters");
        $("#district").css("border", "1px solid red");
        submitOK = "false";
      }
      if (upazila == '') {
        // alert("The name may have no more than 10 characters");
        $("#upazila").css("border", "1px solid red");
        submitOK = "false";
      }


      if (submitOK == "false") {
        $("#error").show();
        return false;
      }else{
        $("#validate").submit();
      }
    }

    function validFunc4() {
      var datasheet = document.getElementById("dataSheetType").value;
      var field = document.getElementById("courseid").value;
      submitOK = "true";

      if (datasheet == '') {        
        $("#dataSheetType").css("border", "1px solid red");
        submitOK = "false";
      }
      if (field == '') {
        // alert("The name may have no more than 10 characters");
        $("#courseid").css("border", "1px solid red");
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
