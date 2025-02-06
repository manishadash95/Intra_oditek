

				<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
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
												<input <?php echo $disabled;?> type="text" name="aadhar_no" id="aadhar_no" class="form-control" placeholder="Aadhar No" value="<?php echo $employee->passport_no ?>">
											</div>
											
                                            
                                           										
											
										</div>
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>