<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$leaveTypeObj = $dbobj->getLeaveType();
	$eid = 	$_SESSION["emp_id"];
	
	
	$lid = $_REQUEST['lid'];
	$encrypt_lid = $lid;
	$iv = $_REQUEST['iv'];
	$emp_id = $_REQUEST['emp_id'];
	$lid = trim($dbobj->get_mcrypt_decrypt($lid,$iv));
	
	$leaveObj = $dbobj->getDetailsLeaveRequest($lid);
	
	$line_cnt = substr_count( trim($leaveObj->msg), "\n" );
	$line_cnt+=3;
										
										
	$selfRequest=false;
	if($leaveObj->eid  == $eid)
		$selfRequest =  true;		
	
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
						<li class="active">HR View Leave Request</li>
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
								<h4>HR Review Leave Request Details : [<?php echo $leaveObj->lid; ?>]</h4>
								</div>
								<div class="clearfix"></div>
							</div>
					<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
			<a href="leavehrviewdetailsresource.php?lid=<?php echo $encrypt_lid;?>&iv=<?php echo $iv;?>" >
			<input type="button" class="btn btn-md btn-red " value="Back" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
			<input type="hidden" id="pageid" name="pageid" value="leavehrviewdetailsresource.php?lid=<?php echo $encrypt_lid;?>&iv=<?php echo $iv;?>" >
			</a>
			
									<!--total_employee_div-->
									<div class="totalaligndiv">
										<!--1st_div-->
										
										<div class="col-md-12">
										
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Created On :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->cdate; ?>">
										</div>
										</div>
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Created By :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->cname; ?>">
											
										</div>
										</div>
										
										<div class="col-md-4">
									    <div class="input-group bmargindiv1 col-md-12" >
									    <span class="input-group-addon ndrftextwidth text-right">Reporting Mgr. :</span>
									    <input type="text" readOnly id="uname" class="form-control" placeholder="" value="<?php echo $leaveObj->report_to; ?>">
									    </div>
									    </div>
										
																				
										</div>
										
										
										<div class="col-md-12">
										
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Leave Id :</span>
										<input type="text" readOnly id="leaveid" name="leaveid" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
										</div>
										</div>
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Leave Type :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->type_str; ?>">
											
										</div>
										</div>
										
										<div class="col-md-4" >
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Available Leaves :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->available; ?>">
										</div>
										</div>
										
										</div>
																				
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-12">
										<div class="col-md-4" >
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">Start Date :</span>
										<input type="text"  readOnly class="form-control" placeholder="Start Date"  value="<?php echo $leaveObj->sdate; ?>" >
										</div>
										</div>
										
										<div class="col-md-4" >
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">End Date :</span>
										<input type="text" readOnly class="form-control" placeholder="End Date" value="<?php echo $leaveObj->edate; ?>" >
										</div>
										</div>
										
										<div class="col-md-4" >
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Total Leaves :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->days; ?>" >
										</div>
										</div>
										
										</div>
									
										
							
							
							
									<!--total_employee_div-->
									<div class="col-md-12">
																	
																		
									<?php $cout=0;
									$edate = $leaveObj->edate;
									$sdate = $leaveObj->sdate;
									$edate_str = strtotime($edate);
									$date = $sdate;
									$date_str = strtotime($date);
									
									while($date_str <= $edate_str )
									{
										$holiday = $dbobj->checkHoliday($date);
										$day = date("D", strtotime($date));
										if(!$holiday){
											$cout++;
									?>	
											<div class="col-md-4" >
											<div class="input-group  col-md-12" style="background-color:#123456" >
											<span id="spanid<?php echo $cout; ?>" name="spanid<?php echo $cout; ?>" class="input-group-addon text-left" style="border-left: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC; font-size: 14px; width:220px; " >
											<B><?php echo $cout." : ".$date." [ ".$day." ]" ;?></B>
											</span>
											<select id="dateid<?php echo $cout; ?>" name="dateid<?php echo $cout; ?>" class="form-control" onchange="updateFields(<?php echo $cout;?>)" >
											<option value="0">Unselect</option>
											<option value="1">Select</option>
											</select>
											</div>
											<input type="hidden" id="hdate<?php echo $cout; ?>" name="hdate<?php echo $cout; ?>"  value="<?php echo $date; ?>" >	
											</div>
										
									
									<?php 
										}
									$date = date("d-m-Y", strtotime($date." 1 days"));
									$date_str = strtotime($date);
									
									}

																		
									?>	
									<input type="hidden" id="hcount" name="hcount"  value="<?php echo $cout; ?>" >			
									
										<!--end_1st_div-->
										<!--2nd_div-->
										
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									
								
									
									<div class="col-md-12" style="padding-top: 30px;" >
									<div class="col-md-4"  >
									<div class="input-group bmargindiv1 col-md-12">
									<input type="button" id="selectbtn" name="selectbtn" class="btn btn-md btn-default " value="Select All"  onclick="updateSelection()">
									</div>
									</div>
									
									<div class="col-md-4" >
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Total Selected :</span>
									<input type="text" readOnly class="form-control" id="tselected" name="tselected" placeholder="0" value="0" >
									</div>
									</div>
									
									
									</div>
									
									<div class="col-md-12" >
									<div class="col-md-12" >
									<div class="input-group bmargindiv1 col-md-12">
									<span  class="input-group-addon ndrftextwidth text-right">Note :</span>
									<textarea id="text1" class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
									</div>
									</div>
									</div>
									
									
									<div class="col-md-12" id="updatediv" >
									<div class="bpaddingdiv1 text-center">
									<button type="button" class="btn btn-default " onclick="revertResourceData();" >Revert</button> 
									</div>
									</div>
									
								
									<!--end_total_employee_div-->
									<!--login_informations_div-->
									
									
									
									<!--end_netpay_information_div-->
									
									<div class="clearfix"></div>
							
					
						
                        	
						
										
										
										
										
										
										
										
										
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
  <form name="editfrmmess" id="editfrmmess" method="post">
    <div class="modal-content">
      
	  
	  <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title " id="myModalLabel">Update Message [<?php echo $leaveObj->lid; ?>]</h4>
      </div>
      
	  <div class="modal-body">
	  
	   
        <div class="totalaligndiv">
			
		
		
		<div class="col-md-12">
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right">Description :</span>
		<textarea id="text1" class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
		</div>
		</div>										
		<input type="hidden" name="hlid" id="hlid" value="<?php echo $lid;?>">									
	 			
      </div>
	  <div class="clearfix"></div>
      <div class="modal-footer">
	  <span style="font-size:14px; float:left" id="istatus">
         
          </span>
        <button type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndAddData();" id="btnsubmit">Update</button> 
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


