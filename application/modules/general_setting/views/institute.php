<div class="page-content">     
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> General Setting</li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal green">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
            <div class="pull-right">
        
            </div>            
          </div>

          <div class="grid-body ">
<!-- http://www.srinichekuri.com/2016/01/09/select2-jquery-plugin/ -->          
            <div id="infoMessage"><?php echo $message;?></div>            
            <table class="table table-hover table-bordered  table-flip-scroll cf">
                <thead class="cf">
                    <tr>
                        <th>SL</th>
                        <th>Institute Name</th>
                        <th>Division</th>                        
                        <th>District</th>
                        <th>Upazila</th>
                        <th>Institute Type</th>
                        <th>Education Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                  $sl = $pagination['current_page'];
                  foreach ($institute as $info):
                    $sl++;
                ?>
                    <tr>
                      <td><?=$sl.'.'?></td>
                      <td><?php echo $info->name;?></td>
                      <td><?php echo $info->division;?></td>
                      <td><?php echo htmlspecialchars($info->district,ENT_QUOTES,'UTF-8');?></td>                 
                      <td><?php echo htmlspecialchars($info->upazila,ENT_QUOTES,'UTF-8');?></td>
                      <td><?php echo htmlspecialchars($info->institute_type,ENT_QUOTES,'UTF-8');?></td>
                      <td><?php echo htmlspecialchars($info->edu_level_name,ENT_QUOTES,'UTF-8');?></td>
					            <td><?php echo anchor("institute/#", 'Edit','class="btn btn-mini btn-primary"') ;?></td>
                     
                    </tr>
                  <?php endforeach;?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Institute </span></div>
                <div class="col-sm-8 col-md-8 text-right">
                    <?php echo $pagination['links']; ?>
                </div>
            </div>
 
          </div>

        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>

