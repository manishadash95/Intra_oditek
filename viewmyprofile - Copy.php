<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	ini_set("display_errors",0);
	$eid = $_SESSION["emp_id"];

	//$_SESSION["pageid"]= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
	
	//$eid = 160701;
	$employee = $dbobj->getEmployeeData($eid);
	//echo $eid;
	//exit();
	//$employee->type=1;
	
	//$rankobj = $dbobj->getRank();
	$allname_array = $dbobj->getAllName();
	$designation_array = $dbobj->getDesignation();
	$department_array = $dbobj->getDepartment();

	
	if(isset($_POST['register']))
	{
		if($dbobj->checkSession())
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
						move_uploaded_file($_FILES['btnupload']['tmp_name'],"uploads/".$newnm);
					}
				}
			}
			
			$msg = $dbobj->updateEmployee($_POST);	
		}
		else{
			$msg = 3;
		}	
		
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
						<li><i class="fa fa-dashboard"></i>  <a href="index.html">Profile</a>
						</li>
						<li class="active">View My Profile</li>
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4><i class="fa fa-exchange fa-fw"></i> View My Profile Info </h4>
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
												<span  class="input-group-addon ndrftextwidth text-right">Name :</span>
												<input readonly type="text" name="name_first" id="name_first" class="form-control" placeholder="Employee Name" value="<?php echo $employee->name ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Gender :</span>
												<input readonly type="text" class="form-control" value="<?php echo $employee->gender ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Blood Group :</span>
												<input readonly type="text" class="form-control" value="<?php echo $employee->blood_grp ?>">
													
											</div>
											
											
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Birth :</span>
												<input type="text" name="date_of_birth" id="date_of_birth" class="form-control tcal" placeholder="Date of Birth" value="<?php echo $employee->date_of_birth ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Mobile No :</span>
												<input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No" maxlength="10" value="<?php echo $employee->mobile ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Emergency No :</span>
												<input type="text" name="emergency_no" id="emergency_no" class="form-control" placeholder="Emergency No" maxlength="10" value="<?php echo $employee->emergency ?>" >
											</div>

											
											
											
											
										
											
											
											
											
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-5">
										<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Joining :</span>
												<input type="text" name="oditek_joining_date" id="oditek_joining_date" readonly class="form-control" placeholder="Joining Date" value="<?php echo $employee->joining_date ?>" >
											</div>
											
											 
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Email Id :</span>
											<input type="text" name="email1" id="email1" class="form-control" placeholder="Email id" value="<?php echo $employee->email ?>">
											</div>	

											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Skype Id :</span>
											<input type="text" name="skype" id="skype" class="form-control" placeholder="Skype id" value="<?php echo $employee->skype_id ?>" >
											</div>	
																						
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">PAN No :</span>
												<input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="PAN No" maxlength="10" value="<?php echo $employee->pan_no ?>">
											</div>
											
											 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Passport No :</span>
												<input type="text" name="passport_no" id="passport_no" class="form-control" placeholder="Passport No" value="<?php echo $employee->passport_no ?>">
											</div>
											
											
											
                                           <?php if($employee->type ==1){ ?>
                                            <div class="input-group bmargindiv1 col-md-12" id="divtptcity">
												<span class="input-group-addon ndrftextwidth text-right"> Status :</span>
												<input readonly type="text" name="employee_status" id="employee_status" class="form-control" value="<?php echo $employee->status_str ?>">
												
											</div>
										   <?php }else{ ?>
										   <div class="input-group bmargindiv1 col-md-12" id="divtptcity">
												<span class="input-group-addon ndrftextwidth text-right">Employee Status :</span>
												<input readonly type="text" name="employee_status" id="employee_status" class="form-control" value="<?php echo $employee->status_str ?>">
												
											</div>
										   
										   <?php } ?>
											
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
													
													<?php if($employee->type ==2){ ?>
													
													<div class="col-md-6">
													<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Office Email :</span>
															<input readonly type="text" name="email_office" id="email_office" class="form-control" placeholder="Email" maxlength="30" value="<?php echo $employee->office_email; ?>" >
															
														</div>
													</div>
												
												
												<div class="col-md-6">	
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Report To :</span>
													<select readonly disabled id="upper_id" name="upper_id" class="form-control" ">
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
													<select disabled  id="dept_id" name="dept_id" class="form-control" ">
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
												</div>
												<div class="col-md-6">
												
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Designation :</span>
													<select disabled id="desig_id" name="desig_id" class="form-control" ">
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
												</div>
												
												
												
													
													
													
													
													<div class="col-md-6">
													
												<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Employee Id :</span>
															<input type="text" name="employeeid" id="employeeid" class="form-control" placeholder="Employee Id" value="<?php echo $employee->eid ?>" readonly>
															
														</div>
														</div>
														<div class="col-md-6">
														<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Login Id :</span>
															<input type="text" name="userid" id="userid" class="form-control" placeholder="User Id" readonly value="<?php echo $employee->office_email ?>">
														</div>
														</div>
														
														<div class="col-md-6">
												
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Password :</span>
												<input type="password" name="password1" id="password1" class="form-control" placeholder="" value="">
												</div>
																										
													</div>
													
													
														<div class="col-md-6">
														<div class="input-group bmargindiv1 col-md-12">
														<span class="input-group-addon ndrftextwidth text-right">Retype Password :</span>
														<input type="password" name="password2" id="password2" class="form-control" placeholder="" value="">
														</div>
												
														
													</div>
													
												<?php }else{ ?>

													<div class="col-md-6">
													<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Office Email :</span>
															<input readonly type="text" name="email_office" id="email_office" class="form-control" placeholder="Email" maxlength="30" onChange="updateLoginId()" value="<?php echo $employee->office_email; ?>" >
															
														</div>
													</div>
												
																							
													
													<div class="col-md-6">
													
													
													<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Department :</span>
													<select disabled  id="dept_id" name="dept_id" class="form-control" ">
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
												</div>
												
												
												
												
													
													
													
													
													<div class="col-md-6">
													
												<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Director Id :</span>
															<input type="text" name="employeeid" id="employeeid" class="form-control" placeholder="Employee Id" value="<?php echo $employee->eid ?>" readonly>
															
														</div>
														</div>
														<div class="col-md-6">
														<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Login Id :</span>
															<input type="text" name="userid" id="userid" class="form-control" placeholder="User Id" readonly value="<?php echo $employee->office_email ?>">
														</div>
														</div>
														
														<div class="col-md-6">
												
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Password :</span>
												<input type="password" name="password1" id="password1" class="form-control" placeholder="" value="">
												</div>
																										
													</div>
													
													
														<div class="col-md-6">
														<div class="input-group bmargindiv1 col-md-12">
														<span class="input-group-addon ndrftextwidth text-right">Retype Password :</span>
														<input type="password" name="password2" id="password2" class="form-control" placeholder="" value="">
														</div>
												
														
													</div>


												<?php } ?>
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
									<div class="col-lg-12">
										<div class="bpaddingdiv1 text-center">
										<input type="submit" name="register" id="register" class="btn btn-green btn-lg" value="Update"  >
										</div>
									</div>
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


