<?php 


?>

				<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
                                            <span class="input-group-addon ndrftextwidth text-right">Past Experience:</span>
                                           <select id="exp_type" name="exp_type" class="form-control" onchange="updatePastExp();" <?php echo ($empData->prev_exp == 0) ? 'readonly' : ''; ?>>
                                          <option value="0">NO</option>
                                          <option value="1">YES</option>
                                          </select>
                                          </div>

											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">Prev. Org.:</span>
											<input type="text" name="prev_org" id="prev_org" class="form-control"  value="<?php echo $empData->prev_org; ?>" readonly>
											</div>
										
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-3">
										<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
										<span class="input-group-addon ndrftextwidth text-right">Year:</span>
										<input type="text" name="exp_yr" id="exp_yr" class="form-control"  value="<?php echo $empData->exp_year; ?>"readonly  >
										</div>
										</div>
										
										
										<div class="col-md-3">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">Month:</span>
											<input type="text" name="exp_mn" id="exp_mn" class="form-control"  value="<?php echo $empData->exp_month; ?>"readonly >
											</div>
										</div>
										
										
										<div class="col-md-12">
										<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
										<span class="input-group-addon ndrftextwidth text-right">Skills.:</span>
										<input type="text" name="skills" id="skills" class="form-control"  value="<?php echo $empData->skills;?>"readonly  >
										</div>
										</div>

										
											
										
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									
									
									<div class="clearfix"></div>
									
									
									
									<div class="clearfix"></div>