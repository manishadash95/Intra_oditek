<?php 
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	
	$dbobj = new DBConnection();
	$dbobj->connect();
	$eid = $_SESSION["emp_id"];
    $imprid = $_REQUEST['imprid'];	
	$iv = $_REQUEST['iv'];
    $priority = $_REQUEST['pro'];
    $responsible = $_REQUEST['res'];
    $type = $_REQUEST['typ'];
    $start_date = $_REQUEST['sdate'];
    $end_date = $_REQUEST['edate'];
		
		
		
		
	// Decrypting the received data
	
$imprid = trim($dbobj->get_mcrypt_decrypt($imprid,$iv));
$priority_input = trim($dbobj->get_mcrypt_decrypt($priority, $iv));
$responsible_input = trim($dbobj->get_mcrypt_decrypt($responsible, $iv));
$type_input =  trim($dbobj->get_mcrypt_decrypt($type, $iv));
$sdate_input = trim($dbobj->get_mcrypt_decrypt($start_date, $iv));
$edate_input = trim($dbobj->get_mcrypt_decrypt($end_date, $iv));
//if($sdate_input != "")
//{
	//echo $sdate_input.":::".$edate_input;
	//exit();
	
//}
		
	$pro_Array = $dbobj->getAllPriority();
	$res_Array = $dbobj->getAllResponsible();
	$typ_Array = $dbobj->getAllType();

	
	
	

	//$emp_name = $dbobj->getEmpName($eid);
	//$allname_array = $dbobj->getAllNameWithBoard();

	
	//$defaultData =  $dbobj->getDefaultImprovementInfo();
	
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>
<?php include 'imageupload/popimageupload.php' ?>
<div id="page-wrapper">
	<div class="page-content">

		<div class="row">
			
			<div class="col-lg-12">
				<div class="page-title">
					<ol class="breadcrumb">
						<li class="active">Improvement Ideas</li>
					</ol>

				</div>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4> View My Improvement</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="dataform" id="dataform" method="post"  enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
								<div class="totalaligndiv">									
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Type :</span>
											<select id="typ" name="typ" class="form-control" onChange="actionImprovementReport()">
												<option value="0">Select All</option>
												<?php
												foreach ($typ_Array as $val) {
													if($type_input == $val->id)
													echo '<option selected value="'.$val->id.'">'.$val->name.'</option>';
												else										
													echo '<option value="'.$val->id.'">'.$val->name.'</option>';
												
												}
												?>
											</select>
										</div>
									</div>
											

												 <div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Responsible :</span>
											<select id="res" name="res" class="form-control" onChange="actionImprovementReport()">
												<option value="0">Select All</option>
												<?php
												foreach ($res_Array as $val) {
													if($responsible_input == $val->id)
													echo '<option selected value="'.$val->id.'">'.$val->name.'</option>';
												else										
													echo '<option value="'.$val->id.'">'.$val->name.'</option>';
												}
												?>
											</select>
										</div>
									</div>						
											

									<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Priority :</span>
											<select id="pro" name="pro" class="form-control" onChange="actionImprovementReport()">
												<option value="0">Select All</option>
												<?php
												foreach ($pro_Array as $val) {
													
													if($priority_input == $val->id)
													echo '<option selected value="'.$val->id.'">'.$val->name.'</option>';
												else										
													echo '<option value="'.$val->id.'">'.$val->name.'</option>';
												}
												?>
											</select>
										</div>
									</div>
										
									
							 <div class="col-md-4">
							<div class="input-group bmargindiv1 col-md-12">
								<span class="input-group-addon ndrftextwidth text-left">Select Date  :</span>
							  <input type="date" name="start_date" id="start_date" class="form-control tcal" placeholder="Start Date" value="<?php echo htmlspecialchars($sdate_input); ?>">

							</div>
						</div>

						<div class="col-md-4">
							<div class="input-group bmargindiv1 col-md-12">
								<span class="input-group-addon ndrftextwidth text-right">Select Date  :</span>
								<input type="date" name="end_date" id="end_date" class="form-control tcal" placeholder="End Date" value="<?php echo htmlspecialchars($edate_input); ?>">
							</div>
						</div>
											
						<div class="col-md-12">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" onclick="generateImprovementReport()">Download</button>
                        </div>
									
						<div class="col-md-12">
                          <div class="tpaddingdiv1 text-center">
                                    <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return actionImprovementReport()">Generate Report</button>
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
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
                                                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Date</th>
														<th>IMPR Id</th>
														<th>Reported By</th>
														<th>Type<br>Responsible</th>
														<th>Assign To</th>
														<th>Priority</th>
														<th>Trgate Date</th>
														<th>Status</th>
                                                       	<th>View</th>
						                            </tr>
                                                </thead>
                                                <tbody id="DATAFIELD" class="tablefont">
									            </tbody>

                                            </table>
                                        </div>
                                       
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    </div>
									
								
                                   	</div>
									
									
									<div class="clearfix"></div>
								
									<!--total_employee_div-->
									<div class="totalaligndiv">
									
									<div class="clearfix"></div>
									
									
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									
									
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
    window.onload = function() {
        actionImprovementReport();
    };

    function actionImprovementReport() {
        var typ = document.getElementById('typ').value;
        var res = document.getElementById('res').value;
        var pro = document.getElementById('pro').value;
        var sdate = document.getElementById('start_date').value;
        var edate = document.getElementById('end_date').value;

        var dataString = "action=ImprovementReport&typ=" + typ + "&res=" + res + "&pro=" + pro + "&start_date=" + sdate + "&end_date=" + edate;

        $.ajax({
            type: "POST",
            url: "ajaxprojectemployee.php",
            data: dataString,
            cache: false,
            success: function(html) {
                var dobj = jQuery.parseJSON(html);
                if (dobj.status == 1) {
                    $("#DATAFIELD").html(dobj.data);
                } else {
                    alert(dobj.msg);
                }
            }
        });
    }

    // Add click event handler for the Generate Report button
    $("#btnsubmit").click(function() {
        var sdate = document.getElementById('start_date').value;
        var edate = document.getElementById('end_date').value;

        if (!sdate || !edate) {
            alert("Please select both start and end dates.");
            return;
        }

        if (new Date(sdate) > new Date(edate)) {
            alert("Start date cannot be greater than end date");
            return;
        }

        actionImprovementReport();
    });
</script>

