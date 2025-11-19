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
              <a href="<?=base_url('general_setting/sub_category_add')?>" class="btn btn-info btn-xs btn-mini"> Add Sub Category </a>
            </div>
          </div>

          <div class="grid-body ">
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                  <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('error')):?>
              <div class="alert alert-error">
                <?php echo $this->session->flashdata('error');?>
              </div>
            <?php endif; ?>

            <table class="table table-hover table-bordered  table-flip-scroll cf" id="usersTable">
              <thead >
                <tr >
                  <th class="text-center"> SL </th>
                  <th class="text-center">Category Name</th>
                  <th class="text-center">Sub Category Name</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Action</th>
                </tr> 
              </thead>
              <tbody>
              <?php
                $sl = 0;
                foreach ($results as $row):
                  $sl++;

                  if($row->status == 1){
                     $status = '<span class="badge badge-success">Enable</span>';
                  }else{
                     $status = '<span class="badge badge-danger">Disable</span>';
                  }
              ?>
                <tr>
                  <td class="text-center"><?= $sl.'.'?></td>
                  <td class="text-center"><?= $row->category_name?></td>
                  <td class="text-center"><?= $row->sub_cate_name?></td>
                  <td class="text-center"><?= $status?></td>
                  <td>
                    <a class="btn btn-mini btn-primary" href="<?=base_url()?>general_setting/sub_category_edit/<?=$row->id?>"> <i class="fa fa-edit"></i></a>
                    <a class="btn btn-mini btn-danger" href="<?=base_url()?>general_setting/sub_category_delete/<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this Sub Category?');"> <i class="fa fa-trash-o"></i> </a>
                  </td>
                <?php endforeach;?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>

   
  </div>
</div>
