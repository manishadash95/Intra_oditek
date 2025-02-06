<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$userid = 	$_SESSION["emp_id"];
	
	$iv = $_REQUEST['iv'];
	$date_input = $_REQUEST['date'];
	$eid = $_REQUEST['eid'];
	$type = $_REQUEST['type'];
	
	$date_input = trim($dbobj->get_mcrypt_decrypt($date_input,$iv));
	$emp_id = $eid = trim($dbobj->get_mcrypt_decrypt($eid,$iv));
	$type = trim($dbobj->get_mcrypt_decrypt($type,$iv));
	
	$edit=0;
	if($dbobj->isHRAdmin($userid) || $dbobj->isAdmin($userid))
		$edit=1;
	
	$emp_name = $dbobj->getEmpName($eid);	
	$monthid = date(n);
	if($type == 1)	
		$empAttendanceData = $dbobj->getEmployeeAttendanceData($date_input ,$eid ,$monthid);
	else
		$empAttendanceData = $dbobj->getOthersAttendanceData($date_input ,$eid ,$monthid);
	
	
	$presentCnt = $empAttendanceData[0]->presentCnt;
	$absCnt = $empAttendanceData[0]->absCnt;
	$leaveCnt = $empAttendanceData[0]->leaveCnt;
	$wfhCnt = $empAttendanceData[0]->wfhCnt;
	
	$current_date = date("Y-m-d", strtotime($date_input));
	$edit_date = date("d-m-Y", strtotime($date_input));
	$current_date = $dbobj->get_mcrypt_encrypt($current_date,$iv);
	$team_attendance1 = "team_attendanceinfo.php?date=".$current_date."&iv=".$iv;
	
	$month_array = $dbobj->getAttendanceMonths();
	
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
						<li class="active">View Attendance Info</li>
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
									<h4> View Resource Attendance Info of <B><?php echo $emp_name;?></B></h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="abc" id="abc" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
				<a href="<?php echo $team_attendance1;?>" >
				<input type="button" class="btn btn-md btn-red " value="Back" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
				</a>
												
									
									<div class="col-md-12">
									
									
									<div class="col-md-12">
									
									<div class="col-md-3" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Month :</span>
									<select id="month_id" name="month_id" class="form-control"  onChange="getAttendanceInfo()">
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
									<select id="statusid" name="statusid" class="form-control"  onChange="getAttendanceInfo();" >
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
									
											
											
									<!--total_employee_div-->
									<div class="totalaligndiv">
									<?php if(!$edit){?>	
										
									<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-1">
											    </colgroup>
                                                <thead >
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Date</th>
														<th>Day</th>
														<th>Name</th>
														<th>IN Time</th>
														<th>OUT Time</th>
														<th>Total Time</th>
														<th>Info</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="ATTENDANCEFIELD" class="tablefont">
												<?php
												$i=0;
												foreach($empAttendanceData as $value)
												{
													$i++;
													$color="";
													if($value->holiday)
														$color="red";
													
													$italic="";
													if($value->manual)
														$italic="font-style: italic;";
													
												 ?>
												<tr class="success">
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $i ?></td>
                                                <td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->date_info ?></td>
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->day_info ?></td>
                                                <td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->name ?></td>
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->start_time ?></td>
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->end_time ?></td>
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->work_time ?></td>
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->info ?></td>
												</tr>
												<?php
													}
												?>
									            </tbody>
												</table>
                                        </div>
										<input type="hidden" name="hdate" id="hdate" value="<?php echo $date_input;?>">
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											<ul class="pagination pull-right margintopzerodiv">
												 <?php //echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?>
											</ul>  
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
									
									<?php }else{?>
									
									<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
											    </colgroup>
                                                <thead >
                                                    <tr >
                                                        <th>Sl. No.</th>
														<th>Date</th>
														<th>Day</th>
														<th>Name</th>
														<th>IN Time</th>
														<th>OUT Time</th>
														<th>Total Time</th>
														<th>Info</th>
														<th>Edit</th>
                                                    </tr>
                                                </thead>
                                                 <tbody id="ATTENDANCEFIELD" class="tablefont">
												<?php
												$i=0;
												foreach($empAttendanceData as $value)
												{
													$i++;
													$color="";
													if($value->holiday)
														$color="red";

													$italic="";
													if($value->manual)
														$italic="font-style: italic;";	

													$show_edit=0; if($i > 1)$show_edit=1; 
															
												 ?>
												<tr class="success" >
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $i ?></td>
                                                <td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->date_info ?></td>
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->day_info ?></td>
                                                <td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->name ?></td>
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->start_time ?></td>
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->end_time ?></td>
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->work_time ?></td>
												<td style="color:<?php echo $color?>;<?php echo $italic; ?> "><?php echo $value->info ?></td>
												<td class="tooltip-sidebar-logout">
												<?php if($show_edit){ ?>
												<a href="javascript://" data-dismiss="modal" data-toggle="modal" data-target="#viewemployeelistdiv"  onClick="loadDetailsData(<?php echo $value->id ;?>);">
												<input type="button" class="btn btn-md btn-green" value="Edit" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
												</a>
												<?php } ?>
												</td>
												</tr>
												<?php
													}
												?>
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


<div class="modal fade" id="viewemployeelistdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
  <form name="frmemployee" id="frmemployee" method="post">
    <div class="modal-content">
      
	  
	  <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title " id="myModalLabel">Update Attendance Data of <?php echo $emp_name; ?></h4>
      </div>
      
	  <div class="modal-body">
	  
	 
	   
	   
        <div class="totalaligndiv">
			
		
		<div class="col-md-12">
		
		<div class="col-md-6">
		<div class="input-group bmargindiv1 col-md-12" >
		<span class="input-group-addon ndrftextwidth text-right">Date :</span>
		<input type="text" id="edit_date" name="edit_date" readOnly class="form-control" placeholder="" value="<?php echo $edit_date;?>">
		</div>
		</div>
										
		<div class="col-md-6" id="avail_block" >
		<div class="input-group bmargindiv1 col-md-12" >
		<span class="input-group-addon ndrftextwidth text-right">Info :</span>
		<input type="text" id="edit_info" name="edit_info" readOnly class="form-control" placeholder="" value="">
		</div>
		</div>
									
		</div>
		
		
		<div class="col-md-12">
		
		<div class="col-md-6" id="start_date_block" >
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">Actual In Time :</span>
		<input type="text" name="edit_ain" id="edit_ain" readOnly class="form-control" placeholder="Start Date"  value="">
		</div>
		</div>
										
		<div class="col-md-6" id="end_date_block"  >
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">Actual Out Time :</span>
		<input type="text" name="edit_aout" id="edit_aout" readOnly class="form-control" placeholder="End Date" value="">
		</div>
		</div>
		
		
										
		</div>
		
		
		<div class="col-md-12">
		
		<div class="col-md-6" id="start_date_block" >
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">In Time :</span>
		<input type="text" name="edit_in" id="edit_in" class="form-control" placeholder="Start Date"  value="">
		</div>
		</div>
										
		<div class="col-md-6" id="end_date_block"  >
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">Out Time :</span>
		<input type="text" name="edit_out" id="edit_out" class="form-control" placeholder="End Date" value="">
		</div>
		</div>
		
		
										
		</div>
			
				
										
		
		<div class="col-md-12">
										
		<div class="col-md-12" id="info_block" name="info_block" style="display:none;">
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
		  <input type="hidden" name="hid" id="hid" value="0">
        <button type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndUpdateData();" id="btnsubmit">Update</button> 
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
	
	document.getElementById('loading_data').style.display = "none";
	//loadStatusRecords();
	getAttendanceInfo();
		
};

