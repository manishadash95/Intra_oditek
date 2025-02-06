<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();

	//$session_rank = $_SESSION["admin_rank"];
	
	$readonly = "readonly";
	$disabled = "disabled";
		
	$eid = $_REQUEST['eid'];
	$iv = $_REQUEST['iv'];
	$eid = trim($dbobj->get_mcrypt_decrypt($eid,$iv));

	$employee = $dbobj->getEmployeeData($eid);

	$designation_array = $dbobj->getDesignation();
	$department_array = $dbobj->getDepartment();

	$emp_id = 	$_SESSION["emp_id"];
	$obj_emp = $dbobj->getEmployeeAccess($emp_id);
	
	
	if($obj_emp->type == 2 && $obj_emp->itadmin == 1)
	{
		$it_access=1;
	}
	
	if($emp_id == 1001)
		$it_access=1;
	

	
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
						<li><i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
						</li>
						<li class="active">View Employee Details</li>
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		<a href="viewemployee.php" >
			<input type="button" class="btn btn-md btn-red " value="Back" style="height:40px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
			</a>
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4><i class="fa fa-exchange fa-fw"></i> View Employee Info </h4>
								</div>
								<div class="portlet-widgets">
									<a data-toggle="collapse" data-parent="#accordion" href="#transactionsPortlet"><i class="fa fa-chevron-down"></i></a>
								</div>
								<div class="clearfix"></div>
							</div>
					<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-5">
										
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Name :</span>
												<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->name ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Gender :</span>
												<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->gender ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Blood Group :</span>
													<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->blood_grp ?>">
											</div>
											
											                                          							
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Mobile No :</span>
												<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->mobile ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Emergency No :</span>
												<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->emergency ?>" >
											</div>

											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Email Id :</span>
											<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->email ?>">
											</div>	
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Joining :</span>
												<input <?php echo $disabled;?> type="text" readonly class="form-control" value="<?php echo $employee->joining_date ?>" >
											</div>
											

											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Skype Id :</span>
											<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->skype_id ?>" >
											</div>						
											
											
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-5">
										
											 <div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Designation :</span>
											<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->desig_name ?>">	
											</div>
																						
                                            <div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Office Email Id :</span>
											<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->office_email ?>">
											</div>					
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Report To :</span>
											<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->report_to ?>">	
											</div>
                                            
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">BU/Department :</span>
											<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->bu_name." / ".$employee->dept_name ?>">		
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Project Grp :</span>
											<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->pro_grp_name; ?>">		
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Project Head :</span>
											<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->pro_grp_head_name; ?>">		
											</div>
												
											
											
                                            
											
											
										</div>
										<!--end_2nd_div-->
										<!--3rd_div-->
										<div class="col-md-2">
											<div class="bpaddingdiv1 text-center">
											
											<?php if(strlen($employee->image) > 0 ) {  $img_path = $employee->image; ?>
											<img src="<?php echo $img_path; ?>" id="bigimage1" name="Employee Photo" border="0" width="140" height="160" style="border:#666 1px solid">
											<?php }else{ ?>			
											<img src="img/noimage.gif" id="bigimage1" name="Employee Photo" border="0" width="140" height="160" style="border:#666 1px solid">
											<?php } ?>
											
											</div>
											<div class="bpaddingdiv1 text-center">
												<div class="bpaddingdiv1">
                                                <input type="hidden" id="hdfilename" name="hdfilename" value="">
												<?php if($session_rank == 1) {?>
                                              	<div class="browse" style="width:40px; height:40px;cursor:pointer;">
            								  	<div class="placeholder">
                								<img src="img/upload.png" width="40" height="40" alt="" style="cursor:pointer;" />
           										</div>  
                                                <input type="file" id="btnupload" name="btnupload" class="form-control" onChange="updateImage()" >	
                                                </div>
												<?php } ?>
                                             	</div>
											</div>
										</div>
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									<!--end_total_employee_div-->
									<!--login_informations_div-->
									
									<?php if( $it_access && $employee->itr == 1 ){?>
									
									<!--Access_informations_div-->
									<div class="col-lg-12">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4> IT Information</h4>
												</div>
												<div class="portlet-widgets">
													<a data-toggle="collapse" data-parent="#accordion" href="#logininformation"></a>
												</div>
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
												<div class="portlet-body">
													
													
													
													
												<div class="col-md-6">
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Office Email</span>
												<input <?php echo $disabled;?> type="text" class="form-control" value="<?php echo $employee->office_email ?>">
												</div>
												</div>
												
												<div class="col-md-6">
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Password :</span>
												<input type="text" class="form-control"  id="emailpasswd" name="emailpasswd" value="">
												</div>
												</div>
																								
												
												<div class="clearfix"></div>
												</div>
												
									
									
											</div>
											<div class="clearfix"></div>
											
												
												
										</div>
										
										<div class="col-lg-12">
												<div class="bpaddingdiv1 text-center">
												<input type="hidden"   id="heid" name="heid" value="<?php echo $employee->eid; ?>">
												<input type="text" name="register" id="register" class="btn btn-green btn-lg" value="Update" onClick="updatePasswd()" >
												</div>
												</div>
									</div>
									
									<?php } ?>
									
									<!--end_netpay_information_div-->
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	
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

function checkValidation()
{
	var passwd = document.getElementById('emailpasswd').value;
	if(passwd == "")
	{	
		alert("Add Office EMail Password");
		return false;
	}
	
	return true;
}

function updatePasswd()
{
	var ret = checkValidation();
	if(!ret)
		return;
	
	var passwd = document.getElementById('emailpasswd').value;
	var eid = document.getElementById('heid').value;
	
	var dataString = "action=updateOfficeEmailPasswd&eid="+eid+"&passwd="+passwd;
	//alert("dataString:"+dataString);		
    $.ajax({ 
	type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		if(dobj.status==1)
		{
			alert(dobj.msg);
			location.reload();
		}
		else{
			alert(dobj.msg);
		}
		//document.getElementById('loading_data').style.display="none";
	} 
   });
	
}


messagestatus2(<?php echo $msg.$employeeid ?> );
</script>

