    <div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_a uk-margin-bottom">Generate Customized Reports</h3>
                <div class="md-card uk-margin-medium-bottom">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon material-icons md-card-fullscreen-activate">fullscreen</i>
                        </div>
                        <h3 class="md-card-toolbar-heading-text">
                                Generate Report
                            </h3>
                    </div>
                    <div class="md-card-content">
                    <form enctype="multipart/form-data" method="POST" action="<?php base_url();?>Generate-Custom-Report">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-large-1-3">
                                <div class="uk-form-row">
                                    <label>Report Title</label>
                                    <input type="text" class="md-input" name="report_title" id="report_title" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="uk-width-large-1-3">
                                <div class="uk-form-row">
                                    <label>Employement Status</label>
                                    <select id="custom_emp_status" data-md-selectize name="report_emp_status" id="report_emp_status">
                                        <option value="All" selected>All</option>
                                            <optgroup label="Employment Status">
                                                <option value="Contractual">Contractual</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Resigned">Resigned</option>
                                                <option value="Retired">Retired</option>
                                            </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-width-large-1-3">
                                <div class="uk-form-row">
                                    <label>Section Assigned</label>
                                    <select id="custom_emp_section" data-md-selectize name="report_emp_section" id="report_emp_section">
                                        <option value="All" selected>All</option>
                                            <optgroup label="Section">
                                                <?php
                                                    foreach($section as $section){
                                                        echo '<option value="'.$section->section_name.'">'.$section->section_name.'</option>';
                                                    }
                                                ?>
                                            </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h4 class="heading_c">Form Fields</h4>
                        <div class="uk-grid" data-uk-grid-margin>
                            <!-- zero row -->
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_mobile_no" id="custom_report_mobile_no" />
                                <label for="custom_report_mobile_no" class="inline-label">Mobile No.</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_telephone_no" id="custom_report_telephone_no" />
                                <label for="custom_report_telephone_no" class="inline-label">Telephone No.</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_email_address" id="custom_report_email_add" />
                                <label for="custom_report_email_add" class="inline-label">Email Address</label>
                            </div>
                            <!-- first row -->
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_birthdate" id="custom_report_birthdate" />
                                <label for="custom_report_birthdate" class="inline-label">Date of Birth</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_TIN" id="custom_report_tin" />
                                <label for="custom_report_tin" class="inline-label">TIN</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_position" id="custom_report_position" />
                                <label for="custom_report_position" class="inline-label">Position</label>
                            </div>
                            <!-- second row -->
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_prese_address" id="custom_report_present_add" />
                                <label for="custom_report_present_add" class="inline-label">Present Address</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_SSS" id="custom_report_sss" />
                                <label for="custom_report_sss" class="inline-label">SSS</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_section" id="custom_report_section" />
                                <label for="custom_report_section" class="inline-label">Section</label>
                            </div>
                            <!-- third row -->
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_perma_address" id="custom_report_permanent_add" />
                                <label for="custom_report_permanent_add" class="inline-label">Permanent Address</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_PhilHealth" id="custom_report_philhealth" />
                                <label for="custom_report_philhealth" class="inline-label">PhilHealth</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_employment_type" id="custom_report_employment_type" />
                                <label for="custom_report_employment_type" class="inline-label">Employment Type</label>
                            </div>
                            <!-- fourth row -->
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_age" id="custom_report_age" disabled />
                                <label for="custom_report_age" class="inline-label">Age</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_PAGIBIG" id="custom_report_pagibig" />
                                <label for="custom_report_pagibig" class="inline-label">Pag-IBIG</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_yrs_of_service" id="custom_report_yrs_of_service" disabled/>
                                <label for="custom_report_yrs_of_service" class="inline-label">Years of Service</label>
                            </div>
                            <!-- fifth row -->
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_sex" id="custom_report_sex" />
                                <label for="custom_report_sex" class="inline-label">Sex</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_CTC" id="custom_report_ctcno_date" />
                                <label for="custom_report_ctcno_date" class="inline-label">CTC No & Date Issued</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_date_hired" id="custom_report_date_hired" disabled/>
                                <label for="custom_report_date_hired" class="inline-label">Date Hired</label>
                            </div>
                            <!-- sixth row -->
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_civilstat" id="custom_report_civil_status" />
                                <label for="custom_report_civil_status" class="inline-label">Civil Status</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_PRC" id="custom_report_licno_date" />
                                <label for="custom_report_licno_date" class="inline-label">License No. & Expiration Date</label>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_date_regular" id="custom_report_date_regular" disabled/>
                                <label for="custom_report_date_hired" class="inline-label">Date Regular</label>
                            </div>
                            <!-- seventh row -->
                            <div class="uk-width-medium-2-3">
                            </div>
                            <div class="uk-width-medium-1-3">
                                <input type="checkbox" name="custom_data[]"data-switchery data-switchery-color="#1e88e5" value="rep_date_resigned" id="custom_report_date_resigned" disabled/>
                                <label for="custom_report_date_hired" class="inline-label">Date Resigned</label>
                            </div>
                        </div>
                        <div class="uk-float-right">
                            <button type="submit" class="md-btn md-btn-primary md-btn-wave-light"> Generate Report</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>