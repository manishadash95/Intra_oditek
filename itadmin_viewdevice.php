<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/ITAdminMgmt.php';
	$dbobj = new ITAdminMgmt();
	$dbobj->connect();
	
	$deviceType_array = $dbobj->getAllDeviceType();
	$today = date("d-m-Y");	
		
	$iv = $_REQUEST['iv'];
	$device = $_REQUEST['device'];
	
	$device_input = $eid = trim($dbobj->get_mcrypt_decrypt($device,$iv));
	
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>
<?php include 'imageupload/popimageupload.php' ?>
<div id="page-wrapper">
	<div class="page-content">

		<!-- begin PAGE TITLE AREA -->
		<!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
		<div class="row">
			
			<div class="col-lg-12">
				<div class="page-title">
					<ol class="breadcrumb">
					<li>View IT Device</li>
					</ol>

				</div>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<!-- end PAGE TITLE AREA -->
	   
	   <!--main_heading_div-->
		<!--search_filed_div-->
		
		<!--end_search_field_div-->
		<!-- /.row -->
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4> View IT Device </h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
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
											<select id="device" name="device" class="form-control" onchange="loadITDevices();" >
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
													<col class="col-md-2 col-sm-2">
									            </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th class="center_td" >Sl. No.</th>
														<th class="center_td" >Device Type</th>
														<th class="center_td" >Device Id</th>
														<th class="center_td" >Manufacture</th>
														<th class="center_td" >Service</th>
														<th class="center_td" >Status</th>
														<th class="center_td" >Assigned To</th>
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



<script>


window.onload = function() {
	
	loadITDevices();
		
};
	
function loadITDevices()
{
	var device = document.getElementById('device').value;
	
	var dataString = "action=viewDeviceList&device="+device;
	//alert(dataString);
	$.ajax({ 
	type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		if(dobj.status==1)
		{
			$("#DATAFIELD").html(dobj.data);
		}
		else{
			alert(dobj.msg);	
		}
	} 
	});
	
	
}	




</script>