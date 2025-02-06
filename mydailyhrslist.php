<?php 
ini_set("display_errors",0);
	//set_time_limit(1);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	//$_SESSION["pageid"]= "";
	
	$emp_name	= $_SESSION["emp_name"];
	$emp_id = 	$_SESSION["emp_id"];
	//$summaryData = $dbobj->getMyDailySummaryData();
		
	//$iv_key = $dbobj->get_mcrypt_iv();
	
	
	$month_array = $dbobj->getAttendanceMonths();
		
		
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>




  
<div id="page-wrapper">
	<div class="page-content">
		<!-- begin PAGE TITLE AREA -->
		<!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
		<div class="row">
			<div class="col-lg-12">
				<div class="page-title">
					
					<ol class="breadcrumb">
						<li class="active">My Daily HRs Report</li>
					</ol>

				</div>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<!-- end PAGE TITLE AREA -->

		<!--show_employee_div-->
		
		<!--end_show_employee_div-->
		
		<!-- /.row -->

		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
				
							<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title">
									<h4> Daily Report Summary</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
								
								
								
								
								
								
								
								
									<div class="table-responsive dashboard-demo-table">
									
									
									<div class="col-md-12">
									<div class="col-md-3" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Month :</span>
									<select id="month_id" name="month_id" class="form-control"  onChange="loadMyAttedance()">
									<?php
									foreach($month_array as $val)
									{
										$select=""; if($val->selected) $select="selected";
										echo '<option '.$select.' value="'.$val->monthid.'">'.$val->monthname.'</option>';
									}			
									?>														
									</select>
									</div>
									</div>
									
									<div class="col-md-3" >
									<div class="input-group bmargindiv1 col-md-12">
									<span class="input-group-addon ndrftextwidth text-right">Status :</span>
									<select id="statusid" name="statusid" class="form-control"  onChange="loadMyAttedance();" >
									<option value="0" >All Status</option>
									<option value="1" >Present</option>
									<option value="2" >On Leave</option>
									<option value="3" >On WFH</option>
									<option value="4" >Absent</option>
									</select>
									</div>
									</div>
									
									</div>
																	
									<div class="col-md-12">
									<div class="col-md-3">
						            <div class="input-group bmargindiv1 col-md-12">
                                    <span class="input-group-addon ndrftextwidth text-right">Total Present :</span>
									<input type="text" readOnly name="t_present" id="t_present" class="form-control" value="<?php echo $presentCnt;?>" >
                                    </div>
                                    </div>

									<div class="col-md-3">
						            <div class="input-group bmargindiv1 col-md-12">
                                    <span class="input-group-addon ndrftextwidth text-right">Total WFH :</span>
									<input type="text" readOnly name="t_wfh" id="t_wfh" class="form-control" value="<?php echo $wfhCnt;?>" >
                                    </div>
                                    </div>

									<div class="col-md-3">
						            <div class="input-group bmargindiv1 col-md-12">
                                    <span class="input-group-addon ndrftextwidth text-right">Total Leaves :</span>
									<input type="text" readOnly name="t_leave" id="t_leave" class="form-control" value="<?php echo $leaveCnt;?>" >
                                    </div>
                                    </div>

									<div class="col-md-3">
						            <div class="input-group bmargindiv1 col-md-12">
                                    <span class="input-group-addon ndrftextwidth text-right">Total Absent :</span>
									<input type="text" readOnly name="t_abs" id="t_abs" class="form-control" value="<?php echo $absCnt;?>" >
                                    </div>
                                    </div>									
									
								    <input type="hidden" readOnly name="heid" id="heid" class="form-control" value="<?php echo $emp_id; ?>" >
									<input type="hidden" readOnly name="heid" id="hedit" class="form-control" value="<?php echo $edit; ?>" >
											
									</div>
									
									
									
									
										<table class="table table-bordered table-striped table-hover">
											<colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-3 col-sm-3">
													<col class="col-md-2 col-sm-2">
											</colgroup>
											<thead>
												<tr>
													<th>Sl. No</th>
                                                    <th>Date<BR>[Day]</th>
											        <th>IN Time</th>
													<th>OUT Time</th>
													<th>Actual Work Time</th>
													<th>Actual Effort</th>
													<th>Info</th>
													<th>View</th>
												</tr>
											</thead>
											<tbody id="ATTENDANCEFIELD" class="tablefont">
                                           
												
											</tbody>
										</table>
								
									
								</div>
								
							
							</div>
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

<script type="text/javascript">


function closeModal(){
	$('#loadingMessage').hide();
	$('.modal-backdrop').hide();
}

window.onload = function() {
	
	loadMyAttedance();

};

function loadMyAttedance()
{
	document.getElementById('loading_data').style.display = "block";
	var month_id = document.getElementById('month_id').value;
	var statusid = document.getElementById('statusid').value;
	
	var dataString = "action=getMyAttendanceInfo&monthid="+month_id+"&statusid="+statusid;
	//alert("::"+dataString);
		
		$.ajax({ 
			type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#ATTENDANCEFIELD").html(dobj.data);
					document.getElementById('t_present').value = dobj.present;
					document.getElementById('t_wfh').value = dobj.wfh;
					document.getElementById('t_leave').value = dobj.leave;
					document.getElementById('t_abs').value = dobj.abs;
					document.getElementById('loading_data').style.display = "none";
						
				}
				else{
					document.getElementById('loading_data').style.display = "none";
					alert(dobj.msg);
					location.reload();
				}
			} 
		});
	
	
}


function checkAlertMessages(){

		var forceno = document.getElementById('forceid').value; 
		//alert("ForceNo:"+forceno);
		var dataString = "type=getdata&forceno="+forceno;
		//alert(""+dataString);
		$.ajax({ 
		type: "POST",url: "ajaxCheckAlerts.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			var alertmessage=1;
			var  value = parseInt(html);
			//alert(""+value);
			if(value > 0)
				$("#alertid").trigger('click');
		} 
		});
}

function checkBoxEvent(id){
	//alert("::"+id);
	 	var value = document.getElementById("checkbox1").checked;
		if(value)
			document.getElementById('okbutton').disabled = false;
		else
			document.getElementById('okbutton').disabled = true;
	}
	
function logout(){
			//alert("logout");
		 	location.href = 'logout.php';
	}
	
function updateMessage(){
	
		document.getElementById('modalid').value=0;;
		var forceno = document.getElementById('forceid').value; 
		var dataString = "type=updatedata&forceno="+forceno;
		$.ajax({ 
		type: "POST",url: "ajaxCheckAlerts.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			
		} 
		});
	
	}	


</script>