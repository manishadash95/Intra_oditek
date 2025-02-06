<?php 

$gender_array = $dbobj->getEmpGender();
$bldgrp_array = $dbobj->getEmpBldGrp();


?>
				
				
							<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Name :</span>
												<input <?php echo $disabled;?> type="text" name="name_first" id="name_first" class="form-control" placeholder="Employee Name" value="">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Gender :</span>
													<select <?php echo $disabled;?> id="gender" name="gender" class="form-control" >
														<option value="0">Select Gender</option>
														<?php
															foreach($gender_array as $val)
															{
																echo '<option value="'.$val->id.'"   '.$selected.' >'.$val->name.'</option>';
															}			
														?>		
													</select>
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Blood Group :</span>
													<select <?php echo $disabled;?> id="blood_grp" name="blood_grp" class="form-control" >
														<option value="0">Select Group</option>
														<?php
															foreach($bldgrp_array as $val)
															{
																echo '<option value="'.$val->id.'"   '.$selected.' >'.$val->name.'</option>';
															}			
														?>		
													</select>
											</div>
											
											
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Birth :</span>
												<input <?php echo $disabled;?> type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Date of Birth" value="">
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
												<span class="input-group-addon ndrftextwidth text-right">Mobile No :</span>
												<input <?php echo $disabled;?> type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No" maxlength="10" value="">
											</div>
											
											
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-6">
											
											
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
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Aadhar No :</span>
												<input <?php echo $disabled;?> type="text" name="aadhar_no" id="aadhar_no" class="form-control" placeholder="Aadhar No" value="<?php echo $employee->aadhar_no ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Emergency No :</span>
												<input <?php echo $disabled;?> type="text" name="emergency_no" id="emergency_no" class="form-control" placeholder="Emergency No" maxlength="10" value="" >
											</div>
											
                                            
                                           										
											
										</div>
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
										
										
									</div>
									
									
									<div class="clearfix"></div>
									
									<div class="col-lg-12" style="padding-top:50px;">
									<div class="bpaddingdiv1 text-center">
									<input type="button" class="btn btn-green btn" value="Update" onClick="updateBasicInfo();">
									</div>
									</div>
									
									<div class="clearfix"></div>
									