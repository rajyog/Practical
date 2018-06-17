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

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/slid_show/css/bjqs.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/slid_show/css/demo.css">
<script src="<?php echo base_url(); ?>assets/slid_show/js/bjqs-1.3.min.js"></script>
<?php
$item_id = $view_data['item_id'];
$truck_id = $view_data['truck_id'];
$truck_name = $view_data['truck_name'];
$truck_profile_image = $view_data['truck_profile_image'];
$item_title = $view_data['item_title'];
$item_description = $view_data['item_description'];
$item_disclaimer = $view_data['item_disclaimer'];
$item_price = $view_data['item_price'];
$item_created = $view_data['item_created'];
$total_review = $view_data['total_review'];
$total_like = $view_data['total_like'];
$total_favourite = $view_data['total_favourite'];
$item_addon = $view_data['item_addon'];
$item_category = $view_data['item_category'];
$item_allergie = $view_data['item_allergie'];
$item_images = $view_data['item_images'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Item Detail
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>item"><i class="fa fa-spoon"></i> Item</a></li>
            <!--            <li><a href="#">Examples</a></li>-->
            <li class="active">Item Detail</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
//        echo "<pre>";
//        print_r($item_addon);
//        echo "</pre>";
//        die;
//        $array = array('lastname', 'email', 'phone');
//        $comma_separated = implode(",", $array);
//
//        echo $comma_separated; // lastname,email,phone
        ?>
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-comment">
                    <?php
                    $default_path = base_url() . 'assets/dist/img/default.png';
                    ?>
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . 'upload/truck/' . $truck_profile_image; ?>" onerror="this.src='<?php echo $default_path; ?>'">
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
                        <li class="active"><a href="#activity" data-toggle="tab">Item Details</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- general form elements -->
                            <div class="box box-comment">
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <center>
                                                <div id="banner-fade">
                                                    <ul class="bjqs">
                                                        <?php
                                                        foreach ($item_images as $row => $value) {
                                                            $image = $value['item_image'];
                                                            ?>
                                                            <?php
                                                            if ($image != '') {
                                                                ?>
                                                                <li><img src="<?php echo base_url(); ?>upload/items/<?php echo $value['item_image']; ?>" onerror="this.src='<?php echo $default_path; ?>'" alt='image not found'></li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><img src="<?php echo $default_path; ?>" alt='image not found' style="width:50px;height:50px;"/></li>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                        }
                                                        ?> 
                                                    </ul>
                                                </div>
                                            </center>
                                            <script class="secret-source">
                                                jQuery(document).ready(function ($) {

                                                    $('#banner-fade').bjqs({
                                                        height: 250,
                                                        width: 400,
                                                        responsive: true
                                                    });

                                                });
                                            </script></div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Name</label>
                                            <p class="text-muted"><?php echo $item_title; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <p class="text-muted"><?php echo $item_description; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Disclaimer</label>
                                            <p class="text-muted"><?php echo $item_disclaimer; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Addon</label>
                                            <?php
                                            $addon = '';
                                            for ($i = 0; $i < count($item_addon); $i++) {

                                                $isaddon = $item_addon[$i]['addon_name'];
                                                $addon .= $isaddon . ' , ';
                                            }
                                            ?>
                                            <p class="text-muted"><?php echo $addon; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Category</label>
                                            <?php
                                            $category = '';
                                            for ($i = 0; $i < count($item_category); $i++) {

                                                $iscategory = $item_category[$i]['category_name'];
                                                $category .= $iscategory . ' , ';
                                            }
                                            ?>
                                            <p class="text-muted"><?php echo $category; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Allergie</label>
                                            <?php
                                            $allergie = '';
                                            for ($i = 0; $i < count($item_allergie); $i++) {

                                                $isallergie = $item_allergie[$i]['allergie_name'];
                                                $allergie .= $isallergie . ' , ';
                                            }
                                            ?>
                                            <p class="text-muted"><?php echo $allergie; ?></p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Created Date </label>
                                            <p class="text-muted"><?php echo date('M  d Y', strtotime($item_created)); ?></p>
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
