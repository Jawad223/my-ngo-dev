<?php 
defined('BASEPATH') or exit('No direct script access allowed');


class Donation extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('AddModel');
        $this->load->model('DeleteModel');
        $this->load->model('ListModel');
        $this->load->model('UpdateModel');

		$this->load->library('form_validation');
	}

	public function styleFiles() {
		$data['title'] = array('title' => 'Donation - NGO Application');	
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

	public function donatev() {
		$this->styleFiles();
		$this->navbarFiles();
		$this->sidebarFiles();
		
		$id = $this->session->userdata('user_id');

		$data['category'] = $this->ListModel->getParentCategories();
		$data['unit'] = $this->ListModel->getUnits();
		$data['donation'] = $this->ListModel->getDonation($id);

		$this->load->view('donation', $data);
		$this->dashboardFooterFiles();
	}

	private function uploadFile($file) {
        $file_name = md5(time());
        $config['file_name'] = $file_name.".png";
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'gif|png|jpg';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file'))
            return $file_name;
        else
            return null;
    }
	
	public function addDonation() {
	    if (!is_null($this->input->post('child_category_3'))) {
	        $category_id = $this->input->post('child_category_3');
        }
        else if (!is_null($this->input->post('child_category_2'))) {
            $category_id = $this->input->post('child_category_2');
        }
        else if (!is_null($this->input->post('child_category_1'))) {
            $category_id = $this->input->post('child_category_1');
        }
        else if (!is_null($this->input->post('category'))) {
            $category_id = $this->input->post('category');
        }

		$config = array(
            array(
                'field' => 'subject',
                'label' => 'Subject',
                'rules' => 'trim|required|min_length[3]|max_length[30]',
                'errors' => array('required' => 'You must provide the %s.'),
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'trim|required|min_length[4]|max_length[250]',
                'errors' => array('required' => 'You must provide the %s.'),
            ),
            array(
                'field' => 'category',
                'label' => 'Category',
                'rules' => 'trim|required|min_length[1]|max_length[5]',
                'errors' => array('required' => 'You must select a %s.'),
            ),
            array(
                'field' => 'measurement_id',
                'label' => 'Measurement Unit',
                'rules' => 'trim|required|min_length[1]|max_length[5]',
                'errors' => array('required' => 'You must select a %s.'),
            ),
            array(
                'field' => 'quantity',
                'label' => 'Requesting Quantity',
                'rules' => 'trim|required|min_length[1]|max_length[10]',
                'errors' => array('required' => 'You must provide the %s.'),
            ),
            array(
                'field' => 'donate_as',
                'label' => 'Donated As',
                'rules' => 'trim|required|min_length[1]|max_length[2]',
                'errors' => array('required' => 'You must select the %s.'),
            ),
        );
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) {
            $this->donatev();
        }
		else {
            $data = array(
                'user_id' => $this->input->post('id'),
                'subject' => $this->input->post('subject'),
                'description' => $this->input->post('description'),
                'quantity' => $this->input->post('quantity'),
                'category_id' => $category_id,
                'measurement_id' => $this->input->post('measurement_id'),
                'type_id' => 1,
                'status_id' => 3,
                'donated_as' => $this->input->post('donate_as'),
                );

            $notification = array(
                'subject' => $this->input->post('subject'),
                'description' => $this->input->post('description'),
                'viewed' => '0',
                'user_id' => $this->input->post('id'),
            );

            $new_id = $this->AddModel->addRequest("request", $data);

            if (!is_null($new_id)) {
                $file = $this->uploadFile($_FILES['file']);
                $this->AddModel->addData("notification", $notification);

                if (!is_null($file)) {
                    $file_data = array('file' => $file.'.png');
                    $this->UpdateModel->updateData("request", "request_id", $new_id, $file_data);
                    $this->session->set_flashdata('donation_success', 'Donated successfully');
                }
                else {
                    $this->session->set_flashdata('donation_success', 'Donated successfully but file not uploaded. 
                    Either you did not select a file to upload or failed');
                }
                redirect(base_url() . 'donation/donatev');
            }
            else {
                $this->session->set_flashdata('donation_fail', 'Could not made the donation');
                redirect(base_url() . 'donation/donatev');
            }
		}
    }
}