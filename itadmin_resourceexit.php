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
	
	$empList = $dbobj->getReleaseResourceList();
	
	
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
					<li>Resource Exit</li>
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
									<h4> Resource Exit Process </h4>
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
										<div class="col-md-12" >
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right" style="width:153px;">Select Resource :</span>
										<select id="reso_id" name="reso_id" class="form-control"  onChange="checkExitStatus()">
										<option selected value="0" >Select Resource</option>
										<?php foreach($empList as $emp){ 
										?>
										<option value="<?php echo $emp->eid; ?>" > [<?php echo $emp->eid; ?>]: <?php echo $emp->name; ?></option>
										<?php } ?>
										</select>
										</div>
										</div>
										
										
										<div class="clearfix"></div>
									</div>
									
									
									<div class="totalaligndiv">
									<!--1st_div-->
									
																		
									
									<div class="col-md-12" id="device_block" style="display:none">
									
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px" >Emp. Name :</span>
									<input type="text" readOnly id="emp_name"  name="emp_name" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px">Emp. Id :</span>
									<input type="text" readOnly id="emp_id" name="emp_id" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px">Emp. Type :</span>
									<input type="text" readOnly id="emp_type" name="emp_type" class="form-control" placeholder="" value="">
									</div>
									</div>
																	
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px" >Current Status :</span>
									<input type="text" readOnly id="emp_status" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px">Joining Date :</span>
									<input type="text" readOnly id="emp_doj" class="form-control" placeholder="" value="">
									</div>
									</div>
											


									<div class="col-md-4" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px;">Device Deallocate :</span>
									<select disabled id="dev_deallocate" name="dev_deallocate" class="form-control"  >
									<option value="0" >NO</option>
									<option value="1" >YES</option>
									</select>
									</div>
									</div>

									
									<div class="col-md-4" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px;">All Devices Received :</span>
									<select id="dev_receiecd" name="dev_receiecd" class="form-control"  >
									<option value="0" >NO</option>
									<option value="1" >YES</option>
									</select>
									</div>
									</div>

									<div class="col-md-4" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px;">Email Deleted :</span>
									<select id="email_delete" name="email_delete" class="form-control"  >
									<option value="0" >NO</option>
									<option value="1" >YES</option>
									</select>
									</div>
									</div>

									<div class="col-md-4" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px;">Matrix Acess Deleted :</span>
									<select id="matric_acess" name="matric_acess" class="form-control"  >
									<option value="0" >NO</option>
									<option value="1" >YES</option>
									</select>
									</div>
									</div>

									<div class="col-md-4" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px;">ID card & Key Received :</span>
									<select id="admin_data" name="admin_data" class="form-control"  >
									<option value="0" >NO</option>
									<option value="1" >YES</option>
									</select>
									</div>
									</div>		
									
									
									
									
									
									</div>
									
									
									
									
										
										
										
									
									<input type="hidden" id="heid" name="heid" value="">
									<input type="hidden" id="hid" name="hid" value="">
									<input type="hidden" id="htype" name="htype" value="">

									
										
									<!--end_3rd_div-->
									<div class="clearfix"></div>
									
									<div class="col-lg-12" style="padding-top:50px;display:none" id="update_btn">
									<div class="bpaddingdiv1 text-center">
									<input type="button" class="btn btn-green btn" value="Update" onClick="updateITExitInfo();">
									</div>
									</div>
									
									<div class="clearfix"></div>
									
									
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
	
	//loadITDevices();
		
};


function checkExitStatus()
{
	var reso_id = document.getElementById('reso_id').value;
	var emp_data_block = document.getElementById( 'device_block');
	var update_btn = document.getElementById( 'update_btn');
	
	var dataString = "action=checkEmpExitStatus&eid="+reso_id;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				emp_data_block.style.display = "block";	
				update_btn.style.display = "none";
				document.getElementById("dev_deallocate").disabled = true;
				document.getElementById("dev_receiecd").disabled = true;
				document.getElementById("email_delete").disabled = true;
				document.getElementById("matric_acess").disabled = true;
				document.getElementById("admin_data").disabled = true;				
				
				for(i=0;i<document.getElementById("dev_deallocate").length;i++){
					if(document.getElementById("dev_deallocate").options[i].value== 1){
						document.getElementById("dev_deallocate").options[i].selected=true;
						break;
					}
				}
				
				for(i=0;i<document.getElementById("dev_receiecd").length;i++){
					if(document.getElementById("dev_receiecd").options[i].value==1){
						document.getElementById("dev_receiecd").options[i].selected=true;
						break;
					}
				}
				
				for(i=0;i<document.getElementById("email_delete").length;i++){
					if(document.getElementById("email_delete").options[i].value==1){
						document.getElementById("email_delete").options[i].selected=true;
						break;
					}
				}
				
				for(i=0;i<document.getElementById("matric_acess").length;i++){
					if(document.getElementById("matric_acess").options[i].value==1){
						document.getElementById("matric_acess").options[i].selected=true;
						break;
					}
				}
				
				for(i=0;i<document.getElementById("admin_data").length;i++){
					if(document.getElementById("admin_data").options[i].value==1){
						document.getElementById("admin_data").options[i].selected=true;
						break;
					}
				}
			
			}
			else{
				loadResoInfo();
			}
		} 
	});
	
	
	
	var dataString = "act=getemployeedata&eid="+reso_id;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				//$("#DATAFIELD").html(dobj.data);
				emp_name.value = dobj.emp_name;
				emp_id.value = dobj.emp_id;
				emp_status.value = dobj.emp_status;
				emp_doj.value = dobj.emp_doj;
				emp_type.value = dobj.emptype_str;
				heid.value = dobj.emp_id;
				hid.value = dobj.db_id;	
				htype.value = dobj.db_type;
			
			}
			else{
				//alert(dobj.msg);
				//location.reload();
			}
		} 
	});
	
	
}
	
