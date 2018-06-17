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
            Edit Category
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>category"><i class="fa fa-th"></i> Category</a></li>
            <li><a href="#">Edit Category</a></li>
            <!--       <li class="active">Simple</li>-->
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-comment">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Category</h3>
                    </div><!-- /.box-header -->
                    <?php
                    foreach ($edit_data as $row => $value) {
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" id="edit_promotion">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Category Name</label>
                                    <div class="col-sm-5">
                                        <input type="hidden" name="category_id" id="category_id" value="<?php echo $value['category_id']; ?>">
                                        <input type="text" class="form-control" id="category_name" placeholder="Category Name" value="<?php echo $value['category_name']; ?>">
                                    </div>
                                    <label for="inputPassword3" id="error_category_name" class="control-label pull-left"></label>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class=" col-sm-offset-2">
                                    <button type="submit" class="btn bg-purple">Edit Category</button>
                                    <label for="inputPassword3" id="error_message" class="control-label"></label>
                                </div>
                            </div><!-- /.box-footer -->
                        </form>
                        <?php
                    }
                    ?> 
                </div><!-- /.box -->
                <script type="text/javascript">
                    var page = '0';//use in pagination
                    $(document).ready(function () {

                        $("#edit_category").on("submit", function (e) {
                            e.preventDefault();
                            var category_name = $("#category_name").val();
                            var category_id = $("#category_id").val();
                            var base_url = "<?php echo base_url(); ?>category/edit_category_data";

                            if (category_name == null || category_name == "") {
                                var data = "Please enter category name.";
                                $("#error_category_name").text(data);
                                return false;
                            } else {
                                $("#error_category_name").text("");
                            }

                            $.ajax({
                                type: 'POST',
                                url: base_url,
                                data: {
                                    category_id: category_id,
                                    category_name: category_name
                                },
                                success: function (data)
                                {
                                    if (data == 0) {
                                        $("#category_name").val("");
                                        $("#error_message").text('Category successfully inserted');
                                        window.location.href = "<?php echo base_url(); ?>category/index";
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
            </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php
include 'footer.php';
?>