function loadStatusRecords()
{
	
	document.getElementById('hid').value = id;
	var dataString = "action=getAttendanceEditData&id="+id;
		$.ajax({ 
			type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					document.getElementById('edit_info').value = dobj.info;
					document.getElementById('edit_in').value = dobj.start_time;
					document.getElementById('edit_out').value = dobj.end_time;
					document.getElementById('edit_ain').value = dobj.act_start_time;
					document.getElementById('edit_aout').value = dobj.act_end_time;
					//alert("::"+dobj.manual);
					if(dobj.manual == 1)
					{
						document.getElementById( 'info').innerHTML = dobj.lastedit; 
						document.getElementById('info_block').style.display = "block";
					}
					else{
						document.getElementById( 'info').innerHTML = ""; 
						document.getElementById('info_block').style.display = "none";
					}
						
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
			} 
		});
	
	
}	

function getAttendanceInfo()
{
	document.getElementById('loading_data').style.display = "block";
	var month_id = document.getElementById('month_id').value;
	var statusid = document.getElementById('statusid').value;
	var eid = document.getElementById('heid').value;
	var edit = document.getElementById('hedit').value;
	
	var dataString = "action=getAttendanceInfo&monthid="+month_id+"&statusid="+statusid+"&eid="+eid+"&edit="+edit;
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

	
function loadDetailsData(id)
{
	
	//alert("AAA:ID:"+id);
	document.getElementById('hid').value = id;
	var dataString = "action=getAttendanceEditData&id="+id;
		$.ajax({ 
			type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					document.getElementById('edit_info').value = dobj.info;
					document.getElementById('edit_in').value = dobj.start_time;
					document.getElementById('edit_out').value = dobj.end_time;
					document.getElementById('edit_ain').value = dobj.act_start_time;
					document.getElementById('edit_aout').value = dobj.act_end_time;
					//alert("::"+dobj.manual);
					if(dobj.manual == 1)
					{
						document.getElementById( 'info').innerHTML = dobj.lastedit; 
						document.getElementById('info_block').style.display = "block";
					}
					else{
						document.getElementById( 'info').innerHTML = ""; 
						document.getElementById('info_block').style.display = "none";
					}
						
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
			} 
		});
		
}



function checkAndUpdateData()
{
	if(confirm("Are you sure want to update records?"))
	{	
	
		var start_time = document.getElementById('edit_in').value;
		var end_time = document.getElementById('edit_out').value;
		var id = document.getElementById('hid').value;
		
		if(start_time == "" || end_time == "")
		{
			alert("Error! Field can not blank");
			return;
		}
			
		
		if(start_time == "NA" && end_time != "NA")
		{	
			alert("Error! In Time can not NA");
			return;
		}
		
		if(start_time != "NA" && end_time == "NA")
		{
			alert("Error! Out Time can not NA");
			return;
		}
		
		
		var dataString = "action=updateAttendanceData&id="+id+"&in_time="+start_time+"&out_time="+end_time;
			$.ajax({ 
				type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
				success: function(html)
				{	 
					var dobj=jQuery.parseJSON(html);
					alert(dobj.msg);
					if(dobj.status == 1)
						location.reload();
				} 
		});
	}
	
}
		

	

</script>