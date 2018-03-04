<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('AuthorizationModel');
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

    public function error() {
        $this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();
        $this->load->view('errors/404.php');
        $this->dashboardFooterFiles();
    }

}

?>