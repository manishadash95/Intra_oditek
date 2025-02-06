<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$leaveTypeObj = $dbobj->getLeaveType();
	$eid = 	$_SESSION["emp_id"];
	
	$cleave = $dbobj->getAvailLeave($eid);
	
	
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
						<li class="active">WFH Dashboard</li>
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
									<h4> [<?php echo date("d-m-Y");?>] Today's WFH List</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="abc" id="abc" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
								
								
																	<!--total_employee_div-->
									<div class="totalaligndiv">
										
										
									<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-4">
													<col class="col-md-2 col-sm-3">
													<col class="col-md-2 col-sm-3">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
									            </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>WFH</th>
														<th>Name</th>
														<th>Group</th>
														<th>BU</th>
														<th>Status</th>
														<th>RM</th>
							                        </tr>
                                                </thead>
                                                <tbody id="DATAFIELD" class="tablefont">
									            </tbody>

                                            </table>
                                        </div>
                                       
                                    </div>
																		
							
										
										
										
										
										<!--end_3rd_div-->
										
									</div>
																	
									
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
		loadLeaveList();
	};
	
	
	
	function loadLeaveList()
	{
		
		var dataString = "action=loadTodayWFHList";
		$.ajax({ 
			type: "POST",url: "ajaxWFH.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#DATAFIELD").html(dobj.data);
				}
				//else{
				//	alert(dobj.msg);
				//	location.reload();
				//}
			} 
		});
		
		
		var dataString = "action=loadUpcomingLeaveList";
		$.ajax({ 
			type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#DATAFIELD123").html(dobj.data);
				}
				//else{
				//	alert(dobj.msg);
				//	location.reload();
				//}
			} 
		});
		
	}	
		
	

</script>