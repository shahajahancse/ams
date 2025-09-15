<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('custom_fields')?>" class="active"> Custom Fields </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('custom_fields/create')?>" class="btn btn-info btn-xs btn-mini"> Add Custom Field</a>
                  </div>
               </div>
               <div class="grid-body ">
                  <?php if($this->session->flashdata('success')):
                     ?>
                     <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success');
                     ?>
                     </div>
                  <?php endif;
                  ?>
                  <?php if($this->session->flashdata('error')):
                     ?>
                     <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error');
                     ?>
                     </div>
                  <?php endif;
                  ?>

                  <table class="table table-hover dataTable table-condensed">
                     <thead>
                        <tr>
                           <th style="width:2%"> SL </th>
                           <th style="width:20%">Field Name</th>
                           <th style="width:15%">Field Type</th>
                           <th style="width:10%">Required</th>
                           <th style="width:30%">Options (for Dropdown)</th>
                           <th style="width:10%" class="text-center">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if (!empty($custom_fields)):
                           ?>
                           <?php $i=0; foreach ($custom_fields as $field): $i++;
                              ?>
                           <tr>
                              <td class="v-align-middle"><?=$i?>.</td>
                              <td class="v-align-middle"><?=$field->field_name?></td>
                              <td class="v-align-middle"><?=$field->field_type?></td>
                              <td class="v-align-middle"><?=($field->is_required == 1) ? 'Yes' : 'No'?></td>
                              <td class="v-align-middle"><?=$field->options?></td>
                              <td class="text-center">
                                 <a href="<?=base_url('custom_fields/edit/'.$field->id);?>" class="btn btn-primary btn-xs btn-mini">Edit</a>
                                 <a href="<?=base_url('custom_fields/delete/'.$field->id);?>" class="btn btn-danger btn-xs btn-mini" onclick="return confirm('Are you sure you want to delete this custom field?');">Delete</a>
                              </td>
                           </tr>
                           <?php endforeach;
                        ?>
                        <?php else:
                           ?>
                           <tr>
                              <td colspan="6" class="text-center">No custom fields defined yet.</td>
                           </tr>
                        <?php endif;
                        ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>