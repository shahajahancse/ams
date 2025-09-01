<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$headding?></title>
	<style type="text/css">
      body{font-family: 'Tahoma'}
      .priview-body{font-size: 16px;color:#000;margin: 25px; }
      .priview-header{margin-bottom: 10px;text-align:center;}
      .priview-header div{font-size: 18px;}
      .priview-memorandum, .priview-from, .priview-to, .priview-subject, .priview-message, .priview-office, .priview-demand, .priview-signature{padding-bottom: 20px;}
      .priview-office{text-align: center;}
      .priview-imitation ul{list-style: none;}
      .priview-imitation ul li{display: block;}
      .date-name{width: 20%;float: left;padding-top: 23px;text-align: right;}
      .date-value{width: 70%;float:left;}
      .date-value ul{list-style: none;}
      .date-value ul li{text-align: center;}
      .date-value ul li.underline{border-bottom: 1px solid black;}
      .subject-content{text-decoration: underline;}
      .headding{border-top:1px solid #000;border-bottom:1px solid #000;}

      .col-1{width:8.33%;float:left;}
      .col-2{width:16.66%;float:left;}
      .col-3{width:25%;float:left;}
      .col-4{width:33.33%;float:left;}
      .col-5{width:41.66%;float:left;}
      .col-6{width:50%;float:left;}
      .col-7{width:58.33%;float:left;}
      .col-8{width:66.66%;float:left;}
      .col-9{width:75%;float:left;}
      .col-10{width:83.33%;float:left;}
      .col-11{width:91.66%;float:left;}
      .col-12{width:100%;float:left;}

      .table{width:100%;border-collapse: collapse;}
      .table td, .table th{border:1px solid #ddd;}
      .table tr.bottom-separate td,
      .table tr.bottom-separate td .table td{border-bottom:1px solid #ddd;}
      .borner-none td{border:0px solid #ddd;}
      .headding td, .total td{border-top:1px solid #ddd;border-bottom:1px solid #ddd;}
      .table th{padding:5px;}
      .table td{padding:5px;}
      .text-center{text-align:center;}
      .text-right{text-align:right;}
      .report_date{text-align: right; font-size: 14px;}
      b{font-weight:500;}
   </style>
</head>
<body>
	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">
            <span style="font-size:20px;font-weight: bold;">Bangladesh Scouts</span>
            <br> <span style="font-size: 14px;">60, Anjuman Mufidul Islam Road, Kakrail, Dhaka – 1000 </span>
            <br><span style="font-size:12px;">www.scouts.gov.bd</span>
         </p>
      </div>

      <div class="priview-memorandum">
         <div class="row">
            <div class="col-12 text-center">
               <div style="font-size:18px;"><u><?=$headding?></u></div>
               <?php // !empty($data_status)?'ব্যাক্তিগত ডাটার স্ট্যাটাসঃ '.func_datasheet_status($data_status).'<br>':''?>
               <?php // !empty($division_info->div_name_bn)?'বিভাগঃ '.$division_info->div_name_bn.'<br>':''?>
               <span style="font-size: 14px;">Date From: <?=$date_from?> - Date To: <?=$date_to?></span>
            </div>
         </div>
      </div>

      <div class="priview-demand">
         <div class="report_date">Report Date: <?=date('d-m-Y')?></div>
         <table class="table table-hover table-bordered report">
            <thead class="headding">
               <tr>
                  <th class="text-center">SL</th>
                  <th class="text-left">Region Name</th>
                  <th class="text-right">Total Scout Group</th>
                  <th class="text-right">Total Scout Member</th>						
               </tr>
            </thead>

            <tbody>
               <?php 
               $i=0;
               $total_group=$total_member=$grandTotalGroup=$grandTotalMember=0;

               foreach ($results as $row) { 
                  $i++;
                  $total_group = $row->total_sc_group;
                  $total_member = $row->total_member;
                  $grandTotalGroup += $total_group;
                  $grandTotalMember += $total_member;
                  ?>
                  <tr>
                     <td class="text-center"><?=$i?>.</td>
                     <td class="text-left"><?=$row->region_name_en?></td>                 
                     <td class="text-right"><?=$total_group?></td>                 
                     <td class="text-right"><?=$total_member?></td>
                  </tr>
                  <?php } ?>
               </tbody>

               <tfoot class="headding">
                  <tr>
                     <th class="text-right" colspan="2">Grand Total</th>
                     <th class="text-right"><?=$grandTotalGroup?></th>
                     <th class="text-right"><?=$grandTotalMember?></th>
                  </tr>
               </tfoot>
            </table>			
         </div>

      </div>

   </body>
   </html>


