<?php
$manifacture_lap_array = $dbobj->getAllManifactureMobile();
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
											<input type="text" readOnly name="ctagid" id="ctagid" class="form-control" placeholder="Tag Id" value="" >
											</div>
											</div>
											
								
								
									
								

								<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
										<span class="input-group-addon ndrftextwidth2 text-right">Hostname :</span>
										<input readonly type="text" name="chostname" id="chostname" class="form-control" placeholder="Host Name">
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
										<select id="cmanifacture" name="cmanifacture" class="form-control" onchange="loadDiv();">
											<option value="0">Select Manifacture</option>
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
										<input type="text" name="cmodel" id="cmodel" class="form-control" placeholder="Model Name">
									</div>
								</div>

								<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
										<span class="input-group-addon ndrftextwidth2 text-right">Date of Purchase :</span>
										<input type="date" name="cdop" id="cdop" class="form-control tcal" placeholder="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
										<span class="input-group-addon ndrftextwidth2 text-right">Processor :</span>
										<select id="cprocessor" name="cprocessor" class="form-control">
											<option value="0">Select Processor</option>
											<option value="Android">Android</option>
											<option value="IOS">IOS</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
										<span class="input-group-addon ndrftextwidth2 text-right">RAM Size :</span>
										<select id="cramsize" name="cramsize" class="form-control">
											<option value="0">Select RAM Size</option>
											<option value="2">2 GB</option>
											<option value="4">4 GB</option>
											<option value="8">8 GB</option>
											<option value="16">16 GB</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
										<span class="input-group-addon ndrftextwidth2 text-right">Storage Capacity :</span>
										<select id="storage" name="storage" class="form-control">
											<option value="0">Select Storage</option>
											<option value="32GB">32 GB</option>
											<option value="64GB">64 GB</option>
											<option value="128GB">128 GB</option>
											<option value="256GB">256 GB</option>
										</select>
									</div>
								</div>

								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-12" id="div_add" style="display:none">
					<div class="bpaddingdiv1 text-center">
						<input type="button" name="register1" id="register1" class="btn btn-green btn-md" value="Update" onClick="updateMobileDevice();">
					</div>
				</div>
