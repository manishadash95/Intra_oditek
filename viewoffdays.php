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
	
			
		
	$year = date("Y");
	
		
	
	
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
                                <li><i class="fa fa-laptop"></i>  <a href="index.php">View Offdays List</a></li>
                               
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
                  	
					
					            <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> All Offdays List</h4>
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
													<col class="col-md-2 col-sm-2">
													<col class="col-md-6 col-sm-6">
                                                 	
										        </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>Year</th>
														<th>Date</th>
														<th>Day</th>
														<th>Category</th>
														<th>Holiday Name</th>
									                    
                                                    </tr>
                                                </thead>
                                                <tbody id="TASKLISTDISPLAYID" class="tablefont" >
												
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											<ul class="pagination pull-right margintopzerodiv">
												<input type="hidden" name="hyear" id="hyear" value="<?php echo $year;?>">
											</ul>  
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    </div>
                                    <!--end_total_left_side_div-->
                                </div>
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
		loadHolidayList();
	};


	

	function loadHolidayList()
	{
		var year_id =  document.getElementById('hyear').value;
		
		var dataString = "action=loadalloffdays&year_id="+year_id;
		//alert(dataString);	
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				//alert(dobj.status);
				if(dobj.status==1)
				{
					$("#TASKLISTDISPLAYID").html(dobj.data);
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
	
	}

	
	
	 </script>
<?php include 'include/footer.php' ?>
