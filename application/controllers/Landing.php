<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

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
}
