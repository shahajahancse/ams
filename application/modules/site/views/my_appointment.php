<div class="container w-75">
	<div class="secondary_sc_content">
      <p class="lead font-weight-bold py-2 text-white" style="background-color: #1aa326; padding-left:10px"><?=$meta_title?></p>
      <div class="container">
         <div class="row">

            <div class="col-md-12">
               <div id="infoMessage"><?php echo $message;?></div>
               <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                     <?=$this->session->flashdata('success');;?>
                  </div>
               <?php endif; ?>
            </div>

            <div class="col-md-12">
               <table class="table table-striped table-condensed">
                  <thead>
                     <tr>
                        <th>SL</th>
                        <th>Type</th>
                        <th>Datetime</th>
                        <th>Title</th> 
                        <th>Purpose</th>                        
                        <th>Status</th>                                          
                     </tr>
                  </thead>   
                  <tbody>
                     <?php 
                     $sl=0;
                     foreach ($results as $row):
                        $sl++;

                     if($row->schedule_type == 'Appointment') {
                        $type = '<span class="badge badge-pill badge-primary">Appointment</span>';
                     }else{
                        $type = '<span class="badge-info">Invitation</span>';
                     }

                     if($row->status == 1) {
                        $status = '<span class="badge badge-success">Approved</span>';
                     }elseif($row->status == 2) {
                        $status = '<span class="badge badge-danger">Rejected</span>';
                     }else{
                        $status = '<span class="badge badge-warning">Pending</span>';
                     }
                     ?>
                     <tr>
                        <td><?=$sl.'.'?></td>
                        <td><?=$type?></td>
                        <td><?=date('d M, Y h:i A', strtotime($row->date)); ?></td>
                        <td><a href="<?=base_url('appointment-details/'.encrypt_url($row->id))?>"><strong><?=$row->title?></strong></a></td>
                        <td><?=$row->purpose?></td>
                        <td><?=$status?></td>
                     </tr>
                  <?php endforeach;?>   
               </tbody>
            </table>
         </div>

      </div> <!-- /row -->
   </div> <!-- /container -->

</div>
</div>