<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeleteModel extends CI_Model {

    function deleteData($table, $pk, $id, $data) {
        $this->db->where($pk, $id);
        $this->db->update($table, $data);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

}