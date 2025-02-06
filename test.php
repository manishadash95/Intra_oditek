<?php 

	require_once 'mail/LeaveRequestEmail.php';
	require_once 'mail/WFHRequestEmail.php';
	include_once 'dbcon/DBConnection.php';

	date_default_timezone_set('Asia/Kolkata');

	$emailObj = new LeaveRequestEmail();
	$wfhObj = new WFHRequestEmail();
	$dbobj = new DBConnection();
	$dbobj->connect();

	set_time_limit(0);
	ini_set("display_errors",0);
	
	$emailObj->sendNewLeaveRequestEmailTest($dbobj);
	

?>


