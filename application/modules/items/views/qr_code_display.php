<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <?=$module_title?> </li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="javascript:history.back()" class="btn btn-blueviolet btn-xs btn-mini"> Go Back</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <div class="row">
                     <div class="col-md-12 text-center">
                        <h3>Generated QR Code</h3>
                        <?php if (isset($qr_code_path) && file_exists(FCPATH . 'qrcode_img/' . basename($qr_code_path))): ?>
                            <img src="<?=$qr_code_path?>" alt="QR Code" style="width: 250px; height: 250px; border: 1px solid #ccc; padding: 5px;">
                            <br><br>
                            <a href="<?=$qr_code_path?>" download class="btn btn-primary">Download QR Code</a>
                            <button onclick="window.print()" class="btn btn-info">Print QR Code</button>
                        <?php else: ?>
                            <p>QR Code could not be generated or found.</p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>  <!-- END GRID BODY -->
            </div> <!-- END GRID -->
         </div>
      </div> <!-- END ROW -->
   </div>
</div>