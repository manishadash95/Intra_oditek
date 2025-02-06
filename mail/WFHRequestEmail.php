<?php
ini_set("display_errors",1);

require_once '/var/www/intra/mail/class.phpmailer.php';

date_default_timezone_set('Asia/Kolkata');


class WFHRequestEmail
{

	function __construct() {
		
    }
    // destructor
    function __destruct() {
        // $this->close();
    }	
	
	public function sendNewWFHRequestEmail($dbObj)
	{
		$dataList = $dbObj->getNewWFHRequestList();
		foreach($dataList as $data)
		{
			$this->sendFirstWFHRequestEmail($dbObj,$data);
		}
		
	}
	
	
	public function sendUpdateWFHRequestEmail($dbObj)
	{
		$dataList = $dbObj->getUpdateWFHRequestList();
		foreach($dataList as $data)
		{
			$this->sendUpdateWFHRequestEmailToAll($dbObj,$data);
		}
	}
		
		
	
	public function sendFirstWFHRequestEmail($dbObj, $data)
	{
		$data->type_str = $dbObj->getWFHTypeById($data->type);
		$emp_name = $dbObj->getEmpName($data->eid);
		$data->emp_name = $emp_name;
		$empData = $dbObj->getEmployeeData($data->eid);
		$data->department = $empData->dept_name;
		$data->duration = $data->start_date." - ".$data->end_date;
		$data->status_str = $dbObj->getWFHStatusById($data->status);
		
		$emp_email = $empData->office_email;
		$mgr_email = $dbObj->getManagerEmail($data->eid);
		$bu_head_email = $dbObj->getEmployeeEmail($data->bu_head_id);
		$ceo_email = $dbObj->getCEOEmail();
		$to = $bu_head_email;
		$from = $emp_email;
		if(!strcmp($bu_head_email,$mgr_email))
			$cc_email = "hr@oditeksolutions.com,".$emp_email.",".$ceo_email;
		else
			$cc_email = "hr@oditeksolutions.com,".$mgr_email.",".$emp_email.",".$ceo_email;
		
		///////////
		//$to = "chinmaya.sahu@oditeksolutions.com";
		//$cc_email = "chinmaya.sahu@oditeksolutions.com";
		//$from = "chinmaya.sahu@oditeksolutions.com";
		////////
		
		$email_title = "NEW Request Type: [".$data->type_str."] : from ".$emp_name." ";
		$body = $this->getWFHNewBodyCreator($data,$emp_name,$email_title);
		$ret = $this->SentMail($to,$from,$emp_name,$email_title,$body,$cc_email);

	}	
		
