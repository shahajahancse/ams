<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> Branch Type</li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/branch_type_add')?>" class="btn btn-info btn-xs btn-mini"> Create </a>
            </div>
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>
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

            <table class="table table-hover table-bordered  table-flip-scroll cf" id="usersTable">
              <thead>
                <tr>
                  <th class="text-center"> SL </th>
                  <th class="text-center">Name bangla</th>
                  <th class="text-center">Name English</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $sl = 0; foreach ($results as $row): $sl++; ?>
                  <tr>
                    <td class="text-center" style="vertical-align:middle"><?=$sl.'.'?></td>
                    <td class="text-center" style="vertical-align:middle"><?=$row->name_bn?></td>
                    <td class="text-center" style="vertical-align:middle"><?=$row->name_en?></td>
                    <td class="text-center" style="vertical-align:middle">
                      <?php if($row->status == 1): ?>
                          <span class="badge badge-success">Active</span>
                      <?php else: ?>
                          <span class="badge badge-danger">Inactive</span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                      <a href="<?=base_url('general_setting/branch_type_edit/'.$row->id)?>" class="btn btn-mini btn-primary"><i class="fa fa-pencil"></i> </a>
                      <a href="<?=base_url('general_setting/branch_type_delete/'.$row->id) ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure you want to delete this Division Type?')"><i class="fa fa-trash-o"></i> </a>
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
