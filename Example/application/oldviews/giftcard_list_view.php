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
            Giftcard
            <small> List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>giftcard"><i class="fa fa-fw fa-gift"></i> Giftcard</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Giftcard Requests</h3>
                        <div class="box-tools">
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 100px" onclick="return sort_filter('sender');">Sender<i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width: 200px" onclick="return sort_filter('recever');">Receiver<i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width:auto" onclick="return sort_filter('giftcard_message');">Message<i class="fa fa-fw fa-sort" ></i></th>
                                    <th style="width: 100px" onclick="return sort_filter('giftcard_amount');">Amount<i class="fa fa-fw fa-sort" ></i></th>
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
                            list_giftcard();
                            $('#search_user').keyup(function () {
                                page = '0';
                                list_giftcard();
                            });
                        });
                        
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
                            list_giftcard();
                        }

                        function page_click(page_no)
                        {
                            page = page_no;
                            list_giftcard();
                        }

                        function list_giftcard()
                        {
                            var pagee = page;
                            if (pagee == '0')
                            {
                                var pagee = '1';
                            }
                            var receiver_name = $('#search_user').val();
                            
                            $.ajax({
                                type: 'post',
                                data: {
                                    receiver_name: receiver_name,
                                    sort_field: sort_field,
                                    sort_type: sort_type,
                                    pagee: pagee
                                },
                                url: '<?php echo base_url(); ?>giftcard/giftcard_list/',
                                success: function (data)
                                {
//                                    alert(data);
                                    var json_obj = $.parseJSON(data);
                                    var result_length = json_obj.giftcard_list.length;

                                    if (result_length > 0)
                                    {
                                        var output = "";
                                        var i;
                                        var default_path = '<?php echo base_url() . 'assets/dist/img/default.png' ?>';
                                        var error_src = "this.src='" + default_path + "'";

                                        for (i = 0; i < json_obj.giftcard_list.length; i++)
                                        {
                                            output += '<tr>';
                                            output += "<td style='width:200px;'>" + json_obj.giftcard_list[i].sender + "</td>";
                                            output += "<td style='width:200px;'>" + json_obj.giftcard_list[i].recever + "</td>";
                                            output += "<td>" + json_obj.giftcard_list[i].giftcard_message + "</td>";
                                            output += "<td style='width:200px;'>" + parseFloat(Math.round(json_obj.giftcard_list[i].giftcard_amount * 100) / 100).toFixed(2); + "</td>";
                                            output += "<td style='width:100px;'>";
                                            output += "<a href='<?php echo base_url(); ?>giftcard/view_giftard/" + json_obj.giftcard_list[i].giftcard_id + "'><button  class='btn btn-success' title='View'><i class='fa fa-eye'></i></button></a>";
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
