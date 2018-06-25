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
<div id="content">

    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?php echo base_url(); ?>admin/dashboard" title="Go to Dashboard" class="tip-bottom"><i class="icon-dashboard"></i>Dashboard</a> 
            <a href="" class="current">Advert Banner List</a> 
        </div>
        <h1>Advert Banner List</h1>
    </div>

    <div class="container-fluid"><hr>
        <div id="message"></div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Add Advert Banner</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" id="add_banner" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Banner Title</label>
                                <div class="controls">
                                    <input type="text" name="banner_name" id="banner_name" >
                                    <span id="error_banner_name" class="custom_error"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Banner Image</label>
                                <div class="controls">
                                    <input type="file" name="banner_image" id="banner_image" onchange="readURL(this);" accept=".png, .jpg, .jpeg" >
                                    <span id="error_banner_image_icon" class="custom_error"></span>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Add Banner" class="btn btn-success">
                            </div>
                            <div class="custom_msg" id="msg">                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-box">
            <div class="widget-title" id="widget_title_search"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Advert Banner List</h5>
                <div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix">                    <div class="dataTables_filter" id="DataTables_Table_0_filter">
                        <label><input type="text" aria-controls="DataTables_Table_0" id="max_banner" placeholder="No Of Banner"></label>
                        <label><a href="javascript:void(0);" onclick="set_limit()" class="btn btn-danger btn-mini" title="Set Limit">Set</a></label>
                        <label>Search:  <input type="text" aria-controls="DataTables_Table_0" id="search_banner" placeholder="Banner Name"></label>
                    </div>
                </div>
            </div>

            <script type="text/javascript">

                var page = '0'; //use in pagination

                $(document).ready(function () {

                    list_banner();
                    $('#search_banner').keyup(function () {
                        page = '0';
                        list_banner();
                    });

<?php if ($this->session->userdata('update_msg')) { ?>
                        $("#message").append('<div class="alert alert-success alert-block"><a class="close" data-dismiss="alert" href="#" onclick="this.parentElement.style.display=\'none\'">×</a><h4 class="alert-heading">Success!</h4>Banner successfully Updated.</div>').fadeIn(300).delay(6000).fadeOut(300);
    <?php
    $this->session->unset_userdata('update_msg');
}
?>

                    $("#add_banner").on("submit", function (e) {
                        e.preventDefault();
                        var banner_name = $("#banner_name").val();
                        if (banner_name == null || banner_name == "") {
                            var data = "Please enter banner_name.";
                            $("#error_banner_name").text(data);
                            return false;
                        } else
                        {
                            $("#error_banner_name").text("");
                        }

                        var banner_image_icon = document.getElementById("banner_image").value;
                        if (banner_image_icon == null || banner_image_icon == "") {
                            var data = "Please select banner image.";
                            $("#error_banner_image_icon").text(data);
                            return false;
                        } else
                        {
                            $("#error_banner_image_icon").text('');
                        }

                        var banner_image = new FormData(this);
                        banner_image.append('banner_name', banner_name);
                        var base_url = "<?php echo base_url(); ?>admin/banner/add_banner";
                        $.ajax({
                            type: 'POST',
                            url: base_url,
                            data: banner_image,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (data)
                            {
                                if (data == '0')
                                {
                                    $("#banner_name").val("");
                                    $("#banner_image").val("");
                                    list_banner();
                                    $("#message").empty();
                                    $("#message").append('<div class="alert alert-success alert-block"><a class="close" data-dismiss="alert" href="#" onclick="this.parentElement.style.display=\'none\'">×</a><h4 class="alert-heading">Success!</h4>Banner successfully inserted.</div>').fadeIn(300).delay(6000).fadeOut(300);
                                }
                                if (data == '1')
                                {
                                    $("#banner_name").val("");
                                    $("#banner_image").val("");
                                    $("#message").empty();
                                    $("#message").append('<div class="alert alert-error alert-block"><a class="close" data-dismiss="alert" href="#" onclick="this.parentElement.style.display=\'none\'">×</a><h4 class="alert-heading">Error!</h4>Connection falied Please try again.</div>').fadeIn(300).delay(6000).fadeOut(300);
                                }
                                if (data == '3')
                                {
                                    $("#banner_name").val("");
                                    $("#banner_image").val("");
                                    $("#message").empty();
                                    $("#message").append('<div class="alert alert-error alert-block"><a class="close" data-dismiss="alert" href="#" onclick="this.parentElement.style.display=\'none\'">×</a><h4 class="alert-heading">Error!</h4>Banner already exist please try other name.</div>').fadeIn(300).delay(6000).fadeOut(300);
                                }

                            },
                            error: function () {
                                console.log(data);
                            }
                        });
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
                    list_banner();
                }

                function readURL(input) {
                    var fuData = document.getElementById('banner_image');
                    var FileUploadPath = fuData.value;

                    //To check if user upload any file
                    if (FileUploadPath == '')
                    {
                        alert("Please upload an image");
                    } else {
                        var Extension = FileUploadPath.substring(
                                FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

                        //The file uploaded is an image
                        if (Extension == "jpeg" || Extension == "jpg")
                        {
                            // To Display
                            if (fuData.files && fuData.files[0])
                            {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('#blah').attr('src', e.target.result);
                                }
                                reader.readAsDataURL(fuData.files[0]);
                            }
                        }
                        //The file upload is NOT an image
                        else
                        {
                            var data = "Please Icon only allows file types of jpg, jpeg.";
                            $("#error_banner_image_icon").text(data);
                            document.getElementById('banner_image').value = '';
                            return false;
                        }
                    }
                }

//                function set_banner(banner_set)
//                {
//                    banner_id = banner_set;
//                    var base_url = "<?php echo base_url(); ?>admin/banner/set_banner_status/";
//                    $.ajax({
//                        url: base_url,
//                        type: 'post',
//                        data: {banner_id: banner_id},
//                        success: function () {
//                            list_banner();
//                        },
//                        error: function () {
//                            alert('ajax failure');
//                        }
//                    });
//                }


                function set_limit()
                {
                    var banner_limit = $("#max_banner").val();
                    //alert(banner_limit);
                    var base_url = "<?php echo base_url(); ?>admin/banner/update_banner_limit/";
                    $.ajax({
                        url: base_url,
                        type: 'post',
                        data: {banner_limit: banner_limit},
                        success: function (data) {
                            // alert(data);
//                            list_banner();
                            if (data == '1')
                            {
                                $("#max_banner").val("");
                                $("#message").empty();
                                $("#message").append('<div class="alert alert-error alert-block"><a class="close" data-dismiss="alert" href="#" onclick="this.parentElement.style.display=\'none\'">×</a><h4 class="alert-heading">Error!</h4>Banner limit Not Set less then no of set banner.</div>').fadeIn(300).delay(6000).fadeOut(300);


                                //$("#myModal4").show();
                                //$("#transparent_background").show();
                                list_banner();
                            }
                            if (data == '0')
                            {
                                list_banner();
                                $("#max_banner").val("");
                                $("#message").empty();
                                $("#message").append('<div class="alert alert-success alert-block"><a class="close" data-dismiss="alert" href="#" onclick="this.parentElement.style.display=\'none\'">×</a><h4 class="alert-heading">Success!</h4>Banner limit successfully Set.</div>').fadeIn(300).delay(6000).fadeOut(300);
                            }
                        },
                        error: function () {
                            alert('ajax failure');
                        }
                    });
                }
                var limit;
                function total_chk_checked()
                {
                    var base_url = "<?php echo base_url(); ?>admin/banner/chk_count_banner_limit/";
                    $.ajax({
                        async: false,
                        url: base_url,
                        type: 'post',
                        success: function (result) {
                            var json_obj = $.parseJSON(result);
                            limit = json_obj.total_check;
                        },
                        error: function () {
                            alert('ajax failure');
                        }
                    });
                }

                function doalert(id, max) {
                    total_chk_checked();
//                    var chk_count = 0;
//                    var e = document.getElementsByName("approve[]");
//                    console.log(e);
//                    for (i = 0; i < e.length; i++)
//                    {
//                        if (e[i].checked == true)
//                        {
//                            chk_count++;
//                        }
//                    }
//                    console.log(chk_count);
//                    if (chk_count > max)
                    var chk = limit + 1;
                    //alert(chk);
                    //alert(limit);
                    if (document.getElementById(id).checked) {
                        //alert('yes');

                        if (chk > max)
                        {
                            var banner_ids = document.getElementById(id).value;
                            document.getElementById(banner_ids).checked = false;

                            $("#check_limit_error").show();

                            $("#message").empty();
                            $("#message").append('<div class="alert alert-error alert-block" id="successfully"><a class="close" data-dismiss="alert" href="#" onclick="this.parentElement.style.display=\'none\'">×</a><h4 class="alert-heading">Error!</h4>You can not set more then limit.</div>').fadeIn(300).delay(6000).fadeOut(300);



//                            $("#myModal3").show();
//                            $("#transparent_background").show();

                        } else {
                            var banner_ids = document.getElementById(id).value;
                            var base_url = "<?php echo base_url(); ?>admin/banner/update_set_banner_status/";
                            $.ajax({
                                url: base_url,
                                type: 'post',
                                data: {banner_id: banner_ids},
                                success: function (data) {


                                    if (data == '0')
                                    {
                                        $("#message").empty();
                                        $("#message").append('<div class="alert alert-success alert-block" id="successfully"><a class="close" data-dismiss="alert" href="#" onclick="this.parentElement.style.display=\'none\'">×</a><h4 class="alert-heading">Success!</h4>Banner successfully Set.</div>').fadeIn(300).delay(6000).fadeOut(300);
                                        //$("#myModal4").show();
                                        //$("#transparent_background").show();
                                        list_banner();
                                    }
                                    list_banner();
                                },
                                error: function () {
                                    alert('ajax failure');
                                }
                            });
                        }
                    } else {
                        //alert('no');
                        var banner_ids = document.getElementById(id).value;
                        var base_url = "<?php echo base_url(); ?>admin/banner/update_unset_banner_status/";
                        $.ajax({
                            url: base_url,
                            type: 'post',
                            data: {banner_id: banner_ids},
                            success: function () {
                                list_banner();
                            },
                            error: function () {
                                alert('ajax failure');
                            }
                        });
                    }



//
//                    if (document.getElementById(id).checked) {
//                        var banner_ids = document.getElementById(id).value;
//
//                        var base_url = "<?php echo base_url(); ?>admin/banner/update_set_banner_status/";
//
//                        $.ajax({
//                            url: base_url,
//                            type: 'post',
//                            data: {banner_id: banner_ids},
//                            success: function () {
//                                list_banner();
//                            },
//                            error: function () {
//                                alert('ajax failure');
//                            }
//                        });
//                    } else {
//                        var banner_ids = document.getElementById(id).value;
//
//                        var base_url = "<?php echo base_url(); ?>admin/banner/update_unset_banner_status/";
//
//                        $.ajax({
//                            url: base_url,
//                            type: 'post',
//                            data: {banner_id: banner_ids},
//                            success: function () {
//                                list_banner();
//                            },
//                            error: function () {
//                                alert('ajax failure');
//                            }
//                        });
//                    }
//                    
                }
                function select_ok()
                {
                    $("#myModal3").hide();
                    $("#myModal4").hide();
                    $("#transparent_background").hide();
                }
                function page_click(page_no)
                {
                    page = page_no;
                    list_banner();
                }
                var is_checked;
                function list_banner()
                {
                    var pagee = page;
                    if (pagee == '0')
                    {
                        var pagee = '1';
                    }

                    var banner_name = $('#search_banner').val();
                    $.ajax({
                        type: 'POST',
                        data: {
                            pagee: pagee,
                            banner_name: banner_name,
                            sort_field: sort_field,
                            sort_type: sort_type
                        },
//                        dataType: 'json',
                        url: '<?php echo base_url(); ?>admin/banner/banner_list/',
                        success: function (result) {
                            //alert(result);

                            var json_obj = $.parseJSON(result);
                            var result_length = json_obj.banner_data.length;
                            if (result_length > 0)
                            {
                                var output = "";
                                var i;
                                var default_path = '<?php echo base_url() . 'img/default.png' ?>';
                                var error_src = "this.src='" + default_path + "'";
                                for (i = 0; i < json_obj.banner_data.length; i++)
                                {
                                    var image = json_obj.banner_data[i].banner_image;
                                    if (image != '')
                                    {
                                        var path = '<?php echo base_url() . 'uploads/banner/' ?>';
                                        var image_path = path + image;
                                    } else {
                                        var image_path = '<?php echo base_url() . 'img/default.png' ?>';
                                    }

                                    var status = json_obj.banner_data[i].banner_set;
                                    var is_color = (status == '1') ? 'grade_block' : 'gradeA odd';
                                    output += "<tr class='" + is_color + "'>";
                                    output += "<td style='width:16px;text-align:center;'>";
                                    var set = json_obj.banner_data[i].banner_set;
                                    var max = "" + json_obj.banner_data[i].banner_limit + "";
//                                    var is_checked = (set == '1') ? 'checked' : '';
//                                    alert(is_checked);
                                    if (set == '1')
                                    {
                                        output += "<input type='checkbox' name='approve[]' value='" + json_obj.banner_data[i].banner_id + "' id='" + json_obj.banner_data[i].banner_id + "' onchange='doalert(this.id," + max + ");' checked />";
                                    } else {
                                        output += "<input type='checkbox' name='approve[]' value='" + json_obj.banner_data[i].banner_id + "' id='" + json_obj.banner_data[i].banner_id + "' onchange='doalert(this.id," + max + ");'/>";
                                    }
                                    output += "</td>";
                                    output += "<td style='width:100px;text-align:center;'>";
                                    output += '<img src="' + image_path + '" style="width:50px;height:50px;" onerror="' + error_src + '" />';
                                    output += "</td>";
                                    output += "<td >" + json_obj.banner_data[i].banner_title + "</td>";
//                                    var is_set = json_obj.banner_data[i].banner_set;
//                                    if (is_set == '0')
//                                    {
//                                        var banner_set = 'unset';
//                                    } else {
//                                        var banner_set = 'set';
//                                    }
//                                    output += "<td style='width:100px;'>" + banner_set + "</td>";
                                    output += "<td style='width:135px;'>";
//                                    output += "<a href='javascript:void(0);' onclick='set_banner(" + json_obj.banner_data[i].banner_id + ")' class='btn btn-success btn-mini' title='Banner'>Set</a>";
                                    output += "<a href='<?php echo base_url(); ?>admin/banner/edit_banner/" + json_obj.banner_data[i].banner_id + "' class='btn btn-primary btn-mini' title='Edit Banner'>Edit</a>";
                                    output += "<a href='javascript:void(0);' onclick='delete_banner(" + json_obj.banner_data[i].banner_id + ")' class='btn btn-danger btn-mini' title='Delete Banner'>Delete</a>";
                                    output += "</td>";
                                    output += "</tr>";
                                }

                                output += "</table>";
                                $('#page_table').html(output);
                                var paging = "";
                                paging += "<div class='pagination'>";
                                paging += "<ul>";
                                var no = json_obj.total_pages;
                                if (pagee > 1) {
                                    var onclick_li = 'onclick = "return page_click(' + (pagee - 1) + ')"';
                                    paging += '<li ' + onclick_li + '"><</li>';
                                }

                                for (i = 1; i <= no; i++) {
                                    var onclick_li = 'onclick = "return page_click(' + i + ')"';
                                    if (pagee == i)
                                    {
                                        paging += '<li ' + onclick_li + 'class="active">' + i + '</li>';
                                    } else
                                    {
                                        paging += '<li ' + onclick_li + ' >' + i + '</li>';
                                    }
                                }

                                if (pagee < no)
                                {
                                    var onclick_li = 'onclick = "return page_click(' + (parseInt(pagee) + 1) + ')"';
                                    paging += '<li ' + onclick_li + '>></li>';
                                }

                                paging += "</ul>";
                                paging += "</div>";
                                $('#paging').html(paging);
                            } else {
                                var output = "";
                                $('#page_table').html(output);
                                var paging = "<div class='error_ex'>";
                                paging += "<h3>No result found!</h3>";
                                paging += "<p>plese search other recode</p>";
                                paging += "</div>";
                                $('#paging').html(paging);
                            }
                        }
                    });
                }

                var banner_ids = '';
                function delete_banner(banner_id)
                {
                    banner_ids = banner_id;
                    $("#myModal2").show();
                    $("#transparent_background").show();
                }
                function delete_ok()
                {
                    delete_cancel();
                    var base_url = "<?php echo base_url(); ?>admin/banner/delete_banner/";
                    $.ajax({
                        url: base_url,
                        type: 'post',
                        data: {banner_id: banner_ids},
                        success: function () {
                            list_banner();
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
                function check_limit_error_cancel()
                {
                    $("#check_limit_error").hide();
                }
                function limit_error_cancel()
                {
                    $("#limit_error").hide();
                }
            </script>

            <div class="widget-content nopadding">
                <table class='table table-bordered data-table'>
                    <thead>
                        <tr>
                            <th><a style="cursor:pointer;width:100px;"> Banner Set </a> </th>
                            <th><a style="cursor:pointer;width:100px;"> Banner Image </a> </th>
                            <th><a style="cursor:pointer;" onclick="return sort_filter('banner_title');" > Banner Name <i class="icon-sort" ></i></a></th>
<!--                            <th><a style="cursor:pointer;" onclick="return sort_filter('banner_set');" > Set Status <i class="icon-sort" ></i></a></th>-->
                            <th style="width:135px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="page_table">

                    </tbody>
                </table>
                <div id="paging">

                </div>  
            </div>
        </div>`
    </div>

    <form class="form-horizontal" method="post" id="confirm">
        <div id="myModal3" class="modal hide">
            <div class="modal-header">
                <h3>Selection Warnning</h3>
            </div>
            <div class="modal-body">
                <p>You can not set more then limit.</p>
            </div>
            <div class="modal-footer">
                <input type="button" data-dismiss="modal" class="btn btn-inverse" onclick="select_ok();" id="ok" value="Ok">
            </div>
        </div>
    </form>
    <form class="form-horizontal" method="post" id="confirm">
        <div id="myModal4" class="modal hide">
            <div class="modal-header">
                <h3>Error Warnning</h3>
            </div>
            <div class="modal-body">
                <p>Banner limit not set less then set banner.</p>
            </div>
            <div class="modal-footer">
                <input type="button" data-dismiss="modal" class="btn btn-inverse" onclick="select_ok();" id="ok" value="Ok">
            </div>
        </div>
    </form>
    <form class="form-horizontal" method="post" id="confirm">
        <div id="myModal2" class="modal hide">
            <div class="modal-header">
                <h3>Delete Warnning</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete?</p>
            </div>
            <div class="modal-footer">
                <input type="button" data-dismiss="modal" class="btn btn-inverse" onclick="delete_ok();" id="ok" value="Ok">
                <input type="button" data-dismiss="modal" class="btn btn-inverse" onclick="return delete_cancel();"id="cancel" value="Cancel">
            </div>
        </div>
    </form>
</div>
<div class="transparent" id="transparent_background"></div>
<?php
include 'footer.php';
?>