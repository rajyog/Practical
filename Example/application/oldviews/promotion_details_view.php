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
$promotion_id = $view_data['promotion_id'];
$truck_id = $view_data['truck_id'];
$firstname = $view_data['firstname'];
$lastname = $view_data['lastname'];
$businessname = $view_data['businessname'];
$email = $view_data['email'];
$promotion_amount = $view_data['promotion_amount'];
$promotion_keyword = $view_data['promotion_keyword'];
$promotion_status = $view_data['promotion_status'];
$promotion_start_date = $view_data['promotion_start_date'];
$promotion_end_date = $view_data['promotion_end_date'];
$priority = $view_data['priority'];
$created = $view_data['created'];
$truck_name = $view_data['truck_name'];
$truck_username = $view_data['truck_username'];
$truck_emailid = $view_data['truck_emailid'];
$truck_location = $view_data['truck_location'];
$truck_phoneno = $view_data['truck_phoneno'];
$truck_website = $view_data['truck_website'];
$truck_profile_image = $view_data['truck_profile_image'];
$total_review = $view_data['total_review'];
$total_like = $view_data['total_like'];
$total_favourite = $view_data['total_favourite'];
$max_priority = $view_data['max_priority'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Newsfeed Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>promotion"><i class="fa fa fa-rocket"></i> Newsfeed</a></li>
            <li class="active">Newsfeed Details</li>
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
                        <li class="active"><a href="#truck_activity" data-toggle="tab">Newsfeed Details</a></li>
                        <li><a href="#timeline" data-toggle="tab">Truck Details</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="truck_activity">
                            <!-- general form elements -->
                            <div class="box box-comment">
                                <!-- form start -->
                                <!--                                <form role="form">-->
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Name</label>
                                        <p class="text-muted"><?php echo $firstname . '' . $lastname; ?></p>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Business Name</label>
                                        <p class="text-muted"><?php echo $businessname; ?></p>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Email </label>
                                        <p class="text-muted"><?php echo $email; ?></p>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Amount</label>
                                        <p class="text-muted"><?php echo '$' . number_format((float) $promotion_amount, 2, '.', '') ?></p>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Keyword</label>
                                        <p class="text-muted"><?php echo $promotion_keyword; ?></p>
                                    </div>
                                    <hr>
                                    <form id="edit_promotion">
                                        <?php
                                        if ($promotion_status == 'pending') {
                                            ?>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Start Date</label>
                                                <input type="hidden" id="promotion_id" value="<?php echo $promotion_id; ?>">
                                                <input id="datepicker" class="form-control" placeholder="Enter start Date"/>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">End Date</label>
                                                <input id="datepicker1" class="form-control" placeholder="Enter end Date"/>
                                            </div>
                                            <hr>
<!--                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Priority</label>
                                                <input type="text" id="priority" class="form-control" placeholder="Enter Priority between 0 to 100">
                                            </div>
                                            <hr>-->
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Priority</label>
                                                <select class="form-control" id="priority">
                                                    <option value="">--select--</option>
                                                    <?php
//                                                    foreach ($truck as $row => $value) {
//                                                        echo '<option value="' . $value['truck_id'] . '">' . $value['truck_username'] . '</option>';
//                                                    }

                                                    for ($i = 1; $i <= $max_priority; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn bg-purple">Edit Request</button>

                                                </div>
                                                <div class="col-md-4">
                                                    <p class="text-muted" id="error_message"></p>
                                                </div>
                                            </div>

                                            <!--                                            <hr>
                                                                                        <div class="form-group">
                                                                                            <div class="col-md-2">
                                                                                                <a href='javascript:void(0);' onclick="withdraw_approval('<?php echo $promotion_id ?>', 'confirm');" class="btn btn-block btn-success">Confirm</a>
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <a href='javascript:void(0);' onclick="withdraw_approval('<?php echo $promotion_id ?>', 'cancel');" class="btn btn-block btn-danger">Cancel</a>
                                                                                            </div>
                                                                                        </div>-->

                                            <?php
                                        }
                                        ?>
                                    </form>
                                </div><!-- /.box-body -->
                                <!--                                </form>-->
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
                                            <label for="exampleInputPassword1">phoneno</label>
                                            <p class="text-muted"><?php echo $truck_phoneno; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">website</label>
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

<script type="text/javascript">
    var page = '0';//use in pagination
    $(document).ready(function () {

        $("#datepicker").datepicker();
        $("#datepicker1").datepicker();
        $("#edit_promotion").on("submit", function (e) {
            e.preventDefault();
            var start_date = $('#datepicker').val();
            var end_date = $('#datepicker1').val();
            var priority = $("#priority").val();
            var promotion_id = $("#promotion_id").val();

            if (start_date == null || start_date == "") {
                var data = "Please enter start date.";
                $("#error_message").text(data);
                return false;
            } else {
                $("#error_message").text("");
            }
            if (end_date == null || end_date == "") {
                var data = "Please enter end date.";
                $("#error_message").text(data);
                return false;
            } else {
                $("#error_message").text("");
            }
            if (priority == null || priority == "") {
                var data = "Please enter priority.";
                $("#error_message").text(data);
                return false;
            } else {
                $("#error_message").text("");
            }
            var base_url = "<?php echo base_url(); ?>promotion/edit_promotion_data";

            $.ajax({
                type: 'POST',
                url: base_url,
                data: {
                    promotion_id: promotion_id,
                    start_date: start_date,
                    end_date: end_date,
                    priority: priority
                },
                success: function (data)
                {
//                    alert(data);
                    if (data == 0) {
                        $("#category_name").val("");
                        $("#error_message").text('Category successfully inserted');
                        window.location.href = "<?php echo base_url(); ?>promotion/index";
                    }
                    if (data == 1) {
                        $("#category_name").val("");
                        $("#error_message").text('Server Authentication Failed Please Try Again');
                    }
                    if (data == 3) {
                        $("#category_name").val("");
                        $("#error_message").text('Category already exist please try other name.');
                    }
                },
                error: function () {

                }
            });
        });
    });
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
