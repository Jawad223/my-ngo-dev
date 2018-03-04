<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthorizationModel extends CI_Model {

    function checkUser($username, $password) {
        $this->db->select('1');
        $this->db->from('user');
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $this->db->where('user_status', 1);
        $this->db->where('delete_flag', 0);

        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
    }

    //find, why this function and where used
    function getUser($data) {
        $query = $this->db->get('user');
        return $query->result();
    }
}