<?php
	ini_set("display_errors",0);
	session_start();
	require_once 'dbcon/config.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();	
		
  
	$emp_name	= $_SESSION["temp_emp_name"];
	$emp_id = 	$_SESSION["temp_emp_id"];

?>

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
        	<div class="col-md-6 marginautodiv floatnonediv well" style="display:block" id="block1">
            	<div class="totalaligndiv">
            	<div class="alert alert-info text-center">
                    Mandatory change your (<?php echo $emp_name;?>) login password.
                </div>
                 <form class="form-horizontal" method="post" name="frmlogin" id="frmlogin" action="" autocomplete="off">
                    <fieldset>
						<div class="col-md-12  text-center">
                            <div class="input-group bmargindiv1 col-md-12">
                            <span class="input-group-addon ndrftextwidth text-left" style="width: 160px;">Current Password :</span>
                            <input type="password"  name="cpasswd" id="cpasswd" class="form-control tcal" placeholder="">
                            </div>
                        </div>
						
                        <div class="col-md-12  text-center">
                            <div class="input-group bmargindiv1 col-md-12">
                            <span class="input-group-addon ndrftextwidth text-left" style="width: 160px;">New Password :</span>
                            <input type="password"  name="password1" id="password1" class="form-control tcal" placeholder="">
                            </div>
                        </div>
						
						<div class="col-md-12  text-center">
                            <div class="input-group bmargindiv1 col-md-12">
                            <span class="input-group-addon ndrftextwidth text-left" style="width: 160px;">Reenter Password :</span>
                            <input type="text"  name="password2" id="password2" class="form-control tcal" placeholder="">
                            </div>
                        </div>
						<input type="hidden" name="eid" id="eid" value="<?php echo $emp_id; ?>" />
                        <div class="clearfix"></div><br>
    
                       <div class="clearfix"></div>
    
                        <div class="input-prepend">
                        </div>
                        <div class="clearfix"></div>
    
                        <p class="text-center tbpaddingdiv2">
                            <input type="button" class="btn btn-primary" value="Change Password" onClick="resetpasswd()" >
							
                        </p>
                    </fieldset>
					
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
    
</body>
</html>
<script>


function resetpasswd()
{
	
	var eid = document.getElementById('eid').value; 
	var cpasswd = document.getElementById('cpasswd').value; 
	var passwd1 = document.getElementById('password1').value; 
	var passwd2 = document.getElementById('password2').value;
	
	if(!cpasswd.length)
	{
		alert("Please add current password");
		return false;
	}
	
	if(!passwd1.length )
	{
		alert("Please add new password");
		return false;
	}
	
	if(!passwd2.length )
	{
		alert("Please retype new password");
		return false;
	}
	
	if(passwd1 != passwd2)
	{
		alert("Password mismatch");
		return false;
	}
	
	var dataString = "action=passwdchange&cpasswd="+cpasswd+"&npasswd="+passwd1+"&eid="+eid;
	//alert(""+dataString);
	$.ajax({ 
	type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
	success: function(html)
	{ 
		var dobj=jQuery.parseJSON(html);
		alert(dobj.msg);
		if(dobj.status==1)
		{
			window.location = 'index.php';
		}
		
	} 
	});	
	
		
}

	


</script>