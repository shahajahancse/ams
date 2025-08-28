<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb">
         <li><a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a></li>
         <li><a href="<?=base_url('appointment/list')?>" class="active"><?=$module_name?></a></li>
         <li><?=$meta_title; ?></li>
      </ul>
      <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; border: 0px solid red;}
         .tg td{font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#00000;background-color:#E0FFEB; vertical-align: middle;}
         .tg th{font-size:14px;font-weight:bold;padding:3px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#bce2c5;text-align: center;}
         .tg .tg-khup{background-color:#efefef;vertical-align:top; color: black; text-align: right; width: 150px;}
         .tg .tg-ywa9{background-color:#ffffff;vertical-align:top; color: black;}
      </style>          

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">                
                     <a href="<?=base_url('appointment')?>" class="btn btn-blueviolet btn-xs btn-mini"> Appointment List</a>  
                     <a href="<?=base_url('appointment/update/'.encrypt_url($info->id))?>" class="btn btn-blueviolet btn-xs btn-mini">Update</a>

                     <!-- <a href="<?=base_url('committee/pdf_national_committee/'.encrypt_url($info->id))?>" class="btn btn-success btn-mini" target="_blank"> Download PDF</a> -->
                     <!-- <a> <input class="btn btn-blueviolet btn-xs btn-mini" type="button" onclick="printDiv('printableArea')" value="Print" /></a>  -->
                  </div>
               </div>

               <div class="grid-body"  id="printableArea">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <?php
                  if($info->schedule_type == 'Appointment') {
                     $type = '<span class="label label-danger">Appointment</span>';
                  }else{
                     $type = '<span class="label label-warning">Invitation</span>';
                  }

                  // Stauts
                  if($info->status == 1) {
                     $status = '<span class="label label-success">Approved</span>';
                  }elseif($info->status == 2) {
                     $status = '<span class="label">Rejected</span>';
                  }else{
                     $status = '<span class="label label-important">Pending</span>';
                  }
                  ?>

                  <div class="row">
                     <div class="col-md-8">
                        <table class="tg" width="100%">
                           <caption>Schedule Info</caption>
                           <tr>
                              <th class="tg-khup"> Schedule Type</th>
                              <td class="tg-ywa9"><?=$type?></td>
                           </tr> 
                           <tr>
                              <th class="tg-khup"> S. Title / Event Name</th>
                              <td class="tg-ywa9"><?=$info->title?></td>
                           </tr> 
                           <tr>
                              <th class="tg-khup"> Start Datetime </th>
                              <td class="tg-ywa9"> <?=date('d M, Y h:i A', strtotime($info->date)); ?> </td> 
                           </tr> 
                           <tr>
                              <th class="tg-khup"> End Datetime </th>
                              <td class="tg-ywa9"> 
                                 <?php 
                                 if($info->date_end != NULL){ 
                                    echo date('d M, Y h:i A', strtotime($info->date_end)); 
                                 }
                                 ?>
                              </td> 
                           </tr>
                           <tr>
                              <th class="tg-khup"> Duration </th>
                              <td class="tg-ywa9">
                                 <?php
                                 $datetime1 = new DateTime($info->date);
                                 $datetime2 = new DateTime($info->date_end);
                                 $interval = $datetime1->diff($datetime2);
                                 // $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                                 $elapsed = $interval->format('%a days %h hours %i minutes %s seconds');
                                 echo $elapsed;
                                 ?>
                              </td>
                           </tr> 
                           <tr>
                              <th class="tg-khup"> Venue </th>
                              <td class="tg-ywa9"><?=$info->venue?></td>
                           </tr> 
                           <tr>
                              <th class="tg-khup"> Purpose </th>
                              <td class="tg-ywa9"><?=$info->purpose?></td>
                           </tr>   
                           <?php  if($info->schedule_type == 'Appointment') { ?>
                           <tr>
                              <th class="tg-khup"> Appointment Person List </th>
                              <td class="tg-ywa9" colspan="3">
                                 <table>
                                    <tr>
                                       <th>SL</th>
                                       <th>Name</th>
                                       <th>Designation</th>
                                       <th>Office/Address</th>
                                       <th>Mobile No</th>
                                    </tr>
                                    <?php 
                                    $sl=0;
                                    foreach($persons as $person){ 
                                       $sl++;
                                       ?>
                                       <tr>
                                          <td><?=$sl?></td>
                                          <td><?=$person->name?></td>
                                          <td><?=$person->designation?></td>
                                          <td><?=$person->office_address?></td>
                                          <td><?=$person->mobile_no?></td>
                                       </tr>
                                       <?php } ?>
                                    </table>
                                 </td>
                              </tr>
                              <?php } ?>

                              <?php  if($info->schedule_type == 'Invitation') { ?>
                              <tr>
                                 <th class="tg-khup"> Name of Chair </th>
                                 <td class="tg-ywa9" colspan="3"><?=$info->event_name_chair?></td>
                              </tr>
                              <tr>
                                 <th class="tg-khup"> Name Chief Guest </th>
                                 <td class="tg-ywa9" colspan="3"><?=$info->event_chief_guest?></td>
                              </tr>
                              <tr>
                                 <th class="tg-khup"> Name of Special Guest </th>
                                 <td class="tg-ywa9" colspan="3"><?=$info->event_special_guest?></td>
                              </tr>
                              <?php } ?>         
                        </table>
                     </div>

                     <div class="col-md-4">
                        <table class="tg" width="100%">
                           <caption>Person Info</caption>
                           <?php
                           if($info->author){
                              $name    = $info->first_name;
                              $mobile  = $info->phone;
                              $email   = $info->email;
                              $organization = $info->org_prof_name;
                           }else{
                              $name    = $info->person_name;
                              $mobile  = $info->person_mobile_no;
                              $email   = $info->person_email;
                              $organization = $info->organization;
                           }
                           ?>
                           <tr>
                              <th class="tg-khup"> Name </th>
                              <td class="tg-ywa9"><?=$name?></td>
                           </tr> 
                           <tr>
                              <th class="tg-khup"> Mobile No </th>
                              <td class="tg-ywa9"> <?=$mobile?></td> 
                           </tr> 
                           <tr>
                              <th class="tg-khup"> Email </th>
                              <td class="tg-ywa9"><?=$email?></td>
                           </tr> 
                           <tr>
                              <th class="tg-khup"> Organization </th>
                              <td class="tg-ywa9"><?=$organization?></td>
                           </tr>       
                        </table>
                     </div>

                     
                  </div>

               </div>  <!-- END GRID BODY -->              
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>