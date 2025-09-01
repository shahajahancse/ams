<!DOCTYPE html>
<html lang="en">
<head>
   <title><?=$meta_title?></title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1"> 
   <link rel="icon" type="image/ico" href="<?=base_url();?>awedget/assets/img/favicon.ico"/>
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>fwedget/assets2/vendor/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>fwedget/assets2/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>fwedget/assets2/css/util.css">
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>fwedget/assets2/css/main.css">
   <script src="<?=base_url();?>fwedget/assets2/vendor/jquery/jquery-3.2.1.min.js"></script>
   <script src="<?=base_url();?>fwedget/assets2/vendor/bootstrap/js/bootstrap.min.js"></script>

   <style type="text/css">
      .table-responsive{
         height:500px; width:100%;
        overflow-y: auto;
        border:2px solid #444;
     }.table-responsive:hover{border-color:red;}

     table{width:100%;}
     td{padding:24px; background:#eee;}
  </style>
</head>
<body>

   <div class="table100 ver5">
      <div class="table100-body js-pscroll">
         <div style="color: white; border-bottom: 1px solid #ccc; overflow: hidden; padding: 5px 10px;font-size: 18px;">
            <div style="float:left; width: 600px;margin-top: 10px;">Technical and Madrasah Education Division</div>
            <div style="float: left;margin-top: 10px;"> <?=date('d F, Y h:i:s A')?> </div>
            <div style="float: right; width: 50px;"> <img src="<?=base_url('fwedget/assets/images/bd_logo1.png')?>" height="40" > </div>
         </div>

         <table>
            <thead>
               <tr>
                  <th class="" style="font-size: 35px; color: white;padding-left: 20px; width: 100px;">SL</th>
                  <th class="" style="font-size: 35px;color: white;width: 200px;">PASS ID</th>
                  <th class="" style="font-size: 35px;color: white;width: 500px;">Name</th>
                  <th class="" style="font-size: 35px;color: white;">Mobile</th>
               </tr>
            </thead>
         </table>

         <!-- <MARQUEE direction = "up" LOOP=INFINITE BEHAVIOR=SLIDE SCROLLDELAY=10> -->
         <div class="table-responsive">
            <table >            
               <tbody>
                  <?php 
                  $sl=0;
                  foreach ($results as $row) { 
                     $sl++;
                     if($row->user_id){
                        $name    = $row->first_name;
                        $mobile  = $row->phone;
                        //$email   = $row->email;
                     }else{
                        $name    = $row->name;
                        $mobile  = $row->mobile_no;
                        //$email   = $row->email;
                     }

                     ?>
                     <tr>
                        <td class=""><?=$sl?></td>
                        <td class=""><?= sprintf("%04d", $row->id);?></td>
                        <td class=""><?=$name?></td>
                        <td class=""><?=$mobile?></td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div> <!-- </table-responsive> -->
            <!-- </MARQUEE> -->

         </div>
      </div>
      
   </body>
   </html>

   <script type="text/javascript">
   // setTimeout(function(){
   //   location = ''
   // },10000)

   var $el = $(".table-responsive");
   function anim() {
      var st = $el.scrollTop();
      var sb = $el.prop("scrollHeight")-$el.innerHeight();
      $el.animate({scrollTop: st<sb/2 ? sb : 0}, 4000, anim);
   }
   function stop(){
      $el.stop();
   }
   anim();
   $el.hover(stop, anim);
</script>