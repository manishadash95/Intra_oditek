<?php
session_start();
include_once 'dbcon/ITAdminMgmt.php';

ini_set("display_errors",1);

$dbobj = new ITAdminMgmt();
$dbobj->connect();

$action = $_REQUEST['action'];
//print_r('action');
switch ($action) 
{
	case 'addLaptopDevice':
	$retarr = $dbobj->addLaptopDevice($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'addDesktopDevice':
	$retarr = $dbobj->addDesktopDevice($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'addMobileDevice':
	$retarr = $dbobj->addMobileDevice($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'addOtherDevice':
	$retarr = $dbobj->addOtherDevice($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'addTempDevice':
	$retarr = $dbobj->addTempDevice($_REQUEST);
	echo json_encode($retarr);
	break;
    
    case 'addInternDevice':
	$retarr = $dbobj->addInternDevice($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'viewDeviceList':
	$device = $_REQUEST['device'];
	$retarr = $dbobj->viewDeviceList($device);
	echo json_encode($retarr);
	break;
	
	
	
	case 'loadMyITallocateDevices':
	$device = $_REQUEST['device'];
	$retarr = $dbobj->loadMyITallocateDevices($device);
	echo json_encode($retarr);
	break;
	
	
	
	
	
	case 'getDeviceDetails':
	$dbid = $_REQUEST['dbid'];
	$retarr = $dbobj->getDeviceDetails($dbid);
	echo json_encode($retarr);
	break;
	
	case 'updateLaptopDevice':
	$retarr = $dbobj->updateLaptopDevice($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'updateDesktopDevice':
	$retarr = $dbobj->updateDesktopDevice($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'updateMobileDevice':
	$retarr = $dbobj->updateMobileDevice($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'updateOtherDevice':
	$retarr = $dbobj->updateOtherDevice($_REQUEST);
	echo json_encode($retarr);
	break;
	
	case 'getNewDeviceList':
	$device = $_REQUEST['device'];
	$retarr = $dbobj->getNewDeviceList($device);
	echo json_encode($retarr);
	break;
	
	
	case 'enrollDevice':
	$dbid = $_REQUEST['dbid'];
	$retarr = $dbobj->enrollDevice($dbid);
	echo json_encode($retarr);
	break;
	
	case 'allotDeviceList':
	$device = $_REQUEST['device'];
	$service = $_REQUEST['service'];
	$status = $_REQUEST['status'];
	$reso_id = $_REQUEST['reso_id'];
	$retarr = $dbobj->allotDeviceList($device,$service,$status,$reso_id);
	echo json_encode($retarr);
	break;
	
	
	
	
	case 'getDeviceUpdateStatus':
	$tid = $_REQUEST['tid'];
	$retarr = $dbobj->getDeviceUpdateStatus($tid);
	echo json_encode($retarr);
	break;
	
	
	case 'updateDeviceStatus':
	$tid = $_REQUEST['tid'];
	$status = $_REQUEST['status'];
	$reso_id = $_REQUEST['reso_id'];
	$itr_id = $_REQUEST['itr_id'];
	$desc = $_REQUEST['desc'];
	$retarr = $dbobj->updateDeviceStatus($tid,$status,$reso_id,$desc,$itr_id);
	echo json_encode($retarr);
	break;
	
	case 'checkEmpExitStatus':
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->checkEmpExitStatus($eid);
	echo json_encode($retarr);
	break;
	
	
	case 'getDeallocationStatus':
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->getDeallocationStatus($eid);
	echo json_encode($retarr);
	break;
	
	
	case 'updateITExit':
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->updateITExit($eid);
	echo json_encode($retarr);
	break;
	
	case 'updateAdminExit':
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->updateAdminExit($eid);
	echo json_encode($retarr);
	break;
	
	case 'updateBUExit':
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->updateBUExit($eid);
	echo json_encode($retarr);
	break;
	
	case 'checkEmpBUExitStatus':
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->checkEmpBUExitStatus($eid);
	echo json_encode($retarr);
	break;

	case 'getTempCardDetails':
	$retarr = $dbobj->getTempCardDetails();
	echo json_encode($retarr);
	break;

    case 'getAllInternName':
	$retarr = $dbobj->getAllInternName();
	echo json_encode($retarr);
	break;

	case 'actionDelete':
	$id = $_REQUEST['id'];
	$retarr = $dbobj->deleteTempCardDetails($id);
	echo json_encode($retarr);
	break;

	case 'actionDeletee':
	$id = $_REQUEST['id'];
	$retarr = $dbobj->deleteeInternCardDetails($id);
	echo json_encode($retarr);
	break;
	
}


?>
