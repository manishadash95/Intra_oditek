<?php 

	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/ITAdminMgmt.php';
	$dbobj = new ITAdminMgmt();
	$dbobj->connect();
	
	$eid = $_SESSION["emp_id"];
	$deviceType_array = $dbobj->getAllDeviceType();
	$today = date("d-m-Y");	
		
	$iv = $_REQUEST['iv'];
	$device = $_REQUEST['device'];
	
	$device_input = trim($dbobj->get_mcrypt_decrypt($device,$iv));
	$empData = $dbobj->getEmployeeData($eid);	
	//echo "::".$eid;
	//exit();
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
						<li class="active">View My Profile</li>
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		
		<?php echo $msg1111;?>
		<div class="row">
		
					<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
							
							
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="portlet portlet-blue">
									<div class="portlet-heading">
									<div class="portlet-title toplistviewtab">
									<ul id="myTab111" class="nav nav-tabs" style="margin-bottom:0px; border-bottom:0px">
									<li class="active"><a href="#basic1" data-toggle="tab">Basic Info</a></li>
									<li><a href="#family1" data-toggle="tab">Family Info</a></li>
									<li><a href="#education1" data-toggle="tab">Education Info</a></li>
									<li><a href="#pastexp1" data-toggle="tab">Past Exp. Info</a></li>
									<li><a href="#empinfo1" data-toggle="tab">Employee Info</a></li>
									<li><a href="#buinfo1" data-toggle="tab">BU Info</a></li>
									<li><a href="#changepswd1" data-toggle="tab">Change Password</a></li>
									<li><a href="#imgupload1" data-toggle="tab">Image Upload</a></li>
									<li><a href="#allocate1" data-toggle="tab">My Allocated Device</a></li>
									
									
									</ul>
									</div>
									<div class="clearfix"></div>
									</div>
					
					
					<div class="portlet-body">
						
						<div id="myTabContent1" class="tab-content">
							
							<div class="tab-pane fade in active" id="basic1">
							<?php include_once 'viewmyprofile_basic.php'; ?>			
							</div>
							
							<div class="tab-pane fade" id="family1">
							<?php include_once 'viewemployee_family.php'; ?>
							</div>
							
							<div class="tab-pane fade" id="education1">
							<?php include_once 'viewemployee_education.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="pastexp1">
							<?php include_once 'viewemployee_pexp.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="empinfo1">
							<?php include_once 'viewemployee_office.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="buinfo1">
							<?php include_once 'viewemployee_bu.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="changepswd1">
							<?php include_once 'viewemployee_cpsw.php'; ?>	
							</div>
							
							
							<div class="tab-pane fade" id="imgupload1">
                               <?php include_once 'viewemployee_imagupload.php'; ?>
                                </div>
							
							<div class="tab-pane fade" id="allocate1">
							<?php include_once 'viewemployee_allocatedevice.php'; ?>	
							</div>
							
							

							
							
							</div>
							
						</div>
					</div>

				</div>
						
					</div>
                      		<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        
							</form>
						</div>
					
<?php include 'include/footer.php' ?>


<script>




window.onload = function() {
	
	loadITallocateDevices();
		
};
	
function loadITallocateDevices()
{
	
	var device = document.getElementById('device').value;
	//alert("::"+device);
	var dataString = "action=loadMyITallocateDevices&device="+device;
	//alert(dataString);
	$.ajax({ 
	type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		//alert("::"+dobj.status);
		if(dobj.status==1)
		{
			$("#DATAFIELD").html(dobj.data);
		}
		else{
			alert(dobj.msg);	
		}
	} 
	});
	
	
}	


</script>
