<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	ini_set("display_errors",0);
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
                               <li class="active">Resignation Request</li>
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
               <form name="formdata" id="formdata" method="post" enctype="multipart/form-data"  >
                <div class="row" id="load_subadmin">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> View Resignation Request</h4>
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
									<div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                               <span style="color: red;">*</span><span class="input-group-addon ndrftextwidth text-left">Date of Resignation :</span>
												<input type="text" name="start_date" id="start_date" class="form-control tcal" placeholder="Start Date">
                                            </div>
                                            
                                        </div>
										
										
										<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Notice Period Last  Date :</span>
												<input type="text" readonly name="last_date" id="last_date" class="form-control tcal" placeholder="End Date">
                                            </div>
                                        </div>
										
										<Div class="col-md-6">
										 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Request For Relieving Date :</span>
												<input type="date" name="date_of_birth" id="date_of_birth" class="form-control tcal" placeholder="Date of Birth">
											</div>
                                    	    
                                        </div>
                                        
										
										
										<Div class="col-md-6">
										 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Approved Last Working  Date :</span>
												<input type="date" name="date_of_birth" id="date_of_birth" class="form-control tcal" placeholder="Date of Birth">
											</div>
                                    	    
                                        </div>
                                        
										<div class="col-md-6">
								<div class="input-group bmargindiv1 col-md-12">
									<span class="input-group-addon ndrftextwidth text-right">Reason For Leaving :</span>
									<select id="leaving" name="leaving" class="form-control">
										<option value="0">Select Reason</option>
										<option value="Resigned for personal reasons.">Resigned for personal reasons.</option>
										<option value="Found a better opportunity.">Found a better opportunity.</option>
										<option value="Relocated to a different city/state/country.">Relocated to a different city/state/country.</option>
										<option value="End of contract/assignment.">End of contract/assignment.</option>
									</select>
								</div>
							</div>

										
									<div class="col-md-12" >
									<div class="input-group bmargindiv1 col-md-12">
									<span  class="input-group-addon ndrftextwidth text-right">Comments :</span>
									<textarea id="text1" class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
									</div>
									</div>		
									
										 <div class="clearfix"></div>
										  
                                        <div class="clearfix"></div>
                                      
                                        <div class="clearfix"></div>
                                    </div>
							<div class="modal-footer">
							 <span style="font-size:14px; float:left" id="istatus">
							  </span>
							<button type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndAddData();" id="btnsubmit">Cancel</button> 
							<button type="button" class="btn btn-primary">Next</button>
						  </div>
														
                                </div>
                            </div>                            
                        </div>
                    <!--end_left_div-->
                  </div>
                  <div class="clearfix"></div>
                </div> <!-- end_row_div -->
				
                </form>
                
                <!--row_div-->
                

            </div>
            <!-- /.page-content -->

        </div>
        


        
<?php include 'include/footer.php' ?>

