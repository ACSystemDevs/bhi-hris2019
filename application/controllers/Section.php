<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller {
    public function __construct()
	{
        date_default_timezone_set('Asia/Manila');
        parent::__construct();
        $this->load->model('Section_management_model','smm');
    }

	public function admin_manage_section()
	{
        if ($this->session->userdata('employee_code')) {
        $this->load->model('Employee_management_model','emm');
        $this->load->model('Department_management_model','dmm');
        $header['title_page'] = "Manage Section";
        $data['department'] = $this->dmm->get_active_department();
        $data['section'] = $this->smm->get_active_section();
        $data['active_employee'] = $this->emm->get_active_employees();
        $this->load->view('admin/fragments/admin_header',$header);
        $this->load->view('admin/fragments/admin_navbar');
        $this->load->view('admin/admin_manage_section',$data);
        $this->load->view('admin/fragments/admin_r_sidebar');
        $this->load->view('admin/fragments/admin_footer.php');
        } else {
            Redirect(base_url('HRMISystem'));
        }
    }

    public function add_section_function()
    {
        //SECTION
        $this->form_validation->set_rules('form_section_department', 'Department', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('form_section_name', 'Section Name', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('form_section_head', 'Section Head', 'xss_clean|trim|required', array('required' => '%s'));

        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Adding Section Error';
            $error['title'] = 'Add Section Error';
            $error['code'] = 'HRIS:Ssmm|ref|XLn36';
            $error['module'] ='Section Module';
            $this->load->view('hris_errors/error_page',$error);
        } else {
            $sect_details = array(
                'FK_department_ID' => $this->input->post('form_section_department'),
                'section_name'      => strtoupper($this->input->post('form_section_name')),
                'section_status'    => 'Active',
                'FK_employee_code'  => $this->input->post('form_section_head')
            );
            
            $this->smm->add_section_details($sect_details);
            redirect(base_url('Manage-Section'));
        }
    }
    public function section_details_byID($section_id){
        $data = $this->smm->get_section_details_byID($section_id);
        echo json_encode($data);
    }

    public function update_section_function($section_id)
    {
        //SECTION
        $this->form_validation->set_rules('edit_form_section_department', 'Department', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('edit_form_section_name', 'Section Name', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('edit_form_section_head', 'Section Head', 'xss_clean|trim|required', array('required' => '%s'));

        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Updating Section Error';
            $error['title'] = 'Update Section Error';
            $error['code'] = 'HRIS:Ssmm|ref|XLn56';
            $error['module'] ='Section Module';
            $this->load->view('hris_errors/error_page',$error);
        } else {
            $sect_details = array(
                'FK_department_ID' => $this->input->post('edit_form_section_department'),
                'section_name'      => strtoupper($this->input->post('edit_form_section_name')),
                'section_status'    => 'Active',
                'FK_employee_code'  => $this->input->post('edit_form_section_head')
            );
            $where_PK = array(
                'PK_section_ID' => $section_id
            );
            $this->smm->update_section_details($where_PK, $sect_details);
            redirect(base_url('Manage-Section'));
        }
    }
    public function get_section_json_encode(){
        $data = $this->smm->get_active_section_json();
            echo '<option value="">Select Section</option>';
			foreach($data as $row) {
				echo '<option value="' . $row['section_name'] . '">' . $row['section_name'] . '</option>';
			}
    }
}
