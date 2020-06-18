<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {
        public function __construct()
	{
                date_default_timezone_set('Asia/Manila');
                parent::__construct();
                $this->load->model('Leave_management_model','lmm');
        }
	public function admin_leave_application()
	{
                if ($this->session->userdata('employee_code')) {
                $header['title_page'] = "Leave Requests";
                $data['leave_request'] = $this->lmm->get_leave_request_current_month();
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_view_leave',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }elseif($usertype == 'Section'){
                        $this->load->view('section_head/fragments/section_header',$header);
                        $this->load->view('section_head/fragments/section_navbar');
                        $this->load->view('section_head/section_view_leave',$data);
                        $this->load->view('section_head/fragments/section_r_sidebar');
                        $this->load->view('section_head/fragments/section_footer.php');
                }elseif($usertype == 'President'){
                        $this->load->view('oic/fragments/oic_header',$header);
                        $this->load->view('oic/fragments/oic_navbar');
                        $this->load->view('oic/oic_view_leave',$data);
                        $this->load->view('oic/fragments/oic_r_sidebar');
                        $this->load->view('oic/fragments/oic_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_view_leave',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
                
        }

        public function section_leave_application(){
                if ($this->session->userdata('employee_code')) {
                        $employee_code = $this->session->userdata('employee_code');
                        $header['title_page'] = "Leave Requests";
                        $data['leave_request'] = $this->lmm->get_leave_request_current_month_section($employee_code);
                        $usertype = $this->session->userdata('usertype');if($usertype == 'Section'){
                                $this->load->view('section_head/fragments/section_header',$header);
                                $this->load->view('section_head/fragments/section_navbar');
                                $this->load->view('section_head/section_view_leave',$data);
                                $this->load->view('section_head/fragments/section_r_sidebar');
                                $this->load->view('section_head/fragments/section_footer.php');
                        }else{
                                $this->load->view('hr_payroll/fragments/payroll_header',$header);
                                $this->load->view('hr_payroll/fragments/payroll_navbar');
                                $this->load->view('hr_payroll/payroll_view_leave',$data);
                                $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                                $this->load->view('hr_payroll/fragments/payroll_footer.php');
                        }
                } else {
                        Redirect(base_url('HRMISystem'));
                }
        }
        public function admin_leave_archives()
        {
                if ($this->session->userdata('employee_code')) {
                $header['title_page'] = "Leave Archives";
                $data['leave_archive'] = $this->lmm->get_leave_request_all();
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_view_leave_archives',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_view_leave_archives',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }
        public function admin_request_leave()
        {
                if ($this->session->userdata('employee_code')) {
                $this->load->model('Employee_management_model','emm');
                $header['title_page'] = "Regular Employee List";
                $data['regular_employee'] = $this->emm->get_hired_employee();
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_view_regular_employee',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_view_regular_employee',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }
        public function admin_add_leave()
	{
                if ($this->session->userdata('employee_code')) {
                $header['title_page'] = "Manage Leave";
                $data['leavetype'] = $this->lmm->get_active_leavetype();
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_add_leave',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_add_leave',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }
        
        public function add_leave_function()
        {
                $this->form_validation->set_rules('form_leave_type', 'Leave Type', 'xss_clean|trim|required', array('required' => '%s'));
                $this->form_validation->set_rules('form_leave_default', 'Default Credit', 'xss_clean|trim|required', array('required' => '%s'));

                if ($this->form_validation->run() == false) {
                $error['error_msg'] = 'Adding Leave Type Error';
                $error['title'] = 'Add Leave Type Error';
                $error['code'] = 'HRIS:Llmm|ref|XLn28';
                $error['module'] ='Leave Module';
                $this->load->view('hris_errors/error_page',$error);
                } else {
                $leave_data = array(
                        'leave_type'            => strtoupper($this->input->post('form_leave_type')),
                        'leave_default_credit'  => strtoupper($this->input->post('form_leave_default')),
                        'leave_type_status'     => 'Active',
                );
                $this->lmm->save_leave_type($leave_data);
                redirect(base_url('Add-Leave-Type'));
                }
        }

        public function employee_request_leave()
        {       
                if ($this->session->userdata('employee_code')) {
                $employee_code = $this->uri->segment(2);
                $this->load->model('Employee_management_model','emm');
                $header['title_page'] = "Request Leave for ".$this->emm->get_employee_wname($employee_code);
                $data['emp_wname'] = $this->emm->get_employee_wname($employee_code);
                $data['profile'] = $this->emm->get_employee_profile($employee_code);
                $data['emp_leave'] = $this->lmm->get_allotted_leave($employee_code);
                $data['leave_history'] = $this->lmm->get_leave_history($employee_code);
                $data['leave_credit'] = $this->lmm->get_leave_credit($employee_code);
                $data['leave_type'] = $this->lmm->get_all_leave_type();
                $data['employee_code'] = $employee_code;
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_employee_leave_request',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }elseif($usertype == 'Section'){
                        $this->load->view('section_head/fragments/section_header',$header);
                        $this->load->view('section_head/fragments/section_navbar');
                        $this->load->view('section_head/section_employee_leave_request',$data);
                        $this->load->view('section_head/fragments/section_r_sidebar');
                        $this->load->view('section_head/fragments/section_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_employee_leave_request',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }

        public function request_leave_function(){
                $employee_code = $this->uri->segment(2);
                $this->form_validation->set_rules('form_leave_type', 'Leave Type', 'xss_clean|trim|required', array('required' => '%s'));
                $this->form_validation->set_rules('form_leave_no_days', 'No of Days', 'xss_clean|trim|required', array('required' => '%s'));
                $this->form_validation->set_rules('form_leave_sdate', 'Start Date', 'xss_clean|trim|required', array('required' => '%s'));
                $this->form_validation->set_rules('form_leave_edata', 'End Date', 'xss_clean|trim|required', array('required' => '%s'));
                $this->form_validation->set_rules('form_leave_address', 'Address', 'xss_clean|trim');
                $this->form_validation->set_rules('form_leave_reason', 'Reason', 'xss_clean|trim');
                if ($this->form_validation->run() == false) {
                $error['error_msg'] = 'Incomplete Data';
                $error['title'] = 'Request Leave Error';
                $error['code'] = 'HRIS:Llmm|ref|XLn145';
                $error['module'] ='Leave';
                $this->load->view('hris_errors/error_page',$error);
                } else {
                                $request_details = array(
                                        'FK_employee_code'   => $employee_code,
                                        'FK_leave_ID'        => $this->input->post('form_leave_type'),
                                        'Leave_Date_Filed'   => date('Y-m-d'),
                                        'Leave_Date_Start'   => $this->input->post('form_leave_sdate'),
                                        'Leave_Date_End'     => $this->input->post('form_leave_edata'),
                                        'Leave_no_days'      => $this->input->post('form_leave_no_days'),
                                        'Leave_Address'      => $this->input->post('form_leave_address'),
                                        'Leave_Reason'       => $this->input->post('form_leave_reason'),
                                        'Leave_Status'       => 'Pending'
                                );
                                $this->lmm->request_leave_function($request_details);
                                redirect(base_url('Request-Leave/'.$employee_code));
                }
        }

        public function leave_request_view($request_id)
        {
                $data = $this->lmm->get_leave_request_info_byID($request_id);
                echo json_encode($data);
        }

        public function admin_leave_noted_request($request_id, $employee_code, $leave_id)
        {
                $data = array(
                        'Leave_Status' => 'Noted',
                        'Date_Recommended' => date('Y-m-d'),
                        'FK_Recommended_By' => '00000',
                        'Date_Approved' => date('Y-m-d'),
                        'FK_Approved_By' => '00000',
                        'Date_Noted' => date('Y-m-d'),
                        'FK_Noted_By' => '00000'
                );
                $where = array(
                        'PK_request_ID' => $request_id
                );
                $credit = $this->lmm->get_leave_record($leave_id, $employee_code,$request_id);
                $leave_credit = array(
                        'days_consumed' => ($credit->days_consumed) + ($credit->Leave_no_days),
                        'remaining_days' => floatval($credit->remaining_days) - floatval($credit->Leave_no_days)
                    );
                $emp_leave_id = array(
                        'PK_emp_leave_ID' => $credit->PK_emp_leave_ID
                    );
                $this->lmm->update_leave_request($where, $data);
                $this->lmm->update_leave_credit($emp_leave_id, $leave_credit);
        }
        public function admin_leave_denied_noted_request($request_id, $employee_code, $leave_id)
        {
                $data = array(
                        'Leave_Status' => 'Denied',
                        'Date_Recommended' => date('Y-m-d'),
                        'FK_Recommended_By' => '00000',
                        'Date_Approved' => date('Y-m-d'),
                        'FK_Approved_By' => '00000',
                        'Date_Noted' => date('Y-m-d'),
                        'FK_Noted_By' => '00000'
                );
                $where = array(
                        'PK_request_ID' => $request_id
                );
                $credit = $this->lmm->get_leave_record($leave_id, $employee_code,$request_id);
                $leave_credit = array(
                        'days_consumed' => $credit->days_consumed - $credit->Leave_no_days,
                        'remaining_days' => floatval($credit->remaining_days) + floatval($credit->Leave_no_days)
                    );
                $emp_leave_id = array(
                        'PK_emp_leave_ID' => $credit->PK_emp_leave_ID
                    );
                $this->lmm->update_leave_request($where, $data);
                $this->lmm->update_leave_credit($emp_leave_id, $leave_credit);
        }

        public function admin_leave_denied_request($request_id)
        {
                $data = array(
                        'Leave_Status' => 'Denied',
                        'Date_Recommended' => date('Y-m-d'),
                        'FK_Recommended_By' => '00000',
                        'Date_Approved' => date('Y-m-d'),
                        'FK_Approved_By' => '00000',
                        'Date_Noted' => date('Y-m-d'),
                        'FK_Noted_By' => '00000'
                );
                $where = array(
                        'PK_request_ID' => $request_id
                );
                $this->lmm->update_leave_request($where, $data);
        }
        public function add_leave_credit()
        {
                $employee_code = $this->uri->segment(2);
                $this->form_validation->set_rules('add_leave_type', 'Leave Type', 'xss_clean|trim|required', array('required' => '%s'));
                $this->form_validation->set_rules('add_leave_days', 'No of Days', 'xss_clean|trim|required', array('required' => '%s'));
                $this->form_validation->set_rules('add_leave_year', 'Year', 'xss_clean|trim|required', array('required' => '%s'));
                if ($this->form_validation->run() == false) {
                $error['error_msg'] = 'Add Leave Credit Error';
                $error['title'] = 'Add Leave Credit Error';
                $error['code'] = 'HRIS:Llmm|ref|XLn165';
                $error['module'] ='Leave';
                $this->load->view('hris_errors/error_page',$error);
                } else{
                        $data = array(
                                'FK_employee_code' => $employee_code,
                                'FK_leave_id' => $this->input->post('add_leave_type'),
                                'emp_leave_credit' => floatval($this->input->post('add_leave_days')),
                                'credit_year' => $this->input->post('add_leave_year'),
                                'days_consumed' => '0',
                                'remaining_days' => floatval($this->input->post('add_leave_days'))
                        );

                $this->lmm->add_leave_credit_to_employee($data);
                redirect(base_url('Request-Leave/'.$employee_code));
                }
        }

        public function edit_leave_credit($employee_code){
                $data = array(
                        'emp_leave_credit' => $this->input->post('edit_leave_days'),
                        'credit_year' => $this->input->post('edit_leave_year'),
                        'remaining_days' => floatval($this->input->post('edit_leave_days')) - floatval($this->input->post('days_consumed'))
                );
                $where = array(
                        'PK_emp_leave_ID' => $this->input->post('emp_leave_id')
                );
                $this->lmm->update_leave_credit($where, $data);
                redirect(base_url('Request-Leave/'.$employee_code));
        }

        public function leave_credit_view($emp_leave_ID){

                $data = $this->lmm->get_leave_credit_info_byID($emp_leave_ID);
                echo json_encode($data);
        }
        //EMPLOYEE REQUEST LEAVE
        public function employee_request_personal_leave()
        {
                if ($this->session->userdata('employee_code')) {
                $employee_code = $this->uri->segment(2);
                $this->load->model('Employee_management_model','emm');
                $header['title_page'] = $this->emm->get_employee_wname($employee_code);
                $data['emp_wname'] = $this->emm->get_employee_wname($employee_code);
                $data['profile'] = $this->emm->get_employee_profile($employee_code);
                $data['emp_leave'] = $this->lmm->get_allotted_leave($employee_code);
                $data['leave_history'] = $this->lmm->get_leave_history($employee_code);
                $data['leave_credit'] = $this->lmm->get_leave_credit($employee_code);
                $data['leave_type'] = $this->lmm->get_all_leave_type();
                $data['employee_code'] = $employee_code;
                $this->load->view('employee/fragments/employee_header',$header);
                $this->load->view('employee/fragments/employee_navbar');
                $this->load->view('employee/employee_employee_leave_request',$data);
                $this->load->view('employee/fragments/employee_r_sidebar');
                $this->load->view('employee/fragments/employee_footer.php');
                } else {
                        Redirect(base_url('HRMISystem'));
                }
        }

        public function view_leave_request_section(){
                if ($this->session->userdata('employee_code')) {
                        $employee_code = $this->session->userdata('employee_code');
                        $this->load->model('Employee_management_model','emm');
                        $header['title_page'] = "Regular Employee List";
                        $data['masterlist_regular'] = $this->emm->get_section_regular_members($employee_code);
                        $usertype = $this->session->userdata('usertype');
                        $this->load->view('section_head/fragments/section_header',$header);
                        $this->load->view('section_head/fragments/section_navbar');
                        $this->load->view('section_head/section_view_regular_employee',$data);
                        $this->load->view('section_head/fragments/section_r_sidebar');
                        $this->load->view('section_head/fragments/section_footer.php');
                } else {
                        Redirect(base_url('HRMISystem'));
                }
        }
        public function section_leave_approve_request($request_id)
        {
                $employee_code = $this->session->userdata('employee_code');
                $data = array(
                        'Leave_Status' => 'Recommended',
                        'Date_Recommended' => date('Y-m-d'),
                        'FK_Recommended_By' => $employee_code,
                );
                $where = array(
                        'PK_request_ID' => $request_id
                );
                $this->lmm->update_leave_request($where, $data);
        }
        public function section_leave_disapprove_request($request_id)
        {
                $employee_code = $this->session->userdata('employee_code');
                $data = array(
                        'Leave_Status' => 'Disapproved_Head',
                        'Date_Recommended' => date('Y-m-d'),
                        'FK_Recommended_By' => $employee_code,
                );
                $where = array(
                        'PK_request_ID' => $request_id
                );
                $this->lmm->update_leave_request($where, $data);
        }
        public function hr_leave_approve_request($request_id)
        {
                $employee_code = $this->session->userdata('employee_code');
                $data = array(
                        'Leave_Status' => 'Approved',
                        'Date_Approved' => date('Y-m-d'),
                        'FK_Approved_By' => $employee_code,
                );
                $where = array(
                        'PK_request_ID' => $request_id
                );
                $this->lmm->update_leave_request($where, $data);
        }
        public function hr_leave_disapprove_request($request_id)
        {
                $employee_code = $this->session->userdata('employee_code');
                $data = array(
                        'Leave_Status' => 'Disapproved_HR',
                        'Date_Approved' => date('Y-m-d'),
                        'FK_Approved_By' => $employee_code,
                );
                $where = array(
                        'PK_request_ID' => $request_id
                );
                $this->lmm->update_leave_request($where, $data);
        }
        public function oic_leave_approve_request($request_id)
        {
                $employee_code = $this->session->userdata('employee_code');
                $data = array(
                        'Leave_Status' => 'Noted',
                        'Date_Noted' => date('Y-m-d'),
                        'FK_Noted_By' => $employee_code,
                );
                $where = array(
                        'PK_request_ID' => $request_id
                );
                $this->lmm->update_leave_request($where, $data);
        }
        public function oic_leave_disapprove_request($request_id)
        {
                $employee_code = $this->session->userdata('employee_code');
                $data = array(
                        'Leave_Status' => 'Disapproved_Pres',
                        'Date_Noted' => date('Y-m-d'),
                        'FK_Noted_By' => $employee_code,
                );
                $where = array(
                        'PK_request_ID' => $request_id
                );
                $this->lmm->update_leave_request($where, $data);
        }

        public function employee_leave_application($employee_code){
                if ($this->session->userdata('employee_code')) {
                        $header['title_page'] = "My Leave History";
                        $data['leave_request'] = $this->lmm->get_leave_request_current_month_byID($employee_code);
                        $data['leave_history'] = $this->lmm->get_leave_history($employee_code);
                        $data['leave_credit'] = $this->lmm->get_leave_credit($employee_code);
                        $usertype = $this->session->userdata('usertype');
                                $this->load->view('employee/fragments/employee_header',$header);
                                $this->load->view('employee/fragments/employee_navbar');
                                $this->load->view('employee/employee_view_leave',$data);
                                $this->load->view('employee/fragments/employee_r_sidebar');
                                $this->load->view('employee/fragments/employee_footer.php');
                } else {
                        Redirect(base_url('HRMISystem'));
                }
        }
}
