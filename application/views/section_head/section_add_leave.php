<div id="page_content">
    <div id="page_content_inner">
        <div class="uk-grid">
            <div class="uk-width-medium-7-10">
                <h4 class="heading_a uk-margin-bottom">Leave Type List</h4>
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-content">
                        <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Default Credit</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Default Credit</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                    foreach($leavetype as $type){
                                        if($type->leave_type_status == 'Active'){
                                            $status = '<span class="uk-badge uk-badge-primary">Active</span>';
                                        }else{
                                            $status = '<span class="uk-badge uk-badge-danger">Inactive</span>';
                                        }
                                        echo '<tr>
                                                <td>'.$type->leave_type.'</td>
                                                <td>'.$type->leave_default_credit.'</td>
                                                <td>'.$status.'</td>
                                                <td><a href="#" class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="EDIT LEAVE"><i class="material-icons md-color-grey-50 md-24">edit</i></a></td>
                                             </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-3-10">
                <h4 class="heading_a uk-margin-bottom">Add Leave Type</h4>
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-content">
                        <form enctype="multipart/form-data" method="POST" action="<?php base_url();?>Add-LeaveType-Function">
                            <div class="uk-form-row">
                                <div class="uk-form-row">
                                    <label>Leave Type</label>
                                    <input type="text" class="md-input uk-text-upper" name="form_leave_type" />
                                </div>
                                <div class="uk-form-row">
                                    <label>Leave Default Credit</label>
                                    <input type="text" class="md-input uk-text-upper" name="form_leave_default" />
                                </div>
                                <div class="uk-form-row">
                                    <button type="submit" class="md-btn md-btn-primary md-btn-wave-light">ADD LEAVE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>