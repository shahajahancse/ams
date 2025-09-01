<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb">
      <li> <a href="<?=base_url()?>" class="active"><?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
    </ul>
  

  <div class="row">
   <div class="col-md-12">
    <div class="grid simple horizontal">
     <div class="grid-title">
      <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
    </div>
    <div class="grid-body">

      <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0; width:90%}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg .tg-b44r{background-color:#c5e2d5;vertical-align:top;color:black}
        .tg .tg-jbrh{background-color:#f3c953;vertical-align:top;color:black}
        .tg .tg-yw4l{vertical-align:top;color:black}
      </style>
      <table class="tg">
        <tr>
          <th class="tg-b44r" style="background-color: #ccc; text-align: center;">পরীক্ষা/ডিগ্রী</th>
          <th class="tg-jbrh" style="background-color: #ccc; text-align: center;">সংখ্যা </th>
          <th class="tg-jbrh" style="background-color: #ccc; text-align: center;">হার</th>
        </tr>
        <?php 
          //print_r($exams);
          //for ($i=0; $i < count($exams); $i++) { 


        $total_count = '';
        foreach ($exam_cnt as $row) {          
          $total_count += $row->data_cnt;
        }
//$tot_per=0;
        foreach ($exam_cnt as $row) {      
          $percent = $row->data_cnt*100/$total_count;             
          //$tot_per += $percent; 
        ?>
        <tr>
          <th class="tg-b44r"><?php echo $row->exam_name?> </th>
          <th class="tg-jbrh"><?php echo $row->data_cnt;?></th>
          <th class="tg-jbrh"> <?php echo number_format($percent, 2, '.', ' ');?> % </th>
        </tr>
        <?php } ?>
      </table>
<?php //echo $tot_per; ?>
    </div>
  </div>
</div>
</div>

</div> <!-- END ROW -->

</div>
</div>