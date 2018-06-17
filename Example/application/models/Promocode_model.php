<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Promocode_model
 *
 * @author hp
 */
class Promocode_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get_all_category() {
        $sql = "select * from tbl_category";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function insert_data($data) {
        $sql = $this->db->insert('tbl_promocode', $data);
//        $s = $this->db->last_query();
//        echo $s;
//        die;
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_promocode_code($promocode_code) {
        $sql = ("select * from tbl_promocode where promocode_code = '" . $promocode_code . "' limit 1");
        $query = $this->db->query($sql);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function get_promocode_list($promocode_name, $category_id, $truck_id) {

        $sql = "select * from tbl_promocode where promocode_enabled='1'";

        $pn = '';
        if ($promocode_name != '') {
            $pn.=" AND promocode_name LIKE '%" . $promocode_name . "%'";
        }
        if (!empty($pn)) {
            $sql = $sql . $pn;
        }

        $cid = '';
        if ($category_id != '') {
            $cid.=" AND promocode_category = '" . $category_id . "'";
        }
        if (!empty($cid)) {
            $sql = $sql . $cid;
        }

        $tid = '';
        if ($truck_id != '') {
            $tid.=" AND promocode_truck = '" . $truck_id . "'";
        }
        if (!empty($tid)) {
            $sql = $sql . $tid;
        }

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_promocode($promocode_name, $category_id, $truck_id, $sort_type, $sort_field, $limit, $start_from) {

        $sql = "SELECT * FROM tbl_promocode where promocode_enabled='1'";

        $pn = '';
        if ($promocode_name != '') {
            $pn.=" AND promocode_name LIKE '%" . $promocode_name . "%'";
        }
        if (!empty($pn)) {
            $sql = $sql . $pn;
        }

        $cid = '';
        if ($category_id != '') {
            $cid.=" AND promocode_category = '" . $category_id . "'";
        }
        if (!empty($cid)) {
            $sql = $sql . $cid;
        }

        $tid = '';
        if ($truck_id != '') {
            $tid.=" AND promocode_truck = '" . $truck_id . "'";
        }
        if (!empty($tid)) {
            $sql = $sql . $tid;
        }

        $orderby = '';
        if (!empty($sort_type) && !empty($sort_field)) {
            $orderby.=" ORDER BY $sort_field $sort_type";
        }

        if (!empty($orderby)) {
            $sql = $sql . $orderby;
        } else {
            $sql = $sql . " ORDER BY promocode_id DESC";
        }
        $sql = $sql . " limit $start_from,$limit ";
//        echo $sql;
//        die;

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_promocode_detail($promocode_id) {
        $sql = ("select * from tbl_promocode where promocode_id='" . $promocode_id . "' ");
        //$sql = ("select P.*,T.truck_username,C.category_name from tbl_promocode AS P JOIN tbl_truck AS T ON T.truck_id = P.promocode_truck JOIN tbl_category AS C ON C.category_id=P.promocode_category where promocode_id='" . $promocode_id . "' ");
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function delete_promocode($promocode_id) {
        $this->db->where('promocode_id', $promocode_id);
        $this->db->delete('tbl_promocode');
    }

    function enable_promocode($promocode_id) {
        $sql = "UPDATE tbl_promocode SET promocode_enabled='2' WHERE promocode_id='$promocode_id'";
        $this->db->query($sql);
    }

    function edit_promocode_data($promocode_id, $truck_name, $category_name, $promocode_type,$promocode_amount, $promocode_assign, $promocode_discount, $promocode_name, $promocode_code, $start_date, $end_date, $access, $promocode_no_of_use) {
        $sql = "UPDATE tbl_promocode SET promocode_category='$category_name', promocode_truck='$truck_name', promocode_type='$promocode_type', 	promocode_minimum_amount='$promocode_amount',promocode_assign='$promocode_assign',promocode_discount='$promocode_discount', promocode_name='$promocode_name', promocode_code='$promocode_code',promocode_start_time='$start_date', promocode_end_time='$end_date',promocode_access='$access',no_of_use='$promocode_no_of_use' WHERE promocode_id='$promocode_id'";
//        echo $sql;
//        die;
        $this->db->query($sql);
    }

    function get_all_truck() {
        $sql = "select truck_id,truck_username,truck_name from tbl_truck";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_all_user() {
        $sql = "select user_id,user_username from tbl_user order by user_username asc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function edit_promocode_approval($promocode_id, $status) {
        $sql = "UPDATE tbl_promocode set promoced_status='$status' where promocode_id= '$promocode_id'";
        $this->db->query($sql);
    }

    function promocode_detail($promocode_id) {
        $sql = "SELECT *,(SELECT category_name FROM tbl_category WHERE category_id = promocode_category) as category,(SELECT truck_name FROM tbl_truck WHERE truck_id = promocode_truck) as truck FROM tbl_promocode WHERE promocode_id ='" . $promocode_id . "'";
//        $sql = "SELECT * FROM tbl_withdraw_request AS W JOIN tbl_bank AS B ON W.bank_id = B.bank_id WHERE W.wr_id ='" . $wr_id . "'";
//        echo $sql;
//        die;
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function get_promocode_category($promocode_category) {
        $sql = "SELECT category_name FROM tbl_category WHERE category_id = '" . $promocode_category . "'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    function get_promocode_truck($promocode_truck) {
        $sql = "SELECT truck_name FROM tbl_truck WHERE truck_id = '" . $promocode_truck . "'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function promocode_order_detail($promocode_code) {
        $sql = "SELECT *,I.item_title FROM tbl_promocode_access AS PA JOIN tbl_order AS O ON O.order_code=PA.promocode_access_order_code JOIN tbl_item as I ON I.item_id = O.item_id WHERE promocode_access_code='$promocode_code'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_item_image($item_id) {
        $this->db->select('*');
        $this->db->from('tbl_item_images');
        $this->db->where('item_id', $item_id);
        $this->db->limit('1');
        $query = $this->db->get();
        return $query->row_array();
    }
    
    function get_procode_order_list($promocode_code) {
        $sql = "SELECT DISTINCT(promocode_access_order_code) AS order_code FROM tbl_promocode_access WHERE promocode_access_code='$promocode_code' ORDER BY promocode_access_id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function get_order_details_on_code($order_code) {
        $sql = "SELECT D.diducat_amount,U.user_firstname,U.user_lastname,U.user_image, O.is_preorder,O.order_created,O.order_date,O.proposed_time,SUM(quantity) AS quantity,SUM(grand_total) AS grand_total FROM tbl_order AS O JOIN tbl_user AS U ON U.user_id = O.user_id JOIN tbl_discount AS D ON D.order_code = O.order_code WHERE O.order_code ='$order_code'";
//        echo $sql;
//        die;
        $query = $this->db->query($sql);
        return $query->row_array();
    }

}
