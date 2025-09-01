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
              <a href="<?=base_url('scouts_setting/upazila_thana_add')?>" class="btn btn-primary btn-xs btn-mini"> Add Post Office </a>
              <a href="<?=base_url('scouts_setting/upazila_thana')?>" class="btn btn-success btn-xs btn-mini"> Post Office List</a>  
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
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:10%">District Name</th>
                  <th style="width:10%">Post Office Name</th>
                  <th style="width:10%">Post Code</th>
                  <th style="width:5%">Status</th>
                  <th style="width:5%">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $sl=0;
                foreach ($results as $row):
                  $sl++;
              ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$row->district_name?></td>
                  <td class="v-align-middle"><?=$row->po_name; ?></td>
                  <td> <?=$row->code?> </td>
                  <td> <?php echo ($row->status) ?'<span class="btn btn-primary btn-xs btn-mini">Enable </span>': '<span class="btn btn-danger btn-xs btn-mini">Disable</span>';?></td>
                  <td class="v-align-middle">
                    <div class="btn-group">
                      <button class="btn btn-mini btn-success">Action</button>
                      <button class="btn btn-mini btn-success dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                      <ul class="dropdown-menu">                        
                        <li><?php //echo anchor("manage_user/edit_user/".$user->id, 'Edit User') ;?></li>
                        <li class="divider"></li>
                        <li><a href="#">Delete</a></li>
                      </ul>
                    </div> 
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