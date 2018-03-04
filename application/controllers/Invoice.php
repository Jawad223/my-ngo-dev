<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller {

	function __construct() {
		parent::__construct();
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

	public function createInvoice() {
        $this->styleFiles();
        $this->navbarFiles();
        $this->sidebarFiles();
        $this->load->view('dashboard/invoice');
        $this->dashboardFooterFiles();
    }
}
