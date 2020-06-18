<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">Employee Directory</h3>
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <div class="uk-vertical-align">
                    <div class="uk-vertical-align-middle">
                        <ul id="contact_list_filter" class="uk-subnav uk-subnav-pill uk-margin-remove">
                            <li class="uk-active" data-uk-filter=""><a href="#">All</a></li>
                            <?php
                                            foreach($section as $sec){
                                                echo '<li data-uk-filter="'.$sec->section_name.'"><a href="#">'.$sec->section_name.'</a></li>';
                                            }
                                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-5 hierarchical_show" id="contact_list">
            <?php
                foreach($masterlist as $master){
                    $emp_wname = $master->emp_LName.' ' .$master->emp_NameExt.', '.$master->emp_FName;
                            if ((is_array(unserialize(base64_decode($master->record_position))) && count(unserialize(base64_decode($master->record_position))) > 0 && unserialize(base64_decode($master->record_position))[0] != '') && (is_array(unserialize(base64_decode($master->record_section))) && count(unserialize(base64_decode($master->record_section))) > 0 && unserialize(base64_decode($master->record_section))[0] != '')) {
                                $pos_count = (count(unserialize(base64_decode($master->record_position)))) -1;
                                $sec_count = (count(unserialize(base64_decode($master->record_section)))) - 1;
                                $position = unserialize(base64_decode($master->record_position))[$pos_count];
                                $section = unserialize(base64_decode($master->record_section))[$sec_count];
                            }else{
                                $position = 'Unassigned';
                                $section = 'Unassigned';
                            }
                    echo '<div data-uk-filter="'.$section.'">
                            <div class="md-card md-card-hover">
                                <div class="md-card-head">
                                    <div class="uk-text-center">
                                        <img class="md-card-head-avatar" src="'.base_url($master->emp_picture).'" alt="'.$emp_wname.'"/>
                                    </div>
                                    <h3 class="md-card-head-text uk-text-center">
                                        '.$emp_wname.'                                
                                        <span class="uk-text-truncate">'.$position.'</span>
                                    </h3>
                                </div>
                                <div class="md-card-content">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Section</span>
                                                <span class="uk-text-small uk-text-muted">'.$section.'</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Email</span>
                                                <span class="uk-text-small uk-text-muted uk-text-truncate"><a href="#">'.$master->emp_email.'</a></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Phone</span>
                                                <span class="uk-text-small uk-text-muted">'.$master->emp_mobno.'</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>';
                }
                ?>

        </div>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-accent" href="<?php base_url();?>Add-Employee-HRPO" data-uk-tooltip title="ADD EMPLOYEE">
            <i class="material-icons">person_add</i>
        </a>
    </div>