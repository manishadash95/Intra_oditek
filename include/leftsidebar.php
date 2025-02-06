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
$wfh_access=0;
$wfh_admin=0;
$MR_access=0;

$current_date = date("Y-m-d");

$iv_key = $dbobj->get_mcrypt_iv();
$current_date = $dbobj->get_mcrypt_encrypt($current_date,$iv_key);
			
$team_attendance = "team_attendanceinfo.php?date=".$current_date."&iv=".$iv_key;
		

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
	$wfh_approver=1;
	$wfh_admin=1;
	$bu_mgmt=1;
	$MR_access=1;
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
	$MR_access=1;
	$wfh_approver=1;
	$wfh_admin=1;
	$bu_mgmt=1;
}
else if($obj_emp->type == 2 && $obj_emp->itadmin == 1)
{
	$it_access=1;
	$my_pr_access=1;
	
	
}
else if($obj_emp->type == 2 && $obj_emp->hradmin == 1)
{
	$MR_access=1;
	$hr_access=1;
	$my_pr_access=1;
	$project_access = $obj_emp->project_access;
	$task_access = $obj_emp->task_access;
	$wfh_viewer=1;
}
else{
	$project_access = $obj_emp->project_access;
	$task_access = $obj_emp->task_access;
	$leave_approver = $dbobj->checkLeaveReqApprover($eid);
	$report_access= $obj_emp->report_access;
	
}


//FOR WFH
if($obj_emp->wfh)
{
	$wfh_access = 1;
}
else{
	$wfh_access = 0;
}

