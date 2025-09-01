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
              <h4 align="center"><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div style="text-align: right;margin-bottom: 5px;">Date: <?= date('d F, Y') ?></div>       
            </div>

            <div class="grid-body ">
               <table class="table table-hover table-condensed" id="example">
                 <thead>
                   <tr>
                     <th width="5%"> SL </th>
                     <th width="20%"> DATETIME </th>
                     <th width="15%">User</th>
                     <th width="25%">Name</th>
                     <th width="35%">Message</th>
                     <th class="text-center" width="20%">Activity Type</th>
                  </tr>
               </thead>
               <tbody>
                <?php 
                $sl=$pagination['current_page'];
                foreach ($results as $row):
                  $sl++;
                  
               ?>
               <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=date('d M, Y h:i A', strtotime($row->created))?></td>
                  <td class="v-align-middle"><strong>
                    <?php
                      if($row->is_office){
                        echo $row->username;
                      }else{
                        echo $row->scout_id;
                      }
                   ?></strong></td>
                  <td class="v-align-middle">
                    <?php
                      if($row->office_type_id == 1){
                        echo $row->nhq_office_name;

                      }elseif($row->office_type_id == 2){
                        echo $row->region_name;

                      }elseif($row->office_type_id == 3){
                        echo $row->dis_name;

                      }elseif($row->office_type_id == 4){
                        echo $row->upa_name;

                      }elseif($row->office_type_id == 5){
                        echo $row->grp_name;

                      }else{
                          echo $row->first_name;
                      }
                    ?>
                  </td>
                  <td class="v-align-middle"><?=$row->message?></td>
                  <td class="v-align-middle text-center"><?=$row->name?></td>
               </tr>
            <?php endforeach;?>                      
         </tbody>
      </table>

 

</div>
</div>
</div>
</div>

</div> <!-- END ROW -->

</div>