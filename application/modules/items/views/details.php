<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>
     <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border:0 solid #ccc; font-weight: bold; vertical-align: top}
      .tg .tg-9vst{background-color:#efefef;text-align:right;}
    </style>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <?php if($this->ion_auth->is_admin()){ ?>
              <div class="pull-right">
                <a href="<?=base_url('complain/complain_list')?>" class="btn btn-success btn-xs btn-mini"> All complain Request List</a> 
              </div> 
            <?php } ?>           
          </div>

          <div class="grid-body ">
            <div id="infoMessage"><?php //echo $message;?></div>            
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('warning')):?>
                <div class="alert alert-warning">
                    <a class="close" data-dismiss="alert">&times;</a>
                    <?php echo $this->session->flashdata('warning');?>
                </div>
            <?php endif; ?>

            <div class="tiles white details">
              <a href="<?=base_url('Complain/details_pdf'.'/'.encrypt_url($complain->id))?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
                <table class="tg">
                    <tr>
                      <th class="tg-9vst">Name:</th>
                      <td class="tg-031e" width="300"><?=$complain->name?></td>
                      <th rowspan="4" class="tg-9vst">Problem Details:</th>
                      <td rowspan="4" class="tg-031e" valign="top"><?=$complain->complain_details?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Mobile:</th>
                      <td class="tg-031e"><?=$complain->phone?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Email:</th>
                      <td class="tg-031e"><?=$complain->email?></td>
                    </tr>
                    <tr>
                      <th class="tg-9vst">Address:</th>
                      <td class="tg-031e"><?=$complain->address?></td>
                    </tr>
                </table>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>