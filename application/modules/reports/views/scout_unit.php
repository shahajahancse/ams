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
                      <div class="col-md-12">
                        <div class="row form-row">
                          <div class="col-md-6">
                            <label class="form-label">Select Scout Region</label>
                            <?php 
                            echo form_error('sc_region_id');
                            $more_attr = 'class="form-control input-sm" id="region"';
                            echo form_dropdown('region', $regions, set_value('region', $region_id), $more_attr);
                            ?>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Select Scout District</label>
                            <?php 
                            echo form_error('sc_district_id'); 
                            $district_attr = 'class="sc_district_val form-control input-sm" id="sc_district"';
                            echo form_dropdown('district', $districts, set_value('district', $district_id), $district_attr);
                            ?>
                            <!-- <select name="district" class="sc_district_val form-control input-sm" id="sc_district">
                              <option value="">-- Select One --</option>
                            </select> -->
                          </div>
                        </div>

                        <div class="row form-row">
                         <div class="col-md-6">
                           <label class="form-label">Select Scout Upazila/Thana</label>
                           <?php 
                           echo form_error('sc_upa_tha_id');
                           $upazila_attr = 'class="sc_upazila_thana_val form-control input-sm"  id="sc_upazila_thana"';
                            echo form_dropdown('upazila', $upazilas, set_value('upazila', $upazila_id), $upazila_attr); 
                           ?>
                           <!-- <select name="upazila" class="sc_upazila_thana_val form-control input-sm"  id="sc_upazila_thana">
                             <option value="">-- Select One --</option>
                           </select> -->
                         </div>

                         <div class="col-md-6">
                          <label class="form-label">Select Scout Group</label>
                          <?php 
                          echo form_error('sc_group_id');
                          $group_attr = 'class="sc_group_val form-control input-sm"';
                            echo form_dropdown('group', $scout_groups, set_value('group', $group_id), $group_attr); 
                          ?>
                          <!-- <select name="group" class="sc_group_val form-control input-sm" >
                            <option value="">-- Select One --</option>
                          </select> -->
                        </div>
                       
                      </div>

                      <div class="pull-right">
                          <button type="submit" class="btn btn-primary btn-cons"><i class="icon-ok"></i> Search</button>
                       </div>

                    </div>
                     <?php if($region_id){?>
                    <a href="<?=$doc_url?>" class="btn btn-blueviolet btn-xs btn-mini" style="float: right; margin-left: 10px;">DOC Download</a>
                    <a href="<?=$download_url?>" class="btn btn-primary btn-xs btn-mini" style="float: right;">PDF Download</a>&nbsp;&nbsp;
                    
                    <?php } ?>
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
                           <th> SL </th>
                           <th>Scout Unit Name</th>
                           <th>Scout Group Name</th>
                           <th>Scout Upazila Name</th>
                           <th>Scout District</th> 
                           <th>Scout Region</th> 
                           <th>Status</th> 
                           <th>Details</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->unit_status == 1) {
                           $status = 'Enable';
                        }else{
                           $status = 'Disable';
                        }

                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <strong><?=$row->unit_name?> </strong></td>
                           <td><?=$row->grp_name?></td>
                           <td><?=$row->upa_name?></td>
                            <td class="v-align-middle"><?=$row->dis_name; ?></td> 
                            <td class="v-align-middle"><?=$row->region_name; ?></td> 
                            <td class="v-align-middle"><?=$status?></td> 
                           
                           <td><a href="<?=base_url('offices/scout_unit_details/'.$row->id)?>" class="btn btn-mini btn-primary"> <i class="fa fa-info-circle"> </i> Details</a></td>
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