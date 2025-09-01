<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
              <a href="<?=base_url('scouts_member/add')?>" class="btn btn-primary btn-xs btn-mini"> Add Scouts Member </a>
              <a href="<?=base_url('scouts_member/all')?>" class="btn btn-success btn-xs btn-mini"> Scouts List</a>  
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
                  <th style="width:5%">Image</th>
                  <th style="width:10%">Full Name</th>
                  <th style="width:10%">Phone</th>
                  <th style="width:10%">Req. Section</th>
                  <th style="width:10%">Scout Unit</th>
                  <th style="width:5%">Verify</th>
                  <th style="width:5%">Edit</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $sl=0;
                foreach ($results as $row):
                  $sl++;
                  
                  $path = base_url().'profile_img/';
                  if($row->profile_img != NULL){
                    $img_url = '<img src="'.$path.$row->profile_img.'" height="20">';
                  }else{
                    $img_url = '<img src="'.$path.'no-img.png" height="20">';
                  }

                  // $active = $row->active == 0 ? '<span class="label label-important">Inactive</span>':'';
              ?>

                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$img_url?></td>
                  <td class="v-align-middle"><?php echo $row->first_name;?></td>
                  <td class="v-align-middle"><?php echo $row->phone;?></td>                  
                  <td class="v-align-middle"><?php echo get_scout_section($row->sc_req_section_id);?></td>
                  <td class="v-align-middle"><?php echo $row->unit_name;?></td>
                  <td class="v-align-middle"> <a href="<?php echo base_url('scouts_member/verify/'.$row->id);?>" class="btn btn-mini btn-success">Verify</a> </td>
                  <td class="v-align-middle"> <a href="<?php echo base_url('scouts_member/verify/'.$row->id);?>" class="btn btn-mini btn-success">Edit</a> </td>
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