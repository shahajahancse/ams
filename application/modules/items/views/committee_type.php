<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
      <li> General Setting </li>
      <li> <?=$meta_title?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('general_setting/committee_type_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Committee Type </a>
            </div>            
          </div>

          <div class="grid-body ">
            <?php if($this->session->flashdata('success')):?>
              <div class="alert alert-success">
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php endif; ?>
            
            <table class="table table-hover table-bordered  table-flip-scroll cf" id="">
              <thead>
                <tr>
                  <th style="width:2%"> SL </th>
                  <th style="width:15%">Scouts Office Name</th>
                  <th style="width:20%">Committee Type Name</th>
                  <th style="width:10%">Status</th>
                  <th style="width:10%">Action</th>
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
                  <td class="v-align-middle"><?=$row->office_type_name?></td>
                  <td class="v-align-middle"><?=$row->committee_type_name?></td>
                  <td> <?php echo ($row->status) ?'<span class="btn btn-primary btn-xs btn-mini">Enable </span>': '<span class="btn btn-danger btn-xs btn-mini">Disable</span>';?> </td>
                  <td align="right">
                    <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                      <ul class="dropdown-menu pull-right">
                        <li><a href="<?=base_url("general_setting/committee_type_edit/".$row->id)?>">Update</a></li>
                      </ul>
                    </div>
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