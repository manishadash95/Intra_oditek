<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
	$leaveTypeObj = $dbobj->getLeaveType();
	$eid = 	$_SESSION["emp_id"];
	
	
	$wid = $_REQUEST['wid'];
	$iv = $_REQUEST['iv'];
	$wid = trim($dbobj->get_mcrypt_decrypt($wid,$iv));
	
	$leaveObj = $dbobj->getDetailsWFHRequest($wid);
	
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
								<h4>View My WFH Request Details : [<?php echo $leaveObj->wid." ]  :- Created On :".$leaveObj->cdate; ?></h4>
								</div>
								<div class="clearfix"></div>
							</div>
					<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
			<a href="wfh_myviewrequest.php" >
			<input type="button" class="btn btn-md btn-red " value="Back" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
			</a>
			
									<!--total_employee_div-->
									<div class="totalaligndiv">
										<!--1st_div-->
										
										<div class="col-md-12">
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Request Id :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->wid; ?>">
										</div>
										</div>
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Request Type :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->type_str; ?>">
											
										</div>
										</div>
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Created By :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->cname; ?>">
											
										</div>
										</div>
										
										
										
										
																				
										</div>
										
										
										<div class="col-md-12">
										
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">BU Name :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->buname; ?>">
										</div>
										</div>
										
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">BU Head :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->bu_head_name; ?>">
										</div>
										</div>
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right">Supervisor :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->super_name; ?>">
											
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
										<span class="input-group-addon ndrftextwidth text-right">Total Days :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->days; ?>" >
										</div>
										</div>
										
										</div>
										
										<div class="col-md-12">
										<div class="col-md-12">
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">Reason :</span>
										<textarea id="text1" readOnly class="form-control" maxlength="500" rows="3" name="text1" style="margin: 0px -0.5px 0px 0px; height: 60px;"><?php echo $leaveObj->reason; ?></textarea>
										</div>
										</div>
										</div>
										
										<div class="col-md-12">
										<div class="col-md-6">
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">Availability :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->avail_time; ?>" >
										</div>
										</div>
																				
										<div class="col-md-6">
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">Internet Speed :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->net_speed; ?>" >
										</div>
										</div>
										</div>
										
										<div class="col-md-12">
										<div class="col-md-6">
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">Status :</span>
										<input type="text" readOnly class="form-control" placeholder="0" value="<?php echo $leaveObj->status_str; ?>" >
										</div>
										</div>
										
										</div>
									
										
						<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
								<?php if($leaveObj->status == 1){?>										
									<div class="col-md-12">
									<input type="button" class="btn btn-md btn-red " value="Cancell" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;" Onclick="cancellRequest();">
									</div>
								<?php } ?>	
									<?php $cout=0; foreach($leaveObj->dataArray as $data)
									{
										$cout++;
										$line_cnt = substr_count( trim($data->msg), "\n" );
										$line_cnt+=3;
										if($cout == 1)
											echo '<div class="col-md-12">';
										else 
											echo '<div class="col-md-12 toppadding">';										
									?>	
										
											<div class="input-group  col-md-12">
											<span class="input-group-addon ndrftextwidth text-left" style="border-left: 1px solid #CCCCCC;
											border-right: 1px solid #CCCCCC; font-size: 14px;" >
											<B><?php echo $data->status_log.' :: '.$data->emp_name?> on <?php echo $data->date_updated?> </B>
											</span>
											</div>
											<div class="input-group col-md-12">
											<textarea disabled  class="form-control text-left" maxlength="1000" rows="<?php echo $line_cnt;?>" style="margin: 0px -0.5px 0px 0px; height: auto;resize: none"> <?php echo trim($data->msg); ?></textarea>
											
											</div>
											
											
									</div>
									
									<?php }	?>		
									
																	
										
										
										
										
										
										<!--end_1st_div-->
										<!--2nd_div-->
										
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									<!--end_total_employee_div-->
									<!--login_informations_div-->
									
									
									
									<!--end_netpay_information_div-->
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	
							</form>
										
										
										
										
										
										
										
										
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
                        	<input type="hidden" name="hwid" id="hwid"  value="<?php echo $wid; ?>">
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
		
	var desc = document.getElementById('text1').value;
	
		
	if(desc == "" )
	{
		alert("Please add Description...");
		return false;
	}
	
		
	return true;
}


function cancellRequest()
{
	var wid = document.getElementById('hwid').value;
	if(confirm("Are you sure want to cancell this request?"))
	{
		var dataString = "action=cancellRequestCreator&wid="+wid;
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
				location.reload();
			}
		} 
		});
	}
	
}


</script>