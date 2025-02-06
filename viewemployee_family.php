<?php 



?>

				<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Father's Name :</span>
												<input type="text" name="father_name" id="father_name" class="form-control" placeholder="NA" value="<?php echo $empData->fname; ?>" readonly>
											</div>
											
																					
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Emergency Name :</span>
												<input type="text" name="emer_name" id="emer_name" class="form-control" placeholder="NA" value="<?php echo $empData->ename; ?>" readonly>
											</div>
											
											<div class="input-group bmargindiv1 col-md-12" >
											<span class="input-group-addon ndrftextwidth text-right">Address :</span>
											<textarea id="addr1" class="form-control " maxlength="1000" rows="8" name="addr1" style="margin: 0px -0.5px 0px 0px; height: 100px;"readonly><?php echo $empData->address; ?></textarea>
											</div>
											
											
											
											
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-6">
																					
											 
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Mother's Name :</span>
												<input type="text" name="mother_name" id="mother_name" class="form-control" placeholder="NA" value="<?php echo $empData->mname; ?>"readonly>
											</div>	


											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Emergency Mob. :</span>
											<input type="text" name="emer_mobile" id="emer_mobile" class="form-control" placeholder="NA" value="<?php echo $empData->emobile; ?>"readonly>
											</div>
																					
                                        	<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Relationship :</span>
												<input type="text" name="emer_rela" id="emer_rela" class="form-control" placeholder="NA" value="<?php echo $empData->erelationship; ?>"readonly>
											</div>								
											
										</div>
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									
									<div class="clearfix"></div>
									
									
									
									<div class="clearfix"></div>