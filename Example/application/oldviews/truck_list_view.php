<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
include 'header.php';
//API___KEY: AIzaSyD7p7J6dh_PJpuq11cAork8mEnKtQ0s_Xk
?>

<!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD7p7J6dh_PJpuq11cAork8mEnKtQ0s_Xk&libraries=places"></script>-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD7p7J6dh_PJpuq11cAork8mEnKtQ0s_Xk&libraries=places"></script>
<!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>-->
<!--<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            var mesg = "Address: " + address;
            mesg += "\nLatitude: " + latitude;
            mesg += "\nLongitude: " + longitude;
             alert(mesg);
        });
    });
</script>-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Truck
            <small> List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>truck"><i class="fa fa-truck"></i> Truck</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Truck List</h3>
                        <div class="box-tools col-md-10" >
                            <div class="col-xs-3">
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
                                    <input type="text" id="txtPlaces" class="form-control input-sm pull-right"  placeholder="Location -  Filter By Distance" />
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <!--                                <div class="input-group">
                                                                    <input type="text" name="distance" class="form-control input-sm pull-right"  placeholder="Filter By Distance" id="max_distance"/>
                                                                </div>-->
                                <select class="form-control input-sm" id="max_distance" style="width: 150px">
                                    <option value="" selected="selected">-- Filter By Distance --</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group">
                                    <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search By Truck Name" id="search_truck">
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
                                    <th style="width: 100px" >Image</th>
                                    <th style="width: 200px" onclick="return sort_filter('truck_name');">Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width: 250px" >Email </th>
                                    <th style="width: 100px" onclick="return sort_filter('truck_phoneno');">Phone No.<i class="fa fa-fw fa-sort" ></i></th>
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
                        var latitude;
                        var longitude;
                        google.maps.event.addDomListener(window, 'load', function () {
                            var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
                            google.maps.event.addListener(places, 'place_changed', function () {
                                var place = places.getPlace();
                                var address = place.formatted_address;
                                latitude = place.geometry.location.lat();
                                longitude = place.geometry.location.lng();
                                var mesg = "Address: " + address;
                                mesg += "\nLatitude: " + latitude;
                                mesg += "\nLongitude: " + longitude;
//                                alert(mesg);
                                list_truck();
                            });
                        });


                        var page = '0';//use in pagination
                        $(document).ready(function () {
                            list_truck();

                            $('#filter_category_name').change(function () {
                                page = '0';
                                var category_name = $('#filter_category_name').val();
                                list_truck();
                            });
                            $('#max_distance').change(function () {
                                page = '0';
                                var max_distance = $('#max_distance').val();
                                list_truck();
                            });

                            $('#search_truck').keyup(function () {
                                page = '0';
                                list_truck();
                            });

//                            $('#max_distance').keyup(function () {
//                                page = '0';
//                                list_truck();
//                            });
                        });

                        function page_click(page_no)
                        {
                            page = page_no;
                            list_truck();
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
                            list_truck();
                        }
                        function list_truck()
                        {
                            var pagee = page;
                            if (pagee == '0')
                            {
                                var pagee = '1';
                            }
                            var truck_name = $('#search_truck').val();
                            var category_id = $("#filter_category_name").val();
                            var max_distance = $("#max_distance").val();

                            $.ajax({
                                type: 'post',
                                data: {
                                    truck_name: truck_name,
                                    category_id: category_id,
                                    max_distance: max_distance,
                                    latitude: latitude,
                                    longitude: longitude,
                                    sort_field: sort_field,
                                    sort_type: sort_type,
                                    pagee: pagee
                                },
                                url: '<?php echo base_url(); ?>truck/truck_list/',
                                success: function (data)
                                {
//                                    alert(data);
                                    var json_obj = $.parseJSON(data);
                                    var result_length = json_obj.truck_list.length;

                                    if (result_length > 0)
                                    {
                                        var output = "";
                                        var i;
                                        var default_path = '<?php echo base_url() . 'assets/dist/img/default.png' ?>';
                                        var error_src = "this.src='" + default_path + "'";

                                        for (i = 0; i < json_obj.truck_list.length; i++)
                                        {
                                            var image = json_obj.truck_list[i].truck_profile_image;
                                            var path = '<?php echo base_url() . 'upload/truck/' ?>';
                                            var image_path = path + image;
                                            output += '<tr>';
                                            output += "<td style='width:100px;text-align:center;'>";
                                            output += '<img src="' + image_path + '" style="width:50px;height:50px;" onerror="' + error_src + '" />';
                                            output += "</td>";
                                            output += "<td style='width:200px;'>" + json_obj.truck_list[i].truck_username + "</td>";
                                            output += "<td>" + json_obj.truck_list[i].truck_emailid + "</td>";
                                            output += "<td style='width:100px;'>" + json_obj.truck_list[i].truck_phoneno;
                                            +"</td>";
                                            output += "<td style='width:100px;'>";
                                            output += "<a href='<?php echo base_url(); ?>truck/view_user/" + json_obj.truck_list[i].truck_id + "'><button  class='btn btn-success' title='View'><i class='fa fa-eye'></i></button></a>";
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
