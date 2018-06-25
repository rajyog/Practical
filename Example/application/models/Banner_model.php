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
class Banner_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_banner_list($banner_name) {
        $sql = "SELECT * FROM tbl_banner";

        $bn = '';
        if ($banner_name != '') {
            $bn.=" WHERE banner_title LIKE '%" . $banner_name . "%' ";
        }
        if (!empty($bn)) {
            $sql = $sql . $bn;
        }

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_banner($banner_name, $sort_type, $sort_field, $limit, $start_from) {

        $sql = "SELECT * FROM tbl_banner";
        $bn = '';
        if ($banner_name != '') {
            $bn.=" WHERE banner_title LIKE '%" . $banner_name . "%' ";
        }
        if (!empty($bn)) {
            $sql = $sql . $bn;
        }

        $orderby = '';

        if (!empty($sort_type) && !empty($sort_field)) {
            $orderby.=" ORDER BY $sort_field $sort_type";
        }

        if (!empty($orderby)) {
            $sql = $sql . $orderby;
        } else {
            $sql = $sql . " ORDER BY banner_id DESC";
        }

        $sql = $sql . " limit $start_from,$limit ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function check_banner_name($banner_name) {
        $sql = ("select * from tbl_banner where  banner_title = '" . $banner_name . "' limit 1");
        $query = $this->db->query($sql);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function insert_data($data) {
        $sql = $this->db->insert('tbl_banner', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_banner_info($banner_id) {
        $this->db->select('*');
        $this->db->where('banner_id', $banner_id);
        $this->db->from('tbl_banner');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_banner_detail($banner_id) {
        $this->db->select('*');
        $this->db->where('banner_id', $banner_id);
        $this->db->from('tbl_banner');
        return $query = $this->db->get();
    }

    function edit_banner_data($banner_id, $data) {
        $this->session->set_userdata('update_msg','<font color="green"<h4><i> Story data update Successfull  </i></h4></font>');
        $this->db->where('banner_id', $banner_id);
        $this->db->update('tbl_banner', $data);
    }

    function update_banner_limit($banner_limit) {
//        $sql = "UPDATE tbl_banner set banner_limit='$banner_limit' , banner_set='0'";
        $sql = "UPDATE tbl_banner set banner_limit='$banner_limit'";
        $query = $this->db->query($sql);
    }

    function delete_banner($banner_id) {
        $this->db->where('banner_id', $banner_id);
        $this->db->delete('tbl_banner');
    }

    function banner_set_status($banner_id) {
        $sql = "SELECT * FROM tbl_banner WHERE banner_id= '$banner_id '";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    function total_set_banner() {
        $sql = "SELECT * FROM tbl_banner WHERE banner_set= '1'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function edit_set_status($banner_id, $set) {
        $sql = "UPDATE tbl_banner set banner_set='$set' where banner_id= '$banner_id'";
        $this->db->query($sql);
    }

    function count_chk_banner() {
        $sql = "SELECT * FROM tbl_banner WHERE banner_set='1'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
