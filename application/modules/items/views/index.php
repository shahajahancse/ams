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
                  <div class="pull-right">
                     <a href="<?=base_url('items/create')?>" class="btn btn-info btn-xs btn-mini"> Add Item</a>
                     <a href="<?=base_url('items/bulk_import')?>" class="btn btn-info btn-xs btn-mini"> Bulk Import</a>
                     <a href="<?=base_url('items/bulk_export')?>" class="btn btn-info btn-xs btn-mini"> Bulk Export</a>
                  </div>
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"><?php //echo $message;?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <?php if($this->session->flashdata('error')):?>
                     <div class="alert alert-error">
                        <?php echo $this->session->flashdata('error');?>
                     </div>
                  <?php endif; ?>

                  <table class="table table-bordered dataTable table-condensed">
                     <thead>
                        <tr>
                           <th style="vertical-align:middle" class="text-center"> SL </th>
                           <th style="vertical-align:middle" class="text-center">Branch</th>
                           <th style="vertical-align:middle" class="text-center">Category</th>
                           <th style="vertical-align:middle" class="text-center">Sub Category</th>
                           <th style="vertical-align:middle" class="text-center">Item Name</th>
                           <th style="vertical-align:middle" class="text-center">Unit</th>
                           <th style="vertical-align:middle" class="text-center">Status</th>
                           <th style="vertical-align:middle" class="text-center">QR Code</th>
                           <th style="vertical-align:middle" class="text-center">Action</th>
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
                           }
                           ?>
                           <tr>
                              <td style="vertical-align:middle" class="text-center"><?=++$i?>.</td>
                              <td style="vertical-align:middle" class="text-center"><?=$row->division_name?></td>
                              <td style="vertical-align:middle" class="text-center"><?=$row->category_name?></td>
                              <td style="vertical-align:middle" class="text-center"><?=$row->sub_cate_name?></td>
                              <td style="vertical-align:middle" class="text-center"><strong><?=$row->item_name?></strong></td>
                              <td style="vertical-align:middle" class="text-center"><?=$row->unit_name?></td>
                              <td style="vertical-align:middle">
                                 <span class="badge <?= ($status == 'Active') ? 'badge-success' : 'badge-danger'?>"><?= $status ?></span>
                              </td>
                              <td style="vertical-align:middle" class="text-center">
                                 <a href="<?=base_url('items/generate_qr_code/'.encrypt_url($row->id));?>" class="btn btn-info btn-xs btn-mini" target="_blank"><i class="fa fa-qrcode"></i> QR</a>
                              </td>
                              <td class="text-center">
                                 <a href="<?=base_url('items/edit/'.encrypt_url($row->id));?>" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i></a>
                                 <a href="<?=base_url('items/edit/'.encrypt_url($row->id));?>" class="btn btn-danger btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>
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
