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
$total_review = $view_data['total_review'];
$total_like = $view_data['total_like'];
$total_favourite = $view_data['total_favourite'];
$truck_details = $view_data['truck_details'];

$truck_name = $view_data['truck_details']['truck_name'];
$truck_username = $view_data['truck_details']['truck_username'];
$truck_emailid = $view_data['truck_details']['truck_emailid'];
$truck_profile_image = $view_data['truck_details']['truck_profile_image'];
$truck_location = $view_data['truck_details']['truck_location'];
$truck_phoneno = $view_data['truck_details']['truck_phoneno'];
$truck_website = $view_data['truck_details']['truck_website'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Withdraw Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>withdraw"><i class="fa fa-fw fa-credit-card"></i> Withdraw</a></li>
            <li class="active">Withdraw Details</li>
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
                    $dynamic_path = base_url() . 'upload/truck/' . $truck_profile_image;
//echo base_url() . 'upload/user/' . $truck_profile_image;
                    ?>
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo $dynamic_path ?>" onerror="this.src='<?php echo $default_path ?>'">
                        <h3 class="profile-username text-center"><?php echo $truck_name; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Favorite</b> <a class="pull-right"><?php echo $total_favourite; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Likes</b> <a class="pull-right"><?php echo $total_like; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Reviews</b> <a class="pull-right"><?php echo $total_review; ?></a>
                            </li>
                        </ul>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#truck_activity" data-toggle="tab">Withdraw Request Details</a></li>
                        <li><a href="#timeline" data-toggle="tab">Truck Details</a></li>
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
                                            <textarea class="form-control" id="reason" placeholder="Enter ..." <?= ($status != 'pending') ? 'disabled' : '' ?> ><?= $reason ?></textarea>
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
                                                    <a href='javascript:void(0);' onclick="withdraw_approval('<?php echo $wr_id ?>', 'confirm');" class="btn btn-block btn-success">Confirm</a>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href='javascript:void(0);' onclick="withdraw_approval('<?php echo $wr_id ?>', 'cancel');" class="btn btn-block btn-danger">Cancel</a>
                                                </div>
                                                <!--                                                <div class="col-md-2">
                                                                                                    <button onclick="withdraw_approval('<?php echo $wr_id ?>', 'confirm');" class="btn btn-block btn-success">Confirm</button>
                                                                                                </div>-->
                                                <!--                                                <div class="col-md-2">
                                                                                                    <button  onclick="withdraw_approval('<?php echo $wr_id ?>', 'cancel');" class="btn btn-block btn-danger">Cancel</button>
                                                                                                </div>-->
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
                                            <p class="text-muted"><?php echo $truck_name; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Username</label>
                                            <p class="text-muted"><?php echo $truck_username; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <p class="text-muted"><?php echo $truck_emailid; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Address</label>
                                            <p class="text-muted"><?php echo $truck_location; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Phone No</label>
                                            <p class="text-muted"><?php echo $truck_phoneno; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Website</label>
                                            <p class="text-muted"><?php echo $truck_website; ?></p>
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
    function withdraw_approval(wr_ids, statuss)
    {
        var wr_id = wr_ids;
        var status = statuss;
        var reason = $("#reason").val();
        var base_url = "<?php echo base_url(); ?>withdraw/request_withdraw_approval/";
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

//        swal({
//            title: 'Are you sure?',
//            text: "You won't be able to revert this!",
//            type: 'warning',
//            showCancelButton: true,
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            confirmButtonText: 'Yes, delete it!'
//        }, function () {
//            $.ajax({
//                url: base_url,
//                type: 'post',
//                data: {
//                    wr_id: wr_id,
//                    status: status
//                },
//                success: function () {
//                },
//                error: function () {
//                    alert('ajax failure');
//                }
//            });
//        });



//        sweetAlert({
//            title: "Your account will be deleted permanently!",
//            text: "Are you sure to proceed?",
//            type: "warning",
//            showCancelButton: true,
//            confirmButtonColor: "#DD6B55",
//            confirmButtonText: "ok",
//            cancelButtonText: "cancel",
//            closeOnConfirm: true,
//            closeOnCancel: true
//        },
//        function (isConfirm) {
//            if (isConfirm == true)
//            {
//                console.log('ok');
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
//            } else {
//                console.log('no');
//                swal("Hurray", "Account is not removed!", "error");
//
//            }
//        });
       // swal("Hello world!");
       
       
        
    }

</script>-->
<script>
    var wr_id = '';
    var status = '';
    var reason = '';
    function withdraw_approval(wr_ids, statuss)
    {
        wr_id = wr_ids;
        status = statuss;
        reason = $("#reason").val();
        $("#transparent_background").show();
        $("#myModal2").show();
    }
    function delete_ok()
    {
//        alert('hi');
        delete_cancel();
        var base_url = "<?php echo base_url(); ?>withdraw/request_withdraw_approval/";
        $.ajax({
            url: base_url,
            type: 'post',
            data: {
                wr_id: wr_id,
                status: status,
                reason: reason
            },
            success: function () {
                location.reload();
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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


<!--<div id="myModal2" class="modal-dialog">
    <div class="modal-header">
        <h3>Delete Warnning</h3>
    </div>
    <div class="modal-body">
        <p>Are you sure you want to delete?</p>
    </div>
    <div class="modal-footer">
        <input type="button" data-dismiss="modal" class="btn btn-inverse" onclick="delete_ok();" id="ok" value="Ok">
        <input type="button" data-dismiss="modal" class="btn btn-inverse" onclick="return delete_cancel();"id="cancel" value="Cancel">
    </div>
</div>-->
