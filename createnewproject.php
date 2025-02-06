<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	$newAdmintobj = $dbobj;	
	$editAdmintobj = $dbobj;
	
	$groupobj = $dbobj->getProjectGrp();
	$custArray = $dbobj->getCustomerGrp();
	
	$checkAccess = $dbobj->checkEmployeeAccess("createnewproject");
	if(!$checkAccess)
	{
		echo "Sorry, You have no access to this page...";
		exit();
		
	}
	


	//$subAdminObj = $dbobj->getProjectList();
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
                                <li class="active">Create New Project</li>
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
               <form name="myformdata" id="myformdata" method="post">
                <div class="row" id="load_subadmin">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> Add Project</h4>
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
									
									<Div class="col-md-12">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Project Name :</span>
                                                 <input type="text" class="form-control" name="pro_name" id="pro_name" placeholder="Project Name" value="" style="background:#FFFFFF;" >
                                            </div>
                                                                                       
                                                                                     
                                            
                                        </div>
										
										
										<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Customer Name :</span>
                                                <select class="form-control" id="pro_cus" name="pro_cus" onChange="loadProjectList()">
                                                    <option value="0">Select Customer</option>
														<?php
															foreach($custArray as $val)
															{
																$str = $val->cus_name." [ ".$val->cus_code." ] ";
																
																echo '<option value="'.$val->cus_id.'">'.$str.'</option>';
															}			
														?>	
                                                </select>
                                            </div>
                                                                                       
                                                                                     
                                            
                                        </div>
										
                                    	
                                        <Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Project Status :</span>
                                                <select class="form-control" id="pro_status" name="pro_status">
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
                                                <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="saveProject()">Save</button>
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> Project List</h4>
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
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-4 col-sm-4">
													<col class="col-md-3 col-sm-3">
													<col class="col-md-2 col-sm-2">
                                                 	<col class="col-md-2 col-sm-2">
									                <col class="col-md-1 col-sm-1">
                                                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>Date&Time</th>
														<th>Id</th>
														<th>Name</th>
														<th>Customer<BR>code</th>
														<th>Estimation</th>
                                                    	<th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="PROLISTDISPLAYID" class="tablefont" >
												
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

<!--end_view_employee_details_div-->
        
<?php include 'include/footer.php' ?>
<script>

window.onload = function() {
  loadProjectList();
};


function editClose()
{
	document.getElementById('loading_data').style.display="block";
	window.location.reload();
}

function loadProjectList()
{
	var pro_cus =  document.getElementById('pro_cus').value;
	var dataString = "action=loadprojectlist&pro_cus="+pro_cus;
	//alert("loadProjectList:"+dataString);
	
	$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				//alert(dobj.msg);
				if(dobj.status==1)
				{
					$("#PROLISTDISPLAYID").html(dobj.data);
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
	
}

function checkValidation()
{
	var val1 =  document.getElementById('pro_name').value;
	var val3 =  document.getElementById('pro_cus').value;
	
	if(val3 == 0) {
		alert("Please select Customer Name...");
		return false;
	}
		
	if(val1.length == 0) {
		alert("Please add Project Name");
		return false;
	}		
		
	return true;
}

function saveProject()
{
	var hidaddedit = document.getElementById("hidaddedit").value;
	var hideditid = document.getElementById("hideditid").value;
	if(hideditid > 0)
	{
		var dataString = "action=updateProject&";
		dataString +=$( "#myformdata" ).serialize();
		//alert("loadProjectList:"+dataString);
		
		$.ajax({ 
				type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
				success: function(html)
				{	 
					var dobj=jQuery.parseJSON(html);
					alert(dobj.msg);
					if(dobj.status==1)
					{
						loadProjectList();
						resetloadform();
					}else{
						
					}
					//document.getElementById('loading_data').style.display="none";
				} 
			});
	
	}else{
	
		var dataString = "action=addnewProject&";
		dataString +=$( "#myformdata" ).serialize();
		//alert("loadProjectList:"+dataString);
		
		$.ajax({ 
				type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
				success: function(html)
				{	 
					var dobj=jQuery.parseJSON(html);
					alert(dobj.msg);
					if(dobj.status==1)
					{
						loadProjectList();
						resetloadform();
					}
					else{
						
					}
					//document.getElementById('loading_data').style.display="none";
				} 
			});
		
	}	
	
}


function resetloadform(){
	
	document.getElementById("hidaddedit").value="add";
	document.getElementById("hideditid").value="0";
	document.getElementById("pro_status").options[0].selected=true;
	document.getElementById("pro_name").value = "";

}


function resetform(){
	
	document.getElementById("hidaddedit").value="add";
	document.getElementById("hideditid").value="0";
	document.getElementById("pro_status").options[0].selected=true;
	document.getElementById("pro_cus").options[0].selected=true;
	document.getElementById("pro_name").value = "";
	loadProjectList();

}



function showdaedit(pid,pname,pstatus,cus_id){
	
	document.getElementById("hidaddedit").value="edit";
	document.getElementById("hideditid").value=pid;
	
		for(i=0;i<document.getElementById("pro_status").length;i++){
		if(document.getElementById("pro_status").options[i].value==pstatus){
			document.getElementById("pro_status").options[i].selected=true;
			break;
		}
	}
	
	for(i=0;i<document.getElementById("pro_cus").length;i++){
		if(document.getElementById("pro_cus").options[i].value==cus_id){
			document.getElementById("pro_cus").options[i].selected=true;
			break;
		}
	}
	
	document.getElementById("pro_name").value = pname;
	
	return false;
}

</script>
