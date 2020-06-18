<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {
    public function __construct()
	{
        date_default_timezone_set('Asia/Manila');
		parent::__construct();
        $this->load->model('Attendance_management_model','atmm');
    }
	public function admin_view_employee_dtr()
	{
        if ($this->session->userdata('employee_code')) {
            $this->load->model('Employee_management_model','emm');
            $header['title_page'] = "Employee Attendance";
            $data['employee'] = $this->emm->get_active_employees();
            $usertype = $this->session->userdata('usertype');
            if($usertype == 'Administrator'){
                    $this->load->view('admin/fragments/admin_header',$header);
                    $this->load->view('admin/fragments/admin_navbar');
                    $this->load->view('admin/admin_view_employee_dtr',$data);
                    $this->load->view('admin/fragments/admin_r_sidebar');
                    $this->load->view('admin/fragments/admin_footer.php');
            }else{
                    $this->load->view('hr_payroll/fragments/payroll_header',$header);
                    $this->load->view('hr_payroll/fragments/payroll_navbar');
                    $this->load->view('hr_payroll/payroll_view_employee_dtr',$data);
                    $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                    $this->load->view('hr_payroll/fragments/payroll_footer.php');
            }
        } else {
            Redirect(base_url('HRMISystem'));
        }
    }

    public function admin_view_employee_dtr_prev()
	{
        if ($this->session->userdata('employee_code')) {
            $this->load->model('Employee_management_model','emm');
            $header['title_page'] = "Employee Attendance";
            $data['employee'] = $this->emm->get_active_employees();
            $usertype = $this->session->userdata('usertype');
            if($usertype == 'Administrator'){
                    $this->load->view('admin/fragments/admin_header',$header);
                    $this->load->view('admin/fragments/admin_navbar');
                    $this->load->view('admin/admin_view_employee_dtr_prev',$data);
                    $this->load->view('admin/fragments/admin_r_sidebar');
                    $this->load->view('admin/fragments/admin_footer.php');
            }else{
                    $this->load->view('hr_payroll/fragments/payroll_header',$header);
                    $this->load->view('hr_payroll/fragments/payroll_navbar');
                    $this->load->view('hr_payroll/payroll_view_employee_dtr_prev',$data);
                    $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                    $this->load->view('hr_payroll/fragments/payroll_footer.php');
            }
        } else {
            Redirect(base_url('HRMISystem'));
        }
    }
    public function admin_view_overtime_requests()
	{
        if ($this->session->userdata('employee_code')) {
                $header['title_page'] = "Overtime Requests";
                $data[] = "";
                $this->load->view('admin/fragments/admin_header',$header);
                $this->load->view('admin/fragments/admin_navbar');
                $this->load->view('admin/admin_view_overtime_request',$data);
                $this->load->view('admin/fragments/admin_r_sidebar');
                $this->load->view('admin/fragments/admin_footer.php');
            } else {
                Redirect(base_url('HRMISystem'));
            }
    }
    public function admin_view_exchange_duty_requests()
	{
        if ($this->session->userdata('employee_code')) {
                $header['title_page'] = "Exchange Duty Requests";
                $data[] = "";
                $this->load->view('admin/fragments/admin_header',$header);
                $this->load->view('admin/fragments/admin_navbar');
                $this->load->view('admin/admin_view_exchange_duty',$data);
                $this->load->view('admin/fragments/admin_r_sidebar');
                $this->load->view('admin/fragments/admin_footer.php');
            } else {
                Redirect(base_url('HRMISystem'));
            }
    }
    public function admin_view_workonoff_requests()
	{
        if ($this->session->userdata('employee_code')) {        
                $header['title_page'] = "Work-on-off Requests";
                $data[] = "";
                $this->load->view('admin/fragments/admin_header',$header);
                $this->load->view('admin/fragments/admin_navbar');
                $this->load->view('admin/admin_view_workonoff',$data);
                $this->load->view('admin/fragments/admin_r_sidebar');
                $this->load->view('admin/fragments/admin_footer.php');
            } else {
                Redirect(base_url('HRMISystem'));
            }
    }

    public function Calculate_attendance_by_Date(){
        $this->load->model('Employee_management_model','emm');
        if(null !==($this->input->post('att_reference_emp_code'))){
            $rec = array(
                'FK_Attendance_log_ID' => 'a'.date('Ymd').date('His').$this->input->post('att_reference_emp_code'),
                'FK_employee_code' => $this->input->post('att_reference_emp_code'),
                'Attendance_Date' => date('Y-m-d', strtotime($this->input->post('att_reference_date'))),
                'Attendance_Time' => date('H:i:s', strtotime($this->input->post('att_reference_time'))),
                'Attendance_State' => 0,
                'Attendance_Date_Updated' => date('Y-m-d')
            );
            $this->atmm->add_new_record($rec);
            $header['title_page'] = "Employee Attendance";
            $data['employee'] = $this->emm->get_active_employees();
            $this->load->view('admin/fragments/admin_header',$header);
            $this->load->view('admin/fragments/admin_navbar');
            $this->load->view('admin/admin_view_employee_dtr',$data);
            $this->load->view('admin/fragments/admin_r_sidebar');
            $this->load->view('admin/fragments/admin_footer.php');
        }else{  
                $employee_code = array(
                    'FK_employee_code' => $this->input->post('form_emp_code_att')
                );
                $dates =  array(
                    'Date_From' => $this->input->post('form_emp_att_from'),
                    'Date_To' => $this->input->post('form_emp_att_to')
                );
                    $data['att_log'] = $this->atmm->get_attendance_by_date_and_ID($employee_code, $dates);
                    $this->load->model('Employee_management_model','emm');
                    $header['title_page'] = "Employee Attendance";
                    $employee_code = $this->input->post('form_emp_code_att');
                    $data['employee'] = $this->emm->get_active_employees();
                    $data['active_emp'] = $this->emm->get_basic_employee_profile($employee_code);
                    $usertype = $this->session->userdata('usertype');
                    if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_view_attendance_result',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                    }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_view_attendance_result',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                    }

        }
    }
    public function Calculate_attendance_by_Date_prev(){
        $this->load->model('Employee_management_model','emm');
        if(null !==($this->input->post('att_reference_emp_code'))){
            $rec = array(
                'FK_Attendance_log_ID' => 'a'.date('Ymd').date('His').$this->input->post('att_reference_emp_code'),
                'FK_employee_code' => $this->input->post('att_reference_emp_code'),
                'Attendance_Date' => date('Y-m-d', strtotime($this->input->post('att_reference_date'))),
                'Attendance_Time' => date('H:i:s', strtotime($this->input->post('att_reference_time'))),
                'Attendance_State' => 0,
                'Attendance_Date_Updated' => date('Y-m-d')
            );
            $this->atmm->add_new_record_prev($rec);
            $header['title_page'] = "Employee Attendance";
            $data['employee'] = $this->emm->get_active_employees();
            $this->load->view('admin/fragments/admin_header',$header);
            $this->load->view('admin/fragments/admin_navbar');
            $this->load->view('admin/admin_view_employee_dtr',$data);
            $this->load->view('admin/fragments/admin_r_sidebar');
            $this->load->view('admin/fragments/admin_footer.php');
        }else{  
                $employee_code = array(
                    'FK_employee_code' => $this->input->post('form_emp_code_att')
                );
                $dates =  array(
                    'Date_From' => $this->input->post('form_emp_att_from'),
                    'Date_To' => $this->input->post('form_emp_att_to')
                );
                    $data['att_log'] = $this->atmm->get_attendance_by_date_and_ID_prev($employee_code, $dates);
                    $this->load->model('Employee_management_model','emm');
                    $header['title_page'] = "Employee Attendance";
                    $employee_code = $this->input->post('form_emp_code_att');
                    $data['employee'] = $this->emm->get_active_employees();
                    $data['active_emp'] = $this->emm->get_basic_employee_profile($employee_code);
                    $usertype = $this->session->userdata('usertype');
                    if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_view_attendance_result_prev',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                    }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_view_attendance_result_prev',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                    }

        }
    }

}
