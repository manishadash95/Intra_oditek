<?php
	$manifacture_lap_array = $dbobj->getAllManifacture();
	$hdd_array = $dbobj->getAllHDDName();


?>	
									
									<div class="col-lg-12">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
												<h4>Service Info</h4>
												</div>
												
											<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
											<div class="portlet-body">
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Tag Id :</span>
											<input type="text" readOnly name="tagid" id="tagid" class="form-control" placeholder="Tag Id" value="" >
											</div>
											</div>
											
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Hostname :</span>
											<input readonly type="text" name="hostname" id="hostname" class="form-control" placeholder="Host Name" >
											</div>
											</div>
											
											<!--
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Status :</span>
											<select id="sstatus" name="sstatus" class="form-control"  >
											<option value="0">Select Status</option>
											<option value="1">In Service</option>
											<option value="2">Out Service</option>
											</select>
											</div>
											</div>
											-->
											
											<!--
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Status :</span>
											<select readyonly id="manifacture" name="manifacture" class="form-control" onchange="loadDiv();" >
											<option value="1">New</option>
											</select>
											</div>
											</div>
											-->
																							
											
											
														
											
											<div class="clearfix"></div>
											</div>
											</div>
										</div>
									</div>
									
									
									<div class="col-lg-12">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4>Device Info</h4>
												</div>
												
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
												<div class="portlet-body">
											
											
																						
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Manufacture :</span>
											<select id="manifacture" name="manifacture" class="form-control" onchange="loadDiv();" >
											<option value="0">Select Manufacture</option>
											<?php
											foreach($manifacture_lap_array as $val)
											{
											echo '<option value="'.$val->id.'">'.$val->name.'</option>';
											}			
											?>		
											</select>
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Model Name :</span>
											<input type="text" name="model" id="model" class="form-control" placeholder="Model Name" >
											</div>
											</div>
											
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Serial No :</span>
											<input type="text" name="serialno" id="serialno" class="form-control" placeholder="" >
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Express No :</span>
											<input type="text" name="expressno" id="expressno" class="form-control" placeholder="" >
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Date of Purchase :</span>
											<input type="date" name="dop" id="dop" class="form-control tcal" placeholder="" >
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Support Expire :</span>
											<input type="date" name="doe" id="doe" class="form-control tcal" placeholder="" >
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Processor :</span>
											<select id="processor" name="processor" class="form-control"  >
											<option value="0">Select Processor</option>
											<option value="QuadCore">QuadCore</option>
											<option value="DualCore">DualCore</option>
											<option value="I3">I3</option>
											<option value="I5">I5</option>
											<option value="I7">I7</option>
											<option value="I9">I9</option>
											</select>
											</div>
											</div>
											
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">HDD Drive :</span>
											<select id="hdd" name="hdd" class="form-control"  >
											<option value="0">Select HDD Drive</option>
											<?php
											foreach($hdd_array as $val)
											{
											echo '<option value="'.$val->id.'">'.$val->name.'</option>';
											}			
											?>		
											</select>
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">RAM Size :</span>
											<select id="ramsize" name="ramsize" class="form-control"  >
											<option value="0">Select RAM Size</option>
											<option value="8">8 GB</option>
											<option value="12">12 GB</option>
											<option value="16">16 GB</option>
											<option value="20">20 GB</option>
											<option value="24">24 GB</option>
											</select>
											</div>
											</div>
											
														
											
											<div class="clearfix"></div>
											</div>
											</div>
										</div>
									</div>
									
									
									
									<div class="col-lg-12">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4> OS Info</h4>
												</div>
												
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
												<div class="portlet-body">
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">OS Type:</span>
											<select id="ostype" name="ostype" class="form-control"   >
											<option value="0">Select OS Type</option>
											<option value="WINDOWS">WINDOWS</option>
											<option value="LINUX">LINUX</option>
											<option value="MAC">MAC</option>
											</select>
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth text-right">OS Name :</span>
											<input type="text" name="osname" id="osname" class="form-control" placeholder="" >
											</div>
											</div>
																								
											
											
											<div class="clearfix"></div>
											</div>
											</div>
										</div>
									</div>
									
									<div class="col-lg-12" id="div_add"  style="display:none" >
										<div class="bpaddingdiv1 text-center">
										<input type="button" name="register1" id="register1" class="btn btn-green btn-md" value="Update" onClick="updateLaptopDevice();">
										</div>
									</div>
									
									
																		
									