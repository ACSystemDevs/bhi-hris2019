<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function save_department_details($dept_details)
    {
        $this->db->insert('tbl_department',$dept_details);
    }

    public function get_active_department()
    {
        $this->db->from('tbl_department dept');
        $this->db->join('tbl_employee emp','emp.PK_employee_code = dept.FK_employee_code');
        $this->db->where('dept.department_status','Active');
        $this->db->order_by('dept.department_name','asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_department_details($department_ID)
    {
        $this->db->from('tbl_department dept');
        $this->db->join('tbl_employee emp','emp.PK_employee_code = dept.FK_employee_code');
        $this->db->where('dept.PK_department_ID',$department_ID);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_department_details($where_ID, $dept_details)
    {
        $this->db->update('tbl_department',$dept_details, $where_ID);
    }
}