<!DOCTYPE html>
<html>
<head>
  <title>স্কাউট ইউনিট রিপোর্ট</title> 
  <meta charset="utf-8">
  <link href="<?=base_url();?>awedget/assets/css/bangla.css" rel="stylesheet" type="text/css"/>
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

        

        </div>
        <!-- END DASHBOARD TILES -->
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
        <div class="row">

        <div style="text-align: center;">
        <div  style="font-size: 20px;">BANGLADESH SCOUTS</div>
        <span>www.scouts.gov.bd</span>
        </div>

        <h4 align="center"><span class="semi-bold">All Upazila/Thana Scouts Office</span></h4>
        <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>     
          <div class="col-md-12" style="padding-bottom: 10px;">
            <h2 style="text-align: center; font-weight: bold; "> স্কাউট ইউনিট রিপোর্ট </h2>
             
                <table class="tg" style="font-family: nikosh !important;">
                  <tr>
                    <th class="tg-yw4l" width="300" style="text-align: center;">শাখা</th>
                    
                    <th class="tg-yw4l" style="font-family: Nikosh !important; text-align: center;">মোট</th>
                    <th class="tg-yw4l" style="text-align: center;">Growth</th>
                  </tr>
                  <tr>
                    
                  </tr>
                  <?php foreach ($unit_type as $key => $value) { 
                    foreach ($count_unit_type_wise as $ke => $val) { 
                      if($val->unit_type==$key){
                   ?>
                   
              
                  <tr>

                    <th class="tg-yw4l"  style="font-family: Nikosh !important; text-align: center;"><?php echo $value;?></th>
                     <th class="tg-rmb8"  style="text-align: center;"> <?php  echo BanglaConverter::en2bn($val->count_total);?></th>


                    <?php  foreach ($count_unit_year_wise_type_wise as $key => $v) { 
                      if($v->unit_type== $val->unit_type){ ?>

                        <th class="tg-rmb8"  style="text-align: center;"> <?php 
                         $sub=$v->count_now- $v->count_prev;
                         if($v->count_prev!=0){
                            $growth=($sub/$v->count_prev)*100; echo BanglaConverter::en2bn($growth).'%';
                          }
                          else {
                            $in=$v->count_now*100;
                            echo  $in.'%'; }?></th>
                    
                    <?php } } ?>
  
                  </tr>
                  
                  <?php } } } ?>
                 
                  
                  
                </table>
          </div>
     
          
        </div>
     
    </div>
  </div>

  </body>
</html>