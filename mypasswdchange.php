<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	ini_set("display_errors",0);
	$eid = $_SESSION["emp_id"];

	//$_SESSION["pageid"]= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
	
	//$eid = 160701;
	$employee = $dbobj->getEmployeeData($eid);
	
		
	//echo $eid;
	//exit();
	//$employee->type=1;
	
	//$rankobj = $dbobj->getRank();
	//$allname_array = $dbobj->getAllName();
	//$designation_array = $dbobj->getDesignation();
	//$department_array = $dbobj->getDepartment();
	//$employee->name="11111111";
	
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>
<?php include 'imageupload/popimageupload.php' ?>
<div id="page-wrapper">
	<div class="page-content">

		<!-- begin PAGE TITLE AREA -->
		<!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
		<div class="row">
			
														
			<div class="col-lg-12">
				<div class="page-title">
					<ol class="breadcrumb">
						<li class="active">My Password Change</li>
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4> My Password Change </h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						
						
					
					<div class="col-md-12">
					<div class="tpaddingdiv1 text-center">
					<a href="viewmyprofile.php">
					<input type="button" class="btn btn-md btn-red " value="Back" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
					</a>
					</div>
					</div>	
				
					<form class="form-horizontal" method="post" name="frmlogin" id="frmlogin" action="" autocomplete="off">
                    <fieldset>
					
					<div class="col-lg-3">
					
					</div>
					
					<div class="col-lg-6">
					
						<div class="col-md-12  text-center">
                            <div class="input-group bmargindiv1 col-md-12">
                            <span class="input-group-addon ndrftextwidth text-left" style="width: 160px;">Current Password :</span>
                            <input type="password"  name="cpasswd" id="cpasswd" class="form-control" placeholder="">
                            </div>
                        </div>
						
                        <div class="col-md-12  text-center">
                            <div class="input-group bmargindiv1 col-md-12">
                            <span class="input-group-addon ndrftextwidth text-left" style="width: 160px;">New Password :</span>
                            <input type="password"  name="password1" id="password1" class="form-control" placeholder="">
                            </div>
                        </div>
						
						<div class="col-md-12  text-center">
                            <div class="input-group bmargindiv1 col-md-12">
                            <span class="input-group-addon ndrftextwidth text-left" style="width: 160px;">Reenter Password :</span>
                            <input type="text"  name="password2" id="password2" class="form-control" placeholder="">
                            </div>
                        </div>
						<input type="hidden" name="eid" id="eid" value="<?php echo $eid; ?>" />
                        <div class="clearfix"></div><br>
    
                       <div class="clearfix"></div>
    
                        <div class="input-prepend">
                        </div>
                        <div class="clearfix"></div>
						    
                        <p class="text-center tbpaddingdiv2">
                            <input type="button" class="btn btn-primary" value="Change Password" onClick="resetpasswd()" >
							
                        </p>
					
					</div>	
						
                    </fieldset>
					
                </form>
				
				
				
						</div>
					</div>
					<!-- /.col-lg-12 -->

				</div>
			</div>
		</div>

	</div>
	<!-- /.page-content -->

</div>
<?php include 'include/footer.php' ?>
<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee111.js"></script>

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

