<?php
include_once 'dbcon/DBConnection.php';
include 'include/pagination.php';
$dbobj = new DBConnection();
$dbobj->connect();

$forceno = $_REQUEST['forceno'];
$type = $_REQUEST['type'];

if($type == "getdata")
{
	$count = $dbobj->getAlertMessagesCount($forceno);
	echo $count;
}
else if($type == "updatedata")
{
	$dbobj->updateAlertMessages($forceno);
}
?>
