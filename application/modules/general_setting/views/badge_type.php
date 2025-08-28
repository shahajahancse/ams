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
              <a href="<?=base_url('general_setting/badge_type_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Badge Type</a>  
            </div>            
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <table class="table table-hover table-condensed" id="">
              <thead>
                <tr>
                  <th style="width:2%">SL</th>
                  <th style="width:35%">Badge Type Name BN</th>
                  <th style="width:35%">Badge Type Name EN</th>
                  <th style="width:10%">Logo</th>
                  <th style="width:18%">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $sl=0;
                foreach ($results as $row):
                  $sl++;

                $img_path = base_url().'scout_badge_img/';
                  if($row->badge_logo != NULL){
                      $src= $img_path.$row->badge_logo;
                      $image = "<img src='$src' width='100'> ";
                  }else{
                    $image = '';
                  }
              ?>
                <tr>
                  <td class="v-align-middle"><?=$sl.'.'?></td>
                  <td class="v-align-middle"><?=$row->badge_type_name_bn;?></td>
                  <td class="v-align-middle"><?=$row->badge_type_name_en;?></td>
                  <td class="v-align-middle"><?=$image; ?></td>
				          <td><?php echo anchor(base_url()."general_setting/badge_type_edit/".$row->id, 'Edit', 'class="btn btn-mini btn-primary"') ;?>&nbsp;<a class="btn btn-mini btn-primary" href="<?=base_url()?>general_setting/badge_type_delete/<?=$row->id?>" onclick="return confirm('Are you sure you want to delete this  Badge Type?');">Delete</a></td>
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