<?php 
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
	
	$groupobj = $dbobj->getProjectGrp();
	
	//$projectArray = $dbobj->getProjectList();
	
	
	
	$today = date("d M, Y [l]");
	$yesday1 = date('d M, Y [l]',strtotime("-1 days"));
	$yesday2 = date('d M, Y [l]',strtotime("-2 days"));
	$yesday3 = date('d M, Y [l]',strtotime("-3 days"));
	$yesday4 = date('d M, Y [l]',strtotime("-4 days"));
	
	$customerobj = $dbobj->getAllCustomer();
	
	//
	$mydailyObj = $dbobj->getMyDailyReport($emp_id);
	//echo $mydailyObj->worddone;
	//die();
	if($mydailyObj->status == 0)
	{
		$note = "Daily report will be submitted at 8:00 PM of same day...";
		$read = "";
		$disabled = "";		
	}else{
		$note = "Daily report already closed...";
		$read = "readonly";
		$disabled = "disabled";
	}
	
	
	
	
	
?>
<?php include 'include/header.php' ?>

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
                                
								<li class="active">Daily Report</li>
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> My Daily Report</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#employeeliststatus"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv3">
										
										
										<form name="myformdata" id="myformdata" method="post" ">
										
										
                                            <div class="bs-docs-example table-responsive">
                                            
											
												
											
                                            
											<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-right" style="width:150px">Select Customer:</span>
												<select class="form-control" id="cus_id" name="cus_id" onChange="loadProjectList()">
                                                    <option value="0">Select Customer</option>
                                                 <?php
													foreach($customerobj as $val)
													{
															echo '<option value="'.$val->cus_id.'">'.$val->cus_code.' ['.$val->cus_name.']</option>';
													}			
														?>	
												 </select>		
                                            </div>
											</div>
										
										<Div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right" style="width:150px" >Project Name:</span>
												 <select id="pro_id"  name="pro_id" class="form-control" onChange="loadProjecttask()" >
												<option value="0">Select Project</option>
														
                                                </select>
											</div>
											
											</div>
											
											<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-right" style="width:150px">Select Group:</span>
												<select class="form-control" id="grp_id" name="grp_id" onChange="loadProjecttask()">
                                                    <option value="0">All Group</option>
                                                 <?php
													foreach($groupobj as $val)
													{
															echo '<option value="'.$val->grpid.'">'.$val->grpname.'</option>';
													}			
														?>	
												 </select>		
                                            </div>
                                                                                       
                                                                                     
                                            </div>
											
                                            
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right" style="width:150px" >Project Task:</span>
												 <select id="pro_task"  name="pro_task" class="form-control" >
												 <option value="">Select Project Task</option>
														
                                                </select>
											</div>
											
											
											</div>
											
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right" style="width:150px">Date & Time :</span>
												<select id="wtime"  name="wtime" class="form-control" onChange="loadEmplyeeRecords();" >
														<option value="1"  ><?php echo $today; ?></option>
														<option value="2"  ><?php echo $yesday1; ?></option>
														<option value="3"  ><?php echo $yesday2; ?></option>
														<option value="4"  ><?php echo $yesday3; ?></option>
														<option value="5"  ><?php echo $yesday4; ?></option>
												</select>
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right" style="width:150px" >Work From :</span>
													<select id="wfrom" <?php echo $read;?> <?php echo $disabled;?> name="wfrom" class="form-control" >
														<option value="1"  >Office</option>
														<option value="2"  >Home</option>
														<option value="3"  >Client</option>														
													</select>
											</div>
											
											
											</div>
											
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right" style="width:150px">Total Work Time :</span>
												<input type="text" readonly name="twtime" id="twtime" class="form-control" placeholder="" value="">
											</div>
											
											
											
											
											</div>
											
											
											
											
											
											
											
											
											<div class="col-md-6">
																	
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right" style="width:150px" >Project Time:</span>
													<select id="ptime"  name="ptime" class="form-control" >
														<option value="15"  >15 Mins</option>
														<option value="30"  >30 Mins</option>
														<option value="45"  >45 Mins</option>
														<option value="60"  >1 HR</option>
														<option value="120"  >2 HRs</option>
														<option value="180"  >3 HRs</option>
														<option value="240"  >4 HRs</option>
														<option value="300"  >5 HRs</option>
														<option value="360"  >6 HRs</option>
														<option value="420"  >7 HRs</option>
														<option value="480"  >8 HRs</option>
													</select>
											</div>
											
											
											</div>
											
											
											<div class="col-md-12">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-center" style="width:300px">Achieved</span>
												
											</div>
											
											</div>
											
											<div class="col-md-12">
											
											<div class="input-group bmargindiv1 col-md-12">
											<textarea id="remark1" <?php echo $read;?> class="form-control" maxlength="1000" rows="2" name="remark1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
											
											</div>
											
											
											</div>
											
											
											
											<div class="clearfix"></div>
										
										<div class="col-md-12" name="holiday_div" id="holiday_div" style="display:none">
										<div class="input-group bmargindiv1 col-md-12">
										<span name="holiday" id="holiday" class="input-group-addon ndrftextwidth text-left" style="width:300px;color:red"></span>
												
										</div>
										</div>
											
										<?php if($read =="") { ?>									
											
										<div class="col-lg-12">
										<div class="bpaddingdiv1 text-center">
										<input type="hidden" name="htype" id="htype" value="0">
										<input type="hidden" name="hid" id="hid" value="0">
										<input type="button" name="btnsubmit" id="btnsubmit" class="btn btn-green btn" onclick="checkAndAddData();" value="Submit">
										
										<input type="button" name="" id="" class="btn btn-red btn" onclick="resetSelection();" value="Cancel">
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
													<col class="col-md-1 col-sm-1">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-1">
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
                                                        <th>Edit</th>
                                                        <th>Delete</th>
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


	function loadProjectList(){
		
	var cus_id =  document.getElementById('cus_id').value;
	var dataString = "action=loadproject&cus_id="+cus_id;
	//alert("dataString:"+dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#pro_id").html(dobj.data);
			}
			else
			{
				alert(dobj.msg);
				location.reload();
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
	}
	
	function loadProjecttask()
	{
		
		var grp_id =  document.getElementById('grp_id').value;
		var pro_name =  document.getElementById('pro_id').value;
		var dataString = "action=loadprojecttask&pro_id="+pro_name+"&grp_id="+grp_id;
		//alert("dataString:"+dataString);
	
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#pro_task").html(dobj.data);
				}
				else
				{
					alert(dobj.msg);
					location.reload();
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
		
		
	}


	function loadEmplyeeRecords(){
		//alert("aaa");
		loadEmplyeeTime();
		loadEmplyeeData();
	
	}


	function loadEmplyeeTime(){
	
		var wtime =  document.getElementById('wtime').value;
		
		var dataString = "action=getprojecttasktime&w_id="+wtime;
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
				else
				{
					//alert(dobj.msg);
					//location.reload();
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
	}
	
	
	function loadEmplyeeData(){
	
		var wtime =  document.getElementById('wtime').value;
		
		var dataString = "action=getprojecttaskdata&w_id="+wtime;
		//alert(""+dataString);
		
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#TASKLISTDISPLAYID").html(dobj.data);
					if(dobj.holiday.length > 0)
					{
						//alert("Holiday");
						$("#holiday").html(dobj.holiday);
						document.getElementById('holiday_div').style.display ="block";
					}else{
						$("#holiday").html("");
						document.getElementById('holiday_div').style.display ="none";
					}
				}
				else
				{
					alert(dobj.msg);
					location.reload();
				}
				//alert("::"+dobj.holiday);
				
				
				//document.getElementById('loading_data').style.display="none";
			} 
		});
	}



	
	

	function checkValidation()
	{
		
		var cus_id = document.getElementById('cus_id').value;
		var pro_name = document.getElementById('pro_id').value;
		var pro_task = document.getElementById('pro_task').value;
		var remark1 = document.getElementById('remark1').value;
		
		if(cus_id == 0 )
		{
			alert("Please select Customer Name...");
			return false;
		}
		
		if(pro_name == "" )
		{
			alert("Please select Project Name...");
			return false;
		}
		
		if(pro_task == "" )
		{
			alert("Please select Project Task Name...");
			return false;
		}
				
		if(remark1.length == 0 )
		{
			alert("Today Achieved field should not be empty...");
			return false;
		}
		return true;
	}
	
	function checkAndAddData()
	{
		
		var ret = checkValidation();
		if(!ret)
			return false;
		
		//document.getElementById('loading_data').style.display="block";
		var dataString = "action=adddailyprojecttask&";
		dataString +=$( "#myformdata" ).serialize();
		//alert("dataString:"+dataString);
		
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				alert(dobj.msg);
				if(dobj.status==1)
				{
					//alert("aaaa");
					loadEmplyeeRecords();
					resetSelection();
					document.getElementById("htype").value = 0;
					document.getElementById("hid").value = 0;
					
					//loadProjectTaskList();
				}
				else{
					location.reload();
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
		
	}
	
		
	
	
	function resetSelection(){
		
	document.getElementById('remark1').value="";
	document.getElementById('pro_task').options[0].selected=true;
	document.getElementById('grp_id').options[0].selected=true;
	document.getElementById("ptime").options[0].selected=true;
	document.getElementById("wfrom").options[0].selected=true;
	document.getElementById("cus_id").disabled = false;
	document.getElementById("pro_id").disabled = false;
	document.getElementById("pro_id").disabled = false;
	document.getElementById("pro_task").disabled = false;
	document.getElementById("grp_id").disabled = false;
	document.getElementById("wtime").disabled = false;
								
	//document.getElementById("hidaddedit").value="add";
	//document.getElementById("hideditid").value="";
	//$("#btnsubmit").html("Add");
	
}


   
	
	
	function updatepage()
	{
		if(reload)
			window.location.reload();
	}
	
	
	function showdEdit(id)
	{
		
		var dataString = "action=editprojecttask&id="+id;
		//alert(dataString);		
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj111=jQuery.parseJSON(html);
				if(dobj111.status==1)
				{//000
					//alert(dobj111.grp_id);
					for(i=0;i<document.getElementById("cus_id").length;i++){
						if(document.getElementById("cus_id").options[i].value==dobj111.cus_id){
							document.getElementById("cus_id").options[i].selected=true;
							
							break;
						}
					}
					
					for(i=0;i<document.getElementById("grp_id").length;i++){
						if(document.getElementById("grp_id").options[i].value==dobj111.grp_id){
							document.getElementById("grp_id").options[i].selected=true;
								break;
							}
					}
					
					var cus_id =  document.getElementById('cus_id').value;
					var dataString = "action=loadproject&cus_id="+cus_id;
					//alert("dataString:"+dataString);
					
					$.ajax({ 
						type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
						success: function(html)
						{//11111	 
							var dobj=jQuery.parseJSON(html);
							if(dobj.status==1)
							{//start
								///////////////////////////////////
								$("#pro_id").html(dobj.data);
								
								for(i=0;i<document.getElementById("pro_id").length;i++){
									if(document.getElementById("pro_id").options[i].value==dobj111.pro_id){
										document.getElementById("pro_id").options[i].selected=true;
									break;
									}
								}
					
								var pro_name =  document.getElementById('pro_id').value;
								var grp_id =  document.getElementById('grp_id').value;
								var dataString = "action=loadprojecttask&pro_id="+pro_name+"&grp_id="+grp_id;
								//alert(dataString);
								$.ajax({ 
									type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
									success: function(html)
									{	 
										var dobj1=jQuery.parseJSON(html);
										if(dobj1.status==1)
										{
											$("#pro_task").html(dobj1.data);
											//document.getElementById("htype").value = 1;
													
											for(i=0;i<document.getElementById("pro_task").length;i++){
												if(document.getElementById("pro_task").options[i].value==dobj111.pro_task_id){
												document.getElementById("pro_task").options[i].selected=true;
												break;
												}
											}
								
										}
												//document.getElementById('loading_data').style.display="none";
									} 
								});
		
														
							
								for(i=0;i<document.getElementById("wtime").length;i++){
									if(document.getElementById("wtime").options[i].value==dobj111.date){
										document.getElementById("wtime").options[i].selected=true;
										break;
									}
								}
									
									
								for(i=0;i<document.getElementById("wfrom").length;i++){
									if(document.getElementById("wfrom").options[i].value==dobj111.location){
										document.getElementById("wfrom").options[i].selected=true;
										break;
									}
								}
									
								for(i=0;i<document.getElementById("ptime").length;i++){
									if(document.getElementById("ptime").options[i].value==dobj111.time){
										document.getElementById("ptime").options[i].selected=true;
										break;
									}
								}
								document.getElementById('remark1').value=dobj111.text;
								document.getElementById("htype").value = 1;
								document.getElementById("hid").value = id;
								
								document.getElementById("cus_id").disabled = true;
								document.getElementById("pro_id").disabled = true;
								document.getElementById("pro_id").disabled = true;
								document.getElementById("pro_task").disabled = true;
								document.getElementById("grp_id").disabled = true;
								document.getElementById("wtime").disabled = true;
								
								
									
							}///end
						}//11111 
					});
					
									
				}//0000
				else{
					alert(dobj111.msg);
					location.reload();
				}	 
			}
			
		});
		
		
	}
	
			
	function  showdDelete(id)
	{
		var status = confirm("Are you sure want to delete this task?");
		if(status)
		{
			var dataString = "action=deleteprojecttask&id="+id;
				
			$.ajax({ 
				type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
				success: function(html)
				{
					var dobj=jQuery.parseJSON(html);
					if(dobj.status==1)
					{
						loadEmplyeeRecords();
						resetSelection();
					}
					else{
						alert(dobj.msg);
						location.reload();
					}
					
					
				}
			});
		}
		
	}
	
	
	
	
	 </script>
<?php include 'include/footer.php' ?>
