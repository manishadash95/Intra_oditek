<?php
ini_set("display_errors",0);

require_once '/var/www/intra/mail/class.phpmailer.php';

date_default_timezone_set('Asia/Kolkata');


class RequestEmail
{

	function __construct() {
		
    }
    // destructor
    function __destruct() {
        // $this->close();
    }	
	
	public function sendForgotPasswdEmail($dbObj)
	{
		$dataList = $dbObj->getForgotPasswdEmailList();
		foreach($dataList as $data)
		{
			$this->sendForgotPasswdEmailToUser($dbObj,$data->eid,$data->otp,$data->type);
		}
		
	}
	
	public function sendCreateEmailIT($dbObj)
	{
		$dataList = $dbObj->getCreateNewEmailList();
		foreach($dataList as $data)
		{
			$this->sendCreateEmailToIT($dbObj,$data->eid);
		}
		
	}
	
	public function sendEmailNewEmployeeALL($dbObj)
	{
		$dataList = $dbObj->getNewEmployeeList();
		foreach($dataList as $data)
		{
			$this->sendNewEmployeeInfo($dbObj,$data->eid);
		}
		
	}
	
	public function sendNormalEmail($dbObj)
	{
		$dataList = $dbObj->getNewNormalEmailList();
		foreach($dataList as $data)
		{
			$this->sendEmail($dbObj,$data);
		}
		
	}
		
	public function sendForgotPasswdEmailToUser($dbObj, $eid, $otp,$type)
	{
		$empInfo = $dbObj->getEmployeeData($eid);
		$emp_name = $dbObj->getEmpName($eid);
		$index1 = stripos($emp_name, ' ');
		$emp_name_first = substr($emp_name,'0',$index1);
		$emp_email = $empInfo->office_email;
		
		$title = "OdiTek Intra Password reset OTP";
		$body = $this->getNewBodyForgotPasswd($emp_name_first,$otp,$title);
		$priority =3;
		$cc="";
		$bcc="";
		$ret = $this->SentMail($emp_email,$cc,$bcc,$title,$body,$priority);
		
		//echo":::::EMAIL::".$ret;
	}	
	
	function getNewBodyForgotPasswd($emp_name_first,$otp,$title)
	{
		$body="<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
			<title>".$title."</title>
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
			font-family: arial, sans-serif;}
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
	        <span style='color:#002060'><B>Dear ".$emp_name_first."</B>,</span>
			<BR><BR>
			Please get OTP for resetting Intra Password : <B>".$otp."</B>
			<BR><BR>
			NOTE: This OTP is valid for 15 min only.
			<BR><BR><BR>
			Br,<BR>
			Intra-Admin
			</body></html>";
		

