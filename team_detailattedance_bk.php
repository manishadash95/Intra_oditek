<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
	$iv = $_REQUEST['iv'];
	$date_input = $_REQUEST['date'];
	$eid = $_REQUEST['eid'];
	$type = $_REQUEST['type'];
	
	$date_input = trim($dbobj->get_mcrypt_decrypt($date_input,$iv));
	$eid = trim($dbobj->get_mcrypt_decrypt($eid,$iv));
	$type = trim($dbobj->get_mcrypt_decrypt($type,$iv));
	
	if($type == 1)	
		$empAttendanceData = $dbobj->getEmployeeAttendanceData($date_input ,$eid );
	else
		$empAttendanceData = $dbobj->getOthersAttendanceData($date_input ,$eid );
	
	$current_date = date("Y-m-d", strtotime($date_input));
	$current_date = $dbobj->get_mcrypt_encrypt($current_date,$iv);
	$team_attendance1 = "team_attendanceinfo.php?date=".$current_date."&iv=".$iv;
	
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
									<h4> View Resource Attendance Info</h4>
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
									
																		
											
											
									<!--total_employee_div-->
									<div class="totalaligndiv">
										
										
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
                                                <tbody >
												<?php
												$i=0;
												foreach($empAttendanceData as $value)
												{
													$i++;
													$color="";
													if($value->holiday)
														$color="red";	
												 ?>
												<tr>
												<td style="color:<?php echo $color?>;"><?php echo $i ?></td>
                                                <td style="color:<?php echo $color?>;"><?php echo $value->date_info ?></td>
												<td style="color:<?php echo $color?>;"><?php echo $value->day_info ?></td>
                                                <td style="color:<?php echo $color?>;"><?php echo $value->name ?></td>
												<td style="color:<?php echo $color?>;"><?php echo $value->start_time ?></td>
												<td style="color:<?php echo $color?>;"><?php echo $value->end_time ?></td>
												<td style="color:<?php echo $color?>;"><?php echo $value->work_time ?></td>
												<td style="color:<?php echo $color?>;"><?php echo $value->info ?></td>
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
	
	document.getElementById('loading_data').style.display = "none";
		
};
	

		

	

</script>