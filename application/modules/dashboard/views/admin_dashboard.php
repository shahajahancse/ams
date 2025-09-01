<style>
    .tiles-container {
        margin-left: 0px;
        margin-right: 0px;
        box-shadow: 0px 0px 7px 1px #adadad;
    }
</style>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

    :root {
        --light: #f6f6f9;
        --primary: #1976D2;
        --light-primary: #CFE8FF;
        --grey: #eee;
        --dark-grey: #AAAAAA;
        --dark: #363949;
        --danger: #D32F2F;
        --light-danger: #FECDD3;
        --warning: #FBC02D;
        --light-warning: #FFF2C6;
        --success: #388E3C;
        --light-success: #BBF7D0;
    }

    .d_card {
        border-radius: 10px;
        padding: 20px;
        margin: 9px 0px;
        box-shadow: 0px 0px 10px 2px darkgrey;
    }
    h5, h4 {
        color: #000000;
        font-weight: bold;
    }

    .c_card {
        border-radius: 10px;
        padding: 5px;
        display: flex;
        margin: 9px 0px;
        cursor: pointer;
        color: #683091;
        box-shadow: 0px 0px 8px 2px #bdbdbd;
        flex-direction: column;
    }
    h4{
        font-weight: bold;
    }

    .c_card:hover {
        box-shadow: 0px 0px 35px 4px #8f8f8f
    }

    .c_cardn {
        border-radius: 10px;
        padding: 5px;
        display: flex;
        margin: 9px 0px;
        cursor: pointer;
        background: linear-gradient(156deg, transparent, transparent);
        box-shadow: 0px 0px 2px 2px #8f8f8f;
        flex-direction: column;
    }

    .c_cardn:hover {
        box-shadow: 0px 0px 35px 4px #8f8f8f
    }

    #floatingDiv {
        height: 247px;
        width: 200px;
        background-image: linear-gradient(141deg, #cdd0ff, #a9f1c3);
        border-radius: 10px;
        padding: 10px;
        z-index: 999;
        overflow-y: scroll;
    }

    .fli {
        list-style: none;
        border: 1px solid;
        width: 174px;
        padding: 6px;
        border-radius: 8px;
        margin-bottom: 4px;
    }

    #floatingDiv::-webkit-scrollbar {
        display: none;

    }
</style>

