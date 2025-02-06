<?php

require_once 'mail/RequestEmail.php';
include_once 'dbcon/DBConnection.php';

date_default_timezone_set('Asia/Kolkata');

$emailObj = new RequestEmail();
$dbobj = new DBConnection();
$dbobj->connect();

	
	$date_numeric = date('j');
	$day_numeric = date('W');
	$hr_numeric = date('G');
	
	//Monthly Service :: Execute on month 1st day Midnight
	if($date_numeric == 1)
	{
		$dbobj->executeMonthlyCronService();
	}
	
	//Weekly Service :: Execute on Sunday Midnight
	if($day_numeric == 0)
	{
		$dbobj->executeWeeklyCronService();
	}
	
	//Daily Service :: Execute on Every Midnight
	if($hr_numeric == 0)
	{
		$dbobj->executeDailyCronService();
	}
	
	//Hourly Service :: Execute on Every hour
	$dbobj->executeHourlyCronService();


	
?>