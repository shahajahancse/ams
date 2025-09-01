<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"><?=$module_name?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>
      
      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
               </div>

          
               <div class="grid-body ">
                <form method="get" action="<?=$_SERVER['PHP_SELF'];?>">

                 <div class="row form-row">
                  <div class="col-md-6">
                      <label class="form-label">Select Scout Region</label>
                      <?php 
                      echo form_error('sc_region_id');
                      $more_attr = 'class="form-control input-sm" id="region"';
                      echo form_dropdown('region', $regions, set_value('sc_region_id', $region_id), $more_attr);
                      ?>
                     
                 </div>
                 <div class="col-md-6">
                  <br>
                    <button style="margin-top: 10px;" type="submit" class="btn btn-primary btn-cons"><i class="icon-ok" ></i> Search</button
                 </div>
                   <div class="pull-right">
                      
                    </div>
                 </div>
                  <div>
                    <a href="<?=base_url('reports/doc_scouts_district_offices')?>" class="btn btn-blueviolet btn-xs btn-mini" style="float: right;margin-left: 10px;">DOC Download</a>

                    <a href="<?=base_url('reports/pdf_scouts_district_offices')?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>
                  </div>
                    
              </form>
                  <div id="infoMessage"><?php //echo $message;?></div>            
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>
                  <table class="table table-hover table-condensed">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:30%">Scout District Name</th>
                           <th style="width:30%">Scout Region</th>
                           <th style="width:10%">Division</th>
                           <th style="width:10%">District</th>
                           <th style="width:10%">District Type</th>
                           <th style="width:5%">Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->dis_status == 1) {
                           $status = 'Enable';
                        }else{
                           $status = 'Disable';
                        }

                        if($row->dis_type == '1') {
                           $district = 'Administrative District';
                        }else if($row->dis_type == '2') {
                           $district = 'Metropolitan District';
                        }else if($row->dis_type == '3') {
                           $district = 'Rover District';
                        }else if($row->dis_type == '4') {
                           $district = 'Railway District';
                        }else if($row->dis_type == '5') {
                           $district = 'Sea District';
                        }else if($row->dis_type == '6') {
                           $district = 'Air District';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <strong> <?=$row->dis_name?> </strong></td>
                           <td class="v-align-middle"><?=$row->region_name; ?></td>
                           <td class="v-align-middle"><?=$row->div_name; ?></td>
                           <td class="v-align-middle"><?=$row->district_name; ?></td>
                           <td> <?=$district?> </td>
                           <td> <?=$status?><td>
                              
                           </tr>
                        <?php endforeach;?>                      
                     </tbody>
                  </table>
               </div>

            </div>
         </div>
      </div>

   </div> <!-- END Content -->

</div>