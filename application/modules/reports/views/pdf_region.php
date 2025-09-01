<style type="text/css">

table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  color: black;

}

</style>
<div class="page-content">     
   <div class="content">  
     <div style="text-align: center;">
         <div  style="font-size: 20px;">BANGLADESH SCOUTS</div>
         <span>www.scouts.gov.bd</span>
      </div>
      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
             <div class="grid-title">
              <h4 align="center"><span class="semi-bold">Regional Offices</span></h4>
              <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
            </div>
               

               <div class="grid-body ">
                  <div id="infoMessage"><?php //echo $message;?></div>            
                  

                  <table class="table table-hover table-condensed">
                     <thead>
                        <tr>
                           <th> SL </th>
                           <th>Region Logo</th>
                           <th>Region Name</th>
                           <th>Division Name</th>
                           <th>Region Type</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->region_status == 1) {
                           $status = 'Active';
                        }else{
                           $status = 'Inactive';
                        }

                        if($row->region_type == 'divisional') {
                           $region = 'Divitional Region';
                        }else{
                           $region = 'Special Region';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <?php 
                       $img_path = base_url().'offices_img/';
                       if($row->region_logo != NULL){
                         $src= $img_path.$row->region_logo;
                         echo "<img src='$src' height='80'>";
                      }
					  else
					  	echo 'No logo';
                      ?></td>
                           <td> <?=$row->region_name?> </td>
                           <td class="v-align-middle"><?=$row->div_name; ?></td>
                           <td> <?=$region?> </td>
                           <td> <?=$status?></td>
                              
                           </tr>
                        <?php endforeach;?>                      
                     </tbody>
                  </table>
               </div>

            </div>
         </div>
      </div>

   </div> <!-- END Content -->

</div>