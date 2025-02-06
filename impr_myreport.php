<?php 

ini_set("display_errors",1);
error_reporting(E_ALL);
include 'include/init.php';
include_once 'dbcon/DBConnection.php';
$dbobj = new DBConnection();
$dbobj->connect();
//$session_rank = $_SESSION["admin_rank"];
$readonly = "readonly";
$disabled = "disabled";
$eid = 	$_SESSION["emp_id"];
//$emp_name = $dbobj->getEmpName($eid);
$dbobj->connect();
$iv = $_REQUEST['iv'];
$pro = $_REQUEST['pro'];
$res = $_REQUEST['res'];
$typ = $_REQUEST['typ'];
$sdate = $_REQUEST['sdate'];
$edate = $_REQUEST['edate'];
$imprid = $_REQUEST['imprid'];
$imprid = trim($dbobj->get_mcrypt_decrypt($imprid,$iv));

$priority_input = $dbobj->get_mcrypt_decrypt($priority, $iv);
$responsible_input = $dbobj->get_mcrypt_decrypt($responsible, $iv);
$type_input = $dbobj->get_mcrypt_decrypt($type, $iv);
$sdate_input = trim($dbobj->get_mcrypt_decrypt($start_date,$iv));
$edate_input = trim($dbobj->get_mcrypt_decrypt($end_date,$iv));
	
	
$device_view_page = "impr_report.php?typ=".$typ."&iv=".$iv."&res=".$res."&pro=".$pro."&sdate=".$sdate."&edate=".$edate;

	
	
$dbobj->updateCreatorIMPReadStatus($imprid,0);
	
$serviceObj = $dbobj->getIMPRecordDetails($imprid);
	//$defaultData =  $dbobj->getDefaultImprovementInfo();
	
	
	
	
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
						<li class="active">Improvement Ideas</li>
						
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		<a href="<?php echo $device_view_page;?>" >
			<input type="button" class="btn btn-md btn-red " value="Back" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
			</a>
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4 style="font-size: 14px"><B> [#<?php echo $serviceObj->imprid;?>]:[<?php echo $serviceObj->status_str;?>] 
									Created on <?php echo $serviceObj->date_created;?> </B>
									</h4>
								</div>
							
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
							
							
							<div class="portlet-body">
							
							
							
							
							<div class="col-md-12">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Title :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->title;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Reported By :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->reported_name;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Type :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->type;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Responsible :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->responsible_name;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span class="input-group-addon ndrftextwidth text-right">Assign to :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->assign_name;?>" >
							</div>
							</div>
							
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Priority :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->priority_name;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Target Date :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->targetdate;?>" >
							</div>
							</div>
							
							
							</div>
							
							
					<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
																	
									<div class="col-md-12">
									<a href="javascript://" data-dismiss="modal" data-toggle="modal" data-target="#viewemployeelistdiv" >
									
									</a>
									</div>
									
									<?php $cout=0; foreach($serviceObj->dataArray as $data)
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
											<textarea readOnly  class="form-control text-left" maxlength="1000" rows="<?php echo $line_cnt;?>" style="margin: 0px -0.5px 0px 0px; height: auto;resize: none"><?php echo trim($data->msg); ?></textarea>
											
											</div>
											<?php if($data->attachment > 0){ ?>
											<div class="input-group  col-md-12">
											<span class="input-group-addon ndrftextwidth text-left" style="border-left: 1px solid #CCCCCC;
											border-right: 1px solid #CCCCCC;" >
											<img src="img/attach2.png" width="20" height="20" alt=""  />
											<?php if(strlen($data->file1) > 0){ ?>
											<span style="cursor:pointer;" onClick="downloadFile(<?php echo $imprid.",".$data->dataid.",'".$data->file1."'"?> )" >
											<B><?php echo $data->file1; ?> </B>
											</span>
											<?php }	?>											
											
											
											<?php if(strlen($data->file2) > 0){ ?>
											<span style="cursor:pointer;" onClick="downloadFile(<?php echo $imprid.",".$data->dataid.",'".$data->file2."'"?> )" >
											<B><?php echo $data->file2; ?> </B>
											</span>
											<?php }	?>
											
											
											<?php if(strlen($data->file3) > 0){ ?>
											<span style="cursor:pointer;" onClick="downloadFile(<?php echo $imprid.",".$data->dataid.",'".$data->file3."'"?> )" >
											<B><?php echo $data->file3; ?> </B>
											</span>
											<?php }	?>
											
											</span>
											</div>
											
											<?php }	?>
											
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
						</div>
					</div>
					<!-- /.col-lg-12 -->

				</div>
			</div>
		</div>

	</div>
	<!-- /.page-content -->

</div>

</div>




							
											


<?php include 'include/footer.php' ?>
<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee.js"></script>

<script>


	



</script>
