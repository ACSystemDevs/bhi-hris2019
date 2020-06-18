<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // EMPLOYEE PROFILE SAVING
    public function save_leave_type($leave_data)
    {
        $this->db->insert('tbl_leave_type',$leave_data);
    }

    public function get_active_leavetype()
    {
        $this->db->from('tbl_leave_type leave');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_allotted_leave($employee_code)
    {
        $this->db->from('tbl_leave_type type');
        $this->db->join('tbl_employee_leave emp_leave','type.PK_leave_ID = emp_leave.FK_leave_ID','left');
        $this->db->where('emp_leave.FK_employee_code',$employee_code);
        $this->db->where('emp_leave.credit_year',date('Y'));
        $query = $this->db->get();
        return $query->result();
    }
    public function get_leave_history($employee_code){
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_leave_request req','req.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_leave_type type','req.FK_leave_ID = type.PK_leave_ID','left');
        $this->db->where('emp.PK_employee_code',$employee_code);
        $this->db->order_by('req.Leave_Date_Filed','desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_leave_credit($employee_code){
        $this->db->from('tbl_employee_leave e_leave');
        $this->db->join('tbl_employee emp','e_leave.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_leave_type type','e_leave.FK_leave_ID = type.PK_leave_ID','left');
        $this->db->like('e_leave.credit_year',date('Y'));
        $this->db->where('emp.PK_employee_code',$employee_code);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_leave_credit_prev($employee_code){
        $this->db->from('tbl_employee_leave e_leave');
        $this->db->join('tbl_employee emp','e_leave.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_leave_type type','e_leave.FK_leave_ID = type.PK_leave_ID','left');
        $this->db->like('e_leave.credit_year',date('Y',strtotime('-1 year')));
        $this->db->where('emp.PK_employee_code',$employee_code);
        $query = $this->db->get();
        return $query->result();
    }

    public function request_leave_function($request_details)
    {
        $this->db->insert('tbl_leave_request',$request_details);
    }

    public function get_leave_request_current_month(){
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_leave_request req','emp.PK_employee_code = req.FK_employee_code','left');
        $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','left');
        // $this->db->like('req.Leave_Date_Start',date('Y-m'));
        // $this->db->or_like('req.Leave_Date_Filed',date('Y-m'));
        $this->db->order_by('req.Leave_Date_Start','asc');
        $this->db->order_by('req.Leave_Date_Filed','desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_leave_request_current_month_byID($employee_code){
        $this->db->from('tbl_leave_request req');
        $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','left');
        $this->db->where('req.FK_employee_code',$employee_code);
        $this->db->order_by('req.Leave_Date_Start','desc');
        $this->db->order_by('req.Leave_Date_Filed','desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_leave_request_current_month_section($employee_code){
        $this->db->select('sec.section_name');
        $this->db->from('tbl_section sec');
        $this->db->where('sec.FK_employee_code',$employee_code);
        $section_arr = $this->db->get()->row();
        $section_FK = $section_arr->section_name;
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_leave_request req','emp.PK_employee_code = req.FK_employee_code','left');
        $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','left');
        $this->db->like('req.Leave_Date_Start',date('Y-m'));
        $this->db->or_like('req.Leave_Date_Filed',date('Y-m'));
        $this->db->order_by('req.Leave_Date_Start','asc');
        $this->db->order_by('req.Leave_Date_Filed','desc');
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
            $leave_data = array(
                'request_id'        => $result[$a]['PK_request_ID'],
                'leave_id'          => $result[$a]['PK_leave_ID'],
                'employee_code'     => $result[$a]['PK_employee_code'],
                'emp_wname'         => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).' '.$result[$a]['emp_NameExt'],
                'date_filed'        => date('F d,Y', strtotime($result[$a]['Leave_Date_Filed'])),
                'inclusive_dates'   => date('F d,Y', strtotime($result[$a]['Leave_Date_Start'])).' - '.date('F d,Y', strtotime($result[$a]['Leave_Date_End'])),
                'leave_type'        => $result[$a]['leave_type'],
                'leave_status'      => $result[$a]['Leave_Status']
            );
            if($section == $section_FK){
                    array_push($masterlist, $leave_data);
            }
        }
        return $masterlist;
    }
    public function get_leave_request_all(){
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_leave_request req','emp.PK_employee_code = req.FK_employee_code','inner');
        $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','inner');
        $this->db->order_by('req.Leave_Date_Start','asc');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_leave_request_info_byID($request_id){
        $this->db->select('req.PK_request_ID, req.FK_leave_ID, req.FK_employee_code, req.Leave_Date_Filed, req.Leave_Date_Start, req.Leave_Date_End, req.Leave_Address, req.Leave_Reason, req.Leave_Status, req.Leave_no_days, emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, emp.emp_picture , type.PK_leave_ID, type.leave_type');
        $this->db->from('tbl_leave_request req');
        $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','left');
        $this->db->join('tbl_employee emp','emp.PK_employee_code = req.FK_employee_code','left');
        $this->db->where('req.PK_request_ID',$request_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_leave_credit_info_byID($emp_leave_ID)
    {
        $this->db->from('tbl_employee_leave e_leave');
        $this->db->join('tbl_leave_type type','e_leave.FK_leave_ID = type.PK_leave_ID','left');
        $this->db->where('e_leave.PK_emp_leave_ID',$emp_leave_ID);
        $query = $this->db->get();
        return $query->row();
    }


    public function update_leave_request($where, $data)
    {
        $this->db->update('tbl_leave_request', $data, $where);
    }

    public function update_leave_credit($where, $data)
    {
        $this->db->update('tbl_employee_leave', $data, $where);
    }

    public function get_all_leave_type()
    {
        $this->db->from('tbl_leave_type type');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_leave_credit_to_employee($data)
    {
        $this->db->insert('tbl_employee_leave',$data);
    }
    public function get_leave_record($leave_id, $employee_code,$request_id)
    {
        $this->db->from('tbl_employee_leave leave');
        $this->db->join('tbl_leave_request req','leave.FK_leave_ID = req.FK_leave_ID','left');
        $this->db->where('leave.FK_leave_ID', $leave_id);
        $this->db->where('leave.FK_employee_code', $employee_code);
        $this->db->where('req.PK_request_ID',$request_id);
        $this->db->where('leave.credit_year', date('Y'));
        $query = $this->db->get();
        return $query->row();
    }

    public function count_leave_by_status_all(){
        $this->db->from('tbl_leave_request req');
        $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','left');
        $this->db->like('req.Leave_Date_Filed',date('Y-m'));
        $this->db->like('req.Leave_Date_Start',date('m'),'after');
        $this->db->like('req.Leave_Date_Start',date('Y'),'before');
        $query = $this->db->get()->result();
        return count($query);
    }
    public function count_leave_by_status_pending(){
        $this->db->from('tbl_leave_request req');
        $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','left');
        $this->db->like('req.Leave_Date_Filed',date('Y-m'));
        $this->db->like('req.Leave_Date_Start',date('m'),'after');
        $this->db->like('req.Leave_Date_Start',date('Y'),'before');
        $this->db->where('req.Leave_Status !=','Noted');
        $this->db->where('req.Leave_Status !=','Denied');
        $query = $this->db->get()->result();
        return count($query);
    }
    public function count_leave_by_status_approved(){
        $this->db->from('tbl_leave_request req');
        $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','left');
        $this->db->like('req.Leave_Date_Filed',date('Y-m'));
        $this->db->like('req.Leave_Date_Start',date('m'),'after');
        $this->db->like('req.Leave_Date_Start',date('Y'),'before');
        $this->db->where('req.Leave_Status','Noted');
        $query = $this->db->get()->result();
        return count($query);
    }
    public function count_leave_by_status_denied(){
        $this->db->from('tbl_leave_request req');
        $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','left');
        $this->db->like('req.Leave_Date_Filed',date('Y-m'));
        $this->db->like('req.Leave_Date_Start',date('m'),'after');
        $this->db->like('req.Leave_Date_Start',date('Y'),'before');
        $this->db->where('req.Leave_Status','Denied');
        $query = $this->db->get()->result();
        return count($query);
    }


    // FOR DASHBOARD
    public function leave_limit(){
        $this->db->from('tbl_leave_request req');
        $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','left');
        $this->db->join('tbl_employee_leave leave','leave.FK_leave_ID = type.PK_leave_ID','left');
        $this->db->join('tbl_employee emp','leave.FK_employee_code = emp.PK_employee_code','left');
        $this->db->where('leave.credit_year', date('Y'));
        $this->db->like('req.Leave_Date_Filed',date('Y-m'));
        $this->db->like('req.Leave_Date_Start',date('m'),'after');
        $this->db->like('req.Leave_Date_Start',date('Y'),'before');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
}