<div class="page-content">     
   <div class="content">  
      <ul class="breadcrumb" style="margin-bottom: 20px;">
         <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
         <li> <a href="javascript:void()" class="active"><?=$module_title?> </a></li>
         <li><?=$meta_title; ?> </li>
      </ul>



      <div class="row">
         <div class="col-md-12">
            <div class="grid simple ">
               

               <div class="grid-body ">
                  <div id="infoMessage"><?php //echo $message;?></div>            
                  <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');?>
                     </div>
                  <?php endif; ?>

                  <div class="row" style="float: right;">
                     <a href="<?=base_url('reports/doc_scouts_regional')?>" class="btn btn-blueviolet btn-xs btn-mini" >DOC Download</a>

                     <a href="<?=base_url('reports/pdf_scouts_regional')?>" class="btn btn-primary btn-xs btn-mini" >PDF Download</a>

                     <a href="<?=base_url('reports/scouts_regional_excel')?>" class="btn btn-success btn-xs btn-mini" >Excel Download</a>              
                  </div> 
                 

                  <table class="table table-hover table-condensed">
                     <thead>
                        <tr>
                           <th> SL </th>
                           <th>Region Logo</th>
                           <th>Region Name</th>
                           <th>Division Name</th>
                           <th>Region Type</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $sl=0;
                        foreach ($results as $row):
                           $sl++;
                        if($row->region_status == 1) {
                           $status = 'Active';
                        }else{
                           $status = 'Inactive';
                        }

                        if($row->region_type == 'divisional') {
                           $region = 'Divitional Region';
                        }else{
                           $region = 'Special Region';
                        }
                        ?>
                        <tr>
                           <td class="v-align-middle"><?=$sl.'.'?></td>
                           <td> <?php 
                       $img_path = base_url().'offices_img/';
                       if($row->region_logo != NULL){
                         $src= $img_path.$row->region_logo;
                         echo "<img src='$src' height='80'>";
                      }
					  else
					  	echo 'No logo';
                      ?></td>
                           <td> <?=$row->region_name?> </td>
                           <td class="v-align-middle"><?=$row->div_name; ?></td>
                           <td> <?=$region?> </td>
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