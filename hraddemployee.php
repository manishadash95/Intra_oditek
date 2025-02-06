<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
	$allname_array = $dbobj->getAllNameWithBoard();
	$designation_array = $dbobj->getDesignationHR();
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
		$msg = $dbobj->addEmployee($_POST);		
		//$msg = 1;
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
						<li class="active">Add Employee</li>
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
									<h4>Add New Employee </h4>
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
												<input type="text" name="date_of_birth" id="date_of_birth" class="form-control tcal" placeholder="Date of Birth">
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
												<span class="input-group-addon ndrftextwidth text-right">Emergency No :</span>
												<input type="text" name="emergency_no" id="emergency_no" class="form-control" placeholder="Emergency No" maxlength="10">
											</div>

											
											
											
											
										
											
											
											
											
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-5">
										<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Joining :</span>
												<input type="text" name="oditek_joining_date" id="oditek_joining_date" class="form-control tcal" placeholder="Joining Date" >
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Email Id :</span>
											<input type="text" name="email1" id="email1" class="form-control" placeholder="Email id" >
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
											
											
											
                                            
                                            <div class="input-group bmargindiv1 col-md-12" id="divtptcity">
												<span class="input-group-addon ndrftextwidth text-right">Employee Status :</span>
												<select readOnly id="employee_status" name="employee_status" class="form-control" onchange="checkStatus()"  >
												<option value="1">Present</option>
												</select>
											</div>
											
											
										</div>
										<!--end_2nd_div-->
										<!--3rd_div-->
										<div class="col-md-2">
											<div class="bpaddingdiv1 text-center">
												<img src="img/noimage.gif" id="bigimage1" name="Employee Photo" border="0" width="140" height="160" style="border:#666 1px solid">
											</div>
											<div class="bpaddingdiv1 text-center">
												<div class="bpaddingdiv1">
                                                <input type="hidden" id="hdfilename" name="hdfilename" value="">
                                              
                                              	<div class="browse" style="width:40px; height:40px;cursor:pointer;">
            								  	<div class="placeholder">
                							 	<img src="img/upload.png" width="40" height="40" alt="" style="cursor:pointer;" />
           									  	</div>  
                                                <input type="file" id="btnupload" name="btnupload" class="form-control" onChange="updateImage()" >	
                                                </div>
                                                 
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
															<input type="text" name="email_office" id="email_office" class="form-control" placeholder="Email" maxlength="50" onChange="updateLoginId()">
															<span class="input-group-addon ndrftextwidth text-center" style="width:140px">@oditeksolutions.com</span>
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
														
														
													
													</div>
													
													
													<div class="col-md-6">
													
													
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
												
														
												
												
														
													</div>
													
													
													
													
													<div class="col-md-6">
													
													
																											
												
												
												<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Employee Id :</span>
															<input type="text" name="employeeid" id="employeeid" class="form-control" placeholder="Employee Id" value="" onChange="checkEmployeeId()">
															<span class="input-group-addon ndrftextwidth text-center" style="width:0px;cursor: pointer" onClick="getEmpyeeId()">Get</span>
														</div>
														
														
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
                                                                
                                            					</li>
																</ul>
														</div>
                                                        
														<div id="myTabContent" class="tab-content">
															<div class="tab-pane fade in active" id="allowancestab">
																<div class="totalaligndiv" id="allowancesinner">
																	<!--1st_div-->
																	<div class="col-md-6 newpadding-left-zero">
																	
																	<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Gross :</span>
																		<input type="text" class="form-control" placeholder="Gross" name="gross" id="gross" value="0" onchange="calcsalary()" >
																	  </div>
																	  
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right" >Basic Pay :</span>
																		<input type="text" class="form-control"  placeholder="Basic Pay" name="basic_pay" id="basic_pay" readonly  value="0"> 
																	  </div>
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right" >DA :</span>
																		<input type="text" class="form-control"  placeholder="DA Pay" name="da_pay" id="da_pay" readonly value="0"> 
																	  </div>
																	 
																	  
																	</div>
																	<!--end_1st_div-->
																	<!--2nd_div-->
																	<div class="col-md-6">
																	 
																	 <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">HRA :</span>
																		<input type="text" class="form-control" placeholder="HRA Pay" name="hra_pay" id="hra_pay" value="0" readonly >
																	  </div>
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">Other Allowance :</span>
																		<input type="text" class="form-control" placeholder="Other Allowance" name="other_pay" id="other_pay" value="0" readonly >
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
																		<input type="text" class="form-control" placeholder="PF Amount" name="pf_ded" id="pf_ded" value="0" onchange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">Pro. Tax :</span>
																		<input type="text" class="form-control" placeholder="Proffesional Tax Amount" name="pt_ded" id="pt_ded" value="0" onchange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">Unpaid Leave :</span>
																		<input type="text" class="form-control" placeholder="Unpaid Leave" name="leave_ded" id="leave_ded" value="0" onchange="calcsalary()">
																	  </div>
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">Others  :</span>
																		<input type="text" class="form-control" placeholder="Other Deductions" name="other_ded" id="other_ded" value="0" onchange="calcsalary()">
																	  </div>
                                                                      
                                                                     
																	 
																	</div>
																	<!--end_1st_div-->
																	<!--2nd_div-->
																	<div class="col-md-6">
                                                                    <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">ITX :</span>
																		<input type="text" class="form-control" placeholder="ITX Amount" name="itx_ded" id="itx_ded" value="0" onchange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">CESS P :</span>
																		<input type="text" class="form-control" placeholder="CESS P Amount" name="cessp_ded" id="cessp_ded" value="0" onchange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right">CESS S :</span>
																		<input type="text" class="form-control" placeholder="CESS S Amount" name="cesss_ded" id="cesss_ded" value="0" onchange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Deductions :</span>
																				<input type="text" class="form-control" placeholder="Tot Ded" readonly name="totded" id="totded" value="0">
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
															<input type="text" class="form-control" placeholder="Gross Pay" name="grosspay" id="grosspay" value="0" > 
														  </div>
														</div>
														<!--end_1st_div-->
														<!--2nd_div-->
														<div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Deduction :</span>
															<input type="text" class="form-control" placeholder="Deduction" name="deduction" id="deduction" value="0">
														  </div>
														</div>
														<!--end_2nd_div-->
														<!--3rd_div-->
                                                         <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Net Pay :</span>
															<input type="text" class="form-control" placeholder="Net Pay" name="netpay" id="netpay" value="0"> 
														  </div>
														</div>
                                                        
														 
                                                        
                                                        <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Loan :</span>
															<input type="text" class="form-control" placeholder="LOAN" name="loan" id="loan" value="0">
														  </div>
														</div>
                                                        
                                                        <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-right fontweightbold">Banker :</span>
															<input type="text" class="form-control" placeholder="Banker" name="banker" id="banker" value="0">
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
									<div class="col-lg-12">
										<div class="bpaddingdiv1 text-center">
											<input type="submit" name="register" id="register" class="btn btn-green btn-lg" value="Add">
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


<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee.js"></script>
<script>
messagestatus(<?php echo $msg ?>);
</script>