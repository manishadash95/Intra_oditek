<?php
ini_set("display_errors",0);

require_once 'mail/ITRequestEmail.php';
include_once 'dbcon/DBConnection.php';

date_default_timezone_set('Asia/Kolkata');

$emailObj = new ITRequestEmail();
$dbobj = new DBConnection();
$dbobj->connect();


$cnt=0;
while(1 > 0){
	
	
	if($cnt == 27){
		break;
	}
	
	$emailObj->sendNewITRequestEmail($dbobj);
	
	
	sleep(1);
	
	$emailObj->sendUpdateITRequestEmail($dbobj);
	
	sleep(1);
	
	$emailObj->checkITRequestStatus($dbobj);
	
	$cnt++;
}







?>