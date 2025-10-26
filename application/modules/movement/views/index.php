<style>
   .grid.simple .grid-body {
      height: 70vh;
   }
</style>

<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <?=$module_title?> </li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('movement/record')?>" class="btn btn-info btn-xs btn-mini"> Create New</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                  <table class="table table-striped table-bordered table-hover" id="example2">
                     <thead>
                        <tr>
                           <th>SL.</th>
                           <th>Asset Name</th>
                           <th>Movement Date</th>
                           <th>From Location</th>
                           <th>To Location</th>
                           <th>From Custodian</th>
                           <th>To Custodian</th>
                           <th>Status</th>
                           <th>Notes</th>
                           <th>Recorded By</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if ($results): ?>
                           <?php foreach ($results as $key => $row): ?>
                              <?php
                                 if ($row->status == 0) {
                                    $status = "<span class='label label-default'> Draft </span>";
                                 } elseif ($row->status == 1) {
                                    $status = "<span class='label label-warning'> On Process </span>";
                                 } elseif ($row->status == 2) {
                                    $status = "<span class='label label-success'> Approved </span>";
                                 } else {
                                    $status = "<span class='label label-danger'> Delete </span>";
                                 }
                              ?>
                              <tr>
                                 <td><?=$key+1?></td>
                                 <td><?=$row->item_name?></td>
                                 <td><?=$row->movement_date?></td>
                                 <td><?=$row->from_location?></td>
                                 <td><?=$row->to_location?></td>
                                 <td><?=$row->from_custodian_fname . ' ' . $row->from_custodian_lname?></td>
                                 <td><?=$row->to_custodian_fname . ' ' . $row->to_custodian_lname?></td>
                                 <td><?=$status?></td>
                                 <td><?=$row->notes?></td>
                                 <td><?=$row->created_by_fname . ' ' . $row->created_by_lname?></td>
                                 <td>
                                    <div class="btn-group">
                                       <button type="button" class="btn btn-primary btn-xs btn-mini dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span>
                                       </button>
                                       <ul class="dropdown-menu pull-right">
                                          <?php if ($row->status == 0){ ?>
                                             <li><a href="<?=base_url('movement/forward/1/'.encrypt_url($row->id))?>"> Forward </a></li>
                                          <?php } elseif ($row->status == 1){ ?>
                                             <li><a href="<?=base_url('movement/forward/1/'.encrypt_url($row->id))?>"> Forward </a></li>
                                             <li><a href="<?=base_url('movement/forward/4/'.encrypt_url($row->id))?>"> Backward </a></li>
                                             <li><a href="<?=base_url('movement/forward/2/'.encrypt_url($row->id))?>"> Approved </a></li>
                                             <li><a href="<?=base_url('movement/forward/3/'.encrypt_url($row->id))?>"> Reject </a></li>
                                          <?php } ?>
                                       </ul>
                                    </div>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                        <?php else: ?>
                           <tr>
                              <td colspan="8">No asset movements found.</td>
                           </tr>
                        <?php endif; ?>
                     </tbody>
                  </table>

               </div>  <!-- END GRID BODY -->
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>

<!-- <script type="text/javascript">
   $(document).ready(function() {
      $('#example2').DataTable();
   });
</script> -->
