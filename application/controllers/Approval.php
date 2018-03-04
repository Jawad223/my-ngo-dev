<?php

class Approval extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AddModel');
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

    public function manageApproval() {
        $this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();

        $data['donation'] = $this->ListModel->getDonations();
        $data['reception'] = $this->ListModel->getReceptions();
        $data['approval_history'] = $this->ListModel->getApprovalHistory();

        $this->load->view('dashboard/approval', $data);
        $this->dashboardFooterFiles();
    }

    public function approveDonation($id, $choice) {
        $id = $this->input->post('id');
        $data = array(
            'status_id' => $this->input->post('choice'),
        );
        $table = 'request';
        $pk1 = 'request_id';
        $pk2 = '1';

        if ($this->UpdateModel->approveData($table, $pk1, $pk2, $id, $data)) {
            $approver_data = array(
                'request_id' => $id,
                'user_id' => $this->session->userdata('user_id'),
                'approval_date' => date("Y-m-d"),
                'approval_type' => '1',
            );
            $this->AddModel->addData("request_approval", $approver_data);
            $this->session->set_flashdata('approve_success', 'Approved successfully');
        }
        else
            $this->session->set_flashdata('approve_fail', 'Did not approved');
        echo json_encode($id.'-'.$choice);
    }

    public function approveReception($id, $choice) {
        $id = $this->input->post('id');
        $data = array(
            'status_id' => $this->input->post('choice'),
        );
        $table = 'request';
        $pk1 = 'request_id';
        $pk2 = '2';

        if ($this->UpdateModel->approveData($table, $pk1, $pk2, $id, $data)) {
            $approver_data = array(
                'request_id' => $id,
                'user_id' => $this->session->userdata('user_id'),
                'approval_date' => date("Y-m-d"),
                'approval_type' => '2',
            );

            $this->AddModel->addData("request_approval", $approver_data);
            $this->session->set_flashdata('approve_success', 'Approved successfully');
        }
        else
            $this->session->set_flashdata('approve_fail', 'Did not approved');
        echo json_encode($id.'-'.$choice);
    }

}