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
$order_detail = $view_data['order_detail'];
$promocode_details = $view_data['promocode_details'];
$user_detail = $view_data['user_detail'];
$user_id = $view_data['user_detail']['user_id'];
$user_firstname = $view_data['user_detail']['user_firstname'];
$user_lastname = $view_data['user_detail']['user_lastname'];
$user_username = $view_data['user_detail']['user_username'];
$user_dateofbirth = $view_data['user_detail']['user_dateofbirth'];
$user_emailid = $view_data['user_detail']['user_emailid'];
$truck_details = $view_data['truck_details'];
$truck_id = $view_data['truck_details']['truck_id'];
$truck_name = $view_data['truck_details']['truck_name'];
$truck_username = $view_data['truck_details']['truck_username'];
$truck_emailid = $view_data['truck_details']['truck_emailid'];
$truck_profile_image = $view_data['truck_details']['truck_profile_image'];
$truck_location = $view_data['truck_details']['truck_location'];
$truck_detail = $view_data['truck_details']['truck_detail'];
$truck_disclimer = $view_data['truck_details']['truck_disclimer'];
$truck_speciality = $view_data['truck_details']['truck_speciality'];
$truck_phoneno = $view_data['truck_details']['truck_phoneno'];
$truck_website = $view_data['truck_details']['truck_website'];
$truck_created = $view_data['truck_details']['truck_created'];

$giftcard_id = $view_data['giftcard_details']['giftcard_id'];
$giftcard_sender_id = $view_data['giftcard_details']['giftcard_sender_id'];
$giftcard_receiver_id = $view_data['giftcard_details']['giftcard_receiver_id'];
$giftcard_message = $view_data['giftcard_details']['giftcard_message'];
$giftcard_amount = $view_data['giftcard_details']['giftcard_amount'];
$giftcard_status = $view_data['giftcard_details']['giftcard_status'];
$sender_username = $view_data['giftcard_details']['user_username'];



//$total_review = $view_data['total_review'];
//$total_like = $view_data['total_like'];
//$total_favourite = $view_data['total_favourite'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Order Detail
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>order"><i class="fa fa-cart-plus "></i> Order</a></li>
            <li class="active">Order Detail</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!--            <div class="col-md-3">
                             Profile Image 
                            <div class="box box-comment">
            <?php
            $default_path = base_url() . 'assets/dist/img/default.png';
//$dynamic_path = base_url() . 'upload/truck/' . $truck_profile_image;
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
                                </div> /.box-body 
                            </div> /.box 
            
                        </div> /.col -->
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#truck_activity" data-toggle="tab">Order</a></li>
                        <li><a href="#timeline" data-toggle="tab">User Details</a></li>
                        <li><a href="#settings" data-toggle="tab">Truck Details</a></li>
                        <li><a href="#giftcard" data-toggle="tab">Giftcard Details</a></li>
                        <li><a href="#promocode" data-toggle="tab">Promocode Details</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="truck_activity">
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
                                                        <th>Date</th>
                                                        <th>Price</th>
                                                        <th>Instruction</th>
                                                    </tr>
                                                    <?php
                                                    for ($i = 0; $i < count($order_detail); $i++) {
                                                        ?>
                                                        <tr>
                                                            <td><img src="<?php echo base_url() . 'upload/items/' . $order_detail[$i]['item_image']; ?>" onerror="this.src='<?php echo $default_path ?>'" style="width:50px;height:50px;" /></td><!--        
                                                            -->                                                         <td><?php echo $order_detail[$i]['item_title']; ?></td>
                                                            <td><?php echo $order_detail[$i]['quantity']; ?></td>
                                                            <td><?php echo date('M d Y', strtotime($order_detail[$i]['order_date'])); ?></td>
                                                            <td><?php echo '$' . number_format((float) $order_detail[$i]['grand_total'], 2, '.', '') ?></td>
                                                            <td><?php echo $order_detail[$i]['special_instruction']; ?></td>
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
                        </div><!--/.tab-pane--> 
                        <div class="tab-pane" id="timeline">
                            <!-- general form elements -->
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile">First Name</label>
                                            <p class="text-muted"><?php echo $user_firstname; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Last Name</label>
                                            <p class="text-muted"><?php echo $user_lastname; ?></p>
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
                            </div><!--/.box--> 
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="settings">
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Name</label>
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
                                            <p class="text-muted"><?php echo $user_emailid; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Details</label>
                                            <p class="text-muted"><?php echo $truck_detail; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Disclimer</label>
                                            <p class="text-muted"><?php echo $truck_disclimer; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Speciality</label>
                                            <p class="text-muted"><?php echo $truck_speciality; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Phoneno</label>
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
                        <div class="tab-pane" id="giftcard">
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Sender Name</label>
                                            <p class="text-muted"><?php echo $user_username; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Message</label>
                                            <p class="text-muted"><?php echo $giftcard_message; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Amount</label>
                                            <p class="text-muted"><?php echo '$' . number_format((float) $giftcard_amount, 2, '.', '') ?></p>
                                            
                                        </div>
                                    </div><!-- /.box-body -->
                                </form>
                            </div><!-- /.box -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="promocode">
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="box-body no-padding">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Code</th>
                                                        <th>Type</th>
                                                        <th>Discount</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                    </tr>
                                                    <?php
                                                    for ($i = 0; $i < count($promocode_details); $i++) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $promocode_details[$i]['promocode_name']; ?></td>
                                                            <td><?php echo $promocode_details[$i]['promocode_code']; ?></td>
                                                            <td><?php 
                                                            if($promocode_details[$i]['promocode_type']=='1'){
                                                                echo "% Off";
                                                            }  else {
                                                                echo "Amount Off";
                                                            }?></td>
                                                            <td><?php echo $promocode_details[$i]['promocode_discount']; ?></td>
                                                            <td><?php echo date('M d Y', strtotime($promocode_details[$i]['promocode_start_time'])); ?></td>
                                                            <td><?php echo date('M d Y', strtotime($promocode_details[$i]['promocode_end_time'])); ?></td>
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
