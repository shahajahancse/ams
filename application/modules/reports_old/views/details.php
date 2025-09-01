<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> <?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
      <li><?=lang('Add New')?></li>
    </ul>

    <div class="row">
        <div class="col-md-12">
          <div class="grid simple horizontal">
            <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">      
                <a href="<?=base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3))?>" class="btn btn-primary btn-xs btn-mini" onclick="printDiv('printableArea')"> প্রিন্ট করুণ </a>
                <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="btn btn-primary btn-xs btn-mini"> <?php echo lang($this->uri->segment(1).'_list');?></a>
              </div>
             </div>
            <div class="grid-body" id="printableArea">
              <div class="row">
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;font-family: 'Kalpurush', Arial, sans-serif;}
.tg td{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;padding:8px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB; vertical-align: middle;}
.tg th{font-family: 'Kalpurush', Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-ywa9{background-color:#ffffff;color:#ffffff;vertical-align:top; width: 300px;color: black;font-weight: bold;}
.tg .tg-khup{background-color:#efefef;color:#ffffff;vertical-align:top; width: 200px; color: black; text-align: right;}
.tg .tg-akf0{background-color:#ffffff;color:#ffffff;vertical-align:top;color: black;}
.tg .tg-mtwr{background-color:#cee8ce;vertical-align:top; font-weight: bold; text-align: center; font-size: 16px;}
</style>                
<?php 
  if($info->data_sheet_type == 1){
    $sheet_type = 'জনপ্রতিনিধি';
  }else{
    $sheet_type = 'কর্মকর্তা/কর্মচারী';
  }

?>
                <div class="col-md-12">
                  <table class="tg" width="100%">
                    <tr>
                      <th class="tg-akf0" colspan="4" style="text-align: center;">
                        <h3 style="font-weight: bold;">জাতীয় স্থানীয় সরকার ইসস্টিটিউট</h3>
                        <span style="color: black;" > (এনআইএলজি) </span> <br>
                        <span style="color: black;">২৯, আগারগাঁও, শেরে বাংলা নগর</span> <br>
                        <span style="color: black;">ঢাকা - ১২০৭</span>
                        <h4 style="font-weight: bold;">বাক্তিগত ডাটা সীট (<?=$sheet_type?>)</h4>
                        <?php //echo $info[0]->id; ?>
                      </th>
                    </tr>
                    <tr><td class="tg-mtwr" colspan="4"> প্রাথমিক তথ্য </td></tr>
                    <tr>
                      <td class="tg-khup">নামঃ বাংলা</td>
                      <td class="tg-ywa9"><?=$info->name_bangla?></td>
                      <td class="tg-khup">জাতীয় পরিচয়পত্র নম্বর</td>
                      <td class="tg-ywa9"><?=$info->national_id?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">নামঃ ইংরেজি</td>
                      <td class="tg-ywa9"><?=$info->name_english?></td>
                      <td class="tg-khup">টেলিফোন / মোবাইল নম্বর</td>
                      <td class="tg-ywa9"><?=$info->telephone_mobile?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">পিতা / স্বামীর নাম</td>
                      <td class="tg-ywa9"><?=$info->father_name?></td>
                      <td class="tg-khup">ই-মেইল</td>
                      <td class="tg-ywa9"><?=$info->email?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">মাতার নাম</td>
                      <td class="tg-ywa9"><?=$info->mother_name?></td>
                      <td class="tg-khup">জেলা</td>
                      <td class="tg-ywa9"><?php echo $info->dis_name_bn?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">লিঙ্গ</td>
                      <td class="tg-ywa9"><?=$info->gender?></td>
                      <td class="tg-khup">উপজেলা / থানা</td>
                      <td class="tg-ywa9"><?=$info->upa_name_bn?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">জম্ম তারিখ</td>
                      <td class="tg-ywa9"><?=date('d F, Y', strtotime($info->date_of_birth));?></td>
                      <td class="tg-khup">স্থায়ী ঠিকানা</td>
                      <td class="tg-ywa9"><?=$info->permanent_add?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">বৈবাহিক অবস্থা</td>
                      <td class="tg-ywa9"><?=$info->marital_status_name?></td>
                      <td class="tg-khup">বর্তমান ঠিকানা</td>
                      <td class="tg-ywa9"><?=$info->present_add?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">ছেলে / মেয়ের সংখ্যা</td>
                      <td class="tg-ywa9">ছেলেঃ <?=$info->son_number?> মেয়েঃ <?=$info->daughter_number?></td>
                      <td class="tg-khup"></td>
                      <td class="tg-ywa9"></td>
                    </tr>

                    <tr><td class="tg-mtwr" colspan="4"> প্রতিষ্ঠানের তথ্য </td></tr>

                    <tr>
                      <td class="tg-khup">প্রথম নির্বাচিত / চাকুরীতে যোগদানকৃত প্রতিষ্ঠানের নাম</td>
                      <td class="tg-ywa9"><?=$info->first_org_name?></td>
                      <td class="tg-khup">বর্তমান নির্বাচিত / চাকুরীতে যোগদানকৃত প্রতিষ্ঠানের নাম</td>
                      <td class="tg-ywa9"><?=$info->current_org_name?></td>
                    </tr>

                    <tr>
                      <td class="tg-khup">প্রথম নির্বাচিত / চাকুরীতে যোগদানকৃত পদের নাম</td>
                      <td class="tg-ywa9"><?php echo $info->first_desig_name?></td>
                      <td class="tg-khup">বর্তমান নির্বাচিত / চাকুরীতে দায়িত্বপ্রাপ্ত পদের নাম</td>
                      <td class="tg-ywa9"><?php echo $info->current_desig_name?></td>
                    </tr>

                    <tr>
                      <td class="tg-khup">প্রথম সভা / যোগদানের তারিখ</td>
                      <td class="tg-ywa9"><?=date('d F, Y', strtotime($info->first_attend_date))?></td>
                      <td class="tg-khup">বর্তমান দায়িত্বপ্রাপ্ত পদে যোগদানের তারিখ</td>
                      <td class="tg-ywa9"><?=date('d F, Y', strtotime($info->curr_attend_date))?></td>
                    </tr>
                  <?php if($info->data_sheet_type == 1){ ?>
                    <tr>
                      <td class="tg-khup">এ যাবত কতবার নির্বাচিত হয়েছেন?</td>
                      <td class="tg-ywa9"><?=$info->how_much_elected?></td>
                      <td class="tg-khup"></td>
                      <td class="tg-ywa9"></td>
                    </tr>
                  <?php }else{ ?>
                    <tr>
                      <td class="tg-khup">চাকুরী স্থায়ী করনের তারিখ</td>
                      <td class="tg-ywa9"><?=date('d F, Y', strtotime($info->job_per_date))?></td>
                      <td class="tg-khup">অবসর উত্তর ছুটিতে গমনের (পিআরএল) তারিখ</td>
                      <td class="tg-ywa9"><?=date('d F, Y', strtotime($info->retirement_prl_date))?></td>
                    </tr>
                    <tr>
                      <td class="tg-khup">অবসর গ্রহণের তারিখ</td>
                      <td class="tg-ywa9"><?=date('d F, Y', strtotime($info->retirement_date))?></td>
                      <td class="tg-khup"></td>
                      <td class="tg-ywa9"></td>
                    </tr>
                  <?php } ?>

                    <?php if($info->data_sheet_type == 1){ ?>
                    <tr>
                      <td class="tg-khup">ইতিপূর্ব নির্বাচনের বিবরণ</td>
                      <td class="tg-ywa9" colspan="3">
                        <?php if($experience != NULL){ ?>
                        <table style="border-collapse:collapse; border:1px solid #ccc;">
                          <tr> <th>প্রতিষ্ঠানের নাম</th> <th>পদের নাম</th> <th>মেয়াদকাল</th> </tr>
                          <?php foreach ($experience as $exp) { ?>
                          <tr> <td><?=$exp->exp_org_name;?></td> <td><?=$exp->exp_desig_name;?></td> <td><?=$exp->exp_duration;?></td> </tr>
                          <?php } ?>
                        </table>
                        <?php } ?>
                      </td>
                    </tr> 
                    <?php }else{ ?>
                    <tr>
                      <td class="tg-khup">ইতিপূর্বে যেসব কর্মস্থলে চাকুরী করেছেন তার বিবরণ</td>
                      <td class="tg-ywa9" colspan="3">
                        <?php if($experience != NULL){ ?>
                        <table>
                          <tr> 
                            <td>প্রতিষ্ঠানের নাম</td> <td>পদের নাম</td> <td>মেয়াদকাল</td> </tr>
                          <?php foreach ($experience as $exp) { ?>
                          <tr > <td><?=$exp->exp_org_name;?></td> <td><?=$exp->exp_desig_name;?></td> <td><?=$exp->exp_duration;?></td> </tr>
                          <?php } ?>
                        </table>
                        <?php } ?>
                      </td>
                    </tr> 
                    <tr>
                      <td class="tg-khup">পদোন্নতি সংক্রান্ত তথ্যাদি</td>
                      <td class="tg-ywa9" colspan="3">
                        <?php if($promotion != NULL){ ?>
                        <table>
                          <tr> 
                            <td>পদোন্নতি প্রাপ্ত পদবী</td> <td>প্রতিষ্ঠানের নাম</td> <td>বেতনক্রম</td> <td> মন্তব্য</td> </tr>
                          <?php foreach ($promotion as $exp) { ?>
                          <tr > <td><?=$exp->pro_desig_name;?></td> <td><?=$exp->pro_org_name;?></td> <td><?=$exp->promo_salary_ratio;?></td> <td><?=$exp->promo_comments;?></td></tr>
                          <?php } ?>
                        </table>
                        <?php } ?>
                      </td>
                    </tr> 
                    <?php } ?>

                    <tr><td class="tg-mtwr" colspan="4"> শিক্ষাগত যোগ্যতা  </td></tr>
                    <tr>
                      <td class="tg-ywa9" colspan="4">
                        <?php if($education != NULL){ ?>
                        <table width="100%">
                          <tr> 
                            <td>পরিক্ষার নাম</td> 
                            <td>পাশের সন</td>
                            <td>বিষয়</td>
                            <td>বোর্ড / বিশ্ববিদ্যালয়</td>
                          </tr>
                          <?php foreach ($education as $row) { ?>
                              <tr> 
                                <td><?php echo $row->exam_name;?></td> 
                                <td><?php echo $row->edu_pass_year;?></td> 
                                <td><?php echo $row->sub_name;?></td> 
                                <td><?php echo $row->board_name;?></td> 
                              </tr>
                          <?php } ?>
                        </table>
                        <?php } ?>
                      </td>
                    </tr> 

                    <tr><td class="tg-mtwr" colspan="4"> এনআইএলজি থেকে প্রাপ্ত প্রশিক্ষ্ণ </td></tr>
                    <tr>
                      <td class="tg-ywa9" colspan="4">
                        <?php if($nilg_training != NULL){ ?>
                        <table width="100%">
                          <tr> 
                            <td>প্রশিক্ষ্ণে অংশগ্রহণকালিন সময়ে পদবী</td> 
                            <td>কোর্সের নাম</td>
                            <td>সময়কাল</td>
                            <td>মেয়াদ</td>
                          </tr>
                          <?php foreach ($nilg_training as $row) { ?>
                              <tr> 
                                <td><?php echo $row->nilg_training_desig_name;?></td> 
                                <td><?php echo $row->course_name;?></td> 
                                <td><?php echo $row->nilg_time_duration;?></td> 
                                <td><?php echo $row->nilg_duration;?></td> 
                              </tr>
                          <?php } ?>
                        </table>
                        <?php } ?>
                      </td>
                    </tr> 

                    <tr><td class="tg-mtwr" colspan="4"> দেশে অন্যান্য প্রতিষ্ঠান থেকে প্রাপ্ত প্রশিক্ষ্ণ </td></tr>
                    <tr>
                      <td class="tg-ywa9" colspan="4">
                        <?php if($local_training != NULL){ ?>
                        <table width="100%">
                          <tr> 
                            <td>কোর্সের নাম</td>
                            <td>প্রশিক্ষ্ণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td> 
                            <td>সময়কাল</td>
                            <td>মেয়াদ</td>
                          </tr>
                          <?php foreach ($local_training as $row) { ?>
                              <tr> 
                                <td><?php echo $row->local_course_name;?></td> 
                                <td><?php echo $row->local_training_org_name_adds;?></td> 
                                <td><?php echo $row->local_time_duration;?></td> 
                                <td><?php echo $row->local_duration;?></td> 
                              </tr>
                          <?php } ?>
                        </table>
                        <?php } ?>
                      </td>
                    </tr> 

                    <tr><td class="tg-mtwr" colspan="4"> বিদেশ থেকে প্রাপ্ত প্রশিক্ষ্ণ </td></tr>
                    <tr>
                      <td class="tg-ywa9" colspan="4">
                        <?php if($foreign_training != NULL){ ?>
                        <table width="100%">
                          <tr> 
                            <td>কোর্সের নাম</td>
                            <td>প্রশিক্ষ্ণ প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td> 
                            <td>সময়কাল</td>
                            <td>মেয়াদ</td>
                          </tr>
                          <?php foreach ($foreign_training as $row) { ?>
                              <tr> 
                                <td><?php echo $row->foreign_course_name;?></td> 
                                <td><?php echo $row->foreign_training_org_name_adds;?></td> 
                                <td><?php echo $row->foreign_time_duration;?></td> 
                                <td><?php echo $row->foreign_duration;?></td> 
                              </tr>
                          <?php } ?>
                        </table>
                        <?php } ?>
                      </td>
                    </tr> 
                  </table>


                </div>          

              </div>
            </div>
          </div>
        </div>

    </div>


  </div>
</div>