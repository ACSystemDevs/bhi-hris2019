<div id="page_content">
    <div id="page_content_inner">
        <h3 class="heading_b uk-margin-bottom">Employee Attendance Viewer</h3>
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="md-card">
                    <div class="md-card-content">
                        <h3 class="heading_a">Date range</h3>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                    <label for="uk_dp_1">Start date</label>
                                    <input class="md-input" type="text" id="uk_dp_1" data-uk-datepicker="{format:'MM/DD/YYYY'}">
                                </div>
                            </div>
                            <div class="uk-width-medium-1-3 ">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                    <label for="uk_dp_1">End date</label>
                                    <input class="md-input" type="text" id="uk_dp_1" data-uk-datepicker="{format:'MM/DD/YYYY'}">
                                </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <a href="<?php base_url();?>Calculate-Records" class="md-btn md-btn-flat md-btn-flat-primary md-btn-wave" data-uk-tooltip title="CALCULATE"><i class="material-icons">track_changes</i>CALCULATE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>