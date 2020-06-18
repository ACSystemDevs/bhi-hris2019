<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_latest_employee_code(){
        // $this->db->select('PK_employee_ID, PK_employee_code');
        $this->db->select('PK_employee_code');
        $this->db->order_by('PK_employee_ID','desc');
        $this->db->limit(1);
        $result = $this->db->get('tbl_employee')->row();
        return $result->PK_employee_code;
    }
    public function get_active_employees(){
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_system_users user','emp.PK_employee_code = user.FK_employee_code','left');
        $this->db->where('user.user_status','Active');
        $this->db->where('emp.PK_employee_code !=','00000');
        $this->db->order_by('emp.emp_LName','asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_hired_employee()
    {
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_employee_record rec','emp.PK_employee_code = rec.FK_employee_code','left');
        $this->db->where('emp.PK_employee_code !=','00000');
        $this->db->order_by('emp.emp_LName','asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_employee_profile($employee_code)
    {
        $this->db->select('emp.*, exp.*, edu.*, ids.*, dep.*, fam.*, rec.*, user.user_status, user.user_usertype');
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_employee_experience exp','exp.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_employee_education edu','edu.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_employee_ids ids','ids.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_employee_dependents dep','dep.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_employee_family fam','fam.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_employee_record rec','emp.PK_employee_code = rec.FK_employee_code','left');
        $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
        $this->db->where('emp.PK_employee_code',$employee_code);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_basic_employee_profile($employee_code)
    {
        $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, rec.record_position, rec.record_status, rec.record_section');
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_employee_record rec','emp.PK_employee_code = rec.FK_employee_code','left');
        $this->db->where('emp.PK_employee_code',$employee_code);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_employee_wname($employee_code)
    {
        $this->db->from('tbl_employee emp');
        $this->db->where('emp.PK_employee_code',$employee_code);
        $query = $this->db->get();
        $emp_name =  $query->row();
        $emp_wname = $emp_name->emp_FName.'&nbsp;'.$emp_name->emp_MName.'&nbsp;'.$emp_name->emp_LName.'&nbsp'.$emp_name->emp_NameExt;
        return $emp_wname;
    }
    public function get_employee_flname($employee_code)
    {
        $this->db->from('tbl_employee emp');
        $this->db->where('emp.PK_employee_code',$employee_code);
        $query = $this->db->get();
        $emp_name =  $query->row();
        $emp_wname = $emp_name->emp_FName.'&nbsp;'.$emp_name->emp_LName.'&nbsp'.$emp_name->emp_NameExt;
        return $emp_wname;
    }
    // EMPLOYEE PROFILE SAVING
    public function save_employee_profile($employee_profile)
    {
        $this->db->insert('tbl_employee',$employee_profile);
    }

    public function save_employee_ids($employee_ids)
    {
        $this->db->insert('tbl_employee_ids',$employee_ids);
    }

    public function save_employee_dependents($employee_dependents)
    {
        $this->db->insert('tbl_employee_dependents',$employee_dependents);
    }

    public function save_employee_experience($employee_experience)
    {
        $this->db->insert('tbl_employee_experience',$employee_experience);
    }

    public function save_employee_education($employee_education)
    {
        $this->db->insert('tbl_employee_education',$employee_education);
    }

    public function save_employee_family($employee_family)
    {
        $this->db->insert('tbl_employee_family',$employee_family);
    }

    public function save_employee_record($employee_record)
    {
        $this->db->insert('tbl_employee_record',$employee_record);
    }

        // EMPLOYEE PROFILE UPDATE
        public function update_employee_profile($where_PK, $employee_profile)
        {
            $this->db->update('tbl_employee',$employee_profile,$where_PK);
        }
    
        public function update_employee_ids($where_FK, $employee_ids)
        {
            $this->db->update('tbl_employee_ids',$employee_ids,$where_FK);
        }
    
        public function update_employee_dependents($where_FK, $employee_dependents)
        {
            $this->db->update('tbl_employee_dependents',$employee_dependents,$where_FK);
        }
    
        public function update_employee_experience($where_FK, $employee_experience)
        {
            $this->db->update('tbl_employee_experience',$employee_experience,$where_FK);
        }
    
        public function update_employee_education($where_FK, $employee_education)
        {
            $this->db->update('tbl_employee_education',$employee_education,$where_FK);
        }
    
        public function update_employee_family($where_FK, $employee_family)
        {
            $this->db->update('tbl_employee_family',$employee_family,$where_FK);
        }
    
        public function update_employee_record($where_FK, $employee_record)
        {
            $this->db->update('tbl_employee_record',$employee_record,$where_FK);
        }

        //for section head
        public function get_section_members($employee_code){

            $this->db->select('sec.section_name');
            $this->db->from('tbl_section sec');
            $this->db->where('sec.FK_employee_code',$employee_code);
            $section_arr = $this->db->get()->row();
            $section_FK = $section_arr->section_name;
            $this->db->select('emp.PK_employee_code,emp.emp_picture, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, emp.emp_mobno, emp.emp_email, rec.record_section, rec.record_position, rec.record_status, user.FK_employee_code, user.user_status');
            $this->db->from('tbl_employee emp');
            $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
            $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
            $this->db->where('user.user_status','Active');
            $this->db->where('emp.PK_employee_code !=','00000');
            $this->db->where('emp.PK_employee_code !=', $employee_code);
            $this->db->order_by('emp.emp_LName','asc');
            $query = $this->db->get();
            $result = $query->result_array();
            $rows = count($result);
            $masterlist = array();
            for($a=0;$a<=($rows-1);$a++){
                if ((is_array(unserialize(base64_decode($result[$a]['record_section']))) && count(unserialize(base64_decode($result[$a]['record_section']))) > 0 && unserialize(base64_decode($result[$a]['record_section']))[0] != '')) {
                    $sec_count = (count(unserialize(base64_decode($result[$a]['record_section'])))) -1;
                    $section =  unserialize(base64_decode($result[$a]['record_section']))[$sec_count];
                }else{
                    $section =  'Unassigned';
                }
                if ((is_array(unserialize(base64_decode($result[$a]['record_position']))) && count(unserialize(base64_decode($result[$a]['record_position']))) > 0 && unserialize(base64_decode($result[$a]['record_position']))[0] != '')) {
                    $pos_count = (count(unserialize(base64_decode($result[$a]['record_position'])))) -1;
                    $position =  unserialize(base64_decode($result[$a]['record_position']))[$pos_count];
                }else{
                    $position =  'Unassigned';
                }
                if ((is_array(unserialize(base64_decode($result[$a]['record_status']))) && count(unserialize(base64_decode($result[$a]['record_status']))) > 0 && unserialize(base64_decode($result[$a]['record_status']))[0] != '')) {
                    $stat_count = (count(unserialize(base64_decode($result[$a]['record_status'])))) -1;
                    $status =  unserialize(base64_decode($result[$a]['record_status']))[$stat_count];
                }else{
                    $status =  'Unassigned';
                }
                $data = array(
                    'employee_code' => $result[$a]['PK_employee_code'],
                    'emp_wname'     => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).'. '.$result[$a]['emp_NameExt'],
                    'section'       => $section,
                    'position'      => $position,
                    'status'        => $status,
                    'mobile_no'     => $result[$a]['emp_mobno'],
                    'email'         => $result[$a]['emp_email'],
                    'picture'       => $result[$a]['emp_picture']
                );

                if($section == $section_FK){
                    array_push($masterlist, $data);
                }
            }
            // var_dump($masterlist);
            // exit();
            return $masterlist;
        }

        public function get_section_regular_members($employee_code){
            $this->db->select('sec.section_name');
            $this->db->from('tbl_section sec');
            $this->db->where('sec.FK_employee_code',$employee_code);
            $section_arr = $this->db->get()->row();
            $section_FK = $section_arr->section_name;
            $this->db->select('emp.PK_employee_code,emp.emp_picture, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, emp.emp_mobno, emp.emp_email, rec.record_section, rec.record_position, rec.record_status, user.FK_employee_code, user.user_status');
            $this->db->from('tbl_employee emp');
            $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
            $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
            $this->db->where('user.user_status','Active');
            $this->db->where('emp.PK_employee_code !=','00000');
            $this->db->where('emp.PK_employee_code !=',$employee_code);
            $query = $this->db->get();
            $result = $query->result_array();
            $rows = count($result);
            $masterlist = array();
            for($a=0;$a<=($rows-1);$a++){
                if ((is_array(unserialize(base64_decode($result[$a]['record_section']))) && count(unserialize(base64_decode($result[$a]['record_section']))) > 0 && unserialize(base64_decode($result[$a]['record_section']))[0] != '')) {
                    $sec_count = (count(unserialize(base64_decode($result[$a]['record_section'])))) -1;
                    $section =  unserialize(base64_decode($result[$a]['record_section']))[$sec_count];
                }else{
                    $section =  'Unassigned';
                }
                if ((is_array(unserialize(base64_decode($result[$a]['record_position']))) && count(unserialize(base64_decode($result[$a]['record_position']))) > 0 && unserialize(base64_decode($result[$a]['record_position']))[0] != '')) {
                    $pos_count = (count(unserialize(base64_decode($result[$a]['record_position'])))) -1;
                    $position =  unserialize(base64_decode($result[$a]['record_position']))[$pos_count];
                }else{
                    $position =  'Unassigned';
                }
                if ((is_array(unserialize(base64_decode($result[$a]['record_status']))) && count(unserialize(base64_decode($result[$a]['record_status']))) > 0 && unserialize(base64_decode($result[$a]['record_status']))[0] != '')) {
                    $stat_count = (count(unserialize(base64_decode($result[$a]['record_status'])))) -1;
                    $status =  unserialize(base64_decode($result[$a]['record_status']))[$stat_count];
                }else{
                    $status =  'Unassigned';
                }

                $data = array(
                    'employee_code' => $result[$a]['PK_employee_code'],
                    'emp_wname'     => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).'. '.$result[$a]['emp_NameExt'],
                    'section'       => $section,
                    'position'      => $position,
                    'status'        => $status,
                    'mobile_no'     => $result[$a]['emp_mobno'],
                    'email'         => $result[$a]['emp_email'],
                    'picture'       => $result[$a]['emp_picture']
                );
                if($section == $section_FK){
                    if($status == 'Regular'){
                        array_push($masterlist, $data);
                    }
                }
            }
            // var_dump($masterlist);
            // exit();
            return $masterlist;
        }
}