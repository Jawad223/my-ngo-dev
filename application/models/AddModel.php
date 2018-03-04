<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddModel extends CI_Model {

    function addData($table, $data) {
        $this->db->insert($table, $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    // keep it separate, as it returns the new inserted id
    function addRequest($table, $data) {
        $this->db->insert($table, $data);
        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
    }

}