<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
        public function __construct()
	    {
                date_default_timezone_set('Asia/Manila');        
                parent::__construct();
                $this->load->model('Upload_management_model','umm');
        }
	public function admin_upload_file($employee_code)
	{
        if ($this->session->userdata('employee_code')) {
        $header['title_page'] = "Upload File";
                $this->load->model('Employee_management_model','emm');
                $employee_code = $this->uri->segment(2);
                $header['title_page'] = $this->emm->get_employee_flname($employee_code);
                $data['emp_wname'] = $this->emm->get_employee_wname($employee_code);
                $data['profile'] = $this->emm->get_employee_profile($employee_code);
                $data['emp_files'] = $this->umm->get_employee_files($employee_code);
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_employee_upload_files',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_employee_upload_files',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
            } else {
                Redirect(base_url('HRMISystem'));
            }
    }
    
    public function upload_employee_file($employee_code){
        $this->form_validation->set_rules('upload_folder_path', 'Folder Path', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('upload_file_title', 'File Title', 'xss_clean|trim|required', array('required' => '%s'));
        $this->form_validation->set_rules('upload_user_file', 'File', 'xss_clean|trim');
        $this->form_validation->set_rules('upload_file_description', 'Short Description', 'xss_clean|trim');
        if ($this->form_validation->run() == false) {
            $error['error_msg'] = 'Uploading File Error';
            $error['title'] = 'Upload File Error';
            $error['code'] = 'HRIS:Uumm|ref|XLn26';
            $error['module'] ='Upload Module';
            $this->load->view('hris_errors/error_page',$error);
        } else {
                    $file = $_FILES['upload_user_file'];
					$name = $file['name'];
					$folder_name = $this->input->post('upload_folder_path');
					$config['upload_path'] = './uploads/employee/' . $employee_code . '/' . $folder_name;
                    $config['allowed_types'] = 'jpg|png|pdf|docx|xlsx|doc|txt';
			        $config['remove_spaces'] = true;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!is_dir('uploads/employee/' . $employee_code . '/' . $folder_name)) {
						mkdir('./uploads/employee/' . $employee_code . '/' . $folder_name, 0777, true);
					}

					if (!$this->upload->do_upload('upload_user_file')) {
                        $error['error_msg'] = $this->upload->display_errors();
                        $error['title'] = 'Upload File Error';
                        $error['code'] = 'HRIS:Uumm|ref|XLn26';
                        $error['module'] ='Upload Module';
                        $this->load->view('hris_errors/error_page',$error);
					} else {
                        $data = array('upload_data' => $this->upload->data());
                        $file = $_FILES['upload_user_file'];
                        $name = $file['name'];
                        $name = str_replace(' ', '_', $name);
                        $file_data = array(
                            'FK_employee_code'  => $employee_code,
                            'Folder_name'       =>$this->input->post('upload_folder_path'),
                            'File_name'         => $name,
                            'File_title'        => $this->input->post('upload_file_title'),
                            'File_path'         => 'uploads/employee/' . $employee_code . '/' . $folder_name . '/' . $name,
                            'Description'       => $this->input->post('upload_file_description'),
                            'Date_added'        => date('Y-m-d'),
                            'file_status'       => 'Active'
                        );
                        $this->umm->add_employee_file($file_data);
                        redirect(base_url('Upload-File/'.$employee_code));
					}
        }
    }
    public function uploaded_file_details_byID($file_id){
        $data = $this->umm->uploaded_file_details($file_id);
        echo json_encode($data);
    }
}
