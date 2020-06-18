<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // EMPLOYEE PROFILE SAVING
    public function save_employee_useraccount($employee_useraccount)
    {
        $this->db->insert('tbl_system_users',$employee_useraccount);
    }

    public function get_all_useraccount()
    {
        $this->db->from('tbl_system_users user');
        $this->db->join('tbl_employee emp','emp.PK_employee_code = user.FK_employee_code','inner');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_useraccount_details_byID($user_id)
    {
        $this->db->select('user.PK_user_ID,user.Username,user.user_usertype');
        $this->db->from('tbl_system_users user');
        $this->db->where('user.PK_user_ID',$user_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_useraccount_details_by_FKID($employee_code)
    {
        $this->db->select('user.PK_user_ID,user.Username,user.user_usertype');
        $this->db->from('tbl_system_users user');
        $this->db->where('user.FK_employee_code',$employee_code);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_employee_useraccount($where_ID, $useraccount_details)
    {
        $this->db->update('tbl_system_users',$useraccount_details,$where_ID);
    }
}