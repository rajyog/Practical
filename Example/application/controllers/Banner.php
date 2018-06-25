<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Banner
 *
 * @author Yogesh
 */
class Banner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/banner_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {

        if (!empty($this->session->userdata('logged_in'))) {
            $this->load->view('admin/add_banner_list_view');
        } else {
            $this->load->view('admin/login');
        }
    }

    public function banner_list() {
        $banner_name = $this->input->post('banner_name');
        $sort_type = $this->input->post('sort_type');
        $sort_field = $this->input->post('sort_field');
        $limit = 10;
        $page = $this->input->post('pagee');
        $total_records = count($this->banner_model->get_banner_list($banner_name));
        $total_pages = ceil($total_records / $limit);

        if (($page != 0) || $page != '') {
            $page = $page;
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $limit;
        $data['banner_data'] = $this->banner_model->get_banner($banner_name, $sort_type, $sort_field, $limit, $start_from);
        $data['total_pages'] = $total_pages;
        echo json_encode($data);
    }

    public function add_banner() {
        $banner_name = $this->input->post('banner_name');
        $data = $this->banner_model->check_banner_name($banner_name);
        if (!empty($data)) {
            echo 3;
        } else {
            $path = '';
            if (!empty($_FILES["banner_image"]["name"])) {
                $folder_name = "banner";
                $type = "banner_image";
                $image_name = $_FILES["banner_image"]["name"];
                $tmp_name = $_FILES["banner_image"]["tmp_name"];
                $path = $this->image_upload($image_name, $tmp_name, $folder_name, $type);
            }
            if (!empty($path)) {
                $banner_created = date('Y-m-d H:i:s', time());

                $data = array('banner_title' => $this->input->post('banner_name'), 'banner_image' => $path, 'banner_set' => '0', 'banner_created' => $banner_created);

                $insert = $this->banner_model->insert_data($data);

                if ($insert == true) {
                    echo 0;
                } else {
                    echo 1;
                }
            }
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

    public function edit_banner($banner_id) {
        if (!empty($this->session->userdata('logged_in'))) {
            $data['edit_data'] = $this->banner_model->get_banner_info($banner_id);
            $this->load->view('admin/edit_banner_view', $data);
        } else {
            $this->load->view('admin/login');
        }
    }

    public function edit_banner_data() {

        $banner_id = $this->input->post('banner_id');

        $res = $this->banner_model->get_banner_detail($banner_id)->row_array();

        $folder_name = "banner";
        $type = "banner_image";
        $image_name = $_FILES["banner_image"]["name"];
        $tmp_name = $_FILES["banner_image"]["tmp_name"];
        //$path = $this->image_upload($image_name, $tmp_name, $folder_name, $type);

        if (!empty($image_name)) {

            $image_path = 'uploads/banner/';
            $filename = $image_path . $res['banner_image'];
            if (file_exists($filename))
                unlink($filename);

            $path = $this->image_upload($image_name, $tmp_name, $folder_name, $type);

            $data = array('banner_title' => $this->input->post('banner_name'), 'banner_image' => $path);

            $this->banner_model->edit_banner_data($banner_id, $data);
            echo 0;
        } else {

            $data = array('banner_title' => $this->input->post('banner_name'));
            $this->banner_model->edit_banner_data($banner_id, $data);
            echo 0;
        }
    }

    public function delete_banner() {
        $banner_id = $this->input->post('banner_id');

        $res = $this->banner_model->get_banner_detail($banner_id)->row_array();
        $image_path = 'uploads/banner/';
        $filename = $image_path . $res['banner_image'];
        if (file_exists($filename)) {
            unlink($filename);
        }
        $this->banner_model->delete_banner($banner_id);
    }

    public function set_banner_status() {
        $banner_id = $this->input->post('banner_id');
        $set_status = $this->banner_model->banner_set_status($banner_id);
        $set = $set_status['banner_set'];
        if ($set == '0') {
            $set = '1';
        }
//        else {
//            $set = '0';
//        }
        $this->banner_model->edit_set_status($banner_id, $set);
    }

    public function update_set_banner_status() {
        $banner_id = $this->input->post('banner_id');
        $set_status = $this->banner_model->banner_set_status($banner_id);
        $set = $set_status['banner_set'];
        if ($set == '0') {
            $set = '1';
            $this->banner_model->edit_set_status($banner_id, $set);
            echo 0;
        }
//        if ($set == '1') {
//            $set = '0';
//            $this->banner_model->edit_set_status($banner_id, $set);
//        }
    }

    public function update_unset_banner_status() {
        $banner_id = $this->input->post('banner_id');
        $set_status = $this->banner_model->banner_set_status($banner_id);
        $set = $set_status['banner_set'];
        if ($set == '1') {
            $set = '0';
            $this->banner_model->edit_set_status($banner_id, $set);
        }
    }

    public function update_banner_limit() {
        $total = count($this->banner_model->total_set_banner());
        $banner_limit = $this->input->post('banner_limit');
        if ($banner_limit < $total) {
            echo 1;
        } else {
            $this->banner_model->update_banner_limit($banner_limit);
            echo 0;
        }
    }

    public function chk_count_banner_limit() {
        $chk_limit = count($this->banner_model->count_chk_banner());
        $data['total_check'] = $chk_limit;
        echo json_encode($data);
    }

}
