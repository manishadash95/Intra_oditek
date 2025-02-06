<?php 

	$allname_array = $dbobj->getAllNameWithBoard();
	$allbu_array = $dbobj->getAllBU();
	$allprm_array = $dbobj->getAllPMGroup();
	$designation_array = $dbobj->getDesignationAll();
	$department_array = $dbobj->getDepartment();
?>

				<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Business Unit :</span>
											<select id="bu_id" name="bu_id" class="form-control" >
											<option value="0">Select BU</option>
											<?php
												foreach($allbu_array as $val)
												{
													echo '<option value="'.$val->id.'">'.$val->name.'</option>';
												}			
											?>														
											</select>
											</div>	
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">PrM Group :</span>
											<select id="prm_id" name="prm_id" class="form-control" >
											<option value="0">General</option>
											<?php
												foreach($allprm_array as $val)
												{
													echo '<option value="'.$val->id.'">'.$val->name.'</option>';
												}			
											?>														
											</select>
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Report To :</span>
											<select id="upper_id" name="upper_id" class="form-control" >
											<option value="0">Select Name</option>
											<?php foreach($allname_array as $val){ 
											?>
											<option value="<?php echo $val->id; ?>" > <?php echo $val->name; ?></option>
											<?php } ?>											
											</select>
											</div>
											
											
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Department :</span>
											<select id="dept_id" name="dept_id" class="form-control ">
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
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-6">
										
										
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">BU Head :</span>
										<input type="text" readOnly name="bu_head" id="bu_head" class="form-control" placeholder="">
										</div>
										
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">PrM Head :</span>
										<input type="text" readOnly name="prm_head" id="prm_head" class="form-control" placeholder="">
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
										
																				
										
										
										
										
									

										
											
										
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									
									
									<div class="clearfix"></div>
									
									<div class="col-lg-12" style="padding-top:50px;">
									<div class="bpaddingdiv1 text-center">
									<input type="button" class="btn btn-green btn" value="Update" onClick="updateBUInfo();">
									</div>
									</div>
									
									<div class="clearfix"></div>