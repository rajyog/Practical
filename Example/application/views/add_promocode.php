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

<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<link href="<?php echo base_url(); ?>assets/jquery.multiselect.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/jquery.multiselect.js" type="text/javascript"></script>

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
$sd = new DateTime($promocode_start_time);
$start_date = $sd->format('m/d/Y');
//$start_time = $sd->format('H:i:s');
//echo $start_time;
$start_time = $sd->format('h:i A');

$start_hours = $sd->format('h');
$start_minutes = $sd->format('i');
$start_am_pm = $sd->format('A');

//die;
$promocode_end_time = $edit_data['promocode_end_time'];
$ed = new DateTime($promocode_end_time);
$end_date = $ed->format('m/d/Y');
//$time = $dt->format('H:i:s');


$end_time = $sd->format('h:i A');

$end_hours = $sd->format('h');

$end_minutes = $sd->format('i');

$end_am_pm = $sd->format('A');





//echo $date, ' | ', $time;
//die;

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
            <li><a href="<?php echo base_url(); ?>promocode"><i class="fa fa-fw fa-ticket"></i>Offer code</a></li>
            <li><a href="#">Edit Offer Code</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-comment">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Offer Code</h3>
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
                                <label for="inputPassword3" class="col-sm-2 control-label">Offered By</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="filter_promocode_assign">
                                        <option value="" selected="selected">-- select --</option>
                                        <option value="admin" <?= 'admin' == $promocode_assign ? 'selected' : '' ?>>Admin</option>
                                        <option value="truck" <?= 'truck' == $promocode_assign ? 'selected' : '' ?>>Truck</option>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_promocode_assign" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Truck</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="filter_truck_name">
                                        <option value="" selected="selected">-- select Truck --</option>
                                        <option value="0" <?= ( 0 == $promocode_truck) ? 'selected' : '' ?> >All</option>
                                        <?php
                                        foreach ($truck as $row => $value) {
//                                            echo '<option value="' . $value['truck_id'] . '">' . $value['truck_username'] . '</option>';
                                            ?>
                                            }
                                            <option 
                                                value="<?= $value['truck_id'] ?>" <?= ($value['truck_id'] == $promocode_truck) ? 'selected' : '' ?> ><?= $value['truck_name'] ?></option>
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
                                        <option value="" selected="selected">-- select Category --</option>
                                        <option value="0" <?= (0 == $promocode_category) ? 'selected' : '' ?> id="select_all_category" >All</option>
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
                                <label for="inputPassword3" class="col-sm-2 control-label">Mini. Amount</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_amount" value="<?php echo $promocode_minimum_amount; ?>" placeholder="Enter minimum food order amount">
                                </div>
                                <label for="inputPassword3" id="error_promocode_amount" class="control-label pull-left"></label>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Discount</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_discount" placeholder="Enter Discount in amount or % off" value="<?php echo $promocode_discount; ?>">
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
                                <label for="inputPassword3" class="col-sm-2 control-label">Start Date</label>
                                <div class="col-sm-5">
                                    <input id="datepicker" class="form-control" value="<?php echo $start_date; ?>"  placeholder="Start Date"/>
                                </div>
                                <label for="inputPassword3" id="error_datepicker" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">End date</label>
                                <div class="col-sm-5">
                                    <input id="datepicker1" class="form-control" value="<?php echo $end_date; ?>" placeholder="Enter End Date"/>


                                </div>
                                <label for="inputPassword3" id="error_datepicker1" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Start Time</label>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <select class="form-control" id="start_hours">
                                            <option value="" selected="selected">Hours</option>
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                ?>
                                                <option value="<?php
                                                if ($i < 10) {
                                                    echo "0" . $i;
                                                } else {
                                                    echo $i;
                                                }
                                                ?>" <?= ($start_hours == $i) ? 'selected' : '' ?>><?php
                                                            if ($i < 10) {
                                                                echo "0" . $i;
                                                            } else {
                                                                echo $i;
                                                            }
                                                            ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-xs-2">
                                        <select class="form-control" id="start_minute">
                                            <option value="" selected="selected">Minute</option>
                                            <?php
                                            for ($i = 0; $i <= 59; $i++) {
                                                ?>
                                                <option value="<?php
                                                if ($i < 10) {
                                                    echo "0" . $i;
                                                } else {
                                                    echo $i;
                                                }
                                                ?>" <?= ($start_minutes == $i) ? 'selected' : '' ?>><?php
                                                            if ($i < 10) {
                                                                echo "0" . $i;
                                                            } else {
                                                                echo $i;
                                                            }
                                                            ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-2">
                                        <select class="form-control" id="start_am">
                                            <!--                                            <option value="am" selected="selected">AM</option>
                                                                                        <option value="pm">PM</option>-->
                                            <option value="am" <?= 'AM' == $start_am_pm ? 'selected' : '' ?>>AM</option>
                                            <option value="pm" <?= 'PM' == $start_am_pm ? 'selected' : '' ?>>PM</option>                               
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                         <label for="inputPassword3" id="error_start_time" class="control-label pull-left"></label>
                                    </div>
                                </div>
                               <!-- <label for="inputPassword3" id="error_start_time" class="control-label pull-left"></label> -->
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">End Time</label>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <select class="form-control" id="end_hours">
                                            <option value="" selected="selected">Hours</option>
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                ?>
                                                <option value="<?php
                                                if ($i < 10) {
                                                    echo "0" . $i;
                                                } else {
                                                    echo $i;
                                                }
                                                ?>" <?= ($end_hours == $i) ? 'selected' : '' ?>><?php
                                                            if ($i < 10) {
                                                                echo "0" . $i;
                                                            } else {
                                                                echo $i;
                                                            }
                                                            ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-xs-2">
                                        <select class="form-control" id="end_minute">
                                            <option value="" selected="selected">Minute</option>
                                            <?php
                                            for ($i = 0; $i <= 59; $i++) {
                                                ?>
                                                <option value="<?php
                                                if ($i < 10) {
                                                    echo "0" . $i;
                                                } else {
                                                    echo $i;
                                                }
                                                ?>" <?= ($end_minutes == $i) ? 'selected' : '' ?>><?php
                                                            if ($i < 10) {
                                                                echo "0" . $i;
                                                            } else {
                                                                echo $i;
                                                            }
                                                            ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-xs-2">
                                        <select class="form-control" id="end_am">
                                            <option value="am" <?= 'AM' == $end_am_pm ? 'selected' : '' ?>>AM</option>
                                            <option value="pm" <?= 'PM' == $end_am_pm ? 'selected' : '' ?>>PM</option>                               
                                        </select>
                                    </div>
                                     <div class="col-xs-3">
                                         <label for="inputPassword3" id="error_end_time" class="control-label pull-left"></label>
                                    </div>
                                </div>
                               <!-- <label for="inputPassword3" id="error_start_time" class="control-label pull-left"></label> -->
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Assign Access Code</label>
                                <div class="col-sm-5">
                                    <script type="text/javascript">
                                        $(document).ready(function () {

                                            $('#boot-multiselect-demo').multiselect({
                                                nonSelectedText: 'Select expertise!',
                                                buttonWidth: 250,
                                                enableFiltering: true,
                                                search: true,
                                                selectAll: true,
                                                texts: {
                                                    placeholder: 'Select User',
                                                }
                                            });
                                        });
                                    </script>
                                    <select class="form-control" id="boot-multiselect-demo" multiple="multiple">
                                        <?php
                                        foreach ($user as $row => $value) {
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
                                <label for="inputPassword3" class="col-sm-2 control-label">Number of Uses / User</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_no_of_use" placeholder="Enter number of time use per user" value="<?php echo $no_of_use; ?>">
                                    <p class="help-block">Note: specify 0 if users have unlimited access. </p>
                                </div>
                                <label for="inputPassword3" id="error_promocode_no_of_use" class="control-label pull-left"></label>
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class=" col-sm-offset-2">
                                <button type="submit" class="btn bg-purple">Edit Offer Code</button>
                                <label for="inputPassword3" id="error_message" class="control-label"></label>
                            </div>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->

                <script type="text/javascript">
                    var page = '0';//use in pagination
                    $(document).ready(function () {
                        $("#datepicker").datepicker();
                        $("#datepicker1").datepicker();

                        $('#datepicker1').datepicker().on('changeDate', function () {
                            var start_date = $('#datepicker').val();
                            var end_date = $('#datepicker1').val();


                            var eDate = new Date(end_date);
                            var sDate = new Date(start_date);

                            if (sDate > eDate)
                            {
                                var data = "Please End Date is greater than Start Date.";
                                $("#error_datepicker1").text(data);
                                return false;
                            } else {
                                $("#error_datepicker1").text("");
                            }


                        });

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

                        $('#filter_truck_name').change(function () {
                            var promocode_assign = $("#filter_promocode_assign").val();
                            var truck_name = $("#filter_truck_name").val();
                            if (promocode_assign == 'truck' && truck_name == '0')
                            {
                                var data = "Please select at least one specific truck.";
                                $("#error_truck_name").text(data);
                                return false;
                            } else {
                                $("#error_truck_name").text("");
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
                            var start_date = $('#datepicker').val();
                            var end_date = $('#datepicker1').val();
                            var start_hours = $('#start_hours').val();
                            var start_minute = $('#start_minute').val();
                            var start_am = $('#start_am').val();
                            var end_hours = $('#end_hours').val();
                            var end_minute = $('#end_minute').val();
                            var end_am = $('#end_am').val();
                            var start_time = start_hours + ':' + start_minute + ' ' + start_am;
                            var end_time = end_hours + ':' + end_minute + ' ' + end_am;
                            var promocode_access = $('#boot-multiselect-demo').val();
                            var promocode_no_of_use = $('#promocode_no_of_use').val();

                            var base_url = "<?php echo base_url(); ?>promocode/edit_promocode_data";

                            if (promocode_name == null || promocode_name == "") {
                                var data = "Please enter promocode name.";
                                $("#error_promocode_name").text(data);
                                return false;
                            } else {
                                $("#error_promocode_name").text("");
                            }
                            if (promocode_assign == null || promocode_assign == "") {
                                var data = "Please enter promocode Offered By.";
                                $("#error_promocode_assign").text(data);
                                return false;
                            } else {
                                $("#error_promocode_assign").text("");
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
                                $("#error_category_name").text(data);
                                return false;
                            } else {
                                $("#error_category_name").text("");
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

                            if (promocode_code.length < 3) {
                                var data = "Minimum 3 characters required in promocode";
                                $("#error_promocode_code").text(data);
                                return false;
                            } else
                            {
                                $("#error_promocode_code").text("");
                            }

                            if (promocode_code.length > 6) {
                                var data = "Maximum 6 characters required in promocode";
                                $("#error_promocode_code").text(data);
                                return false;
                            } else
                            {
                                $("#error_promocode_code").text("");
                            }
                            if (start_hours == null || start_hours == "" || start_minute == null || start_minute == "" || start_am == null || start_am == "") {
                                var data = "Please select start time.";
                                $("#error_start_time").text(data);
                                return false;
                            } else {
                                $("#error_start_time").text("");
                            }
                            if (end_hours == null || end_hours == "" || end_minute == null || end_minute == "" || end_am == null || start_am == "") {
                                var data = "Please select end time.";
                                $("#error_end_time").text(data);
                                return false;
                            } else {
                                $("#error_end_time").text("");
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
                                        $('#start_hours').val("");
                                        $('#start_minute').val("");
                                        $('#end_hours').val("");
                                        $('#end_minute').val("");
                                        $('#boot-multiselect-demo').multiselect('reset');
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
include 'footer2.php';
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
