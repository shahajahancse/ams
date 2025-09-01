<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('qrimages')?>" class="active"> QR Images </a></li>
         <li> Generate QR Code </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold">Generate QR Code</span></h4>
                  <div class="pull-right">
                     <!-- Optional: Add a back button or other actions here -->
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <!-- Original content starts here -->
                  <div align="center">
                     <form action="" method="post">
                     <span>Enter your raw text to generate QRCode</span><br><br>
                     <input type="text" name="qr_text" required="required" placeholder="">
                     <input type="hidden" name="action" value="generate_qrcode"><input type="submit" name="" value="Generate">
                     </form>
                     <?php
                     if($img_url)
                     {
                     ?>
                        <br><br>Your QRcode Image here. Scan this to get result<br>
                        <img src="<?php echo base_url('qrcode_img/'.$img_url); ?>" alt="QRCode Image">
                     <?php
                     }?>
                  </div>
                  <!-- Original content ends here -->
               </div>  <!-- END GRID BODY -->
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>