if($eid == 1001 || $eid==230803)
{
	$it_access=1;
	$pr_access=1;
	
	$hr_access=1;
	$leave_req=1;
	$leave_dash=1;
	$my_pr_access=1;
	$wfh_access=1;
	$wfh_admin=1;
	$wfh_approver=1;
	$wfh_viewer=1;
	$it_admin=1;
	$bu_mgmt=1;
	$wfh_admin_intra=1;
	$MR_access=1;
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
	if(  $page == "createnewproject" || $page == "managecustomer" || $page == "createprojectgroup"  || $page == "createprojecttask" )
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


 function isMyRgRequest($page){
	$ret = 0;
	if($page == "reg_viewrequest"){
	$ret=1;
	}	
		
	return $ret;	
	 
 }


function isITAdmin($page)
{
	$ret=0;
	if(  $page == "itadminview"  || $page == "detailviewadminitrequest"  || $page == "closeadminitrequest" || $page == "detailviewcloseadminitrequest" )
		$ret=1;
		
		
	return $ret;
}

function isITAdminMgmt($page)
{
	$str = substr( $page, 0, 8 );
	if( $str == "itadmin_" )
		$ret=1;
	return $ret;
}

function isEmployeeFile($page)
{
	if( $page == "viewemployee" )
		$ret=1;
	else if( $page == "employeedetail" )
		$ret=1;
	else if( $page == "viewbuhead" )
		$ret=1;
	
	else if( $page == "viewemployee_finance" )
		$ret=1;
	else if( $page == "employeedetail_fin" )
		$ret=1;
	
	$str = substr( $page, 0, 5 );
	if( $str == "team_" )
		$ret=1;
	$str = substr( $page, 0, 7 );
	if( $str == "bumgmt_" )
		$ret=1;
			
	return $ret;
}

function isHREmployeeFile($page)
{
	if( $page == "hr_addemployee" )
		$ret=1;
	else if( $page == "hr_editemployee" )
		$ret=1;
	else if( $page == "viewemployee_hr" )
		$ret=1;
	else if( $page == "employeedetail_hr" )
		$ret=1;
	else if( $page == "hr_editemployee" )
		$ret=1;
	else if( $page == "hr_statusemployee" )
		$ret=1;
	else if( $page == "hr_recordupdatelogs" )
		$ret=1;
	else if( $page == "hr_resourceexit" )
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
	else if( $page == "leavehresourcereport" )
		$ret=1;
	
			
	return $ret;
}

function isWFHMgmt($page)
{
	$str = substr( $page, 0, 4 );
	if( $str == "wfh_" )
		$ret=1;
	return $ret;
}


function isIMPRMenu($page)
{
	$str = substr( $page, 0, 5 );
	if( $str == "impr_" )
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
function isPRSMenu($page)
{
    $ret = 0;
    if ($page == "pur_viewrequest") {
        $ret = 1;
    } else if ($page == "pur_requestreport") {
        $ret = 1;
    }
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
	if( $page == "mydailyreport" || $page == "mydailyhrreport" || $page == "mydailyhrslist" )
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

function MrReport($page)
{
	$ret=0;
	if($page == "mrbooking" || $page == "bookinghistory" || $page == "empBanking")
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
                        <a <?php if($pname=='viewmyprofile' || $pname=='mypasswdchange' )echo 'class="active"';?> href="viewmyprofile.php"><i class="fa fa-hand-o-right"></i> Edit My Profile</a>
                    </li>
					 <!-- end SIDE NAV USER PANEL
                	<li>
                        <a <?php if($pname=='mydailyreport')echo 'class="active"';?> href="mydailyreport.php"><i class="fa fa-laptop"></i> Daily Report </a>
                    </li>
					
					-->
					
					<li class="panel">
                    <a href="javascript:;" <?php if(isEmployeeFile($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#employeeupdate">
                        <i class="fa fa-hand-o-right"></i> BU/Employee <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isEmployeeFile($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="employeeupdate">
							<li>
							<a <?php if($pname=='viewbuhead' ) { echo 'class="active"'; }?> href="viewbuhead.php"><i class="fa fa-angle-double-right"></i> View BU Head</a>
							</li>
							
							
							<li>
							<a <?php if($pname=='viewemployee' || $pname=='employeedetail') { echo 'class="active"'; }?> href="viewemployee.php"><i class="fa fa-angle-double-right"></i> View Employee Data</a>
							</li>

							<li>
							<a <?php if($pname=='viewemployee_finance' || $pname=='employeedetail_fin') { echo 'class="active"'; }?> href="viewemployee_finance.php"><i class="fa fa-angle-double-right"></i> View Employee Fin</a>
							</li>							
							
							<?php if($bu_mgmt || $hr_access ){?>
							<li>
							
							<a <?php if($pname=='team_attendanceinfo' or $pname=='team_detailattedance' ) { echo 'class="active"'; }?> href="<?php echo $team_attendance; ?>" ><i class="fa fa-angle-double-right"></i> Team Attendance</a>
							</li>
							<?php } ?>
							
							<?php if($bu_mgmt){?>
							<li>
							
							<a <?php if($pname=='bumgmt_resourceexit') { echo 'class="active"'; }?> href="bumgmt_resourceexit.php" >
							<i class="fa fa-angle-double-right"></i> BU Exit Process</a>
							</li>
							<?php } ?>
							
                       	  
                        </ul>
                    </li>
					
								
					
					
					
                    
					
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
							<a <?php if($pname=='leavehresourcereport') { echo 'class="active"'; }?> href="leavehresourcereport.php">
							<i class="fa fa-angle-double-right"></i> HR: Leaves Report</a>
							</li>													
							
							<li>
							<a <?php if($pname=='leavehrcompoff') { echo 'class="active"'; }?> href="leavehrcompoff.php">
							<i class="fa fa-angle-double-right"></i> HR: Comp Off Leaves</a>
							</li>
							
							<?php } ?>
                       	  
                        </ul>
                    </li>
					<?php } ?>
					
					
					<?php //if($isEmp and ($wfh_admin or $wfh_access or $wfh_viewer or $wfh_approver )){
						if($isEmp){
					?>
					<li class="panel">
                    <a href="javascript:;" <?php if(isWFHMgmt($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#wfhmgmt">
                        <i class="fa fa-hand-o-right"></i> WFH Mgmt <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isWFHMgmt($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="wfhmgmt">
                            
							
							
							<li>
							<a <?php if($pname=='wfh_dashboard' ) { echo 'class="active"'; }?> href="wfh_dashboard.php">
							<i class="fa fa-angle-double-right"></i> WFH Dashboard</a>
							</li>
							
														
							<?php if($wfh_admin or $wfh_viewer) {?>
							
							<li>
							<a <?php if($pname=='wfh_viewallowlist' ) { echo 'class="active"'; }?> href="wfh_viewallowlist.php">
							<i class="fa fa-angle-double-right"></i> View WFH AllowList</a>
							</li>
							<?php } ?>
							
							<?php if($wfh_admin) {?>
							
							<li>
							<a <?php if($pname=='wfh_manage' || $pname=='wfh_resodetailview' ) { echo 'class="active"'; }?> href="wfh_manage.php">
							<i class="fa fa-angle-double-right"></i> WFH Manage/View</a>
							</li>
							<?php } ?>
							
							
							<li>
							<a <?php if($pname=='wfh_myviewrequest' || $pname=='wfh_mydetail' || $pname=='wfh_closedmyrequest' || $pname=='wfh_mydetailclosed' ) { echo 'class="active"'; }?> href="wfh_myviewrequest.php">
							<i class="fa fa-angle-double-right"></i> My WFH Request</a>
							</li>
						
							
							<?php if($wfh_approver){?>
							<li>
							<a <?php if($pname=='wfh_myapprovalrequest' || $pname=='wfh_myapprovaldetails') { echo 'class="active"'; }?> href="wfh_myapprovalrequest.php">
							<i class="fa fa-angle-double-right"></i> Approve WFH Request</a>
							</li>
							<?php }?>
							
							<?php if($wfh_viewer){?>
							<li>
							<a <?php if($pname=='wfh_viewrequest' || $pname=='wfh_viewrequestdetails') { echo 'class="active"'; }?> href="wfh_viewrequest.php">
							<i class="fa fa-angle-double-right"></i> View WFH Request</a>
							</li>
							<?php }?>
							
							<?php if($wfh_admin_intra){?>
							<li>
							<a <?php if($pname=='wfh_manage_all' || $pname=='wfh_resodetailview' ) { echo 'class="active"'; }?> href="wfh_manage_all.php">
							<i class="fa fa-angle-double-right"></i> WFH Manage/View All</a>
							</li>
							<?php }?>
							
							
							
							
														
							
                       	  
                        </ul>
                    </li>
					<?php } ?>
					
					
					
					
					
					<?php if($hr_access) {?>
					<li class="panel">
                    <a href="javascript:;" <?php if(isHREmployeeFile($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#employeeupdateHR">
                        <i class="fa fa-hand-o-right"></i> HR Employee Mgmt <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isHREmployeeFile($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="employeeupdateHR">
                            
							<li>
							<a <?php if($pname=='hr_addemployee') { echo 'class="active"'; }?> href="hr_addemployee.php">
							<i class="fa fa-angle-double-right"></i> Employee Add
							</a>
							</li>
							
							<li>
							<a <?php if($pname=='hr_editemployee') { echo 'class="active"'; }?> href="hr_editemployee.php">
							<i class="fa fa-angle-double-right"></i> Employee Edit
							</a>
							</li>
							
							<li>
							<a <?php if($pname=='hr_statusemployee') { echo 'class="active"'; }?> href="hr_statusemployee.php">
							<i class="fa fa-angle-double-right"></i> Employee Status
							</a>
							</li>
							
							<li>
							<a <?php if($pname=='hr_resourceexit') { echo 'class="active"'; }?> href="hr_resourceexit.php">
							<i class="fa fa-angle-double-right"></i> Employee Exit 
							</a>
							</li>
							
							
							
							<?php if($eid == 1001){ ?>
							<li>
							<a <?php if($pname=='hr_recordupdatelogs') { echo 'class="active"'; }?> href="hr_recordupdatelogs.php">
							<i class="fa fa-angle-double-right"></i> Update Logs
							</a>
							</li>
							
							
							
							<?php } ?>
													
                       	  
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
							
							
							<?php if($project_access) { ?>
                            <li>
                                <a <?php if($pname=='managecustomer'  ) { echo 'class="active"'; }?> href="managecustomer.php">
                                    <i class="fa fa-angle-double-right"></i> Manage Customer
                                </a>
                            </li>
							<?php } ?>
							
							
							
							<?php if($project_access) { ?>
                            <li>
                                <a <?php if($pname=='createprojectgroup'  ) { echo 'class="active"'; }?> href="createprojectgroup.php">
                                    <i class="fa fa-angle-double-right"></i> Project Group
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
							<a <?php if($pname=='mydailyhrslist' ) { echo 'class="active"'; }?> href="mydailyhrslist.php"><i class="fa fa-angle-double-right"></i> My Daily HRs Report</a>
							</li>
							
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

					
					
					<?php if($MR_access){?>
					<li class="panel">
                        <a href="javascript:;" <?php if(mrReport($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?>data-parent="#side" data-toggle="collapse" data-target="#mrlistid">
                            <i class="fa fa-hand-o-right"></i> Meeting Booking. <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(mrReport($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="mrlistid">
                            
							
							 <li>
                                <a <?php if($pname=='empBanking'  ) { echo 'class="active"'; }?> href="empBanking.php">
                                    <i class="fa fa-angle-double-right"></i> Emp Bank.
                                </a>
                            </li>
							
							
                            <li>
                                <a <?php if($pname=='mrbooking'  ) { echo 'class="active"'; }?> href="mrbooking.php">
                                    <i class="fa fa-angle-double-right"></i> MR Book.
                                </a>
                            </li>
					 <li>
                                <a <?php if($pname=='bookinghistory'  ) { echo 'class="active"'; }?> href="bookinghistory.php">
                                    <i class="fa fa-angle-double-right"></i> BOOK History.
                                </a>
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
					
					
					
					
					<li class="panel">
                    <a href="javascript:;" <?php if(isIMPRMenu($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#employeeimpr">
                        <i class="fa fa-hand-o-right"></i> Improvement Idea <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isIMPRMenu($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="employeeimpr">
                        	
							<li>
							<a <?php if($pname=='impr_myrequest' || $pname=='impr_mydetailview' ) { echo 'class="active"'; }?> href="impr_myrequest.php"><i class="fa fa-angle-double-right"></i> My Request</a>
							</li>
							
							<li>
							<a <?php if($pname=='impr_myassigned' || $pname=='impr_myassignedetailview' ) { echo 'class="active"'; }?> href="impr_myassignedrequest.php"><i class="fa fa-angle-double-right"></i> Assigned Request</a>
							</li>
							
							<li>
							<a <?php if($pname=='impr_requestreviewer' || $pname=='impr_reviewerdetailview' ) { echo 'class="active"'; }?> href="impr_requestreviewer.php"><i class="fa fa-angle-double-right"></i> Request Reviewer</a>
							</li>
													
							<li>
							<a <?php if($pname=='impr_report' || $pname=='impr_myreport.php' ) { echo 'class="active"'; }?> href="impr_report.php"><i class="fa fa-angle-double-right"></i> Improvement Report</a>
							</li>
							
                        </ul>
						
                    </li>
					
					
					<li class="panel">
                    <a href="javascript:;" <?php if(isPRSMenu($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#employeepur">
                        <i class="fa fa-hand-o-right"></i> Purchase Request <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isPRSMenu($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="employeepur">
                        	
							<li>
							<a <?php if($pname=='pur_viewrequest' || $pname=='impr_mydetailview' ) { echo 'class="active"'; }?> href="pur_viewrequest.php"><i class="fa fa-angle-double-right"></i> View Purchase Request</a>
							</li>
							
							<li>
							<a <?php if($pname=='pur_requestreport' || $pname=='impr_myassignedetailview' ) { echo 'class="active"'; }?> href="pur_requestreport.php"><i class="fa fa-angle-double-right"></i> Purchase Request Report</a>
							</li>
							
							
                        </ul>
						
                    </li>
					
					
					
					<li class="panel">
                    <a href="javascript:;" <?php if(isMyRgRequest($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?> data-parent="#side" data-toggle="collapse"  data-target="#employeereg">
                        <i class="fa fa-hand-o-right"></i> Resignation Request <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isMyRgRequest($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="employeereg">
                        	
							<li>
							<a <?php if($pname=='reg_viewrequest' || $pname=='' ) { echo 'class="active"'; }?> href="reg_viewrequest.php"><i class="fa fa-angle-double-right"></i> View Resignation Request</a>
							</li>
							
							
							
							
                        </ul>
						
                
					
					
					
					
					
					
					
					
					
					
					
				
					
					
					<li>
                        <a <?php if(isITRequest($pname))echo 'class="active"';?> href="viewopenitrequest.php"><i class="fa fa-hand-o-right"></i> IT Support</a>
                    </li>
					
					
					
					
					
					<?php if($it_access) { ?>
					<li class="panel">
                        <a href="javascript:;" <?php if(isITAdminMgmt($pname) > 0)echo 'class="accordion-toggle active"'; else echo 'class="accordion-toggle"';?>data-parent="#side" data-toggle="collapse" data-target="#itadminid">
                            <i class="fa fa-hand-o-right"></i> IT Mgmt. <i class="fa fa-caret-down"></i>
                        </a>
                        <ul <?php if(isITAdminMgmt($pname))echo 'class="in nav"'; else echo 'class="collapse nav"';?> id="itadminid">
                        
						<?php if($it_access){ ?>
						<li>
						<a <?php if($pname=='itadmin_itreqview' || $pname == 'itadmin_detailviewadminitrequest' || 
								$pname == 'itadmin_closeadminitrequest'  || $pname == 'itadmin_detailviewcloseadminitrequest' ) echo 'class="active"';?> href="itadmin_itreqview.php">
						<i class="fa fa-angle-double-right"></i> IT Admin
						</a>
						</li>
						
						<li>
                        <a <?php if($pname=='itadmin_itreport'  ) { echo 'class="active"'; }?> href="itadmin_itreport.php">
                        <i class="fa fa-angle-double-right"></i>It Report 
                        </a>
                        </li>
						
						
						<li>
                        <a <?php if($pname=='itadmin_newdevice'  ) { echo 'class="active"'; }?> href="itadmin_newdevice.php">
                        <i class="fa fa-angle-double-right"></i> Add Device
                        </a>
                        </li>
						
						<li>
                        <a <?php if($pname=='itadmin_viewdevice'   ||  $pname=='itadmin_devicedetail' ) { echo 'class="active"'; }?> href="itadmin_viewdevice.php">
                        <i class="fa fa-angle-double-right"></i> View Device
                        </a>
                        </li>
						
						<li>
                        <a <?php if($pname=='itadmin_allotdevice' ||  $pname=='itadmin_allotdetailview'  ) { echo 'class="active"'; }?> href="itadmin_allotdevice.php">
                        <i class="fa fa-angle-double-right"></i> Allocate Device
                        </a>
                        </li>
						
						<li>
                        <a <?php if($pname=='itadmin_allotdevice' ||  $pname=='itadmin_allotdetailview'  ) { echo 'class="active"'; }?> href="itadmin_allocatetempid.php">
                        <i class="fa fa-angle-double-right"></i> Allocatetemp Device
                        </a>
                        </li>
						
                        <li>
                        <a <?php if($pname=='itadmin_allocatetinternid' ) { echo 'class="active"'; }?> href="itadmin_allocatetinternid.php">
                        <i class="fa fa-angle-double-right"></i> Allocateintern Device
                        </a>
                        </li>                         

						<li>
                        <a <?php if($pname=='itadmin_resourceexit' ) { echo 'class="active"'; }?> href="itadmin_resourceexit.php">
                        <i class="fa fa-angle-double-right"></i> IT Exit Process
                        </a>
                        </li>
						
						<?php } ?>
						
						<?php if($it_admin){ ?>
						<li>
                        <a <?php if($pname=='itadmin_enrolldevice' ) { echo 'class="active"'; }?> href="itadmin_enrolldevice.php">
                        <i class="fa fa-angle-double-right"></i> Enroll Device
                        </a>
                        </li>
						
						
						
						
						
						
						<?php } ?>
				 
                        </ul>
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