function updateImage(){
 var obj=document.getElementById('btnupload');
 if(obj.files && obj.files[0]){
 	var reader = new FileReader();
	reader.onload = function (e) {		            	
		$('#bigimage1').attr('src', e.target.result);
	}
	reader.readAsDataURL(obj.files[0]);
 }

}


function masterValidation()
{
	var obj=document.getElementById('date_of_birth').value;
	if(obj == ""){
		alert("Add date of birth...");
		return false;
	}
		
	obj=document.getElementById('mobile_no').value;
	if(obj == ""){
		alert("Add mobile no...");
		return false;
	}
	obj=document.getElementById('emergency_no').value;
	if(obj == ""){
		alert("Add emergency contact no...");
		return false;
	}
	
	obj=document.getElementById('email1').value;
	if(obj == ""){
		alert("Add email id...");
		return false;
	}
	
	var passwd1 = document.getElementById("password1").value;
	var passwd2 = document.getElementById("password2").value;
	if(passwd1.length > 0)
	{
		if(passwd1.length < 8)
		{
			alert("Password length should be 8");
			return false;
		}
		if(passwd1 !=  passwd2)
		{
			alert("Password mismatch");
			return false;
		}
	}
		
	return true;
	
}

$(window).load(function () {
//alert("aaaaa");
calcsalary();
});

messagestatus2(<?php echo $msg ?> );

function messagestatus2(steid_int)
{
	var steid = ""+steid_int;
	var a = parseInt(steid);
	switch(a)
	{
		case 1:
		{
			alert("Data Updated Successfully");
			document.location.href="viewmyprofile.php";
			break;
		}
		case 3:
		{
			alert("Session Expired. Please login again.");
			//document.location.href="viewmyprofile.php";
			break;
		}		
		case 0:
		{
			alert("Unable to Add, Try Again");
			break;
		}
	}
	
}
</script>