function loadResoInfo()
{
	var reso_id = document.getElementById('reso_id').value;
		
	var emp_data_block = document.getElementById( 'device_block');
	var update_btn = document.getElementById( 'update_btn');
	
	var emp_name = document.getElementById('emp_name');
	var emp_id = document.getElementById('emp_id');
	var emp_type = document.getElementById('emp_type');
	var emp_status = document.getElementById('emp_status');
	var emp_doj = document.getElementById('emp_doj');
	var heid = document.getElementById('heid');
	var hid = document.getElementById('hid');
	var htype = document.getElementById('htype');
	var dev_deallocate = document.getElementById('dev_deallocate');
		
	document.getElementById("dev_deallocate").disabled = true;
	document.getElementById("dev_receiecd").disabled = false;
	document.getElementById("email_delete").disabled = false;
	document.getElementById("matric_acess").disabled = false;
	document.getElementById("admin_data").disabled = false;	
	
	for(i=0;i<document.getElementById("dev_deallocate").length;i++){
		if(document.getElementById("dev_deallocate").options[i].value== 0){
			document.getElementById("dev_deallocate").options[i].selected=true;
			break;
		}
	}
				
	for(i=0;i<document.getElementById("dev_receiecd").length;i++){
		if(document.getElementById("dev_receiecd").options[i].value==0){
			document.getElementById("dev_receiecd").options[i].selected=true;
			break;
		}
	}
				
	for(i=0;i<document.getElementById("email_delete").length;i++){
		if(document.getElementById("email_delete").options[i].value==0){
			document.getElementById("email_delete").options[i].selected=true;
			break;
		}
	}
				
	for(i=0;i<document.getElementById("admin_data").length;i++){
		if(document.getElementById("admin_data").options[i].value==0){
			document.getElementById("admin_data").options[i].selected=true;
			break;
		}
	}
	
	
	emp_data_block.style.display = "block";	
	update_btn.style.display = "block";	
	
	var dataString = "action=getDeallocationStatus&eid="+reso_id;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			//alert("::"+dobj.status);
			if(dobj.status==1)
			{
				for(i=0;i<document.getElementById("dev_deallocate").length;i++){
					if(document.getElementById("dev_deallocate").options[i].value==dobj.count){
						document.getElementById("dev_deallocate").options[i].selected=true;
						break;
					}
				}
			}
			else{
				//alert(dobj.msg);
				//location.reload();
			}
		} 
	});
	
	
}	

function updateITExitInfo()
{
	var dev_deallocate = document.getElementById('dev_deallocate').value;
	var dev_receiecd = document.getElementById('dev_receiecd').value;
	var email_delete = document.getElementById('email_delete').value;
	var matric_acess = document.getElementById('matric_acess').value;
	var admin_data = document.getElementById('admin_data').value;
	var reso_id = document.getElementById('reso_id').value;
	//dev_deallocate = 1;
	if(dev_deallocate == 0)
	{
		alert("Please deallocate all devices.");
		return;
	}
	if(dev_receiecd == 0)
	{
		alert("Please collect all devices.");
		return;
	}
	if(email_delete == 0)
	{
		alert("Please delete office email.");
		return;
	}
	if(matric_acess == 0)
	{
		alert("Please remove Matrix Access.");
		return;
	}
	if(admin_data == 0)
	{
		alert("Please collect Office ID card and keys...");
		return;
	}
	
	updateITExit(reso_id);
		
}


function updateITExit(eid)
{
	var dataString = "action=updateITExit&eid="+eid;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			//alert("::"+dobj.status);
			if(dobj.status==1)
			{
				updateAdminExit(eid);
				//window.location.reload();	
			}
			else{
				
			}
		} 
	});
}

function updateAdminExit(eid)
{
	var dataString = "action=updateAdminExit&eid="+eid;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			//alert("::"+dobj.status);
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