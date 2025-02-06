<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$leaveTypeObj = $dbobj->getWFHType();
	$eid = 	$_SESSION["emp_id"];
	
	$cleave = $dbobj->getAvailLeave($eid);
	
	$comfOffList = $dbobj->getCompOffLeaveList($eid);
	
	$obj_emp = $dbobj->getEmployeeAccess($eid);
	
	$wfhAllow = $obj_emp->wfh;
	
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
						<li class="active">View My WFH Request</li>
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
									<h4> View My Open WFH Requests</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="abc" id="abc" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
								
								<?php if($wfhAllow){?>
								<a href="javascript://" data-dismiss="modal" data-toggle="modal" data-target="#viewemployeelistdiv" >
								<input type="button" class="btn btn-md btn-red " value="New Request" style="height:30px; width:100px; padding:2px 5px; font-size:14px;margin-bottom:10px;">
								</a>
								<?php }?>
								<input type="hidden" value="<?php echo $wfhAllow;?>" id="hwfh">
								
									<!--total_employee_div-->
									<div class="totalaligndiv">
									
									<?php if($wfhAllow){?>

									<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
									            </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Category</th>
														<th>Month</th>
														<th>Total Days</th>
														<th>Available Days</th>
							                        </tr>
                                                </thead>
                                                <tbody id="INFODATAFIELD" class="tablefont">
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
									<?php }?>
									<div class="clearfix"></div>
										
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
										
										
								<a href="wfh_closedmyrequest.php" >
								<input type="button" class="btn btn-md btn-silver " value="Closed Request" style="height:30px; width:120px; padding:2px 3px; font-size:14px;margin-bottom:5px;">
								</a>	
										
										
										
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
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


<div class="modal fade" id="viewemployeelistdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
  <form name="frmemployee" id="frmemployee" method="post">
    <div class="modal-content">
      
	  
	  <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title " id="myModalLabel">New WFH/Flexi Time Request</h4>
      </div>
      
	  <div class="modal-body">
	  
	 
	   
	   
        <div class="totalaligndiv">
			
		
		<div class="col-md-12">
		
		<div class="col-md-6">
		<div class="input-group bmargindiv1 col-md-12" >
		<span class="input-group-addon ndrftextwidth text-right" style="width:207px">Request Type :</span>
		<select id="leave_type" name="leave_type" class="form-control"  >
		<option value="0" >Select Type Type</option>
		<?php foreach($leaveTypeObj as $ltype){ ?>
		<option value="<?php echo $ltype->code; ?>"> <?php echo $ltype->type; ?></option>
		<?php } ?>
		</select>
		</div>
		</div>
										
		<div class="col-md-6" id="avail_block" >
		<div class="input-group bmargindiv1 col-md-12" >
		<span class="input-group-addon ndrftextwidth text-right" style="width:207px" >Available Counts :</span>
		<input type="text" id="leave_cnt" name="leave_cnt" readOnly class="form-control" placeholder="0" value="0">
		</div>
		</div>
									
		</div>
		
		<div class="col-md-12">
		
		<div class="col-md-6" id="start_date_block" >
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right" style="width:207px" >Start Date :</span>
		<input type="date" name="start_date" id="start_date" class="form-control tcal" placeholder="Start Date" onchange="getCount(1,event)" >
		</div>
		</div>
										
		<div class="col-md-6" id="end_date_block"  >
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right" style="width:207px">End Date :</span>
		<input type="date" name="end_date" id="end_date" class="form-control tcal" placeholder="End Date" onchange="getCount(2,event)">
		</div>
		</div>
		
												
		</div>
		
		
		<div class="col-md-12">
										
		<div class="col-md-6" id="total_leave_block" >
		<div class="input-group bmargindiv1 col-md-12" >
		<span class="input-group-addon ndrftextwidth text-right" style="width:207px">Total Counts :</span>
		<input type="text" readOnly name="total_leave" id="total_leave" class="form-control" placeholder="0" >
		</div>
		</div>
																				
		</div>
				
										
		<div class="col-md-12">
		
		<div class="col-md-12" >
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right" style="width:207px">Reason :</span>
		<textarea id="text1" class="form-control" maxlength="1000" rows="2" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
		</div>
		</div>
																				
		</div>
		
		<div class="col-md-12">
		
		<div class="col-md-12" >
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right" style="width:207px" >General Availability/Timing :</span>
		<input type="text" name="avail_time" id="avail_time" class="form-control" placeholder="10:00 AM to 6:00 PM" >
		</div>
		</div>
																				
		</div>
		
		<div class="col-md-12">
		
		<div class="col-md-12" >
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right" style="width:207px">Internet provider/Speed :</span>
		<input type="text" name="net_speed" id="net_speed" class="form-control" placeholder="Jio/Broadband" >
		</div>
		</div>
																				
		</div>
		
		<div class="col-md-12">
										
		<div class="col-md-12" id="info_block1" name="info_block1" style="display:none;">
		<div class="input-group bmargindiv1 col-md-12" >
		<span class="input-group-addon ndrftextwidth text-left" name="info" id="info" ></span>
		</div>
		</div>
		
		</div>
				
     			
      </div>
	  <div class="clearfix"></div>
      <div class="modal-footer">
	     <span style="font-size:14px; float:left" id="istatus">
         
          </span>
        <button type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndAddData();" id="btnsubmit">Create</button> 
		<button type="button" class="btn btn-default btn-gray" data-dismiss="modal" onclick="resetSelection();" ><i class="fa fa-times"></i>CLOSE</button>
      </div>
	</div>
    </div>
	<input type="hidden" class="form-control"  id="messageid" name="messageid" value="">
	</form>
  </div>
