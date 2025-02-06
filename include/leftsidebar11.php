<?php
$pname=trim(basename($_SERVER['REQUEST_URI']));
$path_parts = pathinfo($_SERVER['REQUEST_URI']);
$pname= $path_parts['filename'];

$eid = $_SESSION["emp_id"];
$all_access=0;
$project_access=0;
$task_access=0;
$obj_emp = $dbobj->getEmployeeAccess($eid);
$hr_access=0;
$leave_req=1;
$leave_approver=0;
$isEmp = $dbobj->isEmployee($eid);
$report_access=0;

if($obj_emp->type == 1)
{
	$all_access=1;
	$project_access=1;
	$task_access=1;
	$it_access=1;
	$pr_access=1;
	$leave_req=1;
	$leave_approver=1;
	$report_access=1;
}else if($obj_emp->type == 2 && $obj_emp->mgmt == 1)
{
	$all_access=1;
	$project_access=1;
	$task_access=1;
	$it_access=1;
	$pr_access=1;
	$leave_req=1;
	$leave_approver=1;
	$report_access=1;
}
else if($obj_emp->type == 2 && $obj_emp->itadmin == 1)
{
	$it_access=1;
}
else if($obj_emp->type == 2 && $obj_emp->hradmin == 1)
{
	$hr_access=1;
	$my_pr_access=1;
	$project_access = $obj_emp->project_access;
	$task_access = $obj_emp->task_access;
}
else{
	$project_access = $obj_emp->project_access;
	$task_access = $obj_emp->task_access;
	$leave_approver = $dbobj->checkLeaveReqApprover($eid);
	$report_access= $obj_emp->report_access;
}


if($eid == 1001)
{
	$it_access=1;
	$pr_access=1;
	$hr_access=1;
	$leave_req=1;
	$leave_dash=1;
	$my_pr_access=1;
}



function isSalarySection($page)
{
	$ret=0;
	if( $page == "dashboard" )
		$ret=1;
	else if( $page == "viewmyaroll" )
		$ret=1;
		
		
		
	return $ret;
}

function isProject($page)
{
	$ret=0;
	if(  $page == "createnewproject" || $page == "createprojecttask" )
		$ret=1;
		
		
	return $ret;
}

function isPSRequest($page)
{
	$ret=0;
	if(  $page == "closepsrequest" ||  $page == "detailviewclosepsrequest" ||  $page == "viewopenpsrequest" || $page == "newpsrequest" || $page == "pastpsrequest" || $page == "detailviewpsrequest")
		$ret=1;
		
		
	return $ret;
}

function isMyPSRequest($page)
{
	$ret=0;
	if(  $page == "closemypsrequest" ||  $page == "detailviewclosemypsrequest" ||  $page == "viewopenmypr" || $page == "newmypsrequest" || $page == "pastmypsrequest" || $page == "detailviewmypsrequest")
		$ret=1;
		
		
	return $ret;
}

function isITRequest($page)
{
	$ret=0;
	if(  $page == "closeitrequest" ||  $page == "detailviewcloseitrequest" ||  $page == "viewopenitrequest" || $page == "newitrequest" || $page == "pastitrequest" || $page == "detailviewitrequest")
		$ret=1;
		
		
	return $ret;
}

function isITAdmin($page)
{
	$ret=0;
	if(  $page == "itadminview"  || $page == "detailviewadminitrequest"  || $page == "closeadminitrequest" || $page == "detailviewcloseadminitrequest" )
		$ret=1;
		
		
	return $ret;
}

function isEmployeeFile($page)
{
	if( $page == "viewemployee" )
		$ret=1;
	else if( $page == "employeedetail" )
		$ret=1;
			
	return $ret;
}

function isHREmployeeFile($page)
{
	if( $page == "addemployee_hr" )
		$ret=1;
	else if( $page == "viewemployee_hr" )
		$ret=1;
	else if( $page == "employeedetail_hr" )
		$ret=1;
			
	return $ret;
}


function isLeaveMgmt($page)
{
	if( $page == "leavemynewrequest" )
		$ret=1;
	else if( $page == "leavedashboard" )
		$ret=1;
	else if( $page == "leavemyviewrequest" )
		$ret=1;
	else if( $page == "leaveempnewrequest" )
		$ret=1;
	else if( $page == "leavemydetail" )
		$ret=1;
	else if( $page == "leavemyapprovalrequest" )
		$ret=1;
	else if( $page == "leavemyapprovaldetails" )
		$ret=1;
	else if( $page == "leavehrviewrequest" )
		$ret=1;
	else if( $page == "leavehrviewdetails" )
		$ret=1;
	else if( $page == "leaveclosedmyrequest" )
		$ret=1;
	else if( $page == "leavemydetailclosed" )
		$ret=1;
	else if( $page == "leavehrviewresourcestatus" )
		$ret=1;
	else if( $page == "leavehrviewdetailsresource" )
		$ret=1;
	else if( $page == "leavehrupdateresourcecount" )
		$ret=1;
	else if( $page == "leavehrrevertleaves" )
		$ret=1;
	else if( $page == "leavehrcompoff" )
		$ret=1;
	
			
	return $ret;
}

