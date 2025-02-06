<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
include 'include/init.php';
include_once 'dbcon/DBConnection.php';
$dbobj = new DBConnection();
$dbobj->connect();
set_time_limit(0);

$action = $_REQUEST['act'];
//print_r('act');
switch ($action)
 
{
	case 'employeeid':
	$joindate = $_REQUEST['joindate'];
	$result = $dbobj->getEmployeeId($joindate);
	$retarr=array();
	$retarr["id"]= $result;
	echo json_encode($retarr);
	break;
	
	case 'checkemployee':
	$retarr=array();
	$employee_id = $_REQUEST['employee_id'];
	if($dbobj->checkEmployeeId($employee_id)){
		$retarr["result"]= 0;
	}else{
		$retarr["result"]= 1;
	}
	echo json_encode($retarr);
	break;
	
	case 'getEndDate':
	$sdate = $_REQUEST['sdate'];
	$period = $_REQUEST['period'];
	$retarr = $dbobj->getEndDate($sdate,$period);
	echo json_encode($retarr);
	break;
	
	
	case 'directorid':
	$result = $dbobj->getDirectorId();
	$retarr=array();
	$retarr["id"]= $result;
	echo json_encode($retarr);
	break;
	
	case 'addemployee':
	$retarr = $dbobj->addEmployee($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'getemployeedata':
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->getEmployeeDataToEdit($eid);
	echo json_encode($retarr);
	break;
	
	case 'getProbationDuration':
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$retarr = $dbobj->getProbationDuration($sdate,$edate);
	echo json_encode($retarr);
	break;
	
	case 'updateBasicInfo':
	$retarr = $dbobj->updateBasicInfo($_REQUEST);
	echo json_encode($retarr);
	break;
	
	
	
	case 'updateImageInfo':
	$filename = $_REQUEST['filename'];
	$retarr = $dbobj->updateImageInfo($filename);
	echo json_encode($retarr);
	break;


	
	case 'updateFamilyInfo':
	$retarr = $dbobj->updateFamilyInfo($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'updateEducationInfo':
	$retarr = $dbobj->updateEducationInfo($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'updatePastExpInfo':
	$retarr = $dbobj->updatePastExpInfo($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'updateEmployeeInfo':
	$retarr = $dbobj->updateEmployeeInfo($_REQUEST);
	echo json_encode($retarr);
	break;
		
	
	case 'updateBUInfo':
	$retarr = $dbobj->updateBUInfo($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'updateNoticeInfo':
	$retarr = $dbobj->updateNoticeInfo($_REQUEST);
	echo json_encode($retarr);
	break;
	
	
	
	
	
	case 'getPermanentEmployeeList':
	$retarr = $dbobj->getPermanentEmployeeList();
	echo json_encode($retarr);
	break;
	
	case 'getProbationEmployeeList':
	$retarr = $dbobj->getProbationEmployeeList();
	echo json_encode($retarr);
	break;
	
	case 'getInternEmployeeList':
	$retarr = $dbobj->getInternEmployeeList();
	echo json_encode($retarr);
	break;
	
	case 'getOnNoticeEmployeeList':
	$retarr = $dbobj->getOnNoticeEmployeeList();
	echo json_encode($retarr);
	break;
	
	case 'getContractualEmployeeList':
	$retarr = $dbobj->getContractualEmployeeList();
	echo json_encode($retarr);
	break;
	
	case 'getLeftEmployeeList':
	$retarr = $dbobj->getLeftEmployeeList();
	echo json_encode($retarr);
	break;
	
	
	case 'getEmpRecordUpdateLogs':
	$retarr = $dbobj->getEmpRecordUpdateLogs();
	echo json_encode($retarr);
	break;
	
	case 'getEmpExitStatus':
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->getEmpExitStatus($eid);
	echo json_encode($retarr);
	break;
	
	case 'completeExitProcess':
	$retarr = $dbobj->completeExitProcess($_REQUEST);
	echo json_encode($retarr);
	break;
	
	
}
?>