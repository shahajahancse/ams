<style>
   .select2.form-control {
      box-shadow: none;
      border: 1px solid #0aa699 !important;
   }
   .select2-container .select2-choice {
      border-radius: 2px;
      border: 1px solid #e5e9ec !important;
      padding: 2px 10px !important;
      height: 30px !important;
   }
   .select2-search {
      min-height: 20px !important;
   }
   .select2-search input {
      line-height: 20px !important;
   }
</style>


<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('movement')?>" class="active"> <?=$module_title?> </a></li>
         <li> <?=$meta_title; ?> </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                  <div class="pull-right">
                     <a href="<?=base_url('movement')?>" class="btn btn-info btn-xs btn-mini"> Movement List</a>
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <?php
                     if ($info->status == 0) {
                        $status = "<span class='label label-default'> Draft </span>";
                     } elseif ($info->status == 1) {
                        $status = "<span class='label label-warning'> On Process </span>";
                     } elseif ($info->status == 2) {
                        $status = "<span class='label label-success'> Approved </span>";
                     } else {
                        $status = "<span class='label label-danger'> Delete </span>";
                     }
                  ?>

                  <section>
                     <legend>Asset Information</legend>
                     <table class="table table-bordered" id="example2">
                        <tr>
                           <th>Asset Name</th>
                           <td><?= $info->item_name ?></td>
                           <th>From Location</th>
                           <td><?= $info->from_location ?></td>
                           <th>To Location</th>
                           <td><?= $info->to_location ?></td>
                        </tr>
                        <tr>
                           <th>From Custodian</th>
                           <td><?=$info->from_custodian_fname . ' ' . $info->from_custodian_lname?></td>
                           <th>To Custodian</th>
                           <td><?=$info->to_custodian_fname . ' ' . $info->to_custodian_lname?></td>
                           <th>Movement Date</th>
                           <td><?=$info->movement_date?></td>
                        </tr>
                        <tr>
                           <th>Status</th>
                           <td><?=$status?></td>
                           <th>Notes</th>
                           <td colspan="3"><?=$info->notes?></td>
                        </tr>
                     </table>
                  </section>
                  <br>
                  <section>
                     <legend>Work Flow Details</legend>
                     <table class="table table-bordered" id="example2">
                        <tr>
                           <th>Forward By</th>
                           <th>Status</th>
                           <th colspan="4">Remarks</th>
                        </tr>
                        <?php foreach ($details as $row) { ?>
                           <?php
                              if ($row->status == 1) {
                                 $status = "<span class='label label-warning'> Forward </span>";
                              } elseif ($row->status == 2) {
                                 $status = "<span class='label label-success'> Approved </span>";
                              } elseif ($row->status == 3) {
                                 $status = "<span class='label label-danger'> Reject </span>";
                              } else {
                                 $status = "<span class='label label-warning'> Backward </span>";
                              }
                           ?>
                           <tr>
                              <td><?= $row->created_by_name ?></td>
                              <td><?= $status ?></td>
                              <td><?= $row->notes ?></td>
                           </tr>
                        <?php } ?>
                     </table>
                  </section>

                  <br><br>
                  <?php
                     $user_id = $this->session->userdata('user_id');
                     if ($info->status == 0) {
                        $this->db->select('arm.*, af.name as forward_role');
                        $this->db->from('approval_role_manage arm');
                        $this->db->join('approver_user_role af', 'af.id = arm.role_id', 'left');
                        $this->db->where('arm.fb_type_id', 1)->where('arm.user_ordering', 1);
                        $fb=$this->db->get()->row();
                     } else {
                        $this->db->select('arm.*, af.name as forward_role, ab.name as backward_role');
                        $this->db->from('approval_role_manage arm');
                        $this->db->join('approver_user_role af', 'af.id = arm.access_forward', 'left');
                        $this->db->join('approver_user_role ab', 'ab.id = arm.access_backward', 'left');
                        $this->db->where('arm.user_id', 11)->where('arm.fb_type_id', 1);
                        $fb=$this->db->get()->row();
                     }
                     // dd($fb);
                  ?>
                  <?php $attributes = array('id' => 'validate');
                  echo form_open_multipart("movement/forward_status_update/".encrypt_url($info->id), $attributes);?>
                     <div class="row form-row">
                        <!-- status -->
                        <div class="col-md-6" style="">
                           <label class="form-label">Status Type <span class='required'>*</span></label>
                           <?php echo form_error('status'); ?>
                           <?php if ($info->status == 0) { ?>
                              <input type="radio" name="status" value="1" <?=$info->status=='1'?'checked':'';?> > <span style="color: black; font-size: 14px;"><strong> Forward </strong></span>
                              <input type="radio" name="status" value="0" <?=$info->status=='0'?'checked':'';?> > <span style="color: black; font-size: 14px;"><strong> Draft </strong></span>
                           <?php } else if ($info->status == 1) { ?>
                              <input type="radio" name="status" value="1" checked > <span style="color: black; font-size: 14px;"><strong> Review and Forward </strong></span>
                              <input type="radio" name="status" value="2" <?=$info->status=='2'?'checked':'';?> > <span style="color: black; font-size: 14px;"><strong>Approve</strong></span>
                              <input type="radio" name="status" value="3" <?=$info->status=='3'?'checked':'';?> > <span style="color: black; font-size: 14px;"><strong>Reject</strong></span>
                           <?php } else if ($info->status == 2) { ?>
                              <input type="radio" name="status" value="2" checked > <span style="color: black; font-size: 14px;"><strong>Approve</strong></span>
                              <input type="radio" name="status" value="3" <?=$info->status=='3'?'checked':'';?> > <span style="color: black; font-size: 14px;"><strong>Reject</strong></span>
                           <?php } else if ($info->status == 3) { ?>
                              <input type="radio" name="status" value="3" checked > <span style="color: black; font-size: 14px;"><strong>Reject</strong></span>
                           <?php } ?>
                           <div id="typeerror"></div>
                        </div>

                        <!-- forward to -->
                        <div class="col-md-6" style="">
                           <label class="form-label">Forward To <span class='required'>*</span></label>
                           <?php echo form_error('forward'); ?>
                           <?php if ($info->status == 0) { ?>
                              <input type="radio" name="forward" value="0" checked > <span style="color: black; font-size: 14px;"><strong> Draft </strong></span>
                           <?php } ?>
                           <?php if (!empty($fb->forward_role)) { ?>
                              <input type="radio" name="forward" value="<?= $fb->access_forward ?>" <?=$info->status==0?'':'checked';?>  required > <span style="color: black; font-size: 14px;"><strong> Forward to <?=$fb->forward_role?> </strong></span>
                           <?php } ?>
                           <?php if (!empty($fb->backward_role)) { ?>
                              <input type="radio" name="forward" value="<?= $fb->access_backward ?>" > <span style="color: black; font-size: 14px;"><strong> Backward to <?=$fb->backward_role?> </strong></span>
                           <?php } ?>
                           <div id="typeerror"></div>
                        </div>
                     </div>

                     <div class="row form-row">
                        <div class="col-md-12">
                           <label class="form-label">Remarks <span class='required'>*</span> </label>
                           <textarea required class="form-control" rows="2" name="remarks" id="remarks"></textarea>
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

<script type="text/javascript">
   $(document).ready(function() {
      $('#validate').validate({
      ignore: "",
      rules: {
         movement_date: { required: true },
      }
   });
   });
</script>
