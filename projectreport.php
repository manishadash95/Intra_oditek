<?php 
ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	
	$dbobj = new DBConnection();
	$dbobj->connect();
	$newAdmintobj = $dbobj;	
	$editAdmintobj = $dbobj;
	
	$customerobj = $dbobj->getAllCustomer();
	$groupobj = $dbobj->getProjectGrp();
	$custArray = $dbobj->getCustomerGrp();
	
	$projectlist= $dbobj->getProjectList();
	$resourcelist= $dbobj->getResourceList();
	$taskTimeArray= $dbobj->getProjectTaskTime();
	
	/*
	if(isset($_POST["btnsubmit"]))
	{
		if($_POST['hidaddedit']=="add")
		{
			$ret = $dbobj->addNewProjectTask($_POST);
			$msg = '<script>alert("'.$ret.'");</script>';
		}
		
		
		if($_POST['hidaddedit']=="edit")
		{
			//$ret = $dbobj->updateProject($_POST);
			$msg = '<script>alert("'.$ret.'");</script>';
		}
		
		
	}
	*/
	
	if(!isset($_GET["page"]) || $_GET["page"]=="" || $_GET["page"]<1){
		$page = 1;
	}else{
		$page = (int) $_GET['page'];
	}

	$subAdminObj = $dbobj->getProjectList();
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
                               <li class="active">Project Hour Report</li>
                            </ol>

                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE AREA -->
               
			   <!--main_heading_div-->
			   
               <!--search_filed_div-->
               
                <div class="clearfix"></div>
               	<!--end_search_field_div-->
				<?php echo $msg;?>
                <!-- /.row -->
               <form name="myformdata" id="myformdata" method="post" enctype="multipart/form-data"  >
                <div class="row" id="load_subadmin">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> Project Hour Report</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#manageadmin"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="manageadmin" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->
                                    <div class="totalaligndiv">
									
									<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Select Customer:</span>
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
                                                <span class="input-group-addon ndrftextwidth text-left">Select Project :</span>
												<select class="form-control" id="pro_id" name="pro_id" onChange="loadProjectTaskList()">
                                                    <option value="0">All Projects</option>
                                                 <?php
													//foreach($projectlist as $val)
													//{
													//		echo '<option value="'.$val->pid.'">'.$val->pname.'</option>';
													//}			
														?>	
												 </select>		
                                            </div>
                                                                                       
                                                                                     
                                            
                                        </div>
									
									<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Select Group:</span>
												<select class="form-control" id="grp_id" name="grp_id" onChange="loadProjectTaskList()">
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
										
									
										
										
										<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Select Task :</span>
												<select class="form-control" id="task_id" name="task_id" >
                                                    <option value="0">All Tasks</option>
                                                 <?php
													//foreach($projectlist as $val)
													//{
													//		echo '<option value="'.$val->pid.'">'.$val->pname.'</option>';
													//}			
														?>	
												 </select>		
                                            </div>
                                                                                       
                                                                                     
                                            
                                        </div>
										
																				
										
                                    	<div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Select Start Date :</span>
												<input type="text" readonly name="start_date" id="start_date" class="form-control tcal" placeholder="Start Date">
                                            </div>
                                                                                        
                                           
                                            
                                        </div>
                                        <Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Select End Date :</span>
												<input type="text" readonly name="end_date" id="end_date" class="form-control tcal" placeholder="End Date">
                                            </div>
                                        </div>
										
										
										
										 <div class="clearfix"></div>
										  
										
										<input type="hidden" name="hidaddedit" id="hidaddedit" value="add" />
										<input type="hidden" name="hideditid" id="hideditid" value="" />
										
										
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="tpaddingdiv1 text-center">
                                                <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return actionGenerateReport()">Generate Report</button>
												<button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return actionPrintReport()">Print Report</button>
								            </div>
											
											
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!--end_total_left_side_div-->
                                </div>
                            </div>                            
                        </div>
                    <!--end_left_div-->
                  </div>
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> Report</h4>
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
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-3 col-sm-3">
													<col class="col-md-4 col-sm-4">
													<col class="col-md-3 col-sm-3">
                                                 	<col class="col-md-2 col-sm-2">
											    </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th class="center_td">SN</th>
                                                        <th class="center_td">DateTime</th>
														<th class="center_td">Project Name</th>
														<th class="center_td">Group Name</th>
														<th class="center_td">Task Name</th>
														<th class="center_td">Comments</th>
														<th class="center_td">Resource</th>
														<th class="center_td">Time<BR>[HH:MM]</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="PROLISTDISPLAYID" class="tablefont" >
												
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											 
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
				
				
				
				
                
				<!--row_div-->
            </div>
            <!-- /.page-content -->

        </div>
        
<!--view_employee_details_div-->

        
<?php include 'include/footer.php' ?>
<script>
function editClose()
{
	document.getElementById('loading_data').style.display="block";
	window.location.reload();
}


