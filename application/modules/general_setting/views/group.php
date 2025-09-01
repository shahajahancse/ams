<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> General Setting</li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/group_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add group </a>
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
            <table class="table table-hover table-bordered table-flip-scroll cf" id="">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:60%">Group Name</th>
                  <th style="width:60%">Group Pawer</th>
                  <th style="width:20%">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $sl = 0;
                foreach ($results as $row):
                  $sl++;
              ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$row->name?></td>
                  <td class="v-align-middle" style="display: flex;flex-wrap: wrap;gap: 3px;">

                    <?php
                      $pw = explode(',',$row->pw);
                      $permission = explode(',',$row->permission)

                    ?>
                      <?php
                      if(in_array(1, $permission)){
                        echo '<span class="btn btn-primary btn-xs btn-mini">Create</span> &nbsp';
                      }
                      if(in_array(2, $permission)){
                        echo '<span class="btn btn-success btn-xs btn-mini">Approve</span>  &nbsp';
                      }
                      if(in_array(3, $permission)){
                        echo '<span class="btn btn-danger btn-xs btn-mini">Reject</span> &nbsp';
                      }
                      if(in_array(4, $permission)){
                        echo '<span class="btn btn-warning btn-xs btn-mini">Delivery</span>  &nbsp';
                      }
                      if(in_array(5, $permission)){
                        echo '<span class="btn btn-warning btn-xs btn-mini">View Report</span>  &nbsp';
                      }
                      if(in_array(6, $permission)){
                        echo '<span class="btn btn-warning btn-xs btn-mini">Show All Data</span>  &nbsp';
                      }
                    ?>
                    <?php
                      foreach ($pw as $key => $value) {
                        $this->db->where('id', $value);
                        $query = $this->db->get('groups')->row();
                        if ($query) {
                          echo '<span class="btn btn-primary btn-xs btn-mini">Pass To '.$query->name.'</span>  &nbsp';
                        }
                      }
                    ?>
                  </td>
                  <td><?php echo anchor(base_url()."general_setting/group_edit/".$row->id, 'Edit', 'class="btn btn-mini btn-primary"') ;?></td>
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
