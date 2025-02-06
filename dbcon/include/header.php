<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INTRA ODITEK</title>

    <!-- PACE LOAD BAR PLUGIN - This creates the subtle load bar effect at the top of the page. -->
    <link href="<?php echo ADMIN_SITE_URL;?>css/pace.css" rel="stylesheet">
    <script src="<?php echo ADMIN_SITE_URL;?>js/pace.js"></script>

    <!-- GLOBAL STYLES - Include these on every page. -->
    <link href="<?php echo ADMIN_SITE_URL;?>css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel="stylesheet" type="text/css">
    <link href="<?php echo ADMIN_SITE_URL;?>/admin/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="img/OdiTek_fav.png">
    <!-- PAGE LEVEL PLUGIN STYLES -->
    <!-- THEME STYLES - Include these on every page. -->
    <link href="<?php echo ADMIN_SITE_URL;?>css/style.css" rel="stylesheet">
    <link href="<?php echo ADMIN_SITE_URL;?>css/plugins.css" rel="stylesheet">
	<link href="<?php echo ADMIN_SITE_URL;?>css/chosen.css" rel="stylesheet">
	<link href="<?php echo ADMIN_SITE_URL;?>css/load.css" rel="stylesheet">
	<script src="<?php echo ADMIN_SITE_URL;?>js/jquery.min.js"></script>
    <!-- THEME DEMO STYLES - Use these styles for reference if needed. Otherwise they can be deleted. -->
    <link href="<?php echo ADMIN_SITE_URL;?>css/demo.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_SITE_URL;?>calendar/tcal.css" />
	<script type="text/javascript" src="<?php echo ADMIN_SITE_URL;?>calendar/tcal.js"></script> 
	<script type="text/javascript" src="<?php echo ADMIN_SITE_URL;?>js/chosen.jquery.js"></script> 
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
.tooltip{position:absolute;z-index:1030;display:block;visibility:visible;font-size:12px;line-height:1.4;opacity:0;filter:alpha(opacity=0);}.tooltip.in{opacity:0.8;filter:alpha(opacity=80);}
.tooltip.top{margin-top:-3px;padding:5px 0;}
.tooltip.right{margin-left:3px;padding:0 5px;}
.tooltip.bottom{margin-top:3px;padding:5px 0;}
.tooltip.left{margin-left:-3px;padding:0 5px;}
.tooltip-inner{max-width:200px;padding:8px;color:#ffffff;text-align:center;text-decoration:none;background-color:#000000;-webkit-border-radius:4px;-  moz-border-radius:4px;border-radius:4px;}
.tooltip-arrow{position:absolute;width:0;height:0;border-color:transparent;border-style:solid;}
.tooltip.top .tooltip-arrow{bottom:0;left:50%;margin-left:-5px;border-width:5px 5px 0;border-top-color:#000000;}
.tooltip.right .tooltip-arrow{top:50%;left:0;margin-top:-5px;border-width:5px 5px 5px 0;border-right-color:#000000;}
.tooltip.left .tooltip-arrow{top:50%;right:0;margin-top:-5px;border-width:5px 0 5px 5px;border-left-color:#000000;}
.tooltip.bottom .tooltip-arrow{top:0;left:50%;margin-left:-5px;border-width:0 5px 5px;border-bottom-color:#000000;}

  input.text, input.input-text, input.password, input{
	background-color:#FFFFFF;
    border: 1px solid #D0D5CB;
    -moz-border-radius:1px;
	-webkit-border-radius:1px;
	-o-border-radius:1px;
	-ms-border-radius:1px;
	border-radius:1px;
    color: #0B1902;
    font-size: 12px;
    margin: 0px 0px 0px 0px;
    padding: 8px 10px;
	outline:none;
}
input.text:focus, input.input-text:focus, input.password:focus, input:focus {
    border-color: #e93a30;
    outline: medium none;
	box-shadow: 0 2px 16px rgba(0, 100, 0, 0.3);
	-webkit-shadow: 0 2px 16px rgba(0, 100, 0, 0.3);
  	-moz-shadow: 0 2px 16px rgba(0, 100, 0, 0.3);
  	-o-shadow: 0 2px 16px rgba(0, 100, 0, 0.3);
  	-ms-shadow: 0 2px 16px rgba(0, 100, 0, 0.3);
}   
 
</style>
</head>

<body>
<div id="loading_data" style="display:none;">
<img src="img/loading.gif" border="0" name="NDRF" style="float:left; width:50px; height:auto; padding:10px;">
<span style="float:left; padding-left:10px;">Please wait...</span>
<div class="clear"></div>
</div> 
    <div id="wrapper">

        <!-- begin TOP NAVIGATION -->
        <nav class="navbar-top" role="navigation" >

            <!-- begin BRAND HEADING -->
           <div class="navbar-header" style="background: #f7f7fa;">
                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".sidebar-collapse">
                    <i class="fa fa-bars"></i> Menu
                </button>
               <div class="navbar-brand" style="padding: 0px 40px;">
                    <a href="index.html">
                        <img src="img/logo_w.png" data-1x="img/logo_w.png" data-2x="img/logo_w.png" class="hisrc img-responsive" alt="">
                    </a>
                </div>
            </div>
            <!-- end BRAND HEADING -->

            <div class="nav-top">

                <!-- begin LEFT SIDE WIDGETS -->
                <ul class="nav navbar-left">
                    <li class="tooltip-sidebar-toggle">
                        <a href="#" id="sidebar-toggle" data-toggle="tooltip" data-placement="right" title="Sidebar Toggle" class="outlinedivnone">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                    <!-- You may add more widgets here using <li> -->
                </ul>
                <!-- end LEFT SIDE WIDGETS -->

                <!-- begin MESSAGES/ALERTS/TASKS/USER ACTIONS DROPDOWNS -->
                <ul class="nav navbar-right" style="padding-left:70px;">
                    <!-- end ALERTS DROPDOWN -->

                    <!-- begin USER ACTIONS DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="viewmyprofile.php">
                                    <i class="fa fa-user"></i> My Profile
                                </a>
                            </li>
							<li class="divider"></li>
                            <li>
                                <a class="logout_open" href="logout.php">
                                    <i class="fa fa-sign-out"></i> Logout
                                    <strong><?php echo $_SESSION["emp_name"];?></strong>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                    <!-- /.dropdown -->
                    <!-- end USER ACTIONS DROPDOWN -->

                </ul>
                <!-- /.nav -->
                <!-- end MESSAGES/ALERTS/TASKS/USER ACTIONS DROPDOWNS -->

            </div>
            <!-- /.nav-top -->
        </nav>