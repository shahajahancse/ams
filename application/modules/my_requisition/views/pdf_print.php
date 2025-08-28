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
      .text-left{text-align:left;}
      .text-center{text-align:center;}
      .text-right{text-align:right;}
      .report_date{text-align: right; font-size: 14px;}
      b{font-weight:500;}
   </style>
    <style type="text/css">
        .tg {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
        .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#ffffff; vertical-align: middle;}
        .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#efefef;text-align: center;}
        .tg .tg-khup{background-color:#efefef; color: black; text-align: right;}
        .tg .tg-ywa9{background-color:#ffffff; color: black;}
    </style>
</head>
<body>
  <div class="priview-body">
        <div class="priview-header">
            <p class="text-center">
            <span style="font-size:20px;font-weight: bold;">BFRI Inventory Management System</span>
            </p>
        </div>

            <div class="row">
                <div class="col-12 text-center">
                    <div style="font-size:18px;"><u><?=$headding?></u></div>
                    <div style="font-size:13px;">Report Date: <?=date('d-m-Y')?></div>
                    <br>
                </div>
            </div>

        <div class="priview-demand">
            <?php
                $status = '<span class="label label-secondary">Draft</span>';
                if ($info->status == 2) {
                    $status = '<span class="label label-warning">On process</span>';
                }else if($info->status == 3){
                    $status = '<span class="label label-primary">Approve SM</span>';
                }else if($info->status == 4){
                    $status = '<span class="label label-info">Back User From DO</span>';
                }else if($info->status == 5){
                    $status = '<span class="label label-primary">Approve DO</span>';
                }else if($info->status == 6){
                    $status = '<span class="label label-primary">Delivered </span>';
                }else if($info->status == 7){
                    $status = '<span class="label label-danger">Rejected</span>';
                }
            ?>
            <table class="tg" width="100%">
                <tr>
                    <th class="tg-khup">Title </th>
                    <td colspan='5' class="tg-ywa9"><?=$info->title?></td>
                </tr>
                <tr>
                    <th class="tg-khup"> Applicant</th>
                    <td><?=$userDetails['user_info']->first_name?></td>
                    <th class="tg-khup">Status</th>
                    <td><?=$status?></td>
                    <th class="tg-khup">Date</th>
                    <td><?= date('d-m-Y', strtotime($info->created_at)); ?></td>
                </tr>
            </table>
        </div>

        <div class="priview-demand">
            <table class="table table-hover table-bordered report">
                <thead class="headding">
                    <tr>
                        <th class="text-left">SL</th>
                        <th class="text-left">Item Name (Unit)</th>
                        <th class="text-right">Request Qty.</th>
                        <th class="text-right">Approve Qty.</th>
                        <th class="text-left">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl=0;
                        foreach($items as $item){ $sl++; ?>
                        <tr>
                            <td class="text-left"><?=$sl?></td>
                            <td class="text-left"><?=$item->item_name?></td>
                            <td class="text-right"><?=$item->qty_request?></td>
                            <td class="text-right"><?=$item->qty_approve?></td>
                            <td class="text-left"><?=$item->remark?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="headding">
                </tfoot>
            </table>
        </div>
   </div>
</body>
</html>



