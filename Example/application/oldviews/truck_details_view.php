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
//    $truck_id = $value['truck_id'];
//    $truck_name = $value['truck_name'];
//    $truck_username = $value['truck_username'];
//    $truck_emailid = $value['truck_emailid'];
//    $truck_profile_image = $value['truck_profile_image'];
//    $truck_location = $value['truck_location'];
//    $truck_detail = $value['truck_detail'];
//    $truck_disclimer = $value['truck_disclimer'];
//    $truck_speciality = $value['truck_speciality'];
//    $truck_phoneno = $value['truck_phoneno'];
//    $truck_website = $value['truck_website'];
//    $truck_created = $value['truck_created'];
//    $total_review = $value['total_review'];
//    $total_like = $value['total_like'];
//    $total_favourite = $value['total_favourite'];
//}

$truck_id = $view_data['truck_id'];
$truck_name = $view_data['truck_name'];
$truck_username = $view_data['truck_username'];
$truck_emailid = $view_data['truck_emailid'];
$truck_profile_image = $view_data['truck_profile_image'];
$truck_location = $view_data['truck_location'];
$truck_detail = $view_data['truck_detail'];
$truck_disclimer = $view_data['truck_disclimer'];
$truck_speciality = $view_data['truck_speciality'];
$truck_phoneno = $view_data['truck_phoneno'];
$truck_website = $view_data['truck_website'];
$truck_created = $view_data['truck_created'];
$total_review = $view_data['total_review'];
$total_like = $view_data['total_like'];
$total_favourite = $view_data['total_favourite'];
$order_detail = $view_data['order_detail'];
$schedule_detail = $view_data['schedule_detail'];
$item_detail = $view_data['item_detail'];


for ($i = 0; $i < count($order_detail); $i++) {
    $order_id = $order_detail[$i]['order_id'];
    $item_title = $order_detail[$i]['item_title'];
    $item_price = $order_detail[$i]['item_price'];
    $quantity = $order_detail[$i]['quantity'];
    $order_date = $order_detail[$i]['order_date'];
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Truck Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>truck"><i class="fa fa-truck"></i> Truck</a></li>
            <!--            <li><a href="#">Examples</a></li>-->
            <li class="active">Truck profile</li>
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
                        <li class="active"><a href="#truck_activity" data-toggle="tab">Truck Details</a></li>
                        <li><a href="#timeline" data-toggle="tab">Order</a></li>
                        <li><a href="#settings" data-toggle="tab">Schedule</a></li>
                        <li><a href="#truck_item" data-toggle="tab">Items</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="truck_activity">
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
                                            <label for="exampleInputPassword1">Details</label>
                                            <p class="text-muted"><?php echo $truck_detail; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Desclimer</label>
                                            <p class="text-muted"><?php echo $truck_disclimer; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Speciality</label>
                                            <p class="text-muted"><?php echo $truck_speciality; ?></p>
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
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Join In Date </label>
                                            <p class="text-muted"><?php echo date('M d Y', strtotime($truck_created)); ?></p>
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
                                                    for ($i = 0; $i < count($order_detail); $i++) {
                                                        ?>
                                                        <tr>
                                                            <td><img src="<?php echo base_url() . 'upload/items/' . $order_detail[$i]['item_image']; ?>" onerror="this.src='<?php echo $default_path ?>'" style="width:50px;height:50px;" /></td>
                                                            <td><?php echo $order_detail[$i]['item_title']; ?></td>
                                                            <td><?php echo $order_detail[$i]['quantity']; ?></td>
                                                            <td><?php echo date('M d Y', strtotime($order_detail[$i]['order_date'])); ?></td>
                                                            <td><?php echo '$' . number_format((float) $order_detail[$i]['item_price'], 2, '.', '') ?></td>
                                                            
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
                        <div class="tab-pane" id="settings">
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="box-body no-padding">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Strat Time</th>
                                                        <th>End Time</th>
                                                        <th>Address</th>
                                                    </tr>
                                                    <?php
                                                    for ($i = 0; $i < count($schedule_detail); $i++) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo date('M d Y', strtotime($schedule_detail[$i]['schedule_date'])); ?></td>
                                                            <td><?php echo $schedule_detail[$i]['schedule_start_time']; ?></td>
                                                            <td><?php echo $schedule_detail[$i]['schedule_end_time']; ?></td>
                                                            <td><?php echo $schedule_detail[$i]['schedule_location']; ?></td>
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
                        <div class="tab-pane" id="truck_item">
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="box-body no-padding">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                    </tr>
                                                    <?php
                                                    for ($i = 0; $i < count($item_detail); $i++) {
                                                        ?>
                                                        <tr>
                                                            <td><img src="<?php echo base_url() . 'upload/items/' . $item_detail[$i]['item_image']; ?>" onerror="this.src='<?php echo $default_path ?>'" style="width:50px;height:50px;" /></td>
                                                            <td><?php echo $item_detail[$i]['item_title']; ?></td>                               
                                                              <td><?php echo '$' . number_format((float) $item_detail[$i]['item_price'], 2, '.', '') ?></td>
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
