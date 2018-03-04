<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('ListModel');
        $this->load->model('UpdateModel');
	}

	public function fetch() {
        $result = $this->ListModel->fetchNotification();

        $output = '';
        $count = 0;
        if ($result) {
            foreach ($result as $key) {
                $output .= '
				<ul class = "menu">
				    <li>
						<a href="#">
                            <i class="fa fa-users text-red"></i>
						    <strong>'.$key->subject.'</strong><br />
						    <small><em>'.$key->description.'</em></small>
						</a>
					</li>
				</ul>
				';
                $count++;
				}
			}
        else {
			$output .= '
			<li class="header"><a href="#" class="text-bold text-italic">No notification found</a></li>';
			$count = '';
		}

		$data = array(
			'notification' => $output,
			'unseen_notification' => $count
			);
		echo json_encode($data);
	}
}
