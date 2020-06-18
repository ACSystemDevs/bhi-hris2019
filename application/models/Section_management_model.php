<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Section_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_section(){
        $this->db->from('tbl_section sec');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_active_section()
    {
        $this->db->from('tbl_section sect');
        $this->db->join('tbl_department dept','dept.PK_department_ID = sect.FK_department_ID');
        $this->db->join('tbl_employee emp','emp.PK_employee_code = sect.FK_employee_code');
        $this->db->where('sect.section_status','Active');
        $this->db->order_by('dept.department_name','asc');
        $this->db->order_by('sect.section_name','asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_active_section_json()
    {
        $this->db->from('tbl_section sect');
        $this->db->join('tbl_department dept','dept.PK_department_ID = sect.FK_department_ID');
        $this->db->join('tbl_employee emp','emp.PK_employee_code = sect.FK_employee_code');
        $this->db->where('sect.section_status','Active');
        $this->db->order_by('sect.section_name','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_section_details_byID($section_id){
        $this->db->from('tbl_section sect');
        $this->db->join('tbl_department dept','dept.PK_department_ID = sect.FK_department_ID');
        $this->db->join('tbl_employee emp','emp.PK_employee_code = sect.FK_employee_code');
        $this->db->where('sect.PK_section_ID',$section_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function add_section_details($sect_details)
    {
        $this->db->insert('tbl_section',$sect_details);
    }
    public function update_section_details($where_PK, $sect_details)
    {
        $this->db->update('tbl_section',$sect_details, $where_PK);
    }
}