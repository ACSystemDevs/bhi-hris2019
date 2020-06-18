<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Verification';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////GLOBAL ROUTING BELOW/////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
$route['HRMISystem'] = 'Landing/index';
$route['Login_Verification'] = 'Verification/login_user_account';
$route['Logout'] = 'Verification/logout';
//ADMIN : HR : PAYROLL  
$route['Register-Employee-Function'] = 'Employee/register_employee_function';
$route['Update-Employee-Function/(:num)'] = 'Employee/update_employee_function/$1';
$route['Add-Department-Function'] = 'Department/add_department_function';
$route['Edit-Department-Function/(:num)'] = 'Department/update_department_function/$1';
$route['Add-Section-Function'] = 'Section/add_section_function';
$route['Edit-Section-Function/(:num)'] = 'Section/update_section_function/$1';
$route['Add-Position-Function'] = 'Position/add_position_function';
$route['Edit-Position-Function/(:num)'] = 'Position/update_position_function/$1';
$route['Add-LeaveType-Function'] = 'Leave/add_leave_function';
$route['Add-Leave-Credit-Function/(:num)'] = 'Leave/add_leave_credit/$1';
$route['Edit-Leave-Credit-Function/(:num)'] = 'Leave/edit_leave_credit/$1';
$route['Upload-Employee-File-Function/(:num)'] = 'Upload/upload_employee_file/$1';
$route['Request-Leave/(:num)'] = 'Leave/employee_request_leave/$1';
$route['Generate_VLeave_Credit'] = 'Reports/generate_vleave_credits';
$route['Leave_Credit_Allocation'] = 'Reports/generate_leavecredit_allocation';
$route['Leave_Credit_Allocation_perday'] = 'Reports/generate_leavecredit_allocation_perday';
//ALL USER LEVEL
$route['Request-Leave-Function/(:num)'] = 'Leave/request_leave_function/$1';
$route['Calculate-Attendance'] = 'Attendance/Calculate_attendance_by_Date';
$route['Calculate-Attendance_prev'] = 'Attendance/Calculate_attendance_by_Date_prev';
$route['Attendance-Viewer'] = 'Attendance/Redirect_to_Viewer';
// REPORTING ADMIN
$route['Report-General'] = 'Reports';
$route['Report-Customized'] = 'Reports/report_customized_redirect';
$route['Generate_Employee_Masterlist'] = "Reports/generate_employee_masterlist";
$route['Generate_Employee_IDs'] = "Reports/generate_employee_ids";
$route['Generate_Birthday_Celebrant'] = "Reports/generate_birthday_celebrant";
$route['Generate_Employee_Dependents'] = "Reports/generate_employee_dependents";
$route['Generate_Section_Department_Heads'] = "Reports/generate_section_department_heads";
$route['Generate_Count_Section'] = "Reports/generate_count_section";
$route['Generate_Age_Distribution'] = "Reports/generate_age_distribution";
$route['Generate_Employee_Directory'] = "Reports/generate_employee_directory";
$route['Generate_Daily_Time_Record'] = "Reports/view_all_employee_dtr";
$route['Generate_Daily_Time_Record_Previous_PDF'] = "Reports/generate_employee_dtr_previous_pdf";
$route['Generate_Daily_Time_Record_Current_PDF'] ='Reports/generate_employee_dtr_current_pdf';
$route['Generate_Daily_Time_Record_Contractual'] = 'Reports/generate_contractual_employee_dtr_1to5';
$route['Generate_All_Leave_Request_Prev_Month'] = 'Reports/generate_leave_request_prev_month';
$route['Generate_All_Leave_Request_Prev_Month_Summary'] = 'Reports/generate_leave_request_prev_month_summary';
$route['Generate_Daily_Time_Record_Contractual_620'] = 'Reports/generate_contractual_employee_dtr_6to20';
$route['Generate_Leave_Tally_Annual'] ="Reports/generate_leave_tally_annual";
$route['Generate-Custom-Report'] = 'Reports/generate_customized_report';
$route['View-My-Account/(:num)'] = 'User/others_update_username_password/$1';
$route['Update-UserAccount/(:num)'] = 'User/account_settings_save_changes/$1';
$route['Create-New-Attendance-Record/(:num)'] = 'Attendance/create_new_attendance_record/$1';
$route['Generate_Emp_Designation'] = 'Reports/generate_emp_designation';
$route['Generate_Employee_Information'] = 'Reports/generate_emp_information';
//STRICT!
///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////ADMIN ROUTING BELOW//////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
//ADMIN FUNCTIONS
$route['Add-New-User-Function'] = 'User/add_user_function';
// ADMIN ROUTING
$route['Dashboard'] = 'Dashboard';
// ADMIN EMPLOYEE
$route['Employee-Masterlist'] = 'Employee/admin_employee_masterlist';
$route['Employee-Directory'] = 'Employee/admin_employee_directory';
$route['Add-Employee'] = 'Employee/admin_add_employee';
$route['View-Employee/(:num)'] = 'Employee/admin_view_employee_profile/$1';
$route['Edit-Employee/(:num)'] = 'Employee/admin_edit_employee_profile/$1';
$route['Upload-File/(:num)']= 'Upload/admin_upload_file/$1';
// ADMIN LEAVE
$route['Leave-Application'] = 'Leave/admin_leave_application';
$route['Leave-Archives'] = 'Leave/admin_leave_archives';
$route['Add-Leave-Type'] = 'Leave/admin_add_leave';
$route['Employee-Request-Leave'] = 'Leave/admin_request_leave';
//ADMIN ATTENDANCE
$route['Employee-Attendance'] ='Attendance/admin_view_employee_dtr';
$route['Employee-Attendance_prev'] = 'Attendance/admin_view_employee_dtr_prev';
$route['Overtime-Requests'] = 'Attendance/admin_view_overtime_requests';
$route['Exchange-Duty-Requests'] = 'Attendance/admin_view_exchange_duty_requests';
$route['Work-on-Dayoff-Requests'] = 'Attendance/admin_view_workonoff_requests';
// ADMIN DEPARTMENT
$route['Manage-Department'] = 'Department/admin_manage_department';
// ADMIN SECTION
$route['Manage-Section'] = 'Section/admin_manage_section';
// ADMIN POSITION
$route['Manage-Position'] = 'Position/admin_manage_position';
// ADMIN USER
$route['Manage-Users'] = 'User/admin_manage_user';
$route['Save_User_Account_Changes'] = 'User/save_useraccount_changes';
$route['Save_Password_Changes'] = 'User/save_password_changes';
$route['Change_Account_Status_Inactive/(:num)'] = 'User/account_status_inactive/$1';
$route['Change_Account_Status_Active/(:num)'] = 'User/account_status_active/$1';
//ROUTING FOR AJAX FUNCTIONS
$route['View_Leave_Request_byID/(:num)'] = 'Leave/leave_request_view/$1';
$route['View_Leave_Credit_byID/(:num)'] = 'Leave/leave_credit_view/$1';
$route['Admin_Approve_Leave_Request_byID/(:num)/(:num)/(:num)'] ='Leave/admin_leave_noted_request/$1/$2/$3';
$route['Admin_Disapprove_Noted_Leave_Request_byID/(:num)/(:num)/(:num)'] ='Leave/admin_leave_denied_noted_request/$1/$2/$3';
$route['Admin_Disapprove_Leave_Request_byID/(:num)'] ='Leave/admin_leave_denied_request/$1';
$route['Get_Active_Position'] = 'Position/get_position_json_encode';
$route['Get_Active_Section'] = 'Section/get_section_json_encode';
$route['Get_Department_Info_byID/(:num)'] = 'Department/department_details_byID/$1';
$route['Get_Section_Info_byID/(:num)'] = 'Section/section_details_byID/$1';
$route['Get_Position_Info_byID/(:num)'] = 'Position/position_details_byID/$1';
$route['Get_Uploaded_File_Details/(:num)'] = 'Upload/uploaded_file_details_byID/$1';
$route['Get_UserAccount_Info_byID/(:num)'] = 'User/useraccount_details_byID/$1';
// STRICT!!! FOR ADMIN ONLY
$route['Manage-UFace402-Device'] = 'AdminSettings/admin_view_manage_uface';
$route['Terminal-to-HRMIS-Sync'] ='AdminSettings/save_data_from_device_to_db';
$route['Manage-System-Database'] = 'AdminSettings/admin_view_manage_settings';
$route['Terminal-Time-Sync'] = 'AdminSettings/sync_time_to_terminal';
///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////EMPLOYEE ROUTING BELOW///////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
$route['View-My-Profile/(:num)'] = 'Employee/employee_view_employee_profile/$1';
$route['Edit-My-Profile/(:num)'] = 'Employee/employee_edit_employee_profile/$1';
$route['File-Leave-Request/(:num)'] = 'Leave/employee_request_leave/$1';
$route['Employee-Update-Employee-Function/(:num)'] = 'Employee/employee_update_employee_function/$1';
$route['File-Leave-Request/(:num)'] = 'Leave/employee_request_personal_leave/$1';
$route['My-Leave-Application/(:num)'] = 'Leave/employee_leave_application/$1';
///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////PAYROLL/HR ROUTING BELOW/////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
//PAYROLL EMPLOYEE
$route['Employee-Masterlist-HRPO'] = 'Employee/payroll_employee_masterlist';
$route['Employee-Directory-HRPO'] = 'Employee/payroll_employee_directory';
$route['Add-Employee-HRPO'] = 'Employee/payroll_add_employee';
$route['View-Employee-HRPO/(:num)'] = 'Employee/payroll_view_employee_profile/$1';
$route['Edit-Employee-HRPO/(:num)'] = 'Employee/payroll_edit_employee_profile/$1';
$route['Upload-File-HRPO/(:num)']= 'Upload/payroll_upload_file/$1';
//PAYROLL LEAVE
$route['Leave-Application-HRPO'] = 'Leave/payroll_leave_application';
$route['Leave-Archives-HRPO'] = 'Leave/payroll_leave_archives';
$route['Add-Leave-Type-HRPO'] = 'Leave/payroll_add_leave';
$route['Employee-Request-Leave-HRPO'] = 'Leave/payroll_request_leave';
$route['Request-Leave-HRPO/(:num)'] = 'Leave/payroll_employee_request_leave/$1';
//PAYROLL ATTENDANCE
$route['Employee-Attendance-HRPO'] ='Attendance/payroll_view_employee_dtr';
$route['Overtime-Requests-HRPO'] = 'Attendance/payroll_view_overtime_requests';
$route['Exchange-Duty-Requests-HRPO'] = 'Attendance/payroll_view_exchange_duty_requests';
$route['Work-on-Dayoff-Requests-HRPO'] = 'Attendance/payroll_view_workonoff_requests';
// PAYROLL HR APPROVE LEAVE
$route['HR_Approve_Leave_Request_byID/(:num)'] ='Leave/hr_leave_approve_request/$1';
$route['HR_Disapprove_Leave_Request_byID/(:num)'] ='Leave/hr_leave_disapprove_request/$1';
///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////SECTION HEAD ROUTING BELOW///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
$route['Members-Masterlist'] = 'Employee/section_members_masterlist';
$route['View-Member-Profile/(:num)'] = 'Employee/admin_view_employee_profile/$1';
$route['Members-Directory'] = 'Employee/section_members_directory';
$route['Request-Leave-Member/(:num)'] = 'Leave/employee_request_leave_section/$1';
$route['Employee-Request-Leave-Section'] = 'Leave/view_leave_request_section';
$route['Leave-Application-Section'] = 'Leave/section_leave_application';
$route['Section_Approve_Leave_Request_byID/(:num)'] ='Leave/section_leave_approve_request/$1';
$route['Section_Disapprove_Leave_Request_byID/(:num)'] ='Leave/section_leave_disapprove_request/$1';
///////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////OIC ROUTING BELOW//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
$route['OIC_Approve_Leave_Request_byID/(:num)'] ='Leave/oic_leave_approve_request/$1';
$route['OIC_Disapprove_Leave_Request_byID/(:num)'] ='Leave/oic_leave_disapprove_request/$1';


