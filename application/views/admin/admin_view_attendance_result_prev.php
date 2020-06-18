<div id="page_content">
    <div id="page_content_inner">
    <h3 class="heading_b uk-margin-bottom">Employee Attendance Viewer</h3>
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="md-card">
                <form enctype="multipart/form-data" method="POST" action="<?php base_url();?>Calculate-Attendance_prev">
                    <div class="md-card-content">
                        <h3 class="heading_a">Select Employee</h3>
                        <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-4">
                            <div>
                                <label>Employee Name</label>
                                    <select id="select_att_employee" data-md-selectize name="form_emp_code_att">
                                        <option value="">Select Employee</option>
                                        <?php
                                        foreach($employee as $emp){
                                            $emp_wname = $emp->emp_LName.',&nbsp;'.$emp->emp_FName;
                                            echo '<option value="'.$emp->PK_employee_code.'">'.$emp_wname.'</option>';
                                        }

                                        ?>
                                    </select>
                            </div>
                            <div>
                                <br/>
                                <label>From</label>
                                    <input class="md-input uk-text-upper" type="text" id="date_from" name="form_emp_att_from" data-uk-datepicker="{format:'MM/DD/YYYY'}" autocomplete="off">
                            </div>
                            <div>
                                <br/>
                                <label>To</label>
                                    <input class="md-input uk-text-upper" type="text" id="date_to" name="form_emp_att_to" data-uk-datepicker="{format:'MM/DD/YYYY'}" autocomplete="off">
                            </div>
                            <div>
                                <br/>
                                <button type="submit" class="md-btn md-btn-primary md-btn-wave-light md-btn-large md-btn-block"><i class="material-icons md-color-grey-50 md-24">event_available</i>CALCULATE</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="md-card">
                    <div class="md-card-content">
                    <ul class="md-list">
                        <li>
                            <div class="md-list-content">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-large-1-5">
                                        <span class="md-list-heading">
                                        <?php echo $active_emp->PK_employee_code;?>
                                        </span>
                                        <span class="uk-text-small uk-text-muted">ID No.</span>
                                    </div>
                                    <div class="uk-width-large-1-5">
                                        <span class="md-list-heading">
                                        <?php echo $active_emp->emp_LName.', '.$active_emp->emp_FName;?>
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Name</span>
                                    </div>
                                    <div class="uk-width-large-1-5">
                                        <span class="md-list-heading">
                                        <?php
                                            if ((is_array(unserialize(base64_decode($active_emp->record_position))) && count(unserialize(base64_decode($active_emp->record_position))) > 0 && unserialize(base64_decode($active_emp->record_position))[0] != '')) {
                                                $pos_count = (count(unserialize(base64_decode($active_emp->record_position)))) -1;
                                                echo unserialize(base64_decode($active_emp->record_position))[$pos_count];
                                            }else{
                                                echo 'Unassigned';
                                            }
                                        ?>
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Position</span>
                                    </div>
                                    <div class="uk-width-large-1-5">
                                        <span class="md-list-heading">
                                        <?php
                                            if ((is_array(unserialize(base64_decode($active_emp->record_section))) && count(unserialize(base64_decode($active_emp->record_section))) > 0 && unserialize(base64_decode($active_emp->record_section))[0] != '')) {
                                                $pos_count = (count(unserialize(base64_decode($active_emp->record_section)))) -1;
                                                echo unserialize(base64_decode($active_emp->record_section))[$pos_count];
                                            }else{
                                                echo 'Unassigned';
                                            }
                                        ?>
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Section</span>
                                    </div>
                                    <div class="uk-width-large-1-5">
                                        <span class="md-list-heading">
                                        <?php
                                            if ((is_array(unserialize(base64_decode($active_emp->record_status))) && count(unserialize(base64_decode($active_emp->record_status))) > 0 && unserialize(base64_decode($active_emp->record_status))[0] != '')) {
                                                $pos_count = (count(unserialize(base64_decode($active_emp->record_status)))) -1;
                                                echo unserialize(base64_decode($active_emp->record_status))[$pos_count];
                                            }else{
                                                echo 'Unassigned';
                                            }
                                        ?>
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Employment Status</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Daily Time Record</h4>
                        <div class="uk-overflow-container">
                            <table class="uk-table uk-table-condensed uk-table-hover">
                                <thead >
                                    <tr>
                                        <th style="width:20%;" class="uk-text-center">Date</th>
                                        <th style="width:20%;">IN</th>
                                        <th style="width:20%;">OUT</th>
                                        <th style="width:20%;">IN</th>
                                        <th style="width:20%;">OUT</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>IN</th>
                                        <th>OUT</th>
                                        <th>IN</th>
                                        <th>OUT</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $rows = count($att_log);
                                for($i=0;$i < $rows;$i++){
                                        $time_miscs ="";
                                        $time_miscs1 ="";
                                    if((($att_log[$i]["Att_TimeIn"]) == 'OFF') && (($att_log[$i]["Att_TimeOut"]) == 'OFF')){
                                        $time_in = "";
                                        $time_out = "";
                                    }else{
                                        $time_in = date('h:i:sA',strtotime($att_log[$i]['Att_TimeIn']));
                                        if(empty($att_log[$i]['Att_TimeOut'])){
                                            $time_out = null;
                                        }else{
                                            $time_out = date('h:i:sA',strtotime($att_log[$i]['Att_TimeOut']));
                                        }
                                        if($att_log[$i]['Att_TimeMisc']){
                                            $time_miscs = date('h:i:sA',strtotime($att_log[$i]['Att_TimeMisc']));
                                        }
                                        if($att_log[$i]['Att_TimeMisc1']){
                                            $time_miscs1 = date('h:i:sA',strtotime($att_log[$i]['Att_TimeMisc1']));
                                        }
                                    }
                                    echo '<tr>
                                        <td>'.date('F d,Y (l)',strtotime($att_log[$i]['Att_Date'])).'</td>
                                        <td>'.$time_in.'</td>
                                        <td>'.$time_out.'</td>
                                        <td>'.$time_miscs.'</td>
                                        <td>'.$time_miscs1.'</td>
                                        </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="md-fab-wrapper md-fab-in-card" style="position:fixed;bottom:50;">
            <button type="button" class="md-fab md-fab-success md-fab-wave-light" data-uk-tooltip title="ADD TIME" onclick="add_time_att()"><i class="material-icons">event</i></button>
        </div>
        <div class="uk-modal" id="add_time_att_modal">
                    <div class="uk-modal-dialog">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">ADD RECORD</h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-margin-medium-bottom">
                            <form enctype="multipart/form-data" method="POST" id="att_new_record_form">
                                <div class="uk-form-row">
                                    <label>Date</label>
                                    <input type="date" class="md-input label-fixed" id="att_reference_date" name="att_reference_date" autocomplete="off"/>
                                </div>
                                <div class="uk-form-row">
                                    <label>Time</label>
                                    <input type="time" class="md-input label-fixed" id="att_reference_time" name="att_reference_time" autocomplete="off"/>
                                    <input type="hidden" value="<?php echo$active_emp->PK_employee_code;?>" name="att_reference_emp_code">
                                </div>
                            </div>
                            <div class="uk-modal-footer uk-text-right">
                                <button type="button" class="md-btn md-btn-danger md-btn-wave-light uk-modal-close">Close</button>
                                <button type="submit" class="md-btn md-btn-primary md-btn-wave-light">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>