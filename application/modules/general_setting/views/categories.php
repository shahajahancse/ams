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
                     <a href="<?=base_url('general_setting/category_add')?>" class="btn btn-blueviolet btn-xs btn-mini"> Add Category </a>
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

                  <table class="table table-hover table-bordered  table-flip-scroll cf" id="">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:60%">Category Name</th>
                           <th style="width:40%">Action</th>
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
                           <td class="v-align-middle"><?=$row->category_name?></td>
                           <td class="v-align-middle">
                              <a href="<?=base_url('general_setting/category_edit/'.$row->id)?>" class="btn btn-primary btn-xs btn-mini">Edit</a>
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
