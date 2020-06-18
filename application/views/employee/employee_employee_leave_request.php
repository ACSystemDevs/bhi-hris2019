<div id="page_content">
    <div id="page_content_inner">
        <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
            <div class="uk-width-large-12-12">
                <div class="md-card">
                    <div class="user_heading">
                        <div class="user_heading_avatar">
                            <div class="thumbnail" style="height:125px;width:125px;">
                                <?php
                                        if(empty($profile->emp_picture)){
                                            $user_image = base_url('assets/img/avatars/user.png');
                                        }else{
                                            $user_image = base_url($profile->emp_picture);
                                        }
                                    ?>

                                    <img src="<?php echo $user_image;?>" alt="<?php echo $emp_wname;?>" />
                            </div>
                        </div>
                        <div class="user_heading_content">
                            <h2 class="heading_b uk-margin-bottom">
                                    <span class="uk-text-truncate">
                                        <?php 
                                            echo $emp_wname;
                                        ?>
                                    </span>
                                    <span class="sub-heading"><?php echo $profile->PK_employee_code;?> | 
                                        <?php
                                            if ((is_array(unserialize(base64_decode($profile->record_position))) && count(unserialize(base64_decode($profile->record_position))) > 0 && unserialize(base64_decode($profile->record_position))[0] != '')) {
                                                $pos_count = (count(unserialize(base64_decode($profile->record_position)))) -1;
                                                echo unserialize(base64_decode($profile->record_position))[$pos_count];
                                            }else{
                                                echo 'Unassigned';
                                            }
                                        ?>
                                    </span>
                                </h2>
                            <ul class="user_stats">
                                <li>
                                    <h4 class="heading_a"><i class="material-icons md-36">contact_phone</i><?php echo $profile->emp_mobno;?></h4>
                                </li>
                                <li>
                                    <h4 class="heading_a"><i class="material-icons">contact_mail</i><?php echo $profile->emp_email;?></h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="user_content">
                        <ul id="user_leave_tabs" class="uk-tab" data-uk-tab="{connect:'#user_leave_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                            <li class="uk-active"><a href="#">Apply New Request</a></li>
                            <li><a href="#">Leave History</a></li>
                        </ul>
                        <ul id="user_leave_tabs_content" class="uk-switcher uk-margin">
                            <li>
                                <form enctype="multipart/form-data" method="POST" action="<?php echo base_url();?>Request-Leave-Function/<?php echo $employee_code;?>">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-10">
                                        </div>
                                        <div class="uk-width-medium-6-10">
                                            <h3 class="heading_a">Leave Request Form</h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <select id="select_civil_status" data-md-selectize name="form_leave_type">
                                                            <option value="">Select Leave Type</option>
                                                            <?php
                                                                    foreach($emp_leave as $leave){
                                                                        echo '<option value="'.$leave->PK_leave_ID.'">['.$leave->credit_year.'] '.$leave->leave_type.'('.$leave->remaining_days.')</option>';
                                                                    }
                                                                ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <label>No of Days.</label>
                                                        <input type="text" class="md-input uk-text-upper" name="form_leave_no_days" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <label for="">From(MM/DD/YYYY)</label>
                                                        <input class="md-input uk-text-upper" type="text" id="basic_birthdate" name="form_leave_sdate" data-uk-datepicker="{format:'MM/DD/YYYY'}">
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <label for="">To(MM/DD/YYYY)</label>
                                                        <input class="md-input uk-text-upper" type="text" id="basic_birthdate" name="form_leave_edata" data-uk-datepicker="{format:'MM/DD/YYYY'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="uk-form-row">
                                                <label>Address</label>
                                                <input type="text" class="md-input uk-text-upper" name="form_leave_address" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Reason</label>
                                                <input type="text" class="md-input uk-text-upper" name="form_leave_reason" />
                                            </div>
                                            <div class="uk-form-row">
                                                <button type="submit" class="md-btn md-btn-primary md-btn-wave-light md-btn-large uk-float-right" data-uk-tooltip title="SUBMIT REQUEST"><i class="material-icons md-color-grey-50 md-24">send</i>&nbsp;SUBMIT REQUEST</button>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-2-10">
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <li>
                                <h3 class="heading_a">Leave History</h3>
                                <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date Filed</th>
                                            <th>Inclusive Dates</th>
                                            <th>Leave Type</th>
                                            <th>Address</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Date Filed</th>
                                            <th>Inclusive Dates</th>
                                            <th>Leave Type</th>
                                            <th>Address</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php                     
                                                
                                                    foreach($leave_history as $history){
                                                        if(empty($history->PK_request_ID)){
                                                            echo '<tr class="uk-text-center uk-text-danger">
                                                                    <td colspan="6">No Data Found</td>
                                                                    </tr>';
                                                        }else{
                                                        if($history->Leave_Status == 'Pending' || $history->Leave_Status == 'Recommended' || $history->Leave_Status == 'Approved'){
                                                            $status = '<span class="uk-badge uk-badge-warning">Pending</span>';
                                                        }elseif($history->Leave_Status == 'Noted'){
                                                            $status = '<span class="uk-badge uk-badge-success">Noted</span>';
                                                        }else{
                                                            $status = '<span class="uk-badge uk-badge-danger">Denied</span>';
                                                        }
                                                        echo '<tr>
                                                            <td>'.date('F d, Y',strtotime($history->Leave_Date_Filed)).'</td>
                                                            <td>'.date('F d, Y',strtotime($history->Leave_Date_Start)).'&nbsp;-&nbsp;'.date('F d, Y',strtotime($history->Leave_Date_End)).'</td>
                                                            <td>'.$history->leave_type.'</td>
                                                            <td>'.$history->Leave_Address.'</td>
                                                            <td>'.$history->Leave_Reason.'</td>
                                                            <td>'.$status.'</td>
                                                            </tr>';
                                                        }
                                                    }
                                            ?>
                                    </tbody>
                                </table>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>