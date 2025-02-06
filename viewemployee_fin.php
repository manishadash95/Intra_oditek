
                         
				                   <div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">PAN No :</span>
												<input  type="text" name="pan_no" id="pan_no" class="form-control" placeholder="PAN No" maxlength="10" value="<?php echo $empData->pan_no ?>">
											</div>
											
										<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Aadhar No :</span>
												<input  type="text" name="aadhar_no" id="aadhar_no" class="form-control" placeholder="Aadhar No" value="<?php echo $empData->aadhar_no ?>">


											</div>
										
										 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Passport No :</span>
												<input  type="text" name="passport_no" id="passport_no" class="form-control" placeholder="Passport No" value="<?php echo $empData->passport_no ?>">
											</div>
										
										
										
										
										
										
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Bank Ac :</span>
												<input  type="text" name="bnk_no" id="bnk_no" class="form-control" placeholder="Bank Ac">
											</div>
											
										
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-6">
										
										
										<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Bank Name :</span>
												<input  type="text" name="bnk_inf" id="bnk_inf" class="form-control" placeholder="Bank Name">
											</div>
										
										<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">IFSC Code :</span>
												<input  type="text" name="ifsc_co" id="ifsc_co" class="form-control" placeholder="IFSC Code">
											</div>									
										
										
										<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">UAN No :</span>
												<input  type="text" name="uan_no" id="uan_no" class="form-control" placeholder="UAN No">
												
											</div>
											
											
										</div>
										<input type="hidden" name="hdloan" id="hdloan"  value="">
							            <input type="hidden" name="update" id="update"  value="1">
										<input type="hidden" name="heid" id="heid"  value="<?php echo $emp_eid;?>">
							           
										
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									
									
									<div class="bpaddingdiv1 text-center">
										 <button type="button" class="btn btn-default" name="register" onclick="checkAndAddData();" id="register">Update</button> 
										</div>
									<div class="clearfix"></div>
									
									
									
									<div class="clearfix"></div>
