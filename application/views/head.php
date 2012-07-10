<html>
<head>
    <title><?php echo $title ?> - PhD Tracker</title>
    <?php echo doctype(); ?>
    <link rel="shortcut icon" href="<?php echo base_url() ?>images/favicon.gif" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/basic.css" />
    <?php if(isset($css)){ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/<?php echo $css ?>.css" />
    <?php } ?>
</head>
<body>
    <div class="header">
        <div class="wrapper">
            <?php echo img(array('src'=>'images/hat.png', 'style'=>'float:left;')) ?>
            <div style="float: left; margin-top: 10px; margin-left: 10px; font-weight: bolder;">
                <?php echo $title ?> - PhD Tracker
            </div>
            
            <div class="menu">
                <?php
                //        Check if Logged in
                if(isset($this->session))
                if($this->session->userdata('logged_in'))
                { ?>
                    <ul>
                        <li><a href="<?php echo base_url() ?>login/logout">Logout</a></li>
                    </ul>
                <?php }  else{?>
                    <ul>
                        <li><a href="<?php echo base_url() ?>apply">Apply</a></li>
                    </ul>
                <?php }?>
            </div>
        </div>
    </div>