</div>   



<?php include 'include/footer.php' ?>


<script>


window.onload = function() {
		loadMyWFHRequest();
		updateCounts();
	};
	

function updateCounts()
{
	
	var cnt = document.getElementById( 'leave_cnt');
	var sdate = document.getElementById( 'start_date').value;
	var dataString = "action=getWFHCnt&sdate="+sdate;
		
	$.ajax({ 
		type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				cnt.value = dobj.value;
			}
			else{
				location.reload();
			}
		} 
	});
}

function updateFields(){
	
	var type = document.getElementById( 'leave_type').value;
	var sdate = document.getElementById( 'start_date_block');
	var edate = document.getElementById( 'end_date_block');
	var coffblock = document.getElementById( 'compoff_block');
	
	var avail = document.getElementById( 'avail_block');
	var infoblock = document.getElementById( 'info_block');
	var info = document.getElementById( 'info');
	var cnt = document.getElementById( 'leave_cnt');
	var tleaves = document.getElementById( 'total_leave');
	tleaves.value = "0";
		
			
	if(type == 4 || type == 7 ) //halfday
	{
		coffblock
		if(type == 4)
		{
			coffblock.style.display = "none"
			edate.style.display = "none";
			infoblock.style.display = "block";
			info.innerHTML = "NOTE:<BR><BR>1. Each Half-day leave will be deducted from Casual Leave(half-day)";
		}
		else{
			coffblock.style.display = "block"
			edate.style.display = "none";
		}		
	}
	else{
		edate.style.display = "block";
		infoblock.style.display = "none";
		coffblock.style.display = "none"
	}
	if(type == 5 || type == 6) //
	{
		avail.style.display = "block";
	}
	else
		avail.style.display = "block";
	
	if(type == 5  )
	{
		infoblock.style.display = "block";
		info.innerHTML = "NOTE:<BR><BR>1. Unpaid leaves needs to be approved by MGMT/BU Head only.<BR><BR>2. Pay deductions will be applicable on that particular month or at best on subsequent month which is case specific";
	}
	if(type == 6 )
	{
		infoblock.style.display = "block";
		info.innerHTML = "NOTE:<BR><BR>1. Can be availed only for very special purposes like marriage of self, kids’ marriage, bereavement/death of immediate family<BR>    members like (Parents/Parents- in law/spouse/kids/brother/sister only). Also, for appearing examinations.<BR><BR>2. Only MGMT/BU HEAD will approve this leave.";
	}
	
	if(type == 7 )
	{
		infoblock.style.display = "block";
		info.innerHTML = "NOTE:<BR><BR>1. This leave will be awarded by BU HEAD/MGMT based on working on holiday or special achievement.<BR><BR>2. Recommendations of compensatory leaves will come from the BU Head, and the nominated employee can apply leave as<BR> compensatory leave pasting recommendation of the BU Head.<BR><BR>3. To be availed within 30 days, otherwise leave will lapse.";
	}
	
	if(type == 8 )
	{
		infoblock.style.display = "block";
		info.innerHTML = "NOTE:<BR><BR>1. Female employees who have been in continuous employment of the Company for 80 working days prior to the date of<BR> commencement of maternity leave are entitled to Maternity Leave as per regulations of The Maternity Benefit (Amendment) Act, 2017.<BR><BR>2. Every woman will be entitled to maternity benefit of 26 weeks /182 calendar days.<BR><BR>3. It can be availed prior to 8 weeks of expected delivery date and In case of adoption & surrogacy, a Woman is entitled for 12 weeks .<BR><BR>4. Any extension can be utilized from her available Total paid leaves with the approval of MGMT/ BU Head only.";
	}
	
	document.getElementById( 'start_date').value="";
	document.getElementById( 'end_date').value="";
	
	var dataString = "action=getLeaveCnt&type="+type;
		
	$.ajax({ 
		type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				cnt.value = dobj.value;
			}
			else{
				location.reload();
			}
		} 
	});
	
}


