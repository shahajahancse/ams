<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('general_setting')?>" class="active"> General Setting </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal red">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('general_setting/asset_floors_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Asset Floor </a>
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')) :?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed" id="example">
                     <thead>
                        <tr>
                           <th style="width:1%">#</th>
                           <th style="width:20%">Floor Name</th>
                           <th style="width:20%">Branch</th>
                           <th style="width:10%">Status</th>
                           <th style="width:10%">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($results as $key => $row) : ?>
                           <tr>
                              <td><?=$key+1?></td>
                              <td><?=$row->floor_name?></td>
                              <td>
                                 <?php
                                 $branch_info = $this->General_setting_model->get_info('office_unit', $row->unit_id);
                                 echo $branch_info ? $branch_info->unit_name : 'N/A';
                                 ?>
                              </td>
                              <td>
                                 <?php if($row->status == 1){ ?>
                                    <span class="label label-success">Active</span>
                                 <?php }else{ ?>
                                    <span class="label label-important">Inactive</span>
                                 <?php } ?>
                              </td>
                              <td>
                                 <?php echo anchor(base_url()."general_setting/asset_floors_edit/".$row->id, 'Edit', 'class="btn btn-mini btn-primary"') ;?>&nbsp;
                                 <a class="btn btn-mini btn-primary" href="<?=base_url()?>general_setting/asset_floors_delete/<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this Asset Floor?');">Delete</a>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>