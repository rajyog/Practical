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
            Item
            <small> List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>item"><i class="fa fa-spoon"></i> Item</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Item List</h3>
                        <div class="box-tools col-md-10 ">
                            <div class="col-xs-3 col-sm-offset-3">
                                <select class="form-control input-sm" id="filter_category_name" style="width: 150px">
                                    <option value="" selected="selected">-- Filter By Category --</option>
                                    <?php
                                    foreach ($category as $row => $value) {
                                        echo '<option value="' . $value['category_id'] . '">' . $value['category_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group">
                                    <input type="text" name="distance" class="form-control input-sm pull-right"  placeholder="Filter By Item Price" id="max_price"/>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group">
                                    <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search By Item Name" id="search_item">
                                    <!--                                <div class="input-group-btn">
                                                                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 100px">Item Image</th>
                                    <th style="width: 200px" onclick="return sort_filter('item_title');">Item Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width: 250px" onclick="return sort_filter('truck_name');">Truck Name<i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width: 100px" onclick="return sort_filter('item_price');">Item Price<i class="fa fa-fw fa-sort" ></i></th>
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
                            list_item();

                            $('#filter_category_name').change(function () {
                                page = '0';
                                var category_name = $('#filter_category_name').val();
                                list_item();
                            });

                            $('#search_item').keyup(function () {
                                page = '0';
                                list_item();
                            });

                            $('#max_price').keyup(function () {
                                page = '0';
                                list_item();
                            });

                        });

                        function page_click(page_no)
                        {
                            page = page_no;
                            list_item();
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
                            list_item();
                        }
                        function list_item()
                        {
                            var pagee = page;
                            if (pagee == '0')
                            {
                                var pagee = '1';
                            }

                            var item_title = $('#search_item').val();
                            var item_price = $('#max_price').val();
                            var category_id = $("#filter_category_name").val();

                            $.ajax({
                                type: 'post',
                                data: {
                                    item_title: item_title,
                                    item_price: item_price,
                                    category_id: category_id,
                                    sort_field: sort_field,
                                    sort_type: sort_type,
                                    pagee: pagee
                                },
                                url: '<?php echo base_url(); ?>item/item_list/',
                                success: function (data)
                                {
//                                    alert(data);
                                    var json_obj = $.parseJSON(data);
                                    var result_length = json_obj.item_list.length;

                                    if (result_length > 0)
                                    {
                                        var output = "";
                                        var i;
                                        var default_path = '<?php echo base_url() . 'assets/dist/img/default.png' ?>';
                                        var error_src = "this.src='" + default_path + "'";

                                        for (i = 0; i < json_obj.item_list.length; i++)
                                        {
                                            var image = json_obj.item_list[i].item_image;
                                            var path = '<?php echo base_url() . 'upload/items/' ?>';
                                            var image_path = path + image;

                                            output += '<tr>';
                                            output += "<td style='width:100px;text-align:center;'>";
                                            output += '<img src="' + image_path + '" style="width:50px;height:50px;" onerror="' + error_src + '" />';
                                            output += "</td>";
                                            output += "<td style='width:200px;'>" + json_obj.item_list[i].item_title + "</td>";
                                            output += "<td>" + json_obj.item_list[i].truck_name + "</td>";



                                            output += "<td style='width:100px;'>" + parseFloat(Math.round(json_obj.item_list[i].item_price * 100) / 100).toFixed(2);
                                            +"</td>";
                                            output += "<td style='width:100px;'>";
                                            output += "<a href='<?php echo base_url(); ?>item/view_user/" + json_obj.item_list[i].item_id + "'><button  class='btn btn-success' title='View'><i class='fa fa-eye'></i></button></a>";
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
                                                //paging += '<li ' + onclick_li + 'class="active">' + i + '</li>';
                                                paging += '<li ' + onclick_li + ' class="paginate_button active"><a style="cursor:pointer">' + i + '</a></li>';
                                            } else
                                            {
                                                //paging += '<li ' + onclick_li + ' >' + i + '</li>';
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
