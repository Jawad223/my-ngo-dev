<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Measurement extends CI_Controller {

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

    public function listUnitV() {
        $data['unit'] = $this->ListModel->getUnits();
 
        $this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();
        $this->load->view('dashboard/list_unit', $data);
        $this->dashboardFooterFiles();
    }

    public function addUnit() {
        $config = array(
            array(
                'field' => 'measurement_unit',
                'label' => 'Measurement Unit',
                'rules' => 'required|min_length[3]|alpha',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->listUnitV();
        }
        else {
            $data = array(
                'measurement_unit' => $this->input->post('measurement_unit'),
            );

            if ($this->AddModel->addUnit($data)) {
                $this->session->set_flashdata('unit_success','Unit is added/updated successfully');
                $redir = base_url().'measurement/listunitv';
                redirect($redir);
            }
            else {
                $this->session->set_flashdata('unit_fail','Unit is not added/updated');
                $redir = base_url().'measurement/listunitv';
                redirect($redir);
            }
        }
    }

    public function getUnits() {
        $data = $this->ListModel->getUnits();
        echo json_encode($data);
    }

    public function getUnit() {
        $id = $this->input->post('id');
        $data = $this->ListModel->getUnit($id);
        echo json_encode($data);
    }

    public function checkUnitForCategory() {
        $id = $this->input->post('id');
        if (!$this->ListModel->checkUnitForCategory($id))
            echo json_encode(false);
    }

    public function getUnitForCategory() {
	    $id = $this->input->post('id');
	    $data = $this->ListModel->getUnitForCategory($id);
	    echo json_encode($data);
    }

    public function updateUnit() {

        $config = array(
            array(
                'field' => 'measurement_unit',
                'label' => 'Measurement Unit',
                'rules' => 'required|min_length[3]|alpha',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->listUnitV();
        }
        else {
            $id = $this->input->post('measurement_id');
            $data = array ('measurement_unit' => $this->input->post('measurement_unit'));

            if ($this->UpdateModel->updateData("measurement", "measurement_id", $id, $data)) {
                $this->session->set_flashdata('unit_success','Unit is added/updated successfully');
                $redir = base_url().'measurement/listunitv';
                redirect($redir);
            }
            else {
                $this->session->set_flashdata('unit_fail','Unit is not added/updated');
                $redir = base_url().'measurement/listunitv';
                redirect($redir);
            }
        }
	}

    public function deleteUnit() {
        $id = $this->input->post('id');
        $data = array('delete_flag' => 1);
        $table = 'measurement';
        $pk = 'measurement_id';

        if ($this->DeleteModel->deleteData($table, $pk, $id, $data)) {
            $this->session->set_flashdata('unit_success','Unit is deleted successfully');
            echo json_encode($data);
        }
        else {
            $this->session->set_flashdata('unit_fail','Unit is not deleted');
            echo json_encode($data);
        }
    }
}
