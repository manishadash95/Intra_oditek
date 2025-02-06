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
					<li>HR Resource Exit</li>
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
									<h4> HR Resource Exit Process </h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="editdata" id="editdata" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-12" >
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right" style="width:153px;">Select Resource :</span>
										<select id="reso_id" name="reso_id" class="form-control"  onChange="loadResoInfo()">
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
									
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px">BU Exit Process :</span>
									<select disabled id="bu_exit" name="bu_exit" class="form-control"  >
									<option value="0" >Not Done</option>
									<option value="1" >Done</option>
									</select>
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px">IT Exit Process :</span>
									<select disabled id="it_exit" name="it_exit" class="form-control"  >
									<option value="0" >Not Done</option>
									<option value="1" >Done</option>
									</select>
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px">Admin Exit Process :</span>
									<select disabled id="admin_exit" name="admin_exit" class="form-control"  >
									<option value="0" >Not Done</option>
									<option value="1" >Done</option>
									</select>
									</div>
									</div>
									
									
									<div class="col-md-4" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px;">HR Exit Process :</span>
									<select id="hr_exit" name="hr_exit" class="form-control"  >
									<option value="0" >Not Done</option>
									<option value="1" >Done</option>
									</select>
									</div>
									</div>
									
									<div class="col-md-4" >		
									<div class="input-group bmargindiv1 col-md-12">
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px;" >Exit Date:</span>
									<input type="date" name="exit_date" id="exit_date" class="form-control tcal" placeholder="Date of Exit">
									</div>
									</div>
									
									<div class="col-md-12" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right" style="width:180px;" >Info :</span>
									<textarea id="info" class="form-control" maxlength="1000" rows="8" name="info" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
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
									<input type="button" class="btn btn-green btn" value="Update" onClick="updateHRExitProcess();">
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
	var exit_date = document.getElementById('exit_date');
		
	exit_date.value = new Date().toISOString().split('T')[0];
	
	var dataString = "act=getemployeedata&eid="+reso_id;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			//alert(dobj.emptype_str);
			if(dobj.status==1)
			{
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
				
			}
		} 
	});
	
	
	emp_data_block.style.display = "block";	
	update_btn.style.display = "block";	
	
	var dataString = "act=getEmpExitStatus&eid="+reso_id;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			//alert("::"+dobj.status);
			if(dobj.status==1)
			{
				
				for(i=0;i<document.getElementById("bu_exit").length;i++){
					if(document.getElementById("bu_exit").options[i].value==dobj.bu_exit){
						document.getElementById("bu_exit").options[i].selected=true;
						break;
					}
				}
				
				for(i=0;i<document.getElementById("it_exit").length;i++){
					if(document.getElementById("it_exit").options[i].value==dobj.it_exit){
						document.getElementById("it_exit").options[i].selected=true;
						break;
					}
				}
				
				for(i=0;i<document.getElementById("admin_exit").length;i++){
					if(document.getElementById("admin_exit").options[i].value==dobj.admin_exit){
						document.getElementById("admin_exit").options[i].selected=true;
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

function updateHRExitProcess()
{
	
	var emp_name = document.getElementById('emp_name').value;
	var bu_exit = document.getElementById('bu_exit').value;
	var it_exit = document.getElementById('it_exit').value;
	var admin_exit = document.getElementById('admin_exit').value;
	var hr_exit = document.getElementById('hr_exit').value;
	var exit_date = document.getElementById('exit_date').value;
	var info = document.getElementById('info').value;
	var reso_id = document.getElementById('reso_id').value;
	//dev_deallocate = 1;
	if(bu_exit == 0)
	{
		alert("BU Exit Process is not done.");
		return;
	}
	if(it_exit == 0)
	{
		alert("IT Exit Process is not done.");
		return;
	}
	if(admin_exit == 0)
	{
		alert("Admin Exit Process is not done.");
		return;
	}
	if(hr_exit == 0)
	{
		alert("HR Exit Process is not done.");
		return;
	}
	if(exit_date == "")
	{
		alert("Please select Exit Date");
		return;
	}
	if(info == "")
	{
		alert("Please add info.");
		return;
	}
	
	if(confirm("Are you sure want to complete exit process of \""+emp_name+"\" ?"))
	{
		var dataString = "act=completeExitProcess&";
		dataString +=$( "#editdata" ).serialize();
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
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
	
		
}





</script>