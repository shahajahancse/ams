<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
            <li> <a href="<?=base_url('items')?>" class="active"> <?=$module_title; ?> </a></li>
            <li><?=$meta_title; ?> </li>
        </ul>

        <div class="row-fluid">
            <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                    <div class="pull-right">
                        <a href="<?=base_url('items/assigned_emp_entry_form')?>" class="btn btn-info btn-xs btn-mini"> Assign Employee</a>
                    </div>
            </div>

            <div class="grid-body ">
                <div id="infoMessage"><?php //echo $message;?></div>
                <?php if($this->session->flashdata('success')):?>
                    <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');?>
                    </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('error')):?>
                    <div class="alert alert-error">
                    <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php endif; ?>

                <table class="table table-bordered dataTable table-condensed">
                    <thead>
                    <tr>
                        <th style="vertical-align:middle" class="text-center"> SL </th>
                        <th style="vertical-align:middle" class="text-center">Branch</th>
                        <th style="vertical-align:middle" class="text-center">Department</th>
                        <th style="vertical-align:middle" class="text-center">Employee Nmae</th>
                        <th style="vertical-align:middle" class="text-center">Assets</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">No Data Found</td>
                            <td class="text-center">No Data Found</td>
                            <td class="text-center">No Data Found</td>
                            <td class="text-center">No Data Found</td>
                        </tr>
                    <!-- < ?php
                    $i=0;
                    foreach (@$results as $row) {
                        $status_classes = [
                            1 => 'badge-success',
                            2 => 'badge-warning',
                            3 => 'badge-danger',
                            4 => 'badge-info'
                        ];
                        $status_labels = [
                            1 => 'In Use',
                            2 => 'Under Maintenance',
                            3 => 'Disposed',
                            4 => 'Retired'
                        ];
                        $status_class = isset($status_classes[$row->asset_status]) ? $status_classes[$row->asset_status] : 'badge-secondary';
                        $status_label = isset($status_labels[$row->asset_status]) ? $status_labels[$row->asset_status] : 'Unknown';
                        // dd($row);
                        switch ($row->asset_status) {
                            case 1:
                                $status = 'In Use';
                                break;
                            case 2:
                                $status = 'Under Maintenance';
                                break;
                            case 3:
                                $status = 'Disposed';
                                break;
                            case 4:
                                $status = 'Retired';
                                break;
                            default:
                                $status = 'Inactive';
                        }
                        ?>
                        <tr>
                            <td style="vertical-align:middle" class="text-center">< ?=++$i?>.</td>
                            <td style="vertical-align:middle" class="text-center">< ?=$row->branch_name?></td>
                            <td style="vertical-align:middle" class="text-center">< ?=$row->category_name?></td>
                            <td style="vertical-align:middle" class="text-center">< ?=$row->sub_cate_name?></td>
                            <td style="vertical-align:middle" class="text-center"><strong>< ?=$row->item_name?></strong></td>
                            <td style="vertical-align:middle" class="text-center">< ?=$row->unit_name?></td>
                            <td style="vertical-align:middle">
                                <span class="badge < ?= $status_class ?>">< ?= $status_label ?></span>
                            </td>
                            <td style="vertical-align:middle" class="text-center">
                                <a href="< ?=base_url('items/generate_qr_code/'.encrypt_url($row->id));?>" class="btn btn-info btn-xs btn-mini" target="_blank"><i class="fa fa-qrcode"></i> QR</a>
                            </td>
                            <td class="text-center">
                                <a href="< ?=base_url('items/edit/'.encrypt_url($row->id));?>" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i></a>
                                <a href="< ?=base_url('items/edit/'.encrypt_url($row->id));?>" class="btn btn-danger btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        < ? php } ?> -->
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>

        </div> <!-- END ROW -->

    </div>
</div>
