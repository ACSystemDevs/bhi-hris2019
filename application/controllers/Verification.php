<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verification extends CI_Controller {
    public function __construct()
	{
            date_default_timezone_set('Asia/Manila');
            parent::__construct();
            $this->load->model('Account_management_model','amm');
            $this->load->model('Validation_management_model','vlm');
    }
    public function index()
	{
        $data['title_page'] = "Login Page";
		if ($this->session->userdata('FK_employee_code')) {
			$this->session->unset_userdata('error_msg');
			$FK_employee_code = $this->session->userdata('FK_employee_code');
			$usertype = $this->session->userdata('user_usertype');
		} else {
		    $this->load->view('login_page',$data);
		}
	}
    public function login_user_account(){
        $user_login = array(
			'Username' => $this->input->post('login_username'),
			'Password' => sha1(md5($this->input->post('login_password')))
		);
        $data = $this->vlm->validate_login($user_login['Username'], $user_login['Password']);
		if ($data) {
			$this->session->unset_userdata('error_msg');
			$this->session->set_userdata('employee_code', $data['FK_employee_code']);
			$this->session->set_userdata('usertype', $data['user_usertype']);
			$this->session->set_userdata('user_image', $data['emp_picture']);
			$employee_code = $this->session->userdata('employee_code');
			Redirect(base_url('Dashboard'));
		} else {
			$this->session->set_flashdata('error_msg', 'Invalid User Credentials');
			$this->index();
		}
    }
    public function login_user()
	{
		
	}

	public function logout()
	{
		$this->session->unset_userdata('employee_code');
		$this->session->unset_userdata('error_msg');
		$this->session->sess_destroy();
		$this->index();
	}
}
