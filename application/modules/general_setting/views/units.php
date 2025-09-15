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
            <div class="pull-right">
              <a href="<?=base_url('general_setting/unit_add')?>" class="btn btn-info btn-xs btn-mini"> Create </a>
            </div>
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')):?>
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('error');?>
                </div>
            <?php endif; ?>

            <table class="table table-hover table-bordered  table-flip-scroll cf" id="usersTable">
              <thead>
                <tr>
                  <th style="vertical-align:middle;text-align:left" width="25px"> SL </th>
                  <th style="vertical-align:middle;text-align:center">Name(BN)</th>
                  <th style="vertical-align:middle;text-align:center">Name(EN)</th>
                  <th style="vertical-align:middle;text-align:center">Type</th>
                  <th style="vertical-align:middle;text-align:center">Address</th>
                  <th style="vertical-align:middle;text-align:center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $sl = 0; foreach ($results as $row): $sl++; ?>
                  <?php
                    if ($row->type == 1) {
                      $row->type = 'Director Office';
                    } elseif ($row->type == 2) {
                      $row->type = 'Provider Office';
                    } elseif ($row->type == 3) {
                      $row->type = 'General Office';
                    }
                  ?>
                  <tr>
                    <td style="vertical-align:middle; text-align:center"><?=$sl.'.'?></td>
                    <td style="vertical-align:middle; text-align:center"><?=$row->name_bn?></td>
                    <td style="vertical-align:middle; text-align:center"><?=$row->name_en?></td>
                    <td style="vertical-align:middle; text-align:center"><?=$row->type?></td>
                    <td style="vertical-align:middle; text-align:center"><?=$row->address_bn?></td>
                    <td style="vertical-align:middle; text-align:center" width="100px">
                      <a href="<?=base_url('general_setting/unit_edit/'.$row->id)?>" class="btn btn-mini btn-primary"><i class="fa fa-edit"></i></a>
                      <a href="<?=base_url('general_setting/unit_delete/'.$row->id)?>" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i></a>
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
