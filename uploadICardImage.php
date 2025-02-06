<?php
	//ini_set("display_errors",1);
	require_once 'dbcon/config.php';
	session_start();
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	

	
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{	
		$fileName = $_FILES['imagefile']['name'];
		$extenimg = $dbobj->getExtention($fileName);
		$extphoto = strtolower($extenimg);
		$newnm =$eid.".".$extphoto;
		$upload_file = "icardImage/".$newnm;
		//$dbobj->addDebugLogs("FileName:".$upload_file);
				
		if(strlen($fileName) > 0)
		{
			$status=1;
			$file = $_FILES['imagefile']['tmp_name'];
			$ret = move_uploaded_file($_FILES['imagefile']['tmp_name'], $upload_file);
			$log = $file.":::".$ret.":::".$upload_file;
			$dbobj->addDebugLogs("ICARDIMAGE:".$log);
		}
		$msg = "Successfully updated image for I-Card";
		$result = array("status"=>$status,"msg"=>$msg , "filename" => $upload_file);
		echo json_encode($result);
	}
	else{
		$status = 0;
		$msg = "Unable to upload image. Please try again.";
		$result = array("status"=>$status,"msg"=>$msg);
		echo json_encode($result);
		
	}
?>