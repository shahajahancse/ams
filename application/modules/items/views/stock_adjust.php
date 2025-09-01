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
                     <a href="<?=base_url('items/stock')?>" class="btn btn-blueviolet btn-xs btn-mini">Stock List</a>
                  </div>
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"><?php //echo $message;?></div>
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <?php echo form_open('#', 'id="stock_adjust" method="post"'); ?>
                  <table class="table table-hover dataTable table-condensed">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:12%">Sub Category</th>
                           <th style="width:20%">Item Name</th>
                           <th style="width:8%">Quantity</th>
                           <th style="width:10%">Or. Level</th>
                           <th style="width:6%">Status</th>
                           <th style="width:7%">Quantity</th>
                           <th style="width:15%">Remarks</th>
                           <th style="width:15%" class="text-center">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $i=0;
                        foreach ($results as $row) {
                           if($row->status == 1){
                              $status = 'Active';
                           }else{
                              $status = 'Inactive';
                           } ?>
                           <tr>
                              <td class="v-align-middle"><?=++$i?>.</td>
                              <td class="v-align-middle"><?=$row->sub_cate_name?></td>
                              <td class="v-align-middle"><strong><?=$row->item_name?></strong></td>
                              <td class="v-align-middle"><?=($row->balance)?$row->balance:0?></td>
                              <td class="v-align-middle"><?=$row->order_level?></td>
                              <td class="v-align-middle"><?=$status?></td>
                              <input type="hidden" name="ids[]" value="<?=$row->id?>">
                              <input type="hidden" id="order<?=$row->id?>" name="order[]" value="<?=$row->order_level?>">
                              <input type="hidden" id="cat<?=$row->id?>" name="cat<?=$row->id?>" value="<?=$row->cat_id?>">
                              <input type="hidden" id="sub_cat<?=$row->id?>" name="sub_cat<?=$row->id?>" value="<?=$row->sub_cat_id?>">
                              <td class="v-align-middle"><input name="stock<?=$row->id?>" class="form-control input-sm" id="stock<?=$row->id?>"></td>
                              <td class="v-align-middle"><input name="remarks<?=$row->id?>" class="form-control input-sm" id="remarks<?=$row->id?>"></td>

                              <td class="text-center" style="width:15%">
                                 <a class="btn btn-primary btn-xs btn-mini" onclick="ajax_single_adjust(<?=$row->id?>)">Submit</a>
                                 <a class="btn btn-danger btn-xs btn-mini" onclick="remove_row(this)">Remove</a>
                              </td>
                           </tr>
                           <?php } ?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <th colspan='7'></th>
                              <th class="text-center"><button class="btn btn-success btn-xs btn-mini" type="submit">Submit All</button></th>
                           </tr>
                        </tfoot>
                     </table>
                     <?php echo form_close(); ?>
                  </div>
               </div>
            </div>
         </div>
      </div> <!-- END ROW -->
   </div>
</div>

<script>
   function remove_row(el) {
      $(el).closest('tr').remove();
   }
</script>

<script type="text/javascript">
   $(document).ready(function () {
      $("#stock_adjust").submit(function (e) {
         e.preventDefault(); // Prevent default form submission
         var formData = new FormData(this); // Get form data dynamically
         $.ajax({
            url: '<?=base_url('items/ajax_all_adjust')?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
               if (data == 'success') {
                  alert('Updated successfully');
               } else {
                  alert('An error occurred');
               }
            },
            error: function(xhr, status, error){
               alert('An error occurred: ' + xhr.responseText);
            }
         });
      });
   });
</script>

<script type="text/javascript">
   function ajax_single_adjust(id){
      var stock = $('#stock'+id).val();
      var order = $('#order'+id).val();
      var cat = $('#cat'+id).val();
      var sub_cat = $('#sub_cat'+id).val();
      var remarks = $('#remarks'+id).val();
      if(stock == ''){
         alert('Please enter stock quantity');
         return false;
      }
      if(remarks == ''){
         alert('Please enter remarks');
         return false;
      }
      $.ajax({
         url: '<?=base_url('items/ajax_single_adjust')?>',
         type: 'POST',
         data: {id:id, stock:stock, order:order, cat:cat, sub_cat: sub_cat, remarks:remarks},
         success: function(data){
            if (data == 'success') {
               alert('Updated successfully');
            } else {
               alert('An error occurred');
            }
         },
         error: function(xhr, status, error){
            alert('An error occurred: ' + xhr.responseText);
         }
      });
   }
</script>
