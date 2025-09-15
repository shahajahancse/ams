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
                <a href="<?=base_url('general_setting/locker_setup_add')?>" class="btn btn-info btn-xs btn-mini"> Add New </a>
              </div>
            <?php } ?>
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

            <table class="table table-hover table-bordered  table-flip-scroll cf" id="">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th class="text-center">Name bangla</th>
                  <th class="text-center">Name English</th>
                  <th class="text-center">Room</th>
                  <th class="text-center">Branch</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $sl = 0; foreach ($results as $row): $sl++; ?>
                  <tr>
                    <td class="text-center" style = "vertical-align:middle" ><?=$sl.'.'?></td>
                    <td class="text-center" style = "vertical-align:middle" ><?=$row->name_bn?></td>
                    <td class="text-center" style = "vertical-align:middle" ><?=$row->name_en?></td>
                    <td class="text-center" style = "vertical-align:middle" ><?=$row->room ?></td>
                    <td class="text-center" style = "vertical-align:middle" ><?=$row->unit ?></td>
                    <td class="text-center" style = "vertical-align:middle" ><span class="badge <?php echo $row->status == 1? 'badge-success':'badge-danger' ?>"><?php echo $row->status == 1? 'Active':'Inactive' ?></span></td>
                    <td class="text-center">
                      <a href="<?php echo site_url('general_setting/locker_setup_edit/'.$row->id) ?>" class="btn btn-mini btn-primary"><i class="fa fa-pencil"></i></a>
                      <a href="<?php echo site_url('general_setting/locker_setup_delete/'.$row->id) ?>" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i></a>
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
