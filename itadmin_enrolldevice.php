<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/ITAdminMgmt.php';
	$dbobj = new ITAdminMgmt();
	$dbobj->connect();
	
	$deviceType_array = $dbobj->getAllDeviceType();
	$today = date("d-m-Y");	
		
	$iv = $_REQUEST['iv'];
	$device = $_REQUEST['device'];
	
	$device_input = $eid = trim($dbobj->get_mcrypt_decrypt($device,$iv));
	
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
					<li>Enroll IT Device</li>
					</ol>

				</div>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<!-- end PAGE TITLE AREA -->
	   
	   <!--main_heading_div-->
		<!--search_filed_div-->
		
		<!--end_search_field_div-->
		<!-- /.row -->
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4> Enroll IT Device </h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="newdata" id="newdata" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
																						
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Device Type :</span>
											<select id="device" name="device" class="form-control" onchange="loadITDevicesList();" >
											<option value="0">All Device</option>
											<?php
											foreach($deviceType_array as $val)
											{
												if($device_input == $val->id)
													echo '<option selected value="'.$val->id.'">'.$val->name.'</option>';
												else										
													echo '<option value="'.$val->id.'">'.$val->name.'</option>';
											}			
											?>		
											</select>
											</div>
											
											
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">Service :</span>
											<input type="text" readOnly name="service" id="service" class="form-control" value="" >
											</div>
											
											
											
											
										</div>
										
										
										<div class="col-md-6">
																						
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Device Id :</span>
											<select id="device_id" name="device_id" class="form-control" onchange="loadITDevicesService();" >
											</select>
											</div>
											
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">Status :</span>
											<input type="text" readOnly name="status" id="status" class="form-control" value="" >
											</div>
											
											
										</div>
										
										
										<div class="clearfix"></div>
									</div>
									
									<div class="col-lg-12" id="div_add" style="padding-top:30px;"  >
							<div class="bpaddingdiv1 text-center">
							<input type="button" name="register1" id="register1" class="btn btn-green btn-md" value="Enroll" onClick="enrollDevice();">
							</div>
							</div>
													
									
									
														
									<div class="clearfix"></div>
									<!--end_total_employee_div-->
												
									
									
												
									
									
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	<input type="hidden" name="hdevice" id="hdevice"  value="" >
						
							
					
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



<script>


window.onload = function() {
	
	loadITDevicesList();
		
};
	
function loadITDevicesList()
{
	var device = document.getElementById('device').value;
	
	var dataString = "action=getNewDeviceList&device="+device;
	//alert(dataString);
	$.ajax({ 
	type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		if(dobj.status==1)
		{
			$("#device_id").html(dobj.data);
		}
		else{
		}
	} 
	});
	
	
}	

function loadITDevicesService()
{
	
	var dbid = document.getElementById('device_id').value;
	var service = document.getElementById('service');
	var status = document.getElementById('status');
	
	var dataString = "action=getDeviceDetails&dbid="+dbid;
	//alert(dataString);
	$.ajax({ 
	type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		if(dobj.status==1)
		{
			service.value = dobj.service_str;
			status.value = dobj.status_str;
		}
		else{
			service.value = "";
			status.value = "";
		}
	} 
	});
	
}

function enrollDevice()
{
	var dbid = document.getElementById('device_id').value;
	if(dbid == 0)
	{
		alert("Please select a device from list...");
		return false;
	}
	
	var dataString = "action=enrollDevice&dbid="+dbid;
	//alert(dataString);
	$.ajax({ 
	type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		alert(dobj.msg);
		if(dobj.status==1)
		{
			window.location.reload();	
		}
		else{
			
		}
	} 
	});
	
	
}



</script>