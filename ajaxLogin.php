<?php
require_once 'dbcon/config.php';
session_start();
include_once 'dbcon/DBConnection.php';
$dbobj = new DBConnection();
$dbobj->connect();
set_time_limit(0);

ini_set("display_errors",0);



$action = $_REQUEST['action'];
switch ($action) 
{
	case 'resetPassword':
	$email = $_REQUEST['email'];
	$result = $dbobj->checkEmailForgotPasswd($email);
	echo json_encode($result);
	break;
	
	case 'updatePassword':
	$otp = $_REQUEST['otp'];
	$passwd = $_REQUEST['passwd'];
	$email = $_REQUEST['email'];
	$result = $dbobj->updateNewPasswd($email,$otp,$passwd);
	echo json_encode($result);
	break;
	
		
}
?>