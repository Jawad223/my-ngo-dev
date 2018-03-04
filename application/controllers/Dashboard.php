<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('ListModel');
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

	public function userDashboard() {
		$this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();

        $data['donation_count'] = $this->ListModel->getDonationsCount();
        $data['reception_count'] = $this->ListModel->getReceptionsCount();
        $data['user_count'] = $this->ListModel->getUsersCount();

		$this->load->view('dashboard/main_content', $data);
        $this->dashboardFooterFiles();
	}

    public function userRoles() {
        $data['users'] = $this->ListModel->getAllUsers();
        $data['users_by_role'] = $this->ListModel->getAllUsersByRole();
        $data['roles'] = $this->ListModel->getAllRoles();

        $this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();
        $this->load->view('dashboard/userroles', $data);
        $this->dashboardFooterFiles();
    }

    public function myProfile() {
        $username = $this->session->userdata['login_user'];

        $data['user'] = $this->ListModel->getUser($username);
        $data['myroles'] = $this->ListModel->getMyRoles($username);

        $this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();
        $this->load->view('dashboard/profile', $data);
        $this->dashboardFooterFiles();
    }

    public function myCalendar() {
	    $this->styleFiles();
	    $this->navbarFiles();
	    $this->sidebarFiles();
	    $this->load->view('dashboard/calendar');
	    $this->dashboardFooterFiles();
    }
}