function checkValidation()
{
		
	var desc = document.getElementById('text1').value;
	
		
	if(desc == "" )
	{
		alert("Please add Description...");
		return false;
	}
	
		
	return true;
}

function checkAndAddData()
{
	var ret = checkValidation();
	if(!ret)
		return false;
	var dataString = "action=updateHRRequest&";
		dataString +=$( "#editfrmmess" ).serialize();
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


function updateFields(id)
{
	//alert("::"+id);
	
	var dateid = document.getElementById('dateid'+id);
	var spanid = document.getElementById('spanid'+id);
	var tselected = document.getElementById('tselected');
	var val = parseInt(tselected.value);
	if(dateid.value==1)
	{
		spanid.style.background = "#ABEBC6";
		tselected.value = val+1;
	}else{
		spanid.style.background = "";
		tselected.value = val-1;
	}
	
}

function updateSelection()
{
	var count = document.getElementById('hcount').value;
	var selectbtn = document.getElementById('selectbtn').value;
	var tselected = document.getElementById('tselected');
	
	
	if(selectbtn == "Select All")
	{	
		for (let i = 1; i <= count; i++) {
			document.getElementById('dateid'+i).options[1].selected = true;
			document.getElementById('spanid'+i).style.background = "#ABEBC6";;
		}
		tselected.value = count;
		document.getElementById('selectbtn').value = "Unselect All";
	}
	else{
		for (let i = 1; i <= count; i++) {
			document.getElementById('dateid'+i).options[0].selected = true;
			document.getElementById('spanid'+i).style.background = "";;
		}
		tselected.value = 0;
		document.getElementById('selectbtn').value = "Select All";
	}
	
}

function revertResourceData()
{
	var tselected = document.getElementById('tselected').value;
	var desc = document.getElementById('text1').value;
	if(tselected==0)
	{
		alert("Select a date to revert");
		return false;
	}
	
	if(desc == "" )
	{
		alert("Please add Description...");
		return false;
	}
	
	var dataString = "action=revertResoLeaveRecords&";
		dataString +=$( "#frmemployee" ).serialize();
		
	//alert(dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				var pageid = document.getElementById('pageid').value;
				window.location.href = pageid;
				
			}
			else{
				
			}
		} 
	});
	
}

</script>