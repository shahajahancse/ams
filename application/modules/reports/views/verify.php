<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
       <div class="col-md-8">
          <div class="grid simple horizontal">
             <div class="grid-title">
              <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
              <div class="pull-right">                
                <a href="<?=base_url('scouts_member/request')?>" class="btn btn-success btn-xs btn-mini"> Scouts Member Request</a>  
              </div>
             </div>
             <div class="grid-body">
              <!-- <form id="form_traditional_validation" action="#"> -->
              <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
              <div><?php echo validation_errors(); ?></div>
              <?php if($this->session->flashdata('success')):?>
                  <div class="alert alert-success">
                      <a class="close" data-dismiss="alert">&times;</a>
                      <?php echo $this->session->flashdata('success');;?>
                  </div>
              <?php endif; ?>
              <?php echo form_open_multipart("scouts_member/verify/".$info->id);?>

              <div class="row form-row">
                <div class="col-md-8">
                  <div class="scout-verify-box">
                  <?php
                    if($info->req_group == 1){
                      $req_group_name = 'Cub Scout';
                    }else if($info->req_group == 2){
                      $req_group_name = 'Scout';
                    }else if($info->req_group == 3){
                      $req_group_name = 'Rover Scout';
                    }else{
                      $req_group_name = '';
                    }

                    $path = base_url().'profile_img/';
                    if($info->profile_img != NULL){
                      $img_url = '<img src="'.$path.$info->profile_img.'" height="20">';
                    }else{
                      $img_url = '<img src="'.$path.'no-img.png" height="20">';
                    }

                    $active = $info->active == 0 ? '<span class="label label-important">Inactive</span>':'';
                  ?>
                    <p><strong>Name:</strong> <?php echo $info->first_name.' '.$info->first_name;?></p>
                    <p><strong>Date of Birth:</strong> <?=$info->dob?></p>
                    <p><strong>Phone Number:</strong> <?php echo $info->phone;?></p>
                    <p><strong>Email Address:</strong> <?php echo $info->email;?></p>
                    <p><strong>Status:</strong> <?php echo $active;?></p>
                    <p><strong>Request Scout Group:</strong> <?php echo $req_group_name;?></p>
                  </div>
                </div>

                <div class="col-md-4"> </div>
              </div>

              <div class="row form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label">Active / Inactive Member</label> <br><br>
                    <input type="radio" name="active" value="0" <?=$this->input->post('active')==0?'checked="checked"':'';?>> Inactive 
                    <input type="radio" name="active" value="1" <?=$this->input->post('active')==1?'checked="checked"':'';?>> Active
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Approved Scout Group</label>
                  <?php //echo form_error('scout_group'); ?>
                  <?php echo form_dropdown('scout_group', $scout_group, set_value('scout_group')); ?>                    
                  </select>
                </div>
              </div>

            <div class="form-actions">  
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Save</button>
              </div>
            </div>
          <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->              
        </div> <!-- END GRID -->
      </div>

    </div> <!-- END ROW -->


  </div>
</div>