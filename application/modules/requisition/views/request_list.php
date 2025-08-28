<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
            <li> <a href="javascript:void()" class="active"> <?=$module_name?> </a></li>
            <li> <?=$meta_title;?> </li>
        </ul>

        <div class="row">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4><span class="semi-bold"><?=$meta_title;?></span></h4>
                    <div class="pull-right">
                    </div>
                </div>

                <div class="grid-body" style="height: 70vh;">
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <?=$this->session->flashdata('success');?>
                        </div>
                    <?php endif;?>
                    <table class="table table-hover table-condensed dataTable" border="0">
                        <thead>
                            <tr>
                                <th style=""> SL </th>
                                <th style="">Title</th>
                                <th style="">User Name</th>
                                <th style="">Updated</th>
                                <th style="">Status</th>
                                <th style="">Urgent status</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sl = $pagination['current_page'];
                                foreach ($results as $row): $sl++;
                                $status = '<span class="label label-secondary">Draft</span>';
                                if ($row->status == 2) {
                                    $status = '<span class="label label-warning">On process</span>';
                                 }else if($row->status == 3){
                                    $status = '<span class="label label-primary">SM Approve</span>';
                                 }else if($row->status == 4){
                                    $status = '<span class="label label-info">Back User From DO</span>';
                                 }else if($row->status == 5){
                                    $status = '<span class="label label-info">Approve DO</span>';
                                 }else if($row->status == 6){
                                    $status = '<span class="label label-primary">Delivered </span>';
                                 }else if($row->status == 7){
                                    $status = '<span class="label label-danger">Rejected</span>';
                                 }
                            ?>

                            <?php
                                $created_at=date('Y-m-d', strtotime($row->created));
                                $today_date = date('Y-m-d');
                                $day_diff=abs(strtotime($today_date) - strtotime($created_at));
                                $number_of_days=floor($day_diff/(60*60*24));
                                if($number_of_days > 7) {
                                $colorb = '#ff8686';
                                }elseif($number_of_days > 5) {
                                $colorb = '#ffbc86';
                                }elseif($number_of_days > 3) {
                                $colorb = '#f3f982';
                                }else{
                                $colorb = 'white';
                                }
                            ?>

                            <tr style="">
                                <td><?=$sl . '.'?></td>
                                <td><?=$row->title;?></td>
                                <td><?=$row->first_name;?></td>
                                <td><?=date('d-m-Y', strtotime($row->updated_at));?> </td>
                                <td> <?=$status?> </td>
                                <td> <?=($row->urgent_status==2)?'Urgent':'Not Urgent'?></td>
                                <td align="right">
                                    <div class="btn-group">
                                        <a class="btn btn-success dropdown-toggle btn-mini" data-toggle="dropdown" href="#"> Action <span class="caret"></span> </a>
                                        <ul class="dropdown-menu pull-right">
                                            <?php if($this->ion_auth->in_group(array('admin','sm'))&& $row->status==2){ ?>
                                            <li><a href="<?=base_url('requisition/ap_status/'.$row->id)?>"> Approval</a> </li>
                                            <?php } ?>

                                            <?php if($this->ion_auth->in_group(array('admin','do'))&& $row->status==3){ ?>
                                            <li><a href="<?=base_url('requisition/ap_status/'.$row->id)?>"> Approval</a> </li>
                                            <?php } ?>

                                            <?php if($this->ion_auth->in_group(array('admin','sm'))&& $row->status==5){ ?>
                                            <li><a href="<?=base_url('requisition/received/'.$row->id)?>"> Delivery</a> </li>
                                            <?php } ?>

                                            <li><a href="<?=base_url('requisition/details/'.$row->id)?>"> Details</a> </li>
                                            <li><a target="_blank" href="<?=base_url('my_requisition/print_requisition/'.$row->id)?>"> Print </a> </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-4 col-md-4 text-left" style="margin-top: 20px;"> Total <span
                                style="color: green; font-weight: bold;"><?php echo $total_rows; ?> Requisition
                            </span></div>
                    </div>

                </div>

            </div>
        </div>

    </div> <!-- END Content -->

</div>
<script>
    const get_re_data = (id) => {
        $.ajax({
            type: "POST",
            url: "<?=base_url('requisition/get_re_data') ?>",
            data: {
                id: id,
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#r_desk').empty();
                $('#r_desk').append(data.send_option);
                $('#r_ids').val(id);
                $('#r_title').text(data.info.title);
            }
        })
    }
</script>
<script>
    $('#requisition_form_m').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?=base_url('requisition/send_requisition') ?>",
            data: $('#requisition_form_m').serialize(),
            success: function(data) {
                $('#myModal').modal('toggle');

                if (data == 'success') {

                    showMessage('success', 'Requisition sent successfully')

                }else{
                    showMessage('error', 'Something went wrong')

                }
            },
            error: function(data) {
                $('#myModal').modal('toggle');
                showMessage('error', 'Something went wrong')
            }
        })
    })
</script>
