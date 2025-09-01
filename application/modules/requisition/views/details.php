<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('my_requisition')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
         .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
         .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
         .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right; width: 150px;}
         .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('my_requisition')?>" class="btn btn-blueviolet btn-xs btn-mini"> My Requisition List</a>
                  </div>
               </div>

               <div class="grid-body"  id="printableArea">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

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

                  <div class="row">
                     <div class="col-md-12">
                        <table class="tg" width="100%">
                           <tr>
                              <th class="tg-khup">Title </th>
                              <td class="tg-ywa9"><?=$info->title?></td>
                              <th class="tg-khup">Status</th>
                              <td class="tg-ywa9"><?=$status?></td>
                              <th class="tg-khup">Date</th>
                              <td class="tg-ywa9"><?= date('d-m-Y', strtotime($info->created_at)); ?></td>
                           </tr>
                           <tr>
                              <th class="tg-khup"> Applicant</th>
                              <td colspan='2' class="tg-ywa9"><?=$userDetails['user_info']->first_name?></td>
                              <th class="tg-khup"> Designation </th>
                              <td colspan='2' class="tg-ywa9"><?=$userDetails['user_info']->desig_name?></td>
                           </tr>
                        </table>
                     </div>
                  </div> <!-- END GRID BODY -->
                  <br>

                  <div class="row form-row">
                     <div class="col-md-12">
                        <style type="text/css">td{color: black; font-size: 15px;}</style>
                        <fieldset>
                           <legend>Requisition List</legend>
                           <style type="text/css">
                              #appRowDiv td{padding: 5px; border-color: #ccc;}
                              #appRowDiv th{padding: 5px;text-align:left;border-color: #ccc; color: black;}
                           </style>
                           <div id="msgPerson"> </div>
                           <table width="100%" border="1" id="appRowDiv">
                              <tr>
                                 <th>SL</th>
                                 <th>Item Name (Unit)</th>
                                 <th>Request Qty.</th>
                                 <th>Approve Qty.</th>
                                 <th>Remarks</th>
                              </tr>
                              <?php $sl=0;
                                 foreach($items as $item){ $sl++; ?>
                                 <tr>
                                    <td><?=$sl?></td>
                                    <td><?=$item->item_name?></td>
                                    <td><?=$item->qty_request?></td>
                                    <td><?=$item->qty_approve?></td>
                                    <td><?=$item->remark?></td>
                                 </tr>
                              <?php } ?>
                           </table>
                        </fieldset>
                     </div>
                     <div class="col-md-12">
                        <label for=""> Description </label>
                        <p class="form-control input-sm" ><?=$info->description?></p>
                     </div>
                     <div class="col-md-12">
                        <div class="pull-right">
                           <a class="btn btn-primary btn-cons" href="<?= base_url('requisition/request_list') ?>">Back</a>
                        </div>
                     </div>
                  </div>
               </div> <!-- END GRID -->
            </div>
         </div> <!-- END ROW -->
      </div>
   </div>
