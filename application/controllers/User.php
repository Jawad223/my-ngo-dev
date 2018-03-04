<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('AddModel');
        $this->load->model('DeleteModel');
        $this->load->model('ListModel');
        $this->load->model('UpdateModel');
    }

    public function styleFiles() {
        $data['title'] = array('title' => 'Dashboard - NGO Application');
        $this->load->view('include/style', $data);
    }

    public function cleanblogHeader() {
        $data['title'] = array('title' => 'Dashboard - NGO Application');
        $this->load->view('include/cleanblog_header', $data);
    }

    public function clearblogFooter() {
        $this->load->view('include/cleanblog_footer');
    }

    public function navigationFiles() {
        $this->load->view('include/navigation');
    }

    public function navbarFiles() {
        $this->load->view('dashboard/navbar');
    }

    public function sidebarFiles() {
        $this->load->view('dashboard/sidebar');
    }

    public function dashboardFooterFiles() {
        $this->load->view('dashboard/dashboard_footer');
    }

    // get those users for a role, which has not been assigned that role
    public function getUsersForRole() {
        $role_id = $this->input->post('role_id');
        $data = $this->ListModel->getUsersForRole($role_id);

        foreach ($data as $key) {
            $output = '<option value="'.$key->user_id.'">'.$key->name.'</option>';
            echo $output;
        }
    }

    public function login() {
        $this->cleanblogHeader();
        $this->navigationFiles();
        $this->load->view('login');
    }

    public function signup() {
        $this->cleanblogHeader();
        $this->navigationFiles();
        $this->load->view('signup');
        $this->clearblogFooter();
    }

    public function getUser($username) {
        $data = $this->ListModel->getUser($username);
    }

    public function addUser() {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Full Name',
                'rules' => 'required|min_length[3]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|min_length[8]|valid_email',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[5]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'password_confirm',
                'label' => 'Confirm Password',
                'rules' => 'required|min_length[5]|matches[password]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'cell',
                'label' => 'Cell #',
                'rules' => 'required|min_length[10]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'dob',
                'label' => 'Date of Birth',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'cnic',
                'label' => 'CNIC',
                'rules' => 'required|min_length[13]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->cleanblogHeader();
            $this->navigationFiles();
            $this->load->view('signup');
        }
        else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'cell' => $this->input->post('cell'),
                'address' => $this->input->post('address'),
                'pin' => $this->input->post('pin'),
                'cnic' => $this->input->post('cnic'),
                'dob' => date_format(date_create($this->input->post('dob')), "Y-m-d"),
                'gender' => $this->input->post('gender'),
                'status' => $this->input->post('status') ? '1' : '0',
                'admin' => $this->input->post('admin') ? '1' : '0'
                );

            if ($this->AddModel->addData("user", $data)) {
                $this->session->set_flashdata('signup_success', 'User created successfully');
                redirect(base_url().'user/login');
            } else {
                $this->session->set_flashdata('signup_fail', 'Error in Signup. Please validate and try again');
                redirect(base_url().'user/login');
            }
        }
    }

    public function updateUser() {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Full Name',
                'rules' => 'required|min_length[3]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[5]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'password_confirm',
                'label' => 'Confirm Password',
                'rules' => 'required|min_length[5]|matches[password]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'cell',
                'label' => 'Cell #',
                'rules' => 'required|min_length[10]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'dob',
                'label' => 'Date of Birth',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'cnic',
                'label' => 'CNIC',
                'rules' => 'required|min_length[13]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('profile_fail', validation_errors());
            redirect(base_url().'dashboard/myprofile');
        }
        else {
            $email = $this->input->post('email');
            $data = array(
                'name' => $this->input->post('name'),
                'password' => $this->input->post('password'),
                'address' => $this->input->post('address'),
                'cell' => $this->input->post('cell'),
                'dob' => date_format(date_create($this->input->post('dob')), "Y-m-d"),
                'cnic' => $this->input->post('cnic'),
                'pin' => $this->input->post('pin'),
            );

            if ($this->UpdateModel->updateData("user", "email", $email, $data)) {
                $this->session->set_flashdata('profile_success', 'User/Profile is updated successfully.');
                redirect(base_url().'dashboard/myprofile');
            }
            else {
                $this->session->set_flashdata('profile_fail', 'User/Profile is not updated');
                redirect(base_url().'dashboard/myprofile');
            }
        }
    }
}
