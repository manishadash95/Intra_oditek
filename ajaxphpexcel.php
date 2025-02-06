<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);
include 'include/init.php';
require_once 'dbcon/config.php';
include_once 'dbcon/DBConnection.php';
include_once 'dbcon/PHPExcelGenerator.php';
$dbobj = new DBConnection();
$excelobj = new PHPExcelGenerator($dbobj);
$dbobj->connect();
set_time_limit(0);



$action = $_REQUEST['action'];
switch ($action) 
{
		
	
	
	case 'generateEmployeeCovidReport':
	$result = $excelobj->generateEmployeeCovidReport();
	echo json_encode($result);
	break;
	
	case 'generatehrreport':
	$cus_id = $_REQUEST['cus_id'];
	$grp_id = $_REQUEST['grp_id'];
	$pro_id = $_REQUEST['pro_id'];
	$task_id = $_REQUEST['task_id'];
	$reso_id = 0;//$_REQUEST['reso_id'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	
	$result = $excelobj->generateHRProjectReport($cus_id,$grp_id,$pro_id,$task_id,$reso_id,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	case 'generateresoreport':
	$team_id = $_REQUEST['team_id'];
	$pro_id = $_REQUEST['pro_id'];
	$task_id = $_REQUEST['task_id'];
	$reso_id = $_REQUEST['reso_id'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	
	$result = $excelobj->generateResoProjectReport($team_id,$pro_id,$task_id,$reso_id,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	case 'generateprotaskreport':
	$pro_id = $_REQUEST['pro_id'];
	$grp_id = $_REQUEST['grp_id'];
	$result = $excelobj->generateProjectTaskReport($pro_id,$grp_id);
	echo json_encode($result);
	break;
	
	case 'generateEmployeeData':
	$rank = $_REQUEST['deg_id'];
	$dept_id = $_REQUEST['dep_id'];
	$status = $_REQUEST['status'];
	$bu_id = $_REQUEST['bu_id'];
	$type = $_REQUEST['type'];
	$result = $excelobj->generateEmployeeData($rank,$dept_id,$status,$bu_id,$type);
	echo json_encode($result);
	break;
	
	case 'generateImprovementReport':
        $pro = $_REQUEST['pro'];
        $typ = $_REQUEST['typ'];
        $res = $_REQUEST['res'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        $result = $excelobj->generateImprovementReport($pro, $typ, $res, $start_date, $end_date);
        echo json_encode($result);
        break;
	
	
	case 'generatePurchaseReport':
	$bu = $_REQUEST['bu_head'];
	$pr = $_REQUEST['pr_head'];
	$sdate = $_REQUEST['start_date'];
	$edate = $_REQUEST['end_date'];
	$result = $excelobj->generatePurchaseReport($bu,$pr,$sdate,$edate);
	echo json_encode($result);
	break;
	
	case 'generateITReport':
	
	$pro = $_REQUEST['pro'];
	$sdate = $_REQUEST['start_date'];
	$edate = $_REQUEST['end_date'];
	$result = $excelobj->generateITReport($pro,$sdate,$edate);
	echo json_encode($result);
	break;
	
	
	
	case 'generateinvoicereport':
	$cus_id = $_REQUEST['cus_id'];
	$pro_id = $_REQUEST['pro_id'];
	$inv_type = $_REQUEST['inv_type'];
	$inv_status = $_REQUEST['inv_status'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$result = $excelobj->generateInvoiceReport($cus_id,$pro_id,$inv_type,$inv_status,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	
	case 'generatereceivedreport':
	$cus_id = $_REQUEST['cus_id'];
	$pro_id = $_REQUEST['pro_id'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$result = $excelobj->generateReceivedReport($cus_id,$pro_id,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	
	
	
}
?>