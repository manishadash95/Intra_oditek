<?php 

ini_set("display_errors",0);
include 'include/init.php';
include_once 'dbcon/DBConnection.php';
$dbobj = new DBConnection();
$dbobj->connect();

set_time_limit(0);

ini_set("display_errors",0);
 
 $date = $_REQUEST['date'];
 $eid = $_REQUEST['eid'];
 if($date=="")
 {
	 echo "Please add date(DD-MM-YYYY) format";
 }
 
 
 $dbobj->getMarixDailyData($date,$eid);
 

	
 
 
			
 
?>