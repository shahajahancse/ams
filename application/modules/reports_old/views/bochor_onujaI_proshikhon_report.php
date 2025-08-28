<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"><?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
      <li><?=lang('Add New')?></li>
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
				<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0; width:90%;padding-top: 100px;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-b44r{background-color:#cbcefb;vertical-align:top;color:black}
    .tg .tg-jbrh{background-color:#c1c2ef;vertical-align:top;color:black}
    .tg .tg-yw4l{vertical-align:top;color:black}
    </style>
	       <form action="" method="post">
			   <table >
			  	<tr>
				 <td style="padding-left: 10px;"><select class="form-control input-sm" name="Year" id="Year" onchange="this.form.submit()">
				  <option value="">Select Year</option>
					<?php
					  for($i=date("Y");$i>=2010;$i--)
					  {
					  
						$selected='';
						if($i==$_POST['Year'])
						 $selected='selected="selected"';
					 echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
					  }
					?>
					
				  </select>
				     </td>
					  </tr>
				  </table>
			</form>
			
				  <br><br>
				 <?php if($_POST)
							$year=$this->input->post('Year');
							else
							   $year=date('Y');
					if($year==2017){  ?>
				  <table class="tg">
				 
				 
				    <tr>
				        <th class="tg-b44r">কোর্সের নাম</th>
						<th class="tg-jbrh">কোর্সের মেয়াদ</th>
						<th class="tg-jbrh">কোর্সের শুরুর তারিখ</th>
				    </tr>
				  	<tr>
					<?php if($course_names!=NULL) { ?>
			               <?php foreach($course_names as $row){?>
							<tr>
								<td class="tg-b44r"><?=$row['course_name']?></td>
								<td class="tg-jbrh"><?=$row['course_duration_day']?> মাস</td>
								<td class="tg-jbrh"><?=$row['prosikkhon_start_date']?></td>
								
							</tr>
							<?php } }?>
								
				  </tr>
				  
				  </table>     
				  <?php  }  else  echo "এই সম্পর্কিত কোন ডাটা পাওয়া যায় নি ";?>
			  
			  
	                            
							     
				 
           <?php /*?> <style type="text/css">
			   .t  {font-size:18px; border-spacing:20; width:90%;}
			   			   .a {font-size:18px; padding-right: 4px;}

			 </style>
             <table class="t">
              
                
                 <tr >
                <th class="">মোট ডাটার সংখ্যা :</th>
                <th class="a"><a href="https://www.w3schools.com"><?=$total_data?> জন</a> </th>
                <th class="">মোট প্রশিক্ষণার্থীর সংখ্যা :</th>
                <th class="a"><?=$total_count?> জন</th>
                 <th class="">প্রশিক্ষণ পায়নি তাদের সংখ্যা : </th>
                <th class="a"><?=$no_course?> জন</th>
       
                </tr>
              </table>
				<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0; width:90%;padding-top: 100px;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-b44r{background-color:#cbcefb;vertical-align:top;color:black}
    .tg .tg-jbrh{background-color:#c1c2ef;vertical-align:top;color:black}
    .tg .tg-yw4l{vertical-align:top;color:black}
    </style>
                <br/>
				
				 
				<?php */?>
                <?php /*?><table class="tg">
                <tr>
                <th class="tg-b44r">বুনিয়াদি প্রশিক্ষণ কোর্স : </th>
                <th class="tg-jbrh"><a href="https://www.w3schools.com"><?=$buniad_count?> জন</a> </th>
                <th class="tg-b44r">প্রশাসন আবহিত করন কোর্স : </th>
                <th class="tg-jbrh"><?=$proshason_count?> জন</th>
                </tr>
                <tr>
                <th class="tg-b44r">আইন বিধি আবহিত করন কোর্স : </th>
                <th class="tg-jbrh"><a href="https://www.w3schools.com"><?=$aien_count?> জন</a> </th>
                <th class="tg-b44r">কোর্স এর সংখ্যা : </th>
                <th class="tg-jbrh"><?=$total_course?> জন</th>
               </tr>
               
               <tr>
                <th class="tg-b44r"> Basic Computer Application & Literacy</th>
                <th class="tg-jbrh"><?=$Basic_Computer_Application_Literacy?> জন</th>
                <th class="tg-b44r">Basic Training Course</th>
                <th class="tg-jbrh"><?=$Basic_Training_Course?> জন</th>
               </tr>
               <tr>
                <th class="tg-b44r"> Computer Application & English Language</th>
                <th class="tg-jbrh"><?=$Computer_Application_English_Language?> জন</th>
                <th class="tg-b44r">Training on Disaster Control & Management</th>
                <th class="tg-jbrh"><?=$Training_on_Disaster_Control_Management?> জন</th>
               </tr>
               <tr>
                <th class="tg-b44r"> অডিট আপত্তি ও নিষ্পত্তি</th>
                <th class="tg-jbrh"><?=$audit_apotti_nispotti?> জন</th>
                <th class="tg-b44r">আইন বিধি আবহিত করন কোর্স</th>
                <th class="tg-jbrh"><?=$ayinbidi_obohito_koron?> জন</th>
               </tr>
               <tr>
                <th class="tg-b44r"> আর্থিক বিধি ব্যবস্থাপনা ও হিসাব নিরীক্ষা </th>
                <th class="tg-jbrh"><?=$bidhi_bebostapona_o_hisab_nirikha?> জন</th>
                <th class="tg-b44r">ইউনিয়ন পারিষদ ব্যবস্থাপনা</th>
                <th class="tg-jbrh"><?=$union_porisod_bebosthapona?> জন</th>
               </tr>
            
               <tr>
                <th class="tg-b44r">  উপজেলা পরিষদ আইন ও প্রশাসন রিফ্রেশার্স</th>
                <th class="tg-jbrh"><?=$u_parisod_ayn_O_prosason_refregeration?> জন</th>
                <th class="tg-b44r">উপজেলা পরিষদ বিধিমালা সমূহ আবহিতকরন</th>
                <th class="tg-jbrh"><?=$up_bidhimalasamuho_obohitokoron?> জন</th>
               </tr>
                <tr>
                <th class="tg-b44r">  নম্বি ব্যবস্থাপনা </th>
                <th class="tg-jbrh"><?=$nambi_bebosthapona?> জন</th>
                <th class="tg-b44r">পি পি আর ট্রেনিং</th>
                <th class="tg-jbrh"><?=$ppr_training?> জন</th>
               </tr>
                <tr>
                <th class="tg-b44r"> প্রশাসন আবহিত করন কোর্স</th>
                <th class="tg-jbrh"><?=$prosason_obohitokoron_course?> জন</th>
                <th class="tg-b44r">ফাউন্ডেশন ট্রেনিং</th>
                <th class="tg-jbrh"><?=$foundaion_traing?> জন</th>
               </tr>
               <tr>
                <th class="tg-b44r"> বি-৬০ তম বুনিয়াদী প্রশিক্ষণ</th>
                <th class="tg-jbrh"><?=$bi_60_tomo_bunniadi_course?> জন</th>
                <th class="tg-b44r">	বিশেষ প্রশিক্ষণ</th>
                <th class="tg-jbrh"><?=$bises_prosikhon?> জন</th>
               </tr>
                 <tr>
                <th class="tg-b44r"> বুনিয়াদি প্রশিক্ষণ কোর্স</th>
                <th class="tg-jbrh"><?=$bunadi_prosikhon_course?> জন</th>
                <th class="tg-b44r">	বিশেষ প্রশিক্ষণ</th>
                <th class="tg-jbrh"><?=$bises_prosikhon?> জন</th>
               </tr>
                 <tr>
                <th class="tg-b44r"> বি-৬০ তম বুনিয়াদী প্রশিক্ষণ</th>
                <th class="tg-jbrh"><?=$bi_60_tomo_bunniadi_course?> জন</th>
                <th class="tg-b44r">মৌল অফিস প্রশাসন</th>
                <th class="tg-jbrh"><?=$moulo_office_prosason?> জন</th>
               </tr>
                 <tr>
                <th class="tg-b44r">মৌলিক প্রশিক্ষণ</th>
                <th class="tg-jbrh"><?=$moulik_prosikhon?> জন</th>
                <th class="tg-b44r">৪র্থ এক্সিকিউটিভ ম্যাজিস্ট্রেট প্রশিক্ষণ কোর্স</th>
                <th class="tg-jbrh"><?=$tho_exicutive_megistate_prosikhon?> জন</th>
               </tr>
                <tr>
                <th class="tg-b44r">৫৫ তম বুনিয়াদি প্রশিক্ষণ কোর্স</th>
                <th class="tg-jbrh"><?=$_tomo_bunniadi_course?> জন</th>
                <th class="tg-b44r">৮১ তম আইন ও প্রশাসন কোর্স</th>
                <th class="tg-jbrh"><?=$tomo_ayn_O_prosason_course?> জন</th>
               </tr>
               
               </table>
           <?php */?>
		
			
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>