<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$emp_id = $_SESSION["emp_id"];
	
	$iv = $_REQUEST['iv'];
	$date_input = $_REQUEST['date'];
	
	$empList = $dbobj->getAllActiveEmployeeListName();
	
	$iv = $_REQUEST['iv'];
	$date_input = trim($dbobj->get_mcrypt_decrypt($date_input,$iv));
	
	//$date_input1 = date("Y-m-d", strtotime($date_input));
	
	$buArray = $dbobj->getAllBU();
	$admin = $dbobj->isAdmin($emp_id);
	$ceo = $dbobj->isCEO($emp_id);
	$hraccess = $dbobj->isHRAdmin($emp_id);
	
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
						<li class="active">View Matrix Data</li>
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
									<h4> View Team Matrix Data</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="abc" id="abc" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
												
									
									<div class="col-md-12">
									
									<div class="col-md-12">
									
									<div class="col-md-3">
											
                                    <div class="input-group bmargindiv1 col-md-12">
                                    <span class="input-group-addon ndrftextwidth text-right">Select Date :</span>
									<input type="date" name="select_date" id="select_date" class="form-control tcal" onChange="onDateChange();" placeholder="Date" value="<?php echo $date_input1;?>">
                                    </div>
                                    </div>

									<div class="col-md-3">
						            <div class="input-group bmargindiv1 col-md-12">
                                    <span class="input-group-addon ndrftextwidth text-right">Employee Id :</span>
									<input type="text" name="emp_id" id="emp_id" class="form-control" value="0" >
                                    </div>
                                    </div>	

									<div class="col-md-3">
									<div class="input-group bmargindiv1 col-md-12">
                                    <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return getMatrixReport()">Get Report</button>
									</div>
									</div>									
									
													
																	
									
									</div>

									
									<!--total_employee_div-->
									<div class="totalaligndiv">
										
										
									<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                
                                               
                                                <tbody id="LEAVEFIELD" class="tablefont">
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
										
										
								
										
										
										
										
										<!--end_3rd_div-->
																		
										<div class="clearfix"></div>
                                        <div class="col-md-12">
                                           
											
											
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


window.onload = function() {
	
	document.getElementById('loading_data').style.display = "none";
	
		
};
	
function onDateChange()
{
	
}


function getMatrixReport()
{
	
	var dataString = "action=loadResourceAttedance&date="+date+"&category="+category+"&status="+status;
	//alert("::"+dataString);
		$.ajax({ 
			type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#LEAVEFIELD").html(dobj.data);
					document.getElementById('loading_data').style.display = "none";
					document.getElementById('t_present').value = dobj.tpresent;
					document.getElementById('t_wfh').value = dobj.twfh;
					document.getElementById('t_leave').value = dobj.tleave;
					document.getElementById('t_abs').value = dobj.tabs;
					
					
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
			} 
		});
	
}	

</script>