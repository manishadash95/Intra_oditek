<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
	$iv = $_REQUEST['iv'];
	
	$empList = $dbobj->getBUActiveEmployeeName();
	
	$emp_id = $_REQUEST['emp_id'];
	$iv = $_REQUEST['iv'];
	$emp_id = trim($dbobj->get_mcrypt_decrypt($emp_id,$iv));
	$category_array = $dbobj->getAllWFHcategory();
	$month_array = $dbobj->getWFHRestMonths();
	
	
	
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
						<li class="active">Manage Resource WFH</li>
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
									<h4> Manage Resource WFH</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="ENTRYDATA" id="ENTRYDATA" method="post" enctype="multipart/form-data" >
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
									<input type="text" readOnly id="emp_name" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Emp. Id :</span>
									<input type="text" readOnly id="emp_id" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Reporting Mgr. :</span>
									<input type="text" readOnly id="uname" class="form-control" placeholder="" value="">
									</div>
									</div>


									</div>
									
									
									<div class="col-md-12">
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">BU :</span>
									<input type="text" readOnly id="bu_id" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Team :</span>
									<input type="text" readOnly id="team_id" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Designation :</span>
									<input type="text" readOnly id="desig" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									</div>
									
									<div class="col-md-12">
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Category :</span>
									<select id="cat_id" name="cat_id" class="form-control" onchange="loadCategory();">
									<?php
									foreach($category_array as $val)
									{
										echo '<option value="'.$val->id.'">'.$val->category.'</option>';
									}			
									?>														
									</select>
									</div>
									</div>
									
									<div class="col-md-4" id="monthdivid" style="display:none">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Month :</span>
									<select id="month_id" name="month_id" class="form-control" >
									<option value="0">Select Month</option>
									<?php
									foreach($month_array as $val)
									{
										echo '<option value="'.$val->monthid.'">'.$val->monthname.'</option>';
									}			
									?>														
									</select>
									</div>
									</div>
									
									<div class="col-md-4" id="daysdivid" style="display:none">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Total Days :</span>
									<input type="text"  id="days_id" name="days_id" class="form-control" placeholder="" value="1">
									</div>
									</div>
									
									</div>
									
										
									
									<div class="bpaddingdiv1 text-center">
									<input type="button" name="add1" id="add1" class="btn btn-green btn-md" value="Add" onclick="addWFHEntry();">
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
													<col class="col-md-3 col-sm-3">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
								                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Employee Id</th>
														<th>Name</th>
														<th>BU</th>
														<th>Category</th>
														<th>Month</th>
                                                        <th>Total Days</th>
														<th>Available Days</th>
														<th>Delete</th>
							                        </tr>
                                                </thead>
                                                <tbody id="WFHFIELD" class="tablefont">
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
									<h4> View Resource WFH Records</h4>
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
														<th>Emp Id</th>
														<th>Name</th>
														<th>Id</th>
														<th>Type</th>
                                                        <th>Start Date</th>
														<th>End Date</th>
														<th>No of Days</th>
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
			
			
			
			
			
			
			
			
			
			
			
		</div>

	</div>
	<!-- /.page-content -->

</div>





<?php include 'include/footer.php' ?>


<script>


window.onload = function() {
	
	loadWFHResourceCounts();
	loadWFHRecordsData();
	var heid = document.getElementById( 'heid').value;
	
	if(heid > 0)
		autoLoadResourceData(heid);
		
	};
	

function autoLoadResourceData(heid)
{
	loadResourceData();
}


function resetAllFiels()
{
	var emp_name = document.getElementById( 'emp_name');
	var emp_id = document.getElementById( 'emp_id');
	var uname = document.getElementById( 'uname');
	var bu_id = document.getElementById( 'bu_id');
	var team_id = document.getElementById( 'team_id');
	var desig = document.getElementById( 'desig');
	emp_name.value = "";
	emp_id.value = "";
	uname.value = "";
	bu_id.value = "";
	team_id.value = "";
	desig.value = "";
}	
	
function loadResourceData()
{
	var reso_id = document.getElementById( 'reso_id').value;
	loadWFHResourceCounts();	
	if(reso_id == 0)
	{
		resetAllFiels();
		return false;
	}
	var emp_name = document.getElementById( 'emp_name');
	var emp_id = document.getElementById( 'emp_id');
	var uname = document.getElementById( 'uname');
	var bu_id = document.getElementById( 'bu_id');
	var team_id = document.getElementById( 'team_id');
	var desig = document.getElementById( 'desig');
	
		
	var dataString = "action=loadResoData&eid="+reso_id;
	$.ajax({ 
		type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				emp_name.value = dobj.emp_name;
				emp_id.value = dobj.emp_id;
				uname.value = dobj.uname;
				bu_id.value = dobj.bu_name;
				team_id.value = dobj.team_name;
				desig.value = dobj.designation;
			}
			else{
				//alert(dobj.msg);
				//location.reload();
			}
		} 
	});
	
	loadWFHRecordsData();
	
			
}	

function loadWFHRecordsData()
{
	var reso_id = document.getElementById( 'reso_id').value;
	var dataString = "action=loadResoAllWFH&eid="+reso_id;
	$.ajax({ 
		type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
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

function loadWFHResourceCounts()
{
	var reso_id = document.getElementById( 'reso_id').value;
	var dataString = "action=loadWFHResourceCounts&eid="+reso_id;
		$.ajax({ 
			type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#WFHFIELD").html(dobj.data);
					
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
			} 
		});
	
	
}	

function loadCategory()
{
	var cat_id = document.getElementById( 'cat_id').value;
	var monthdivid = document.getElementById( 'monthdivid');
	var daysdivid = document.getElementById( 'daysdivid');
	if(cat_id == 1) //Always
	{
		monthdivid.style.display = "none";
		daysdivid.style.display = "none";
	}else{
		monthdivid.style.display = "block";
		daysdivid.style.display = "block";
	}
	
}

function actionEdit(id)
{
	alert("Edit:"+id);
}

function actionDelete(id)
{
	if(confirm("Are you sure want to delete?"))
	{
		var dataString = "action=deleteWFHEntry&id="+id;
		$.ajax({ 
			type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					alert(dobj.msg);	
					location.reload();
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
			} 
		});
		
	}
}

function addWFHEntry()
{
	
	var reso_id = document.getElementById( 'reso_id').value;
	var emp_name = document.getElementById( 'emp_name').value;
	var emp_id = document.getElementById( 'emp_id').value;
	var cat_id = document.getElementById( 'cat_id').value;
	var month_id = document.getElementById( 'month_id').value;
	var days = document.getElementById( 'days_id').value;
	if(reso_id == 0)
	{
		alert("Please select employee name");
		return false;
	}
		
	if(cat_id ==2)
	{
		
		if(month_id == 0)
		{
			alert("Please select month name");
			return false;
		}
		if(days =="")
		{
			alert("Please add number of days");
			return false;
		}
		if(isNaN(days))
		{
			alert("Please add a valid numeric number");
			return false;
		}
		if(days < 0)
		{
			alert("Please add a valid numeric number");
			return false;
		}
			
		
	}
	
	
	var dataString = "action=addWFHEntry&";
		dataString +=$( "#ENTRYDATA" ).serialize();
	//alert(dataString);
	
		
	$.ajax({ 
		type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				alert(dobj.msg);	
				location.reload();
			}
			else{
				alert(dobj.msg);
			}
		} 
	});
	
	
	
}

</script>