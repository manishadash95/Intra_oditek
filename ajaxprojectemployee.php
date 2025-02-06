<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



require_once 'dbcon/config.php';
session_start();
include_once 'dbcon/DBConnection.php';
$dbobj = new DBConnection();
$dbobj->connect();
set_time_limit(0);

ini_set("display_errors",1);

if(isset($_SESSION['userstart']) ) {
	$session_life = time() - $_SESSION['userstart'];
	if($session_life > SESSION_INACTIVE){
		$value = "Session Expired. Please login again.";
		$result=array("status"=>0,"msg"=>$value );	
		echo json_encode($result);
		return;	
	}
}

$_SESSION['userstart'] = time();


ini_set("display_errors",0 );
$action = $_REQUEST['action'];
//print_r('action');
switch ($action) 
{
	
	
	case 'updateProfileFilename':
	$filename = $_REQUEST['filename'];
	$result = $dbobj->updateEmployeeImage($filename);
	echo json_encode($result);
	break;
		
	
	case 'updateICardImage':
	$filename = $_REQUEST['filename'];
	$result = $dbobj->updateICardImage($filename);
	echo json_encode($result);
	break;
	
	case 'updateOfficeEmailPasswd':
	$eid = $_REQUEST['eid'];
	$passwd = $_REQUEST['passwd'];
	$result = $dbobj->updateEmployeeEmailInfo($eid,$passwd);
	echo json_encode($result);
	break;
	
	case 'loadprojectlist':
	$pro_cus = $_REQUEST['pro_cus'];
	$result = $dbobj->getProjectListHtml($pro_cus);
	echo json_encode($result);
	break;
	
	case 'loadproject3':
	$cus_id = $_REQUEST['cus_id'];
	$result = $dbobj->loadProject3($cus_id);
	echo json_encode($result);
	break;
	
	case 'loadDepartment':
    $dep_id = $_REQUEST['dep_id'];
    $bu_id = $_REQUEST['bu_id'];
    $deg_id = $_REQUEST['deg_id'];
    $status = $_REQUEST['status'];
	$type = $_REQUEST['type'];
    $result = $dbobj->loadDepartment($dep_id, $bu_id, $deg_id, $status, $type); 
    echo json_encode($result);
    break;

	
	case 'loadDepartment_fin':
    $dep_id = $_REQUEST['dep_id'];
    $bu_id = $_REQUEST['bu_id'];
	$deg_id =$_REQUEST['deg_id'];
    $result = $dbobj->loadDepartment_fin($dep_id, $bu_id, $deg_id);
    echo json_encode($result);
    break;
	
     case 'updateEmpFinInfo':
     $retarr = $dbobj->updateEmpFinInfo($_REQUEST);
     echo json_encode($retarr); 
     break;

	case 'updateProject':
	$result = $dbobj->updateProject($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'manageProject':
	$result = $dbobj->manageProject($_REQUEST);
	echo json_encode($result);
	break;
	
	 case 'loadCustomerGroup':
	 $result = $dbobj->loadCustomerGroup($_REQUEST);
	 echo json_encode($result);
	 break;
	
	case 'updateProjectCustomer':
	$result = $dbobj->updateProjectCustomer($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'addnewProject':
	$result = $dbobj->addNewProject($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'passwdchange':
	$cpasswd = $_REQUEST['cpasswd'];
	$npasswd = $_REQUEST['npasswd'];
	$eid = $_REQUEST['eid'];
	$retarr = $dbobj->changeLoginPasswd($cpasswd,$npasswd,$eid);
	echo json_encode($retarr);
	break;
	
	case 'adddailyprojecttask':
	$result = $dbobj->addDailyProjectTask($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'updateprojecttask':
	$result = $dbobj->updateNewProjectTask($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'loadprojecttask':
	$pro_id = $_REQUEST['pro_id'];
	$grp_id = $_REQUEST['grp_id'];
	$result = $dbobj->loadProjectTaskHTMLEmpy($pro_id,$grp_id);
	echo json_encode($result);
	break;
	
	case 'loadprojecttask_a':
	$pro_id = $_REQUEST['pro_id'];
	$grp_id = $_REQUEST['grp_id'];
	$result = $dbobj->loadProjectTaskHTML($pro_id,$grp_id);
	echo json_encode($result);
	break;
	
	case 'loadsearchprojecttask':
	$pro_id = $_REQUEST['pro_id'];
	$grp_id = $_REQUEST['grp_id'];
	$search = $_REQUEST['search'];
	
	$result = $dbobj->loadSearchProjectTaskHTML($pro_id,$grp_id,$search);
	echo json_encode($result);
	break;
	
	
	case 'loadshowProjecttask':
	$pro_id = $_REQUEST['pro_id'];
	$grp_id = $_REQUEST['grp_id'];
	$search = $_REQUEST['search'];
	$show = $_REQUEST['showall'];
	$result = $dbobj->loadshowProjectTaskHTML($pro_id,$grp_id,$search,$showall);
	echo json_encode($result);
	break;
	
	
	case 'getprojecttasktime':
	$w_id = $_REQUEST['w_id'];
	$result = $dbobj->getProjectTaskTime($w_id);
	echo json_encode($result);
	break;
	
	case 'getdailytasktime':
	$date_time = $_REQUEST['date_time'];
	$result = $dbobj->getDailyTaskTime($date_time);
	echo json_encode($result);
	break;
	
	case 'getdailytasktime2':
	$date_time = $_REQUEST['date_time'];
	$eid = $_REQUEST['eid'];
	$result = $dbobj->getDailyTaskTime2($date_time,$eid);
	echo json_encode($result);
	break;
	
	
	case 'getprojecttaskdata':
	$w_id = $_REQUEST['w_id'];
	$result = $dbobj->getProjectTaskData($w_id);
	echo json_encode($result);
	break;
	
	case 'getdailytaskdata':
	$date_time = $_REQUEST['date_time'];
	$result = $dbobj->getDailyTaskData($date_time);
	echo json_encode($result);
	break;
	
	case 'getdailytaskdata2':
	$date_time = $_REQUEST['date_time'];
	$eid = $_REQUEST['eid'];
	$result = $dbobj->getDailyTaskData2($date_time,$eid);
	echo json_encode($result);
	break;
	
	
	case 'editprojecttask':
	$id = $_REQUEST['id'];
	$result = $dbobj->editProjectTask($id);
	echo json_encode($result);
	break;
	
	case 'deleteprojecttask':
	$id = $_REQUEST['id'];
	$result = $dbobj->deleteProjectTask($id);
	echo json_encode($result);
	break;
	
	case 'loadproject':
	$cus_id = $_REQUEST['cus_id'];
	$result = $dbobj->loadProject($cus_id);
	echo json_encode($result);
	break;
	
	case 'loadholiday':
	$year_id = $_REQUEST['year_id'];
	$result = $dbobj->loadHoliday($year_id);
	echo json_encode($result);
	break;
	
	case 'loadalloffdays':
	$year_id = $_REQUEST['year_id'];
	$result = $dbobj->getAllOffDayList($year_id);
	echo json_encode($result);
	break;
	
	case 'addprojecttask':
	$result = $dbobj->addNewProjectTask($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'updateprojecttask':
	$result = $dbobj->updateNewProjectTask($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'loadcusproject2':
	$cus_id = $_REQUEST['cus_id'];
	$result = $dbobj->loadCustomerProject2($cus_id);
	echo json_encode($result);
	break;
	
	case 'loadprojecttasktime':
	$pro_id = $_REQUEST['pro_id'];
	$grp_id = $_REQUEST['grp_id'];
	$result = $dbobj->loadProjectTaskTimeHTML($pro_id,$grp_id);
	echo json_encode($result);
	break;
	
	//Start IT Task
	
	case 'addNewITSupportTask':
	//$title = $_REQUEST['title'];
	//$text1 = $_REQUEST['text1'];
	$result = $dbobj->generateITRequest($_REQUEST);
	echo json_encode($result);
	break;
	
	
	
	case 'createNewImprovement':
	
	$result = $dbobj->addImprvIdeas($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'addAssignImprovement':
	
	$result = $dbobj->addAssignImprovement($_REQUEST);
	echo json_encode($result);
	break;
	
	
	case 'loadOpenITSupportTask':
	$result = $dbobj->loadEmpOpenITRequest();
	echo json_encode($result);
	break;
	
	case 'loadMyOpenImprovementIdeas':
	$result = $dbobj->loadMyOpenImprovementIdeas();
	echo json_encode($result);
	break;
	
	
	case 'loadMyOpenAssignIdeas':
	$result = $dbobj->loadMyOpenAssignIdeas();
	echo json_encode($result);
	break;
	
	
	case 'loadReviewerImprovementIdeas':
	$result = $dbobj->loadReviewerImprovementIdeas();
	echo json_encode($result);
	break;
	
	case 'loadImproveAssignIdeas':
	$result = $dbobj->loadImproveAssignIdeas();
	echo json_encode($result);
	break;
	
	
	
	case 'loadOpenAdminITSupportTask':
	$result = $dbobj->loadAdminOpenITRequest();
	echo json_encode($result);
	break;
	
	
	case 'GenerateReport':
	$bu_head = $_REQUEST['bu_head'];
	$pr_head = $_REQUEST['pr_head'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	
	$result = $dbobj->GenerateReport($bu_head,$pr_head,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	
	case 'loadITSupportTask':
	
	$pro = $_REQUEST['pro'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$result = $dbobj->loadITSupportTask($pro,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	
	case 'loadCloseITSupportTask':
	$result = $dbobj->loadEmpCloseITRequest();
	echo json_encode($result);
	break;
	
	case 'loadCloseAdminITSupportTask':
	$result = $dbobj->loadAdminCloseITRequest();
	echo json_encode($result);
	break;
	
	case 'saveProjectGroup':
    $grp_name = $_REQUEST['grp_name'];
    $reso_id = $_REQUEST['reso_id'];
    $result = $dbobj->saveProjectGroup($grp_name, $reso_id);
    echo json_encode($result);
    break;
	
	
	case 'UpdateProjectGroup':
    $grp_name = $_REQUEST['grp_name'];
    $reso_id = $_REQUEST['reso_id'];
    $id = $_REQUEST['id']; // Receive the id parameter
    
    $result = $dbobj->UpdateProjectGroup($grp_name, $reso_id, $id);
    echo json_encode($result);
    break;

	
   case 'loadProjectGroup':
	$grp_name = $_REQUEST['grp_name'];
	$reso_id = $_REQUEST['reso_id'];
	$pro_grp_id = $_REQUEST['pro_grp_id'];
	$result = $dbobj->loadProjectGroup($grp_name,$reso_id, $pro_grp_id);
	echo json_encode($result);
	break;
	
	case 'loadUpdateGroup':
    $grp_name = $_REQUEST['grp_name'];
    $reso_id = $_REQUEST['reso_id'];
	$pro_grp_id = $_REQUEST['pro_grp_id'];
	$result = $dbobj->loadUpdateGroup($grp_name, $reso_id,$pro_grp_id);
    echo json_encode($result);
    break;
   
  
	case 'actionDelete':
	$id = $_REQUEST['id'];
	$retarr = $dbobj->deleteProjectDetails($id);
	echo json_encode($retarr);
	break;
	
	case 'downloaditfile':
	$sid = $_REQUEST['sid'];
	$dataid = $_REQUEST['dataid'];
	$filename = $_REQUEST['filename'];
	$result = $dbobj->downloadITFile($sid,$dataid,$filename);
	echo json_encode($result);
	break;
	
	case 'updateITSupportTask':
	$result = $dbobj->updateITRequest($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'updateAdminITSupportTask':
	$result = $dbobj->updateAdminITRequest($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'updateNewITEmailFlag':
	$sid = $_REQUEST['sid'];
	$value = $_REQUEST['value'];
	$result = $dbobj->updateITReqEmail($sid,$value);
	echo json_encode($result);
	break;
	
	
	case 'updateNewIMPEmailFlag':
	$imprid = $_REQUEST['imprid'];
	$value = $_REQUEST['value'];
	$result = $dbobj->updateIMPReqEmail($imprid,$value);
	echo json_encode($result);
	break;
	
	
	case 'updateOldITEmailFlag':
	$dataid = $_REQUEST['dataid'];
	$value = $_REQUEST['value'];
	$result = $dbobj->updateITDataEmail($dataid,$value);
	echo json_encode($result);
	break;
	
	//End IT Task
	
	//Start PR Task
	
	
	case 'addNewPSSupportTask':
	$result = $dbobj->generatePSRequest($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'loadOpenPSSupportTask':
	$result = $dbobj->loadEmpOpenPSRequest();
	echo json_encode($result);
	break;
	
	
	
	
	
	case 'GenerateReport':
	$bu_head = $_REQUEST['bu_head'];
	$pr_head = $_REQUEST['pr_head'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	
	$result = $dbobj->GenerateReport($bu_head,$pr_head,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	
	case 'ImprovementReport':
	$typ = $_REQUEST['typ'];
	$res = $_REQUEST['res'];
	$pro = $_REQUEST['pro'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	
	$result = $dbobj->ImprovementReport($typ,$res,$pro,$start_date,$end_date);
	echo json_encode($result);
	break;
	
	
	case 'loadmyOpenPRTask':
	$result = $dbobj->loadMyOpenPSRequest();
	echo json_encode($result);
	break;
	
	case 'updatePSSupportTask':
	$result = $dbobj->updatePSRequest($_REQUEST);
	echo json_encode($result);
	break;
	
	
	case 'updateMyIMPRIdeas':
	$result = $dbobj->updateMyIMPRIdeas($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'updateMyASSIGNIdeas':
	$result = $dbobj->updateMyASSIGNIdeas($_REQUEST);
	echo json_encode($result);
	break;
	
	case 'loadClosePSSupportTask':
	$result = $dbobj->loadEmpClosePSRequest();
	echo json_encode($result);
	break;
	
	
	case 'loadCloseIMPRequest':
	$result = $dbobj->loadCloseIMPRequest();
	echo json_encode($result);
	break;
	
	
	case 'loadCloseIMPRequestreviewer':
	$result = $dbobj->loadCloseIMPRequestreviewer();
	echo json_encode($result);
	break;
	
	case 'loadCloseMyPSSupportTask':
	$result = $dbobj->loadMyClosePSRequest();
	echo json_encode($result);
	break;
	
	case 'downloadpsfile': 
	$sid = $_REQUEST['sid'];
	$dataid = $_REQUEST['dataid'];
	$filename = $_REQUEST['filename'];
	$result = $dbobj->downloadPSFile($sid,$dataid,$filename);
	echo json_encode($result);
	break;
	
	case 'downloadimpfile': 
	$imprid = $_REQUEST['imprid'];
	$dataid = $_REQUEST['dataid'];
	$filename = $_REQUEST['filename'];
	$result = $dbobj->downloadimpfile($imprid,$dataid,$filename);
	echo json_encode($result);
	break;
	
	
	case 'updateNewPSEmailFlag':
	$sid = $_REQUEST['sid'];
	$value = $_REQUEST['value'];
	$result = $dbobj->updatePSReqEmail($sid,$value);
	echo json_encode($result);
	break;
	
	case 'updateOldPSEmailFlag':
	$dataid = $_REQUEST['dataid'];
	$value = $_REQUEST['value'];
	$result = $dbobj->updatePSDataEmail($dataid,$value);
	echo json_encode($result);
	break;
	


case 'updateIMPEmail':
	$dataid = $_REQUEST['dataid'];
	$value = $_REQUEST['value'];
	$result = $dbobj->updateIMPEmail($dataid,$value);
	echo json_encode($result);
	break;

	
	//End PR Task
	
	case 'updateCovidVaccine':
	$vac_type = $_REQUEST['vac_type'];
	$vac_dose1 = $_REQUEST['vac_dose1'];
	$vac_dose2 = $_REQUEST['vac_dose2'];
	$result = $dbobj->updateCovidVaccine($vac_type,$vac_dose1,$vac_dose2);
	echo json_encode($result);
	break;
	
}
?>