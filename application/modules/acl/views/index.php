<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('acl')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal">
          <div class="grid-title" style="border: 3px solid #dddddd; border-bottom: 0px;">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a target="_blank" href="<?=base_url('acl/acl_excel')?>" class="btn btn-info btn-xs btn-mini"> Excel </a>
              <a href="<?=base_url('acl/create_user')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create User </a>
            </div>
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php echo $message;?></div>

            <table class="table table-hover table-bordered dataTable  table-flip-scroll cf">
              <thead class="cf">
                <tr>
                  <th>SL</th>
                  <th>Full Name</th>
                  <th>Branch</th>
                  <th>Username</th>
                  <th>Department</th>
                  <th>Designation</th>
                  <th>Status</th>
                  <th>Group</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php $sl = $pagination['current_page'];
              foreach ($users as $user): $sl++; ?>
                <tr>
                  <td><?=$sl.'.'?></td>
                  <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                  <td><?php echo $user->name_en;?></td>
                  <td><?php echo $user->username;?></td>
                  <td><?php echo $user->dept_name;?></td>
                  <td><?php echo $user->desig_name;?></td>
                  <td>
                    <?php
                    echo ($user->active) ? anchor("acl/deactivate/".$user->id, strtoupper(lang('index_active_link')), array('class' => 'label label-success')) : anchor("acl/activate/". $user->id, strtoupper(lang('index_inactive_link')), array('class' => 'label label-important'));
                    ?>
                  </td>
                  <td>
                    <?php
                    foreach ($user->groups as $group):
                      echo '<span class="btn btn-primary btn-xs btn-mini" style="background-color:#6b64d0;margin-bottom:1px;">'.htmlspecialchars($group->name,ENT_QUOTES,'UTF-8').'</span>';
                    echo '&nbsp;';
                    endforeach;
                    ?>
                  </td>
                  <td><?php echo anchor("acl/edit_user/".$user->id, 'Edit','class="btn btn-mini btn-primary"') ;?></td>
                </tr>
              <?php endforeach;?>
            </table>
            <div class="row">
              <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Users </span></div>
              <div class="col-sm-8 col-md-8 text-right">
                <?php echo $pagination['links']; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- END ROW -->
</div>
