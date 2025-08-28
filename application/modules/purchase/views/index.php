<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
            <li> <a href="javascript:void()" class="active"> <?=$module_name?> </a></li>
            <li> <?=$meta_title;?> </li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>
                        <div class="pull-right">
                            <?php if ($this->ion_auth->in_group(array('sm','admin'))) { ?>
                                <a href="<?=base_url('purchase/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Purchase</a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="grid-body" style="height: 70vh;" >
                        <?php if($this->session->flashdata('success')):?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');?>
                        </div>
                        <?php endif; ?>
                        <table class="table table-hover table-condensed dataTable" border="0">
                            <thead>
                                <tr>
                                    <th style=""> SL </th>
                                    <th style="">Name</th>
                                    <th style="">Title Name</th>
                                    <th style="">Date</th>
                                    <!-- <th style="">On Desk</th> -->
                                    <th style="">Status</th>
                                    <th style="">Received Status</th>
                                    <th style="text-align: right;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=$pagination['current_page'];
                                foreach ($results as $row): $sl++; ?>
                                <?php
                                    if($row->is_received == 2) {
                                        $ast = '<span class="label label-success"> Received </span>';
                                    }else{
                                        $ast = '<span class="label label-important">Pending</span>';
                                    }
                                ?>

                                <?php
                                    $status = '<span class="label label-secondary"> Draft </span>';
                                    if ($row->status == 2) {
                                        $status = '<span class="label label-warning"> On process </span>';
                                    }else if($row->status == 3){
                                        $status = '<span class="label label-success"> DO Approve </span>';
                                    }else if($row->status == 4){
                                        $status = '<span class="label label-info"> Back SM From DO </span>';
                                    }else if($row->status == 5){
                                        $status = '<span class="label label-primary"> Director Approve </span>';
                                    }else if($row->status == 6){
                                        $status = '<span class="label label-info"> Received </span>';
                                    }else if($row->status == 7){
                                        $status = '<span class="label label-important"> Rejected </span>';
                                    }else if($row->status == 8){
                                        $status = '<span class="label label-warning"> Back DO/SM From Director </span>';
                                    }else if($row->status == 9){
                                        $status = '<span class="label label-warning"> Return Request </span>';
                                    }else if($row->status == 10){
                                        $status = '<span class="label label-important"> Return Complete </span>';
                                        $ast = '<span class="label label-important">Return</span>';
                                    }
                                ?>

                                <tr>
                                    <td class="v-align-middle"><?=$sl.'.'?></td>
                                    <td class="v-align-middle"><?=$row->first_name; ?></td>
                                    <td class="v-align-middle"><?=$row->supplier_name; ?></td>
                                    <td class="v-align-middle"><?=date('d-m-Y', strtotime($row->created_at)); ?></td>

                                    <td><?= $status ?></td>
                                    <td class="v-align-middle"><?= $ast; ?> </td>
                                    <td align="right">
                                        <div class="btn-group">
                                            <a class="btn btn-success dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                            <ul class="dropdown-menu pull-right">
                                                <?php if($this->ion_auth->in_group(array('admin','sm')) && in_array($row->status, array(1,8,4))){ ?>
                                                    <li><a href="<?=base_url('purchase/edit/'.$row->id)?>"> Edit</a> </li>
                                                <?php } ?>

                                                <?php if($this->ion_auth->in_group(array('do')) && $row->status == 2){ ?>
                                                    <li><a href="<?=base_url('purchase/ap_status/'.$row->id)?>"> Approval</a> </li>
                                                <?php } ?>

                                                <?php if($this->ion_auth->in_group(array('admin')) && $row->status == 3){ ?>
                                                    <li><a href="<?=base_url('purchase/ap_status/'.$row->id)?>"> Approval</a> </li>
                                                <?php } ?>

                                                <?php if($this->ion_auth->in_group(array('admin')) && $row->status == 9){ ?>
                                                    <li><a href="<?=base_url('purchase/purchase_return/10/'.$row->id)?>"> Return Confirm </a> </li>
                                                <?php } ?>

                                                <?php if($this->ion_auth->in_group(array('sm')) && $row->status == 5){ ?>
                                                    <li><a href="<?=base_url('purchase/received/'.$row->id)?>"> Received </a> </li>
                                                    <li><a href="<?=base_url('purchase/purchase_return/9/'.$row->id)?>"> Return Request </a> </li>
                                                <?php } ?>
                                                <li><a href="<?=base_url('purchase/details/'.$row->id)?>"> Details</a> </li>
                                                <li><a target="_blank" href="<?=base_url('purchase/print_purchase/'.$row->id)?>"> Print </a> </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span
                                    style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Purchase </span>
                            </div>
                            <div class="col-sm-8 col-md-8 text-right">
                                <?php echo $pagination['links']; ?>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div> <!-- END Content -->

</div>
