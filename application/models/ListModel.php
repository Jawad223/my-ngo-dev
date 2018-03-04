<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListModel extends CI_Model {

    function checkChildCategory($id) {
        $this->db->select('category_id');
        $this->db->from('category');
        $this->db->where('parent_category_id', $id);

        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return true;
        }
        else {
            false;
        }
    }

    function checkUnitForCategory($id) {
        $this->db->select('category_id');
        $this->db->from('category');
        $this->db->where('parent_category_id', $id);

        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return true;
        }
        else {
            return false;
        }
    }

    function getApprovalHistory() {
        $this->db->select('request_approval.request_id');
        $this->db->select('request.subject');
        $this->db->select('request.description');
        $this->db->select('request_type.type');
        $this->db->select('request_status.status');
        $this->db->select('user.name');
        $this->db->select('request_approval.approval_date');
        $this->db->from('request_approval');
        $this->db->join('request', 'request_approval.request_id = request.request_id');
        $this->db->join('user', 'request_approval.user_id = user.user_id');
        $this->db->join('request_type', 'request.type_id = request_type.rt_id');
        $this->db->join('request_status', 'request.status_id = request_status.status_id');
        $this->db->where('request.status_id !=', '1');

        $query = $this->db->get();
        return $query->result();
    }

    function checkUser($username, $password) {
        $this->db->select('1');
        $this->db->from('user');
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $this->db->where('user_status = 1');
        $this->db->where('delete_flag = 0');

        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    function getAllUsersByRole() {
        $this->db->select('user.user_id');
        $this->db->select('user.name');
        $this->db->select('user.email');
        $this->db->select('user.address');
        $this->db->select('user.user_status');
        $this->db->select('user.cell');
        $this->db->select('user.created_at');
        $this->db->select('role.role_name');
        $this->db->from('user');
        $this->db->join('user_role','user.user_id = user_role.user_id','inner');
        $this->db->join('role','user_role.role_id = role.role_id','inner');

        $query = $this->db->get();
        return $query->result();
    }

    function getAllRoles() {
        $query = $this->db->get('role');
        return $query->result();
    }

    function getCategories() {
        $this->db->select('C1.category_id AS category_id,C1.category_name AS category_name');
        $this->db->select('C2.category_name AS parent_category');
        $this->db->select('M1.measurement_unit');
        $this->db->from('category C1');
        $this->db->join('category C2','C2.category_id = C1.parent_category_id','left');
        $this->db->join('measurement M1','C1.measurement_id = M1.measurement_id');
        $this->db->order_by('category_id','asc');
        $this->db->where('C1.delete_flag',0);

        $query = $this->db->get();
        return $query->result();
    }

    function getParentCategories() {
        $this->db->select('category_id');
        $this->db->select('category_name');
        $this->db->from('category');
        $this->db->where('parent_category_id', null);
        $this->db->where('delete_flag',0);
        $this->db->order_by('category_name', 'asc');

        $query = $this->db->get();
        return $query->result();
    }

    function getCategory($id) {
        $this->db->select('C1.category_id AS id,C1.category_name AS category');
        $this->db->select('C2.category_name AS parent, C2.category_id AS pid');
        $this->db->select('M1.measurement_id AS mid, M1.measurement_unit');
        $this->db->from('category C1');
        $this->db->join('category C2', 'C2.category_id = C1.parent_category_id', 'left');
        $this->db->join('measurement M1','C1.measurement_id = M1.measurement_id');
        $this->db->where('C1.category_id', $id);
        $this->db->where('C1.delete_flag',0);
        $this->db->order_by('C1.category_id','asc');

        $query = $this->db->get();
        return $query->result();
    }

    function getChildCategory($id) {
        $this->db->select('category_id');
        $this->db->select('category_name');
        $this->db->from('category');
        $this->db->where('parent_category_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    function getControls() {
        $this->db->select('*');
        $this->db->from('control');
        $this->db->where('delete_flag',0);
        $this->db->order_by('control_name');
        $query = $this->db->get();

        return $query->result();
    }

    function getControl($id) {
        $this->db->select('*');
        $this->db->from('control');
        $this->db->where('control_id', $id);
        $this->db->where('delete_flag',0);

        $query = $this->db->get();
        return $query->result();
    }

    function getDonations() {
        $this->db->select('request.request_id');
        $this->db->select('request.subject');
        $this->db->select('request.description');
        $this->db->select('category.category_name');
        $this->db->select('measurement.measurement_unit');
        $this->db->select('request.created_at');
        $this->db->select('request.quantity');
        $this->db->select('request.file');
        $this->db->select('request_status.status');
        $this->db->select('request_type.type');
        $this->db->from('request');
        $this->db->join('category', 'request.category_id = category.category_id');
        $this->db->join('measurement', 'request.measurement_id = measurement.measurement_id');
        $this->db->join('request_status', 'request.status_id = request_status.status_id');
        $this->db->join('request_type', 'request.type_id = request_type.rt_id');
        $this->db->where('request.type_id', 1);
        $this->db->where('request.status_id', 3);
        $this->db->order_by('request.created_at', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    function getDonation($id) {
        $this->db->select('request.description');
        $this->db->select('request.subject');
        $this->db->select('category.category_name');
        $this->db->select('measurement.measurement_unit');
        $this->db->select('request.created_at');
        $this->db->select('request.quantity');
        $this->db->select('request_type.type');
        $this->db->select('request.file');
        $this->db->select('request_status.status');
        $this->db->from('request');
        $this->db->join('category', 'request.category_id = category.category_id');
        $this->db->join('measurement', 'request.measurement_id = measurement.measurement_id');
        $this->db->join('request_type', 'request.type_id = request_type.rt_id');
        $this->db->join('request_status', 'request.status_id = request_status.status_id');
        $this->db->where('user_id', $id);
        $this->db->where('request.type_id', 1);
        $this->db->order_by('request.created_at', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    function getUnits() {
        $this->db->select('*');
        $this->db->from('measurement');
        $this->db->where('delete_flag',0);
        $query = $this->db->get();
        return $query->result();
    }

    function getUnit($id) {
        $this->db->select('*');
        $this->db->from('measurement');
        $this->db->where('measurement_id', $id);
        $this->db->where('delete_flag',0);

        $query = $this->db->get();
        return $query->result();
    }

    function getUnitForCategory($id) {
        $this->db->select('measurement.measurement_id');
        $this->db->select('measurement.measurement_unit');
        $this->db->from('category');
        $this->db->join('measurement', 'category.measurement_id = measurement.measurement_id', 'INNER');
        $this->db->where('category.category_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    public function fetchNotification() {
        $this->db->select('*');
        $this->db->from('notification');
        $this->db->order_by('notification_id', 'DESC');
        $this->db->where('viewed', 0);
        $this->db->limit('5');

        $query = $this->db->get();
        return $query->result();
    }

    function getReceptions() {
        $this->db->select('request.request_id');
        $this->db->select('request.description');
        $this->db->select('request.subject');
        $this->db->select('category.category_name');
        $this->db->select('measurement.measurement_unit');
        $this->db->select('request.created_at');
        $this->db->select('request.quantity');
        $this->db->select('reference.name reference');
        $this->db->select('request_status.status');
        $this->db->from('request');
        $this->db->join('category', 'request.category_id = category.category_id');
        $this->db->join('measurement', 'request.measurement_id = measurement.measurement_id', 'left');
        $this->db->join('reference', 'request.reference_id = reference.reference_id', 'left');
        $this->db->join('request_status', 'request.status_id = request_status.status_id');
        $this->db->where('request.type_id', 2);
        $this->db->where('request.status_id', 3);
        $this->db->order_by('request.created_at', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    function getReception($id) {
        $this->db->select('request.description description');
        $this->db->select('request.subject');
        $this->db->select('category.category_name');
        $this->db->select('measurement.measurement_unit');
        $this->db->select('request.created_at');
        $this->db->select('request.quantity');
        $this->db->select('reference.name reference');
        $this->db->select('request_status.status');
        $this->db->from('request');
        $this->db->join('category', 'request.category_id = category.category_id');
        $this->db->join('measurement', 'request.measurement_id = measurement.measurement_id');
        $this->db->join('reference', 'request.reference_id = reference.reference_id', 'left');
        $this->db->join('request_status', 'request.status_id = request_status.status_id');
        $this->db->where('request.user_id', $id);
        $this->db->where('request.type_id', 2);
        $this->db->where('request.status_id', 3);
        $this->db->order_by('request.created_at', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    function getReferences() {
        $this->db->select('*');
        $this->db->from('reference');

        $query = $this->db->get();
        return $query->result();
    }

    function getReference($id) {
        $this->db->select('*');
        $this->db->from('reference');
        $this->db->where('user_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    function getRolesControls() {
        $this->db->select("role_control.rc_id");
        $this->db->select("role.role_name ");
        $this->db->select("control.control_name, control.control_url");
        $this->db->from("role_control");
        $this->db->join("role","role_control.role_id = role.role_id");
        $this->db->join("control","role_control.control_id = control.control_id");
        $this->db->where("role_control.delete_flag",0);

        $query = $this->db->get();
        return $query->result();
    }

    function getControlsForRole($role_id) {
        $sql  = "SELECT * FROM control WHERE control.control_name NOT IN (";
		$sql .= " SELECT c.control_name FROM user_role ur";
        $sql .= " INNER JOIN role_control rc ON ur.role_id = rc.role_id";
        $sql .= " INNER JOIN control c ON rc.control_id = c.control_id";
        $sql .= " INNER JOIN role r ON ur.user_id = r.role_id";
        $sql .= " WHERE ur.role_id = ".$role_id.")";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRoles() {
        $this->db->select("*");
        $this->db->from("role");
        $this->db->where("delete_flag",0);
        $query = $this->db->get();
        return $query->result();
    }

    function getRole($id) {
        $this->db->select('role_id');
        $this->db->select('role_name');
        $this->db->from('role');
        $this->db->where('role_id', $id);
        $this->db->where('delete_flag',0);

        $query = $this->db->get();
        return $query->result();
    }

    function getUser($username) {
        $this->db->select('user.user_id');
        $this->db->select('user.name');
        $this->db->select('user.email');
        $this->db->select('user.password');
        $this->db->select('user.address');
        $this->db->select('user.created_at');
        $this->db->select('user.cell');
        $this->db->select('user.dob');
        $this->db->select('user.cnic');
        $this->db->select('user.gender');
        $this->db->select('user.pin');
        $this->db->select('role.role_name');
        $this->db->from('user');
        $this->db->join('user_role', 'user.user_id = user_role.user_id');
        $this->db->join('role', 'user_role.role_id = role.role_id');
        $this->db->where('user.email', $username);
        $this->db->where('user.user_status = 1');
        $this->db->where('user.delete_flag = 0');

        $this->db->limit(1);

        $query = $this->db->get();
        return $query->result();
    }

    function getAllUsers() {
        $query = $this->db->get('user');
        return $query->result();
    }

    function getUsersForRole($role_id) {
        $sql = "SELECT user.user_id, user.name";
        $sql .= " FROM user";
        $sql .= " WHERE user.user_id NOT IN(";
        $sql .= " SELECT user.user_id FROM user";
        $sql .= " INNER JOIN user_role ON USER.user_id = user_role.user_id";
        $sql .= " INNER JOIN role ON user_role.role_id = role.role_id";
        $sql .= " WHERE user_role.role_id = ". $role_id .")";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getMyRoles($username) {
        $this->db->select('user_role.ur_id');
        $this->db->select('role.role_name AS RoleName');
        $this->db->select('control.control_name AS ControlName, control.control_url AS ControlURL');
        $this->db->from('user_role, role_control, role, control, user');
        $this->db->where('user_role.role_id = role.role_id');
        $this->db->where('user_role.user_id = user.user_id');
        $this->db->where('user_role.role_id = role_control.role_id');
        $this->db->where('role_control.control_id = control.control_id');
        $this->db->where('role_control.role_id = role.role_id');
        $this->db->where('user.email', $username);
        $this->db->where('control.delete_flag',0);

        $query = $this->db->get();
        return $query->result();
    }

    function getRoleURL($user_id) {
        $this->db->select('c.control_url ControlURL');
        $this->db->from('user_role ad');
        $this->db->join('role_control rc', 'ad.role_id = rc.role_id');
        $this->db->join('control c','rc.control_id = c.control_id');
        $this->db->where('ad.user_id', $user_id);
        $this->db->where('c.delete_flag', 0);

        $query = $this->db->get();
        return $query->result();
    }

    function ifChildExists($id) {
        $this->db->select('1');
        $this->db->from('category');
        $this->db->where('parent_category_id', $id);
        $this->db->where('delete_flag', '0');

        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    // donations count for main dashboard chart
    function getDonationsCount() {
        $this->db->select('count(*) total_donations');
        $this->db->from('request');
        $this->db->where('request.type_id', 1);
        $this->db->where('request.delete_flag', 0);

        $query = $this->db->get();
        return $query->result();
    }

    // receptions count for main dashboard chart
    function getReceptionsCount() {
        $this->db->select('count(*) total_receptions');
        $this->db->from('request');
        $this->db->where('request.type_id', 2);
        $this->db->where('request.delete_flag', 0);

        $query = $this->db->get();
        return $query->result();
    }

    // users count for main dashboard chart
    function getUsersCount() {
        $this->db->select('count(*) total_users');
        $this->db->from('user');
        $this->db->where('user.delete_flag', 0);

        $query = $this->db->get();
        return $query->result();
    }
}