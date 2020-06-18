<div id="page_content">
    <div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }">
        <h1>Manage uFace 402 Device- ZKTeco</h1>
        <span class="uk-text-upper uk-text-small"><a href="#">Facial multi-biometric time & attendance and access control terminal</a></span>
    </div>

    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-overflow-container uk-margin-bottom">
                    <h3 class="heading_b">Device Information</h3>
                    <ul class="md-list">
                        <li>
                            <div class="md-list-content">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_status;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">Status</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_version;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">Version</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_osVersion;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">OS Version</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_platform;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">Platform</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_fmVersion;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">Firmware Version</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_workCode;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">Work Code</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_ssr;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">SSR</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_pinWidth;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">PIN Width</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_faceFunctionOn;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">Face Function On</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_serialNumber;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">Serial Number</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_deviceName;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">Device Name</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                                        <?php echo $zk_getTime;?>
                                                    </span>
                                        <span class="uk-text-small uk-text-muted">Current Device Time</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- statistics (small charts) -->
        <div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="material-icons md-color-orange-500 md-36">sync_disabled</i></div>
                        <span class="uk-text-muted uk-text-small">Unsynced Records</span>
                        <!-- <h2 class="uk-margin-remove">6</h2> -->
                        <h2 class="uk-margin-remove">
                            <?php 
                                if(empty($last_records->FK_attendance_log_ID)){
                                    echo intval($current_record);
                                }else{
                                    echo (intval($current_record) - intval($last_records->FK_attendance_log_ID));
                                }
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="material-icons md-color-teal-500 md-36">event_available</i></div>
                        <span class="uk-text-muted uk-text-small">Last Synced</span>
                        <h2 class="uk-margin-remove">
                            <?php 
                                if(empty($last_records->Attendance_Date_Updated)){
                                    echo 'No Records Found!';
                                }else{
                                    echo date('F d,Y',strtotime($last_records->Attendance_Date_Updated));
                                }
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <button type="button" class="md-btn md-btn-primary md-btn-wave-light md-btn-block" data-uk-tooltip title="SYNCING TAKES TIME" style="height:50px;" onclick="sync_records()" ><i class="material-icons md-color-grey-50 md-24">sync</i>&nbsp;Sync Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>