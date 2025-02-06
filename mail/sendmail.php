<?php
require_once('class.phpmailer.php');



function SentMail($to,$from,$subject,$msg_body,$reply_to='',$cc='',$files=''){		
	$mail = new PHPMailer();
	$body = $msg_body;
	$mail->IsSMTP();
	//$mail->SMTPDebug = 2;
	$mail->Host       = "smtpout.secureserver.net";
	$mail->SMTPAuth   = true;                    
	$mail->SMTPSecure = 'tls';   
	$mail->Port    = 587;
	$mail->Username   = "intra@oditeksolutions.com"; 
	$mail->Password   = "Oditek123!@#";        
	$mail->setfrom("intra@oditeksolutions.com", "Oditek");
	$mail->addreplyto("intra@oditeksolutions.com","Oditek");
	$mail->Subject    = $subject;
	$mail->MsgHTML($body);
	$address = $to;
	$mail->AddAddress($address);
	if(count($files) > 0 && $files!=''){
		for($i=0;$i<=count($files);$i++){
			if(is_file($files[$i])){
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
	if($mail->Send()){
		return 1;
	}else{
		return 0;
	}
}

echo "Sending Email";
$to = "chinmaya.sahu@oditeksolutions.com";
$from = "chinmaya.sahu@oditeksolutions.com";
$subject="Test Email";
$msg_body="sample test body";
$ret = SentMail($to,$from,$subject,$msg_body);

echo "<BR>Status:".$ret."<BR>";



?>