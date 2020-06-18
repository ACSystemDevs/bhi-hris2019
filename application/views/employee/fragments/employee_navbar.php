<!-- main sidebar -->
<aside id="sidebar_main">
        
        <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <a href="<?php echo base_url();?>Dashboard" class="sSidebar_hide"><img src="<?php echo base_url();?>assets/img/bethany_official/logo_main.fw.png" alt="" height="50" width="200"/></a>
                <a href="<?php echo base_url();?>Dashboard" class="sSidebar_show"><img src="<?php echo base_url();?>assets/img/bethany_official/logo.png" alt="" height="32" width="32"/></a>
            </div>
        </div>
        <?php  $employee_code = $this->session->userdata('employee_code');?>
        <div class="menu_section">
            <ul>
                <li>
                    <a href="<?php echo base_url();?>Dashboard">
                        <span class="menu_icon"><i class="material-icons">dashboard</i></span>
                        <span class="menu_title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('View-My-Profile/'.$employee_code);?>">
                        <span class="menu_icon"><i class="material-icons">account_box</i></span>
                        <span class="menu_title">My Profile</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">event_busy</i></span>
                        <span class="menu_title">Manage Leave</span>
                    </a>
                    <ul>
                        <li><a href="<?php echo base_url('File-Leave-Request/'.$employee_code);?>">Apply Leave Request</a></li>
                        <li><a href="<?php echo base_url('My-Leave-Application/'.$employee_code);?>">View Leave Requests</a></li>
                    </ul>
                </li> -->
                <li>
                    <a href="<?php echo base_url('My-Leave-Application/'.$employee_code);?>">
                        <span class="menu_icon"><i class="material-icons">event_busy</i></span>
                        <span class="menu_title">Leave History</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>Logout">
                        <span class="menu_icon"><i class="material-icons">power_settings_new</i></span>
                        <span class="menu_title">Logout</span>
                    </a>
                </li>
                <li>
                    <a>&copy;&nbsp;MIS-JACeeeee&nbsp;<?php echo date('Y');?></a>
                </li>
            </ul>
        </div>
    </aside><!-- main sidebar end -->