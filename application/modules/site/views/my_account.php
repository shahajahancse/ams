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
               <table class="tg">
                  <tr>
                     <th class="tg-d8ej"> Name </th>
                     <td class="tg-031e"><strong><?=$info->first_name?></strong></td>
                  </tr>                  
                  <tr>
                     <th class="tg-d8ej"> Email </th>
                     <td class="tg-031e"><?=$info->username?></td>
                  </tr>
                  <tr>
                     <th class="tg-d8ej"> Mobile </th>
                     <td class="tg-031e"><strong><?=$info->phone?></strong></td>
                  </tr>
                  <tr>
                     <th class="tg-d8ej"> Org. / Office Name </th>
                     <td class="tg-031e"><?=$info->org_prof_name?></td>
                  </tr>
               </table>
            </div>

         </div> <!-- /row -->
      </div> <!-- /container -->
      <br>

   </div>
</div>