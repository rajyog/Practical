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
<!-- Minified Bootstrap CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!-- Minified JS library -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!-- Minified Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="<?php echo base_url(); ?>assets/bootstrap_datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/bootstrap_datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<?php
//print_r($edit_data);
//die;

$promocode_type = $edit_data['promocode_type'];
$promocode_minimum_amount = $edit_data['promocode_minimum_amount'];
$promocode_assign = $edit_data['promocode_assign'];
$promocode_access = $edit_data['promocode_access'];
//echo $promocode_access;
//die;
$promocode_access_Array = explode(',', $promocode_access);
$promocode_category = $edit_data['promocode_category'];
$promocode_truck = $edit_data['promocode_truck'];
$promocode_id = $edit_data['promocode_id'];
$promocode_discount = $edit_data['promocode_discount'];
$promocode_name = $edit_data['promocode_name'];
$promocode_code = $edit_data['promocode_code'];
$promocode_start_time = $edit_data['promocode_start_time'];
$promocode_end_time = $edit_data['promocode_end_time'];
$promoced_status = $edit_data['promoced_status'];
$no_of_use = $edit_data['no_of_use'];

//}
?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Promo code
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>promocode"><i class="fa fa-fw fa-ticket"></i> Promo code</a></li>
            <li><a href="#">Edit Promo code</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-comment">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Promocode</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="edit_promocode">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_name" value="<?php echo $promocode_name; ?>" placeholder="Enter Promocode Name">
                                    <input type="hidden" class="form-control" id="promocode_id" value="<?php echo $promocode_id; ?>" placeholder="Enter Promocode Name">
                                </div>
                                <label for="inputPassword3" id="error_promocode_name" class="control-label pull-left"></label>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Truck</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="filter_truck_name">
                                        <option value="0">All</option>
                                        <?php
                                        foreach ($truck as $row => $value) {
//                                            echo '<option value="' . $value['truck_id'] . '">' . $value['truck_username'] . '</option>';
                                            ?>
                                            }
                                            <option 
                                                value="<?= $value['truck_id'] ?>" <?= ($value['truck_id'] == $promocode_truck) ? 'selected' : '' ?> ><?= $value['truck_username'] ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_truck_name" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="filter_category_name">
                                        <option value="all" id="select_all_category">All</option>
                                        <?php
                                        foreach ($category as $row => $value) {
//                                            echo '<option value="' . $value['category_id'] . '">' . $value['category_name'] . '</option>';
                                            ?>
                                            <option 
                                                value="<?= $value['category_id'] ?>" <?= ($value['category_id'] == $promocode_category) ? 'selected' : '' ?> ><?= $value['category_name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_category_name" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="filter_promocode_type">
                                        <option value="" selected="selected">-- select --</option>
                                        <option value="1" <?= 1 == $promocode_type ? 'selected' : '' ?>>% off</option>
                                        <option value="2" <?= 2 == $promocode_type ? 'selected' : '' ?>>AMOUNT off</option>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_promocode_type" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group" id="minimum" style="display:<?= '2' == $promocode_type ? 'block' : 'none' ?>">
                                <label for="inputPassword3" class="col-sm-2 control-label">Mini Amount</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_amount" value="<?php echo $promocode_minimum_amount; ?>" placeholder="Enter minimum amount">
                                </div>
                                <label for="inputPassword3" id="error_promocode_amount" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Assign By</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="filter_promocode_assign">
                                        <option value="" selected="selected">-- select --</option>
                                        <option value="admin" <?= 'admin' == $promocode_assign ? 'selected' : '' ?>>Admin</option>
                                        <option value="truck" <?= 'truck' == $promocode_assign ? 'selected' : '' ?>>Truck</option>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_promocode_type" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Discount</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_discount" placeholder="Enter amoint or % off Discount" value="<?php echo $promocode_discount; ?>">
                                </div>
                                <label for="inputPassword3" id="error_promocode_discount" class="control-label pull-left"></label>
                            </div>



                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Code</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_code" value="<?php echo $promocode_code; ?>" placeholder="Enter Promocode code">
                                </div>
                                <label for="inputPassword3" id="error_promocode_code" class="control-label pull-left"></label>
                            </div>



                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Start Time</label>
                                <div class="col-sm-5">
<!--                                    <input id="datepicker" class="form-control" value="<?php echo $promocode_start_time; ?>" placeholder="Enter Start Date"/>-->
                                    <input class="form-control" id="datetime" placeholder="Enter Start Date" value="<?php echo $promocode_start_time; ?>">
                                    <script type="text/javascript">
                                        $("#datetime").datetimepicker({
                                            format: 'yyyy-mm-dd hh:ii',
                                            autoclose: true
                                        });
                                    </script>

                                </div>
                                <label for="inputPassword3" id="error_datepicker" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">End Time</label>
                                <div class="col-sm-5">
<!--                                        <input id="datepicker1" class="form-control" value="<?php echo $promocode_end_time; ?>" placeholder="Enter End Date"/>-->
                                    <input class="form-control" id="datetime1" placeholder="Enter Start Date" value="<?php echo $promocode_end_time; ?>">
                                    <script type="text/javascript">
                                        $("#datetime1").datetimepicker({
                                            format: 'yyyy-mm-dd hh:ii',
                                            autoclose: true
                                        });
                                    </script>
                                </div>
                                <label for="inputPassword3" id="error_datepicker1" class="control-label pull-left"></label>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Access</label>
                                <div class="col-sm-5">
                                    <select multiple class="form-control" id="filter_promocode_access">
                                        <option value="all" id="select_all">All</option>
                                        <?php
                                        foreach ($user as $row => $value) {
//                                            echo '<option value="' . $value['user_id'] . '">' . $value['user_username'] . '</option>';
//                                            if (in_array($value['user_id'], $promocode_access_Array)) {
//                                                
//                                            }
                                            ?>
                                            <option value="<?= $value['user_id'] ?>" <?= (in_array($value['user_id'], $promocode_access_Array)) ? 'selected' : '' ?> ><?= $value['user_username'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_promocode_access" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">No Of Use</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_no_of_use" placeholder="Enter number of time use" value="<?php echo $no_of_use; ?>">
                                    <p class="help-block">Note if you provide unlimited then enter no of use 0 (zero). </p>
                                </div>
                                <label for="inputPassword3" id="error_promocode_no_of_use" class="control-label pull-left"></label>
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class=" col-sm-offset-2">
                                <button type="submit" class="btn bg-purple">Edit Promocode</button>
                                <label for="inputPassword3" id="error_message" class="control-label"></label>
                            </div>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->

                <script type="text/javascript">
                    var page = '0';//use in pagination
                    $(document).ready(function () {
//                        $("#datepicker").datepicker();
//                        $("#datepicker1").datepicker();

                        $('#filter_promocode_access').click(function () {
                            var promocode_access_count = $("#filter_promocode_access :selected").length;
                            var data = "No Of Selected User " + promocode_access_count;
                            $("#error_promocode_access").text(data);
                        });

                        $('#filter_promocode_type').change(function () {
                            //alert('hi');
                            var promocode_type = $("#filter_promocode_type").val();
                            //alert(promocode_type);
                            var current_value = filter_promocode_type.options[filter_promocode_type.selectedIndex].value;
                            //alert(current_value);
                            if (current_value == "2") {
                                $('#minimum').show();
                            }
                            else {
                                $('#minimum').hide();
                            }
                        });


                        $("#edit_promocode").on("submit", function (e) {
                            e.preventDefault();
                            var promocode_id = $("#promocode_id").val();
                            var promocode_name = $("#promocode_name").val();
                            var truck_name = $("#filter_truck_name").val();
                            var category_name = $("#filter_category_name").val();
                            var promocode_type = $("#filter_promocode_type").val();
                            var promocode_amount = $("#promocode_amount").val();
                            var promocode_assign = $("#filter_promocode_assign").val();
                            var promocode_discount = $("#promocode_discount").val();
                            var promocode_code = $("#promocode_code").val();
                            var start_date = $('#datetime').val();
                            var end_date = $('#datetime1').val();
                            var promocode_access = $('#filter_promocode_access').val();
                            var promocode_no_of_use = $('#promocode_no_of_use').val();

                            var base_url = "<?php echo base_url(); ?>promocode/edit_promocode_data";

                            if (promocode_name == null || promocode_name == "") {
                                var data = "Please enter promocode name.";
                                $("#error_promocode_name").text(data);
                                return false;
                            } else {
                                $("#error_promocode_name").text("");
                            }
                            if (truck_name == null || truck_name == "") {
                                var data = "Please select truck.";
                                $("#error_truck_name").text(data);
                                return false;
                            } else {
                                $("#error_truck_name").text("");
                            }
                            if (category_name == null || category_name == "") {
                                var data = "Please select category.";
                                $("#error_truck_name").text(data);
                                return false;
                            } else {
                                $("#error_truck_name").text("");
                            }
                            if (promocode_type == null || promocode_type == "") {
                                var data = "Please select promocode type.";
                                $("#error_promocode_type").text(data);
                                return false;
                            } else {
                                $("#error_promocode_type").text("");
                            }
                            if (promocode_amount == null || promocode_amount == "" && promocode_type == '2') {
                                var data = "Please Enter promocode amount.";
                                $("#error_promocode_amount").text(data);
                                return false;
                            } else {
                                $("#error_promocode_amount").text("");
                            }
                            if (promocode_amount < 10) {
                                var data = "Please Enter minimum 10 promocode amount.";
                                $("#error_promocode_amount").text(data);
                                return false;
                            } else {
                                $("#error_promocode_amount").text("");
                            }
                            if (promocode_discount == null || promocode_discount == "") {
                                var data = "Please select promocode discount.";
                                $("#error_promocode_discount").text(data);
                                return false;
                            } else {
                                $("#error_promocode_discount").text("");
                            }
                            if (promocode_code == null || promocode_code == "") {
                                var data = "Please enter promocode code.";
                                $("#error_promocode_code").text(data);
                                return false;
                            } else {
                                $("#error_promocode_code").text("");
                            }
                            if (promocode_code.length < 6 || promocode_code.length > 6) {
                                var data = "promocode must be 8 Character";
                                $("#error_promocode_code").text(data);
                                return false;
                            } else
                            {
                                $("#error_promocode_code").text("");
                            }

                            if (promocode_access == null || promocode_access == "") {
                                var data = "Please select promocode access.";
                                $("#error_promocode_access").text(data);
                                return false;
                            } else {
                                $("#error_promocode_access").text("");
                            }
                            if (promocode_access == null || promocode_access == "") {
                                var data = "Please select promocode access.";
                                $("#error_promocode_access").text(data);
                                return false;
                            } else {
                                $("#error_promocode_access").text("");
                            }
                            if (promocode_no_of_use == null || promocode_no_of_use == "") {
                                var data = "Please enter promocode no of use.";
                                $("#error_promocode_no_of_use").text(data);
                                return false;
                            } else {
                                $("#error_promocode_no_of_use").text("");
                            }

                            $.ajax({
                                type: 'POST',
                                url: base_url,
                                data: {
                                    promocode_id: promocode_id,
                                    promocode_name: promocode_name,
                                    truck_name: truck_name,
                                    category_name: category_name,
                                    promocode_type: promocode_type,
                                    promocode_amount: promocode_amount,
                                    promocode_assign: promocode_assign,
                                    promocode_discount: promocode_discount,
                                    promocode_code: promocode_code,
                                    start_date: start_date,
                                    end_date: end_date,
                                    promocode_access: promocode_access,
                                    promocode_no_of_use: promocode_no_of_use
                                },
                                success: function (data)
                                {
//                                    alert(data);
                                    if (data == 0) {
                                        $("#promocode_name").val("");
                                        $("#promocode_code").val("");
                                        $("#promocode_description").val("");
                                        $('#datepicker').val("");
                                        $('#datepicker1').val("");
//                                        $("#error_message").text('Promocode successfully inserted');
                                        window.location.href = "<?php echo base_url(); ?>promocode/index";
                                    }
                                    if (data == 1) {
                                        $("#promocode_name").val("");
                                        $("#promocode_code").val("");
                                        $("#promocode_description").val("");
                                        $('#datepicker').val("");
                                        $('#datepicker1').val("");
                                        $("#error_message").text('Server Authentication Failed Please Try Again');
                                    }
                                    if (data == 3) {
                                        $("#promocode_name").val("");
                                        $("#promocode_code").val("");
                                        $("#promocode_description").val("");
                                        $('#datepicker').val("");
                                        $('#datepicker1').val("");
                                        $("#error_message").text('Promocode already exist please try other name.');
                                    }
                                },
                                error: function () {

                                }
                            });
                        });
                    });
                </script>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
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
                        <h4 class="modal-title">Delete Warnning</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return delete_cancel();">Close</button>
                        <button type="button" class="btn btn-success" onclick="delete_ok();">OK</button>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>
    </form>
</div>
