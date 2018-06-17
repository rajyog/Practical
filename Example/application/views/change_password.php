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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Change Password
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- right column -->
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-comment">
                    <div class="box-header with-border">
                        <h3 class="box-title">Change Password</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="change_password">
                        <div class="box-body">
                            <?php
                            $session_data = $this->session->userdata('logged_in');
                            ?>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Old Password</label>
                                <div class="col-sm-5">
                                    <input type="hidden" name="email" id="email" value="<?php echo $session_data['email']; ?>">
                                    <input type="password" class="form-control" id="old_password" placeholder="Old Password">
                                </div>
                                <label for="inputPassword3" id="error_old_password" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="new_password" placeholder="New Password">
                                </div>
                                <label for="inputPassword3" id="error_new_password" class="control-label"></label>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"> Confirm Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password"><span id="error_old_password" class="custom_error"></span>
                                </div>
                                <label for="inputPassword3" id="error_confirm_password" class="control-label"></label>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer col-sm-offset-2">
                            <button type="submit" class="btn bg-purple">Change Password</button>
                            <label for="inputPassword3" id="error_message" class="control-label"></label>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {

        $("#change_password").on("submit", function (e) {
            e.preventDefault();
            var old_password = $("#old_password").val();
            var new_password = $("#new_password").val();
            var confirm_password = $("#confirm_password").val();
            var email = $("#email").val();
            var base_url = "<?php echo base_url(); ?>login/change_password";

            if (old_password == null || old_password == "") {
                var data = "Please enter old password.";
                $("#error_old_password").text(data);
                return false;
            } else {
                $("#error_old_password").text("");
            }

            if (old_password.length < 8) {
                var data = "Old Password must be more then 8 Character";
                $("#error_old_password").text(data);
                return false;
            } else {
                $("#error_old_password").text("");
            }


            if (new_password == null || new_password == "") {
                var data = "Please enter new password.";
                $("#error_new_password").text(data);
                return false;
            } else {
                $("#error_new_password").text("");
            }

            if (new_password.length < 8) {
                var data = "Password must be more then 8 Character";
                $("#error_new_password").text(data);
                return false;
            } else {
                $("#error_new_password").text("");
            }

            if (confirm_password == null || confirm_password == "") {
                var data = "Please enter confirm password.";
                $("#error_confirm_password").text(data);
                return false;
            } else {
                $("#error_confirm_password").text("");
            }

            if (confirm_password != new_password) {
                var data = "Password and Confirm Password not Match.";
                $("#error_confirm_password").text(data);
                return false;
            } else {
                $("#error_confirm_password").text("");
            }

            $.ajax({
                type: 'POST',
                url: base_url,
                data: {
                    old_password: old_password,
                    new_password: new_password,
                    confirm_password: confirm_password,
                    email: email
                },
                success: function (data)
                {
                    if (data == 0) {
                        window.location.href = "<?php echo base_url(); ?>index.php/login/logout";
                        $("#old_password").val("");
                        $("#new_password").val("");
                        $("#confirm_password").val("");
                        $("#error_message").text('Password Sucessfully Change');
                    }
                    if (data == 1) {
                        $("#old_password").val("");
                        $("#new_password").val("");
                        $("#confirm_password").val("");
                        $("#error_message").text('Server Authentication Failed Please Try Again');
                    }
                    if (data == 2) {
                        $("#old_password").val("");
                        $("#new_password").val("");
                        $("#confirm_password").val("");
                        $("#error_message").text('Your Old Password Not Set as New Password');
                    }
                    if (data == 3) {
                        $("#old_password").val("");
                        $("#new_password").val("");
                        $("#confirm_password").val("");
                        $("#error_message").text('Your Old Password Worng');
                    }
                    if (data == 4) {
                        $("#old_password").val("");
                        $("#new_password").val("");
                        $("#confirm_password").val("");
                        $("#error_message").text('Your Password And Confirm Password Not Same');
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
