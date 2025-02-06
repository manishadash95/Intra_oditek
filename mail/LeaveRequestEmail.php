<?php
ini_set("display_errors",0);

require_once '/var/www/intra/mail/class.phpmailer.php';

date_default_timezone_set('Asia/Kolkata');


class LeaveRequestEmail
{

	function __construct() {
		
    }
    // destructor
    function __destruct() {
        // $this->close();
    }	
	
	public function sendNewLeaveRequestEmail($dbObj)
	{
		$dataList = $dbObj->getNewLeaveRequestList();
		foreach($dataList as $data)
		{
			$this->sendFirstLeaveRequestEmail($dbObj,$data->lid,$data->dataid);
		}
		
	}
	
	
	public function sendNewLeaveRequestEmailTest($dbObj)
	{
		$dataList = $dbObj->getNewLeaveRequestListTest();
		foreach($dataList as $data)
		{
			$this->sendFirstLeaveRequestEmail($dbObj,$data->lid,$data->dataid);
		}
		
	}
	
	
	public function sendUpdateLeaveRequestEmail($dbObj)
	{
		$dataList = $dbObj->getUpdateLeaveRequestList();
		foreach($dataList as $data)
		{
			$this->sendUpdateLeaveRequestEmailtoAll($dbObj,$data->lid,$data->dataid);
		}
	}
		
		
	
	public function sendFirstLeaveRequestEmail($dbObj, $lid, $dataid)
	{
		$leaveObj = $dbObj->getLeaveReqObj($lid);
		$dataObj = $dbObj->getLeaveDataInfo($dataid);		
		
		$type = $leaveObj['type'];
		$type_str = $dbObj->getLeaveTypeById($type);
		$sdate = $leaveObj['start_date'];
		$edate = $leaveObj['end_date'];
		$days = $leaveObj['days'];
		$hr = $leaveObj['hr'];
		
		$msg = stripslashes($dataObj['msg']);
		$msg = str_replace("\n","<BR>",$msg);
		$eid = $dataObj['eid'];
		
		$emp_name = $dbObj->getEmpName($eid);
		$index1 = stripos($emp_name, ' ');
		$emp_name_first = substr($emp_name,'0',$index1);
		$empInfo = $dbObj->getEmployeeData($eid);
		$emp_email = $empInfo->office_email;
		$to = $dbObj->getManagerEmail($eid);
		if($empInfo->pro_grp_id)
		{
			$pro_mgr_email = $empInfo->pro_grp_head_email;
			$pos = strpos($to, $pro_mgr_email);	
			if($pos === false)
			{
				if($eid != $empInfo->pro_grp_head)
					$to = $to.",".$pro_mgr_email;
			}				
		}
			
		$from = $emp_email;
		$cc_email = "hr@oditeksolutions.com,".$emp_email;
		if($hr)
		{
			$emp_name = "HR on behalf of ".$emp_name;
		}
		
		
		$lid_str = $lid;
		$email_title = "NEW Leave Request[".$type_str."] : from ".$emp_name." ";
		$body = $this->getLeaveNewBodyCreator($lid,$emp_name,$email_title,$type_str,$sdate,$edate,$days,$msg);
							
		$ret = $this->SentMail($to,$from,$emp_name,$email_title,$body,$cc_email);

	}	
		
