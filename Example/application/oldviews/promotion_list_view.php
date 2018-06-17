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
            Newsfeed
            <small> List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>promotion"><i class="fa fa-rocket"></i> Newsfeed</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Newsfeed List</h3>
                        <div class="box-tools" >
                            <div>
                                <div class="input-group">
                                    <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search By Truck Name" id="search_truck">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th onclick="return sort_filter('truck_name');">Truck Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th onclick="return sort_filter('businessname');">Business Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th onclick="return sort_filter('promotion_amount');">Amount <i class="fa fa-fw fa-sort" ></i></th>
                                    <th onclick="return sort_filter('priority');">Priority <i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width:150px;float:right;">Action</th>
                                </tr>
                            <thead>
                            <tbody id="page_table">
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix" id="paging">
                    </div>
                    <script type="text/javascript">
                        var page = '0';//use in pagination
                        $(document).ready(function () {
                            list_promotion();

                            $('#search_truck').keyup(function () {
                                page = '0';
                                list_promotion();
                            });

                        });
//                        var category_ids = '';
//                        function delete_category(category_id)
//                        {
//                            category_ids = category_id;
//                            if (confirm("Are You sure you want to delete?"))
//                            {
//                                delete_ok();
//                            }
//
//                        }
//
//                        function delete_ok()
//                        {
////                            var base_url = "<?php echo base_url(); ?>category/delete_category/";
//                            $.ajax({
//                                url: base_url,
//                                type: 'post',
//                                data: {category_id: category_ids},
//                                success: function () {
//                                    list_category();
//                                },
//                                error: function () {
//                                    alert('ajax failure');
//                                }
//                            });
//                        }


                        var category_ids = '';
                        function delete_category(category_id)
                        {
                            category_ids = category_id;
                            $("#myModal2").show();
                            $("#transparent_background").show();
                        }
                        function delete_ok()
                        {
                            delete_cancel();
                            var base_url = "<?php echo base_url(); ?>category/delete_category/";
                            $.ajax({
                                url: base_url,
                                type: 'post',
                                data: {category_id: category_ids},
                                success: function () {
                                    list_promotion();
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
                            list_promotion();
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
                            list_promotion();
                        }
                        function list_promotion()
                        {
                            var pagee = page;
                            if (pagee == '0')
                            {
                                var pagee = '1';
                            }
                            var truck_name = $('#search_truck').val();

                            $.ajax({
                                type: 'post',
                                data: {
                                    truck_name: truck_name,
                                    sort_field: sort_field,
                                    sort_type: sort_type,
                                    pagee: pagee
                                },
                                url: '<?php echo base_url(); ?>promotion/promotion_list/',
                                success: function (data)
                                {
                                    var json_obj = $.parseJSON(data);
                                    var result_length = json_obj.promotion_list.length;

                                    if (result_length > 0)
                                    {
                                        var output = "";
                                        var i;
                                        var default_path = '<?php echo base_url() . 'assets/dist/img/default.png' ?>';
                                        var error_src = "this.src='" + default_path + "'";

                                        for (i = 0; i < json_obj.promotion_list.length; i++)
                                        {

                                            var image = json_obj.promotion_list[i].truck_profile_image;

                                            var path = '<?php echo base_url() . 'upload/truck/' ?>';
                                            var image_path = path + image;

                                            output += '<tr>';
                                            output += "<td style='width:100px;text-align:center;'>";
                                            output += '<img src="' + image_path + '" style="width:50px;height:50px;" onerror="' + error_src + '" />';
                                            output += "</td>";
                                            output += "<td>" + json_obj.promotion_list[i].truck_name + "</td>";
                                            output += "<td>" + json_obj.promotion_list[i].businessname + "</td>";
                                            output += "<td style='width:200px;'>" + parseFloat(Math.round(json_obj.promotion_list[i].promotion_amount * 100) / 100).toFixed(2); + "</td>";
                                            output += "<td>" + json_obj.promotion_list[i].priority + "</td>";
                                            output += "<td style='width:150px'>";
                                            output += "<a href='<?php echo base_url(); ?>promotion/view_promostion/" + json_obj.promotion_list[i].promotion_id + "'><button  class='btn btn-success' title='View'><i class='fa fa-eye'></i></button></a>";

//                                            output += "<a href='javascript:void(0);' onclick='delete_category(" + json_obj.promotion_list[i].promotion_id + ")' ><button  class='btn btn-danger margin' title='Delete'><i class='fa fa-trash'></i></button></a>";
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
                                            } else
                                            {
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
                </div><!-- /.box -->
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
