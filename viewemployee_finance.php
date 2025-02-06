<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$page = (int) $_GET['page'];
	if ($page < 1) $page = 1;
		$recordsperpage=100;
	$noofpagelinks=10;
	$startResults = ($page - 1) * $recordsperpage;
	$totalRecords=mysql_num_rows(mysql_query("select * from ".PREFIX1."employee where status='Present' order by id desc"));
	
    $rankemployee =$dbobj->getEmployee(0 , 0, "1", $startResults, $recordsperpage);
    
	$rank_array=$dbobj->getDesignation();
	$dept_array=$dbobj->getDepartment();
	$iv_key = $dbobj->get_mcrypt_iv();
	$BU_array = $dbobj-> getAllBUHead();
	$dep = $dbobj->getDepartmentList();
	

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
                                <li class="active">View Employee</li>
                            </ol>

                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE AREA -->
               
			   <!--main_heading_div-->
                <!--row_div-->
                <div class="row">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4> View Employee</h4>
                                </div>                         
                               
                                
                                
                                
                                <div class="clearfix"></div>
                            </div>
                            
                           
						   
						  
						   
                                        
                                        
                            <div id="viewemployeedetails" class="panel-collapse collapse in">
                            	<div class="portlet-body" id="showEmployee">
                                	<!--total_left_side_div-->
									 
									 
                                    <div class="totalaligndiv">
                            <div class="bpaddingdiv1 bordertopgraydiv">
                          <div class="text-right"><?php echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?></div>
                         <div class="clearfix"></div>
                        </div>

									   <div class="row">
						 <div class="col-md-4">
							<div class="input-group bmargindiv1">
								<span class="input-group-addon ndrftextwidth text-center">BU Head :</span>
								<select id="bu_id" name="bu_id" class="form-control" onchange="loadDepartment();">
									<option value="0">Select All</option>
									<?php
									foreach($BU_array as $val) {
										echo '<option value="'.$val->id.'">'.$val->bu_name.'</option>';
									}
									?>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="input-group bmargindiv1">
								<span class="input-group-addon ndrftextwidth text-center">Designation :</span>
								<select id="deg_id" name="deg_id" class="form-control" onchange="loadDepartment();">
									<option value="0">Select All</option>
									<?php
									foreach ($rank_array as $val) {
										echo '<option value="' . $val->id . '">' . $val->name . '</option>';
									}
									?>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="input-group bmargindiv1">
								<span class="input-group-addon ndrftextwidth text-center">DEPARTMENT :</span>
								<select id="dep_id" name="dep_id" class="form-control" onchange="loadDepartment();">
									<option value="0">Select All</option>
									<?php
									foreach ($dept_array as $val) {
										echo '<option value="' . $val->id . '">' . $val->name . '</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>

                    <div class="profilemodal modal fade modal-sm" id="employeeImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<button type="button" class="btn btn-default modal-close" data-dismiss="modal">x</button>
								<div class="modal-body">
									<div class="modal-img">
										<img id="modalEmployeeImage" src="" alt="Employee Image">
									</div>
									<div class="empname">
										<h3 id="employeeName"></h3>
									</div>
									<!--<div class="content">
										
										 <button type="button" class="btn btn-continue" data-dismiss="modal">OK</button> <br><br> 
									</div>-->
								</div>
							</div>
						</div>
					</div>
					
					<!--<div class="modal fade" id="employeeImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                      <div class="modal-dialog modal-lg">
                      <div class="modal-content" style="border: none;">
                      <div class="modal-body text-center" id="modalBody">
                      <img id="modalEmployeeImage" src="" alt="Employee Image" style="max-width: 40%; max-height: 40%; object-fit: contain; border-radius: 5px; border: none;">
                      <p id="employeeName" style="margin-top: 10px; font-weight: bold;"></p>
                     </div>
                     <div class="modal-footer justify-content-center">
                    <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>-->


								<div class="clearfix"></div>
								<div class="tpaddingdiv1">
								<div class="bs-docs-example table-responsive">
								<table class="table table-bordered table-striped" align="center">
								<colgroup>
									<!-- Define column widths if necessary -->
									<col class="col-md-1 col-sm-1">
									<col class="col-md-1 col-sm-1">
									<col class="col-md-2 col-sm-2">
									<col class="col-md-2 col-sm-2">
									<col class="col-md-2 col-sm-2">
									<col class="col-md-2 col-sm-2">
									<col class="col-md-2 col-sm-2">
									<col class="col-md-3 col-sm-3">
									<col class="col-md-1 col-sm-1">
								</colgroup>
								<thead>
									<tr>
										<th class="center_td">SL</th>
										<th class="center_td">Image</th>
										<th class="center_td">Name</th>
										<th class="center_td">Designation</th>
										<th class="center_td">BU</th>
										<th class="center_td">Department</th>
										<th class="center_td">Mobile</th>
										<th class="center_td">Email</th>
										<th class="center_td">Action</th>
									</tr>
								</thead>
								<tbody id="TASKLISTDISPLAYID" class="tablefont">
									<!-- Your table data will go here -->
								</tbody>
								</table>
											

											<div class="bpaddingdiv1 bordertopgraydiv">
										 <div class="text-center"><?php echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?></div>
										 <div class="clearfix"></div>
                                     </div>
											
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
                
            </div>
            <!-- /.page-content -->

        </div>
		
    <!--view_employee_div-->
    
    <!--end_view_employee_div-->

<input type="hidden"  name="hidpage" id="hidpage" value="1">
	 
<?php include 'include/footer.php' ?>

<script>

window.onload = function() {
	
	loadDepartment();
		
};
function showEmployeeImage(imageSrc, employeeName) {
    // Set the source of the modal image to the clicked image source
    document.getElementById('modalEmployeeImage').src = imageSrc;
    // Display the employee name in the modal
    document.getElementById('employeeName').textContent = employeeName;
    // Show the modal
    $('#employeeImageModal').modal('show');
}



  function loadDepartment() {
    var dep_id = document.getElementById('dep_id').value;
    var bu_id = document.getElementById('bu_id').value;
	var deg_id = document.getElementById('deg_id').value;
    var dataString = "action=loadDepartment_fin&dep_id=" + dep_id + "&bu_id=" + bu_id + "&deg_id="+deg_id; // Add &bu_id=

  //alert("dataString:" + dataString);

    $.ajax({
        type: "POST",
        url: "ajaxprojectemployee.php",
        data: dataString,
        cache: false,
        success: function(html) {
            var dobj = jQuery.parseJSON(html);
            if (dobj.status == 1) {
                $("#TASKLISTDISPLAYID").html(dobj.data);
                //loadDepartment();
            }
        }
    });
}



   

function ajaxpagination(page)
{
	document.getElementById("hidpage").value=page;
	dv = document.getElementById('showEmployee');
	//alert("::"+page);
	var status=$("#status").val();
	var rank=$("#rank_id").val();
	var coy=$("#coy_id").val();
	$("#showEmployee").load("ajaxforce.php?status="+status+"&rkid="+rank+"&coy="+coy+"&page="+page);
}

function showDept(par)      
{
	var rank=$("#rank_id").val();
	dv = document.getElementById('showEmployee');
	$("#showEmployee").load("ajaxforce.php?status="+status+"&rkid="+rank+"&deptid="+par);
}
	
	
</script>

