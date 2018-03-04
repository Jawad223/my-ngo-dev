<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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

    public function listCategoryV() {
        $data['category'] = $this->ListModel->getCategories();
        $data['unit'] = $this->ListModel->getUnits();
        
        $this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();
        $this->load->view('dashboard/list_category', $data);
        $this->dashboardFooterFiles();
    }

    public function addCategory() {
        $config = array(
            array(
                'field' => 'category_name',
                'label' => 'Category Name',
                'rules' => 'trim|required|min_length[3]',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
            array(
                'field' => 'measurement_id',
                'label' => 'Measurement Unit',
                'rules' => 'trim|required|min_length[1]|numeric',
                'errors' => array(
                    'required' => 'You must provide the %s.',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->listCategoryV();
            //redirect(base_url().'category/listcategoryv');
        }
        else {
            $data = array(
                'category_name' => $this->input->post('category_name'),
                'measurement_id' => $this->input->post('measurement_id'),
                'parent_category_id' => $this->input->post('parent_category_id')
            );
            if ($this->AddModel->addData("category", $data)) {
                $this->session->set_flashdata('category_success','Category is added/updated successfully');
                redirect(base_url().'category/listcategoryv');
            }
            else {
                $this->session->set_flashdata('category_fail','Category is not added/updated');
                redirect(base_url().'category/listcategoryv');
            }
        }
    }

    public function updateCategory() {
        $id = $this->input->post('category_id');

        $data = array (
            'category_name' => $this->input->post('category_name'),
            'measurement_id' => $this->input->post('measurement_id'),
            'parent_category_id' => $this->input->post('parent_category_id')
            );

        if ($this->UpdateModel->updateData("category", "category_id", $id, $data)) {
            $this->session->set_flashdata('category_success','Category is added/updated successfully');
            $redir = base_url().'category/listcategoryv';
            redirect($redir);
        }
        else {
            $this->session->set_flashdata('category_fail','Category is not added/updated');
            $redir = base_url().'category/listcategoryv';
            redirect($redir);
        }
    }

    public function getCategories() {
        $data = $this->ListModel->getCategories();
        echo json_encode($data);
    }

    public function getCategory() {
        $id = $this->input->post('id');
        $data = $this->ListModel->getCategory($id);

        echo json_encode($data);
    }

    public function ifChildExists() {
	    $id = $this->input->post('id');
	    if ($this->ListModel->ifChildExists($id))
	        echo json_encode(1);
	    else
	        echo json_encode(0);
    }

    public function getChildCategory() {
	    $id = $this->input->post('id');
	    $category = $this->ListModel->getChildCategory($id);

	    echo json_encode($category);
    }

    public function deleteCategory() {
        $id = $this->input->post('id');
        $data = array('delete_flag' => 1);
        $table = 'category';
        $pk = 'category_id';

        if ($this->DeleteModel->deleteData($table, $pk, $id, $data)) {
            $this->session->set_flashdata('category_success','Category is deleted successfully');
            echo json_encode($data);
        }
        else {
            $this->session->set_flashdata('category_fail','Category is not deleted');
            echo json_encode($data);
        }
    }

}
