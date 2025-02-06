<?php
ini_set("display_errors",0);

require_once 'mail/LeaveRequestEmail.php';
require_once 'mail/WFHRequestEmail.php';
include_once 'dbcon/DBConnection.php';

date_default_timezone_set('Asia/Kolkata');

$emailObj = new LeaveRequestEmail();
$wfhObj = new WFHRequestEmail();
$dbobj = new DBConnection();
$dbobj->connect();


$cnt=0;
while(1 > 0){
	
	
	if($cnt == 27){
		break;
	}
	
	$emailObj->sendNewLeaveRequestEmail($dbobj);
	$wfhObj->sendNewWFHRequestEmail($dbobj);
	
	sleep(1);
	
	$emailObj->sendUpdateLeaveRequestEmail($dbobj);
	$wfhObj->sendUpdateWFHRequestEmail($dbobj);
	
	sleep(1);
	
		
	$cnt++;
}







?>