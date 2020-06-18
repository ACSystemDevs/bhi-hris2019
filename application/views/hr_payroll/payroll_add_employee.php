<div id="page_content">
    <div id="page_content_inner">
        <form class="uk-form-stacked" enctype="multipart/form-data" method="POST" action="<?php echo base_url();?>Register-Employee-Function">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-12-12">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="height:135px;width:135px;">
                                    <img src="<?php echo base_url(); ?>assets/img/avatars/user.png" alt="user avatar" />
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="height:135px;width:135px;"></div>
                                <div class="user_avatar_controls">
                                    <span class="btn-file">
                                            <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                    <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                    <input type="file" name="userfile" id="user_edit_avatar_control">
                                    </span>
                                    <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom">
                                    <span class="uk-text-truncate">
                                        Add New Employee
                                    </span>
                                </h2>
                                <div id="default_id" style="display:block;">
                                    <!-- <ul class="user_stats">
                                        <li>
                                            <h4 class="heading_a"><input type="text" class="md-input uk-align-center" value="<?php echo $employee_code;?>" name="PK_employee_code" maxlength="5" style="background:#fff;"><span class="sub-heading">ID Number</span></h4>
                                        </li>
                                        <li>
                                            <h4 class="heading_a"><input type="text" class="md-input uk-align-center" value="<?php echo 'Active';?>" style="background:#fff;" disabled><span class="sub-heading">Account Status</span></h4>
                                        </li>
                                        <li>
                                            <h4 class="heading_a"><input type="text" class="md-input uk-align-center" value="<?php echo 'Employee';?>" style="background:#fff;" disabled><span class="sub-heading">Usertype</span></h4>
                                        </li>
                                    </ul>-->
                                    <ul class="user_stats">
                                    <li>
                                        <h4 class="heading_a"><?php echo $employee_code;?><span class="sub-heading">ID Number</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a"><?php echo 'Active';?><span class="sub-heading">Account Status</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a"><?php echo 'Employee';?><span class="sub-heading">Usertype</span></h4>
                                    </li>
                                </ul> 
                                </div>
                            </div>
                            <div class="md-fab-wrapper">
                                <button type="submit" class="md-fab md-fab-small md-fab-accent" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'bottom'}" title="Save"><i class="material-icons">save</i></button>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-form-row">
                                <h3>Employee Name</h3>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-4">
                                        <label>Last Name</label>
                                        <input type="text" class="md-input uk-text-upper" name="emp_LName" value="<?php echo set_value('emp_LName');?>" />
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label>First Name</label>
                                        <input type="text" class="md-input uk-text-upper" name="emp_FName" value="<?php echo set_value('emp_LName');?>" />
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label>Middle Name</label>
                                        <input type="text" class="md-input uk-text-upper" name="emp_MName" value="<?php echo set_value('emp_LName');?>" />
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <select id="select_name_ext" data-md-selectize name="emp_nameext">
                                            <option value="">Name Ext.</option>
                                            <optgroup label="Name Extension(If Any)">
                                                <option value="Jr">Jr</option>
                                                <option value="Sr">Sr</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#">Personal Information</a></li>
                                <li><a href="#">Additional Information</a></li>
                                <li><a href="#">Employment History</a></li>
                                <li><a href="#">Education History</a></li>
                                <li><a href="#">Family Background</a></li>
                                <li><a href="#">Spouse / Dependents</a></li>
                                <li><a href="#">Service Record</a></li>
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                    <!-- Personal Information -->
                                    <br/>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3 class="heading_a">Basic Information</h3>
                                            <div class="uk-form-row">
                                                <label for="">Birthdate(MM/DD/YYYY)</label>
                                                <input class="md-input uk-text-upper" type="text" id="basic_birthdate" name="emp_birthdate" data-uk-datepicker="{format:'MM/DD/YYYY'}">
                                            </div>
                                            <div class="uk-form-row">
                                                <label for="">Birthplace</label>
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-3">
                                                        <label>Town</label>
                                                        <select id="select_bplace_citymun" data-md-selectize name="emp_bplace_citymun">
                                                            <option value="">Select City/Municipality</option>
                                                            <?php
                                                                    foreach($ref_citymun as $citymun){
                                                                        echo '<option value="'.$citymun->citymunDesc.'">'.$citymun->citymunDesc.'</option>';
                                                                    }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label>Province</label>
                                                        <select id="select_bplace_province" data-md-selectize name="emp_bplace_province">
                                                            <option value="">Select Province</option>
                                                            <?php
                                                                    foreach($ref_province as $province){
                                                                        echo '<option value="'.$province->provDesc.'">'.$province->provDesc.'</option>';
                                                                    }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label>Region</label>
                                                        <select id="select_bplace_region" data-md-selectize name="emp_bplace_region">
                                                            <option value="">Select Region</option>
                                                            <?php
                                                                    foreach($ref_region as $region){
                                                                        echo '<option value="'.$region->regDesc.'">'.$region->regDesc.'</option>';
                                                                    }
                                                                ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Religion</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_religion" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Citizenship</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_citizenship" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Civil Status</label>
                                                <select id="select_civil_status" data-md-selectize name="emp_civilstatus">
                                                    <option value="">Select...</option>
                                                    <optgroup label="Civil Status">
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Divored">Divorced</option>
                                                        <option value="Legally Separated">Legally Separated</option>
                                                        <option value="Widowed">Widowed</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Gender:</label>
                                                <span class="icheck-inline">
                                                        <input type="radio" name="emp_gender" id="radio_gender_male" value="MALE" data-md-icheck />
                                                        <label for="radio_gender_male" class="inline-label">MALE</label>
                                                    </span>
                                                <span class="icheck-inline">
                                                        <input type="radio" name="emp_gender" id="radio_gender_female" value="FEMALE" data-md-icheck />
                                                        <label for="radio_gender_female" class="inline-label">FEMALE</label>
                                                    </span>
                                            </div>
                                            <br/>
                                            <h3 class="heading_a">Miscellaneous Information</h3>
                                            <div class="uk-form-row">
                                                <label>Weight</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_weight" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Height</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_height" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Blood Type</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_bloodtype" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3 class="heading_a">Present Address</h3>
                                            <div class="uk-form-row">
                                                <label>Street Address</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_present_street" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Barangay</label>
                                                <select id="select_present_brgy" data-md-selectize name="emp_present_brgy">
                                                    <option value="">Select Barangay</option>
                                                    <!-- <?php
                                                                    foreach($ref_brgy as $brgy){
                                                                        echo '<option value="'.$brgy->brgyDesc.'">'.$brgy->brgyDesc.'</option>';
                                                                    }
                                                                ?> -->
                                                </select>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Town</label>
                                                <select id="select_present_citymun" data-md-selectize name="emp_present_citymun">
                                                    <option value="">Select City/Municipality</option>
                                                    <?php
                                                                    foreach($ref_citymun as $citymun){
                                                                        echo '<option value="'.$citymun->citymunDesc.'">'.$citymun->citymunDesc.'</option>';
                                                                    }
                                                                ?>
                                                </select>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Province</label>
                                                <select id="select_present_province" data-md-selectize name="emp_present_province">
                                                    <option value="">Select Province</option>
                                                    <?php
                                                                    foreach($ref_province as $province){
                                                                        echo '<option value="'.$province->provDesc.'">'.$province->provDesc.'</option>';
                                                                    }
                                                                ?>
                                                </select>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Region</label>
                                                <select id="select_present_region" data-md-selectize name="emp_present_region">
                                                    <option value="">Select Region</option>
                                                    <?php
                                                                    foreach($ref_region as $region){
                                                                        echo '<option value="'.$region->regDesc.'">'.$region->regDesc.'</option>';
                                                                    }
                                                                ?>
                                                </select>
                                            </div>
                                            <br/>
                                            <h3 class="heading_a">Permanent Address</h3>
                                            <div class="uk-form-row">
                                                <label>Street Address</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_permanent_street" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Barangay</label>
                                                <select id="select_permanent_brgy" data-md-selectize name="emp_permanent_brgy">
                                                    <option value="">Select Barangay</option>
                                                    <!-- <?php
                                                                    foreach($ref_brgy as $brgy){
                                                                        echo '<option value="'.$brgy->brgyDesc.'">'.$brgy->brgyDesc.'</option>';
                                                                    }
                                                                ?> -->
                                                </select>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Town</label>
                                                <select id="select_permanent_citymun" data-md-selectize name="emp_permanent_citymun">
                                                    <option value="">Select City/Municipality</option>
                                                    <?php
                                                                    foreach($ref_citymun as $citymun){
                                                                        echo '<option value="'.$citymun->citymunDesc.'">'.$citymun->citymunDesc.'</option>';
                                                                    }
                                                                ?>
                                                </select>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Province</label>
                                                <select id="select_permanent_province" data-md-selectize name="emp_permanent_province">
                                                    <option value="">Select Province</option>
                                                    <?php
                                                                    foreach($ref_province as $province){
                                                                        echo '<option value="'.$province->provDesc.'">'.$province->provDesc.'</option>';
                                                                    }
                                                                ?>
                                                </select>
                                            </div>
                                            <br/>
                                            <div class="uk-form-row">
                                                <label>Region</label>
                                                <select id="select_permanent_region" data-md-selectize name="emp_permanent_region">
                                                    <option value="">Select Region</option>
                                                    <?php
                                                                    foreach($ref_region as $region){
                                                                        echo '<option value="'.$region->regDesc.'">'.$region->regDesc.'</option>';
                                                                    }
                                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <!-- Additional Information -->
                                    <br/>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Contact Details</h3>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Government IDs</h3>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <label for="">Mobile No.(09*********)</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_mobile_no" maxlength="11" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label for="">Telephone No.</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_telephone_no" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Email Address</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_email_address" />
                                            </div>
                                            <div class="uk-form-row">
                                                <div class="md-card">
                                                    <div class="md-card-content">
                                                        <h5 class="heading_a">Note: Provide accurate and legitimate Government ID's<br/>Your contact information will not be shared to anyone without your personal consent.</h5>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <label>CTC No.</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_ctc" maxlength="8" />
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <label>CTC Date</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_ctc_date" data-uk-datepicker="{format:'MM/DD/YYYY'}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <label>PRC</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_prc_license" maxlength="7" />
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <label>PRC Expiration Date</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_prc_expire" data-uk-datepicker="{format:'MM/DD/YYYY'}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>TIN</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_tin_id" minlength="13" maxlength="13" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>SSS</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_sss_id" minlength="10" maxlength="10" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Philhealth</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_phic_id" minlength="12" maxlength="12" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Pag-ibig</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_hdmf_id" minlength="12" maxlength="12" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <!-- EXPERIENCE -->
                                    <br/>
                                    <h3>Employment History(Please Start with the most recent experience)</h3>
                                    <table id="experience_table" class="exp_table uk-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <td>Firm/Office</td>
                                                <td>Position</td>
                                                <td>Start Date</td>
                                                <td>End Date</td>
                                                <td>Reason for Leaving</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="employer[]" placeholder="Firm/Office" />
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="position[]" placeholder="Position" />
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="exp_start_date[]" data-uk-datepicker="{format:'MM/DD/YYYY'}" placeholder="MM/DD/YYYY">
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="exp_end_date[]" data-uk-datepicker="{format:'MM/DD/YYYY'}" placeholder="MM/DD/YYYY">
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="exp_reason[]" placeholder="Reason for Leaving" />
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">
                                                    <button type="button" class="md-btn md-btn-primary md-btn-wave-light md-btn-block" id="addRow_exp" onclick="add_exp_row()" />Add Row</button>
                                                </td>
                                                <td></td>
                                                <td colspan="2" style="text-align: left;">
                                                    <button type="button" class="ibtnDel_exp md-btn md-btn-danger md-btn-wave-light md-btn-block" onclick="rm_exp_row()">Delete Last Row</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </li>
                                <li>
                                    <!-- EDUCATION -->
                                    <br/>
                                    <h3>Education History(Please Start with the highest degree you earned)</h3>
                                    <table id="education_table" class="edu_table uk-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <td>School Attended</td>
                                                <td>Course Pursued</td>
                                                <td>Degree Earned</td>
                                                <td>Year Graduated</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="school[]" placeholder="School Attended" />
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="course[]" placeholder="Course Pursued" />
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="degree[]" placeholder="Degree Earned">
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="yr_grad[]" data-uk-datepicker="{format:'MM/DD/YYYY'}" placeholder="MM/DD/YYYY">
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">
                                                    <button type="button" class="md-btn md-btn-primary md-btn-wave-light md-btn-block" id="addRow_edu" onclick="add_edu_row()" />Add Row</button>
                                                </td>
                                                <td colspan="2" style="text-align: left;">
                                                    <button type="button" class="ibtnDel_edu md-btn md-btn-danger md-btn-wave-light md-btn-block" onclick="rm_edu_row()">Delete Last Row</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </li>
                                <li>
                                    <!-- Family Background -->
                                    <br/>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Father's Background</h3>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Mother's Background</h3>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <label for="">Father's Name:(Lastname ext, Firstname Middlename)</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_father_WName" />
                                            </div>
                                            <div class="uk-form-row">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-2">
                                                        <label for="">Birthdate</label>
                                                        <input class="md-input uk-text-upper" type="text" id="father_birthdate" data-uk-datepicker="{format:'MM/DD/YYYY'}" name="emp_father_birthdate">
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label for="">Occupation</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_father_occupation" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-form-row">
                                                <label for="">Employer</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_father_employer" />
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <label for="">Mother's Maiden Name:(Lastname, Firstname Middlename)</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_mother_WName" />
                                            </div>
                                            <div class="uk-form-row">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-2">
                                                        <label for="">Birthdate</label>
                                                        <input class="md-input uk-text-upper" type="text" id="mother_birthdate" data-uk-datepicker="{format:'MM/DD/YYYY'}" name="emp_mother_birthdate">
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label for="">Occupation</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_mother_occupation" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-form-row">
                                                <label for="">Employer</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_mother_employer" />
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="heading_a">Contact Person in-case of Emergency</h3>
                                    <div class="uk-form-row">
                                        <div class="uk-grid">
                                            <div class="uk-width-medium-1-2">
                                                <label for="">Name(Lastname, Firstname Middlename)</label>
                                                <input class="md-input uk-text-upper" type="text" name="emp_ice_WName">
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <label for="">Relation</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_ice_relation" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="uk-width-medium-1-2">
                                            <label for="">Contact No.</label>
                                            <input class="md-input uk-text-upper" type="text" name="emp_ice_contactno">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <!-- DEPENDENTS -->
                                    <br/>
                                    <h3 class="heading_a">Spouse's Information</h3>
                                    <div class="uk-form-row">
                                        <label for="">Spouse's Name:(Lastname, Firstname Middlename)</label>
                                        <input type="text" class="md-input uk-text-upper" name="emp_spouse_WName" />
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="uk-grid">
                                            <div class="uk-width-medium-1-2">
                                                <label for="">Birthdate</label>
                                                <input class="md-input uk-text-upper" type="text" id="spouse_birthdate" data-uk-datepicker="{format:'MM/DD/YYYY'}" name="emp_spouse_birthdate">
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <label for="">Occupation</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_spouse_occupation" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <label for="">Employer</label>
                                        <input type="text" class="md-input uk-text-upper" name="emp_spouse_employer" />
                                    </div>
                                    <br/>
                                    <h3 class="heading_a">Dependents</h3>
                                    <table id="dependents_table" class="dep_table uk-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <td>Last Name</td>
                                                <td>First Name</td>
                                                <td>Middle Name</td>
                                                <td>Name Extension(if Any)</td>
                                                <td>Birthdate</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="dep_lname[]" placeholder="Last Name" />
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="dep_fname[]" placeholder="First Name" />
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" id="dep_mname[]" placeholder="Middle Name">
                                                </td>
                                                <td>
                                                    <select name="dep_name_ext[]" class="md-input uk-text-upper">
                                                        <option value="">&nbsp;</option>
                                                        <optgroup label="Name Ext">
                                                            <option value="Jr">Jr</option>
                                                            <option value="Sr">Sr</option>
                                                            <option value="II">II</option>
                                                            <option value="III">III</option>
                                                            <option value="IV">IV</option>
                                                            <option value="V">V</option>
                                                        </optgroup>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" id="dep_bdate[]" data-uk-datepicker="{format:'MM/DD/YYYY'}" placeholder="MM/DD/YYYY">
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">
                                                    <button type="button" class="md-btn md-btn-primary md-btn-wave-light md-btn-block" id="addRow_dep" onclick="add_dep_row()" />Add Row</button>
                                                </td>
                                                <td></td>
                                                <td colspan="2" style="text-align: left;">
                                                    <button type="button" class="ibtnDel_dep md-btn md-btn-danger md-btn-wave-light md-btn-block" onclick="rm_dep_row()">Delete Last Row</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </li>
                                <li>
                                    <!-- Service Record -->
                                    <br/>
                                    <h3>Service Record</h3>
                                    <table id="job_info_table" class="jobinfo_table uk-table" cellspacing="0" width="100%">
                                        <thead class="uk-text-center">
                                            <tr>
                                                <td colspan="2">Service(Inclusive Dates)</td>
                                                <td colspan="2">Record of Appointment</td>
                                                <td>Station/Place of</td>
                                            </tr>
                                            <tr>
                                                <td>From</td>
                                                <td>To</td>
                                                <td>Designation</td>
                                                <td>Status</td>
                                                <td>Assignment</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="emp_inclusive_startdate[]" data-uk-datepicker="{format:'MM/DD/YYYY'}" placeholder="MM/DD/YYYY" />
                                                </td>
                                                <td>
                                                    <input class="md-input uk-text-upper" type="text" name="emp_inclusive_enddate[]" data-uk-datepicker="{format:'MM/DD/YYYY'}" placeholder="MM/DD/YYYY" />
                                                </td>
                                                <td>
                                                    <select id="select_job_position" data-md-selectize name="emp_job_position[]">
                                                        <option value="">Select Position</option>
                                                        <?php
                                                                foreach($position as $position){
                                                                    echo '<option value="'.$position->job_name.'">'.$position->job_name.'</option>';
                                                                }
                                                            ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="select_job_status" data-md-selectize name="emp_job_status[]">
                                                        <option value="">Select Status</option>
                                                        <optgroup label="Employment Status">
                                                            <option value="Orientee">Orientee</option>
                                                            <option value="Job Order">Job Order</option>
                                                            <option value="Part Time">Part Time</option>
                                                            <option value="Casual">Casual</option>
                                                            <option value="Contractual">Contractual</option>
                                                            <option value="Probationary">Probationary</option>
                                                            <option value="Regular">Regular</option>
                                                            <option value="Resigned">Resigned</option>
                                                            <option value="Retired">Retired</option>
                                                            <option value="Volunteer">Volunteer</option>
                                                        </optgroup>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="select_job_section" data-md-selectize name="emp_job_section[]">
                                                        <option value="">Select Section</option>
                                                        <?php
                                                                foreach($section as $section){
                                                                    echo '<option value="'.$section->section_name.'">'.$section->section_name.'</option>';
                                                                }
                                                            ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">
                                                    <button type="button" class="md-btn md-btn-primary md-btn-wave-light md-btn-block" id="addRow_edu" onclick="add_job_row()" />Add Row</button>
                                                </td>
                                                <td></td>
                                                <td colspan="2" style="text-align: left;">
                                                    <button type="button" class="ibtnDel_edu md-btn md-btn-danger md-btn-wave-light md-btn-block" onclick="rm_job_row()">Delete Last Row</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>