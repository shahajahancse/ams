<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> <?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
      <li><?=lang('Add New')?></li>
    </ul>
<?php
    $exam_data = '<option value="">Select</option>';
    for($i=0;$i<sizeof($exams);$i++)
    {
      $exam_data .= '<option value="'.$exams[$i]['id'].'">'.$exams[$i]['exam_name'].'</option>';
    }

    $pass_year_data = '<option value="">Select</option>';
    for($i=1995;$i<=date('Y');$i++)
    {
      $pass_year_data .= '<option value="'.$i.'">'.$i.'</option>';
    }

    $subject_data = '<option value="">Select</option>';
    for($i=0;$i<sizeof($subjects);$i++)
    {
      $subject_data .= '<option value="'.$subjects[$i]['id'].'">'.$subjects[$i]['sub_name'].'</option>';
    }

    $board_data = '<option value="">Select</option>';
    for($i=0;$i<sizeof($boards);$i++)
    {                              
      $board_data .= '<option value="'.$boards[$i]['id'].'">'.$boards[$i]['board_name'].'</option>';
    }


    $organization_data = '';
    foreach ($organizations as $key => $value) {      
      $organization_data .= '<option value="'.$key.'">'.$value.'</option>';
    }

    $designation_data = '';
    foreach ($designation as $key => $value) {      
      $designation_data .= '<option value="'.$key.'">'.$value.'</option>';
    }

    $nilg_trainings_data = '';
    foreach ($nilg_trainings as $key => $value) {      
      $nilg_trainings_data .= '<option value="'.$key.'">'.$value.'</option>';
    }
                  
  ?>
<style type="text/css">
  #educationInfoDiv td{padding: 5px;}
  #experienceDiv td{padding: 5px;}
  #nilgTrainingDiv td{padding: 5px;}
  #localOrgTrainingDiv td{padding: 5px;}
  #foreignOrgTrainingDiv td{padding: 5px;}
  #promotionDiv td{padding: 5px;}
