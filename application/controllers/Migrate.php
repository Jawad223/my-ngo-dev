<?php

class Migrate extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        }
    }

}