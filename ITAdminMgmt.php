<?php
ini_set("display_errors",0);
require_once 'dbcon/config.php';
include_once 'dbcon/DBConnection.php';

date_default_timezone_set('Asia/Kolkata');


class ITData {
	
   
	
}


class ITAdminMgmt  extends DBConnection
{

	function __construct() {
		
    }
	
    // destructor
    function __destruct() {
       
    }	
	
	public function getCurrentDateTime(){
		return $date=date("d-m-Y h:i A");
	}	
	
	
	
///GENERIC FUNCTIONS
	
	public function getAllDeviceType()
	{
		$getArray = array();	
		$dbsql=mysql_query("select * from od_it_devicetype ORDER BY id asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$itdata = new ITData();
				$itdata->id = $row['id'];
				$itdata->name = $row['name'];
				$getArray[] = $itdata;
			}
		}
				
		
		return $getArray;
	}
	
	
	
	public function getAllManifacture()
	{
		$getArray = array();	
		$dbsql=mysql_query("select * from od_it_manifacture_lap ORDER BY id asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$itdata = new ITData();
				$itdata->id = $row['id'];
				$itdata->name = $row['name'];
				$getArray[] = $itdata;
			}
		}
				
		
		return $getArray;
	}
	
	
	public function getAllHDDName()
	{
		$getArray = array();	
		$dbsql=mysql_query("select * from od_it_hdd_name ORDER BY id asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$itdata = new ITData();
				$itdata->id = $row['id'];
				$itdata->name = $row['name'];
				$getArray[] = $itdata;
			}
		}
				
		
		return $getArray;
	}
	
	

}
?>