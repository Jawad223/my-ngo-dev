<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Reference extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('AddModel');
        $this->load->model('ListModel');
        $this->load->library('form_validation');
	}

	public function styleFiles() {
		$data['title'] = array('title' => 'Reference - NGO Application');
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

	public function listuserreferencev() {
		$user_id = $this->session->userdata('user_id');
		
		if ($user_id == 1) {
			$data['references'] = $this->ListModel->getReferences();
		}
		else
			$data['references'] = $this->ListModel->getReference($user_id);

		$this->styleFiles();
		$this->navbarFiles();
		$this->sidebarFiles();
		$this->load->view('dashboard/reference', $data);
		$this->footerFiles();
	}

	public function addReference() {
	    $config = array(
	        array(
	            'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|min_length[3]',
                'errors' => array(
                    'required' => 'You must provide the %s'
                ),
            ),
            array(
                'field' => 'cell',
                'label' => 'Cell',
                'rules' => 'required|min_length[10]|max_length[13]|numeric',
                'errors' => array(
                    'required' => 'You must provide the %s'
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|min_length[8]|valid_email',
                'errors' => array(
                    'required' => 'You must provide the %s'
                ),
            ),
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->listuserreferencev();
        }
        else {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'cell' => $this->input->post('cell'),
            );

            if ($this->AddModel->addReference($data)) {
                $this->session->set_flashdata('add_reference_success','Reference added/updated successfully');
                $redir = base_url().'reference/listuserreferencev';
                redirect($redir);
            }
        }
	}

	public function getReference() {
		$id = $this->session->userdata('user_id');
		$data = $this->ReferenceModel->getReference($id);
		echo json_encode($data);
	}

}
