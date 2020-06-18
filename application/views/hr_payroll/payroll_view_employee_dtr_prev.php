<div id="page_content">
    <div id="page_content_inner">
    <h3 class="heading_b uk-margin-bottom">Employee Attendance Viewer</h3>
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="md-card">
                <form enctype="multipart/form-data" method="POST" action="<?php base_url();?>Calculate-Attendance_prev">
                    <div class="md-card-content">
                        <h3 class="heading_a">Select Employee(Maximum Allowable Scope is two months)</h3>
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
    </div>
</div>