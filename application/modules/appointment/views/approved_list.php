<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"> <?=$module_name?> </a></li>
         <li> <?=$meta_title;?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
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
                  <!-- <a href="<?=base_url('Committee/national_pdf')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a> -->
                  <table class="table table-hover table-condensed dataTable"  id="example3" border="0">
                     <thead>
                        <tr>
                           <th style="width:10px;"> SL </th>
                           <th style="width:120px;">Schedule Type</th>
                           <th style="width:170px;">Datatime</th>
                           <th style="">Name/Title</th>
                           <th style="">Venue</th>
                           <th style="width:100px;">Mobile No</th>
                           <th style="width:50px;">Status</th>
                           <th style="width:40px; text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=$pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;

                        if($row->schedule_type == 'Appointment') {
                           $type = '<span class="label label-info">Appointment</span>';
                        }else{
                           $type = '<span class="label label-inverse">Invitation</span>';
                        }

                        if($row->status == 1) {
                           $status = '<span class="label label-success">Approved</span>';
                        }elseif($row->status == 2) {
                           $status = '<span class="label">Rejected</span>';
                        }else{
                           $status = '<span class="label label-important">Pending</span>';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <?=$type?></td>
                           <td class="v-align-middle"><?=date('d M, Y h:i A', strtotime($row->date)); ?></td>
                           <td> <strong><?=$row->title?></strong> </td>
                           <td> <?=$row->venue?></td>
                           <td> <?=$row->mobile_no?></td>
                           <td> <?=$status?></td>
                           <td align="right">
                              <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li><?=anchor("appointment/details/".encrypt_url($row->id), 'Details')?></li>

                                    <?php if($this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin() || $this->ion_auth->is_po_admin()){ ?>
                                    <li><?=anchor("appointment/approve/".encrypt_url($row->id), 'Approve')?></li>
                                    <li><?=anchor("appointment/reject/".encrypt_url($row->id), 'Reject')?></li>
                                    <?php } ?>

                                    <li><?=anchor("appointment/update/".encrypt_url($row->id), 'Update')?></li>
                                    <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_sec_admin() || $this->ion_auth->is_ps_admin()){ ?>
                                    <!-- <li><?=anchor("appointment/delete/".encrypt_url($row->id), 'Delete', 'onclick="return confirm(\'Be careful! Are you sure you want to delete this appointment?\');"')?></li> -->
                                    <?php } ?>
                                 </ul>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach;?>                      
                  </tbody>
               </table>

               <div class="row">
                  <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Appointment </span></div>
                  <div class="col-sm-8 col-md-8 text-right">
                     <?php echo $pagination['links']; ?>
                  </div>
               </div>

            </div>

         </div>
      </div>
   </div>

</div> <!-- END Content -->

</div>