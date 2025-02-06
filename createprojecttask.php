<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	ini_set("display_errors",0);
	$dbobj = new DBConnection();
	$dbobj->connect();
	$newAdmintobj = $dbobj;	
	$editAdmintobj = $dbobj;
	
	$groupobj = $dbobj->getProjectGrp();
	$custArray = $dbobj->getCustomerGrp();
	
	$projectlist= $dbobj->getProjectList();
	$taskTimeArray= $dbobj->getProjectTaskTimeList();
	
	$checkAccess = $dbobj->checkEmployeeAccess("createprojecttask");
	if(!$checkAccess)
	{
		echo "Sorry, You have no access to this page...";
		exit();
		
	}		
	
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
                                <li class="active">Manage Project Tasks</li>
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> Add Project Tasks</h4>
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
									
									<Div class="col-md-4">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Customer Name :</span>
                                                <select class="form-control" id="pro_cus" name="pro_cus" onChange="loadProjectList()">
                                                    <option value="0">Select Customer</option>
														<?php
															foreach($custArray as $val)
															{
																$str = $val->cus_code." [ ".$val->cus_name." ] ";
																
																echo '<option value="'.$val->cus_id.'">'.$str.'</option>';
															}			
														?>	
                                                </select>
                                            </div>
                                                                                       
                                                                                     
                                            
                                    </div>
									
									
									<Div class="col-md-4">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Select Project :</span>
												<select class="form-control" id="pro_id" name="pro_id" onChange="loadProjectTaskList()">
                                                    <option value="0">Select Project</option>
                                                 <?php
													//foreach($projectlist as $val)
													//{
													//		echo '<option value="'.$val->pid.'">'.$val->pname.'</option>';
													//}			
														?>	
												 </select>		
                                            </div>
                                                                                       
                                                                                     
                                            
                                        </div>
										
										
										
									<Div class="col-md-4">
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
									
									
										
										<Div class="col-md-12">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Task Name :</span>
                                                 <input type="text" class="form-control" name="pro_taskname" id="pro_taskname" placeholder="Task Name" value="" style="background:#FFFFFF;" >
                                            </div>
                                             
                                        </div>
										
                                    	<div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Select Time :</span>
									            <select class="form-control" id="task_time" name="task_time">
                                                   <option value="0">Select Time</option>
                                                 <?php
													foreach($taskTimeArray as $val)
													{
															echo '<option value="'.$val["value"].'">'.$val["time"].'</option>';
													}			
													?>	
												 </select>
                                            </div>
                                                                                        
                                                                                       
                                        </div>
                                        <Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Task Status :</span>
                                                <select class="form-control" id="task_status" name="task_status">
                                                    <option value="1">Active</option>
													<option value="0">Closed</option>
													<option value="2">Halted</option>
											
                                                </select>
                                            </div>
                                        </div>
										
										 <div class="clearfix"></div>
										  
										
										<input type="hidden" name="hidaddedit" id="hidaddedit" value="add" />
										<input type="hidden" name="hideditid" id="hideditid" value="" />
										
										
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="tpaddingdiv1 text-center">
                                                <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return actionSaveTaskList()">Add</button>
												<button type="button" class="btn btn-red" name="btncancel" id="btncancel" onClick="return resetform()">Cancel</button>
												 
												 
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> Project Task List</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#employeeliststatus"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
							
							
							
							  <div id="manageadmin" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->
                                    <div class="totalaligndiv">
									
												<div class="col-md-6">
						<div class="input-group bmargindiv1 col-md-12">
							<span class="input-group-addon ndrftextwidth text-left">Search Project :</span>
							<input type="text" class="form-control" name="search_id" id="search_id" placeholder="Type here..." style="background:#FFFFFF;" oninput="highlightSearch()" onClick="searchProjectTaskList()" onkeyup="displayText(); InactiveButton(true);">
							<span class="input-group-btn">
								<input type="button" name="showall" id="showall" class="btn btn-default" value="Show All" onClick="showProjectTaskList(); InactiveButton(false);">
								
								<input type="button" name="inactiveall" id="inactiveall" class="btn btn-red" value="Inactive All" onClick="showProjectTaskList();" style="display:none; margin-left: 10px;">
							</span>
						</div>
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
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-2">
													<col class="col-md-5 col-sm-5">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-1 col-sm-1">
                                                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>Date&Time</th>
														<th>Group Name</th>
														<th>Task Name</th>
														<th>Task Time</th>
                                                    	<th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TASKLISTDISPLAYID" class="tablefont" >
												
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											<ul class="pagination pull-right margintopzerodiv">
												 <?php echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?>
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
        
