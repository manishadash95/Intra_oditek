<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	$empList = $dbobj->getAllActiveEmployeeListName();
	
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
                                <li class="active">Create Project Group</li>
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> Add Project Group</h4>
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
                                                <span class="input-group-addon ndrftextwidth text-left">Group Name :</span>
												<input type="text" class="form-control" name="grp_name" id="grp_name" placeholder="Group Name" value="" style="background:#FFFFFF;"onChange="loadProjectGroup()" >
                                            </div>
                                        </div>
                                    <Div class="col-md-6">	
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Prm-Name :</span>
									<select id="reso_id" name="reso_id" class="form-control chosen-select"onChange="loadProjectGroup()">
									<option value="0" >All Select</option>
									<?php foreach($empList as $emp){ 
									$select="";
									
									?>
									<option value="<?php echo $emp->eid; ?>" <?php echo $select;?> > <?php echo $emp->name; ?></option>
									<?php } ?>
									</select>
									</div>
								</div>
                                   <div class="clearfix"></div>
										  
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="tpaddingdiv1 text-center">
                                                <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="saveProjectGroup()">Add</button>
										        </div>
											      </div>
                                        <div class="clearfix"></div>
										<input type="hidden" name="hid" id="hid" value="<?php echo $id;?>">
       
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> Project Group List</h4>
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
									              </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>Date&Time</th>
														<th>Group<BR>Name</th>
														<th>PRM<BR>Name</th>
														<th>Member</th>
		                                              	<th>Edit</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="PROLISTDISPLAYID" class="tablefont" >
												
                                                </tbody>
                                            </table>
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
  loadProjectGroup();
};

function loadProjectGroup() {
    var grp_name = document.getElementById('grp_name').value;
    var reso_id = document.getElementById('reso_id').value;
	
	 
    var dataString = "action=loadProjectGroup&grp_name=" + grp_name + "&reso_id=" + reso_id;
    alert(dataString);
    $.ajax({
        type: "POST",
        url: "ajaxprojectemployee.php",
        data: dataString,
        cache: false,
        success: function(html) {
            var dobj = jQuery.parseJSON(html);
           // alert(dobj.msg);
            if (dobj.status == 1) {
                $("#PROLISTDISPLAYID").html(dobj.data);
            }
        }
    });
}

function saveProjectGroup() {
    var grp_name = document.getElementById('grp_name').value;
    var reso_id = document.getElementById('reso_id').value;

    // Perform validation
   if (grp_name.trim() === '') {
        alert('Please select a group name.');
        return; // Stop further execution
    }
   if (reso_id === '0') { 
        alert('Please select a prm name.');
        return; // Stop further execution
    }
    var dataString = "action=saveProjectGroup&grp_name=" + grp_name + "&reso_id=" + reso_id;

    $.ajax({ 
        type: "POST",
        url: "ajaxprojectemployee.php",
        data: dataString,
        cache: false,
        success: function(html) {    
            var dobj = jQuery.parseJSON(html);
            alert(dobj.msg);
            if (dobj.status == 1) {
                 loadProjectGroup();
                resetloadform();
            } else {
                // Handle failure case
            }
        } 
    });
}


function actionDelete(id) {
    if (confirm("Are you sure want to delete?")) {
        var dataString = "action=actionDelete&id=" + id;
        $.ajax({
            type: "POST",
            url: "ajaxprojectemployee.php",
            data: dataString,
            cache: false,
            success: function (html) {
                var dobj = jQuery.parseJSON(html);
                if (dobj.status == 1) {
                    alert(dobj.msg);
                    location.reload();
                } else {
                    alert("Error during deletion: " + dobj.msg);
                    console.log(dobj); // Log the response for debugging
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + error);
                location.reload();
            }
        });
    }
}

</script>

