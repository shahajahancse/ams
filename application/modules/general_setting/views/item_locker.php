<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> General Setting</li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <?php if ($this->ion_auth->in_group(array('admin'))) {  ?>
              <div class="pull-right">
                <a href="<?=base_url('general_setting/item_locker_add')?>" class="btn btn-info btn-xs btn-mini"> Add New </a>
              </div>
            <?php } ?>
          </div>

          <div class="grid-body ">
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert"></a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')):?>
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert"></a>
                    <?php echo $this->session->flashdata('error');?>
                </div>
            <?php endif; ?>

            <table class="table table-hover table-bordered  table-flip-scroll cf" id="">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th class="text-center">Category Name</th>
                  <th class="text-center">Sub Category Name</th>
                  <th class="text-center">Item Name</th>
                  <th class="text-center">Locker</th>
                  <th class="text-center">Room</th>
                  <th class="text-center">Branch</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $sl = 0; foreach ($results as $row): $sl++; ?>
                  <tr>
                    <td class="text-center" style= "vertical-align:middle" ><?=$sl.'.'?></td>
                    <td class="text-center" style= "vertical-align:middle" ><?=$row->category_name?></td>
                    <td class="text-center" style= "vertical-align:middle" ><?=$row->sub_cate_name?></td>
                    <td class="text-center" style= "vertical-align:middle" ><?=$row->item_name?></td>
                    <td class="text-center" style= "vertical-align:middle" ><?=$row->name_en?></td>
                    <td class="text-center" style= "vertical-align:middle" ><?=$row->room?></td>
                    <td class="text-center" style= "vertical-align:middle" ><?=$row->unit?></td>
                    <td class="text-center" style= "vertical-align:middle" >
                      <?php if($row->status == 1): ?>
                      <span class="badge badge-success">Active</span>
                      <?php else: ?>
                      <span class="badge badge-danger">Inactive</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a>
                        <?php echo anchor(base_url()."general_setting/item_locker_edit/".$row->id, '<i class="fa fa-pencil"></i> ', array('class' => 'btn btn-mini btn-primary')) ;?>
                      </a>
                      <a>
                        <?php echo anchor(base_url()."general_setting/item_locker_delete/".$row->id, '<i class="fa fa-trash-o"></i> ', array('class' => 'btn btn-mini btn-danger')) ;?>
                      </a>
                    </td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    </div> <!-- END ROW -->
  </div>
</div>
