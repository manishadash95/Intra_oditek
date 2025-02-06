<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
	$iv = $_REQUEST['iv'];
	
	$empList = $dbobj->getAllActiveEmployeeListName();
	
	$emp_id = $_REQUEST['emp_id'];
	$iv = $_REQUEST['iv'];
	$emp_id = trim($dbobj->get_mcrypt_decrypt($emp_id,$iv));
	
	
	
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
						<li class="active">View Resource Leave Status</li>
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
									<h4> View Resource Leaves Status</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="abc" id="abc" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
			
			
									<div class="col-md-12">
										
									<div class="col-md-12">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Select Resource :</span>
									<select id="reso_id" name="reso_id" class="form-control chosen-select"  onChange="loadResourceData()" >
									<option value="0" >Select Resource</option>
									<?php foreach($empList as $emp){ 
									$select="";
									if($emp_id > 0 && $emp->eid == $emp_id)
										$select = "selected";
									?>
									<option value="<?php echo $emp->eid; ?>" <?php echo $select;?> > <?php echo $emp->name; ?></option>
									<?php } ?>
									</select>
									</div>
									</div>
																				
									</div>
									
									<input type="hidden" id="heid" value="<?php echo $emp_id; ?>">
									
									<!-- div class="col-md-12">
									<div class="bpaddingdiv1 text-center">
									<button type="button" class="btn btn-default " name="btnsubmit" onclick="loadResourceData();" id="btnsubmit">View</button> 
									</div>
									</div -->	

									<div class="col-md-12">
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Emp. Name :</span>
									<input type="text" readOnly id="emp_name" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Emp. Id :</span>
									<input type="text" readOnly id="emp_id" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Reporting Mgr. :</span>
									<input type="text" readOnly id="uname" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>


									</div>
									
									
									<div class="col-md-12">
									
									<div class="col-md-3">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Paid [C/A] :</span>
									<input type="text" readOnly id="paidc" class="form-control" placeholder="" value="0">
									</div>
									</div>
									
									<div class="col-md-3">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">UnPaid [C/A] :</span>
									<input type="text" readOnly id="unpaidc" class="form-control" placeholder="" value="0">
									</div>
									</div>
									
									<div class="col-md-3">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Special [C/A] :</span>
									<input type="text" readOnly id="specialc" class="form-control" placeholder="" value="0">
									</div>
									</div>
									
									<div class="col-md-3">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Maternity [C/A] :</span>
									<input type="text" readOnly id="maternityc" class="form-control" placeholder="" value="0">
									</div>
									</div>


									</div>
									
									
									<div class="col-md-12" style="display:none">
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Max Paid :</span>
									<input type="text" readOnly id="m_paid" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Max Unpaid :</span>
									<input type="text" readOnly id="m_unpaid" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									<!--	
									<div class="col-md-3">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Max Special :</span>
									<input type="text" readOnly id="m_special" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									-->
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Max Earned :</span>
									<input type="text" readOnly id="m_earned" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>


									</div>
									
									<div class="col-md-12" style="display:none" >
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Available Paid :</span>
									<input type="text" readOnly id="a_paid" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Available Unpaid :</span>
									<input type="text" readOnly id="a_unpaid" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									<!--
									<div class="col-md-3">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Available Special :</span>
									<input type="text" readOnly id="a_special" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									-->
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Available Earned :</span>
									<input type="text" readOnly id="a_earned" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>


									</div>
									
									
									<div class="col-md-12">
									
									<!--total_employee_div-->
									<div class="totalaligndiv">
										
										
									<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
								                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Created Date</th>
														<th>Id</th>
														<th>Type</th>
                                                        <th>Start Date</th>
														<th>End Date</th>
														<th>No of Leaves</th>
														<th>Status</th>
														<th>View</th>
							                        </tr>
                                                </thead>
                                                <tbody id="DATAFIELD" class="tablefont">
									            </tbody>

                                            </table>
                                        </div>
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											<ul class="pagination pull-right margintopzerodiv">
												 <?php //echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?>
											</ul>  
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
										
										
								
										
										
										
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									</div>
									<!--end_total_employee_div-->
									<!--login_informations_div-->
							
									<!--end_login_information_div-->
									
									
									<!--permission_informations_div-->
					
									
									<!--end_permission_information_div-->
									<!--allowances_deduction_div-->
			
									<!--end_allowances_deduction_div-->
                                    <!--final_deduction_div-->
                            
                                    <!--end_final_deduction_div-->
									<!--netpay_information_div-->
				
									<!--end_netpay_information_div-->
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                       	</form>
						</div>
					</div>
					<!-- /.col-lg-12 -->

				</div>
			</div>
			
			
			
			
			
			
			
			
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4> View Resource Leaves Counts</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="abc" id="abc" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
												
									
									<div class="col-md-12">
									
									<!--total_employee_div-->
									<div class="totalaligndiv">
										
										
									<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-3 col-sm-3">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
								                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Emp. Id</th>
														<th>Name</th>
														<th>Gender</th>
														<th>Emp. Type</th>
														<th>Paid[A/T]</th>
														<th>Unpaid[A/T]</th>
														<th>Special[A/T]</th>
														<th>Compup[A/T] </th>
                                                        <th>Maternity[A/T]</th>
														<th>Reporting Mgr.</th>
								                    </tr>
                                                </thead>
                                                <tbody id="LEAVEFIELD" class="tablefont">
									            </tbody>

                                            </table>
                                        </div>
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											<ul class="pagination pull-right margintopzerodiv">
												 <?php //echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?>
											</ul>  
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
										
										
								
										
										
										
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									</div>
									<!--end_total_employee_div-->
									<!--login_informations_div-->
							
									<!--end_login_information_div-->
									
									
									<!--permission_informations_div-->
					
									
									<!--end_permission_information_div-->
									<!--allowances_deduction_div-->
			
									<!--end_allowances_deduction_div-->
                                    <!--final_deduction_div-->
                            
                                    <!--end_final_deduction_div-->
									<!--netpay_information_div-->
				
									<!--end_netpay_information_div-->
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
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
	
	loadResourceLeaveCounts();
	
	var heid = document.getElementById( 'heid').value;
	
	if(heid > 0)
		autoLoadResourceData(heid);
		
	};
	

