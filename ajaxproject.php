<?php
ini_set("display_errors",0);
include 'include/init.php';
include_once 'dbcon/DBConnection.php';
$dbobj = new DBConnection();
$dbobj->connect();
set_time_limit(0);



$action = $_REQUEST['action'];
//print_r('action');
switch ($action) 
{
	case 'addnewProject':
	$result = $dbobj->addNewProject($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'MeetingBooking':
	$result = $dbobj->MeetingBooking($_REQUEST);
	echo json_encode($result);
	break;
	
	
	case 'BankInfo':
	$result = $dbobj->BankInfo($_REQUEST);
	echo json_encode($result);
	break;
	
	
	 case 'loadBankGroup':
	 $result = $dbobj->loadBankGroup($_REQUEST);
	 echo json_encode($result);
	 break;
	
	case 'updateBankInfo':
	$result = $dbobj->updateBankInfo($_REQUEST);
	echo json_encode($result);
	break;
	
	
	case 'CreateMeeting':
	$result = $dbobj->CreateMeeting($_REQUEST);
	echo json_encode($result);
	break;
	 
	case 'deleteMeetingHistory':
    $id = $_REQUEST['id']; 
    $deleteAll = $_REQUEST['deleteAll'];  // Simple check for deleteAll flag

    $retarr = $dbobj->deleteMeetingHistory($id, $deleteAll);  // Call delete function
    echo json_encode($retarr); 
    break;

    




	case 'getMeetingBook':
	$result =  $dbobj->getMeetingBook($_REQUEST); 
    echo json_encode($result);
	break;

	
	case 'getMeetingBookDetails':
	$result =  $dbobj->getMeetingBook($_REQUEST); 
    echo json_encode($result);
	break;
	
	
	case 'loadMeetingGroup':
	$result = $dbobj->loadMeetingGroup($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'actionDelete':
	$id = $_REQUEST['id'];
	$retarr = $dbobj->deleteMeetingBooking($id);
	echo json_encode($retarr);
	break;
	
	
	case 'updateProject':
	$result = $dbobj->updateProject($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'addprojecttask':
	$result = $dbobj->addNewProjectTask($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'updateprojecttask':
	$result = $dbobj->updateNewProjectTask($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'loadprojecttask':
	$pro_id = $_REQUEST['pro_id'];
	$grp_id = $_REQUEST['grp_id'];
	$result = $dbobj->loadProjectTaskHTML($pro_id,$grp_id);
	echo json_encode($result);
	break;
	
	case 'loadprojecttasktime':
	$pro_id = $_REQUEST['pro_id'];
	$grp_id = $_REQUEST['grp_id'];
	$result = $dbobj->loadProjectTaskTimeHTML($pro_id,$grp_id);
	echo json_encode($result);
	break;
	
	case 'loadproject':
	$grp_id = $_REQUEST['grp_id'];
	$result = $dbobj->loadProject($grp_id);
	echo json_encode($result);
	break;
	
	case 'loadproject2':
	$grp_id = $_REQUEST['grp_id'];
	$result = $dbobj->loadProject2($grp_id);
	echo json_encode($result);
	break;
	
	case 'loadproject3':
	$cus_id = $_REQUEST['cus_id'];
	$result = $dbobj->loadProject3($cus_id);
	echo json_encode($result);
	break;
	
	
	case 'loadcusproject':
	$cus_id = $_REQUEST['cus_id'];
	//$grp_id = $_REQUEST['grp_id'];
	$result = $dbobj->loadCustomerProject($cus_id);
	echo json_encode($result);
	break;
	
	case 'loadcusproject2':
	$cus_id = $_REQUEST['cus_id'];
	$result = $dbobj->loadCustomerProject2($cus_id);
	echo json_encode($result);
	break;
	
	case 'loadcusproject3':
	$cus_id = $_REQUEST['cus_id'];
	$result = $dbobj->loadCustomerProject3($cus_id);
	echo json_encode($result);
	break;
	
	case 'loadprojecttasklist':
	$pro_id = $_REQUEST['pro_id'];
	$grp_id = $_REQUEST['grp_id'];
	$result = $dbobj->loadProjectTaskListHTML($pro_id,$grp_id);
	echo json_encode($result);
	break;
	
	
	case 'loadprojecttaskresources':
	$pro_id = $_REQUEST['pro_id'];
	$task_id = $_REQUEST['task_id'];
	$result = $dbobj->loadProjectTaskResoListHTML($pro_id,$task_id);
	echo json_encode($result);
	break;
	
	case 'loadresource':
	$team_id = $_REQUEST['team_id'];
	$result = $dbobj->loadResourceList($team_id);
	echo json_encode($result);
	break;
	
	
	case 'loadprojectlist':
	$pro_cus = $_REQUEST['pro_cus'];
	$result = $dbobj->getProjectListHtml($pro_cus);
	echo json_encode($result);
	break;
	
	
	case 'generatehrreport':
	$cus_id = $_REQUEST['cus_id'];
	$grp_id = $_REQUEST['grp_id'];
	$pro_id = $_REQUEST['pro_id'];
	$task_id = $_REQUEST['task_id'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$reso_id=0;
	$result = $dbobj->generateHRReportHTML($cus_id,$grp_id,$pro_id,$task_id,$reso_id,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	
	case 'generateinvoicereport':
	$cus_id = $_REQUEST['cus_id'];
	$pro_id = $_REQUEST['pro_id'];
	$inv_type = $_REQUEST['inv_type'];
	$inv_status = $_REQUEST['inv_status'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$result = $dbobj->generateInvoiceReportHTML($cus_id,$pro_id,$inv_type,$inv_status,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	
	case 'generatereceivedreport':
	$cus_id = $_REQUEST['cus_id'];
	$pro_id = $_REQUEST['pro_id'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$result = $dbobj->generateReceivedReportHTML($cus_id,$pro_id,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	
}
?>