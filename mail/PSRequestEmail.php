<?php
ini_set("display_errors",0);

require_once '/var/www/intra/mail/class.phpmailer.php';

date_default_timezone_set('Asia/Kolkata');

define("IT_IMG_PATH","/var/www/intra/upload_pr/");

class PSRequestEmail
{

	function __construct() {
		
    }
    // destructor
    function __destruct() {
        // $this->close();
    }	
	
	public function sendNewPSRequestEmail($dbObj)
	{
		$dataList = $dbObj->getNewPSRequestList();
		foreach($dataList as $data)
		{
			$this->sendFirstPSRequestEmailMGMTDesk($dbObj,$data->sid,$data->dataid);
		}
		
	}
	
	
	public function sendUpdateITRequestEmail($dbObj)
	{
		$dataList = $dbObj->getUpdatePSRequestList();
		foreach($dataList as $data)
		{
			$this->sendUpdateITRequestEmailMGMTDesk($dbObj,$data->sid,$data->dataid);
		}
	}
	
	public function sendFirstPSRequestEmailMGMTDesk($dbObj, $sid, $dataid)
	{
		$itObj = $dbObj->getPSRequestInfo($sid);
		$title = stripslashes($itObj['title']);
		$dataObj = $dbObj->getPSDataInfo($dataid);		
		$msg = stripslashes($dataObj['msg']);
		$msg = str_replace("\n","<BR>",$msg);
		$head = $dbObj->getPRHeadString($itObj['head']);
		$cost = $itObj['cost'];
		$eid = $dataObj['eid'];
		$file1 = $dataObj['file1'];
		$file2 = $dataObj['file2'];
		$file3 = $dataObj['file3'];
		$emp_name = $dbObj->getEmpName($eid);
		$index1 = stripos($emp_name, ' ');
		$emp_name_first = substr($emp_name,'0',$index1);
		$empInfo = $dbObj->getEmployeeData($eid);
		$emp_email = $empInfo->office_email;
		$cc_email = "";
		$to = "";
		$from = "";
		$sid_str = "#PR".$sid;
		$email_title = "NEW:[".$sid_str."]-".$title." ";
		$body = $this->getPSNewBodyCreator($sid_str,$emp_name_first,$email_title,$title,$msg,$head,$cost);
		
		$fileArray = array();
		if(strlen($file1) > 0)
		{
			$file_path1 = PR_IMG_PATH.$sid."/".$dataid."/".$file1;
			$fileArray[] = $file_path1;	
		}
		if(strlen($file2) > 0)
		{
			$file_path2 = PR_IMG_PATH.$sid."/".$dataid."/".$file2;
			$fileArray[] = $file_path2;	
		}
		if(strlen($file3) > 0)
		{
			$file_path3 = PR_IMG_PATH.$sid."/".$dataid."/".$file3;
			$fileArray[] = $file_path3;	
		}
		$ret = $this->SentMail($emp_name_first,$emp_email,$email_title,$body,"",$cc_email,$fileArray);

	}	
	
	
		
