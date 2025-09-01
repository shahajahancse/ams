<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
            <li> <a href="<?=base_url('acl')?>" class="active"> <?=$module_title; ?> </a></li>
            <li><?=$meta_title; ?></li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple horizontal">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?=base_url('acl')?>" class="btn btn-blueviolet btn-xs btn-mini"> All User List</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <?php echo form_open_multipart(uri_string());?>
                        <div class="row form-row">
                            <div class="col-md-4">
                                <label class="form-label">Full Name</label>
                                <?php echo form_error('full_name'); ?>
                                <input name="full_name" id="full_name" type="text" value="<?=set_value('full_name', $user->first_name)?>" class="form-control input-sm" placeholder="Full Name">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><?php echo lang('create_user_phone_label', 'phone');?></label>
                                <?php echo form_error('phone'); ?>
                                <input name="phone" id="phone" type="text" value="<?=set_value('phone', $user->phone)?>" class="form-control input-sm" placeholder="Phone Number">
                            </div>
                            <?php if($this->ion_auth->is_admin()) { ?>
                                <?php $units = $this->db->get('units')->result(); ?>
                                <div class="col-md-4">
                                    <label class="form-label">Division <span style="color:red">*</span></label>
                                    <?php echo form_error('unit_id'); ?>
                                    <select name="unit_id" id="unit_id" class="form-control input-sm select2">
                                        <option value="">Select Division</option>
                                        <?php foreach($units as $unit):?>
                                        <option value="<?=$unit->id?>" <?= $unit->id== $user->unit_id?'selected':'' ?> ><?=$unit->name_en?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            <?php }else{?>
                                <?php $un = $this->db->where('id', $user->unit_id)->get('units')->result(); ?>
                                <div class="col-md-4">
                                    <label class="form-label">Division <span style="color:red">*</span></label>
                                    <?php echo form_error('unit_id'); ?>
                                    <select name="unit_id" id="unit_id" class="form-control input-sm select2">
                                        <option value="<?=$un->id?>"><?=$un->name_en?></option>
                                    </select>
                                </div>
                            <?php }?>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-4">
                                <label class="form-label"><?php echo lang('create_user_email_label', 'email');?></label>
                                <?php echo form_error('email'); ?>
                                <input name="email" id="email" type="text" value="<?=set_value('email', $user->email)?>" class="form-control input-sm" placeholder="Email Address">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Department</label>
                                <?php
                                echo form_error('dept_id');
                                $more_attr = 'class="form-control input-sm" id="dept_id"';
                                echo form_dropdown('dept_id', $department, set_value('dept_id', $user->dept_id), $more_attr);
                                ?>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Designation</label>
                                <?php
                                    echo form_error('desig_id');
                                    $more_attr = 'class="form-control input-sm" id="desig_id"';
                                    echo form_dropdown('desig_id', $designation, set_value('desig_id', $user->desig_id), $more_attr);
                                ?>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-md-6">
                                <label class="form-label"><?php echo lang('create_user_password_label', 'password');?></label>
                                <?php echo form_error('password'); ?>
                                <input name="password" id="password" type="text" class="form-control input-sm"
                                    placeholder="Password">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
                                <?php echo form_error('password_confirm'); ?>
                                <input name="password_confirm" id="password_confirm" type="text"
                                    class="form-control input-sm" placeholder="Confirm Password">
                            </div>
                        </div>

                        <?php if($this->ion_auth->is_admin()) { ?>
                        <div class="row form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h3><?php echo lang('edit_user_groups_heading');?></h3>
                                    <?php foreach ($groups as $group):?>
                                    <div style="color: black;">
                                        <?php
                                            $gID=$group['id'];
                                            $checked = null;
                                            $item = null;
                                            foreach($currentGroups as $grp) {
                                                if ($gID == $grp->id) {
                                                    $checked= ' checked="checked"';
                                                    break;
                                                }
                                            }
                                        ?>
                                        <label style="color: black;">
                                            <input type="radio" name="group" value="<?php echo $group['id'];?>"
                                            <?php echo $checked;?>>
                                            <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?> <br>
                                        </label>
                                    </div>
                                    <?php endforeach?>
                                </div>

                                <?php echo form_hidden('id', $user->id);?>
                            </div>
                            <?php }else{?>
                            <div class="row form-row" disable>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h3><?php echo lang('edit_user_groups_heading');?></h3>
                                        <?php foreach ($groups as $group):?>
                                        <div style="color: black;">
                                            <?php
                                                $gID=$group['id'];
                                                $checked = null;
                                                $item = null;
                                                foreach($currentGroups as $grp) {
                                                    if ($gID == $grp->id) {
                                                        $checked= ' checked="checked"';
                                                        break;
                                                    }
                                                }
                                            ?>
                                            <label style="color: black;">
                                                <input disabled type="radio" name="group"
                                                    value="<?php echo $group['id'];?>" <?php echo $checked;?>>
                                                <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?> <br>
                                            </label>
                                        </div>
                                        <?php endforeach?>
                                    </div>
                                    <?php echo form_hidden('id', $user->id);?>
                                </div>
                                <?php } ?>

                                <div class="col-md-6" style="color: black;">
                                    <h3>Status</h3>
                                    <?php echo form_error('active'); ?>
                                    <?php if($this->ion_auth->is_admin()){?>
                                    <input type="radio" name="active" value="0"
                                        <?=set_value('active', $user->active)==0?'checked':'';?>> Inactive <br>
                                    <input type="radio" name="active" value="1"
                                        <?=set_value('active', $user->active)==1?'checked':'';?>> Active<br>
                                    <?php }else{?>
                                    <input disabled type="radio" name="active" value="0"
                                        <?=set_value('active', $user->active)==0?'checked':'';?>> Inactive <br>
                                    <input disabled type="radio" name="active" value="1"
                                        <?=set_value('active', $user->active)==1?'checked':'';?>> Active<br>
                                    <?php }?>
                                </div>
                                <div class="col-md-6"
                                    style="color: black;box-shadow: 0px 0px 1px 1px #b5b5b5;padding: 7px;width: max-content;">
                                    <?php if ($user->profile_img) {
                                        $img = $user->profile_img;
                                        $img = base_url() . "profile_img/" . $img;
                                        echo '<img src="' . $img . '" width="100px" height="100px" style="border-radius: 50%;"/>';
                                    } ?>
                                    <h3>Profile Image</h3>
                                    <input type="file" name="profile_img" />
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="pull-right">
                                    <?php echo form_submit('submit', lang('edit_user_submit_btn'), "class='btn btn-primary btn-cons'"); ?>
                                </div>
                            </div>
                            <?php echo form_close();?>

                        </div> <!-- END GRID BODY -->
                    </div> <!-- END GRID -->
                </div>

            </div> <!-- END ROW -->

        </div>
    </div>
