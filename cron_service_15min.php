<?php

require_once 'mail/RequestEmail.php';
include_once 'dbcon/DBConnection.php';

date_default_timezone_set('Asia/Kolkata');

$emailObj = new RequestEmail();
$dbobj = new DBConnection();
$dbobj->connect();

	
	//15 min Service
	$dbobj->executeCronService15Min();


	
?>