<!--view_employee_details_div-->

        
<?php include 'include/footer.php' ?>
<script>
 function InactiveButton(show) {
        var inactiveButton = document.getElementById('inactiveall');
        if (show) {
            inactiveButton.style.display = 'inline-block';
        } else {
            inactiveButton.style.display = 'none';
        }
    }
	function displayText() {
       
    }

    function searchProjectTaskList() {
        
    }

    function highlightSearch() {
       
    }

    function showProjectTaskList() {
       
    }
function editClose()
{
	document.getElementById('loading_data').style.display="block";
	window.location.reload();
}

 
document.getElementById("search_id").addEventListener("keyup", function(event) {
   
    if (event.keyCode === 13) {
        event.preventDefault();
        searchProjectTaskList();
    }
});

function searchProjectTaskList() {
    
    console.log("Searching projects...");
    
}

function highlightSearch() {
    var searchText = document.getElementById('search_id').value;
    var rows = document.getElementById('TASKLISTDISPLAYID').getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].textContent || cells[j].innerText;
            var re = new RegExp(searchText, 'gi'); // 'gi' flag for global search and case-insensitive
            cellText = cellText.replace(re, function(match) {
                return '<span style="background-color: yellow;">' + match + '</span>';
            });
            cells[j].innerHTML = cellText;
        }
    }
}


 
function checkValidation()
{
	var val =  document.getElementById('grp_id').value;
	var val1 =  document.getElementById('pro_id').value;
	var val2 =  document.getElementById('pro_taskname').value;
	var val3 =  document.getElementById('task_time').value;
	
	
	if(val == 0) {
		alert("Please select Group...");
		return false;
	}
	
	if(val1 == 0) {
		alert("Please select Project...");
		return false;
	}
	
	if(val2.length == 0) {
		alert("Please add task name...");
		return false;
	}
	
	if(val3 == "0") {
		alert("Please select task time...");
		return false;
	}
	
			
	return true;
}









function actionSaveTaskList(){

	var ret = checkValidation();
	if(!ret)
		return false;
	
	var action_type = document.getElementById("hidaddedit").value;
	
	if(action_type == "add")
	{
		var dataString = "action=addprojecttask&";
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
					resetSelection();
					loadProjectTaskList();
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
	}else if(action_type == "edit")
	{
		
		//document.getElementById('loading_data').style.display="block";
		var dataString = "action=updateprojecttask&";
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
					resetSelection();
					loadProjectTaskList();
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
		
	}
	
}

function showProjectTaskList() {
	
        var pro_id = document.getElementById('pro_id').value;
        var grp_id = document.getElementById('grp_id').value;
        var search_val = document.getElementById('search_id').value;
        var showall = document.getElementById('showall').value;

       
        var dataString = "action=loadshowProjecttask&pro_id=" + pro_id + "&grp_id=" + grp_id + "&search=" + search_val + "&show=" + showall;
        //alert("dataString:" + dataString);

        $.ajax({
            type: "POST",
            url: "ajaxprojectemployee.php",
            data: dataString,
            cache: false,
            success: function(html) {
                var dobj = jQuery.parseJSON(html);
                if (dobj.status == 1) {
                    //alert(dobj.msg);
                    //alert(dobj.data);
                    $("#TASKLISTDISPLAYID").html(dobj.data);
                }
                //document.getElementById('loading_data').style.display="none";
            }
        });
    }



function searchProjectTaskList(){
	var pro_id =  document.getElementById('pro_id').value;
	var grp_id =  document.getElementById('grp_id').value;
	var search_val =  document.getElementById('search_id').value;
	if(search_val == "")
	{
		//alert("Please add text in searchbox");
		return;
	}
	var dataString = "action=loadsearchprojecttask&pro_id="+pro_id+"&grp_id="+grp_id+"&search="+search_val;
	//alert("dataString:"+dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				//alert(dobj.msg);
				//alert(dobj.data);
				$("#TASKLISTDISPLAYID").html(dobj.data);
				 highlightSearch();
				 
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
}



  

function loadProjectTaskList(){
	var pro_id =  document.getElementById('pro_id').value;
	var grp_id =  document.getElementById('grp_id').value;
	
	var dataString = "action=loadprojecttask_a&pro_id="+pro_id+"&grp_id="+grp_id;
	//alert("dataString:"+dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				//alert(dobj.msg);
				//alert(dobj.data);
				$("#TASKLISTDISPLAYID").html(dobj.data);
				
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
}


function loadProjectList(){
	$("#TASKLISTDISPLAYID").html("");
	var cus_id =  document.getElementById('pro_cus').value;
	
	var dataString = "action=loadproject3&cus_id="+cus_id;
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



function showdEdit(taskid,name,time,status,grp_id){
	
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
	
	for(i=0;i<document.getElementById("grp_id").length;i++){
		if(document.getElementById("grp_id").options[i].value==grp_id){
			document.getElementById("grp_id").options[i].selected=true;
			break;
		}
	}
		
	document.getElementById("pro_taskname").value = name;
	
	return false;
}

</script>
