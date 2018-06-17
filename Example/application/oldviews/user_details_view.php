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
//foreach ($view_data as $row => $value) {
$user_id = $view_data['user_id'];
$user_firstname = $view_data['user_firstname'];
$user_lastname = $view_data['user_lastname'];
$user_username = $view_data['user_username'];
$user_emailid = $view_data['user_emailid'];
$user_image = $view_data['user_image'];
$user_dateofbirth = $view_data['user_dateofbirth'];
$user_created = $view_data['user_created'];
$total_order = $view_data['total_order'];
$order_list = $view_data['order_list'];
//}
?> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="fa fa-user"></i> User</a></li>
            <li class="active">User profile</li>
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
                        <li class="active"><a href="#activity" data-toggle="tab">User Details</a></li>
                        <li><a href="#timeline" data-toggle="tab">User Orders</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- general form elements -->
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <p class="text-muted"><?php echo $user_emailid; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Username</label>
                                            <p class="text-muted"><?php echo $user_username; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Date Of Birth</label>
                                            <p class="text-muted"><?php echo date('M d Y', strtotime($user_dateofbirth)); ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Join In Date </label>
                                            <p class="text-muted"><?php echo date('M d Y', strtotime($user_created)); ?></p>
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
                                        <div class="box-body no-padding">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Item Name</th>
                                                        <th>Quantity</th>
                                                        <th>Order Date</th>
                                                        <th>Price</th>
                                                    </tr>
                                                    <?php
                                                    for ($i = 0; $i < count($order_list); $i++) {
                                                        ?>
                                                        <tr>
                                                            <td><img src="<?php echo $order_list[$i]['item_image']; ?>" onerror="this.src='<?php echo $default_path ?>'" style="width:50px;height:50px;" /></td>
                                                            <td><?php echo $order_list[$i]['item_title']; ?></td>
                                                            <td><?php echo $order_list[$i]['quantity']; ?></td>
                                                            <td><?php echo date('M d Y', strtotime($order_list[$i]['order_date'])); ?></td>
                                                            <td><?php echo '$' . number_format((float) $order_list[$i]['item_price'], 2, '.', '') ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <hr>
                                            <br />
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
