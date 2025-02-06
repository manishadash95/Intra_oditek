<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
	$allname_array = $dbobj->getAllNameWithBoard();
	$allbu_array = $dbobj->getAllBU();
	$designation_array = $dbobj->getDesignation();
	$department_array = $dbobj->getDepartment();
	$emptype_array = $dbobj->getAllEmpType();

	$today = date("d-m-Y");	
	
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
					<li>Add Employee</li>
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
									<h4> Add New Employee </h4>
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
										<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Name :</span>
												<input type="text" name="name_first" id="name_first" class="form-control" placeholder="Employee Name" >
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Gender :</span>
													<select id="gender" name="gender" class="form-control" >
														<option value="0">Select Gender</option>
														<option value="1">Male</option>
														<option value="2">Female</option>		
													</select>
											</div>
											
											
											
											
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Birth :</span>
												<input type="date" name="date_of_birth" id="date_of_birth" class="form-control tcal" placeholder="Date of Birth">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Blood Group :</span>
													<select id="blood_grp" name="blood_grp" class="form-control" >
														<option value="0">Select Group</option>
														<option value="A+">A+</option>
														<option value="A-">A-</option>
														<option value="B+">B+</option>
														<option value="B-">B-</option>
														<option value="O+">O+</option>
														<option value="O-">O-</option>
														<option value="AB+">AB+</option>
														<option value="AB-">AB-</option>		
													</select>
											</div>
											
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Mobile No :</span>
												<input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No" maxlength="10">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Email Id :</span>
											<input type="text" name="email1" id="email1" class="form-control" placeholder="Email id" >
											</div>
											
											
											
											
											
										
											
											
											
											
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-6">
											
											 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Join :</span>
												<input type="date" name="oditek_joining_date" id="oditek_joining_date" class="form-control tcal" placeholder="Date of Join">
											</div>		
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Marriage Status :</span>
													<select id="mrg_status" name="mrg_status" class="form-control" >
														<option value="0">Select</option>
														<option value="1">Unmarried</option>
														<option value="2">Married</option>
													</select>
											</div>	

											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Skype Id :</span>
											<input type="text" name="skype" id="skype" class="form-control" placeholder="Skype id" >
											</div>	
 											
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">PAN No :</span>
												<input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="PAN No" maxlength="10">
											</div>
											
											 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Passport No :</span>
												<input type="text" name="passport_no" id="passport_no" class="form-control" placeholder="Passport No" >
											</div>
											
											 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Aadhar No :</span>
												<input type="text" name="aadhar_no" id="aadhar_no" class="form-control" placeholder="Aadhar No" >
											</div>											
                                            
                                           
											
											
										</div>
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									<!--end_total_employee_div-->
									
									<div class="col-lg-12">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4>Family Info</h4>
												</div>
												
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
												<div class="portlet-body">
													
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Father's Name :</span>
											<input type="text" name="fname" id="fname" class="form-control" placeholder="Father Name" >
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Mother's Name :</span>
											<input type="text" name="mname" id="mname" class="form-control" placeholder="Mother Name" >
											</div>
											</div>
											
											
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Address :</span>
											<textarea id="addr1" class="form-control" maxlength="1000" rows="4" name="addr1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
											</div>
											</div>
														
											
											<div class="clearfix"></div>
											</div>
											</div>
										</div>
									</div>
									
									
									
									<div class="col-lg-12">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4>Emergency Info</h4>
												</div>
												
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
												<div class="portlet-body">
													
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Contact Name :</span>
											<input type="text" name="ename" id="ename" class="form-control" placeholder="Emergency person Name" >
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Contact Mobile :</span>
											<input type="text" name="emobile" id="emobile" class="form-control" placeholder="Emergency Mobile" >
											</div>
											</div>
											
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Relationship :</span>
											<input type="text" name="erelationship" id="erelationship" class="form-control" placeholder="Relationship" >
											</div>
											</div>
											
											
											
														
											
											<div class="clearfix"></div>
											</div>
											</div>
										</div>
									</div>
									
									
									
									
																		
									
									
									
									
									<div class="col-lg-12">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4>Education Info</h4>
												</div>
												
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
											
											
											
											<div class="portlet-body">
													
											<div class="col-md-5">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon  text-center">Collage/University</span>
											</div>
											</div>
											
											<div class="col-md-3">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon  text-center">Degree/Diploma</span>
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon text-center">Year</span>
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon  text-center">Percentage :</span>
											</div>
											</div>
											</div>
											
											
											<div class="portlet-body">
											
											
											<div class="col-md-5">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon  text-right">1.</span>
											<input type="text" name="cuname1" id="cuname1" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-3">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<input type="text" name="degree1" id="degree1" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<input type="text" name="eduyear1" id="eduyear1" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<input type="text" name="eduper1" id="eduper1" class="form-control"  >
											</div>
											</div>
											</div>
											
											
											
											
											
											<div class="portlet-body">
													
											<div class="col-md-5">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon  text-right">2.</span>
											<input type="text" name="cuname2" id="cuname2" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-3">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<input type="text" name="degree2" id="degree2" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<input type="text" name="eduyear2" id="eduyear2" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<input type="text" name="eduper2" id="eduper2" class="form-control"  >
											</div>
											</div>
											</div>
											
											
											<div class="portlet-body">
													
											<div class="col-md-5">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon  text-right">3.</span>
											<input type="text" name="cuname3" id="cuname3" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-3">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<input type="text" name="degree3" id="degree3" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<input type="text" name="eduyear3" id="eduyear3" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-2">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<input type="text" name="eduper3" id="eduper3" class="form-control"  >
											</div>
											</div>
														
											
											<div class="clearfix"></div>
											</div>
											
											
											
											
											
											
											
											</div>
											
											
										</div>
									</div>
									
									
									<div class="col-lg-12">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4> Employee Type</h4>
												</div>
												
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
												<div class="portlet-body">
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">Experiance:</span>
											<select id="exp_type" name="exp_type" class="form-control" onchange="actionExperiance()"  >
											<option value="0" >NO</option>
											<option value="1">YES</option>
											</select>
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">Employee Type :</span>
											<select id="employee_type" name="employee_type" class="form-control" onchange="actionEmpType()"  >
											<option value="0" >Select Status</option>
											<?php
											foreach($emptype_array as $val)
											{
											echo '<option value="'.$val->code.'">'.$val->name.'</option>';
											}			
											?>	
											</select>
											</div>
											</div>
														
											<div class="col-md-6" id="probationid" style="display:none" >
											<div class="input-group bmargindiv1 col-md-12" >
											<span class="input-group-addon ndrftextwidth text-right">Probation Period:</span>
											<select id="probation_period" name="probation_period" class="form-control" onchange="checkStatus()"  >
											<option value="0">Select</option>
											<option value="6">6 Months</option>
											<option value="5">5 Months</option>
											<option value="4">4 Months</option>
											<option value="3">3 Months</option>
											<option value="2">2 Months</option>
											</select>
											</div>	
											</div>
											
											<div class="clearfix"></div>
											</div>
											</div>
										</div>
									</div>
									
									
									
									<div class="col-lg-12" id="expe_div" style="display:none;">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4> Previous Experiance</h4>
												</div>
												
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
											<div class="portlet-body">
													
											<div class="col-md-3">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">Year:</span>
											<input type="text" name="exp_yr" id="exp_yr" class="form-control"  >
											</div>
											</div>
											
											
											<div class="col-md-3">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">Month:</span>
											<input type="text" name="exp_mn" id="exp_mn" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">Prev. Org.:</span>
											<input type="text" name="prev_org" id="prev_org" class="form-control"  >
											</div>
											</div>
											
											<div class="col-md-12">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">Skills.:</span>
											<input type="text" name="skills" id="skills" class="form-control"  >
											</div>
											</div>
														
											
											<div class="clearfix"></div>
											</div>
											</div>
										</div>
									</div>
									
									
									
									<!--login_informations_div-->
									<div class="col-lg-12">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4><i class="fa fa-angle-double-right"></i> Login Information</h4>
												</div>
												<div class="portlet-widgets">
													<a data-toggle="collapse" data-parent="#accordion" href="#logininformation"><i class="fa fa-chevron-down"></i></a>
												</div>
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
												<div class="portlet-body">
													
													<div class="col-md-6">
													
													
														<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Office Email :</span>
															<input type="text" name="email_office" id="email_office" class="form-control" placeholder="Email" maxlength="50" onChange="updateLoginId()">
															<span class="input-group-addon ndrftextwidth text-center" style="width:140px">@oditeksolutions.com</span>
														</div>
														</div>
														
														<div class="col-md-6">
														<div class="input-group bmargindiv1 col-md-12">
														<span class="input-group-addon ndrftextwidth text-right">Business Unit :</span>
														<select id="bu_id" name="bu_id" class="form-control" ">
														<option value="0">Select BU</option>
														<?php
															foreach($allbu_array as $val)
															{
																echo '<option value="'.$val->id.'">'.$val->name.'</option>';
															}			
														?>														
														</select>
														</div>
														
														
														</div>
													
													
													<div class="col-md-6">
													
													<div class="input-group bmargindiv1 col-md-12">
														<span class="input-group-addon ndrftextwidth text-right">Report To :</span>
														<select id="upper_id" name="upper_id" class="form-control" ">
														<option value="0">Select Name</option>
														<?php
															foreach($allname_array as $val)
															{
																echo '<option value="'.$val->id.'">'.$val->name.'</option>';
															}			
														?>														
														</select>
														</div>
														
														
														
													<div class="input-group bmargindiv1 col-md-12">
													<span class="input-group-addon ndrftextwidth text-right">Department :</span>
													<select id="dept_id" name="dept_id" class="form-control" ">
													<option value="0">Select Department</option>
													<?php
														foreach($department_array as $val)
														{
															echo '<option value="'.$val->id.'">'.$val->name.'</option>';
														}			
													?>														
													</select>
													</div>
																								
												
																						
												
												
														
													</div>
													
													
													
													
													<div class="col-md-6">
													
													<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Designation :</span>
													<select id="desig_id" name="desig_id" class="form-control" >
														<option value="0">Select Designation</option>
														<?php
															foreach($designation_array as $val)
															{
																echo '<option value="'.$val->id.'">'.$val->name.'</option>';
															}			
														?>														
													</select>
												</div>
																											
												
												
												<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Employee Id :</span>
															<input readonly type="text" name="employeeid" id="employeeid" class="form-control" placeholder="Employee Id" value="" onChange="checkEmployeeId()">
															<span class="input-group-addon ndrftextwidth text-center" style="width:0px;cursor: pointer" onClick="getEmpyeeId()">Get</span>
														</div>
														
														
														
														
												
														
													</div>
													
													
													<div class="col-md-6">
																																																	
														
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Login Id :</span>
												<input type="text" name="userid" id="userid" class="form-control" placeholder="User Id" value="" readonly >
												</div>
														
													
														
												
														
													</div>
													
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>
									<!--end_login_information_div-->
									
									
									<!--permission_informations_div-->
									<div class="col-lg-12" style="display:none">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4><i class="fa fa-angle-double-right"></i> Access Information</h4>
												</div>
												<div class="portlet-widgets">
													<a data-toggle="collapse" data-parent="#accordion" href="#logininformation"><i class="fa fa-chevron-down"></i></a>
												</div>
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
												<div class="portlet-body">
													
													
														
														
													
													
												<div class="col-md-6">
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Mgmt. Member :</span>
													<select id="mgmt" name="mgmt" class="form-control" >
														<option value="0">No</option>
														<option value="1">Yes</option>
																											
													</select>
												</div>
												</div>
																										
												<div class="col-md-6">
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">IT Member :</span>
													<select id="itadmin" name="itadmin" class="form-control" >
														<option value="0">No</option>
														<option value="1">Yes</option>
																											
													</select>
												</div>
												</div>	
												

												<div class="col-md-6">
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">HR Member :</span>
													<select id="hradmin" name="hradmin" class="form-control" >
														<option value="0">No</option>
														<option value="1">Yes</option>
																											
													</select>
												</div>
												</div>
												
												<div class="col-md-6">
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Finance Member :</span>
													<select id="finadmin" name="finadmin" class="form-control" >
														<option value="0">No</option>
														<option value="1">Yes</option>
																											
													</select>
												</div>
												</div>
												
													
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>
									
									<!--end_permission_information_div-->
									
									<div class="col-lg-12">
										<div class="bpaddingdiv1 text-center">
										<input type="button" name="register1" id="register1" class="btn btn-green btn-lg" value="Add" onClick="addEmployee();">
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	<input type="hidden" name="hdloan" id="hdloan"  value="">
							<input type="hidden" name="update" id="update"  value="0">
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


<script src="<?php echo USER_SITE_URL;?>oditekjs/addemployee_hr.js"></script>
<script>
messagestatus(<?php echo $msg ?>);
</script>