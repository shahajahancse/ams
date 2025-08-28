<div class="container w-75">
	<div class="secondary_sc_content">
      <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>
      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; }
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 170px;text-align:right;}
         .tg .tg-d8ej{background-color:#f0daef}
      </style>
      <div class="container">
       <div class="row">

         <div class="col-md-12">
            <div id="infoMessage"><?php echo $message;?></div>
            <?php
            if($info->schedule_type == 'Appointment') {
               $type = '<span class="badge badge-pill badge-primary">Appointment</span>';
            }else{
               $type = '<span class="badge-info">Invitation</span>';
            }
            ?>

            <table class="tg">
               <tr>
                  <th class="tg-d8ej"> Schedule Type </th>
                  <td class="tg-031e"><?=$type?></td>
               </tr>
               <tr>
                  <th class="tg-d8ej">Proposed Datatime </th>
                  <td class="tg-031e"><?=date('d M, Y h:i A', strtotime($info->date)); ?></td>
               </tr>
               <tr>
                  <th class="tg-d8ej"> Schedule Title </th>
                  <td class="tg-031e"><strong><?=$info->title?></strong></td>
               </tr>               
               <tr>
                  <th class="tg-d8ej"> Venue </th>
                  <td class="tg-031e"><?=$info->venue?></td>
               </tr>
               <tr>
                  <th class="tg-d8ej"> Purpose </th>
                  <td class="tg-031e"><?=$info->purpose?></td>
               </tr>
               <tr>
                  <th class="tg-d8ej"> Organization </th>
                  <td class="tg-031e"><?=$info->organization?></td>
               </tr>
            </table>
         </div>

      </div> <!-- /row -->
   </div> <!-- /container -->
   <br>
   
</div>
</div>