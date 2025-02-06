<?php
ini_set("display_errors",0);
include_once 'dbcon/DBConnection.php';
session_start();
include 'include/pagination.php';
include_once 'dbcon/LeaveRecordExcelGenerator.php';
$dbobj = new DBConnection();
$excelobj = new LeaveRecordExcelGenerator($dbobj);
$dbobj->connect();
ini_set("display_errors",0);
$action = $_REQUEST['action'];


if($action == "totaldays")
{
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$type = $_REQUEST['type'];
	$retarr = $dbobj->calculateTotalDays($type,$sdate,$edate);
	echo json_encode($retarr);
}
else if($action == "getLeaveCnt")
{
	$type = $_REQUEST['type'];
	$eid = $_SESSION["emp_id"];
	$retarr = $dbobj->getAllAvailableLeave($type,$eid);
	echo json_encode($retarr);
}

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


else if($action == "loadMyOpenLeaveRequest")
{
	$retarr = $dbobj->loadMyOpenLeaveRequest();
	echo json_encode($retarr);
}
else if($action == "loadMyClosedLeaveRequest")
{
	$retarr = $dbobj->loadMyClosedLeaveRequest();
	echo json_encode($retarr);
}
else if($action == "loadMyReviewLeaveRequest")
{
	$retarr = $dbobj->loadMyReviewLeaveRequest();
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
else if($action == "loadResoLeaveRecords")
{
	$eid = $_REQUEST['eid'];
	$year = date("Y");
	$retarr = $dbobj->loadResoLeaveRecords($eid,$year);
	echo json_encode($retarr);
}
else if($action == "loadResoAllLeaveRequest")
{
	$eid = $_REQUEST['eid'];
	$year = date("Y");
	$retarr = $dbobj->loadResoAllLeaveRequest($eid,$year);
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
else if($action == "loadResourceAttedance")
{
	$date = $_REQUEST['date'];
	$category = $_REQUEST['category'];
	$status = $_REQUEST['status'];	
	$retarr = $dbobj->loadResourceAttendance($date,$category,$status);
	echo json_encode($retarr);
}
else if($action == "generateLeaveSummary")
{	
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$emp_id= $_REQUEST['emp_id'];
	$result = $excelobj->generateLeaveSummaryReport($start_date,$end_date,$emp_id);
	echo json_encode($result);
}
else if($action == "generateLeaveDetails")
{	
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$emp_id= $_REQUEST['emp_id'];
	$result = $excelobj->generateLeaveDetailsReport($start_date,$end_date,$emp_id);
	echo json_encode($result);
}
else if($action == "generateAbsentDetails")
{	
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$emp_id= $_REQUEST['emp_id'];
	$result = $excelobj->generateAbsentDetailsReport($start_date,$end_date,$emp_id);
	echo json_encode($result);
}
else if($action == "getAttendanceEditData")
{	
	$id = $_REQUEST['id'];
	$result = $dbobj->getAttendanceEditData($id);
	echo json_encode($result);
}
else if($action == "updateAttendanceData")
{	
	$id = $_REQUEST['id'];
	$in_time = $_REQUEST['in_time'];
	$out_time = $_REQUEST['out_time'];
	$result = $dbobj->updateAttendanceData($id,$in_time,$out_time);
	echo json_encode($result);
}
else if($action == "getAttendanceInfo")
{	
	$monthid = $_REQUEST['monthid'];
	$statusid = $_REQUEST['statusid'];
	$eid = $_REQUEST['eid'];
	$edit = $_REQUEST['edit'];
	$result = $dbobj->getAttendanceInfo($monthid,$statusid,$eid,$edit);
	echo json_encode($result);
}
else if($action == "getMyAttendanceInfo")
{	
	$monthid = $_REQUEST['monthid'];
	$statusid = $_REQUEST['statusid'];
	$result = $dbobj->getMyDailySummaryData($monthid,$statusid);
	echo json_encode($result);
}


?>