function isGenerateSalary($page)
{
	$ret=0;
	if( $page == "aroll" || $page == "viewaroll" || $page == "viewemployeearoll")
		$ret=1;
		
		
	return $ret;
}

function isHolidayFile($page)
{
	$ret=0;
	if( $page == "viewholidays" )
		$ret=1;
	else if( $page == "viewoffdays" )
		$ret=1;
			
	return $ret;
}

function isAchievementsFile($page)
{
	$ret=0;
	if( $page == "achivements2020" )
		$ret=1;
	
	return $ret;
}

function isProjectReport($page)
{
	$ret=0;
	if( $page == "mydailyreport" || $page == "mydailyhrreport" )
		$ret=1;
	
			
	return $ret;
}



function isReport($page)
{
	$ret=0;
	if(  $page == "projecttaskreport" || $page == "empolyeehrreport" || $page == "dailyhrreport" || $page == "projectreport")
		$ret=1;
		
		
	return $ret;
}




?>
<nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <div class="profileimage">
                        <?php
							
							$image = $dbobj->getImage($eid);
						?>
                        <?php if(strlen($image)  > 0) {
                        	echo '<img class="img-circle" src="'.$image.'" alt="">';
                        }
						else{ 
						?>
                        <img class="img-circle" src="img/profile-pic-blank.png" alt="">
						</div>
                        <?php } ?>
                        <p class="welcome">
                            
                        </p>
                        <p class="name tooltip-sidebar-logout">
                           
                            <span class="last-name"><?php echo $_SESSION["emp_name"];?></span> 
							<a style="color: inherit; outline:none;" class="logout_open outlinedivnone" href="logout.php" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
							
                        </p>
						<div class="clearfix"></div>
						<p class="name tooltip-sidebar-logout">
                           
                            <span class="" style="marging-top:135px;">Emp. Id:<?php echo $_SESSION["emp_id"];?></span>
                        </p>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin SIDE NAV SEARCH -->
                    
                    <!-- end SIDE NAV SEARCH -->
                    <!-- begin DASHBOARD LINK -->
                    <li>
                        <a <?php if(isSalarySection($pname)) echo 'class="active"';?> href="dashboard.php"><i class="fa fa-hand-o-right"></i> My Dashboard</a>
                    </li>
					 <!--
					<li>
                        <a <?php if($pname=='new-card-image' || $pname=='viewicardimages' )echo 'class="active"';?> href="new-card-image.php"><i class="fa fa-hand-o-right"></i> I-Card Image 
						<img src="img/new-image.png" width="auto" height="20" alt="" style="padding-left:10px;"></a>
                    </li>
					-->
					
					<li>
                        <a <?php if($pname=='covid19vaccine')echo 'class="active"';?> href="covid19vaccine.php"><i class="fa fa-hand-o-right"></i> Covid-19 Vaccine</a>
                    </li>
                    
                   <li>
                        <a <?php if($pname=='viewmyprofile')echo 'class="active"';?> href="viewmyprofile.php"><i class="fa fa-hand-o-right"></i> Edit My Profile</a>
                    </li>
					 <!-- end SIDE NAV USER PANEL
                	<li>
                        <a <?php if($pname=='mydailyreport')echo 'class="active"';?> href="mydailyreport.php"><i class="fa fa-laptop"></i> Daily Report </a>
                    </li>
                    
					-->
					<?php if($isEmp){?>
					<li class="panel">
                    <a href="javascript:;" <?php if(isLeaveMgmt($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#leavemgmt">
                        <i class="fa fa-hand-o-right"></i> Leave Mgmt <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isLeaveMgmt($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="leavemgmt">
                            
							<li>
							<a <?php if($pname=='leavedashboard' ) { echo 'class="active"'; }?> href="leavedashboard.php">
							<i class="fa fa-angle-double-right"></i> Leave Dashboard</a>
							</li>
							
							
							<?php if($leave_req){?>
							<li>
							<a <?php if($pname=='leavemyviewrequest' || $pname=='leavemydetail' || $pname=='leaveclosedmyrequest' || $pname=='leavemydetailclosed' ) { echo 'class="active"'; }?> href="leavemyviewrequest.php">
							<i class="fa fa-angle-double-right"></i> My Leave Request</a>
							</li>
							<?php }?>
							
							<?php if($leave_approver){?>
							<li>
							<a <?php if($pname=='leavemyapprovalrequest' || $pname=='leavemyapprovaldetails') { echo 'class="active"'; }?> href="leavemyapprovalrequest.php">
							<i class="fa fa-angle-double-right"></i> Approve Leave Request</a>
							</li>
							<?php }?>
							
							<?php if($hr_access) {?>
							
							
							<li>
							<a <?php if($pname=='leaveempnewrequest' ) { echo 'class="active"'; }?> href="leaveempnewrequest.php">
							<i class="fa fa-angle-double-right"></i> HR: New Leave Request</a>
							</li>
							
							
							<li>
							<a <?php if($pname=='leavehrviewrequest' || $pname=='leavehrviewdetails') { echo 'class="active"'; }?> href="leavehrviewrequest.php">
							<i class="fa fa-angle-double-right"></i> HR: Open Leave Request</a>
							</li>
							
							<li>
							<a <?php if($pname=='leavehrviewresourcestatus' || $pname=='leavehrviewdetailsresource' || $pname=='leavehrrevertleaves' ) { echo 'class="active"'; }?> href="leavehrviewresourcestatus.php">
							<i class="fa fa-angle-double-right"></i> HR: View Resource Leaves</a>
							</li>
							
							<li>
							<a <?php if($pname=='leavehrupdateresourcecount') { echo 'class="active"'; }?> href="leavehrupdateresourcecount.php">
							<i class="fa fa-angle-double-right"></i> HR: Update Resource Leaves</a>
							</li>
							
							<li>
							<a <?php if($pname=='leavehrcompoff') { echo 'class="active"'; }?> href="leavehrcompoff.php">
							<i class="fa fa-angle-double-right"></i> HR: Comp Off Leaves</a>
							</li>
							
							<?php } ?>
                       	  
                        </ul>
                    </li>
					<?php } ?>
					
					
					
					<li class="panel">
                    <a href="javascript:;" <?php if(isEmployeeFile($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#employeeupdate">
                        <i class="fa fa-hand-o-right"></i> Employee <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isEmployeeFile($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="employeeupdate">
                                                      
							<li>
							<a <?php if($pname=='viewemployee' || $pname=='employeedetail') { echo 'class="active"'; }?> href="viewemployee.php"><i class="fa fa-angle-double-right"></i> View Employee Data</a>
							</li>
                       	  
                        </ul>
                    </li>
					
					<?php if($hr_access) {?>
					<li class="panel">
                    <a href="javascript:;" <?php if(isHREmployeeFile($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#employeeupdateHR">
                        <i class="fa fa-hand-o-right"></i> HR Employee Mgmt <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isHREmployeeFile($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="employeeupdateHR">
                            
							<li>
							<a <?php if($pname=='addemployee_hr') { echo 'class="active"'; }?> href="addemployee_hr.php">
							<i class="fa fa-angle-double-right"></i> Add New Employee
							</a>
							</li>
							<!--
							<li>
							<a <?php if($pname=='viewemployee_hr' || $pname=='employeedetail_hr') { echo 'class="active"'; }?> href="viewemployee_hr.php"><i class="fa fa-angle-double-right"></i> View Employee Data</a>
							</li>
							-->						
                       	  
                        </ul>
                    </li>
					
					
					<?php }?>
										
					
					<?php if($project_access || $task_access) { ?>
					<li class="panel">
                        <a href="javascript:;" <?php if(isProject($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?>data-parent="#side" data-toggle="collapse" data-target="#projectlistid">
                            <i class="fa fa-hand-o-right"></i> Project Mgmt. <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isProject($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="projectlistid">
                            
							<?php if($project_access) { ?>
                            <li>
                                <a <?php if($pname=='createnewproject'  ) { echo 'class="active"'; }?> href="createnewproject.php">
                                    <i class="fa fa-angle-double-right"></i> Manage Project
                                </a>
                            </li>
							<?php } ?>

						     <?php if($task_access) { ?>
                            <li>
                                <a <?php if($pname=='createprojecttask'  ) { echo 'class="active"'; }?> href="createprojecttask.php">
                                    <i class="fa fa-angle-double-right"></i> Manage Project Tasks
                                </a>
                            </li>
                        	<?php } ?>				
                       
                        
				 
                        </ul>
                    </li>
					<?php } ?>
					
					
					<li class="panel">
                    <a href="javascript:;" <?php if(isProjectReport($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#employeeproject">
                        <i class="fa fa-hand-o-right"></i> Project Report <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isProjectReport($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="employeeproject">
                        	<li>
							<a <?php if($pname=='mydailyreport' ) { echo 'class="active"'; }?> href="mydailyreport.php"><i class="fa fa-angle-double-right"></i> My Daily Report</a>
							</li>
							
							<li>
							<a <?php if($pname=='mydailyhrreport' ) { echo 'class="active"'; }?> href="mydailyhrreport.php"><i class="fa fa-angle-double-right"></i> View Daily Report</a>
							</li>
							
							
                        </ul>
                    </li>
					
					<?php if($report_access){?>
					<li class="panel">
                        <a href="javascript:;" <?php if(isReport($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?>data-parent="#side" data-toggle="collapse" data-target="#reportlistid">
                            <i class="fa fa-hand-o-right"></i> Report Mgmt. <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isReport($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="reportlistid">
                            
                            <li>
                                <a <?php if($pname=='projectreport'  ) { echo 'class="active"'; }?> href="projectreport.php">
                                    <i class="fa fa-angle-double-right"></i> Project Report
                                </a>
                            </li>
                      

						     
                            <li>
                                <a <?php if($pname=='empolyeehrreport'  ) { echo 'class="active"'; }?> href="empolyeehrreport.php">
                                    <i class="fa fa-angle-double-right"></i> Resource Hour Report
                                </a>
                            </li>
							
						
							<li>
							<a <?php if($pname=='projecttaskreport' ) { echo 'class="active"'; }?> href="projecttaskreport.php"><i class="fa fa-angle-double-right"></i> Project Task Report</a>
							</li>
						
                      
                        </ul>
                    </li>
					<?php }?>
					
					
					<?php if($pr_access){ ?>
					<li>
                        <a <?php if(isPSRequest($pname))echo 'class="active"';?> href="viewopenpsrequest.php"><i class="fa fa-hand-o-right"></i> Purchase Request</a>
                    </li>
					<?php } ?>
					
					<?php if($my_pr_access){ ?>
					<li>
                        <a <?php if(isMyPSRequest($pname))echo 'class="active"';?> href="viewopenmypr.php"><i class="fa fa-hand-o-right"></i> My Purchase Request</a>
                    </li>
					<?php } ?>
					
					<li>
                        <a <?php if(isITRequest($pname))echo 'class="active"';?> href="viewopenitrequest.php"><i class="fa fa-hand-o-right"></i> IT Support</a>
                    </li>
					
					<?php if($it_access){ ?>
					<li>
                        <a <?php if(isITAdmin($pname))echo 'class="active"';?> href="itadminview.php"><i class="fa fa-hand-o-right"></i> IT Admin</a>
                    </li>
					<?php } ?>
					
					
					
					
					<li>
                        <a <?php if($pname=='viewdoclink')echo 'class="active"';?> href="viewdoclink.php"><i class="fa fa-hand-o-right"></i> Important Links</a>
                    </li>
					
					
					
					<li class="panel">
                    <a href="javascript:;" <?php if(isAchievementsFile($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#achievements">
                        <i class="fa fa-hand-o-right"></i> Achievements <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isAchievementsFile($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="achievements">
                           <?php if($admin_restrictions == 0 || $adminobj->lr1 == 1 ) { ?> 
							<li>
							<a <?php if($pname=='achivements2020' ) { echo 'class="active"'; }?> href="achivements2020.php"><i class="fa fa-angle-double-right"></i> Year 2020</a>
							</li>
                            <?php } ?>
                            
                        </ul>
                    </li>
					
					
					<li class="panel">
                    <a href="javascript:;" <?php if(isHolidayFile($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#holidayupdate">
                        <i class="fa fa-hand-o-right"></i> Holiday <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isHolidayFile($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="holidayupdate">
                           <?php if($admin_restrictions == 0 || $adminobj->lr1 == 1 ) { ?> 
							<li>
							<a <?php if($pname=='viewholidays' ) { echo 'class="active"'; }?> href="viewholidays.php"><i class="fa fa-angle-double-right"></i> View Holiday</a>
							</li>
                            <?php } ?>
                            <?php if($admin_restrictions == 0 || $adminobj->lr2 == 1 ) { ?>
							<li>
							<a <?php if($pname=='viewoffdays' ) { echo 'class="active"'; }?> href="viewoffdays.php"><i class="fa fa-angle-double-right"></i> View All Offdays</a>
							</li>
                       	  <?php } ?>
                        </ul>
                    </li>
					
					
                     

                    
                    <!-- end DASHBOARD LINK -->
                    <!--add_employee_div-->
                    
                    <li>
                        <a <?php if($pname=='alertmessage') { echo 'class="active"'; } else { echo '';}?> href="alertmessage.php">
                            <i class="fa fa-dashboard"></i> Alert Message
                        </a>
                    </li>
                    <!--end_employee_div-->
                    <!--add_generate_salary_div-->
                   
                    <!--end_generate_salary_div-->
                    <!--add_quickly_update_div-->
                    
                    <!--end_update_record_div-->
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>