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
            Order
            <small> List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>order"><i class="fa fa-cart-plus"></i>Order</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Order List</h3>
                        <div class="box-tools col-md-10 ">
                            <div class="col-xs-3 col-sm-offset-6">
                                <div class="input-group">
<!--                                    <input type="text" name="distance" class="form-control input-sm pull-right"  placeholder="Enter start date" id="max_price"/>-->
                                    <input id="datepicker" class="form-control input-sm pull-right" placeholder="Filter By Start Date"/>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group">
<!--                                    <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Enter end date" id="search_item">-->

                                    <input id="datepicker1" class="form-control input-sm pull-right" placeholder="Filter By End Date"/>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 100px" >Image</th>
                                    <th style="width: 200px" onclick="return sort_filter('user_username');"> User Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width: 200px" onclick="return sort_filter('truck_name');">Truck Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width: 200px" onclick="return sort_filter('item_title');">Item Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width: 250px" >Order Date</th>
                                    <th style="width: 100px">Action</th>
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
                            $("#datepicker").datepicker();
                            list_order();

                            $('#datepicker').datepicker().on('changeDate', function () {
                                list_order();
                            });

                            $('#datepicker1').datepicker().on('changeDate', function () {
                                list_order();
                            });

                        });

                        function page_click(page_no)
                        {
                            page = page_no;
                            list_order();
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
                            list_order();
                        }
                        function list_order()
                        {
                            var pagee = page;
                            if (pagee == '0')
                            {
                                var pagee = '1';
                            }

                            var start_date = $('#datepicker').val();
                            var end_date = $('#datepicker1').val();

                            $.ajax({
                                type: 'post',
                                data: {
                                    start_date: start_date,
                                    end_date: end_date,
                                    sort_field: sort_field,
                                    sort_type: sort_type,
                                    pagee: pagee
                                },
                                url: '<?php echo base_url(); ?>order/order_list/',
                                success: function (data)
                                {
                                    var json_obj = $.parseJSON(data);
                                    var result_length = json_obj.order_list.length;

                                    if (result_length > 0)
                                    {
                                        var output = "";
                                        var i;
                                        var default_path = '<?php echo base_url() . 'assets/dist/img/default.png' ?>';
                                        var error_src = "this.src='" + default_path + "'";

                                        for (i = 0; i < json_obj.order_list.length; i++)
                                        {
                                            var image = json_obj.order_list[i].user_image;

                                            var path = '<?php echo base_url() . 'upload/user/' ?>';
                                            var image_path = path + image;

                                            output += '<tr>';
                                            output += "<td style='width:100px;text-align:center;'>";
                                            output += '<img src="' + image_path + '" style="width:50px;height:50px;" onerror="' + error_src + '" />';
                                            output += "</td>";
                                            output += "<td style='width:200px;'>" + json_obj.order_list[i].user_username + "</td>";
                                            output += "<td style='width:200px;'>" + json_obj.order_list[i].truck_name + "</td>";
                                            output += "<td style='width:200px;'>" + json_obj.order_list[i].item_title + "</td>";
                                            output += "<td style='width:200px;'>" + json_obj.order_list[i].order_date + "</td>";
                                            output += "<td style='width:100px;'>";
                                            output += "<a href='<?php echo base_url(); ?>order/view_order/" + json_obj.order_list[i].order_code + "'><button  class='btn btn-success' title='View'><i class='fa fa-eye'></i></button></a>";
                                            output += "</td>";
                                            output += "</tr>";
                                        }

                                        $('#page_table').html(output);
                                        var paging = "";
                                        paging += "<ul class='pagination pagination-sm no-margin pull-right'>";
                                        var no = json_obj.total_pages;
                                        if (pagee > 1) {
                                            var onclick_li = 'onclick = "return page_click(' + (pagee - 1) + ')"';
                                            paging += '<li ' + onclick_li + '"><a href="#">&laquo;</a></li>';
                                        }

                                        for (i = 1; i <= no; i++) {
                                            var onclick_li = 'onclick = "return page_click(' + i + ')"';
                                            if (pagee == i)
                                            {
                                                paging += '<li ' + onclick_li + ' class="paginate_button active"><a href="#">' + i + '</a></li>';
                                            } else
                                            {
                                                paging += '<li ' + onclick_li + '><a href="#">' + i + '</a><li>';
                                            }
                                        }

                                        if (pagee < no)
                                        {
                                            var onclick_li = 'onclick = "return page_click(' + (parseInt(pagee) + 1) + ')"';
                                            paging += '<li ' + onclick_li + '><a href="#">&raquo;</a></li>';
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