	public function sendUpdateLeaveRequestEmailtoAll($dbObj, $lid, $dataid)
	{
		$leaveObj = $dbObj->getLeaveReqObj($lid);
		$dataObj = $dbObj->getLeaveDataInfo($dataid);
		
		$type = $leaveObj['type'];
		$type_str = $dbObj->getLeaveTypeById($type);
		$sdate = $leaveObj['start_date'];
		$edate = $leaveObj['end_date'];
		$days = $leaveObj['days'];
		$status = $leaveObj['status'];
		$hr = $leaveObj['hr'];
		$status_str = $dbObj->getLeaveStatusById($status);
		$emp_creator = $leaveObj['eid'];
		$emp_creator_name = $dbObj->getEmpName($emp_creator);
		$empInfo_creator = $dbObj->getEmployeeData($emp_creator);
		$emp_creator_email = $empInfo_creator->office_email;
		$manager_email = $dbObj->getManagerEmail($emp_creator);
		
				
		$msg = stripslashes($dataObj['msg']);
		$msg = str_replace("\n","<BR>",$msg);
		$eid = $dataObj['eid'];
		if($eid == 1) //SCM
		{
			$emp_name =  "SCM-Admin";
			$email_reviewer = "intra@oditeksolutions.com";
		}
		else
		{			
			$emp_name = $dbObj->getEmpName($eid);
			$empData = $dbObj->getEmployeeData($eid);
			$email_reviewer = $empData->office_email;
		}
		
		if($empInfo_creator->pro_grp_id)
		{
			$pro_mgr_email = $empInfo_creator->pro_grp_head_email;
			$pos = strpos($manager_email, $pro_mgr_email);	
			if($pos === false)
			{
				if($eid != $empInfo_creator->pro_grp_head && $emp_creator != $empInfo_creator->pro_grp_head)
					$manager_email = $manager_email.",".$pro_mgr_email;
			}				
		}
		
		$to = $emp_creator_email;
		$cc_email = $manager_email.",hr@oditeksolutions.com";
		$from = $email_reviewer;
		
		///////////
		//$to = "chinmaya.sahu@oditeksolutions.com";
		//$cc_email = "chinmaya.sahu@oditeksolutions.com";
		////////
		//if($hr)
		//{
		//	$emp_name = "HR on behalf of ".$emp_name;
		//}
				
		$email_title = $status_str." [".$type_str."] : from ".$emp_name;
		$body = $this->getLeaveUpdateBody($lid,$emp_creator_name,$email_title,$type_str,$sdate,$edate,$days,$msg,$status_str,$emp_name);
		
				
		$ret = $this->SentMail($to,$from,$emp_name,$email_title,$body,$cc_email);
	
	}
	
	
	
	
	function getLeaveNewBodyCreator($lid,$emp_name,$email_title,$type_str,$sdate,$edate,$days,$msg)
	{
		
		$body='<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head>
		<meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">

		<title>'.$email_title.'</title>

		</head>
		<body style="-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0;width:100% !important">
		<table border="0" cellpadding="0" cellspacing="0" id="backgroundTable" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px;margin:0;padding:0;width:100% !important;line-height:100% !important">
		<tr>
		<td valign="top" style="padding:0;margin:0;border-collapse:collapse;font-family:arial">
		<table align="center" border="0" cellpadding="0" cellspacing="0" id="containerTable" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px;width:100% !important">
		<tr id="header">
		<td valign="top" width="200" style="padding:0;margin:0;border-collapse:collapse;font-family:arial"></td>
		<td valign="top" width="200" style="padding:0;margin:0;border-collapse:collapse;font-family:arial"></td>
		<td valign="top" width="200" style="padding:0;margin:0;border-collapse:collapse;font-family:arial"></td>
		</tr>
		<tr id="content">
		<td width="100%" style="padding:0;margin:0;border-collapse:collapse;font-family:arial">
		<table border="0" cellpadding="0" cellspacing="0" class="itsm-email-container" width="100%" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px;background-color:white">
		<tr>
		<td align="center" class="section-title-wrapper reply-above-line-wrapper" height="30" valign="middle" width="100%" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;background-color:#f5f5f5">
		<p class="section-title reply-above-line" style="font-family:arial, sans-serif;line-height:1.3em;color:#999999;font-size:14px;margin:auto;padding:0 10px">Reply above this line to add a comment</p>
		</td>
		</tr>
		<tr class="top_margin" style="height:50px;width:100%"></tr>
		<table style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px"><tr><td style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em"></td></tr></table><table style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px">
		<tr>
		<td class="section-main-box" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;padding-top:10px;padding-bottom:10px;font-family:arial, sans-serif;line-height:1.3em;padding-right:86px">
		<table border="0" cellpadding="0" cellspacing="0" class="event-container headline-event" width="100%" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px;margin:0">
		<tr>
		<td align="center" class="sidebar-wrapper" height="1" valign="top" width="68" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em">
		 </td>
		<td class="event-wrapper" valign="top" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em">
		<table border="0" cellpadding="0" cellspacing="0" class="event" width="100%" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px">
		<tr>
		<td class="title-wrapper" valign="top" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;font-size:14px;color:#444444;font-size:17px;color:#111111;padding-top:5px;padding-bottom:20px">
		<h2 class="title" style="color:#999999;font-size:14px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:24px">New Leave Request <span style="color:#003399"><U>'.$lid.'</U></span>: has been generated by '.$emp_name.'</h2>
		</td>
		</tr>
		<tr>
		<td class="body-wrapper" style="margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;font-size:14px;color:#444444;font-size:17px;color:#111111;padding:0">
		<br>
		<br>Leave Type : '.$type_str.'
		<br>
		<br>Leave Date: From '.$sdate.' to '.$edate.'
		<br>
		<br>Leave Days: '.$days.' days
		<br><br>
		Description:<br>'.$msg.'
		<br><br>
		<br>Periodic updates can be viewed in "Intra Leave"  module as well as by email.
		<br>
		<table style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px">
		<tr>
		<td class="buttons-wrapper" height="38" valign="middle" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;font-size:14px;color:#444444;font-size:17px;color:#111111;padding:20px 0">
		<table border="0" cellpadding="0" cellspacing="0" class="action-buttons-container view-itsm-container" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px;border-radius:4px;background-color:#0063B7">
		<tr>

		</tr>
		</table> </td>
		</tr>
		</table> </td>
		</tr>
		</table> </td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		<table style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px"><tr><td style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em">
		<br></td></tr></table><tr>
		<td class="footer-wrapper" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;border-top:1px solid #e8e8e8">
		<p class="footer" style="font-size:14px;font-family:arial, sans-serif;line-height:1.3em;color:#999999;font-size:12px">Best regards,
		<br>OdiTek HR
		<br>
		<br></p>
		</td>
		</tr> </table> </td>
		</tr>
		<tr id="footer"></tr>
		</table>
		</td>
		</tr>
		</table>
		<!-- End of wrapper table -->
		</body>
		</html>
		';	
		

		return $body;
	}
	
	
	
		
	
