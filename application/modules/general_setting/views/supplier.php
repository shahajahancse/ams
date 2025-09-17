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
              <a href="<?=base_url('general_setting/supplier_add')?>" class="btn btn-info btn-xs btn-mini"> Add New </a>
            </div>            
          </div>

          <div class="grid-body ">          
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
                  <th class="text-center"> SL </th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Phone</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Address</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody class="text-center" >
              <?php 
                $sl = 0;
                foreach ($results as $row):
                  $sl++;
              ?>
                <tr>
                  <td style="vertical-align:middle"><?=$sl.'.'?></td>
                  <td style="vertical-align:middle"><?=$row->name?></td>
                  <td style="vertical-align:middle"><?=$row->phone?></td>
                  <td style="vertical-align:middle"><?=$row->email?></td>
                  <td style="vertical-align:middle"><?=$row->address?></td>
                  <td style="vertical-align:middle"><span class="badge <?= ($row->status==1) ? 'badge-success':'badge-danger'?>"><?=($row->status==1) ? 'Active':'Inactive'?></span></td>
                  <td style="vertical-align:middle">
                    <a href="<?=base_url()?>general_setting/supplier_edit/<?=$row->id?>" class="btn btn-mini btn-primary"><i class="fa fa-pencil"></i> </a>
                    <a class="btn btn-mini btn-danger" href="<?=base_url()?>general_setting/supplier_delete/<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this Supplier?');"><i class="fa fa-trash-o"></i> </a>
                  </td>
                <?php endforeach;?>                      
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>

  </div>
