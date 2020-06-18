<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/bethany_official/logo.png" sizes="16x16">

    <title><?php echo $title_page;?></title>

    <!-- additional styles for plugins -->
        <!-- uikit -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/uikit/css/uikit.almost-flat.min.css" media="all">
        <!-- flag icons -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/icons/flags/flags.min.css" media="all">
        <!-- altair admin -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.min.css" media="all">
        <style>
            /* Webkit browsers like Safari and Chrome */
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            /* width */
            ::-webkit-scrollbar {
            width: 0px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
            background: #000; 
            }
            
            /* Handle */
            ::-webkit-scrollbar-thumb {
            background: #00a65a; 
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
            background: #888; 
            }
        </style>
</head>
<body class=" sidebar_main_open sidebar_main_swipe">
<?php  
$employee_code = $this->session->userdata('employee_code');
$user_image = $this->session->userdata('user_image');
?>
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                                
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                
                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>
                
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE7F4;</i><span class="uk-badge">16</span></a>
                            <div class="uk-dropdown uk-dropdown-xlarge">
                                <div class="md-card-content">
                                    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#header_alerts',animation:'slide-horizontal'}">
                                        <li class="uk-width-1-2 uk-active"><a href="#" class="js-uk-prevent uk-text-small">Messages (0)</a></li>
                                        <li class="uk-width-1-2"><a href="#" class="js-uk-prevent uk-text-small">Alerts (0)</a></li>
                                    </ul>
                                    <ul id="header_alerts" class="uk-switcher uk-margin">
                                        <li>
                                            <!-- <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-cyan">yd</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Enim neque est.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Fugit non sit neque commodi molestiae quia nobis quia.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_07_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Occaecati aut.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Quis incidunt facere corrupti dolor at aut harum eum a sed.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-light-green">hr</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Saepe est.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Repellat veritatis et illum magnam a dignissimos consequuntur molestiae.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_02_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Non necessitatibus inventore.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Enim et explicabo laboriosam enim voluptatum odio ut.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_09_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Voluptatem ratione maxime.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Dignissimos occaecati in voluptatem eos reiciendis.</span>
                                                    </div>
                                                </li>
                                            </ul> -->
                                            <div class="uk-text-center uk-margin-top uk-margin-small-bottom">
                                                <a href="#" class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent">Feature will be added soon...</a>
                                            </div>
                                        </li>
                                        <li>
                                            <!-- <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Voluptates assumenda.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Necessitatibus non vel magnam neque.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-success">&#xE88F;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Possimus eligendi.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Minus error quod impedit.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-danger">&#xE001;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Explicabo ut mollitia.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Perspiciatis ab nihil in sed.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-primary">&#xE8FD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Modi sint dolor.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Amet et eum quo sed et.</span>
                                                    </div>
                                                </li>
                                            </ul> -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image">
                            <img class="md-user-image" src="<?php echo base_url($user_image);?>" alt=""/></a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="<?php echo base_url('View-My-Profile/'.$employee_code);?>">My Profile</a></li>
                                    <li><a href="<?php echo base_url('View-My-Account/'.$employee_code);?>">My Account</a></li>
                                    <li><a href="<?php echo base_url();?>Logout">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form">
                <input type="text" class="header_main_search_input" value="Feature will be added soon..."/>
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
            </form>
        </div>
    </header><!-- main header end -->