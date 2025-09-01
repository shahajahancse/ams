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
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
               </div>
               <div class="grid-body ">
                <h2 style="text-align: center; font-weight: bold; ">  District Scouts Office </h2>
                  <table class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                           <th > SL </th>
                           <th >Scout District Name</th>
                           <th >Scout Region</th>
                           <th >Division</th>
                           <th >District</th>
                           <th >District Type</th>
                           <th >Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->dis_status == 1) {
                           $status = 'Enable';
                        }else{
                           $status = 'Disable';
                        }

                        if($row->dis_type == '1') {
                           $district = 'Administrative District';
                        }else if($row->dis_type == '2') {
                           $district = 'Metropolitan District';
                        }else if($row->dis_type == '3') {
                           $district = 'Rover District';
                        }else if($row->dis_type == '4') {
                           $district = 'Railway District';
                        }else if($row->dis_type == '5') {
                           $district = 'Sea District';
                        }else if($row->dis_type == '6') {
                           $district = 'Air District';
                        }
                        ?>
                        <tr>
                            <td class="v-align-middle"><?=$sl.'.'?></td>
                            <td> <?=$row->dis_name?> </td>
                            <td class="v-align-middle"><?=$row->region_name; ?></td>
                            <td class="v-align-middle"><?=$row->div_name; ?></td>
                            <td class="v-align-middle"><?=$row->district_name; ?></td>
                            <td> <?=$district?> </td>
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