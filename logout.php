<?php
	
	ini_set("display_errors",0);
	session_start();
	$last_page = $_SESSION["pageid"];
	$keep = $_SESSION["keep"];
	if(!$keep)
		$last_page="";
	session_unset();
	session_destroy();
	include_once 'dbcon/config.php';
	include_once 'dbcon/DBConnection.php';
	
	$dbobj = new DBConnection();
	$dbobj->connect();	
	
	if(strlen($last_page) > 0)
	{
		$iv = $dbobj->get_mcrypt_iv();
		$encrypted_string = $dbobj->get_mcrypt_encrypt($last_page,$iv ); 
		header("Location:".USER_SITE_URL."?pageid=".$encrypted_string."&iv=".$iv);
		
	}else{
		header("Location:".USER_SITE_URL);
	}
	
	
	

?>