	function getLeaveUpdateBody($lid,$emp_name,$email_title,$type_str,$sdate,$edate,$days,$msg,$status_str,$reviewer_name)
	{
		
		$body='<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head>
		<meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">

		<title>'.$email_title.'</title>

		</head>
		<body style="-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0;width:100% !important">
		<table border="0" cellpadding="0" cellspacing="0" id="backgroundTable" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px;margin:0;padding:0;width:100% !important;line-height:100% !important">
		<tr>
		<td valign="top" style="padding:0;margin:0;border-collapse:collapse;font-family:arial">
		<table align="center" border="0" cellpadding="0" cellspacing="0" id="containerTable" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px;width:100% !important">
		<tr id="header">
		<td valign="top" width="200" style="padding:0;margin:0;border-collapse:collapse;font-family:arial"></td>
		<td valign="top" width="200" style="padding:0;margin:0;border-collapse:collapse;font-family:arial"></td>
		<td valign="top" width="200" style="padding:0;margin:0;border-collapse:collapse;font-family:arial"></td>
		</tr>
		<tr id="content">
		<td width="100%" style="padding:0;margin:0;border-collapse:collapse;font-family:arial">
		<table border="0" cellpadding="0" cellspacing="0" class="itsm-email-container" width="100%" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px;background-color:white">
		<tr>
		<td align="center" class="section-title-wrapper reply-above-line-wrapper" height="30" valign="middle" width="100%" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;background-color:#f5f5f5">
		<p class="section-title reply-above-line" style="font-family:arial, sans-serif;line-height:1.3em;color:#999999;font-size:14px;margin:auto;padding:0 10px">Reply above this line to add a comment</p>
		</td>
		</tr>
		<tr class="top_margin" style="height:50px;width:100%"></tr>
		<table style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px"><tr><td style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em"></td></tr></table><table style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px">
		<tr>
		<td class="section-main-box" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;padding-top:10px;padding-bottom:10px;font-family:arial, sans-serif;line-height:1.3em;padding-right:86px">
		<table border="0" cellpadding="0" cellspacing="0" class="event-container headline-event" width="100%" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px;margin:0">
		<tr>
		<td align="center" class="sidebar-wrapper" height="1" valign="top" width="68" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em">
		 </td>
		<td class="event-wrapper" valign="top" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em">
		<table border="0" cellpadding="0" cellspacing="0" class="event" width="100%" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px">
		<tr>
		<td class="title-wrapper" valign="top" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;font-size:14px;color:#444444;font-size:17px;color:#111111;padding-top:5px;padding-bottom:20px">
		<h2 class="title" style="color:#999999;font-size:14px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:24px">Leave Request <span style="color:#003399"><U>'.$lid.'</U></span>: created by '.$emp_name.'</h2>
		</td>
		</tr>
		<tr>
		<td class="body-wrapper" style="margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;font-size:14px;color:#444444;font-size:17px;color:#111111;padding:0">
		<br>
		<br>Leave Type : '.$type_str.'
		<br>
		<br>Leave Date: From '.$sdate.' to '.$edate.'
		<br>
		<br>Leave Days: '.$days.' days
		<br>
		<br>Status: '.$status_str.'
		<br>
		<br>Updated By: '.$reviewer_name.'
		<br><br>
		Description:<br>'.$msg.'
		<br><br>
		<br>Periodic updates can be viewed in "Intra Leave"  module as well as by email.
		<br>
		<table style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px">
		<tr>
		<td class="buttons-wrapper" height="38" valign="middle" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;font-size:14px;color:#444444;font-size:17px;color:#111111;padding:20px 0">
		<table border="0" cellpadding="0" cellspacing="0" class="action-buttons-container view-itsm-container" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px;border-radius:4px;background-color:#0063B7">
		<tr>

		</tr>
		</table> </td>
		</tr>
		</table> </td>
		</tr>
		</table> </td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		<table style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;font-size:14px"><tr><td style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em">
		<br></td></tr></table><tr>
		<td class="footer-wrapper" style="padding:0;margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;border-top:1px solid #e8e8e8">
		<p class="footer" style="font-size:14px;font-family:arial, sans-serif;line-height:1.3em;color:#999999;font-size:12px">Best regards,
		<br>OdiTek HR
		<br>
		<br></p>
		</td>
		</tr> </table> </td>
		</tr>
		<tr id="footer"></tr>
		</table>
		</td>
		</tr>
		</table>
		<!-- End of wrapper table -->
		</body>
		</html>
		';	
		

		return $body;
	}
	
	public function SentMail($to,$from,$emp_name,$subject,$msg_body,$cc){		
	$body = $msg_body;
	
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host  = "smtpout.secureserver.net";
	$mail->SMTPAuth   = true;                    
	$mail->SMTPSecure = 'ssl';   
	$mail->Port    =  465; // 80,3535,25: Normal , 465 SSL, 587 TLS
	$mail->Username   = "it@oditeksolutions.com"; 
	$mail->Password   = "ITOditek@123";        
	$mail->setfrom($from, $emp_name);
	//$mail->addreplyto("it@oditeksolutions.com","OdiTek-IT");
	$mail->Subject    = $subject;
	$mail->MsgHTML($body);
	$mail->AddAddress($address);
	$bcc = "";
	
	if($to!=''){
		$addr = explode(',',$to);
		foreach ($addr as $address) {
			$mail->AddAddress(trim($address));
		}
	}
	
	if($cc!=''){
		$addrcc = explode(',',$cc);
		foreach ($addrcc as $addresscc) {
			$mail->AddCC(trim($addresscc));
		}
	}
		
	if($mail->Send()){
		return 1;
	}else{
		return 0;
	}
}

}
?>