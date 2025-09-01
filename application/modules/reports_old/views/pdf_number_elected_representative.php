<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>বাজেট বরাদ্দের বিস্তারিত রিপোর্ট</title>

    <style type="text/css">
		.priview-body{
			font-size: 16px;
			color:#000;
			margin: 25px;
		}
		.priview-header{
			margin-bottom: 10px;
			text-align:center;
		}
		.priview-header div{
			font-size: 18px;
		}
		.priview-memorandum, 
		.priview-from, 
		.priview-to, 
		.priview-subject,
		.priview-message,
		.priview-office,
		.priview-demand,
		.priview-signature{
			padding-bottom: 20px;
		}
		.priview-office{
			text-align: center;
		}
		.priview-imitation ul{
			list-style: none;
		}
		.priview-imitation ul li{
			display: block;
		}
		.date-name{
			width: 20%;
			float: left;
			padding-top: 23px;
			text-align: right;
		}
		.date-value{
			width: 70%;
			float:left;
		}
		.date-value ul{
			list-style: none;
		}
		.date-value ul li{
			text-align: center;
		}
		.date-value ul li.underline{
			border-bottom: 1px solid black;
		}
		.subject-content{
			text-decoration: underline;
		}
		.headding{
			border-top:1px solid #000;
			border-bottom:1px solid #000;

		}

		.col-1{
			width:8.33%;
			float:left;
		}
		.col-2{
			width:16.66%;
			float:left;
		}
		.col-3{
			width:25%;
			float:left;
		}
		.col-4{
			width:33.33%;
			float:left;
		}
		.col-5{
			width:41.66%;
			float:left;
		}
		.col-6{
			width:50%;
			float:left;
		}
		.col-7{
			width:58.33%;
			float:left;
		}
		.col-8{
			width:66.66%;
			float:left;
		}
		.col-9{
			width:75%;
			float:left;
		}
		.col-10{
			width:83.33%;
			float:left;
		}
		.col-11{
			width:91.66%;
			float:left;
		}
		.col-12{
			width:100%;
			float:left;
		}
		.table{
			width:100%;
			border-collapse: collapse;
		}
		.table td, .table th{
			
			border:0px solid #ddd;
		}
		.table tr.bottom-separate td,
		.table tr.bottom-separate td .table td{
			border-bottom:1px solid #ddd;
		}
		.borner-none td{
			border:0px solid #ddd;
		}
		.headding td, .total td{
			border-top:1px solid #ddd;
			border-bottom:1px solid #ddd;
		}
		.table td{
			padding:5px;
		}
		.text-center{
			text-align:center;
		}
		.text-right{
			text-align:right;
		}
		b{
			font-weight:500;
		}
		

	</style>
</head>
<body>

<?php $headding=$this->lang->line('headding'); ?>	
<div class="priview-body">
	<div class="priview-header">
		<p class="text-center"><?=$headding?></p>
	</div>

	<div class="priview-memorandum">
		<div class="row">			
			<div class="col-12">
				<?= !empty($office->office_name_bng)?$office->office_name_bng.', ':''?>
				<?= !empty($upazila->name_bd)?$upazila->name_bd.', ':''?>
				<?= !empty($district->name_bn)?$district->name_bn.', ':''?>
				<?= !empty($division->name_bn)?$division->name_bn:''?>
			</div>
			<div class="col-12">
				<?= !empty($start_date)?' অনুসন্ধানের তারিখ : '.date_bangla_calender_format($start_date).', ':''?>
				<?= !empty($end_date)?' থেকে '.date_bangla_calender_format($end_date):''?>
			</div>
			<!-- <div class="col-12r">
				অর্থবছর : <?=$this->Common_model->en2bn($fiscal_year->name_bn)?>
			</div> -->
			<div class="col-12r">
				তারিখ : <?=date_bangla_calender_format(date('d-m-Y'))?>
			</div>
		</div>
		
	</div>

	<div class="priview-memorandum">
		<div class="row">
			<div class="col-12 text-center">
				<div style="font-size: 18px;"><u> বাজেট বরাদ্দের বিস্তারিত রিপোর্ট </u></div>
				<div style="font-size: 12px;"><?=$office_type->name?></div>
			</div>
		</div>
		
	</div>
	
	<div class="priview-demand">
		<table class="table table-hover table-bordered report">
			<thead class="headding">
				<tr>
					<td class="text-center"><?=$this->lang->line('serial-no')?></td>
					<td class="text-center"><?=$this->lang->line('code_no')?></td>
					<td class="text-left"><?=$this->lang->line('head_name')?></td>
					<td>
						<table class="borner-none" style="width: 90%">
							<tr>
								<td class="text-left" width="40%">অফিস এর নাম</td>
								<td class="text-center" width="30%">তারিখ</td>
								<td class="text-right" width="30%"><?=$this->lang->line('received_amount')?></td>
							</tr>
						</table>
					</td>
					<td class="text-right">মোট</td>
				</tr>
			</thead>
			<tbody>
				
				<?php 
				$sum1=0;  
				$i=1;
				foreach ($budget_sub_heads as $item) { 
					$sum1 +=$budget_sub_heads[$item['info']->id]['allocation'];
				?>
				<tr class="bottom-separate">
					<td class="text-center"><?=$this->Common_model->en2bn($i)?></td>
					<td class="text-center"><?=$budget_sub_heads[$item['info']->id]['info']->new_code?></td>
					<td class="text-left"><?=$budget_sub_heads[$item['info']->id]['info']->name?></td>
					<td>
						<table class="table" style="width: 90%">
							
							<?php foreach ($budget_sub_heads[$item['info']->id]['allocation_details'] as $details) {?>
								<tr>
									<td class="text-left" width="40%">
										<?=$details->office_name_bng?>
										<?= !empty($details->name_bd)?', '.$details->name_bd:''?>
										<?= !empty($details->name_bn)?', '.$details->name_bn:''?>	
										</td>
									<td class="text-left" width="30%"><?=date_bangla_calender_format($details->created_at) ?></td>
									<td class="text-right" width="30%"><?=$this->Common_model->en2bn($details->allocation_amount) ?></td>
								</tr>
							<?php } ?>
							
						</table>	
					</td>
					<td class="text-right"><?=$this->Common_model->en2bn($budget_sub_heads[$item['info']->id]['allocation'])?></td>
				</tr>
				<?php 
					$i++; 
				}   
				?>
			</tbody>
			<tfoot class="headding">
				<tr>
					<td class="text-right" colspan="3">সর্বমোট বরাদ্দকৃত অর্থঃ</td>
					<td class="text-right" colspan="2"><?=$this->Common_model->en2bn($sum1)?></td>
				</tr>
			</tfoot>
			
		</table>
	</div>
</div>
</body>
</html>


