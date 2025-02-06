<?php 
    $allname_array = $dbobj->getAllNameWithBoard();
	$allbu_array = $dbobj->getAllBU();
	$allprm_array = $dbobj->getAllPMGroup();
	$designation_array = $dbobj->getDesignationAll();
	$department_array = $dbobj->getDepartment();
     $emptype_array = $dbobj->getAllEmpType();
	

?>

				<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Date of Join :</span>
											<input type="date" name="joining_date" id="joining_date" class="form-control tcal" placeholder="Date of Join" value="<?php echo $empData->joining_date; ?>" readonly>
											</div>	
											
										  <div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Employee Type :</span>
														<select disabled id="employee_type" name="employee_type" class="form-control" ">
															<option value="0">Select Status</option>
															<?php
																foreach($emptype_array as $val)
																{
																	$selected = ( $empData->emptype == $val->code)?'selected':'';
																	echo '<option value="'.$val->code.'"  '.$selected.' >'.$val->name.'</option>';
																}			
															?>								
															</select>
									
											</div>
										
										
										
										
										
										
										
										
											
											<div class="input-group bmargindiv1 col-md-12" >
											<span class="input-group-addon ndrftextwidth text-right">Probation Period:</span>
											<input type="text" name="prob_dura" id="prob_dura" class="form-control" placeholder="0" value="<?php echo $empData->pro_duration; ?>" readonly>
											</div>


                               <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Business Unit :</span>
														<select disabled  id="bu_id" name="bu_id" class="form-control" ">
															<option value="0">Select Department</option>
															<?php
																foreach($allbu_array as $val)
																{
																	$selected = ( $empData->bu == $val->id)?'selected':'';
																	echo '<option value="'.$val->id.'"  '.$selected.' >'.$val->name.'</option>';
																}			
															?>														
														</select>
												</div>	



                                              <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">PrM Group :</span>
														<select disabled  id="prm_id" name="prm_id" class="form-control" ">
															<option value="0">Select Department</option>
															<?php
																foreach($allprm_array as $val)
																{
																	$selected = ( $empData->pro_grp_id == $val->id)?'selected':'';
																	echo '<option value="'.$val->id.'"  '.$selected.' >'.$val->name.'</option>';
																}			
															?>														
														</select>
												          </div>
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
											
												
										
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-6">
										
										
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">Date of Exit :</span>
										<input type="date" name="exit_date" id="exit_date" class="form-control tcal" placeholder="Date of Exit" value="<?php echo $empData->exit_date; ?>" readonly>
										</div>
										
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">End of Probation :</span>
										<input type="date" name="end_probation" id="end_probation" class="form-control tcal " placeholder="End of Probation" value="<?php echo $empData->pro_end_date; ?>" readonly>
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
										<span class="input-group-addon ndrftextwidth text-right">BU Head :</span>
										<input type="text" readOnly name="bu_head" id="bu_head" class="form-control" placeholder=""readonly >
										</div>
										
										
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">PrM Head :</span>
										<input type="text" readOnly name="prm_head" id="prm_head" class="form-control" placeholder=""readonly>
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
										
										
										</div>
										
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									
									<div class="clearfix"></div>
									
									
									
									<div class="clearfix"></div>