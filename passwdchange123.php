<?php 
	//set_time_limit(1);
ini_set("display_errors",1);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();

	$emp_name	= $_SESSION["emp_name"];
	$emp_id = 	$_SESSION["emp_id"];
	
?>
<?php include 'include/header_passwd.php' ?>
<?php include 'include/leftsidebar_simple.php' ?>
<div id="page-wrapper">
	<div class="page-content">
		<!-- begin PAGE TITLE AREA -->
		<!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
		<div class="row">
			<div class="col-lg-12">
				<div class="page-title">
					
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-dashboard"></i> Password Change</li>
					</ol>
				</div>
				
				<div class="clearfix"></div>
				
				<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data"  >
                <div class="row" id="load_subadmin">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> Password Change</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#manageadmin"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="manageadmin" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->
                                    <div class="totalaligndiv">
									
									<div class="col-md-12  text-center">
                                    <div class="input-group bmargindiv1 col-md-6">
                                    <span class="input-group-addon ndrftextwidth text-left">New Password :</span>
                                    <input type="password"  name="password1" id="password1" class="form-control tcal" placeholder="">
                                    </div>
                                    </div>
									 
									<div class="col-md-12  text-center">
                                    <div class="input-group bmargindiv1 col-md-6 text-center">
                                    <span class="input-group-addon ndrftextwidth text-left">Retype New Password :</span>
                                    <input type="password" name="password2" id="password2" class="form-control tcal" placeholder="">
                                    </div>
                                    </div>
									                                                                                         
                                 
                                            
                                     </div>
									
																			
										
										 <div class="clearfix"></div>
										  
										
										<input type="hidden" name="eid" id="eid" value="<?php echo $emp_id; ?>" />
										<input type="hidden" name="hideditid" id="hideditid" value="" />
										
										
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="tpaddingdiv1 text-center">
                                                <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return savePasswordData()">Change Password</button>
												 												 
												 
                                            </div>
											
											
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!--end_total_left_side_div-->
                                </div>
                            </div>                            
                        </div>
                    <!--end_left_div-->
                  </div>
                  <div class="clearfix"></div>
                </div> <!-- end_row_div -->
                </form>
					
					
														
														
				
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<!-- end PAGE TITLE AREA -->

		<!--show_employee_div-->
		
		<!--end_show_employee_div-->
		
		<!-- /.row -->

		

	</div>
	<!-- /.page-content -->
</div>



    
<?php include 'include/footer.php' ?>

<script type="text/javascript">


window.onload = function () { 
		checkAlertMessages();
    }

function savePasswordData()
{
	var eid = document.getElementById('eid').value; 
	var passwd1 = document.getElementById('password1').value; 
	var passwd2 = document.getElementById('password2').value;
	if(passwd1.length < 8)
	{
		alert("New password length must be greater than 8 characters");
		return false;	
	}		
	if(passwd1 != passwd2)
	{
		alert("Password mismatch");
		return false;
	}
	
	var dataString = "action=passwdchange&passwd="+passwd1+"&eid="+eid;
	//alert(""+dataString);
	$.ajax({ 
	type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
	success: function(html)
	{ 
		var dobj=jQuery.parseJSON(html);
		if(dobj.status==1)
		{
			alert("Done");
			window.location = 'dashboard.php';
			
		}
		
	} 
	});
	
}	

function checkAlertMessages(){

		var forceno = document.getElementById('forceid').value; 
		//alert("ForceNo:"+forceno);
		var dataString = "type=getdata&forceno="+forceno;
		//alert(""+dataString);
		$.ajax({ 
		type: "POST",url: "ajaxCheckAlerts.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			var alertmessage=1;
			var  value = parseInt(html);
			//alert(""+value);
			if(value > 0)
				$("#alertid").trigger('click');
		} 
		});
}

function checkBoxEvent(id){
	//alert("::"+id);
	 	var value = document.getElementById("checkbox1").checked;
		if(value)
			document.getElementById('okbutton').disabled = false;
		else
			document.getElementById('okbutton').disabled = true;
	}
	
function logout(){
			//alert("logout");
		 	location.href = 'logout.php';
	}
	
function updateMessage(){
	
		document.getElementById('modalid').value=0;;
		var forceno = document.getElementById('forceid').value; 
		var dataString = "type=updatedata&forceno="+forceno;
		$.ajax({ 
		type: "POST",url: "ajaxCheckAlerts.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			
		} 
		});
	
	}	


</script>