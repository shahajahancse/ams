<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('cbs_integration')?>" class="active"> <?=$module_title; ?> </a></li>
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
                           <th>GL Account</th>
                           <th>Total Debit</th>
                           <th>Total Credit</th>
                           <th>Balance</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($report_data as $row): ?>
                        <tr>
                           <td><?=$row['gl_account']?></td>
                           <td><?=$row['total_debit']?></td>
                           <td><?=$row['total_credit']?></td>
                           <td><?=$row['total_debit'] - $row['total_credit']?></td>
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