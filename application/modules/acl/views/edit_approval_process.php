<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">
  <div class="content">
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url('acl/create_approval_type')?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?></li>
    </ul>

    <div class="row">
      <div class="col-md-12">
        <div class="grid simple horizontal">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
          </div>
          <div class="grid-body">
            <?php echo form_open("acl/edit_approval_process/".$info->id);?>
              <div><?=validation_errors() ?></div>

              <div class="row form-row">
                <div class="col-md-6">
                  <label class="form-label">Name</label>
                  <input name="name" id="name" type="text" class="form-control input-sm" placeholder="Name" value="<?=$info->name?>">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Forward Type</label>
                  <?php
                  $options = array('only_forward'  => 'Only Forward', 'forward_backward'    => 'Forward Backward');
                  echo form_dropdown('forward_type', $options, $info->forward_type, 'class="form-control"');
                  ?>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Status</label>
                  <?php
                  $options = array(1  => 'Active', 0    => 'Inactive');
                  echo form_dropdown('status', $options, $info->status, 'class="form-control"');
                  ?>
                </div>
              </div>

              <div class="row form-row">
                <div class="col-md-12">
                  <label class="form-label">Remarks</label>
                  <textarea name="remarks" id="remarks" class="form-control" rows="1"><?=$info->remarks?></textarea>
                </div>
              </div>

              <div class="row form-row">
                <table class="table table-hover">
                  <tr>
                    <th class="text-left">User Name</th>
                    <th class="text-left">Role Name</th>
                    <th class="text-left">Type</th>
                    <th width="10%" class="text-left">Order</th>
                    <th class="text-left">Forward</th>
                    <th class="text-left">Backward</th>
                    <th class="text-right">
                      <button type="button" class="btn btn-primary btn-mini" onclick="addRow()">
                        <i class="fa fa-plus-circle"></i> Add
                      </button>
                    </th>
                  </tr>
                  <?php $users = $this->db->where('status', 1)->get('users')->result(); ?>
                  <?php $roles = $this->db->where('status', 1)->get('approver_user_role')->result(); ?>
                  <tbody id="tbody">
                    <?php foreach($results as $row) { ?>
                      <tr>
                        <input type="hidden" name="ids[]" value="<?=$row->id?>">
                        <td class="text-left">
                          <select name="user_id[]" class="form-control user-select">
                            <option value="">Please Select Employee</option>
                            <?php foreach($users as $user) {?>
                                <option value="<?=$user->id?>" <?=$row->user_id == $user->id ? 'selected' : ''?>><?=$user->first_name?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <td class="text-left">
                          <select name="role_id[]" class="form-control role-select">
                            <option value="">Please Select Role</option>
                            <?php foreach($roles as $role) {?>
                                <option value="<?=$role->id?>" <?=$row->role_id == $role->id ? 'selected' : ''?>><?=$role->name?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <td class="text-left">
                          <select name="type_id[]" class="form-control">
                            <option value="">Please Select Type</option>
                            <option value="approver" <?=$row->type_id == 'approver' ? 'selected' : ''?>>Approver</option>
                            <option value="reviewer" <?=$row->type_id == 'reviewer' ? 'selected' : ''?>>Reviewer</option>
                            <option value="verifier" <?=$row->type_id == 'verifier' ? 'selected' : ''?>>Verifier</option>
                          </select>
                        </td>
                        <td class="text-left">
                          <input type="number" name="user_ordering[]" class="form-control" placeholder="Order" value="<?=$row->user_ordering?>">
                        </td>
                        <td class="text-left">
                          <select name="access_forward[]" class="form-control">
                            <option value="">Please Select</option>
                            <option value="0" <?=$row->access_forward == 0 ? 'selected' : ''?>>Back to User</option>
                            <?php foreach($roles as $role) {?>
                                <option value="<?=$role->id?>" <?=$row->access_forward == $role->id ? 'selected' : ''?>><?=$role->name?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <td class="text-left">
                          <select name="access_backward[]" class="form-control">
                            <option value="">Please Select</option>
                            <option value="0" <?=$row->access_backward == 0 ? 'selected' : ''?>>Back to User</option>
                            <?php foreach($roles as $role) {?>
                                <option value="<?=$role->id?>" <?=$row->access_backward == $role->id ? 'selected' : ''?>><?=$role->name?></option>
                            <?php } ?>
                          </select>
                        </td>

                        <td class="">
                          <button type="button" class="btn btn-danger" onclick="removeRow(this, <?=$row->id?>)">
                            <i class="fa fa-times"></i>
                          </button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <div class="form-actions">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary btn-cons">Save</button>
                </div>
              </div>
            <?php echo form_close();?>

          </div>  <!-- END GRID BODY -->
        </div> <!-- END GRID -->
      </div>
    </div> <!-- END ROW -->
  </div>
</div>

<script>
  function removeRow(el, id) {
    $.ajax({
      url: '<?=base_url('acl/ajax_delete_approval_process')?>',
      type: 'post',
      data: {
        id: id
      },
      success: function (response) {
        $(el).closest('tr').remove();
      }
    });
  }
</script>

<?php $users = $this->db->where('status', 1)->get('users')->result(); ?>
<?php $roles = $this->db->where('status', 1)->get('approver_user_role')->result(); ?>
<script>
  var users_options = '<option value="">Please Select Employee</option>';
  <?php foreach($users as $user) {?>
      users_options += '<option value="<?php echo $user->id;?>"><?php echo $user->first_name;?></option>';
  <?php } ?>
  var users_roles = '';
  <?php foreach($roles as $role) {?>
      users_roles += '<option value="<?php echo $role->id;?>"><?php echo $role->name;?></option>';
  <?php } ?>

  var types = '<option value="">Select One</option>';
  types += '<option value="approver">Approver</option>';
  types += '<option value="reviewer">Reviewer</option>';
  types += '<option value="verifier">Verifier</option>';

  var f_user = '<option value="">Select One</option>';
  var b_user = '<option value="">Select One</option><option value="0">Back to User</option>';
  f_user += users_roles;
  b_user += users_roles;

  function addRow(params) {
    var new_row = '<tr>' +
        '<input type="hidden" name="ids[]" value="new">' +
        '<td><select name="user_id[]" class="form-control user-select">' + users_options + '</select></td>' +
        '<td><select name="role_id[]" class="form-control">' + users_roles + '</select></td>' +
        '<td><select name="type_id[]" class="form-control">' + types + '</select></td>' +
        '<td width="10%"> <input type="number" name="user_ordering[]" class="form-control" placeholder="Order"> </td>' +

        '<td><select name="access_forward[]" class="form-control">' + f_user + '</select></td>' +
        '<td><select name="access_backward[]" class="form-control">' + b_user + '</select></td>' +
        '<td><button type="button" class="btn btn-danger remove_row"> <i class="fa fa-times"></i></button></td>' +
        '</tr>';
    $('#tbody').append(new_row);
    $('#tbody tr:last .user-select').select2({ width: '100%' });
  }
</script>
<script>
  $(document).ready(function () {
    $('#tbody').on('click', '.remove_row', function () {
      $(this).closest('tr').remove();
    })
  })
</script>
