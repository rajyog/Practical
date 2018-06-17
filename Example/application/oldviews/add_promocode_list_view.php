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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Promo code
            <small> List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>promocode"><i class="fa fa-fw fa-ticket"></i> Promo code</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-comment">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Promocode</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="add_promocode">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_name" placeholder="Enter Promocode Name">
                                </div>
                                <label for="inputPassword3" id="error_promocode_name" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Truck</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="filter_truck_name">
                                        <option value="" selected="selected">-- select Truck --</option>
                                        <option value="0">All</option>
                                        <?php
                                        foreach ($truck as $row => $value) {
                                            echo '<option value="' . $value['truck_id'] . '">' . $value['truck_username'] . '</option>';
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
                                        <option value="0" id="select_all_category">All</option>
                                        <?php
                                        foreach ($category as $row => $value) {
                                            echo '<option value="' . $value['category_id'] . '">' . $value['category_name'] . '</option>';
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
                                        <option value="" selected="selected">-- select Type --</option>
                                        <option value="1">% off</option>
                                        <option value="2">AMOUNT off</option>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_promocode_type" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group" id="minimum" style="display:none">
                                <label for="inputPassword3" class="col-sm-2 control-label">Mini Amount</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_amount" placeholder="Enter minimum amount">
                                </div>
                                <label for="inputPassword3" id="error_promocode_amount" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Assign By</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="filter_promocode_assign">
                                        <option value="" selected="selected">-- select Assign By --</option>
                                        <option value="admin">Admin</option>
                                        <option value="truck">Truck</option>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_promocode_type" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Discount</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_discount" placeholder="Enter amoint or % off Discount">

                                </div>
                                <label for="inputPassword3" id="error_promocode_discount" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Code</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_code" placeholder="Enter Promocode code">
                                </div>
                                <label for="inputPassword3" id="error_promocode_code" class="control-label pull-left"></label>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Start Time</label>
                                <div class="col-sm-5">
<!--                                    <input id="datepicker" class="form-control" placeholder="Enter Start Date"/>-->
                                    <input class="form-control" id="datetime" placeholder="Enter Start Date">
                                    <script type="text/javascript">
                                        var start_Date;
                                        $("#datetime").datetimepicker({
                                            format: 'yyyy-mm-dd hh:ii',
                                            autoclose: true
                                        });

                                        $("#datetime").on("change", function () {
                                            start_Date = $(this).val();
//                                            alert(selected);
//                                            $('#datetime1').datetimepicker('setStartDate', start_Date);
                                        });
//                                        var startDate;
//                                        $("#datetime").datetimepicker({
//                                            autoclose: true,
//                                            format: 'yyyy-mm-dd hh:ii',
//                                            minDate: 0,
//                                            roundTime: 'ceil',
//                                            onChangeDateTime: function (dp, $input) {
//                                                startDate = $("#datetime").val();
//                                            }
//                                        });
                                    </script>
                                </div>
                                <label for="inputPassword3" id="error_datepicker" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">End Time</label>
                                <div class="col-sm-5">
<!--                                    <input id="datepicker1" class="form-control" placeholder="Enter End Date"/>-->
                                    <input class="form-control" id="datetime1" placeholder="Enter End Date">
                                    <script type="text/javascript">
                                        $("#datetime1").datetimepicker({
                                            format: 'yyyy-mm-dd hh:ii',
                                            autoclose: true
                                        });

//                                        $('#datetime1').datetimepicker().on('changeDate', function (ev) {
//                                            if (ev.date.valueOf() < start_Date) {
//                                                alert('yes');
//                                            }
//                                        });


                                        $("#datetime1").on("change", function () {
                                            end_date = $(this).val();
//                                            alert(start_Date);
//                                            alert(end_date);

//                                            if ((Date.parse(start_Date) <= Date.parse(end_date))) {
//                                                console.log('yes');
//                                                alert("End date should be greater than Start date");
//                                            }
//                                          
                                            var eDate = new Date(end_date);
                                            var sDate = new Date(start_Date);

                                            if (sDate > eDate)
                                            {
//                                                alert("Please ensure that the End Date is greater than or equal to the Start Date.");
//                                                return false;
                                                var data = "Please End Date is greater than Start Date.";
                                                $("#error_datepicker1").text(data);
                                                return false;
                                            } else {
                                                $("#error_datepicker1").text("");
                                            }

                                        });


//                                        $("#datetime1").datetimepicker({
//                                            autoclose: true,
//                                            format: 'yyyy-mm-dd hh:ii',
//                                            onClose: function (current_time, $input) {
//                                                var endDate = $("#datetime1").val();
//                                                if (startDate > endDate) {
//                                                    alert('Please select correct date');
//                                                }
//                                            }
//                                        });
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
                                            echo '<option value="' . $value['user_id'] . '">' . $value['user_username'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_promocode_access" class="control-label pull-left"></label>
                            </div>

                            <!--                            <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">No Of Use</label>
                                                            <div class="col-sm-5">
                                                                <form id="myForm">
                                                                    <div class="form-group">
                                                                        <label>
                                                                            <input type="radio" name="r3" value="yes" class="flat-red" checked>
                                                                            Unlimited
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="r3" value="no" class="flat-red">
                                                                            Other
                                                                        </label>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <label for="inputPassword3" id="error_promocode_access" class="control-label pull-left"></label>
                                                        </div>-->

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">No Of Use</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="promocode_no_of_use" placeholder="Enter number of time use">
                                    <!--                                    <label for="inputPassword3" class="control-label pull-left">ehsrhrsr</label>-->
                                    <p class="help-block">Note if you provide unlimited then enter no of use 0 (zero). </p>
                                </div>
                                <label for="inputPassword3" id="error_promocode_no_of_use" class="control-label pull-left"></label>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class=" col-sm-offset-2">
                                <button type="submit" class="btn bg-purple">Add Promocode</button>
                                <label for="inputPassword3" id="error_message" class="control-label"></label>
                            </div>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Promocode List</h3>
                        <!--                        <div class="box-tools">
                                                    <div class="input-group" style="width: 150px;">
                                                        <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search name" id="search_promo">
                                                    </div>
                                                </div>-->

                        <div class="box-tools col-md-10" >
                            <div class="col-xs-3 col-sm-offset-3">
                                <select class="form-control input-sm" id="filter_category">
                                    <option value="" selected="selected">--Filter By Category--</option>
                                    <?php
                                    foreach ($category as $row => $value) {
                                        echo '<option value="' . $value['category_id'] . '">' . $value['category_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <select class="form-control" id="filter_truck">
                                    <option value="">--Filter By Truck--</option>
                                    <?php
                                    foreach ($truck as $row => $value) {
                                        echo '<option value="' . $value['truck_id'] . '">' . $value['truck_username'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group">
                                    <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search By Promocode Name" id="search_promo">
                                </div>
                            </div>
                        </div>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th onclick="return sort_filter('promocode_name');">Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th onclick="return sort_filter('promocode_code');">Code <i class="fa fa-fw fa-sort" ></i></th>
                                    <th onclick="return sort_filter('promocode_type');">Type <i class="fa fa-fw fa-sort" ></i></th>
                                    <th onclick="return sort_filter('promoced_status');">Status <i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width:150px;float:right;">Action</th>
                                </tr>
                            <thead>
                            <tbody id="page_table">
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix" id="paging">
                    </div>
                </div><!-- /.box -->

                <script type="text/javascript">

                    var page = '0';//use in pagination
                    $(document).ready(function () {
                        list_promocode();
//                        $("#datepicker").datepicker();
//                        $("#datepicker1").datepicker();

                        $('#select_all').click(function () {
                            $('#filter_promocode_access option').prop('selected', true);
                            $('#filter_promocode_access option[value="all"]').remove();
//                            $('#filter_promocode_access option[value="all"].disabled==true');
//                             control.options[i].disabled = 'true';
                        });

                        $('#filter_promocode_access').click(function () {
                            var promocode_access_count = $("#filter_promocode_access :selected").length;
                            var data = "No Of Selected User " + promocode_access_count;
                            $("#error_promocode_access").text(data);
                        });

                        $('#search_promo').keyup(function () {
                            page = '0';
                            list_promocode();
                        });

                        $('#filter_category').change(function () {
                            page = '0';
                            list_promocode();
                        });
                        $('#filter_truck').change(function () {
                            page = '0';
                            list_promocode();
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
                                $("#promocode_amount").val("");
                            }
                        });



//                        $('#select_all_category').click(function () {
//                            $('#filter_category_name option').prop('selected', true);
//                            $('#filter_promocode_access option[value="all"]').remove();
//                        });


//                        $('#r3').select(function () {
//                            var promocode_radio = $("#r3").val();
//                            alert(promocode_radio);
//                        });







                        $("#add_promocode").on("submit", function (e) {
                            e.preventDefault();

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
//                            var newstring = remove(promocode_access,"all"); // newstring will contain "1,2,3,5"
                            //alert(promocode_access);
                            var promocode_no_of_use = $('#promocode_no_of_use').val();

                            var base_url = "<?php echo base_url(); ?>promocode/add_promocode";


//                            $("#EndDate").change(function () {
//                                var start_date = $('#datetime').val();
//                                var end_date = $('#datetime1').val();
//
//                                if ((Date.parse(start_date) <= Date.parse(end_date))) {
//                                    alert("End date should be greater than Start date");
//                                }
//                            });



//                            if ((Date.parse(start_date) <= Date.parse(end_date))) {
//                                alert("End date should be greater than Start date");
////                                document.getElementById("EndDate").value = "";
//                            }

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
                            if (promocode_amount < 10 && promocode_type == '2') {
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
                                var data = "promocode must be 6 Character";
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
                                    if (data == 0) {
                                        $("#promocode_name").val("");
                                        $("#filter_truck_name").val("0");
                                        $("#filter_category_name").val("0");
                                        $("#filter_promocode_type").val("");
                                        $("#promocode_discount").val("");
                                        $("#promocode_code").val("");
                                        $("#promocode_description").val("");
                                        $('#datetime').val("");
                                        $('#datetime1').val("");
                                        $('#filter_promocode_access').val("");
                                        $('#promocode_no_of_use').val("");
                                        $("#error_message").text('Promocode successfully inserted');
                                        list_promocode();
                                    }
                                    if (data == 1) {
                                        $("#promocode_name").val("");
                                        $("#filter_truck_name").val("0");
                                        $("#filter_category_name").val("0");
                                        $("#filter_promocode_type").val("");
                                        $("#promocode_discount").val("");
                                        $("#promocode_code").val("");
                                        $("#promocode_description").val("");
                                        $('#datetime').val("");
                                        $('#datetime1').val("");
                                        $('#filter_promocode_access').val("");
                                        $('#promocode_no_of_use').val("");
                                        $("#error_message").text('Server Authentication Failed Please Try Again');
                                    }
                                    if (data == 3) {
                                        $("#promocode_name").val("");
                                        $("#filter_truck_name").val("0");
                                        $("#filter_category_name").val("0");
                                        $("#filter_promocode_type").val("");
                                        $("#promocode_discount").val("");
                                        $("#promocode_code").val("");
                                        $("#promocode_description").val("");
                                        $('#datetime').val("");
                                        $('#datetime1').val("");
                                        $('#filter_promocode_access').val("");
                                        $('#promocode_no_of_use').val("");
                                        $("#error_message").text('Promocode already exist please try other name.');
                                    }
                                },
                                error: function () {

                                }
                            });
                        });
                    });


                    var promo_id = '';
                    function promocode_live(promocode_id)
                    {
                        promo_id = promocode_id;
                        var base_url = "<?php echo base_url(); ?>promocode/request_live_promocode/";
                        $.ajax({
                            url: base_url,
                            type: 'post',
                            data: {
                                promocode_id: promo_id
                            },
                            success: function () {
                                location.reload();
                            },
                            error: function () {
                                alert('ajax failure');
                            }
                        });
                    }

                    var promocode_ids = '';
                    var promocode_statuss = '';
                    function delete_promocode(promocode_id, promocode_status)
                    {
                        promocode_ids = promocode_id;
                        promocode_statuss = promocode_status;
                        $("#myModal2").show();
                        $("#transparent_background").show();
                    }
                    function delete_ok()
                    {
                        delete_cancel();
                        var base_url = "<?php echo base_url(); ?>promocode/delete_promocode/";
                        $.ajax({
                            url: base_url,
                            type: 'post',
                            data: {
                                promocode_id: promocode_ids,
                                promocode_status: promocode_statuss
                            },
                            success: function () {
                                list_promocode();
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


                    function page_click(page_no)
                    {
                        page = page_no;
                        list_category();
                    }

                    var sort_field;
                    var sort_type;
                    function sort_filter(field)
                    {
                        if (sort_type == undefined)
                        {
                            sort_type = 'asc';
                        } else if (sort_type == 'asc')
                        {
                            sort_type = 'desc';
                        } else if (sort_type == 'desc')
                        {
                            sort_type = 'asc';
                        }

                        sort_field = field;
                        list_promocode();
                    }

                    function list_promocode()
                    {
                        var pagee = page;
                        if (pagee == '0')
                        {
                            var pagee = '1';
                        }

                        var promocode_name = $('#search_promo').val();
                        var category_id = $("#filter_category").val();
                        var truck_id = $("#filter_truck").val();

                        $.ajax({
                            type: 'post',
                            data: {
                                pagee: pagee,
                                promocode_name: promocode_name,
                                category_id: category_id,
                                truck_id: truck_id,
                                sort_field: sort_field,
                                sort_type: sort_type
                            },
                            url: '<?php echo base_url(); ?>promocode/list_promocode/',
                            success: function (data)
                            {
//                                alert(data);
                                var json_obj = $.parseJSON(data);
                                var result_length = json_obj.promocode_list.length;

                                if (result_length > 0)
                                {
                                    var output = "";
                                    var i;
                                    var default_path = '<?php echo base_url() . 'assets/dist/img/default.png' ?>';
                                    var error_src = "this.src='" + default_path + "'";

                                    for (i = 0; i < json_obj.promocode_list.length; i++)
                                    {

                                        output += '<tr>';
                                        output += "<td>" + json_obj.promocode_list[i].promocode_name + "</td>";
                                        output += "<td>" + json_obj.promocode_list[i].promocode_code + "</td>";
                                        if (json_obj.promocode_list[i].promocode_type == 1)
                                        {
                                            var type = "% Off";
                                        } else {
                                            var type = "Amount Off";
                                        }
                                        output += "<td>" + type + "</td>";
                                        var type = json_obj.promocode_list[i].promoced_status;
                                        if (type == 'local')
                                        {
                                            output += "<td> Unpublished </td>";
                                        } else {
                                            output += "<td> Published  </td>";
                                        }
//                                        output += "<td style='width:260px'>";
//                                        if (type == 'local')
//                                        {
//                                            output += "<a href='<?php echo base_url(); ?>promocode/edit_promocode/" + json_obj.promocode_list[i].promocode_id + "'><button  class='btn btn-info margin' title='View'><i class='fa fa-edit'></i></button></a>";
//                                        } else {
//                                            output += "<a><button  class='btn btn-info margin disabled' title='View'><i class='fa fa-edit'></i></button></a>";
//                                        }
//                                        var promocode_id = json_obj.promocode_list[i].promocode_id;
//                                        var local = '"local"';
//                                        var live = '"live"';
//
//                                        if (type == 'local') {
//                                            output += "<a href='javascript:void(0);' onclick='delete_promocode(" + promocode_id + "," + local + ")' ><button  class='btn btn-danger margin' title='Delete'><i class='fa fa-trash'></i></button></a>";
//                                        } else {
//                                            output += "<a href='javascript:void(0);' onclick='delete_promocode(" + promocode_id + "," + live + ")'><button  class='btn btn-danger margin' title='Delete'><i class='fa fa-trash'></i></button></a>";
//                                        }
//
//
//                                        if (type == 'local') {
//                                            output += "<a href='javascript:void(0);' onclick='promocode_live(" + json_obj.promocode_list[i].promocode_id + ");'><button  class='btn  btn-warning margin' title='Edit Status'><i class='fa fa-fw fa-level-up'></i></button></a>";
//                                        } else {
//                                            output += "<a href='javascript:void(0);'><button  class='btn  btn-warning margin disabled' title='Edit Status'><i class='fa fa-fw fa-level-up'></i></button></a>";
//                                        }
//
//                                        output += "<a href='<?php echo base_url(); ?>promocode/view_promocode/" + json_obj.promocode_list[i].promocode_id + "'><button  class='btn btn-success margin' title='View'><i class='fa fa-eye'></i></button></a>";
//                                        output += "</td>";
                                        output += "<td style='width:150px'>";
                                        output += "<div class='btn-group'>";
                                        output += "<button type='button' class='btn btn-default'>Action</button>";
                                        output += "<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>";
                                        output += "<span class='caret'></span>";
                                        output += "<span class='sr-only'>Toggle Dropdown</span>";
                                        output += "</button>";
                                        output += "<ul class='dropdown-menu' role='menu'>";
                                        if (type == 'local')
                                        {
                                            output += "<li><a href='<?php echo base_url(); ?>promocode/edit_promocode/" + json_obj.promocode_list[i].promocode_id + "'><b>Edit</b></a></li>";
                                        } else {
                                            output += "<li><a>Edit</a></li>";
                                        }
                                        var promocode_id = json_obj.promocode_list[i].promocode_id;
                                        var local = '"local"';
                                        var live = '"live"';

                                        if (type == 'local') {
                                            output += "<li><a href='javascript:void(0);' onclick='delete_promocode(" + promocode_id + "," + local + ")' ><b>Delete</b></a></li>";
                                        } else {
                                            output += "<li><a href='javascript:void(0);' onclick='delete_promocode(" + promocode_id + "," + live + ")'><b>Delete</b></a></li>";
                                        }

                                        if (type == 'local') {
                                            output += "<li><a href='javascript:void(0);' onclick='promocode_live(" + json_obj.promocode_list[i].promocode_id + ");'><b>Publised</b></a></li>";
                                        } else {
                                            output += "<li><a href='javascript:void(0);'>Publised</a></li>";
                                        }
                                        output += "<li><a href='<?php echo base_url(); ?>promocode/view_promocode/" + json_obj.promocode_list[i].promocode_id + "'><b>View</a></b></li>";
                                        output += "</ul>";
                                        output += "</div>";
                                        output += "</td>";
                                        output += "</tr>";
                                    }

                                    $('#page_table').html(output);
                                    var paging = "";
                                    paging += "<ul class='pagination pagination-sm no-margin pull-right'>";
                                    var no = json_obj.total_pages;
                                    if (pagee > 1) {
                                        var onclick_li = 'onclick = "return page_click(' + (pagee - 1) + ')"';
                                        paging += '<li ' + onclick_li + '"><a style="cursor:pointer">&laquo;</a></li>';
                                    }

                                    for (i = 1; i <= no; i++) {
                                        var onclick_li = 'onclick = "return page_click(' + i + ')"';
                                        if (pagee == i)
                                        {
                                            paging += '<li ' + onclick_li + ' class="paginate_button active"><a style="cursor:pointer">' + i + '</a></li>';
                                        } else {
                                            paging += '<li ' + onclick_li + '><a style="cursor:pointer">' + i + '</a><li>';
                                        }
                                    }

                                    if (pagee < no)
                                    {
                                        var onclick_li = 'onclick = "return page_click(' + (parseInt(pagee) + 1) + ')"';
                                        paging += '<li ' + onclick_li + '><a style="cursor:pointer">&raquo;</a></li>';
                                    }

                                    paging += "</ul>";
                                    $('#paging').html(paging);
                                } else {
                                    var output = "";
                                    output += '<tr class="odd">';
                                    output += '<td colspan="5" class="dataTables_empty"><center><h2>No matching records found</h2></center></td>';
                                    output += '</tr>';
                                    $('#page_table').html(output);
                                    var paging = "";
                                    $('#paging').html(paging);
                                }
                            },
                            error: function () {
                                console.log(data);
                            }
                        });
                    }
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
                        <button type="button" class="btn btn-success" onclick="delete_ok()
                                        ;">OK</button>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>
    </form>
</div>
