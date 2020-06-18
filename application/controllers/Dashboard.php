<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
        public function __construct()
	{
                date_default_timezone_set('Asia/Manila');
		parent::__construct();
                $this->load->model('Dashboard_management_model','damm');
        }
	public function index()
	{
                $usertype = $this->session->userdata('usertype');
                if ($this->session->userdata('employee_code')) {
                        switch ($usertype) {
                                case "Administrator";
                                        $this->load->model('Leave_management_model','lmm');
                                        $header['title_page'] = "Admin Dashboard";
                                        $data['limit_leave'] = $this->lmm->leave_limit();
                                        $this->load->view('admin/fragments/admin_header',$header);
                                        $this->load->view('admin/fragments/admin_navbar');
                                        $this->load->view('admin/admin_dashboard',$data);
                                        $this->load->view('admin/fragments/admin_r_sidebar');
                                        $this->load->view('admin/fragments/admin_footer.php');
                                break;
                                case "President";
                                        $header['title_page'] = "President Dashboard";
                                        $data[] = "";
                                        $this->load->view('oic/fragments/oic_header',$header);
                                        $this->load->view('oic/fragments/oic_navbar');
                                        $this->load->view('oic/oic_dashboard',$data);
                                        $this->load->view('oic/fragments/oic_r_sidebar');
                                        $this->load->view('oic/fragments/oic_footer.php');
                                break;
                                case "HR";
                                        $header['title_page'] = "Dashboard";
                                        $data[] = "";
                                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                                        $this->load->view('hr_payroll/payroll_dashboard',$data);
                                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                                break;
                                case "Payroll";
                                        $header['title_page'] = "Dashboard";
                                        $data[] = "";
                                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                                        $this->load->view('hr_payroll/payroll_dashboard',$data);
                                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                                break;
                                case "Section";
                                        $header['title_page'] = "Dashboard";
                                        $data[] = "";
                                        $this->load->view('section_head/fragments/section_header',$header);
                                        $this->load->view('section_head/fragments/section_navbar');
                                        $this->load->view('section_head/section_dashboard',$data);
                                        $this->load->view('section_head/fragments/section_r_sidebar');
                                        $this->load->view('section_head/fragments/section_footer.php');
                                break;
                                case "Employee";
                                        $header['title_page'] = "Employee Dashboard";
                                        $data[] = "";
                                        $this->load->view('employee/fragments/employee_header',$header);
                                        $this->load->view('employee/fragments/employee_navbar');
                                        $this->load->view('employee/employee_dashboard',$data);
                                        $this->load->view('employee/fragments/employee_r_sidebar');
                                        $this->load->view('employee/fragments/employee_footer.php');
                                break;
                            }   
                    } else {
                        Redirect(base_url('HRMISystem'));
                    }
	}
}
