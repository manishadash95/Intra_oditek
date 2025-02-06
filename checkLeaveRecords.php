<?php 

	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	require_once 'mail/ITRequestEmail.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	set_time_limit(0);
	ini_set("display_errors",0);
	
	//check Leave Errors
	$year = 2023;
	$dbobj->checkLeaveRecords($year);
	


?>