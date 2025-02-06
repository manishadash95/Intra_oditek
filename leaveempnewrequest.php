<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$leaveTypeObj = $dbobj->getLeaveType();
	$eid = 	$_SESSION["emp_id"];
	
	$cleave = $dbobj->getAvailLeave($eid);
	
	$comfOffList = $dbobj->getCompOffLeaveList($eid);
	
	$empList = $dbobj->getAllActiveEmployeeListName();
	
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
						<li class="active">New Employee Leave Request</li>
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
									<h4> New Employee Leave Request</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
								
														
								
									<!--total_employee_div-->
									<div class="totalaligndiv">
										
														
									
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Select Employee :</span>
									<select id="reso_id" name="reso_id" class="form-control chosen-select" onchange="updateLeaveFields()" >
									<option value="0" >Select Resource</option>
									<?php foreach($empList as $emp){ 
									$select="";
									
									?>
									<option value="<?php echo $emp->eid; ?>" <?php echo $select;?> > <?php echo $emp->name; ?></option>
									<?php } ?>
									</select>
									</div>
								
									
									<div class="col-md-12" id="leave_block" style="display:none;">
									
									<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Employee Name :</span>
									<input type="text" readOnly id="emp_name" name="emp_name" class="form-control" placeholder="name"  >
									</div>
									</div>
									
									
									<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Employee Id :</span>
									<input type="text" readOnly id="emp_id" name="emp_id" class="form-control" placeholder="id"  >
									</div>
									</div>
									
									
									<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Leave Type :</span>
									<select id="leave_type" name="leave_type" class="form-control" onchange="updateFields()"  >
									<option value="0" >Select Leave Type</option>
									</select>
									</div>
									</div>
																	
									<div class="col-md-6" id="avail_block" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Available Leaves :</span>
									<input type="text" id="leave_cnt" name="leave_cnt" readOnly class="form-control" placeholder="0" value="0">
									</div>
									</div>
																
																	
									<div class="col-md-6" id="start_date_block" >
									<div class="input-group bmargindiv1 col-md-12">
									<span class="input-group-addon ndrftextwidth text-right">Start Date :</span>
									<input type="date" name="start_date" id="start_date" class="form-control tcal" placeholder="Start Date" onchange="updateCount(1,event)" >
									</div>
									</div>
																	
									<div class="col-md-6" id="end_date_block"  >
									<div class="input-group bmargindiv1 col-md-12">
									<span class="input-group-addon ndrftextwidth text-right">End Date :</span>
									<input type="date" name="end_date" id="end_date" class="form-control tcal" placeholder="End Date" onchange="updateCount(2,event)">
									</div>
									</div>
									
									<div class="col-md-6" id="compoff_block" style="display:none;" >
									<div class="input-group bmargindiv1 col-md-12">
									<span class="input-group-addon ndrftextwidth text-right">CompOff Date :</span>
									<select id="comoff" name="comoff" class="form-control"   >
									<option value="0" >Select CompOff Type</option>
									<?php foreach($comfOffList as $coffdate){ ?>
									<option value="<?php echo $coffdate->id; ?>"> <?php echo $coffdate->date; ?></option>
									<?php } ?>
									</select>
									</div>
									</div>
																											
									<div class="col-md-6" id="total_leave_block" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Total Leaves :</span>
									<input type="text" readOnly name="total_leave" id="total_leave" class="form-control" placeholder="0" >
									</div>
									</div>
									
									
									<div class="col-md-12" >
									<div class="input-group bmargindiv1 col-md-12">
									<span  class="input-group-addon ndrftextwidth text-right">Description :</span>
									<textarea id="text1" class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
									</div>
									</div>								
									
									
									<div class="col-md-12" id="info_block" name="info_block" style="display:none;">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-left" name="info" id="info" ></span>
									</div>
									</div>
									
									
		
		
									
									
									 
									 <div class="input-group bmargindiv1 col-md-12" >
									 <div class="modal-footer">
									 <span style="font-size:14px; float:left" id="istatus">
									 
									  </span>
									<button type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndAddData();" id="btnsubmit">Create</button> 
									<button type="button" class="btn btn-default btn-gray" data-dismiss="modal" onclick="reloadPage();" ><i class="fa fa-times"></i>CLOSE</button>
								     </div>
										
									 </div>
									</div>	
									
									</div>	
										
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





