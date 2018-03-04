<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('AddModel');
        $this->load->model('DeleteModel');
        $this->load->model('ListModel');
        $this->load->model('UpdateModel');
        $this->load->library('form_validation');
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

    public function listControlV() {
        $data['control'] = $this->ListModel->getControls();
 
        $this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();
        $this->load->view('dashboard/list_control', $data);
        $this->dashboardFooterFiles();
    }

    public function addControl() {
        $config = array(
            array(
                'field' => 'control_name',
                'label' => 'Control Name',
                'rules' => 'required|min_length[3]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'control_url',
                'label' => 'Control URL',
                'rules' => 'required|min_length[5]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->listControlV();
        }
        else {
            $url = $this->input->post('control_url');
            $data = array(
                'control_name' => $this->input->post('control_name'),
                'control_url' => $this->input->post('control_url')
            );

            if ($this->AddModel->addData("control", $data)) {
                $this->session->set_flashdata('control_success','Control is added/updated successfully');
                $redir = base_url().'control/listcontrolv';
                redirect($redir);
            }
            else {
                $this->session->set_flashdata('control_fail','Control is not added/updated');
                $redir = base_url().'control/listcontrolv';
                redirect($redir);
            }
        }
    }

    public function updateControl() {
        $id = $this->input->post('control_id');
        $data = array (
            'control_name' => $this->input->post('control_name'),
            'control_url' => $this->input->post('control_url')
        );
        $table = "control";
        $pk = "control_id";

        if ($this->UpdateModel->updateData($table, $pk, $id, $data)) {
            $this->session->set_flashdata('control_success','Control is added/updated successfully');
            $redir = base_url().'control/listcontrolv';
            redirect($redir);
        }
        else {
            $this->session->set_flashdata('control_fail','Control is not added/updated');
            $redir = base_url().'control/listcontrolv';
            redirect($redir);
        }
    }

    public function getControl() {
        $id = $this->input->post('id');
        $data = $this->ListModel->getControl($id);
        echo json_encode($data);
    }

    public function deleteControl() {
        $id = $this->input->post('id');
        $data = array('delete_flag' => 1);
        $table = 'control';
        $pk = 'control_id';

        if ($this->DeleteModel->deleteData($table, $pk, $id, $data)) {
            $this->session->set_flashdata('control_success','Control is deleted successfully');
            echo json_encode($data);
        }
        else {
            $this->session->set_flashdata('control_fail','Control is not deleted');
            echo json_encode($data);
        }
    }
}