function autoLoadResourceData(heid)
{
	loadResourceData();
}
	
	
function loadResourceData()
{
	var reso_id = document.getElementById( 'reso_id').value;
	loadResourceLeaveCounts(reso_id);	
	if(reso_id == 0)
	{
		//alert("Please select Resource");
		return false;
	}
	var emp_name = document.getElementById( 'emp_name');
	var emp_id = document.getElementById( 'emp_id');
	
	var uname = document.getElementById( 'uname');
	var m_paid = document.getElementById( 'm_paid');
	var m_unpaid = document.getElementById( 'm_unpaid');
	//var m_special = document.getElementById( 'm_special');
	var m_earned = document.getElementById( 'm_earned');
	var a_paid = document.getElementById( 'a_paid');
	var a_unpaid = document.getElementById( 'a_unpaid');
	var a_special = document.getElementById( 'a_special');
	var a_earned = document.getElementById( 'a_earned');
	var paidc = document.getElementById( 'paidc');
	var unpaidc = document.getElementById( 'unpaidc');
	var specialc = document.getElementById( 'specialc');
	var maternityc = document.getElementById( 'maternityc');
	
		
	var dataString = "action=loadResoLeaveRecords&eid="+reso_id;
	$.ajax({ 
		type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				//$("#DATAFIELD").html(dobj.data);
				
				emp_name.value = dobj.emp_name;
				emp_id.value = dobj.emp_id;
				uname.value = dobj.uname;
				//alert(":::"+dobj.paid_field);
				//leave counts
				//m_paid.value = dobj.m_paid;
				//m_unpaid.value = dobj.m_unpaid;
				//m_special.value = dobj.m_special;
				//m_earned.value = dobj.m_earned;
				//a_paid.value = dobj.a_paid;
				//a_unpaid.value = dobj.a_unpaid;
				//a_special.value = dobj.a_special;
				//a_earned.value = dobj.a_earned;
				paidc.value = dobj.paid_field;
				unpaidc.value = dobj.unpaid_field;
				specialc.value = dobj.special_field;
				maternityc.value = dobj.maternity_field;
				
			}
			else{
				//alert(dobj.msg);
				//location.reload();
			}
		} 
	});
	
	var dataString = "action=loadResoAllLeaveRequest&eid="+reso_id;
	$.ajax({ 
		type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#DATAFIELD").html(dobj.data);
			}
		} 
	});
	
			
}	
		

function loadResourceLeaveCounts()
{
	var reso_id = document.getElementById( 'reso_id').value;
	var dataString = "action=loadResourceLeaveCounts1&eid="+reso_id;
		$.ajax({ 
			type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#LEAVEFIELD").html(dobj.data);
					
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
			} 
		});
	
	
}	

</script>