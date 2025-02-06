<?php

	$fileName1 = $_FILES['file1']['name'];
	$fileName2 = $_FILES['file2']['name'];
	$fileName3 = $_FILES['file3']['name'];
	
	$imprid = $_POST['imprid'];
	$dataid = $_POST['dataid'];
	
	$sid_path  = "upload_impr/".$imprid;
	if(!is_dir($sid_path))
	{
		mkdir($sid_path, 0777);
	}
	$data_path  = "upload_pr/".$imprid."/".$dataid;
	if(!is_dir($data_path))
	{
		mkdir($data_path, 0777);
	}
	
	if(strlen($fileName1) > 0)
	{
		$status=1;
		$file_name = $_FILES['file1']['name'];
		$file_name = str_replace(' ', '-', $file_name);	
		move_uploaded_file($_FILES['file1']['tmp_name'], $data_path.'/' . $file_name);
	}
	
	if(strlen($fileName2) > 0)
	{
		$status=1;
		$file_name = $_FILES['file2']['name'];
		$file_name = str_replace(' ', '-', $file_name);			
		move_uploaded_file($_FILES['file2']['tmp_name'], $data_path.'/' . $file_name);
	}
	
	if(strlen($fileName3) > 0)
	{
		$status=1;
		$file_name = $_FILES['file3']['name'];
		$file_name = str_replace(' ', '-', $file_name);		
		move_uploaded_file($_FILES['file3']['tmp_name'], $data_path.'/' . $file_name);
	}
	
	
	
	$result = array("status"=>$status,"msg"=>$msg);
	echo json_encode($result);
?>