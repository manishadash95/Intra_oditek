<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
	$iv = $_REQUEST['iv'];
	
	$empList = $dbobj->getAllActiveEmployeeListNameExceptMgmt();
	
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
						<li class="active">Resource Leave Report</li>
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
									<h4>Generate Resource Leaves Report</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="abc" id="abc" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
									
									<div class="col-md-12">
									
									<div class="col-md-4" >	
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Report Type :</span>
									<select id="report_type" name="report_type" class="form-control" onchange="updateFields()"  >
									<option value="0" >Select Report Type</option>
									<option value="1" >Leave Summary</option>
									<option value="2" >Leave Details</option>
									<option value="3" >Absent Details</option>
									</select>
									</div>
									</div>
									
									<div class="col-md-4" >
									<div class="input-group bmargindiv1 col-md-12">
									<span class="input-group-addon ndrftextwidth text-right">Start Date :</span>
									<input type="date" name="start_date" id="start_date" class="form-control tcal" placeholder="Start Date" onchange="updateCount(1,event)" >
									</div>
									</div>
																	
									<div class="col-md-4"  >
									<div class="input-group bmargindiv1 col-md-12">
									<span class="input-group-addon ndrftextwidth text-right">End Date :</span>
									<input type="date" name="end_date" id="end_date" class="form-control tcal" placeholder="End Date" onchange="updateCount(2,event)">
									</div>
									</div>
																				
									</div>
									
			
									<div class="col-md-12">
										
									<div class="col-md-12">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Select Resource :</span>
									<select id="reso_id" name="reso_id" class="form-control chosen-select"  onChange="loadResourceData()" >
									<option value="0" >All Resources</option>
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
																		
									
									<div class="col-md-12">
									
									<div class="col-md-12">
                                    <div class="tpaddingdiv1 text-center">
                                    <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return actionGenerateReport()">Generate Report</button>
									</div>
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

function checkValidation()
{
	var report_type =  document.getElementById('report_type').value;
	var reso_id =  document.getElementById('reso_id').value;
	var start_date =  document.getElementById('start_date').value;
	var end_date =  document.getElementById('end_date').value;
	
	
	if(report_type == 0) {
		alert("Please select report type...");
		return false;
	}
	
	if(start_date.length == 0) {
		alert("Please select start date...");
		return false;
	}
	
	if(end_date.length == 0) {
		alert("Please select end date...");
		return false;
	}
	
			
	return true;
}


function actionGenerateReport(){

	
	var ret = checkValidation();
	if(!ret)
		return false;
	
	document.getElementById('loading_data').style.display = "block";
	
	var report_type =  document.getElementById('report_type').value;
	var reso_id =  document.getElementById('reso_id').value;
	var start_date =  document.getElementById('start_date').value;
	var end_date =  document.getElementById('end_date').value;
	
	var dataString = "";
	if(report_type == 1)
		dataString = "action=generateLeaveSummary&start_date="+start_date+"&end_date="+end_date+"&emp_id="+reso_id;
	else if (report_type == 2)
		dataString = "action=generateLeaveDetails&start_date="+start_date+"&end_date="+end_date+"&emp_id="+reso_id;
	else if(report_type == 3)
		dataString = "action=generateAbsentDetails&start_date="+start_date+"&end_date="+end_date+"&emp_id="+reso_id;

	//alert(dataString);	
	$.ajax({ 
		type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				var dpath=dobj.file_name;
				var a = document.createElement("a");
				document.body.appendChild(a);
		        a.href = dobj.file_path;
		        a.download =dpath;
		        a.target='_blank';
		        a.click();
		
			}
			else{
				alert(dobj.msg);
			}
			document.getElementById('loading_data').style.display="none";
		} 
	});
	
	
}

</script>