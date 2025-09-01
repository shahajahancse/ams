<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('scouts_member')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>
      <style type="text/css">
         .marTopSearch{margin-top: 10px;}
      </style>
      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
             <div class="grid-title">
               <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               <div class="pull-right">
                  <!-- <a href="<?=base_url('scouts_member/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Scouts Member </a>
                  <a href="<?=base_url('scouts_member/all')?>" class="btn btn-blueviolet btn-xs btn-mini"> Scouts Member List</a> -->
               </div>            
            </div>

            <div class="grid-body ">
               <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                     <?php echo $this->session->flashdata('success');?>
                  </div>
               <?php endif; ?>
               <?php 

                /*****************Filter check start*********************/
                if (!empty($_GET['region']) && isset($_GET['region']) || (!empty($_GET['memberType'])) || (!empty($_GET['scoutID'])) || (!empty($_GET['name'])) || (!empty($_GET['username'])) || (!empty($_GET['gender']))|| (!empty($_GET['section']))) { ?>
                   <div class="row" style="font-size: 15px;">
                        <b style="color: #FFFFFF;background-color: #4CAF50;padding: 5px;">Filter</b>

                        <?php
                            if (!empty($_GET['region']) && isset($_GET['region'])) {
                                echo "<b>Region :- </b>".$regions[$_GET['region']].',';
                            }

                            if (!empty($_GET['district']) && isset($_GET['district'])) {
                                echo "<b> District :- </b>".$scouts_district[$_GET['district']].',';
                            }

                            if (!empty($_GET['upazila']) && isset($_GET['upazila'])) {
                                echo "<b>Upazila :- </b>".$scouts_upazila[$_GET['upazila']].',';
                            }

                            if (!empty($_GET['sgroup']) && isset($_GET['sgroup'])) {
                                echo "<b> Group :- </b>".$scouts_group[$_GET['sgroup']].',';
                            }

                            if (!empty($_GET['memberType']) && isset($_GET['memberType'])) {
                                echo "<b> Member Type :- </b>".$member_type[$_GET['memberType']].',';
                            }

                            if (!empty($_GET['scoutID']) && isset($_GET['scoutID'])) {
                                echo "<b> Scout ID :- </b>".$_GET['scoutID'].',';
                            }

                            if (!empty($_GET['name']) && isset($_GET['name'])) {
                                echo "<b> Name :- </b>".$_GET['name'].',';
                            }

                            if (!empty($_GET['username']) && isset($_GET['username'])) {
                                echo "<b> Username :- </b>".$_GET['username'].',';
                            }

                            if (!empty($_GET['gender']) && isset($_GET['gender'])) {
                                echo "<b> Gender :- </b>".$_GET['gender'].',';
                            }

                            if (!empty($_GET['section']) && isset($_GET['section'])) {
                                echo "<b> Section :- </b>".$scout_section[$_GET['section']].',';
                            }
                        ?>
                  </div>
                    <?php 
                }
                /*****************Filter check End*********************/
                ?>
              <br>
                <?php $this->load->view('search_view')?>
               <?php //$this->load->view('search_view')?>
               <a href="<?=base_url('Activity_logs/activity_logs_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>

               <?php if($results) { ?>
               <table class="table table-hover dataTable table-condensed" id="example">
                 <thead>
                   <tr>
                     <th width="5%"> SL </th>
                     <th width="20%"> DATETIME </th>
                     <th width="15%">User</th>
                     <th width="25%">Name</th>
                     <th width="35%">Message</th>
                     <th class="text-center" width="20%">Activity Type</th>
                     <!-- <th width="10%">Action</th> -->
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
                  
                    
                  <!-- <td align="right">
                         <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                          <ul class="dropdown-menu pull-right">
                           <li><a href="<?=base_url("scouts_member/details/".encrypt_url($row->id))?>" target="_blank">Details Scouts Member</a></li>
                           <li><a href="<?=base_url("scouts_member/edit/".encrypt_url($row->id))?>" target="_blank">Update Scouts Member</a></li>
                           <li><a href="<?=base_url("scouts_member/archive/".encrypt_url($row->id))?>" onclick="return confirm('Are you sure you want to archive this scouts member?');">Archive Scouts Member</a></li>
                           <li class="divider"></li>
                           <li><a href="<?=base_url("scouts_member/delete/".encrypt_url($row->id))?>" onclick="return confirm('Be careful! are you sure you want to delete this user?');">Member Delete Request</a></li>
                        </ul>
                     </div>
                  </td>  -->
               </tr>
            <?php endforeach;?>                      
         </tbody>
      </table>
      <div class="row">
         <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Total Log </span></div>
         <div class="col-sm-8 col-md-8 text-right">
           <?php echo $pagination['links']; ?>
        </div>
     </div>

     <?php }else{ ?>

     <div class="alert alert-block alert-error fade in">
      <h4 class="alert-heading"><i class="icon-warning-sign"></i>No data found!</h4>
   </div>

   <?php } ?>

</div>
</div>
</div>
</div>

</div> <!-- END ROW -->

</div>