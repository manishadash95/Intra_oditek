<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$curdate=date("Y-m-d");
	$curmonth=date("m");
	$curyear=date("Y");
	$dadata= new Configurations();
	
	$emp_id = 	$_SESSION["emp_id"];
	
	$dt = $_REQUEST['dt'];
	$iv = $_REQUEST['iv'];
	if(strlen($dt) > 0)
		$dt = trim($dbobj->get_mcrypt_decrypt($dt,$iv));
	
	if($dt != "")
		$today = $dt;
	else	
		$today = date("d-m-Y");
	
	
	$myteam = $dbobj->getAllMyTeamName($emp_id);
	
?>
<?php include 'include/header.php' ?>
<script>
function resetform(){
	document.getElementById("txtcity").value="";
	document.getElementById("hidaddedit").value="add";
	document.getElementById("hideditid").value="";
	document.getElementById("cmbcity").options[0].selected=true;
	document.getElementById("hidbaseid").value="0";
}

function showdaedit(id,rank,rankid){
	document.getElementById("txtrank").value=rank;
	document.getElementById("hidaddedit").value="edit";
	document.getElementById("hideditid").value=id;
	
	for(i=0;i<document.getElementById("cmbrank").length;i++){
		if(document.getElementById("cmbrank").options[i].value==rankid){
			document.getElementById("cmbcity").options[i].selected=true;
			return false;
		}
	}
	return false;
}
</script>
<?php include 'include/leftsidebar.php' ?>
        <!-- begin MAIN PAGE CONTENT -->
        <div id="page-wrapper">

            <div class="page-content">

                <!-- begin PAGE TITLE AREA -->
                <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                <div class="row">
                	
                    <div class="col-lg-12">
                        <div class="page-title">
                            <ol class="breadcrumb">
                             	<li class="active">Daily HR Report</li>
                               
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE AREA -->
               
			   <!--main_heading_div-->
				<?php echo $msg;?>
                <!-- /.row -->
				<form name="frmdarate" id="frmdarate" method="post">
				<div class="row" id="load_subadmin">
				<div class="clearfix"></div>
				</div> <!-- end_row_div -->
				</form>
                
                <!--row_div-->
                
                <div class="row">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4> My Daily Report</h4>
                                </div>
                                <div class="clearfix"></div>
								
                            </div>
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
								<?php if($dt != ""){ ?>
								<div class="bpaddingdiv1 text-center">
								
								<a href="mydailyhrslist.php" >
								
								<input type="button" class="btn btn-md btn-red " value="Back" >
								</a>
								</div>
								<?php } ?>
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv3">
										
										
										<form name="myformdata" id="myformdata" method="post" ">
										
										
                                            <div class="bs-docs-example table-responsive">
                                            
											
											<div class="col-md-4">
											
											
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Report To :</span>
											<select id="reso_id" name="reso_id" class="form-control" >
											<option value="<?php echo $emp_id;?>">My Report</option>
											<?php
												foreach($myteam as $val)
												{
													echo '<option value="'.$val->id.'">'.$val->name.'</option>';
												}			
											?>														
											</select>
											</div>											
											
											</div>
											
											
											<div class="col-md-4">
											
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Select Date :</span>
												<input type="text" name="start_date" id="start_date" class="form-control tcal" placeholder="Start Date" value="<?php echo $today;?>">
                                            </div>
                                            </div>                                          
                                           										
											
											<div class="col-md-4">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right" style="width:200px">Total Work Time :</span>
												<input type="text" readonly name="twtime" id="twtime" class="form-control" placeholder="" value="">
											</div>
											
											
											
											
											</div>										
											
											
											<div class="clearfix"></div>
										
										<?php if($read =="") { ?>									
											
										<div class="col-lg-12">
										<div class="bpaddingdiv1 text-center">
										<input type="hidden" name="htype" id="htype" value="0">
										<input type="button" name="btnsubmit" id="btnsubmit" class="btn btn-green btn" onclick="loadEmplyeeRecords();" value="Submit">
										</div>
										</div>
										
										<?php }	?>	
											
										<div class="clearfix"></div>	
                                        </div>
										
										
										
										
										
										
										
										
										
					
								<div class="portlet-body">
									
                                    
                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-4 col-sm-4">
                                                    <col class="col-md-2 col-sm-2">
                                                    
                                                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Date</th>
                                                        <th>Project name</th>
														<th>Group name</th>
														<th>Task</th>
														<th>Comments</th>
                                                        <th>Time</th>
                                                   
                                                    </tr>
                                                </thead>
                                                <tbody id="TASKLISTDISPLAYID" class="tablefont">
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
                                    </div>
                                   	</div>
									
									
									
									
							
										
						<div class="clearfix"></div>				
										
										
										
										
										
										
										
										</form>
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											<ul class="pagination pull-right margintopzerodiv">
												 <?php //echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?>
											</ul>  
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    </div>
                                    <!--end_total_left_side_div-->
                                </div>
                            </div>                            
                        </div>
                    <!--end_left_div-->
                  </div>
                  <div class="clearfix"></div>
                </div> <!--end_row_div-->
                
            </div>
            <!-- /.page-content -->

        </div>
        
         <!--view_employee_div-->
    
    <!--end_view_employee_div-->
    <script type="text/javascript"> 
	
	
	window.onload = function() {
		loadEmplyeeRecords();
	};


	

	function loadEmplyeeRecords(){
		//alert("aaa");
		loadEmplyeeTime();
		loadEmplyeeData();
	
	}


	function loadEmplyeeTime(){
	
		var start_date =  document.getElementById('start_date').value;
		var eid =  document.getElementById('reso_id').value;
		
		var dataString = "action=getdailytasktime2&date_time="+start_date+"&eid="+eid;
		//alert(""+dataString);
		
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					document.getElementById('twtime').value = dobj.ttime;
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
	}
	
	
	function loadEmplyeeData(){
	
		var start_date =  document.getElementById('start_date').value;
		var eid =  document.getElementById('reso_id').value;
		var dataString = "action=getdailytaskdata2&date_time="+start_date+"&eid="+eid;;
		//alert(""+dataString);
		
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#TASKLISTDISPLAYID").html(dobj.data);
				}else{
					$("#TASKLISTDISPLAYID").html(dobj.data);
					alert(dobj.msg);
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
	}

	
	
	 </script>
<?php include 'include/footer.php' ?>
