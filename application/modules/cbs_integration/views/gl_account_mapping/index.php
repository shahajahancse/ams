<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('cbs_integration/gl_account_mapping')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('cbs_integration/add_gl_account_mapping')?>" class="btn btn-info btn-xs btn-mini"> Add GL Account Mapping</a>
                     <a href="<?=base_url('cbs_integration/export_journal_entries')?>" class="btn btn-success btn-xs btn-mini">Export Journal Entries</a>
                  </div>
               </div>

               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <table class="table table-hover dataTable table-condensed">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:20%">Category</th>
                           <th style="width:20%">Asset Cost Account</th>
                           <th style="width:20%">Accumulated Depreciation Account</th>
                           <th style="width:20%">Depreciation Expense Account</th>
                           <th style="width:18%">Gain/Loss on Disposal Account</th>
                           <th style="width:10%" class="text-center">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $i=0;
                        foreach ($mappings as $row) { ?>
                           <tr>
                              <td class="v-align-middle"><?=++$i?>.</td>
                              <td class="v-align-middle"><?=$row['category_name']?></td>
                              <td class="v-align-middle"><?=$row['asset_cost_account']?></td>
                              <td class="v-align-middle"><?=$row['accumulated_depreciation_account']?></td>
                              <td class="v-align-middle"><?=$row['depreciation_expense_account']?></td>
                              <td class="v-align-middle"><?=$row['gain_loss_on_disposal_account']?></td>
                              <td class="text-center">
                                 <a href="<?=base_url('cbs_integration/edit_gl_account_mapping/'.$row['id']);?>" class="btn btn-primary btn-xs btn-mini">Edit</a>
                                 <a href="<?=base_url('cbs_integration/delete_gl_account_mapping/'.$row['id']);?>" class="btn btn-danger btn-xs btn-mini" onclick="return confirm('Are you sure you want to delete this mapping?');">Delete</a>
                              </td>
                           </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>