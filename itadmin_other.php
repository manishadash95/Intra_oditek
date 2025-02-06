<?php
$manifacture_lap_array1 = $dbobj->getAllManifactureOther();
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
											<span class="input-group-addon ndrftextwidth text-center" style="width:0px;cursor: pointer" >IT/OD/</span>
											<input type="text" name="ftagid" id="ftagid" class="form-control" placeholder="Tag Id" value="" onChange="checkTagIdOther()">
									       </div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Hostname :</span>
											<input readonly type="text" name="fhostname" id="fhostname" class="form-control" placeholder="Host Name" >
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
													<h4>Device Info</h4>
												</div>
												
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
												<div class="portlet-body">
																					
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Manufacture :</span>
											<select id="fmanifacture" name="fmanifacture" class="form-control" onchange="loadDiv();" >
											<option value="0">Select Manifacture</option>
											<?php
											foreach($manifacture_lap_array1 as $val)
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
											<input type="text" name="fmodel" id="fmodel" class="form-control" placeholder="Model Name" >
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
											<span class="input-group-addon ndrftextwidth2 text-right">Date of Purchase :</span>
											<input type="date" name="fdop" id="fdop" class="form-control tcal" placeholder="" >
											</div>
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
												<span class="input-group-addon ndrftextwidth2 text-right">Storage Capacity :</span>
												<select id="fstorage" name="fstorage" class="form-control">
													<option value="0">Select Storage</option>
													<option value="128GB">128 GB</option>
													<option value="240GB">240 GB</option>
													<option value="256GB">256 GB</option>
													<option value="512GB">512 GB</option>
													<option value="1TB">1 TB</option>
													
												</select>
											</div>
										</div>

											<div class="clearfix"></div>
											</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12" id="div_add"  style="display:block" >
										<div class="bpaddingdiv1 text-center">
										<input type="button" name="register1" id="register1" class="btn btn-green btn-md" value="Add" onClick="addOtherDevice();">
										</div>
									</div>