		return $body;
	}
	
	
	
	
	public function sendCreateEmailToIT($dbObj, $eid)
	{
		$empInfo = $dbObj->getEmployeeData($eid);
		$emp_name = $empInfo->name;
		$emp_email = $empInfo->office_email;
		
		$title = "Create New Email of ".$emp_name;
		$body = $this->getNewBodyCreateNewEmail($emp_name,$emp_email,$title);
		$to = "it-desk@oditeksolutions.com";
		$priority =1;
		$cc="";
		$bcc="";
		$ret = $this->SentMail($to,$cc,$bcc,$title,$body,$priority);
	    echo":::::EMAIL::".$ret;
	}	
	
	function getNewBodyCreateNewEmail($emp_name,$emp_email,$title)
	{
		$body="<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
			<title>".$title."</title>
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
			font-size:11.0pt;
			font-family: arial, sans-serif;}
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
			 .tabletr{font-family:Tahoma, Geneva, sans-serif; background:F2F2F2;font-size:11px;color:#666'}
			</style>
			</head>
			<body lang=EN-IN link='#0563C1' vlink='#954F72'>
			<div class=WordSection1>
	        <p class=MsoNormal>
	        <span style='color:#002060'>Dear IT,</span>
			<BR><BR>
			Please create new office email of employee :<b> ".$emp_name."</b>
			<BR><BR>
			Email Address:<B> ".$emp_email."</B>
			<BR><BR><BR>
			NOTE: After creating new Email, please update password in 'Employee->View Employee Data' and view of employee ".$emp_name." 
			<BR><BR><BR>
			Br,<BR>
			Intra-Admin
			</body></html>";
		

		return $body;
	}
		
	
	public function sendNewEmployeeInfo($dbObj, $eid)
	{
		$emp_report = $dbObj->getEmployeeToReport($eid);
		$empInfo = $dbObj->getEmployeeData($eid);
		$emp_name = $empInfo->name;
		$index1 = stripos($emp_name, ' ');
		$emp_name_first = substr($emp_name,'0',$index1);
		$office_email = $empInfo->office_email;
		
		$title = "Welcome to OdiTek Solutions";
		$body = $this->getNewBodyFirstEmployeeEmail($emp_name_first,$empInfo,$title);
		$to = $empInfo->email;
		$cc = $office_email;
		$bcc = "";
		$priority =1;
		$ret = $this->SentMail($to,$cc,$bcc,$title,$body,$priority);
		//echo":::::EMAIL::".$ret;
		
		//Send to MGMT
		$title = "New Employee Info: ".$emp_name;
		$body = $this->getNewBodyFirstEmployeeEmailToMgmt($emp_name,$empInfo,$title);
		$to = "hr-intra@oditeksolutions.com";
		$cc = $emp_report->office_email;
		$priority =1;
		$ret = $this->SentMail($to,$cc,$bcc,$title,$body,$priority);
		
	}

	public function sendEmail($dbObj,$data)
	{
		$to = $data->to;
		$cc = $data->cc;
		$bcc = $data->bcc;
		$title = $data->title;
		$body = $this->getNormalEmailBody($data);
		$priority=1;
		$ret = $this->SentMail($to,$cc,$bcc,$title,$body,$priority);
		
	}
	
	
	function getNewBodyFirstEmployeeEmail($emp_name,$empInfo,$title)
	{
		$body="<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
			<title>".$title."</title>
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
			font-size:10.0pt;
			font-family: arial, sans-serif;}
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
			 .tabletr{font-family:Tahoma, Geneva, sans-serif; background:F2F2F2;font-size:11px;color:#666'}
			</style>
			</head>
			<body lang=EN-IN link='#0563C1' vlink='#954F72'>
			<div class=WordSection1>
	        <p class=MsoNormal>
	        <span style='color:#002060'>Dear ".$emp_name.",</span>
			<BR><BR>
			<B>Welcome to OdiTek Solutions!</B>
			<BR><BR>
			Please get below details of OdiTek Email as well as Intra site login credentials:
			<BR><BR>
			<B><U>#OdiTek Email:</U></B>
			<BR>
			<B>URL</B>: <a href='http://email.oditeksolutions.com'>OdiTek Webmail</a>
			<BR>
			<B>User Name</B>: ".$empInfo->office_email."
			<BR>
			<B>Password</B>: ".$empInfo->office_email_passwd."
			<BR>
			<I>Note: Please change email password after login.</I>
			<BR><BR>
			<B><U>#OdiTek Intra:</U></B>
			<BR>
			<B>URL</B>: <a href='http://intra.oditek.in'>OdiTek Intra</a>
			<BR>
			<B>User Name</B>: ".$empInfo->intra_username."
			<BR>
			<B>Password</B>: ".$empInfo->intra_username_passwd."
			<BR><BR><BR>
			Br,<BR>
			HR-OdiTek
			</body></html>";
		

		return $body;
	}
	
	
	function getNewBodyFirstEmployeeEmailToMgmt($emp_name,$empInfo,$title)
	{
		$body="<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
			<title>".$title."</title>
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
			font-size:10.0pt;
			font-family: arial, sans-serif;}
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
			 .tabletr{font-family:Tahoma, Geneva, sans-serif; background:F2F2F2;font-size:11px;color:#666'}
			</style>
			</head>
			<body lang=EN-IN link='#0563C1' vlink='#954F72'>
			<div class=WordSection1>
	        <p class=MsoNormal>
	        <span style='color:#002060'>Dear Mgmt,</span>
			<BR><BR>
			New email as well as Intra login details has been sent to ".$emp_name."
			<BR><BR>
			Please get below details of ".$emp_name.":
			<BR><BR>
			<BR>
			<B>Name:</B> ".$empInfo->name."
			<BR>
			<B>Gender:</B> ".$empInfo->gender."
			<BR>
			<B>Email:</B> ".$empInfo->office_email;
			if($empInfo->prev_exp)
			{
				$body.="<BR>
				<B>Prev. Exp.:</B> ".$empInfo->prev_org_exp."
				<BR>
				<B>Skills.:</B> ".$empInfo->skills."
				";
			}else{
				$body.="<BR>
				<B>Prev. Exp.:</B> ".$empInfo->prev_org_exp."
				";
			}
			$body.="<BR><BR>
			<B>Reporting To:</B> ".$empInfo->report_to."
			<BR>
			<B>Designation:</B> ".$empInfo->desig_name."
			<BR>
			<B>Group name:</B> ".$empInfo->dept_name."
			<BR>
			<BR><BR><BR>
			Br,<BR>
			HR-OdiTek
			</body></html>";
		

		return $body;
	}
	
	
	
	function getNormalEmailBody($data)
	{
		$body="<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
			<title>".$data->title."</title>
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
			font-family: 'Calibri',sans-serif;}
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
			 .tabletr{font-family: Arial, sans-serif; background:F2F2F2;font-size:12px;color:#151B8D'}
			</style>
			</head>
			<body lang=EN-IN link='#0563C1' vlink='#954F72'>
			<div class=WordSection1 style='color:#002060'>
	        <p class=MsoNormal>
	        ".$data->body."
			</p></div>
			</body></html>";
		

		return $body;
	}
	
	
	public function SentMail($emp_email,$cc,$bcc,$title,$msg_body,$priority)
	{		
		$body = $msg_body;
		$address = $emp_email;
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host  = "smtpout.secureserver.net";
		$mail->SMTPAuth   = true;                    
		$mail->SMTPSecure = 'ssl';   
		$mail->Port    =  465; // 80,3535,25: Normal , 465 SSL, 587 TLS
		$mail->Username   = "intra@oditeksolutions.com"; 
		$mail->Password   = "Oditek123!@#";        
		$mail->setfrom("intra@oditeksolutions.com", "OdiTek-Intra");
		$mail->Subject    = $title;
		$mail->MsgHTML($body);
		$mail->AddAddress($address);
		$mail->HeaderLine('X-Priority', $priority);
		
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