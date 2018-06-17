<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Let'sEat | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/jquery-1.7.1.min.js" type="text/javascript"></script>

    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>Let's</b>Eat</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg"  id="server_error_msg"></p>
                <form id="loginform" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Email" id="email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" id="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn bg-purple btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
        <script type="text/javascript">

            $(document).ready(function () {

                $("#loginform").on("submit", function (e) {
                    e.preventDefault();

                    var email = $("#email").val();

                    if (email == null || email == "") {
                        var data = "Please enter Email Id.";
                        $("#server_error_msg").text(data);
                        return false;
                    } else {
                        $("#server_error_msg").text("");
                    }

                    if (IsEmail(email) == false) {
                        var data = "Please enter valid Email Id.";
                        $("#server_error_msg").text(data);
                        return false;
                    } else {
                        $("#server_error_msg").text("");
                    }


                    var password = $("#password").val();
                    if (password == null || password == "") {
                        var data = "Please enter Password.";
                        $("#server_error_msg").text(data);
                        return false;
                    } else
                    {
                        $("#server_error_msg").text("");
                    }
                    if (password.length < 8) {
                        var data = "Password must be more then 8 Character";
                        $("#server_error_msg").text(data);
                        return false;
                    } else
                    {
                        $("#server_error_msg").text("");
                    }

                    var base_url = "<?php echo base_url(); ?>login/login_process";
                   
                    $.ajax({
                        type: 'POST',
                        url: base_url,
                        data: {
                            username: email,
                            password: password
                        },
                        success: function (data)
                        {
                            if (data == 0) {
                                $("#server_error_msg").text('Invalid Password Please try again.');
                            }
                            if (data == 2) {
                                $("#server_error_msg").text('Your Email Id invalid Please try again.');
                            }
                            if (data == 1) {
                                window.location.href = "<?php echo base_url(); ?>dashboard";
                            }
                        },
                        error: function () {
//                            alert(JSON.stringify(data));                  
//                            console.log(data);
                        }
                    });
                });
            });
            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test(email)) {
                    return false;
                } else {
                    return true;
                }
            }
        </script>
    </body>
</html>
