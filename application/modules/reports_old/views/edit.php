<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> <?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
      <li><?=$meta_title; ?></li>
    </ul>


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
          <div class="grid simple horizontal transparent">
            <div class="grid-title red">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="btn btn-primary btn-xs btn-mini"> <?php echo lang($this->uri->segment(1).'_list');?></a>
              </div>
             </div>
            <div class="grid-body ">
              <div class="row">
              <?php
                $attributes = array('id' => 'form_data_sheet_update_validate');
                echo form_open_multipart(current_url(), $attributes);
              ?>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <a class="close" data-dismiss="alert">&times;</a>
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>
              <!-- <form id="form-data-sheet-update" action="#"> -->

                <div class="col-md-12">
                  <ul class="nav nav-tabs" id="tab-01">
                    <li class="active"><a href="#general">সাধারণ তথ্য</a></li>
                    <li><a href="#organizaiotn">প্রতিষ্ঠানের তথ্য</a></li>
                    <li><a href="#training">শিক্ষাগত যোগ্যতা ও প্রশিক্ষ্ণের তথ্য</a></li>
                    <!-- <li><a href="#change_pass">লগইন</a></li>               -->
                  </ul>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                  <div class="tab-content">
                    <div class="tab-pane active" id="general">
                      <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-label">নামঃ (ক) বাংলা (স্পষ্ট অক্ষরে)</label>
                              <?php echo form_error('name_bangla'); ?>
                              <input name="name_bangla" id="name_bangla" type="text" value="<?=set_value('name_bangla', $info->name_bangla)?>" class="form-control input-sm" placeholder="e.g. আতাউল মোস্তাফা">
                            </div>

                            <div class="form-group">
                              <label class="form-label">(খ) ইংরেজি (Capital Letter)</label>
                              <?php echo form_error('name_english'); ?>
                              <input name="name_english" id="name_english" type="text" value="<?=set_value('name_english', $info->name_english)?>" class="form-control input-sm" onkeyup="upperCase()" placeholder="e.g. ATAUL MOSTAFA">
                            </div>

                            <div class="form-group">
                              <label class="form-label">পিতা / স্বামীর নাম</label>
                              <?php echo form_error('father_name'); ?>
                              <input name="father_name" id="father_name" type="text" value="<?=set_value('father_name', $info->father_name)?>" class="form-control input-sm" placeholder="">
                            </div>

                            <div class="form-group">
                              <label class="form-label">মাতার নাম</label>
                              <?php echo form_error('mother_name'); ?>
                              <input name="mother_name" id="mother_name" type="text" value="<?=set_value('mother_name', $info->mother_name)?>" class="form-control input-sm" placeholder="">
                            </div>
                            
                          </div>

                          <div class="col-md-4">   
                            <div class="form-group">
                              <label class="form-label">জাতীয় পরিচয়পত্র নম্বর</label><br>
                              <span style="font-weight: bold"> <?=$info->national_id;?> </span>
                            </div>
                            <div class="row form-row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label">জম্ম তারিখ</label>
                                  <?php echo form_error('date_of_birth'); ?>
                                  <input name="date_of_birth" id="date_of_birth" type="text" value="<?=set_value('date_of_birth', $info->date_of_birth)?>" class="form-control input-sm datetime" placeholder="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label class="form-label">লিঙ্গ</label>
                                <?php echo form_error('gender'); ?>
                                 <input type="radio" name="gender" value="Male" <?php echo set_value('gender', $info->gender) == 'Male' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">পুরূষ </span> 
                                <input type="radio" name="gender" value="Female" <?php echo set_value('gender', $info->gender) == 'Female' ? "checked" : ""; ?>> <span style="color: black; font-size: 15px;">নারী</span>
                                <div class="error_placeholder"></div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="form-label">বৈবাহিক অবস্থা</label>
                              <?php echo form_error('marital_status_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm" id="marital_status_id"';
                              echo form_dropdown('marital_status_id', $marital_status, set_value('marital_status_id', $info->marital_status_id), $more_attr);
                              ?>
                            </div>                            

                            <div class="row form-row">
                              <label class="form-label" style="margin-left: 15px;">ছেলে / মেয়ের সংখ্যা</label>
                              <div class="col-md-6">                              
                                <div class="form-group">                                  
                                  <label class="form-label">ছেলে</label>
                                    <?php echo form_error('son_number'); ?>
                                    <input name="son_number" id="son_number" type="number" value="<?=set_value('son_number', $info->son_number)?>" class="form-control input-sm" placeholder="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label">মেয়ে</label>
                                  <?php echo form_error('daughter_number'); ?>
                                  <input name="daughter_number" id="daughter_number" type="number" value="<?=set_value('daughter_number', $info->daughter_number)?>" class="form-control input-sm" placeholder="">
                                </div>
                              </div>
                            </div>

                          </div>

                          <div class="col-md-4">      
                            <div class="form-group">
                              <label class="form-label">টেলিফোন / মোবাইল নম্বর</label>
                              <?php echo form_error('telephone_mobile'); ?>
                              <input name="telephone_mobile" id="telephone_mobile" type="text" value="<?=set_value('telephone_mobile', $info->telephone_mobile)?>" class="form-control input-sm" placeholder="">
                            </div>
                    
                            <div class="form-group">
                              <label class="form-label">ই-মেইল </label>
                              <?php echo form_error('email'); ?>
                              <input name="email" id="email" type="text" value="<?=set_value('email', $info->email)?>" class="form-control input-sm" placeholder="">
                            </div>

                            <div class="form-group">
                              <label class="form-label">(ক) স্থায়ী ঠিকানা</label>
                              <?php echo form_error('present_add'); ?>
                              <textarea name="present_add" type="text" class="form-control input-sm" placeholder=""><?=set_value('present_add', $info->present_add)?></textarea>
                            </div>

                            <div class="form-group">
                              <label class="form-label">(ক) বর্তমান ঠিকানা</label>
                              <?php echo form_error('permanent_add'); ?>
                              <textarea name="permanent_add" id="permanent_add" type="text" class="form-control input-sm" placeholder=""><?=set_value('permanent_add', $info->permanent_add)?></textarea>
                            </div>

                          </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="organizaiotn">
                      <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">বাক্তিগত ডাটা টাইপ</label><br>
                              <?php
                                if($info->data_sheet_type == 1){
                                  $sheet_type = 'জনপ্রতিনিধি';
                                }else{
                                  $sheet_type = 'কর্মকর্তা/কর্মচারী';
                                }

                                echo $sheet_type;
                              ?>
                            </div>
                            <div class="form-group">
                              <label class="form-label">বিভাগ</label>
                              <?php echo form_error('division_id'); 
                              $more_attr = 'class="form-control input-sm" id="division"';
                              echo form_dropdown('division_id', $divisions, set_value('division_id', $info->division_id), $more_attr);
                              ?>
                            </div>

                            <div class="form-group">
                              <label class="form-label">জেলা</label>
                              <?php echo form_error('district_id'); 
                                $more_attr = 'class="form-control input-sm district_val" id="distirict"';
                                echo form_dropdown('district_id', $districts, set_value('district_id', $info->district_id), $more_attr);
                              ?>
                            </div>

                            <div class="form-group">
                              <label class="form-label">উপজেলা / থানা</label>
                              <?php echo form_error('upa_tha_id'); 
                                $more_attr = 'class="form-control input-sm upazila_thana" id="upazila_thana_id"';
                                echo form_dropdown('upa_tha_id', $up_thanas, set_value('upa_tha_id', $info->upa_tha_id), $more_attr);
                              ?>
                            </div>                            
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">প্রথম নির্বাচিত / চাকুরীতে যোগদানকৃত প্রতিষ্ঠানের নাম </label>
                              <?php echo form_error('first_org_id'); 
                                $more_attr = 'class="form-control input-sm organization_val" id="upazila_thana_id"';
                                echo form_dropdown('first_org_id', $organizations, set_value('first_org_id', $info->first_org_id), $more_attr);
                              ?>
                            </div>

                            <div class="form-group">
                              <label class="form-label">প্রথম নির্বাচিত / চাকুরীতে যোগদানকৃত পদের নাম</label>
                              <?php echo form_error('first_desig_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('first_desig_id', $designation, set_value('first_desig_id', $info->first_desig_id), $more_attr);
                              ?>
                            </div>

                            <div class="form-group">
                              <label class="form-label">প্রথম সভা / যোগদানের তারিখ</label>
                              <?php echo form_error('first_attend_date'); ?>
                              <input name="first_attend_date" id="first_attend_date" type="text" value="<?=set_value('first_attend_date', $info->first_attend_date)?>" class="form-control input-sm datetime" placeholder="">
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-label">বর্তমান নির্বাচিত / চাকুরীতে যোগদানকৃত প্রতিষ্ঠানের নাম </label>
                              <?php echo form_error('curr_org_id'); 
                                $more_attr = 'class="form-control input-sm organization_val" id="upazila_thana_id"';
                                echo form_dropdown('curr_org_id', $organizations, set_value('curr_org_id', $info->curr_org_id), $more_attr);
                              ?>
                            </div>

                            <div class="form-group">
                              <label class="form-label">বর্তমান নির্বাচিত / চাকুরীতে দায়িত্বপ্রাপ্ত পদের নাম</label>
                              <?php echo form_error('curr_desig_id'); ?>
                              <?php
                              $more_attr = 'class="form-control input-sm"';
                              echo form_dropdown('curr_desig_id', $designation, set_value('curr_desig_id', $info->curr_desig_id), $more_attr);
                              ?>
                            </div>

                            <div class="form-group">
                              <label class="form-label">বর্তমান দায়িত্বপ্রাপ্ত পদে যোগদানের তারিখ</label>
                              <?php echo form_error('curr_attend_date'); ?>
                              <input name="curr_attend_date" id="curr_attend_date" type="text" value="<?=set_value('curr_attend_date', $info->curr_attend_date)?>" class="form-control input-sm datetime" placeholder="">
                            </div>
                          </div>

                          <div class="col-md-3">
                          <?php if($info->data_sheet_type == 2){ ?>
                            <div>
                              <div class="form-group">
                                <label class="form-label">চাকুরী স্থায়ী করনের তারিখ</label>
                                <?php echo form_error('job_per_date'); ?>
                                <input name="job_per_date" id="job_per_date" type="text" value="<?=set_value('job_per_date', $info->job_per_date)?>" class="form-control input-sm datetime" placeholder="">
                              </div>

                              <div class="form-group">
                                <label class="form-label">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখ</label>
                                <?php echo form_error('retirement_prl_date'); ?>
                                <input name="retirement_prl_date" id="retirement_prl_date" type="text" value="<?=set_value('retirement_prl_date', $info->retirement_prl_date)?>" class="form-control input-sm datetime" placeholder="">
                              </div>
                      
                              <div class="form-group">
                                <label class="form-label">অবসর গ্রহণের তারিখ</label>
                                <?php echo form_error('retirement_date'); ?>
                                <input name="retirement_date" id="retirement_date" type="text" value="<?=set_value('retirement_date', $info->retirement_date)?>" class="form-control input-sm datetime" placeholder="">
                              </div>
                            </div>

                            <?php }else{ ?>

                            <div>
                              <div class="form-group">
                                <label class="form-label">এ যাবত কতবার নির্বাচিত হয়েছেন?</label>
                                <select name="how_much_elected" class="form-control input-sm">
                                  <?php for($i=1; $i <= 10; $i++){ ?>
                                    <option value="<?=$i?>" <?=$info->how_much_elected==$i?'selected':'';?>><?=$i?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } ?>
                          </div>

                            <div class="col-md-12" >
                              <div id="msgExp"> </div>
                              <label class="form-label">একাধিকবার নির্বাচিত বা  ইতিপূর্বে যেসব কর্মস্থলে চাকুরী করেছেন তার বিবরণ</label>
                              <table width="100%" border="1" id="experienceDiv">
                                <tr>
                                  <td>প্রতিষ্ঠানের নাম</td>
                                  <td>পদের নাম</td>
                                  <td>মেয়াদকাল</td>
                                  <td width="120"> <a href="javascript:void();" id="addRowExperience" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                                </tr>
                                <?php foreach ($experience as $row) { ?>
                                  <tr>
                                    <td><?php 
                                      $more_attr = 'class="form-control input-sm organization_val" id="upazila_thana_id"';
                                      echo form_dropdown('exp_org_id[]', $organizations, set_value('exp_org_id', $row->exp_org_id), $more_attr); ?></td>
                                    <td><?php 
                                      $more_attr = 'class="form-control input-sm organization_val" id="upazila_thana_id"';
                                      echo form_dropdown('exp_desig_id[]', $designation, set_value('exp_desig_id', $row->exp_desig_id), $more_attr); ?></td>
                                    <td><input type="text" class="form-control input-sm" value="<?=set_value('exp_duration', $row->exp_duration)?>" name="exp_duration[]">
                                    <input type="hidden" name="hide_exp_id[]" value="<?=$row->id?>">
                                    </td>
                                    <td width="120"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowExpFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                                  </tr>

                                <?php } ?>
                                <tr></tr>
                              </table>
                            </div>

                            <?php if($info->data_sheet_type == 2){ ?>
                              <div class="col-md-12" style="margin-top: 10px;">
                                <div id="msgPromo"> </div>
                                <label class="form-label">পদোন্নতি সংক্রান্ত তথ্যাদিঃ</label>
                                <table width="100%" border="1" id="promotionDiv">
                                  <tr>
                                    <td>পদোন্নতি প্রাপ্ত পদবী</td>
                                    <td>প্রতিষ্ঠানের নাম</td>
                                    <td>বেতনক্রম </td>
                                    <td>মন্তব্য </td>
                                    <td width="120"> <a href="javascript:void();" id="addRowPromotion" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                                  </tr>
                                  <?php foreach ($promotion as $row) { ?>
                                  <tr>
                                    <td><?php 
                                      $more_attr = 'class="form-control input-sm organization_val" id="upazila_thana_id"';
                                      echo form_dropdown('promo_desig_id[]', $designation, set_value('promo_desig_id', $row->promo_desig_id), $more_attr); ?></td>
                                    <td><?php 
                                      $more_attr = 'class="form-control input-sm organization_val" id="upazila_thana_id"';
                                      echo form_dropdown('promo_org_id[]', $organizations, set_value('promo_org_id', $row->promo_org_id), $more_attr); ?></td>
                                    <td><input type="text" class="form-control input-sm" value="<?=set_value('promo_salary_ratio', $row->promo_salary_ratio)?>" name="promo_salary_ratio[]">
                                    </td>
                                    <td><input type="text" class="form-control input-sm" value="<?=set_value('promo_comments', $row->promo_comments)?>" name="promo_comments[]">
                                    <input type="hidden" name="hide_promo_id[]" value="<?=$row->id?>">
                                    </td>
                                    <td width="120"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowPromoFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                                  </tr>

                                <?php } ?>
                                  <tr></tr>
                                </table>
                              </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="tab-pane" id="training">
                      <div class="row">
                        <div class="col-md-12" >
                          <div id="msgEdu"> </div>
                          <label class="form-label">শিক্ষাগত যোগ্যতাঃ</label>
                          <table width="100%" border="1" id="educationInfoDiv">
                            <tr>
                              <td>পরিক্ষার নাম</td>
                              <td>পাশের সন</td>
                              <td>বিষয়</td>
                              <td>বোর্ড / বিশ্ববিদ্যালয়</td>
                              <td width="120"> <a href="javascript:void();" id="addRow"  class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                            </tr>
                            <?php foreach ($education as $row) { ?>
                              <tr>
                                <td><?php 
                                  $more_attr = 'class="form-control input-sm"';
                                  echo form_dropdown('edu_exam_id[]', $exams_2, set_value('edu_exam_id', $row->edu_exam_id), $more_attr); ?>
                                  </td>
                                <td>
                                    <select class="form-control input-sm" name="edu_pass_year[]">
                                      <?php
                                        for($i=1950;$i<=date('Y');$i++){
                                          $selected = $row->edu_pass_year==$i?"selected":"";
                                          echo '<option value="'.$i.'" '. $selected .'>'.$i.'</option>';
                                        }
                                      ?>
                                    </select>
                                  </td>
                                <td>
                                  <?php 
                                  $more_attr = 'class="form-control input-sm"';
                                  echo form_dropdown('edu_subject_id[]', $subjects_2, set_value('edu_subject_id', $row->edu_subject_id), $more_attr); ?>
                                </td>
                                <td>
                                  <?php 
                                  $more_attr = 'class="form-control input-sm"';
                                  echo form_dropdown('edu_board_id[]', $boards_2, set_value('edu_board_id', $row->edu_board_id), $more_attr); ?>
                                  </td>
                                <input type="hidden" name="hide_edu_id[]" value="<?=$row->id?>">
                                <td width="120"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowEducationFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                              </tr>

                            <?php } ?>
                            <tr></tr>
                          </table>
                        </div>                            

                        <div class="col-md-12" >
                          <div style="margin-top: 20px;">প্রশিক্ষ্ণ সংক্রান্তঃ</div>    
                          <div id="msgNILG"> </div>
                          <label class="form-label">(ক) এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষ্ণ</label>
                          <table width="100%" border="1" id="nilgTrainingDiv">
                            <tr>
                              <td>প্রশিক্ষ্ণে অংশগ্রহণকালিন সময়ে পদবী</td>
                              <td>কোর্সের নাম</td>
                              <td width="150">সময়কাল</td>
                              <td width="150">মেয়াদ</td>
                              <td width="120"> <a href="javascript:void();" id="addRowNilgTraining"  class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                            </tr>
                            <?php foreach ($nilg_training as $row) { ?>
                              <tr>
                                <td><?php 
                                    $more_attr = 'class="form-control input-sm organization_val" id="upazila_thana_id"';
                                    echo form_dropdown('nilg_desig_id[]', $designation, set_value('nilg_desig_id', $row->nilg_desig_id), $more_attr); ?>
                                </td>          
                                <td>
                                  <?php 
                                  $more_attr = 'class="form-control input-sm"';
                                  echo form_dropdown('nilg_course_id[]', $nilg_trainings, set_value('nilg_course_id', $row->nilg_course_id), $more_attr); ?>
                                </td>
                                <td><input type="text" class="form-control input-sm" value="<?=set_value('nilg_time_duration', $row->nilg_time_duration)?>" name="nilg_time_duration[]">
                                </td>
                                <td><input type="text" class="form-control input-sm" value="<?=set_value('nilg_duration', $row->nilg_duration)?>" name="nilg_duration[]">
                                  <input type="hidden" name="hide_nilg_training_id[]" value="<?=$row->id?>">
                                </td>
                                <td width="120"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowNILGFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                              </tr>
                            <?php } ?>
                            <tr></tr>
                          </table>
                        </div> 

                        <div class="col-md-12" style="margin-top: 20px;">  
                          <div id="msgLocal"> </div>                          
                          <label class="form-label">(খ) দেশে অন্যান্য প্রতিষ্ঠান থেকে প্রাপ্ত প্রশিক্ষ্ণ</label>

                          <table width="100%" border="1" id="localOrgTrainingDiv">
                            <tr>
                              <td>কোর্সের নাম</td>
                              <td>প্রশিক্ষ্ণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
                              <td width="100">সময়কাল </td>
                              <td width="100">মেয়াদ</td>
                              <td width="120"> <a href="javascript:void();" id="addRowLocalOrgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                            </tr>
                            <?php foreach ($local_training as $row) { ?>
                              <tr>
                                <td>
                                  <?php 
                                  $more_attr = 'class="form-control input-sm"';
                                  echo form_dropdown('local_course_id[]', $nilg_trainings, set_value('local_course_id', $row->local_course_id), $more_attr); ?>
                                </td>
                                <td><input type="text" class="form-control input-sm" value="<?=set_value('local_training_org_name_adds', $row->local_training_org_name_adds)?>" name="local_training_org_name_adds[]">
                                </td>
                                <td><input type="text" class="form-control input-sm" value="<?=set_value('local_time_duration', $row->local_time_duration)?>" name="local_time_duration[]">
                                </td>
                                <td><input type="text" class="form-control input-sm" value="<?=set_value('local_duration', $row->local_duration)?>" name="local_duration[]">
                                  <input type="hidden" name="hide_local_training_id[]" value="<?=$row->id?>">
                                </td>
                                <td width="120"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowLocalFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                              </tr>
                            <?php } ?>
                            <tr></tr>
                          </table>
                        </div>  

                        <div class="col-md-12" style="margin-top: 20px;">  
                          <div id="msgForeign"> </div>                          
                          <label class="form-label">(গ) বিদেশ থেকে প্রাপ্ত প্রশিক্ষ্ণ</label>

                          <table width="100%" border="1" id="foreignOrgTrainingDiv">
                            <tr>
                              <td>কোর্সের নাম</td>
                              <td>প্রশিক্ষ্ণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
                              <td width="100">সময়কাল </td>
                              <td width="100">মেয়াদ</td>
                              <td width="120"> <a href="javascript:void();" id="addRowForeignOrgTraining" class="label label-success"> <i  class="fa fa-plus-circle"></i> যোগ করুন</a> </td>
                            </tr>
                            <?php foreach ($foreign_training as $row) { ?>
                              <tr>
                                <td>
                                  <?php 
                                  $more_attr = 'class="form-control input-sm"';
                                  echo form_dropdown('foreign_course_id[]', $nilg_trainings, set_value('foreign_course_id', $row->foreign_course_id), $more_attr); ?>
                                </td>
                                <td><input type="text" class="form-control input-sm" value="<?=set_value('foreign_training_org_name_adds', $row->foreign_training_org_name_adds)?>" name="foreign_training_org_name_adds[]">
                                </td>
                                <td><input type="text" class="form-control input-sm" value="<?=set_value('foreign_time_duration', $row->foreign_time_duration)?>" name="foreign_time_duration[]">
                                </td>
                                <td><input type="text" class="form-control input-sm" value="<?=set_value('foreign_duration', $row->foreign_duration)?>" name="foreign_duration[]">
                                  <input type="hidden" name="hide_foreign_training_id[]" value="<?=$row->id?>">
                                </td>
                                <td width="120"> <a href="javascript:void();" data-id="<?=$row->id?>" onclick="removeRowForeignFunc(this)" class="label label-important"> <i class="fa fa-minus-circle"></i> মুছে ফেলুন</a> </td>
                              </tr>
                            <?php } ?>
                            <tr></tr>
                          </table>
                        </div>             

                      </div>
                    </div>

                  </div>
                </div>

                <div>  
                <div class="pull-right">
                  <?php echo form_submit('submit', 'Save', "class='btn btn-primary btn-cons'"); ?>
                </div>
              </div>
            <?php echo form_close();?>

              </div>
            </div>
          </div>
        </div>

    </div>


  </div>
</div>

<script>
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
        // $("#educationInfoDiv").append(items);
    });     

    function removeRowExperience(id){ 
        $(id).closest("tr").remove();
    }

    function removeRowExpFunc(id){ 
        var dataId = $(id).attr("data-id");
        // alert(dataId);

        var txt;
        if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
            $.ajax({
              type: "POST",
              url: hostname+"personal_datas/ajax_experiance_del/"+dataId,
              success: function (response) {
                $("#msgExp").addClass('alert alert-success').html(response);
                $(id).closest("tr").remove();
              }
            });
            txt = "You pressed OK!";
        }else{
            txt = "You pressed Cancel!";
        }
    }


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

    function removeRowEducationFunc(id){ 
        var dataId = $(id).attr("data-id");

        if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
            $.ajax({
              type: "POST",
              url: hostname+"personal_datas/ajax_education_del/"+dataId,
              success: function (response) {
                $("#msgEdu").addClass('alert alert-success').html(response);
                $(id).closest("tr").remove();
              }
            });
        }
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
    function removeRowForeignFunc(id){ 
        var dataId = $(id).attr("data-id");

        if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
            $.ajax({
              type: "POST",
              url: hostname+"personal_datas/ajax_foreign_training_del/"+dataId,
              success: function (response) {
                $("#msgForeign").addClass('alert alert-success').html(response);
                $(id).closest("tr").remove();
              }
            });
        }
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
    function removeRowLocalFunc(id){ 
        var dataId = $(id).attr("data-id");

        if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
            $.ajax({
              type: "POST",
              url: hostname+"personal_datas/ajax_local_training_del/"+dataId,
              success: function (response) {
                $("#msgLocal").addClass('alert alert-success').html(response);
                $(id).closest("tr").remove();
              }
            });
        }
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
    function removeRowNILGFunc(id){ 
        var dataId = $(id).attr("data-id");

        if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
          $.ajax({
            type: "POST",
            url: hostname+"personal_datas/ajax_nilg_training_del/"+dataId,
            success: function (response) {
              $("#msgNILG").addClass('alert alert-success').html(response);
              $(id).closest("tr").remove();
            }
          });
        }
    }


    //NILG Promotion
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

    function removeRowPromoFunc(id){ 
        var dataId = $(id).attr("data-id");
        // alert(dataId);

        var txt;
        if (confirm("আপনি কি এই তথ্যটি ডাটাবেজ থেকে সম্পূর্ণভাবে মুছে ফেলতে চান?") == true) {
            $.ajax({
              type: "POST",
              url: hostname+"personal_datas/ajax_promotion_del/"+dataId,
              success: function (response) {
                $("#msgPromo").addClass('alert alert-success').html(response);
                $(id).closest("tr").remove();
              }
            });
            txt = "You pressed OK!";
        }else{
            txt = "You pressed Cancel!";
        }
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

    $('#upazila_thana_id').change(function(){
      $('.organization_val').addClass('form-control input-sm');
      $(".organization_val > option").remove();
      var up_th_id = $('#upazila_thana_id').val();
      // alert(up_th_id);
      $.ajax({
          type: "POST",
          url: hostname +"personal_datas/ajax_get_organization_by_up_th_id/" + up_th_id,
          success: function(organization)
          {
              // alert(organization);
              $.each(organization,function(id,orgnization_name)
              {
                  var opt = $('<option />');
                  opt.val(id);
                  opt.text(orgnization_name);
                  $('.organization_val').append(opt);
              });
          }
      });
    });
   


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