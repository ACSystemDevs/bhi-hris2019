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
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">dashboard</i></span>
                        <span class="menu_title">Dashboard</span>
                    </a>
                    <ul>
                        <li><a href="<?php echo base_url();?>Dashboard">Dashboard</a></li>
                        <li><a href="<?php echo base_url();?>Dashboard-Graphs">Dashboard Graphs</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">face</i></span>
                        <span class="menu_title">Manage Members</span>
                    </a>
                    <ul>
                        <li><a href="<?php echo base_url();?>Members-Masterlist">View Members</a></li>
                        <li><a href="<?php echo base_url();?>Members-Directory">Members Directory</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">contact_mail</i></span>
                        <span class="menu_title">Manage Leave</span>
                    </a>
                    <ul>
                        <li><a href="<?php echo base_url();?>Employee-Request-Leave-Section">Apply Leave Request</a></li>
                        <li><a href="<?php echo base_url();?>Leave-Application-Section">View Leave Requests</a></li>
                        <li><a href="<?php echo base_url();?>Leave-Archives">View Archived Leave</a></li>
                    </ul>
                </li>
                <li >
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">watch_later</i></span>
                        <span class="menu_title">Manage Attendance</span>
                    </a>
                    <ul>
                        <li><a href="<?php echo base_url();?>Overtime-Requests">Overtime Requests</a></li>
                        <li><a href="<?php echo base_url();?>Exchange-Duty-Requests">Exchange Duty Request</a></li>
                        <li><a href="<?php echo base_url();?>Work-on-Dayoff-Requests">Work-on-Dayoff Request</a></li>
                    </ul>
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