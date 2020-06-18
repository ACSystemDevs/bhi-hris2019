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

    <title>Bethany Hospital Inc. HRMIS</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/login_page.min.css" />

</head>
<body class="login_page" style="background:url(<?php echo base_url(); ?>assets/img/bethany_official/bhi-droneshot.png) no-repeat center center; background-size: cover; ">
    <div class="login_page_wrapper">
        <div class="md-card" id="login_card" style="background-color:rgba(255,255,255, 0.85);">
            <div class="md-card-content large-padding" id="login_form" >
                <div class="login_heading">
					<div class="user_avatar" style="height:75px;width:75px;">
                        <img src="<?php echo base_url();?>assets/img/bethany_official/logo.png" style="height:100%;">
                    </div>
					<h3 class="heading_b uk-bottom-margin">Bethany Hospital Inc.</h3>
					<h4 class="heading_c uk-bottom-margin">Human Resource Management System</h4>
                </div>
                <?php 
                    $error_msg = $this->session->flashdata('error_msg');
                    if ($error_msg) {
                ?>
                        <div class="uk-alert uk-alert-danger uk-text-center" data-uk-alert>
                            <?php echo $error_msg; ?>
                        </div>
                <?php
                    } else {
                ?>
                        <div class="alert">
                        </div>
                <?php 
                }
                ?>
                <form method="POST" action="<?php echo base_url('Login_Verification');?>">
                    <div class="uk-form-row">
                        <label for="login_username">Username</label>
                        <input class="md-input" type="text" id="login_username" name="login_username" required autocomplete="off"/>
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" type="password" id="login_password" name="login_password" required/>
                    </div>
                    <div class="uk-margin-medium-top">
                        <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</button>
                    </div>
                    <div class="uk-margin-top">
                        <a href="#" id="login_help_show" class="uk-float-right">Can't log in?</a>
                        <span class="icheck-inline">&copy;JACodeIT Systems
                        </span>
                    </div>
                </form>
            </div>
            <div class="md-card-content large-padding uk-position-relative" id="login_help" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <div class="login_heading">
					<div class="user_avatar" style="height:50px;width:50px;">
                        <img src="<?php echo base_url();?>assets/img/bethany_official/logo.png" style="height:100%;">
                    </div>
					<h3 class="heading_b uk-bottom-margin">Bethany Hospital Inc.</h3>
					<h4 class="heading_c uk-bottom-margin">Human Resource Management System</h4>
                </div>
                <h2 class="heading_b uk-text-success">Can't log in?</h2>
                <p>Please contact your System Administrator @ Local 126</p>
            </div>
        </div>
    </div>

    <!-- common functions -->
    <script src="<?php echo base_url();?>assets/js/common.min.js"></script>
    <!-- altair core functions -->
    <script src="<?php echo base_url();?>assets/js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="<?php echo base_url();?>assets/js/pages/login.min.js"></script>
</body>
</html>