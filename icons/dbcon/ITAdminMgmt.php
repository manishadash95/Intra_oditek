<?php
ini_set("display_errors",0);
include '/var/www/intra/dbcon/DBConnection.php';
date_default_timezone_set('Asia/Kolkata');

ini_set("display_errors",0);

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
		$dbsql=mysql_query("select * from od_it_devicetype ORDER BY name asc");
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
	
	
	public function getAllDeviceService()
	{
		$getArray = array();
		$dbsql=mysql_query("select * from od_it_deviceservice order by name asc");
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
	
	public function getAllDeviceStatus()
	{
		$getArray = array();
		$dbsql=mysql_query("select * from od_it_devicestatus order by name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$itdata = new ITData();
				if($row['id'] == 3 || $row['id'] == 5 || $row['id'] == 7 )
					continue;
				$itdata->id = $row['id'];
				$itdata->name = $row['name'];
				$getArray[] = $itdata;
			}
		}
		return $getArray;
	}
	
	public function getDeviceServiceById($id)
	{
		$name = "NA";
		$dbsql=mysql_query("select * from od_it_deviceservice where id='".$id."'");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$name = $row['name'];
			}
		}
		return $name;
	}
		
	
	
	public function getAllManifacture()
	{
		$getArray = array();	
		$dbsql=mysql_query("select * from od_it_manifacture ORDER BY name asc");
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
	
	
	public function getManifactureById($id)
	{
		$dbsql=mysql_query("select * from od_it_manifacture where id='".$id."'  ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$name = $row['name'];
			}
		}
		return $name;
	}
	
	
	public function getAllHDDName()
	{
		$getArray = array();	
		$dbsql=mysql_query("select * from od_it_hdd_name ORDER BY name asc");
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
	
	
	public function updateITRecordsLogs($tid,$msg,$mod_by)
	{
		$today = date("d-m-Y, h:i:s A");
		$query = "INSERT into od_it_records_update_logs set date='".$today."' , tid='".$tid."', logs='".$msg."' , mod_by='".$mod_by."' ";
		$res = mysql_query($query);
	}


	
	public function addLaptopDevice($data)
	{
		$mod_eid = $_SESSION["emp_id"];
		$tid = 	"IT/LP/".$data['tagid'];
		if($mod_eid > 0)
		{	
			$date_time = date("d-m-Y, h:i:s A");
			$device_type = 	$data['hdevice'];
			
			$hostname = $data['hostname'];
			$manifacture = $data['manifacture'];
			$model = $data['model'];
			$serialno = $data['serialno'];
			$expressno = $data['expressno'];
			$dop = $data['dop'];
			$doe = $data['doe'];
			$processor = $data['processor'];
			$hdd = $data['hdd'];
			$ramsize = $data['ramsize'];
			$ostype = $data['ostype'];
			$osname = $data['osname'];
			
			$dbsql=mysql_query("select * from  od_it_device_list where tid='".$tid."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				$status = 0;
				$msg = "Error!, Tag id is already exists.";
				$this->updateITRecordsLogs($tid,"addLaptopDevice::Failure::".$msg,$mod_eid);
				$result = array("status"=>$status,"msg"=>$msg);
				return $result;
			}

			
			$query = "INSERT INTO od_it_device_list set date='".$date_time."' , type='".$device_type."' , tid='".$tid."' , service='1' , status='1'  , 	eid='".$mod_eid."'  ";
			$res = mysql_query($query);		
			if($res)
			{
				$query = "INSERT INTO od_it_laptop_list set tid='".$tid."' , hostname='".$hostname."' , manifacture='".$manifacture."' , model='".$model."' , 	serial='".$serialno."'  , express='".$expressno."' , dop='".$dop."' , dow='".$doe."' , processor='".$processor."' , hdd='".$hdd."' , ram='".$ramsize."' , ostype='".$ostype."' , osname='".$osname."' ";
				$res = mysql_query($query);
				$db_id = mysql_insert_id();
				if($res)
				{
					$qry=mysql_query("UPDATE od_it_device_list set dbid ='".$db_id."' where tid='".$tid."'");
					$this->updateITRecordsLogs($tid,"addLaptopDevice::Success",$mod_eid);
					$status = 1;
					$msg = "Succesfully Enrolled New Laptop Device of tag id:\"".$tid."\".";
				}
				else{
					$msg = "Error1!, Something went wrong. Try again.";
					$this->updateITRecordsLogs($tid,"addLaptopDevice::Failure::".$msg,$mod_eid);
					$status = 0;
					
				}
			}else{
				
			}
		}
		else{
			$status = 0;
			$msg = "Error2!, Something went wrong. Try again.";
			$this->updateITRecordsLogs($tid,"addLaptopDevice::Failure::".$msg,$mod_eid);
		}
		
		$result = array("status"=>$status,"msg"=>$msg);
		return $result;
	}
	
	
	public function addDesktopDevice($data)
	{
		$mod_eid = $_SESSION["emp_id"];
		$tid = 	"IT/DT/".$data['tagid'];
		if($mod_eid > 0)
		{	
			$date_time = date("d-m-Y, h:i:s A");
			$device_type = 	$data['hdevice'];
			
			$hostname = $data['hostname'];
			$manifacture = $data['manifacture'];
			$model = $data['model'];
			$serialno = $data['serialno'];
			$expressno = $data['expressno'];
			$dop = $data['dop'];
			$doe = $data['doe'];
			$processor = $data['processor'];
			$hdd = $data['hdd'];
			$ramsize = $data['ramsize'];
			$ostype = $data['ostype'];
			$osname = $data['osname'];
			
			$dbsql=mysql_query("select * from  od_it_device_list where tid='".$tid."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				$status = 0;
				$msg = "Error!, Tag id is already exists.";
				$this->updateITRecordsLogs($tid,"addDesktopDevice::Failure::".$msg,$mod_eid);
				$result = array("status"=>$status,"msg"=>$msg);
				return $result;
			}

			
			$query = "INSERT INTO od_it_device_list set date='".$date_time."' , type='".$device_type."' , tid='".$tid."' , service='1' , status='1'  , 	eid='".$mod_eid."'  ";
			$res = mysql_query($query);		
			if($res)
			{
				$query = "INSERT INTO od_it_desktop_list set tid='".$tid."' , hostname='".$hostname."' , manifacture='".$manifacture."' , model='".$model."' , 	serial='".$serialno."'  , express='".$expressno."' , dop='".$dop."' , dow='".$doe."' , processor='".$processor."' , hdd='".$hdd."' , ram='".$ramsize."' , ostype='".$ostype."' , osname='".$osname."' ";
				$res = mysql_query($query);
				$db_id = mysql_insert_id();
				if($res)
				{
					$qry=mysql_query("UPDATE od_it_device_list set dbid ='".$db_id."' where tid='".$tid."'");
					$this->updateITRecordsLogs($tid,"addDesktopDevice::Success",$mod_eid);
					$status = 1;
					$msg = "Succesfully Enrolled New Desktop Device of tag id:\"".$tid."\".";
				}
				else{
					$msg = "Error1!, Something went wrong. Try again.";
					$this->updateITRecordsLogs($tid,"addDesktopDevice::Failure::".$msg,$mod_eid);
					$status = 0;
					
				}
			}else{
				
			}
		}
		else{
			$status = 0;
			$msg = "Error2!, Something went wrong. Try again.";
			$this->updateITRecordsLogs($tid,"addDesktopDevice::Failure::".$msg,$mod_eid);
		}
		
		$result = array("status"=>$status,"msg"=>$msg);
		return $result;
	}
	
	public function getLaptopDeviceInfo($tid)
	{
		$deviceObj =new ITData();
		$deviceObj->dbstatus = 0;
		$dbsql = "select * from od_it_laptop_list where tid ='".$tid."' order by id desc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);
		if($Num)
		{
			$row1 = mysql_fetch_array($dbres);
			$deviceObj->dbstatus = 1;
			$deviceObj->hostname = $row1['hostname'];
			$deviceObj->manifacture = $row1['manifacture'];
			$deviceObj->model = $row1['model'];
			$deviceObj->serial = $row1['serial'];
			$deviceObj->express = $row1['express'];
			$deviceObj->dop = $row1['dop'];
			$deviceObj->dow = $row1['dow'];
			$deviceObj->processor = $row1['processor'];
			$deviceObj->hdd = $row1['hdd'];
			$deviceObj->ram = $row1['ram'];
			$deviceObj->ostype = $row1['ostype'];
			$deviceObj->osname = $row1['osname'];
		}
		
		return $deviceObj;
	}
	
	
	public function getDesktopDeviceInfo($tid)
	{
		$deviceObj =new ITData();
		$deviceObj->dbstatus = 0;
		$dbsql = "select * from od_it_desktop_list where tid ='".$tid."' order by id desc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);
		if($Num)
		{
			$row1 = mysql_fetch_array($dbres);
			$deviceObj->dbstatus = 1;
			$deviceObj->hostname = $row1['hostname'];
			$deviceObj->manifacture = $row1['manifacture'];
			$deviceObj->model = $row1['model'];
			$deviceObj->serial = $row1['serial'];
			$deviceObj->express = $row1['express'];
			$deviceObj->dop = $row1['dop'];
			$deviceObj->dow = $row1['dow'];
			$deviceObj->processor = $row1['processor'];
			$deviceObj->hdd = $row1['hdd'];
			$deviceObj->ram = $row1['ram'];
			$deviceObj->ostype = $row1['ostype'];
			$deviceObj->osname = $row1['osname'];
		}
		
		return $deviceObj;
	}
	
	
	public function getDeviceDetails($id)
	{
		
		$dbsql=mysql_query("select * from  od_it_device_list where id='".$id."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			
			$type = $row['type'];
			$tid = $row['tid'];
			$dbid = $row['dbid'];
			$service = $row['service'];
			$dstatus = $row['status'];
			$service_str = $this->getDeviceServiceById($service);
			$status_str = $this->getDeviceStatusById($dstatus);
			$data = array("status" => 1 , "db_id" => $dbid , "tid" => $tid , "service" => $service ,"service_str" => $service_str , "dstatus" => $dstatus , "status_str" => $status_str);
			
			if($type == 1) //Laptop
			{	
				$deviceDb = $this->getLaptopDeviceInfo($tid);
				$data['type'] = $type;
				$data['type_str'] = $this->getDeviceTypeNameById($type);
				$data['hostname'] = $deviceDb->hostname;
				$data['manifacture'] = $deviceDb->manifacture;
				$data['manifacture_str'] =  $this->getManifactureById($data['manifacture']);
				$data['model'] = $deviceDb->model;
				$data['serial'] = $deviceDb->serial;
				$data['express'] = $deviceDb->express;
				$data['dop'] = $deviceDb->dop;
				$data['dow'] = $deviceDb->dow;
				$data['processor'] = $deviceDb->processor;
				$data['hdd'] = $deviceDb->hdd;
				$data['ram'] = $deviceDb->ram;
				$data['ostype'] = $deviceDb->ostype;
				$data['osname'] = $deviceDb->osname;
			}
			else if($type == 2) //Desktop
			{	
				$deviceDb = $this->getDesktopDeviceInfo($tid);
				$data['type'] = $type;
				$data['type_str'] = $this->getDeviceTypeNameById($type);
				$data['hostname'] = $deviceDb->hostname;
				$data['manifacture'] = $deviceDb->manifacture;
				$data['manifacture_str'] =  $this->getManifactureById($data['manifacture']);
				$data['model'] = $deviceDb->model;
				$data['serial'] = $deviceDb->serial;
				$data['express'] = $deviceDb->express;
				$data['dop'] = $deviceDb->dop;
				$data['dow'] = $deviceDb->dow;
				$data['processor'] = $deviceDb->processor;
				$data['hdd'] = $deviceDb->hdd;
				$data['ram'] = $deviceDb->ram;
				$data['ostype'] = $deviceDb->ostype;
				$data['osname'] = $deviceDb->osname;
			}			
		}
		
		return $data;
	}
	
	
	public function getAllotDeviceDetails($id)
	{
		
		$dbsql=mysql_query("select * from  od_it_device_list where id='".$id."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			
			$device = new ITData();
			
			$device->type = $row['type'];
			$device->type_str = $this->getDeviceTypeNameById($device->type);
			$device->tid = $row['tid'];
			$device->dbid = $row['dbid'];
			$device->service = $row['service'];
			$device->status = $row['status'];
			$device->assigned = $row['assigned'];
			$device->itr = $row['itr'];
			if($device->itr > 0)
				$device->openitreq = "#IT".$device->itr; 
			else
				$device->openitreq = "NA";
			
			$device->assignedTo = "Free";
			if($device->assigned > 0)
				$device->assignedTo = $this->getEmpName($device->assigned);
			
			$device->service_str = $this->getDeviceServiceById($device->service);
			$device->status_str = $this->getDeviceStatusById($device->status);
			$device->dataArray = array();
			
			if($device->type == 1) //Laptop
			{	
				$deviceDb = $this->getLaptopDeviceInfo($device->tid);
				
				$device->hostname = $deviceDb->hostname;
				$device->manifacture = $deviceDb->manifacture;
				$device->manifacture_str =  $this->getManifactureById($device->manifacture);
				$device->model = $deviceDb->model;
				$device->serial = $deviceDb->serial;
				$device->express = $deviceDb->express;
				$device->dop = $deviceDb->dop;
				$device->dow = $deviceDb->dow;
				$device->processor = $deviceDb->processor;
				$device->hdd = $deviceDb->hdd;
				$device->ram = $deviceDb->ram;
				$device->ostype = $deviceDb->ostype;
				$device->osname = $deviceDb->osname;
			}
			
			if($device->type == 2) //Desktop
			{	
				$deviceDb = $this->getDesktopDeviceInfo($device->tid);
				
				$device->hostname = $deviceDb->hostname;
				$device->manifacture = $deviceDb->manifacture;
				$device->manifacture_str =  $this->getManifactureById($device->manifacture);
				$device->model = $deviceDb->model;
				$device->serial = $deviceDb->serial;
				$device->express = $deviceDb->express;
				$device->dop = $deviceDb->dop;
				$device->dow = $deviceDb->dow;
				$device->processor = $deviceDb->processor;
				$device->hdd = $deviceDb->hdd;
				$device->ram = $deviceDb->ram;
				$device->ostype = $deviceDb->ostype;
				$device->osname = $deviceDb->osname;
			}

			//get allocation logs
			$dbsql=mysql_query("select * from od_it_deviceallot_log where tid='".$device->tid."' ORDER BY id DESC");
			$Num = mysql_num_rows($dbsql);	
			while($row = mysql_fetch_array($dbsql))
			{
				$data = new ITData();;
				$data->dataid = $row['id'];
				$data->date_updated = $row['date'];
				$data->emp_name = $this->getEmpName($row['eid']);
				$data->msg = stripslashes($row['msg']);
				$data->status_log = $row['status_log'];
				$device->dataArray[] =  $data;
			}	
			
		}
		
		return $device;
	}
	
	
	public function getAllotDeviceDetailsByTid($tid)
	{
		
		$dbsql=mysql_query("select * from  od_it_device_list where tid='".$tid."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			
			$device = new ITData();
			
			$device->type = $row['type'];
			$device->type_str = $this->getDeviceTypeNameById($device->type);
			$device->tid = $tid;
			$device->id = $row['id'];
			$device->dbid = $row['dbid'];
			$device->service = $row['service'];
			$device->status = $row['status'];
			$device->assigned = $row['assigned'];
			$device->itr = $row['itr'];
			$device->assignedTo = "Free";
			if($device->assigned > 0)
				$device->assignedTo = $this->getEmpName($device->assigned);
			
			$device->service_str = $this->getDeviceServiceById($device->service);
			$device->status_str = $this->getDeviceStatusById($device->status);
			$device->dataArray = array();
			
			if($device->type == 1) //Laptop
			{	
				$deviceDb = $this->getLaptopDeviceInfo($device->tid);
				
				$device->hostname = $deviceDb->hostname;
				$device->manifacture = $deviceDb->manifacture;
				$device->manifacture_str =  $this->getManifactureById($device->manifacture);
				$device->model = $deviceDb->model;
				$device->serial = $deviceDb->serial;
				$device->express = $deviceDb->express;
				$device->dop = $deviceDb->dop;
				$device->dow = $deviceDb->dow;
				$device->processor = $deviceDb->processor;
				$device->hdd = $deviceDb->hdd;
				$device->ram = $deviceDb->ram;
				$device->ostype = $deviceDb->ostype;
				$device->osname = $deviceDb->osname;
			}
			if($device->type == 2) //Desktop
			{	
				$deviceDb = $this->getDesktopDeviceInfo($device->tid);
				
				$device->hostname = $deviceDb->hostname;
				$device->manifacture = $deviceDb->manifacture;
				$device->manifacture_str =  $this->getManifactureById($device->manifacture);
				$device->model = $deviceDb->model;
				$device->serial = $deviceDb->serial;
				$device->express = $deviceDb->express;
				$device->dop = $deviceDb->dop;
				$device->dow = $deviceDb->dow;
				$device->processor = $deviceDb->processor;
				$device->hdd = $deviceDb->hdd;
				$device->ram = $deviceDb->ram;
				$device->ostype = $deviceDb->ostype;
				$device->osname = $deviceDb->osname;
			}

			//get allocation logs
			$dbsql=mysql_query("select * from od_it_deviceallot_log where tid='".$device->tid."' ORDER BY id DESC");
			$Num = mysql_num_rows($dbsql);	
			while($row = mysql_fetch_array($dbsql))
			{
				$data = new ITData();;
				$data->dataid = $row['id'];
				$data->date_updated = $row['date'];
				$data->emp_name = $this->getEmpName($row['eid']);
				$data->msg = stripslashes($row['msg']);
				$data->status_log = $row['status_log'];
				$device->dataArray[] =  $data;
			}	
			
		}
		
		return $device;
	}
	
	
	public function updateLaptopDevice($data)
	{
		$mod_eid = $_SESSION["emp_id"];
		$tid = 	$data['tagid'];
		if($mod_eid > 0)
		{	
			$date_time = date("d-m-Y, h:i:s A");
						
			$hostname = $data['hostname'];
			$manifacture = $data['manifacture'];
			$model = $data['model'];
			$serialno = $data['serialno'];
			$expressno = $data['expressno'];
			$dop = $data['dop'];
			$doe = $data['doe'];
			$processor = $data['processor'];
			$hdd = $data['hdd'];
			$ramsize = $data['ramsize'];
			$ostype = $data['ostype'];
			$osname = $data['osname'];
			
			$dbsql=mysql_query("select * from  od_it_device_list where tid='".$tid."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				$row = mysql_fetch_array($dbsql);
				
				$status = $row['status']; 
				
				$query = "INSERT INTO od_it_laptop_list set tid='".$tid."' , hostname='".$hostname."' , manifacture='".$manifacture."' , model='".$model."' , serial='".$serialno."'  , express='".$expressno."' , dop='".$dop."' , dow='".$doe."' , processor='".$processor."' , hdd='".$hdd."' , ram='".$ramsize."' , ostype='".$ostype."' , osname='".$osname."' ";
				$res = mysql_query($query);
				$db_id = mysql_insert_id();
				if($res)
				{
					$qry=mysql_query("UPDATE od_it_device_list set dbid ='".$db_id."' where tid='".$tid."'");
					$this->updateITRecordsLogs($tid,"updateLaptopDevice::Success",$mod_eid);
					$status = 1;
					$msg = "Succesfully Updated Laptop Device of tag id:\"".$tid."\".";
				}
				else{
					$msg = "Error1!, Something went wrong. Try again.";
					$this->updateITRecordsLogs($tid,"updateLaptopDevice::Failure::".$msg,$mod_eid);
					$status = 0;
					
				}
			}
			else{
				$msg = "Error2!, Something went wrong. Try again.";
				$this->updateITRecordsLogs($tid,"updateLaptopDevice::Failure::".$msg,$mod_eid);
				$status = 0;
				
			}
		}
		else{
			$status = 0;
			$msg = "Error3!, Something went wrong. Try again.";
			$this->updateITRecordsLogs($tid,"updateLaptopDevice::Failure::".$msg,$mod_eid);
			
		}
		$result = array("status"=>$status,"msg"=>$msg);
		return $result;
	}
	
	
	public function updateDesktopDevice($data)
	{
		$mod_eid = $_SESSION["emp_id"];
		$tid = 	$data['tagid'];
		if($mod_eid > 0)
		{	
			$date_time = date("d-m-Y, h:i:s A");
						
			$hostname = $data['hostname'];
			$manifacture = $data['manifacture'];
			$model = $data['model'];
			$serialno = $data['serialno'];
			$expressno = $data['expressno'];
			$dop = $data['dop'];
			$doe = $data['doe'];
			$processor = $data['processor'];
			$hdd = $data['hdd'];
			$ramsize = $data['ramsize'];
			$ostype = $data['ostype'];
			$osname = $data['osname'];
			
			$dbsql=mysql_query("select * from  od_it_device_list where tid='".$tid."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				$row = mysql_fetch_array($dbsql);
				
				$status = $row['status']; 
				
				$query = "INSERT INTO od_it_desktop_list set tid='".$tid."' , hostname='".$hostname."' , manifacture='".$manifacture."' , model='".$model."' , serial='".$serialno."'  , express='".$expressno."' , dop='".$dop."' , dow='".$doe."' , processor='".$processor."' , hdd='".$hdd."' , ram='".$ramsize."' , ostype='".$ostype."' , osname='".$osname."' ";
				$res = mysql_query($query);
				$db_id = mysql_insert_id();
				if($res)
				{
					$qry=mysql_query("UPDATE od_it_device_list set dbid ='".$db_id."' where tid='".$tid."'");
					$this->updateITRecordsLogs($tid,"updateDesktopDevice::Success",$mod_eid);
					$status = 1;
					$msg = "Succesfully Updated Laptop Device of tag id:\"".$tid."\".";
				}
				else{
					$msg = "Error1!, Something went wrong. Try again.";
					$this->updateITRecordsLogs($tid,"updateDesktopDevice::Failure::".$msg,$mod_eid);
					$status = 0;
					
				}
			}
			else{
				$msg = "Error2!, Something went wrong. Try again.";
				$this->updateITRecordsLogs($tid,"updateDesktopDevice::Failure::".$msg,$mod_eid);
				$status = 0;
				
			}
		}
		else{
			$status = 0;
			$msg = "Error3!, Something went wrong. Try again.";
			$this->updateITRecordsLogs($tid,"updateDesktopDevice::Failure::".$msg,$mod_eid);
			
		}
		$result = array("status"=>$status,"msg"=>$msg);
		return $result;
	}
	
	
	public function viewDeviceList($device)
	{
		$mod_eid = $_SESSION["emp_id"];
		if($mod_eid > 0)
		{	
			if(!$device)
				$dbstr = "select * from od_it_device_list order by tid desc";
			else
				$dbstr = "select * from od_it_device_list where type='".$device."' order by tid desc";
		
			$dbsql=mysql_query($dbstr);
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				$sl_no=0;
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$id = $row['id'];
					$type = $row['type'];
					$tid = $row['tid'];
					$status = $row['status'];
					$service = $row['service'];
					$dbid = $row['dbid'];
					$assigned = $row['assigned'];
					
					$iv_key = $this->get_mcrypt_iv();
					$encrypt_id = $this->get_mcrypt_encrypt($id,$iv_key);
					$encrypt_device = $this->get_mcrypt_encrypt($device,$iv_key);
					$encrypt_type = $this->get_mcrypt_encrypt($type,$iv_key);
	
	
					$type_str = $this->getDeviceTypeNameById($type);
					$service_str = $this->getDeviceServiceById($service);
					$status_str = $this->getDeviceStatusById($status);
					
					$assigned_to = "FREE";
					if($status == 4)
					{
						$assigned_to = $this->getEmpName($assigned);
					}
					if($status == 6)
					{
						$assigned_to = "Out of Service";
					}
					
					
					$deviceInfo = $this->getDeviceDetails($id);
					
					$manufacture = 	$deviceInfo['manifacture_str']."::".$deviceInfo['model'];				
					
					$italic="";
					if($service == 3)
					{
						$color =  "red";
						$italic="font-style: italic;";
					}
					
					if($status == 2) $color =  "green";
					else if($status == 4) $color =  "blue";
					else if($status == 5) $color =  "red";
					else if($status == 6) $color =  "red";
						
					$str .= '<tr class="success">
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$sl_no.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$type_str.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$tid.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$manufacture.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$service_str.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$status_str.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$assigned_to.'</td>
						<td  class="tooltip-sidebar-logout center_td">
						<a href="itadmin_devicedetail.php?id='.$encrypt_id.'&iv='.$iv_key.'&device='.$encrypt_device.'&type='.$encrypt_type.'  "  >
						<input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px">
						</td>
                        </tr>';				
				}
			}
			else{
				$str ='<tr><td class="center_td" colspan="7">No records found</td></tr>';
			}
		}
		$value = "";
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}


	public function allotDeviceList($device,$fservice,$fstatus,$reso_id)
	{
		$mod_eid = $_SESSION["emp_id"];
		if($mod_eid > 0)
		{	
			if(!$device)
				$dbstr = "select * from od_it_device_list order by tid desc";
			else
				$dbstr = "select * from od_it_device_list where type='".$device."' order by tid desc";
		
			$dbsql=mysql_query($dbstr);
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				$sl_no=0;
				while($row = mysql_fetch_array($dbsql))
				{
					
					$id = $row['id'];
					$type = $row['type'];
					$tid = $row['tid'];
					$status = $row['status'];
					$service = $row['service'];
					$dbid = $row['dbid'];
					$assigned = $row['assigned'];
					
					if($fstatus > 0 && $fstatus != $status )
						continue;
					
					if($fservice > 0 && $fservice != $service )
						continue;
					
					if($reso_id > 0 && $reso_id != $assigned )
						continue;
					
					
					$sl_no++;
					$iv_key = $this->get_mcrypt_iv();
					$encrypt_id = $this->get_mcrypt_encrypt($id,$iv_key);
					$encrypt_device = $this->get_mcrypt_encrypt($device,$iv_key);
					$encrypt_type = $this->get_mcrypt_encrypt($type,$iv_key);
					$encrypt_service = $this->get_mcrypt_encrypt($fservice,$iv_key);
					$encrypt_status = $this->get_mcrypt_encrypt($fstatus,$iv_key);
					$encrypt_resoid = $this->get_mcrypt_encrypt($reso_id,$iv_key);
	
	
					$type_str = $this->getDeviceTypeNameById($type);
					$service_str = $this->getDeviceServiceById($service);
					$status_str = $this->getDeviceStatusById($status);
					$assigned_to = "FREE";
					if($status == 4)
					{
						$assigned_to = $this->getEmpName($assigned);
					}
					if($status == 6)
					{
						$assigned_to = "Out of Service";
					}
					
					$deviceInfo = $this->getDeviceDetails($id);
					
					$manufacture = 	$deviceInfo['manifacture_str']."::".$deviceInfo['model'];				
					
					$italic="";
					if($service == 3)
					{
						$color =  "red";
						$italic="font-style: italic;";
					}
					
					if($status == 2) $color =  "green";
					else if($status == 4) $color =  "blue";
					else if($status == 5) $color =  "red";
					else if($status == 6) $color =  "red";
					else if($status == 8) $color =  "red";
						
					$str .= '<tr class="success">
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$sl_no.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$type_str.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$tid.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$manufacture.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$service_str.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$status_str.'</td>
						<td  class="center_td" style="color:'.$color.';'.$italic.'" >'.$assigned_to.'</td>
						<td  class="tooltip-sidebar-logout center_td">
						<a href="itadmin_allotdetailview.php?id='.$encrypt_id.'&iv='.$iv_key.'&device='.$encrypt_device.'&type='.$encrypt_type.'&service='.$encrypt_service.'&status='.$encrypt_status.'&resoid='.$encrypt_resoid.' "  >
						<input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px">
						</td>
                        </tr>';				
				}
			}
			else{
				$str ='<tr><td class="center_td" colspan="7">No records found</td></tr>';
			}
		}
		$value = "";
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}	
	
	 
	
	public function getNewDeviceList($device)
	{
		$str= '<option value="0">Select Device</option>';
		if($device)
			$dbsql=mysql_query("select * from od_it_device_list where type='".$device."' and service=1 and status=1 ORDER BY tid asc");
		else
			$dbsql=mysql_query("select * from od_it_device_list where service=1 and status=1 ORDER BY tid asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$str .= '<option value="'.$row['id'].'">'.$row['tid'].'</option>';
			}
		}
		$data=array("status"=>1,"data"=>$str);
		return $data;
	}
	
	
	public function enrollDevice($dbid)
	{
		$mod_eid = $_SESSION["emp_id"];
		if($mod_eid > 0)
		{	
			$dbsql=mysql_query("select * from  od_it_device_list where id='".$dbid."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				$row = mysql_fetch_array($dbsql);
				$tid = $row['tid'];
				$entry_date = date('d-m-Y, h:i:s A');
				$msg = "Enrolled new device.";
				$status_log = "[New => Available]";
				
				$allquery = "INSERT INTO od_it_deviceallot_log  set date='".$entry_date."', tid='".$tid."',  eid='".$mod_eid."' , status='2' , msg='".$msg."' , status_log='".$status_log."' ";
				$allres = mysql_query($allquery);
					
				$allquery = "UPDATE od_it_device_list set service='2' , status='2'  where id='".$dbid."' ";
				$allres = mysql_query($allquery);
				$msg = "Done!";
				$data=array("status"=>1,"msg"=>$msg);
			}
			else{
				$msg = "Error! Something went wrong!";
				$data=array("status"=>0,"msg"=>$msg);
			}
		}
		
		return $data;
	}
	
		
	public function updateRecords()
	{
		
		$dbsql=mysql_query("select * from od_it_device_list ORDER BY tid asc");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$dbid = $row['id'];
				$tid = $row['tid'];
				
				$deviceInfo = $this->getDeviceDetails($dbid);
				
				$dop = $deviceInfo['dop'];
				$entry_date = date('d-m-Y, h:i:s A', strtotime($dop));
				$msg = "Enrolled new device.";
				$status_log = "[New => Available]";
				
				$allquery = "INSERT INTO od_it_deviceallot_log  set date='".$entry_date."', tid='".$tid."',  eid='1001' , status='2' , msg='".$msg."' , status_log='".$status_log."' ";
				echo $allquery."<BR>";
				$allres = mysql_query($allquery);
				echo "::".$allres.":<BR>";
			}
			
		}
		
		
	}
	
	
	public function getDeviceUpdateStatus($tid)
	{
		$dbsql=mysql_query("select * from od_it_device_list where tid='".$tid."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$status = $row['status'];
			$service = $row['service'];
			$str='<option value="0">Select Status</option>';
			if($status == 2)  // available
			{
				$str.='<option value="3">'.$this->getDeviceStatusById(3).'</option>';
				$str.='<option value="8">'.$this->getDeviceStatusById(8).'</option>';
				$str.='<option value="6">'.$this->getDeviceStatusById(6).'</option>';				
			}
			else if($status == 4)  // Allocated
			{
				$str.='<option value="7">'.$this->getDeviceStatusById(7).'</option>';
				$str.='<option value="8">'.$this->getDeviceStatusById(8).'</option>';
			}
			else if($status == 8)  // Support
			{
				$str.='<option value="5">'.$this->getDeviceStatusById(5).'</option>';
			}
			else if($status == 6)  // Damaged
			{
				$str.='<option value="8">'.$this->getDeviceStatusById(8).'</option>';
			}
			
			
		}
		$data=array("status"=>1,"data"=>$str);
		return $data;
	}
	
	public function updateDeviceStatus($tid,$status,$reso_id,$desc,$itr_id)
	{
		$my_id = $_SESSION["emp_id"];
		if($my_id)
		{
			$itr=0;
			if($status == 3) // allocate
				$status = 4;
				
			if($status == 7) // deallocate
				$status = 2;	
				
			$deviceInfo = $this->getAllotDeviceDetailsByTid($tid);
			$current_date = $this->getCurrentDateTime();
			$desc = addslashes($desc);
			$last_status = $deviceInfo->status;
			$last_status_str = $this->getDeviceStatusById($last_status);
			$new_status_str = $this->getDeviceStatusById($status);
			
			if($status == 8)
			{
				$status_mod_str = "[".$new_status_str."]";
				$itr = $itr_id;
			}
			else{
				if($status > 0 && $last_status != $status)
					$status_mod_str = "[".$last_status_str." => ".$new_status_str."]";
				else
					$status_mod_str = "[".$last_status_str."]";
			}
			
			if($status == 4) // allocate
			{
				$qry=mysql_query("UPDATE od_it_device_list set date='".$current_date."' , status='".$status."' , assigned ='".$reso_id."' , eid='".$my_id."'  where  tid='".$tid."'");
				
				$qry = mysql_query("INSERT into od_it_device_reso_allot set date='".$current_date."' , tid='".$tid."', assigned='".$reso_id."' ");
			}
			else if($status == 6)//damaged
			{
				$qry=mysql_query("UPDATE od_it_device_list set date='".$current_date."' , status='".$status."' , service='3' , assigned ='".$reso_id."' , eid='".$my_id."'  where  tid='".$tid."'");
			}
			else if($status == 2){//Available
				
				$qry=mysql_query("UPDATE od_it_device_list set date='".$current_date."' , status='".$status."' , assigned='0'  ,eid='".$my_id."' where  tid='".$tid."'");
				
				$qry=mysql_query("delete from od_it_device_reso_allot where tid='".$tid."' ");
			}
			else if($status == 8){//Support
				
				$qry=mysql_query("UPDATE od_it_device_list set date='".$current_date."' , status='".$status."' , itr='".$itr."' , eid='".$my_id."' where  tid='".$tid."'");
					
			}
			else if($status == 5){//repaired
				if($deviceInfo->assigned > 0)
					$qry=mysql_query("UPDATE od_it_device_list set date='".$current_date."' , status='4' , itr='0' ,  eid='".$my_id."' where  tid='".$tid."'");
				else
					$qry=mysql_query("UPDATE od_it_device_list set date='".$current_date."' ,  itr='0' , status='2' , eid='".$my_id."' where  tid='".$tid."'");
				if($deviceInfo->itr > 0)
					$this->resolvedITRequest($deviceInfo->itr,$desc);
					
			}
			

			$query = "INSERT into od_it_deviceallot_log set date='".$current_date."' , status='".$status."', tid='".$tid."', itr='".$itr."' , eid='".$my_id."', msg='".$desc."' , email='1' , status_log='".$status_mod_str."' ";
			$res = mysql_query($query);
			$data_id = mysql_insert_id();
			if($res)
			{
				$msg = "Successfully updated Device Info";
				$data=array("status"=>1, "msg"=>$msg ,"tid"=>$tid, "dataid"=>$data_id );
			}
			else{
				$msg = "Unknown Error...";
				$data=array("status"=>0,"msg"=>$msg);
			}
		}
		else{
			$msg = "Unknown Error...";
			$data=array("status"=>0,"msg"=>$msg);
		}
			
		return $data;
	}
	
	
	public function resolvedITRequest($sid , $msg)
	{
		$eid = $_SESSION["emp_id"];
		if($eid > 0)
		{
			$date = date("d-m-Y, h:i:s A");
			$status_id = 5 ; // resolved
			$last_status = $this->getITReqStatus($sid);
			$last_status_str = $this->getITStatusString($last_status);
			$current_status_str = $this->getITStatusString($status_id);
			$status_mod_str = "[".$last_status_str." => ".$current_status_str."]";
			
			$qry=mysql_query("UPDATE od_it_request set status='".$status_id."' where sid='".$sid."'");
			$date_str =  strtotime($date);
			$qry=mysql_query("UPDATE od_it_request set cdate='".$date."' , cdate_str='".$date_str."' where sid='".$sid."'");
			
			$query = "INSERT into od_it_request_logs set date='".$date."' , sid='".$sid."', eid='".$eid."', msg='".$msg."' , email='1' , status_log='".$status_mod_str."' ";
			$res = mysql_query($query);
			
		}
	}
	
	public function getDeallocationStatus($eid)
	{
		$count=1;	
		$dbsql=mysql_query("select * from od_it_device_list where assigned='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num)
			$count = 0;		
		$data=array("status"=>1,"count"=>$count);
		return $data;
	}
	
	
	public function updateITExit($eid)
	{
		$count=1;	
		$dbsql=mysql_query("select * from od_emp_exit where eid='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if($row = mysql_fetch_array($dbsql))
		{
			$qry=mysql_query("UPDATE od_emp_exit set it_exit='1' where eid='".$eid."' ");
		}
		else{
			$qry=mysql_query("INSERT into od_emp_exit set it_exit='1' , eid='".$eid."' ");
		}
		$data=array("status"=>1,"msg"=>"");
		return $data;
	}
	
	public function updateAdminExit($eid)
	{
		$count=1;	
		$dbsql=mysql_query("select * from od_emp_exit where eid='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if($row = mysql_fetch_array($dbsql))
		{
			$qry=mysql_query("UPDATE od_emp_exit set admin_exit='1' where eid='".$eid."' ");
		}
		else{
			$qry=mysql_query("INSERT into od_emp_exit set admin_exit='1' , eid='".$eid."' ");
		}
		$data=array("status"=>1,"msg"=>"");
		return $data;
	}
	
	public function updateBUExit($eid)
	{
		$count=1;	
		$dbsql=mysql_query("select * from od_emp_exit where eid='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if($row = mysql_fetch_array($dbsql))
		{
			$qry=mysql_query("UPDATE od_emp_exit set bu_exit='1' where eid='".$eid."' ");
		}
		else{
			$qry=mysql_query("INSERT into od_emp_exit set bu_exit='1' , eid='".$eid."' ");
		}
		$data=array("status"=>1,"msg"=>"");
		return $data;
	}
	
	public function checkEmpExitStatus($eid)
	{
		$dbsql=mysql_query("select * from od_emp_exit where eid='".$eid."' and it_exit=1 ");
		$Num = mysql_num_rows($dbsql);
		if($Num)
			$data=array("status"=>1,"msg"=>"");
		else
			$data=array("status"=>0,"msg"=>"");
		
		return $data;
	}
	
	public function checkEmpBUExitStatus($eid)
	{
		$dbsql=mysql_query("select * from od_emp_exit where eid='".$eid."' and bu_exit=1 ");
		$Num = mysql_num_rows($dbsql);
		if($Num)
			$data=array("status"=>1,"msg"=>"");
		else
			$data=array("status"=>0,"msg"=>"");
		
		return $data;
	}
		
	
}//class END
?>