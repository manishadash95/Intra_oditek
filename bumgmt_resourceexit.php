<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/ITAdminMgmt.php';
	$dbobj = new ITAdminMgmt();
	$dbobj->connect();
	
	$my_eid = $_SESSION["emp_id"];
	
	$deviceType_array = $dbobj->getAllDeviceType();
	$today = date("d-m-Y");	
		
	$iv = $_REQUEST['iv'];
	$device = $_REQUEST['device'];
	
	$device_input = $eid = trim($dbobj->get_mcrypt_decrypt($device,$iv));
	if($dbobj->isAdmin($my_eid))
		$empList = $dbobj->getReleaseResourceList();
	else
		$empList = $dbobj->getBUReleaseResourceList();
	
	
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
					<li>BU Resource Exit</li>
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
									
									</div>

									
									<div class="col-md-6" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:300px;">All Assigned Task Done :</span>
									<select id="task_assign" name="task_assign" class="form-control"  >
									<option value="0" >NO</option>
									<option value="1" >YES</option>
								    </select>
									</div>
									</div>

									<div class="col-md-6" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:300px;">Knowledge Transfer Done:</span>
									<select id="kt" name="kt" class="form-control"  >
									<option value="0" >NO</option>
									<option value="1" >YES</option>
									</select>
									</div>
									</div>

									<div class="col-md-6" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:300px;">Access to Git/Repository  deleted :</span>
									<select id="git_acess" name="git_acess" class="form-control"  >
									<option value="0" >NO</option>
									<option value="1" >YES</option>
									</select>
									</div>
									</div>

									<div class="col-md-6" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:300px;">All credential removed :</span>
									<select id="credential_data" name="credential_data" class="form-control"  >
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
									<input type="button" class="btn btn-green btn" value="Update" onClick="updateBUExitInfo();">
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
	
	var dataString = "action=checkEmpBUExitStatus&eid="+reso_id;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			//alert("::"+dobj.status);
			if(dobj.status==1)
			{
				emp_data_block.style.display = "block";	
				update_btn.style.display = "none";
				document.getElementById("task_assign").disabled = true;
				document.getElementById("kt").disabled = true;
				document.getElementById("git_acess").disabled = true;
				document.getElementById("credential_data").disabled = true;
				
				
				for(i=0;i<document.getElementById("task_assign").length;i++){
					if(document.getElementById("task_assign").options[i].value== 1){
						document.getElementById("task_assign").options[i].selected=true;
						break;
					}
				}
				
				for(i=0;i<document.getElementById("kt").length;i++){
					if(document.getElementById("kt").options[i].value==1){
						document.getElementById("kt").options[i].selected=true;
						break;
					}
				}
				
				for(i=0;i<document.getElementById("git_acess").length;i++){
					if(document.getElementById("git_acess").options[i].value==1){
						document.getElementById("git_acess").options[i].selected=true;
						break;
					}
				}
				
				for(i=0;i<document.getElementById("credential_data").length;i++){
					if(document.getElementById("credential_data").options[i].value==1){
						document.getElementById("credential_data").options[i].selected=true;
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
	//var dev_deallocate = document.getElementById('task_assign');
		
	document.getElementById("task_assign").disabled = false;
	document.getElementById("kt").disabled = false;
	document.getElementById("git_acess").disabled = false;
	document.getElementById("credential_data").disabled = false;
	
	for(i=0;i<document.getElementById("task_assign").length;i++){
		if(document.getElementById("task_assign").options[i].value== 0){
			document.getElementById("task_assign").options[i].selected=true;
			break;
		}
	}
				
	for(i=0;i<document.getElementById("kt").length;i++){
		if(document.getElementById("kt").options[i].value==0){
			document.getElementById("kt").options[i].selected=true;
			break;
		}
	}
				
	for(i=0;i<document.getElementById("git_acess").length;i++){
		if(document.getElementById("git_acess").options[i].value==0){
			document.getElementById("git_acess").options[i].selected=true;
			break;
		}
	}
	
	for(i=0;i<document.getElementById("credential_data").length;i++){
		if(document.getElementById("credential_data").options[i].value==0){
			document.getElementById("credential_data").options[i].selected=true;
			break;
		}
	}
	
	
	emp_data_block.style.display = "block";	
	update_btn.style.display = "block";	
	
		
	
}	

function updateBUExitInfo()
{
	var task_assign = document.getElementById('task_assign').value;
	var kt = document.getElementById('kt').value;
	var git_acess = document.getElementById('git_acess').value;
	var credential_data = document.getElementById('credential_data').value;
	var reso_id = document.getElementById('reso_id').value;
	//dev_deallocate = 1;
	if(task_assign == 0)
	{
		alert("Please update 'All Assigned Task Done' field");
		return;
	}
	if(kt == 0)
	{
		alert("Please update 'Knowledge Transfer Done' field");
		return;
	}
	if(git_acess == 0)
	{
		alert("Please update 'Access to Git/Repository deleted' field");
		return;
	}
	if(credential_data == 0)
	{
		alert("Please update 'All credential removed' field");
		return;
	}
		
	updateBUExit(reso_id);
		
}


function updateBUExit(eid)
{
	var dataString = "action=updateBUExit&eid="+eid;
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