<div class="page-content">
    <div class="content">
        <div class="row">
            <div class='col-md-5'>
                <h2>Dashboard</h2>
                <h4 class="widget-user-username welcome-hrsale-user">
                    Welcome Back,<span style="color: #1976D2"> <?php echo $this->session->userdata('first_name')?>!</span>
                </h4>
            </div>
            <!-- filter -->
            <?php if($this->ion_auth->in_group(array('admin'))){ ?>
                <?php $units = $this->db->get('units')->result(); ?>
                <div class='col-md-3'>
                    <label>Select Branch</label>
                    <select name="unit_id" id="unit_id" class="form-control" onchange="ajax_get_data()">
                        <option value=""> Select Branch </option>
                        <?php foreach ($units as $unit) { ?>
                            <option value="<?=$unit->id?>"><?=$unit->name_en?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class='col-md-2'>
                <label>From Date</label>
                <input type="date" name="from_date" id="from_date" class="form-control" onchange="ajax_get_data()">
                </div>
            <?php } else { ?>
                <div class='col-md-2 col-md-offset-3'>
                <label>From Date</label>
                <input type="date" name="from_date" id="from_date" class="form-control" onchange="ajax_get_data()">
                </div>
            <?php } ?>
            <div class='col-md-2'>
                <label>To Date</label>
                <input type="date" name="to_date" id="to_date" class="form-control" onchange="ajax_get_data()">
            </div>

            <!-- record -->
            <div id="divView">
                <div class='col-md-12'>
                    <div class="col-md-6">
                        <div class="d_card" style="background: aliceblue;color: #683091;">
                            <h4>Requisition</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="c_card"  onclick="window.location.href = '<?php echo base_url('requisition/index')?>';">
                                        <h5>Total Requisition</h5>
                                        <div class="col-md-12">
                                            <h3 class="reqid col-md-6"><?=$total_data?></h3>
                                            <i class="fa fa-user col-md-6 fa-3x"
                                                style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="c_card"  onclick="window.location.href = '<?php echo base_url('requisition/request_list')?>';">
                                        <h5>Pending</h5>
                                        <div class="col-md-12">
                                            <h3 class="reqpen col-md-6"><?=$total_pending?></h3>
                                            <i class="fa fa-laptop col-md-6 fa-3x"
                                                style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="c_card" onclick="window.location.href = '<?php echo base_url('requisition/approve_list')?>';">
                                        <h5>Approved </h5>
                                        <div class="col-md-12">
                                            <h3 class="reqaa col-md-6"><?=$total_approve?></h3>
                                            <i class="fa fa-home col-md-6 fa-3x"
                                                style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="c_card"  onclick="window.location.href = '<?php echo base_url('requisition/rejected_list')?>';">
                                        <h5>Rejected</h5>
                                        <div class="col-md-12">
                                            <h3 class="reqrrr col-md-6"><?=$total_rejected?></h3>
                                            <i class="fa fa-clock-o col-md-6 fa-3x"
                                                style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"
                                                class=" col-md-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d_card" style="background: aliceblue;color: #683091;">
                            <h4>Purchase</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="c_card"  onclick="window.location.href = '<?php echo base_url('purchase/index')?>';">
                                        <h5>Total Purchase</h5>
                                        <div class="col-md-12">
                                            <h3 class="gjhg col-md-6"><?=$total_datap?></h3>
                                            <i class="fa fa-user col-md-6 fa-3x"
                                                style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="c_card"  onclick="window.location.href = '<?php echo base_url('purchase/purchase_pending')?>';">
                                        <h5>Pending</h5>
                                        <div class="col-md-12">
                                            <h3 class="pejhuj col-md-6"><?=$total_pendingp?></h3>
                                            <i class="fa fa-laptop col-md-6 fa-3x"
                                                style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="c_card" onclick="window.location.href = '<?php echo base_url('purchase/purchase_approved')?>';">
                                        <h5>Approved </h5>
                                        <div class="col-md-12">
                                            <h3 class="apjpppp col-md-6"><?=$total_approvep?></h3>
                                            <i class="fa fa-home col-md-6 fa-3x"
                                                style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="c_card"  onclick="window.location.href = '<?php echo base_url('purchase/purchase_rejected')?>';">
                                        <h5>Rejected</h5>
                                        <div class="col-md-12">
                                            <h3 class="rejppp col-md-6"><?=$total_rejectedp?></h3>
                                            <i class="fa fa-clock-o col-md-6 fa-3x"
                                                style="height: -webkit-fill-available;text-align: -webkit-center;margin: 6px -3px;"
                                                class=" col-md-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        if ($total_data != 0) {
                            $percent_pending = ($total_pending / $total_data) * 100;
                            $percent_approve = ($total_approve / $total_data) * 100;
                            $percent_rejected = ($total_rejected / $total_data) * 100;
                        }else{
                            $percent_pending = 0;
                            $percent_approve = 0;
                            $percent_rejected = 0;
                        }

                        if ($total_datap != 0) {
                            $percent_pendingp = ($total_pendingp / $total_datap) * 100;
                            $percent_approvep = ($total_approvep / $total_datap) * 100;
                            $percent_rejectedp = ($total_rejectedp / $total_datap) * 100;
                        }else{
                            $percent_pendingp = 0;
                            $percent_approvep = 0;
                            $percent_rejectedp = 0;
                        }
                    ?>
                    <div class="col-md-6">
                        <div class="d_card" style="background: aliceblue;color: #683091;">
                            <h4>Requisition Statics</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="background: transparent;padding-top: 15px;box-shadow: 0px 0px 7px 1px #adadad;margin: 9px;border-radius: 5px;">
                                        <canvas id="myChart" style="width:100%"></canvas>
                                    </div>

                                    <script>
                                    const xValues = [
                                        'Total Pending',
                                        'Total Approve',
                                        'Total Rejected'
                                    ];
                                    const yValues = [<?=$percent_pending?>, <?=$percent_approve?>, <?=$percent_rejected?>];
                                    const barColors = [
                                        "#b91d47",
                                        "#00aba9",
                                        "#2b5797"
                                    ];

                                    new Chart("myChart", {
                                        type: "pie",
                                        data: {
                                            labels: xValues,
                                            datasets: [{
                                                data: yValues,
                                                backgroundColor: barColors,
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: "Requisition Status"
                                            }
                                        }
                                    });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d_card" style="background: aliceblue;color: #683091;">
                            <h4>Purchase Statics</h4>
                            <div class="row">

                                <div class="col-md-12">
                                    <div style="background: transparent;padding-top: 15px;box-shadow: 0px 0px 7px 1px #adadad;margin: 9px;border-radius: 5px;">
                                        <canvas id="myChartp" style="width:100%"></canvas>
                                    </div>
                                    <script>
                                    const xValuesp = [
                                        'Total Pending',
                                        'Total Approve',
                                        'Total Rejected'
                                    ];
                                    const yValuesp = [<?=$percent_pendingp?>, <?=$percent_approvep?>, <?=$percent_rejectedp?>];

                                    new Chart("myChartp", {
                                        type: "pie",
                                        data: {
                                            labels: xValuesp,
                                            datasets: [{
                                                data: yValuesp,
                                                backgroundColor: barColors,
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: "Purchase Status"
                                            }
                                        }
                                    });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function ajax_get_data() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var unit_id = $('#unit_id').val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>dashboard/ajax_get_data",
            data: {
                from_date: from_date,
                to_date: to_date,
                unit_id: unit_id
            },
            dataType: "json",
            success: function (data) {
                $('.reqid').html(data.total_data);
                $('.reqpen').html(data.total_pending);
                $('.reqaa').html(data.total_approve);
                $('.reqrrr').html(data.total_rejected);

                $('.gjhg').html(data.total_datap);
                $('.pejhuj').html(data.total_pendingp);
                $('.apjpppp').html(data.total_approvep);
                $('.rejppp').html(data.total_rejectedp);
                yValuess = [data.per_pending, data.per_approve, data.per_rejected];
                new Chart("myChart", {
                    type: "pie",
                    data: {
                        labels: xValuesp,
                        datasets: [{
                            data: yValuess,
                            backgroundColor: barColors,
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Requisition Status"
                        }
                    }
                });

                yValuesps = [data.per_pendingp, data.per_approvep, data.per_rejectedp];
                new Chart("myChartp", {
                    type: "pie",
                    data: {
                        labels: xValues,
                        datasets: [{
                            data: yValuesps,
                            backgroundColor: barColors,
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Requisition Status"
                        }
                    }
                });
            }
        });
    }
</script>

