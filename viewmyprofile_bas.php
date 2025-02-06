<?php 

$gender_array = $dbobj->getEmpGender();
$bldgrp_array = $dbobj->getEmpBldGrp();


?>
				
				
							<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Name :</span>
												<input <?php echo $disabled;?> type="text" name="name_first" id="name_first" class="form-control" placeholder="Employee Name" value="<?php echo $empData->name; ?>"readonly>
											   </div>
											
											<div class="input-group bmargindiv1 col-md-12">
                                            <span class="input-group-addon ndrftextwidth text-right">Gender :</span>
                                            <input type="text" class="form-control" placeholder="Gender"value="<?php echo $empData->gender; ?>" readonly>
                                            </div>
											
											<div class="input-group bmargindiv1 col-md-12">
                                            <span class="input-group-addon ndrftextwidth text-right">Blood Group :</span>
                                            <input type="text" class="form-control" placeholder="Blood Group" value="<?php echo $empData->blood_grp; ?>" readonly>
                                            </div>

											
											
                                            <div class="input-group bmargindiv1 col-md-12">
										    <span class="input-group-addon ndrftextwidth text-right">Date of Birth :</span>
											<input <?php echo $disabled;?> type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Date of Birth" value="<?php echo $empData->date_of_birth; ?>"readonly>
											</div>
											
											
											
											
										   <div class="input-group bmargindiv1 col-md-12">
                                           <span class="input-group-addon ndrftextwidth text-right">Marriage Status :</span>
                                           <select id="mrg_status" name="mrg_status" class="form-control" readonly>
                                           <option value="0">Select</option>
                                           <option value="1" <?php echo ($empData->mrg_status == 1) ? 'selected' : ''; ?>>Unmarried</option>
                                           <option value="2" <?php echo ($empData->mrg_status == 2) ? 'selected' : ''; ?>>Married</option>
                                           </select>
                                           </div>
											
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">Mobile No :</span>
										<input <?php echo $disabled;?> type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No" maxlength="10" value="<?php echo $empData->mobile; ?>"readonly>
										</div>
											
											
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-6">
																					
											
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Email Id :</span>
											<input <?php echo $disabled;?> type="text" name="email1" id="email1" class="form-control" placeholder="Email id" value="<?php echo $empData->email ?>"readonly>
											</div>	

											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Skype Id :</span>
											<input <?php echo $disabled;?> type="text" name="skype" id="skype" class="form-control" placeholder="Skype id" value="<?php echo $empData->skype_id ?>"readonly>
											</div>	
																						
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">PAN No :</span>
												<input <?php echo $disabled;?> type="text" name="pan_no" id="pan_no" class="form-control" placeholder="PAN No" maxlength="10" value="<?php echo $empData->pan_no ?>"readonly>
											</div>
											
											 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Passport No :</span>
												<input <?php echo $disabled;?> type="text" name="passport_no" id="passport_no" class="form-control" placeholder="Passport No" value="<?php echo $empData->passport_no ?>"readonly>
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Aadhar No :</span>
												<input <?php echo $disabled;?> type="text" name="aadhar_no" id="aadhar_no" class="form-control" placeholder="Aadhar No" value="<?php echo $empData->aadhar_no ?>"readonly>


											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Emergency No :</span>
												<input <?php echo $disabled;?> type="text" name="emergency_no" id="emergency_no" class="form-control" placeholder="Emergency No" maxlength="10" value="<?php echo $empData->emergency ?>"readonly>
											</div>
											
                                            
                                           										
											
										</div>
										
									
										
										
									</div>
									
									
														
									<div class="clearfix"></div>
									
									
									
									
								
									