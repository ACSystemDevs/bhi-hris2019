<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct()
	{
            date_default_timezone_set('Asia/Manila');
            parent::__construct();
            $this->load->model('Account_management_model','amm');
    }
	public function admin_manage_user()
	{
        if ($this->session->userdata('employee_code')) {        
        $this->load->model('Employee_management_model','emm');
                $header['title_page'] = "Manage User";
                $data['users'] = $this->amm->get_all_useraccount();
                $data['active_employee'] = $this->emm->get_active_employees();
                $this->load->view('admin/fragments/admin_header',$header);
                $this->load->view('admin/fragments/admin_navbar');
                $this->load->view('admin/admin_manage_user',$data);
                $this->load->view('admin/fragments/admin_r_sidebar');
                $this->load->view('admin/fragments/admin_footer.php');
            } else {
                Redirect(base_url('HRMISystem'));
            }
    }

    public function add_user_function()
    {
        $this->form_validation->set_rules('form_employee_account', 'Employee Name', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('form_username', 'Username', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('form_usertype', 'Usertpye', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('form_password', 'Password', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('form_confirm_password', 'Confirm Password', 'xss_clean|trim|required|matches[form_password]', array('matches' => 'Password does not match'));
        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Adding New User Error';
            $error['title'] = 'Add New User Error';
            $error['code'] = 'HRIS:Uamm|ref|XLn21';
            $error['module'] ='User Account';
            $this->load->view('hris_errors/error_page',$error);
        } else {
            $useraccount_details = array(
                'FK_employee_code'  => $this->input->post('form_employee_code'),
                'Username'          => $this->input->post('form_username'),
                'Password'          => $this->input->post('form_password'),
                'user_usertype'     => $this->input->post('form_usertype'),
                'user_status'       => 'Active'
            );
            $this->amm->save_employee_useraccount($useraccount_details);
            redirect(base_url('Manage-Users'));
        }
    }

    public function useraccount_details_byID($user_id){
        $data = $this->amm->get_useraccount_details_byID($user_id);
        echo json_encode($data);
    }

    public function save_useraccount_changes(){
        $this->form_validation->set_rules('modal_form_username', 'Username', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('modal_form_usertype', 'Usertype', 'xss_clean|trim|required', array('required' => '%s'));
        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Edit  User Error';
            $error['title'] = 'Edit User Error';
            $error['code'] = 'HRIS:Uamm|ref|XLn55';
            $error['module'] ='User Account';
            $this->load->view('hris_errors/error_page',$error);
        } else {
            $useraccount_details = array(
                'Username'          => $this->input->post('modal_form_username'),
                'user_usertype'     => $this->input->post('modal_form_usertype')
            );
            $where_ID = array (
                'PK_user_ID' => $this->input->post('modal_form_user_id')
            );

            $this->amm->update_employee_useraccount($where_ID,$useraccount_details);
            redirect(base_url('Manage-Users'));
        }
    }

    public function save_password_changes(){
        $this->form_validation->set_rules('form_password', 'Password', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('form_confirm_password', 'Confirm Password', 'xss_clean|trim|required|matches[form_password]', array('matches' => 'Password does not match'));
        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Edit  User Error';
            $error['title'] = 'Edit User Error';
            $error['code'] = 'HRIS:Uamm|ref|XLn55';
            $error['module'] ='User Account';
            $this->load->view('hris_errors/error_page',$error);
        } else {
            $useraccount_details = array(
                'Password'          => sha1(md5($this->input->post('form_password')))
            );
            $where_ID = array (
                'PK_user_ID' => $this->input->post('modal_form_user_id')
            );

            $this->amm->update_employee_useraccount($where_ID,$useraccount_details);
            redirect(base_url('Manage-Users'));
        }
    }

    public function account_status_inactive($user_id){
        $useraccount_details = array(
            'user_status'          => 'Inactive'
        );
        $where_ID = array (
            'PK_user_ID' => $user_id
        );
        $this->amm->update_employee_useraccount($where_ID,$useraccount_details);
        redirect(base_url('Manage-Users'));
    }

    public function account_status_active($user_id){
        $useraccount_details = array(
            'user_status'          => 'Active'
        );
        $where_ID = array (
            'PK_user_ID' => $user_id
        );
        $this->amm->update_employee_useraccount($where_ID,$useraccount_details);
        redirect(base_url('Manage-Users'));
    }

    public function others_update_username_password($employee_code){
        if ($this->session->userdata('employee_code')) {
            $usertype = $this->session->userdata('usertype');
            $data['account'] =  $this->amm->get_useraccount_details_by_FKID($employee_code);
            $header['title_page'] = 'My Account Settings';
            if($usertype == 'Section'){
                    $this->load->view('section_head/fragments/section_header',$header);
                    $this->load->view('section_head/fragments/section_navbar');
                    $this->load->view('account_settings',$data);
                    $this->load->view('section_head/fragments/section_r_sidebar');
                    $this->load->view('section_head/fragments/section_footer.php');
            }elseif($usertype == 'President'){
                    $this->load->view('oic/fragments/oic_header',$header);
                    $this->load->view('oic/fragments/oic_navbar');
                    $this->load->view('account_settings',$data);
                    $this->load->view('oic/fragments/oic_r_sidebar');
                    $this->load->view('oic/fragments/oic_footer.php');
            }elseif($usertype == 'Payroll' || $usertype == 'HR'){
                    $this->load->view('hr_payroll/fragments/payroll_header',$header);
                    $this->load->view('hr_payroll/fragments/payroll_navbar');
                    $this->load->view('account_settings',$data);
                    $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                    $this->load->view('hr_payroll/fragments/payroll_footer.php');
            }elseif($usertype == 'Employee'){
                    $this->load->view('employee/fragments/employee_header',$header);
                    $this->load->view('employee/fragments/employee_navbar');
                    $this->load->view('account_settings',$data);
                    $this->load->view('employee/fragments/employee_r_sidebar');
                    $this->load->view('employee/fragments/employee_footer.php');
            }else{
                Redirect(base_url('HRMISystem'));
            }
    } else {
            Redirect(base_url('HRMISystem'));
        }
    }

    public function account_settings_save_changes($user_id){
        $this->form_validation->set_rules('user_username', 'Username', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('user_password', 'Password', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('user_cpassword', 'Confirm Password', 'xss_clean|trim|required|matches[user_password]', array('matches' => 'Password does not match'));
        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Edit User Error';
            $error['title'] = 'Edit User Error';
            $error['code'] = 'HRIS:Uamm|ref|XLn164';
            $error['module'] ='User Account';
            $this->load->view('hris_errors/error_page',$error);
        } else {
            $useraccount_details = array(
                'Username' => $this->input->post('user_username'),
                'Password' => sha1(md5($this->input->post('user_password')))
            );
            $where_ID = array (
                'PK_user_ID' => $user_id
            );
            $this->amm->update_employee_useraccount($where_ID,$useraccount_details);
            redirect(base_url('Dashboard'));
        }
    }
}
