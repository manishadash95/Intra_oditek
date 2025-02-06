<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
	$iv = $_REQUEST['iv'];
	
	$empList = $dbobj->getAllActiveEmployeeListNameExceptMgmt();
	
	$emp_id = $_REQUEST['emp_id'];
	//$iv = $_REQUEST['iv'];
	$emp_id = trim($dbobj->get_mcrypt_decrypt($emp_id,$iv));
	$finance_head = $dbobj->getFinanceHead();
	$bu_head = $dbobj->getAllBU();

	
	
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
						<li class="active">Request Report</li>
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
									<h4>Generate Request Report</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="dataform" id="dataform" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
			
								 <div class="col-md-12">
								
								<div class="col-md-6">											
								<div class="input-group bmargindiv1 col-md-12">
								<span  class="input-group-addon ndrftextwidth text-right">BU Head :</span>
								<select id="bu_head" name="bu_head" class="form-control" >
								<option value="0">Select All</option>
								<?php
								foreach($bu_head as $val)
								{
								   echo '<option value="'.$val->id.'">'.$val->name.'</option>';
								}			
								?>			
								</select>
								</div>
								</div>
								
								<div class="col-md-6">											
								<div class="input-group bmargindiv1 col-md-12">
								<span  class="input-group-addon ndrftextwidth text-right">Account Head :</span>
								<select id="pr_head" name="pr_head" class="form-control" >
								<option value="0">Select All</option>
								<?php
								foreach($finance_head as $val)
								{
								   echo '<option value="'.$val->id.'">'.$val->name.'</option>';
								}			
								?>			
								</select>
								</div>
								</div>
								</div>	
				
								<div class="col-md-12">
									
									
								<div class="col-md-6" >
								<div class="input-group bmargindiv1 col-md-12">
								<span class="input-group-addon ndrftextwidth text-right">Start Date :</span>
								<input type="date" name="start_date" id="start_date" class="form-control tcal" placeholder="Start Date">
								</div>
								</div>
																		
								<div class="col-md-6"  >
								<div class="input-group bmargindiv1 col-md-12">
								<span class="input-group-addon ndrftextwidth text-right">End Date :</span>
								<input type="date" name="end_date" id="end_date" class="form-control tcal" placeholder="End Date" >
								</div>
								</div>
																					
								</div>
				                    
									<div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="generatePurchaseReport()">Download</button>
                </div>
									<input type="hidden" id="heid" value="<?php echo $emp_id; ?>">
																		
									
									<div class="col-md-12">
									
									<div class="col-md-12">
                                    <div class="tpaddingdiv1 text-center">
                                    <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return actionGenerateReport()">Generate Report</button>
									</div>
							        </div>
									
									</div>
									
									<div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
                                                    <col class="col-md-3 col-sm-3">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
                                                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Date</th>
														<th>PR Id</th>
												        <th>Title</th>
														<th>BU</th>
														<th>Head</th>
														<th>Cost</th>
														<th>Status</th>
														<th>Created By</th>
														<th>View</th>
						                            </tr>
                                                </thead>
                                                <tbody id="DATAFIELD" class="tablefont">
									            </tbody>

                                            </table>
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

<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee.js"></script>
<script>



function actionGenerateReport() {
    var bu_head = document.getElementById('bu_head').value;
    var pr_head = document.getElementById('pr_head').value;
    var start_date = document.getElementById('start_date').value;
    var end_date = document.getElementById('end_date').value;
    var dataString = "action=GenerateReport&bu_head=" + bu_head + "&pr_head=" + pr_head + "&start_date=" + start_date + "&end_date=" + end_date;
 
   if (!start_date || !end_date) {
        alert("Please select both start and end dates.");
        return;
    }

    var dataString = "action=GenerateReport&bu_head=" + bu_head + "&pr_head=" + pr_head + "&start_date=" + start_date + "&end_date=" + end_date;
 
    if (new Date(start_date) > new Date(end_date)) {
        alert("Start date cannot be greater than end date");
        return; 
    }
   // alert("dataString:" + dataString);

    $.ajax({
       type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
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

</script>