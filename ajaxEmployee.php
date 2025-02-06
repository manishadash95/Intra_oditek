<?php
include_once 'dbcon/DBConnection.php';
include 'include/pagination.php';
$dbobj = new DBConnection();
$dbobj->connect();

$type = $_REQUEST['type'];


if($type == "passwdchange")
{
	$cpasswd = $_REQUEST['cpasswd'];
	$npasswd = $_REQUEST['npasswd'];
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->changeLoginPasswd($cpasswd,$npasswd,$eid);
	echo json_encode($retarr);
}

?>