	public function sendUpdateITRequestEmailMGMTDesk($dbObj, $sid, $dataid)
	{
		$itObj = $dbObj->getPSRequestInfo($sid);
		
		$title = stripslashes($itObj['title']);
		
		$status = $itObj['status'];
		$emp_creator = $itObj['eid'];
		$head = $dbObj->getPRHeadString($itObj['head']);
		$cost = $itObj['cost'];
		
		$emp_creator_name = $dbObj->getEmpName($emp_creator);
		$status_str = $dbObj->getPRStatusString($status);
		$empInfo_creator = $dbObj->getEmployeeData($emp_creator);
		$emp_creator_email = $empInfo_creator->office_email;
		$cc_email = $dbObj->getManagerEmail($emp_creator);
		
		$dataObj = $dbObj->getPSDataInfo($dataid);		
		$msg = stripslashes($dataObj['msg']);
		//$msg = $dataObj['msg'];
		$msg = str_replace("\n","<BR>",$msg);
		$eid = $dataObj['eid'];
		$status_log = $dataObj['status_log'];
		$file1 = $dataObj['file1'];
		$file2 = $dataObj['file2'];
		$file3 = $dataObj['file3'];
		$emp_name = $dbObj->getEmpName($eid);
		$index1 = stripos($emp_name, ' ');
		$emp_name_first = substr($emp_name,'0',$index1);
		$empInfo = $dbObj->getEmployeeData($eid);
		$emp_email = $empInfo->office_email;

		
		$cc = "";
		$from = "";
        if($status == 7) //MEAN PURCHASED		
		{
			$cc = "finance@oditeksolutions.com";
		}
		$sid_str = "#PR".$sid;
		$email_title = $status_str.":[".$sid_str."]-\"".$title." \" from ".$emp_name;
		$body = $this->getUpdateBodyPRDesk($sid_str,$emp_creator_name,$emp_name_first,$email_title,$title,$msg,$status_log,$head,$cost);
		
		$fileArray = array();
		if(strlen($file1) > 0)
		{
			$file_path1 = IT_IMG_PATH.$sid."/".$dataid."/".$file1;
			$fileArray[] = $file_path1;	
		}
		if(strlen($file2) > 0)
		{
			$file_path2 = IT_IMG_PATH.$sid."/".$dataid."/".$file2;
			$fileArray[] = $file_path2;	
		}
		if(strlen($file3) > 0)
		{
			$file_path3 = IT_IMG_PATH.$sid."/".$dataid."/".$file3;
			$fileArray[] = $file_path3;	
		}
		
		$ret = $this->SentMail($emp_name_first,$emp_email,$email_title,$body,"",$cc,$fileArray);
	
	}
	
	
	
	
	function getPSNewBodyCreator($sid_str,$emp_name,$email_title,$title,$msg,$head,$cost)
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
		<h2 class="title" style="color:#999999;font-size:12px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:24px">
		Purchase Request <span style="color:#003399"><U>'.$sid_str.'</U></span>: has been created.
		</h2>
		</td>
		</tr>
		<tr>
		<td class="body-wrapper" style="margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;font-size:14px;color:#444444;font-size:17px;color:#111111;padding:0">
		Hi All,
		<br>
		<br>New Purchase Request '.$sid_str.' 
		<br>Titled: &quot;'.$title.'&quot; <br>has been created by '.$emp_name.'.
		<br><br>
		Account : '.$head.'
		<br>
		Proposal Cost : Rs '.$cost.'
		<br>
		Description:<BR>['.$msg.']
		<br><br>
		<br>Periodic updates can be viewed in "Purchase Request" desk as well as by email.
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
		<br>OdiTek Intra Desk
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
	
	
	
		
	
	function getUpdateBodyPRDesk($sid_str,$emp_creator,$emp_name,$email_title,$title,$msg,$status_str,$head,$cost)
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
		<h2 class="title" style="color:#999999;font-size:12px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:24px">
		Update on Purchase Request <span style="color:#003399"><U>'.$sid_str.'</U></span>: '.$status_str.' </h2>
		</td>
		</tr>
		<tr>
		<td class="body-wrapper" style="margin:0;border-collapse:collapse;font-family:arial;font-family:arial, sans-serif;line-height:1.3em;font-size:14px;color:#444444;font-size:17px;color:#111111;padding:0">
	
		<br>Titled: &quot;'.$title.'&quot; <br>has been created by "'.$emp_creator.'"
		<br><br>
		Account : '.$head.'
		<br>
		Proposal Cost : Rs '.$cost.'
		<br>
		<br>
		Updated by: "'.$emp_name.'",
		<br>
		Description:<BR>['.$msg.']
		<BR>
		
		<br><br>
		<br>Periodic updates can be viewed in "Purchase Request" desk as well as by email.
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
		<br>OdiTek Intra Desk
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
	
	public function SentMail($name,$from,$subject,$msg_body,$reply_to='',$cc='',$files=''){		
	$body = $msg_body;
	$address = "mgmt@oditeksolutions.com";
	//$address = "chinmaya.sahu@oditeksolutions.com";
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host  = "smtpout.secureserver.net";
	$mail->SMTPAuth   = true;                    
	$mail->SMTPSecure = 'ssl';   
	$mail->Port    =  465; // 80,3535,25: Normal , 465 SSL, 587 TLS
	$mail->Username   = "intra@oditeksolutions.com"; 
	$mail->Password   = "Oditek123!@#";        
	$mail->setfrom($from, $name);
	$mail->Subject    = $subject;
	$mail->MsgHTML($body);
	$mail->AddAddress($address);
	$bcc = "";
	if(count($files) > 0 && $files!=''){
		for($i=0;$i<=count($files);$i++){
			//echo "<BR>file:".$files[$i]."<BR>";
			if(is_file($files[$i])){
				//echo "<BR>Attached<BR>";
				$mail->AddAttachment($files[$i]);
			}
		}
	}
	if($cc!=''){
		$addrcc = explode(',',$cc);
		foreach ($addrcc as $addresscc) {
			$mail->AddCC(trim($addresscc));
		}
	}
	
	if($bcc!=''){
		$addrcc = explode(',',$bcc);
		foreach ($addrcc as $addresscc) {
			$mail->AddBCC(trim($addresscc));
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