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
                     <a href="<?=base_url('items')?>" class="btn btn-blueviolet btn-xs btn-mini"> Items List</a>
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
                           <th>Asset Name</th>
                           <th>Movement Date</th>
                           <th>From Location</th>
                           <th>To Location</th>
                           <th>From Custodian</th>
                           <th>To Custodian</th>
                           <th>Notes</th>
                           <th>Recorded By</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if ($results): ?>
                           <?php foreach ($results as $row): ?>
                              <tr>
                                 <td><?=$row->item_name?></td>
                                 <td><?=$row->movement_date?></td>
                                 <td><?=$row->from_location?></td>
                                 <td><?=$row->to_location?></td>
                                 <td><?=$row->from_custodian_fname . ' ' . $row->from_custodian_lname?></td>
                                 <td><?=$row->to_custodian_fname . ' ' . $row->to_custodian_lname?></td>
                                 <td><?=$row->notes?></td>
                                 <td><?=$row->created_by_fname . ' ' . $row->created_by_lname?></td>
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

<script type="text/javascript">
   $(document).ready(function() {
      $('#example2').DataTable();
   });
</script>