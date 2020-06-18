<div id="page_content">
    <div id="page_content_inner">

        <!-- statistics (small charts) -->
        <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_visitors peity_data">5,10,2,15,7</span></div>
                        <span class="uk-text-muted uk-text-small">New Employees (<?php echo date('F')?>)</span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>39</noscript></span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">100/100</span></div>
                        <span class="uk-text-muted uk-text-small">Total Employees</span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>279</noscript></span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">233/279</span></div>
                        <span class="uk-text-muted uk-text-small">Regular Employees</span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>233</noscript></span></h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">46/279</span></div>
                        <span class="uk-text-muted uk-text-small">Contractual</span>
                        <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>46</noscript></span></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- tasks -->
        <div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
            <div class="uk-width-medium-1-2">
                <div class="md-card">
                    <div class="md-card-content">
                            <h3 class="heading_a uk-margin-bottom">Leave Request</h3>
                        <div class="uk-overflow-container">
                            <table class="uk-table">
                                <thead>
                                    <tr>
                                        <th class="uk-text-nowrap">Name</th>
                                        <th class="uk-text-nowrap">Date Filed</th>
                                        <th class="uk-text-nowrap">Leave Type</th>
                                        <th class="uk-text-nowrap  uk-text-right">Staus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // foreach($limit_leave as $leave){
                                //     $emp_wname = $leave->emp_FName.' '.$leave->emp_LName;
                                //     $date_filed = date('F d, Y', strtotime($leave->Leave_Date_Filed));
                                //     if($leave->Leave_Status == 'Denied'){
                                //         $status = '<span class="uk-badge uk-badge-danger">Denied</span>';
                                //     }elseif($leave->Leave_Status == 'Noted'){
                                //         $status = '<span class="uk-badge uk-badge-success">Noted</span>';
                                //     }else{
                                //         $status = '<span class="uk-badge uk-badge-warning">Pending</span>';
                                //     }
                                //     echo '<tr class="uk-table-middle">
                                //             <td class="uk-width-3-10 uk-text-nowrap"><a href="'.base_url('Leave-Application').'">'.$emp_wname.'</a></td>
                                //             <td class="uk-width-3-10">'.$date_filed.'</td>
                                //             <td class="uk-width-2-10">'.$leave->leave_type.'</td>
                                //             <td class="uk-width-2-10 uk-text-right uk-text-nowrap">'.$status.'</td>
                                //         </tr>';
                                // }
                                ?>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-1-2">
                <div class="md-card">
                    <div class="md-card-content">
                        <h3 class="heading_a uk-margin-bottom">Notable Leave</h3>
                        <div id="ct-chart" class="chartist"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="md-card">
            <div id="clndr_events" class="clndr-wrapper">
                <script>
                    // calendar events
                    clndrEvents = [{
                        date: '2019-03-22',
                        title: 'Purchased Car',
                        url: 'javascript:void(0)',
                        timeStart: '14:00',
                        timeEnd: '16:30'
                    },{
                        date: '2019-03-25',
                        title: 'Sleep all day',
                        url: 'javascript:void(0)',
                        timeStart: '00:00',
                        timeEnd: '23:59'
                    },{
                        date: '2019-03-31',
                        title: 'Deadline of HRMIS',
                        url: 'javascript:void(0)',
                        timeStart: '00:00',
                        timeEnd: '23:59'
                    }]
                </script>
                <script id="clndr_events_template" type="text/x-handlebars-template">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon clndr_add_event material-icons">add</i>
                            <i class="md-icon clndr_today material-icons">event</i>
                            <i class="md-icon clndr_previous material-icons">chevron_left</i>
                            <i class="md-icon clndr_next material-icons uk-margin-remove">chevron_right</i>
                        </div>
                        <h3 class="md-card-toolbar-heading-text">
                                        {{ month }} {{ year }}
                                    </h3>
                    </div>
                    <div class="clndr_days">
                        <div class="clndr_days_names">
                            {{#each daysOfTheWeek}}
                            <div class="day-header">{{ this }}</div>
                            {{/each}}
                        </div>
                        <div class="clndr_days_grid">
                            {{#each days}}
                            <div class="{{ this.classes }}" {{#if this.id }} id="{{ this.id }}" {{/if}}>
                                <span>{{ this.day }}</span>
                            </div>
                            {{/each}}
                        </div>
                    </div>
                    <div class="clndr_events">
                        <i class="material-icons clndr_events_close_button">&#xE5CD;</i> {{#each eventsThisMonth}}
                        <div class="clndr_event" data-clndr-event="{{ dateFormat this.date format='YYYY-MM-DD' }}">
                            <a href="{{ this.url }}">
                                <span class="clndr_event_title">{{ this.title }}</span>
                                <span class="clndr_event_more_info">
                                                {{~dateFormat this.date format='MMM Do'}}
                                                {{~#ifCond this.timeStart '||' this.timeEnd}} ({{/ifCond}}
                                                {{~#if this.timeStart }} {{~this.timeStart~}} {{/if}}
                                                {{~#ifCond this.timeStart '&&' this.timeEnd}} - {{/ifCond}}
                                                {{~#if this.timeEnd }} {{~this.timeEnd~}} {{/if}}
                                                {{~#ifCond this.timeStart '||' this.timeEnd}}){{/ifCond~}}
                                            </span>
                            </a>
                        </div>
                        {{/each}}
                    </div>
                </script>
            </div>
            <div class="uk-modal" id="modal_clndr_new_event">
                <div class="uk-modal-dialog">
                    <div class="uk-modal-header">
                        <h3 class="uk-modal-title">New Event</h3>
                    </div>
                    <div class="uk-margin-bottom">
                        <label for="clndr_event_title_control">Event Title</label>
                        <input type="text" class="md-input" id="clndr_event_title_control" />
                    </div>
                    <div class="uk-grid uk-grid-width-medium-1-3 uk-margin-large-bottom" data-uk-grid-margin>
                        <div>
                            <div class="uk-input-group">
                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                <label for="clndr_event_date_control">Event Date</label>
                                
                                <input class="md-input" type="text" id="clndr_event_date_control" data-uk-datepicker="{format:'YYYY-MM-DD', addClass: 'dropdown-modal', minDate: '<?php echo date('Y-m-d');?>' }">
                            </div>
                        </div>
                        <div>
                            <div class="uk-input-group">
                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-clock-o"></i></span>
                                <label for="clndr_event_start_control">Event Start</label>
                                <input class="md-input" type="text" id="clndr_event_start_control" data-uk-timepicker>
                            </div>
                        </div>
                        <div>
                            <div class="uk-input-group">
                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-clock-o"></i></span>
                                <label for="clndr_event_end_control">Event End</label>
                                <input class="md-input" type="text" id="clndr_event_end_control" data-uk-timepicker>
                            </div>
                        </div>
                    </div>
                    <div class="uk-modal-footer uk-text-right">
                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                        <button type="button" class="md-btn md-btn-flat md-btn-flat-primary" id="clndr_new_event_submit">Add Event</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- circular charts -->
        <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-5 uk-text-center uk-sortable sortable-handler" id="dashboard_sortable_cards" data-uk-sortable data-uk-grid-margin>
            <div>
                <div class="md-card md-card-hover md-card-overlay">
                    <div class="md-card-content">
                        <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                            <span class="epc_chart_icon"><i class="material-icons">&#xE0BE;</i></span>
                        </div>
                    </div>
                    <div class="md-card-overlay-content">
                        <div class="uk-clearfix md-card-overlay-header">
                            <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                            <h3>
                                    User Messages
                                </h3>
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card md-card-hover md-card-overlay">
                    <div class="md-card-content uk-flex uk-flex-center uk-flex-middle">
                        <span class="peity_conversions_large peity_data">5,3,9,6,5,9,7</span>
                    </div>
                    <div class="md-card-overlay-content">
                        <div class="uk-clearfix md-card-overlay-header">
                            <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                            <h3>
                                    Conversions
                                </h3>
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card md-card-hover md-card-overlay md-card-overlay">
                    <div class="md-card-content" id="canvas_1">
                        <div class="epc_chart" data-percent="37" data-bar-color="#9c27b0">
                            <span class="epc_chart_icon"><i class="material-icons">&#xE85D;</i></span>
                        </div>
                    </div>
                    <div class="md-card-overlay-content">
                        <div class="uk-clearfix md-card-overlay-header">
                            <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                            <h3>
                                    Tasks List
                                </h3>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <button class="md-btn md-btn-primary">More</button>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card md-card-hover md-card-overlay">
                    <div class="md-card-content">
                        <div class="epc_chart" data-percent="53" data-bar-color="#009688">
                            <span class="epc_chart_text"><span class="countUpMe">53</span>%</span>
                        </div>
                    </div>
                    <div class="md-card-overlay-content">
                        <div class="uk-clearfix md-card-overlay-header">
                            <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                            <h3>
                                    Orders
                                </h3>
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card md-card-hover md-card-overlay">
                    <div class="md-card-content">
                        <div class="epc_chart" data-percent="37" data-bar-color="#607d8b">
                            <span class="epc_chart_icon"><i class="material-icons">&#xE7FE;</i></span>
                        </div>
                    </div>
                    <div class="md-card-overlay-content">
                        <div class="uk-clearfix md-card-overlay-header">
                            <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                            <h3>
                                    User Registrations
                                </h3>
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>