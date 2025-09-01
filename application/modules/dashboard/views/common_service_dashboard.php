<div class="page-content">
  <div class="content">
    <div class="page-title"> </div>    
    <div class="row">  
      <div class="col-md-12" style="color: black;">
        <h3>Welcome, <strong><?php echo $this->session->userdata('first_name')?></strong></h3>
        <!-- <h2 class="text-center"> <strong>Digital Work Schedule Management System</strong></h2> -->

        <div class="row">

          <div class="col-md-12">
            <div class="grid-body">
              <table class="table table-hover table-condensed" border="0">
                <thead>
                  <tr>
                    <th style="width:10px;"> SL </th>
                    <th style="width:200px;">Title</th>
                    <th style="width:100px;">Created</th>
                    <th style="width:100px;">Updated</th>
                    <th style="width:50px;">Status</th>
                    <th style="width:40px; text-align: right;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sl=$pagination['current_page'];
                  foreach ($results as $row):
                    $sl++;

                  if($row->status == 2) {
                    $status = '<span class="label label-success">Approved</span>';
                  }elseif($row->status == 3) {
                    $status = '<span class="label">Rejected</span>';
                  }else{
                    $status = '<span class="label label-important">Pending</span>';
                  }
                  ?>
                  <tr>
                    <td class="v-align-middle"><?=$sl.'.'?></td>
                    <td class="v-align-middle"><?=$row->title; ?></td>
                    <td class="v-align-middle"><?=date('d M, Y h:i A', strtotime($row->created));?></td>
                    <td class="v-align-middle"><?=date('d M, Y h:i A', strtotime($row->updated));?></td>
                    <td> <?=$status?></td>
                    <td align="right">
                      <?=anchor("requisition/change_status/".encrypt_url($row->id), 'Approval Status', array('class' => 'btn btn-blueviolet btn-mini'))?>
                      <?=anchor("requisition/details/".encrypt_url($row->id), 'Details', array('class' => 'btn btn-primary btn-mini'))?>
                    </td>
                  </tr>
                <?php endforeach;?>                      
              </tbody>
            </table>
          </div>
        </div>

      </div> <!-- /row -->

    </div>
  </div>
</div>
</div>