	public function sendUpdateWFHRequestEmailToAll($dbObj,$data)
	{
		$data->type_str = $dbObj->getWFHTypeById($data->type);
		$emp_name = $dbObj->getEmpName($data->eid);
		$data->emp_name = $emp_name;
		$update_name = $dbObj->getEmpName($data->update_id);
		$empData = $dbObj->getEmployeeData($data->eid);
		$data->department = $empData->dept_name;
		$data->duration = $data->start_date." - ".$data->end_date;
		$data->status_str = $dbObj->getWFHStatusById($data->status);
		
		$emp_email = $dbObj->getEmployeeEmail($data->eid);
		$mgr_email = $dbObj->getManagerEmail($data->eid);
		$bu_head_email = $dbObj->getEmployeeEmail($data->bu_head_id);
		$update_email = $dbObj->getEmployeeEmail($data->update_id);
		$ceo_email = $dbObj->getCEOEmail();
		if($data->eid == $data->update_id)
		{	
			$to = $bu_head_email;
			$from = $emp_email;
			$cc_email = "hr@oditeksolutions.com,".$mgr_email.",".$update_email.",".$ceo_email;
		}
		else
		{
			$to = $emp_email;
			$from = $bu_head_email;
			if(!strcmp($bu_head_email,$mgr_email))
				$cc_email = "hr@oditeksolutions.com,".$update_email.",".$ceo_email;
			else
				$cc_email = "hr@oditeksolutions.com,".$mgr_email.",".$update_email.",".$ceo_email;
		}
		
		///////////
		//$to = "chinmaya.sahu@oditeksolutions.com";
		//$cc_email = "chinmaya.sahu@oditeksolutions.com";
		//$from = "chinmaya.sahu@oditeksolutions.com";
		////////
		
		$email_title = "[".$data->status_str."] Request Type: [".$data->type_str."] : from ".$update_name." ";
		$body = $this->getWFHUpdateBody($data,$update_name,$email_title);
		$ret = $this->SentMail($to,$from,$update_name,$email_title,$body,$cc_email);
	
	}
	
	
	
	
	public function getWFHNewBodyCreator($data,$emp_name,$email_title)
	{
		
		$body="<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
		<title>".$email_title."</title>
		<style>
		/* Font Definitions */
		@font-face
		{font-family:'Cambria Math';
		panose-1:2 4 5 3 5 4 6 3 2 4;}
		@font-face
		{font-family:Calibri;
		panose-1:2 15 5 2 2 2 4 3 2 4;}
		/* Style Definitions */
		p.MsoNormal, li.MsoNormal, div.MsoNormal
		{margin:0cm;
		margin-bottom:.0001pt;
		font-size:12.0pt;
		font-family:'Times New Roman',serif;}
		a:link, span.MsoHyperlink
		{mso-style-priority:99;
		color:#0563C1;
		text-decoration:underline;}
		a:visited, span.MsoHyperlinkFollowed
		{mso-style-priority:99;
		color:#954F72;
		text-decoration:underline;}
		span.EmailStyle17
		{mso-style-type:personal-compose;
		font-family:'Calibri',sans-serif;
		color:windowtext;}
		.MsoChpDefault
		{mso-style-type:export-only;
		font-family:'Calibri',sans-serif;
		mso-fareast-language:EN-US;}
		@page WordSection1
		{size:612.0pt 792.0pt;
		margin:72.0pt 72.0pt 72.0pt 72.0pt;}
		div.WordSection1
		{page:WordSection1;}
		 .holiday{color:white;background-color:#56a832;}
		 .absent{color:white;background-color:#FF0404;}
		 .tabletr{font-family:Tahoma, Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'}
		</style>
		</head>
		<body lang=EN-IN link='#0563C1' vlink='#954F72'>
		<div class=WordSection1>
	    <p class=MsoNormal>
		<h2 class='title' style='color:#999999;font-size:14px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:20px'>
		New ".$data->type_str." Request <span style='color:#003399'><U>".$data->wid."</U></span>: by ".$emp_name."</h2>
		<BR><BR>
		<h2 class='title' style='color:#999999;font-size:14px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:16px'>
		<I>NOTE: To update, please goto 'INTRA->WFH Mgmt' module only</I></h2>";
				
						
		$body.="<BR><BR><div style='height: 500.0pt'><table width='600' border='1' align='left'>
		        <tbody> 
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
			    <td width='120' align='center' style='padding-right:10px;'>
			    <B>Created Date<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->cdate."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Request Type<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->type_str."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Name<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->emp_name."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Department/Team<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->department."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Supervisor Name<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->super_name."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>BU Name<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->bu_name."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>BU Head<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->bu_head_name."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Duration<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->duration."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Days<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->days."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Reason<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->reason."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>General Availability/Timing<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->avail_time."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Internet provider/Speed<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->net_speed."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Status<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->status_str."</td>
			    </tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Approver Name<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->bu_head_name."</td>
			    </tr>";
								
				$body.="</tbody></table></div>
				</p></div>";
				$body.="</body></html>";
		

		return $body;
	}
	
	
	
	public function getWFHUpdateBody($data,$emp_name,$email_title)
	{
		
		$body="<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
		<title>".$email_title."</title>
		<style>
		/* Font Definitions */
		@font-face
		{font-family:'Cambria Math';
		panose-1:2 4 5 3 5 4 6 3 2 4;}
		@font-face
		{font-family:Calibri;
		panose-1:2 15 5 2 2 2 4 3 2 4;}
		/* Style Definitions */
		p.MsoNormal, li.MsoNormal, div.MsoNormal
		{margin:0cm;
		margin-bottom:.0001pt;
		font-size:12.0pt;
		font-family:'Times New Roman',serif;}
		a:link, span.MsoHyperlink
		{mso-style-priority:99;
		color:#0563C1;
		text-decoration:underline;}
		a:visited, span.MsoHyperlinkFollowed
		{mso-style-priority:99;
		color:#954F72;
		text-decoration:underline;}
		span.EmailStyle17
		{mso-style-type:personal-compose;
		font-family:'Calibri',sans-serif;
		color:windowtext;}
		.MsoChpDefault
		{mso-style-type:export-only;
		font-family:'Calibri',sans-serif;
		mso-fareast-language:EN-US;}
		@page WordSection1
		{size:612.0pt 792.0pt;
		margin:72.0pt 72.0pt 72.0pt 72.0pt;}
		div.WordSection1
		{page:WordSection1;}
		 .holiday{color:white;background-color:#56a832;}
		 .absent{color:white;background-color:#FF0404;}
		 .tabletr{font-family:Tahoma, Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'}
		</style>
		</head>
		<body lang=EN-IN link='#0563C1' vlink='#954F72'>
		<div class=WordSection1>
	    <p class=MsoNormal>
		<h2 class='title' style='color:#999999;font-size:14px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:20px'>
		Updated ".$data->type_str." Request <span style='color:#003399'><U>".$data->wid."</U></span>: by ".$emp_name."</h2>
		<BR><BR>
		<h2 class='title' style='color:#999999;font-size:14px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:16px'>
		<I>NOTE: To update, please goto 'INTRA->WFH Mgmt' module only</I></h2>";
				
						
		$body.="<BR><BR><div style='height: 500.0pt'><table width='600' border='1' align='left'>
		        <tbody> 
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
			    <td width='120' align='center' style='padding-right:10px;'>
			    <B>Created Date<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->cdate."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Request Type<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->type_str."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Name<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->emp_name."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Department/Team<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->department."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Supervisor Name<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->super_name."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>BU Name<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->bu_name."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>BU Head<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->bu_head_name."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Duration<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->duration."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Days<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->days."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Reason<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->reason."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>General Availability/Timing<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->avail_time."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Internet provider/Speed<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->net_speed."</td>
				</tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Status<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->status_str."</td>
			    </tr>
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Updated By<B></td>
			    <td width='200' align='center' style='padding-left:5px;'>
			    ".$data->updated_name."</td>
			    </tr>";
								
				$body.="</tbody></table></div>
				</p></div>";
				$body.="</body></html>";
		

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
		<tr class="top_margin" style="height:200px;width:100%"></tr>
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
	$mail->Port    =  465; // 200,3535,25: Normal , 465 SSL, 587 TLS
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