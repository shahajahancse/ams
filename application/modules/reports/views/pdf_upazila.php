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
              <h4 align="center"><span class="semi-bold">All Upazila/Thana Scouts Office</span></h4>
              <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
            </div>
               
               <div class="grid-body ">
                 
                  <table class="table table-hover table-condensed">
                     <thead>
                        <tr>
                           <th> SL </th>
                           <th>Scout Upazila Name</th>
                           <th>Scout District</th>
                           <th>Scout Region</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->upa_status == 1) {
                           $status = 'Enable';
                        }else{
                           $status = 'Disable';
                        }

                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <?=$row->upa_name?> </td>
                           <td class="v-align-middle"><?=$row->dis_name; ?></td>
                           <td class="v-align-middle"><?=$row->region_name; ?></td>
                           
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