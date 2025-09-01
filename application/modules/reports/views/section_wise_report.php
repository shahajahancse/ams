<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>    
    <div class="clearfix"></div>

    <div class="content">
      <div class="page-title"> </div>
      <!-- BEGIN DASHBOARD TILES -->
        <div class="row">  

        

        </div>
        <!-- END DASHBOARD TILES -->
  <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb; width: 100%}
                .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB; text-align: center;}
                .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
                .tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top}
                .tg .tg-yw4l{vertical-align:middle; text-align: right; font-weight: bold;}
                </style>
        <div class="row">
          <div class="col-md-12" style="padding-bottom: 10px;">
            <h3 style="text-align: center; font-weight: bold; "> সেকসন অনুযায়ী স্কাউট সদস্য পরিসংখ্যান(কাব স্কাউট)</h3>
             
                <table class="tg">
                  <tr>
                    <th class="tg-yw4l" rowspan="2" width="300" style="text-align: center;">শাখা</th>
                    <th class="tg-yw4l"  style="text-align: center;">পুরুষ</th>
                    <th class="tg-yw4l"  style="text-align: center;">মহিলা</th>
                    <th class="tg-yw4l" style="text-align: center;">অন্যান্য</th>
                    <th class="tg-yw4l" style="text-align: center;">মোট</th>
                    <th class="tg-yw4l" style="text-align: center;">Growth</th>
                  </tr>
                  <tr>
                    
                  </tr>
                  <?php foreach ($count_cub_scout_section_wise as $key => $value) { 
                    if($value->badge_type_name_bn!='') {?>
                   
              
                  <tr>
                    <th class="tg-yw4l"  style="text-align: center;"><?php echo $value->badge_type_name_bn;?></th>
                    <th class="tg-rmb8"  style="text-align: center;"> <?php  echo $value->count_male;?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php  echo $value->count_female;?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo $value->count_other?></th>
                     <th class="tg-rmb8"  style="text-align: center;"><?php echo $value->count_total?></th>

                      
                     <?php  foreach ($count_member_cub_scout_year_wise_groupby_section_wise as $key => $v) { 
                      if($value->badge_type_name_bn==$v->badge_type_name_bn){ ?>

                        <th class="tg-rmb8"  style="text-align: center;"> <?php 
                         $sub=$v->count_now- $v->count_prev;
                         if($v->count_prev!=0){
                            $growth=($sub/$v->count_prev)*100; echo $growth.'%';
                          }
                          else {
                            $in=$v->count_now*100;
                            echo  $in.'%'; }?></th>
                    
                    <?php } } ?>

                  </tr>
                  
                  <?php } } ?>
                 
                  
                  
                </table><br><br>
          </div>
     
          <div class="col-md-12" style="padding-bottom: 10px;">
            <h3 style="text-align: center; font-weight: bold; "> সেকসন অনুযায়ী স্কাউট সদস্য পরিসংখ্যান(স্কাউট)</h3>
             
                <table class="tg">
                  <tr>
                    <th class="tg-yw4l" rowspan="2" width="300" style="text-align: center;">শাখা</th>
                    <th class="tg-yw4l"  style="text-align: center;">পুরুষ</th>
                    <th class="tg-yw4l"  style="text-align: center;">মহিলা</th>
                    <th class="tg-yw4l" style="text-align: center;">অন্যান্য</th>
                    <th class="tg-yw4l" style="text-align: center;">মোট</th>
                    <th class="tg-yw4l" style="text-align: center;">Growth</th>
                  </tr>
                  <tr>
                    
                  </tr>
                  <?php foreach ($count_scout_section_wise as $key => $value) {  
                    if($value->badge_type_name_bn!='') {?>
                   
                  
                  <tr>
                    <th class="tg-yw4l"  style="text-align: center;"><?php echo $value->badge_type_name_bn;?></th>
                    <th class="tg-rmb8"  style="text-align: center;"> <?php  echo $value->count_male;?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo $value->count_female?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo $value->count_other?></th>
                     <?php  foreach ($count_member_scout_year_wise_groupby_section_wise as $key => $v) { 
                      if($value->badge_type_name_bn==$v->badge_type_name_bn){ ?>

                        <th class="tg-rmb8"  style="text-align: center;"> <?php 
                         $sub=$v->count_now- $v->count_prev;
                         if($v->count_prev!=0){
                            $growth=($sub/$v->count_prev)*100; echo $growth.'%';
                          }
                          else {
                            $in=$v->count_now*100;
                            echo  $in.'%'; }?></th>
                    
                    <?php } } ?>

                  </tr>
                  
                  <?php } }?>
                 
                  
                  
                </table><br><br>
          </div>
           
           <div class="col-md-12" style="padding-bottom: 10px;">
            <h3 style="text-align: center; font-weight: bold; "> সেকসন অনুযায়ী স্কাউট সদস্য পরিসংখ্যান(রোভার স্কাউট)</h3>
             
                <table class="tg">
                  <tr>
                    <th class="tg-yw4l" rowspan="2" width="300" style="text-align: center;">শাখা</th>
                    <th class="tg-yw4l"  style="text-align: center;">পুরুষ</th>
                    <th class="tg-yw4l"  style="text-align: center;">মহিলা</th>
                    <th class="tg-yw4l" style="text-align: center;">অন্যান্য</th>
                    <th class="tg-yw4l" style="text-align: center;">মোট</th>
                    <th class="tg-yw4l" style="text-align: center;">Growth</th>
                  </tr>
                  <tr>
                    
                  </tr>
                  <?php foreach ($count_rover_scout_section_wise as $key => $value) {
                     if($value->badge_type_name_bn!='') { ?>
                   
                  <tr>
                    <th class="tg-yw4l"  style="text-align: center;"><?php echo $value->badge_type_name_bn;?></th>
                    <th class="tg-rmb8"  style="text-align: center;"> <?php  echo $value->count_male;?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo $value->count_female?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo $value->count_other?></th>
                     <?php  foreach ($count_member_rover_scout_year_wise_groupby_section_wise as $key => $v) { 
                      if($value->badge_type_name_bn==$v->badge_type_name_bn){ ?>

                        <th class="tg-rmb8"  style="text-align: center;"> <?php 
                         $sub=$v->count_now- $v->count_prev;
                         if($v->count_prev!=0){
                            $growth=($sub/$v->count_prev)*100; echo $growth.'%';
                          }
                          else {
                            $in=$v->count_now*100;
                            echo  $in.'%'; }?></th>
                    
                    <?php } } ?>

                  </tr>
                  
                  <?php } }?>
                 
                  
                  
                </table><br><br>
          </div>
          <div class="col-md-12" style="padding-bottom: 10px;">
            <h3 style="text-align: center; font-weight: bold; "> সেকসন অনুযায়ী স্কাউট সদস্য পরিসংখ্যান(Adult Leader)</h3>
             
                <table class="tg">
                  <tr>
                    <th class="tg-yw4l" rowspan="2" width="300" style="text-align: center;">শাখা</th>
                    <th class="tg-yw4l"  style="text-align: center;">পুরুষ</th>
                    <th class="tg-yw4l"  style="text-align: center;">মহিলা</th>
                    <th class="tg-yw4l" style="text-align: center;">অন্যান্য</th>
                    <th class="tg-yw4l" style="text-align: center;">মোট</th>
                    <th class="tg-yw4l" style="text-align: center;">Growth</th>
                  </tr>
                  <tr>
                    
                  </tr>
                  <?php foreach ($count_rover_scout_section_wise as $key => $value) {
                     if($value->badge_type_name_bn!='') { ?>
                   
                  <tr>
                    <th class="tg-yw4l"  style="text-align: center;"><?php echo $value->badge_type_name_bn;?></th>
                    <th class="tg-rmb8"  style="text-align: center;"> <?php  echo $value->count_male;?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo $value->count_female?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo $value->count_other?></th>
                     <th class="tg-rmb8"  style="text-align: center;"><?php echo $value->count_total?></th>
                  </tr>
                  
                  <?php } }?>
                 
                  
                  
                </table><br><br>
          </div>
        </div>
     
    </div>
  </div>