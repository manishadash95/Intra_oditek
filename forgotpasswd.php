<?php
	ini_set("display_errors",0);
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();	
		
  


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
                    Please enter your office email id.
                </div>
                 <form class="form-horizontal" method="post" name="frmlogin" id="frmlogin" action="" autocomplete="off">
                    <fieldset>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="txtemail" id="txtemail" class="form-control" placeholder="email id">
							<span class="input-group-addon">@oditeksolutions.com</span>
                        </div>
                        <div class="clearfix"></div><br>
    
                       <div class="clearfix"></div>
    
                        <div class="input-prepend">
                        </div>
                        <div class="clearfix"></div>
    
                        <p class="text-center tbpaddingdiv2">
                            <input type="button" class="btn btn-primary" value="Reset Password" onClick="resetpasswd()" >
							
                        </p>
                    </fieldset>
					<div class="alert text-center" style="font-style: bold; color: blue">
					<a href="index.php" >
                     Sign in
					</a>
					</div>
                </form>
                </div>
            </div>
			
			<div class="col-md-6 marginautodiv floatnonediv well" style="display:none" id="block2">
            	<div class="totalaligndiv">
            	<div class="alert alert-info text-center">
                    Please check OTP send to your email. 
                </div>
                 <form class="form-horizontal" method="post" name="frmlogin" id="frmlogin" action="" autocomplete="off">
                    <fieldset>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon" style="width:180px">OTP: </span>
                            <input type="text" name="passwdotp" id="passwdotp" class="form-control" placeholder="OTP" style="width:350px">
				        </div>
                        <div class="clearfix"></div><br>
						<div class="input-group input-group-lg">
                            <span class="input-group-addon" style="width:180px" >New Password: </span>
                            <input type="password" name="passwd1" id="passwd1" class="form-control" placeholder="password" style="width:350px">
				        </div>
						<div class="clearfix"></div><br>
						<div class="input-group input-group-lg">
                            <span class="input-group-addon" style="width:180px">Retype Password: </span>
                            <input type="password" name="passwd2" id="passwd2" class="form-control" placeholder="retype password" style="width:350px">
				        </div>
						
                       <div class="clearfix"></div>
    
                        <div class="input-prepend">
                        </div>
                        <div class="clearfix"></div>
    
                        <p class="text-center tbpaddingdiv2">
                            <input type="button" class="btn btn-primary" value="Reset Password" onClick="updatepasswd()" >
							
                        </p>
                    </fieldset>
					<div class="alert text-center" style="font-style: bold; color: blue">
					<a href="index.php" >
                     Sign in
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
    
</body>
</html>
<script>


function resetpasswd()
{
	var email = document.getElementById('txtemail').value;
    if(email=="")
	{
		alert("Please enter office email id");
		return;
	}		
	
	var dataString = "action=resetPassword&email="+email;
	$.ajax({ 
		type: "POST",url: "ajaxLogin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				document.getElementById('block1').style.display="none";
				document.getElementById('block2').style.display="block";				
			}
			else{
				alert(dobj.msg);
				//location.reload();
			}
		} 
	});
		
}

function updatepasswd()
{
	var email = document.getElementById('txtemail').value;
	var passwdotp = document.getElementById('passwdotp').value;
	var passwd1 = document.getElementById('passwd1').value;
	var passwd2 = document.getElementById('passwd2').value;
	if(passwdotp == "")
	{
		alert("Add OTP, which is sent to your email.");
		return;
	}
	
	if(passwd1 == "")
	{
		alert("Add New Password...");
		return;
	}
	
	if(passwd2 == "")
	{
		alert("Add Retype Password...");
		return;
	}
	if(passwd1 != passwd2)
	{
		alert("Password mismatch...");
		return;
	}
	
	//alert("SUCCESS");
	var dataString = "action=updatePassword&otp="+passwdotp+"&passwd="+passwd1+"&email="+email;
	$.ajax({ 
		type: "POST",url: "ajaxLogin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				alert(dobj.msg);
				window.location.href = "index.php";				
			}
			else if(dobj.status==2)
			{
				alert(dobj.msg);
				document.getElementById('passwdotp').value="";
			}
			else{
				alert(dobj.msg);
				document.getElementById('passwdotp').value="";
			}
		} 
	});
	
	
	
}	
	


</script>