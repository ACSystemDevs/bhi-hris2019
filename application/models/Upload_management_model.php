<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_employee_file($file_data){
        $this->db->insert('tbl_employee_201files',$file_data);
    }

    public function get_employee_files($employee_code){
        $this->db->from('tbl_employee_201files files');
        $this->db->where('files.FK_employee_code',$employee_code);
        $query = $this->db->get();
        return $query->result();
    }

    public function uploaded_file_details($file_id)
    {
        $this->db->from('tbl_employee_201files files');
        $this->db->where('files.PK_emp_201files_ID',$file_id);
        $query = $this->db->get();
        return $query->row();
    }
}