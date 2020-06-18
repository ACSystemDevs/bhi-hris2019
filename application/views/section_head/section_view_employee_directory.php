<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">Employee Directory</h3>

        <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3 hierarchical_show" id="contact_list">
            <?php
                $count = count($masterlist)-1;
                for($i=0;$i<=$count;$i++){
                    echo '<div data-uk-filter="'.$masterlist[$i]['section'].'">
                            <div class="md-card md-card-hover">
                                <div class="md-card-head">
                                    <div class="uk-text-center">
                                        <img class="md-card-head-avatar" src="'.base_url($masterlist[$i]['picture']).'" alt="'.$masterlist[$i]['emp_wname'].'"/>
                                    </div>
                                    <h3 class="md-card-head-text uk-text-center">
                                        '.$masterlist[$i]['emp_wname'].'                                
                                        <span class="uk-text-truncate">'.$masterlist[$i]['position'].'</span>
                                    </h3>
                                </div>
                                <div class="md-card-content">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Email</span>
                                                <span class="uk-text-small uk-text-muted uk-text-truncate"><a href="#">'.$masterlist[$i]['mobile_no'].'</a></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Phone</span>
                                                <span class="uk-text-small uk-text-muted">'.$masterlist[$i]['email'].'</span>
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