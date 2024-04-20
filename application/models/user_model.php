<?php
class user_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    function index() {
        return $this->db->get('students');
    }

    function insert($data) {
        return $this->db->insert('students', $data);
    }

    function view($param) {
        $query = $this->db->get_where('students', $param['condition']);
        return $query->row_array();
    }

    function update($param) {
        $field = array(
            'name' => $param['user_name'],
            'email' => $param['user_email'],
            'age' => $param['user_age'], 
        );
        $condition = array('id' => $param['user_id']);
        
        $query = $this->db->get_where('students', $condition);
        $result = $query->result_array();
        
        if (!empty($result)) {
            $this->db->where($condition);
            $this->db->update('students', $field);
            return true; // Update successful
        } else {
            return false; // No matching record found
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('students');
    }
}
?>
