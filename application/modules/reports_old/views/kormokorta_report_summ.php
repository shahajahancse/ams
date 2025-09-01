<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"><?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
    </ul>
  
  
  
<?php /*?><form class="form-horizontal has-validation-callback" method="post" action="" onsubmit="return validatefltr()">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td width="100" align="right"><?=lang('course_name_id')?>&nbsp;&nbsp;</td>
    <td width="200">
      <select name="course_name_id" class="form-control" onchange="this.form.submit()">
        <option value=""><?=lang('select')?></option>
        <?php foreach ($course_name_id[2] as $value) {
          
            if($value['id']==$_POST['course_name_id'])
              $checkval='selected="selected"';
            else
              $checkval='';
            ?> 
          
          <option <?=$checkval?> value="<?php echo $value['id']; ?>"><?php echo $value['course_name'] ?></option>
        <?php } ?>
      </select>
      
      
    </td>
    <td>&nbsp;</td>
    <td width="100" align="right"><?=lang('prosikkhon_start_date')?>&nbsp;&nbsp;</td>
    <td width="200"><input class="form-control datetime" placeholder="<?=lang('start_date')?>" value="<?=$from_date?$from_date:''?>" name="from_date" id="from_date" type="text"></td>
    <td width="10">&nbsp;</td>
    <td width="200"><input class="form-control  datetime" placeholder="<?=lang('end_date')?>" value="<?=$t_date?$t_date:''?>" name="t_date" id="t_date" type="text"></td>
    <td width="10">&nbsp;</td>
    <td width="100"><input class="form-control btn green" value="<?=lang('filter_data')?>" name="filter" type="submit" ></td>
    <td>&nbsp;</td>
  </tr>
</table>
<div style="clear:both"></div><br />
<br />
</form><?php */?>



    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              
             </div>
             <div class="grid-body">
            <div id="infoMessage"><?php //echo $message;?></div>            
            
      
      
      <div class="form-group" style="font-size:20px"><label class="form-label" style="font-size:20px"-> কর্মকর্তা / কর্মচারীর সংখ্যাঃ </label> <?=$total_data?> জন</div>

      <div >
        <div class="col-md-12 p-t-35 p-r-20 p-b-30 col-sm-12" style="background-color: #eae5e5; margin-bottom: 20px;">
          <div class="form-group" style="font-size:20px"><label class="form-label" style="font-size:20px"->আলাদা আলাদা মোট কর্মকর্তা / কর্মচারীর সংখ্যাঃ </label></div>
            <div class="col-md-12 col-sm-12 ">
              <div class="row b-b b-grey p-b-10">
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <p class="bold small-text">ইউনিয়ন পরিষদ</p>
                  <h3 class="bold text-success"><?=$union?></h3>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <p class="bold small-text">উপজেলা পরিষদ</p>
                  <h3 class="bold text-success"><?=$upazila?></h3>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <p class="bold small-text">পৌরসভা</p>
                  <h3 class="bold text-success"><?=$zila?></h3>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <p class="bold small-text">জেলা পরিষদ</p>
                  <h3 class="bold text-success"><?=$pouroshova?></h3>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <p class="bold small-text">সিটি কর্পোরেশন</p>
                  <h3 class="bold text-success"><?=$city_corporation?></h3>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <p class="bold small-text">অন্যান্য</p>
                  <h3 class="bold text-success"><?=$other_data?></h3>
                </div>
              </div>

              <!-- <div class="row m-t-15">
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <p class="text-black">245</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <p class="text-black">245</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <p class="text-black">245</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <p class="text-black">245</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <p class="text-black">245</p>
                </div>
              </div>
 -->
            </div>

          </div>
      </div>
	  
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0; width:90%}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-b44r{background-color:#cbcefb;vertical-align:top;color:black}
.tg .tg-jbrh{background-color:#c1c2ef;vertical-align:top;color:black}
.tg .tg-yw4l{vertical-align:top;color:black}
</style>
<table class="tg">
  <tr>
    <th class="tg-b44r">চেয়ারম্যানের সংখ্যাঃ </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=1&search=খুজুন"><?=$total_charman?> জন</a> </th>
    <th class="tg-b44r">মেয়র সংখ্যাঃ</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=6&search=খুজুন"><?=$total_mayor?> জন</a></th>
  </tr>
  <tr>
    <th class="tg-b44r">সদস্য সাধারন সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=2&search=খুজুন"><?=$total_member_normal?> জন</a></th>
    <th class="tg-b44r">ভাইস চেয়ারম্যান সাধারন সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=4&search=খুজুন"><?=$vice_charirman?> জন</a></th>
  </tr>
  <tr>
    <th class="tg-b44r"> অফিস সহকারী সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=18&search=খুজুন"><?=$office_sohokari?> জন</a></th>
    <th class="tg-b44r">অফিস সহকারী কাম কম্পিউটার মুদ্রাক্ষরিক সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=27&search=খুজুন"><?=$com_mudrakhorik?> জন</a></th>
  </tr>
  <tr>
    <th class="tg-b44r"> ইউনিয়ন সমাজকর্মী সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=12&search=খুজুন"><?=$union_somajkormi?> জন</a></th>
    <th class="tg-b44r">উপ-সহকারী প্রকৌশলী সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=17&search=খুজুন"><?=$upo_sohokari_prokusoli?> জন</a></th>
  </tr>
   <tr>
    <th class="tg-b44r"> উপজেলা একাডেমিক সুপারভাইজার সংখ্যা  :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=46&search=খুজুন"><?=$upzela_ekhademic_super?> জন</a></th>
    <th class="tg-b44r">উপজেলা একাডেমিক সুপার সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=31&search=খুজুন"><?=$upzela_ekhademic_supervisor?> জন</a></th>
  </tr>
  </tr>
   <tr>
    <th class="tg-b44r"> উপজেলা নির্বাহী অফিসার সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=33&search=খুজুন"><?=$upzela_nirbahi_officer?> জন</a></th>
    <th class="tg-b44r">উপজেলা পরিবার পরিকল্পনা সহকারী সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=29&search=খুজুন"><?=$upzela_poriber_porikolpona_sohokari?> জন</a></th>
  </tr>
  <tr>
    <th class="tg-b44r"> উপজেলা পল্লী উন্নয়ন অফিসার সংখ্যা :  </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=37&search=খুজুন"><?=$upzela_polli_unnoyon?> জন</a></th>
    <th class="tg-b44r">উপজেলা প্রকল্প বাস্তবায়ন কর্মকর্তা সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=20&search=খুজুন"><?=$ten?> জন</a></th>
  </tr>
    <tr>
    <th class="tg-b44r"> উপজেলা মহিলা বিষয়ক কর্মকর্তা সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=24&search=খুজুন"><?=$eleven?> জন</a></th>
    <th class="tg-b44r">উপজেলা মাধ্যমিক শিক্ষা অফিসার সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=30&search=খুজুন"><?=$twelve?> জন</a></th>
  </tr>
  
  </tr>
    <tr>
    <th class="tg-b44r"> উপজেলা মৎস্য কর্মকর্তা সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=42&search=খুজুন"><?=$tharteen?> জন</a></th>
    <th class="tg-b44r">উপজেলা যুব উন্নয়ন কর্মকর্তা সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=25&search=খুজুন"><?=$fourteen?> জন</a></th>
  </tr>
   </tr>
    <tr>
    <th class="tg-b44r"> এম. এল. এস. এস. সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=21&search=খুজুন"><?=$fiften?> জন</a></th>
    <th class="tg-b44r">এস এ ই : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=51&search=খুজুন"><?=$sixten?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r">  কমিউনিটি অর্গনাইজার সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=45&search=খুজুন"><?=$seventeen?> জন</a></th>
    <th class="tg-b44r">কর্মচারী সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=10&search=খুজুন"><?=$eighteen?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r"> কাউন্সিলর সংরক্ষিত সংখ্যা :  </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=8&search=খুজুন"><?=$nineteen?> জন</a></th>
    <th class="tg-b44r">কাউন্সিলর সাধারন সংখ্যা  : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=7&search=খুজুন"><?=$twenty?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r"> কারিগরী প্রশিক্ষকা সংখ্যা :  </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=14&search=খুজুন"><?=$twentyone?> জন</a></th>
    <th class="tg-b44r">ক্রেডিট সুপারভাইজার সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=26&search=খুজুন"><?=$twentytwo?> জন</a></th>
  </tr>
   
    </tr>
    <tr>
    <th class="tg-b44r"> চেয়ারম্যানের সংখ্যাঃ  </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=1&search=খুজুন"><?=$twentythree?> জন</a></th>
    <th class="tg-b44r">জেলা অডিটর সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=48&search=খুজুন"><?=$twentyfour?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r">  থানা প্রকল্প কর্মকর্তা সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=28&search=খুজুন"><?=$twentyfive?> জন</a></th>
    <th class="tg-b44r">নলকূপ মেকানিক সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=22&search=খুজুন"><?=$twentysix?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r"> নিম্নমান সহকারী কাম মুদ্রাক্ষরিক সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=44&search=খুজুন"><?=$twentyseven?> জন</a></th>
    <th class="tg-b44r">নিরাপত্তা প্রহরী সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=11&search=খুজুন"><?=$twentyeight?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r"> নৈশ প্রহরী সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=15&search=খুজুন"><?=$twentynine?> জন</a></th>
    <th class="tg-b44r">পরিদর্শক সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=47&search=খুজুন"><?=$tharty?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r"> পরিবার কল্যাণ সহকারী সংখ্যা : </th>
    <th class="tg-jbrh"> <a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=34&search=খুজুন"><?=$thartyone?> জন</a></th>
    <th class="tg-b44r">পৈর সমাজকর্মী সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=13&search=খুজুন"><?=$thartytwo?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r"> ফিশার ম্যান সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=43&search=খুজুন"><?=$thartythree?> জন</a></th>
    <th class="tg-b44r">ভাইস চেয়ারম্যান সংরক্ষিত সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=5&search=খুজুন"><?=$thartyfour?> জন</a></th>
  </tr>
    </tr>
    <tr>
    <th class="tg-b44r"> ভাইস চেয়ারম্যান সাধারন সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=4&search=খুজুন"><?=$thartyfive?> জন</a></th>
    <th class="tg-b44r">মেয়র সংখ্যা :</th>
    <th class="tg-jbrh"> <a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=6&search=খুজুন"><?=$thartysix?> জন</a></th>
  </tr>
    </tr>
    <tr>
    <th class="tg-b44r"> ম্যাকানিক সংখ্যা :  </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=50&search=খুজুন"><?=$thartyseven?> জন</a></th>
    <th class="tg-b44r">সচিব সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=9&search=খুজুন"><?=$thartyeight?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r"> সদস্য সংরক্ষিত সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=3&search=খুজুন"><?=$thartynine?> জন</a></th>
    <th class="tg-b44r">সহকারী কমিশনার ও নির্বাহী ম্যাজিস্ট্রেট সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=32&search=খুজুন"><?=$fourtyone?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r">সহকারী পরিদর্শক সংখ্যা :   </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=49&search=খুজুন">0 জন</a></th>
    <th class="tg-b44r">সহকারী পল্লী উন্নয়ন অফিসার সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=40&search=খুজুন"><?=$fourtythree?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r"> সহকারী প্রকৌশলী সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=16&search=খুজুন"><?=$fourtyfour?> জন</a></th>
    <th class="tg-b44r">সহকারী প্রকৌশলী কাম মুদ্রাক্ষরিক সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=41&search=খুজুন"><?=$fourtyfive?> জন</a></th>
  </tr>
  </tr>
    <tr>
    <th class="tg-b44r">  সহকারী সনবায় অফিসার সংখ্যা :</th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=23&search=খুজুন"><?=$fourtysix?> জন</a></th>
    <th class="tg-b44r">সার্ভেয়ার সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=19&search=খুজুন"><?=$fourtyseven?> জন</a></th>
  </tr>
   </tr>
    <tr>
    <th class="tg-b44r"> সিনিয়র সহকারি কমিশনার সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=35&search=খুজুন"><?=$fourtyeight?> জন</a></th>
    <th class="tg-b44r">হিসাব রক্ষক সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=36&search=খুজুন"><?=$fourtynine?> জন</a></th>
  </tr>
   </tr>
    <tr>
    <th class="tg-b44r"> হিসাব সহকারী সংখ্যা : </th>
    <th class="tg-jbrh"><a href="<?=base_url()?>personal_datas/kormokorta_report?national_id=&district=&upazila_thana=&designation=39&search=খুজুন"><?=$fifty?> জন</a></th>
    <th class="tg-b44r"></th>
    <th class="tg-jbrh"></th>
  </tr>
  
</table>
		   
		   
		   
		  
		 
		   
		 

     
      
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>