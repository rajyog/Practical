<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Promocode
 *
 * @author hp
 */
class Promocode extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('promocode_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        if (!empty($this->session->userdata('logged_in'))) {
            $data['category'] = $this->promocode_model->get_all_category();
            $data['truck'] = $this->promocode_model->get_all_truck();
            $data['user'] = $this->promocode_model->get_all_user();
            $this->load->view('add_promocode_list_view', $data);
//            $this->load->view('add_promocode');
        } else {
            $this->load->view('login');
        }
    }

    public function add_promocode() {
        $promocode_name = $this->input->post('promocode_name');
        $promocode_code = $this->input->post('promocode_code');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $start_t = $this->input->post('start_time');
        $end_t = $this->input->post('end_time');

        $start_time = DATE("H:i", STRTOTIME($start_t));
        $end_time = DATE("H:i", STRTOTIME($end_t));

        $start_date_time = $start_date . '' . $start_time;
        $end_date_time = $end_date . '' . $end_time;

        $truck_name = $this->input->post('truck_name');
        $category_name = $this->input->post('category_name');
        $promocode_type = $this->input->post('promocode_type');
        $promocode_amount = $this->input->post('promocode_amount');
        $promocode_assign = $this->input->post('promocode_assign');
        $promocode_discount = $this->input->post('promocode_discount');
        $promocode_access = $this->input->post('promocode_access');
        $promocode_no_of_use = $this->input->post('promocode_no_of_use');

        if (!empty($start_date)) {
            $start_date = date("Y-m-d H:i:s", strtotime($start_date_time));
        }
        if (!empty($end_date)) {
            $end_date = date("Y-m-d H:i:s", strtotime($end_date_time));
        }

        $access = implode(",", $promocode_access);

        //echo implode(" ", $arr);
//        print_r($promocode_access);
//        die;

        $result = $this->promocode_model->check_promocode_code($promocode_code);
        if (!empty($result)) {
            echo 3;
        } else {
            $promocode_created = date('Y-m-d H:i:s');
            $promocode_status = "local";
            $data = array('promocode_category' => $category_name, 'promocode_truck' => $truck_name, 'promocode_type' => $promocode_type, 'promocode_minimum_amount' => $promocode_amount, 'promocode_assign' => $promocode_assign, 'promocode_discount' => $promocode_discount, 'promocode_name' => $promocode_name, 'promocode_code' => $promocode_code, 'promocode_start_time' => $start_date, 'promocode_end_time' => $end_date, 'promocode_access' => $access, 'no_of_use' => $promocode_no_of_use, 'promoced_status' => $promocode_status, 'promocode_created' => $promocode_created);
            $insert = $this->promocode_model->insert_data($data);

            if ($insert == true) {
                echo 0;
            } else {
                echo 1;
            }
        }
    }

    public function list_promocode() {
        $limit = 10;
        $page = $this->input->post('pagee');
        $promocode_name = $this->input->post('promocode_name');
        $category_id = $this->input->post('category_id');
        $truck_id = $this->input->post('truck_id');

        $sort_type = $this->input->post('sort_type');
        $sort_field = $this->input->post('sort_field');

        $total_records = count($this->promocode_model->get_promocode_list($promocode_name, $category_id, $truck_id));
        $total_pages = ceil($total_records / $limit);

        if (($page != 0) || $page != '') {
            $page = $page;
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $limit;
        $data['promocode_list'] = $this->promocode_model->get_promocode($promocode_name, $category_id, $truck_id, $sort_type, $sort_field, $limit, $start_from);
        $data['total_pages'] = $total_pages;
        echo json_encode($data);
    }

    public function edit_promocode($promocode_id) {
        if (!empty($this->session->userdata('logged_in'))) {
            $data['edit_data'] = $this->promocode_model->get_promocode_detail($promocode_id);
            $promocode_category = $data['edit_data']['promocode_category'];
            $promocode_truck = $data['edit_data']['promocode_truck'];

            if ($promocode_category != '0') {
                $promocode_category = $this->promocode_model->get_promocode_category($promocode_category);
                $data['edit_data']['category_name'] = $promocode_category['category_name'];
            }

            if ($promocode_truck != '0') {
                $promocode_truck = $this->promocode_model->get_promocode_truck($promocode_truck);
                $data['edit_data']['truck_name'] = $promocode_truck['truck_name'];
            }

            $data['category'] = $this->promocode_model->get_all_category();
            $data['truck'] = $this->promocode_model->get_all_truck();
            $data['user'] = $this->promocode_model->get_all_user();
            $this->load->view('add_promocode', $data);
        } else {
            $this->load->view('login');
        }
    }

    public function delete_promocode() {

        $promocode_id = $this->input->post('promocode_id');
        $promocode_status = $this->input->post('promocode_status');
        if ($promocode_status == 'local') {
            $result = $this->promocode_model->delete_promocode($promocode_id);
        } else {
            $result = $this->promocode_model->enable_promocode($promocode_id);
        }
    }

    public function edit_promocode_data() {
        $promocode_id = $this->input->post('promocode_id');
        $promocode_name = $this->input->post('promocode_name');
        $promocode_code = $this->input->post('promocode_code');
        
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $start_t = $this->input->post('start_time');
        $end_t = $this->input->post('end_time');

        $start_time = DATE("H:i", STRTOTIME($start_t));
        $end_time = DATE("H:i", STRTOTIME($end_t));

        $start_date_time = $start_date . '' . $start_time;
        $end_date_time = $end_date . '' . $end_time;
        
        
        $truck_name = $this->input->post('truck_name');
        $category_name = $this->input->post('category_name');
        $promocode_type = $this->input->post('promocode_type');
        if ($promocode_type == '2') {
            $promocode_amount = $this->input->post('promocode_amount');
        } else {
            $promocode_amount = "0";
        }
        $promocode_assign = $this->input->post('promocode_assign');
        $promocode_discount = $this->input->post('promocode_discount');
        $promocode_access = $this->input->post('promocode_access');
        $promocode_no_of_use = $this->input->post('promocode_no_of_use');
        $access = implode(",", $promocode_access);
        if (!empty($start_date)) {
            $start_date = date("Y-m-d H:i:s", strtotime($start_date_time));
        }
        if (!empty($end_date)) {
            $end_date = date("Y-m-d H:i:s", strtotime($end_date_time));
        }

        $this->promocode_model->edit_promocode_data($promocode_id, $truck_name, $category_name, $promocode_type, $promocode_amount, $promocode_assign, $promocode_discount, $promocode_name, $promocode_code, $start_date, $end_date, $access, $promocode_no_of_use);
        echo 0;
    }

    public function request_live_promocode() {
        $promocode_id = $this->input->post('promocode_id');
        $status = "live";
        $this->promocode_model->edit_promocode_approval($promocode_id, $status);
    }

    public function view_promocode($promocode_id) {

        if (!empty($this->session->userdata('logged_in'))) {
            $promocode_detail = $this->promocode_model->promocode_detail($promocode_id);
            $data['view_data'] = $promocode_detail;
            $promocode_code = $promocode_detail['promocode_code'];
            $order_detail = $this->promocode_model->promocode_order_detail($promocode_code);

            for ($i = 0; $i < count($order_detail); $i++) {
                $item_image_data = array();
                $item_image_data = $this->promocode_model->get_item_image($order_detail[$i]['item_id']);
                $order_detail[$i]['item_image'] = $item_image_data['item_image'];
            }

            $get_order_code = $this->promocode_model->get_procode_order_list($promocode_code);
            $get_order_detail = array();
            for ($i = 0; $i < count($get_order_code); $i++) {
                $get_order_detail[] = $this->promocode_model->get_order_details_on_code($get_order_code[$i]['order_code']);
            }
            $data['view_data']['get_order_detail'] = $get_order_detail;

//            echo "<pre>";
//            print_r($get_order_detail);
//            die;

            $data['view_data']['order_detail'] = $order_detail;

            $this->load->view('promocode_details_view', $data);
        } else {
            $this->load->view('login');
        }
    }

}
