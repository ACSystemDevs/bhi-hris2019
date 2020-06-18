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

    <title>BHI HRIS - <?php echo $title;?></title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin error page -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/error_page.min.css" />
    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/uikit/css/uikit.almost-flat.min.css" media="all">
        <!-- flag icons -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/icons/flags/flags.min.css" media="all">
        <!-- altair admin -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.min.css" media="all">
</head>
<body class="error_page">

    <div class="error_page_header">
        <div class="uk-width-8-10 uk-container-center">
        <?php echo $error_msg;?>!
        </div>
    </div>
    <div class="error_page_content">
        <div class="uk-width-8-10 uk-container-center">
            <div class="uk-alert uk-alert-danger uk-text-bold" data-uk-alert>
                <?php echo "The following field is required: " . validation_errors(' ', ', ');?>
            </div>
            <p class="heading_b"><?php echo $code;?></p>
            <p class="uk-text-large">
               Oops! An Error occured on <span class="uk-text-danger"><?php echo $module;?> Module</span> <br/>
               <span class="uk-text-danger">End Date must be same/or after Start Date</span>
            </p>
            <a href="#" class="md-btn md-btn-danger md-btn-wave-light" onclick="history.go(-1);return false;"><i class="material-icons">arrow_back_ios</i>&nbsp;Go back to previous page</a>
        </div>
    </div>
</body>
</html>