function checkValidation()
{
	var cus_id =  document.getElementById('cus_id').value;
	var start_date =  document.getElementById('start_date').value;
	var end_date =  document.getElementById('end_date').value;
	
	if(cus_id == 0) {
		alert("Please select Customer...");
		return false;
	}
	
	if(start_date.length == 0) {
		alert("Please select start date...");
		return false;
	}
	
	if(end_date.length == 0) {
		alert("Please select end date...");
		return false;
	}
	
			
	return true;
}


function actionGenerateReport(){

	var ret = checkValidation();
	if(!ret)
		return false;
	
	
	var cus_id =  document.getElementById('cus_id').value;
	var pro_id =  document.getElementById('pro_id').value;
	var grp_id =  document.getElementById('grp_id').value;
	var task_id =  document.getElementById('task_id').value;
	var start_date =  document.getElementById('start_date').value;
	var end_date =  document.getElementById('end_date').value;

	var dataString = "action=generatehrreport&cus_id="+cus_id+"&grp_id="+grp_id+"&pro_id="+pro_id+"&task_id="+task_id+"&start_date="+start_date+"&end_date="+end_date;
	//alert("dataString:"+dataString);
	
	
	$.ajax({ 
		type: "POST",url: "ajaxproject.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#PROLISTDISPLAYID").html(dobj.data);
		
			}
			else{
				alert(dobj.msg);
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
	
}


function actionPrintReport(){

	var ret = checkValidation();
	if(!ret)
		return false;
	
	
	var cus_id =  document.getElementById('cus_id').value;
	var grp_id =  document.getElementById('grp_id').value;
	var pro_id =  document.getElementById('pro_id').value;
	var task_id =  document.getElementById('task_id').value;
	var start_date =  document.getElementById('start_date').value;
	var end_date =  document.getElementById('end_date').value;

	var dataString = "action=generatehrreport&cus_id="+cus_id+"&grp_id="+grp_id+"&pro_id="+pro_id+"&task_id="+task_id+"&start_date="+start_date+"&end_date="+end_date;
	//alert("dataString:"+dataString);
	
	
	$.ajax({ 
		type: "POST",url: "ajaxphpexcel.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				var dpath=dobj.file_name;
				var a = document.createElement("a");
				document.body.appendChild(a);
		        a.href = dobj.file_path;
		        a.download =dpath;
		        a.target='_blank';
		        a.click();
		
			}
			else{
				alert(dobj.msg);
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
	
}

function loadProjectTaskList(){
	var pro_id =  document.getElementById('pro_id').value;
	var grp_id =  document.getElementById('grp_id').value;
	var dataString = "action=loadprojecttasklist&pro_id="+pro_id+"&grp_id="+grp_id;
	//alert("dataString:"+dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxproject.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				//alert(dobj.msg);
				//alert(dobj.data);
				$("#task_id").html(dobj.data);
				
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
	loadProjectTaskResourcesList();
	
}

function loadProjectTaskResourcesList(){
	
	return;
	var pro_id =  document.getElementById('pro_id').value;
	var task_id =  document.getElementById('task_id').value;
	var dataString = "action=loadprojecttaskresources&pro_id="+pro_id+"&task_id="+task_id;
	//alert("dataString:"+dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxproject.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				//alert(dobj.msg);
				//alert(dobj.data);
				$("#reso_id").html(dobj.data);
				
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
}

function loadProjectList(){
	var cus_id =  document.getElementById('cus_id').value;
	var dataString = "action=loadcusproject&grp_id="+grp_id+"&cus_id="+cus_id;
		
	$.ajax({ 
		type: "POST",url: "ajaxproject.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#pro_id").html(dobj.data);
				loadProjectTaskList();
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
}


function resetSelection(){
	document.getElementById('pro_taskname').value="";
	document.getElementById('task_time').options[0].selected=true;
	document.getElementById("task_status").options[0].selected=true;
	document.getElementById("hidaddedit").value="add";
	document.getElementById("hideditid").value="";
	$("#btnsubmit").html("Add");
	
}

function resetform(){
	var action_type = document.getElementById("hidaddedit").value;
	if(action_type == "edit")
	{
		resetSelection();
	}
	else{
		document.getElementById("hidaddedit").value="add";
		document.getElementById("hideditid").value="";
		document.getElementById("pro_id").options[0].selected=true;
		document.getElementById("task_status").options[0].selected=true;
		document.getElementById('task_time').options[0].selected=true;;
		document.getElementById("pro_taskname").value = "";
		$("#btnsubmit").html("Add");
		$("#TASKLISTDISPLAYID").html("");
	}

}



function showdEdit(taskid,name,time,status){
	
	//alert("::"+name);
	
	document.getElementById("hidaddedit").value="edit";
	document.getElementById("hideditid").value=taskid;
	$("#btnsubmit").html("Update");
	
	for(i=0;i<document.getElementById("task_time").length;i++){
		if(document.getElementById("task_time").options[i].value==time){
			document.getElementById("task_time").options[i].selected=true;
			break;
		}
	}
	
	for(i=0;i<document.getElementById("task_status").length;i++){
		if(document.getElementById("task_status").options[i].value==status){
			document.getElementById("task_status").options[i].selected=true;
			break;
		}
	}
		
	document.getElementById("pro_taskname").value = name;
	
	return false;
}

</script>
