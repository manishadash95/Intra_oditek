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
	$groupobj = $dbobj->getProjectGrpRankWise();
	//$custArray = $dbobj->getCustomerGrp();
	
	//$projectlist= $dbobj->getProjectList();
	//$resourcelist= $dbobj->getResourceList();
	//$taskTimeArray= $dbobj->getProjectTaskTime();
	
		
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
                                <li class="active">Project Task Report</li>
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> Project Task Report</h4>
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
															echo '<option value="'.$val->cus_id.'">['.$val->cus_code.'] :'.$val->cus_name.'</option>';
													}			
														?>	
												 </select>		
                                            </div>
                                                                                       
                                                                                     
                                            
                                    </div>
									
									
									<Div class="col-md-6">
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
										
									
										
										
										
										
										
										
                                    	
										
										
										
										 <div class="clearfix"></div>
										  
										
										<input type="hidden" name="hidaddedit" id="hidaddedit" value="add" />
										<input type="hidden" name="hideditid" id="hideditid" value="" />
										
										
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="tpaddingdiv1 text-center">
                                                <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return pintTaskReport()">Print Report</button>
												
												 
												 
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
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-!">
													<col class="col-md-4 col-sm-4">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
                                                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>Group Name</th>
														<th>Task Name</th>
														<th>Task Time</th>
														<th>Actual Time</th>
														<th>Work %</th>
														<th>Status</th>
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
function editClose()
{
	document.getElementById('loading_data').style.display="block";
	window.location.reload();
}


function checkValidation()
{
	var pro_id =  document.getElementById('pro_id').value;
	
	
	if(pro_id == 0) {
		alert("Please select Project...");
		return false;
	}
	
		
			
	return true;
}


function loadProjectTaskList(){
	var pro_id =  document.getElementById('pro_id').value;
	var grp_id =  document.getElementById('grp_id').value;
	var dataString = "action=loadprojecttasktime&pro_id="+pro_id+"&grp_id="+grp_id;
	//alert("dataString:"+dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#TASKLISTDISPLAYID").html(dobj.data);
				
			}
			else{
				alert(dobj.msg);
				location.reload();
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
}


function pintTaskReport(){

	var ret = checkValidation();
	if(!ret)
		return false;
	
	
	var pro_id =  document.getElementById('pro_id').value;
	var grp_id =  document.getElementById('grp_id').value;
	
	var dataString = "action=generateprotaskreport&pro_id="+pro_id+"&grp_id="+grp_id;
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
				location.reload();
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
	
}

function loadProjectList(){
	var cus_id =  document.getElementById('cus_id').value;
	var dataString = "action=loadcusproject2&cus_id="+cus_id;
	//alert("dataString:"+dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#pro_id").html(dobj.data);
				loadProjectTaskList();
			}
			else{
				alert(dobj.msg);
				location.reload();
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
}




</script>
