<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {

    public function __construct()
	{
		date_default_timezone_set('Asia/Manila');
		parent::__construct();
		$this->load->model('Form_management_model', 'fmm');
	}
	
}
