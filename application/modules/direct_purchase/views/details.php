   <style type="text/css">
      .btn-cons{font-size: 20px;}
   </style>
   <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
      .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#000000;background-color:#E0FFEB; vertical-align: middle;}
      .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
      .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right; width: 150px;}
      .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
   </style>

   <div class="page-content">
      <div class="content">
         <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
            <li><a href="<?=base_url('requisition')?>" class="active"><?=$module_name?></a></li>
            <li><?=$meta_title; ?></li>
         </ul>
         <div class="row">
            <div class="col-md-12">
               <div class="grid simple horizontal">
                  <div class="grid-title">
                     <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                     <div class="pull-right"> </div>
                  </div>
                  <div class="grid-body">
                     <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                           <?=$this->session->flashdata('success');;?>
                        </div>
                     <?php endif; ?>

                     <div class="row">
                        <div class="col-md-12">
                           <fieldset >
                              <legend>Purchase Information </legend>
                              <?php
                                 $status = '<span class="label label-primary"> Direct Purchase </span>';
                              ?>

                              <div class="row">
                                 <div class="col-md-12">
                                    <table class="tg" width="100%">
                                       <tr>
                                          <th class="tg-khup"> Title Name</th>
                                          <td class="tg-ywa9"><?=$info->supplier_name?></td>
                                          <th class="tg-khup"> Status </th>
                                          <td class="tg-ywa9"><?=$status?></td>
                                       </tr>

                                       <tr>
                                          <th class="tg-khup"> Created </th>
                                          <td class="tg-ywa9"><?=date('d-m-Y', strtotime($info->created_at)); ?></td>
                                          <th class="tg-khup"> Updated </th>
                                          <td class="tg-ywa9"><?= empty($info->updated_at) ? '' : date('d-m-Y', strtotime($info->updated_at)); ?></td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                     </div>

                     <div class="row form-row">
                        <div class="col-md-12">
                           <style type="text/css">td{color: black; font-size: 15px;}</style>
                           <fieldset>
                              <legend>Purchase List</legend>
                              <style type="text/css">
                                 #appRowDiv td{padding: 5px; border-color: #ccc;}
                                 #appRowDiv th{padding: 5px;text-align:left;border-color: #ccc; color: black;}
                              </style>
                              <div id="msgPerson"> </div>
                              <table width="100%" border="1" id="appRowDiv">
                                 <tr>
                                    <th width="20%">Item Name <span class="required">*</span></th>
                                    <th width="15%">Qty. Request</th>
                                    <th width="15%"> Qty. Correction </th>
                                    <th width="10%"> Unit </th>
                                    <th width="20%">Remark</th>
                                 </tr>

                                 <?php foreach($purchase_item_data as $item){ ?>
                                 <tr>
                                    <td><?=$item->item_name?></td>
                                    <td><?=$item->pur_quantity?>  <?=$item->unit_name?></td>
                                    <td><?=$item->pur_approve?></td>
                                    <td><?=$item->unit_name?></td>
                                    <td><?=$item->pur_remark?></td>
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
                              <a class="btn btn-primary btn-cons" href="<?= base_url('purchase') ?>">Back</a>
                           </div>
                        </div>
                     </div>
                  </div>  <!-- END GRID BODY -->
               </div> <!-- END GRID -->
            </div>
         </div> <!-- END ROW -->
      </div>
   </div>

