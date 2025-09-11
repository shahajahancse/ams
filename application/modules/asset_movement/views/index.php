<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('asset_movement')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>

               <div class="grid-body ">
                  <table class="table table-hover dataTable table-condensed">
                     <thead>
                        <tr>
                           <th>Asset Name</th>
                           <th>Transfer Date</th>
                           <th>From Branch</th>
                           <th>From Department</th>
                           <th>To Branch</th>
                           <th>To Department</th>
                           <th>Transferred By</th>
                           <th>Notes</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($results as $row): ?>
                        <tr>
                           <td><?=$row->item_name?></td>
                           <td><?=$row->transfer_date?></td>
                           <td><?=$row->from_branch_name?></td>
                           <td><?=$row->from_department_name?></td>
                           <td><?=$row->to_branch_name?></td>
                           <td><?=$row->to_department_name?></td>
                           <td><?=$row->first_name . ' ' . $row->last_name?></td>
                           <td><?=$row->notes?></td>
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>