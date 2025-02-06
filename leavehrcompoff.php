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
						<li class="active">View Comp Off Leave</li>
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
									<h4> View Comp Off Leave</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="editdata" id="editdata" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
			
			
									<div class="col-md-12">
										
									<div class="col-md-12">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Select Resource :</span>
									<select id="reso_id" name="reso_id" class="form-control chosen-select" onchange="loadResourceData();"  >
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
									
									<input type="hidden" id="heid" value="">
									
									<div class="col-md-12" style="display:none;">
									<div class="bpaddingdiv1 text-center">
									<button type="button" class="btn btn-default " name="btnsubmit" onclick="loadResourceData();" id="btnsubmit">View</button> 
									</div>
									</div>	

									<div class="col-md-12">
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Emp. Name :</span>
									<input type="text" readOnly id="emp_name" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
																										
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Reporting Mgr. :</span>
									<input type="text" readOnly id="uname" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									<div class="col-md-4" id="start_date_block" >
									<div class="input-group bmargindiv1 col-md-12">
									<span class="input-group-addon ndrftextwidth text-right">Comp Off Date :</span>
									<input type="date" name="comp_date" id="comp_date" class="form-control tcal" placeholder="Start Date"  >
									</div>
									</div>


									</div>
									
									
									<div class="col-md-12" style="display:block`">
									
									
									
									</div>

									<div class="col-md-12" id="notediv" style="display:none;" >
		
									<div class="col-md-12" >
									<div class="input-group bmargindiv1 col-md-12">
									<span  class="input-group-addon ndrftextwidth text-right">Note :</span>
									<textarea id="text1" class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
									</div>
									</div>
																											
									</div>	

									<div class="col-md-12" id="updatediv" style="display:none;">
									<div class="bpaddingdiv1 text-center">
									<button type="button" class="btn btn-default " onclick="addCompOffLeave();" >Add</button> 
									</div>
									</div>
													
																	
									
									
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
									<h4> View Comp Off Leaves</h4>
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
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
								                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Date</th>
														<th>Emp. Id</th>
														<th>Emp. Name</th>
														<th>Reporting Mgr.</th>
														<th>Comp Off Date</th>
														<th>Expired Date</th>
														<th>Status</th>
														<th>Leave Id</th>
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
	
	
	//loadResourceLeaveCounts();
	loadCompOffLeaves();
	
			
	};
	

function autoLoadResourceData(heid)
{
	//loadResourceData();
}
	
	
function loadResourceData()
{
	var reso_id = document.getElementById( 'reso_id').value;
	
	if(reso_id == 0)
	{
		alert("Please select Resource");
		return false;
	}
	var emp_name = document.getElementById( 'emp_name');
	var uname = document.getElementById( 'uname');
	var emp_id = document.getElementById( 'heid');
	
	
		
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
				updatediv.style.display = "block";
				notediv.style.display = "block";
				
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
		

function loadCompOffLeaves()
{
	var dataString = "action=loadCompOffLeaves";
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
					//alert(dobj.msg);
					//location.reload();
				}
			} 
		});
	
	
}


function addCompOffLeave()
{
	var reso_id = document.getElementById( 'reso_id').value;
	var comp_date = document.getElementById('comp_date').value;
	var desc = document.getElementById('text1').value;
	
	if(comp_date =="" )
	{
		alert("Select comp off date!");
		return false;
	}
	
	if(desc == "" )
	{
		alert("Please add Description...");
		return false;
	}
		
	var dataString = "action=addCompOffLeave&";
		dataString +=$( "#editdata" ).serialize();
		
	//alert(dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				document.getElementById('text1').value="";
				loadCompOffLeaves();
				//loadResourceData();
				
			}
			else{
				
			}
		} 
	});
	
}		

</script>