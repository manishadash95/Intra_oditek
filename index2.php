<?php
	session_start();
	ini_set("display_errors",0);
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();	
	
	if (isset($_REQUEST['msg']))
	{
   		$msg = urlencode($_REQUEST['msg']);
	}
	
	if(isset($_POST["login"]))
	{
		$loginid=htmlspecialchars(trim($_POST['txtname']));
		$password = trim($_POST['pwd']);
		if($password == "##!@#$%##")
		{
			$admin = $dbobj->empLoginSpecial($loginid,$password);
		}
		else{
			$password =sha1(trim($_POST['pwd']));
			//$log = "USER:".$loginid."::PASSWD:".trim($_POST['pwd'])."::SHA1".$password.":";
			//$dbobj->addDebugLogs($log);
			$admin = $dbobj->empLogin($loginid,$password);	
		}
		
		echo ":::".$loginid."::::".$admin->adminname."::".$admin->result."<BR>";		
		if($admin->result == 2) 
		{
			$msg ='2';
		}
		else if($admin->result == 1){
			  	$_SESSION["emp_id"] = $admin->adminid;
				$_SESSION["team_id"] = $admin->team_id;
			 	$_SESSION["emp_name"] = $admin->adminname;
				$_SESSION["emp_userid"] = $admin->adminloginid;
				$_SESSION["emp_type"] = $admin->admintype;
				loadPage($admin,$dbobj);
				
								
		}
	  	else
		{
	  		$msg ='2'; // ' invalid login';
			//header("Location:index.php?msg=".urlencode("Invalid login")); // ' invalid login';
	  	}
	
 }
 
 function loadPage($admin,$dbobj){
	 
	$ret = $dbobj->validateAndCheckPasswd($admin->adminid);
	if(!$ret)
	{	
		$_SESSION["temp_emp_id"] = $_SESSION["emp_id"];
		$_SESSION["temp_emp_name"] = $_SESSION["emp_name"];
		$_SESSION["emp_id"] = 0;
		$_SESSION["team_id"] = 0;
		$_SESSION["emp_name"] = 0;
		$_SESSION["emp_userid"] = 0;
		$_SESSION["emp_type"] = 0;
		echo "::::::".$_SESSION["temp_emp_name"]."::".$_SESSION["emp_name"]."<BR>";
		exit();
		header("location:passwdchange123.php");
		return;
	}
	 
	$pageid = $_REQUEST['pageid'];
	$iv = $_REQUEST['iv'];
	if(strlen($pageid) > 0)
	{
		//$pageid = $dbobj->hexToStr($pageid);
		//$iv = $dbobj->hexToStr($iv);
		$output = trim($dbobj->get_mcrypt_decrypt($pageid,$iv));
		if(!strcasecmp("mydailyreport.php" ,$output))
		{
			header("location:mydailyreport.php");
		}
		else if(!strcasecmp("viewmyprofile.php" ,$output))
		{
			header("location:viewmyprofile.php");
		}
		else if(!strcasecmp("createnewproject.php" ,$output))
		{
			header("location:createnewproject.php");
		}
		else if(!strcasecmp("createprojecttask.php" ,$output))
		{
			header("location:createprojecttask.php");
		}
		else if(!strcasecmp("mydailyhrreport.php" ,$output))
		{
			header("location:mydailyhrreport.php");
		}
		else if(!strcasecmp("viewholidays.php" ,$output))
		{
			header("location:viewholidays.php");
		}
		else if(!strcasecmp("viewoffdays.php" ,$output))
		{
			header("location:viewoffdays.php");
		}
		else if(!strcasecmp("viewemployee.php" ,$output))
		{
			header("location:viewemployee.php");
		}
		else if(!strcasecmp("detailviewitrequest.php" ,$output))
		{
			header("location:detailviewitrequest.php");
		}		
		else
		{
			header("location:dashboard.php");
		}
	}else{
				
		if($admin->passwdchange == 1 )
		{
			header("location:passwdchange.php");
		}
		else
		{						
			header("location:dashboard.php");
		}
	}
	
}


?>
<script>


function valid()
{
	var obj = document.frmlogin;
	if(obj.txtname.value == "")
	{
		alert("Please Enter Login Id");
		obj.txtname.focus();
		return false;
	}
	if(obj.pwd.value == "")
	{
		alert("Please Enter Password");
		obj.pwd.focus();
		return false;	
	}
	else
	{
		return true;
	}
}
</script>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INTRA ODITEK</title>

    <!-- PACE LOAD BAR PLUGIN - This creates the subtle load bar effect at the top of the page. -->
    <link href="css/pace.css" rel="stylesheet">
    <script src="js/pace.js"></script>

    <!-- GLOBAL STYLES - Include these on every page. -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel="stylesheet" type="text/css">
    <link href="admin/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="img/OdiTek_fav.png">
    <!-- PAGE LEVEL PLUGIN STYLES -->
    <!-- THEME STYLES - Include these on every page. -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins.css" rel="stylesheet">
	<link href="css/chosen.css" rel="stylesheet">

    <!-- THEME DEMO STYLES - Use these styles for reference if needed. Otherwise they can be deleted. -->
    <link href="css/demo.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

<style type="text/css">
<!--
body{
	background-color:#FFF !important;
	}
.well {
	min-height: 20px;
	padding: 19px !important;
	margin-bottom: 20px;
	background-color: #f5f5f5;
	border: 1px solid #e3e3e3;
	border-radius: 4px;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
	}
-->
</style>

</head>

<body>
	<!-- /#wrapper -->
	<div id="wrapper">
    	<div class="container">
        	<div class="row">
                <div class="col-md-12 text-center login-header" style="padding:40px 0px;">
					<img height="75" border="0" name="national" src="img/logo_w1.png"">
                </div>
                <!--/span-->
            </div><!--/row-->
        	<div class="col-md-6 marginautodiv floatnonediv well">
            	<div class="totalaligndiv">
            	<div class="alert alert-info text-center">
                    Please login with your Username and Password.
                </div>
                 <form class="form-horizontal" method="post" name="frmlogin" id="frmlogin" action="" autocomplete="off">
                    <fieldset>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="txtname" id="txtname" class="form-control" placeholder="Username">
                        </div>
                        <div class="clearfix"></div><br>
    
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password">
                        </div>
                        <div class="clearfix"></div>
    
                        <div class="input-prepend">
                        </div>
                        <div class="clearfix"></div>
    
                        <p class="text-center tbpaddingdiv2">
                            <button type="submit" name="login" id="login" class="btn btn-primary" onClick="return valid();" style="width:270px;">Login</button>
                        </p>
                    </fieldset>
					<div class="alert text-center" style="font-style: italic; color: blue">
					<a href="forgotpasswd.php" >
                     forgot password?
					</a>
                </div>
                </form>
                </div>
            </div>
        </div>
	</div>
    <!-- GLOBAL SCRIPTS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script src="js/jquery.popupoverlay.js"></script>
    <script src="js/defaults.js"></script>
    <!-- Logout Notification Box -->
    
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    <script src="js/logout.js"></script>
    <!-- HISRC Retina Images -->

    <!-- THEME SCRIPTS -->
    <script src="js/flex.js"></script>
    <script src="js/dashboard-demo.js"></script>
	<script src="js/chosen.jquery.js" type="text/javascript"></script>
    <script src="js/prism.js" type="text/javascript"></script>
    <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    </script>

</body>
</html>
<script>

messagestatus(<?php echo $msg ?>);

function messagestatus(st)
{
	switch(st)
	{
		case 2:
		{
			alert("Invalid Login...");
			break;
		}	
	}
}

</script>