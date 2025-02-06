<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
	include_once 'admin/dbcon/config.php';
	error_reporting(0);
	$con = mysql_connect(DB_HOST,DB_USER, DB_PASSWORD) or die( "Unable to connect to database");
	if (!$con)
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db(DB_DATABASE, $con)  or die( "Unable to select database");
	define("USER_SITE_URL", "localhost/ndrf/");
	define("ADMIN_SITE_URL", "localhost/ndrf/admin/");
	define("PREFIX", "ndr_");
 ?>