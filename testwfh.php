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
//ini_set("display_errors",0);
//$wfhObj->sendNewWFHRequestEmail($dbobj);
$wid = "WFH017";
$dbobj->approveOpenRequest($wid);



?>