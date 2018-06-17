<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
include 'header.php';
?>
<?php
$wr_id = $view_data['wr_id'];
$user_id = $view_data['user_id'];
$truck_id = $view_data['truck_id'];
$order_code = $view_data['order_code'];
$bank_id = $view_data['bank_id'];
$bank_name = $view_data['bank_name'];
$account_holder_name = $view_data['account_holder_name'];
$account_no = $view_data['account_no'];
$routing_no = $view_data['routing_no'];
$amount = $view_data['amount'];
$status = $view_data['status'];
$refund_withdraw = $view_data['refund_withdraw'];
$reason = $view_data['reason'];
$create_date = $view_data['create_date'];
$total_order = $view_data['total_order'];
$user_details = $view_data['user_details'];

$user_firstname = $view_data['user_details']['user_firstname'];
$user_lastname = $view_data['user_details']['user_lastname'];
$user_username = $view_data['user_details']['user_username'];
$user_emailid = $view_data['user_details']['user_emailid'];
$user_image = $view_data['user_details']['user_image'];
$user_dateofbirth = $view_data['user_details']['user_dateofbirth'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Refund Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>refund"><i class="fa fa-fw fa-retweet"></i> Refund</a></li>
            <li class="active">Refund Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-comment">
                    <?php
                    $default_path = base_url() . 'assets/dist/img/default.png';
                    $dynamic_path = base_url() . 'upload/user/' . $user_image;
                    ?>
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo $dynamic_path ?>" onerror="this.src='<?php echo $default_path ?>'">
                        <h3 class="profile-username text-center"><?php echo $user_username; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Total Order</b> <a class="pull-right"><?php echo $total_order; ?></a>
                            </li>
                        </ul>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#truck_activity" data-toggle="tab">Refund Request Details</a></li>
                        <li><a href="#timeline" data-toggle="tab">User Details</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="truck_activity">
                            <!-- general form elements -->
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Account Holder Name</label>
                                            <p class="text-muted"><?php echo $account_holder_name; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Bank Name</label>
                                            <p class="text-muted"><?php echo $bank_name; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Account No</label>
                                            <p class="text-muted"><?php echo $account_no; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Routing No</label>
                                            <p class="text-muted"><?php echo $routing_no; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Amount</label>
                                            <p class="text-muted"><?php echo '$' . number_format((float) $amount, 2, '.', '') ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Status</label>
                                            <p class="text-muted"><?php echo $status; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Reason</label>
                                            <textarea class="form-control" id="reason" placeholder="Enter ..." <?= ($status != 'pending') ? 'disabled' : '' ?>><?= $reason ?></textarea>
                                        </div>
                                        <?php
                                        if ($status == 'pending') {
                                            ?>
                                            <hr>
                                            <div class="form-group">

                                                <div class="col-md-2">
                                                    <label for="exampleInputPassword1">Reason</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href='javascript:void(0);' onclick="refund_approval(<?php echo $wr_id ?>, 'confirm');" class="btn btn-block btn-success">Confirm</a>
    <!--                                                    <button id="confirm" onclick="refund_approval(<?php echo $wr_id ?>, 'confirm');" class="btn btn-block btn-success">Confirm</button>-->
                                                </div>
                                                <div class="col-md-2">
                                                    <a href='javascript:void(0);' onclick="refund_approval(<?php echo $wr_id ?>, 'cancel');" class="btn btn-block btn-danger">Cancel</a>
    <!--                                                    <button id="cancel" onclick="refund_approval(<?php echo $wr_id ?>, 'cancel');" class="btn btn-block btn-danger">Cancel</button>-->
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div><!-- /.box-body -->
                                </form>
                            </div><!-- /.box -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- general form elements -->
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Name</label>
                                            <p class="text-muted"><?php echo $user_firstname . ' ' . $user_lastname; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Username</label>
                                            <p class="text-muted"><?php echo $user_username; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <p class="text-muted"><?php echo $user_emailid; ?></p>
                                        </div>
                                    </div><!-- /.box-body -->
                                </form>
                            </div><!-- /.box -->
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--<script>
    function refund_approval(wr_ids, statuss)
    {
        var wr_id = wr_ids;
        var status = statuss;
        var reason = $("#reason").val();
        
        var base_url = "<?php echo base_url(); ?>refund/request_refund_approval/";
        $.ajax({
            url: base_url,
            type: 'post',
            data: {
                wr_id: wr_id,
                status: status,
                reason:reason
            },
            success: function () {
            },
            error: function () {
                alert('ajax failure');
            }
        });


//        sweetAlert({
//            title: "",
//            text: "Are you sure to proceed?",
//            type: "",
//            showCancelButton: true,
//            confirmButtonColor: "#008d4c",
//            cancelButtonColor: '#d33',
//            confirmButtonText: "ok",
//            cancelButtonText: "cancel"
//        },
//        function (isConfirm) {
//            if (isConfirm == true)
//            {
//                var wr_id = wr_ids;
//                var status = statuss;
//                var reason = $("#reason").val();
//                var base_url = "<?php //echo base_url();   ?>refund/request_refund_approval/";
//                $.ajax({
//                    url: base_url,
//                    type: 'post',
//                    data: {
//                        wr_id: wr_id,
//                        status: status
//                    },
//                    success: function () {
//                    },
//                    error: function () {
//                        alert('ajax failure');
//                    }
//                });
//            }
//        });


    }


</script>-->


<script>
    var wr_id = '';
    var status = '';
    var reason = '';
    function refund_approval(wr_ids, statuss)
    {
        wr_id = wr_ids;
        status = statuss;
        reason = $("#reason").val();
        $("#transparent_background").show();
        $("#myModal2").show();
    }
    function delete_ok()
    {
        alert('hi');
        delete_cancel();
        var base_url = "<?php echo base_url(); ?>refund/request_refund_approval/";

        $.ajax({
            url: base_url,
            type: 'post',
            data: {
                wr_id: wr_id,
                status: status,
                reason: reason
            },
            success: function () {
            },
            error: function () {
                alert('ajax failure');
            }
        });
    }
    function delete_cancel()
    {
        $("#myModal2").hide();
        $("#transparent_background").hide();
    }
</script>
<?php
include 'footer.php';
?>
<div id="transparent_background" style="position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;background-color:#000;opacity:0.8;display:none;"></div>
<div id="myModal2" style="position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;display:none;">
    <form class="form-horizontal" method="post" id="confirm">
        <div id="myModal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Conformation</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to accept/cancel request ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return delete_cancel();" >Close</button>
                        <button type="button" class="btn btn-success" onclick="delete_ok();">Ok</button>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>
    </form>
</div>
