<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Reception extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('AddModel');
        $this->load->model('ListModel');
        $this->load->model('UpdateModel');

        $this->load->library('form_validation');
	}

	public function styleFiles() {
		$data['title'] = array('title' => 'Receive - NGO Application');
		$this->load->view('include/style', $data);
	}

	public function navbarFiles() {
		$this->load->view('dashboard/navbar');
	}

	public function sidebarFiles() {
		$this->load->view('dashboard/sidebar');
	}

	public function footerFiles() {
		$this->load->view('dashboard/dashboard_footer');
	}

	public function receivev() {
		$id = $this->session->userdata('user_id');
		$data['category'] = $this->ListModel->getParentCategories();
		$data['unit'] = $this->ListModel->getUnits();

		if ($this->session->userdata('role') == 'admin') {
			$data['reception'] = $this->ListModel->getReceptions();
		}
		else {
			$data['reception'] = $this->ListModel->getReception($id);
		}
		$this->styleFiles();
		$this->navbarFiles();
		$this->sidebarFiles();
		$this->load->view('reception', $data);
		$this->footerFiles();
	}

	public function addReception() {
        $config = array(
            array(
                'field' => 'subject',
                'label' => 'Subject',
                'rules' => 'required|min_length[3]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'category',
                'label' => 'Category',
                'rules' => 'required|min_length[1]',
                'errors' => array(
                    'required' => 'You must select a %s.',
                ),
            ),
            array(
                'field' => 'measurement_id',
                'label' => 'Measurement Unit',
                'rules' => 'required|min_length[1]',
                'errors' => array(
                    'required' => 'You must select a %s.',
                ),
            ),
            array(
                'field' => 'quantity',
                'label' => 'Requesting Quantity',
                'rules' => 'required|min_length[1]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'reference_id',
                'label' => 'Receive As',
                'rules' => 'required|min_length[1]',
                'errors' => array(
                    'required' => 'You must mention the %s person.',
                ),
            ),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->receivev();
        }
        else {
            $data = array (
                'user_id' => $this->input->post('id'),
                'subject' => $this->input->post('subject'),
                'description' => $this->input->post('description'),
                'quantity' => $this->input->post('quantity'),
                'reference_id' => $this->input->post('reference_id'),
                'category_id' => $this->input->post('category'),
                'measurement_id' => $this->input->post('measurement_id'),
                'type_id' => 2,
                'status_id' => 3,
            );
            $notification = array(
                'subject' => $this->input->post('subject'),
                'description' => $this->input->post('description'),
                'viewed' => '0',
                'user_id' => $this->input->post('id'),
            );

            if ($this->AddModel->addData("request", $data)) {
                $this->AddModel->addData("notification", $notification);

                $this->session->set_flashdata('reception_success','Applied successfully');
                $redir = base_url().'reception/receivev';
                redirect($redir);
            }
        }
	}
}
