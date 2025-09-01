<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"> <?=$module_name?> </a></li>
         <li> <?=$meta_title;?> </li>
      </ul>

      <div class="row-fluid">
         <div class="span12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <?php //if($this->ion_auth->is_admin()){ ?>
                     <a href="<?=base_url('appointment/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Appointment</a>
                     <?php //} ?>
                  </div>
               </div>
               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <table class="table table-hover table-condensed" id="example3">
                     <thead>
                        <tr>
                           <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin()){ ?>
                           <!-- <th style="width:1%"><div class="checkbox check-default" style="margin-right:auto;margin-left:auto;"> -->
                              <!-- <input type="checkbox" value="1" id="checkbox1"> -->
                              <!-- <label for="checkbox1"></label> -->
                           <!-- </div> -->
                           <!-- </th> -->
                           <?php } ?>
                           <th style="width:10px;">SL</th>
                           <th style="width:100px;">Schedule Type</th>
                           <th style="width:150px;">Start Datatime</th>
                           <th style="width:150px;">End Datatime</th>
                           <th style="">Duration</th>
                           <th style="">Name/Title</th>
                           <th style="width:30px; text-align: center;">Status PO</th>
                           <th style="width:30px; text-align: center;">Status PS</th>
                           <th style="width:40px; text-align: center;">Status Sec</th>
                           <th style="width:40px; text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;

                        // Schedule Type
                        if($row->schedule_type == 'Appointment') {
                           $type = '<span class="label label-info">Appointment</span>';
                        }else{
                           $type = '<span class="label label-inverse">Invitation</span>';
                        }

                        // Secretary status
                        if($row->status == 1) {
                           $status = '<span class="label label-success">Approved</span>';
                        }elseif($row->status == 2) {
                           $status = '<span class="label">Reject</span>';
                        }else{
                           $status = '<span class="label label-important">Pending</span>';
                        }

                        // PS status
                        if($row->status_ps == 1) {
                           $status_ps = '<span class="label label-success">Approved</span>';
                        }elseif($row->status_ps == 2) {
                           $status_ps = '<span class="label">Reject</span>';
                        }else{
                           $status_ps = '<span class="label label-important">Pending</span>';
                        }

                        // PO status
                        if($row->status_po == 1) {
                           $status_po = '<span class="label label-success">Approved</span>';
                        }elseif($row->status_po == 2) {
                           $status_po = '<span class="label">Reject</span>';
                        }else{
                           $status_po = '<span class="label label-important">Pending</span>';
                        }
                        ?>
                        <tr>
                           <!-- <td class="v-align-middle"><?=$sl.'.'?></td> -->
                           <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin()){ ?>                            
                           <!-- <td class="v-align-middle"><div class="checkbox check-default">
                              <input type="checkbox" value="<?=$row->id?>" id="checkbox<?=$row->id?>">
                              <label for="checkbox<?=$row->id?>"></label>
                           </div></td> -->
                           <td><?=$sl;?></td>
                           <?php } ?>

                           <td> <?=$type?></td>
                           <td class="v-align-middle"><?=date('d M, Y h:i A', strtotime($row->date)); ?></td>
                           <td> <?php 
                              if($row->date_end != NULL){ 
                                 echo date('d M, Y h:i A', strtotime($row->date_end)); 
                              }
                              ?>  
                           </td>
                           <td> 
                              <?php
                              if($row->date_end != NULL){ 
                                 $datetime1 = new DateTime($row->date);
                                 $datetime2 = new DateTime($row->date_end);
                                 $interval = $datetime1->diff($datetime2);
                                 // $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                                 $elapsed = $interval->format('%h:%i');
                                 echo $elapsed;
                              }
                              ?>
                           </td>
                           <td> <a href="<?=base_url("appointment/details/".encrypt_url($row->id))?>"><strong><?=$row->title?></strong></a> </td>
                           <td align="right"> <?=$status_po?> </td>
                           <td align="right"> <?=$status_ps?> </td>
                           <td align="right"> <?=$status?> </td>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><?=anchor("appointment/details/".encrypt_url($row->id), 'Details')?></li>  

                                    <?php if($this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin()){ ?>
                                    <li><?=anchor("appointment/approve/".encrypt_url($row->id), 'Approve App.')?></li>
                                    <li><?=anchor("appointment/reject/".encrypt_url($row->id), 'Reject App.')?></li>                                    
                                    <?php } ?>

                                    <li><?=anchor("appointment/update/".encrypt_url($row->id), 'Update')?></li>
                                    <?php 
                                    if($row->status != 1){
                                    if($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin()){ ?>
                                    <li><?=anchor("appointment/delete/".encrypt_url($row->id), 'Delete', 'onclick="return confirm(\'Be careful! Are you sure you want to delete this appointment?\');"')?></li>
                                    <?php } } ?>
                                 </ul>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach;?> 
                  </tbody>

               </table>
            </div>
         </div>
      </div>
   </div>

</div>

</div> <!-- END Content -->

</div>