</style>  

    <div class="row">
        <div class="col-md-12">
          <div class="grid simple horizontal">
            <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="btn btn-primary btn-xs btn-mini"> <?php echo lang($this->uri->segment(1).'_list');?></a>
              </div>
             </div>
            <div class="grid-body ">
              <div class="row">
              <?php
                $attributes = array('id' => 'dataSheetForm');
                echo form_open_multipart("personal_datas/add", $attributes);
              ?>
                <form id="dataSheetForm" >
                  <div id="rootwizard" class="col-md-12">
                    <div class="form-wizard-steps">
                      <ul class="wizard-steps">
                        <li class="" data-target="#step1"> <a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title"><strong>সাধারণ তথ্য</strong></span> </a> </li>
                        <li data-target="#step2" class=""> <a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title"><strong>প্রতিষ্ঠানের তথ্য</strong></span> </a> </li>
                        <li data-target="#step3" class=""> <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title"><strong>শিক্ষাগত যোগ্যতা ও প্রশিক্ষ্ণের তথ্য</strong></span> </a> </li>
                        <li data-target="#step4" class=""> <a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title"><strong>লগইন</strong> <br>
                          </span> </a> </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="tab-content">
                      <div class="tab-pane" id="tab1"> <br>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-label">নামঃ (ক) বাংলা (স্পষ্ট অক্ষরে)</label>
                              <?php echo form_error('name_bangla'); ?>
                              <input name="name_bangla" id="name_bangla" type="text" value="<?=set_value('name_bangla')?>" class="form-control input-sm" placeholder="e.g. আতাউল মোস্তাফা">
                            </div>

                            <div class="form-group">
                              <label class="form-label">(খ) ইংরেজি (Capital Letter)</label>
                              <?php echo form_error('name_english'); ?>
                              <input name="name_english" id="name_english" type="text" value="<?=set_value('name_english')?>" class="form-control input-sm" onkeyup="upperCase()" placeholder="e.g. ATAUL MOSTAFA">
                            </div>

                            <div class="form-group">
                              <label class="form-label">পিতা / স্বামীর নাম</label>
                              <?php echo form_error('father_name'); ?>
                              <input name="father_name" id="father_name" type="text" value="<?=set_value('father_name')?>" class="form-control input-sm" placeholder="">
                            </div>

                            <div class="form-group">
                              <label class="form-label">মাতার নাম</label>
                              <?php echo form_error('mother_name'); ?>
                              <input name="mother_name" id="mother_name" type="text" value="<?=set_value('mother_name')?>" class="form-control input-sm" placeholder="">
                            </div>
                            
                          </div>

                          <div class="col-md-4">                               
                            <div class="form-group">
                              <label class="form-label">বৈবাহিক অবস্থা</label>
                              <?php echo form_error('marital_status_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm" id="marital_status_id"';
                              echo form_dropdown('marital_status_id', $marital_status, set_value('marital_status_id', $this->input->post('marital_status_id')), $more_attr);
                              ?>
                            </div>                            

                            <div class="row form-row">
                              <label class="form-label" style="margin-left: 15px;">ছেলে / মেয়ের সংখ্যা</label>
                              <div class="col-md-6">                              
                                <div class="form-group">                                  
                                  <label class="form-label">ছেলে</label>
                                    <?php echo form_error('son_number'); ?>
                                    <input name="son_number" id="son_number" type="number" value="<?=set_value('son_number')?>" class="form-control input-sm" placeholder="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label">মেয়ে</label>
                                  <?php echo form_error('daughter_number'); ?>
                                  <input name="daughter_number" id="daughter_number" type="number" value="<?=set_value('daughter_number')?>" class="form-control input-sm" placeholder="">
                                </div>
                              </div>
                            </div>

                            <div class="row form-row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label">জম্ম তারিখ</label>
                                  <?php echo form_error('date_of_birth'); ?>
                                  <input name="date_of_birth" id="date_of_birth" type="text" value="<?=set_value('date_of_birth')?>" class="form-control input-sm datetime" placeholder="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label class="form-label">লিঙ্গ</label>
                                <?php echo form_error('gender'); ?>
                                 <input type="radio" name="gender" value="Male" <?php echo set_value('gender', $this->input->post('gender')) == 'Male' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">পুরূষ </span> 
                                <input type="radio" name="gender" value="Female" <?php echo set_value('gender', $this->input->post('gender')) == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">নারী</span>
                                <div class="error_placeholder"></div>
                              </div>
                            </div>

                          </div>

                          <div class="col-md-4">      
                            <div class="form-group">
                              <label class="form-label">টেলিফোন / মোবাইল নম্বর</label>
                              <?php echo form_error('telephone_mobile'); ?>
                              <input name="telephone_mobile" id="telephone_mobile" type="text" value="<?=set_value('telephone_mobile')?>" class="form-control input-sm" placeholder="">
                            </div>
                    
                            <div class="form-group">
                              <label class="form-label">ই-মেইল </label>
                              <?php echo form_error('email'); ?>
                              <input name="email" id="email" type="text" value="<?=set_value('email')?>" class="form-control input-sm" placeholder="">
                            </div>

                            <div class="form-group">
                              <label class="form-label">(ক) স্থায়ী ঠিকানা</label>
                              <?php echo form_error('present_add'); ?>
                              <textarea name="present_add" type="text" class="form-control input-sm" placeholder=""><?=set_value('present_add')?></textarea>
                            </div>

                            <div class="form-group">
                              <label class="form-label">(ক) বর্তমান ঠিকানা</label>
                              <?php echo form_error('permanent_add'); ?>
                              <textarea name="permanent_add" id="permanent_add" type="text" class="form-control input-sm" placeholder=""><?=set_value('permanent_add')?></textarea>
                            </div>

                          </div>
                        </div>
                      </div> <!-- tab1 -->

                      <div class="tab-pane" id="tab2"> <br>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">বাক্তিগত ডাটা টাইপ</label><br>
                                <?php echo form_error('data_sheet_type'); ?>
                                <input type="radio" class="representative" name="data_sheet_type" value="1" <?=set_value('data_sheet_type')==1?'checked':'';?>> জনপ্রতিনিধি
                                <input type="radio" class="employee" name="data_sheet_type" value="2" <?=set_value('data_sheet_type')==2?'checked':'';?>> কর্মকর্তা/কর্মচারী
                            </div>

                            <div class="form-group">
                              <label class="form-label">বিভাগ</label>
                              <?php echo form_error('division_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm" id="division"';
                              echo form_dropdown('division_id', $divisions, set_value('division_id', $this->input->post('division_id')), $more_attr);
                              ?>
                            </div>

                            <div class="form-group">
                              <label class="form-label">জেলা</label>
                              <?php echo form_error('district_id'); ?>
                                <select name="district_id" class="district_val form-control input-sm"  id="distirict">
                                  <option value=""><?=lang('select_district')?></option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label class="form-label">উপজেলা / থানা</label>
                              <?php echo form_error('upa_tha_id'); ?>
                              <select name="upa_tha_id" class="upazila_thana form-control input-sm" id="upazila_thana_id" >
                                <option value=""><?=lang('select_up_thana')?></option>
                              </select>
                            </div>                            
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">প্রথম নির্বাচিত / চাকুরীতে যোগদানকৃত প্রতিষ্ঠানের নাম </label>
                              <?php echo form_error('first_org_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('first_org_id', $organizations, set_value('first_org_id', $this->input->post('first_org_id')), $more_attr);
                              ?>
                              <!-- <select name="first_org_id" class="organization_val form-control input-sm">
                                  <option value="">Select Organization</option>
                              </select> -->
                            </div>

                            <div class="form-group">
                              <label class="form-label">প্রথম নির্বাচিত / চাকুরীতে যোগদানকৃত পদের নাম</label>
                              <?php echo form_error('first_desig_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('first_desig_id', $designation, set_value('first_desig_id', $this->input->post('first_desig_id')), $more_attr);
                              ?>
                            </div>

                            <div class="form-group">
                              <label class="form-label">প্রথম সভা / যোগদানের তারিখ</label>
                              <?php echo form_error('first_attend_date'); ?>
                              <input name="first_attend_date" id="first_attend_date" type="text" value="<?=set_value('first_attend_date')?>" class="form-control input-sm datetime" placeholder="">
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">বর্তমান নির্বাচিত / চাকুরীতে যোগদানকৃত প্রতিষ্ঠানের নাম </label>
                              <?php echo form_error('curr_org_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('curr_org_id', $organizations, set_value('curr_org_id', $this->input->post('curr_org_id')), $more_attr);
                              ?>
                              <!-- <select name="curr_org_id" class="organization_val form-control input-sm">
                                  <option value="">Select Organization</option>
                              </select> -->
                            </div>

                            <div class="form-group">
                              <label class="form-label">বর্তমান নির্বাচিত / চাকুরীতে দায়িত্বপ্রাপ্ত পদের নাম</label>
                              <?php echo form_error('curr_desig_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('curr_desig_id', $designation, set_value('curr_desig_id'), $more_attr);
                              ?>
                            </div>

                            <div class="form-group">
                              <label class="form-label">বর্তমান দায়িত্বপ্রাপ্ত পদে যোগদানের তারিখ</label>
                              <?php echo form_error('curr_attend_date'); ?>
                              <input name="curr_attend_date" id="curr_attend_date" type="text" value="<?=set_value('curr_attend_date')?>" class="form-control input-sm datetime" placeholder="">
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div id="empDiv" style="display: none;">
                              <div class="form-group">
                                <label class="form-label">চাকুরী স্থায়ী করনের তারিখ</label>
                                <?php echo form_error('job_per_date'); ?>
                                <input name="job_per_date" id="job_per_date" type="text" value="<?=set_value('job_per_date')?>" class="form-control input-sm datetime" placeholder="">
                              </div>

                              <div class="form-group">
                                <label class="form-label">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখ</label>
                                <?php echo form_error('retirement_prl_date'); ?>
                                <input name="retirement_prl_date" id="retirement_prl_date" type="text" value="<?=set_value('retirement_prl_date')?>" class="form-control input-sm datetime" placeholder="">
                              </div>
                      
                              <div class="form-group">
                                <label class="form-label">অবসর গ্রহণের তারিখ</label>
                                <?php echo form_error('retirement_date'); ?>
                                <input name="retirement_date" id="retirement_date" type="text" value="<?=set_value('retirement_date')?>" class="form-control input-sm datetime" placeholder="">
                              </div>
                            </div>

                            <div id="repDiv" style="display: none;">
                              <div class="form-group">
                                <label class="form-label">এ যাবত কতবার নির্বাচিত হয়েছেন?</label>
                                <select name="how_much_elected" class="form-control input-sm">
                                  <?php for($i=1; $i <= 10; $i++){ ?>
                                    <option value="<?=$i?>" <?=$this->input->post('how_much_elected')==$i?'selected':'';?>><?=$i?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row" style="margin-bottom: 20px;">
                          <div class="col-md-12" >
                            <label class="form-label">একাধিকবার নির্বাচিত বা  ইতিপূর্বে যেসব কর্মস্থলে চাকুরী করেছেন তার বিবরণ</label>
                            <table width="100%" border="1" id="experienceDiv">
                              <tr>
                                <td>প্রতিষ্ঠানের নাম</td>
                                <td>পদের নাম</td>
                                <td>মেয়াদকাল</td>
                                <td width="120"> <a href="javascript:void();" id="addRowExperience" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                              </tr>
                              <tr></tr>
                            </table>
                          </div>
                        </div>

                        <div class="row" id="promotion" style=" display: none; margin-bottom: 20px;">
                          <div class="col-md-12" >
                            <label class="form-label">পদোন্নতি সংক্রান্ত তথ্যাদিঃ</label>
                            <table width="100%" border="1" id="promotionDiv">
                              <tr>
                                <td>পদোন্নতি প্রাপ্ত পদবী</td>
                                <td>প্রতিষ্ঠানের নাম</td>
                                <td>বেতনক্রম </td>
                                <td>মন্তব্য </td>
                                <td width="120"> <a href="javascript:void();" id="addRowPromotion" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                              </tr>
                              <tr></tr>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="tab3"> <br>
                        <div class="row" style="margin-bottom: 30px;">
                          <div class="col-md-12" >
                            <label class="form-label">শিক্ষাগত যোগ্যতাঃ</label>
                            <table width="100%" border="1" id="educationInfoDiv">
                              <tr>
                                <td>পরিক্ষার নাম</td>
                                <td>পাশের সন</td>
                                <td>বিষয়</td>
                                <td>বোর্ড / বিশ্ববিদ্যালয়</td>
                                <td width="120"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                              </tr>
                              <tr></tr>
                            </table>
                          </div>
                        </div>

                        <div class="row" style="margin-bottom: 30px;">
                          <div class="col-md-12" >
                            <label class="form-label">প্রশিক্ষ্ণ সংক্রান্তঃ</label>
                            <label class="form-label">(ক) এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষ্ণ</label>
                            <table width="100%" border="1" id="nilgTrainingDiv">
                              <tr>
                                <td>প্রশিক্ষ্ণে অংশগ্রহণকালিন সময়ে পদবী</td>
                                <td>কোর্সের নাম</td>
                                <td>সময়কাল </td>
                                <td>মেয়াদ</td>
                                <td width="120"> <a href="javascript:void();" id="addRowNilgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                              </tr>
                              <tr></tr>
                            </table>
                          </div>
                        </div>

                        <div class="row" style="margin-bottom: 30px;">
                          <div class="col-md-12" >                            
                            <label class="form-label">(খ) দেশে অন্যান্য প্রতিষ্ঠান থেকে প্রাপ্ত প্রশিক্ষ্ণ</label>
                            <table width="100%" border="1" id="localOrgTrainingDiv">
                              <tr>
                                <td>কোর্সের নাম</td>
                                <td>প্রশিক্ষ্ণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
                                <td>সময়কাল </td>
                                <td>মেয়াদ</td>
                                <td width="120"> <a href="javascript:void();" id="addRowLocalOrgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                              </tr>
                              <tr></tr>
                            </table>
                          </div>
                        </div>

                        <div class="row" style="margin-bottom: 30px;">
                          <div class="col-md-12" >                            
                            <label class="form-label">(গ) বিদেশ থেকে প্রাপ্ত প্রশিক্ষ্ণ</label>
                            <table width="100%" border="1" id="foreignOrgTrainingDiv">
                              <tr>
                                <td>কোর্সের নাম</td>
                                <td>প্রশিক্ষ্ণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
                                <td>সময়কাল </td>
                                <td>মেয়াদ</td>
                                <td width="120"> <a href="javascript:void();" id="addRowForeignOrgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                              </tr>
                              <tr></tr>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="tab4"> <br>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-label">জাতীয় পরিচয়পত্র নম্বর</label>
                              <?php echo form_error('national_id'); ?>
                              <input name="national_id" id="national_id" type="number" value="<?=set_value('national_id')?>" class="form-control input-sm" placeholder="">
                              <div class="nid_success"></div>
                            </div>

                              <div class="form-group">
                                <label class="form-label">পাসওয়ার্ড</label>
                                <?php echo form_error('password'); ?>
                                <input name="password" id="" type="text" value="<?=set_value('password')?>" class="form-control input-sm" placeholder="">
                              </div>
                          </div>
                        </div>
                      </div>

                      <ul class=" wizard wizard-actions pull-right">
                        <li class="previous first" style="display:none;"><a href="javascript:;" class="btn">&nbsp;&nbsp;First&nbsp;&nbsp;</a></li>
                        <li class="previous" id="previous_button"><a href="javascript:;" class="btn">&nbsp;&nbsp;Previous&nbsp;&nbsp;</a></li>
                        <li class="next last" style="display:none;"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Last&nbsp;&nbsp;</a></li>
                        <li class="next last" id="save_button" style="display:none;">
                          <!-- <a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Save&nbsp;&nbsp;</a> -->
                          <?php echo form_submit('submit', 'Save', "class='btn btn-primary'"); ?>
                        </li>
                        <li class="next" id="next_button"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Next&nbsp;&nbsp;</a></li>                        
                      </ul>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    </div>


  </div>
</div>

<?php
    $exam_data = '<option value="">Select</option>';
    for($i=0;$i<sizeof($exams);$i++)
    {
      $exam_data .= '<option value="'.$exams[$i]['id'].'">'.$exams[$i]['exam_name'].'</option>';
    }

    $pass_year_data = '<option value="">Select</option>';
    for($i=1950;$i<=date('Y');$i++)
    {
      $pass_year_data .= '<option value="'.$i.'">'.$i.'</option>';
    }

    $subject_data = '<option value="">Select</option>';
    for($i=0;$i<sizeof($subjects);$i++)
    {
      $subject_data .= '<option value="'.$subjects[$i]['id'].'">'.$subjects[$i]['sub_name'].'</option>';
    }

    $board_data = '<option value="">Select</option>';
    for($i=0;$i<sizeof($boards);$i++)
    {                              
      $board_data .= '<option value="'.$boards[$i]['id'].'">'.$boards[$i]['board_name'].'</option>';
    }


    $organization_data = '';
    foreach ($organizations as $key => $value) {      
      $organization_data .= '<option value="'.$key.'">'.$value.'</option>';
    }

    $designation_data = '';
    foreach ($designation as $key => $value) {      
      $designation_data .= '<option value="'.$key.'">'.$value.'</option>';
    }

    $nilg_trainings_data = '';
    foreach ($nilg_trainings as $key => $value) {      
      $nilg_trainings_data .= '<option value="'.$key.'">'.$value.'</option>';
    }
                  
  ?>

<script>
    // Education
    $("#addRow").click(function(e) {
        var items = '';
        items+= '<tr>';        
        
        items+= '<td><select class="form-control input-sm" name="edu_exam_id[]"><?php echo $exam_data;?></select></td>';
        items+= '<td><select class="form-control input-sm" name="edu_pass_year[]"><?php echo $pass_year_data;?></select></td>';
        items+= '<td><select class="form-control input-sm" name="edu_subject_id[]"><?php echo $subject_data;?></select></td>';
        items+= '<td><select class="form-control input-sm" name="edu_board_id[]"><?php echo $board_data;?></select></td>';
        items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRow(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

        items+= '</tr>';
        // items+= '</div>';
        $('#educationInfoDiv tr:last').after(items);
        // $("#educationInfoDiv").append(items);
    }); 

    function removeRow(id){ 
        $(id).closest("tr").remove();
    }


    

    //Foreign Organization Training
    $("#addRowForeignOrgTraining").click(function(e) {
        var items = '';
        items+= '<tr>';        
        
        items+= '<td><select class="form-control input-sm" name="foreign_course_id[]"><?php echo $nilg_trainings_data;?></select></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="foreign_training_org_name_adds[]"></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="foreign_time_duration[]"></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="foreign_duration[]"></td>';
        items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowforeignOrgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

        items+= '</tr>';
        // items+= '</div>';
        $('#foreignOrgTrainingDiv tr:last').after(items);
    }); 
    function removeRowforeignOrgTraining(id){ 
        $(id).closest("tr").remove();
    }
    //Local Organization Training
    $("#addRowLocalOrgTraining").click(function(e) {
        var items = '';
        items+= '<tr>';        
        
        items+= '<td><select class="form-control input-sm" name="local_course_id[]"><?php echo $nilg_trainings_data;?></select></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="local_training_org_name_adds[]"></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="local_time_duration[]"></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="local_duration[]"></td>';
        items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowLocalOrgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

        items+= '</tr>';
        // items+= '</div>';
        $('#localOrgTrainingDiv tr:last').after(items);
    }); 
    function removeRowLocalOrgTraining(id){ 
        $(id).closest("tr").remove();
    }

    //NILG Training
    $("#addRowNilgTraining").click(function(e) {
        var items = '';
        items+= '<tr>';        
        
        items+= '<td><select class="form-control input-sm" name="nilg_desig_id[]"><?php echo $designation_data;?></select></td>';
        items+= '<td><select class="form-control input-sm" name="nilg_course_id[]"><?php echo $nilg_trainings_data;?></select></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="nilg_time_duration[]"></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="nilg_duration[]"></td>';
        items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowNilgTraining(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

        items+= '</tr>';
        // items+= '</div>';
        $('#nilgTrainingDiv tr:last').after(items);
    }); 
    function removeRowNilgTraining(id){ 
        $(id).closest("tr").remove();
    }

    //NILG Training
    $("#addRowPromotion").click(function(e) {
        var items = '';
        items+= '<tr>';        
        
        items+= '<td><select class="form-control input-sm" name="promo_desig_id[]"><?php echo $designation_data;?></select></td>';
        items+= '<td><select class="form-control input-sm" name="promo_org_id[]"><?php echo $organization_data;?></select></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="promo_salary_ratio[]"></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="promo_comments[]"></td>';
        items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowPromotion(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

        items+= '</tr>';
        // items+= '</div>';
        $('#promotionDiv tr:last').after(items);
    }); 
    function removeRowPromotion(id){ 
        $(id).closest("tr").remove();
    }

    // Experence 
    $("#addRowExperience").click(function(e) {
        var items = '';
        items+= '<tr>';        
        items+= '<td><select class="form-control input-sm" name="exp_org_id[]"><?php echo $organization_data;?></select></td>';
        items+= '<td><select class="form-control input-sm" name="exp_desig_id[]"><?php echo $designation_data;?></select></td>';
        items+= '<td><input type="text" class="form-control input-sm" name="exp_duration[]"></td>';
        items+= '<td> <a href="javascript:void();" class="label label-important" onclick="removeRowExperience(this)"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন </a></td>';

        items+= '</tr>';
        // items+= '</div>';
        $('#experienceDiv tr:last').after(items);
    }); 

    function removeRowExperience(id){ 
        $(id).closest("tr").remove();
    }


    //district dropdown
    $('#division').change(function(){
      $('.district_val').addClass('form-control input-sm');
      $(".district_val > option").remove();
      var id = $('#division').val();
      $.ajax({
          type: "POST",
          url: hostname +"personal_datas/ajax_get_district_by_div/" + id,
          success: function(func_data)
          {
              $.each(func_data,function(id,name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(name);
                  $('.district_val').append(opt);
              });
          }
      });
    });

    //district dropdown
    $('#distirict').change(function(){
      $('.upazila_thana').addClass('form-control input-sm');
      $(".upazila_thana > option").remove();
      var dis_id = $('#distirict').val();
      $.ajax({
          type: "POST",
          url: hostname +"personal_datas/ajax_get_upa_tha_by_dis/" + dis_id,
          success: function(upazilaThanas)
          {
              $.each(upazilaThanas,function(id,ut_name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(ut_name);
                  $('.upazila_thana').append(opt);
              });
          }
      });
    });

    // $('#upazila_thana_id').change(function(){
    //   $('.organization_val').addClass('form-control input-sm');
    //   $(".organization_val > option").remove();
    //   var up_th_id = $('#upazila_thana_id').val();
    //   // alert(up_th_id);
    //   $.ajax({
    //       type: "POST",
    //       url: hostname +"personal_datas/ajax_get_organization_by_up_th_id/" + up_th_id,
    //       success: function(organization)
    //       {
    //           // alert(organization);
    //           $.each(organization,function(id,orgnization_name)
    //           {
    //               var opt = $('<option />');
    //               opt.val(id);
    //               opt.text(orgnization_name);
    //               $('.organization_val').append(opt);
    //           });
    //       }
    //   });
    // });
   


    $(".employee").click(function(){
        $("#empDiv").show();
        $("#repDiv").hide();
        $("#promotion").show();
    });

    $(".representative").click(function(){
        $("#empDiv").hide();
        $("#repDiv").show();
        $("#promotion").hide();
    });


    function upperCase() {
        var x = document.getElementById("name_english");
        x.value = x.value.toUpperCase();
    }

    
    $(document).ready(function() {
    

    }); 
</script>