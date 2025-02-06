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
	$obj_emp = $dbobj->getEmployeeAccess($emp_id);
	
	
	
?>
<?php include 'include/header.php' ?>

<?php include 'include/leftsidebar.php' ?>
<?php include 'imageupload/popimageupload.php' ?>
        <!-- begin MAIN PAGE CONTENT -->
        <div id="page-wrapper">

            <div class="page-content">

                <!-- begin PAGE TITLE AREA -->
                <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                <div class="row">
                	
                    <div class="col-lg-12">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                
								<li class="active">IT Admin</li>
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
                                    <h4> Active IT Request</h4>
                                </div>
                              
				
                                <div class="clearfix"></div>
                            </div>
							
				
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                               <div class="totalaligndiv" id="SHOWADMINLIST">
																		
									
					
								<div class="portlet-body">
									
										                                    
                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-3 col-sm-3">
                                                    <col class="col-md-3 col-sm-3">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
                                                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Created Date</th>
														<th>Service Id</th>
														<th>Created by</th>
                                                        <th>Title</th>
														<th>Priority</th>
														<th>Status</th>
														<th>View</th>
						                            </tr>
                                                </thead>
                                                <tbody id="DATAFIELD" class="tablefont">
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
									
								<a href="itadmin_closeadminitrequest.php" >
								<input type="button" class="btn btn-md btn-silver " value="Closed Request" style="height:30px; width:120px; padding:2px 3px; font-size:14px;margin-bottom:5px;">
								</a>
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
   
<div class="modal fade" id="viewemployeelistdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
  <form name="editfrmmess" id="editfrmmess" method="post">
    <div class="modal-content">
      
	  
	  <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title " id="myModalLabel">New IT Request</h4>
      </div>
      
	  <div class="modal-body">
	  
	 
	   
	   
        <div class="totalaligndiv">
			
		<div class="col-md-12">											
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right">Title :</span>
		<input type="text" name="title" id="title" class="form-control" placeholder="subject" >
		</div>
		</div>
		
		<div class="col-md-12">
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right">Description :</span>
		<textarea id="text1" <?php echo $read;?> class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
		</div>
		</div>										
											
		<div class="col-md-12">
		<input type="file" id="file-upload" multiple required />
		<label for="file-upload" style="cursor:pointer;" >
		<img src="img/attach.png" width="20" height="20" alt="" style="cursor:pointer;" />Attach file
		</label>
		Maximum 3 files]<BR>
		<div>
		<img   class="file-remove" id="remove1" src="img/remove.png" width="20" height="20"  onClick="removeFile('1')"/>
		<div class="file-upload" id="file1"></div>
		</div>
		<div>		
		<img   class="file-remove" id="remove2" src="img/remove.png" width="20" height="20"  onClick="removeFile('2')"/>
		<div class="file-upload" id="file2"> </div>
		</div>
		<div>
		<img   class="file-remove"  id="remove3" src="img/remove.png" width="20" height="20"  onClick="removeFile('3')"/>
		<div class="file-upload" id="file3"> </div>
		</div>
		<input type="hidden" name="hfilecnt" id="hfilecnt" value="">
		<input type="hidden" name="hfile1" id="hfile1" value="">
		<input type="hidden" name="hfile2" id="hfile2" value="">
		<input type="hidden" name="hfile3" id="hfile3" value="">
		<input type="hidden" name="hsid" id="hsid" value="<?php echo $sid;?>">
		</div>		
		
     			
      </div>
	  <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndAddData();" id="btnsubmit">Create</button> 
		<button type="button" class="btn btn-default btn-gray" data-dismiss="modal" onclick="resetSelection();" ><i class="fa fa-times"></i>CLOSE</button>
      </div>
	</div>
    </div>
	<input type="hidden" class="form-control"  id="messageid" name="messageid" value="">
	</form>
  </div>
</div>   
	
	
	
    <!--end_view_employee_div-->
    <script type="text/javascript"> 
	


	
	
	window.onload = function() {
		loadOpenAdminITRequest();
	};

	
	
	function loadOpenAdminITRequest()
	{
		
		var dataString = "action=loadOpenAdminITSupportTask";
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#DATAFIELD").html(dobj.data);
					
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
			} 
		});
		
	}	
	
	
		
	function updatepage()
	{
		if(reload)
			window.location.reload();
	}
	
	
			
	
	
	
	 </script>
<?php include 'include/footer.php' ?>
