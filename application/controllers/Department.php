<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {
    public function __construct()
	{
            date_default_timezone_set('Asia/Manila');
            parent::__construct();
            $this->load->model('Employee_management_model','emm');
            $this->load->model('Department_management_model','dmm');
    }
	public function admin_manage_department()
	{
        if ($this->session->userdata('employee_code')) {    
        $header['title_page'] = "Manage Department";
            $data['active_employee'] = $this->emm->get_active_employees();
            $data['department'] = $this->dmm->get_active_department();
            $this->load->view('admin/fragments/admin_header',$header);
            $this->load->view('admin/fragments/admin_navbar');
            $this->load->view('admin/admin_manage_department',$data);
            $this->load->view('admin/fragments/admin_r_sidebar');
            $this->load->view('admin/fragments/admin_footer.php');
        } else {
            Redirect(base_url('HRMISystem'));
        }
    }

    public function add_department_function()
    {
        // WORK EXPERIENCE
        $this->form_validation->set_rules('form_department_name', 'Department Name', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('form_department_head_ID', 'Department Head', 'xss_clean|trim|required', array('required' => '%s'));
        
        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Adding Department Error';
            $error['title'] = 'Add Department Error';
            $error['code'] = 'HRIS:Ddmm|ref|XLn33';
            $error['module'] ='Department Module';
            $this->load->view('hris_errors/error_page',$error);
        } else {
            $dept_details = array(
                'department_name'   => strtoupper($this->input->post('form_department_name')),
                'department_status' => 'Active',
                'FK_employee_code'  => $this->input->post('form_department_head_ID')
            );
            $this->dmm->save_department_details($dept_details);
            redirect(base_url('Manage-Department'));
        }
    }

    public function update_department_function($department_ID)
    {
        // WORK EXPERIENCE
        $this->form_validation->set_rules('edit_form_department_name', 'Department Name', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('edit_form_department_head_ID', 'Department Head', 'xss_clean|trim|required', array('required' => '%s'));
        
        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Updating Department Error';
            $error['title'] = 'Update Department Error';
            $error['code'] = 'HRIS:Ddmm|ref|XLn46';
            $error['module'] ='Department Module';
            $this->load->view('hris_errors/error_page',$error);
        } else {
            $dept_details = array(
                'department_name'   => strtoupper($this->input->post('edit_form_department_name')),
                'department_status' => 'Active',
                'FK_employee_code'  => $this->input->post('edit_form_department_head_ID')
            );

            $where_ID = array(
                'PK_department_id' => $department_ID
            );
            $this->dmm->update_department_details($where_ID, $dept_details);
            redirect(base_url('Manage-Department'));
        }
    }
    
    public function department_details_byID($department_ID){
        $data = $this->dmm->get_department_details($department_ID);
        echo json_encode($data);
    }
}