function getCount(v,e)
{
	//alert(v+"::aaa::"+e.target.value);
	updateCounts();
	var sdate = document.getElementById( 'start_date').value;
	var edate = document.getElementById( 'end_date').value;
	var type = document.getElementById( 'leave_type').value;
	var tleaves = document.getElementById( 'total_leave');
	var leave_cnt = document.getElementById( 'leave_cnt').value;
	
	tleaves.value = "0";
	if(type == 0)
	{
		alert("Select Leave type first");
		return;
	}
	else if(sdate != "" && edate != "")
	{
		var dataString = "action=totaldays&sdate="+sdate+"&edate="+edate+"&type="+type;
		$.ajax({ 
			type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					tleaves.value = dobj.count;
				}
				else{
					
					tleaves.value = 0;
					alert(dobj.msg);
					//location.reload();
				}
			} 
		});
	}
	
	
}	
	


function checkValidation()
{
		
	var type = document.getElementById( 'leave_type').value;
	var sdate = document.getElementById( 'start_date').value;
	var edate = document.getElementById( 'end_date').value;
	var leave_cnt = document.getElementById( 'leave_cnt').value;
	var desc = document.getElementById('text1').value;
	var avail_time = document.getElementById('avail_time').value;
	var net_speed = document.getElementById('net_speed').value;
	var total_leave = document.getElementById('total_leave').value;
	leave_cnt = parseInt(leave_cnt, 10);
	total_leave = parseFloat(total_leave, 10);
	
	if(type == 0 )
	{
		alert("Please select Request type...");
		return false;
	}
	if(sdate == "" )
	{
		alert("Please add start date...");
		return false;
		
	}
	
	if(type != 4 && type != 7 && edate == "" )
	{
		alert("Please add end date...");
		return false;
	}
	
	if(total_leave == 0)
	{
		alert("Your total counts is zero...");
		return false;
	}
	
		
	
	if(desc == "" )
	{
		alert("Please add Reason...");
		return false;
	}
	
	if(avail_time == "" )
	{
		alert("Please add General Availability/Timing...");
		return false;
	}
	
	if(net_speed == "" )
	{
		alert("Please add Internet provider/Speed...");
		return false;
	}
	
	//alert(leave_cnt+"::"+total_leave);
	if(leave_cnt < total_leave)
	{
		alert("Sorry, Your current available counts is less than your new counts.");
		return false;
	}
	
	
	return true;
}

function checkAndAddData()
{
	var ret = checkValidation();
	if(!ret)
		return false;
	
	
	var dataString = "action=createNewRequest&";
		dataString +=$( "#frmemployee" ).serialize();
	//alert(dataString);
    //return;	
	$.ajax({ 
		type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				location.reload();
			}
			else{
				
			}
		} 
	});
	
}
	
	
	
	function loadMyWFHRequest()
	{
		
		var dataString = "action=loadMyOpenRequest";
		$.ajax({ 
			type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#DATAFIELD").html(dobj.data);
					
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
			} 
		});
		
		var wfh_allwo = document.getElementById('hwfh').value;
		if(wfh_allwo)
		{
			var dataString = "action=getMyWFHCountsList";
			$.ajax({ 
			type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#INFODATAFIELD").html(dobj.data);
					
				}
				else{
					//alert(dobj.msg);
					//location.reload();
				}
			} 
		});
			
		}
		
	}	
		
	function resetSelection(){
		
	document.getElementById('leave_type').value=0;
	document.getElementById('start_date').value="";
	document.getElementById('end_date').value="";
	document.getElementById('leave_cnt').value="";
	document.getElementById('text1').value="";
	document.getElementById('total_leave').value="";
	var info_block = document.getElementById( 'info_block');
	info_block.style.display = "none";
	document.getElementById( 'info').innerHTML = "";
	
	}	



</script>