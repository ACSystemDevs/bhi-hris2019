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
                                    <h4 class="heading_a"><i class="material-icons">contact_mail</i><?php echo strtolower($profile->emp_email);?></h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="user_content">
                        <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                            <li class="uk-active"><a href="#">Personal Information</a></li>
                            <li><a href="#">Daily Time Record</a></li>
                            <li><a href="#">Service Record</a></li>
                            <li><a href="#">Documents</a></li>
                            <li><a href="#">Leave</a></li>
                        </ul>
                        <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                            <li>
                                <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Personal Details</h4>
                                <ul class="md-list">
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        if((empty($profile->emp_prese_brgy)) && (empty($profile->emp_prese_town)) && (empty($profile->emp_prese_province)) && (empty($profile->emp_prese_region))){
                                                                            $present_address = '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            $present_address = $profile->emp_prese_street.'&nbsp;'.$profile->emp_prese_brgy.'&nbsp;'.$profile->emp_prese_town.'&nbsp;'.$profile->emp_prese_province;
                                                                        }
                                                                        echo $present_address;
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Present Address</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                <?php 
                                                                    if((empty($profile->emp_perma_brgy)) && (empty($profile->emp_perma_town)) && (empty($profile->emp_perma_province)) && (empty($profile->emp_perma_region))){
                                                                        $permanent_address = '<span class="uk-text-danger">No Data Found</span>';
                                                                    }else{
                                                                        $permanent_address = $profile->emp_perma_street.'&nbsp;'.$profile->emp_perma_brgy.'&nbsp;'.$profile->emp_perma_town.'&nbsp;'.$profile->emp_perma_province;
                                                                    }
                                                                    echo $permanent_address;
                                                                ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Permanent Address</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        echo date('F d, Y',strtotime($profile->emp_birthdate));
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Birthdate</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                <?php
                                                                $birthday           = date('Y-m-d',strtotime($profile->emp_birthdate));
                                                                $today              = date('Y-m-d');
                                                                list($y1, $m1, $d1) = explode('-', $birthday);
                                                                list($y2, $m2, $d2) = explode('-', $today);
                                                                $m1                 = $m2 - $m1;

                                                                if ($m1 < 0 || ($m1 == 0 && $d2 - $d1 < 0))
                                                                {
                                                                    $y1++;
                                                                }

                                                                $age = $y2 - $y1;
                                                                $age = floor((time() - strtotime($birthday)) / 31556926);
                                                                $datetime = date_diff(date_create(), date_create($birthday));
                                                                $age      = $datetime->format('%Y years, %m months Old');
                                                                echo $age;
                                                                ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Age</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">
                                                            <?php
                                                                if((empty($profile->emp_bplace_town)) && empty($profile->emp_bplace_prov)){
                                                                    $birthplace = '<span class="uk-text-danger">No Data Found</span>';
                                                                }else{
                                                                    $birthplace = $profile->emp_bplace_town.',&nbsp;'.$profile->emp_bplace_prov;
                                                                }
                                                                echo $birthplace;
                                                            ?>
                                                        </span>
                                            <span class="uk-text-small uk-text-muted">Birthplace</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        echo $profile->emp_gender;
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Sex</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        if(empty($profile->emp_bloodtype)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_bloodtype;
                                                                        }
                                                                        
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Blood Type</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_religion)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_religion;
                                                                        }
                                                                       
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Religion</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        if(empty($profile->emp_citizenship)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_citizenship;
                                                                        }
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Citizenship</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        if(empty($profile->emp_height)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_height;
                                                                        }
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Height</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        if(empty($profile->emp_weight)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_weight;
                                                                        }
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Weight</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <hr/>
                                <!-- END OF PERSONAL DETAILS -->
                                <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Government IDs</h4>
                                <ul class="md-list">
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->CTC_No)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->CTC_No;
                                                                        }
                                                                    ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Community Tax Certificate No.</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->CTC_No)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo date('F d, Y',strtotime($profile->CTC_Date));
                                                                        }
                                                                    ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Date Issued</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php echo preg_replace("/^1?(\d{2})(\d{7})(\d{1})$/", "$1-$2-$3", $profile->SSS_ID);?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Social Security Number</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php echo preg_replace("/^1?(\d{3})(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3-$4", $profile->TIN_ID);?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Tax Identification Number</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php echo preg_replace("/^1?(\d{4})(\d{4})(\d{4})$/", "$1-$2-$3", $profile->PHIC_ID);?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">PhilHealth ID</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                            <?php echo preg_replace("/^1?(\d{4})(\d{4})(\d{4})$/", "$1-$2-$3", $profile->HDMF_ID);?>
                                                        </span>
                                                    <span class="uk-text-small uk-text-muted">Pag-IBIG Membership ID</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->PRC_License)){
                                                                            echo 'Not Applicable';
                                                                        }else{
                                                                            echo $profile->PRC_License;
                                                                        }
                                                                    ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Professional License</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->PRC_License)){
                                                                            echo 'Not Applicable';
                                                                        }else{
                                                                            echo date('F d, Y',strtotime($profile->PRC_License));
                                                                        }
                                                                    ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Expiration Date</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <hr/>
                                <!-- END OF Government IDs -->
                                <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Family Background</h4>
                                <ul class="md-list">
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_father_WName)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_father_WName;
                                                                        }
                                                                    ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Father's Name</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_mother_WName)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_mother_WName;
                                                                        }
                                                                    ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Mother's Maiden Name</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-large-1-2">
                                                            <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_father_birthdate)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo date('F d, Y',strtotime($profile->emp_father_birthdate));
                                                                        }
                                                                    ?>
                                                                </span>
                                                            <span class="uk-text-small uk-text-muted">Birthdate</span>
                                                        </div>
                                                        <div class="uk-width-large-1-2">
                                                            <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_father_birthdate)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            $birthday           = date('Y-m-d',strtotime($profile->emp_father_birthdate));
                                                                            $today              = date('Y-m-d');
                                                                            list($y1, $m1, $d1) = explode('-', $birthday);
                                                                            list($y2, $m2, $d2) = explode('-', $today);
                                                                            $m1                 = $m2 - $m1;

                                                                            if ($m1 < 0 || ($m1 == 0 && $d2 - $d1 < 0))
                                                                            {
                                                                                $y1++;
                                                                            }

                                                                            $age = $y2 - $y1;
                                                                            $age = floor((time() - strtotime($birthday)) / 31556926);
                                                                            $datetime = date_diff(date_create(), date_create($birthday));
                                                                            $age      = $datetime->format('%Y years, %m months Old');
                                                                            echo $age;
                                                                        }
                                                                    ?>
                                                                </span>
                                                            <span class="uk-text-small uk-text-muted">Age</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-large-1-2">
                                                            <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_mother_birthdate)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo date('F d, Y',strtotime($profile->emp_mother_birthdate));
                                                                        }
                                                                    ?>
                                                                </span>
                                                            <span class="uk-text-small uk-text-muted">Birthdate</span>
                                                        </div>
                                                        <div class="uk-width-large-1-2">
                                                            <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_mother_birthdate)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            $birthday           = date('Y-m-d',strtotime($profile->emp_mother_birthdate));
                                                                            $today              = date('Y-m-d');
                                                                            list($y1, $m1, $d1) = explode('-', $birthday);
                                                                            list($y2, $m2, $d2) = explode('-', $today);
                                                                            $m1                 = $m2 - $m1;

                                                                            if ($m1 < 0 || ($m1 == 0 && $d2 - $d1 < 0))
                                                                            {
                                                                                $y1++;
                                                                            }

                                                                            $age = $y2 - $y1;
                                                                            $age = floor((time() - strtotime($birthday)) / 31556926);
                                                                            $datetime = date_diff(date_create(), date_create($birthday));
                                                                            $age      = $datetime->format('%Y years, %m months Old');
                                                                            echo $age;
                                                                        }
                                                                    ?>
                                                                </span>
                                                            <span class="uk-text-small uk-text-muted">Age</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_father_occupation)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_father_occupation;
                                                                        }
                                                                    ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Occupation</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_mother_occupation)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_mother_occupation;
                                                                        }
                                                                    ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Occupation</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_father_employer)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_father_employer;
                                                                        }
                                                                    ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Employer</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                        if(empty($profile->emp_mother_employer)){
                                                                            echo '<span class="uk-text-danger">No Data Found</span>';
                                                                        }else{
                                                                            echo $profile->emp_mother_employer;
                                                                        }
                                                                    ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Employer</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <hr/>
                                <!-- END OF Family -->
                                <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Work Experience</h4>
                                <div class="uk-overflow-container">
                                    <table class="uk-table uk-table-hover">
                                        <thead>
                                            <tr>
                                                <td>Firm/Office</td>
                                                <td>Position</td>
                                                <td>Start Date</td>
                                                <td>End Date</td>
                                                <td>Reason for Leaving</td>
                                            </tr>
                                        </thead>
                                        <tbody class="uk-text-upper">
                                            <?php 
                                                                if (is_array(unserialize(base64_decode($profile->experience_firm))) && count(unserialize(base64_decode($profile->experience_firm))) > 0 && unserialize(base64_decode($profile->experience_firm))[0] != '') {
                                                                    $exp = count(unserialize(base64_decode($profile->experience_firm)));
                                                                    for ($i = 0; $i < $exp; $i++) {
                                                                        echo '<tr>
                                                                                <td>
                                                                                    '.unserialize(base64_decode($profile->experience_firm))[$i].'
                                                                                </td>
                                                                                <td>
                                                                                    '.unserialize(base64_decode($profile->experience_position))[$i].'
                                                                                </td>
                                                                                <td>
                                                                                    '.date('F d, Y',strtotime(unserialize(base64_decode($profile->experience_sdate))[$i])).'
                                                                                </td>
                                                                                <td>
                                                                                '   .date('F d, Y',strtotime(unserialize(base64_decode($profile->experience_edate))[$i])).'
                                                                                </td>
                                                                                <td>
                                                                                    '.unserialize(base64_decode($profile->experience_reason))[$i].'
                                                                                </td>
                                                                            </tr>';
                                                                    }
                                                                }else{
                                                                    echo '<tr><td colspan="5"><span class="uk-text-danger">No Data Found</span></td></tr>';
                                                                }
                                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr/>
                                <!-- END OF Work Experience -->
                                <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Education</h4>
                                <div class="uk-overflow-container">
                                    <table class="uk-table uk-table-hover">
                                        <thead>
                                            <tr>
                                                <td>School Attended</td>
                                                <td>Course Pursued</td>
                                                <td>Degree Earned</td>
                                                <td>Year Graduated</td>
                                            </tr>
                                        </thead>
                                        <tbody class="uk-text-upper">
                                            <?php 
                                                                if (is_array(unserialize(base64_decode($profile->education_school))) && count(unserialize(base64_decode($profile->education_school))) > 0 && unserialize(base64_decode($profile->education_school))[0] != '') {
                                                                    $exp = count(unserialize(base64_decode($profile->education_school)));
                                                                    for ($i = 0; $i < $exp; $i++) {
                                                                        echo '<tr>
                                                                                <td>
                                                                                    '.unserialize(base64_decode($profile->education_school))[$i].'
                                                                                </td>
                                                                                <td>
                                                                                    '.unserialize(base64_decode($profile->education_course))[$i].'
                                                                                </td>
                                                                                <td>
                                                                                    '.unserialize(base64_decode($profile->education_degree))[$i].'
                                                                                </td>
                                                                                <td>
                                                                                '   .date('F d, Y',strtotime(unserialize(base64_decode($profile->education_yrlast))[$i])).'
                                                                                </td>
                                                                            </tr>';
                                                                    }
                                                                }else{
                                                                    echo '<tr><td colspan="4"><span class="uk-text-danger">No Data Found</span></td></tr>';
                                                                }
                                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END OF Education -->
                                <hr/>
                                <!-- THIS DIV WILL DISPLAY IF CIVILSTATUS IS MARRIED -->
                                <div id="spouse_div" <?php if($profile->emp_civilstatus == 'Married'){echo 'style="display:block;"';}else{echo 'style="display:none;"';}?>>
                                    <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Spouse</h4>
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">
                                                                    <?php
                                                                        echo $profile->emp_spouse_WName;
                                                                    ?>
                                                                    </span>
                                                <span class="uk-text-small uk-text-muted">Spouse's Name</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-large-1-2">
                                                        <span class="md-list-heading">
                                                                        <?php 
                                                                            echo date('F d, Y',strtotime($profile->emp_spouse_Birthdate));
                                                                        ?>
                                                                    </span>
                                                        <span class="uk-text-small uk-text-muted">Birthdate</span>
                                                    </div>
                                                    <div class="uk-width-large-1-2">
                                                        <span class="md-list-heading">
                                                                    <?php
                                                                    $now = date('Y-m-d');
                                                                    $start_date = date('Y-m-d',strtotime($profile->emp_spouse_Birthdate));
                                                                    $diff = abs(strtotime($start_date) - strtotime($now));
                                                                    $years = floor($diff / (365*60*60*24));
                                                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                                    printf("%d years, %d months  Old", $years, $months, $days);
                                                                    $_age = floor((time() - strtotime($profile->emp_birthdate)) / 31556926);
                                                                    // echo $_age.'&nbsp;years old';
                                                                    ?>
                                                                    </span>
                                                        <span class="uk-text-small uk-text-muted">Age</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-large-1-2">
                                                        <span class="md-list-heading">
                                                                        <?php 
                                                                            echo $profile->emp_spouse_occupation;
                                                                        ?>
                                                                    </span>
                                                        <span class="uk-text-small uk-text-muted">Occupation</span>
                                                    </div>
                                                    <div class="uk-width-large-1-2">
                                                        <span class="md-list-heading">
                                                                    <?php
                                                                        echo $profile->emp_spouse_employer;
                                                                    ?>
                                                                    </span>
                                                        <span class="uk-text-small uk-text-muted">Employer</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Dependents</h4>
                                <div class="uk-overflow-container">
                                    <table id="dependents_table" class="dep_table uk-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <td>Name</td>
                                                <td>Birthdate</td>
                                            </tr>
                                        </thead>
                                        <tbody class="uk-text-upper">
                                            <?php 
                                                                if (is_array(unserialize(base64_decode($profile->emp_dep_LName))) && count(unserialize(base64_decode($profile->emp_dep_LName))) > 0 && unserialize(base64_decode($profile->emp_dep_LName))[0] != '') {
                                                                    $exp = count(unserialize(base64_decode($profile->emp_dep_LName)));
                                                                    for ($i = 0; $i < $exp; $i++) {
                                                                        $dep_wname = unserialize(base64_decode($profile->emp_dep_LName))[$i].''.unserialize(base64_decode($profile->emp_dep_FName))[$i].''.unserialize(base64_decode($profile->emp_dep_MName))[$i].''.unserialize(base64_decode($profile->emp_dep_NameExt))[$i];
                                                                        echo '<tr>
                                                                                <td>
                                                                                    '.$dep_wname.'
                                                                                </td>
                                                                                <td>
                                                                                    '.date('F d, Y',strtotime(unserialize(base64_decode($profile->emp_dep_birthdate))[$i])).'
                                                                                </td>
                                                                            </tr>';
                                                                    }
                                                                }else{
                                                                    echo '<tr><td colspan="2"><span class="uk-text-danger">No Data Found</span></td></tr>';
                                                                }
                                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END OF PROFILE -->
                            </li>
                            <li>
                                <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom">Daily Time Record - <?php echo date('F Y');?></h4>
                                    <div class="md-card uk-margin-medium-bottom">
                                        <div class="md-card-content">
                                        <ul id="user_dtr_tabs" class="uk-tab" data-uk-tab="{connect:'#user_dtr_tabs_contents', animation:'slide-horizontal'}">
                                            <li class="uk-active"><a href="#">Current Month</a></li>
                                            <li><a href="#">Past Month</a></li>
                                        </ul>
                                        <ul id="user_dtr_tabs_contents" class="uk-switcher uk-margin">
                                            <li>
                                                <div class="uk-overflow-container">
                                                    <table class="uk-table uk-table-condensed uk-table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>IN</th>
                                                                <th>OUT</th>
                                                                <th>IN</th>
                                                                <th>OUT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $rows = count($att_log);
                                                            for ($i = 0; $i < $rows; $i++) {
                                                                $time_miscs = "";
                                                                if ((($att_log[$i]["Att_TimeIn"]) == 'OFF') && (($att_log[$i]["Att_TimeOut"]) == 'OFF')) {
                                                                    $time_in  = "";
                                                                    $time_out = "";
                                                                } else {
                                                                    $time_in = date('h:i:sA', strtotime($att_log[$i]['Att_TimeIn']));
                                                                    if (empty($att_log[$i]['Att_TimeOut'])) {
                                                                        $time_out = null;
                                                                    } else {
                                                                        $time_out = date('h:i:sA', strtotime($att_log[$i]['Att_TimeOut']));
                                                                    }
                                                                    if ($att_log[$i]['Att_TimeMisc']) {
                                                                        $time_miscs = date('h:i:sA', strtotime($att_log[$i]['Att_TimeMisc']));
                                                                    }
                                                                }
                                                                echo '<tr>
                                                                    <td>' . date('F d,Y (l)', strtotime($att_log[$i]['Att_Date'])) . '</td>
                                                                    <td>' . $time_in . '</td>
                                                                    <td>' . $time_out . '</td>
                                                                    <td>' . $time_miscs . '</td>
                                                                    <td></td>
                                                                </tr>';
                                                            }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="uk-overflow-container">
                                                    <table class="uk-table uk-table-condensed uk-table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>IN</th>
                                                                <th>OUT</th>
                                                                <th>IN</th>
                                                                <th>OUT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $rows = count($past_att_log);
                                                            for ($i = 0; $i < $rows; $i++) {
                                                                $time_miscs = "";
                                                                if ((($past_att_log[$i]["Att_TimeIn"]) == 'OFF') && (($past_att_log[$i]["Att_TimeOut"]) == 'OFF')) {
                                                                    $time_in  = "";
                                                                    $time_out = "";
                                                                } else {
                                                                    $time_in = date('h:i:sA', strtotime($past_att_log[$i]['Att_TimeIn']));
                                                                    if (empty($past_att_log[$i]['Att_TimeOut'])) {
                                                                        $time_out = null;
                                                                    } else {
                                                                        $time_out = date('h:i:sA', strtotime($past_att_log[$i]['Att_TimeOut']));
                                                                    }
                                                                    if ($past_att_log[$i]['Att_TimeMisc']) {
                                                                        $time_miscs = date('h:i:sA', strtotime($past_att_log[$i]['Att_TimeMisc']));
                                                                    }
                                                                }
                                                                echo '<tr>
                                                                    <td>' . date('F d,Y (l)', strtotime($past_att_log[$i]['Att_Date'])) . '</td>
                                                                    <td>' . $time_in . '</td>
                                                                    <td>' . $time_out . '</td>
                                                                    <td>' . $time_miscs . '</td>
                                                                    <td></td>
                                                                </tr>';
                                                            }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </li>
                                        </ul>  
                                    </div>
                                </div>
                            </li>
                            <li>
                                <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Job Information</h4>
                                <ul class="md-list">
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php
                                                                    if ((is_array(unserialize(base64_decode($profile->record_position))) && count(unserialize(base64_decode($profile->record_position))) > 0 && unserialize(base64_decode($profile->record_position))[0] != '')) {
                                                                        $pos_count = (count(unserialize(base64_decode($profile->record_position)))) -1;
                                                                        echo unserialize(base64_decode($profile->record_position))[$pos_count];
                                                                    }else{
                                                                        echo 'Unassigned';
                                                                    }
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Job Title</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        if ((is_array(unserialize(base64_decode($profile->record_section))) && count(unserialize(base64_decode($profile->record_section))) > 0 && unserialize(base64_decode($profile->record_section))[0] != '')) {
                                                                            $sec_count = (count(unserialize(base64_decode($profile->record_section)))) -1;
                                                                            echo unserialize(base64_decode($profile->record_section))[$sec_count];
                                                                        }else{
                                                                            echo 'Unassigned';
                                                                        }
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Section</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        if ((is_array(unserialize(base64_decode($profile->record_startdate))) && count(unserialize(base64_decode($profile->record_startdate))) > 0 && unserialize(base64_decode($profile->record_startdate))[0] != '')) {
                                                                            echo date('F d, Y',strtotime(unserialize(base64_decode($profile->record_startdate))[0]));
                                                                        }else{
                                                                            echo 'Not Applicable';
                                                                        }
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Date of Hire</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                <?php
                                                                    if ((is_array(unserialize(base64_decode($profile->record_startdate))) && count(unserialize(base64_decode($profile->record_startdate))) > 0 && unserialize(base64_decode($profile->record_startdate))[0] != '')) {
                                                                        // $years_service = floor((time() - strtotime(unserialize(base64_decode($profile->record_startdate))[0])) / 31556926);
                                                                        if((is_array(unserialize(base64_decode($profile->record_status))) && count(unserialize(base64_decode($profile->record_status))) > 0 && unserialize(base64_decode($profile->record_status))[0] != '')) {
                                                                            $rec_count = (count(unserialize(base64_decode($profile->record_status)))) -1;
                                                                            $status =  unserialize(base64_decode($profile->record_status))[$rec_count];
                                                                        }

                                                                        if($status == 'Resigned'){
                                                                            $end_date_count = (count(unserialize(base64_decode($profile->record_enddate)))) -1;
                                                                            $end_date = date('Y-m-d',strtotime(unserialize(base64_decode($profile->record_enddate))[$end_date_count]));
                                                                        }else{
                                                                            $end_date = date('Y-m-d');
                                                                        }

                                                                        $start_date = date('Y-m-d',strtotime(unserialize(base64_decode($profile->record_startdate))[0]));
                                                                        $diff = abs(strtotime($start_date) - strtotime($end_date));
                                                                        $years = floor($diff / (365*60*60*24));
                                                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                                        printf("%d years, %d months  of Service", $years, $months);
                                                                    }else{
                                                                        echo 'Undetermined';
                                                                    }
                                                                ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Years of Service</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        echo $profile->user_status;
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Employee Status</span>
                                                </div>
                                                <div class="uk-width-large-1-2">
                                                    <span class="md-list-heading">
                                                                    <?php 
                                                                        if ((is_array(unserialize(base64_decode($profile->record_status))) && count(unserialize(base64_decode($profile->record_status))) > 0 && unserialize(base64_decode($profile->record_status))[0] != '')) {
                                                                            $rec_count = (count(unserialize(base64_decode($profile->record_status)))) -1;
                                                                            echo unserialize(base64_decode($profile->record_status))[$rec_count];
                                                                        }else{
                                                                            echo 'Undetermined';
                                                                        }
                                                                     ?>
                                                                </span>
                                                    <span class="uk-text-small uk-text-muted">Employee Type</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <hr/>
                                <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Service Record</h4>
                                <div class="uk-overflow-container">
                                    <table class="uk-table uk-table-hover uk-text-center">
                                        <thead>
                                            <tr>
                                                <td colspan="2">Service(Inclusive Dates)</td>
                                                <td colspan="2">Record of Appointment</td>
                                                <td rowspan="2" style="vertical-align:middle;">Station/Place of Assignment</td>
                                            </tr>
                                            <tr>
                                                <td>From</td>
                                                <td>To</td>
                                                <td>Designation</td>
                                                <td>Status</td>
                                            </tr>
                                        </thead>
                                        <tbody class="uk-text-upper">
                                            <?php 
                                                        if (is_array(unserialize(base64_decode($profile->record_position))) && count(unserialize(base64_decode($profile->record_position))) > 0 && unserialize(base64_decode($profile->record_position))[0] != '') {
                                                            $exp = count(unserialize(base64_decode($profile->record_position)));
                                                            for ($i = 0; $i < $exp; $i++) {
                                                                if(empty(unserialize(base64_decode($profile->record_enddate))[$i])){
                                                                    $enddate = 'PRESENT';
                                                                }else{
                                                                    $enddate = date('F d, Y',strtotime(unserialize(base64_decode($profile->record_enddate))[$i]));
                                                                }
                                                                echo '<tr>
                                                                        <td>
                                                                            '.date('F d, Y',strtotime(unserialize(base64_decode($profile->record_startdate))[$i])).'
                                                                        </td>
                                                                        <td>
                                                                            '.$enddate.'
                                                                        </td>
                                                                        <td>
                                                                            '.unserialize(base64_decode($profile->record_position))[$i].'
                                                                        </td>
                                                                        <td>
                                                                            '.unserialize(base64_decode($profile->record_status))[$i].'
                                                                        </td>
                                                                        <td>
                                                                            '.unserialize(base64_decode($profile->record_section))[$i].'
                                                                        </td>
                                                                    </tr>';
                                                                    }
                                                        }else{
                                                            echo '<tr><td colspan="5"><span class="uk-text-danger">No Data Found</span></td></tr>';
                                                        }
                                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li>
                            <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">201 Files</h4>
                            <div class="uk-form-row"><span class="uk-text-bold">Employee's Files</span></div>
                                            <div class="uk-overflow-container">
                                                <table class="uk-table uk-table-hover" id="dt_approved">
                                                    <thead>
                                                        <tr>
                                                            <th>Date Uploaded</th>
                                                            <th>File Title</th>
                                                            <th>File Name</th>
                                                            <th class="uk-text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if(empty($files)){
                                                            echo '<tr><td colspan="4" class="uk-text-danger">NO DATA FOUND</td></tr>';
                                                        }
                                                            foreach($emp_files as $files){
                                                                $last_three = substr($files->File_name, -3);
                                                                
                                                                if($last_three == 'pdf'){
                                                                    $view_button = '<button type="button" class="md-btn md-btn-warning md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW FILE" onclick="uploaded_file_view_pdf(' . "'" . $files->PK_emp_201files_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">visibility</i></button>';
                                                                }elseif($last_three == 'png' || $last_three == 'jpg' || $last_three == 'jpeg'){
                                                                    $view_button = '<button type="button" class="md-btn md-btn-warning md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW FILE" onclick="uploaded_file_view_img(' . "'" . $files->PK_emp_201files_ID . "'" . ')"><i class="material-icons md-color-grey-50 md-24">visibility</i></button>';
                                                                }else{
                                                                    $view_button = '<a href="'.base_url().$files->File_path.'" target="_blank" class="md-btn md-btn-warning md-btn-wave-light md-btn-small" data-uk-tooltip title="VIEW FILE"><i class="material-icons md-color-grey-50 md-24">visibility</i></a>';
                                                                }
                                                                echo '<tr>
                                                                        <td>'.date('F d, Y',strtotime($files->Date_added)).'</td>
                                                                        <td>'.$files->File_title.'</td>
                                                                        <td>'.$files->File_name.'</td>
                                                                        <td class="uk-text-center">'.$view_button.'
                                                                            <button type="button" class="md-btn md-btn-primary md-btn-wave-light md-btn-small" data-uk-tooltip title="DOWNLOAD FILE"><i class="material-icons md-color-grey-50 md-24">cloud_download</i></button>
                                                                        </td>
                                                                    </tr>';
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                             <!-- MODAL FOR IMAGE -->
                             <div class="uk-modal" id="view_uploaded_file_image">
                                <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                    <button type="button" class="uk-modal-close uk-close uk-close-alt"></button>
                                    <img src="assets/img/gallery/Image01.jpg" alt="" id="uploaded_file_img"/>
                                    <div class="uk-modal-caption" id="uploaded_short_desc" style="background-color:#000;opacity:0.6;"></div>
                                </div>
                            </div>
                        <!-- MODAL FOR PDF -->
                            <div class="uk-modal" id="view_uploaded_file_pdf">
                                <div class="uk-modal-dialog uk-modal-dialog-lightbox uk-modal-dialog-large" style="height:100%;" width="500px">
                                    <button type="button" class="uk-modal-close uk-close uk-close-alt"></button>
                                    <iframe id="uploaded_file_pdf" src="" width="100%" height="100%" frameborder="0" uk-video></iframe>
                                    
                                </div>
                            </div>
                            </li>
                            <li>
                            <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Leave Credit for <?php echo date('Y');?></h4>
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
                            <h4 class="full_width_in_card heading_a uk-text-bold uk-margin-small-bottom ">Leave History</h4>
                                <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date Filed</th>
                                            <th>Inclusive Dates</th>
                                            <th>Leave Type</th>
                                            <th>No of Days</th>
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
                                            <th>No of Days</th>
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
                                                    <td>'.$history->Leave_no_days.'</td>
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