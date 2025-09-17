<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('general_setting')?>" class="active"> General Setting </a> </li>
         <li><?=$meta_title; ?></li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('general_setting/asset_floors_add')?>" class="btn btn-info btn-xs btn-mini"> Add Asset Floor </a>
                  </div>
               </div>
               <div class="grid-body">
                  <?php if($this->session->flashdata('success')) :?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-bordered" id="usersTable">
                     <thead >
                        <tr >
                           <th class="text-center" style="vertical-align:middle" >SL</th>
                           <th class="text-center" style="vertical-align:middle" >Floor Name</th>
                           <th class="text-center" style="vertical-align:middle" >Branch</th>
                           <th class="text-center" style="vertical-align:middle" >Status</th>
                           <th class="text-center" style="vertical-align:middle" >Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($results as $key => $row) : ?>
                           <tr>
                              <td class="text-center" style="vertical-align:middle"><?=$key+1?></td>
                              <td class="text-center" style="vertical-align:middle"><?=$row->floor_name?></td>
                              <td class="text-center" style="vertical-align:middle">
                                 <?php
                                 $branch_info = $this->General_setting_model->get_info('branches', $row->unit_id);
                                 echo $branch_info ? $branch_info->name_en : 'N/A';
                                 ?>
                              </td>
                              <td class="text-center" style="vertical-align:middle">
                                 <?php if($row->status == 1){ ?>
                                    <span class="badge badge-success">Active</span>
                                 <?php }else{ ?>
                                    <span class="badge badge-important">Inactive</span>
                                 <?php } ?>
                              </td>
                              <td class="text-center" style="vertical-align:middle">
                                 <?php echo anchor(base_url()."general_setting/asset_floors_edit/".$row->id, '<i class="fa fa-pencil"></i>', 'class="btn btn-mini btn-primary"') ;?>&nbsp;
                                 <a class="btn btn-mini btn-danger" href="<?=base_url()?>general_setting/asset_floors_delete/<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this Asset Floor?');"><i class="fa fa-trash-o"></i></a>
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