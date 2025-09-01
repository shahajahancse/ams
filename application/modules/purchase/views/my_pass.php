<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">     
   <div class="content">
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('my_appointment/my_pass')?>" class="active"> <?=$module_title; ?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal green">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('my_appointment/create_pass')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Pass </a>
                  </div>            
               </div>

               <div class="grid-body ">
                  <div id="infoMessage"><?php echo $message;?></div>   
                  <table class="table table-hover table-bordered table-flip-scroll cf">
                     <thead class="cf">
                        <tr>
                           <th width="15">SL</th>
                           <th width="200">Datetime</th>                           
                           <th>Host</th>
                           <th>Reason</th>
                           <th width="80">Status</th>
                           <th width="60">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $disable = '';
                        $sl = $pagination['current_page'];
                        foreach ($results as $row):
                           $sl++;
                        if($row->status == 1) {
                           $status = '<span class="label label-success">Approve</span>';
                        }elseif($row->status == 2) {
                           $status = '<span class="label">Reject</span>';
                        }elseif($row->status == 3) {
                           $status = '<span class="label">Complete</span>';
                        }elseif($row->status == 4) {
                           $status = '<span class="label">Cancel</span>';
                        }else{
                           $status = '<span class="label label-important">Pending</span>';
                        }

                        if($row->status == 3) {
                           $disable = 'disabled';
                        }else{
                           $disable = '';
                        }

                        $host = $row->host_name.' ('.$row->host_designation.')';
                        ?>
                        <tr>
                           <td><?=$sl.'.'?></td>
                           <td><?php echo date("F d, Y h:i A", strtotime($row->created));?></td>
                           <td><?php echo $host;?></td>
                           <td><?php echo $row->reason;?></td>
                           <td><?php echo $status;?></td>
                           <td align="right">
                              <a href="<?=base_url('my_appointment/cancelpass/'.encrypt_url($row->id))?>" class="btn btn-primary dropdown-toggle btn-mini <?=$disable?>"> Cancel Pass </a>
                           </td>
                        </tr>
                        <?php 
                        endforeach;
                        ?>
                     </tbody>
                  </table>

                  <div class="row">
                     <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Pass </span></div>
                     <div class="col-sm-8 col-md-8 text-right">
                        <?php echo $pagination['links']; ?>
                     </div>
                  </div>

               </div>

            </div>
         </div>
      </div>

   </div> <!-- /END ROW -->
</div> <!-- /page-content -->