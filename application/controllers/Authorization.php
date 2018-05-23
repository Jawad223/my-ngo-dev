<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorization extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('AuthorizationModel');
        $this->load->model('ListModel');
    }

    public function checkUser() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($this->AuthorizationModel->checkUser($username, $password)) {
            $result = $this->ListModel->getUser($username);

            foreach ($result as $key) {
                $this->session->set_userdata('login_user', $key->email);
                $this->session->set_userdata('password', $key->password);
                $this->session->set_userdata('username', $key->name);
                $this->session->set_userdata('created_at', $key->created_at);
                $this->session->set_userdata('user_id', $key->user_id);
                $this->session->set_userdata('role', $key->role_name);
            }

            $myroles = $this->ListModel->getMyRoles($this->session->userdata('login_user'));
            foreach ($myroles as $key) {
                $control[] = $key->ControlName;
                $this->session->set_userdata('control', $control);
            }

            $userURL = $this->ListModel->getRoleURL($this->session->userdata('user_id'));
            foreach ($userURL as $key) {
                $userURL[] = $key->ControlURL;
                $this->session->set_userdata('userURL', $userURL);
            }

            $this->session->set_flashdata('login_success',' Welcome');
            redirect(base_url().'dashboard/userdashboard', 'refresh');
        }
        else {
            $this->session->set_flashdata('login_error',' Invalid username/password');
            redirect(base_url().'user/login','refresh');
        }
    }

    public function logout() {
        $this->session->unset_userdata('login_user');
        $this->session->unset_userdata('password');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('registration_date');
        $this->session->unset_userdata('control');
        $this->session->unset_userdata('userURL');
        $this->session->unset_userdata('user_id');
        $this->session->set_flashdata('logout',' Logged out successfully');
        $redir = base_url().'user/login';
        redirect($redir,'refresh');
    }

}