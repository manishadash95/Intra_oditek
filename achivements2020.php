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
                                <li><i class="fa fa-laptop"></i>  <a href="index.php">Achivements of Year 2020</a></li>
                               
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> Star Performer </h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#StarPerformer"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="StarPerformer" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv1">
                                            <div class="bs-docs-example table-responsive">
											
											<div class="clearfix"></div>
													<div class="achivementheading" align="center">
													<span >Star Performer of 2020</span>
													</div>
											
                                            <table class="table table-bordered table-striped">
                                               
                                                <thead class="tablefont">
                                                    
													<tr>
													<?php
													//Debashree emp id: 131202
													$empData = $dbobj->getEmployeeData(131202);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Star Performer” award is given to <B><?php echo $empData->name; ?></B> in recognition of being the top-most performer in OdiTek during the year 2020. She demonstrated key organizational values with consistency all through-out the year (Customer Focus, Leadership, Commitment to Schedule & Quality, Aptitude to Learn and Team Work).</span>
													</div>
													
									                </td>
                                                    </tr>
                                                </thead>
                                                
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
                  </div>
                  <div class="clearfix"></div>
				  
				  
				  <div class="row">
                  <div class="col-md-12">
              
					       <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> Go-that-extra-mile </h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#Go-that-extra-mile"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="Go-that-extra-mile" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv1">
                                            <div class="bs-docs-example table-responsive">
											<div class="clearfix"></div>
													<div class="achivementheading" align="center">
													<span >Go-that-extra-mile 2020</span>
													</div>
													
                                            <table class="table table-bordered table-striped">
                                               
                                                <thead class="tablefont">
                                                    
													<tr>
													<?php
													//Saswati Nayak emp id: 200101
													$empData = $dbobj->getEmployeeData(200101);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Go-that-extra-mile” award is given to <b><?php echo $empData->name; ?></b> in recognition of exemplary leadership in institutionalizing our digital marketing efforts, quick learning & her ability to stitch together goals and building up a team of high performance. Her project coordination and customer communication abilities are appreciable, and we acknowledge her passion to continuously improve our digital content and strategy.</span>
													</div>
													
									                </td>
                                                    </tr>
													
													<tr>
													<?php
													//Debasish Ray emp id: 160401
													$empData = $dbobj->getEmployeeData(160401);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Go-that-extra-mile” award is given to <b><?php echo $empData->name; ?></b> in recognition of taking ownership and going that extra mile in delivering several customer projects, many times putting up needed extra effort. His contribution towards Hope Hospice Patient Management System, iKomplianz, NIMS, 2050-Healthcare projects are appreciated, and his knowledge-sharing with team with efforts to train younger colleagues is commendable.</span>
													</div>
													
									                </td>
                                                    </tr>
													
													
													<tr>
													<?php
													//JhalakPalai emp id: 190402
													$empData = $dbobj->getEmployeeData(190402);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Go-that-extra-mile” award is given to <b><?php echo $empData->name; ?></b> in recognition of becoming a top-class-performer in 2020 & independently managing customer projects. Jhalak has become a role-model to follow for rest of us when it comes to taking up a challenge in learning new skills, and sheer determination to deliver on time with quality. His relentless effort is highly appreciated.</span>
													</div>
													
									                </td>
                                                    </tr>
													
													
													<tr>
													<?php
													//Asis Pati emp id: 160901
													$empData = $dbobj->getEmployeeData(160901);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Go-that-extra-mile” award is given to <b><?php echo $empData->name; ?></b> in recognition of being the most aggressive yet a smiling leader. Asis has seamlessly taken up parallel project assignments, and always eager to improve his as well as team’s performance. His ability to handle challenging deadlines, complex requirements and staying cheerful under stressful situations are appreciated.</span>
													</div>
													
									                </td>
                                                    </tr>
													
													
													<tr>
													<?php
													//Manas Mahala emp id: 180101
													$empData = $dbobj->getEmployeeData(180101);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Go-that-extra-mile” award is given to <b><?php echo $empData->name; ?></b> in recognition of his positivity, ability to learn new technologies & build a team that delivers. His contribution to several projects in-parallel & managing customer expectations is appreciated. He is a role model when it comes to multi-tasking & imparting positivity.</span>
													</div>
													
									                </td>
                                                    </tr>
                                                </thead>
                                                
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
                  </div>
				  
				  
				  
				  
				  
				  <div class="clearfix"></div>
				  
				  
				  <div class="row">
                  <div class="col-md-12">
              
					       <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> Best Customer-Centricity </h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#Customer-Centricity"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="Customer-Centricity" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv1">
                                            <div class="bs-docs-example table-responsive">
											<div class="clearfix"></div>
													<div class="achivementheading" align="center">
													<span >Best Customer-Centricity 2020</span>
													</div>
													
                                            <table class="table table-bordered table-striped">
                                               
                                                <thead class="tablefont">
                                                    
													<tr>
													<?php
													//Debashree emp id: 131202
													$empData = $dbobj->getEmployeeData(131202);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Best Customer Centricity” award is given to <b><?php echo $empData->name; ?></b> in recognition of her sincerity, care and consistent focus towards customer’s goals. She had demonstrated exemplary customer communication, proactiveness and won client’s confidence by her sheer passion to make things happen for clients. </span>
													</div>
													
									                </td>
                                                    </tr>
													
													<tr>
													<?php
													//Sunil Kumar Muduli emp id: 151101
													$empData = $dbobj->getEmployeeData(151101);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Best Customer Centricity” award is given to <b><?php echo $empData->name; ?></b> in recognition of his dedicated effort and proactive communication, tweaking his availability based on customer time zone etc. His responses to customer messages and acting on priorities have helped him and OdiTek continue to be in good books of the client.</span>
													</div>
													
									                </td>
                                                    </tr>
													
													
													
                                                </thead>
                                                
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
                  </div>
				  
				  
				  
				  <div class="clearfix"></div>
				  
				  
				  <div class="row">
                  <div class="col-md-12">
              
					       <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> The High Flyer </h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#High_Flyer"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="High_Flyer" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv1">
                                            <div class="bs-docs-example table-responsive">
											<div class="clearfix"></div>
													<div class="achivementheading" align="center">
													<span >The High Flyer 2020</span>
													</div>
													
                                            <table class="table table-bordered table-striped">
                                               
                                                <thead class="tablefont">
                                                    
													<tr>
													<?php
													//Rajesh Kumar Chhatar: 201101
													$empData = $dbobj->getEmployeeData(201101);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “High Flyer” award is given to <b><?php echo $empData->name; ?></b> in recognition of his super-quick adaptation to customer projects, ability to acclimatize to new team, new organization with ease. He set a new benchmark of flying quick and high at OdiTek, and his contribution towards delivering on assigned projects are well acknowledged. </span>
													</div>
													
									                </td>
                                                    </tr>
													
													<tr>
													<?php
													//Dev Mandal  emp id: 200702
													$empData = $dbobj->getEmployeeData(200702);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “High Flyer” award is given to <b><?php echo $empData->name; ?></b> in recognition of his determined effort to learn & deliver. His positive disposition, willingness to burn extra hours to master new skills is well recognized.</span>
													</div>
													
									                </td>
                                                    </tr>
													
													
													
                                                </thead>
                                                
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
                  </div>
				  
				  
				  
				  
				  <div class="clearfix"></div>
				  
				  
				  <div class="row">
                  <div class="col-md-12">
              
					       <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> Running The Marathon </h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#Running-Marathon"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="Running-Marathon" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv1">
                                            <div class="bs-docs-example table-responsive">
											<div class="clearfix"></div>
													<div class="achivementheading" align="center">
													<span >Running The Marathon 2020</span>
													</div>
													
                                            <table class="table table-bordered table-striped">
                                               
                                                <thead class="tablefont">
                                                    
													<tr>
													<?php
													//Prakash Barik : 131203
													$empData = $dbobj->getEmployeeData(131203);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Running the Marathon” award is given to <b><?php echo $empData->name; ?></b> in recognition of his consistent focus towards multiple customer projects, and ability to handle team in a long marathon of multiple milestones. His calm composure in multi-tasking is well recognized. </span>
													</div>
													
									                </td>
                                                    </tr>
													
													<tr>
													<?php
													//Jayanta Moharana  emp id: 151005
													$empData = $dbobj->getEmployeeData(151005);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Running the Marathon” award is given to <b><?php echo $empData->name; ?></b> in recognition of his relentless efforts in managing a number of projects through-out 2020. His efforts towards better UI/UX, and ability to handle challenging deadlines is appreciated. He is a go-to-guy when it comes to software UI design.</span>
													</div>
													
									                </td>
                                                    </tr>
													
													
													
                                                </thead>
                                                
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
                  </div>
				  
				  
				  
				  
				  <div class="clearfix"></div>
				  
				  
				  <div class="row">
                  <div class="col-md-12">
              
					       <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> Best Team Player </h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#Team_Player"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="Team_Player" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv1">
                                            <div class="bs-docs-example table-responsive">
											<div class="clearfix"></div>
													<div class="achivementheading" align="center">
													<span >Best Team Player 2020</span>
													</div>
													
                                            <table class="table table-bordered table-striped">
                                               
                                                <thead class="tablefont">
                                                    
													<tr>
													<?php
													//Deepak Behera  : 131101
													$empData = $dbobj->getEmployeeData(131101);	
													?>
                                                    <td class="center_td" style="width:250px;" >
													<div class="achivementimage" align="center">
													<img  src="<?php echo $empData->image; ?>" alt="">
													</div>
													<div class="clearfix"></div>
													<div class="achivementname" align="center">
													<span ><?php echo $empData->name; ?></span>
													</div>
										            </td>
													<td>
													<div class="achivementsummary" align="center">
													<span >The “Best Team Player” award is given to <b><?php echo $empData->name; ?></b> in recognition of his attitude to contribute towards different teams. His ability to work on priorities, willingness to learn & contribute to different projects and teams is appreciable. </span>
													</div>
													
									                </td>
                                                    </tr>
													
																									
													
                                                </thead>
                                                
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
                  </div>
				  
				  
				  
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
	
	var dataString = "action=loadholiday&year_id="+year_id;
	//alert("dataString:"+dataString);
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
