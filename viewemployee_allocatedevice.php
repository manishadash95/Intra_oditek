
							
					<form name="newdata" id="newdata" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-4">
																						
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Select Device Type :</span>
											<select id="device" name="device" class="form-control" onchange="loadITallocateDevices();" >
											<option value="0">All Device</option>
											<?php
											foreach($deviceType_array as $val)
											{
												if($device_input == $val->id)
													echo '<option selected value="'.$val->id.'">'.$val->name.'</option>';
												else										
													echo '<option value="'.$val->id.'">'.$val->name.'</option>';
											}			
											?>		
											</select>
											</div>
										</div>
										
										
										<div class="clearfix"></div>
									</div>
									
									
									<div class="totalaligndiv">
									<!--1st_div-->
										
									<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
									            </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                       <th class="center_td" >Sl. No.</th>
														<th class="center_td" >Device Type</th>
														<th class="center_td" >Device Id</th>
														<th class="center_td" >Allocate Date</th>
														<th class="center_td" >Status</th>
														<th class="center_td" >View</th>
														
							                        </tr>
                                                </thead>
                                                <tbody id="DATAFIELD" class="tablefont">
									            </tbody>

                                            </table>
                                        </div>
                                       
                                    </div>


									
										
									<!--end_3rd_div-->
									<div class="clearfix"></div>
									</div>
									
									
														
									<div class="clearfix"></div>
									<!--end_total_employee_div-->
												
									
									
												
									
									
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	<input type="hidden" name="hdevice" id="hdevice"  value="" >
						
					
							</form>
						</div>
					</div>
					<!-- /.col-lg-12 -->

				</div>
			</div>
		</div>

	</div>
	<!-- /.page-content -->

</div>
<?php include 'include/footer.php' ?>