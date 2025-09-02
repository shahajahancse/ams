<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
         <div class="row page-titles">
            <div class="col-md-5 align-self-center">
               <h3 class="text-themecolor"><?=$module_title?></h3>
            </div>
            <div class="col-md-7 align-self-center">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                  <li class="breadcrumb-item active"><?=$module_title?></li>
               </ol>
            </div>
         </div>
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card card-outline-info">
                     <div class="card-header">
                        <h4 class="m-b-0 text-white">Asset Movement History</h4>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive ">
                           <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                 <tr>
                                    <th>Asset Name</th>
                                    <th>Transfer Date</th>
                                    <th>From Branch</th>
                                    <th>From Department</th>
                                    <th>To Branch</th>
                                    <th>To Department</th>
                                    <th>Transferred By</th>
                                    <th>Notes</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php if (!empty($results)): ?>
                                 <?php foreach ($results as $row): ?>
                                 <tr>
                                    <td><?=$row->item_name?></td>
                                    <td><?=$row->transfer_date?></td>
                                    <td><?=$row->from_branch_name?></td>
                                    <td><?=$row->from_department_name?></td>
                                    <td><?=$row->to_branch_name?></td>
                                    <td><?=$row->to_department_name?></td>
                                    <td><?=$row->first_name?> <?=$row->last_name?></td>
                                    <td><?=$row->notes?></td>
                                 </tr>
                                 <?php endforeach; ?>
                                 <?php else: ?>
                                 <tr>
                                    <td colspan="8">No asset movements found.</td>
                                 </tr>
                                 <?php endif; ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php $this->load->view('backend/footer'); ?>
         <script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
         <script src="<?=base_url()?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
         <script>
            $(document).ready(function() {
                $('#example23').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            });
         </script>