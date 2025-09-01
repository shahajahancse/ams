<!DOCTYPE html>
<html>
<head>
  <title>স্কাউট সদস্য পরিসংখ্যান</title> 
  <meta charset="utf-8">
  <link href="<?=base_url();?>awedget/assets/css/bangla.css" rel="stylesheet" type="text/css"/>
  <style type="text/css">

table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  color: black;

}
</style>
</head>

<body style=" font-family: nikosh !important;" >

<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>  -->   
    <div class="clearfix"></div>

    <div class="content">
      <div class="page-title"> </div>
      <!-- BEGIN DASHBOARD TILES -->
        <div class="row">  

        <style type="text/css">

table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  color: black;

}

</style>
<div class="page-content">     
     <div style="text-align: center;">
         <div  style="font-size: 20px;">BANGLADESH SCOUTS</div>
         <span>www.scouts.gov.bd</span>
      </div>
      <div class="row-fluid">
              <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
            </div>

        </div>
        <!-- END DASHBOARD TILES -->

        <div class="row">
          
          <div class="col-md-12">
            <h2 style="text-align: center; font-weight: bold; "> স্কাউট সদস্য পরিসংখ্যান</h2>

              <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
                .tg td{sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;color:#594F4F; text-align: center;}
                .tg th{ sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;color:#493F3F;}
                .tg .tg-rmb8{vertical-align:top}
                .tg .tg-yw4l{vertical-align:middle; text-align: right; font-weight: bold;}
                </style>
                <table class="tg">
                  <tr>
                    <th class="tg-yw4l" width="300" style="text-align: center;">শাখা</th>
                    <th class="tg-yw4l"  style="text-align: center;">পুরুষ</th>
                    <th class="tg-yw4l"  style="text-align: center;">মহিলা</th>
                    <th class="tg-yw4l" style="text-align: center;">অন্যান্য</th>
                    <th class="tg-yw4l" style="text-align: center;">মোট</th>
                  </tr>
                  <tr>
                    
                  </tr>
                  <tr>
                    <th class="tg-yw4l"  style="text-align: center;">কাব স্কাউট </th>
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_cub_scout_m);?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_cub_scout_f)?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_cub_scout_o);?></th>
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_cub_scout_m+$count_cub_scout_f+$count_cub_scout_o);?></th>
                    
                  </tr>
                  <tr>
                    <th class="tg-yw4l"  style="text-align: center;">স্কাউট </th>
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_scout_m);?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_scout_f);?></th>
                   
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_scout_o); ?></th>
                     <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_scout_m+$count_scout_f+$count_scout_o); ?></th>
                   
                  </tr>
                  <tr>
                    <th class="tg-yw4l"  style="text-align: center;">রোভার স্কাউট </th>
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_rober_scout_m);?></th>
                 
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_rober_scout_f);?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php  echo BanglaConverter::en2bn($count_rober_scout_o);?></th>

                     <th class="tg-rmb8"  style="text-align: center;"><?php  echo BanglaConverter::en2bn($count_rober_scout_m+$count_rober_scout_f+$count_rober_scout_o);?></th>
                   
                  </tr>
                 
                  
                  <tr>
                    <th class="tg-yw4l"  style="text-align: center;"> কাব স্কাউট লিডার সদস্য সংখ্যা</th>
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_cub_scout_leader_m);?></th>
                 
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_cub_scout_leader_f);?></th>
                  
                    <th class="tg-rmb8"  style="text-align: center;">
                      <?php 
                         echo BanglaConverter::en2bn($count_cub_scout_leader_o);
                        ?>
                        
                    </th>
                    <th class="tg-rmb8"  style="text-align: center;">
                      <?php 
                         echo BanglaConverter::en2bn($count_cub_scout_leader_m+$count_cub_scout_leader_f+$count_cub_scout_leader_o);
                        ?>
                        
                    </th>
                    
                  </tr>
                  <tr>
                    <th class="tg-yw4l"  style="text-align: center;"> স্কাউট লিডার সদস্য সংখ্যা</th>
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_scout_leader_m);?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_scout_leader_f);?></th>
                  
                    <th class="tg-rmb8"  style="text-align: center;">
                      <?php 
                         echo BanglaConverter::en2bn($count_scout_leader_o);
                      ?>
                        
                    </th>
                    <th class="tg-rmb8"  style="text-align: center;">
                      <?php 
                         echo BanglaConverter::en2bn($count_scout_leader_m+$count_scout_leader_f+$count_scout_leader_o);
                      ?>
                        
                    </th>
                    
                  </tr>
                 
                  <tr>
                    <th class="tg-yw4l"  style="text-align: center;">রোভার স্কাউট লিডার সদস্য সংখ্যা</th>
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_scout_leader_m);?></th>
                    
                    <th class="tg-rmb8"  style="text-align: center;"><?php echo BanglaConverter::en2bn($count_scout_leader_f);?></th>
                  
                    <th class="tg-rmb8"  style="text-align: center;">
                      <?php 
                       echo BanglaConverter::en2bn($count_rober_scout_leader_o);  
                      ?>
                        
                    </th>
                    <th class="tg-rmb8"  style="text-align: center;">
                      <?php 
                       echo BanglaConverter::en2bn($count_scout_leader_m+$count_scout_leader_f+$count_rober_scout_leader_o);  
                      ?>
                        
                    </th>
                    
                  </tr>
                  
                </table>
          </div>
        </div>
     
    </div>
  </div>
  </body>
</html>