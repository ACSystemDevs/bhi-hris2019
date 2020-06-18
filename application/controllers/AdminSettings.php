<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSettings extends CI_Controller {
    public function __construct()
	{
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->model('Attendance_management_model','atmm');
        $this->load->library('CI_zklib');
    }

    public function admin_view_manage_uface(){
        if ($this->session->userdata('employee_code')) {
            $header['title_page'] = "Manage uFace 402 Device";
            $zk = new ZKLib();
            $enableGetDeviceInfo = true;
            $enableGetUsers = true;
            $enableGetData = true;
            $ret = $zk->connect();
            if ($ret) {
                if($enableGetDeviceInfo === true) {
                    $data['zk_version'] = $zk->version();
                    $data['zk_osVersion'] = $zk->osVersion();
                    $data['zk_platform'] = $zk->platform();
                    $data['zk_fmVersion'] = $zk->fmVersion();
                    $data['zk_workCode'] = $zk->workCode();
                    $data['zk_ssr'] = $zk->ssr();
                    $data['zk_pinWidth'] = $zk->pinWidth();
                    $data['zk_faceFunctionOn'] = $zk->faceFunctionOn();
                    $data['zk_serialNumber'] = $zk->serialNumber();
                    $data['zk_deviceName'] = $zk->deviceName();
                    $data['zk_getTime'] = $zk->getTime();
                    $data['zk_status'] = 'Connected';
                }
            }
            $data['last_records'] = $this->atmm->get_last_attendance_records();
            $this->load->view('admin/fragments/admin_header',$header);
            $this->load->view('admin/fragments/admin_navbar');
            $this->load->view('admin/admin_manage_uface_device',$data);
            $this->load->view('admin/fragments/admin_r_sidebar');
            $this->load->view('admin/fragments/admin_footer.php');
            $zk->disconnect();
        } else {
            Redirect(base_url('HRMISystem'));
        }
    }
    public function save_data_from_device_to_db()
    {
        $zk = new ZKLib();
        $enableGetData = true;
        $ret = $zk->connect();
        if ($ret) {
            if ($enableGetData === true) { 
                $attendance = $zk->getAttendance();
            }
        }
        $data = $this->atmm->sync_terminal_records_to_db($attendance);
        $zk->disconnect();
    }
    public function admin_view_manage_settings()
	{
            if ($this->session->userdata('employee_code')) {
                $header['title_page'] = "System Settings";
                $data[] = "";
                $this->load->view('admin/fragments/admin_header',$header);
                $this->load->view('admin/fragments/admin_navbar');
                $this->load->view('admin/admin_manage_settings',$data);
                $this->load->view('admin/fragments/admin_r_sidebar');
                $this->load->view('admin/fragments/admin_footer.php');
            } else {
                Redirect(base_url('HRMISystem'));
            }
    }

    public function sync_time_to_terminal(){
            $zk = new ZKLib();
            $ret = $zk->connect();
                if ($ret) {
                    $current_time = date('Y-m-d H:i:s');
                    // echo $current_time;
                    // exit();
                    $zk->setTime($current_time);
                }
    }
}
