<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function export_employee_masterlist(){
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_employee_ids ids','emp.PK_employee_code = ids.FK_employee_code','left');
        $this->db->join('tbl_employee_record rec','emp.PK_employee_code = rec.FK_employee_code','left');
        $this->db->join('tbl_system_users sys','emp.PK_employee_code = sys.FK_employee_code','left');
        $this->db->where('emp.PK_employee_code !=','00000');
        $this->db->where('sys.user_status', 'Active');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);

        $masterlist = array();
        for($i=0;$i<=($rows-1);$i++){
            $birthday           = date('Y-m-d',strtotime($result[$i]['emp_birthdate']));
            $today              = date('Y-m-d');
            list($y1, $m1, $d1) = explode('-', $birthday);
            list($y2, $m2, $d2) = explode('-', $today);
            $m1                 = $m2 - $m1;
            if ($m1 < 0 || ($m1 == 0 && $d2 - $d1 < 0)){
            $y1++;
            }
            $age = $y2 - $y1;
            $age = floor((time() - strtotime($birthday)) / 31556926);
            $datetime = date_diff(date_create(), date_create($birthday));
            $age_yr      = $datetime->format('%Y');
            if ((is_array(unserialize(base64_decode($result[$i]['record_position']))) && count(unserialize(base64_decode($result[$i]['record_position']))) > 0 && unserialize(base64_decode($result[$i]['record_position']))[0] != '')) {
                $pos_count = (count(unserialize(base64_decode($result[$i]['record_position'])))) -1;
                $position =  unserialize(base64_decode($result[$i]['record_position']))[$pos_count];
            }else{
                $position =  'Unassigned';
            }
            if ((is_array(unserialize(base64_decode($result[$i]['record_section']))) && count(unserialize(base64_decode($result[$i]['record_section']))) > 0 && unserialize(base64_decode($result[$i]['record_section']))[0] != '')) {
                $sec_count = (count(unserialize(base64_decode($result[$i]['record_section'])))) -1;
                $section =  unserialize(base64_decode($result[$i]['record_section']))[$sec_count];
            }else{
                $section =  'Unassigned';
            }
            if ((is_array(unserialize(base64_decode($result[$i]['record_status']))) && count(unserialize(base64_decode($result[$i]['record_status']))) > 0 && unserialize(base64_decode($result[$i]['record_status']))[0] != '')) {
                $rec_count = (count(unserialize(base64_decode($result[$i]['record_status'])))) -1;
                $emp_status =  unserialize(base64_decode($result[$i]['record_status']))[$rec_count];
            }else{
                $emp_status =  'Unassigned';
            }
            if ((is_array(unserialize(base64_decode($result[$i]['record_startdate']))) && count(unserialize(base64_decode($result[$i]['record_startdate']))) > 0 && unserialize(base64_decode($result[$i]['record_startdate']))[0] != '')) {
                $date_hired1 =  date('Y-m-d',strtotime(unserialize(base64_decode($result[$i]['record_startdate']))[0]));
                $date_hired =   date('F d,Y',strtotime(unserialize(base64_decode($result[$i]['record_startdate']))[0]));
                $present_day              = date('Y-m-d');
                list($y11, $m11, $d11) = explode('-', $date_hired1);
                list($y22, $m22, $d22) = explode('-', $present_day);
                $m11                 = $m22 - $m11;
                if ($m11 < 0 || ($m11 == 0 && $d22 - $d11 < 0)){
                $y11++;
                }
                $yrs = $y22 - $y11;
                $yrs = floor((time() - strtotime($birthday)) / 31556926);
                $diff = date_diff(date_create(), date_create($birthday));
                $yrs_of_service      = $datetime->format('%Y');
            }else{
                $date_hired  = 'Not Applicable';
                $yrs_of_service = 'Not Applicable';
            }
            $bplace     = $result[$i]['emp_bplace_town'].', '.$result[$i]['emp_bplace_prov'].', '.$result[$i]['emp_bplace_region'];
            $prese_add  = $result[$i]['emp_prese_street'].', '.$result[$i]['emp_prese_brgy'].', '.$result[$i]['emp_prese_town'].', '.$result[$i]['emp_prese_province'].', '.$result[$i]['emp_prese_region'];
            $perma_add  = $result[$i]['emp_perma_street'].', '.$result[$i]['emp_perma_brgy'].', '.$result[$i]['emp_perma_town'].', '.$result[$i]['emp_perma_province'].', '.$result[$i]['emp_perma_region'];
            if((!empty($result[$i]['emp_perma_brgy']) || !empty($result[$i]['emp_perma_town']) || !empty($result[$i]['emp_perma_province']) || !empty($result[$i]['emp_perma_region'])) === FALSE){
                $perma_add = $prese_add;
            }
            $data = array(
                'employee_code' => $result[$i]['PK_employee_code'],
                'emp_wname'     => $result[$i]['emp_LName'].', '.$result[$i]['emp_FName'].' '.substr($result[$i]['emp_MName'],0,1).' '.$result[$i]['emp_NameExt'],
                'birthdate'     => date('F d, Y',strtotime($result[$i]['emp_birthdate'])),
                'age'           => $age_yr,
                'mob_no'        => $result[$i]['emp_mobno'],
                'tel_no'        => $result[$i]['emp_telno'],
                'email'         => $result[$i]['emp_email'],
                'sex'           => $result[$i]['emp_gender'],
                'prese_add'     => $prese_add,
                'perma_add'     => $perma_add,
                'civil_stat'    => $result[$i]['emp_civilstatus'],
                'section'       => $section,
                'position'      => $position,
                'emp_status'    => $emp_status,
                'date_hired'    => $date_hired,
                'yrs_service'   => $yrs_of_service,
                'TIN'           => $result[$i]['TIN_ID'],
                'SSS'           => $result[$i]['SSS_ID'],
                'PHIC'          => $result[$i]['PHIC_ID'],
                'HDMF'          => $result[$i]['HDMF_ID'],
                'CTC_no'        => $result[$i]['CTC_No'],
                'Date_Issued'   => $result[$i]['CTC_Date'],
                'License_no'    => $result[$i]['PRC_License'],
                'exp_date'      => $result[$i]['PRC_Expdate'],
                'bplace'        => $bplace,
            );
            array_push($masterlist, $data);
        }
        return $masterlist;
    }

    public function export_employee_information(){
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_system_users sys','emp.PK_employee_code = sys.FK_employee_code','left');
        $this->db->where('emp.PK_employee_code !=','00000');
        $this->db->where('sys.user_status', 'Active');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);
        $masterlist = array();
        for($i=0;$i<=($rows-1);$i++){
            $birthday           = date('Y-m-d',strtotime($result[$i]['emp_birthdate']));
            $today              = date('Y-m-d');
            list($y1, $m1, $d1) = explode('-', $birthday);
            list($y2, $m2, $d2) = explode('-', $today);
            $m1                 = $m2 - $m1;
            if ($m1 < 0 || ($m1 == 0 && $d2 - $d1 < 0)){
            $y1++;
            }
            $age = $y2 - $y1;
            $age = floor((time() - strtotime($birthday)) / 31556926);
            $datetime = date_diff(date_create(), date_create($birthday));
            $age_yr      = $datetime->format('%Y');
            $bplace     = $result[$i]['emp_bplace_town'].', '.$result[$i]['emp_bplace_prov'].', '.$result[$i]['emp_bplace_region'];
            $prese_add  = $result[$i]['emp_prese_street'].', '.$result[$i]['emp_prese_brgy'].', '.$result[$i]['emp_prese_town'].', '.$result[$i]['emp_prese_province'].', '.$result[$i]['emp_prese_region'];
            $perma_add  = $result[$i]['emp_perma_street'].', '.$result[$i]['emp_perma_brgy'].', '.$result[$i]['emp_perma_town'].', '.$result[$i]['emp_perma_province'].', '.$result[$i]['emp_perma_region'];
            if((!empty($result[$i]['emp_perma_brgy']) || !empty($result[$i]['emp_perma_town']) || !empty($result[$i]['emp_perma_province']) || !empty($result[$i]['emp_perma_region'])) === FALSE){
                $perma_add = $prese_add;
            }
            $data = array(
                'employee_code' => $result[$i]['PK_employee_code'],
                'emp_wname'     => $result[$i]['emp_LName'].', '.$result[$i]['emp_FName'].' '.substr($result[$i]['emp_MName'],0,1).' '.$result[$i]['emp_NameExt'],
                'birthdate'     => date('F d, Y',strtotime($result[$i]['emp_birthdate'])),
                'age'           => $age_yr,
                'birthplace'    => $bplace,
                'prese_add'     => $prese_add,
                'perma_add'     => $perma_add,
                'civil_stat'    => $result[$i]['emp_civilstatus']
            );
            array_push($masterlist, $data);
        }
            array_multisort($masterlist['emp_wname'], SORT_ASC);
            return $masterlist;
    }

    public function export_employee_ids(){
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_employee_ids ids','emp.PK_employee_code = ids.FK_employee_code','left');
        $this->db->join('tbl_employee_record rec','emp.PK_employee_code = rec.FK_employee_code','left');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);

        $ids = array();
        for($i=0;$i<=($rows-1);$i++){
            if ((is_array(unserialize(base64_decode($result[$i]['record_status']))) && count(unserialize(base64_decode($result[$i]['record_status']))) > 0 && unserialize(base64_decode($result[$i]['record_status']))[0] != '')) {
                $rec_count = (count(unserialize(base64_decode($result[$i]['record_status'])))) -1;
                $emp_status =  unserialize(base64_decode($result[$i]['record_status']))[$rec_count];
            }else{
                $emp_status =  'Unassigned';
            }
            if($emp_status == 'Resigned' || $emp_status == 'Retired')
            {
                //do nothing
            }else{
                $data = array(
                    'employee_code' => $result[$i]['PK_employee_code'],
                    'emp_wname'     => $result[$i]['emp_LName'].', '.$result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_NameExt'],
                    'TIN'           => $result[$i]['TIN_ID'],
                    'SSS'           => $result[$i]['SSS_ID'],
                    'PHIC'          => $result[$i]['PHIC_ID'],
                    'HDMF'          => $result[$i]['HDMF_ID'],
                    'CTC_no'        => $result[$i]['CTC_No'],
                    'Date_Issued'   => $result[$i]['CTC_Date'],
                    'License_no'    => $result[$i]['PRC_License'],
                    'exp_date'      => $result[$i]['PRC_Expdate'],
                    'TIN_format'    => preg_replace("/^1?(\d{3})(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3-$4", $result[$i]['TIN_ID']),
                    'SSS_format'    => preg_replace("/^1?(\d{2})(\d{7})(\d{1})$/", "$1-$2-$3", $result[$i]['SSS_ID']),
                    'PHIC_format'   => preg_replace("/^1?(\d{4})(\d{4})(\d{4})$/", "$1-$2-$3", $result[$i]['PHIC_ID']),
                    'HDMF_format'   => preg_replace("/^1?(\d{4})(\d{4})(\d{4})$/", "$1-$2-$3", $result[$i]['HDMF_ID']),
                );
                array_push($ids, $data);
            }
        }
        return $ids;
    }

    public function export_birthday_celebrants(){
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_system_users sys','sys.FK_employee_code = emp.PK_employee_code','left');
        $this->db->like('emp.emp_birthdate',date('m'),'after');
        $this->db->where('emp.PK_employee_code !=','00000');
        $this->db->where('sys.user_status', 'Active');
        $this->db->order_by('emp.emp_birthdate','asc');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);

        $celebrants = array();
        for($i=0;$i<=($rows-1);$i++){
            $birthday           = date('Y-m-d',strtotime($result[$i]['emp_birthdate']));
            $today              = date('Y-m-d');
            list($y1, $m1, $d1) = explode('-', $birthday);
            list($y2, $m2, $d2) = explode('-', $today);
            $m1                 = $m2 - $m1;
            if ($m1 < 0 || ($m1 == 0 && $d2 - $d1 < 0)){
            $y1++;
            }
            $age = $y2 - $y1;
            $age = floor((time() - strtotime($birthday)) / 31556926);
            $datetime = date_diff(date_create(), date_create($birthday));
            $age_yr      = $datetime->format('%Y');
            $data = array(
                'employee_code' => $result[$i]['PK_employee_code'],
                'emp_wname'     => $result[$i]['emp_LName'].', '.$result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_NameExt'],
                'birthdate'     => date('F d, Y',strtotime($result[$i]['emp_birthdate'])),
                'age'           => $age_yr
            );
            array_push($celebrants, $data);
        }
        return $celebrants;
    }

    public function export_section_heads(){
        $this->db->from('tbl_section sec');
        $this->db->join('tbl_employee emp','emp.PK_employee_code = sec.FK_employee_code','left');
        $this->db->join('tbl_department dept', 'dept.PK_department_ID = sec.FK_department_ID','left');
        $this->db->order_by('dept.department_name','asc');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);

        $heads = array();
        for($i=0;$i<=($rows-1);$i++){
            $data = array(
                'department' => $result[$i]['department_name'],
                'section'     => $result[$i]['section_name'],
                'head'     => $result[$i]['emp_LName'].', '.$result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_NameExt']
            );
            array_push($heads, $data);
        }
        return $heads;
    }

    public function export_department_heads(){
        $this->db->from('tbl_department dept');
        $this->db->join('tbl_employee emp','emp.PK_employee_code = dept.FK_employee_code','left');
        $this->db->order_by('dept.department_name','asc');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);

        $heads = array();
        for($i=0;$i<=($rows-1);$i++){
            $data = array(
                'department' => $result[$i]['department_name'],
                'head'     => $result[$i]['emp_LName'].', '.$result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_NameExt']
            );
            array_push($heads, $data);
        }
        return $heads;
    }

    public function export_employee_directory(){
        $this->db->from('tbl_employee emp');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);

        $directory = array();
        for($i=0;$i<=($rows-1);$i++){
            
            $data = array(
                'employee_code' => $result[$i]['PK_employee_code'],
                'emp_wname'     => $result[$i]['emp_LName'].', '.$result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_NameExt'],
                'mob_no'        => $result[$i]['emp_mobno'],
                'tel_no'        => $result[$i]['emp_telno'],
                'email'         => $result[$i]['emp_email'],
            );
            array_push($directory, $data);
        }
        return $directory;
    }

    public function export_employee_dependents(){
        $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, dep.*');
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_employee_dependents dep','emp.PK_employee_code = dep.FK_employee_code','left');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);

        $dependent = array();
        $dep_info = array();
        for($i=0;$i<=($rows-1);$i++){
            if ((is_array(unserialize(base64_decode($result[$i]['emp_dep_LName']))) && count(unserialize(base64_decode($result[$i]['emp_dep_LName']))) > 0 && unserialize(base64_decode($result[$i]['emp_dep_LName']))[0] != '')) {
                $dep_count = (count(unserialize(base64_decode($result[$i]['emp_dep_LName'])))) -1;
                $real_count = (count(unserialize(base64_decode($result[$i]['emp_dep_LName']))));
                for($x = 0; $x <= $dep_count;$x++){
                    $dep_LName =  unserialize(base64_decode($result[$i]['emp_dep_LName']))[$x];
                    $dep_FName =  unserialize(base64_decode($result[$i]['emp_dep_FName']))[$x];
                    $dep_MName =  unserialize(base64_decode($result[$i]['emp_dep_MName']))[$x];
                    $dep_NameExt =  unserialize(base64_decode($result[$i]['emp_dep_NameExt']))[$x];
                    $dep_bdate =  unserialize(base64_decode($result[$i]['emp_dep_birthdate']))[$x];

                    $data = array(
                        'employee_code' => $result[$i]['PK_employee_code'],
                        'emp_wname'     => $result[$i]['emp_LName'].', '.$result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_NameExt'],
                        'no_deps'        => $real_count,
                        'dep_Name'      => $dep_LName.', '.$dep_FName.' '.$dep_MName.' '.$dep_NameExt,
                        'dep_Bdate'     => $dep_bdate
                    );
                    array_push($dependent,$data);
                }
            }else{
                $real_count = "0";
                $dep_LName =  null;
                $dep_FName =  null;
                $dep_MName =  null;
                $dep_NameExt =  null;
                $dep_bdate =  null;
                $data = array(
                    'employee_code' => $result[$i]['PK_employee_code'],
                    'emp_wname'     => $result[$i]['emp_LName'].', '.$result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_NameExt'],
                    'no_deps'        => $real_count,
                    'dep_Name'        => $dep_LName.', '.$dep_FName.' '.$dep_MName.' '.$dep_NameExt,
                    'dep_Bdate'         => $dep_bdate,
                );
                array_push($dependent, $data);
            }
        }
        return $dependent;
    }

    public function export_age_distribution(){
        $this->db->select('emp.emp_birthdate,emp.emp_gender, emp.emp_FName, emp.emp_MName, emp.emp_LName, emp.emp_NameExt');
        $this->db->from('tbl_employee emp');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);
        $total = 0;
        $male = 0;
        $female = 0;
        $total_1820 = 0;
        $male_1820 = 0;
        $female_1820 = 0;
        $total_2130 = 0;
        $male_2130 = 0;
        $female_2130 = 0;
        $total_3140 = 0;
        $male_3140 = 0;
        $female_3140 = 0;
        $total_4150 = 0;
        $male_4150 = 0;
        $female_4150 = 0;
        $total_5160 = 0;
        $male_5160 = 0;
        $female_5160 = 0;
        $total_61up = 0;
        $male_61up = 0;
        $female_61up = 0;

        for($i=0;$i<=($rows-1);$i++){
            $birthday           = date('Y-m-d',strtotime($result[$i]['emp_birthdate']));
            $today              = date('Y-m-d');
            list($y1, $m1, $d1) = explode('-', $birthday);
            list($y2, $m2, $d2) = explode('-', $today);
            $m1                 = $m2 - $m1;
            if ($m1 < 0 || ($m1 == 0 && $d2 - $d1 < 0)){
            $y1++;
            }
            $age = $y2 - $y1;
            $age = floor((time() - strtotime($birthday)) / 31556926);
            $datetime = date_diff(date_create(), date_create($birthday));
            $age_yr      = $datetime->format('%Y');

            if($age_yr >= 18 && $age_yr <= 20){
                if($result[$i]['emp_gender']=="MALE"){
                    $male_1820++;
                    $male++;
                }elseif($result[$i]['emp_gender']=="FEMALE"){
                    $female_1820++;
                    $female++;
                }
                $total_1820++;
            }elseif($age_yr >= 21 && $age_yr <= 30){
                if($result[$i]['emp_gender']=="MALE"){
                    $male_2130++;
                    $male++;
                }elseif($result[$i]['emp_gender']=="FEMALE"){
                    $female_2130++;
                    $female++;
                }
                $total_2130++;
            }elseif($age_yr >= 31 && $age_yr <= 40){
                if($result[$i]['emp_gender']=="MALE"){
                    $male_3140++;
                    $male++;
                }elseif($result[$i]['emp_gender']=="FEMALE"){
                    $female_3140++;
                    $female++;
                }
                $total_3140++;
            }elseif($age_yr >= 41 && $age_yr <= 50){
                if($result[$i]['emp_gender']=="MALE"){
                    $male_4150++;
                    $male++;
                }elseif($result[$i]['emp_gender']=="FEMALE"){
                    $female_4150++;
                    $female++;
                }
                $total_4150++;
            }elseif($age_yr >= 51 && $age_yr <= 60){
                if($result[$i]['emp_gender']=="MALE"){
                    $male_5160++;
                    $male++;
                }elseif($result[$i]['emp_gender']=="FEMALE"){
                    $female_5160++;
                    $female++;
                }
                $total_5160++;
            }else{
                if($result[$i]['emp_gender']=="MALE"){
                    $male_61up++;
                    $male++;
                }elseif($result[$i]['emp_gender']=="FEMALE"){
                    $female_61up++;
                    $female++;
                }
                $total_61up++;
            }
            $total++;
        }
        $age_range_count = 7;
        $age_distribution = array();
        for($i=1;$i<=$age_range_count;$i++){
            switch ($i) {
                case 1:
                    $data = array(
                        'age_range' => '18-20',
                        'total'     => $total_1820,
                        'male'      => $male_1820,
                        'female'    => $female_1820
                    );
                    array_push($age_distribution,$data);
                    break;
                case 2:
                    $data = array(
                        'age_range' => '21-30',
                        'total'     => $total_2130,
                        'male'      => $male_2130,
                        'female'    => $female_2130
                    );
                    array_push($age_distribution,$data);
                    break;
                case 3:
                    $data = array(
                        'age_range' => '31-40',
                        'total'     => $total_3140,
                        'male'      => $male_3140,
                        'female'    => $female_3140
                    );
                    array_push($age_distribution,$data);
                    break;
                case 4:
                    $data = array(
                        'age_range' => '41-50',
                        'total'     => $total_4150,
                        'male'      => $male_4150,
                        'female'    => $female_4150
                    );
                    array_push($age_distribution,$data);
                    break;
                case 5:
                    $data = array(
                        'age_range' => '51-60',
                        'total'     => $total_5160,
                        'male'      => $male_5160,
                        'female'    => $female_5160
                    );
                    array_push($age_distribution,$data);
                    break;
                case 6:
                    $data = array(
                        'age_range' => '61>',
                        'total'     => $total_61up,
                        'male'      => $male_61up,
                        'female'    => $female_61up
                    );
                    array_push($age_distribution,$data);
                    break;
                case 7:
                    $data = array(
                        'age_range' => 'GRAND TOTAL',
                        'total'     => $total,
                        'male'      => $male,
                        'female'    => $female
                    );
                    array_push($age_distribution,$data);
                    break;
            }
        }
        return $age_distribution;
    }

    public function export_age_distribution_detailed(){
        $this->db->select('emp.emp_birthdate,emp.emp_gender, emp.emp_FName, emp.emp_MName, emp.emp_LName, emp.emp_NameExt');
        $this->db->from('tbl_employee emp');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);
        $age18_20 = array();
        $age21_30 = array();
        $age31_40 = array();
        $age41_50 = array();
        $age51_60 = array();
        $age60up = array();

        for($i=0;$i<=($rows-1);$i++){
            $birthday           = date('Y-m-d',strtotime($result[$i]['emp_birthdate']));
            $today              = date('Y-m-d');
            list($y1, $m1, $d1) = explode('-', $birthday);
            list($y2, $m2, $d2) = explode('-', $today);
            $m1                 = $m2 - $m1;
            if ($m1 < 0 || ($m1 == 0 && $d2 - $d1 < 0)){
            $y1++;
            }
            $age = $y2 - $y1;
            $age = floor((time() - strtotime($birthday)) / 31556926);
            $datetime = date_diff(date_create(), date_create($birthday));
            $age_yr      = $datetime->format('%Y');
            $data = array();
            if($age_yr >= 18 && $age_yr <= 20){
                $data = array(
                    'Name' => $result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_LName'],
                    'birthdate' => date('F d,Y',strtotime($result[$i]['emp_birthdate'])),
                    'age'   => $age_yr,
                    'sex'   => $result[$i]['emp_gender']
                );
                array_push($age18_20, $data);
            }elseif($age_yr >= 21 && $age_yr <= 30){
                $data = array(
                    'Name' => $result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_LName'],
                    'birthdate' => date('F d,Y',strtotime($result[$i]['emp_birthdate'])),
                    'age'   => $age_yr,
                    'sex'   => $result[$i]['emp_gender']
                );
                array_push($age21_30, $data);
            }elseif($age_yr >= 31 && $age_yr <= 40){
                $data = array(
                    'Name' => $result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_LName'],
                    'birthdate' => date('F d,Y',strtotime($result[$i]['emp_birthdate'])),
                    'age'   => $age_yr,
                    'sex'   => $result[$i]['emp_gender']
                );
                array_push($age31_40, $data);
            }elseif($age_yr >= 41 && $age_yr <= 50){
                $data = array(
                    'Name' => $result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_LName'],
                    'birthdate' => date('F d,Y',strtotime($result[$i]['emp_birthdate'])),
                    'age'   => $age_yr,
                    'sex'   => $result[$i]['emp_gender']
                );
                array_push($age41_50, $data);
            }elseif($age_yr >= 51 && $age_yr <= 60){
                $data = array(
                    'Name' => $result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_LName'],
                    'birthdate' => date('F d,Y',strtotime($result[$i]['emp_birthdate'])),
                    'age'   => $age_yr,
                    'sex'   => $result[$i]['emp_gender']
                );
                array_push($age51_60, $data);
            }else{
                $data = array(
                    'Name' => $result[$i]['emp_FName'].' '.$result[$i]['emp_MName'].' '.$result[$i]['emp_LName'],
                    'birthdate' => date('F d,Y',strtotime($result[$i]['emp_birthdate'])),
                    'age'   => $age_yr,
                    'sex'   => $result[$i]['emp_gender']
                );
                array_push($age60up, $data);
            }
        }
        foreach ($age18_20 as $key => $row) {
            $orderby['gender'][$key] = $row['sex'];
            $orderby['age'][$key] = $row['age'];
        }
        array_multisort($orderby['gender'], SORT_DESC,$orderby['age'], SORT_ASC,$age18_20);

        foreach ($age21_30 as $key1 => $row1) {
            $orderby1['gender'][$key1] = $row1['sex'];
            $orderby1['age'][$key1] = $row1['age'];
        }
        array_multisort($orderby1['gender'], SORT_DESC,$orderby1['age'], SORT_ASC,$age21_30);

        foreach ($age31_40 as $key2 => $row2) {
            $orderby2['gender'][$key2] = $row2['sex'];
            $orderby2['age'][$key2] = $row2['age'];
        }
        array_multisort($orderby2['gender'], SORT_DESC,$orderby2['age'], SORT_ASC,$age31_40);

        foreach ($age41_50 as $key3 => $row3) {
            $orderby3['gender'][$key3] = $row3['sex'];
            $orderby3['age'][$key3] = $row3['age'];
        }
        array_multisort($orderby3['gender'], SORT_DESC,$orderby3['age'], SORT_ASC,$age41_50);

        foreach ($age51_60 as $key4 => $row4) {
            $orderby4['gender'][$key4] = $row4['sex'];
            $orderby4['age'][$key4] = $row4['age'];
        }
        array_multisort($orderby4['gender'], SORT_DESC,$orderby4['age'], SORT_ASC,$age51_60);

        foreach ($age60up as $key5 => $row5) {
            $orderby5['gender'][$key5] = $row5['sex'];
            $orderby5['age'][$key5] = $row5['age'];
        }
        array_multisort($orderby5['gender'], SORT_DESC,$orderby5['age'], SORT_ASC,$age60up);

        $detailed_age_distribution = array(
            '18to20'    => $age18_20,
            '21to30'    => $age21_30,
            '31to40'    => $age31_40,
            '41to50'    => $age41_50,
            '51to60'    => $age51_60,
            '60up'      => $age60up
        );
        return $detailed_age_distribution;
    }

    public function export_count_by_section(){
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_employee_record rec','emp.PK_employee_code = rec.FK_employee_code','left');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);
        $employee_sec =array();
        for($z=0;$z<=($rows-1);$z++){
            if ((is_array(unserialize(base64_decode($result[$z]['record_section']))) && count(unserialize(base64_decode($result[$z]['record_section']))) > 0 && unserialize(base64_decode($result[$z]['record_section']))[0] != '')) {
                $sec_count = (count(unserialize(base64_decode($result[$z]['record_section'])))) -1;
                $section =  unserialize(base64_decode($result[$z]['record_section']))[$sec_count];
            }else{
                $section =  'Unassigned';
            }
            $data1 = array(
                'sec_name' => $section
            );
            array_push($employee_sec,$section);
        }

        $clean = array_replace($employee_sec,array_fill_keys(array_keys($employee_sec, null),''));
        $count_section = array_count_values($clean);
        $count_section_arr = count($count_section);
        $count_section_key = array_keys($count_section);
        $return_val = array();
        for($y=0;$y<=($count_section_arr-1);$y++){
            $proc_data = array(
                'section_name' => $count_section_key[$y],
                'emp_count' => $count_section[$count_section_key[$y]]
            );
            array_push($return_val,$proc_data);
        }
        return $return_val;
    }

    public function extract_dtr_record_prev_month(){
        $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, rec.record_section, rec.record_status, user.FK_employee_code, user.user_status');
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
        $this->db->where('user.user_status','Active');
        $this->db->where('emp.PK_employee_code !=','00000');

        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);
        $masterlist = array();
        for($a=0;$a<=($rows-1);$a++){
            if ((is_array(unserialize(base64_decode($result[$a]['record_section']))) && count(unserialize(base64_decode($result[$a]['record_section']))) > 0 && unserialize(base64_decode($result[$a]['record_section']))[0] != '')) {
                $sec_count = (count(unserialize(base64_decode($result[$a]['record_section'])))) -1;
                $section =  unserialize(base64_decode($result[$a]['record_section']))[$sec_count];
            }else{
                $section =  'Unassigned';
            }
            if ((is_array(unserialize(base64_decode($result[$a]['record_status']))) && count(unserialize(base64_decode($result[$a]['record_status']))) > 0 && unserialize(base64_decode($result[$a]['record_status']))[0] != '')) {
                $stat_count = (count(unserialize(base64_decode($result[$a]['record_status'])))) -1;
                $status =  unserialize(base64_decode($result[$a]['record_status']))[$stat_count];
            }else{
                $status =  'Unassigned';
            }
            $data = array(
                'employee_code' => $result[$a]['PK_employee_code'],
                'emp_wname'     => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).' '.$result[$a]['emp_NameExt'],
                'section'       => $section,
                'status'        => $status
            );
            array_push($masterlist, $data);
        }
        $employee_info = array();
        $final_dtr = array();
        for($b=0;$b<=($rows-1);$b++){
            $employee_code = $masterlist[$b]['employee_code'];
            $days = cal_days_in_month(CAL_GREGORIAN,date('m',strtotime("-1 month")),date('Y'));
            $day=1;
            $emp_details = array(
                'employee_code' => $masterlist[$b]['employee_code'],
                'emp_wname' => $masterlist[$b]['emp_wname'],
                'section' => $masterlist[$b]['section'],
                'status' => $masterlist[$b]['status'],
            );
            array_push($employee_info,$emp_details);
            $date_result = array();
            $for_return = array();
            for($c=0;$c<$days;$c++){
                $date_mon =  date('Y').'-'.date('m',strtotime("-1 month")).'-'.$day;
                $this->db->select('att.Attendance_Date, att.Attendance_Time');
                $this->db->from('tbl_employee_attendance att');
                $this->db->where('att.Attendance_Date',$date_mon);
                $this->db->where('att.FK_employee_code',$employee_code);
                $this->db->order_by('att.Attendance_Time','asc');
                $query1 = $this->db->get();
                $rows1 = $query1->num_rows();
                $result1 = $query1->result_array();
                if($rows1 > 0){
                    if($rows1 == 1){
                        $data = array(
                            'Att_Date' => date('F d,Y (D)',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-1]["Attendance_Time"])),
                            'Att_TimeOut'=> null,
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows1 == 2){
                        $data = array(
                            'Att_Date' => date('F d,Y (D)',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-2]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time'])),
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows1 == 3){   
                        $data = array(
                            'Att_Date' => date('F d,Y (D)',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-3]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-2]['Attendance_Time'])),
                            'Att_TimeMisc' => date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time'])),
                            'Att_TimeMisc1' =>null
                        );
                    }elseif($rows1 == 4){
                        $data = array(
                            'Att_Date' => date('F d,Y (D)',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-4]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-3]['Attendance_Time'])),
                            'Att_TimeMisc' => date('h:i:sA',strtotime($result1[$rows1-2]['Attendance_Time'])),
                            'Att_TimeMisc1' => date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time']))
                        );
                    }
                    $merge = array_merge($for_return,$data);
                }else{
                    $data = array(
                        'Att_Date' => date('F d,Y (D)',strtotime($date_mon)),
                        'Att_TimeIn'=> null,
                        'Att_TimeOut'=> null,
                        'Att_TimeMisc' => null,
                        'Att_TimeMisc1' => null
                    );
                    $merge = array_merge($for_return,$data);
                }
                array_push($date_result,$merge);
                $day++; 
            }
            $emp_dtr = array_merge($emp_details,$date_result);
            array_push($final_dtr, $emp_dtr);
            $emp_details = array();
            $date_result = array();
        }
        // SORTING
        foreach ($final_dtr as $key => $row) {
            $orderby['section'][$key] = $row['section'];
            $orderby['emp_wname'][$key] = $row['emp_wname'];
        }
        array_multisort($orderby['section'], SORT_ASC,$orderby['emp_wname'], SORT_ASC,$final_dtr);
        return $final_dtr;
    }

    public function extract_dtr_record_current_month(){
        $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, rec.record_section, rec.record_status, user.FK_employee_code, user.user_status');
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
        $this->db->where('user.user_status','Active');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);
        $masterlist = array();
        for($a=0;$a<=($rows-1);$a++){
            if ((is_array(unserialize(base64_decode($result[$a]['record_section']))) && count(unserialize(base64_decode($result[$a]['record_section']))) > 0 && unserialize(base64_decode($result[$a]['record_section']))[0] != '')) {
                $sec_count = (count(unserialize(base64_decode($result[$a]['record_section'])))) -1;
                $section =  unserialize(base64_decode($result[$a]['record_section']))[$sec_count];
            }else{
                $section =  'Unassigned';
            }
            if ((is_array(unserialize(base64_decode($result[$a]['record_status']))) && count(unserialize(base64_decode($result[$a]['record_status']))) > 0 && unserialize(base64_decode($result[$a]['record_status']))[0] != '')) {
                $stat_count = (count(unserialize(base64_decode($result[$a]['record_status'])))) -1;
                $status =  unserialize(base64_decode($result[$a]['record_status']))[$stat_count];
            }else{
                $status =  'Unassigned';
            }
            $data = array(
                'employee_code' => $result[$a]['PK_employee_code'],
                'emp_wname'     => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).' '.$result[$a]['emp_NameExt'],
                'section'       => $section,
                'status'        => $status
            );
            array_push($masterlist, $data);
        }
        $employee_info = array();
        $final_dtr = array();
        for($b=0;$b<=($rows-1);$b++){
            $employee_code = $masterlist[$b]['employee_code'];
            $days = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
            if($days > date('d')){
                $days_count = intval(date('d'));
            }else{
                $days_count = $days;
            }
            $day=1;
            $emp_details = array(
                'employee_code' => $masterlist[$b]['employee_code'],
                'emp_wname' => $masterlist[$b]['emp_wname'],
                'section' => $masterlist[$b]['section'],
                'status' => $masterlist[$b]['status']
            );
            array_push($employee_info,$emp_details);
            $date_result = array();
            $for_return = array();
            for($c=0;$c<$days_count;$c++){
                $date_mon =  date('Y').'-'.date('m').'-'.$day;
                $this->db->select('att.Attendance_Date, att.Attendance_Time');
                $this->db->from('tbl_employee_attendance att');
                $this->db->where('att.Attendance_Date',$date_mon);
                $this->db->where('att.FK_employee_code',$employee_code);
                $this->db->order_by('att.Attendance_Time');
                $query1 = $this->db->get();
                $rows1 = $query1->num_rows();
                $result1 = $query1->result_array();
                if($rows1 > 0){
                    if($rows1 == 1){
                        $data = array(
                            'Att_Date' => date('F d,Y (D)',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-1]["Attendance_Time"])),
                            'Att_TimeOut'=> null,
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows1 == 2){
                        $data = array(
                            'Att_Date' => date('F d,Y (D)',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-2]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time'])),
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows1 == 3){
                        $data = array(
                            'Att_Date' => date('F d,Y (D)',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-3]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-2]['Attendance_Time'])),
                            'Att_TimeMisc' => date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time'])),
                            'Att_TimeMisc1' =>null
                        );
                    }elseif($rows1 == 4){
                        $data = array(
                            'Att_Date' => date('F d,Y (D)',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-4]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-3]['Attendance_Time'])),
                            'Att_TimeMisc' => date('h:i:sA',strtotime($result1[$rows1-2]['Attendance_Time'])),
                            'Att_TimeMisc1' => date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time']))
                        );
                    }
                    $merge = array_merge($for_return,$data);
                }else{
                    $data = array(
                        'Att_Date' => date('F d,Y (D)',strtotime($date_mon)),
                        'Att_TimeIn'=> null,
                        'Att_TimeOut'=> null,
                        'Att_TimeMisc' => null,
                        'Att_TimeMisc1' => null
                    );
                    $merge = array_merge($for_return,$data);
                }
                array_push($date_result,$merge);
                $day++; 
            }
            $emp_dtr = array_merge($emp_details,$date_result);
            array_push($final_dtr, $emp_dtr);
            $emp_details = array();
            $date_result = array();
        }
        // SORTING
        foreach ($final_dtr as $key => $row) {
            $orderby['section'][$key] = $row['section'];
            $orderby['emp_wname'][$key] = $row['emp_wname'];
        }
        array_multisort($orderby['section'], SORT_ASC,$orderby['emp_wname'], SORT_ASC,$final_dtr);
        return $final_dtr;
    }

    public function extract_dtr_record_current_month_for_contractual(){
        $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, rec.record_section, rec.record_status, user.FK_employee_code, user.user_status');
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
        $this->db->where('user.user_status','Active');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);
        $masterlist = array();
        for($a=0;$a<=($rows-1);$a++){
            if ((is_array(unserialize(base64_decode($result[$a]['record_section']))) && count(unserialize(base64_decode($result[$a]['record_section']))) > 0 && unserialize(base64_decode($result[$a]['record_section']))[0] != '')) {
                $sec_count = (count(unserialize(base64_decode($result[$a]['record_section'])))) -1;
                $section =  unserialize(base64_decode($result[$a]['record_section']))[$sec_count];
            }else{
                $section =  'Unassigned';
            }
            if ((is_array(unserialize(base64_decode($result[$a]['record_status']))) && count(unserialize(base64_decode($result[$a]['record_status']))) > 0 && unserialize(base64_decode($result[$a]['record_status']))[0] != '')) {
                $stat_count = (count(unserialize(base64_decode($result[$a]['record_status'])))) -1;
                $status =  unserialize(base64_decode($result[$a]['record_status']))[$stat_count];
            }else{
                $status =  'Unassigned';
            }
            if($status == 'Contractual' || $status == 'Trainee' ||$status == 'Probationary' ){
                $data = array(
                    'employee_code' => $result[$a]['PK_employee_code'],
                    'emp_wname'     => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).' '.$result[$a]['emp_NameExt'],
                    'section'       => $section,
                    'status'        => $status
                );
                array_push($masterlist, $data);
            }
        }
        $employee_info = array();
        $final_dtr = array();
        $contractual = count($masterlist);
        for($b=0;$b<=($contractual-1);$b++){
            $employee_code = $masterlist[$b]['employee_code'];
            $days = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
            if($days > date('d')){
                $days_count = intval(date('d'));
            }else{
                $days_count = $days;
            }
            $day=1;
            $emp_details = array(
                'employee_code' => $masterlist[$b]['employee_code'],
                'emp_wname' => $masterlist[$b]['emp_wname'],
                'section' => $masterlist[$b]['section'],
                'status' => $masterlist[$b]['status']
            );
            array_push($employee_info,$emp_details);
            $date_result = array();
            $for_return = array();
            for($c=0;$c<$days_count;$c++){
                $date_mon =  date('Y').'-'.date('m').'-'.$day;
                $this->db->select('att.Attendance_Date, att.Attendance_Time');
                $this->db->from('tbl_employee_attendance att');
                $this->db->where('att.Attendance_Date',$date_mon);
                $this->db->where('att.FK_employee_code',$employee_code);
                $query1 = $this->db->get();
                $rows1 = $query1->num_rows();
                $result1 = $query1->result_array();
                if($rows1 > 0){
                    if($rows1 == 1){
                        $data = array(
                            'Att_Date' => date('F d,Y',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-1]["Attendance_Time"])),
                            'Att_TimeOut'=> null,
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows1 == 2){
                        $data = array(
                            'Att_Date' => date('F d,Y',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-2]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time'])),
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows1 == 3){
                        $data = array(
                            'Att_Date' => date('F d,Y',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-3]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-2]['Attendance_Time'])),
                            'Att_TimeMisc' => date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time'])),
                            'Att_TimeMisc1' =>null
                        );
                    }elseif($rows1 == 4){
                        $data = array(
                            'Att_Date' => date('F d,Y',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-4]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-3]['Attendance_Time'])),
                            'Att_TimeMisc' => date('h:i:sA',strtotime($result1[$rows1-2]['Attendance_Time'])),
                            'Att_TimeMisc1' => date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time']))
                        );
                    }
                    $merge = array_merge($for_return,$data);
                }else{
                    $data = array(
                        'Att_Date' => date('F d,Y',strtotime($date_mon)),
                        'Att_TimeIn'=> null,
                        'Att_TimeOut'=> null,
                        'Att_TimeMisc' => null,
                        'Att_TimeMisc1' => null
                    );
                    $merge = array_merge($for_return,$data);
                }
                array_push($date_result,$merge);
                $day++; 
            }
            $emp_dtr = array_merge($emp_details,$date_result);
            array_push($final_dtr, $emp_dtr);
            $emp_details = array();
            $date_result = array();
        }
        // SORTING
        foreach ($final_dtr as $key => $row) {
            $orderby['section'][$key] = $row['section'];
            $orderby['emp_wname'][$key] = $row['emp_wname'];
        }
        array_multisort($orderby['section'], SORT_ASC,$orderby['emp_wname'], SORT_ASC,$final_dtr);
        return $final_dtr;
    }
    public function extract_dtr_record_current_month_for_contractual_620(){
        $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, rec.record_section, rec.record_status, user.FK_employee_code, user.user_status');
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
        $this->db->where('user.user_status','Active');
        $this->db->where('emp.PK_employee_code !=','00000');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);
        $masterlist = array();
        for($a=0;$a<=($rows-1);$a++){
            if ((is_array(unserialize(base64_decode($result[$a]['record_section']))) && count(unserialize(base64_decode($result[$a]['record_section']))) > 0 && unserialize(base64_decode($result[$a]['record_section']))[0] != '')) {
                $sec_count = (count(unserialize(base64_decode($result[$a]['record_section'])))) -1;
                $section =  unserialize(base64_decode($result[$a]['record_section']))[$sec_count];
            }else{
                $section =  'Unassigned';
            }
            if ((is_array(unserialize(base64_decode($result[$a]['record_status']))) && count(unserialize(base64_decode($result[$a]['record_status']))) > 0 && unserialize(base64_decode($result[$a]['record_status']))[0] != '')) {
                $stat_count = (count(unserialize(base64_decode($result[$a]['record_status'])))) -1;
                $status =  unserialize(base64_decode($result[$a]['record_status']))[$stat_count];
            }else{
                $status =  'Unassigned';
            }
            if($status == 'Contractual' || $status == 'Trainee' ||$status == 'Probationary' ){
                $data = array(
                    'employee_code' => $result[$a]['PK_employee_code'],
                    'emp_wname'     => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).' '.$result[$a]['emp_NameExt'],
                    'section'       => $section,
                    'status'        => $status
                );
                array_push($masterlist, $data);
            }
        }
        $employee_info = array();
        $final_dtr = array();
        $contractual = count($masterlist);
        for($b=0;$b<$contractual;$b++){
            $employee_code = $masterlist[$b]['employee_code'];
            $days = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
            if($days > date('d')){
                $days_count = intval(date('d'));
            }else{
                $days_count = $days;
            }
            $day=1;
            $emp_details = array(
                'employee_code' => $masterlist[$b]['employee_code'],
                'emp_wname' => $masterlist[$b]['emp_wname'],
                'section' => $masterlist[$b]['section'],
                'status' => $masterlist[$b]['status']
            );
            array_push($employee_info,$emp_details);
            $date_result = array();
            $for_return = array();
            for($c=0;$c<$days_count;$c++){
                $date_mon =  date('Y').'-'.date('m').'-'.$day;
                $this->db->select('att.Attendance_Date, att.Attendance_Time');
                $this->db->from('tbl_employee_attendance att');
                $this->db->where('att.Attendance_Date',$date_mon);
                $this->db->where('att.FK_employee_code',$employee_code);
                $query1 = $this->db->get();
                $rows1 = $query1->num_rows();
                $result1 = $query1->result_array();
                if($rows1 > 0){
                    if($rows1 == 1){
                        $data = array(
                            'Att_Date' => date('F d,Y',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-1]["Attendance_Time"])),
                            'Att_TimeOut'=> null,
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows1 == 2){
                        $data = array(
                            'Att_Date' => date('F d,Y',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-2]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time'])),
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows1 == 3){
                        $data = array(
                            'Att_Date' => date('F d,Y',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-3]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-2]['Attendance_Time'])),
                            'Att_TimeMisc' => date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time'])),
                            'Att_TimeMisc1' =>null
                        );
                    }elseif($rows1 == 4){
                        $data = array(
                            'Att_Date' => date('F d,Y',strtotime($date_mon)),
                            'Att_TimeIn'=> date('h:i:sA',strtotime($result1[$rows1-4]["Attendance_Time"])),
                            'Att_TimeOut'=> date('h:i:sA',strtotime($result1[$rows1-3]['Attendance_Time'])),
                            'Att_TimeMisc' => date('h:i:sA',strtotime($result1[$rows1-2]['Attendance_Time'])),
                            'Att_TimeMisc1' => date('h:i:sA',strtotime($result1[$rows1-1]['Attendance_Time']))
                        );
                    }
                    $merge = array_merge($for_return,$data);
                }else{
                    $data = array(
                        'Att_Date' => date('F d,Y',strtotime($date_mon)),
                        'Att_TimeIn'=> null,
                        'Att_TimeOut'=> null,
                        'Att_TimeMisc' => null,
                        'Att_TimeMisc1' => null
                    );
                    $merge = array_merge($for_return,$data);
                }
                array_push($date_result,$merge);
                $day++; 
            }
            $emp_dtr = array_merge($emp_details,$date_result);
            array_push($final_dtr, $emp_dtr);
            $emp_details = array();
            $date_result = array();
        }
        // SORTING
        foreach ($final_dtr as $key => $row) {
            $orderby['section'][$key] = $row['section'];
            $orderby['emp_wname'][$key] = $row['emp_wname'];
        }
        array_multisort($orderby['section'], SORT_ASC,$orderby['emp_wname'], SORT_ASC,$final_dtr);
        return $final_dtr;
    }
    public function get_all_leave_request_prev_month_summary(){
        $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, rec.record_section, rec.record_status, user.FK_employee_code, user.user_status');
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
        $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
        $this->db->where('user.user_status','Active');
        $this->db->where('emp.PK_employee_code !=','00000');
        $this->db->order_by('emp.emp_LName');
        $query = $this->db->get();
        $result = $query->result_array();
        $rows = count($result);
        $masterlist = array();
        $for_return = array();
        for($a=0;$a<$rows;$a++){
            if ((is_array(unserialize(base64_decode($result[$a]['record_section']))) && count(unserialize(base64_decode($result[$a]['record_section']))) > 0 && unserialize(base64_decode($result[$a]['record_section']))[0] != '')) {
                $sec_count = (count(unserialize(base64_decode($result[$a]['record_section'])))) -1;
                $section =  unserialize(base64_decode($result[$a]['record_section']))[$sec_count];
            }else{
                $section =  'Unassigned';
            }
            $data = array(
                    'employee_code' => $result[$a]['PK_employee_code'],
                    'emp_wname'     => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).'. '.$result[$a]['emp_NameExt'],
                    'section'       => $section
            );
            array_push($masterlist, $data);
        }
        for($i=0;$i<$rows;$i++){
            $employee_code = $masterlist[$i]['employee_code'];
            $emp_details = array(
                'employee_code' => $masterlist[$i]['employee_code'],
                'emp_wname' => $masterlist[$i]['emp_wname'],
                'section' => $masterlist[$i]['section']
            );
            $this->db->from('tbl_leave_request req');
            $this->db->join('tbl_leave_type type','type.PK_leave_ID = req.FK_leave_ID','left');
            $this->db->where('req.FK_employee_code',$employee_code);
            $this->db->where('req.Leave_Status','Noted');
            $this->db->order_by('type.PK_leave_ID');
            $this->db->order_by('req.Leave_Date_start');
            $req_query = $this->db->get();
            $req_rows = $req_query->num_rows();
            $req_result = $req_query->result_array();
            $req_summary = array();
            if($req_rows>0){
                for($x=0;$x<$req_rows;$x++){
                    $request_details = array(
                        'date_filed' => date('F d, Y',strtotime($req_result[$x]['Leave_Date_Filed'])),
                        'inclusive_date' => date('F d, Y',strtotime($req_result[$x]['Leave_Date_Start'])).' - '.date('F d,Y',strtotime($req_result[$x]['Leave_Date_End'])),
                        'leave_type'    => ucfirst(substr($req_result[$x]['leave_type'],0,-6)),
                        'reason'        => $req_result[$x]['Leave_Reason'],
                        'address'       => $req_result[$x]['Leave_Address'],
                        'credit_used'   => $req_result[$x]['Leave_no_days']
                    );
                    if($req_result[$x]['FK_Recommended_By'] == '00000' || $req_result[$x]['FK_Recommended_By']==null){
                        $asignatories = array(
                            'recommended' => 'System Administrator',
                            'approved' =>'System Administrator',
                            'noted' => 'System Administrator',
                        );
                    }else{
                        $this->db->select('emp.emp_FName, emp.emp_LName, emp.emp_MName, emp.emp_NameExt');
                        $this->db->from('tbl_employee emp');
                        $this->db->where('emp.PK_employee_code',$req_result[$x]['FK_Recommended_By']);
                        $rec_qry = $this->db->get();
                        $rec_res = $rec_qry->result_array();
                        $this->db->from('tbl_employee emp');
                        $this->db->where('emp.PK_employee_code',$req_result[$x]['FK_Approved_By']);
                        $app_qry = $this->db->get();
                        $app_res = $app_qry->result_array();
                        $this->db->from('tbl_employee emp');
                        $this->db->where('emp.PK_employee_code',$req_result[$x]['FK_Noted_By']);
                        $not_qry = $this->db->get();
                        $not_res = $not_qry->result_array();
                        $asignatories = array(
                            'recommended' => $rec_res[0]['emp_FName'].' '.substr($rec_res[0]['emp_MName'],0,1).' '.$rec_res[0]['emp_LName'].' '.$rec_res[0]['emp_NameExt'],
                            'approved' => $app_res[0]['emp_FName'].' '.substr($app_res[0]['emp_MName'],0,1).' '.$app_res[0]['emp_LName'].' '.$app_res[0]['emp_NameExt'],
                            'noted' => $not_res[0]['emp_FName'].' '.substr($not_res[0]['emp_MName'],0,1).' '.$not_res[0]['emp_LName'].' '.$not_res[0]['emp_NameExt'],
                        );
                    }
                    $merge_emp = array_merge($request_details,$asignatories);
                    array_push($req_summary,$merge_emp);
                }
                // foreach ($req_summary as $key => $row) {
                //     $orderby['leave_type'][$key] = $row['leave_type'];
                //     $orderby['date_filed'][$key] = $row['date_filed'];
                // }
                // array_multisort($orderby['leave_type'], SORT_ASC,$orderby['date_filed'], SORT_ASC,$req_summary);
                $merge = array_merge($emp_details, $req_summary);
                array_push($for_return,$merge);
                $emp_details = array();
                $req_summary = array();
            }
        }
        return $for_return;
    }
    public function get_all_leave_request_prev_month(){
        $this->db->from('tbl_leave_request req');
        $this->db->join('tbl_leave_type type','req.FK_leave_ID = type.PK_leave_ID','left');
        $this->db->join('tbl_employee emp', 'emp.PK_employee_code = req.FK_employee_code','left');
        $this->db->join('tbl_employee_record rec','emp.PK_employee_code = rec.FK_employee_code','left');
        $this->db->like('req.Leave_Date_Start',date('m',strtotime('-1 month')),'after');
        $this->db->like('req.Leave_Date_Start',date('Y'),'before');
        $query = $this->db->get();
        $rows = $query->num_rows();
        $result = $query->result_array();
        $data = array();
        for($a=0;$a<=($rows-1);$a++){
            if($result[$a]['Leave_Status'] == 'Noted'){
                $status = 'Approved';
            }elseif($result[$a]['Leave_Status'] == 'Approved'){
                $status = 'Approved';
            }elseif($result[$a]['Leave_Status'] == 'Recommended'){
                $status = 'Approved';
            }elseif($result[$a]['Leave_Status'] == 'Denied_Head'){
                $status = 'Denied';
            }elseif($result[$a]['Leave_Status'] == 'Denied_HR'){
                $status = 'Denied';
            }elseif($result[$a]['Leave_Status'] == 'Denied_Pres'){
                $status = 'Denied';
            }elseif($result[$a]['Leave_Status'] == 'Pending'){
                $status = 'Pending';
            }elseif($result[$a]['Leave_Status'] == 'Denied'){
                $status = 'Denied';
            }
            if ((is_array(unserialize(base64_decode($result[$a]['record_section']))) && count(unserialize(base64_decode($result[$a]['record_section']))) > 0 && unserialize(base64_decode($result[$a]['record_section']))[0] != '')) {
                $sec_count = (count(unserialize(base64_decode($result[$a]['record_section'])))) -1;
                $section =  unserialize(base64_decode($result[$a]['record_section']))[$sec_count];
            }else{
                $section =  'Unassigned';
            }
            if ((is_array(unserialize(base64_decode($result[$a]['record_status']))) && count(unserialize(base64_decode($result[$a]['record_status']))) > 0 && unserialize(base64_decode($result[$a]['record_status']))[0] != '')) {
                $stat_count = (count(unserialize(base64_decode($result[$a]['record_status'])))) -1;
                $status_emp =  unserialize(base64_decode($result[$a]['record_status']))[$stat_count];
            }else{
                $status_emp =  'Unassigned';
            }
            $request = array(
                'employee_code' => $result[$a]['PK_employee_code'],
                'emp_name'      => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).'.',
                'leave_type'    => $result[$a]['leave_type'],
                'inclusive_date'=> date('F d,Y',strtotime($result[$a]['Leave_Date_Start'])).' - '.date('F d,Y',strtotime($result[$a]['Leave_Date_End'])),
                'date_filed'    => date('F d,Y',strtotime($result[$a]['Leave_Date_Filed'])),
                'status'        => $status,
                'section'       => $section,
                'status_emp'    => $status_emp
            );
            array_push($data, $request);
        }
        foreach ($data as $key => $row) {
            $orderby['leave_type'][$key] = $row['leave_type'];
            $orderby['date_filed'][$key] = $row['date_filed'];
            $orderby['inclusive_date'][$key] = $row['inclusive_date'];
            $orderby['emp_name'][$key] = $row['emp_name'];
        }
        array_multisort($orderby['leave_type'], SORT_ASC,$orderby['emp_name'], SORT_ASC, $orderby['date_filed'], SORT_ASC,$orderby['inclusive_date'], SORT_ASC,$data);
        return $data;
    }
    
    public function generate_custom_report($data,$emp_status,$section){
        $this->db->select('emp.PK_employee_code as employee_code, CONCAT(emp.emp_LName,", ",emp.emp_FName," ",emp.emp_MName," ",emp.emp_NameExt) as emp_wname'.$data,FALSE);
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_employee_record rec','emp.PK_employee_code = rec.FK_employee_code','left');
        $this->db->join('tbl_employee_ids ids','emp.PK_employee_code = ids.FK_employee_code','left');
        $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
        $this->db->where('user.user_status','Active');
        $this->db->where('emp.PK_employee_code !=','00000');
        $this->db->order_by('emp.emp_LName');
        $query = $this->db->get();
        if($emp_status == 'All' && $section == 'All'){
			return $query->result();
		}else{
            return $query->result_array();
		}
    }

    public function get_leave_tally_monthly(){
        $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, lq.*');
        $this->db->from('tbl_employee emp');
        $this->db->join('tbl_leave_request lq','emp.PK_employee_code = lq.FK_employee_code','left');
        $this->db->where('emp.PK_employee_code','17022');
        $query = $this->db->get();
        return $query->result();
    }


















    public function get_vacation_leave_credits(){
            $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, rec.record_section, rec.record_status, rec.record_startdate, user.FK_employee_code, user.user_status, leave.emp_leave_credit, leave.days_consumed, leave.remaining_days');
            $this->db->from('tbl_employee emp');
            $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
            $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
            $this->db->join('tbl_employee_leave leave','leave.FK_employee_code = emp.PK_employee_code','left');
            $this->db->where('user.user_status','Active');
            $this->db->where('emp.PK_employee_code !=','00000');
            $this->db->where('leave.FK_leave_ID','1');
            $this->db->order_by('emp.emp_LName');
            $query = $this->db->get();
            $result = $query->result_array();
            $rows = count($result);
            $masterlist = array();
            $for_return = array();
            for($a=0;$a<$rows;$a++){
                if ((is_array(unserialize(base64_decode($result[$a]['record_startdate']))) && count(unserialize(base64_decode($result[$a]['record_startdate']))) > 0 && unserialize(base64_decode($result[$a]['record_startdate']))[0] != '')) {
                    $index_reg = array_search("Regular",(unserialize(base64_decode($result[$a]['record_status']))));
                    $regdate =  unserialize(base64_decode($result[$a]['record_startdate']))[$index_reg];
                }else{
                    $regdate =  'CONTRACTUAL';
                }
                $data = array(
                        'employee_code' => $result[$a]['PK_employee_code'],
                        'emp_name'     => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).'. '.$result[$a]['emp_NameExt'],
                        'regdate'       => $regdate,
                        'vlcredits'     => $result[$a]['emp_leave_credit'],
                        'vlused'        => $result[$a]['days_consumed'],
                        'vlremain'      => $result[$a]['remaining_days']
                );
                array_push($masterlist, $data);
            }
            return $masterlist;
        }

        public function calculate_leave_credits_allocation(){
            $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, rec.record_section, rec.record_status, rec.record_startdate, user.FK_employee_code, user.user_status');
            $this->db->from('tbl_employee emp');
            $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
            $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
            $this->db->where('user.user_status','Active');
            $this->db->where('emp.PK_employee_code !=','00000');
            $this->db->order_by('emp.emp_LName');
            $query = $this->db->get();
            $result = $query->result_array();
            $rows = count($result);
            $masterlist = array();
            $for_return = array();
            $cal = 0;
            for($a=0;$a<$rows;$a++){
                if ((is_array(unserialize(base64_decode($result[$a]['record_startdate']))) && count(unserialize(base64_decode($result[$a]['record_startdate']))) > 0 && unserialize(base64_decode($result[$a]['record_startdate']))[0] != '')) {
                    $index_reg = array_search("Regular",(unserialize(base64_decode($result[$a]['record_status']))));
                    $regdate =  unserialize(base64_decode($result[$a]['record_startdate']))[$index_reg];
                    $rec_count = (count(unserialize(base64_decode($result[$a]['record_section'])))) -1;
                    $status =  unserialize(base64_decode($result[$a]['record_status']))[$index_reg];
                    $reg_yr = date('Y',strtotime($regdate));

                    if($reg_yr == date('Y',strtotime('-1 year'))){
                        //1.25
                        $reg_month = date('n',strtotime($regdate));
                        $reg_date = date('j',strtotime($regdate));
                        $reg_yr = date('Y',strtotime($regdate));
                        $credit_alloc = 0.00;
                        $start_month = date('n',strtotime($regdate));
                        $days = cal_days_in_month(CAL_GREGORIAN,$reg_month, $reg_yr);
                        $cal = $days-$reg_date+1;
                        $add = round($cal*0.04109589,2);
                        $wh_month = 0.00;
                        for($reg_month ; $reg_month<=12;$reg_month++){
                            if($start_month == $reg_month){
                                $credit_alloc  = $credit_alloc+$add;
                            }else{
                                $credit_alloc  = $credit_alloc+1.25;
                                $wh_month = $wh_month+1.25;
                            }
                        }
                    }else{
                        $credit_alloc = "15";
                    }
                }else{
                    $regdate =  '--|';
                }
                $data = array(
                        'employee_code'         => $result[$a]['PK_employee_code'],
                        'emp_name'              => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).'. '.$result[$a]['emp_NameExt'],
                        'regdate'               => $regdate,
                        'status'                => $status,
                        'leave_alloc'           => $credit_alloc,
                        'wh_month'              => $wh_month,
                        'misc'                  => $add
                );
                if($status == 'Regular'){
                    array_push($masterlist, $data);
                }
            }
            return $masterlist;
        }

        public function calculate_leave_credits_allocation_perday(){
            $this->db->select('emp.PK_employee_code, emp.emp_LName, emp.emp_FName, emp.emp_MName, emp.emp_NameExt, rec.record_section, rec.record_status, rec.record_startdate, user.FK_employee_code, user.user_status');
            $this->db->from('tbl_employee emp');
            $this->db->join('tbl_system_users user','user.FK_employee_code = emp.PK_employee_code','left');
            $this->db->join('tbl_employee_record rec','rec.FK_employee_code = emp.PK_employee_code','left');
            $this->db->where('user.user_status','Active');
            $this->db->where('emp.PK_employee_code !=','00000');
            $this->db->order_by('emp.emp_LName');
            $query = $this->db->get();
            $result = $query->result_array();
            $rows = count($result);
            $masterlist = array();
            $for_return = array();
            $cal = 0;
            for($a=0;$a<$rows;$a++){
                if ((is_array(unserialize(base64_decode($result[$a]['record_startdate']))) && count(unserialize(base64_decode($result[$a]['record_startdate']))) > 0 && unserialize(base64_decode($result[$a]['record_startdate']))[0] != '')) {
                    $index_reg = array_search("Regular",(unserialize(base64_decode($result[$a]['record_status']))));
                    $regdate =  unserialize(base64_decode($result[$a]['record_startdate']))[$index_reg];
                    $rec_count = (count(unserialize(base64_decode($result[$a]['record_section'])))) -1;
                    $status =  unserialize(base64_decode($result[$a]['record_status']))[$index_reg];
                    $reg_yr = date('Y',strtotime($regdate));

                    if($reg_yr == date('Y',strtotime('-1 year'))){
                        //1.25
                        $reg_month = date('n',strtotime($regdate));
                        $reg_month2 = date('n',strtotime($regdate));
                        $reg_date = date('j',strtotime($regdate));
                        $reg_yr = date('Y',strtotime($regdate));
                        $start_month = date('n',strtotime($regdate));
                        $days = cal_days_in_month(CAL_GREGORIAN,$reg_month, $reg_yr);
                        $multiplier = 15/365;
                        $pre_days = $days-$reg_date+1;
                        $add = round($pre_days*$multiplier,2);
                        $wh_month = 0.00;
                        $credit_alloc = 0.00;
                        $credit_alloc_hax = 0.00;
                        $totaldays = 0;
                        $post_days = 0;
                        for($reg_month+1 ; $reg_month<12;$reg_month++){
                            $mondays = cal_days_in_month(CAL_GREGORIAN,($reg_month+1), $reg_yr);
                            $post_days = $post_days + $mondays;

                        }
                        for($reg_month2 ; $reg_month2<=12;$reg_month2++){
                            if($start_month == $reg_month2){
                                $credit_alloc_hax  = $credit_alloc_hax+$add;
                            }else{
                                $credit_alloc_hax  = $credit_alloc_hax+1.25;
                                $wh_month = $wh_month+1.25;
                            }
                        }
                        $totaldays = $pre_days+$post_days;
                        $credit_alloc = $totaldays*$multiplier;
                        $test = $add+$wh_month;
                    }else{
                        $credit_alloc = "15";
                    }
                }else{
                    $regdate =  '--|';
                }
                $data = array(
                        'employee_code'         => $result[$a]['PK_employee_code'],
                        'emp_name'              => $result[$a]['emp_LName'].', '.$result[$a]['emp_FName'].' '.substr($result[$a]['emp_MName'],0,1).'. '.$result[$a]['emp_NameExt'],
                        'regdate'               => $regdate,
                        'status'                => $status,
                        'leave_alloc_perday'    => $credit_alloc,
                        'leave_alloc_1mon'      => $credit_alloc_hax,
                        'wh_month'              => $wh_month,
                        'misc'                  => $add,
                );
                if($status == 'Regular'){
                    array_push($masterlist, $data);
                }
            }
            return $masterlist;
        }
}   