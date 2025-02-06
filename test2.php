<?php 

	ini_set("display_errors",1);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	//require_once 'mail/ITRequestEmail.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	set_time_limit(0);
	ini_set("display_errors",1);
	
	//$str = "oditek123@";
	//$cpasswd = $_REQUEST['passwd'];
	//$sha = sha1(trim($str));
	//echo $str."::".$sha;
	
	//$dbobj->updateAllPasswd();
	//$dbobj->updateAllPasswd();
	
	
	$email = "biswaranjan.parida@oditeksolutions.com,girija.mallick@oditeksolutions.com,arabinda.nanda@oditeksolutions.com";
	$email2 = "girija.mallick@oditeksolutions.com";
	$pos = strpos($email, $email2);
	if($pos === false) {
		echo $email2." is not present inside :".$email;
	}
	else{
		echo $email2." is present inside :".$email;
	}


?>