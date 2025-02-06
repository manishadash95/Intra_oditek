<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	


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
                                <li class="active">View Update Logs</li>
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
                                    <h4> View Employee Record Logs</h4>
                                </div>                         
                               
                                
                                
                                
                                <div class="clearfix"></div>
                            </div>
                            
                           
                                        
                                        
                            <div id="viewemployeedetails" class="panel-collapse collapse in">
                            	<div class="portlet-body" id="showEmployee">
                                	<!--total_left_side_div-->
									 
									 
                                    <div class="totalaligndiv">
									  
                                    
                                        <div class="clearfix"></div>
										<div class="tpaddingdiv1">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped" align="center">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
										        </colgroup>
                                                <thead>
                                                	
                                                    <tr>
                                                        <th class="center_td">SL</th>
                                                        <th class="center_td">Date</th>
                                                        <th class="center_td">Emp. Id</th>
                                                        <th class="center_td">Emp. Name</th>
														<th class="center_td">Logs</th>
                                                        <th class="center_td">Mod. By</th>
							                        </tr>
                                                </thead>
                                                 <tbody id="DATAFIELD" class="tablefont">
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
                
            </div>
            <!-- /.page-content -->

        </div>
		
    <!--view_employee_div-->
    


	 
<?php include 'include/footer.php' ?>

<script>

window.onload = function() {
	
			loadUpdateLogs();
			
		
	};
function loadUpdateLogs()
{
	var dataString = "act=getEmpRecordUpdateLogs";
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#DATAFIELD").html(dobj.data);
			}
			else{
				alert(dobj.msg);		
			}
		} 
		});
	
	
}
	
	
</script>

