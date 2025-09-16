<div class="page-content">
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('items')?>" class="active"> Items </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>

               <div class="grid-body ">
                  <div class="text-center">
                     <h3>QR Code for Asset</h3>
                     <img src="<?=$qr_code_path?>" alt="QR Code" style="height: 300px;">
                     <br><br>
                     <button onclick="window.print()" class="btn btn-primary">Print QR Code</button>
                     <a href="<?=base_url('items')?>" class="btn btn-default">Back to Items</a>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>