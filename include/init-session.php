<?php
require_once 'dbcon/config.php';
session_start();
$empname=$_SESSION["emp_name"];
$empid=$_SESSION["emp_id"];

if (!$_SESSION["emp_id"])
{
   $_SESSION["keep"] = 1;	
   header("Location:logout.php");
}
$msg="";	
	
if(isset($_SESSION['userstart']) ) {
	$session_life = time() - $_SESSION['userstart'];
	if($session_life > SESSION_INACTIVE){
		$_SESSION["keep"] = 1;
		header("Location: logout.php?show=1");
	}
}

$_SESSION['userstart'] = time();

?>