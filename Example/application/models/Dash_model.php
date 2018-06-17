<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dash_model
 *
 * @author hp
 */
class Dash_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function total_category() {
        $sql = ("select count(*) as total_category from tbl_category");
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function total_user() {
        $sql = ("select count(*) as total_user from tbl_user");
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function total_truck() {
        $sql = ("select count(*) as total_truck from tbl_truck");
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function total_order() {
        $sql = ("select count(DISTINCT order_code) as total_order from tbl_order");
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function total_item() {
        $sql = ("select count(*) as total_item from tbl_item");
        $query = $this->db->query($sql);
        return $query->row_array();
    }

}
