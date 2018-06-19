<?php

class Song extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('song_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        if (!empty($this->session->userdata('logged_in'))) {
            $data['category'] = $this->song_model->get_all_category();
            $data['subcategory'] = $this->song_model->get_all_sub_category();
	    $data['notes'] = $this->song_model->get_all_note();
            $this->load->view('song_list_view', $data);
        } else {
            $this->load->view('login');
        }
    }
	
    public function add_song() {

        $song_name = $this->input->post('song_name');
        $category_id = $this->input->post('category_name');
        $sub_category_id = $this->input->post('sub_category_id');
        $artist_name = $this->input->post('artist_name');
		$bpm = $this->input->post('bpm');
		$note_id = $this->input->post('note');

        $path = '';
        if (!empty($_FILES["songfile"]["name"])) {
            $folder_name = "uploads";
            $type = "music_audio";
            $image_name = $_FILES["songfile"]["name"];
            $tmp_name = $_FILES["songfile"]["tmp_name"];
            $path = $this->image_upload($image_name, $tmp_name, $folder_name, $type);
        }
        $data = array('category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'song_name' => $song_name, 'artist_name' => $artist_name, 'song_link' => $path, 'bpm' => $bpm, 'note_id' => $note_id);
        $insert = $this->song_model->insert_data($data);

        if ($insert == true) {
            echo 0;
        } else {
            echo 1;
        }
    }

    function image_upload($image_name, $tmp_name, $folder_name, $type) {

        $main_dir = "uploads";
        $tmp_arr = explode(".", $image_name);
        $img_extn = end($tmp_arr);
        $new_image_name = $type . '_' . uniqid() . '_' . date("YmdHis") . '.' . $img_extn;
        $flag = 0;

        if (!file_exists('../' . $main_dir)) {
            @mkdir($main_dir, 0777, true);
            if (!file_exists('../' . $main_dir . '/' . $folder_name)) {
                @mkdir($main_dir . '/' . $folder_name, 0777, true);
            }
        } elseif (!file_exists($main_dir . '/' . $folder_name)) {
            @mkdir($main_dir . '/' . $folder_name, 0777, true);
        }
        if (file_exists($main_dir . '/' . $folder_name . '/' . $new_image_name)) {
            return true;
        } else {
            move_uploaded_file($tmp_name, $main_dir . "/" . $folder_name . "/" . $new_image_name);
            $flag = 1;
            return $new_image_name;
        }
    }

    public function edit_song_data() {
        $song_id = $this->input->post('song_id');
        $song_name = $this->input->post('song_name');
        $category_id = $this->input->post('category_name');
        $sub_category_id = $this->input->post('sub_category_id');
        $artist_name = $this->input->post('artist_name');
		$note_id = $this->input->post('note');
        $bpm = $this->input->post('bpm');

        $folder_name = "uploads";
        $type = "music_audio";
        $image_name = $_FILES["songfile"]["name"];
        $tmp_name = $_FILES["songfile"]["tmp_name"];

        $res = $this->song_model->song_detail($song_id);


        if (!empty($image_name)) {

            $image_path = 'uploads/uploads/';
            $filename = $image_path . $res['song_link'];

            if (file_exists($filename)) {
                unlink($filename);
            }
            $path = $this->image_upload($image_name, $tmp_name, $folder_name, $type);
            $this->song_model->edit_song_with_data($song_id, $song_name, $category_id, $sub_category_id, $artist_name, $path, $note_id, $bpm);
            echo 0;
        } else {
            $this->song_model->edit_song_data($song_id, $song_name, $category_id, $sub_category_id, $artist_name, $note_id, $bpm);
            echo 0;
        }
    }


}
