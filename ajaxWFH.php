<?php
include_once 'dbcon/DBConnection.php';
session_start();
include 'include/pagination.php';
$dbobj = new DBConnection();
$dbobj->connect();

$action = $_REQUEST['action'];




if($action == "loadWFHResourceCounts")
{
	$eid = $_REQUEST['eid'];	
	$retarr = $dbobj->loadWFHResourceCounts($eid);
	echo json_encode($retarr);
}
else if($action == "getMyWFHCountsList")
{
	$retarr = $dbobj->getMyWFHCountsList();
	echo json_encode($retarr);
}
else if($action == "loadMyOpenRequest")
{
	$retarr = $dbobj->loadMyOpenWFHRequest();
	echo json_encode($retarr);
}
else if($action == "loadAllOpenRequest")
{
	$retarr = $dbobj->loadMyOpenWFHRequest();
	echo json_encode($retarr);
}
else if($action == "getWFHCnt")
{
	$eid = $_SESSION["emp_id"];
	$sdate = $_REQUEST['sdate'];
	$retarr = $dbobj->getAvailableWFH($eid,$sdate);
	echo json_encode($retarr);
}
else if($action == "totaldays")
{
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$type = $_REQUEST['type'];
	$retarr = $dbobj->calculateTotalWFHDays($type,$sdate,$edate);
	echo json_encode($retarr);
}
else if($action == "createNewRequest")
{
	$eid = $_SESSION["emp_id"];	
	$retarr = $dbobj->createNewRequest($_REQUEST,$eid);
	echo json_encode($retarr);
}
else if($action == "loadMyClosedEFHRequest")
{
	$retarr = $dbobj->loadMyClosedWFHRequest();
	echo json_encode($retarr);
}
else if($action == "loadAllClosedEFHRequest")
{
	$retarr = $dbobj->loadAllClosedWFHRequest();
	echo json_encode($retarr);
}
else if($action == "loadMyReviewWFHRequest")
{
	$retarr = $dbobj->loadMyReviewWFHRequest();
	echo json_encode($retarr);
}
else if($action == "cancellRequestCreator")
{
	$wid = $_REQUEST["wid"];	
	$retarr = $dbobj->cancellOpenRequest($wid);
	echo json_encode($retarr);
}
else if($action == "rejectRequest")
{
	$wid = $_REQUEST["wid"];	
	$retarr = $dbobj->rejectOpenRequest($wid);
	echo json_encode($retarr);
}
else if($action == "approveRequest")
{
	$wid = $_REQUEST["wid"];	
	$retarr = $dbobj->approveOpenRequest($wid);
	echo json_encode($retarr);
}
else if($action == "loadResoData")
{
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->loadWFHResoData($eid);
	echo json_encode($retarr);
}
else if($action == "loadResoAllWFH")
{
	$eid = $_REQUEST['eid'];
	$year = date("Y");
	$retarr = $dbobj->loadResoAllWFHRequest($eid,$year);
	echo json_encode($retarr);
}
else if($action == "deleteWFHEntry")
{
	$id = $_REQUEST['id'];
	$retarr = $dbobj->deleteWFHEntryRecord($id);
	echo json_encode($retarr);
}
else if($action == "addWFHEntry")
{
	$retarr = $dbobj->addNewWFHEntryRecord($_REQUEST);
	echo json_encode($retarr);
}
else if($action == "loadWFHResourceAllow")
{
	$retarr = $dbobj->loadWFHResourceAllow();
	echo json_encode($retarr);
}
else if($action == "loadTodayWFHList")
{
	$retarr = $dbobj->loadTodayWFHList();
	echo json_encode($retarr);
}




////////////////////////////////////















else if($action == "getLeaveCntEmp")
{
	$type = $_REQUEST['type'];
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->getAllAvailableLeave($type,$eid);
	echo json_encode($retarr);
}

else if($action == "getLeaveTypeEmp")
{
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->getLeaveTypeEmp($eid);
	echo json_encode($retarr);
}

else if($action == "getLeaveAllType")
{
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->getLeaveAllType($eid);
	echo json_encode($retarr);
}

else if($action == "createLeave")
{
	$eid = $_SESSION["emp_id"];	
	$retarr = $dbobj->createNewLeaveRequest($_REQUEST,$eid,0);
	echo json_encode($retarr);
}

else if($action == "createLeaveEmp")
{
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->createNewLeaveRequest($_REQUEST,$eid,1);
	echo json_encode($retarr);
}
else if($action == "loadHRReviewLeaveRequest")
{
	$retarr = $dbobj->loadHRReviewLeaveRequest();
	echo json_encode($retarr);
}
else if($action == "loadHRReviewPastLeaveRequest")
{
	$retarr = $dbobj->loadHRReviewPastLeaveRequest();
	echo json_encode($retarr);
}
else if($action == "updateRequestCreator")
{
	$retarr = $dbobj->updateLeaveRequestbyCreator($_REQUEST);
	echo json_encode($retarr);
}
else if($action == "updateRequestReviwer")
{
	$retarr = $dbobj->updateLeaveRequestbyReviwer($_REQUEST);
	echo json_encode($retarr);
}
else if($action == "updateHRRequest")
{
	$retarr = $dbobj->updateHRRequest($_REQUEST);
	echo json_encode($retarr);
}


else if($action == "updateResoLeaveRecords")
{
	$retarr = $dbobj->updateResoLeaveRecords($_REQUEST);
	echo json_encode($retarr);
}
else if($action == "revertResoLeaveRecords")
{
	$retarr = $dbobj->revertResoLeaveRecords($_REQUEST);
	echo json_encode($retarr);
}
else if($action == "loadResourceLeaveCounts")
{
	$retarr = $dbobj->loadResourceLeaveCounts();
	echo json_encode($retarr);
}
else if($action == "loadResourceLeaveCounts1")
{
	$eid = $_REQUEST['eid'];	
	$retarr = $dbobj->loadResourceLeaveCounts1($eid);
	echo json_encode($retarr);
}
else if($action == "addCompOffLeave")
{
	$retarr = $dbobj->addCompOffLeave($_REQUEST);
	echo json_encode($retarr);
}
else if($action == "loadCompOffLeaves")
{
	$retarr = $dbobj->loadCompOffLeaves();
	echo json_encode($retarr);
}
else if($action == "loadTodayLeaveList")
{
	$retarr = $dbobj->loadTodayLeaveList();
	echo json_encode($retarr);
}
else if($action == "loadUpcomingLeaveList")
{
	$retarr = $dbobj->loadUpcomingLeaveList();
	echo json_encode($retarr);
}


?>
