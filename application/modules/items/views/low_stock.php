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
                           <th style="width:12%">Category</th>
                           <th style="width:12%">Sub Category</th>
                           <th style="width:20%">Item Name</th>
                           <th style="width:8%">Unit</th>
                           <th style="width:8%">Quantity</th>
                           <th style="width:10%">Order Level</th>
                           <th style="width:10%">Division</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i=0;
                        foreach ($results as $row) { ?>
                           <tr>
                              <td class="v-align-middle"><?=++$i?>.</td>
                              <td class="v-align-middle"><?=$row->category_name?></td>
                              <td class="v-align-middle"><?=$row->sub_cate_name?></td>
                              <td class="v-align-middle"><strong><?=$row->item_name?></strong></td>
                              <td class="v-align-middle"><?=$row->unit_name?></td>
                              <td class="v-align-middle"><strong><?=$row->balance?></strong></td>
                              <td class="v-align-middle"><?=$row->order_level?></td>
                              <td class="v-align-middle"><?=$row->name_en?></td>
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
