<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$session_rank = $_SESSION["admin_rank"];
	$readonly = "";
	$disabled = "";
	if($session_rank != 1)
	{
		$readonly = "readonly";
		$disabled = "disabled";
	}
	
	$eid = $_REQUEST['eid'];

	//$eid = 160701;
	$employee = $dbobj->getEmployeeData($eid);

	
	//$rankobj = $dbobj->getRank();
	$allname_array = $dbobj->getAllNameWithBoard();
	$designation_array = $dbobj->getDesignation();
	$department_array = $dbobj->getDepartment();

	
	if(isset($_POST['register']))
	{
		$employeeid  = $_POST['employeeid'];
		if($_FILES['btnupload']['name'] != '')
		{
			$extenimg = $dbobj->getExtention($_FILES['btnupload']['name']);
			$extphoto = strtolower($extenimg);
			if($extphoto=="jpg" || $extphoto=="jpeg" || $extphoto=="png" || $extphoto=="gif")
			{
				$filename = $_FILES['btnupload']['tmp_name'];
				$size=$_FILES['btnupload']['size'];
				$newnm =$employeeid.".".$extphoto;
				$_POST['hdfilename'] = "uploads/".$newnm;
				if($size < 2024*2024)
				{
					move_uploaded_file($_FILES['btnupload']['tmp_name'],"../uploads/".$newnm);
				}
			}
		}
		
		$msg = $dbobj->updateEmployee($_POST);		
		$msg = 1;
	}
	
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
		<a href="viewemployee_hr.php" >
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
												<input <?php echo $disabled;?> type="text" name="name_first" id="name_first" class="form-control" placeholder="Employee Name" value="<?php echo $employee->name ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Gender :</span>
													<select <?php echo $disabled;?> id="gender" name="gender" class="form-control" >
														<option value="0">Select Gender</option>
														<option value="1" <?php echo ($employee->gender == 1 )?'selected':'' ?> >Male</option>
														<option value="2" <?php echo ($employee->gender == 2 )?'selected':'' ?> >Female</option>		
													</select>
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Blood Group :</span>
													<select <?php echo $disabled;?> id="blood_grp" name="blood_grp" class="form-control" >
														<option value="0">Select Group</option>
														<option value="A+" <?php echo ($employee->blood_grp == "A+" )?'selected':'' ?> >A+</option>
														<option value="A-" <?php echo ($employee->blood_grp == "A-" )?'selected':'' ?> >A-</option>
														<option value="B+" <?php echo ($employee->blood_grp == "B+" )?'selected':'' ?> >B+</option>
														<option value="B-" <?php echo ($employee->blood_grp == "B-" )?'selected':'' ?> >B-</option>
														<option value="O+" <?php echo ($employee->blood_grp == "O+" )?'selected':'' ?> >O+</option>
														<option value="O-" <?php echo ($employee->blood_grp == "O-" )?'selected':'' ?> >O-</option>
														<option value="AB+"<?php echo ($employee->blood_grp == "AB+" )?'selected':'' ?> >AB+</option>
														<option value="AB-"<?php echo ($employee->blood_grp == "AB-" )?'selected':'' ?> >AB-</option>		
													</select>
											</div>
											
											
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Birth :</span>
												<input <?php echo $disabled;?> type="text" name="date_of_birth" id="date_of_birth" class="form-control tcal" placeholder="Date of Birth" value="<?php echo $employee->date_of_birth ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Mobile No :</span>
												<input <?php echo $disabled;?> type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No" maxlength="10" value="<?php echo $employee->mobile ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Emergency No :</span>
												<input <?php echo $disabled;?> type="text" name="emergency_no" id="emergency_no" class="form-control" placeholder="Emergency No" maxlength="10" value="<?php echo $employee->emergency ?>" >
											</div>

											
											
											
											
										
											
											
											
											
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-5">
										<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Joining :</span>
												<input <?php echo $disabled;?> type="text" name="oditek_joining_date" id="oditek_joining_date" readonly class="form-control" placeholder="Joining Date" value="<?php echo $employee->joining_date ?>" >
											</div>
											
											 
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Email Id :</span>
											<input <?php echo $disabled;?> type="text" name="email1" id="email1" class="form-control" placeholder="Email id" value="<?php echo $employee->email ?>">
											</div>	

											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Skype Id :</span>
											<input <?php echo $disabled;?> type="text" name="skype" id="skype" class="form-control" placeholder="Skype id" value="<?php echo $employee->skype_id ?>" >
											</div>	
																						
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">PAN No :</span>
												<input <?php echo $disabled;?> type="text" name="pan_no" id="pan_no" class="form-control" placeholder="PAN No" maxlength="10" value="<?php echo $employee->pan_no ?>">
											</div>
											
											 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Passport No :</span>
												<input <?php echo $disabled;?> type="text" name="passport_no" id="passport_no" class="form-control" placeholder="Passport No" value="<?php echo $employee->passport_no ?>">
											</div>
											
											
											
                                            
                                            <div class="input-group bmargindiv1 col-md-12" id="divtptcity">
												<span class="input-group-addon ndrftextwidth text-right">Employee Status :</span>
												<select <?php echo $disabled;?> id="employee_status" name="employee_status" class="form-control" onchange="checkStatus()"  >
												<option value="0" >Select Status</option>
												<option value="1" <?php echo ($employee->status == 1 )?'selected':'' ?>  >Present</option>
												<option value="2" <?php echo ($employee->status == 2 )?'selected':'' ?> >Left</option>
												<option value="3" <?php echo ($employee->status == 3 )?'selected':'' ?> >With Held</option>
												</select>
											</div>
											
											
										</div>
										<!--end_2nd_div-->
										<!--3rd_div-->
										<div class="col-md-2">
											<div class="bpaddingdiv1 text-center">
											
											<?php if(strlen($employee->image) > 0 ) {  $img_path = "../".$employee->image; ?>
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
															<input <?php echo $disabled;?> type="text" name="email_office" id="email_office" class="form-control" placeholder="Email" maxlength="30" onChange="updateLoginId()" value="<?php echo $employee->office_email ?>" >
															<span class="input-group-addon ndrftextwidth text-center" >@oditeksolutions.com</span>
														</div>
													</div>
													<div class="col-md-6">
													<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Report To :</span>
													<select <?php echo $disabled;?> id="upper_id" name="upper_id" class="form-control" ">
														<option value="0">Select Name</option>
														<?php
															foreach($allname_array as $val)
															{
																$selected = ( $employee->upper_id == $val->id)?'selected':'';
																echo '<option value="'.$val->id.'"   '.$selected.' >'.$val->name.'</option>';
															}			
														?>														
													</select>
												</div>
												
												
													</div>
													
													<div class="col-md-6">
													
													
													<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Department :</span>
													<select <?php echo $disabled;?> id="dept_id" name="dept_id" class="form-control" ">
														<option value="0">Select Department</option>
														<?php
															foreach($department_array as $val)
															{
																$selected = ( $employee->dept_id == $val->id)?'selected':'';
																echo '<option value="'.$val->id.'"  '.$selected.' >'.$val->name.'</option>';
															}			
														?>														
													</select>
												</div>
												
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Designation :</span>
													<select <?php echo $disabled;?> id="desig_id" name="desig_id" class="form-control" ">
														<option value="0">Select Designation</option>
														<?php
															foreach($designation_array as $val)
															{
																$selected = ( $employee->desig_id == $val->id)?'selected':'';
																echo '<option value="'.$val->id.'"  '.$selected.' >'.$val->name.'</option>';
															}			
														?>														
													</select>
												</div>
												
												<?php if($session_rank == 1) {?>
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Password :</span>
												<input type="password" name="password1" id="password1" class="form-control" placeholder="" value="">
												</div>
												<?php }?>
																								
																							
												
													
												
												
													
														
														
												
												
														
													</div>
													
													
													
													
													<div class="col-md-6">
													
													
														
														
												
												
												<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Employee Id :</span>
															<input type="text" name="employeeid" id="employeeid" class="form-control" placeholder="Employee Id" value="<?php echo $employee->eid ?>" readonly>
															
														</div>
														
														
														<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Login Id :</span>
															<input type="text" name="userid" id="userid" class="form-control" placeholder="User Id" readonly value="<?php echo $employee->office_email ?>">
														</div>
														<?php if($session_rank == 1) {?>
														<div class="input-group bmargindiv1 col-md-12">
														<span class="input-group-addon ndrftextwidth text-right">Retype Password :</span>
														<input type="password" name="password2" id="password2" class="form-control" placeholder="" value="">
														</div>
														<?php }?>
														
													</div>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>
									<!--end_login_information_div-->
									
									<!--Access_informations_div-->
									<div class="col-lg-12">
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
												<select <?php echo $disabled;?> id="mgmt" name="mgmt" class="form-control" >
												<option value="0" <?php echo ($employee->mgmt == 0 )?'selected':'' ?>>No</option>
												<option value="1" <?php echo ($employee->mgmt == 1 )?'selected':'' ?>>Yes</option>
												</select>
												</div>
												</div>
												
												<div class="col-md-6">
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">IT Member :</span>
												<select <?php echo $disabled;?> id="itadmin" name="itadmin" class="form-control" >
												<option value="0" <?php echo ($employee->itadmin == 0 )?'selected':'' ?>>No</option>
												<option value="1" <?php echo ($employee->itadmin == 1 )?'selected':'' ?>>Yes</option>
												</select>
												</div>
												</div>
												
												
												
												<div class="col-md-6">
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">HR Member :</span>
												<select <?php echo $disabled;?> id="hradmin" name="hradmin" class="form-control" >
												<option value="0" <?php echo ($employee->hradmin == 0 )?'selected':'' ?>>No</option>
												<option value="1" <?php echo ($employee->hradmin == 1 )?'selected':'' ?>>Yes</option>
												</select>
												</div>
												</div>
												
												
												<div class="col-md-6">
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Finance Member :</span>
												<select <?php echo $disabled;?> id="finadmin" name="finadmin" class="form-control" >
												<option value="0" <?php echo ($employee->finadmin == 0 )?'selected':'' ?>>No</option>
												<option value="1" <?php echo ($employee->finadmin == 1 )?'selected':'' ?>>Yes</option>
												</select>
												</div>
												</div>
												
												
														
												
												
														
																										
													
													
												
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>
									
									
									
									
									<!--end_access_information_div-->
									<!--allowances_deduction_div-->
									<div class="col-lg-12" style="display:none">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4><i class="fa fa-angle-double-right"></i> Allowances / Deductions</h4>
												</div>
                                                
												<div class="portlet-widgets">
													<a data-toggle="collapse" data-parent="#accordion" href="#allowancesdeductionstab"><i class="fa fa-chevron-down"></i></a>
												</div>
												<div class="clearfix"></div>
											</div>
											
											<div id="allowancesdeductionstab" class="panel-collapse collapse in">
												<div class="portlet-body">
													<div class="portlet-body newtabbgcolor">
														<div class="totalaligndiv">
															<ul id="myTab" class="nav nav-tabs">
																<li class="active"><a href="#allowancestab" data-toggle="tab">Allowances</a></li>
																<li><a href="#deductionstab" data-toggle="tab">Deductions</a></li>
													            <li>
																<div class="input-group bmargindiv1 col-md-12" style="margin-left:20px;">
																<span class="input-group-addon ndrftextwidth text-left" style="height:42px;">Month :</span>
																<select id="monthyear" name="monthyear" class="form-control" style="height:42px;" onchange="calcsalary()"">																					    								<?php		
																$monthlist=$dbobj->getMonthList();
																echo '<option value="">GLOBAL</option>';
																foreach($monthlist as $val){
																	echo '<option value="'.$val->id.'">'.$val->month.'</option>';
																}
																?>					
																</select>														
																</div>
																
																</li>
																</ul>
														</div>
                                                        
														<div id="myTabContent" class="tab-content">
															<div class="tab-pane fade in active" id="allowancestab">
																<div class="totalaligndiv" id="allowancesinner">
																	<!--1st_div-->
																	<div class="col-md-6 newpadding-left-zero">
																	
																	<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Gross :</span>
																	<input readonly type="text" class="form-control" placeholder="Gross" name="gross" id="gross" value="<?php echo $employee->gross ?>" >
																	  </div>
																	  
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right" >Basic Pay :</span>
																		<input type="text" class="form-control"  placeholder="Basic Pay" name="basic_pay" id="basic_pay" readonly  value="<?php echo $employee->basic ?>"> 
																	  </div>
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right" >DA :</span>
																		<input type="text" class="form-control"  placeholder="DA Pay" name="da_pay" id="da_pay" readonly value="<?php echo $employee->da ?>"> 
																	  </div>
																	 
																	  
																	</div>
																	<!--end_1st_div-->
																	<!--2nd_div-->
																	<div class="col-md-6">
																	 
																	 <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">HRA :</span>
																		<input type="text" class="form-control" placeholder="HRA Pay" name="hra_pay" id="hra_pay" value="<?php echo $employee->hra ?>" readonly >
																	  </div>
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">Other Allowance :</span>
																		<input type="text" class="form-control" placeholder="Other Allowance" name="other_pay" id="other_pay" value="<?php echo $employee->other ?>" readonly >
																	  </div>
																	  
																	  
																	  
																	  
																	
																	  </div>
																	</div>
																	<!--end_2nd_div-->
																	<!--3rd_div-->
																	
																	<!--end_3rd_div-->
																	<div class="clearfix"></div>
																	<!--end_show_changes_div-->                               
																  </div>
															
															
															<div class="tab-pane fade" id="deductionstab">
																<div class="totalaligndiv"  id="deductioninner">
																	<!--1st_div-->
																	<div class="col-md-6 newpadding-left-zero">
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">PF :</span>
																		<input type="text" class="form-control" placeholder="PF Amount" name="pf_ded" id="pf_ded" value="<?php echo $employee->pf_ded ?>" onchange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">Pro. Tax :</span>
																		<input type="text" class="form-control" placeholder="Proffesional Tax Amount" name="pt_ded" id="pt_ded" value="<?php echo $employee->pt_ded ?>" onchange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">Unpaid Leave :</span>
																		<input type="text" class="form-control" placeholder="Unpaid Leave" name="leave_ded" id="leave_ded" value="<?php echo $employee->leave_ded ?>" onchange="calcsalary()">
																	  </div>
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">Others  :</span>
																		<input type="text" class="form-control" placeholder="Other Deductions" name="other_ded" id="other_ded" value="<?php echo $employee->other_ded ?>" onchange="calcsalary()">
																	  </div>
                                                                      
                                                                     
																	 
																	</div>
																	<!--end_1st_div-->
																	<!--2nd_div-->
																	<div class="col-md-6">
                                                                    <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">ITX :</span>
																		<input type="text" class="form-control" placeholder="ITX Amount" name="itx_ded" id="itx_ded" value="<?php echo $employee->itx_ded ?>" onchange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">CESS P :</span>
																		<input type="text" class="form-control" placeholder="CESS P Amount" name="cessp_ded" id="cessp_ded" value="<?php echo $employee->cessp_ded ?>" onchange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">CESS S :</span>
																		<input type="text" class="form-control" placeholder="CESS S Amount" name="cesss_ded" id="cesss_ded" value="<?php echo $employee->cesss_ded ?>" onchange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Deductions :</span>
																		<input type="text" class="form-control" placeholder="Tot Ded" readonly name="totded" id="totded" value="<?php echo $employee->totded ?>">
																		 </div>
                                                                     
																	  
																	</div>
																	<!--end_2nd_div-->
																	<!--3rd_div-->
																	
																	<!--end_3rd_div-->
																	<div class="clearfix"></div>
																	<!--4th_div-->
																	
																	<!--end_4th_div-->  
																	<!--show_deductions_div-->
																	<!--<div class="col-lg-12">
																		<div class="tpaddingdiv2">
																		  <button class="btn btn-default" data-toggle="modal" data-target="#deductionpreview">Show Changes</button>
																		</div>
																	  </div>-->
																	  <div class="clearfix"></div>
																	<!--end_show_deductions_div-->                              
																  </div>
															</div>
                                                            
                                                                                                           
                                     
											
                                                            
                                                            
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end_allowances_deduction_div-->
                                    <!--final_deduction_div-->
                                    <div class="col-lg-12">
										
									</div>
                                    <!--end_final_deduction_div-->
									<!--netpay_information_div-->
									<div class="col-lg-12" style="display:none">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4><i class="fa fa-angle-double-right"></i>  NetPay</h4>
												</div>
												<div class="portlet-widgets">
													<a data-toggle="collapse" data-parent="#accordion" href="#netpayinformation"><i class="fa fa-chevron-down"></i></a>
												</div>
												<div class="clearfix"></div>
											</div>
											<div id="netpayinformation" class="panel-collapse in">
												<div class="portlet-body">
													<div class="totalaligndiv">
														<!--1st_div-->
														<div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Gross Pay :</span>
															<input readonly type="text" class="form-control" placeholder="Gross Pay" name="grosspay" id="grosspay" value="<?php echo $employee->gross ?>" > 
														  </div>
														</div>
														<!--end_1st_div-->
														<!--2nd_div-->
														<div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Deduction :</span>
															<input readonly type="text" class="form-control" placeholder="Deduction" name="deduction" id="deduction" value="0">
														  </div>
														</div>
														<!--end_2nd_div-->
														<!--3rd_div-->
                                                         <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Net Pay :</span>
															<input readonly type="text" class="form-control" placeholder="Net Pay" name="netpay" id="netpay" value="0"> 
														  </div>
														</div>
                                                        
														 
                                                        
                                                        <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Loan :</span>
															<input readonly  type="text" class="form-control" placeholder="LOAN" name="loan" id="loan" value="0">
														  </div>
														</div>
                                                        
                                                        <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Banker :</span>
															<input readonly type="text" class="form-control" placeholder="Banker" name="banker" id="banker" value="0">
														  </div>
														</div>
                                                       
                                                        
                                                        
														<!--end_3rd_div-->
														<div class="clearfix"></div>
														<!--4th_div-->
														<div class="totalaligndiv">
															<div class="col-md-12 vertsizetextarea">
																<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">Remarks :</span>
																	<textarea id="remarks" class="form-control" maxlength="225" rows="2" name="remarks" style="margin: 0px -0.5px 0px 0px; height: 150px;"></textarea>
																  </div>
															</div>
															<div class="clearfix"></div>
														</div>
														<!--end_4th_div-->                                
													  </div>
												</div>
											</div>
										</div>
									</div>
									<!--end_netpay_information_div-->
									<?php if($session_rank == 1) {?>
									<div class="col-lg-12">
										<div class="bpaddingdiv1 text-center">
										<input type="submit" name="register" id="register" class="btn btn-green btn-lg" value="Update"  >
										</div>
									</div>
									<?php }?>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	<input type="hidden" name="hdloan" id="hdloan"  value="">
							<input type="hidden" name="update" id="update"  value="1">
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
<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee.js"></script>

<script>


$(window).load(function () {
//alert("aaaaa");
calcsalary();
});

messagestatus2(<?php echo $msg.$employeeid ?> );
</script>

