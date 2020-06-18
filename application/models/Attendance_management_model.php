<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function sync_terminal_records_to_db($data)
    {
        $records = count($data);
        $new_records = 0;
        $old_records = 0;
        for($i=0; $i < $records; $i++) 
        {
            $to_sync = array(
                'FK_Attendance_log_ID' => $data[$i]["uid"],
                'FK_employee_code' => $data[$i]["id"],
                'Attendance_Date' => date('Y-m-d', strtotime($data[$i]['timestamp'])),
                'Attendance_Time' => date('H:i:s', strtotime($data[$i]['timestamp'])),
                'Attendance_State' => $data[$i]["state"],
                'Attendance_Date_Updated' => date('Y-m-d')
            );
            $where_FK = $to_sync["FK_Attendance_log_ID"];
            $this->db->select('att.PK_emp_attendance_ID');
            $this->db->from('tbl_employee_attendance att');
            $this->db->where('att.FK_Attendance_log_ID',$where_FK);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $record = 0;
                //record exists to HRMIS Database
            }else{
                $record = 1;
                //record is not synced on HRMIS Database
            }
                //if record exist no action
            if($record == 0){
                $old_records++;
            }else{
                $this->db->insert('tbl_employee_attendance',$to_sync);
                $new_records++;
            }
        }

        $result = array(
            'old' => $old_records,
            'new' => $new_records
        );
        return $result;
    }

    public function get_last_attendance_records(){
        $this->db->select('att.FK_attendance_log_ID, att.Attendance_Date_Updated, att.PK_emp_attendance_ID');
        $this->db->from('tbl_employee_attendance att');
        $this->db->order_by('att.Attendance_Date_Updated','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_attendance_by_ID($employee_code){
        $days = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
        if($days > date('d')){
            $days_count = date('d');
        }else{
            $days_count = $days;
        }
        $day=1;
        $for_return = array();
        for($i=0;$i < $days_count;$i++){
            $date_mon =  date('Y-m').'-'.$day;
            $this->db->from('tbl_employee_attendance att');
            $this->db->where('att.Attendance_Date',$date_mon);
            $this->db->where('att.FK_employee_code',$employee_code);
            $this->db->order_by('att.Attendance_Time');
            $query = $this->db->get();
            $rows = $query->num_rows();
            $result = $query->result_array();
            if($rows > 0){
                if($rows == 1){
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=> $result[$rows-1]["Attendance_Time"],
                        'Att_TimeMisc' => null,
                        'Att_TimeMisc1' => null
                    );
                }elseif($rows == 2){
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=> $result[$rows-2]["Attendance_Time"],
                        'Att_TimeOut'=> $result[$rows-1]['Attendance_Time'],
                        'Att_TimeMisc' => null,
                        'Att_TimeMisc1' => null
                    );
                }elseif($rows == 3){
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=> $result[$rows-3]["Attendance_Time"],
                        'Att_TimeOut'=> $result[$rows-2]['Attendance_Time'],
                        'Att_TimeMisc' => $result[$rows-1]['Attendance_Time'],
                        'Att_TimeMisc1' => null
                    );
                }elseif($rows == 4){
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=> $result[$rows-3]["Attendance_Time"],
                        'Att_TimeOut'=> $result[$rows-2]['Attendance_Time'],
                        'Att_TimeMisc' => $result[$rows-1]['Attendance_Time'],
                        'Att_TimeMisc1' => $result[$rows-1]['Attendance_Time'],
                    );
                }
                $merge = array_merge($for_return,$data);
            }else{
                $data = array(
                    'Att_Date' => $date_mon,
                    'Att_TimeIn'=>"OFF",
                    'Att_TimeOut'=> "OFF"
                );
                $merge = array_merge($for_return,$data);
            }
            $day++;
            array_push($for_return,$merge);
        }
        // exit();
        return $for_return;
    }
    public function get_attendance_by_ID_past_month($employee_code){
        $days = cal_days_in_month(CAL_GREGORIAN,date('m',strtotime("-1 month")),date('Y'));
        $day=1;
        $for_return = array();
        for($i=0;$i < $days;$i++){
            $date_mon =  date('Y').'-'.date('m',strtotime("-1 month")).'-'.$day;
            $this->db->from('tbl_employee_attendance att');
            $this->db->where('att.Attendance_Date',$date_mon);
            $this->db->where('att.FK_employee_code',$employee_code) ;
            $this->db->order_by('att.Attendance_Time');
            $query = $this->db->get();
            $rows = $query->num_rows();
            $result = $query->result_array();
            if($rows > 0){
                if($rows == 1){
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=> $result[$rows-1]["Attendance_Time"],
                        'Att_TimeMisc' => null,
                        'Att_TimeMisc1' => null
                    );
                }elseif($rows == 2){
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=> $result[$rows-2]["Attendance_Time"],
                        'Att_TimeOut'=> $result[$rows-1]['Attendance_Time'],
                        'Att_TimeMisc' => null,
                        'Att_TimeMisc1' => null
                    );
                }elseif($rows == 3){
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=> $result[$rows-3]["Attendance_Time"],
                        'Att_TimeOut'=> $result[$rows-2]['Attendance_Time'],
                        'Att_TimeMisc' => $result[$rows-1]['Attendance_Time'],
                        'Att_TimeMisc1' => null
                    );
                }elseif($rows == 4){
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=> $result[$rows-4]["Attendance_Time"],
                        'Att_TimeOut'=> $result[$rows-3]['Attendance_Time'],
                        'Att_TimeMisc' => $result[$rows-2]['Attendance_Time'],
                        'Att_TimeMisc1' => $result[$rows-1]['Attendance_Time'],
                    );
                }
                $merge = array_merge($for_return,$data);
            }else{
                $data = array(
                    'Att_Date' => $date_mon,
                    'Att_TimeIn'=>"OFF",
                    'Att_TimeOut'=> "OFF"
                );
                $merge = array_merge($for_return,$data);
            }
            $day++;
            array_push($for_return,$merge);
        }
        // exit();
        return $for_return;
    }

    public function get_attendance_by_date_and_ID($employee_code,$dates){
        $date_from = date('Y-m-d',strtotime($dates['Date_From']));
        $date_to = date('Y-m-d',strtotime($dates['Date_To']));
        $employee_code = $employee_code["FK_employee_code"];
        $date_from_mY = date('Y-m',strtotime($date_from));
        $date_to_mY = date('Y-m',strtotime($date_to));
        $date_from_d = date('d',strtotime($date_from));
        $date_to_d = date('d',strtotime($date_to));
        $inclusive_dates = array();
        if($date_from_mY == $date_to_mY){
            for($i = intval($date_from_d);$i <= $date_to_d;$i++){
                if($i <= 9){
                    $i= '0'.$i;
                }
                $date_from_final = $date_from_mY.'-'.$i;
                array_push($inclusive_dates,$date_from_final);
            }
            $days_count = count($inclusive_dates);
            $for_return = array();
            for($z=0;$z < $days_count;$z++){
                $date_mon = $inclusive_dates[$z];
                $this->db->from('tbl_employee_attendance att');
                $this->db->where('att.Attendance_Date',$date_mon);
                $this->db->where('att.FK_employee_code',$employee_code);
                $this->db->order_by('att.Attendance_Time');
                $query = $this->db->get();
                $rows = $query->num_rows();
                $result = $query->result_array();
                if($rows > 0){
                    if($rows == 1){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-1]["Attendance_Time"],
                            'Att_TimeOut'=> null,
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 2){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-2]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-1]['Attendance_Time'],
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 3){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-3]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-2]['Attendance_Time'],
                            'Att_TimeMisc' => $result[$rows-1]['Attendance_Time'],
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 4){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-4]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-3]['Attendance_Time'],
                            'Att_TimeMisc' => $result[$rows-2]['Attendance_Time'],
                            'Att_TimeMisc1' => $result[$rows-1]['Attendance_Time'],
                        );
                    }
                    $merge = array_merge($for_return,$data);
                }else{
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=>"OFF",
                        'Att_TimeOut'=> "OFF"
                    );
                    $merge = array_merge($for_return,$data);
                }
                array_push($for_return,$merge);
            }
        }else{
            $affected_days1 = cal_days_in_month(CAL_GREGORIAN,date('m',strtotime($date_from)),date('Y',strtotime($date_from)));
            $affected_days2 = cal_days_in_month(CAL_GREGORIAN,date('m',strtotime($date_to)),date('Y',strtotime($date_to)));
            for($i = intval($date_from_d);$i<= $affected_days1;$i++){
                if($i <= 9){
                    $i= '0'.$i;
                }
                $date_from_final = $date_from_mY.'-'.$i;
                array_push($inclusive_dates,$date_from_final);
            }
            for($j = 1;$j<= $date_to_d;$j++){
                if($j <= 9){
                    $j= '0'.$j;
                }
                $date_to_final =  $date_to_mY.'-'.$j;
                array_push($inclusive_dates,$date_to_final);
            }
            $days_count = count($inclusive_dates);
            $for_return = array();
            for($z=0;$z < $days_count;$z++){
                $date_mon = $inclusive_dates[$z];
                $this->db->from('tbl_employee_attendance att');
                $this->db->where('att.Attendance_Date',$date_mon);
                $this->db->where('att.FK_employee_code',$employee_code);
                $this->db->order_by('att.Attendance_Time');
                $query = $this->db->get();
                $rows = $query->num_rows();
                $result = $query->result_array();
                if($rows > 0){
                    if($rows == 1){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-1]["Attendance_Time"],
                            'Att_TimeOut'=> null,
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 2){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-2]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-1]['Attendance_Time'],
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 3){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-3]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-2]['Attendance_Time'],
                            'Att_TimeMisc' => $result[$rows-1]['Attendance_Time'],
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 4){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-4]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-3]['Attendance_Time'],
                            'Att_TimeMisc' => $result[$rows-2]['Attendance_Time'],
                            'Att_TimeMisc1' => $result[$rows-1]['Attendance_Time'],
                        );
                    }
                    $merge = array_merge($for_return,$data);
                }else{
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=>"OFF",
                        'Att_TimeOut'=> "OFF"
                    );
                    $merge = array_merge($for_return,$data);
                }
                array_push($for_return,$merge);
            }
        }
        return $for_return;
    }

    public function get_attendance_by_date_and_ID_prev($employee_code,$dates){
        $date_from = date('Y-m-d',strtotime($dates['Date_From']));
        $date_to = date('Y-m-d',strtotime($dates['Date_To']));
        $employee_code = $employee_code["FK_employee_code"];
        $date_from_mY = date('Y-m',strtotime($date_from));
        $date_to_mY = date('Y-m',strtotime($date_to));
        $date_from_d = date('d',strtotime($date_from));
        $date_to_d = date('d',strtotime($date_to));
        $inclusive_dates = array();
        if($date_from_mY == $date_to_mY){
            for($i = intval($date_from_d);$i <= $date_to_d;$i++){
                if($i <= 9){
                    $i= '0'.$i;
                }
                $date_from_final = $date_from_mY.'-'.$i;
                array_push($inclusive_dates,$date_from_final);
            }
            $days_count = count($inclusive_dates);
            $for_return = array();
            for($z=0;$z < $days_count;$z++){
                $date_mon = $inclusive_dates[$z];
                $this->db->from('tbl_employee_attendance_2 att');
                $this->db->where('att.Attendance_Date',$date_mon);
                $this->db->where('att.FK_employee_code',$employee_code);
                $this->db->order_by('att.Attendance_Time');
                $query = $this->db->get();
                $rows = $query->num_rows();
                $result = $query->result_array();
                if($rows > 0){
                    if($rows == 1){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-1]["Attendance_Time"],
                            'Att_TimeOut'=> null,
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 2){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-2]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-1]['Attendance_Time'],
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 3){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-3]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-2]['Attendance_Time'],
                            'Att_TimeMisc' => $result[$rows-1]['Attendance_Time'],
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 4){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-4]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-3]['Attendance_Time'],
                            'Att_TimeMisc' => $result[$rows-2]['Attendance_Time'],
                            'Att_TimeMisc1' => $result[$rows-1]['Attendance_Time'],
                        );
                    }
                    $merge = array_merge($for_return,$data);
                }else{
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=>"OFF",
                        'Att_TimeOut'=> "OFF"
                    );
                    $merge = array_merge($for_return,$data);
                }
                array_push($for_return,$merge);
            }
        }else{
            $affected_days1 = cal_days_in_month(CAL_GREGORIAN,date('m',strtotime($date_from)),date('Y',strtotime($date_from)));
            $affected_days2 = cal_days_in_month(CAL_GREGORIAN,date('m',strtotime($date_to)),date('Y',strtotime($date_to)));
            for($i = intval($date_from_d);$i<= $affected_days1;$i++){
                if($i <= 9){
                    $i= '0'.$i;
                }
                $date_from_final = $date_from_mY.'-'.$i;
                array_push($inclusive_dates,$date_from_final);
            }
            for($j = 1;$j<= $date_to_d;$j++){
                if($j <= 9){
                    $j= '0'.$j;
                }
                $date_to_final =  $date_to_mY.'-'.$j;
                array_push($inclusive_dates,$date_to_final);
            }
            $days_count = count($inclusive_dates);
            $for_return = array();
            for($z=0;$z < $days_count;$z++){
                $date_mon = $inclusive_dates[$z];
                $this->db->from('tbl_employee_attendance_2 att');
                $this->db->where('att.Attendance_Date',$date_mon);
                $this->db->where('att.FK_employee_code',$employee_code);
                $this->db->order_by('att.Attendance_Time');
                $query = $this->db->get();
                $rows = $query->num_rows();
                $result = $query->result_array();
                if($rows > 0){
                    if($rows == 1){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-1]["Attendance_Time"],
                            'Att_TimeOut'=> null,
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 2){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-2]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-1]['Attendance_Time'],
                            'Att_TimeMisc' => null,
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 3){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-3]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-2]['Attendance_Time'],
                            'Att_TimeMisc' => $result[$rows-1]['Attendance_Time'],
                            'Att_TimeMisc1' => null
                        );
                    }elseif($rows == 4){
                        $data = array(
                            'Att_Date' => $date_mon,
                            'Att_TimeIn'=> $result[$rows-4]["Attendance_Time"],
                            'Att_TimeOut'=> $result[$rows-3]['Attendance_Time'],
                            'Att_TimeMisc' => $result[$rows-2]['Attendance_Time'],
                            'Att_TimeMisc1' => $result[$rows-1]['Attendance_Time'],
                        );
                    }
                    $merge = array_merge($for_return,$data);
                }else{
                    $data = array(
                        'Att_Date' => $date_mon,
                        'Att_TimeIn'=>"OFF",
                        'Att_TimeOut'=> "OFF"
                    );
                    $merge = array_merge($for_return,$data);
                }
                array_push($for_return,$merge);
            }
        }
        return $for_return;
    }

    public function add_new_record($data){
        $this->db->insert('tbl_employee_attendance',$data);
    }

    public function add_new_record_prev($data){
        $this->db->insert('tbl_employee_attendance_2',$data);
    }
}