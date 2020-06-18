<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_reference_region(){
        $this->db->from('tbl_reference_region reg');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_reference_province(){
        $this->db->from('tbl_reference_province prov');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_reference_citymun(){
        $this->db->from('tbl_reference_citymun citymun');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_reference_brgy(){
        $this->db->from('tbl_reference_brgy brgy');
        $query = $this->db->get();
        return $query->result();
    }

    
}