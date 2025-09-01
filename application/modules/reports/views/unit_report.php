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
          <a href="<?=base_url('reports/doc_unit_report')?>" class="btn btn-blueviolet btn-xs btn-mini" style="float: right;margin-left:10px; ">DOC Download</a>
          <a href="<?=base_url('reports/pdf_unit_report')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
          <div class="col-md-12" style="padding-bottom: 10px;">
            <h2 style="text-align: center; font-weight: bold; "> স্কাউট ইউনিট রিপোর্ট </h2>
             
                <table class="tg">
                  <tr>
                    <th class="tg-yw4l" rowspan="2" width="300" style="text-align: center;">শাখা</th>
                    
                    <th class="tg-yw4l" style="text-align: center;">মোট</th>
                    <th class="tg-yw4l" style="text-align: center;">Growth</th>
                  </tr>
                  <tr>
                    
                  </tr>
                  <?php foreach ($unit_type as $key => $value) { 
                    foreach ($count_unit_type_wise as $ke => $val) { 
                      if($val->unit_type==$key){
                   ?>
                   
              
                  <tr>

                    <th class="tg-yw4l"  style="text-align: center;"><?php echo $value;?></th>
                     <th class="tg-rmb8"  style="text-align: center;"> <?php  echo $val->count_total;?></th>


                    <?php  foreach ($count_unit_year_wise_type_wise as $key => $v) { 
                      if($v->unit_type== $val->unit_type){ ?>

                        <th class="tg-rmb8"  style="text-align: center;"> <?php 
                         $sub=$v->count_now- $v->count_prev;
                         if($v->count_prev!=0){
                            $growth=($sub/$v->count_prev)*100; 
                            echo $growth.'%';
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