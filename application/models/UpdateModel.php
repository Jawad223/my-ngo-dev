<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateModel extends CI_Model {

    function approveData($table, $pk1, $pk2, $id, $data) {
        $this->db->where($pk1, $id);
        $this->db->where('type_id', $pk2);
        $this->db->update($table, $data);

        return $this->db->affected_rows() == 1 ? true : false;
    }

    function updateData($table, $pk, $id, $data) {
        $this->db->where($pk, $id);
        $this->db->update($table, $data);

        return $this->db->affected_rows() >= 1 ? true : false;
    }
}