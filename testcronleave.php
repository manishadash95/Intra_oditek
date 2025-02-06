<?php
ini_set("display_errors",0);

require_once 'mail/LeaveRequestEmail.php';
include_once 'dbcon/DBConnection.php';

date_default_timezone_set('Asia/Kolkata');

$emailObj = new LeaveRequestEmail();
$dbobj = new DBConnection();
$dbobj->connect();


$cnt=0;


$emailObj->sendNewLeaveRequestEmail($dbobj);

$emailObj->sendUpdateLeaveRequestEmail($dbobj);








?>