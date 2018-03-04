<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller
{
    function __construct() {
        parent::__construct();

        $this->load->model('AddModel');
        $this->load->model('DeleteModel');
        $this->load->model('ListModel');
        $this->load->model('UpdateModel');
    }

    public function styleFiles() {
        $data['title'] = array('title' => 'Dashboard - NGO Application');
        $this->load->view('include/style', $data);
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

    public function listRoleV() {
        $data['role'] = $this->ListModel->getRoles();

        $this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();
        $this->load->view('dashboard/list_role', $data);
        $this->dashboardFooterFiles();
    }

    public function addRole() {
        $role_name = $this->input->post('role_name');
        $data = array('role_name' => $role_name);

        if ($this->AddModel->addData("role", $data)) {
            $this->session->set_flashdata('role_success', 'Role is added/updated successfully');
            $redir = base_url() . 'role/listrolev';
            redirect($redir);
        } else {
            $this->session->set_flashdata('role_fail', 'Role is not added/updated');
            $redir = base_url() . 'role/listrolev';
            redirect($redir);
        }
    }

    public function updateRole() {
        $id = $this->input->post('role_id');
        $data = array('role_name' => $this->input->post('role_name'));

        if ($this->UpdateModel->updateData("role", "role_id", $id, $data)) {
            $this->session->set_flashdata('role_success', 'Role is added/updated successfully');
            $redir = base_url() . 'role/listrolev';
            redirect($redir);
        } else {
            $this->session->set_flashdata('role_fail', 'Role is not added/updated');
            $redir = base_url() . 'role/listrolev';
            redirect($redir);
        }

    }

    public function getRole() {
        $data = $this->ListModel->getRole($this->input->post('id'));
        echo json_encode($data);
    }

    public function deleteRole() {
        $id = $this->input->post('id');
        $data = array('delete_flag' => 1);
        $table = 'role';
        $pk = 'role_id';

        if ($this->DeleteModel->deleteData($table, $pk, $id, $data)) {
            $this->session->set_flashdata('role_success','Role is deleted successfully');
            echo json_encode($this->DeleteModel->deleteData($table, $pk, $id, $data));
        }
        else {
            $this->session->set_flashdata('role_fail','Role is not deleted');
            echo json_encode($data);
        }
    }

    public function assignRole() {
        $data = array (
            'user_id' => $this->input->post('user_id'),
            'role_id' => $this->input->post('role_id')
        );

        $this->AddModel->addData("user_role", $data);
        echo json_encode($data);
    }
}
