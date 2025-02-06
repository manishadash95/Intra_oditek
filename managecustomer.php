<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	$newAdmintobj = $dbobj;	
	$editAdmintobj = $dbobj;
	
	
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> Manage Customer</h4>
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
                                                <span class="input-group-addon ndrftextwidth text-left">Customer Name :</span>
                                                 <input type="text" class="form-control" name="cus_name" id="cus_name" placeholder="Customer Name" value="" style="background:#FFFFFF;"onChange="loadCustomerGroup()"  >
                                            </div>
                                                                                       
                                                                                     
                                            
                                        </div>
										
										<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Customer Code :</span>
                                                 <input type="text" class="form-control" name="cus_code" id="cus_code" placeholder="Customer Code" value="" style="background:#FFFFFF;" onChange="loadCustomerGroup()" >
                                            </div>
                                                                                       
                                                                                     
                                            
                                        </div>
										
                                    	<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Contact Name :</span>
                                                 <input type="text" class="form-control" name="cus_per" id="cus_per" placeholder="Contact Name" value="" style="background:#FFFFFF;" onChange="loadCustomerGroup()" >
                                            </div>
                                                                                       
                                                                                     
                                            
                                        </div>
										
										
										<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Contact No :</span>
                                                 <input type="text" class="form-control" name="cus_no" id="cus_no" placeholder="Contact No" value="" style="background:#FFFFFF;"onChange="loadCustomerGroup()"  >
                                            </div>
                                                                                       
                                                                                     
                                            
                                        </div>
										
										
										
										 <div class="clearfix"></div>
										  
										
										<input type="hidden" name="hidaddedit" id="hidaddedit" value="add" />
										<input type="hidden" name="hideditid" id="hideditid" value="" />
										
										
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="tpaddingdiv1 text-center">
                                                <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="manageProject()">Save</button>
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> Customer List</h4>
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
														<th>Customer<BR>code</th>
														<th>Name</th>
														<th>Contact<BR>Name</th>
                                                    	<th>Customer<BR>No</th>
                                                        <th>Edit</th>
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
  loadCustomerGroup();
};

function loadCustomerGroup() {
    var cus_name = document.getElementById('cus_name').value;
    var cus_code = document.getElementById('cus_code').value;
    var cus_per = document.getElementById('cus_per').value;
    var cus_no = document.getElementById('cus_no').value;
	 
    var dataString = "action=loadCustomerGroup&cus_name=" + cus_name + "&cus_code=" + cus_code + "&cus_per=" + cus_per + "&cus_no=" + cus_no;
  
    //alert(dataString);
    $.ajax({
        type: "POST",
        url: "ajaxprojectemployee.php",
        data: dataString,
        cache: false,
        success: function(html) {
            var dobj = jQuery.parseJSON(html);
            if (dobj.status == 1) {
                $("#PROLISTDISPLAYID").html(dobj.data);
            }
        }
    });
}


function manageProject() {
	
	var hidaddedit = document.getElementById("hidaddedit").value;
	var hideditid = document.getElementById("hideditid").value;
	if(hideditid > 0)
	{
		var dataString = "action=updateProjectCustomer&";
		dataString +=$( "#myformdata" ).serialize();
		//alert("loadCustomerGroup:"+dataString);
		
		$.ajax({ 
				type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
				success: function(html)
				{	 
					var dobj=jQuery.parseJSON(html);
					alert(dobj.msg);
					if(dobj.status==1)
					{
					loadCustomerGroup();
                
                document.getElementById('cus_name').value = "";
                document.getElementById('cus_code').value = "";
                document.getElementById('cus_per').value = "";
                document.getElementById('cus_no').value = "";
					}else{
						
					}
					//document.getElementById('loading_data').style.display="none";
				} 
			});
	
	}else{
	
	
	
    var cus_name = document.getElementById('cus_name').value;
    var cus_code = document.getElementById('cus_code').value;
    var cus_per = document.getElementById('cus_per').value;
    var cus_no = document.getElementById('cus_no').value;
	if(cus_name == 0) {
		alert("Please add customer name...");
		return false;
	}
	
	if(cus_code == 0) {
		alert("Please add customer code...");
		return false;
	}
	
	if(cus_per == 0) {
		alert("Please add contact name...");
		return false;
	}
	
	if(cus_no == 0) {
		alert("Please add contact no...");
		return false;
	}
	
	
    var datastring = "action=manageProject&cus_name=" + cus_name + "&cus_code=" + cus_code + "&cus_per=" + cus_per + "&cus_no=" + cus_no;
    alert(datastring); 
    $.ajax({
        type: "POST",
        url: "ajaxprojectemployee.php",
        data: datastring,
        cache: false,
        success: function(html) {
            var obj = jQuery.parseJSON(html);
            alert(obj.msg);
            if (obj.status == 1) {
                loadCustomerGroup();
                
                document.getElementById('cus_name').value = "";
                document.getElementById('cus_code').value = "";
                document.getElementById('cus_per').value = "";
                document.getElementById('cus_no').value = "";
            } else {
                
            }
        }
    });
	}
}


function resetform() {
    // Resetting form values
    document.getElementById("cus_name").value = "";
    document.getElementById("cus_code").value = "";
    document.getElementById("cus_per").value = "";
    document.getElementById("cus_no").value = "";

    // Returning false to prevent form submission
    return false;
}



function showdEdit(cus_id, cus_name, cus_per, cus_no, cus_code) {
   // alert("::" + cus_name); 

    document.getElementById("hidaddedit").value = "edit";
    document.getElementById("hideditid").value = cus_id;
   
    // Set the selected values for cus_per, cus_no, and cus_code
    document.getElementById("cus_per").value = cus_per;
    document.getElementById("cus_no").value = cus_no;
    document.getElementById("cus_code").value = cus_code;

    // Set the value for cus_name
    document.getElementById("cus_name").value = cus_name;

    return false; // Prevent default form submission
}

</script>
