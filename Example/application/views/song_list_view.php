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
            Track
            <small> List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>song"><i class="fa fa-fw fa-music"></i> Track</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-comment">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Track</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="add_song">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Track Name</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="song_name" placeholder="Track Name">
                                </div>
                                <label for="inputPassword3" id="error_song_name" class="control-label pull-left"></label>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Category Name</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="select_category_name" onchange="reload(this.form)">
                                        <option value="" selected="selected">-- Select Category --</option>
                                        <?php
                                        foreach ($category as $row => $value) {
                                            echo '<option value="' . $value['category_id'] . '">' . $value['category_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_song_category" class="control-label pull-left"></label>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Sub Category Name</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="sub_category_name">
                                        <option value="" selected="selected">-- Select Sub Category --</option>
                                        <?php
                                        foreach ($subcategory as $row2 => $value2) {
                                            echo '<option value="' . $value2['sub_category_id'] . '">' . $value2['sub_category_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputPassword3" id="error_sub_category" class="control-label pull-left"></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile" class="col-sm-2 control-label">Select Music</label>
                                <div class="col-sm-5">
                                    <input type="file" id="songfile" name="songfile" onchange="readURL(this);">
                                </div>
                                
                                <label for="inputPassword3" id="error_music_name" class="control-label pull-left"></label>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class=" col-sm-offset-2">
                                <button type="submit" class="btn bg-blue">Add Track</button>
                                <img src="<?php echo progressbar_url ?>" id="progressbar" style="display: none">
                                <label for="inputPassword3" id="error_message" class="control-label"></label>
                            </div>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Track List</h3>
                        <div class="box-tools col-md-10" >

                            <div class="col-xs-3 col-sm-offset-6">
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
                                    <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search By Track Name" id="search_category">
                                </div>
                            </div>

                        </div>
                    </div><!-- /.box-header -->
                    <div id="loading" class="loading"></div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th  onclick="return sort_filter('song_name');">Track Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th  onclick="return sort_filter('category_name');">Category Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th  onclick="return sort_filter('artist_name');">Artist Name <i class="fa fa-fw fa-sort" ></i></th>
                                    <th>BPM</th>
                                    <th>Notes</th>
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
					
					
		function reload(form)
		{
		var category_name = $('#select_category_name').val();
		//alert(category_name);
		var base_url = '<?php echo base_url().'song/get_sub_category'?>';
		$.ajax({
			type: "POST",
			url: base_url,
			data:'category_name='+category_name,
			success: function(data){
				$("#sub_category_name").html(data);
			}
		});
		
	}
															
					
                        var page = '0';//use in pagination
                        $(document).ready(function () {
                            list_song();

                            $('#filter_category_name').change(function () {
                                pages = '0';
								//add_subcategory_name();
                                list_song();
                            });
                            
                            $("#add_song").on("submit", function (e) {
                                e.preventDefault();
                                var base_url = "<?php echo base_url(); ?>song/add_song";
                                var song_name = $("#song_name").val();
                                var category_name = $("#select_category_name").val();
								var sub_category_id = $("#sub_category_name").val();
                                var artist_name = $("#artist_name").val();
								var bpm = $("#bpm").val();
								var note = $("#select_note").val();
                                var songfile = $("#songfile").val();

                                if (song_name == null || song_name == "") {
                                    var data = "Please enter Track name.";
                                    $("#error_song_name").text(data);
                                    return false;
                                } else {
                                    $("#error_song_name").text("");
                                }
                                if (category_name == null || category_name == "") {
                                    var data = "Please enter category name.";
                                    $("#error_song_category").text(data);
                                    return false;
                                } else {
                                    $("#error_song_category").text("");
                                }
								if (sub_category_id == null || sub_category_id == "") {
                                    var data = "Please enter sub category name.";
                                    $("#error_sub_category").text(data);
                                    return false;
                                } else {
                                    $("#error_sub_category").text("");
                                }
                                if (artist_name == null || artist_name == "") {
                                    var data = "Please enter artist name.";
                                    $("#error_artist_name").text(data);
                                    return false;
                                } else {
                                    $("#error_artist_name").text("");
                                }
                               
							   
							    if (note == null || note == "") {
                                    var data = "Please select note.";
                                    $("#error_note").text(data);
                                    return false;
                                } else {
                                    $("#error_note").text("");
                                }
								
								if (bpm == null || bpm == "") {
                                    var data = "Please enter BPM.";
                                    $("#error_bpm").text(data);
                                    return false;
                                } else {
                                    $("#error_bpm").text("");
                                }
								
								if (40 > parseInt(bpm))
								{		
																			
									var data = "Please enter between 40 to 220.";
									$("#error_bpm_point").text(data);
									return false;
								}
								else if(parseInt(bpm) > 220) 
								{
									var data = "Please enter between 40 to 220.";
									$("#error_bpm_point").text(data);
									return false;
								}
								else
								{
									$("#error_bpm_point").text("");
								}
								
								 if (songfile == null || songfile == "") {
                                    var data = "Please enter song file.";
                                    $("#error_music_name").text(data);
                                    return false;
                                } else {
                                    $("#error_music_name").text("");
                                }

                                var song_audio = new FormData(this);
                                song_audio.append('song_name', song_name);
                                song_audio.append('category_name', category_name);
								song_audio.append('sub_category_id', sub_category_id);
                                song_audio.append('artist_name', artist_name);
								song_audio.append('bpm', bpm);
								song_audio.append('note', note);

                                $.ajax({
                                    type: 'POST',
                                    url: base_url,
                                    data: song_audio,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    beforeSend: function () {
                                        $("#progressbar").show();
                                    },
                                    success: function (data)
                                    {
                                        if (data == 0) {
                                           $("#song_name").val("");
                                            $("#select_category_name").val("");
											$("#sub_category_name").val("");
                                            $("#artist_name").val("");
											$("#bpm").val("");
											$("#select_note").val("");
                                            $("#songfile").val("");
                                            $("#error_message").text('Track successfully inserted');
                                            $("#progressbar").hide();
                                            list_song();
                                        }
                                        if (data == 1) {
                                            $("#category_name").val("");
                                            $("#error_message").text('Server Authentication Failed Please Try Again');
                                            $("#progressbar").hide();
                                        }
                                        if (data == 3) {
                                            $("#category_name").val("");
                                            $("#error_message").text('Track already exist please try other name.');
                                            $("#progressbar").hide();
                                        }
                                    },
                                    error: function () {

                                    }
                                });
                            });

                            $('#search_category').keyup(function () {
                                page = '0';
                                list_song();
                            });

                        });

                        function readURL(input) {
                            var fuData = document.getElementById('songfile');
                            var FileUploadPath = fuData.value;
                            if (FileUploadPath == '')
                            {
                                alert("Please upload an image");
                            } else {
                                var Extension = FileUploadPath.substring(
                                        FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

                                if (Extension == "mp3") {
                                    if (fuData.files && fuData.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            $('#blah').attr('src', e.target.result);
                                        }
                                        reader.readAsDataURL(fuData.files[0]);
                                    }
                                } else {
                                    var data = "Please music only allows file types of mp3.";
                                    $("#error_music_name").text(data);
                                    document.getElementById('songfile').value = '';
                                    return false;
                                }
                            }
                        }
						
						

                        var song_ids = '';
                        function delete_category(song_id)
                        {
                            song_ids = song_id;
                            $("#myModal2").show();
                            $("#transparent_background").show();
                        }
                        function delete_ok()
                        {
                            delete_cancel();
                            var base_url = "<?php echo base_url(); ?>song/delete_song/";
                            $.ajax({
                                url: base_url,
                                type: 'post',
                                data: {song_id: song_ids},
                                success: function () {
                                    list_song();
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
                            list_song();
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
                            list_song();
                        }
                        function list_song()
                        {
                            $("#loading").show();
                            var pagee = page;
                            if (pagee == '0')
                            {
                                var pagee = '1';
                            }
                            var song_name = $('#search_category').val();
                            var category_id = $("#filter_category_name").val();
                            $.ajax({
                                type: 'post',
                                data: {
                                    category_id: category_id,
                                    song_name: song_name,
                                    sort_field: sort_field,
                                    sort_type: sort_type,
                                    pagee: pagee
                                },
                                url: '<?php echo base_url(); ?>song/song_list/',
                                success: function (data)
                                {
                                    var json_obj = $.parseJSON(data);
                                    var result_length = json_obj.song_list.length;

                                    if (result_length > 0)
                                    {
                                        var output = "";
                                        var i;
                                        var default_path = '<?php echo base_url() . 'assets/dist/img/default.png' ?>';
                                        var error_src = "this.src='" + default_path + "'";

                                        for (i = 0; i < json_obj.song_list.length; i++)
                                        {
                                            var first = json_obj.song_list[i].note.substr(0, 1);
											
											var sec = json_obj.song_list[i].note.substr(1, 1);
											if(sec=='#' || sec=='b')
											{
												var sec_res = sec.sup();
											}
											else
											{
												var sec_res = sec.sub();
											}
											
											var third = json_obj.song_list[i].note.substr(2, 1);
											if(third=='#' || third=='b')
											{
												var third_res = third.sup();
											}
											else
											{
												var third_res = third.sub();
											}
											
											var forth = json_obj.song_list[i].note.substr(3, 1);
											var fifth = json_obj.song_list[i].note.substr(4, 1);
											var sixth = json_obj.song_list[i].note.substr(5, 1);
											if(sixth=='#' || sixth=='b')
											{
												var sixth_res = sixth.sup();
											}
											else
											{
												var sixth_res = sixth.sub();
											}
											
											var seventh = json_obj.song_list[i].note.substr(6, 1);
											if(seventh=='#' || seventh=='b')
											{
												var seventh_res = seventh.sup();
											}
											else
											{
												var seventh_res = seventh.sub();
											}
											
											//alert(seventh_res);
                                                                                        var image = json_obj.user_list[i].user_image;
                                            var path = '<?php echo user_image_url ?>';
                                            var image_path = path + image;

                                            output += '<tr>';
                                            output += "<td style='width:100px;text-align:center;'>";
                                            output += '<img src="' + image_path + '" style="width:50px;height:50px;" onerror="' + error_src + '" />';
                                            output += "</td>";

											
                                            output += "<td>" + json_obj.song_list[i].song_name + "</td>";
                                            output += "<td>" + json_obj.song_list[i].category_name + "</td>";
                                            output += "<td>" + json_obj.song_list[i].artist_name + "</td>";
											output += "<td>" + json_obj.song_list[i].bpm + "</td>";
											
											output += "<td>" + first + sec_res + third_res + forth + fifth + sixth_res + seventh_res + "</td>";
                                            output += "<td style='width:150px'>";
                                            output += "<a href='<?php echo base_url(); ?>song/edit_song/" + json_obj.song_list[i].song_id + "'><button  class='btn btn-primary margin' title='View'><i class='fa fa-edit'></i></button></a>";
//                                            output += "<a href='<?php echo base_url(); ?>category/view_user/" + json_obj.category_list[i].category_id + "'><button  class='btn btn-danger' title='View'><i class='fa  fa-trash'></i></button></a>";

                                            output += "<a href='javascript:void(0);' onclick='delete_category(" + json_obj.song_list[i].song_id + ")' ><button  class='btn btn-danger margin' title='Delete'><i class='fa fa-trash'></i></button></a>";
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
                                        $("#loading").hide();
                                    } else {
                                        var output = "";
                                        output += '<tr class="odd">';
                                        output += '<td colspan="5" class="dataTables_empty"><center><h2>No matching records found</h2></center></td>';
                                        output += '</tr>';
                                        $('#page_table').html(output);
                                        var paging = "";
                                        $('#paging').html(paging);
                                        $("#loading").hide();
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return delete_cancel();">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="delete_ok();">Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>
    </form>
</div>
