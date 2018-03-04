<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class RoleControl extends CI_Controller {

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

    public function listRoleControlV() {
        $data['role'] = $this->ListModel->getRoles();
        $data['control'] = $this->ListModel->getControls();
        $data['role_control'] = $this->ListModel->getRolesControls();

        $this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();
        $this->load->view('dashboard/list_role_control', $data);
        $this->dashboardFooterFiles();
    }
    
    public function addRoleControl() {
        $config = array(
            array(
                'field' => 'control_id',
                'label' => 'Control',
                'rules' => 'trim|required|min_length[1]|numeric',
                'errors' => array(
                    'required' => 'You must select the %s.',
                ),
            ),
            array(
                'field' => 'role_id',
                'label' => 'Role',
                'rules' => 'trim|required|min_length[1]|numeric',
                'errors' => array(
                    'required' => 'You must select the %s.',
                ),
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->listRoleControlV();
        }
        else {
            $control_id = $this->input->post('control_id');
            $role_id = $this->input->post('role_id');
            $data = array(
                'control_id' => $control_id,
                'role_id' => $role_id
            );
            $table = 'role_control';

            if ($this->AddModel->addData($table, $data)) {
                $this->session->set_flashdata('role_control_success','Role Control is added successfully');
                $redir = base_url().'rolecontrol/listrolecontrolv';
                redirect($redir);
            }
            else {
                $this->session->set_flashdata('role_control_fail','Role Control not added');
                $redir = base_url().'rolecontrol/listrolecontrolv';
                redirect($redir);
            }
        }
    }

    public function getControlsForRole() {
        $role_id = $this->input->post('id');
        if ($role_id == 0) {
            echo "";
        }
        else {
            $data = $this->ListModel->getControlsForRole($role_id);

            $output = '<label for="control" class="col-sm-2 control-label">Control</label>';
            $output .= '<div class="col-sm-10">';
            $output .= '<select class="form-control" name="control_id">';

            foreach ($data as $key) {
                $output .= '<option value="'.$key->control_id.'">'.$key->control_name.'</option>';
            }
            $output .= '</select>';
            $output .= '</div>';
            echo $output;
        }
    }

    public function deleteRoleControl() {
        $id = $this->input->post('id');
        $data = array('delete_flag' => 1);
        $table = 'role_control';
        $pk = 'rc_id';

        $this->DeleteModel->deleteRoleControl($table, $pk, $id, $data);

        echo json_encode($data);
    }
}
