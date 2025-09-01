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
                     <a href="<?=base_url('items/stock_adjust')?>" class="btn btn-blueviolet btn-xs btn-mini"> Stock Adjust</a>
                  </div>
                  <?php endif; ?>
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"><?php //echo $message;?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <table class="table table-hover dataTable table-condensed">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <?php if($this->ion_auth->in_group(array('admin'))): ?>
                              <th style="width:12%">Branch</th>
                           <?php else: ?>
                              <th style="width:12%">Category</th>
                           <?php endif; ?>
                           <th style="width:12%">Sub Category</th>
                           <th style="width:20%">Item Name</th>
                           <th style="width:8%">Quantity</th>
                           <th style="width:10%">Order Level</th>
                           <!-- <th style="width:8%">Status</th> -->
                           <th style="width:12%" class="text-center">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i=0;
                        foreach ($results as $row) {
                           if($row->status == 1){
                              $status = 'Active';
                           }else{
                              $status = 'Inactive';
                           } ?>
                           <tr>
                              <td class="v-align-middle"><?=++$i?>.</td>
                              <?php if($this->ion_auth->in_group(array('admin'))): ?>
                                 <td class="v-align-middle"><?=$row->branch_name?></td>
                              <?php else: ?>
                              <td class="v-align-middle"><?=$row->category_name?></td>
                              <?php endif; ?>
                              <td class="v-align-middle"><?=$row->sub_cate_name?></td>
                              <td class="v-align-middle"><strong><?=$row->item_name?></strong></td>
                              <td class="v-align-middle"><?=($row->balance)? $row->balance:0?></td>
                              <td class="v-align-middle"><?=$row->order_level?></td>
                              <!-- <td class="v-align-middle"><?=$status?></td> -->
                              <td align="right">
                                 <div class="btn-group">
                                    <a class="btn btn-success dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                    <ul class="dropdown-menu pull-right">
                                       <li><a href="<?=base_url('items/stock_details/'.encrypt_url($row->id))?>"> Details</a> </li>
                                       <li><a target="_blank" href="<?=base_url('items/print_stock_in/'.$row->id)?>"> Print </a> </li>
                                    </ul>
                                 </div>
                              </td>
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
