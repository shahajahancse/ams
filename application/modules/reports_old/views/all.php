<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> <?=lang('Dashboard')?> </a> </li>
      <li> <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="active"> <?php echo lang($this->uri->segment(1).'_list');?></a></li>
      <li><?=lang('Add New')?></li>
    </ul>

    <div class="row">
       <div class="col-md-12">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">
                <a href="<?=base_url($this->uri->segment(1).'/all')?>" class="btn btn-primary btn-xs btn-mini"> <?php echo lang($this->uri->segment(1).'_list');?></a>  
              </div>
             </div>
             <div class="grid-body">
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
                  <th>ক্রম</th>
                  <th>নাম</th> 
                  <th>ন্যাশনাল আইডি</th>                 
                  <th>জেলা</th>
                  <th>উপজেলা </th>
                  <th>বর্তমান পদবি</th>
                  <th>বর্তমান ঠিকানা</th>
                  <th width="170">
                    <?php echo 'Action'; ?>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sl=0;
                  if($all_list > 0) {
                    foreach ($all_list as $row) {  $sl++;?>
                    <tr>
                      <td> <?=$sl?> </td>
  										<?php foreach($printcolumn as $value) { ?>
  											<td> <?php  echo  $row[$value];  ?> </td>
  										<?php }?>
                      <td>
                          <div class="btn-group">
                            <button class="btn btn-mini btn-primary">Action</button>
                            <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> </button>
                            <ul class="dropdown-menu">
                              <li><a href="<?php echo base_url(); ?>trainers/add?data_id=<?php echo $row['id']; ?>"><i class="fa fa-pencil-square"></i> <?php echo lang('stu_clas_training_entry'); ?></a></li>

                              <li><a href="<?php echo base_url(); ?>personal_datas/details/<?php echo $row['id']; ?>"><i class="fa fa-user"></i> বিস্তারিত তথ্য </a></li>

                              <li><a href="<?php echo base_url(); ?>personal_datas/edit/<?php echo $row['id']; ?>"><i class="fa fa-pencil-square"></i> <?php echo lang('stu_clas_Edit'); ?> </a></li>
                              <li class="divider"></li>
                              <li><a href="<?php echo base_url(); ?><?=$this->uri->segment(1);?>/delete?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this personal data?');"><i class="fa fa-trash-o"></i> <?php echo lang('stu_clas_Delete'); ?></a></li>
                            </ul>
                          </div>
                      </td>
                    </tr>
                  <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>