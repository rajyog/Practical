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
$giftcard_id = $view_data['giftcard_id'];
$giftcard_sender_id = $view_data['giftcard_sender_id'];
$giftcard_receiver_id = $view_data['giftcard_receiver_id'];
$giftcard_message = $view_data['giftcard_message'];
$giftcard_amount = $view_data['giftcard_amount'];
$giftcard_status = $view_data['giftcard_status'];
$giftcard_created = $view_data['giftcard_created'];
$total_order = $view_data['total_order'];
$receiver_detail = $view_data['receiver_detail'];

$user_firstname = $view_data['receiver_detail']['user_firstname'];
$user_lastname = $view_data['receiver_detail']['user_lastname'];
$user_image = $view_data['receiver_detail']['user_image'];

$sender_firstname = $view_data['sender_detail']['user_firstname'];
$sender_lastname = $view_data['sender_detail']['user_lastname'];
$sender_user_emailid = $view_data['sender_detail']['user_emailid'];
$sender_user_username = $view_data['sender_detail']['user_username'];
$sender_image = $view_data['sender_detail']['user_image'];

$default_path = base_url() . 'assets/dist/img/default.png';
?> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Giftcard Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>giftcard"><i class="fa fa-fw fa-gift"></i>Giftcard</a></li>
            <li class="active">Giftcard Details</li>
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
                    ?>

                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . 'upload/user/' . $user_image; ?>" onerror="this.src='http://localhost/letseat/assets/dist/img/default.png'">
                        <h3 class="profile-username text-center"><?php echo $user_firstname . '&nbsp&nbsp;' . $user_lastname; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Orders</b> <a class="pull-right"><?php echo $total_order; ?></a>
                            </li>
                            <?php
//                            $timezone = date('T');
//                            echo $timezone;
//                            $myDateTime = new DateTime('2016-03-21 13:14', $timezone);
//                            $offset = $userTimezone->getOffset($myDateTime);
//                            echo $offset;
                            //echo $myDateTime;
                            ?>
                        </ul>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Giftcard Details</a></li>
                        <li><a href="#timeline" data-toggle="tab">Sender Details</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- general form elements -->
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Amount</label>
                                            <p class="text-muted"><?php echo '$' . number_format((float) $giftcard_amount, 2, '.', '') ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Message</label>
                                            <p class="text-muted"><?php echo $giftcard_message; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Status </label>
                                            <p class="text-muted"><?php echo $giftcard_status; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Created Date </label>
                                            <p class="text-muted"><?php echo date('M d Y', strtotime($giftcard_created)); ?></p>
                                        </div>
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
                                            <!--<p class="text-muted"><?php echo $sender_user_username; ?></p>-->
                                            <img src="<?php echo base_url() . 'upload/user/' . $sender_image; ?>" onerror="this.src='<?php echo $default_path;?>'" alt="image not found" style="height: 250px; width: 100%;">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Name</label>
                                            <p class="text-muted"><?php echo $sender_firstname . ' ' . $sender_lastname; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Username </label>
                                            <p class="text-muted"><?php echo $sender_user_username; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <p class="text-muted"><?php echo $sender_user_emailid; ?></p>
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
<?php
include 'footer.php';
?>
