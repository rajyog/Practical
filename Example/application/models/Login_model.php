<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_model
 *
 * @author hp
 */
class Login_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function find_password($email) {
        $sql = ("select * from tbl_admin where  email = '" . $email . "' limit 1");
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function get_password($email) {
        $sql = ("select * from tbl_admin where  email = '" . $email . "' limit 1");
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function check_login_user_data($email, $password) {
//echo $email.$password;
        $sql = ("select * from tbl_admin where  email = '" . $email . "' AND password='" . $password . "' limit 1");
//echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            //print_r($query->row_array());
            return $query->row_array();
        } else {
            return false;
        }
    }

    function edit_admin_data($new_password, $old_password) {
        $sql = "UPDATE tbl_admin set password='$new_password' where password= '$old_password'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return '0';
        } else {
            return '2';
        }
    }

    function edit_password($new_encrypt_password, $email) {
        $sql = "UPDATE tbl_admin set password='$new_encrypt_password' where email= '$email'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return '0';
        } else {
            return '1';
        }
    }

}
