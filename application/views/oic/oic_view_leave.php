<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">Leave Requests<small>&nbsp;(for the month of <i class="material-icons">event</i><?php echo date('F');?>)</small></h3>
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                        <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date Filed</th>
                                    <th>Leave Type</th>
                                    <th>Inclusive Dates</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Date Filed</th>
                                    <th>Leave Type</th>
                                    <th>Inclusive Dates</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php
                                        foreach($leave_request as $request){
                                            $emp_wname = $request->emp_LName.',&nbsp;'.$request->emp_FName.' '.substr($request->emp_MName,0,1).' '.$request->emp_NameExt;

                                            if($request->Leave_Status == 'Approved'){
                                                $status = '<span class="uk-badge uk-badge-default" data-uk-tooltip title="Approved by HR">Approved</span>';
                                                $buttons = '<button class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW LEAVE" onclick="modal_view_leave_details(' . "'" .  $request->PK_request_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">visibility</i></button>
                                                            <button class="md-btn md-btn-success md-btn-wave-light md-btn-small" data-uk-tooltip title="APPROVE LEAVE" onclick="modal_leave_approve_oic(' . "'" .  $request->PK_request_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">done</i></button>
                                                            <button class="md-btn md-btn-danger md-btn-wave-light md-btn-small" data-uk-tooltip title="DISAPPROVE LEAVE" onclick="modal_leave_disapprove_oic(' . "'" .  $request->PK_request_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">close</i></button>';
                                            }elseif($request->Leave_Status == 'Noted'){
                                                $status = '<span class="uk-badge uk-badge-success" data-uk-tooltip title="Approved by President">Noted</span>';
                                                $buttons = '<button class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW LEAVE" onclick="modal_view_leave_details(' . "'" .  $request->PK_request_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">visibility</i></button>
                                                <button class="md-btn md-btn-danger md-btn-wave-light md-btn-small" data-uk-tooltip title="DISAPPROVE LEAVE" onclick="modal_leave_disapprove_oic(' . "'" .  $request->PK_request_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">close</i></button>';
                                            }elseif($request->Leave_Status == 'Disapproved_Pres'){
                                                $status = '<span class="uk-badge uk-badge-danger" data-uk-tooltip title="Disapproved by President">Disapproved</span>';
                                                $buttons = '<button class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW LEAVE" onclick="modal_view_leave_details(' . "'" .  $request->PK_request_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">visibility</i></button>
                                                <button class="md-btn md-btn-success md-btn-wave-light md-btn-small" data-uk-tooltip title="APPROVE LEAVE" onclick="modal_leave_approve_oic(' . "'" .  $request->PK_request_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">done</i></button>';
                                            }
                                            if($request->Leave_Status == 'Approved' || $request->Leave_Status == 'Noted' || $request->Leave_Status == 'Disapproved_Pres'){
                                                echo '<tr>
                                                <td>'.$emp_wname.'</td>
                                                <td>'.date('F d, Y',strtotime($request->Leave_Date_Filed)).'</td>
                                                <td>'.$request->leave_type.'</td>
                                                <td>'.date('F d, Y',strtotime($request->Leave_Date_Start)).'&nbsp;-&nbsp;'.date('F d, Y',strtotime($request->Leave_Date_End)).'</td>
                                                <td>'.$status.'</td>
                                                <td>'.$buttons.'</td>
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
                        <!-- APPROVE MODAl -->
                        <div class="uk-modal" id="approve_modal">
                            <div class="uk-modal-dialog">
                                <div class="uk-modal-header">
                                    <h3 class="uk-modal-title">Approve Request</h3>
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
                                        <button type="button" class="md-btn md-btn-danger md-btn-wave-light uk-modal-close">Close</button>\
                                        <button type="button" class="md-btn md-btn-success md-btn-wave-light">Approve</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>