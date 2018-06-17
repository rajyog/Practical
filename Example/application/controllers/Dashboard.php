<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard
 *
 * @author hp
 */
class Dashboard extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('dash_model');
    }

    public function index() {
        if (!empty($this->session->userdata('logged_in'))) {
            $data['category_total'] = $this->dash_model->total_category();
            $data['user_total'] = $this->dash_model->total_user();
            $data['truck_total'] = $this->dash_model->total_truck();
            $data['order_total'] = $this->dash_model->total_order();
            $data['item_total'] = $this->dash_model->total_item();
            $this->load->view('dashboard_view', $data);
        } else {
            $this->load->view('login');
        }
    }

}