<?php include 'include/footer.php' ?>


<script>


window.onload = function() {
		loadMyLeaveRequest();
	};


function updateLeaveFields()
{
	var reso = document.getElementById( 'reso_id');
	var reso_id = document.getElementById( 'reso_id').value;
	var emp_name = document.getElementById( 'emp_name');
	var emp_id = document.getElementById( 'emp_id');
	var leave_block = document.getElementById( 'leave_block');
	
	//alert("reso_id:"+reso_id);
	if(reso_id == 0)
	{
		leave_block.style.display = "none";
	}else{
		var name= reso.options[reso.selectedIndex].text;
		emp_id.value = reso_id;
		emp_name.value = name;
		leave_block.style.display = "block";
		
		document.getElementById( 'leave_cnt').value = 0;
		document.getElementById( 'leave_type').selectedIndex =0;
		resetFields();
		
		//ajax get to leave type of selected employee
		var dataString = "action=getLeaveAllType&eid="+reso_id;
		//alert("dataString11:"+dataString);
	
		$.ajax({ 
			type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#leave_type").html(dobj.data);
					$("#leave_type").trigger("chosen:updated");
					
				}				
				//document.getElementById('loading_data').style.display="none";
			} 
		});
					
	}
	
	
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
		//coffblock
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
	var emp_id = document.getElementById( 'emp_id').value;
	
	var dataString = "action=getLeaveCntEmp&type="+type+"&eid="+emp_id;
		
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


function updateCount(v,e)
{
	//alert(v+"::aaa::"+e.target.value);
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
	if(type == 4) //halfday
	{
		tleaves.value = "0.5";
	}
	else if(type == 7) //halfday
	{
		if(leave_cnt > 0)
			tleaves.value = "1";
		else{
			alert("Comp Off Leave is not available.");
		}
	}
	else if(sdate != "" && edate != "")
	{
		var dataString = "action=totaldays&sdate="+sdate+"&edate="+edate+"&type="+type;
		$.ajax({ 
			type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
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
	var total_leave = document.getElementById('total_leave').value;
	var comoffdate = document.getElementById('comoff').value;
	leave_cnt = parseInt(leave_cnt, 10);
	total_leave = parseFloat(total_leave, 10);
	
	if(type == 0 )
	{
		alert("Please select leave type...");
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
	
	if(type == 7 && comoffdate == 0)
	{
		alert("Please select Comp Off date...");
		return false;
	}
	
	if(total_leave == 0)
	{
		alert("Your total leaves is zero...");
		return false;
	}
	
		
	
	if(desc == "" )
	{
		alert("Please add Description...");
		return false;
	}
	
	//alert(leave_cnt+"::"+total_leave);
	if(leave_cnt < total_leave)
	{
		alert("Sorry, Your current available leaves count is less than your new leave counts.");
		return false;
	}
	
	
	return true;
}

function checkAndAddData()
{
	var ret = checkValidation();
	if(!ret)
		return false;
	var emp_id = document.getElementById( 'emp_id').value;
	var dataString = "action=createLeaveEmp&eid="+emp_id+"&";
		dataString +=$( "#frmemployee" ).serialize();
	alert(dataString);
    //return;	
	$.ajax({ 
		type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
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
	
	
	
	function loadMyLeaveRequest()
	{
		
		var dataString = "action=loadMyOpenLeaveRequest";
		$.ajax({ 
			type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
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
		
	}	
		
	function resetSelection(){
		
	resetFields();
	document.getElementById( 'reso_id').selectedIndex =0;
	var leave_block = document.getElementById( 'leave_block');
	leave_block.style.display = "none";
	
	
	}
	
	
	function reloadPage(){
		
	
	location.reload();
	
	}
	
	

  function resetFields(){
		
	document.getElementById('leave_type').value=0;
	document.getElementById('start_date').value="";
	document.getElementById('end_date').value="";
	document.getElementById('leave_cnt').value="";
	document.getElementById('text1').value="";
	document.getElementById('total_leave').value="";
	document.getElementById( 'info').innerHTML = "";
	
	}		



</script>