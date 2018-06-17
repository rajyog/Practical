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
$promocode_id = $view_data['promocode_id'];
$promocode_category = $view_data['promocode_category'];
$promocode_truck = $view_data['promocode_truck'];
$promocode_type = $view_data['promocode_type'];
$promocode_minimum_amount = $view_data['promocode_minimum_amount'];
$promocode_assign = $view_data['promocode_assign'];
$promocode_discount = $view_data['promocode_discount'];
$promocode_name = $view_data['promocode_name'];
$promocode_code = $view_data['promocode_code'];
$promocode_start_time = $view_data['promocode_start_time'];
$promocode_end_time = $view_data['promocode_end_time'];
$promocode_access = $view_data['promocode_access'];
$promoced_status = $view_data['promoced_status'];
$promocode_created = $view_data['promocode_created'];
$category = $view_data['category'];
$truck = $view_data['truck'];
$order_detail = $view_data['order_detail'];
$default_path = base_url() . 'assets/dist/img/default.png';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Promocode Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>promocode"><i class="fa fa-fw fa-ticket"></i> Promocode</a></li>
            <li class="active">Promocode Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#truck_activity" data-toggle="tab">Promocode Details</a></li>
                        <li><a href="#timeline" data-toggle="tab">Promocode Use Details</a></li>
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
                                            <p class="text-muted"><?php echo $promocode_name; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Code</label>
                                            <p class="text-muted"><?php echo $promocode_code; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Type</label>
                                            <p class="text-muted"><?php
                                                if ($promocode_type == '1') {
                                                    echo "% Off";
                                                } else {
                                                    echo "Amount Off";
                                                }
                                                ?></p>
                                        </div>
                                        <hr>
                                        <?php
                                        if ($promocode_type == '2') {
                                            ?>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Minimum Amount</label>
                                                <p class="text-muted"><?php echo $promocode_minimum_amount; ?></p>
                                            </div>
                                            <hr>
                                            <?php
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Assign By</label>
                                            <p class="text-muted"><?php echo $promocode_assign; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Start Time</label>
                                            <p class="text-muted"><?php echo date('M d Y G i A', strtotime($promocode_start_time)); ?></p>                                            
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">End Time</label>
                                            <p class="text-muted"><?php echo date('M d Y G i A', strtotime($promocode_end_time)); ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Category Name</label>
                                            <p class="text-muted"><?php echo $category; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Truck Name</label>
                                            <p class="text-muted"><?php echo $truck; ?></p>
                                        </div>
                                        <hr>
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
                                                        <th>Order code</th>
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
                                                            <td><?php echo $order_detail[$i]['order_code']; ?></td>
                                                            <td><?php echo $order_detail[$i]['quantity']; ?></td>
                                                            <td><?php echo date('M  d ,Y', strtotime($order_detail[$i]['order_date'])); ?></td>
                                                            <td><?php echo '$' . number_format((float) $order_detail[$i]['grand_total'], 2, '.', '') ?></td>
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
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php
include 'footer.php';
?>
