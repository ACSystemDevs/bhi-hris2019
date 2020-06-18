<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">My Leave History</h3>
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
            <h4 class="heading_c uk-margin-small-bottom ">Leave Credit for <?php echo date('Y');?></h4>
                            <table id="dt_pending" class="uk-table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Leave Type</th>
                                            <th>Leave Used</th>
                                            <th>Remaining Days</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Leave Type</th>
                                            <th>Leave Used</th>
                                            <th>Remaining Days</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                            <?php
                                                foreach($leave_credit as $credit){
                                                    echo '<tr>
                                                    <td>'.$credit->leave_type.'</td>
                                                    <td>'.$credit->days_consumed.'</td>
                                                    <td>'.$credit->remaining_days.'</td>
                                                    <td>'.$credit->emp_leave_credit.'</td>
                                                    </tr>';
                                                }
                                            ?>
                                    </tbody>
                                </table>
            </div>
        </div>
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                                <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date Filed</th>
                                            <th>Inclusive Dates</th>
                                            <th>Leave Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Date Filed</th>
                                            <th>Inclusive Dates</th>
                                            <th>Leave Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                                            <td>'.$status.'</td>
                                                            <td><button class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW LEAVE" onclick="modal_view_leave_details(' . "'" . $history->PK_request_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">visibility</i></button></td>
                                                            </tr>';
                                                        }
                                                    }
                                            ?>
                                    </tbody>
                                </table>
                                 <!-- MODAL START -->
                <div class="uk-modal" id="view_request_modal">
                    <div class="uk-modal-dialog">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Leave Request</h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-margin-medium-bottom">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-small-3-5">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Date:</span>
                                        <p id="ajax_date_filed"></p>
                                    </div>
                                    <div class="uk-width-small-2-5">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Status</span>
                                        <span class="uk-badge uk-badge-primary" id="ajax_leave_status"></span>
                                    </div>
                                </div>
                                <span class="uk-text-muted uk-text-small uk-text-italic">Employee Name:</span>
                                <p id="ajax_emp_wname"></p>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-small-3-5">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Inclusive Date:</span>
                                        <p id="ajax_inclusive_date"></p>
                                    </div>
                                    <div class="uk-width-small-2-5">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Total Days:</span>
                                        <p class="uk-text-bold" id="ajax_no_of_days"></p>
                                    </div>
                                </div>
                                <br/>
                                <span class="uk-text-muted uk-text-small uk-text-italic">Address</span>
                                <p class="uk-margin-top-remove" id="ajax_leave_address"></p>
                                <span class="uk-text-muted uk-text-small uk-text-italic">Reason</span>
                                <p class="uk-margin-top-remove" id="ajax_leave_reason"></p>
                            </div>
                            <div class="uk-modal-footer uk-text-right">
                                <button type="button" class="md-btn md-btn-danger md-btn-wave-light uk-modal-close">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL END -->
            </div>
        </div>
    </div>

</div>