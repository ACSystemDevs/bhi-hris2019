<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">All Leave Requests</h3>
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <a href="<?php echo base_url();?>Employee-Request-Leave" class="md-btn md-btn-primary md-btn-wave-light md-btn-small"><i class="material-icons md-color-grey-50 md-24">event_busy</i>New Leave Request</a>
                        <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date Filed</th>
                                    <th>Leave Type</th>
                                    <th>Inclusive Dates</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Date Filed</th>
                                    <th>Leave Type</th>
                                    <th>Inclusive Dates</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php
                                        foreach($leave_archive as $archive){
                                            $emp_wname = $archive->emp_LName.',&nbsp;'.$archive->emp_FName.' '.substr($archive->emp_MName,0,1).' '.$archive->emp_NameExt;

                                            if($archive->Leave_Status == 'Pending' || $archive->Leave_Status == 'Recommended' || $archive->Leave_Status == 'Approved'){
                                                $status = '<span class="uk-badge uk-badge-warning">Pending</span>';
                                            }elseif($archive->Leave_Status == 'Noted'){
                                                $status = '<span class="uk-badge uk-badge-success">Noted</span>';
                                            }else{
                                                $status = '<span class="uk-badge uk-badge-danger">Denied</span>';
                                            }

                                            echo '<tr>
                                                    <td>'.$emp_wname.'</td>
                                                    <td>'.date('F d, Y',strtotime($archive->Leave_Date_Filed)).'</td>
                                                    <td>'.$archive->leave_type.'</td>
                                                    <td>'.date('F d, Y',strtotime($archive->Leave_Date_Start)).'&nbsp;-&nbsp;'.date('F d, Y',strtotime($archive->Leave_Date_End)).'</td>
                                                    <td class="uk-text-upper">'.$archive->Leave_Reason.'</td>
                                                    <td>'.$status.'</td>
                                                    </tr>';
                                        }
                                        ?>
                            </tbody>
                        </table>
            </div>
        </div>
    </div>
</div>