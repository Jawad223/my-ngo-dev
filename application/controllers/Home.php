<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function styleFiles() {
    	$data['title'] = array('title' => 'Home - NGO Application');
		$this->load->view('include/cleanblog_header', $data);
	}

	public function navigationFiles() {
		$this->load->view('include/navigation');
	}

	public function sliderFiles() {
		$this->load->view('include/slider');
	}
	
    public function footerFiles() {
    	$this->load->view('include/cleanblog_footer');
	}

	public function index() {
        $this->styleFiles();
        $this->navigationFiles();
        $this->sliderFiles();
        $this->load->view('home');
        $this->footerFiles();
    }
}

?>