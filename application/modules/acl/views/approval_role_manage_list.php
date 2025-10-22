<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('acl')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('acl/create_approval_role_manage')?>" class="btn btn-info btn-xs btn-mini"> Create Approval Role Manage</a>
            </div>
          </div>

          <div class="grid-body ">
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>

            <table class="table table-hover table-bordered dataTable table-flip-scroll cf">
                <thead class="cf">
                  <tr>
                    <th>SL</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>FB Type</th>
                    <th>Type</th>
                    <th>User SL</th>
                    <th>Access Forward</th>
                    <th>Access Backward</th>
                    <th width="150">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sl = 0;
                  foreach ($results as $row):
                    $sl++;
                ?>
                    <tr>
                      <td><?=$sl.'.'?></td>
                      <td><?php echo $row->first_name;?></td>
                      <td><?php echo $row->role_name;?></td>
                      <td><?php echo $row->fb_type_name;?></td>
                      <td><?php echo $row->type;?></td>
                      <td><?php echo $row->user_ordering;?></td>
                      <td><?php echo $row->access_forward;?></td>
                      <td><?php echo $row->access_backward;?></td>
                      <td><?php echo anchor("acl/edit_approval_role_manage/".$row->id, 'Edit','class="btn btn-mini btn-primary"') ;?>&nbsp;<?php echo anchor("acl/delete_approval_role_manage/".$row->id, 'Delete','class="btn btn-mini btn-danger" onclick="return confirm(\'Are you sure you want to delete this?\')"') ;?></td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
            </table>
            <div>
              <?=$pagination?>
            </div>
          </div>

        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>
