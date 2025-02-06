<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$leaveTypeObj = $dbobj->getLeaveType();
	$eid = 	$_SESSION["emp_id"];
	
	$cleave = $dbobj->getAvailLeave($eid);
	
	
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>
<?php include 'imageupload/popimageupload.php' ?>


<?php 
	include 'leaveinfo.php';
?>

