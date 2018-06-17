<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author hp
 */
class Login extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('encrypt');
    }

    public function index() {
        $this->load->view('login');
    }

    public function login_process() {

        $session_set_value = $this->session->all_userdata();

        $email = $this->input->post('username');
        $password = $this->input->post('password');


        if (empty($email) || empty($password)) {
            $data = array(
                'error_message' => 'Both field are required.'
            );
            $this->load->view('login', $data);
        } else {
            $result = $this->login_model->find_password($email);


            if ($result != false) {
                $get_admin_id = $result['admin_id'];
                $get_email = $result['email'];
                $get_password = $result['password'];

                $pass = $this->encrypt->decode($get_password);
//
                if ($password == $pass) {
//
                    $sess_data = array(
                        'admin_id' => $get_admin_id,
                        'email' => $get_email,
                        'password' => $pass
                    );
                    $this->session->set_userdata('logged_in', $sess_data);
                    // echo json_encode(array('status' => 1, 'message' => 'valid'));
                    echo 1;
                } else {
                    // echo json_encode(array('status' => 0, 'message' => 'Invalid Password Please try again.'));
                    echo 0;
                }
            } else {
                //echo json_encode(array('status' => 2, 'message' => 'Your Email Id invalid Please try again. '));
                echo 2;
            }
        }
    }

    public function change_password_view() {
        if (!empty($this->session->userdata('logged_in'))) {
            $this->load->view('change_password');
        } else {
            $this->load->view('login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('login');
        $this->load->view('login');
    }

    public function change_password() {
        
        $email = $this->input->post('email');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        if ($new_password == $confirm_password) {
            $result = $this->login_model->get_password($email);
//            $pass = $result['password'];
            $pass = $this->encrypt->decode($result['password']);

            if ($pass == $old_password) {

                if ($pass == $new_password) {
//                    echo json_encode(array('status' => 2, 'message' => 'Your Old Password Not Set as New Password'));
                    echo 2;
                } else {
                    $new_encrypt_password = $this->encrypt->encode($new_password);
                    $result_update = $this->login_model->edit_password($new_encrypt_password, $email);
                    if ($result_update == 0) {
                        //echo json_encode(array('status' => 0, 'message' => 'Password Sucessfully Change'));
                        echo 0;
                    }
                    if ($result_update == 1) {
//                        echo json_encode(array('status' => 1, 'message' => 'Server Authentication Failed Please Try Again'));
                        echo 1;
                    }
                }
            } else {
//                echo json_encode(array('status' => 3, 'message' => 'Your Old Password Worng'));
                    echo 3;
            }
        } else {
//            echo json_encode(array('status' => 4, 'message' => 'Your Password And Confirm Password Not Same'));
            echo 4;
        }
    }

}
