										  <div class="totalaligndiv">
											<!--1st_div-->
											<div class="col-md-6">
												
											   <div class="input-group bmargindiv1 col-md-12">
											   <span class="input-group-addon ndrftextwidth text-right">Office Email :</span>
											<input readonly type="text" name="email_office" id="email_office" class="form-control" placeholder="Email" maxlength="30" value="<?php echo $empData->office_email; ?>" >
											  </div>
												
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Department :</span>
														<select disabled  id="dept_id" name="dept_id" class="form-control" ">
															<option value="0">Select Department</option>
															<?php
																foreach($department_array as $val)
																{
																	$selected = ( $empData->dept_id == $val->id)?'selected':'';
																	echo '<option value="'.$val->id.'"  '.$selected.' >'.$val->name.'</option>';
																}			
															?>														
														</select>
												</div>
												
												
												<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Employee Id :</span>
														<input type="text" name="employeeid" id="employeeid" class="form-control" placeholder="Employee Id" value="<?php echo $empData->eid ?>" readonly>
												</div>
												
											
											</div>
											<!--end_1st_div-->
											<!--2nd_div-->
											<div class="col-md-6">
											
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Report To :</span>
														<select readonly disabled id="upper_id" name="upper_id" class="form-control" ">
															<option value="0">Select Name</option>
															<?php
																foreach($allname_array as $val)
																{
																	$selected = ( $empData->upper_id == $val->id)?'selected':'';
																	echo '<option value="'.$val->id.'"   '.$selected.' >'.$val->name.'</option>';
																}			
															?>														
														</select>
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Designation :</span>
														<select disabled id="desig_id" name="desig_id" class="form-control" ">
															<option value="0">Select Designation</option>
															<?php
																foreach($designation_array as $val)
																{
																	$selected = ( $empData->desig_id == $val->id)?'selected':'';
																	echo '<option value="'.$val->id.'"  '.$selected.' >'.$val->name.'</option>';
																}			
															?>								
															</select>
									
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Login Id :</span>
											<input type="text" name="userid" id="userid" class="form-control" placeholder="User Id" readonly value="<?php echo $empData->office_email ?>">
										 </div>									
										
											</div>
											
											
											
											
											<div class="col-md-12">
														<div class="tpaddingdiv1 text-center">
														<a href="mypasswdchange.php">
														<input type="button" class="btn btn-md btn-red " value="Change Password" style="height:30px; width:160px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
														</a>
														</div>
														</div>

											<!--end_2nd_div-->
											<!--3rd_div-->
											
											<!--end_3rd_div-->
											<div class="clearfix"></div>
										</div>
										
										
										<div class="clearfix"></div>
										
										
										
										<div class="clearfix"></div>
										
										
										
										
										

												
												
												
												
												
												
												