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
              <a href="<?=base_url('general_setting/item_unit_add')?>" class="btn btn-info btn-xs btn-mini"> Add New </a>
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
            
            <table class="table table-hover table-bordered dataTable  table-flip-scroll cf" id="">
              <thead>
                <tr>
                  <th style="width:10%"> SL </th>
                  <th style="width:50%">Unit Name</th>
                  <th style="width:18%">Status</th>
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
                  <td class="v-align-middle"><?=$row->unit_name?></td>
                  <td><span class="badge <?= ($row->status=='Enable') ? 'badge-success':'badge-danger'?>"><?=($row->status == 'Enable') ? 'Active':'Inactive'?></span></td>
                  <td>
                    <a class="btn btn-mini btn-primary" href="<?=base_url()?>general_setting/item_unit_edit/<?=$row->id?>"><i class="fa fa-pencil"></i> </a>&nbsp;
                    <a class="btn btn-mini btn-danger" href="<?=base_url()?>general_setting/item_unit_delete/<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this Unit?')"><i class="fa fa-trash-o"></i> </a>
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