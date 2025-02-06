<html>
<head>


</head>


<body>
<?php
include 'include/init.php';
include_once 'dbcon/DBConnection.php';

$dbobj = new DBConnection();
$dbobj->connect();
$year=$_REQUEST["year"];
$type=$_REQUEST["type"];

if($type == "PART-A")
{
	$forceno = 	$_SESSION["forceno"];
	$panno = $dbobj->getPANNo($forceno);
	$file_name = $panno."_".$year.".pdf";
	$path = FORM16_URL.$year."/PART-A/".$file_name;
	if(file_exists($path))
	{
		header('Content-type: application/pdf');
		readfile($path);
	}
}
else if($type == "PART-B")
{
	$forceno = 	$_SESSION["forceno"];
	$file_name = $forceno.".pdf";
	$path = FORM16_URL.$year."/PART-B/".$file_name;
	if(file_exists($path))
	{
		header('Content-type: application/pdf');
		readfile($path);
	}
	
}
else
{
	echo "Error in loading file...";
}

?>
</body>

</html>