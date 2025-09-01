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
                            <?php if ($this->ion_auth->in_group(array('sm','badmin'))) { ?>
                                <a href="<?=base_url('direct_purchase/create')?>" class="btn btn-blueviolet btn-xs btn-mini"> Create Purchase</a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="grid-body" style="height: 70vh;">
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
                                    <th style="">Status</th>
                                    <th style="text-align: right;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=$pagination['current_page'];
                                foreach ($results as $row): $sl++; ?>
                                <?php
                                    $status = '<span class="label label-primary"> Direct Purchase </span>';
                                ?>
                                <tr>
                                    <td class="v-align-middle"><?=$sl.'.'?></td>
                                    <td class="v-align-middle"><?=$row->first_name; ?></td>
                                    <td class="v-align-middle"><?=$row->supplier_name; ?></td>
                                    <td class="v-align-middle"><?=date('d-m-Y', strtotime($row->created_at)); ?></td>
                                    <td><?= $status ?></td>
                                    <td align="right">
                                        <div class="btn-group">
                                            <a class="btn btn-success dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="<?=base_url('direct_purchase/details/'.$row->id)?>"> Details</a> </li>
                                                <li><a target="_blank" href="<?=base_url('direct_purchase/print_direct/'.$row->id)?>"> Print </a> </li>
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
