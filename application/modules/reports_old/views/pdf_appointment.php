<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$headding?></title>
	<style type="text/css">
		.priview-body{font-size: 16px;color:#000;margin: 25px;}
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
		.table td{padding:5px;}
		.text-center{text-align:center;}
		.text-right{text-align:right;}
		b{font-weight:500;}
	</style>
</head>
<body>
	<div class="priview-body">
		<div class="priview-header">
			<p class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার  <br><span style="font-size:20px;">কারিগরি মাদ্রাসা শিক্ষা বিভাগ</span><br> শিক্ষা মন্ত্রণালয়, বাংলাদেশ সচিবালয় <br> <span style="font-size:12px;">www.BCCT.gov.bd</span></p>
		</div>

		<div class="priview-memorandum">
			<div class="row">
				<div class="col-12 text-center">
					<div style="font-size:18px;">সচিব মহোদয়<br><u><?=$headding?></u></div>
					<?php //!empty($finance_info)?'অর্থায়নেঃ '.$finance_info->finance_name.'<br>':''?>
					<?=date_bangla_calender_format($this->input->post('start_date'))?> <em>হতে</em> <?=date_bangla_calender_format($this->input->post('end_date'))?> <em> তারিখ পর্যন্ত </em>
				</div>
			</div>
		</div>

		<div class="priview-demand">
			<table class="table table-hover table-bordered report">
				<thead class="headding">
					<tr>
						<!-- <th class="text-center">ক্রম</th> -->
						<th class="text-center">তারিখ ও বার</th>
						<th class="text-center">সময়</th>
						<th class="text-center">সভার বিষয়	</th>
						<!-- <th class="text-center">কোর্সের মেয়াদ (দিন)</th> -->
						<!-- <th class="text-center">অংশগ্রহণকারীর সংখ্যা</th> -->
						<!-- <th class="text-center">অর্থায়নে</th> -->
						<th class="text-center">মন্তব্য</th>
					</tr>
				</thead>

				<tbody>
					<?php 
					$i=0;					
					foreach ($results as $row) { 
						$i++;
//Day count
$startDate = $row->date != '0000-00-00 00:00:00' ? $row->date:'';
$endDate = $row->date_end != '0000-00-00 00:00:00' ? $row->date_end:'';
$date_start = strtotime($startDate);
$date_end   = strtotime($endDate);
$datediff = $date_end - $date_start;
$duration = round($datediff / (60 * 60 * 24))+1;
$duration = eng2bng($duration).' দিন';
						?>
						<tr>
							<!-- <td class="text-center"><?=eng2bng($i)?>.</td> -->
							<td class="text-left"><?=date_bangla_calender_format($row->date)?></td>
							<td class="text-left"><?=date('h:i A', $row->date)?></td>
							<td class="text-left"><?=$row->title?></td>
							<!-- <td class="text-left"><?=$row->participant_name?></td> -->
							<!-- <td class="text-center"><?=$duration?></td> -->
							<!-- <td class="text-left"></td> -->
							<td>&nbsp;</td>		
						</tr>
						<?php } ?>
					</tbody>
		
				</table>			
			</div>

		</div>

	</body>
	</html>


