<?php 

$emptype_array = $dbobj->getAllEmpType();
?>

				<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Start Date :</span>
											<input type="date" name="notice_start_date" id="notice_start_date" class="form-control tcal" placeholder="" onchange="actionNotice()" >
											</div>	
											
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">End Date :</span>
											<input type="text" disabled name="notice_end_date" id="notice_end_date" class="form-control" placeholder="">
											</div>
											
											
										
										
											
										
											
																															
										
												
										
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-6">
										
										
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Notice Period:</span>
										<select id="notice_period" name="notice_period" class="form-control" onchange="actionNotice()"  >
										<option value="0" >Select Period</option>
										<option value="2" >2 Months</option>
										<option value="3" >3 Months</option>
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
									<input type="button" class="btn btn-green btn" value="Update" onClick="updateNoticeInfo();">
									</div>
									</div>
									
									<div class="clearfix"></div>