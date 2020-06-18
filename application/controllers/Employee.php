<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

        public function __construct()
	{
                date_default_timezone_set('Asia/Manila');
                parent::__construct();
                $this->load->model('Employee_management_model','emm');
        }
        // GLOBAL FUNCTION
        public function register_employee_function(){
                $this->load->model('Account_management_model', 'amm');
                        // VARIABLE DECLARATIONS
                        $employee_status = 'active';
                        $emp_account_type = 'employee';
                        // BASIC INFORMATION TAB
                        $this->form_validation->set_rules('emp_LName', 'Last name', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_FName', 'First name', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_MName', 'Middle name', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_nameext', 'Name Extension', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_permanent_street', '(No./St./Sub/Sitio)', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_permanent_brgy', 'Barangay', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_permanent_region', 'Region', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_permanenet_province', 'Province', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_permanent_citymun', 'City/Town', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_present_street', '(No./St./Sub/Sitio)', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_present_brgy', 'Barangay', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_present_region', 'Region', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_present_province', 'Province', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_present_citymun', 'City/Town', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_birthdate', 'Date of Birth', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_height', 'Height', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_weight', 'Weight', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_bloodtype', 'Blood Type', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_bplace_region', 'Birthplace(Region)', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_bplace_province', 'Birthplace(Province)', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_bplace_citymun', 'Birthplace(City/Town)', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_gender', 'Gender', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_citizenship', 'Citizenship', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_civilstatus', 'Civil Status', 'xss_clean|trim');
                        $this->form_validation->set_rules('emp_religion', 'Religion', 'xss_clean|trim');
                        // ADDITIONAL INFORMATION TAB
			$this->form_validation->set_rules('emp_email_address', 'Email Address', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_mobile_no', 'Mobile Number', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_telephone_no', 'Telephone Number', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_sss_id', 'SSS No.', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_hdmf_id', 'HDMF No.', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_phic_id', 'PhilHealth No.', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_tin_id', 'TIN', 'xss_clean|trim|required', array('required' => '%s'));
                        $this->form_validation->set_rules('emp_prc_license', 'License No.', 'xss_clean|trim');
                        $this->form_validation->set_rules('emp_prc_expire', 'License No.', 'xss_clean|trim');
                        // WORK EXPERIENCE
                        $this->form_validation->set_rules('employer[]', 'Firm/Office', 'xss_clean|trim');
			$this->form_validation->set_rules('position[]', 'Position Held', 'xss_clean|trim');
			$this->form_validation->set_rules('exp_start_date[]', 'Start Date', 'xss_clean|trim');
                        $this->form_validation->set_rules('exp_end_date[]', 'End Date', 'xss_clean|trim');
                        $this->form_validation->set_rules('exp_reason[]', 'End Date', 'xss_clean|trim');
                        // EDUCATION HISTORY
                        $this->form_validation->set_rules('school[]', 'School Attended', 'xss_clean|trim');
			$this->form_validation->set_rules('course[]', 'Course Pursued', 'xss_clean|trim');
			$this->form_validation->set_rules('degree[]', 'Degree Earned', 'xss_clean|trim');
                        $this->form_validation->set_rules('yr_grad[]', 'Year Graduated', 'xss_clean|trim');
                        // FAMILY BACKGROUND
                        $this->form_validation->set_rules('emp_father_WName', 'Father\'s Name', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_father_birthdate', 'Father\'s Date of Birth', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_father_occupation', 'Father\'s Occupation', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_father_employer', 'Father\'s Employer', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_mother_WName', 'Mother\'s Name', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_mother_birthdate', 'Mother\'s Date of Birth', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_mother_occupation', 'Mother\'s Occupation', 'xss_clean|trim');
                        $this->form_validation->set_rules('emp_mother_employer', 'Mother\'s Employer', 'xss_clean|trim');
                        // IN CASE OF EMERGENCY
			$this->form_validation->set_rules('emp_ice_WName', 'Contact Person', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_ice_contactno', 'Contact Number', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_ice_address', 'Contact Person\'s Address(Region)', 'xss_clean|trim');
                        $this->form_validation->set_rules('emp_ice_relation', 'Relationship', 'xss_clean|trim');
                        // SPOUSE INFORMATION
                        $this->form_validation->set_rules('emp_spouse_WName', 'Spouse\'s Last name', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_spouse_birthdate', 'Spouse\'s Birthday', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_spouse_occupation', 'Spouse\'s Occupation', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_spouse_employer', 'Spouse\'s Employer', 'xss_clean|trim');
                        // DEPENDENTS
			$this->form_validation->set_rules('dep_lname[]', 'Dependent\'s Last Name', 'xss_clean|trim');
			$this->form_validation->set_rules('dep_fname[]', 'Dependent\'s First Name', 'xss_clean|trim');
			$this->form_validation->set_rules('dep_mname[]', 'Dependent\'s Middle Name', 'xss_clean|trim');
			$this->form_validation->set_rules('dep_name_ext[]', 'Dependent\'s Name Extension', 'xss_clean|trim');
                        $this->form_validation->set_rules('dep_bdate[]', 'Dependent\'s Birthday', 'xss_clean|trim');

                        if ($this->form_validation->run() == false) {
                                $error['error_msg'] = 'Registration Error';
                                $error['title'] = 'Registration Error';
                                $error['code'] = 'HRIS:Eemm|ref|XLn90';
                                $error['module'] ='Employee Registration';
                                $this->load->view('hris_errors/error_page',$error);
			} else {
                                //EMPLOYEE ID NUMBER GENERATION
                                // UNCOMMENT THIS PART AFTER BACKLOGS
                                // $latest_employee_code_1 = intval($this->emm->get_latest_employee_code()+1);
                                // if($latest_employee_code_1 == $this->input->post('PK_employee_code')){
                                //         $last_emp_code = $this->emm->get_latest_employee_code();
                                //         //get first 2 numbers in ID
                                //         $id_yr = substr($last_emp_code, 0, 2);
                                //                 //compare if true then continue sequence == same year 
                                //                 //else start id number sequence to 001 : nn = 2 digits of current yr, ID = nn000
                                //         if ($id_yr == date('y')) {
                                //                 $numeric_id = substr($last_emp_code, -3);
                                //                 $int = intval($numeric_id);
                                //                 $int++;
                                //                 $employee_code = date('y') . str_pad($int, 3, "0", STR_PAD_LEFT);
                                //         } else {
                                //                 $new_id_start = '001';
                                //                 $employee_code = date('y') . $new_id_start;
                                //         }
                                // }else{
                                        $employee_code = $this->input->post('PK_employee_code');
                                // }
				
                                // UPLOADING EMPLOEYE PHOTO
                                if (empty($_FILES['userfile']['tmp_name'])) {
                                        $error['error_msg'] = 'Image Uploading Error';
                                        $error['title'] = 'Image Uploading Error';
                                        $error['code'] = 'HRIS:Eemm|ref|XLn114';
                                        $error['module'] ='Employee Registration - Upload Photo';
                                        $this->load->view('hris_errors/error_page',$error);
				} else {
					$file = $_FILES['userfile'];
					$name = $file['name'];
					$folder_name = 'employee_picture';
					$config['upload_path'] = './uploads/employee/' . $employee_code . '/' . $folder_name;
					$config['allowed_types'] = 'jpg|png';

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!is_dir('uploads/employee/' . $employee_code . '/' . $folder_name)) {
						mkdir('./uploads/employee/' . $employee_code . '/' . $folder_name, 0777, true);
					}

					if (!$this->upload->do_upload('userfile')) {
						$error = array('error' => $this->upload->display_errors()); 
						// $this->load->view('home_view', $error); 
						echo "Picture to be upload is big";
					} else {
						$data = array('upload_data' => $this->upload->data());
					}
                                        $profile_picture = "uploads/employee/" . $employee_code . "/" . $folder_name . "/" . preg_replace('/\s+/','_',$name);
                                        
                                        $employee_profile = array(
                                                'PK_employee_code'      => $employee_code,
                                                'emp_LName'             => strtoupper($this->input->post('emp_LName')),
                                                'emp_FName'             => strtoupper($this->input->post('emp_FName')),
                                                'emp_MName'             => strtoupper($this->input->post('emp_MName')),
                                                'emp_NameExt'           => strtoupper($this->input->post('emp_nameext')),
                                                'emp_perma_street'      => strtoupper($this->input->post('emp_permanent_street')),
                                                'emp_perma_brgy'        => strtoupper($this->input->post('emp_permanent_brgy')),
                                                'emp_perma_town'        => strtoupper($this->input->post('emp_permanent_citymun')),
                                                'emp_perma_province'    => strtoupper($this->input->post('emp_permanent_province')),
                                                'emp_perma_region'      => strtoupper($this->input->post('emp_permanent_region')),
                                                'emp_prese_street'      => strtoupper($this->input->post('emp_present_street')),
                                                'emp_prese_brgy'        => strtoupper($this->input->post('emp_present_brgy')),
                                                'emp_prese_town'        => strtoupper($this->input->post('emp_present_citymun')),
                                                'emp_prese_province'    => strtoupper($this->input->post('emp_present_province')),
                                                'emp_prese_region'      => strtoupper($this->input->post('emp_present_region')),
                                                'emp_birthdate'         => $this->input->post('emp_birthdate'),
                                                'emp_height'            => $this->input->post('emp_height'),
                                                'emp_weight'            => $this->input->post('emp_weight'),
                                                'emp_bloodtype'         => strtoupper($this->input->post('emp_bloodtype')),
                                                'emp_bplace_town'       => strtoupper($this->input->post('emp_bplace_citymun')),
                                                'emp_bplace_prov'       => strtoupper($this->input->post('emp_bplace_province')),
                                                'emp_bplace_region'        => strtoupper($this->input->post('emp_bplace_region')),
                                                'emp_gender'            => strtoupper($this->input->post('emp_gender')),
                                                'emp_civilstatus'       => strtoupper($this->input->post('emp_civilstatus')),
                                                'emp_citizenship'       => strtoupper($this->input->post('emp_citizenship')),
                                                'emp_religion'          => strtoupper($this->input->post('emp_religion')),
                                                'emp_email'             => strtolower($this->input->post('emp_email_address')),
                                                'emp_telno'             => $this->input->post('emp_telephone_no'),
                                                'emp_mobno'             => $this->input->post('emp_mobile_no'),
                                                'emp_ice_name'          => strtoupper($this->input->post('emp_ice_WName')),
                                                'emp_ice_conno'         => $this->input->post('emp_ice_contactno'),
                                                'emp_ice_relation'      => strtoupper($this->input->post('emp_ice_relation')),
                                                'emp_picture'           => $profile_picture
                                        );

                                        $employee_ids = array(
                                                'FK_employee_code'      => $employee_code,
                                                'SSS_ID'                => $this->input->post('emp_sss_id'),
                                                'HDMF_ID'               => $this->input->post('emp_hdmf_id'),
                                                'PHIC_ID'               => $this->input->post('emp_phic_id'),
                                                'TIN_ID'                => $this->input->post('emp_tin_id'),
                                                'PRC_License'           => $this->input->post('emp_prc_license'),
                                                'PRC_Expdate'           => $this->input->post('emp_prc_expire'),
                                                'CTC_No'                => $this->input->post('emp_ctc'),
                                                'CTC_Date'              => $this->input->post('emp_ctc_date')
                                        );

                                       
                                        $employee_dependents = array(
                                                'FK_employee_code'      => $employee_code,
                                                'emp_dep_LName'         => base64_encode(serialize($this->input->post('dep_lname[]'))),
                                                'emp_dep_FName'         => base64_encode(serialize($this->input->post('dep_fname[]'))),
                                                'emp_dep_MName'         => base64_encode(serialize($this->input->post('dep_mname[]'))),
                                                'emp_dep_NameExt'       => base64_encode(serialize($this->input->post('dep_name_ext[]'))),
                                                'emp_dep_birthdate'     => base64_encode(serialize($this->input->post('dep_bdate[]')))
                                        );
                                        

                                        $employee_education = array(
                                                'FK_employee_code'      => $employee_code,
                                                'education_school'      => base64_encode(serialize($this->input->post('school[]'))),
                                                'education_course'      => base64_encode(serialize($this->input->post('course[]'))),
                                                'education_degree'      => base64_encode(serialize($this->input->post('degree[]'))),
                                                'education_yrlast'      => base64_encode(serialize($this->input->post('yr_grad[]')))
                                        );

                                        $employee_experience = array(
                                                'FK_employee_code'      => $employee_code,
                                                'experience_firm'       => base64_encode(serialize($this->input->post('employer[]'))),
                                                'experience_position'   => base64_encode(serialize($this->input->post('position[]'))),
                                                'experience_sdate'      => base64_encode(serialize($this->input->post('exp_start_date[]'))),
                                                'experience_edate'      => base64_encode(serialize($this->input->post('exp_end_date[]'))),
                                                'experience_reason'     => base64_encode(serialize($this->input->post('exp_reason[]')))
                                        );

                                        $employee_family = array(
                                                'FK_employee_code'      => $employee_code,
                                                'emp_father_WName'      => strtoupper($this->input->post('emp_father_WName')),
                                                'emp_father_birthdate'  => $this->input->post('emp_father_birthdate'),
                                                'emp_father_occupation' => strtoupper($this->input->post('emp_father_occupation')),
                                                'emp_father_employer'   => strtoupper($this->input->post('emp_father_employer')),
                                                'emp_mother_WName'      => strtoupper($this->input->post('emp_mother_WName')),
                                                'emp_mother_birthdate'  => $this->input->post('emp_mother_birthdate'),
                                                'emp_mother_occupation' => strtoupper($this->input->post('emp_mother_occupation')),
                                                'emp_mother_employer'   => strtoupper($this->input->post('emp_mother_employer')),
                                                'emp_spouse_WName'      => strtoupper($this->input->post('emp_spouse_WName')),
                                                'emp_spouse_birthdate'  => $this->input->post('emp_spouse_birthdate'),
                                                'emp_spouse_occupation' => strtoupper($this->input->post('emp_spouse_occupation')),
                                                'emp_spouse_employer'   => strtoupper($this->input->post('emp_spouse_employer'))
                                        );

                                        $employee_record = array(
                                                'FK_employee_code'      => $employee_code,      
                                                'record_startdate'      =>base64_encode(serialize($this->input->post('emp_inclusive_startdate[]'))),
                                                'record_enddate'        =>base64_encode(serialize($this->input->post('emp_inclusive_enddate[]'))),
                                                'record_position'       =>base64_encode(serialize($this->input->post('emp_job_position[]'))),
                                                'record_status'         =>base64_encode(serialize($this->input->post('emp_job_status[]'))),
                                                'record_section'        =>base64_encode(serialize($this->input->post('emp_job_section[]'))),
                                        );

                                        // $password = date('Fdy',strtotime($this->input->post('emp_birthdate')));
                                        $password = 'Bethany1921' + $employee_code;
                                        $employee_useraccount = array(
                                                'FK_employee_code'      => $employee_code,
                                                'Username'              => $employee_code,
                                                'Password'              => sha1(md5($password)),
                                                'user_usertype'         => 'Employee',
                                                'user_status'           => 'Active',
                                        );

                                        $this->emm->save_employee_profile($employee_profile);
                                        $this->emm->save_employee_ids($employee_ids);
                                        $this->emm->save_employee_dependents($employee_dependents);
                                        $this->emm->save_employee_experience($employee_experience);
                                        $this->emm->save_employee_education($employee_education);
                                        $this->emm->save_employee_family($employee_family);
                                        $this->emm->save_employee_record($employee_record);
                                        $this->amm->save_employee_useraccount($employee_useraccount);

                                        // redirect(base_url('Employee-Masterlist'));
                                        redirect(base_url('Add-Employee'));
				}
                        }
        }

        public function update_employee_function(){
                        // BASIC INFORMATION TAB
                        $this->form_validation->set_rules('emp_LName', 'Last name', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_FName', 'First name', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_MName', 'Middle name', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_nameext', 'Name Extension', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_permanent_street', '(No./St./Sub/Sitio)', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_permanent_brgy', 'Barangay', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_permanent_region', 'Region', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_permanenet_province', 'Province', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_permanent_citymun', 'City/Town', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_present_street', '(No./St./Sub/Sitio)', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_present_brgy', 'Barangay', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_present_region', 'Region', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_present_province', 'Province', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_present_citymun', 'City/Town', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_birthdate', 'Date of Birth', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_height', 'Height', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_weight', 'Weight', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_bloodtype', 'Blood Type', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_bplace_region', 'Birthplace(Region)', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_bplace_province', 'Birthplace(Province)', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_bplace_citymun', 'Birthplace(City/Town)', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_gender', 'Gender', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_citizenship', 'Citizenship', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_civilstatus', 'Civil Status', 'xss_clean|trim');
                        $this->form_validation->set_rules('emp_religion', 'Religion', 'xss_clean|trim');
                        // ADDITIONAL INFORMATION TAB
			$this->form_validation->set_rules('emp_email_address', 'Email Address', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_mobile_no', 'Mobile Number', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_telephone_no', 'Telephone Number', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_sss_id', 'SSS No.', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_hdmf_id', 'HDMF No.', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_phic_id', 'PhilHealth No.', 'xss_clean|trim|required', array('required' => '%s'));
			$this->form_validation->set_rules('emp_tin_id', 'TIN', 'xss_clean|trim|required', array('required' => '%s'));
                        $this->form_validation->set_rules('emp_prc_license', 'License No.', 'xss_clean|trim');
                        $this->form_validation->set_rules('emp_prc_expire', 'License No.', 'xss_clean|trim');
                        // WORK EXPERIENCE
                        $this->form_validation->set_rules('employer[]', 'Firm/Office', 'xss_clean|trim');
			$this->form_validation->set_rules('position[]', 'Position Held', 'xss_clean|trim');
			$this->form_validation->set_rules('exp_start_date[]', 'Start Date', 'xss_clean|trim');
                        $this->form_validation->set_rules('exp_end_date[]', 'End Date', 'xss_clean|trim');
                        $this->form_validation->set_rules('exp_reason[]', 'End Date', 'xss_clean|trim');
                        // EDUCATION HISTORY
                        $this->form_validation->set_rules('school[]', 'School Attended', 'xss_clean|trim');
			$this->form_validation->set_rules('course[]', 'Course Pursued', 'xss_clean|trim');
			$this->form_validation->set_rules('degree[]', 'Degree Earned', 'xss_clean|trim');
                        $this->form_validation->set_rules('yr_grad[]', 'Year Graduated', 'xss_clean|trim');
                        // FAMILY BACKGROUND
                        $this->form_validation->set_rules('emp_father_WName', 'Father\'s Name', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_father_birthdate', 'Father\'s Date of Birth', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_father_occupation', 'Father\'s Occupation', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_father_employer', 'Father\'s Employer', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_mother_WName', 'Mother\'s Name', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_mother_birthdate', 'Mother\'s Date of Birth', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_mother_occupation', 'Mother\'s Occupation', 'xss_clean|trim');
                        $this->form_validation->set_rules('emp_mother_employer', 'Mother\'s Employer', 'xss_clean|trim');
                        // IN CASE OF EMERGENCY
			$this->form_validation->set_rules('emp_ice_WName', 'Contact Person', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_ice_contactno', 'Contact Number', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_ice_address', 'Contact Person\'s Address(Region)', 'xss_clean|trim');
                        $this->form_validation->set_rules('emp_ice_relation', 'Relationship', 'xss_clean|trim');
                        // SPOUSE INFORMATION
                        $this->form_validation->set_rules('emp_spouse_WName', 'Spouse\'s Last name', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_spouse_birthdate', 'Spouse\'s Birthday', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_spouse_occupation', 'Spouse\'s Occupation', 'xss_clean|trim');
			$this->form_validation->set_rules('emp_spouse_employer', 'Spouse\'s Employer', 'xss_clean|trim');
                        // DEPENDENTS
			$this->form_validation->set_rules('dep_lname[]', 'Dependent\'s Last Name', 'xss_clean|trim');
			$this->form_validation->set_rules('dep_fname[]', 'Dependent\'s First Name', 'xss_clean|trim');
			$this->form_validation->set_rules('dep_mname[]', 'Dependent\'s Middle Name', 'xss_clean|trim');
			$this->form_validation->set_rules('dep_name_ext[]', 'Dependent\'s Name Extension', 'xss_clean|trim');
                        $this->form_validation->set_rules('dep_bdate[]', 'Dependent\'s Birthday', 'xss_clean|trim');

                        if ($this->form_validation->run() == false) {
                                $error['error_msg'] = 'Registration Error';
                                $error['title'] = 'Registration Error';
                                $error['code'] = 'HRIS:Eemm|ref|XLn90';
                                $error['module'] ='Employee Registration';
                                $this->load->view('hris_errors/error_page',$error);
			} else {
                                $employee_code = $this->uri->segment(2);
                                // UPLOADING EMPLOEYE PHOTO
                                if (empty($_FILES['user_edit_avatar_control']['tmp_name'])) {
                                        $employee_profile = array(
                                                'emp_LName'             => strtoupper($this->input->post('emp_LName')),
                                                'emp_FName'             => strtoupper($this->input->post('emp_FName')),
                                                'emp_MName'             => strtoupper($this->input->post('emp_MName')),
                                                'emp_NameExt'           => strtoupper($this->input->post('emp_nameext')),
                                                'emp_perma_street'      => strtoupper($this->input->post('emp_permanent_street')),
                                                'emp_perma_brgy'        => strtoupper($this->input->post('emp_permanent_brgy')),
                                                'emp_perma_town'        => strtoupper($this->input->post('emp_permanent_citymun')),
                                                'emp_perma_province'    => strtoupper($this->input->post('emp_permanent_province')),
                                                'emp_perma_region'      => strtoupper($this->input->post('emp_permanent_region')),
                                                'emp_prese_street'      => strtoupper($this->input->post('emp_present_street')),
                                                'emp_prese_brgy'        => strtoupper($this->input->post('emp_present_brgy')),
                                                'emp_prese_town'        => strtoupper($this->input->post('emp_present_citymun')),
                                                'emp_prese_province'    => strtoupper($this->input->post('emp_present_province')),
                                                'emp_prese_region'      => strtoupper($this->input->post('emp_present_region')),
                                                'emp_birthdate'         => $this->input->post('emp_birthdate'),
                                                'emp_height'            => $this->input->post('emp_height'),
                                                'emp_weight'            => $this->input->post('emp_weight'),
                                                'emp_bloodtype'         => strtoupper($this->input->post('emp_bloodtype')),
                                                'emp_bplace_town'       => strtoupper($this->input->post('emp_bplace_citymun')),
                                                'emp_bplace_prov'       => strtoupper($this->input->post('emp_bplace_province')),
                                                'emp_bplace_region'        => strtoupper($this->input->post('emp_bplace_region')),
                                                'emp_gender'            => strtoupper($this->input->post('emp_gender')),
                                                'emp_civilstatus'       => strtoupper($this->input->post('emp_civilstatus')),
                                                'emp_citizenship'       => strtoupper($this->input->post('emp_citizenship')),
                                                'emp_religion'          => strtoupper($this->input->post('emp_religion')),
                                                'emp_email'             => $this->input->post('emp_email_address'),
                                                'emp_telno'             => $this->input->post('emp_telephone_no'),
                                                'emp_mobno'             => $this->input->post('emp_mobile_no'),
                                                'emp_ice_name'          => strtoupper($this->input->post('emp_ice_WName')),
                                                'emp_ice_conno'         => $this->input->post('emp_ice_contactno'),
                                                'emp_ice_relation'      => strtoupper($this->input->post('emp_ice_relation'))
                                        );
				} else {
					$file = $_FILES['user_edit_avatar_control'];
					$name = $file['name'];
					$folder_name = 'employee_picture';
					$config['upload_path'] = './uploads/employee/' . $employee_code . '/' . $folder_name;
					$config['allowed_types'] = 'jpg|png';

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!is_dir('uploads/employee/' . $employee_code . '/' . $folder_name)) {
						mkdir('./uploads/employee/' . $employee_code . '/' . $folder_name, 0777, true);
					}

					if (!$this->upload->do_upload('user_edit_avatar_control')) {
						$error = array('error' => $this->upload->display_errors()); 
						// $this->load->view('home_view', $error); 
						echo "Picture to be upload is big";
					} else {
						$data = array('upload_data' => $this->upload->data());
					}
                                        $profile_picture = "uploads/employee/" . $employee_code . "/" . $folder_name . "/" . $name;
                                        $employee_profile = array(
                                                'emp_LName'             => strtoupper($this->input->post('emp_LName')),
                                                'emp_FName'             => strtoupper($this->input->post('emp_FName')),
                                                'emp_MName'             => strtoupper($this->input->post('emp_MName')),
                                                'emp_NameExt'           => strtoupper($this->input->post('emp_nameext')),
                                                'emp_perma_street'      => strtoupper($this->input->post('emp_permanent_street')),
                                                'emp_perma_brgy'        => strtoupper($this->input->post('emp_permanent_brgy')),
                                                'emp_perma_town'        => strtoupper($this->input->post('emp_permanent_citymun')),
                                                'emp_perma_province'    => strtoupper($this->input->post('emp_permanent_province')),
                                                'emp_perma_region'      => strtoupper($this->input->post('emp_permanent_region')),
                                                'emp_prese_street'      => strtoupper($this->input->post('emp_present_street')),
                                                'emp_prese_brgy'        => strtoupper($this->input->post('emp_present_brgy')),
                                                'emp_prese_town'        => strtoupper($this->input->post('emp_present_citymun')),
                                                'emp_prese_province'    => strtoupper($this->input->post('emp_present_province')),
                                                'emp_prese_region'      => strtoupper($this->input->post('emp_present_region')),
                                                'emp_birthdate'         => $this->input->post('emp_birthdate'),
                                                'emp_height'            => $this->input->post('emp_height'),
                                                'emp_weight'            => $this->input->post('emp_weight'),
                                                'emp_bloodtype'         => strtoupper($this->input->post('emp_bloodtype')),
                                                'emp_bplace_town'       => strtoupper($this->input->post('emp_bplace_citymun')),
                                                'emp_bplace_prov'       => strtoupper($this->input->post('emp_bplace_province')),
                                                'emp_bplace_region'        => strtoupper($this->input->post('emp_bplace_region')),
                                                'emp_gender'            => strtoupper($this->input->post('emp_gender')),
                                                'emp_civilstatus'       => strtoupper($this->input->post('emp_civilstatus')),
                                                'emp_citizenship'       => strtoupper($this->input->post('emp_citizenship')),
                                                'emp_religion'          => strtoupper($this->input->post('emp_religion')),
                                                'emp_email'             => strtolower($this->input->post('emp_email_address')),
                                                'emp_telno'             => $this->input->post('emp_telephone_no'),
                                                'emp_mobno'             => $this->input->post('emp_mobile_no'),
                                                'emp_ice_name'          => strtoupper($this->input->post('emp_ice_WName')),
                                                'emp_ice_conno'         => $this->input->post('emp_ice_contactno'),
                                                'emp_ice_relation'      => strtoupper($this->input->post('emp_ice_relation')),
                                                'emp_picture'           => $profile_picture
                                        );
                                }
                                $employee_ids = array(
                                        'SSS_ID'                => $this->input->post('emp_sss_id'),
                                        'HDMF_ID'               => $this->input->post('emp_hdmf_id'),
                                        'PHIC_ID'               => $this->input->post('emp_phic_id'),
                                        'TIN_ID'                => $this->input->post('emp_tin_id'),
                                        'PRC_License'           => $this->input->post('emp_prc_license'),
                                        'PRC_Expdate'           => $this->input->post('emp_prc_expire'),
                                        'CTC_No'                => $this->input->post('emp_ctc'),
                                        'CTC_Date'              => $this->input->post('emp_ctc_date')
                                );

                               
                                $employee_dependents = array(
                                        'emp_dep_LName'         => base64_encode(serialize($this->input->post('dep_lname[]'))),
                                        'emp_dep_FName'         => base64_encode(serialize($this->input->post('dep_fname[]'))),
                                        'emp_dep_MName'         => base64_encode(serialize($this->input->post('dep_mname[]'))),
                                        'emp_dep_NameExt'       => base64_encode(serialize($this->input->post('dep_name_ext[]'))),
                                        'emp_dep_birthdate'     => base64_encode(serialize($this->input->post('dep_bdate[]')))
                                );
                                

                                $employee_education = array(
                                        'education_school'      => base64_encode(serialize($this->input->post('school[]'))),
                                        'education_course'      => base64_encode(serialize($this->input->post('course[]'))),
                                        'education_degree'      => base64_encode(serialize($this->input->post('degree[]'))),
                                        'education_yrlast'      => base64_encode(serialize($this->input->post('yr_grad[]')))
                                );

                                $employee_experience = array(
                                        'experience_firm'       => base64_encode(serialize($this->input->post('employer[]'))),
                                        'experience_position'   => base64_encode(serialize($this->input->post('position[]'))),
                                        'experience_sdate'      => base64_encode(serialize($this->input->post('exp_start_date[]'))),
                                        'experience_edate'      => base64_encode(serialize($this->input->post('exp_end_date[]'))),
                                        'experience_reason'     => base64_encode(serialize($this->input->post('exp_reason[]')))
                                );

                                $employee_family = array(
                                        'emp_father_WName'      => strtoupper($this->input->post('emp_father_WName')),
                                        'emp_father_birthdate'  => $this->input->post('emp_father_birthdate'),
                                        'emp_father_occupation' => strtoupper($this->input->post('emp_father_occupation')),
                                        'emp_father_employer'   => strtoupper($this->input->post('emp_father_employer')),
                                        'emp_mother_WName'      => strtoupper($this->input->post('emp_mother_WName')),
                                        'emp_mother_birthdate'  => $this->input->post('emp_mother_birthdate'),
                                        'emp_mother_occupation' => strtoupper($this->input->post('emp_mother_occupation')),
                                        'emp_mother_employer'   => strtoupper($this->input->post('emp_mother_employer')),
                                        'emp_spouse_WName'      => strtoupper($this->input->post('emp_spouse_WName')),
                                        'emp_spouse_birthdate'  => $this->input->post('emp_spouse_birthdate'),
                                        'emp_spouse_occupation' => strtoupper($this->input->post('emp_spouse_occupation')),
                                        'emp_spouse_employer'   => strtoupper($this->input->post('emp_spouse_employer'))
                                );

                                $employee_record = array(
                                        'record_startdate'      =>base64_encode(serialize($this->input->post('emp_inclusive_startdate[]'))),
                                        'record_enddate'        =>base64_encode(serialize($this->input->post('emp_inclusive_enddate[]'))),
                                        'record_position'       =>base64_encode(serialize($this->input->post('emp_job_position[]'))),
                                        'record_status'         =>base64_encode(serialize($this->input->post('emp_job_status[]'))),
                                        'record_section'        =>base64_encode(serialize($this->input->post('emp_job_section[]'))),
                                );

                                $where_PK = array(
                                        'PK_employee_code' => $employee_code
                                );
                                $where_FK = array(
                                        'FK_employee_code' => $employee_code
                                );

                                $this->emm->update_employee_profile($where_PK,$employee_profile);
                                $this->emm->update_employee_ids($where_FK,$employee_ids);
                                $this->emm->update_employee_dependents($where_FK,$employee_dependents);
                                $this->emm->update_employee_experience($where_FK,$employee_experience);
                                $this->emm->update_employee_education($where_FK,$employee_education);
                                $this->emm->update_employee_family($where_FK,$employee_family);
                                $this->emm->update_employee_record($where_FK,$employee_record);

                                redirect(base_url('View-Employee/'.$employee_code));
                        }
        }
        //ADMIN ROUTING
	public function admin_employee_masterlist()
	{
                if ($this->session->userdata('employee_code')) {
                $header['title_page'] = "Employee Masterlist";
                $data['masterlist'] = $this->emm->get_hired_employee();
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_view_employee',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }elseif($usertype == 'President'){
                        $this->load->view('oic/fragments/oic_header',$header);
                        $this->load->view('oic/fragments/oic_navbar');
                        $this->load->view('oic/oic_view_employee',$data);
                        $this->load->view('oic/fragments/oic_r_sidebar');
                        $this->load->view('oic/fragments/oic_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_view_employee',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }

        public function admin_employee_directory()
	{
                if ($this->session->userdata('employee_code')) {
                $this->load->model('Section_management_model','smm');
                $header['title_page'] = "Employee Directory";
                $data['masterlist'] = $this->emm->get_hired_employee();
                $data['section'] = $this->smm->get_active_section();
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_view_employee_directory',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }elseif($usertype == 'Section'){
                        $this->load->view('section_head/fragments/section_header',$header);
                        $this->load->view('section_head/fragments/section_navbar');
                        $this->load->view('section_head/section_view_employee_directory',$data);
                        $this->load->view('section_head/fragments/section_r_sidebar');
                        $this->load->view('section_head/fragments/section_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_view_employee_directory',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }
        
        public function admin_add_employee()
	{
                if ($this->session->userdata('employee_code')) {
                $this->load->model('Section_management_model','smm');
                $this->load->model('Form_management_model', 'fmm');
                $this->load->model('Position_management_model', 'pmm');
                $header['title_page'] = "Add New Employee";
                $data['employee_code'] = intval($this->emm->get_latest_employee_code())+1;
                $data['ref_region'] = $this->fmm->get_reference_region();
                $data['ref_province'] = $this->fmm->get_reference_province();
                $data['ref_citymun'] = $this->fmm->get_reference_citymun();
                $data['ref_brgy'] = $this->fmm->get_reference_brgy();
                $data['section'] = $this->smm->get_active_section();
                $data['position'] = $this->pmm->get_active_position();
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_add_employee',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_add_employee',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }

        public function admin_edit_employee_profile()
	{
                if ($this->session->userdata('employee_code')) {
                $this->load->model('Leave_management_model','lmm');
                $this->load->model('Section_management_model','smm');
                $this->load->model('Form_management_model', 'fmm');
                $this->load->model('Position_management_model', 'pmm');
                $employee_code = $this->uri->segment(2);
                $header['title_page'] = "EDIT&nbsp;".$this->emm->get_employee_flname($employee_code);
                $data['emp_wname'] = $this->emm->get_employee_wname($employee_code);
                $data['profile'] = $this->emm->get_employee_profile($employee_code);
                $data['leave_history'] = $this->lmm->get_leave_history($employee_code);
                $data['ref_region'] = $this->fmm->get_reference_region();
                $data['ref_province'] = $this->fmm->get_reference_province();
                $data['ref_citymun'] = $this->fmm->get_reference_citymun();
                $data['ref_brgy'] = $this->fmm->get_reference_brgy();
                $data['section'] = $this->smm->get_active_section();
                $data['position'] = $this->pmm->get_active_position();
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_edit_employee',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }elseif($usertype == 'Section'){
                        $this->load->view('section_head/fragments/section_header',$header);
                        $this->load->view('section_head/fragments/section_navbar');
                        $this->load->view('section_head/section_edit_employee',$data);
                        $this->load->view('section_head/fragments/section_r_sidebar');
                        $this->load->view('section_head/fragments/section_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_edit_employee',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }

        public function admin_view_employee_profile()
	{
                if ($this->session->userdata('employee_code')) {
                $this->load->model('Leave_management_model','lmm');
                $this->load->model('Upload_management_model','umm');
                $this->load->model('Attendance_management_model','atmm');
                $employee_code = $this->uri->segment(2);
                $header['title_page'] = $this->emm->get_employee_flname($employee_code);
                $data['emp_wname'] = $this->emm->get_employee_wname($employee_code);
                $data['profile'] = $this->emm->get_employee_profile($employee_code);
                $data['leave_history'] = $this->lmm->get_leave_history($employee_code);
                $data['leave_credit'] = $this->lmm->get_leave_credit($employee_code);
                $data['leave_credit_prev'] = $this->lmm->get_leave_credit_prev($employee_code); 
                $data['emp_files'] = $this->umm->get_employee_files($employee_code);
                $data['att_log'] = $this->atmm->get_attendance_by_ID($employee_code);
                $data['past_att_log'] = $this->atmm->get_attendance_by_ID_past_month($employee_code);
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_employee_profile',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }elseif($usertype == 'Section'){
                        $this->load->view('section_head/fragments/section_header',$header);
                        $this->load->view('section_head/fragments/section_navbar');
                        $this->load->view('section_head/section_employee_profile',$data);
                        $this->load->view('section_head/fragments/section_r_sidebar');
                        $this->load->view('section_head/fragments/section_footer.php');
                }elseif($usertype == 'President'){
                        $this->load->view('oic/fragments/oic_header',$header);
                        $this->load->view('oic/fragments/oic_navbar');
                        $this->load->view('oic/oic_employee_profile',$data);
                        $this->load->view('oic/fragments/oic_r_sidebar');
                        $this->load->view('oic/fragments/oic_footer.php');
                }else{
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_employee_profile',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }
        //FOR EMPLOYEE ONLY
        public function employee_view_employee_profile()
        {
                if ($this->session->userdata('employee_code')) {
                $this->load->model('Leave_management_model','lmm');
                $this->load->model('Upload_management_model','umm');
                $this->load->model('Attendance_management_model','atmm');
                $employee_code = $this->uri->segment(2);
                $header['title_page'] = $this->emm->get_employee_flname($employee_code);
                $data['emp_wname'] = $this->emm->get_employee_wname($employee_code);
                $data['profile'] = $this->emm->get_employee_profile($employee_code);
                $data['leave_history'] = $this->lmm->get_leave_history($employee_code);
                $data['leave_credit'] = $this->lmm->get_leave_credit($employee_code);  
                $data['leave_credit_prev'] = $this->lmm->get_leave_credit_prev($employee_code); 
                $data['emp_files'] = $this->umm->get_employee_files($employee_code);
                $data['att_log'] = $this->atmm->get_attendance_by_ID($employee_code);
                $data['past_att_log'] = $this->atmm->get_attendance_by_ID_past_month($employee_code);
                $usertype = $this->session->userdata('usertype');
                if($usertype == 'Administrator'){
                        $this->load->view('admin/fragments/admin_header',$header);
                        $this->load->view('admin/fragments/admin_navbar');
                        $this->load->view('admin/admin_employee_profile',$data);
                        $this->load->view('admin/fragments/admin_r_sidebar');
                        $this->load->view('admin/fragments/admin_footer.php');
                }elseif($usertype =="Payroll" || $usertype== "HR"){
                        $this->load->view('hr_payroll/fragments/payroll_header',$header);
                        $this->load->view('hr_payroll/fragments/payroll_navbar');
                        $this->load->view('hr_payroll/payroll_employee_profile',$data);
                        $this->load->view('hr_payroll/fragments/payroll_r_sidebar');
                        $this->load->view('hr_payroll/fragments/payroll_footer.php');
                }elseif($usertype =="President"){
                        $this->load->view('ceo/fragments/ceo_header',$header);
                        $this->load->view('ceo/fragments/ceo_navbar');
                        $this->load->view('ceo/ceo_employee_profile',$data);
                        $this->load->view('ceo/fragments/ceo_r_sidebar');
                        $this->load->view('ceo/fragments/ceo_footer.php');
                }elseif($usertype =="Section"){
                        $this->load->view('section_head/fragments/section_header',$header);
                        $this->load->view('section_head/fragments/section_navbar');
                        $this->load->view('section_head/section_employee_profile',$data);
                        $this->load->view('section_head/fragments/section_r_sidebar');
                        $this->load->view('section_head/fragments/section_footer.php');
                }elseif($usertype =="Employee"){
                        $this->load->view('employee/fragments/employee_header',$header);
                        $this->load->view('employee/fragments/employee_navbar');
                        $this->load->view('employee/employee_employee_profile',$data);
                        $this->load->view('employee/fragments/employee_r_sidebar');
                        $this->load->view('employee/fragments/employee_footer.php');
                }
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }
        public function employee_edit_employee_profile()
        {
                if ($this->session->userdata('employee_code')) {
                $this->load->model('Leave_management_model','lmm');
                $this->load->model('Upload_management_model','umm');
                $this->load->model('Form_management_model', 'fmm');
                $employee_code = $this->uri->segment(2);
                $header['title_page'] = $this->emm->get_employee_flname($employee_code);
                $data['emp_wname'] = $this->emm->get_employee_wname($employee_code);
                $data['profile'] = $this->emm->get_employee_profile($employee_code);
                $data['leave_history'] = $this->lmm->get_leave_history($employee_code);
                $data['leave_credit'] = $this->lmm->get_leave_credit($employee_code);
                $data['emp_files'] = $this->umm->get_employee_files($employee_code);
                $data['ref_region'] = $this->fmm->get_reference_region();
                $data['ref_province'] = $this->fmm->get_reference_province();
                $data['ref_citymun'] = $this->fmm->get_reference_citymun();
                $data['ref_brgy'] = $this->fmm->get_reference_brgy();
                $this->load->view('employee/fragments/employee_header',$header);
                $this->load->view('employee/fragments/employee_navbar');
                $this->load->view('employee/employee_edit_employee',$data);
                $this->load->view('employee/fragments/employee_r_sidebar');
                $this->load->view('employee/fragments/employee_footer.php');
        } else {
                Redirect(base_url('HRMISystem'));
            }
        }
        public function employee_update_employee_function(){
                // BASIC INFORMATION TAB
                $this->form_validation->set_rules('emp_permanent_street', '(No./St./Sub/Sitio)', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_permanent_brgy', 'Barangay', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_permanent_region', 'Region', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_permanenet_province', 'Province', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_permanent_citymun', 'City/Town', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_present_street', '(No./St./Sub/Sitio)', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_present_brgy', 'Barangay', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_present_region', 'Region', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_present_province', 'Province', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_present_citymun', 'City/Town', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_height', 'Height', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_weight', 'Weight', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_bloodtype', 'Blood Type', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_bplace_region', 'Birthplace(Region)', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_bplace_province', 'Birthplace(Province)', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_bplace_citymun', 'Birthplace(City/Town)', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_citizenship', 'Citizenship', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_civilstatus', 'Civil Status', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_religion', 'Religion', 'xss_clean|trim');
                // ADDITIONAL INFORMATION TAB
                $this->form_validation->set_rules('emp_email_address', 'Email Address', 'xss_clean|trim|required', array('required' => '%s'));
                $this->form_validation->set_rules('emp_mobile_no', 'Mobile Number', 'xss_clean|trim|required', array('required' => '%s'));
                $this->form_validation->set_rules('emp_telephone_no', 'Telephone Number', 'xss_clean|trim');
                // WORK EXPERIENCE
                $this->form_validation->set_rules('employer[]', 'Firm/Office', 'xss_clean|trim');
                $this->form_validation->set_rules('position[]', 'Position Held', 'xss_clean|trim');
                $this->form_validation->set_rules('exp_start_date[]', 'Start Date', 'xss_clean|trim');
                $this->form_validation->set_rules('exp_end_date[]', 'End Date', 'xss_clean|trim');
                $this->form_validation->set_rules('exp_reason[]', 'End Date', 'xss_clean|trim');
                // EDUCATION HISTORY
                $this->form_validation->set_rules('school[]', 'School Attended', 'xss_clean|trim');
                $this->form_validation->set_rules('course[]', 'Course Pursued', 'xss_clean|trim');
                $this->form_validation->set_rules('degree[]', 'Degree Earned', 'xss_clean|trim');
                $this->form_validation->set_rules('yr_grad[]', 'Year Graduated', 'xss_clean|trim');
                // FAMILY BACKGROUND
                $this->form_validation->set_rules('emp_father_WName', 'Father\'s Name', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_father_birthdate', 'Father\'s Date of Birth', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_father_occupation', 'Father\'s Occupation', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_father_employer', 'Father\'s Employer', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_mother_WName', 'Mother\'s Name', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_mother_birthdate', 'Mother\'s Date of Birth', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_mother_occupation', 'Mother\'s Occupation', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_mother_employer', 'Mother\'s Employer', 'xss_clean|trim');
                // IN CASE OF EMERGENCY
                $this->form_validation->set_rules('emp_ice_WName', 'Contact Person', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_ice_contactno', 'Contact Number', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_ice_address', 'Contact Person\'s Address(Region)', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_ice_relation', 'Relationship', 'xss_clean|trim');
                // SPOUSE INFORMATION
                $this->form_validation->set_rules('emp_spouse_WName', 'Spouse\'s Last name', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_spouse_birthdate', 'Spouse\'s Birthday', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_spouse_occupation', 'Spouse\'s Occupation', 'xss_clean|trim');
                $this->form_validation->set_rules('emp_spouse_employer', 'Spouse\'s Employer', 'xss_clean|trim');
                // DEPENDENTS
                $this->form_validation->set_rules('dep_lname[]', 'Dependent\'s Last Name');
                $this->form_validation->set_rules('dep_fname[]', 'Dependent\'s First Name', 'xss_clean|trim');
                $this->form_validation->set_rules('dep_mname[]', 'Dependent\'s Middle Name', 'xss_clean|trim');
                $this->form_validation->set_rules('dep_name_ext[]', 'Dependent\'s Name Extension', 'xss_clean|trim');
                $this->form_validation->set_rules('dep_bdate[]', 'Dependent\'s Birthday', 'xss_clean|trim');

                if ($this->form_validation->run() == false) {
                        $error['error_msg'] = 'Registration Error';
                        $error['title'] = 'Registration Error';
                        $error['code'] = 'HRIS:Eemm|ref|XLn90';
                        $error['module'] ='Employee Registration';
                        $this->load->view('hris_errors/error_page',$error);
                } else {
                        $employee_code = $this->uri->segment(2);
                        // UPLOADING EMPLOEYE PHOTO
                        if (empty($_FILES['userfile']['tmp_name'])) {
                                $employee_profile = array(
                                        'emp_perma_street'      => strtoupper($this->input->post('emp_permanent_street')),
                                        'emp_perma_brgy'        => strtoupper($this->input->post('emp_permanent_brgy')),
                                        'emp_perma_town'        => strtoupper($this->input->post('emp_permanent_citymun')),
                                        'emp_perma_province'    => strtoupper($this->input->post('emp_permanent_province')),
                                        'emp_perma_region'      => strtoupper($this->input->post('emp_permanent_region')),
                                        'emp_prese_street'      => strtoupper($this->input->post('emp_present_street')),
                                        'emp_prese_brgy'        => strtoupper($this->input->post('emp_present_brgy')),
                                        'emp_prese_town'        => strtoupper($this->input->post('emp_present_citymun')),
                                        'emp_prese_province'    => strtoupper($this->input->post('emp_present_province')),
                                        'emp_prese_region'      => strtoupper($this->input->post('emp_present_region')),
                                        'emp_height'            => $this->input->post('emp_height'),
                                        'emp_weight'            => $this->input->post('emp_weight'),
                                        'emp_bloodtype'         => strtoupper($this->input->post('emp_bloodtype')),
                                        'emp_bplace_town'       => strtoupper($this->input->post('emp_bplace_citymun')),
                                        'emp_bplace_prov'       => strtoupper($this->input->post('emp_bplace_province')),
                                        'emp_bplace_region'        => strtoupper($this->input->post('emp_bplace_region')),
                                        'emp_civilstatus'       => strtoupper($this->input->post('emp_civilstatus')),
                                        'emp_citizenship'       => strtoupper($this->input->post('emp_citizenship')),
                                        'emp_religion'          => strtoupper($this->input->post('emp_religion')),
                                        'emp_email'             => $this->input->post('emp_email_address'),
                                        'emp_telno'             => $this->input->post('emp_telephone_no'),
                                        'emp_mobno'             => $this->input->post('emp_mobile_no'),
                                        'emp_ice_name'          => strtoupper($this->input->post('emp_ice_WName')),
                                        'emp_ice_conno'         => $this->input->post('emp_ice_contactno'),
                                        'emp_ice_relation'      => strtoupper($this->input->post('emp_ice_relation'))
                                );
                        } else {
                                $file = $_FILES['userfile'];
                                $name = $file['name'];
                                $folder_name = 'employee_picture';
                                $config['upload_path'] = './uploads/employee/' . $employee_code . '/' . $folder_name;
                                $config['allowed_types'] = 'jpg|png';

                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);

                                if (!is_dir('uploads/employee/' . $employee_code . '/' . $folder_name)) {
                                        mkdir('./uploads/employee/' . $employee_code . '/' . $folder_name, 0777, true);
                                }

                                if (!$this->upload->do_upload('userfile')) {
                                        $error = array('error' => $this->upload->display_errors()); 
                                        // $this->load->view('home_view', $error); 
                                        echo "Picture to be upload is big";
                                } else {
                                        $data = array('upload_data' => $this->upload->data());
                                }
                                $profile_picture = "uploads/employee/" . $employee_code . "/" . $folder_name . "/" . $name;
                                $employee_profile = array(
                                        'emp_perma_street'      => strtoupper($this->input->post('emp_permanent_street')),
                                        'emp_perma_brgy'        => strtoupper($this->input->post('emp_permanent_brgy')),
                                        'emp_perma_town'        => strtoupper($this->input->post('emp_permanent_citymun')),
                                        'emp_perma_province'    => strtoupper($this->input->post('emp_permanent_province')),
                                        'emp_perma_region'      => strtoupper($this->input->post('emp_permanent_region')),
                                        'emp_prese_street'      => strtoupper($this->input->post('emp_present_street')),
                                        'emp_prese_brgy'        => strtoupper($this->input->post('emp_present_brgy')),
                                        'emp_prese_town'        => strtoupper($this->input->post('emp_present_citymun')),
                                        'emp_prese_province'    => strtoupper($this->input->post('emp_present_province')),
                                        'emp_prese_region'      => strtoupper($this->input->post('emp_present_region')),
                                        'emp_height'            => $this->input->post('emp_height'),
                                        'emp_weight'            => $this->input->post('emp_weight'),
                                        'emp_bloodtype'         => strtoupper($this->input->post('emp_bloodtype')),
                                        'emp_bplace_town'       => strtoupper($this->input->post('emp_bplace_citymun')),
                                        'emp_bplace_prov'       => strtoupper($this->input->post('emp_bplace_province')),
                                        'emp_bplace_region'        => strtoupper($this->input->post('emp_bplace_region')),
                                        'emp_civilstatus'       => strtoupper($this->input->post('emp_civilstatus')),
                                        'emp_citizenship'       => strtoupper($this->input->post('emp_citizenship')),
                                        'emp_religion'          => strtoupper($this->input->post('emp_religion')),
                                        'emp_email'             => strtolower($this->input->post('emp_email_address')),
                                        'emp_telno'             => $this->input->post('emp_telephone_no'),
                                        'emp_mobno'             => $this->input->post('emp_mobile_no'),
                                        'emp_ice_name'          => strtoupper($this->input->post('emp_ice_WName')),
                                        'emp_ice_conno'         => $this->input->post('emp_ice_contactno'),
                                        'emp_ice_relation'      => strtoupper($this->input->post('emp_ice_relation')),
                                        'emp_picture'           => $profile_picture
                                );
                        }

                        $employee_dependents = array(
                                'emp_dep_LName'         => base64_encode(serialize($this->input->post('dep_lname[]'))),
                                'emp_dep_FName'         => base64_encode(serialize($this->input->post('dep_fname[]'))),
                                'emp_dep_MName'         => base64_encode(serialize($this->input->post('dep_mname[]'))),
                                'emp_dep_NameExt'       => base64_encode(serialize($this->input->post('dep_name_ext[]'))),
                                'emp_dep_birthdate'     => base64_encode(serialize($this->input->post('dep_bdate[]')))
                        );

                        $employee_education = array(
                                'education_school'      => base64_encode(serialize($this->input->post('school[]'))),
                                'education_course'      => base64_encode(serialize($this->input->post('course[]'))),
                                'education_degree'      => base64_encode(serialize($this->input->post('degree[]'))),
                                'education_yrlast'      => base64_encode(serialize($this->input->post('yr_grad[]')))
                        );

                        $employee_experience = array(
                                'experience_firm'       => base64_encode(serialize($this->input->post('employer[]'))),
                                'experience_position'   => base64_encode(serialize($this->input->post('position[]'))),
                                'experience_sdate'      => base64_encode(serialize($this->input->post('exp_start_date[]'))),
                                'experience_edate'      => base64_encode(serialize($this->input->post('exp_end_date[]'))),
                                'experience_reason'     => base64_encode(serialize($this->input->post('exp_reason[]')))
                        );

                        $employee_family = array(
                                'emp_father_WName'      => strtoupper($this->input->post('emp_father_WName')),
                                'emp_father_birthdate'  => $this->input->post('emp_father_birthdate'),
                                'emp_father_occupation' => strtoupper($this->input->post('emp_father_occupation')),
                                'emp_father_employer'   => strtoupper($this->input->post('emp_father_employer')),
                                'emp_mother_WName'      => strtoupper($this->input->post('emp_mother_WName')),
                                'emp_mother_birthdate'  => $this->input->post('emp_mother_birthdate'),
                                'emp_mother_occupation' => strtoupper($this->input->post('emp_mother_occupation')),
                                'emp_mother_employer'   => strtoupper($this->input->post('emp_mother_employer')),
                                'emp_spouse_WName'      => strtoupper($this->input->post('emp_spouse_WName')),
                                'emp_spouse_birthdate'  => $this->input->post('emp_spouse_birthdate'),
                                'emp_spouse_occupation' => strtoupper($this->input->post('emp_spouse_occupation')),
                                'emp_spouse_employer'   => strtoupper($this->input->post('emp_spouse_employer'))
                        );

                        $employee_record = array(
                                'record_startdate'      =>base64_encode(serialize($this->input->post('emp_inclusive_startdate[]'))),
                                'record_enddate'        =>base64_encode(serialize($this->input->post('emp_inclusive_enddate[]'))),
                                'record_position'       =>base64_encode(serialize($this->input->post('emp_job_position[]'))),
                                'record_status'         =>base64_encode(serialize($this->input->post('emp_job_status[]'))),
                                'record_section'        =>base64_encode(serialize($this->input->post('emp_job_section[]'))),
                        );

                        $where_PK = array(
                                'PK_employee_code' => $employee_code
                        );
                        $where_FK = array(
                                'FK_employee_code' => $employee_code
                        );
                        $this->emm->update_employee_profile($where_PK,$employee_profile);
                        $this->emm->update_employee_dependents($where_FK,$employee_dependents);
                        $this->emm->update_employee_experience($where_FK,$employee_experience);
                        $this->emm->update_employee_education($where_FK,$employee_education);
                        $this->emm->update_employee_family($where_FK,$employee_family);
                        $this->emm->update_employee_record($where_FK,$employee_record);
                        redirect(base_url('View-My-Profile/'.$employee_code));
                }
        }


        public function section_members_masterlist(){
                if ($this->session->userdata('employee_code')) {
                        $employee_code = $this->session->userdata('employee_code');
                        $header['title_page'] = "Members Masterlist";
                        $data['masterlist'] = $this->emm->get_section_members($employee_code);
                        $usertype = $this->session->userdata('usertype');
                        if($usertype == 'Section'){
                                $this->load->view('section_head/fragments/section_header',$header);
                                $this->load->view('section_head/fragments/section_navbar');
                                $this->load->view('section_head/section_view_employee',$data);
                                $this->load->view('section_head/fragments/section_r_sidebar');
                                $this->load->view('section_head/fragments/section_footer.php');
                        }else{
                                Redirect(base_url('HRMISystem'));
                        }
                } else {
                        Redirect(base_url('HRMISystem'));
                    }
        }

        public function section_members_directory(){
                if ($this->session->userdata('employee_code')) {
                        $employee_code = $this->session->userdata('employee_code');
                        $header['title_page'] = "Members Masterlist";
                        $data['masterlist'] = $this->emm->get_section_members($employee_code);
                        $usertype = $this->session->userdata('usertype');
                        if($usertype == 'Section'){
                                $this->load->view('section_head/fragments/section_header',$header);
                                $this->load->view('section_head/fragments/section_navbar');
                                $this->load->view('section_head/section_view_employee_directory',$data);
                                $this->load->view('section_head/fragments/section_r_sidebar');
                                $this->load->view('section_head/fragments/section_footer.php');
                        }else{
                                Redirect(base_url('HRMISystem'));
                        }
                } else {
                        Redirect(base_url('HRMISystem'));
                    }
        }
}
