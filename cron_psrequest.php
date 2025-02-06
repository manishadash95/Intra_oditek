<?php
ini_set("display_errors",1);

require_once 'mail/PSRequestEmail.php';
include_once 'dbcon/DBConnection.php';

date_default_timezone_set('Asia/Kolkata');

$emailObj = new PSRequestEmail();
$dbobj = new DBConnection();
$dbobj->connect();


$cnt=0;
while(1 > 0){
	
	
	
	if($cnt == 27){
		break;
	}
	
	$emailObj->sendNewPSRequestEmail($dbobj);
	
	
	sleep(2);
	
	$emailObj->sendUpdateITRequestEmail($dbobj);
	
	$cnt++;
}


//$emailObj->sendNewPSRequestEmail($dbobj);
//$emailObj->sendUpdateITRequestEmail($dbobj);





?>