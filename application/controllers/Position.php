<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller {
    public function __construct()
	{
        date_default_timezone_set('Asia/Manila');
        parent::__construct();
        $this->load->model('Position_management_model','pmm');
    }

	public function admin_manage_position()
	{
        if ($this->session->userdata('employee_code')) {
        $this->load->model('Section_management_model','smm');
                $header['title_page'] = "Manage Position";
                $data['section'] = $this->smm->get_active_section();
                $data['position'] = $this->pmm->get_active_position();
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                    $this->load->view('admin/fragments/admin_header',$header);
                    $this->load->view('admin/fragments/admin_navbar');
                    $this->load->view('admin/admin_manage_position',$data);
                    $this->load->view('admin/fragments/admin_r_sidebar');
                    $this->load->view('admin/fragments/admin_footer.php');
                }else{
                    $this->load->view('hr_payroll/fragments/payroll_header',$header);
                    $this->load->view('hr_payroll/fragments/payroll_navbar');
                    $this->load->view('hr_payroll/payroll_manage_position',$data);
                    $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                    $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
            } else {
                Redirect(base_url('HRMISystem'));
        }
    }

    public function add_position_function(){
        $this->form_validation->set_rules('form_position_section', 'Section', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('form_position_name', 'Position Name', 'xss_clean|trim|required', array('required' => '%s'));

        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Adding Position Error';
            $error['title'] = 'Add Position Error';
            $error['code'] = 'HRIS:Ppmm|ref|XLn23';
            $error['module'] ='Position Module';
            $this->load->view('hris_errors/error_page',$error);
        } else {
            $position_details = array(
                'FK_section_ID'         => $this->input->post('form_position_section'),
                'job_name'              => strtoupper($this->input->post('form_position_name')),
                'position_status'       => 'Active',
                'job_date_added'        => date('Y-m-d')
            );
            
            $this->pmm->add_position_details($position_details);
            redirect(base_url('Manage-Position'));
        }
    }

    public function get_position_json_encode(){
        $data = $this->pmm->get_active_position_json();
            echo '<option value="">Select Position</option>';
			foreach($data as $row) {
				echo '<option value="' . $row['job_name'] . '">' . $row['job_name'] . '</option>';
			}
    }

    public function position_details_byID($position_id)
    {
        $data = $this->pmm->get_position_details($position_id);
        echo json_encode($data);
    }

    public function update_position_function($position_id){
        $this->form_validation->set_rules('edit_form_position_name', 'Section', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('edit_form_position_section', 'Position Name', 'xss_clean|trim|required', array('required' => '%s'));

        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Updating Position Error';
            $error['title'] = 'Update Position Error';
            $error['code'] = 'HRIS:Ppmm|ref|XLn61';
            $error['module'] ='Position Module';
            $this->load->view('hris_errors/error_page',$error);
        } else {
            $position_details = array(
                'FK_section_ID'         => $this->input->post('edit_form_position_section'),
                'job_name'              => strtoupper($this->input->post('edit_form_position_name')),
                'position_status'       => 'Active',
                'job_date_added'        => date('Y-m-d')
            );
            $where_ID = array(
                'PK_position_ID' => $position_id
            );
            $this->pmm->update_position_details($where_ID, $position_details);
            redirect(base_url('Manage-Position'));
        }
    }
}