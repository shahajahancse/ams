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
              <a href="<?=base_url('acl/create_permission')?>" class="btn btn-info btn-xs btn-mini"> Create Permission</a>
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
                    <th>Name</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Remarks</th>
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
                      <td><?php echo $row->name;?></td>
                      <td><?php echo $row->type;?></td>
                      <td><?php echo ($row->status == 1) ? 'Active' : 'Inactive';?></td>
                      <td><?php echo $row->remarks;?></td>
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
