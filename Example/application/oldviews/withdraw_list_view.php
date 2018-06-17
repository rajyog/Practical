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
           Withdraw Requests
            <small> List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>withdraw"><i class="fa fa-fw fa-credit-card"></i> Withdraw</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Withdraw Requests</h3>
                        <div class="box-tools">
                            <div class="input-group" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search By Account Holder Name" id="search_user">
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 100px" >Account Holder Name</th>
                                    <th style="width: 200px" >Account No.</th>
                                    <th style="width: 200px">Amount</th>
                                    <th style="width: 250px" >Status</th>
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
                            list_withdraw();
                            $('#search_user').keyup(function () {
                                page = '0';
                                list_withdraw();
                            });
                        });

                        function page_click(page_no)
                        {
                            page = page_no;
                            list_withdraw();
                        }

                        function list_withdraw()
                        {
                            var pagee = page;
                            if (pagee == '0')
                            {
                                var pagee = '1';
                            }
                            var account_holder_name = $('#search_user').val();
                            
                            $.ajax({
                                type: 'post',
                                data: {
                                    account_holder_name: account_holder_name,
                                    pagee: pagee
                                },
                                url: '<?php echo base_url(); ?>withdraw/withdraw_list/',
                                success: function (data)
                                {
                                    var json_obj = $.parseJSON(data);
                                    var result_length = json_obj.withdraw_list.length;

                                    if (result_length > 0)
                                    {
                                        var output = "";
                                        var i;
                                        var default_path = '<?php echo base_url() . 'assets/dist/img/default.png' ?>';
                                        var error_src = "this.src='" + default_path + "'";

                                        for (i = 0; i < json_obj.withdraw_list.length; i++)
                                        {
                                            output += '<tr>';
                                            output += "<td style='width:200px;'>" + json_obj.withdraw_list[i].account_holder_name + "</td>";
                                            output += "<td style='width:200px;'>" + json_obj.withdraw_list[i].account_no + "</td>";
                                            output += "<td style='width:200px;'>" + parseFloat(Math.round(json_obj.withdraw_list[i].amount * 100) / 100).toFixed(2); + "</td>";
                                            
                                            if(json_obj.withdraw_list[i].status=='confirm')
                                            {
                                                output += "<td>Processed</td>";
                                            }else
                                            {
                                                output += "<td>" + json_obj.withdraw_list[i].status + "</td>";
                                            }
                                            output += "<td style='width:100px;'>";
                                            output += "<a href='<?php echo base_url(); ?>withdraw/view_withdraw/" + json_obj.withdraw_list[i].wr_id + "'><button  class='btn btn-success' title='View'><i class='fa fa-eye'></i></button></a>";
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
