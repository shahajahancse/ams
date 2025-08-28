<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('items')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <?php if($this->ion_auth->in_group(array('badmin', 'sm'))): ?>
                  <div class="pull-right">
                     <a href="<?=base_url('items/stock')?>" class="btn btn-blueviolet btn-xs btn-mini"><< Back List</a>
                  </div>
                  <?php endif; ?>
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <!-- Item Info -->
                  <div class="row">
                     <div class="col-md-12">
                        <table class="table table-hover">
                           <tr style="background: #dacfe3;">
                              <td >Item Name</td>
                              <td><?= $info->item_name ?></td>
                              <td >Quantity</td>
                              <td><?= $info->balance ?></td>
                           </tr>
                        </table>
                     </div>
                  </div>

                  <!-- Item details -->
                  <table class="table table-hover table-condensed">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:20%">Item Name</th>
                           <th style="width:12%">Category</th>
                           <th style="width:12%">Division</th>
                           <th style="width:12%">Date</th>
                           <th style="width:8%">Quantity</th>
                           <th style="width:8%">Status</th>
                           <!-- <th style="width:15%">Remarks</th> -->
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i=0;
                        foreach ($results as $row) {
                           if($row->status == 2){
                              $status = " <span class='label label-primary'>Store Purchase (In)</span> ";
                           }else if($row->status == 3){
                              $status = " <span class='label btn-danger'>Internal Requisition (Out)</span> ";
                           } else if($row->status == 4){
                              $status = " <span class='label label-primary'>Store Requisition (In)</span> ";
                           } else if($row->status == 5){
                              $status = " <span class='label label-primary'>Direct Purchase</span> ";
                           } else if($row->status == 6){
                              $status = " <span class='label label-warning'>Store Requisition (Out)</span> ";
                           } else {
                              $status = " <span class='label label-info'>Adjust (In)</span> ";
                           } ?>
                           <tr>
                              <td class="v-align-middle"><?=++$i?>.</td>
                              <td class="v-align-middle"><strong><?=$row->item_name?></strong></td>
                              <td class="v-align-middle"><?=$row->sub_cate_name?></td>
                              <td class="v-align-middle"><?=$row->branch_name?></td>
                              <td class="v-align-middle"><?= date('d-m-Y', strtotime($row->updated_at)) ?></td>
                              <td class="v-align-middle"><?=($row->qty)? $row->qty:0?></td>
                              <td class="v-align-middle"><?=$status?></td>
                              <!-- <td class="v-align-middle"><?=$row->remarks?></td> -->
                           </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

      </div> <!-- END ROW -->

   </div>
</div>
