<?php 

	ini_set("display_errors",1);
	include 'include/init.php';
	include_once 'dbcon/ITAdminMgmt.php';
	//require_once 'mail/ITRequestEmail.php';
	$dbobj = new ITAdminMgmt();
	$dbobj->connect();
	set_time_limit(0);
	ini_set("display_errors",0);
	
	
	$dbobj->updateRecords();
	

?>