<div id="page_content">
    <div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }">
        <h1>Manage System Settings</h1>
        <span class="uk-text-upper uk-text-small"><a href="#">Human Resource Management Information System - <?php echo date('Y');?></a></span>
    </div>

    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-overflow-container uk-margin-bottom">
                    <h3 class="heading_b">System Information</h3>
                    <ul class="md-list">
                        <li>
                            <div class="md-list-content">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                        Online
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Status</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                        HRMIS Rebuild V 1.22.5389475
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Version</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                        April 01, 2019
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Released</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                        Web-Based System
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
                                        <?php echo base_url();?>
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Base Url</span>
                                    </div>
                                    <div class="uk-width-large-2-4 uk-text-center">
                                        <span class="md-list-heading">
                                        <h4 class="heading_a">Human Resource Management Information System</h4>
                                        </span>
                                        <span class="uk-text-small uk-text-muted">System Title</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                        GLPv2.0
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Licensed Under</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                        CodeIgniter 3, UI-Kit, MySQL<br/>PHP ZKLib, Altair Admin
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Technologies Used</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                        Jose Angelito N. Cereno <br/> @JACodeIT
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Designed & Developed By:</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                        +63 927 978 4731 <br/>jacerenoit25@gmail.com
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Contact Information</span>
                                    </div>
                                    <div class="uk-width-large-1-4">
                                        <span class="md-list-heading">
                                        <?php echo date('h:i:sA').'<br>'.date('F d,Y');?>
                                        </span>
                                        <span class="uk-text-small uk-text-muted">Current System Time</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-medium-1-2 uk-grid-medium" data-uk-sortable data-uk-grid-margin>
            <h3 class="heading_b">System Database</h3>
        </div>
        <div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="material-icons md-color-teal-500 md-36">event</i></div>
                        <span class="uk-text-muted uk-text-small">Latest Backup was on</span>
                        <h2 class="uk-margin-remove">March 27, 2019</h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <button type="button" class="md-btn md-btn-primary md-btn-wave-light md-btn-block" data-uk-tooltip title="SYNCING TAKES TIME" style="height:50px;" onclick="" ><i class="material-icons md-color-grey-50 md-24">cloud_download</i>&nbsp;Back-up Database</button>
                    </div>
                </div>
            </div>
            <div>
                <div class="md-card">
                    <div class="md-card-content">
                        <button type="button" class="md-btn md-btn-primary md-btn-wave-light md-btn-block" data-uk-tooltip title="SYNCING TAKES TIME" style="height:50px;" onclick="" ><i class="material-icons md-color-grey-50 md-24">cloud_upload</i>&nbsp;Restore Database</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>