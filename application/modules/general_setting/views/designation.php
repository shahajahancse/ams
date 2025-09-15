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
              <a href="<?=base_url('general_setting/designation_add')?>" class="btn btn-info btn-xs btn-mini"> Add New </a>
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
                  <th> SL </th>
                  <th>Designation Name</th>
                  <th>Status</th>
                  <th>Action</th>
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
                  <td class="v-align-middle"><?=$row->desig_name?></td>
                  <td class="v-align-middle">
                    <?php if($row->status==1): ?>
                    <span class="badge badge-success">Active</span>
                    <?php else: ?>
                    <span class="badge badge-danger">Inactive</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="<?=base_url()?>general_setting/designation_edit/<?=$row->id ?>" class="btn btn-mini btn-primary"><i class="fa fa-pencil"></i> </a>
                    <a class="btn btn-mini btn-danger" href="<?=base_url()?>general_setting/designation_delete/<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this Department?');"><i class="fa fa-trash-o"></i> </a>
                  </td>

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