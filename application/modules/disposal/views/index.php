<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('disposal')?>" class="active"> <?=$module_title; ?> </a></li>
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
                           <th>Asset ID</th>
                           <th>Asset Name</th>
                           <th>Disposal Date</th>
                           <th>Disposal Type</th>
                           <th>Sale Proceeds</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($disposed_assets as $asset): ?>
                        <tr>
                           <td><?=$asset->id?></td>
                           <td><?=$asset->item_name?></td>
                           <td><?=$asset->disposal_date?></td>
                           <td><?=$asset->disposal_type?></td>
                           <td><?=$asset->sale_proceeds?></td>
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