<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validation_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    public function get_employee_id($emp_id){
        $this->db->select('employee_id');
        $this->db->from('tbl_employee');
        $this->db->where('employee_code',$emp_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function validate_login($username, $password)
    {

        $this->db->select('u.*,e.emp_picture');
        $this->db->from('tbl_system_users u');
        $this->db->join('tbl_employee e','e.PK_employee_code = u.FK_employee_code','left');
        $this->db->where('u.Username', $username);
        $this->db->where('u.Password', $password);

        if ($query = $this->db->get()) {
            return $query->row_array();
        } else {
            return false;
        }

    }
}

?>