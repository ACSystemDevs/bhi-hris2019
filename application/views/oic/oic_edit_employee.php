<div id="page_content">
    <div id="page_content_inner">
        <form enctype="multipart/form-data" method="POST" action="<?php echo base_url();?>Update-Employee-Function/<?php echo $profile->PK_employee_code;?>" class="uk-form-stacked" id="user_edit_form">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-12-12">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="height:135px;width:135px;">
                                    <?php
                                        if(empty($profile->emp_picture)){
                                            $user_image = base_url('assets/img/avatars/user.png');
                                        }else{
                                            $user_image = base_url($profile->emp_picture);
                                        }
                                    ?>
                                    <img src="<?php echo $user_image;?>" alt="user avatar" />
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="height:135px;width:135px;"></div>
                                <div class="user_avatar_controls">
                                    <span class="btn-file">
                                            <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                    <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                    <input type="file" name="user_edit_avatar_control" id="user_edit_avatar_control">
                                    </span>
                                    <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $emp_wname;?></span>
                                    <span class="sub-heading">
                                    <?php
                                            if ((is_array(unserialize(base64_decode($profile->record_position))) && count(unserialize(base64_decode($profile->record_position))) > 0 && unserialize(base64_decode($profile->record_position))[0] != '')) {
                                                $pos_count = (count(unserialize(base64_decode($profile->record_position)))) -1;
                                                echo unserialize(base64_decode($profile->record_position))[$pos_count];
                                            }else{
                                                echo 'Unassigned';
                                            }
                                        ?>
                                    </span></h2>
                                <ul class="user_stats">
                                    <li>
                                        <h4 class="heading_a"><?php echo $profile->PK_employee_code;?><span class="sub-heading">ID Number</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a"><?php echo $profile->user_status;?><span class="sub-heading">Status</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a"><?php echo $profile->user_usertype;?><span class="sub-heading">Usertype</span></h4>
                                    </li>
                                </ul>
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
                                        <input type="text" class="md-input uk-text-upper" name="emp_LName" value="<?php echo $profile->emp_LName;?>" />
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label>First Name</label>
                                        <input type="text" class="md-input uk-text-upper" name="emp_FName" value="<?php echo $profile->emp_FName;?>" />
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <label>Middle Name</label>
                                        <input type="text" class="md-input uk-text-upper" name="emp_MName" value="<?php echo $profile->emp_MName;?>" />
                                    </div>
                                    <div class="uk-width-medium-1-4">
                                        <select id="select_name_ext" data-md-selectize name="emp_nameext">
                                            <?php 
                                                if(empty($profile->NameExt)){
                                                    echo '<option value="">Select ...</option>';
                                                }else{
                                                    echo '<option value="'.$profile->emp_NameExt.'">'.$profile->emp_NameExt.'</option>';
                                                }
                                            ?>
                                            <option value="<?php echo $profile->emp_NameExt;?>"><?php echo $profile->emp_NameExt;?></option>
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
                                                <input class="md-input uk-text-upper" type="text" id="basic_birthdate" name="emp_birthdate" data-uk-datepicker="{format:'MM/DD/YYYY'}" value="<?php echo $profile->emp_birthdate;?>">
                                            </div>
                                            <div class="uk-form-row">
                                                <label for="">Birthplace</label>
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-3">
                                                        <label>Town</label>
                                                        <select id="select_bplace_citymun" data-md-selectize name="emp_bplace_citymun">
                                                            <?php 
                                                                if(empty($profile->emp_bplace_town)){
                                                                    echo '<option value="">Select City/Municipality</option>';
                                                                }else{
                                                                    echo '<option value="'.$profile->emp_bplace_town.'">'.$profile->emp_bplace_town.'</option>';
                                                                }
                                                                foreach($ref_citymun as $citymun){
                                                                    echo '<option value="'.$citymun->citymunDesc.'">'.$citymun->citymunDesc.'</option>';
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label>Province</label>
                                                        <select id="select_bplace_province" data-md-selectize name="emp_bplace_province">
                                                            <?php 
                                                                if(empty($profile->emp_bplace_prov)){
                                                                    echo '<option value="">Select Province</option>';
                                                                }else{
                                                                    echo '<option value="'.$profile->emp_bplace_prov.'">'.$profile->emp_bplace_prov.'</option>';
                                                                }
                                                                foreach($ref_province as $province){
                                                                    echo '<option value="'.$province->provDesc.'">'.$province->provDesc.'</option>';
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label>Region</label>
                                                        <select id="select_bplace_region" data-md-selectize name="emp_bplace_region">
                                                            <?php 
                                                                if(empty($profile->emp_bplace_region)){
                                                                    echo '<option value="">Select Region</option>';
                                                                }else{
                                                                    echo '<option value="'.$profile->emp_bplace_region.'">'.$profile->emp_bplace_region.'</option>';
                                                                }
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
                                                <input type="text" class="md-input uk-text-upper" name="emp_religion" value="<?php echo $profile->emp_religion;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Citizenship</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_citizenship" value="<?php echo $profile->emp_citizenship;?>" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Civil Status</label>
                                                <select id="select_civil_status" data-md-selectize name="emp_civilstatus">
                                                    <?php 
                                                        if(empty($profile->emp_civilstatus)){
                                                            echo '<option value="">Select ...</option>';
                                                        }else{
                                                            echo '<option value="'.$profile->emp_civilstatus.'">'.$profile->emp_civilstatus.'</option>';
                                                        }
                                                    ?>
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
                                                <?php 
                                                        if($profile->emp_gender == 'MALE'){
                                                            echo '<span class="icheck-inline">
                                                                        <input type="radio" name="emp_gender" id="radio_gender_male" value="MALE" data-md-icheck checked />
                                                                        <label for="radio_gender_male" class="inline-label">MALE</label>
                                                                    </span>
                                                                <span class="icheck-inline">
                                                                        <input type="radio" name="emp_gender" id="radio_gender_female" value="FEMALE" data-md-icheck />
                                                                        <label for="radio_gender_female" class="inline-label">FEMALE</label>
                                                                    </span>';
                                                        }else{
                                                            echo '<span class="icheck-inline">
                                                                        <input type="radio" name="emp_gender" id="radio_gender_male" value="MALE" data-md-icheck />
                                                                        <label for="radio_gender_male" class="inline-label">MALE</label>
                                                                    </span>
                                                                <span class="icheck-inline">
                                                                        <input type="radio" name="emp_gender" id="radio_gender_female" value="FEMALE" data-md-icheck checked/>
                                                                        <label for="radio_gender_female" class="inline-label">FEMALE</label>
                                                                    </span>';
                                                        }
                                                    ?>
                                            </div>
                                            <br/>
                                            <h3 class="heading_a">Miscellaneous Information</h3>
                                            <div class="uk-form-row">
                                                <label>Weight</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_weight" value="<?php echo $profile->emp_weight;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Height</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_height" value="<?php echo $profile->emp_height;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Blood Type</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_bloodtype" value="<?php echo $profile->emp_bloodtype;?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3 class="heading_a">Present Address</h3>
                                            <div class="uk-form-row">
                                                <label>Street Address</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_present_street" value="<?php echo $profile->emp_prese_street;?>" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Barangay</label>
                                                <select id="select_present_brgy" data-md-selectize name="emp_present_brgy">
                                                    <?php 
                                                        if(empty($profile->emp_prese_brgy)){
                                                            echo '<option value="">Select Barangay</option>';
                                                        }else{
                                                            echo '<option value="'.$profile->emp_prese_brgy.'">'.$profile->emp_prese_brgy.'</option>';
                                                        }
                                                        // foreach($ref_brgy as $brgy){
                                                        //     echo '<option value="'.$brgy->brgyDesc.'">'.$brgy->brgyDesc.'</option>';
                                                        // }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Town</label>
                                                <select id="select_present_citymun" data-md-selectize name="emp_present_citymun">
                                                    <?php 
                                                        if(empty($profile->emp_prese_town)){
                                                            echo '<option value="">Select City/Municipality</option>';
                                                        }else{
                                                            echo '<option value="'.$profile->emp_prese_town.'">'.$profile->emp_prese_town.'</option>';
                                                        }
                                                        foreach($ref_citymun as $citymun){
                                                            echo '<option value="'.$citymun->citymunDesc.'">'.$citymun->citymunDesc.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Province</label>
                                                <select id="select_present_province" data-md-selectize name="emp_present_province">
                                                    <?php 
                                                        if(empty($profile->emp_prese_province)){
                                                            echo '<option value="">Select Province</option>';
                                                        }else{
                                                            echo '<option value="'.$profile->emp_prese_province.'">'.$profile->emp_prese_province.'</option>';
                                                        }
                                                        foreach($ref_province as $province){
                                                            echo '<option value="'.$province->provDesc.'">'.$province->provDesc.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Region</label>
                                                <select id="select_present_region" data-md-selectize name="emp_present_region">
                                                    <?php 
                                                        if(empty($profile->emp_prese_region)){
                                                            echo '<option value="">Select Religion</option>';
                                                        }else{
                                                            echo '<option value="'.$profile->emp_prese_region.'">'.$profile->emp_prese_region.'</option>';
                                                        }
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
                                                <input type="text" class="md-input uk-text-upper" name="emp_permanent_street" value="<?php echo $profile->emp_perma_street;?>" />
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Barangay</label>
                                                <select id="select_permanent_brgy" data-md-selectize name="emp_permanent_brgy">
                                                    <?php 
                                                        if(empty($profile->emp_perma_brgy)){
                                                            echo '<option value="">Select Barangay</option>';
                                                        }else{
                                                            echo '<option value="'.$profile->emp_perma_brgy.'">'.$profile->emp_perma_brgy.'</option>';
                                                        }
                                                        // foreach($ref_brgy as $brgy){
                                                        //     echo '<option value="'.$brgy->brgyDesc.'">'.$brgy->brgyDesc.'</option>';
                                                        // }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Town</label>
                                                <select id="select_permanent_citymun" data-md-selectize name="emp_permanent_citymun">
                                                    <option value="">Select City/Municipality</option>
                                                    <?php 
                                                        if(empty($profile->emp_perma_town)){
                                                            echo '<option value="">Select City/Municipality</option>';
                                                        }else{
                                                            echo '<option value="'.$profile->emp_perma_town.'">'.$profile->emp_perma_town.'</option>';
                                                        }
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
                                                        if(empty($profile->emp_perma_province)){
                                                            echo '<option value="">Select Province</option>';
                                                        }else{
                                                            echo '<option value="'.$profile->emp_perma_province.'">'.$profile->emp_perma_province.'</option>';
                                                        }
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
                                                    <?php 
                                                        if(empty($profile->emp_perma_region)){
                                                            echo '<option value="">Select Religion</option>';
                                                        }else{
                                                            echo '<option value="'.$profile->emp_perma_region.'">'.$profile->emp_perma_region.'</option>';
                                                        }
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
                                                <input type="text" class="md-input uk-text-upper" name="emp_mobile_no" minlength="11" maxlength="11" value="<?php echo $profile->emp_mobno;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <label for="">Telephone No.</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_telephone_no" value="<?php echo $profile->emp_telno;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Email Address</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_email_address" value="<?php echo $profile->emp_email;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <div class="md-card">
                                                    <div class="md-card-content">
                                                        <h5 class="heading_a">Note: </h5>
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
                                                        <input type="text" class="md-input uk-text-upper" name="emp_ctc" minlength="8" maxlength="8" value="<?php echo $profile->CTC_No;?>"/>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <label>CTC Date</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_ctc_date" data-uk-datepicker="{format:'MM/DD/YYYY'}" value="<?php echo $profile->CTC_Date;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <label>PRC</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_prc_license" maxlength="7" value="<?php echo $profile->PRC_License;?>"/>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="uk-form-row">
                                                        <label>PRC Expiration Date</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_prc_expire" data-uk-datepicker="{format:'MM/DD/YYYY'}" value="<?php echo $profile->PRC_Expdate;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-form-row"></div>
                                            <div class="uk-form-row">
                                                <label>TIN</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_tin_id" minlength="13" maxlength="13" value="<?php echo $profile->TIN_ID;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>SSS</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_sss_id" minlength="10" maxlength="10" value="<?php echo $profile->SSS_ID;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Philhealth</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_phic_id" minlength="12" maxlength="12" value="<?php echo $profile->PHIC_ID;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <label>Pag-ibig</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_hdmf_id" minlength="12" maxlength="12" value="<?php echo $profile->HDMF_ID;?>" />
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
                                        <?php
                                            if (is_array(unserialize(base64_decode($profile->experience_firm))) && count(unserialize(base64_decode($profile->experience_firm))) > 0 && unserialize(base64_decode($profile->experience_firm))[0] != '') {
                                                $exp = count(unserialize(base64_decode($profile->experience_firm)));
                                                for ($i = 0; $i < $exp; $i++) {
                                                    echo '<tr>
                                                            <td>
                                                                <input class="md-input uk-text-upper" type="text" name="employer[]" placeholder="Firm/Office" value="'.unserialize(base64_decode($profile->experience_firm))[$i].'"/>
                                                            </td>
                                                            <td>
                                                                <input class="md-input uk-text-upper" type="text" name="position[]" placeholder="Position" value="'.unserialize(base64_decode($profile->experience_position))[$i].'" />
                                                            </td>
                                                            <td>
                                                            <input class="md-input uk-text-upper" type="text" name="exp_start_date[]" data-uk-datepicker='."{format:'MM/DD/YYYY'}".' placeholder="MM/DD/YYYY" value="'.unserialize(base64_decode($profile->experience_sdate))[$i].'">
                                                            </td>
                                                            <td>
                                                            <input class="md-input uk-text-upper" type="text" name="exp_end_date[]" data-uk-datepicker='."{format:'MM/DD/YYYY'}".' placeholder="MM/DD/YYYY" value="'.unserialize(base64_decode($profile->experience_edate))[$i].'">
                                                            </td>
                                                            <td>
                                                                <input class="md-input uk-text-upper" type="text" name="exp_reason[]" placeholder="Reason for Leaving" value="'.unserialize(base64_decode($profile->experience_reason))[$i].'"/>
                                                            </td>
                                                        </tr>';
                                                }
                                            }
                                        ?>
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
                                        <?php
                                        if (is_array(unserialize(base64_decode($profile->education_school))) && count(unserialize(base64_decode($profile->education_school))) > 0 && unserialize(base64_decode($profile->education_school))[0] != '') {
                                            $exp = count(unserialize(base64_decode($profile->education_school)));
                                            for ($i = 0; $i < $exp; $i++) {
                                                echo '<tr>
                                                        <td>
                                                            <input class="md-input uk-text-upper" type="text" name="school[]" placeholder="School Attended" value="'.unserialize(base64_decode($profile->education_school))[$i].'"/>
                                                        </td>
                                                        <td>
                                                            <input class="md-input uk-text-upper" type="text" name="course[]" placeholder="Course Pursued" value="'.unserialize(base64_decode($profile->education_course))[$i].'"/>
                                                        </td>
                                                        <td>
                                                            <input class="md-input uk-text-upper" type="text" name="degree[]" placeholder="Degree Earned" value="'.unserialize(base64_decode($profile->education_degree))[$i].'">
                                                        </td>
                                                        <td>
                                                            <input class="md-input uk-text-upper" type="text" name="yr_grad[]" data-uk-datepicker='."{format:'MM/DD/YYYY'}".' placeholder="MM/DD/YYYY" value="'.unserialize(base64_decode($profile->education_yrlast))[$i].'">
                                                        </td>
                                                    </tr>';
                                            }
                                        }
                                        ?>
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
                                                <input type="text" class="md-input uk-text-upper" name="emp_father_WName" value="<?php echo $profile->emp_father_WName;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-2">
                                                        <label for="">Birthdate</label>
                                                        <input class="md-input uk-text-upper" type="text" id="father_birthdate" data-uk-datepicker="{format:'MM/DD/YYYY'}" name="emp_father_birthdate" value="<?php echo $profile->emp_father_birthdate;?>">
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label for="">Occupation</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_father_occupation" value="<?php echo $profile->emp_father_occupation;?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-form-row">
                                                <label for="">Employer</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_father_employer" value="<?php echo $profile->emp_father_employer;?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <label for="">Mother's Maiden Name:(Lastname, Firstname Middlename)</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_mother_WName" value="<?php echo $profile->emp_mother_WName;?>"/>
                                            </div>
                                            <div class="uk-form-row">
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-2">
                                                        <label for="">Birthdate</label>
                                                        <input class="md-input uk-text-upper" type="text" id="mother_birthdate" data-uk-datepicker="{format:'MM/DD/YYYY'}" name="emp_mother_birthdate" value="<?php echo $profile->emp_mother_birthdate;?>">
                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <label for="">Occupation</label>
                                                        <input type="text" class="md-input uk-text-upper" name="emp_mother_occupation" value="<?php echo $profile->emp_mother_occupation;?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-form-row">
                                                <label for="">Employer</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_mother_employer" value="<?php echo $profile->emp_mother_employer;?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="heading_a">Contact Person in-case of Emergency</h3>
                                    <div class="uk-form-row">
                                        <div class="uk-grid">
                                            <div class="uk-width-medium-1-2">
                                                <label for="">Name(Lastname, Firstname Middlename)</label>
                                                <input class="md-input uk-text-upper" type="text" name="emp_ice_WName" value="<?php echo $profile->emp_ice_name;?>">
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <label for="">Relation</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_ice_relation" value="<?php echo $profile->emp_ice_relation;?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="uk-width-medium-1-2">
                                            <label for="">Contact No.</label>
                                            <input class="md-input uk-text-upper" type="text" name="emp_ice_contactno" value="<?php echo $profile->emp_ice_conno;?>">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <!-- DEPENDENTS -->
                                    <br/>
                                    <h3 class="heading_a">Spouse's Information</h3>
                                    <div class="uk-form-row">
                                        <label for="">Spouse's Name:(Lastname, Firstname Middlename)</label>
                                        <input type="text" class="md-input uk-text-upper" name="emp_spouse_WName" value="<?php echo $profile->emp_spouse_WName;?>"/>
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="uk-grid">
                                            <div class="uk-width-medium-1-2">
                                                <label for="">Birthdate</label>
                                                <input class="md-input uk-text-upper" type="text" id="spouse_birthdate" data-uk-datepicker="{format:'MM/DD/YYYY'}" name="emp_spouse_birthdate" value="<?php echo $profile->emp_spouse_Birthdate;?>">
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                <label for="">Occupation</label>
                                                <input type="text" class="md-input uk-text-upper" name="emp_spouse_occupation" value="<?php echo $profile->emp_spouse_occupation;?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <label for="">Employer</label>
                                        <input type="text" class="md-input uk-text-upper" name="emp_spouse_employer" value="<?php echo $profile->emp_spouse_employer;?>"/>
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
                                        <?php
                                            if (is_array(unserialize(base64_decode($profile->emp_dep_LName))) && count(unserialize(base64_decode($profile->emp_dep_LName))) > 0 && unserialize(base64_decode($profile->emp_dep_LName))[0] != '') {
                                                $exp = count(unserialize(base64_decode($profile->emp_dep_LName)));
                                                for ($i = 0; $i < $exp; $i++) {
                                                    $dep_wname = unserialize(base64_decode($profile->emp_dep_LName))[$i].''.unserialize(base64_decode($profile->emp_dep_FName))[$i].''.unserialize(base64_decode($profile->emp_dep_MName))[$i].''.unserialize(base64_decode($profile->emp_dep_NameExt))[$i];
                                                    echo '<tr>
                                                            <td>
                                                                <input class="md-input uk-text-upper" type="text" name="dep_lname[]" placeholder="Last Name" value="'.unserialize(base64_decode($profile->emp_dep_LName))[$i].'"/>
                                                            </td>
                                                            <td>
                                                                <input class="md-input uk-text-upper" type="text" name="dep_fname[]" placeholder="First Name" value="'.unserialize(base64_decode($profile->emp_dep_FName))[$i].'"/>
                                                            </td>
                                                            <td>
                                                                <input class="md-input uk-text-upper" type="text" id="dep_mname[]" placeholder="Middle Name" value="'.unserialize(base64_decode($profile->emp_dep_MName))[$i].'">
                                                            </td>
                                                            <td>
                                                                <select name="dep_name_ext[]" class="md-input uk-text-upper">
                                                                    <option value="'.unserialize(base64_decode($profile->emp_dep_NameExt))[$i].'">'.unserialize(base64_decode($profile->emp_dep_NameExt))[$i].'/option>
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
                                                                <input class="md-input uk-text-upper" type="text" id="dep_bdate[]" data-uk-datepicker='."{format:'MM/DD/YYYY'}".' placeholder="MM/DD/YYYY" value="'.unserialize(base64_decode($profile->emp_dep_birthdate))[$i].'">
                                                            </td>
                                                        </tr>';
                                                }
                                            }
                                            ?>
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
                                        <?php
                                        if (is_array(unserialize(base64_decode($profile->record_position))) && count(unserialize(base64_decode($profile->record_position))) > 0 && unserialize(base64_decode($profile->record_position))[0] != '') {
                                            $exp = count(unserialize(base64_decode($profile->record_position)));
                                            for ($i = 0; $i < $exp; $i++) {
                                                echo '<tr>
                                                        <td>
                                                            <input class="md-input uk-text-upper" type="text" name="emp_inclusive_startdate[]" data-uk-datepicker="'."{format:'MM/DD/YYYY'}".'" placeholder="MM/DD/YYYY" value="'.unserialize(base64_decode($profile->record_startdate))[$i].'"/>
                                                        </td>
                                                        <td>
                                                        <input class="md-input uk-text-upper" type="text" name="emp_inclusive_startdate[]" data-uk-datepicker="'."{format:'MM/DD/YYYY'}".'" placeholder="MM/DD/YYYY" value="'.unserialize(base64_decode($profile->record_enddate))[$i].'"/>
                                                        </td>
                                                        <td>
                                                            <select id="select_job_position" data-md-selectize name="emp_job_position[]">
                                                                <option value="'.unserialize(base64_decode($profile->record_position))[$i].'">'.unserialize(base64_decode($profile->record_position))[$i].'</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select id="select_job_status" data-md-selectize name="emp_job_status[]">
                                                                <option value="'.unserialize(base64_decode($profile->record_status))[$i].'">'.unserialize(base64_decode($profile->record_status))[$i].'</option>
                                                                <optgroup label="Employment Status">
                                                                    <option value="Trainee">Trainee</option>
                                                                    <option value="Contractual">Contractual</option>
                                                                    <option value="Probationary">Probationary</option>
                                                                    <option value="Regular">Regular</option>
                                                                    <option value="Widowed">Resigned</option>
                                                                    <option value="Retired">Retired</option>
                                                                </optgroup>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select id="select_job_section" data-md-selectize name="emp_job_section[]">
                                                            <option value="'.unserialize(base64_decode($profile->record_section))[$i].'">'.unserialize(base64_decode($profile->record_section))[$i].'</option>
                                                            </select>
                                                        </td>
                                                    </tr>';
                                                    }
                                        }
                                        ?>
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