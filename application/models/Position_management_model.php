<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Position_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_active_position(){
        $this->db->from('tbl_position pos');
        $this->db->join('tbl_section sec','pos.FK_section_ID = sec.PK_section_ID','left');
        $this->db->where('pos.position_status','active');
        $this->db->order_by('sec.section_name','asc');
        $this->db->order_by('pos.job_name','asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_active_position_json(){
        $this->db->from('tbl_position pos');
        $this->db->join('tbl_section sec','pos.FK_section_ID = sec.PK_section_ID','left');
        $this->db->where('pos.position_status','active');
        $this->db->order_by('pos.job_name','asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function add_position_details($position_details)
    {
        $this->db->insert('tbl_position',$position_details);
    }

    public function get_position_details($position_id){
        $this->db->from('tbl_position pos');
        $this->db->join('tbl_section sec','pos.FK_section_ID = sec.PK_section_ID','left');
        $this->db->where('pos.PK_position_ID',$position_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_position_details($where_ID, $position_details)
    {
        $this->db->update('tbl_position',$position_details,$where_ID);
    }
}