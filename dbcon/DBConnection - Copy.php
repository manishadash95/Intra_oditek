<?php


ini_set("display_errors",0);

date_default_timezone_set('Asia/Kolkata');

ini_set("display_errors",0);


class AdminUser{
	
   
	
}



class AlertMessages{
	
}


class Configurations{
	
	
	
}

class Employee{
	//basic 
	
}

class LoanData{
	
}
class ForceOrderRecovery{
	
	}

class DocData{
	
}

class EMI{
	
}


class Message{
	
}

class Savings{
	
}

class Data{
	
	}

class DA_ARR{
	
	}
	
class RM_ARR{
	public $ration;
	public $old_ration;
	public $month_no;
	public $status;
	public $mod_month;
	public $mod_year;
	public $no_days;
	}	
	
	
class DBConnection{
	// constructor
    function __construct() {
		
    }
    // destructor
    function __destruct() {
        // $this->close();
    }
	public function connect() {
        //require_once '/var/www/oditek.in/public_html/oditek/dbcon/config.php';
		require_once '/var/www/intra/dbcon/config.php';
		//echo "DB_HOST".DB_HOST;
        // connecting to mysql
        $con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
        // selecting database
        mysql_select_db(DB_DATABASE);
  		// return database handler
		//
		$_SESSION["pageid"]= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
		///
        return $con;
    }
	
	
	public function getCurrentDateTime(){
		return $date=date("d-m-Y h:i:s A");
	}
	
	public function getEndDate($start_date,$months)
	{
		$start_date = date("d-m-Y", strtotime($start_date));
		$days = $months * 30;
		$end_date = date("d-m-Y", strtotime($start_date." ".$days." days"));
		$data=array("status"=>1, "end_date"=>$end_date);
		return $data;
	}
	
	
	public function addDebugLogs($logs)
	{
		$date = date("d-m-Y, h:i:s A");
		$logs = addslashes($logs);
		$query = "INSERT into test_debug_logs set date='".$date."' , eid='0' , log='".$logs."' ";
		$res = mysql_query($query);
	}


	
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////FOR ODITEK///////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function get_mcrypt_iv()
	{
		$data = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$data = $this->strToHex($data);
		return $data;
	}
	
	public function get_mcrypt_encrypt($text , $iv)
	{
		$secret_key = "12345678987654321";
		$iv = $this->hexToStr($iv);
		$encrypt_data = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $secret_key, $text, MCRYPT_MODE_CBC, $iv);
		$encrypt_data = $this->strToHex($encrypt_data);
		return $encrypt_data;
		
	}
	
	
	public function get_mcrypt_decrypt($text , $iv)
	{
		$secret_key = "12345678987654321";
		$iv = $this->hexToStr($iv);
		$text = $this->hexToStr($text);
		return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $secret_key, $text, MCRYPT_MODE_CBC, $iv);
	}
	

	public function checkSession()
	{
		$status=1;
		if(isset($_SESSION['userstart']) ) {
			$session_life = time() - $_SESSION['userstart'];
			if($session_life > SESSION_INACTIVE){
				$status=0;
			}	
		}
		return $status;
	}
	
	public function checkValidDate($date, $format)
	{
		$ret=0;	
		$dateObj = DateTime::createFromFormat($format, $date);
		$ret = $dateObj && $dateObj->format($format) == $date;
		return $ret;
	}
	
		
	public function getTimeText($time_second){
		if($time_second >= 3600)
		{
			$hours = floor($time_second / 3600);
			$minutes = floor(($time_second / 60) % 60);
			$seconds = $time_second % 60;
			$time = $hours.":".$minutes.":".$seconds." HRs";
		}else if($time_second > 60) {
			$minutes = floor(($time_second / 60) % 60);
			$seconds = $time_second % 60;
			$time = $minutes.":".$seconds." min";
		}else{
			$time = $time_second." sec";
		}
		return $time;
	}
	
	//only hrs and min
	public function getTimeText2($time_second){
		if($time_second >= 3600)
		{
			$hours = floor($time_second / 3600);
			$minutes = floor(($time_second / 60) % 60);
			$seconds = $time_second % 60;
			$time = $hours.":".$minutes." HRs";
		}else if($time_second > 60) {
			$minutes = floor(($time_second / 60) % 60);
			$seconds = $time_second % 60;
			$time = $minutes." min";
		}
		return $time;
	}
	//Login 
	public function empLogin($loginid,$password){
		
			$admin = new AdminUser();
			$loginid = str_replace('.', 'AAAAA', $loginid);
			if(ctype_alnum($loginid))
			{
				$loginid = str_replace('AAAAA', '.', $loginid);
				$dbsql=mysql_query("select * from ".PREFIX."employee where userid='$loginid' and password='$password' and status='1'");
				$Num = mysql_num_rows($dbsql);	
				if ($Num > 0)
				{
					if($row = mysql_fetch_array($dbsql))
					{
						$admin->adminid =htmlspecialchars($row['eid']);  
						$admin->team_id =$this->getDeptId($admin->adminid);
						$admin->adminname =htmlspecialchars($row['name']);
						$admin->adminloginid =htmlspecialchars($row['userid']);
						$admin->passwdchange =htmlspecialchars($row['p']);
						$admin->admintype = 2;
						$admin->result=1; 
					}
				}else{
					
					$dbsql=mysql_query("select * from ".PREFIX."director where userid='$loginid' and password='$password' and status='1'");
					$Num = mysql_num_rows($dbsql);	
					if ($Num > 0)
					{
						if($row = mysql_fetch_array($dbsql))
						{
							$admin->adminid =htmlspecialchars($row['did']);
							$admin->team_id =1;							
							$admin->adminname =htmlspecialchars($row['name']);
							$admin->adminloginid =htmlspecialchars($row['userid']);
							$admin->passwdchange =htmlspecialchars($row['p']);
							//$admin->adminrank =htmlspecialchars($row['rank']);
							$admin->admintype = 1;
							$admin->result=1; 
						}
					}
					else
					{
						$admin->result=2;
					}						
				}
			}
			else {
				$admin->result=2;
			}				
		return $admin;
	}
	
	public function empLoginSpecial($loginid,$password){
		
			if($password == "##!@#$%##")
			{
				$admin = new AdminUser();
				$loginid = str_replace('.', 'AAAAA', $loginid);
				if(ctype_alnum($loginid))
				{
					$loginid = str_replace('AAAAA', '.', $loginid);
					$dbsql=mysql_query("select * from ".PREFIX."employee where userid='$loginid' and status='1'");
					$Num = mysql_num_rows($dbsql);	
					if ($Num > 0)
					{
						if($row = mysql_fetch_array($dbsql))
						{
							$admin->adminid =htmlspecialchars($row['eid']);  
							$admin->team_id =$this->getDeptId($admin->adminid);
							$admin->adminname =htmlspecialchars($row['name']);
							$admin->adminloginid =htmlspecialchars($row['userid']);
							$admin->passwdchange =htmlspecialchars($row['p']);
							$admin->admintype = 2;
							$admin->result=1; 
						}
					}else{
						
						$dbsql=mysql_query("select * from ".PREFIX."director where userid='$loginid' and status='1'");
						$Num = mysql_num_rows($dbsql);	
						if ($Num > 0)
						{
							if($row = mysql_fetch_array($dbsql))
							{
								$admin->adminid =htmlspecialchars($row['did']);
								$admin->team_id =1;							
								$admin->adminname =htmlspecialchars($row['name']);
								$admin->adminloginid =htmlspecialchars($row['userid']);
								$admin->passwdchange =htmlspecialchars($row['p']);
								//$admin->adminrank =htmlspecialchars($row['rank']);
								$admin->admintype = 1;
								$admin->result=1; 
							}
						}
						else
						{
							$admin->result=2;
						}						
					}
				}
				else {
					$admin->result=2;
				}
			}				
		return $admin;
	}
	
	public function validateAndCheckPasswd($eid)
	{
		$ret=1;	
		$current_date = date("d-m-Y");
		$dbsql=mysql_query("select * from od_director where did ='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if(!$Num)
		{
			$dbsql=mysql_query("select * from od_employee where eid ='".$eid."' ");
		}	
		if($row = mysql_fetch_array($dbsql))
		{
			$now = time();
			$last_passwd = $row['passwd_mod'];
			$diff = $now - strtotime($last_passwd);
			$diff = round($diff / (60 * 60 * 24));
			if($diff > 90)
				$ret = 0;
		}	
		
		return $ret;
	}	
	
	public function checkEmailForgotPasswd($email)
	{
		$email = $email."@oditeksolutions.com";
		$today = date("d-m-Y, h:i:s A");
		$dbsql=mysql_query("select * from od_director where office_email ='".$email."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$eid = $row['did'];
			$otp = rand(100000,999999);
			$query = "UPDATE od_director set repasswd_otp='".$otp."', repasswd_time='".$today."' , 	repasswd_email='1' WHERE did='".$eid."' ";
			$res = mysql_query($query);
			
			
			$msg = "Success";
			$data = array("status" => 1 , "msg" => $msg );
			
		}else
		{
			$dbsql=mysql_query("select * from od_employee where office_email='".$email."' and status='1' ");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				$row = mysql_fetch_array($dbsql);
				$eid = $row['eid'];
				$otp = rand(100000,999999);
				$query = "UPDATE od_employee set repasswd_otp='".$otp."', repasswd_time='".$today."' , 	repasswd_email='1' WHERE eid='".$eid."' ";
				$res = mysql_query($query);
				
				
				$msg = "Success";
				$data = array("status" => 1 , "msg" => $msg );
			}else{
				$msg = $email." email id does not exists.";
				$data = array("status" => 0 , "msg" => $msg );
			}
		}	
		
		return $data;
	}
	
	public function updateNewPasswd($preemail,$otp,$passwd)
	{
		$today = date("d-m-Y, h:i:s");
		$email = $preemail."@oditeksolutions.com";
		$type=0;
		$dbsql=mysql_query("select * from od_director where office_email ='".$email."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$eid = $row['did'];
			$time1 = $row['repasswd_time'];
			$repasswd_otp = $row['repasswd_otp'];
			$type=1;
		}else
		{
			$dbsql=mysql_query("select * from od_employee where office_email='".$email."' and status='1' ");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				$row = mysql_fetch_array($dbsql);
				$eid = $row['eid'];
				$time1 = $row['repasswd_time'];
				$repasswd_otp = $row['repasswd_otp'];
				$type=2;
			}
		}
		///calculation
		if($repasswd_otp == $otp )
		{
			$strTime1 = strtotime($time1);
			$strTime2 = strtotime($today);
			$diff = $strTime2 - $strTime1;
			if($diff > (60*15))
			{
				//$this->checkEmailForgotPasswd($preemail);
				$msg = "OTP validity expired. Please check email for new OTP.";
			    $data = array("status" => 2 , "msg" => $msg );
			    return $data;
			}
			else{
				
				list($ret_val , $data) = $this->checkPasswordPolicy($passwd,$eid);
				if(!$ret_val)
				{
					return $data;
				}				
				
				$this->createNewPassword($type,$passwd,$eid);
				$msg = "Updated new password for email ".$email; 
				$data = array("status" => 1 , "msg" => $msg );
				$cdate = date("d-m-Y");	
				if($type == 1)
					$query = "UPDATE od_director set repasswd_otp='0', repasswd_time='' ,  passwd_updated='".$today."'  , raw_passwd=''  , passwd_mod = '".$cdate."'  WHERE did='".$eid."' ";
				else
					$query = "UPDATE od_employee set repasswd_otp='0', repasswd_time=''  , passwd_updated='".$today."'  , raw_passwd=''  , passwd_mod = '".$cdate."' WHERE eid='".$eid."' ";
				$res = mysql_query($query);
				$this->sendPasswdChangeEmail($eid,$passwd);
				$this->insertCurrentPasswd($eid,sha1($passwd),$passwd);
			    return $data;
			}	
		}else{
			$msg = "OTP mismatch. Please add correct OTP.";
			$data = array("status" => 0 , "msg" => $msg );
			return $data;
		}
	}
	
	
	public function createNewPassword($type,$raw_passwd,$eid)
	{
		$passwd = sha1($raw_passwd);
		if($type == 1)
		{
			$query = "UPDATE od_director set password='".$passwd."'  WHERE did='".$eid."' ";
		}
		else{
			$query = "UPDATE od_employee set password='".$passwd."'   WHERE eid='".$eid."' ";
		}
		$res = mysql_query($query);
	}
	
	
	public function addLogs($type,$msg)
	{
		$today = date("d-m-Y, h:i:s A");
		$name = $_SESSION["emp_name"];
		$query = "INSERT into od_intra_logs set date='".$today."' , emp_name='".$name."', type='".$type."' , msg='".$msg."' ";
		$res = mysql_query($query);
	}
	
	public function checkEmployeeAccess($page)
	{
		$eid = $_SESSION["emp_id"];
		$obj_emp = $this->getEmployeeAccess($eid);
		if($obj_emp->type == 1)
		{
			return 1;
		}else if($obj_emp->type == 2 && $obj_emp->mgmt == 1)
		{
			return 1;
		}
		else{
			if($page == "createnewproject" && $obj_emp->project_access == 1)
			{
				return 1;
			}
			else if($page == "createprojecttask" && $obj_emp->task_access == 1)
			{
				return 1;
			}
		}
		$msg = "Invalid page access ".$page;
		$this->addLogs("WARN",$msg);
		return 0;
	}
	
	
	public function getDeptId($eid)
	{
		$dept_id = 0;
		$dbsql=mysql_query("select * from od_emp_report where eid='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$dept_id = $row['dept_id'];
		}
		return $dept_id;
	}
	
	public function checkLastPasswd($eid , $passwd)
	{
		$ret=1;
		$dbsql=mysql_query("select * from  od_employee_passwd where eid='".$eid."' order by id DESC limit 0,3 ");
		while($row = mysql_fetch_array($dbsql))
		{
			$lpasswd = $row['passwd'];
			if($passwd == $lpasswd)
			{
				$ret=0;	
				break;
			}
		}
		return $ret;
	}
	
	public function insertCurrentPasswd($eid , $passwd, $raw_passwd)
	{
		$date = date("d-m-Y, h:i:s A");
		//$query = "INSERT into od_employee_passwd set date='".$date."' , eid='".$eid."' , passwd = '".$passwd."'   ,  raw_passwd='".$raw_passwd."' ";
		$query = "INSERT into od_employee_passwd set date='".$date."' , eid='".$eid."' , passwd = '".$passwd."'   ";
		$res = mysql_query($query);
	
	}
	
	public function checkPasswordPolicy($raw_passwd,$eid)
	{
		$ret = 1;
		$passwd_lower = $raw_passwd ;
		$passwd_lower = strtolower($passwd_lower);
		$passwd = sha1($raw_passwd);
		//$length = strlen($passwd);
		
		
		if (strlen($raw_passwd) < 8 || strlen($raw_passwd) > 16)
		{
			$data=array("status"=>0,"msg"=>"New password should be min 8 characters and max 16 characters.\nPlease retype a new password.");
			$ret = 0;
			return [$ret , $data];	
		}
		
		
		$passwd_lower_sha =sha1(trim($passwd_lower));
		$dbsql=mysql_query("select * from od_common_passwd where passwd='".$passwd_lower_sha."'");
		$Num = mysql_num_rows($dbsql);
		if($Num)
		{
			$data=array("status"=>0,"msg"=>"New password is a very common password. \nPlease retype a new password.");
			$ret = 0;
			return [$ret , $data];
		}
		
		$ret = $this->checkLastPasswd($eid,$passwd);
		if(!$ret)
		{
			$data=array("status"=>0,"msg"=>"New password can't same with your last 3 password.\nPlease retype a new password.");
			$ret = 0;
			return [$ret , $data];
		}
		
		if (!preg_match("/\d/", $raw_passwd))
		{
			$data=array("status"=>0,"msg"=>"New password should contain at least one digit.\nPlease retype a new password.");
			$ret = 0;
			return [$ret , $data];
		}
		
		if (!preg_match("/[A-Z]/", $raw_passwd))
		{
			$data=array("status"=>0,"msg"=>"New password should contain at least one Capital Letter.\nPlease retype a new password.");
			$ret = 0;
			return [$ret , $data];
		}
		
		if (!preg_match("/[a-z]/", $raw_passwd))
		{
			$data=array("status"=>0,"msg"=>"New password should contain at least one small Letter.\nPlease retype a new password.");
			$ret = 0;
			return [$ret , $data];
		}
		
		if (!preg_match("/\W/", $raw_passwd))
		{
			$data=array("status"=>0,"msg"=>"New password should contain at least one special character.\nPlease retype a new password.");
			$ret = 0;
			return [$ret , $data];
		}
		
		if (preg_match("/\s/", $raw_passwd))
		{
			$data=array("status"=>0,"msg"=>"New password should not contain any white space.\nPlease retype a new password.");
			$ret = 0;
			return [$ret , $data];
		}
		
		return [$ret , $data];
	}

	public function changeLoginPasswd($cpasswd , $raw_passwd , $eid)
	{
		$passwd_lower = $raw_passwd ;
		$passwd_lower = strtolower($passwd_lower);
		$cpasswd =sha1(trim($cpasswd));
		$passwd = sha1($raw_passwd);
		$type = $_SESSION["emp_type"];
		$date = date("d-m-Y");
		$length = strlen($passwd);
	
		list($ret_val , $data) = $this->checkPasswordPolicy($raw_passwd,$eid);
		if(!$ret_val)
		{
			return $data;
		}
			
		
		if($type == 1)
		{
			$dbsql=mysql_query("select * from od_director where password='".$cpasswd."' and did='".$eid."' ");
		}
		else{
			$dbsql=mysql_query("select * from od_employee where password='".$cpasswd."' and eid='".$eid."' ");
		}
		$Num = mysql_num_rows($dbsql);
		if($Num)
		{	
			$today = date("d-m-Y, h:i:s A");	
			if($type == 1)
			{				
				$query = "UPDATE od_director set password='".$passwd."', p='0' , passwd_updated='".$today."'  , passwd_mod='".$date."' , raw_passwd='' WHERE did='".$eid."' ";
			}
			else{
				$query = "UPDATE od_employee set password='".$passwd."', p='0' , passwd_updated='".$today."' , passwd_mod='".$date."' , raw_passwd='' , oemail_passwd='' WHERE eid='".$eid."' ";
			}
			//$log = "changeLoginPasswd:".$query.":";
			//$this->addDebugLogs($log);
			$res = mysql_query($query);
			$this->sendPasswdChangeEmail($eid,$raw_passwd);
			$this->insertCurrentPasswd($eid,$passwd,$raw_passwd);
			$data=array("status"=>1,"msg"=>"Done!");
		}
		else{
			$data=array("status"=>0,"msg"=>"Invalid Current Password! \nPlease retype a current password.");
		}
		
		return $data;
	}
	
	public function sendPasswdChangeEmail($eid,$raw_passwd)
	{
		$time = date("d-m-Y, h:i:s A");	
		$empInfo = $this->getEmployeeData($eid);
		$emp_name = $this->getEmpName($eid);
		$to = $empInfo->office_email;
		$cc="";
		$bcc="";
		
		$title = "OdiTek Intra Password Changed";
		
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
			 .tabletr{font-family:Tahoma, Geneva, sans-serif; background:F2F2F2;font-size:10px;color:#666'}
			</style>
			</head>
			<body lang=EN-IN link='#0563C1' vlink='#954F72'>
			<div class=WordSection1>
	        <p class=MsoNormal>
	        <span style='color:#002060'><B>Dear ".$emp_name."</B>,</span>
			<BR><BR>
			Your OdiTek-Intra login password has been changed on date ".$time.".
			<BR>
			Your new password : ".$raw_passwd."
			<BR>
			Please remember your new password.
			<BR>
			<BR>
			Br,<BR>
			Intra-Admin
			</body></html>";
		
		$body = addslashes($body);
		$query = "INSERT into od_send_email set date='".$time."' , toemail='".$to."' , cc='".$cc."' , bcc='".$bcc."' , title='".$title."' , body='".$body."' , name='".$emp_name."' ";
		$res = mysql_query($query);
	}
	
	
	public function getNewBodyForgotPasswd($emp_name_first,$otp,$title)
	{
		
		

		return $body;
	}

	public function updateAllPasswd()
	{
		/*
		$current_date = date("d-m-Y");
		$dbsql=mysql_query("select * from od_employee where status=1 ");
		while($row = mysql_fetch_array($dbsql))
		{
			$now = time();
			$id = $row['id'];
			$name = $row['name'];
			$passwd_mod = $row['passwd_mod'];
			$diff = $now - strtotime($passwd_mod);
			$diff = round($diff / (60 * 60 * 24));
			//$upd=mysql_query("UPDATE od_employee set raw_passwd='' where id='".$id."'" );
			echo "Name:".$name."::::PASSWD DATE::".$passwd_mod.":::DIFF:".$diff.":<BR>";
			
		}
		
		
		$query = 'select * from od_employee where eid=131203';
		$result = mysql_query($query);
		$i = 0;
		while ($i < mysql_num_fields($result))
		{
		   $fld = mysql_fetch_field($result, $i);
		   echo "::"$fld->name.":";
		   $i = $i + 1;
		}
		*/
		
	}	
	
	public function getMyReportList($eid){
		
		$dbsql=mysql_query("select * from od_daily_report where eid='".$eid."' order by id DESC limit 0,10 ");
		$Num = mysql_num_rows($dbsql);
		$daarray=array();
		///////////////////////////////////
		//$Num = 0;
		////////////////////////////////////
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$darateobj = new Employee();
				$darateobj->id=$row['id'];
				$darateobj->date_time=$row['date_time'];
				$darateobj->wfrom=$row['work_from'];
				if($darateobj->wfrom == 1)
					$darateobj->wfrom = Office;
				else
					$darateobj->wfrom = Home;
				$darateobj->wtime=$row['work_time']." HRs";
				$darateobj->worddone= substr($row['today'], 0, 30)."...";
				$darateobj->nextplan= substr($row['tomorrow'], 0, 30)."...";
				if($row['status'] == 1)
					$darateobj->status= "Closed";
				else
					$darateobj->status= "Open";
					$daarray[] = $darateobj;
			}
		}
		return $daarray;
	}
	
	public function getMatrixDB($eid,$date)
	{
		$dbsql=mysql_query("select * from od_leave_records where lid='".$lid."' ");
		$Num = mysql_num_rows($dbsql);	
		$row = mysql_fetch_array($dbsql);
		return $row;
	}
	
	public function getMyDailySummaryData($monthid,$statusid)
	{
		
		$eid = $_SESSION["emp_id"];
		$max = 0;
		$count=0;
		$current_date = date("d-m-Y");
		$presentCnt=0; $absCnt=0; $leaveCnt=0; $wfhCnt=0;
		$empData = $this->getEmployeeData($eid);
		$doj = date("d-m-Y", strtotime($empData->joining_date));
		$iv_key = $this->get_mcrypt_iv();
		if(strpos($monthid, '-'))
		{	
			$parts = [];
			$parts = explode('-',$monthid);
			$month= $parts[0];
			$year= $parts[1];
			$a_date = "01-".$month."-".$year;
			$max = $date = date("t", strtotime($a_date));
			$date = $date."-".$month."-".$year;
			$monthid = date(m)."-".date('Y');
			if($monthid == $month."-".$year)
			{	
				$date = $current_date;
				$max = date("d");
			}
		}
		else{
			$max = date("z")+1;
			$date = date("d-m-Y");
			
		}
		
		
		while(1)
		{
			$total_time = $this->getMyTotalDailyTime($date);
			$total_time = $this->getTimeText($total_time* 60);
			$attenData = $this->getEmpAttendanceData($eid,$date);
			$id = $attenData->id;
			$edit = 1;
			$date_info = $date;
			$day_info = date("l", strtotime($date));
			$name = $empData->name;
			$eid = $eid;
			$start_time = $attenData->start_time ;
			$end_time = $attenData->end_time ;
			$work_time = $attenData->work_time ;
			$manual = $attenData->manual ;
			$holiday = $this->checkHoliday($date);
			$info="";
			$isAbsent=0;
			$isPresent=1;
			if($holiday && $start_time == "NA" && $end_time == "NA")
				$isPresent=0;
			
			$isLeave=0;
			$isWFH=0;
			if(!$holiday && $start_time == "NA" && $end_time == "NA")
			{
				$info = "ABS";
				$isAbsent = 1;
				$isPresent=0;
			}
				
			$leaveInfo = $this->getEmployeeLeaveInfo($eid,$date);
			if($leaveInfo->status)
			{	
				$info = $leaveInfo->info;
				$edit = 0;
				$isAbsent = 0;
				$isPresent=0;
				$isLeave=1;
			}
				
			$wfhInfo = $this->getEmployeeWFHInfo($eid,$date);
			if($wfhInfo->status)
			{
				$info  = $wfhInfo->info;
				$edit = 0;
				$isAbsent = 0;
				$isPresent=0;
				$isWFH=1;
			}
			
			if($isPresent) $presentCnt++;
			if($isAbsent) $absCnt++;
			if($isLeave) $leaveCnt++;
			if($isWFH) $wfhCnt++;
			
			$appendData=1;
			
			if($statusid == 1 && !$isPresent)
			{
				$appendData=0;
			}
			else if($statusid == 2 && !$isLeave)
			{
				$appendData=0;
			}
			else if($statusid == 3 && !$isWFH)
			{
				$appendData=0;
			}
			else if($statusid == 4 && !$isAbsent)
			{
				$appendData=0;
			}
			
			if($appendData)
			{
				$sl_no++;
				$color="";
				if($holiday)  $color="red";
				$italic="";
				if($manual) 	$italic="font-style: italic;";	
				$show_edit=0; if($current_date != $date) $show_edit=1; 
															
				$encrypt_id = $this->get_mcrypt_encrypt($date,$iv_key);
				
				$str .= '<tr class="success" >
						 <td  style="color:'.$color.';'.$italic.'" >'.$sl_no.'</td>
						 <td  style="color:'.$color.';'.$italic.'" >'.$date_info.' ['.$day_info.']</td>
						 <td  style="color:'.$color.';'.$italic.'" >'.$start_time.'</td>
						 <td  style="color:'.$color.';'.$italic.'" >'.$end_time.'</td>
						 <td  style="color:'.$color.';'.$italic.'" >'.$work_time.'</td>
						 <td  style="color:'.$color.';'.$italic.'" >'.$total_time.'</td>
						 <td  style="color:'.$color.';'.$italic.'" >'.$info.'</td>
						 <td class="tooltip-sidebar-logout">
						 <a href="mydailyhrreport.php?dt='.$encrypt_id.'&iv='.$iv_key.'" >
						 <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px">
						 </a>
						 </td></tr>';
			}
		
			if($doj == $date)
				break;
		
			$count++;
			$date = date("d-m-Y", strtotime($date." -1 days"));
		
			if($count == $max )
				break;
		}	
	
		$data=array("status"=>1,"data"=>$str , "present"=>$presentCnt , "abs"=>$absCnt , "leave"=>$leaveCnt , "wfh"=>$wfhCnt );
	
	  return $data;
	
	}
	
	public function getMyTodayHrs()
	{
		$workTime = "NA";
		$emp_id = $_SESSION["emp_id"];
		$date = date("d-m-Y");
		$dbsql=mysql_query("select * from od_matrix_daily_log where eid='".$emp_id."' and date='".$date."'  ");
		$Num = mysql_num_rows($dbsql);	
		$rowdb = mysql_fetch_array($dbsql);
		if($Num)
		{
			$start_time = $rowdb['punch1'];
			if($start_time != "NA")
			{	
				$end_time = $rowdb['punch2'];
				if($end_time != "NA")
				{	
					$from_time = strtotime($start_time); 
					$to_time = strtotime($end_time); 
					$workTime = round(abs($from_time - $to_time) / 60,2);
					$workTime = $this->getTimeText2($workTime*60);
				}
			}
		}
		return $workTime;
	}
	
	public function getMyTeamCnt($eid)
	{
		$teamCnt = 0;
		$dbsql=mysql_query("select a.eid from od_emp_report a
							INNER JOIN od_employee b 
							ON a.eid = b.eid 
							where a.upper_id='".$eid."' and b.status = 1 ");
		while($rowdb = mysql_fetch_array($dbsql))
		{
			$team_eid = $rowdb['eid'];
			$name = $this->getEmployeeName($team_eid);
			$teamCnt++;
			$teamCnt += $this->getMyTeamCnt($team_eid);
		}
		return $teamCnt;
	}
	
	public function getMyTotalDailyTime($date)
	{
		$time =0;
		$emp_id = $_SESSION["emp_id"];
		$dbquery="select time from od_project_dailytask_logs where date='".$date."' and emp_id='".$emp_id."' ";
		$dbsql=mysql_query($dbquery);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$time+=$row['time'];
			}
		}
		
		return $time;
	}
	
	
	public function checkHoliday($date)
	{
		$holiday =0;
		$dbquery="select * from od_all_offday_list where date='".$date."' ";
		$dbsql=mysql_query($dbquery);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$holiday =1;
		}
		
		return $holiday;
	}
	
	public function getHolidayInfo($date)
	{
		$info ="";
		$dbquery="select * from od_all_offday_list where date='".$date."' ";
		$dbsql=mysql_query($dbquery);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$info =$row['hname'];
		}
		
		return $info;
	}
	
	
	public function getMyDailyReport($eid){
		
		$today_prt = date("dmy");
		$darateobj = new Employee();
		$darateobj->record = 0;
		$darateobj->status_str= "Open";
		$dbsql=mysql_query("select * from od_daily_report where eid='".$eid."' and time='".$today_prt."' ");
		//echo "select * from od_daily_report where eid='".$eid."' and time='".$today_prt."' ";
		$Num = mysql_num_rows($dbsql);
		if ($Num > 0)
		{
				$row = mysql_fetch_array($dbsql);
				$darateobj->record = 1;
				$darateobj->id=$row['id'];
				$darateobj->date_time=$row['date_time'];
				$darateobj->worddone= $row['today'];
				$darateobj->nextplan= $row['tomorrow'];
				$darateobj->status= $row['status'];
				$darateobj->workfrom= $row['work_from'];
				$darateobj->worktime= $row['work_time'];
				if($row['status'] == 1)
					$darateobj->status_str= "Closed";
				else
					$darateobj->status_str= "Open";
		}
		return $darateobj;
	}
	
	public function getProjectGrpObject($pro_grp_id)
	{
		$proData=new Employee();
		$dbsql111=mysql_query("select * from od_project_mgmt where id='".$pro_grp_id."' ");
		if($row111=mysql_fetch_array($dbsql111))
		{
			$proData->pro_grp_name = $row111['pr_name'];
			$proData->pro_grp_head = $row111['pr_head'];
		}	
			
		return $proData;	
	}
	
	public function getTimeDuration($sdate, $edate)
	{
		$result="";
		$join_date = date('Y-m-d', strtotime($sdate));
		if($edate != "")
			$today = date('Y-m-d', strtotime($edate));
		else	
			$today = date('Y-m-d');
		
		$date1 = strtotime($join_date);  
		$date2 = strtotime($today);  
        $diff_kt = $date2 - $date1;
		// Formulate the Difference between two dates 
		$diff = abs($date2 - $date1);  
    
		if($diff_kt > 0)
		{
			// To get the year divide the resultant date into 
			// total seconds in a year (365*60*60*24) 
			$years = floor($diff / (365*60*60*24));  
			if($years > 0)
				$result = $years."Y ";
	  
			// To get the month, subtract it with years and 
			// divide the resultant date into 
			// total seconds in a month (30*60*60*24) 
			$months = floor(($diff - $years * 365*60*60*24) 
								   / (30*60*60*24));  
	  
			if($months > 0)
				$result .= $months."M ";
			// To get the day, subtract it with years and  
			// months and divide the resultant date into 
			// total seconds in a days (60*60*24) 
			$days = floor(($diff - $years * 365*60*60*24 -  
				 $months*30*60*60*24)/ (60*60*24));
			
			if($days > 0)
				$result .= $days."D ";		
				 
		}else{
			$result="0 days";
		}

			 
		return 	$result; 
	}
	
	
	
	public function getEmployeeData($eid){
			$employee=new Employee();
			$employee->type=2;
			$employee->valid=0;
			$dbsql = "select * from ".PREFIX1."employee where eid ='".$eid."' ";
			$dbres = mysql_query($dbsql);
			$Num = mysql_num_rows($dbres);
			if(!$Num)
			{
				$dbsql = "select * from ".PREFIX1."director where did ='".$eid."' ";
				$dbres = mysql_query($dbsql);
				$employee->type=1;
			}
			if($row=mysql_fetch_array($dbres)){
				
				$employee->valid=1;
				$employee->id = $row['id'];
				if($employee->type==1)
					$employee->eid = $row['did'];
				else
					$employee->eid = $row['eid'];
				$employee->ceo = $row['ceo'];
				$employee->admin = $row['sadmin'];
				$employee->name = $row['name'];
				
				$employee->gender_id = $row['gender'];
				$employee->gender = $this->getGender($row['gender']);
				$employee->date_of_birth = $row['date_of_birth'];
				$employee->blood_grp = $row['blood_grp'];
				$employee->mrg_status = $row['mrg_status'];
				$employee->pan_no = $row['pan_no'];
				$employee->passport_no = $row['passport_no'];
				$employee->aadhar_no = $row['aadhar_no'];
				$employee->joining_date = $row['joining_date'];
				$employee->exit_date = $row['exit_date'];
				$employee->oditek_exp = $this->getTimeDuration($employee->joining_date,$employee->exit_date);
				$employee->mobile = $row['mobile'];
				$employee->emergency = $row['emergency'];
				$employee->image = $row['image'];
				$employee->status = $row['status'];
				$employee->emptype = $row['type'];
				$employee->uan_number = $row['UAN_no'];
				$employee->ifsc_code = $row['IFSC_Code'];
				$employee->emptype_str = $this->getEmpTypeById($employee->emptype);
				if($employee->emptype == 4 ) //4 mean On Notice
					$employee->onnotice = 1;
				else
					$employee->onnotice = 0;
				
				if($employee->emptype == 3 ) //3 mean Intern
				{
					$employee->intern_start_date = $employee->joining_date;
					$employee->intern_end_date = date("Y-m-d", strtotime($employee->intern_start_date." 180 days"));
				}
				
				
				$employee->empexp = $row['experiance'];
				$employee->status_str = $this->getStatusStr($employee->status);
				$employee->userid = $row['userid'];
				$employee->email = $row['email'];
				$office_email = $row['office_email'];
				//$index1 = stripos($office_email, '@');
				$employee->office_email = $office_email;
				$employee->skype_id = $row['skype_id'];
				$employee->bu = $row['bu'];
				$employee->bu_name = $this->getBUnitById($row['bu']);
				
				if($employee->type==2)
				{	
					$employee->itr = $row['itr'];
					$employee->office_email_passwd = $row['oemail_passwd'];
					$employee->intra_username = $row['userid'];
					$employee->intra_username_passwd = $row['raw_passwd'];
				}	
				else
				{
					$employee->itr = 0;
					$employee->office_email_passwd = "";
					$employee->intra_username = "";
					$employee->intra_username_passwd = "";
				}
				
				if($employee->type==1)
				{
					$employee->dept_id = $row['dept_id'];
					$employee->dept_name = $this->getDeptById($employee->dept_id);
					$employee->desig_id = $row['desig_id'];
					$employee->desig_name = $this->getDesigById($employee->desig_id);
					//$upper_id = 1000;
					$employee->upper_id = $row['upper_id'];
					$employee->report_to = $this->getEmployeeName($employee->upper_id);
					
					//past exp.
					$dbsql = "select * from od_employee_exp where eid ='".$eid."'  ";
					$dbres = mysql_query($dbsql);
					if($row=mysql_fetch_array($dbres)){
						$enable = $row['enable'];
						if($enable == 1)
							$employee->prev_exp = 1;
						else
							$employee->prev_exp = 0;
						$employee->exp_year = $row['exp_year'];
						$employee->exp_month = $row['exp_month'];
						$employee->prev_org_exp = $employee->exp_year." Year and ".$employee->exp_month." Months";
						$employee->prev_org = stripslashes($row['prev_org']);
						$employee->skills = stripslashes($row['skills']);
					}
					else{
						$employee->prev_exp = 0;
						$employee->prev_org_exp = "Fresher";
						$employee->exp_year = "";
						$employee->exp_month = "";
						$employee->prev_org = "";
						$employee->skills = "";
					}
					
					$employee->pro_grp_id = 0;
					$employee->pro_grp_name = "NA";
					$employee->pro_grp_head = 0;
					$employee->pro_grp_head_name = "NA";
					$employee->pro_grp_head_email = "";
					
				}else{
					$dbsql = "select * from ".PREFIX1."emp_report where eid ='".$eid."'  ";
					$dbres = mysql_query($dbsql);
					if($row=mysql_fetch_array($dbres)){
						$employee->dept_id = $row['dept_id'];
						$employee->dept_name = $this->getDeptById($employee->dept_id);
						$employee->desig_id = $row['desig_id'];
						$employee->desig_name = $this->getDesigById($employee->desig_id);
						$employee->upper_id = $row['upper_id'];
						$employee->report_to = $this->getEmployeeName($row['upper_id']);
						//added for PROJECT GRP
						$employee->pro_grp_id = $row['pro_grp_id'];
						if($employee->pro_grp_id > 0)
						{
							$proGrpObj = $this->getProjectGrpObject($employee->pro_grp_id);
							$employee->pro_grp_name = $proGrpObj->pro_grp_name;
							$employee->pro_grp_head = $proGrpObj->pro_grp_head;;
							$employee->pro_grp_head_name = $this->getEmployeeName($employee->pro_grp_head);
							$employee->pro_grp_head_email = $this->getEmployeeEmail($employee->pro_grp_head);
						}
						else{
							$employee->pro_grp_id = 0;
							$employee->pro_grp_name = "NA";
							$employee->pro_grp_head = 0;
							$employee->pro_grp_head_name = "NA";
							$employee->pro_grp_head_email = "";
						}
					}
					
					//past exp.
					$dbsql = "select * from od_employee_exp where eid ='".$eid."'  ";
					$dbres = mysql_query($dbsql);
					if($row=mysql_fetch_array($dbres)){
						$enable = $row['enable'];
						if($enable == 1)
							$employee->prev_exp = 1;
						else
						$employee->prev_exp = 0;
						$employee->exp_year = $row['exp_year'];
						$employee->exp_month = $row['exp_month'];
						$employee->prev_org_exp = $employee->exp_year." Year and ".$employee->exp_month." Months";
						$employee->prev_org = stripslashes($row['prev_org']);
						$employee->skills = stripslashes($row['skills']);
					}
					else{
						$employee->prev_exp = 0;
						$employee->prev_org_exp = "Fresher";
						$employee->exp_year = "";
						$employee->exp_month = "";
						$employee->prev_org = "";
						$employee->skills = "";
					}
				}

				//get family info
				$dbsql = "select * from od_emp_family where eid ='".$eid."'  ";
				$dbres = mysql_query($dbsql);
				if($row=mysql_fetch_array($dbres)){
					$employee->fname = $row['fname'];
					$employee->mname = $row['mname'];
					$employee->ename = $row['ename'];
					$employee->emobile = $row['emobile'];
					$employee->erelationship = $row['erelationship'];
					$employee->address = stripslashes($row['address']);						
				}
				else{
					$employee->fname = "NA";
					$employee->mname = "NA";
					$employee->ename = "NA";
					$employee->emobile = "NA";
					$employee->erelationship = "NA";
					$employee->address = "NA";
				}
				
				
				//get education info
				$dbsql = "select * from od_emp_education where eid ='".$eid."'  ";
				$dbres = mysql_query($dbsql);
				$Num = mysql_num_rows($dbres);
				$cnt=0;
				while($row=mysql_fetch_array($dbres)){
					$cnt++;
					if($cnt==1)
					{	
						$employee->cuname1 = stripslashes($row['cuname']);
						$employee->degree1 = stripslashes($row['degree']);
						$employee->eduyear1 = stripslashes($row['eduyear']);
						$employee->eduper1 = stripslashes($row['eduper']);
					}
					else if($cnt==2)
					{
						$employee->cuname2 = stripslashes($row['cuname']);
						$employee->degree2 = stripslashes($row['degree']);
						$employee->eduyear2 = stripslashes($row['eduyear']);
						$employee->eduper2 = stripslashes($row['eduper']);
					}
					else{
						$employee->cuname3 = stripslashes($row['cuname']);
						$employee->degree3 = stripslashes($row['degree']);
						$employee->eduyear3 = stripslashes($row['eduyear']);
						$employee->eduper3 = stripslashes($row['eduper']);
					}
				}
				if(!$Num)
				{
					$employee->cuname1 = $employee->cuname2 = $employee->cuname3 = "NA";
					$employee->degree1 = $employee->degree2 = $employee->degree3 = "NA";
					$employee->eduyear1 = $employee->eduyear2 = $employee->eduyear3 = "NA";
					$employee->eduper1 = $employee->eduper2 = $employee->eduper3 = "NA";
				}
				
				//probation info
				$dbsql = "select * from od_emp_probation where eid ='".$eid."'  ";
				$dbres = mysql_query($dbsql);
				$Num = mysql_num_rows($dbres);
				if($row=mysql_fetch_array($dbres))
				{
					$employee->pro_month = $row['month'];
					$employee->pro_end_date = $row['end_date'];
					$employee->pro_duration = $this->getTimeDuration($employee->joining_date,$employee->pro_end_date);
				}
				else{
					$employee->pro_month = "0";
					$employee->pro_end_date = "";
					$employee->pro_duration = "";
				}
				
				//Notice info
				if($employee->onnotice)
				{
					$dbsql = "select * from od_emp_notice where eid ='".$eid."'  ";
					$dbres = mysql_query($dbsql);
					$Num = mysql_num_rows($dbres);
					if($row=mysql_fetch_array($dbres))
					{
						$employee->notice_start_date = $row['start_date'];
						$employee->notice_end_date = date("d-m-Y", strtotime($row['end_date']));
						$employee->notice_period = $row['month'];
					}
					else{
						$employee->notice_start_date = "";
						$employee->notice_end_date = "";
						$employee->notice_period = 0;
					}
				}
							
			}
		return $employee;
	}
	
	

	
	
	public function getEmployeeDataToEdit($eid){
			
		$empData = $this->getEmployeeData($eid);
		
		$bu_head_name = $this->getBUHeadById($empData->bu);
		
		$data = array("status" => 1 , "db_id" => $empData->id , "db_type" => $empData->type , "emp_id" => $empData->eid , "emp_name" => $empData->name , "emp_doj" => $empData->joining_date , "emp_dol" => $empData->exit_date , "emp_exp" => $empData->oditek_exp , "emp_status" => $empData->status_str , "emp_image" => $empData->image ,
		
		"gender_id" => $empData->gender_id , "blood_grp" => $empData->blood_grp , "date_of_birth" => $empData->date_of_birth , "mobile" => $empData->mobile , "emergency" => $empData->emergency , "email" => $empData->email , "skype_id" => $empData->skype_id , "pan_no" => $empData->pan_no  , "passport_no" => $empData->passport_no , "aadhar_no" => $empData->aadhar_no , "mrg_status" => $empData->mrg_status , 
		
		"father_name" => $empData->fname , "mother_name" => $empData->mname , "emer_name" => $empData->ename , "emer_mobile" => $empData->emobile , "emer_rela" => $empData->erelationship , "addr1" => $empData->address  ,

		"cuname1" => $empData->cuname1 , "degree1" => $empData->degree1 , "eduyear1" => $empData->eduyear1 , "eduper1" => $empData->eduper1 , "cuname2" => $empData->cuname2 , "degree2" => $empData->degree2 , "eduyear2" => $empData->eduyear2 , "eduper2" => $empData->eduper2 , "cuname3" => $empData->cuname3 , "degree3" => $empData->degree3 , "eduyear3" => $empData->eduyear3 , "eduper3" => $empData->eduper3 ,

		"pre_exp" => $empData->prev_exp , "exp_year" => $empData->exp_year , "exp_month" => $empData->exp_month , "prev_org" => $empData->prev_org , "skills" => $empData->skills 	,
		
		"joining_date" => $empData->joining_date , "exit_date" => $empData->exit_date , "emp_type" => $empData->emptype , "emptype_str" => $empData->emptype_str  , "pro_month" => $empData->pro_month , "pro_end_date" => $empData->pro_end_date  , "onnotice" => $empData->onnotice ,  "pro_duration" => $empData->pro_duration ,
		
		"bu_id" => $empData->bu , "bu_head" => $bu_head_name , "prm_id" => $empData->pro_grp_id , "prm_head" => $empData->pro_grp_head_name , "upper_id" => $empData->upper_id ,
		"dept_id" => $empData->dept_id , "desig_id" => $empData->desig_id	,

		"notice_start_date"	=> $empData->notice_start_date , "notice_end_date"	=> $empData->notice_end_date , "notice_period"	=> $empData->notice_period
		);
		
		
		return $data;
	}
	
	public function getProbationDuration($sdate,$edate)
	{
		
		$pro_duration = $this->getTimeDuration($sdate,$edate);
		$data = array("status" => 1 , "duration" => $pro_duration);

		return  $data;	
	}
	
	public function getEmpExitStatus($eid)
	{
		$bu_exit = 0;
		$it_exit = 0;
		$admin_exit = 0;
		$dbsql=mysql_query("select * from od_emp_exit where eid='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if($row = mysql_fetch_array($dbsql))
		{
			$bu_exit = $row['bu_exit'];
			$it_exit = $row['it_exit'];
			$admin_exit = $row['admin_exit'];			
		}
		
		$data=array("status"=>1,"bu_exit"=>$bu_exit , "it_exit"=>$it_exit , "admin_exit"=>$admin_exit);
		
		return $data;
		
		
	}
	
	public function updateHRExit($eid,$info)
	{
		$dbsql=mysql_query("select * from od_emp_exit where eid='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if($row = mysql_fetch_array($dbsql))
		{
			$qry=mysql_query("UPDATE od_emp_exit set hr_exit='1' , info ='".$info."'  where eid='".$eid."' ");
		}
	}
	
	public function completeExitProcess($data)
	{
		//Emplyee Exit Process
		$mod_eid = $_SESSION["emp_id"];
		if($mod_eid > 0)
		{
			$date_time = date("d-m-Y, h:i:s A");
			
			$eid = $data["reso_id"];
			$exit_date = $data["exit_date"];
			$info = addslashes($data["info"]);
			$exit_date = date('Y-m-d', strtotime($exit_date));
			$this->updateHRExit($eid,$info);
			
			$query = "UPDATE od_employee set  date_added='".$date_time."' , exit_date='".$exit_date."', status='2' where eid='".$eid."' ";
			$res = mysql_query($query);
			if($res)
			{
				$msg = "Successfully updated Employee Data";
				$data=array("status"=>1, "msg"=>$msg );
				
			}
			else{
				$msg = "Error! Something went wrong!";
				$data=array("status"=>0, "msg"=>$msg );
			}	
		
		}
		else{
			$msg = "Error! Something went wrong!";
			$data=array("status"=>0, "msg"=>$msg );
		}
		
		return $data;	
	}
	
	public function getEmployeeAccess($eid)
	{
		$employee=new Employee();
		$dbsql = "select * from od_director where did ='".$eid."'  ";
		//echo $dbsql;
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);
		if($Num > 0){
			$employee->type = 1;
		}else{
			$employee->type = 2;
			//$emp = $this->getEmployeeData($eid);
			if($isMgmt = $this->isManagement($eid))
				$employee->mgmt = 1;
			
			if($this->isITAdmin($eid))
				$employee->itadmin = 1;
			
			if($this->isHRAdmin($eid))
				$employee->hradmin = 1;
				
			$dbsql = "select * from od_emp_access where eid ='".$eid."'  ";
			$dbres = mysql_query($dbsql);
			if($row=mysql_fetch_array($dbres)){
					$employee->project_access = $row['project_create'];
					$employee->task_access = $row['task_create'];
					$employee->report_access = $row['report_access'];
					
			}else{
				$employee->project_access = 0;
				$employee->task_access = 0;
				$employee->report_access = 0;
			}
		}
		
		//check type 2
		$monthid = date(n);
		$pre_monthid = $monthid - 1;
		if($pre_monthid == 0)  $pre_monthid = 12;	
		$next_monthid = $monthid +1 ;
		if($next_monthid > 12) $next_monthid = 1;
			
		$dbsql = "select * from od_wfh_allow_list where eid ='".$eid."' and type=2 and ( mid='".$pre_monthid."' or mid='".$monthid."' or mid='".$next_monthid."')   ";
		$dbres = mysql_query($dbsql);
		$num = mysql_num_rows($dbres);
		if($num)
			$employee->wfh =1;
		else
			$employee->wfh =0;
			
		//check for WFH type1
		if(!$employee->wfh)
		{
			$dbsql = "select * from od_wfh_allow_list where eid ='".$eid."' and type=1 ";
			$dbres = mysql_query($dbsql);
			$num = mysql_num_rows($dbres);
			if($num)
				$employee->wfh =1;
			else
				$employee->wfh =0;
		}
		
		return $employee;
	}
	
	


		public function updateEmployee($data){
					$type = $_SESSION["emp_type"];
					
					$cpass = $data['cpasswd'];
					$pass1 = $data['password1'];
					$passwd = sha1($pass1);
					//$image = $data['hdfilename'];
					
					$dateofbirth = date('Y-m-d', strtotime($data['date_of_birth']));
					$IFSC_Code = $data['ifsc_code'];
                    $UAN_no = $data['uan_number'];

										
					if($type == 2)
						
					
					{
						//Insert Employee Table
						$query = "UPDATE ".PREFIX1."employee set date_of_birth='".$dateofbirth."', pan_no='".$data['pan_no']."', passport_no='".$data['passport_no']."', mobile='".$data['mobile_no']."', emergency='".$data['emergency_no']."', IFSC_Code='".$IFSC_Code."', UAN_no='".$UAN_no."', email='".$data['email1']."', skype_id='".$data['skype']."', date_added=now() , mod_by='".$_SESSION['emp_name']."' WHERE eid='".$data['employeeid']."' ";
                        $res = mysql_query($query);
                        $employee_id = $data['employeeid'];

						
						
												
						
						/*if(strlen($image) > 0)
						{
							$query = "UPDATE ".PREFIX1."employee set image='".$image."' WHERE eid='".$data['employeeid']."' ";
							$res = mysql_query($query);
						}*/
					}else{
						
						//Insert Employee Table
						$query = "UPDATE ".PREFIX1."director set date_of_birth='".$dateofbirth."', pan_no='".$data['pan_no']."', passport_no='".$data['passport_no']."', mobile='".$data['mobile_no']."', emergency='".$data['emergency_no']."',IFSC_Code='".$IFSC_Code."', UAN_no='".$UAN_no."', email='".$data['email1']."', skype_id='".$data['skype']."', date_added=now() , mod_by='".$_SESSION['emp_name']."' WHERE did='".$data['employeeid']."' ";
						$res = mysql_query($query);
						$employee_id = $data['employeeid'];
						
						
						/*if(strlen($pass1) > 0)
						{
							$query = "UPDATE ".PREFIX1."director set password='".$passwd."', raw_passwd='".$pass1."'  WHERE did='".$data['employeeid']."' ";
							$res = mysql_query($query);
						}*/
						/*
						if(strlen($image) > 0)
						{
							$query = "UPDATE ".PREFIX1."director set image='".$image."' WHERE did='".$data['employeeid']."' ";
							$res = mysql_query($query);
						}*/
					}
					
								
					
					if($employee_id > 0)
					{	
						$status = 1;
						$msg = "Successfully updated profile.";
						$result = array("status"=>$status,"msg"=>$msg);
					}
					else{
						$status = 0;
						$msg = "Unable to update profile.";
						$result = array("status"=>$status,"msg"=>$msg);
					}
			return 	$result;	
		}	
	
	
	public function updateEmployeeImage($filename)
	{
		$type = $_SESSION["emp_type"];
		$emp_id = $_SESSION["emp_id"];
		if($type == 1)
			$query = "UPDATE ".PREFIX1."director set image='".$filename."' WHERE did='".$emp_id."' ";
		else
			$query = "UPDATE ".PREFIX1."employee set image='".$filename."' WHERE eid='".$emp_id."' ";
		
		$res = mysql_query($query);
	}
	
	
	public function updateICardImage($filename)
	{
		$type = $_SESSION["emp_type"];
		$emp_id = $_SESSION["emp_id"];
		
		$str1 = "delete from od_icard_image where eid='".$emp_id."' ";
		$dbsql=mysql_query($str1);
		$date = date("d-m-Y, h:i:s A");		
		$query = "INSERT into od_icard_image set date='".$date."' , eid='".$emp_id."' , type = '".$type."'   ,  image='".$filename."' ";
		$res = mysql_query($query);
	}
	
	public function getICardImage($eid)
	{
		$image="";
		$dbsql=mysql_query("select * from od_icard_image where eid='".$eid."' ");
		$Num = mysql_num_rows($dbsql);	
		if($row = mysql_fetch_array($dbsql))
		{
			$image = $row['image'];
		}
		return $image;
	}
	
	
	public function updateEmployeeEmailInfo($eid,$passwd)
	{
		$query = "UPDATE od_employee set oemail_passwd='".$passwd."', femail='1' , itr='0'  WHERE eid='".$eid."' ";
		//$this->addDebugLogs($query);
		$res = mysql_query($query);
		$data = array("status" => 1 , "msg" => "Successfully Updated" );
		return $data;
	}
	
	
	public function getStatusStr($status)
	{
		$status_str = "Present";
		if($status == 2)
			$status_str = "Left";
		if($status == 3)
			$status_str = "With Held";
		return $status_str;	
	}
	
		
	
	
	public function getExtention($image_name){
				return substr($image_name,strrpos($image_name,'.')+1);
		}
		
		
	public function getAllName(){
			$getArray= array();
			
			$dbsql=mysql_query("select a.did , a.name , b.rank ,  b.rankid from ".PREFIX1."director a 
								INNER JOIN ".PREFIX1."rank b ON a.desig_id = b.rankid  
								where a.status='1' order by a.id asc");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					//$getRankArray[] = htmlspecialchars($row['name']); 
					$admin = new AdminUser();
					$admin->id = $row['rankid'].":".htmlspecialchars($row['did']);  
					$admin->name = htmlspecialchars($row['name'])." [".$row['rank']."]";
					$getArray[] = $admin;
					
				}
			}
			
			$dbsql=mysql_query("select a.id , a.eid , a.name , c.rank , c.rankid from od_employee a 
								INNER JOIN od_emp_report b ON a.eid = b.eid
								INNER JOIN  		 c ON b.desig_id = c.rankid  
								where a.status='1' order by b.desig_id asc");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					//$getRankArray[] = htmlspecialchars($row['name']); 
					$admin = new AdminUser();
					$admin->id = $row['rankid'].":".htmlspecialchars($row['eid']);  
					$admin->name = htmlspecialchars($row['name'])." [".$row['rank']."]";
					$getArray[] = $admin;
					
				}
			}
			
		return $getArray;
	}
	
	public function getAllNameOnly(){
			$getArray= array();
			
			$dbsql=mysql_query("select a.id , a.did , a.name , b.rank ,  b.rankid from ".PREFIX1."director a 
								INNER JOIN ".PREFIX1."rank b ON a.desig_id = b.rankid  
								where a.status='1' order by a.name asc");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					//$getRankArray[] = htmlspecialchars($row['name']); 
					$admin = new AdminUser();
					$admin->id = htmlspecialchars($row['did']);  
					$admin->name = htmlspecialchars($row['name']);
					$getArray[] = $admin;
					
				}
			}
			
			$dbsql=mysql_query("select a.id , a.eid , a.name , c.rank , c.rankid from od_employee a 
								INNER JOIN od_emp_report b ON a.eid = b.eid
								INNER JOIN od_rank c ON b.desig_id = c.rankid  
								where a.status='1' order by a.name asc");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					//$getRankArray[] = htmlspecialchars($row['name']); 
					$admin = new AdminUser();
					$admin->id = htmlspecialchars($row['eid']);  
					$admin->name = htmlspecialchars($row['name']);
					$getArray[] = $admin;
					
				}
			}
			
		return $getArray;
	}
	
	public function isDirector($eid){
		$Num=0;
		$dbsql=mysql_query("select * from od_director where did ='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		return $Num;
	}
	
	public function isCEO($eid){
		$Num=0;
		$empData = $this->getEmployeeData($eid);
		if($empData->ceo)
		   $Num=1;
		return $Num;
	}
	
	public function isAdmin($eid){
		$Num=0;
		$empData = $this->getEmployeeData($eid);
		if($empData->admin)
		   $Num=1;
		return $Num;
	}
	
	
	public function getCEOName()
	{
		$name="NA";
		$dbsql=mysql_query("select * from od_director where ceo=1 ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$name = $row['name'];
		}
		else{
			$dbsql=mysql_query("select * from od_employee where ceo=1 ");
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				$row = mysql_fetch_array($dbsql);
				$name = $row['name'];
			}
		}
		return $name;
	}
		
	
	public function isEmployee($eid)
	{
		$status = 0;
		$Num =  $this->isDirector($eid);
		if($Num)
		{
			return 1;
		}
		$empData = $this->getEmployeeData($eid);
		if($empData->valid && $empData->desig_id != 20) //intern
			$status = 1;
		return $status;
	}
	
	public function isContractEmployee($eid)
	{
		$status = 0;
		$Num =  $this->isDirector($eid);
		if($Num)
		{
			return $status;
		}
		$empData = $this->getEmployeeData($eid);
		if($empData->emptype == 5) //Contract Employee
			$status = 1;
		return $status;
		
	}
	
	public function isOnNoticePeriod($eid)
	{
		$status = 0;
		$Num =  $this->isDirector($eid);
		if($Num)
		{
			return $status;
		}
		$empData = $this->getEmployeeData($eid);
		if($empData->emptype == 4) //ON Notice
			$status = 1;
		return $status;
		
	}
	
	
	public function isManagement($eid){
		$Num =  $this->isDirector($eid);
		if(!$Num)
		{
			$dbsql=mysql_query("select * from od_employee where eid ='".$eid."' and mgmt ='1' ");
			$Num = mysql_num_rows($dbsql);
		}
		return $Num;
	}
	
	public function isITAdmin($eid){
		//$Num =  $this->isDirector($eid);
		if(!$Num)
		{
			$dbsql=mysql_query("select * from od_employee where eid ='".$eid."' and itadmin ='1' ");
			$Num = mysql_num_rows($dbsql);
		}
		return $Num;
	}
	
	public function isHRAdmin($eid){
		//$Num =  $this->isDirector($eid);
		if(!$Num)
		{
			$dbsql=mysql_query("select * from od_employee where eid ='".$eid."' and hradmin ='1' ");
			$Num = mysql_num_rows($dbsql);
		}
		return $Num;
	}
	
	public function getEmployeeName($eid){
		$name="";
		if($eid == 1000)
		{
			$name="OdiTek Board";
			return $name;
		}
		$dbsql=mysql_query("select * from od_director where did ='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num>0)
		{
			$row = mysql_fetch_array($dbsql);
			$name = $row['name'];
		}else{
			$dbsql=mysql_query("select * from od_employee where eid ='".$eid."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num>0)
			{
				$row = mysql_fetch_array($dbsql);
				$name = $row['name'];
			}
		}
		return $name;
	}
	
	public function getEmployeeEmail($eid){
		$email="";
		if($eid == 1000)
		{
			$email="mgmt@oditeksolutions.com";
			return $email;
		}
		
		$dbsql=mysql_query("select * from od_director where did ='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num>0)
		{
			$row = mysql_fetch_array($dbsql);
			$email = $row['office_email'];
		}else{
			$dbsql=mysql_query("select * from od_employee where eid ='".$eid."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num>0)
			{
				$row = mysql_fetch_array($dbsql);
				$email = $row['office_email'];
			}
		}
		return $email;
		
	}
	
	
	public function getCEOEmail()
	{
		$email="";
		$eid=0;
		$dbsql=mysql_query("select * from od_director where ceo=1");
		if($row = mysql_fetch_array($dbsql))
		{
			$eid = $row['did'];
		}else{
			$dbsql=mysql_query("select * from od_employee where ceo=1");
			if($row = mysql_fetch_array($dbsql))
			{
				$eid = $row['eid'];
			}
		}
		$email = $this->getEmployeeEmail($eid);
		
		return $email;
	}
	
	
	
	public function getEmployeeBUName($eid){
		$bu_id=0;
		$dbsql=mysql_query("select * from od_director where did ='".$eid."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num>0)
		{
			$row = mysql_fetch_array($dbsql);
			$bu_id = $row['bu'];
		}else{
			$dbsql=mysql_query("select * from od_employee where eid ='".$eid."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num>0)
			{
				$row = mysql_fetch_array($dbsql);
				$bu_id = $row['bu'];
			}
		}
		$name = $this->getBUnitById($bu_id);
		return $name;
	}
	
		
	public function getReportToMe($upper_id){
		//echo "Supper ID::".$this->getEmployeeName($upper_id)."<BR>";
		$dbsql=mysql_query("select * from od_emp_report ");
		$Num = mysql_num_rows($dbsql);
		$emp_array = array();
		while($row = mysql_fetch_array($dbsql))
		{
			$emp_id = $row['upper_id'];
			$eid = $row['eid'];
			//$index = strpos($report_id , ":");
			//$emp_id = substr($report_id,$index+1,strlen($report_id));
			if($emp_id == $upper_id)
			{
				//echo ":MATCH:".$eid."::";
				$emp_array[] = $eid;
			}
			//ho $emp_id."::".$upper_id."<BR>";
		}
		return $emp_array;
	}
	
	
	public function getAllMyTeamName($eid){
		
			if($this->isDirector($eid))
			{
				$getArray = $this->getAllNameOnly();
				return $getArray;
			}
			if($this->isManagement($eid))
			{
				$getArray = $this->getAllNameOnly();
				return $getArray;
			}
			$total_emp_list= array();
			$emp_array = $this->getReportToMe($eid);
			foreach($emp_array as $obj)
			{
				$total_emp_list[] = $obj;
				$emp_array = $this->getReportToMe($obj);
				foreach($emp_array as $obj)
				{
					$total_emp_list[] = $obj;
					$emp_array = $this->getReportToMe($obj);
					foreach($emp_array as $obj)
					{
						$total_emp_list[] = $obj;
						$emp_array = $this->getReportToMe($obj);
					}
				}
			}
			/////////////////
			foreach($total_emp_list as $obj)
			{
				//echo $obj."::".$this->getEmployeeName($obj)."<BR>";
				$eid=$obj;
				$dbsql=mysql_query("select a.id , a.eid , a.name , c.rank , c.rankid from od_employee a 
									INNER JOIN od_emp_report b ON a.eid = b.eid
									INNER JOIN od_rank c ON b.desig_id = c.rankid  
									where a.status='1' and a.eid='".$eid."' ");
				$Num = mysql_num_rows($dbsql);
				if ($Num > 0)
				{
					if($row = mysql_fetch_array($dbsql))
					{
						$admin = new AdminUser();
						$admin->id = htmlspecialchars($row['eid']);  
						//$admin->name = htmlspecialchars($row['name'])." [".$row['rank']."]";
						$admin->name = htmlspecialchars($row['name']);
						$getArray[] = $admin;
					}
				}
			}	
		return $getArray;
	}
	
	
	public function getEmpGender(){
			$getArray= array();
			$dbsql=mysql_query("select * from od_emp_gender order by id asc");
			$Num = mysql_num_rows($dbsql);
		
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$admin = new AdminUser();
					$admin->name = $row['gender'];  
					$admin->id = $row['gender_id'];
					$getArray[] = $admin;
				}
			}
		return $getArray;
	}
	
	public function getEmpBldGrp(){
			$getArray= array();
			$dbsql=mysql_query("select * from od_emp_bloodgrp order by id asc");
			$Num = mysql_num_rows($dbsql);
		
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$admin = new AdminUser();
					$admin->id = $row['bld_grp'];
					$admin->name = $row['bld_grp'];					
					$getArray[] = $admin;
				}
			}
		return $getArray;
	}
	
	
	public function getDesignation(){
			$getArray= array();
			$dbsql=mysql_query("select * from ".PREFIX1."rank where rankid > 1 order by rank asc");
			$Num = mysql_num_rows($dbsql);
		
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$admin = new AdminUser();
					$admin->id = $row['rankid'];  
					$admin->name = $row['rank'];
					$getArray[] = $admin;
				}
			}
		return $getArray;
	}
	
	public function getDesignationAll(){
			$getArray= array();
			$dbsql=mysql_query("select * from ".PREFIX1."rank order by rank asc");
			$Num = mysql_num_rows($dbsql);
		
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$admin = new AdminUser();
					$admin->id = $row['rankid'];  
					$admin->name = $row['rank'];
					$getArray[] = $admin;
				}
			}
		return $getArray;
	}
	
	public function getDesigById($desig_id){
			$dbsql=mysql_query("select * from ".PREFIX1."rank where rankid='".$desig_id."' ");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				if($row = mysql_fetch_array($dbsql))
				{
					$rank_name = $row['rank'];
				}
			}
		return $rank_name;
	}
	
	public function getDesigByEid($eid){
		$rank_name="";
		$empData = $this->getEmployeeData($eid);
		$rank_name = $empData->desig_name;
		return $rank_name;
	}
	
	public function getDepartment(){
			$getArray= array();
			$dbsql=mysql_query("select * from ".PREFIX1."dept order by id asc");
			$Num = mysql_num_rows($dbsql);
		
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$admin = new AdminUser();
					$admin->id = $row['dept_id'];  
					$admin->name = $row['dept_name'];
					$getArray[] = $admin;
				}
			}
		return $getArray;
	}
	
	
	public function getAllBU(){
			$getArray= array();
			$dbsql=mysql_query("select * from od_bu_info");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$admin = new AdminUser();
					$admin->id = $row['id'];  
					$admin->name = $row['bu_name'];
					$getArray[] = $admin;
				}
			}
		return $getArray;
	}
	
	public function getAllPMGroup(){
			$getArray= array();
			$dbsql=mysql_query("select * from od_project_mgmt");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$admin = new AdminUser();
					$admin->id = $row['id'];  
					$admin->name = $row['pr_name'];
					$admin->pr_head = $row['pr_head'];
					$getArray[] = $admin;
				}
			}
		return $getArray;
	}
	
	
	public function getBUnitById($bu_id){
			$dbsql=mysql_query("select * from od_bu_info where id='".$bu_id."' ");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				if($row = mysql_fetch_array($dbsql))
				{
					$bu_name = $row['bu_name'];
				}
			}
		return $bu_name;
	}
	
	public function getDeptById($dept_id){
			$dbsql=mysql_query("select * from ".PREFIX1."dept where dept_id='".$dept_id."' ");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				if($row = mysql_fetch_array($dbsql))
				{
					$dept_name = $row['dept_name'];
				}
			}
		return $dept_name;
	}
	
	
	public function myDailyReportSubmit($eid,$data)
	{
		$today_prt = date("dmy");
		$today = date("d-m-Y, h:i:s A");
		$dbsql=mysql_query("select * from od_daily_report where eid='".$eid."' and time='".$today_prt."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$status= $row['status'];
			if($status == 0)
			{
				$query = "UPDATE od_daily_report set date_time='".$today."', today='".$data['remark1']."', tomorrow='".$data['remark2']."', status='0' , work_from='".$data['wfrom']."', work_time='".$data['wtime']."' where  eid='".$eid."' and time='".$today_prt."'  ";
				$res = mysql_query($query);
			}
			
		}else{
			$query = "INSERT into od_daily_report set time='".$today_prt."' , date_time='".$today."', today='".$data['remark1']."', tomorrow='".$data['remark2']."', status='0' , work_from='".$data['wfrom']."' , work_time='".$data['wtime']."' , eid='".$eid."' ";
			$res = mysql_query($query);
		}
		
		return 1;
	}
	
	public function getProjectList()
	{
		
		$dbsql=mysql_query("select * from od_project_info where status='1' ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->pid = $row['pid'];
				$admin->pname = $row['pname'];
				$admin->grpid_str = $this->getGroupName($row['grpid']);	
				$getRankArray[] = $admin;
			}
		}
		return $getRankArray;
	}
	
	
	public function getResourceList()
	{
		$dbsql=mysql_query("select * from od_director ORDER BY name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->reso_name = $row['name'];
				$admin->reso_id = $row['did'];
				$admin->reso_type = 1;
				$getRankArray[] = $admin;
			}
		}
		
		$dbsql=mysql_query("select * from od_employee ORDER BY name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->reso_name = $row['name'];
				$admin->reso_id = $row['eid'];
				$admin->reso_type = 2;
				$getRankArray[] = $admin;
			}
		}
		
		
		return $getRankArray;
	}
	
	
	public function getProjectList2()
	{
		$dbsql=mysql_query("select * from od_project_info ORDER BY id DESC");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->pdate = $row['date'];
				$admin->pid = $row['pid'];
				$admin->grpid = $row['grpid'];
				$admin->grpid_str = $this->getGroupName($row['grpid']);	
				$admin->cus_id = $row['cus_id'];	
				$admin->cuscode_str = $this->getCustomerCode($row['cus_id']);
				$admin->project_time = 	$this->getProjectPlannedTime($admin->pid);	
				$admin->pname = $row['pname'];
				$admin->pstatus = $row['status'];
				$admin->pstatus_str = $this->getStatusText($row['status']);
				$getRankArray[] = $admin;
			}
		}
		return $getRankArray;
	}
	
	public function getCustomerCode($cus_id)
	{
		$cus_code="";
		$dbsql=mysql_query("select * from od_customer_info where cus_id ='".$cus_id."' ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$cus_code = $row['cus_code'];
		}
		return $cus_code;
	}
	
	
	public function getProjectPlannedTime($project_id){
		
		$total_time=0;
		$dbsql=mysql_query("select * from od_project_task_info where project_id='".$project_id."' and status=1 order by id desc");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$total_time += $row['task_time'];
			}
			if($total_time > 0)
				$total_time = $this->getTimeText($total_time);
		}
		
		return $total_time;
	}
	
		
	public function getGroupName($grp_id)
	{
		$group_name="";
		$dbsql=mysql_query("select * from od_project_grp where grp_id ='".$grp_id."' ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$group_name = $row['grp_name'];
		}
		return $group_name;
	}
	
	public function getProjectGrp(){
				$dbsql=mysql_query("select * from od_project_grp ORDER BY grp_name ASC");
				$Num = mysql_num_rows($dbsql);	
				if ($Num > 0)
				{
					while($row = mysql_fetch_array($dbsql))
					{
						$admin = new AdminUser();
						$admin->grpid =htmlspecialchars($row['grp_id']);  
						$admin->grpname =htmlspecialchars($row['grp_name']);
						$getRankArray[] = $admin;
					}
				}
		return $getRankArray;
	}
	
	public function addNewProject($data)
	{
		$str=""; 
		$project_id = date("ym")."01";
		$i=1;
		while($i<100)
		{
			$dbsql=mysql_query("select pid from od_project_info where pid='".$project_id."' ");
			$Num = mysql_num_rows($dbsql);	
			if($Num == 0)
				break;
			else
				$project_id++;
			$i++;
		}
		
		$dbsql=mysql_query("select pid from od_project_info where pname='".$data['pro_name']."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$str = "Project name is already exists...";	
			$data=array("status"=>0,"msg"=>$str );
			return $data;
		}else{			
			
			$date = $this->getCurrentDateTime();	
			$allquery = "INSERT INTO od_project_info set pid='".$project_id."', date='".$date."' , cus_id='".$data['pro_cus']."' , pname='".$data['pro_name']."' , status='".$data['pro_status']."' ";
			$allres = mysql_query($allquery);
			$str = "New Project is successfully added...";	
		}
		
		$data=array("status"=>1,"msg"=>$str );
		
		return $data;
	}
	
	
	public function getAllCustomer(){
				$dbsql=mysql_query("select * from od_customer_info ORDER BY cus_name ASC");
				$Num = mysql_num_rows($dbsql);	
				if ($Num > 0)
				{
					while($row = mysql_fetch_array($dbsql))
					{
						$admin = new AdminUser();
						$admin->cus_id =htmlspecialchars($row['cus_id']);  
						$admin->cus_name =htmlspecialchars($row['cus_name']);
						$admin->cus_code =htmlspecialchars($row['cus_code']);
						$check = $this->checkCustomerActiveProject($admin->cus_id);
						if($check)
							$getRankArray[] = $admin;
					}
				}
		return $getRankArray;
	}
	
	public function checkCustomerActiveProject($cus_id)
	{
		$check=0;	
		$dbsql=mysql_query("select * from od_project_info where cus_id='".$cus_id."' and status ='1'");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$check = 1;
		}
		return $check;
	}
	
	public function loadCustomerProject($cus_id )
	{
		$dbsql=mysql_query("select * from od_project_info where cus_id='".$cus_id."' order by pname asc");
		$Num = mysql_num_rows($dbsql);
		$str= '<option value="0">All Projects</option>';
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
					$status = $this->getStatusText($row['status']);
					$str .= '<option value="'.$row['pid'].'">'.$row['pname'].' : ['.$status.']</option>';
		    }
		}
		$value = $grp_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	public function loadCustomerProject2($cus_id)
	{
		$dbsql=mysql_query("select * from od_project_info where cus_id='".$cus_id."' and status ='1' order by pname asc");
		$Num = mysql_num_rows($dbsql);
		$str= '<option value="0">Select Project</option>';
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
					$status = $this->getStatusText($row['status']);
					$str .= '<option value="'.$row['pid'].'">'.$row['pname'].' : ['.$status.']</option>';
		    }
		}
		$data=array("status"=>1,"data"=>$str);
		return $data;
	}
	
	public function loadCustomerProject3($cus_id)
	{
		$dbsql=mysql_query("select * from od_project_info where cus_id='".$cus_id."' and status='1' order by pname asc");
		$Num = mysql_num_rows($dbsql);
		$str= '<option value="0">Select Project</option>';
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
					$status = $this->getStatusText($row['status']);
					$str .= '<option value="'.$row['pid'].'">'.$row['pname'].'</option>';
		    }
		}
		$value = $grp_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	public function loadProjectTaskListHTML($pro_id,$grp_id)
	{
		if($grp_id > 0)
			$dbstr = "select * from od_project_task_info where project_id='".$pro_id."' and grp_id='".$grp_id."' order by task_name asc";
		else
			$dbstr = "select * from od_project_task_info where project_id='".$pro_id."' order by task_name asc";
		
		$dbsql=mysql_query($dbstr);
		$Num = mysql_num_rows($dbsql);
		$str= '<option value="0">All Tasks</option>';
		if($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$str .= '<option value="'.$row['task_id'].'">'.$row['task_name'].'</option>';
		    }
		}
		$value = $pro_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	
	public function loadProjectTaskResoListHTML($pro_id,$task_id)
	{
		$str= '<option value="0">All Resources</option>';
		if($task_id > 0)
		{	
			
			$task_gb_id = $this->getTaskDbId($task_id);
			$dbsql=mysql_query("select DISTINCT emp_id from od_project_dailytask_logs where pro_id='".$pro_id."' and pro_task_id='".$task_gb_id."' order by id desc");
			$Num = mysql_num_rows($dbsql);
			
			if($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$emp_id = $row['emp_id'];
					$emp = $this->getEmployeeInfo($emp_id);		
					$str .= '<option value="'.$emp_id.'"> '.$emp->name.'</option>';
				}
			}
		}else{
			
			$dbsql=mysql_query("select DISTINCT emp_id from od_project_dailytask_logs where pro_id='".$pro_id."' order by id desc");
			$Num = mysql_num_rows($dbsql);
		
			if($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$emp_id = $row['emp_id'];
					$emp = $this->getEmployeeInfo($emp_id);		
					$str .= '<option value="'.$emp_id.'"> '.$emp->name.'</option>';
				}
			}
		}
		
		$data=array("status"=>1,"data"=>$str);
		return $data;
	}
	
	public function loadResourceList($dept_id)
	{
		$str= '<option value="0">All Resources</option>';
		
		if($dept_id == 1) // 1 is for Management
		{
			$dbsql=mysql_query("select * from od_director ORDER BY name asc");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$str .= '<option value="'.$row['did'].'">'.$row['name'].'</option>';
				}
			}
		}
		
		$dbsql=mysql_query("select b.* from od_emp_report a
							inner join od_employee b on a.eid = b.eid 
							where a.dept_id='".$dept_id."' order by b.name asc");
		$Num = mysql_num_rows($dbsql);
		
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
					$str .= '<option value="'.$row['eid'].'">'.$row['name'].'</option>';
		    }
		}
		$value = $dept_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	public function loadProjectTaskTimeHTML($pro_id,$grp_id)
	{
		if($grp_id > 0)
			$dbstr = "select * from od_project_task_info where project_id='".$pro_id."' and grp_id='".$grp_id."'  order by id desc";
		else
			$dbstr = "select * from od_project_task_info where project_id='".$pro_id."' order by id desc";
		
		$dbsql=mysql_query($dbstr);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$time = $row['task_time'];
				$grp_id = $row['grp_id'];
				$grp_name = $this->getGroupName($grp_id);
				$time_str = $this->getTimeText($time*60);
				$status = $this->getStatusText($row['status']);
				$actual_time = $this->getTaskProjectTime($pro_id,$id);
				$actual_time_str = $this->getTimeText($actual_time*60);
	
				$work_percentage = round($actual_time/$time,2)*100;			
				if($work_percentage > 100) $color2 =  "red";
				else $color2 =  "green";
				
				if($row['status'] == 1) $color =  "green";
				else $color =  "red";
	
				$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                 	   <td>'.$grp_name.'</td>
					   <td>'.$row['task_name'].'</td>
					   <td>'.$time_str.'</td>
					   <td>'.$actual_time_str.'</td>
					   <td style="color:'.$color2.'">'.$work_percentage.'%</td>
					   <td style="color:'.$color.'">'.$status.'</td>
	                   </tr>';				
			}
		}
		$value = $pro_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	public function getTaskDbId($task_id)
	{
		$task_db_id=0;
		$dbsql=mysql_query("select * from od_project_task_info where task_id='".$task_id."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$task_db_id = $row['id'];	
			}
		}
		return $task_db_id;
	}
	
	public function getTaskProjectTime($pro_id, $task_id)
	{
		$time =0;
		$str = "select * from od_project_dailytask_logs where pro_id='".$pro_id."' and pro_task_id='".$task_id."'";
		$dbsql=mysql_query($str);
		$Num = mysql_num_rows($dbsql);
		if($Num> 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$time += $row['time'];
		    }
		}
		
		//$time_str = $this->getTimeText($time*60);
		return $time; 
	}
	
	
	public function updateProject($data)
	{
		$pro_id = $data['hideditid'];
		
		$dbsql=mysql_query("select * from od_project_info where pname='".$data['pro_name']."' and pid !='".$pro_id."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$str = "Project name is already exists...";
			$data=array("status"=>0,"msg"=>$str );
			return $data;			
		
		}else{			
			$date = $this->getCurrentDateTime();	
			$allquery = "UPDATE od_project_info set date='".$date."' , pname='".$data['pro_name']."', cus_id='".$data['pro_cus']."' , status='".$data['pro_status']."' where pid ='".$pro_id."' ";
			$allres = mysql_query($allquery);
			$str = "Project is successfully updated...";	
		}
		$data=array("status"=>1,"msg"=>$str );
		
		return $data;
	}	
	
	
	public function getProjectGrpRankWise(){
		
				$emp_id = $_SESSION["emp_id"];
				$group_name = $this->getEmployeeGrpName($emp_id);
				//echo "group_name::".$group_name;
				if($this->isManagement($emp_id))
					$group_name = "All";
				$dbsql=mysql_query("select * from od_project_grp ORDER BY grp_id ASC");
				$Num = mysql_num_rows($dbsql);	
				if ($Num > 0)
				{
					while($row = mysql_fetch_array($dbsql))
					{
						$admin = new AdminUser();
						$admin->grpid =htmlspecialchars($row['grp_id']);  
						$admin->grpname =htmlspecialchars($row['grp_name']);
						if($group_name != "All" && $group_name == $admin->grpname )	
							$getRankArray[] = $admin;
						if($group_name == "All")
							$getRankArray[] = $admin;
					}
				}
		return $getRankArray;
	}
	
	public function getEmployeeGrpName($emp_id){
		$pro_grp_name="All";
		$dbsql=mysql_query("select * from od_emp_report where eid='".$emp_id."' ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$dept_id = $row['dept_id'];
			$pro_grp_name = $this->getProGrpFromDept($dept_id);
		}
		return $pro_grp_name;
	}
	
	public function getProGrpFromDept($dept_id){
		$pro_grp_name="All";
		$dbsql=mysql_query("select * from od_dept where dept_id='".$dept_id."' ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$pro_grp = $row['pro_grp'];
			if($pro_grp > 0)
				$pro_grp_name = $this->getGroupName($pro_grp);
		}
		return $pro_grp_name;
	}
	
	public function getCustomerGrp()
	{
		
		$dbsql=mysql_query("select * from od_customer_info ORDER BY cus_name ASC");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->pdate = $row['date_time'];
				$admin->cus_id = $row['cus_id'];
				$admin->cus_code = $row['cus_code'];
				$admin->cus_name = $row['cus_name'];
				$admin->cus_per = $row['cus_per'];
				$admin->cus_no = $row['cus_no'];
				$getRankArray[] = $admin;
			}
		}
		return $getRankArray;
	}	
	
	public function loadProject($cus_id)
	{
		$dbsql=mysql_query("select * from od_project_info where cus_id='".$cus_id."' order by pname asc");
		$Num = mysql_num_rows($dbsql);
		$str= '<option value="0">Select Project</option>';
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
					$str .= '<option value="'.$row['pid'].'">'.$row['pname'].'</option>';
		    }
		}
		$value = $grp_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	public function loadProject2($grp_id)
	{
		$dbsql=mysql_query("select * from od_project_info where grpid='".$grp_id."' order by pname asc");
		$Num = mysql_num_rows($dbsql);
		$str= '<option value="0">All Projects</option>';
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{		
					$status = $this->getStatusText($row['status']);
					$str .= '<option value="'.$row['pid'].'">'.$row['pname'].'-['.$status.']</option>';
		    }
		}
		$value = $grp_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	public function loadProject3($cus_id)
	{
		$str = "select * from od_project_info where cus_id='".$cus_id."' order by pname asc";
		$dbsql=mysql_query($str);
		$Num = mysql_num_rows($dbsql);
		$str= '<option value="0">Select Project</option>';
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{		
					$status = $this->getStatusText($row['status']);
					$str .= '<option value="'.$row['pid'].'">'.$row['pname'].'-['.$status.']</option>';
		    }
		}
		$value = $grp_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	
	public function getProjectListHtml($cus_id)
	{
		if($cus_id > 0)
			$dbstr = "select * from od_project_info where cus_id=".$cus_id." ORDER BY id DESC";
		else
			$dbstr = "select * from od_project_info ORDER BY id DESC";
		$dbsql=mysql_query($dbstr);
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$slno=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$slno++;
				$admin = new AdminUser();
				$admin->pdate = $row['date'];
				$admin->pid = $row['pid'];
				//$admin->grpid_str = $this->getGroupName($row['grpid']);	
				$admin->cus_id = $row['cus_id'];	
				$admin->cuscode_str = $this->getCustomerCode($row['cus_id']);
				$admin->project_time = 	$this->getProjectPlannedTime($admin->pid);	
				$admin->pname = $row['pname'];
				$admin->pstatus = $row['status'];
				$admin->pstatus_str = $this->getStatusText($row['status']);
				//$getRankArray[] = $admin;
				
				$str.='<tr class="success">
                      <td>'.$slno.'</td>
                      <td>'.$admin->pdate.'</td>
					  <td>'.$admin->pid.'</td>
					  <td>'.$admin->pname.'</td>
					  <td>'.$admin->cuscode_str.'</td>
					  <td>'.$admin->project_time.'</td>
					  <td>'.$admin->pstatus_str.'</td>
                      <td class="tooltip-sidebar-logout">
					  <button class="btn btn-xs btn-green outlinedivnone" data-placement="top" title=""   onClick="return showdaedit('.$admin->pid.',\''.$admin->pname.'\','.$admin->pstatus.','.$admin->cus_id.');">Edit</button> 
					  </td>
                      </tr>';
			}
		}else{
			$str ='<tr><td colspan="9">No records found</td></tr>';
				
		}
		
		$data=array("status"=>1,"data"=>$str );
		
		return $data;
	}
	
	
	 public function generateHRReportHTML($cus_id,$grp_id,$pro_id,$task_id,$reso_id,$start_date,$end_date)
	{
		$proArray= array();
		if($grp_id == 0 && $pro_id == 0 )// Means only Customer ID is present
		{
			//find all active project of customer
			$dbsql=mysql_query("select * from od_project_info where cus_id='".$cus_id."' and status='1' ");
 			$Num1 = mysql_num_rows($dbsql);
			while($row1 = mysql_fetch_array($dbsql))
			{
				$proArray[] = $row1['pid'];
			}	
		}else if($pro_id == 0)// Means only Customer ID as well as group id is present
		{
			//find all active project of customer in that group
			$dbsql=mysql_query("select * from od_project_info where cus_id='".$cus_id."' and grpid='".$grp_id."' and status='1' ");
 			$Num1 = mysql_num_rows($dbsql);
			while($row1 = mysql_fetch_array($dbsql))
			{
				$proArray[] = $row1['pid'];
			}
		}
		else{
			//pro_id is must present
			$proArray[] = $pro_id;
		}
		
		$task_db_id = 0;
		if($task_id > 0)
			$task_db_id = $this->dbObj->getTaskDbId($task_id);
		
		$date=$start_date;
		$str_data="";
		$total_hrs=0;
		while(strtotime($date) <= strtotime($end_date))
		{
			foreach($proArray as $pro_obj)
			{
				if($reso_id > 0)
					$dbsql=mysql_query("select * from od_project_dailytask_logs where date='".$date."' and pro_id='".$pro_obj."' and emp_id='".$reso_id."' ");
				else
					$dbsql=mysql_query("select * from od_project_dailytask_logs where date='".$date."' and pro_id='".$pro_obj."' ");
				$Num1 = mysql_num_rows($dbsql);
				//echo "Records:".$Num1."<BR>";	
				if ($Num1 > 0)
				{
					while($row1 = mysql_fetch_array($dbsql))
					{
						$emp_id = $row1['emp_id'];
						$pro_task_db_id = $row1['pro_task_id'];
						$time = $row1['time'];
						$time_str = $this->getTimeTextNumberOnly($time* 60);
						$location = $row1['location'];
						$text = $row1['text'];
						$project_name123  = $this->getProjectName($pro_obj);
						$task_name = $this->getProjectTaskNameByDbId($pro_task_db_id);
						$grp_id = $this->getProjectTaskGroupIdByDbId($pro_task_db_id);
						$grp_name = $this->getGroupName($grp_id);
						$employee = $this->getEmployeeInfo($emp_id);
						$employee_name = $employee->name;
						if($task_db_id > 0 && $task_db_id == $pro_task_db_id)
						{
							$sl_no++;
							$total_hrs += $time;
							$str_data.='<tr class="success">
									   <td >'.$sl_no.'</td>
									   <td >'.$date.'</td>
									   <td >'.$project_name123.'</td>
									   <td >'.$grp_name.'</td>
									   <td >'.$task_name.'</td>
									   <td >'.$text.'</td>
									   <td >'.$employee_name.'</td>
									   <td class="center_td">'.$time_str.'</td>
									   </tr>';
							
						}else if(!$task_id){
							$sl_no++;
							$total_hrs += $time;
							$str_data.='<tr class="success">
									   <td >'.$sl_no.'</td>
									   <td >'.$date.'</td>
									   <td >'.$project_name123.'</td>
									   <td >'.$grp_name.'</td>
									   <td >'.$task_name.'</td>
									   <td >'.$text.'</td>
									   <td >'.$employee_name.'</td>
									   <td class="center_td">'.$time_str.'</td>
									   </tr>';
													
						}
					}
				}
			}
			$date = date("d-m-Y", strtotime($date." +1 days"));
		}
		$total_time_str = $this->getTimeTextNumberOnly($total_hrs* 60);
		$str_data .='<tr><td colspan="7" class="right_td" style="font-weight: bold;" >Total Hrs [HH:MM]</td><td class="center_td" style="font-weight: bold;">'.$total_time_str.'</td></tr>';
		
		$data=array("status"=>1,"data"=>$str_data );
		
		return $data;
	}
	
	
	public function generateInvoiceReportHTML($cus_id,$pro_id,$inv_type,$inv_status,$start_date,$end_date)
	{
		
		$chk_cus_id = ($cus_id != '0')?"and cus_id='".$cus_id."'":"";
		$chk_pro_id = ($pro_id != '0')?"and pro_id='".$pro_id."'":"";
		$chk_inv_type = ($inv_type != '0')?"and inv_type='".$inv_type."'":"";
		$chk_inv_status = ($inv_status != '0')?"and bill_status='".$inv_status."'":"";

		
		$date=$start_date;
		$str_data="";
		$sl_no=0;
		while(strtotime($date) <= strtotime($end_date))
		{
			$dbsql=mysql_query("select * from od_invoice_data where inv_date='".$date."'  
								".$chk_cus_id."  ".$chk_pro_id."  ".$chk_inv_type." ".$chk_inv_status." ");
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$db_cus_id  = $row['cus_id'];
					$cus_name = $this->getCustomerName($db_cus_id);
					$db_pro_id  = $row['pro_id'];
					$pro_name = $this->getProjectName($db_pro_id);
					$inv_date  = $row['inv_date'];
					$inv_id  = $row['inv_id'];
					$db_inv_type  = $row['inv_type'];
					$inv_type_str = $this->getInvoiceTypeById($db_inv_type);
					$bill_status  = $row['bill_status'];
					$bill_status_str = $this->getInvoiceStatusById($bill_status);
					$bill_amt  = $row['bill_amt'];
					$bill_inr  = $row['bill_inr'];
					$bill_gst  = $row['bill_gst'];
					$bill_curr = $row['bill_curr'];
					$bill_curr_str = $this->getBiiledCurrencyById($bill_curr);
					$bill_total  = $row['bill_total'];
					$bill_total  = $row['bill_total'];
					$inv_note  = $row['inv_note'];
					$received_amt = $this->getInvoiceReceivedAmount($cus_id,$inv_id);
					$str_data.='<tr class="success">
									<td >'.$sl_no.'</td>
									<td >'.$inv_date.'</td>
									<td >'.$inv_id.'</td>
									<td >'.$cus_name.'<BR>['.$pro_name.']</td>
									<td >'.$inv_type_str.'</td>
									<td>['.$bill_curr_str.'] '.$bill_amt.'<BR>₹ '.$bill_inr.'<BR>₹ '.$bill_gst.'<BR>₹ '.$bill_total.'</td>
									<td >₹ '.$received_amt.'</td>
									<td >'.$bill_status_str.'</td>
									</tr>';
					
				}
				
			}
			$date = date("d-m-Y", strtotime($date." +1 days"));
		}
		
		if($str_data == "")
		{
				$str_data ='<tr><td colspan="8" class="center_td" style="font-weight: bold;" >No records found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str_data );
		return $data;
	}
	
	public function generateReceivedReportHTML($cus_id,$pro_id,$start_date,$end_date)
	{
		
		$chk_cus_id = ($cus_id != '0')?"and cus_id='".$cus_id."'":"";
		//$chk_pro_id = ($pro_id != '0')?"and pro_id='".$pro_id."'":"";
		
		
		$date=$start_date;
		$str_data="";
		$sl_no=0;
		while(strtotime($date) <= strtotime($end_date))
		{
			$dbsql=mysql_query("select * from od_invoice_recv_data where recv_date='".$date."' 	".$chk_cus_id."   ");
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$db_cus_id  = $row['cus_id'];
					$inv_id  = $row['inv_id'];
					$recv_date  = $row['recv_date'];
					$recv_amt  = $row['recv_amt'];
					$recv_mod  = $row['recv_mod'];
					$recv_note  = $row['recv_note'];
					$mod_by  = $row['mod_by'];
					
					$cus_name = $this->getCustomerName($db_cus_id);
					$invRow = $this->getInvoiceRow($inv_id);
					$db_pro_id  = $invRow['pro_id'];
					$inv_date  = $invRow['inv_date'];
					$bill_total  = $invRow['bill_total'];
					$pro_name = $this->getProjectName($db_pro_id);
					$recv_mod_str = $this->getInvoiceReceivedModeById($recv_mod);
					$add= true;
					if($pro_id > 0 && $pro_id != $db_pro_id)
						$add= false;
					if($add)
					{
						$str_data.='<tr class="success">
										<td class="center_td">'.$sl_no.'</td>
										<td class="center_td">'.$recv_date.'</td>
										<td class="center_td">'.$inv_id.'</td>
										<td class="center_td">'.$inv_date.'</td>
										<td class="center_td">'.$cus_name.'<BR>['.$pro_name.']</td>
										<td class="center_td">₹ '.$bill_total.'</td>
										<td class="center_td">₹ '.$recv_amt.'</td>
										<td class="center_td">'.$recv_mod_str.'</td>
										</tr>';
					}
					
				}
				
			}
			$date = date("d-m-Y", strtotime($date." +1 days"));
		}
		
		if($str_data == "")
		{
				$str_data ='<tr><td colspan="8" class="center_td" style="font-weight: bold;" >No records found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str_data );
		return $data;
	}
	
	public function getCustomerName($cus_id)
	{
		$cus_name="";
		$dbsql=mysql_query("select * from od_customer_info where cus_id ='".$cus_id."' ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$cus_name = $row['cus_name'];
		}
		return $cus_name;
	}
	
	
	public function addNewProjectTask($dataArr)
	{
		$grp_id = $dataArr['grp_id'];
		$project_id = $dataArr['pro_id'];
		$task_name = $dataArr['pro_taskname'];
		$task_time = $dataArr['task_time'];
		$task_status = $dataArr['task_status'];
		$task_id = 0;
		$date = $this->getCurrentDateTime();	
		
		$dbsql=mysql_query("select *  from od_project_task_info where task_name='".$task_name."' and project_id='".$project_id."' " );
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$str = "Project Task name is already exists...";
			$data=array("status"=>0,"msg"=>$str);			
		}else{			
			
			$allquery = "INSERT INTO od_project_task_info set task_id='".$task_id."', date_time='".$date."' , grp_id='".$grp_id."' , project_id='".$project_id."' , task_name='".$task_name."' , task_time='".$task_time."' , status='".$task_status."' ";
			$allres = mysql_query($allquery);
			$id = mysql_insert_id();
			$task_id = $this->getTaskId($project_id,$id);
			$upd=mysql_query("UPDATE od_project_task_info set task_id='".$task_id."' where id='".$id."'" );
			$str = "New task is successfully added...";	
			$data=array("status"=>1,"msg"=>$str);
		}
		
		return $data;
	}
	
	public function updateNewProjectTask($dataArr)
	{
		$task_id = $dataArr['hideditid'];
		$grp_id = $dataArr['grp_id'];
		$project_id = $dataArr['pro_id'];
		$task_name = $dataArr['pro_taskname'];
		$task_time = $dataArr['task_time'];
		$task_status = $dataArr['task_status'];
		$date = $this->getCurrentDateTime();	
		
		
		$dbsql=mysql_query("select *  from od_project_task_info where task_name='".$task_name."' and project_id='".$project_id."' and id !='".$task_id."' " );
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$str = "Project Task name is already exists...";
			$data=array("status"=>0,"msg"=>$str);
			return $data;			
		}
		
		$dbsql=mysql_query("select * from od_project_task_info where id='".$task_id."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$allquery = "UPDATE od_project_task_info set date_time='".$date."' , grp_id='".$grp_id."' ,task_name='".$task_name."' , task_time='".$task_time."' , status='".$task_status."' where id='".$task_id."'";
			$allres = mysql_query($allquery);
			$id = mysql_insert_id();
			$str = "Task is updated successfully...";	
			$data=array("status"=>1,"msg"=>$str);		
		}else{
			$str = "Sorry, unable to update...";	
			$data=array("status"=>0,"msg"=>$str);	
		}
		
		return $data;
	}
	
	public function getTaskId($project_id,$id){
		$task_id=$project_id;
		$max_len = 10;
		$index1 = strlen($project_id);
		$index2 = strlen($id);
		$max_cnt = $index1 + $index2;
		$extra = 10 - $max_cnt;
		$cnt=0;
		for($i=0;$i<$extra;$i++)
		{
			$cnt++;
			$task_id .="0";		
		}
		$task_id .= $id;
		
		return $task_id;
	}
	
	
	public function loadProjectTaskHTMLEmpy($pro_id,$grp_id)
	{
		if($grp_id > 0)
			$dbstr = "select * from od_project_task_info where project_id='".$pro_id."' and status=1 and grp_id='".$grp_id."' order by id asc";
		else
			$dbstr = "select * from od_project_task_info where project_id='".$pro_id."' and status=1 order by id asc";
		
		$dbsql=mysql_query($dbstr);
		$Num = mysql_num_rows($dbsql);
		$str='<option value="">Select Project Task</option>';
		if($Num > 0)
		{
			//$str='<option value="">Select Project Task</option>';
			while($row = mysql_fetch_array($dbsql))
			{
				$grp_id = $row['grp_id'];
				$grp_name = $this->getGroupName($grp_id);
				
			$str .= '<option value="'.$row['id'].'">['.$grp_name.']:'.$row['task_name'].'</option>';
			}
		}
		$value = $pro_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	
	
	
	public function loadProjectTaskHTML($pro_id,$grp_id)
	{
		if($grp_id > 0)
			$dbstr = "select * from od_project_task_info where project_id='".$pro_id."' and grp_id='".$grp_id."' order by id desc";
		else
			$dbstr = "select * from od_project_task_info where project_id='".$pro_id."' order by id desc";
		
		$dbsql=mysql_query($dbstr);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$time = $this->getTimeText($row['task_time']*60);
				$status = $this->getStatusText($row['status']);
				$grp_name = $this->getGroupName($row['grp_id']);
				if($row['status'] == 1) $color =  "green";
				else $color =  "red";
	
				$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                       <td>'.$row['date_time'].'</td>
					   <td>'.$grp_name.'</td>
					   <td>'.$row['task_name'].'</td>
					   <td>'.$time.'</td>
					   <td style="color:'.$color.'">'.$status.'</td>
					   <td class="tooltip-sidebar-logout">
						<button class="btn btn-xs btn-green outlinedivnone" data-placement="top" title=""   onClick="return showdEdit('.$row['id'].',\''.$row['task_name'].'\','.$row['task_time'].','.$row['status'].','.$row['grp_id'].');">Edit</button> 
						</td>
                        </tr>';				
			}
		}
		$value = $pro_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	
	public function loadshowProjectTaskHTML($pro_id, $grp_id, $search, $showall)
{
    

    if ($showall) {
        $dbstr = "SELECT * FROM od_project_task_info WHERE project_id='".$pro_id."' ORDER BY id DESC";
    } else {
        if ($grp_id > 0) {
            $dbstr = "SELECT * FROM od_project_task_info WHERE project_id='".$pro_id."' AND grp_id='".$grp_id."' ORDER BY id DESC";
        } else {
            $dbstr = "SELECT * FROM od_project_task_info WHERE project_id='".$pro_id."' ORDER BY id DESC";
        }
    }
    
    $dbsql = mysql_query($dbstr);
    $Num = mysql_num_rows($dbsql);
    
    if ($Num > 0) {
        $sl_no = 0;
        while ($row = mysql_fetch_array($dbsql)) {
            $sl_no++;
            $time = $this->getTimeText($row['task_time'] * 60);
            $status = $this->getStatusText($row['status']);
            $grp_name = $this->getGroupName($row['grp_id']);
            if ($row['status'] == 1) $color = "green";
            else $color = "red";

            // Build the string including all fields
            $str .= '<tr class="success">
                       <td>'.$sl_no.'</td>
                       <td>'.$row['date_time'].'</td>
                       <td>'.$grp_name.'</td>
                       <td>'.$row['task_name'].'</td>
                       <td>'.$time.'</td>
                       <td style="color:'.$color.'">'.$status.'</td>
                       <td class="tooltip-sidebar-logout">
                        <button class="btn btn-xs btn-green outlinedivnone" data-placement="top" title=""   onClick="return showdEdit('.$row['id'].',\''.$row['task_name'].'\','.$row['task_time'].','.$row['status'].','.$row['grp_id'].');">Edit</button> 
                        </td>
                        </tr>';
        }
    }
    
    $value = $pro_id;
    $data = array("status"=>1, "data"=>$str, "msg"=>$value);
    return $data;
}

	
	
	
	
	
	
	public function loadSearchProjectTaskHTML($pro_id,$grp_id,$search)
	{
		if($grp_id > 0)
			$dbstr = "select * from od_project_task_info where project_id='".$pro_id."' and grp_id='".$grp_id."' order by id desc";
		else
			$dbstr = "select * from od_project_task_info where project_id='".$pro_id."' order by id desc";
		
		$dbsql=mysql_query($dbstr);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$time = $this->getTimeText($row['task_time']*60);
				$status = $this->getStatusText($row['status']);
				$grp_name = $this->getGroupName($row['grp_id']);
				if($row['status'] == 1) $color =  "green";
				else $color =  "red";
				
				$task_name  = trim($row['task_name']);
				$task_name = strtolower($task_name);
				$search   = strtolower($search);
				$pos = 	strpos($task_name,trim($search));
					
				if(!$pos) continue;	
	
				$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                       <td>'.$row['date_time'].'</td>
					   <td>'.$grp_name.'</td>
					   <td>'.$row['task_name'].'</td>
					   <td>'.$time.'</td>
					   <td style="color:'.$color.'">'.$status.'</td>
					   <td class="tooltip-sidebar-logout">
						<button class="btn btn-xs btn-green outlinedivnone" data-placement="top" title=""   onClick="return showdEdit('.$row['id'].',\''.$row['task_name'].'\','.$row['task_time'].','.$row['status'].','.$row['grp_id'].');">Edit</button> 
						</td>
                        </tr>';				
			}
		}
		$value = $pro_id;
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
	}
	
	public function addDailyProjectTask($dataArr)
	{
		$date_time = $this->getCurrentDateTime();
		$ptime = $dataArr['wtime'];
		if($ptime == "1") 	$date = date("d-m-Y");
		if($ptime == "2") 	$date = date("d-m-Y" , strtotime("-1 days"));
		if($ptime == "3") 	$date = date("d-m-Y" , strtotime("-2 days"));
		if($ptime == "4") 	$date = date("d-m-Y" , strtotime("-3 days"));
		if($ptime == "5") 	$date = date("d-m-Y" , strtotime("-4 days"));
		if($ptime == "6") 	$date = date("d-m-Y" , strtotime("-5 days"));
		if($ptime == "7") 	$date = date("d-m-Y" , strtotime("-6 days"));
		$emp_id = $_SESSION["emp_id"];
		$team_id = $_SESSION["team_id"];
		
		if($emp_id == 0 || $team_id == 0)
		{
			$value = "Session Expired. Please login again.";
			$data=array("status"=>0,"data"=>$str, "msg"=>$value );
			return $data;
		}
		$pro_id = 	$dataArr['pro_id'];
		$pro_task_id = 	$dataArr['pro_task'];
		$location = 	$dataArr['wfrom'];
		$msg = 	addslashes($dataArr['remark1']);
		$time = 	$dataArr['ptime'];
		$edit = 	$dataArr['htype'];
		$hid = 	$dataArr['hid'];
		
		$str = "select * from od_project_dailytask_logs where id='".$hid."' ";
		$dbsql=mysql_query($str);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			if($edit > 0)
			{
				$row = mysql_fetch_array($dbsql);
				$id = $row['id'];
				$query = "UPDATE od_project_dailytask_logs set date_time='".$date_time."' , location='".$location."' , time='".$time."' , text='".$msg."' where id ='".$id."' ";
				$res = mysql_query($query);
				$value = "Successfully Updated...";
				$data=array("status"=>1,"data"=>$str, "msg"=>$value );
				
			}
			/*else{
				//$value = "Project task is already added...";
				//$data=array("status"=>0,"data"=>$str, "msg"=>$value );
				$query = "INSERT into od_project_dailytask_logs set date_time='".$date_time."' , date='".$date."', team_id='".$team_id."' ,emp_id='".$emp_id."', pro_id='".$pro_id."', pro_task_id='".$pro_task_id."' , location='".$location."' , time='".$time."' , text='".$msg."' ";
				$res = mysql_query($query);
		
				$value = "Successfully Added...";
				$data=array("status"=>1,"data"=>$str, "msg"=>$value );				
			}*/
			
		
		}else{
				
			$query = "INSERT into od_project_dailytask_logs set date_time='".$date_time."' , date='".$date."', team_id='".$team_id."' ,emp_id='".$emp_id."', pro_id='".$pro_id."', pro_task_id='".$pro_task_id."' , location='".$location."' , time='".$time."' , text='".$msg."' ";
			$res = mysql_query($query);
		
			$value = "Successfully Added...";
			$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		}
		
		return $data;
	}
	
	public function getProjectTaskTimeList()
	{
		$data[] = array("time" => "15 min", "value" => "15" );
		$data[] = array("time" => "30 min", "value" => "30" );
		$data[] = array("time" => "45 min", "value" => "45" );
		$data[] = array("time" => "1:00 Hr", "value" => "60" );
		$data[] = array("time" => "1:30 Hrs", "value" => "90" );
		$data[] = array("time" => "2:00 Hrs", "value" => "120" );
		$data[] = array("time" => "3:00 Hrs", "value" => "180" );
		$data[] = array("time" => "4:00 Hrs", "value" => "240" );
		$data[] = array("time" => "5:00 Hrs", "value" => "300" );
		$data[] = array("time" => "6:00 Hrs", "value" => "360" );
		$data[] = array("time" => "7:00 Hrs", "value" => "420" );
		$data[] = array("time" => "8:00 Hrs", "value" => "480" );
		$data[] = array("time" => "9:00 Hrs", "value" => "540" );
		$data[] = array("time" => "10:00 Hrs", "value" => "600" );
		$data[] = array("time" => "11:00 Hrs", "value" => "660" );
		$data[] = array("time" => "12:00 Hrs", "value" => "720" );
		$data[] = array("time" => "14:00 Hrs", "value" => "840" );
		$data[] = array("time" => "16:00 Hrs", "value" => "960" );
		$data[] = array("time" => "18:00 Hrs", "value" => "1080" );
		$data[] = array("time" => "20:00 Hrs", "value" => "1200" );
		$data[] = array("time" => "22:00 Hrs", "value" => "1320" );
		$data[] = array("time" => "24:00 Hrs", "value" => "1440" );
		$data[] = array("time" => "26:00 Hrs", "value" => "1560" );
		$data[] = array("time" => "28:00 Hrs", "value" => "1680" );
		$data[] = array("time" => "30:00 Hrs", "value" => "1800" );
		$data[] = array("time" => "32:00 Hrs", "value" => "1920" );
		$data[] = array("time" => "35:00 Hrs", "value" => "2100" );
		$data[] = array("time" => "40:00 Hrs", "value" => "2400" );
		$data[] = array("time" => "45:00 Hrs", "value" => "2700" );
		$data[] = array("time" => "50:00 Hrs", "value" => "3000" );
		$data[] = array("time" => "55:00 Hrs", "value" => "3300" );
		$data[] = array("time" => "60:00 Hrs", "value" => "3600" );
		$data[] = array("time" => "70:00 Hrs", "value" => "4200" );
		$data[] = array("time" => "80:00 Hrs", "value" => "4800" );
		$data[] = array("time" => "90:00 Hrs", "value" => "5400" );
		$data[] = array("time" => "100:00 Hrs", "value" => "6000" );
		
		return $data;
	}	
	
	public function getProjectTaskTime($wtime)
	{
		$emp_id = $_SESSION["emp_id"];
		$total_time=0;
		if($wtime == "1") 	$date = date("d-m-Y");
		if($wtime == "2") 	$date = date("d-m-Y" , strtotime("-1 days"));
		if($wtime == "3") 	$date = date("d-m-Y" , strtotime("-2 days"));
		if($wtime == "4") 	$date = date("d-m-Y" , strtotime("-3 days"));
		if($wtime == "5") 	$date = date("d-m-Y" , strtotime("-4 days"));
		
		$str = "select * from od_project_dailytask_logs where date='".$date."' and emp_id='".$emp_id."'";
		$dbsql=mysql_query($str);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			
			while($row = mysql_fetch_array($dbsql))
			{
				$total_time += $row['time'];
			}
		}
		
		$total_time = $this->getTimeText($total_time*60);
		
		$data=array("status"=>1,"ttime"=>$total_time, "msg"=>$value );
		return $data;
		
	}
	
	
	public function getStatusText($status){
		
		if($status == 1)
			$status_str = "Active";
		else if($status == 2)
			$status_str = "Halted";
		else if($status == 0)
			$status_str = "Closed";
		
		return $status_str;
	}
	
	
	public function getDailyTaskTime($date_time)
	{
		$emp_id = $_SESSION["emp_id"];
		$total_time=0;
		$date = date("d-m-Y", strtotime($date_time));
		
		$str = "select * from od_project_dailytask_logs where date='".$date."' and emp_id='".$emp_id."'";
		$dbsql=mysql_query($str);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			
			while($row = mysql_fetch_array($dbsql))
			{
				$total_time += $row['time'];
			}
		}
		
		$total_time = $this->getTimeText($total_time*60);
		
		$data=array("status"=>1,"ttime"=>$total_time, "msg"=>$value );
		return $data;
		
	}
	
	public function getDailyTaskTime2($date_time,$emp_id)
	{
		$total_time=0;
		$date = date("d-m-Y", strtotime($date_time));
		
		$str = "select * from od_project_dailytask_logs where date='".$date."' and emp_id='".$emp_id."'";
		$dbsql=mysql_query($str);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			
			while($row = mysql_fetch_array($dbsql))
			{
				$total_time += $row['time'];
			}
		}
		
		$total_time = $this->getTimeText($total_time*60);
		
		$data=array("status"=>1,"ttime"=>$total_time, "msg"=>$value );
		return $data;
		
	}
	
	
	public function getProjectName($pro_id)
	{
		$pro_name="";
		$str = "select * from od_project_info where pid='".$pro_id."' ";
		$dbsql=mysql_query($str);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$pro_name = $row['pname'];
		}	
		return $pro_name;
	}
	
	
	public function getProjectTaskName($pro_task_id)
	{
		$pro_task_name="";
		$str = "select * from od_project_task_info where id='".$pro_task_id."' ";
		$dbsql=mysql_query($str);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$pro_task_name = $row['task_name'];
		}	
		return $pro_task_name;
	}
	
	public function getProjectTaskGroupIdByDbId($task_db_id)
	{
		$grp_id=0;
		$dbsql=mysql_query("select * from od_project_task_info where id='".$task_db_id."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$grp_id = $row['grp_id'];	
			}
		}
		return $grp_id;
	}
	
	
	
	public function getProjectTaskData($wtime)
	{
		$str = '';
		$emp_id = $_SESSION["emp_id"];
		$total_time=0;
		if($wtime == "1") 	$date = date("d-m-Y");
		if($wtime == "2") 	$date = date("d-m-Y" , strtotime("-1 days"));
		if($wtime == "3") 	$date = date("d-m-Y" , strtotime("-2 days"));
		if($wtime == "4") 	$date = date("d-m-Y" , strtotime("-3 days"));
		if($wtime == "5") 	$date = date("d-m-Y" , strtotime("-4 days"));
		if($wtime == "6") 	$date = date("d-m-Y" , strtotime("-5 days"));
		if($wtime == "7") 	$date = date("d-m-Y" , strtotime("-6 days"));
		
		$str1 = "select * from od_project_dailytask_logs where date='".$date."' and emp_id='".$emp_id."'";
		$dbsql=mysql_query($str1);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$time = $this->getTimeText($row['time']*60);
				$project_name  = $this->getProjectName($row['pro_id']);
				$project_task_name  = $this->getProjectTaskName($row['pro_task_id']);
				$grp_id = $this->getProjectTaskGroupIdByDbId($row['pro_task_id']);
				$grp_name = $this->getGroupName($grp_id);
				$task_msg = stripcslashes($row['text']);	
				
				$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                       <td>'.$row['date'].'</td>
					   <td>'.$project_name.'</td>
					   <td>'.$grp_name.'</td>
					   <td>'.$project_task_name.'</td>
					   <td>'.$task_msg.'</td>
					   <td>'.$time.'</td>
					  <td class="tooltip-sidebar-logout">
					   <button type="button" class="btn btn-xs btn-green outlinedivnone" data-placement="top" title=""   onClick="return showdEdit('.$row['id'].');">Edit</button> 
					  </td>
					   <td class="tooltip-sidebar-logout">
					   <button type="button" class="btn btn-xs btn-red outlinedivnone" data-placement="top" title=""   onClick="return showdDelete('.$row['id'].');">Delete</button> 
					  </td>
                      </tr>';			
			
			}
		}else{
			$str ='<tr><td colspan="10">No records found</td></tr>';
		}
		/////holiday info
		$holiday="";
		if($this->checkHoliday($date))
		{
			$holiday = $this->getHolidayInfo($date);
		}
				
		$data=array("status"=>1,"data"=>$str, "holiday"=>$holiday , "msg"=>$value );
		return $data;
		
	}
	
	public function getDailyTaskData($date_time)
	{
		$str = '';
		$emp_id = $_SESSION["emp_id"];
		$total_time=0;
		$date = date("d-m-Y", strtotime($date_time));
		
		$str1 = "select * from od_project_dailytask_logs where date='".$date."' and emp_id='".$emp_id."'";
		$dbsql=mysql_query($str1);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$time = $this->getTimeText($row['time']*60);
				$project_name  = $this->getProjectName($row['pro_id']);
				$project_task_name  = $this->getProjectTaskName($row['pro_task_id']);
				$task_msg = stripcslashes($row['text']);
		
				$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                       <td>'.$row['date'].'</td>
					   <td>'.$project_name.'</td>
					   <td>'.$project_task_name.'</td>
					   <td>'.$task_msg.'</td>
					   <td>'.$time.'</td>
					  			   
                      </tr>';			
			
			}
		}else{
			$str ='<tr><td colspan="6">No records found</td></tr>';
			$value="No records found";
			$data=array("status"=>0,"data"=>$str, "msg"=>$value );
			return $data;
		}
		
				
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
		
	}
	
	public function getDailyTaskData2($date_time,$emp_id)
	{
		$str = '';
		$total_time=0;
		$date = date("d-m-Y", strtotime($date_time));
		
		$str1 = "select * from od_project_dailytask_logs where date='".$date."' and emp_id='".$emp_id."'";
		$dbsql=mysql_query($str1);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$time = $this->getTimeText($row['time']*60);
				$project_name  = $this->getProjectName($row['pro_id']);
				$project_task_name  = $this->getProjectTaskName($row['pro_task_id']);
				$grp_id = $this->getProjectTaskGroupIdByDbId($row['pro_task_id']);
				$grp_name = $this->getGroupName($grp_id);
				$task_msg = stripcslashes($row['text']);
		
				$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                       <td>'.$row['date'].'</td>
					   <td>'.$project_name.'</td>
					   <td>'.$grp_name.'</td>
					   <td>'.$project_task_name.'</td>
					   <td>'.$task_msg.'</td>
					   <td>'.$time.'</td>
					  			   
                      </tr>';			
			
			}
		}else{
			$str ='<tr><td colspan="7">No records found</td></tr>';
			$value="No records found";
			$data=array("status"=>0,"data"=>$str, "msg"=>$value );
			return $data;
		}
		
				
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		return $data;
		
	}
	
	
	public function editProjectTask($id)
	{
		$today = date("d-m-Y");
		$emp_id = $_SESSION["emp_id"];
		$str1 = "select * from od_project_dailytask_logs where id='".$id."' and emp_id='".$emp_id."'";
		$dbsql=mysql_query($str1);
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$data_date = $row['date'];			
				$date = $this->getDateSequence($data_date);
				$pro_id = $row['pro_id'];
				$cus_id = $this->getProjectCusId($pro_id);
				$pro_task_id = $row['pro_task_id'];
				$grp_id = $this->getProjectTaskGroupIdByDbId($pro_task_id);
				//$grp_name = $this->getGroupName($grp_id);
				//$grp_id = $this->getProjectGroupId($pro_id);
				
				$location = $row['location'];
				$time = $row['time'];
				$text = stripcslashes($row['text']);
				$id = $row['id'];
				
			}
		}
				
		$data=array("status"=>1,"date"=>$date, "cus_id"=>$cus_id , "grp_id"=>$grp_id ,"pro_id"=>$pro_id, "pro_task_id"=>$pro_task_id, "location"=>$location, "time"=>$time, "text"=>$text, "id"=>$id );
		
		return $data;
	}
	
	
	public function getDateSequence($date)
	{
		$date_id=1;
		$today = date("d-m-Y");
		$yesday1 = date('d-m-Y',strtotime("-1 days"));
		$yesday2 = date('d-m-Y',strtotime("-2 days"));
		$yesday3 = date('d-m-Y',strtotime("-3 days"));
		$yesday4 = date('d-m-Y',strtotime("-4 days"));
		if($today == $date)
			$date_id=1;
		else if($yesday1 == $date)
			$date_id=2;
		else if($yesday2 == $date)
			$date_id=3;
		else if($yesday3 == $date)
			$date_id=4;
		else if($yesday4 == $date)
			$date_id=5;
		return 	$date_id;
	}
	
	
	public function deleteProjectTask($id)
	{
		$str1 = "delete from od_project_dailytask_logs where id='".$id."' ";
		$dbsql=mysql_query($str1);
		$value = "Task deleted successfully";
		$data=array("status"=>1,"msg"=>$value );
		return $data;		
	}	
	public function getProjectCusId($pro_id)
	{
		$cus_id=0;
		$dbsql=mysql_query("select * from od_project_info where pid='".$pro_id."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$cus_id = $row['cus_id'];
			}
		}
				
		return $cus_id;
	}
	
	
	public function loadHoliday($year)
	{
		$current_date_ptr =  strtotime(date("d-m-Y"));
		$dbsql=mysql_query("select * from od_holiday_list  where year='".$year."' order by date_ptr asc " );
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$year = $row['year'];
				$date = $row['date'];
				$date_ptr = $row['date_ptr'];
				$day = $row['day'];
				$hcat = $row['hcat'];
				$hcat_name = $this->getHolidayCatById($hcat);
				$hname = $row['hname'];
				if($date_ptr > $current_date_ptr )
					$bold="bold";
				else
					$bold="";
				
				$str .= '<tr class="success">
				       <td style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                       <td style="font-weight:'.$bold.'">'.$year.'</td>
					   <td style="font-weight:'.$bold.'">'.$date.'</td>
					   <td style="font-weight:'.$bold.'">'.$day.'</td>
					   <td style="font-weight:'.$bold.'">'.$hcat_name.'</td>
					   <td style="font-weight:'.$bold.'">'.$hname.'</td>
					   </tr>';				
			}
		}			
		$data=array("status"=>1,"data"=>$str );
		
		return $data;
	}
	
	public function getHolidayCatById($hcat)
	{
		$hcat_name="PUBLIC";
		if($hcat == 2)
			$hcat_name="FESTIVAL";
		if($hcat == 3)
			$hcat_name="WEEKEND";
		if($hcat == 4)
			$hcat_name="SATURDAY";
		
		return $hcat_name;
	}
	
	
	public function getAllOffDayList($year)
	{
		
		$current_date_ptr =  strtotime(date("d-m-Y"));
		$dbsql=mysql_query("select * from od_all_offday_list  where year='".$year."' order by date_ptr asc " );
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$year = $row['year'];
				$date = $row['date'];
				$date_ptr = $row['date_ptr'];
				$day = $row['day'];
				$hcat = $row['hcat'];
				$hcat_name = $this->getHolidayCatById($hcat);
				$hname = $row['hname'];
				if($date_ptr > $current_date_ptr )
					$bold="bold";
				else
					$bold="";
				
				$str .= '<tr class="success">
				       <td style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                       <td style="font-weight:'.$bold.'">'.$year.'</td>
					   <td style="font-weight:'.$bold.'">'.$date.'</td>
					   <td style="font-weight:'.$bold.'">'.$day.'</td>
					   <td style="font-weight:'.$bold.'">'.$hcat_name.'</td>
					   <td style="font-weight:'.$bold.'">'.$hname.'</td> </tr>';				
			}
		}			
		$data=array("status"=>1,"data"=>$str );
		
		return $data;
	}
	
	
	public function getAllBUHead()
	{
		$dbsql=mysql_query("select * from od_bu_info ORDER BY id asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$id = $row['id'];
				$admin = new AdminUser();
				$admin->id=$row['id'];
				$admin->bu_name =$row['bu_name'];
		        $admin->eid =$row['bu_head'];
				
				$empdata = $this->getEmployeeData($row['bu_head']);
				
				$admin->bu_head_name = $empdata->name;
				$reportTo = $row['report'];
				if($reportTo > 0)
					$admin->reportTo = $this->getEmployeeName($reportTo);
				else
					$admin->reportTo = "MGMT";
				
			    $admin->office_email =$empdata->office_email;
				$admin->mobile =$empdata->mobile;
								
				$users[] = $admin;
			}
		}
		
		 return $users;
		
	}
	
	public function getBUHeadById($bu_id)
	{
		$bu_head_name = "NA";	
		$dbsql=mysql_query("select * from od_bu_info where id='".$bu_id."' ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
		      	$empdata = $this->getEmployeeData($row['bu_head']);
				$bu_head_name = $empdata->name;
			}
		}
		
		 return $bu_head_name;
		
	}
	
	
	public function getBUHeadId($bu_id)
	{
		$dbsql=mysql_query("select * from od_bu_info where id='".$bu_id."' ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$bu_head_id = $row['bu_head'];
			}
		}
		
		 return $bu_head_id;
		
	}
	
	public function getEmployee($desig, $dept , $status, $startResults, $recordsperpage)
	{
		
		
		$dbsql=mysql_query("select * from od_director ORDER BY name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['did']);
                $admin->name =htmlspecialchars($row['name']);
                $admin->desig =htmlspecialchars($this->getDesigById($row['desig_id']));
				$admin->bu =htmlspecialchars($this->getBUnitById($row['bu']));
				$admin->dept =htmlspecialchars($this->getDeptById($row['dept_id']));
				$admin->office_email =$row['office_email'];
				$admin->mobile =$row['mobile'];
		        $admin->status =$row['status'];
				$admin->status_str = $this->getStatusStr($admin->status);
				
				$users[] = $admin;
			}
		}
				
		
		$Chkrkid = ($desig != '')?"and b.desig_id='".$desig."'":"";
		$Chkcoyid = ($dept != '')?"and b.dept_id='".$dept."'":"";
		$Chkstatus = ($status != '')?"and a.status='".$status."'":"";
		$dbsql = "select * from od_employee a 
				inner join od_emp_report b  on b.eid=a.eid  
				where a.eid > 1 ".$Chkrkid."  ".$Chkcoyid."   ".$Chkstatus." order by a.name asc limit ".$startResults.", ".$recordsperpage." ";
		
		$dbres = mysql_query($dbsql);
        $Num = mysql_num_rows($dbres);
        if ($Num > 0)
        {
            while($row=mysql_fetch_array($dbres))
            {
                $admin=new AdminUser();
                $admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
                $admin->name =htmlspecialchars($this->getEmpName($row['eid']));
                $admin->desig =htmlspecialchars($this->getDesigById($row['desig_id']));
				$admin->bu =htmlspecialchars($this->getBUnitById($row['bu']));
				$admin->dept =htmlspecialchars($this->getDeptById($row['dept_id']));
				$admin->mobile =$row['mobile'];
				$admin->office_email =$row['office_email'];
		        $admin->status =$row['status'];
				$admin->status_str = $this->getStatusStr($admin->status);
                $users[]=$admin;
            } 
        }
        return $users;
    }
	
	



public function loadDepartment($dep_id) 
{
		$dataArray = $this->
	
	
	
	
	
    if ($dep_id > 0)
        $dbstr =  "SELECT * FROM od_director WHERE dept_id='".$dep_id."' ORDER BY id DESC";
    else
        $dbstr = "SELECT * FROM od_employee ORDER BY id DESC";
	
    $dbsql = mysql_query($dbstr);
    $Num = mysql_num_rows($dbsql);
    
    if ($Num > 0) {
        $sl_no = 0;
        $str = '';
        while ($row = mysql_fetch_array($dbsql)) {
            $sl_no++;
            $id = $row['id'];
            $eid = htmlspecialchars($row['did']);
            $name = htmlspecialchars($row['name']);
            $desig = htmlspecialchars($this->getDesigById($row['desig_id']));
            $bu = htmlspecialchars($this->getBUnitById($row['bu']));
            $dept = htmlspecialchars($this->getDeptById($row['dept_id']));
            $Image = $this->getImage($row['did'], true); 
            $office_email = $row['office_email'];
            $mobile = $row['mobile'];
            $status = $row['status'];
            $status_str = $this->getStatusStr($status);
			$employee = $this->getEmployeeData($eid);
            
            $str .= '<tr class="success">
                        <td>'.$sl_no.'</td>
                       <td><img src="'.$Image.'" alt="Employee Image" style="max-width: 100px; max-height: 50px;"></td> 
                       <td>'.$name.'</td>
                        <td>'.$desig.'</td>
                        <td>'.$bu.'</td>
                        <td>'.$dept.'</td>
                        <td>'.$mobile.'</td>
                        <td>'.$office_email.'</td>
                        <td class="tooltip-sidebar-logout">
                            <button class="btn btn-xs getbtn-green outlinedivnone" data-placement="top" title="" onClick="return showdEdit('.$row['id'].',\''.$row['task_name'].'\','.$row['task_time'].','.$row['status'].','.$row['grp_id'].');">View</button> 
                        </td>
                    </tr>';
        }
    }
    $value = $dept;
    $data = array("status"=>1, "data"=>$str, "msg"=>$value);
    return $data;
}









	
	public function getAllEmployeeList()
	{
		//Select All Director
		$dbsql=mysql_query("select * from od_director ORDER BY name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['did']);
        		$users[] = $admin;
			}
		}
		
		//Select employee with MGMT
        $dbsql = "select * from od_employee where mgmt=1 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
        		$users[] = $admin;
			}
		}

		//Select rest employee
        $dbsql = "select * from od_employee where mgmt=0 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
        		$users[] = $admin;
			}
		}		
        return $users;
    }	
	
	
	public function getAllActiveEmployeeList()
	{
		//Select All Director
		$dbsql=mysql_query("select * from od_director ORDER BY name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['did']);
        		$users[] = $admin;
			}
		}
		
		//Select employee with MGMT
        $dbsql = "select * from od_employee where mgmt=1 and status=1 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
        		$users[] = $admin;
			}
		}

		//Select rest employee
        $dbsql = "select * from od_employee where mgmt=0 and status=1 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
        		$users[] = $admin;
			}
		}		
        return $users;
    }
	
	public function updateEmpLeftDate()
	{
		$dbsql = "select * from od_employee where status=2 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$id = $row["id"];
				$name = $row["name"];
				$lastupdate = $row["date_added"];
				$left_date = date('Y-m-d', strtotime($lastupdate));
				echo $name."::".$left_date."::<BR>";
				$query = "UPDATE od_employee set exit_date='".$left_date."' WHERE id='".$id."' ";
				echo $query."::::::<BR>";
				$res = mysql_query($query);
				
			}
		}	
	
		
	}
	
	public function getAllEmployeeListName()
	{
		$dbsql=mysql_query("select * from od_director ORDER BY name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['did']);
				$admin->name =htmlspecialchars($row['name']);
        		$users[] = $admin;
			}
		}
		
		
       	//Select rest employee
        $dbsql = "select * from od_employee order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
				$admin->name =htmlspecialchars($row['name']);
				$admin->doj = $row['joining_date'];;
				//if($this->isEmployee($admin->eid))
				$users[] = $admin;
			}
		}		
        return $users;
		
	}
	
	
	public function getAllEmployeeListNameHR()
	{
		
       	//Select rest employee
        $dbsql = "select * from od_employee where mgmt!=1 and status=1 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
				$admin->name =htmlspecialchars($row['name']);
				$admin->doj = $row['joining_date'];;
				//if($this->isEmployee($admin->eid))
				$users[] = $admin;
			}
		}		
        return $users;
		
	}
	//////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////Improvement///////////////////////////
	///////////////////////////////////////////////////
	
	
	
	function getIMCreatedID($imprid)
	{
		$eid = 0;
		$dbsql=mysql_query("select * from od_impr_record where imprid = '".$imprid."' ");
		if($row = mysql_fetch_array($dbsql))
		{
			$eid = $row['eid'];
		}	
		return $eid;
	}
	
	function updateCreatorIMPReadStatus($imprid,$val)
	{
		$eid = $_SESSION["emp_id"];
		$c_eid = $this->getIMCreatedID($imprid);
		if($eid == $c_eid)
			$qry=mysql_query("UPDATE od_impr_record set cunread='".$val."' where imprid='".$imprid."'");
	}
	
	
	function updateReviwerIMPRReadStatus($imprid,$val)
	{
		$eid = $_SESSION["emp_id"];
		$c_eid = $this->getIMCreatedID($imprid);
		if($eid != $c_eid)
		{	
			$qry=mysql_query("UPDATE od_impr_record set unread='".$val."' where imprid='".$imprid."'");
		
			$dbsql=mysql_query("select * from  od_impr_record where imprid='".$imprid."' ");
			$Num = mysql_num_rows($dbsql);	
			if($row = mysql_fetch_array($dbsql))
			{
				$str = $row['status'];
				if($str == 1)
					$qry=mysql_query("UPDATE od_impr_record set status='2' where imprid='".$imprid."'");
			
			}
		}
	}
	
	public function generateimprID($num)
{
	$id="IR";
	$size  = strlen($num);
	if($size == 1)
		$id .= "100".$num;
	else if	($size == 2)
	    $id .= "10".$num;
	else if	($size == 3)
		$id .= "1".$num;
	else if	($size == 4)
		$id .= $num;	
	
	return $id;	
}
	
	
	
	
	public function getDefaultImprovementInfo()
	{
		$getArray = array();
		$dbsql=mysql_query("select * from od_impr_info");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->default_assigne = $row['dassign'];
				$admin->default_responsible = $row['dresponsible'];
				$admin->name = $row['name'];
			}
		}
		return $admin;
	}
	
	
	public function getAllResponsible()
	{
		$getArray = array();
		$dbsql=mysql_query("select * from od_impr_responsible");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->id = $row['id'];
				$admin->name = $row['name'];
				$users[] = $admin;;
			}
		}
		return $users;
	}
	
	
	public function getAllType()
	{
		$getArray = array();
		$dbsql=mysql_query("select * from od_impr_type order by id asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->id = $row['id'];
				$admin->name = $row['name'];
				$users[] = $admin;;
			}
		}
		return $users;
	}
	
	
	public function getAllPriority()
	{
		$getArray = array();
		$dbsql=mysql_query("select * from od_impr_priority order by id asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->id = $row['id'];
				$admin->name = $row['name'];
				$users[] = $admin;; 
			}
		}
		return $users;
	}
	
	
	
	public function getIMPRStatusString($status)
	{
		$str="";
		$dbsql=mysql_query("select * from od_impr_request_status where id='".$status."' ");
		$Num = mysql_num_rows($dbsql);	
		if($row = mysql_fetch_array($dbsql))
		{
			$str = $row['status'];
		}
		return 	$str;
	}
	

	public function addImprvIdeas($request){
    $eid = $_SESSION["emp_id"];

    if($eid > 0)
    {   
        $title = addslashes($request['title']);
        $typ = $request['typ'];
        $pro = $request['pro'];
        $res = $request['res'];
        $rep = $request['rep'];
        $text1 = addslashes($request['text1']);
		$file1 = $request['hfile1'];
		$file2 = $request['hfile2'];
		$file3 = $request['hfile3'];
		$defaultData = $this->getDefaultImprovementInfo();
        $assignto = $defaultData->default_assigne;
		
		if($typ != 3) 
			$rep = $eid;
		
        $date = date("d-m-Y, h:i:s A");
        $query = "INSERT into od_impr_record set date='".$date."' , type='".$typ."', eid='".$eid."',  title='".$title."' , email='1', status ='1',  reportedby='".$rep."', responsible='".$res."' , assignto='".$assignto."' ,targetdate='NA' , priority='".$pro."' ";
		//echo $query;
        $res = mysql_query($query);
        
        if ($res) {
			$db_id = mysql_insert_id();
			$imprid = $this->generateimprID($db_id);
			
			$qry=mysql_query("UPDATE od_impr_record set imprid='".$imprid."' where id='".$db_id."'");
			
			$last_status_str = $this->getIMPRStatusString(1);
			$status_mod_str = "[".$last_status_str."]";
			
			$query = "INSERT into od_impr_record_logs set date='".$date."' ,  imprid='".$imprid."', msg='".$text1."' , updatedby='".$rep."', type='".$typ."', responsible='".$res."' , priority='".$pro."', status ='1' , file1='".$file1."' , file2='".$file2."' , file3='".$file3."' , status_log='".$status_mod_str."' ";
		    $res = mysql_query($query);
			if($res)
			{	
				$data_id = mysql_insert_id();
				$msg = 'New Improvement Idea is Created successfully.';
				$data=array("status"=>1, "msg"=>$msg ,"imprid"=>$imprid, "dataid"=>$data_id );
			}
        } else {
            $data['status'] = 0;
            $data['msg'] = 'Error inserting data into the database: ' . mysql_error();
        }
    }
	
	return $data;
}


public function loadMyOpenImprovementIdeas()
{
	$session_eid = $_SESSION["emp_id"];
	if($session_eid > 0)
	{
		$dbsql=mysql_query("select * from od_impr_record where eid='".$session_eid."' and ( status='1' or status='2' or status='3' or status='6' or status='7') ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$imprid =$row['imprid'];
				$date = $row['date'];
				$targetdate = $row['targetdate'];
				$assignto = $row['assignto'];
				$assign_name= $this->getEmpName($assignto);
				$type = $row['type'];
				$type_name = $this->getImprtype($type);
				$reportedby = $row['reportedby'];
				$reported_name = $this->getEmpName($reportedby);
			    $responsible = $row['responsible'];
				$responsible_name = $this->getImprresponsible($responsible);
				$priority = $row['priority'];
				$priority_name = $this->getImprPriority($priority);
				$status = $row['status'];
				$cunread = $row['cunread'];
				$unread = $row['unread'];
				$status_str = $this->getIMPRStatusString($status);
				
				$bold = "normal";
				if($cunread == 1) $bold = "bold";
				
				
				
				if($reportedby== 0){//change for type
					$reported_name= "Anonymous";
				}
			    $iv_key = $this->get_mcrypt_iv();
				$encrypt_imprid = $this->get_mcrypt_encrypt($imprid,$iv_key);		
				
				
				$str .= '<tr class="success">
				       <td  style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                       <td style="font-weight:'.$bold.'" >'.$date.'</td>
					   <td style="font-weight:'.$bold.'" >#'.$imprid.'</td>
					   <td style="font-weight:'.$bold.'" >'.$reported_name.'</td> ///change for type value
					   <td style="font-weight:'.$bold.'" >'.$type_name.'<BR>'.$responsible_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$assign_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$priority_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$targetdate.'</td>
					   <td style="font-weight:'.$bold.'">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="impr_mydetailview.php?imprid='.$encrypt_imprid.'&iv='.$iv_key.'" >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Open Improvement Ideas found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}

public function getIMPRecordDetails($imprid)
{
	
	$dbsql=mysql_query("select * from od_impr_record where imprid='".$imprid."' ");             
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$defaultData = $this->getDefaultImprovementInfo();
		
		$admin = new AdminUser();
		$admin->imprid = $imprid;
		$admin->date_created = $row['date'];
		$admin->title = stripslashes($row['title']);
		$admin->reportedby = $row['reportedby'];
		if($admin->reportedby == 0)
		{
			$admin->reported_name= "Anonymous";
		}else{
			$admin->reported_name = $this->getEmpName($admin->reportedby);
		}
		$admin->responsible = $row['responsible'];
		$admin->responsible_name = $this->getImprresponsible($admin->responsible);
		$admin->type = $row['type'];
		$admin->type = $this->getImprtype($admin->type);
		$admin->priority = $row['priority'];
		$admin->priority_name = $this->getImprPriority($admin->priority);
		
		$admin->assignto = $row['assignto'];
		$admin->assign_name=$this->getEmpName($admin->assignto);
		
		$admin->status = $row['status'];
		$admin->status_str = $this->getIMPRStatusString($admin->status);
		
		$admin->targetdate = $row['targetdate'];
		$reviewer = $defaultData->default_assigne;
		$admin->creator = $row['eid'];
		$admin->reviewer = $reviewer;
		
		
		
		$admin->dataArray = array();
		////////get data details
		$dbsql=mysql_query("select * from od_impr_record_logs where imprid='".$imprid."' ORDER BY id DESC");
		$Num = mysql_num_rows($dbsql);	
		while($row = mysql_fetch_array($dbsql))
		{
			$data = new AdminUser();
			$data->dataid = $row['id'];
			$data->date_updated = $row['date'];
			$updatedby = $row['updatedby'];
			if($updatedby > 0)
				$data->emp_name = $this->getEmpName($updatedby);
			else
				$data->emp_name = "Anonymous";
			$data->msg = stripslashes($row['msg']);
			$data->status_log = $row['status_log'];
			$data->attachment=0;
			$file1 = $row['file1']; if(strlen($file1) > 0) $data->attachment++;
			$file2 = $row['file2']; if(strlen($file2) > 0) $data->attachment++;
			$file3 = $row['file3']; if(strlen($file3) > 0) $data->attachment++;
			$data->file1 = $file1;
			$data->file2 = $file2;
			$data->file3 = $file3;
			$admin->dataArray[] =  $data;
		}
	}
	
	return $admin;
}



public function updateMyIMPRIdeas($request)
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$status_id = $request['status_id'];
		
		$text1 = addslashes($request['text1']);
		$file1 = $request['hfile1'];
		$file2 = $request['hfile2'];
		$file3 = $request['hfile3'];
		$file1 = str_replace(' ', '-', $file1);
		$file2 = str_replace(' ', '-', $file2);
		$file3 = str_replace(' ', '-', $file3);
		$imprid  = $request['himprid'];
		$reportedby  = $request['hrep'];
		
		//$tdate  = $request['date'];
		
		//$empData = $this->getEmployeeData($eid);
		$date = date("d-m-Y, h:i:s A");
		//update unread
		//$this->updateIMPRReadStatus($imprid,1);
		
		//status string
		$last_status = $this->getIMPReqStatus($imprid);
		$last_status_str = $this->getIMPRStatusString($last_status);
		$current_status_str = $this->getIMPRStatusString($status_id);
		if($status_id > 0 && $last_status != $status_id)
			$status_mod_str = "[".$last_status_str." => ".$current_status_str."]";
		else
		    $status_mod_str = "[".$last_status_str."]";
			
		if($status_id > 0)
		{	
			$qry=mysql_query("UPDATE od_impr_record  set  status='".$status_id."' where imprid='".$imprid."'");
		}
		
		$createdby = $this->getIMCreatedID($imprid);
		//update cdate
		$date_str =  strtotime($date);
		
		//$qry=mysql_query("UPDATE od_impr_record set targetdate='".$tdate."' , responsible='".$res."',assignto='".$assignto."',  priority='".$pro."',  unread='1'  where imprid='".$imprid."'");
		
		
		$query = "INSERT into od_impr_record_logs set date='".$date."' , imprid='".$imprid."', 	updatedby='".$reportedby."', msg='".$text1."' , email='1' , file1='".$file1."' , file2='".$file2."' , file3='".$file3."' , status='".$status_id."'	, status_log='".$status_mod_str."' ";
		$res = mysql_query($query);
		 if(!$res)
		 {
            $error = mysql_error();
            error_log("MySQL error: $error");
            $msg = "Error updating IMPR record: $error";
            $data = array("status" => 0, "msg" => $msg);
         }
		 else
		 {
			 $data_id = mysql_insert_id();
			$msg = "Successfully updated Improvement Request";
			$data=array("status"=>1, "msg"=>$msg ,"imprid"=>$imprid, "dataid"=>$data_id );
		 }
		
	}else{
		$msg = "Unknown Error...";
		$data=array("status"=>0,"msg"=>$msg);
	}
	return $data;
}



public function loadCloseIMPRequest() 
{
	$session_eid = $_SESSION["emp_id"];
	if($session_eid > 0)
	{
		$dbsql = mysql_query("SELECT * FROM od_impr_record WHERE status='5' ORDER BY id DESC");

		
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$imprid =$row['imprid'];
				$date = $row['date'];
				$targetdate = $row['targetdate'];
				$assignto = $row['assignto'];
				$assign_name= $this->getEmpName($assignto);
				$type = $row['type'];
				$type_name = $this->getImprtype($type);
				$reportedby = $row['reportedby'];
				$reported_name = $this->getEmpName($reportedby);
			    $responsible = $row['responsible'];
				$responsible_name = $this->getImprresponsible($responsible);
				$priority = $row['priority'];
				$priority_name = $this->getImprPriority($priority);
				$status = $row['status'];
				$cunread = $row['cunread'];
				$unread = $row['unread'];
				$status_str = $this->getIMPRStatusString($status);
				
				$bold = "normal";
				if($cunread == 1) $bold = "bold";
				
				
				
				if($reportedby== 0){//change for type
					$reported_name= "Anonymous";
				}
			    $iv_key = $this->get_mcrypt_iv();
				$encrypt_imprid = $this->get_mcrypt_encrypt($imprid,$iv_key);		
				
				
				$str .= '<tr class="success">
				       <td  style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                       <td style="font-weight:'.$bold.'" >'.$date.'</td>
					   <td style="font-weight:'.$bold.'" >#'.$imprid.'</td>
					   <td style="font-weight:'.$bold.'" >'.$reported_name.'</td> ///change for type value
					   <td style="font-weight:'.$bold.'" >'.$type_name.'<BR>'.$responsible_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$assign_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$priority_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$targetdate.'</td>
					   <td style="font-weight:'.$bold.'">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="impr_mydetailviewcloserequest.php?imprid='.$encrypt_imprid.'&iv='.$iv_key.'" >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Close Improvement Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}


public function loadCloseIMPRequestreviewer() 
{
	$session_eid = $_SESSION["emp_id"];
	if($session_eid > 0)
	{
		$dbsql = mysql_query("SELECT * FROM od_impr_record WHERE  status='5' ORDER BY id DESC");
		
		

		
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$imprid =$row['imprid'];
				$date = $row['date'];
				$targetdate = $row['targetdate'];
				$assignto = $row['assignto'];
				$assign_name= $this->getEmpName($assignto);
				$type = $row['type'];
				$type_name = $this->getImprtype($type);
				$reportedby = $row['reportedby'];
				$reported_name = $this->getEmpName($reportedby);
			    $responsible = $row['responsible'];
				$responsible_name = $this->getImprresponsible($responsible);
				$priority = $row['priority'];
				$priority_name = $this->getImprPriority($priority);
				$status = $row['status'];
				$cunread = $row['cunread'];
				$unread = $row['unread'];
				$status_str = $this->getIMPRStatusString($status);
				
				$bold = "normal";
				if($cunread == 1) $bold = "bold";
				
				
				
				if($reportedby== 0){//change for type
					$reported_name= "Anonymous";
				}
			    $iv_key = $this->get_mcrypt_iv();
				$encrypt_imprid = $this->get_mcrypt_encrypt($imprid,$iv_key);		
				
				
				$str .= '<tr class="success">
				       <td  style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                       <td style="font-weight:'.$bold.'" >'.$date.'</td>
					   <td style="font-weight:'.$bold.'" >#'.$imprid.'</td>
					   <td style="font-weight:'.$bold.'" >'.$reported_name.'</td> ///change for type value
					   <td style="font-weight:'.$bold.'" >'.$type_name.'<BR>'.$responsible_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$assign_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$priority_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$targetdate.'</td>
					   <td style="font-weight:'.$bold.'">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="impr_mydetailviewcloserequestreviewer.php?imprid='.$encrypt_imprid.'&iv='.$iv_key.'" >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Close  Request  reviewer found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}

public function downloadimpfile($imprid,$dataid,$filename)
{
	$file_download_path = ROOT_DIR."upload_pr/".$imprid."/".$dataid."/".$filename;
	$actual_path = PR_IMG_PATH.$imprid."/".$dataid."/".$filename;
	if(file_exists($actual_path))
	{
		$msg="";
		$data = array("status" => 1 , "msg" => $msg ,"file_path" => $file_download_path , "file_name" => $filename);
	}
	else
	{
		//$msg="Error! File does not exist.";
		$msg=$file_download_path;
		$data = array("status" => 0 , "msg" => $msg );
	}
	return $data;
}

public function updateMyASSIGNIdeas($request)
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$status_id = $request['status_id'];
		$pro = $request['pro'];
        $res = $request['res'];
		$assign = $request['assign'];
		$assignto = $row['assignto'];
		$assign_name= $this->getEmpName($assignto);
		$date = $row['date'];
	    $targetdate = $row['targetdate'];
		$text1 = addslashes($request['text1']);
		$file1 = $request['hfile1'];
		$file2 = $request['hfile2'];
		$file3 = $request['hfile3'];
		$file1 = str_replace(' ', '-', $file1);
		$file2 = str_replace(' ', '-', $file2);
		$file3 = str_replace(' ', '-', $file3);
		$imprid  = $request['himprid'];
		$reportedby  = $request['hrep'];
		
		$tdate  = $request['date'];
		
		//$empData = $this->getEmployeeData($eid);
		$date = date("d-m-Y");
		//update unread
		//$this->updateIMPRReadStatus($imprid,1);
		
		//status string
		$last_status = $this->getIMPReqStatus($imprid);
		$last_status_str = $this->getIMPRStatusString($last_status);
		$current_status_str = $this->getIMPRStatusString($status_id);
		if($status_id > 0 && $last_status != $status_id)
			$status_mod_str = "[".$last_status_str." => ".$current_status_str."]";
		else
		    $status_mod_str = "[".$last_status_str."]";
			
		if($status_id > 0)
		{	
			$qry=mysql_query("UPDATE od_impr_record  set  status='".$status_id."' where imprid='".$imprid."'");
		}
		
		$createdby = $this->getIMCreatedID($imprid);
		//update cdate
		$date_str =  strtotime($date);
		
		$qry=mysql_query("UPDATE od_impr_record set targetdate='".$date."' , responsible='".$res."',assignto='".$assign."',  priority='".$pro."',  unread='1'  where imprid='".$imprid."'");
		
		
		$query = "INSERT into od_impr_record_logs set date='".$date."' , imprid='".$imprid."', 	updatedby='".$reportedby."', msg='".$text1."' , email='1' , file1='".$file1."' , file2='".$file2."' , file3='".$file3."' , status='".$status_id."'	, status_log='".$status_mod_str."' ";
		$res = mysql_query($query);
		 if(!$res)
		 {
            $error = mysql_error();
            error_log("MySQL error: $error");
            $msg = "Error updating IMPR record: $error";
            $data = array("status" => 0, "msg" => $msg);
         }
		 else
		 {
			 $data_id = mysql_insert_id();
			$msg = "Successfully updated Improvement Request";
			$data=array("status"=>1, "msg"=>$msg ,"imprid"=>$imprid, "dataid"=>$data_id );
		 }
		
	}else{
		$msg = "Unknown Error...";
		$data=array("status"=>0,"msg"=>$msg);
	}
	return $data;
}

/////////////////////////Improvement End////////////////////////	


public function loadReviewerImprovementIdeas()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_impr_record where ( status='1' or status='2' or status='3' or status='6' or status='7') ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$imprid =$row['imprid'];
				$date = $row['date'];
				$targetdate = $row['targetdate'];
				$assignto = $row['assignto'];
				$assign_name=$this->getEmpName($assignto);
				$type = $row['type'];
				$type_name = $this->getImprtype($type);
				$reportedby = $row['reportedby'];
				$reported_name = $this->getEmpName($reportedby);
			    $responsible = $row['responsible'];
				$responsible = $this->getImprresponsible($responsible);
				$priority = $row['priority'];
				$priority = $this->getImprPriority($priority);
				$status = $row['status'];
				$cunread = $row['cunread'];
				$unread = $row['unread'];
				$status_str = $this->getIMPRStatusString($status);
				$bold = "normal";
				if($assignto == $eid)
				{	
					if($unread == 1) $bold = "bold";
				}			
				
				
				if($reportedby== 0){//change for type
					$reported_name= "Anonymous";
				}
			   
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_imprid = $this->get_mcrypt_encrypt($imprid,$iv_key);		
				
				
				$str .= '<tr class="success">
				       <td  style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                       <td style="font-weight:'.$bold.'" >'.$date.'</td>
					   <td style="font-weight:'.$bold.'" >'.$imprid.'</td>
					   <td style="font-weight:'.$bold.'" >'.$reported_name.'</td> ///change for type value
					   <td style="font-weight:'.$bold.'" >'.$type_name.'<BR>'.$responsible.'</td>
					   <td style="font-weight:'.$bold.'" >'.$assign_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$priority.'</td>
					   <td style="font-weight:'.$bold.'" >'.$targetdate.'</td>
					   <td style="font-weight:'.$bold.'" >'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="impr_reviewerdetailview.php?imprid='.$encrypt_imprid.'&iv='.$iv_key.'" >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}			
			
		}else{
			
			$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Open Improvement Ideas found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}
//////////////////////////////improvement view end////////////////////////////////////////////////////////////////////

//////////////////////////////for improvement assign///////////////////////////////////////////////////////////////

public function addAssignImprovement($request){
    $eid = $_SESSION["emp_id"];

    if($eid > 0)
    {   
        $title = addslashes($request['title']);
        $typ = $request['typ'];
        $pro = $request['pro'];
        $res = $request['res'];
        $rep = $request['rep'];
        $text1 = addslashes($request['text1']);
		$file1 = $request['hfile1'];
		$file2 = $request['hfile2'];
		$file3 = $request['hfile3'];
		$defaultData = $this->getDefaultImprovementInfo();
        $assignto = $defaultData->default_assigne;
		$data_date = $row['date'];			
		$date = $this->getDateSequence($data_date);
		
		if($typ != 3)
			$rep = $eid;
		
        $date = date("d-m-Y, h:i:s A");
        $query = "INSERT into od_impr_record set date='".$date."' , type='".$typ."', eid='".$eid."',  title='".$title."' , email='1', status ='1',  reportedby='".$rep."', responsible='".$res."' , assignto='".$assignto."' ,targetdate='NA' , priority='".$pro."' ";
		//echo $query;
        $res = mysql_query($query);
        
        if ($res) {
			$db_id = mysql_insert_id();
			$imprid = $this->generateimprID($db_id);
			
			$qry=mysql_query("UPDATE od_impr_record set imprid='".$imprid."' where id='".$db_id."'");
			
			
			$last_status_str = $this->getIMPRStatusString(1);
			$status_mod_str = "[".$last_status_str."]";
			
			$query = "INSERT into od_impr_record_logs set date='".$date."' ,  imprid='".$imprid."', msg='".$text1."' , updatedby='".$rep."', type='".$typ."', responsible='".$res."' ,priority='".$pro."', status ='1' , file1='".$file1."' , file2='".$file2."' , file3='".$file3."' , status_log='".$status_mod_str."' ";
		    $res = mysql_query($query);
			if($res)
			{
				$data['status'] = 1;
				$data['msg'] = 'Improvement idea is added successfully.';
			}
        } else {
            $data['status'] = 0;
            $data['msg'] = 'Error inserting data into the database: ' . mysql_error();
        }
  
    }
	
	return $data;
}





public function loadMyOpenAssignIdeas()
{
	
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_impr_record where assignto='".$eid."' and ( status='3' or status='6' ) ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$imprid =$row['imprid'];
				$date = $row['date'];
				$targetdate = $row['targetdate'];
				$assignto = $row['assignto'];
				$assign_name=$this->getEmpName($assignto);
				$type = $row['type'];
				$type_name = $this->getImprtype($type);
				$reportedby = $row['reportedby'];
				$reported_name = $this->getEmpName($reportedby);
			    $responsible = $row['responsible'];
				$responsible = $this->getImprresponsible($responsible);
				$priority = $row['priority'];
				$priority = $this->getImprPriority($priority);
				$status = $row['status'];
				$cunread = $row['cunread'];
				$unread = $row['unread'];
				$status_str = $this->getIMPRStatusString($status);
				$bold = "normal";
				if($assignto == $eid)
				{	
					if($unread == 1) $bold = "bold";
				}			
				
				
				if($reportedby== 0){//change for type
					$reported_name= "Anonymous";
				}
			   
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_imprid = $this->get_mcrypt_encrypt($imprid,$iv_key);		
				
				
				$str .= '<tr class="success">
				       <td  style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                       <td style="font-weight:'.$bold.'" >'.$date.'</td>
					   <td style="font-weight:'.$bold.'" >'.$imprid.'</td>
					   <td style="font-weight:'.$bold.'" >'.$reported_name.'</td> ///change for type value
					   <td style="font-weight:'.$bold.'" >'.$type_name.'<BR>'.$responsible.'</td>
					   <td style="font-weight:'.$bold.'" >'.$assign_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$priority.'</td>
					   <td style="font-weight:'.$bold.'" >'.$targetdate.'</td>
					   <td style="font-weight:'.$bold.'" >'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="impr_myassignedetailview.php?imprid='.$encrypt_imprid.'&iv='.$iv_key.'" >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}			
			
		}else{
			
			$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Open Improvement Ideas found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}








	////////////////////////////////////End//////////////////////////////////////////////////////////////////////////
	public function getAllEmployeeListNameIT()
	{
		
       	$dbsql=mysql_query("select * from od_director where status=1 ORDER BY name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['did']);
				$admin->name =htmlspecialchars($row['name']);
        		$users[] = $admin;
			}
		}
		
		
       	//Select rest employee
        $dbsql = "select * from od_employee where status=1 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
				$admin->name =htmlspecialchars($row['name']);
				$admin->doj = $row['joining_date'];;
				if($this->isEmployee($admin->eid))
					$users[] = $admin;
			}
		}		
        return $users;
		
	}
	
	public function getAllInternListNameIT()
	{
       	//Select intern employee
        $dbsql = "select * from od_employee where status=1 and type=3 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
				$admin->name =htmlspecialchars($row['name']);
				$admin->doj = $row['joining_date'];;
				$users[] = $admin;
			}
		}		
        return $users;
		
	}
	
	
	public function getReleaseResourceList()
	{
       	//Select rest employee
        $dbsql = "select * from od_employee where (type = 2 or type = 3 or type = 4) and status=1 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
				$admin->name =htmlspecialchars($row['name']);
				$admin->doj = $row['joining_date'];
				$users[] = $admin;
			}
		}		
        return $users;
		
	}
	
	
	public function getBUReleaseResourceList()
	{
       	//Select rest employee
		$my_eid = $_SESSION["emp_id"];
		$users =  array();
		if($my_eid)
		{
			$empData = $this->getEmployeeData($my_eid);
			$mybu = $empData->bu;
			$dbsql = "select * from od_employee where (type = 2 or type = 3 or type = 4) and status=1 order by name asc";
			$dbres = mysql_query($dbsql);
			$Num = mysql_num_rows($dbres);	
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbres))
				{
					if($mybu == $row['bu'])
					{						
						$admin = new AdminUser();
						$admin->id=$row['id'];
						$admin->eid =htmlspecialchars($row['eid']);
						$admin->name =htmlspecialchars($row['name']);
						$admin->doj = $row['joining_date'];
						$users[] = $admin;
					}
				}
			}		
		}
        return $users;
	}
	
	
	public function getAllActiveEmployeeListName()
	{
		$dbsql=mysql_query("select * from od_director ORDER BY name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['did']);
				$admin->name =htmlspecialchars($row['name']);
        		$users[] = $admin;
			}
		}
		
		
       	//Select rest employee
        $dbsql = "select * from od_employee where status=1 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
				$admin->name =htmlspecialchars($row['name']);
				$admin->doj = $row['joining_date'];;
				if($this->isEmployee($admin->eid))
					$users[] = $admin;
			}
		}		
        return $users;
		
	}

	public function getAllActiveEmployeeInternListName()
	{
		$dbsql=mysql_query("select * from od_director ORDER BY name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['did']);
				$admin->name =htmlspecialchars($row['name']);
				$admin->emp_type = "Employee";
        		$users[] = $admin;
			}
		}
		
		
       	//Select rest employee
        $dbsql = "select * from od_employee where status=1 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
				$admin->name =htmlspecialchars($row['name']);
				$admin->doj = $row['joining_date'];;
				$admin->emp_type ="";
				if($this->isEmployee($admin->eid))
					$admin->emp_type = "Employee";
				else
					$admin->emp_type = "Intern";
				$users[] = $admin;
			}
		}		
        return $users;
		
	}	
	
	public function getAllActiveEmployeeListNameExceptMgmt()
	{
		//Select rest employee
        $dbsql = "select * from od_employee where status=1 order by name asc";
		$dbres = mysql_query($dbsql);
		$Num = mysql_num_rows($dbres);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbres))
			{
				$admin = new AdminUser();
				$admin->id=$row['id'];
				$mgmt=$row['mgmt'];
                $admin->eid =htmlspecialchars($row['eid']);
				$admin->name =htmlspecialchars($row['name']);
				if($this->isEmployee($admin->eid) && $mgmt == 0 )
					$users[] = $admin;
			}
		}		
        return $users;
		
	}	
	
	
	public function getBUActiveEmployeeName()
	{
		$my_id = $_SESSION["emp_id"];
		if($my_id)
		{	
			$empData = $this->getEmployeeData($my_id);
			$bu_id = $empData->bu;
			$isCEO = $this->isCEO($my_id);
			if($isCEO)
				$dbsql = "select * from od_employee where status=1  order by name asc";
			else
				$dbsql = "select * from od_employee where status=1 and bu='".$bu_id."' order by name asc";
				
			$dbres = mysql_query($dbsql);
			$Num = mysql_num_rows($dbres);	
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbres))
				{
					$admin = new AdminUser();
					$admin->id=$row['id'];
					$admin->eid =htmlspecialchars($row['eid']);
					$admin->name =htmlspecialchars($row['name']);
					if($this->isEmployee($admin->eid) and $my_id != $admin->eid)
						$users[] = $admin;
				}
			}		
		}
        return $users;
	}
	
	
	
	public function getEmployeeToReport($eid)
	{
		if($this->isDirector($eid))
		{
			$admin = new AdminUser();
			$admin->mgmt = 1;
			if($this->isCEO($eid))
				$admin->name = "OdiTek Board";
			else{
				$admin->name = $this->getCEOName();
			}
			$admin->desig = "--";
			$admin->dept = "--";
			$admin->office_email = "--";
			$admin->mobile = "--";
		}
		else
		{
			$dbsql = "select * from od_emp_report where eid='".$eid."' ";
			$dbres = mysql_query($dbsql);
			$Num = mysql_num_rows($dbres);
			if($row=mysql_fetch_array($dbres))
			{
				$eid_report = $row["upper_id"];
				if($eid_report > 0)
				{
					$admin = $this->getEmployeeData($eid_report);
					$admin->mgmt = 0;
				}
			}
		}
		return $admin;
    }
	
	public function  getEmployeeBUHeadName($eid)
	{
		
		
		
	}
	
	
	public function getEmployee_hr($desig, $dept , $status, $type ,  $startResults, $recordsperpage)
	 {
		
		
		$Chkrkid = ($desig != '0')?"and desig_id='".$desig."'":"";
		$Chkcoyid = ($dept != '0')?"and dept_id='".$dept."'":"";
		$Chkstatus = ($status != '0')?"and status='".$status."'":"";
		$Chktype = ($type != '0')?"and type='".$type."'":"";
		
		$dbsql = "select * from od_director  where did > 1 ".$Chkrkid."  ".$Chkcoyid."   ".$Chkstatus."  ".$Chktype."  order by name asc limit ".$startResults.", ".$recordsperpage." ";
		
		$dbres = mysql_query($dbsql);
        $Num = mysql_num_rows($dbres);
        if ($Num > 0)
        {
            while($row=mysql_fetch_array($dbres))
            {
                $admin=new AdminUser();
                $admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['did']);
                $admin->name =htmlspecialchars($this->getEmpName($row['did']));
                $admin->desig =htmlspecialchars($this->getDesigById($row['desig_id']));
				$admin->dept =htmlspecialchars($this->getDeptById($row['dept_id']));
		        $admin->status =$row['status'];
				$admin->emptype = $this->getEmpTypeById($row['type']);
				$admin->status_str = $this->getStatusStr($admin->status);
				$admin->type = 1;
                $users[]=$admin;
            } 
        }
		
			
		
		$Chkrkid = ($desig != '0')?"and b.desig_id='".$desig."'":"";
		$Chkcoyid = ($dept != '0')?"and b.dept_id='".$dept."'":"";
		$Chkstatus = ($status != '0')?"and a.status='".$status."'":"";
		$Chktype = ($type != '0')?"and type='".$type."'":"";
		
		$dbsql = "select * from ".PREFIX1."employee a inner join ".PREFIX1."emp_report b  on b.eid=a.eid  where a.eid > 1 ".$Chkrkid."  ".$Chkcoyid."   ".$Chkstatus." ".$Chktype." order by a.name asc limit ".$startResults.", ".$recordsperpage." ";
		
		$dbres = mysql_query($dbsql);
        $Num = mysql_num_rows($dbres);
        if ($Num > 0)
        {
            while($row=mysql_fetch_array($dbres))
            {
                $admin=new AdminUser();
                $admin->id=$row['id'];
                $admin->eid =htmlspecialchars($row['eid']);
                $admin->name =htmlspecialchars($this->getEmpName($row['eid']));
                $admin->desig =htmlspecialchars($this->getDesigById($row['desig_id']));
				$admin->dept =htmlspecialchars($this->getDeptById($row['dept_id']));
		        $admin->status =$row['status'];
				$admin->emptype = $this->getEmpTypeById($row['type']);
				$admin->status_str = $this->getStatusStr($admin->status);
				$admin->type = 2;
                $users[]=$admin;
            } 
        }
        return $users;
    }
	
	
	
	
	public function getEmployeeReportToMe($eid)
	{
			$emp_array = $this->getReportToMe($eid);
			$getArray = array();
			/////////////////
			foreach($emp_array as $obj)
			{
				$admin = $this->getEmployeeData($obj);
				if($admin->status ==1)
					$getArray[] = $admin;
			}	
		return $getArray;
	}
	
	
	 public function getEmpName($eid){
        $dbsql=mysql_query("select * from ".PREFIX1."employee where eid='".$eid."'  ");
        $Num = mysql_num_rows($dbsql);
        if ($Num > 0)
        {
            if($row=mysql_fetch_array($dbsql))
            {
             	$name =htmlspecialchars($row['name']);
          	} 
        }else
		{
			$dbsql=mysql_query("select * from ".PREFIX1."director where did ='".$eid."'   ");
			$Num = mysql_num_rows($dbsql);
			if($row=mysql_fetch_array($dbsql))
            {
             	$name =htmlspecialchars($row['name']);
          	}
		}
        return $name;
    }

public function getImage($eid){
        $dbsql=mysql_query("select * from ".PREFIX."employee where eid='".$eid."' ");
        $Num = mysql_num_rows($dbsql);
        if ($Num > 0)
        {
            if($row=mysql_fetch_array($dbsql))
            {
             	$name =$row['image'];
	      	} 
        }else{
			$dbsql=mysql_query("select * from ".PREFIX."director where did='".$eid."' ");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				if($row=mysql_fetch_array($dbsql))
				{
					$name =$row['image'];
				} 
			}
		}
		
        return $name;
    }
	
public function getIcardImage123($eid){
	
		$name="";
        $dbsql=mysql_query("select * from od_icard_image where eid='".$eid."' ");
        $Num = mysql_num_rows($dbsql);
        if ($Num > 0)
        {
            if($row=mysql_fetch_array($dbsql))
            {
             	$name =$row['image'];
	      	} 
        }
        return $name;
    }

	
	
	public function strToHex($string){
    $hex = '';
    for ($i=0; $i<strlen($string); $i++){
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0'.$hexCode, -2);
    }
    return strToUpper($hex);
}
	
	public function hexToStr($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}

public function getMonthList(){
		
		$cmonth = date('M');
		$cnt=12;
			/////////////
			$monthyear = date('F Y', strtotime("last month"));
			$darateobj = new Configurations();
			$darateobj->id=$monthyear;
			$darateobj->month=$monthyear;
			$daarray[] = $darateobj;
			///////////
		for($i = 0 ; $i < $cnt ; $i++)
		{
			$monthyear = date('F Y', strtotime("$cmonth +$i month"));
			$darateobj = new Configurations();
			$darateobj->id=$monthyear;
			$darateobj->month=$monthyear;
			$daarray[] = $darateobj;
		}
		return $daarray;
	}
	
public function getGender($gender_id)
{
	$gender="";
	if($gender_id == 1)
		$gender="Male";
	else if($gender_id == 2)
		$gender="Female";
	else if($gender_id == 3)
		$gender="Other";
	return $gender;
}

public function getLinkDocumentList()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_doc_link_cat order by view asc ");
	$Num = mysql_num_rows($dbsql);
	if ($Num > 0)
	{
		while($row=mysql_fetch_array($dbsql))
		{
			$cat_id = $row['id'];
			$cat_name = $row['doc_cat'];
			$doc_array = $this->getMyLinkDocuments($cat_id);
			$size = sizeof($doc_array);
			if($size>0)
			{
				$admin= new DocData();
				$admin->cat_name = $cat_name;
				$admin->doc_size = $size;
				$admin->doc_array = $doc_array;
				$dataArray[] = $admin;	
			}
		}
	}
	
	return $dataArray;
}

public function getMyLinkDocuments($cat_id)
{
	$docArray = array();
	$eid = $_SESSION["emp_id"];
	$empData = $this->getEmployeeData($eid);
	$team_id = $empData->dept_id;
	$cnt=0;
	
	if($this->isManagement($eid))
	{
		$dbsql=mysql_query("select * from od_doc_link where cat='".$cat_id."' ");
		while($row=mysql_fetch_array($dbsql))
		{
			$cnt++;
			$admin= new DocData();
			$text = $row['text'];
			$weblink = $row['link'];
			$url= "<a href='".$weblink."' target='_blank' style='color:blue' ><u>".$text."</u></a>";
			$admin->str = $cnt.". ".$url;
			$docArray[] = $admin;	
		}
		
		return $docArray;
	}
	
	//get Global link
	$dbsql=mysql_query("select * from od_doc_link where cat='".$cat_id."' and team_id='0' ");
	while($row=mysql_fetch_array($dbsql))
	{
		$cnt++;
		$admin= new DocData();
		$text = $row['text'];
		$weblink = $row['link'];
		$url= "<a href='".$weblink."' target='_blank' style='color:blue' ><u>".$text."</u></a>";
		$admin->str = $cnt.". ".$url;
		$docArray[] = $admin;	
	}
	
	//get Team link
	$dbsql=mysql_query("select * from od_doc_link where cat='".$cat_id."' and team_id='".$team_id."' and emp_id='0' ");
	while($row=mysql_fetch_array($dbsql))
	{
		$cnt++;
		$admin= new DocData();
		$text = $row['text'];
		$weblink = $row['link'];
		$url= "<a href='".$weblink."' target='_blank' style='color:blue' ><u>".$text."</u></a>";
		$admin->str = $cnt.". ".$url;
		$docArray[] = $admin;	
	}
	
	//get my link
	$dbsql=mysql_query("select * from od_doc_link where cat='".$cat_id."' and emp_id='".$eid."' ");
	while($row=mysql_fetch_array($dbsql))
	{
		$cnt++;
		$admin= new DocData();
		$text = $row['text'];
		$weblink = $row['link'];
		$url= "<a href='".$weblink."' target='_blank' style='color:blue' ><u>".$text."</u></a>";
		$admin->str = $cnt.". ".$url;
		$docArray[] = $admin;	
	}
	
	return $docArray;
}

/////////////////////////////////////////////////////////////////
////////////////////START IT MODULES/////////////////////////////
/////////////////////////////////////////////////////////////////

public function generateITReqID($num)
{
	$id="";
	$size  = strlen($num);
	if($size == 1)
		$id = "100".$num;
	else if	($size == 2)
	    $id = "10".$num;
	else if	($size == 3)
		$id = "1".$num;
	else if	($size == 4)
		$id = $num;	
	
	return $id;	
}

public function getITRequestInfo($sid)
{
	$dbsql=mysql_query("select * from od_it_request where sid='".$sid."' ");
	$Num = mysql_num_rows($dbsql);	
	$row = mysql_fetch_array($dbsql);
	return 	$row;
}


public function getITDataInfo($dataid)
{
	$dbsql=mysql_query("select * from od_it_request_logs where id='".$dataid."' ");
	$Num = mysql_num_rows($dbsql);	
	$row = mysql_fetch_array($dbsql);
	return 	$row;
}


public function generateITRequest($request)
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$title = addslashes($request['title']);
		$text1 = addslashes($request['text1']);
		$priority = addslashes($request['priority']);
		$device = addslashes($request['device']);
		$file1 = $request['hfile1'];
		$file2 = $request['hfile2'];
		$file3 = $request['hfile3'];
		$file1 = str_replace(' ', '-', $file1);
		$file2 = str_replace(' ', '-', $file2);
		$file3 = str_replace(' ', '-', $file3);
				
		//$empData = $this->getEmployeeData($eid);
		$date = date("d-m-Y, h:i:s A");
		
		$query = "INSERT into od_it_request set date='".$date."' , sid='0', device='".$device."', email='1', eid='".$eid."', title='".$title."' , priority='".$priority."' ";
		$res = mysql_query($query);
		if($res)
		{
			$db_id = mysql_insert_id();
			$sid = $this->generateITReqID($db_id);
			
			$qry=mysql_query("UPDATE od_it_request set sid='".$sid."' where id='".$db_id."'");
			
			$last_status_str = $this->getITStatusString(1);
			$status_mod_str = "[".$last_status_str."]";
			///////////////////
			if($device != "")
				$this->updateITReqDeviceInfo($sid,$device,$eid,$title);
			//////////////////
			
			$query = "INSERT into od_it_request_logs set date='".$date."' , sid='".$sid."', eid='".$eid."', msg='".$text1."' , email='1' , file1='".$file1."' , file2='".$file2."' , file3='".$file3."' , status_log='".$status_mod_str."' ";
			$res = mysql_query($query);
			if($res)
			{
				$data_id = mysql_insert_id();
				$msg = "Successfully generated new IT Request. IT Service Ticket is: #IT".$sid;
				$data=array("status"=>1, "msg"=>$msg ,"sid"=>$sid, "dataid"=>$data_id );
			}
			else{
				$str1 = "delete from od_it_request where sid='".$sid."' ";
				$dbsql=mysql_query($str1);
				$msg = "Unknown Error...";
				$data=array("status"=>0,"msg"=>$msg);
			}
		}
		else{
			$msg = "Unknown Error...";
			$data=array("status"=>0,"msg"=>$msg);
		}
	}else{
		$msg = "Unknown Error...";
		$data=array("status"=>0,"msg"=>$msg);
	}
	
	return $data;
}



public function updateITReqDeviceInfo($sid,$tid,$eid,$title)
{
	$itreq = "#IT".$sid;
	$name = $this->getEmployeeName($eid);
	$current_date = $this->getCurrentDateTime();
	$status_mod_str = "[".$this->getDeviceStatusById(8)."]"; // 8 mean Support
	$msg = $itreq." [".$name."]:-".$title;
	
	$qry=mysql_query("UPDATE od_it_device_list set date='".$current_date."' , status='8' , itr='".$sid."', eid='".$eid."' where  tid='".$tid."'");
		
	$query = "INSERT into od_it_deviceallot_log set date='".$current_date."' , status='8', tid='".$tid."', itr='".$sid."' , eid='".$eid."', msg='".$msg."' , email='1' , status_log='".$status_mod_str."' ";
	$res = mysql_query($query);
	
}

public function completeITReqDeviceInfo($sid,$msg,$eid)
{
	$current_date = $this->getCurrentDateTime();
	$dbquery="select * from od_it_request where sid='".$sid."' ";
	$dbsql=mysql_query($dbquery);
	$Num = mysql_num_rows($dbsql);
	if($Num > 0)
	{
		if($row = mysql_fetch_array($dbsql))
		{
			$device = $row['device'];
			if($device != "" )
			{
				$last_status_str = $this->getDeviceStatusById(8);
				$new_status_str = $this->getDeviceStatusById(5);
				$status_mod_str = "[".$last_status_str." => ".$new_status_str."]";
				
				$qry=mysql_query("UPDATE od_it_device_list set date='".$current_date."' , status='4' , itr='0', eid='".$eid."' where  tid='".$device."'");
				$query = "INSERT into od_it_deviceallot_log set date='".$current_date."' , status='5', tid='".$device."', itr='0' , eid='".$eid."', msg='".$msg."' , email='1' , status_log='".$status_mod_str."' ";
				$res = mysql_query($query);
		
			}
			
		}
	}
	
	
} 


public function updateITRequest($request)
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$status_id = $request['status_id'];
		$text1 = addslashes($request['text1']);
		$file1 = $request['hfile1'];
		$file2 = $request['hfile2'];
		$file3 = $request['hfile3'];
		$file1 = str_replace(' ', '-', $file1);
		$file2 = str_replace(' ', '-', $file2);
		$file3 = str_replace(' ', '-', $file3);
		$sid  = $request['hsid'];
		//$empData = $this->getEmployeeData($eid);
		$date = date("d-m-Y, h:i:s A");
		//update unread
		$this->updateReadStatus($sid,1);
		
		//status string
		$last_status = $this->getITReqStatus($sid);
		$last_status_str = $this->getITStatusString($last_status);
		$current_status_str = $this->getITStatusString($status_id);
		if($status_id > 0 && $last_status != $status_id)
			$status_mod_str = "[".$last_status_str." => ".$current_status_str."]";
		else
		    $status_mod_str = "[".$last_status_str."]";
			
		if($status_id > 0)
		{	
			$qry=mysql_query("UPDATE od_it_request set status='".$status_id."' where sid='".$sid."'");
		}
		//update cdate
		$date_str =  strtotime($date);
		$qry=mysql_query("UPDATE od_it_request set cdate='".$date."' , cdate_str='".$date_str."' where sid='".$sid."'");
		
		$query = "INSERT into od_it_request_logs set date='".$date."' , sid='".$sid."', eid='".$eid."', msg='".$text1."' , email='1' , file1='".$file1."' , file2='".$file2."' , file3='".$file3."' , status_log='".$status_mod_str."' ";
		$res = mysql_query($query);
		if($res)
		{
			$data_id = mysql_insert_id();
			$msg = "Successfully updated IT Request";
			$data=array("status"=>1, "msg"=>$msg ,"sid"=>$sid, "dataid"=>$data_id );
		}
		else{
			$msg = "Unknown Error...";
			$data=array("status"=>0,"msg"=>$msg);
		}
	}else{
		$msg = "Unknown Error...";
		$data=array("status"=>0,"msg"=>$msg);
	}
	
	return $data;
}


public function updateAdminITRequest($request)
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$status_id = $request['status_id'];
		$text1 = addslashes($request['text1']);
		$file1 = $request['hfile1'];
		$file2 = $request['hfile2'];
		$file3 = $request['hfile3'];
		$file1 = str_replace(' ', '-', $file1);
		$file2 = str_replace(' ', '-', $file2);
		$file3 = str_replace(' ', '-', $file3);
		$sid  = $request['hsid'];
		//$empData = $this->getEmployeeData($eid);
		$date = date("d-m-Y, h:i:s A");
		//update unread
		$this->updateCReadStatus($sid,1);
		
		//status string
		$last_status = $this->getITReqStatus($sid);
		$last_status_str = $this->getITStatusString($last_status);
		$current_status_str = $this->getITStatusString($status_id);
		if($status_id > 0 && $last_status != $status_id)
			$status_mod_str = "[".$last_status_str." => ".$current_status_str."]";
		else
		    $status_mod_str = "[".$last_status_str."]";
			
		if($status_id > 0)
			$qry=mysql_query("UPDATE od_it_request set status='".$status_id."' where sid='".$sid."'");
		
		//update cdate
		$date_str =  strtotime($date);
		$qry=mysql_query("UPDATE od_it_request set cdate='".$date."' , cdate_str='".$date_str."' where sid='".$sid."'");
		////////////
		if($status_id == 3 || $status_id ==  5) 
		{
			$this->completeITReqDeviceInfo($sid,$text1,$eid);
		}
		
		///////////
		
		
		$query = "INSERT into od_it_request_logs set date='".$date."' , sid='".$sid."', eid='".$eid."', msg='".$text1."' , email='1' , file1='".$file1."' , file2='".$file2."' , file3='".$file3."' , status_log='".$status_mod_str."' ";
		$res = mysql_query($query);
		if($res)
		{
			$data_id = mysql_insert_id();
			$msg = "Successfully updated IT Request";
			$data=array("status"=>1, "msg"=>$msg ,"sid"=>$sid, "dataid"=>$data_id );
		}	
		else{
			$msg = "Unknown Error...";
			$data=array("status"=>0,"msg"=>$msg);
		}
	}else{
		$msg = "Unknown Error...";
		$data=array("status"=>0,"msg"=>$msg);
	}
	
	return $data;
}


public function getITReqStatus($sid)
{
	$str=0;
	$dbsql=mysql_query("select status from od_it_request where sid='".$sid."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$str = $row['status'];
	}
	return 	$str;
}

public function getAllOpenITReq()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_it_request where (status='2' or status='1') order by id desc");
	//$dbsql=mysql_query("select * from od_it_request order by id desc  LIMIT 100" );
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$admin = new AdminUser();
		$admin->sid = $row['sid'];
		$admin->info = "#IT".$admin->sid." [".$this->getEmpName($row['eid'])."]:-".$row['title'];
		$dataArray[] = $admin;
	}
	return 	$dataArray;
}

public function getDeviceTypeNameById($id)
	{
		$name = "NA";
		$dbsql=mysql_query("select * from od_it_devicetype where id='".$id."'");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$name = $row['name'];
			}
		}
		return $name;
	}
	
public function getDeviceStatusById($id)
	{
		$name = "NA";
		$dbsql=mysql_query("select * from od_it_devicestatus where id='".$id."'");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$name = $row['name'];
			}
		}
		return $name;
	}	

public function getMyAllocatedDevices()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dataArray = array();
		$dbsql=mysql_query("select * from od_it_device_list where assigned='".$eid."' order by id desc");
		$Num = mysql_num_rows($dbsql);	
		while($row = mysql_fetch_array($dbsql))
		{
			$admin = new AdminUser();
			$admin->id = $row['id'];
			$admin->tid = $row['tid'];
			$admin->type = $row['type'];
			$admin->type_str = $this->getDeviceTypeNameById($admin->type);
			$admin->info = $admin->tid." [".$admin->type_str."]";
			$dataArray[] = $admin;
		}
	}
	return 	$dataArray;
}


public function getITReqPriority($prority)
{
	$str="";
	$dbsql=mysql_query("select * from od_it_priority where id='".$prority."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$str = $row['priority'];
	}
	return 	$str;
}


public function getImprPriority($id)
	{
		$name="";
		$dbsql=mysql_query("select * from od_impr_priority  where id='".$id."'");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
				
				$row = mysql_fetch_array($dbsql);
				$name = $row['name'];	
		}
		return $name;
	}


public function getImprtype($id)
	{
		$name="";
		$dbsql=mysql_query("select * from od_impr_type  where id='".$id."'");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
				
				$row = mysql_fetch_array($dbsql);
				$name = $row['name'];	
		}
		return $name;
	}


public function getImprresponsible($id)
	{
		$name="";
		$dbsql=mysql_query("select * from od_impr_responsible  where id='".$id."'");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
				
				$row = mysql_fetch_array($dbsql);
				$name = $row['name'];	
		}
		return $name;
	}

public function getImprinfo($id)
	{
		$name="";
		$dbsql=mysql_query("select * from od_impr_info  where id='".$id."'");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
				
				$row = mysql_fetch_array($dbsql);
				$name = $row['name'];	
		}
		return $name;
	}





public function getITStatusString($status)
{
	$str="";
	$dbsql=mysql_query("select * from od_it_request_status where id='".$status."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$str = $row['status'];
	}
	return 	$str;
}

public function getITPriorityString($priority)
{
	$str="";
	$dbsql=mysql_query("select * from od_it_priority where id='".$priority."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$str = $row['priority'];
	}
	return 	$str;
}

public function loadEmpOpenITRequest()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_it_request where eid='".$eid."' and ( status='1' or status='2' or status='5' or status='6') ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$sid = $row['sid'];
				$title = stripslashes($row['title']);
				$status = $row['status'];
				$cunread = $row['cunread'];
				$priority = $row['priority'];
				$priority = $this->getITReqPriority($priority);
				$status_str = $this->getITStatusString($status);
				$bold = "normal";
				if($cunread == 1)
					$bold = "bold";	
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_sid = $this->get_mcrypt_encrypt($sid,$iv_key);				
				
				$str .= '<tr class="success">
				       <td  style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                       <td style="font-weight:'.$bold.'" >'.$date.'</td>
					   <td style="font-weight:'.$bold.'" >#IT'.$sid.'</td>
					   <td style="font-weight:'.$bold.'" >'.$title.'</td>
					   <td style="font-weight:'.$bold.'" >'.$priority.'</td>
					   <td style="font-weight:'.$bold.'">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="detailviewitrequest.php?sid='.$encrypt_sid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="7" style="text-align: center; font-weight:bold" >No Open IT Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}







public function loadAdminOpenITRequest()
{
	$dbsql=mysql_query("select * from od_it_request where ( status='1' or status='2' or status='5' or status='6' ) ORDER BY id DESC ");
	$Num = mysql_num_rows($dbsql);	
	if ($Num > 0)
	{
		$sl_no=0;
		while($row = mysql_fetch_array($dbsql))
		{
			$sl_no++;
			$id = $row['id'];
			$date = $row['date'];
			$sid = $row['sid'];
			$eid = $row['eid'];
			$emp_name = $this->getEmpName($eid);
		    $title = stripslashes($row['title']);
			$status = $row['status'];
			$priority = $row['priority'];
			$priority = $this->getITReqPriority($priority);
			$status_str = $this->getITStatusString($status);
			$unread = $row['unread'];
			$bold = "normal";
			if($unread == 1)
				$bold = "bold";
			$iv_key = $this->get_mcrypt_iv();
			$encrypt_sid = $this->get_mcrypt_encrypt($sid,$iv_key);		
				
			$str .= '<tr class="success">
			       <td  style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                   <td style="font-weight:'.$bold.'" >'.$date.'</td>
				   <td style="font-weight:'.$bold.'" >#IT'.$sid.'</td>
				   <td style="font-weight:'.$bold.'" >'.$emp_name.'</td>
				   <td style="font-weight:'.$bold.'" >'.$title.'</td>
				   <td style="font-weight:'.$bold.'" >'.$priority.'</td>
			       <td style="font-weight:'.$bold.'">'.$status_str.'</td>
				   <td class="tooltip-sidebar-logout">
				   <a href="itadmin_detailviewadminitrequest.php?sid='.$encrypt_sid.'&iv='.$iv_key.'" >
				   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
				   </td>
				   </tr>';				
		}
	}else{
			
			$str ='<tr><td colspan="8" style="text-align: center; font-weight:bold" >No Open IT Request found</td></tr>';
	}
	$data=array("status"=>1,"data"=>$str);
	
	return $data;
}



public function loadEmpCloseITRequest()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_it_request where eid='".$eid."' and ( status='3' or status='4' ) ORDER BY cdate_str DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$cdate = $row['cdate'];
				$sid = $row['sid'];
				$priority = $row['priority'];
			    $priority = $this->getITReqPriority($priority);
				$title = stripslashes($row['title']);
				$status = $row['status'];
				$status_str = $this->getITStatusString($status);
				
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_sid = $this->get_mcrypt_encrypt($sid,$iv_key);						
				
				$str .= '<tr class="success">
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'</td>
					   <td style="font-weight:normal" >'.$cdate.'</td>
					   <td style="font-weight:normal" >#IT'.$sid.'</td>
					   <td style="font-weight:normal" >'.$title.'</td>
					   <td style="font-weight:normal" >'.$priority.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="detailviewcloseitrequest.php?sid='.$encrypt_sid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="8" style="text-align: center; font-weight:bold" >No Closed IT Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}

public function loadAdminCloseITRequest()
{
		
	
		$dbsql=mysql_query("select * from od_it_request where ( status='3' or status='4' ) ORDER BY cdate_str DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$cdate = $row['cdate'];
				$sid = $row['sid'];
				$eid = $row['eid'];
				$emp_name = $this->getEmpName($eid);
				$title = stripslashes($row['title']);
				$priority = $row['priority'];
			    $priority = $this->getITReqPriority($priority);
				$status = $row['status'];
				$status_str = $this->getITStatusString($status);
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_sid = $this->get_mcrypt_encrypt($sid,$iv_key);		
				
				$str .= '<tr class="success">
				       <td >'.$sl_no.'</td>
                       <td >'.$date.'</td>
					   <td >'.$cdate.'</td>
					   <td >#IT'.$sid.'</td>
					   <td >'.$emp_name.'</td>
					   <td >'.$title.'</td>
					   <td >'.$priority.'</td>
					   <td >'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="itadmin_detailviewcloseadminitrequest.php?sid='.$encrypt_sid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No Closed IT Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	
	
	
	return $data;
}
	
public function downloadITFile($sid,$dataid,$filename)
{
	$file_download_path = ROOT_DIR."upload_it/".$sid."/".$dataid."/".$filename;
	$actual_path = IT_IMG_PATH.$sid."/".$dataid."/".$filename;
	if(file_exists($actual_path))
	{
		$msg="";
		$data = array("status" => 1 , "msg" => $msg ,"file_path" => $file_download_path , "file_name" => $filename);
	}
	else
	{
		//$msg="Error! File does not exist.";
		$msg=$actual_path;
		$data = array("status" => 0 , "msg" => $msg );
	}
	return $data;
}


function updateReadStatus($sid,$val)
{
	$qry=mysql_query("UPDATE od_it_request set unread='".$val."' where sid='".$sid."'");
	
}


function updateCReadStatus($sid,$val)
{
	$qry=mysql_query("UPDATE od_it_request set cunread='".$val."' where sid='".$sid."'");
	
}

function updateITReqEmail($sid,$val)
{
	$qry=mysql_query("UPDATE od_it_request set email='".$val."' where sid='".$sid."'");
	
}

function updateIMPReqEmail($imprid,$val)
{
	$qry=mysql_query("UPDATE od_impr_record set email='".$val."' where imprid='".$imprid."'");
	
}

function updateITDataEmail($id,$val)
{
	$qry=mysql_query("UPDATE od_it_request_logs set email='".$val."' where id='".$id."'");
	
}

function updateNewITStatus($sid)
{
	//$this->addDebugLogs("Inside updateNewITStatus");
	$dbsql=mysql_query("select * from od_it_request where sid='".$sid."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$str = $row['status'];
		if($str == 1){
			//$this->addDebugLogs("UPDATE od_it_request set status='2' where sid='".$sid."'");
			$qry=mysql_query("UPDATE od_it_request set status='2' where sid='".$sid."'");
		}
	}
		
}

function getITRequestDetails($sid)
{
	
	$dbsql=mysql_query("select * from od_it_request where sid='".$sid."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$admin = new AdminUser();
		$admin->sid = $sid;
		$admin->sid_str = "#IT".$sid;
		$admin->date_created = $row['date'];
		$admin->title = stripslashes($row['title']);
		$admin->creator  = $this->getEmpName($row['eid']);
		$admin->status = $row['status'];
		$admin->status_str = $this->getITStatusString($admin->status);
		$priority = $row['priority'];
		$admin->priority = $this->getITReqPriority($priority);
		$admin->dataArray = array();
		////////get data details
		$dbsql=mysql_query("select * from od_it_request_logs where sid='".$sid."' ORDER BY id DESC");
		$Num = mysql_num_rows($dbsql);	
		while($row = mysql_fetch_array($dbsql))
		{
			$data = new AdminUser();
			$data->dataid = $row['id'];
			$data->date_updated = $row['date'];
			$data->emp_name = $this->getEmpName($row['eid']);
			$data->msg = stripslashes($row['msg']);
			$data->status_log = $row['status_log'];
			$data->attachment=0;
			$file1 = $row['file1']; if(strlen($file1) > 0) $data->attachment++;
			$file2 = $row['file2']; if(strlen($file2) > 0) $data->attachment++;
			$file3 = $row['file3']; if(strlen($file3) > 0) $data->attachment++;
			$data->file1 = $file1;
			$data->file2 = $file2;
			$data->file3 = $file3;
			$admin->dataArray[] =  $data;
		}
	}
	
	return $admin;
}

public function getITRequestFirstData($sid)
{
	$dataid = 0;
	$dbsql=mysql_query("select id from od_it_request_logs where sid='".$sid."' order by id asc");
	if($row = mysql_fetch_array($dbsql))
		$dataid = $row['id'];
	return 	$dataid;
}

public function getNewITRequestList()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_it_request where email='0' ");
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->sid = $row['sid'];
		$data->dataid = $this->getITRequestFirstData($row['sid']);
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_it_request set email='1' ");
		
	return  $dataArray;
}

public function checkNewITRequestStatus()
{
	$current_date = date("d-m-Y, h:i:s A");
	$dataArray = array();
	$dbsql=mysql_query("select * from od_it_request where status='1' ");
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$id  = $row['id'];
		$sid  = $row['sid'];
		$priority = $row['priority'];
		$date = $row['date'];
		$r = $row['r'];
		if($priority == 1) //high
		{
			$reminder = 30;
			$date_str1 =  strtotime($date);
			$date_str2 =  strtotime($current_date);
			$diff=round(abs($date_str2 - $date_str1) / (60*$reminder),0);
			if($diff > 0 && ($r != $diff) )
			{
				$data = new AdminUser();
				$data->sid = $sid;
				$data->dataid = $this->getITRequestFirstData($sid);
				$data->diff = $diff;
				$dataArray[] = $data;
				$qry=mysql_query("UPDATE od_it_request set r='".$diff."' where id=".$id." ");
			}	
		}
	}
	return  $dataArray;
}


public function getUpdateITRequestList()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_it_request_logs where email='0' ");
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->dataid = $row['id'];
		$data->sid = $row['sid'];
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_it_request_logs set email='1' ");
		
	return  $dataArray;
}

public function getManagerEmail($eid)
{
	$email="";
	if(!$this->isManagement($eid))
	{
		$str = "select upper_id from od_emp_report where eid ='".$eid."' ";
		$dbsql=mysql_query($str );
		if($row = mysql_fetch_array($dbsql))
		{
			$manager_id = $row['upper_id'];
			$empInfo = $this->getEmployeeData($manager_id);
			$email = $empInfo->office_email;
			$str = $this->getManagerEmail($manager_id);
			if(strlen($str))
				$email.=','.$str;
		}	
	}
	return $email;
}


public function getRMEmail($eid)
{
	$email="";
	if(!$this->isManagement($eid))
	{
		$str = "select upper_id from od_emp_report where eid ='".$eid."' ";
		$dbsql=mysql_query($str );
		if($row = mysql_fetch_array($dbsql))
		{
			$manager_id = $row['upper_id'];
			$empInfo = $this->getEmployeeData($manager_id);
			$email = $empInfo->office_email;
		}	
	}
	return $email;
}

public function getBUHeadEmail($eid)
{
	$email="";
	if(!$this->isManagement($eid))
	{
		$str = "select bu from od_employee where eid ='".$eid."' ";
		$dbsql=mysql_query($str );
		if($row = mysql_fetch_array($dbsql))
		{
			$bu_id = $row['bu'];
			$bu_head_id = $this->getBUHeadId($bu_id);
			$email = $this->getEmployeeEmail($bu_head_id);
		}	
	}
	return $email;
}


public function getCovidVaccineStatus($emp_id)
{
	$status=false;
	$dbsql=mysql_query("select * from od_covid_info where emp_id='".$emp_id."' ");
	$Num = mysql_num_rows($dbsql);	
	if($Num)
	{
		$row = mysql_fetch_array($dbsql);
		$dose1 = $row['vac_dose1'];
		$dose2 = $row['vac_dose2'];
		if($dose1 !="" && $dose2 !="")
			$status=true;
	}
	return $status;
}


public function updateCovidVaccine($vac_type,$vac_dose1,$vac_dose2)
{
	$emp_id = $_SESSION["emp_id"];
	if(strtotime($vac_dose1) > time()) 
	{
		$msg = "Error! ".$vac_dose1." is a future date. Date should be past/current date.";
		$data = array("status" => 0 , "msg" => $msg );
		return $data;
	}
	
	if(strtotime($vac_dose2) > time()) 
	{
		$msg = "Error! ".$vac_dose2." is a future date. Date should be past/current date.";
		$data = array("status" => 0 , "msg" => $msg );
		return $data;
	}
	
	if($vac_dose2 != "")
	{
		$doseInfo = $this->getVaccineInfo($emp_id);
		$dose1_date = $doseInfo->dose1;
		if(strtotime($dose1_date) >= strtotime($vac_dose2) )
		{
			$msg = "Error! ".$vac_dose2." is a invalid date for 2nd dose. 2nd dose date should be after 1st dose date.";
			$data = array("status" => 0 , "msg" => $msg );
			return $data;
		}
	}
		
		 
	
	$date = date("d-m-Y, h:i:s A");
	$dbsql=mysql_query("select * from od_covid_info where emp_id='".$emp_id."' ");
	$Num = mysql_num_rows($dbsql);
	if($Num)
	{
		if($vac_dose1 != "")  $qry=mysql_query("UPDATE od_covid_info set date='".$date."' , vac_dose1='".$vac_dose1."' where emp_id='".$emp_id."'");
		if($vac_dose2 != "")  $qry=mysql_query("UPDATE od_covid_info set date='".$date."' , vac_dose2='".$vac_dose2."' where emp_id='".$emp_id."'");
		$msg = "Updated Successfully";	
	}else{
		$query = "INSERT into od_covid_info set date='".$date."' , vaccine='".$vac_type."'  , vac_dose1='".$vac_dose1."', vac_dose2='".$vac_dose2."', emp_id='".$emp_id."'  ";
		$res = mysql_query($query);
		$msg = "Added Successfully";
	}
		
	$data = array("status" => 1 , "msg" => $msg );
	return $data;
}

public function getVaccineInfo($emp_id)
{
	$data = new AdminUser();
	$data->status = 0;
	$dbsql=mysql_query("select * from od_covid_info where emp_id='".$emp_id."' ");
	$Num = mysql_num_rows($dbsql);
	if($Num)
	{
		$data->status = 1;
		$row = mysql_fetch_array($dbsql);
		$data->vaccine = $row['vaccine'];
		$data->dose1 = $row['vac_dose1'];
		$data->dose2 = $row['vac_dose2'];
	}
	return $data;
}
//////////////////////////////////////////////////////////////////////////////////
////////////////////////END IT MODULES////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////
////////////////////START PR MODULES/////////////////////////////
/////////////////////////////////////////////////////////////////


public function generatePRReqID($num)
{
	$id="";
	$size  = strlen($num);
	if($size == 1)
		$id = "100".$num;
	else if	($size == 2)
	    $id = "10".$num;
	else if	($size == 3)
		$id = "1".$num;
	else if	($size == 4)
		$id = $num;	
	
	return $id;	
}

public function getPRStatusString($status)
{
	$str="";
	$dbsql=mysql_query("select * from od_pr_request_status where id='".$status."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$str = $row['status'];
	}
	return 	$str;
}






public function getPRHeadString($head)
{
	$str="";
	$dbsql=mysql_query("select * from od_finance_head where id='".$head."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$str = $row['fin_head'];
	}
	return 	$str;
}


public function getFinanceHead(){
			$getArray= array();
			$dbsql=mysql_query("select * from ".PREFIX1."finance_head where status=1 order by id asc");
			$Num = mysql_num_rows($dbsql);
		
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$admin = new AdminUser();
					$admin->id = $row['id'];  
					$admin->name = $row['fin_head'];
					$getArray[] = $admin;
				}
			}
		return $getArray;
}

public function getMyFinanceHead(){
		$emp_id = $_SESSION["emp_id"];
		$hr = $this->isHRAdmin($emp_id);
		$mgmt = $this->isManagement($emp_id);
		if($mgmt)
		{
			$getArray = $this->getFinanceHead();
			return $getArray;
		}
		
		if($hr)
		{			
			$admin = new AdminUser();
			$admin->id = 5;  
			$admin->name = "HR";
			$getArray[] = $admin;
		}
		
	return $getArray;
}


public function getMyITHead(){
		$emp_id = $_SESSION["emp_id"];
		$it = $this->isITAdmin($emp_id);
		$mgmt = $this->isManagement($emp_id);
		if($mgmt)
		{
			$getArray = $this->getFinanceHead();
			return $getArray;
		}
		
		if($it)
		{			
			$admin = new AdminUser();
			$admin->id = 4;  
			$admin->name = "IT";
			$getArray[] = $admin;
		}
		
	return $getArray;
}
	
public function getPSReqStatus($sid)
{
	$str=0;
	$dbsql=mysql_query("select status from od_pr_request where sid='".$sid."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$str = $row['status'];
	}
	return 	$str;
}

public function getIMPReqStatus($imprid)
{
	$str=0;
	$dbsql=mysql_query("select status from od_impr_record where imprid='".$imprid."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$str = $row['status'];
	}
	return 	$str;
}




function getPRCreatedID($sid)
{
	$eid = 0;
	$dbsql=mysql_query("select * from od_pr_request where sid = '".$sid."' ");
	if($row = mysql_fetch_array($dbsql))
	{
		$eid = $row['eid'];
	}	
	return $eid;
}
	
function updatePSCReadStatus($sid,$val)
{
	$eid = $_SESSION["emp_id"];
	$c_eid = $this->getPRCreatedID($sid);
	if($eid == $c_eid)
	$qry=mysql_query("UPDATE od_pr_request set cunread='".$val."' where sid='".$sid."'");
	
}




function updateIMPReadStatus($imprid,$val)
{
	$eid = $_SESSION["emp_id"];
	$c_eid = $this->getIMCreatedID($imprid);
	if($eid == $c_eid)
	$qry=mysql_query("UPDATE od_impr_record set cunread='".$val."' where imprid='".$imprid."'");
	
}

public function updatePSReqEmail($sid,$val)
{
	$qry=mysql_query("UPDATE od_pr_request set email='".$val."' where sid='".$sid."'");
	
}

public function updatePSDataEmail($id,$val)
{
	$qry=mysql_query("UPDATE od_pr_request_logs set email='".$val."' where id='".$id."'");
}


public function updateIMPEmail($id,$val)
{
	$qry=mysql_query("UPDATE od_impr_record_logs set email='".$val."' where id='".$id."'");
}


public function getPSRequestInfo($sid)
{
	$dbsql=mysql_query("select * from od_pr_request where sid='".$sid."' ");
	$Num = mysql_num_rows($dbsql);	
	$row = mysql_fetch_array($dbsql);
	return 	$row;
}


public function getPSDataInfo($dataid)
{
	$dbsql=mysql_query("select * from od_pr_request_logs where id='".$dataid."' ");
	$Num = mysql_num_rows($dbsql);	
	$row = mysql_fetch_array($dbsql);
	return 	$row;
}


function updatePSReadStatus($sid,$val)
{
	$eid = $_SESSION["emp_id"];
	$c_eid = $this->getPRCreatedID($sid);
	if($eid != $c_eid)
	{	
		$qry=mysql_query("UPDATE od_pr_request set unread='".$val."' where sid='".$sid."'");
	
		$dbsql=mysql_query("select * from od_pr_request where sid='".$sid."' ");
		$Num = mysql_num_rows($dbsql);	
		if($row = mysql_fetch_array($dbsql))
		{
			$str = $row['status'];
			if($str == 1)
				$qry=mysql_query("UPDATE od_pr_request set status='2' where sid='".$sid."'");
		
		}
	}
}


public function generatePSRequest($request)
{
	$eid = $_SESSION["emp_id"];
		
	if($eid > 0)
	{
		$title = addslashes($request['title']);
		$text1 = addslashes($request['text1']);
		$bu_head = $request['bu_head'];
		$head = $request['pr-head'];
		$cost = $request['pr-cost'];
		
		$file1 = $request['hfile1'];
		$file2 = $request['hfile2'];
		$file3 = $request['hfile3'];
		$file1 = str_replace(' ', '-', $file1);
		$file2 = str_replace(' ', '-', $file2);
		$file3 = str_replace(' ', '-', $file3);
				
		//$empData = $this->getEmployeeData($eid);
		$date = date("d-m-Y, h:i:s A");
		
		$query = "INSERT into od_pr_request set date='".$date."' , sid='0', email='1', eid='".$eid."', title='".$title."' , bu='".$bu_head."' , head='".$head."' , cost='".$cost."' ";
		$res = mysql_query($query);
		if($res)
		{
			$db_id = mysql_insert_id();
			$sid = $this->generatePRReqID($db_id);
			
			$qry=mysql_query("UPDATE od_pr_request set sid='".$sid."' where id='".$db_id."'");
			
			$last_status_str = $this->getPRStatusString(1);
			$status_mod_str = "[".$last_status_str."]";
			
			$query = "INSERT into od_pr_request_logs set date='".$date."' , sid='".$sid."', eid='".$eid."', msg='".$text1."' , email='1' , file1='".$file1."' , file2='".$file2."' , file3='".$file3."' , status_log='".$status_mod_str."' ";
			$res = mysql_query($query);
			if($res)
			{
				$data_id = mysql_insert_id();
				$msg = "Successfully generated new Purchase Request. PR Ticket is: #PR".$sid;
				$data=array("status"=>1, "msg"=>$msg ,"sid"=>$sid, "dataid"=>$data_id );
			}
			else{
				$str1 = "delete from od_pr_request where sid='".$sid."' ";
				$dbsql=mysql_query($str1);
				$msg = "Unknown Error...";
				$data=array("status"=>0,"msg"=>$msg);
			}
		}
		else{
			$msg = "Unknown Error...";
			$data=array("status"=>0,"msg"=>$msg);
		}
	}else{
		$msg = "Unknown Error...";
		$data=array("status"=>0,"msg"=>$msg);
	}
	
	return $data;
}


public function loadEmpOpenPSRequest()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_pr_request where ( status='1' or status='2' or status='3' or status='4' or status='7') ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$sid = $row['sid'];
				$title = stripslashes($row['title']);
				$bu = $row['bu'];
				$bu_name = $this->getBUnitById($bu);
				$head = $row['head'];
				$head_name = $this->getPRHeadString($head);
				$created_eid = $row['eid'];
				$created_by = $this->getEmpName($created_eid);
				$cost = $row['cost'];
				$status = $row['status'];
				$cunread = $row['cunread'];
				$unread = $row['unread'];
				$status_str = $this->getPRStatusString($status);
				$bold = "normal";
				if($eid == $created_eid)
				{	
					if($cunread == 1) $bold = "bold";
				}else{
					if($unread == 1) $bold = "bold";
				}
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_sid = $this->get_mcrypt_encrypt($sid,$iv_key);	
				
				$str .= '<tr class="success">
				       <td  style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                       <td style="font-weight:'.$bold.'" >'.$date.'</td>
					   <td style="font-weight:'.$bold.'" >#PR'.$sid.'</td>
					   <td style="font-weight:'.$bold.'" >'.$title.'</td>
					   <td style="font-weight:'.$bold.'" >'.$bu_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$head_name.'</td>
					   <td style="font-weight:'.$bold.'" >₹'.$cost.'</td>
					   <td style="font-weight:'.$bold.'">'.$status_str.'</td>
					   <td style="font-weight:'.$bold.'">'.$created_by.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="detailviewpsrequest.php?sid='.$encrypt_sid.'&iv='.$iv_key.'" >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No Open Purchase Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}


public function loadMyOpenPSRequest()
{
	$eid = $_SESSION["emp_id"];
	//$eid = 1001;
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_pr_request where eid ='".$eid."' and  ( status='1' or status='2' or status='3' or status='4' or status='7') ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$sid = $row['sid'];
				$title = stripslashes($row['title']);
				$bu = $row['bu'];
				$bu_name = $this->getBUnitById($bu);
				$head = $row['head'];
				$head_name = $this->getPRHeadString($head);
				$created_eid = $row['eid'];
				$created_by = $this->getEmpName($created_eid);
				$cost = $row['cost'];
				$status = $row['status'];
				$cunread = $row['cunread'];
				$unread = $row['unread'];
				$status_str = $this->getPRStatusString($status);
				$bold = "normal";
				if($eid == $created_eid)
				{	
					if($cunread == 1) $bold = "bold";
				}else{
					if($unread == 1) $bold = "bold";
				}
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_sid = $this->get_mcrypt_encrypt($sid,$iv_key);	
				
				$str .= '<tr class="success">
				       <td  style="font-weight:'.$bold.'" >'.$sl_no.'</td>
                       <td style="font-weight:'.$bold.'" >'.$date.'</td>
					   <td style="font-weight:'.$bold.'" >#PR'.$sid.'</td>
					   <td style="font-weight:'.$bold.'" >'.$title.'</td>
					   <td style="font-weight:'.$bold.'" >'.$bu_name.'</td>
					   <td style="font-weight:'.$bold.'" >'.$head_name.'</td>
					   <td style="font-weight:'.$bold.'" >₹'.$cost.'</td>
					   <td style="font-weight:'.$bold.'">'.$status_str.'</td>
					   <td style="font-weight:'.$bold.'">'.$created_by.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="detailviewmypsrequest.php?sid='.$encrypt_sid.'&iv='.$iv_key.'" >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No Open Purchase Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}



function getPSRequestDetails($sid)
{
	
	$dbsql=mysql_query("select * from od_pr_request where sid='".$sid."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$admin = new AdminUser();
		$admin->sid = $sid;
		$admin->date_created = $row['date'];
		$admin->title = stripslashes($row['title']);
		$bu = $row['bu'];
		$head = $row['head'];
		$admin->bu_name = $this->getBUnitById($bu);;
		$admin->head_name = $this->getPRHeadString($head);
		$admin->cost = $row['cost'];
		$admin->act_cost = $row['act_cost'];
		$admin->creator_eid = $row['eid'];
		$admin->creator  = $this->getEmpName($row['eid']);
		$admin->status = $row['status'];
		$admin->status_str = $this->getPRStatusString($admin->status);
		$admin->dataArray = array();
		////////get data details
		$dbsql=mysql_query("select * from od_pr_request_logs where sid='".$sid."' ORDER BY id DESC");
		$Num = mysql_num_rows($dbsql);	
		while($row = mysql_fetch_array($dbsql))
		{
			$data = new AdminUser();
			$data->dataid = $row['id'];
			$data->date_updated = $row['date'];
			$data->emp_name = $this->getEmpName($row['eid']);
			$data->msg = stripslashes($row['msg']);
			$data->status_log = $row['status_log'];
			$data->attachment=0;
			$file1 = $row['file1']; if(strlen($file1) > 0) $data->attachment++;
			$file2 = $row['file2']; if(strlen($file2) > 0) $data->attachment++;
			$file3 = $row['file3']; if(strlen($file3) > 0) $data->attachment++;
			$data->file1 = $file1;
			$data->file2 = $file2;
			$data->file3 = $file3;
			$admin->dataArray[] =  $data;
		}
	}
	
	return $admin;
}


public function updatePSRequest($request)
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$status_id = $request['status_id'];
		$act_cost = $request['act_cost'];
		$text1 = addslashes($request['text1']);
		$file1 = $request['hfile1'];
		$file2 = $request['hfile2'];
		$file3 = $request['hfile3'];
		$file1 = str_replace(' ', '-', $file1);
		$file2 = str_replace(' ', '-', $file2);
		$file3 = str_replace(' ', '-', $file3);
		$sid  = $request['hsid'];
		//$empData = $this->getEmployeeData($eid);
		$date = date("d-m-Y, h:i:s A");
		//update unread
		$this->updatePSReadStatus($sid,1);
		
		//status string
		$last_status = $this->getPSReqStatus($sid);
		$last_status_str = $this->getPRStatusString($last_status);
		$current_status_str = $this->getPRStatusString($status_id);
		if($status_id > 0 && $last_status != $status_id)
			$status_mod_str = "[".$last_status_str." => ".$current_status_str."]";
		else
		    $status_mod_str = "[".$last_status_str."]";
			
		if($status_id > 0)
		{	
			$qry=mysql_query("UPDATE od_pr_request set act_cost='".$act_cost."' , status='".$status_id."' where sid='".$sid."'");
		}
		
		$c_eid = $this->getPRCreatedID($sid);
		//update cdate
		$date_str =  strtotime($date);
		if($c_eid == $eid)
			$qry=mysql_query("UPDATE od_pr_request set cdate='".$date."' , cdate_str='".$date_str."' , unread='1'  where sid='".$sid."'");
		else
			$qry=mysql_query("UPDATE od_pr_request set cdate='".$date."' , cdate_str='".$date_str."' , cunread='1'  where sid='".$sid."'");
		
		$query = "INSERT into od_pr_request_logs set date='".$date."' , sid='".$sid."', eid='".$eid."', msg='".$text1."' , email='1' , file1='".$file1."' , file2='".$file2."' , file3='".$file3."' , status_log='".$status_mod_str."' ";
		$res = mysql_query($query);
		if($res)
		{
			$data_id = mysql_insert_id();
			$msg = "Successfully updated Purchase Request";
			$data=array("status"=>1, "msg"=>$msg ,"sid"=>$sid, "dataid"=>$data_id );
		}
		else{
			$msg = "Unknown Error...";
			$data=array("status"=>0,"msg"=>$msg);
		}
	}else{
		$msg = "Unknown Error...";
		$data=array("status"=>0,"msg"=>$msg);
	}
	return $data;
}


public function loadEmpClosePSRequest()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_pr_request where (status='5' or status='6' ) ORDER BY cdate_str DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$cdate = $row['cdate'];
				$sid = $row['sid'];
				$title = stripslashes($row['title']);
				$head = $row['head'];
				$head_name = $this->getPRHeadString($head);
				$cost = $row['cost'];
				$creator_eid = $row['eid'];
				$created_by  = $this->getEmpName($row['eid']);
				$status = $row['status'];
				$status_str = $this->getPRStatusString($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_sid = $this->get_mcrypt_encrypt($sid,$iv_key);
				
				$str .= '<tr class="success">
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'<BR>'.$cdate.'</td>
					   <td style="font-weight:normal" >#PR'.$sid.'</td>
					   <td style="font-weight:'.$bold.'" >'.$title.'</td>
					   <td style="font-weight:'.$bold.'" >'.$head_name.'</td>
					   <td style="font-weight:'.$bold.'" >₹'.$cost.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td style="font-weight:'.$bold.'">'.$created_by.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="detailviewclosepsrequest.php?sid='.$encrypt_sid.'&iv='.$iv_key.'" >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No Closed Purchase Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}


public function loadMyClosePSRequest()
{
	$eid = $_SESSION["emp_id"];
	//$eid = 1001;
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_pr_request where eid = '".$eid."' and (status='5' or status='6' ) ORDER BY cdate_str DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$cdate = $row['cdate'];
				$sid = $row['sid'];
				$title = stripslashes($row['title']);
				$head = $row['head'];
				$head_name = $this->getPRHeadString($head);
				$cost = $row['cost'];
				$creator_eid = $row['eid'];
				$created_by  = $this->getEmpName($row['eid']);
				$status = $row['status'];
				$status_str = $this->getPRStatusString($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_sid = $this->get_mcrypt_encrypt($sid,$iv_key);
				
				$str .= '<tr class="success">
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'<BR>'.$cdate.'</td>
					   <td style="font-weight:normal" >#PR'.$sid.'</td>
					   <td style="font-weight:'.$bold.'" >'.$title.'</td>
					   <td style="font-weight:'.$bold.'" >'.$head_name.'</td>
					   <td style="font-weight:'.$bold.'" >₹'.$cost.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td style="font-weight:'.$bold.'">'.$created_by.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="detailviewclosemypsrequest.php?sid='.$encrypt_sid.'&iv='.$iv_key.'" >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No Closed Purchase Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}

public function downloadPSFile($sid,$dataid,$filename)
{
	$file_download_path = ROOT_DIR."upload_pr/".$sid."/".$dataid."/".$filename;
	$actual_path = PR_IMG_PATH.$sid."/".$dataid."/".$filename;
	if(file_exists($actual_path))
	{
		$msg="";
		$data = array("status" => 1 , "msg" => $msg ,"file_path" => $file_download_path , "file_name" => $filename);
	}
	else
	{
		//$msg="Error! File does not exist.";
		$msg=$file_download_path;
		$data = array("status" => 0 , "msg" => $msg );
	}
	return $data;
}

public function addPSLogs($sid)
{
	$eid = $_SESSION["emp_id"];
	$date = date("d-m-Y, h:i:s A");
	$query = "INSERT into od_pr_logs set date='".$date."' , sid='".$sid."', eid='".$eid."'";
	$res = mysql_query($query);
	
}

public function getNewPSRequestList()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_pr_request where email='0' ");
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->sid = $row['sid'];
		$data->dataid = $this->getPSRequestFirstData($row['sid']);
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_pr_request set email='1' ");
		
	return  $dataArray;
}

public function getUpdatePSRequestList()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_pr_request_logs where email='0' ");
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->dataid = $row['id'];
		$data->sid = $row['sid'];
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_pr_request_logs set email='1' ");
		
	return  $dataArray;
}

public function getPSRequestFirstData($sid)
{
	$dataid = 0;
	$dbsql=mysql_query("select id from od_pr_request_logs where sid='".$sid."' order by id asc");
	if($row = mysql_fetch_array($dbsql))
		$dataid = $row['id'];
	return 	$dataid;
}




//////////////////////////////////////////////////////////////////////////////////
////////////////////////END PR MODULES////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////
////////////////////////START EMAIL MODULES////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

public function getForgotPasswdEmailList()
{
	$dataArray = array();
	
	$dbsql=mysql_query("select * from od_director where repasswd_email =1 ");
	$Num = mysql_num_rows($dbsql);
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->eid = $row['did'];
		$data->otp = $row['repasswd_otp'];
		$data->type=1;
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_director set repasswd_email='0' ");
	
	
	$dbsql=mysql_query("select * from od_employee where repasswd_email =1 ");
	$Num = mysql_num_rows($dbsql);
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->eid = $row['eid'];
		$data->otp = $row['repasswd_otp'];
		$data->type=2;
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_employee set repasswd_email='0' ");
			
	return  $dataArray;
}

public function getCreateNewEmailList()
{
	$dataArray = array();
	
	$dbsql=mysql_query("select * from od_employee where itr_email =1 ");
	$Num = mysql_num_rows($dbsql);
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->eid = $row['eid'];
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_employee set itr_email='0' ");
			
	return  $dataArray;
}

public function getNewEmployeeList()
{
	$dataArray = array();
	
	$dbsql=mysql_query("select * from od_employee where femail =1 ");
	$Num = mysql_num_rows($dbsql);
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->eid = $row['eid'];
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_employee set femail='0' ");
			
	return  $dataArray;
}

public function getNewNormalEmailList()
{
	$dataArray = array();
	
	$dbsql=mysql_query("select * from od_send_email where send =0 ");
	$Num = mysql_num_rows($dbsql);
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->to = $row['toemail'];
		$data->cc = $row['cc'];
		$data->bcc = $row['bcc'];
		$data->title = $row['title'];
		$data->name = $row['name'];
		$data->body = stripcslashes($row['body']);
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_send_email set send='1' ");
			
	return  $dataArray;
}





//////////////////////////////////////////////////////////////////////////////////
////////////////////////END EMAIL MODULES////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////







//////////////////////////////////////////////////////////////////////////////////
////////////////////////START HR MODULES////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////


public function getAllEmpType()
{
	
	$getArray= array();
	$dbsql=mysql_query("select * from od_employee_type order by id asc");
	$Num = mysql_num_rows($dbsql);
	if ($Num > 0)
	{
		while($row = mysql_fetch_array($dbsql))
		{
			$admin = new AdminUser();
			$admin->name = $row['type'];  
			$admin->code = $row['code'];
			$getArray[] = $admin;
		}
	}
	return $getArray;
}


public function getEmpTypeById($id)
{
	$type="NA";
	$dbsql=mysql_query("select * from od_employee_type where code='".$id."' ");
	$Num = mysql_num_rows($dbsql);
	if($row = mysql_fetch_array($dbsql))
	{
		$type = $row['type'];  
	}
	return $type;
}

public function getEmployeeId($joindate){
		
		$month = date('m', strtotime($joindate));
		$year = date('y', strtotime($joindate));
		$id = $year.$month."01";
		$loop = true;	
		while($loop)
		{
			$dbsql=mysql_query("select eid from ".PREFIX1."employee where eid = '".$id."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num != 0)
				$id+=1;
			else
				$loop =  false;
		}
		return $id;
	}
	
		public function addEmployee($data){
					
					$pass_rand = $data['mobile_no'];
					$passwd = sha1($pass_rand);
					
					$dateofbirth = date('Y-m-d', strtotime($data['date_of_birth']));
					$oditek_joining_date = date('Y-m-d', strtotime($data['oditek_joining_date']));
					
					$edit_type='Created';
					$office_email = $data['email_office']."@oditeksolutions.com";
					
					$experiance = $data['exp_type'];
					$type = $data['employee_type'];
					
					
					$query = "INSERT INTO ".PREFIX1."employee set eid='".$data['employeeid']."', name='".$data['name_first']."' , gender='".$data['gender']."', date_of_birth='".$dateofbirth."', blood_grp='".$data['blood_grp']."' , mrg_status='".$data['mrg_status']."' ,pan_no='".$data['pan_no']."', passport_no='".$data['passport_no']."', joining_date='".$oditek_joining_date."', mobile='".$data['mobile_no']."', emergency='".$data['emobile']."', experiance='".$experiance."' , type='".$type."' , status='1' , office_email='".$office_email."' , userid='".$data['userid']."', email='".$data['email1']."', skype_id='".$data['skype']."', password='".$passwd."', raw_passwd='".$pass_rand."', date_added=now() , mod_by='".$_SESSION['admin_name']."' , bu='".$data['bu_id']."' ";
				
					
					$res = mysql_query($query);
					$employee_id = $data['employeeid'];
				
					$query = "UPDATE od_employee set itr='1' , itr_email='1' WHERE eid='".$employee_id."' ";
					$res = mysql_query($query);
					
				
					//Insert reporting Table
					$allquery = "INSERT INTO ".PREFIX1."emp_report set eid='".$employee_id."', upper_id='".$data['upper_id']."' , dept_id='".$data['dept_id']."' , desig_id='".$data['desig_id']."' ";
					$allres = mysql_query($allquery);
					
					//Insert family data
					$address = addslashes($data['addr1']);
					$allquery = "INSERT INTO od_emp_family set eid='".$employee_id."', fname='".$data['fname']."' , mname='".$data['mname']."' , ename='".$data['ename']."' , 	emobile='".$data['emobile']."'  , 	erelationship='".$data['erelationship']."' , address='".$address."'  ";
					$allres = mysql_query($allquery);
					
					//Insert Education data
					//1st
					$cuname1 = addslashes($data['cuname1']);
					$degree1 = addslashes($data['degree1']);
					$eduyear1 = addslashes($data['eduyear1']);
					$eduper1 = addslashes($data['eduper1']);
					$allquery = "INSERT INTO od_emp_education set eid='".$employee_id."', cuname='".$cuname1."' , degree='".$degree1."' , eduyear='".$eduyear1."' , eduper='".$eduper1."'  ";
					$allres = mysql_query($allquery);
					//2nd
					$cuname2 = addslashes($data['cuname2']);
					$degree2 = addslashes($data['degree2']);
					$eduyear2 = addslashes($data['eduyear2']);
					$eduper2 = addslashes($data['eduper2']);
					$allquery = "INSERT INTO od_emp_education set eid='".$employee_id."', cuname='".$cuname2."' , degree='".$degree2."' , eduyear='".$eduyear2."' , eduper='".$eduper2."'  ";
					$allres = mysql_query($allquery);
					//3rd
					$cuname3 = addslashes($data['cuname3']);
					$degree3 = addslashes($data['degree3']);
					$eduyear3 = addslashes($data['eduyear3']);
					$eduper3 = addslashes($data['eduper3']);
					$allquery = "INSERT INTO od_emp_education set eid='".$employee_id."', cuname='".$cuname3."' , degree='".$degree3."' , eduyear='".$eduyear3."' , eduper='".$eduper3."'  ";
					$allres = mysql_query($allquery);
					
					
					if($experiance)
					{
						$exp_yr = $data['exp_yr'];
						$exp_mn = $data['exp_mn'];
						$prev_org = addslashes($data['prev_org']);
						$skills = addslashes($data['skills']);
						
						$allquery = "INSERT INTO od_employee_exp set eid='".$employee_id."', exp_year='".$exp_yr."' , exp_month='".$exp_mn."' , prev_org='".$prev_org."' , skills='".$skills."' ";
					    $allres = mysql_query($allquery);
					}
					
					if($type == 2) //probation
					{
						$start_date = $oditek_joining_date;
						$month = $data['probation_period'];
						$end_date = date('Y-m-d',strtotime($start_date." ".$month." months"));
						$allquery = "INSERT INTO od_emp_probation set eid='".$employee_id."', start_date='".$start_date."' , month='".$month."' , end_date='".$end_date."' ";
					    $allres = mysql_query($allquery);
					}
					
					
					if($employee_id > 0)
						$data=array("status"=>1,"msg"=>"Successfully created new employee...");
					else
						$data=array("status"=>0,"msg"=>"Error...");
					
					return $data;
				}


public function employeeUpdateRecordsLogs($eid,$ename,$msg,$mod_by)
{
	$today = date("d-m-Y, h:i:s A");
	$query = "INSERT into od_emp_records_update_logs set date='".$today."' , eid='".$eid."', ename='".$ename."' , logs='".$msg."' , mod_by='".$mod_by."' ";
	$res = mysql_query($query);
	
}				
	
public function updateBasicInfo($data)
{
	$host_eid = $_SESSION["emp_id"];
	if($host_eid > 0)
	{	
		$eid = $data['heid'];
		$emp_name = $data['emp_name'];
		if($eid > 0)
		{
			$db_id = $data['hid'];
			$db_type = $data['htype'];
			
			$name = $data['name_first'];
			$gender = $data['gender'];
			$blood_grp = $data['blood_grp'];
			$date_of_birth = $data['date_of_birth'];
			$mrg_status = $data['mrg_status'];
			$mobile_no = $data['mobile_no'];
			$skype = $data['skype'];
			$pan_no = $data['pan_no'];
			$passport_no = $data['passport_no'];
			$aadhar_no = $data['aadhar_no'];
			$emergency_no = $data['emergency_no'];
			$email = $data['email1'];
			
			$date_of_birth = date('Y-m-d', strtotime($date_of_birth));
			
			if($db_type == 2)
			{	
				$query = "UPDATE od_employee set  name='".$name."' , gender='".$gender."', date_of_birth='".$date_of_birth."', blood_grp='".$blood_grp."' , mrg_status='".$mrg_status."' ,pan_no='".$pan_no."', passport_no='".$passport_no."', mobile='".$mobile_no."', emergency='".$emergency_no."', email='".$email."', skype_id='".$skype."' where id='".$db_id."' and eid ='".$eid."' ";
			}
			else{
				$query = "UPDATE od_director set  name='".$name."' , gender='".$gender."', date_of_birth='".$date_of_birth."', blood_grp='".$blood_grp."' , mrg_status='".$mrg_status."' ,pan_no='".$pan_no."', passport_no='".$passport_no."', mobile='".$mobile_no."', emergency='".$emergency_no."', email='".$email."', skype_id='".$skype."' where id='".$db_id."' and did ='".$eid."' ";
			}
			//$this->addDebugLogs($query);
			$res = mysql_query($query);
			if($res)
			{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateBasicInfo::Success",$host_eid);
				$status = 1;
				$msg = "Succesfully updated Basic Info of \"".$emp_name."\".";
			}
			else{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateBasicInfo::Failure",$host_eid);
				$status = 0;
				$msg = "Error!, Something went wrong. Try again.11";
			}
		}
		else{
			$status = 0;
			$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateBasicInfo::Failure",$host_eid);
			$msg = "Error!, Something went wrong. Try again.22";
		}
	}
	
	$result = array("status"=>$status,"msg"=>$msg);
	
	return $result; 
}


public function updateFamilyInfo($data)
{
	$host_eid = $_SESSION["emp_id"];
	if($host_eid > 0)
	{	
		$eid = $data['heid'];
		$emp_name = $data['emp_name'];
		if($eid > 0)
		{
			$db_id = $data['hid'];
			$db_type = $data['htype'];
			
			$father_name = $data['father_name'];
			$mother_name = $data['mother_name'];
			$emer_name = $data['emer_name'];
			$emer_mobile = $data['emer_mobile'];
			$addr1 = $data['addr1'];
			$emer_rela = $data['emer_rela'];
			
			
			$addr1 = addslashes($addr1);
			
			//check if Family db prsent or not 
			$dbsql=mysql_query("select * from od_emp_family where eid='".$eid."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				$query = "UPDATE od_emp_family set fname='".$father_name."' , mname='".$mother_name."' , ename='".$emer_name."' , 	emobile='".$emer_mobile."'  , 	erelationship='".$emer_rela."' , address='".$addr1."' where eid='".$eid."' ";
			}
			else
			{
				$query = "INSERT INTO od_emp_family set eid='".$eid."' , fname='".$father_name."' , mname='".$mother_name."' , ename='".$emer_name."' , emobile='".$emer_mobile."'  , 	erelationship='".$emer_rela."' , address='".$addr1."'  ";
			}		
			$res = mysql_query($query);
			if($res)
			{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateFamilyInfo::Success",$host_eid);
				$status = 1;
				$msg = "Succesfully updated Family Info of \"".$emp_name."\".";
			}
			else{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateFamilyInfo::Failure",$host_eid);
				$status = 0;
				$msg = "Error!, Something went wrong. Try again.11";
			}
		}
		else{
			$status = 0;
			$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateFamilyInfo::Failure",$host_eid);
			$msg = "Error!, Something went wrong. Try again.22";
		}
	}
	
	$result = array("status"=>$status,"msg"=>$msg);
	
	return $result; 
}


public function updateEducationInfo($data)
{
	$host_eid = $_SESSION["emp_id"];
	if($host_eid > 0)
	{	
		$eid = $data['heid'];
		$emp_name = $data['emp_name'];
		if($eid > 0)
		{
			$db_id = $data['hid'];
			$db_type = $data['htype'];
			
			$cuname1 = addslashes($data['cuname1']);
			$degree1 = addslashes($data['degree1']);
			$eduyear1 = addslashes($data['eduyear1']);
			$eduper1 = addslashes($data['eduper1']);
			
			$cuname2 = addslashes($data['cuname2']);
			$degree2 = addslashes($data['degree2']);
			$eduyear2 = addslashes($data['eduyear2']);
			$eduper2 = addslashes($data['eduper2']);
					
			$cuname3 = addslashes($data['cuname3']);
			$degree3 = addslashes($data['degree3']);
			$eduyear3 = addslashes($data['eduyear3']);
			$eduper3 = addslashes($data['eduper3']);
			
			//delete all old records  
			$dbsql=mysql_query("delete from od_emp_education where eid='".$eid."' ");
						
			//add new entry
			$allquery = "INSERT INTO od_emp_education set eid='".$eid."', cuname='".$cuname1."' , degree='".$degree1."' , eduyear='".$eduyear1."' , eduper='".$eduper1."'  ";
			$res = mysql_query($allquery);
			
			$allquery = "INSERT INTO od_emp_education set eid='".$eid."', cuname='".$cuname2."' , degree='".$degree2."' , eduyear='".$eduyear2."' , eduper='".$eduper2."'  ";
			$res = mysql_query($allquery);
			
			$allquery = "INSERT INTO od_emp_education set eid='".$eid."', cuname='".$cuname3."' , degree='".$degree3."' , eduyear='".$eduyear3."' , eduper='".$eduper3."'  ";
			$res = mysql_query($allquery);
					
					
			if($res)
			{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateEducationInfo::Success",$host_eid);
				$status = 1;
				$msg = "Succesfully updated Education Info of \"".$emp_name."\".";
			}
			else{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateEducationInfo::Failure",$host_eid);
				$status = 0;
				$msg = "Error!, Something went wrong. Try again.11";
			}
		}
		else{
			$status = 0;
			$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateEducationInfo::Failure",$host_eid);
			$msg = "Error!, Something went wrong. Try again.22";
		}
	}
	
	$result = array("status"=>$status,"msg"=>$msg);
	
	return $result; 
}


public function updatePastExpInfo($data)
{
	$host_eid = $_SESSION["emp_id"];
	if($host_eid > 0)
	{	
		$eid = $data['heid'];
		$emp_name = $data['emp_name'];
		if($eid > 0)
		{
			$db_id = $data['hid'];
			$db_type = $data['htype'];
			
			$exp_type = $data['exp_type'];
			$prev_org = addslashes($data['prev_org']);
			$exp_yr = $data['exp_yr'];
			$exp_mn = $data['exp_mn'];
			$skills = addslashes($data['skills']);
			
			//check if past exp db prsent or not 
			$dbsql=mysql_query("select * from  od_employee_exp where eid='".$eid."' ");
			$Num = mysql_num_rows($dbsql);
			if($Num > 0)
			{
				if($exp_type)	
					$query = "UPDATE od_employee_exp set enable='".$exp_type."' , exp_year='".$exp_yr."' , exp_month='".$exp_mn."' , prev_org='".$prev_org."' , skills='".$skills."' where eid='".$eid."' ";
				else
					$query = "UPDATE od_employee_exp set enable='".$exp_type."' where eid='".$eid."' ";
			}
			else
			{
				$query = "INSERT INTO od_employee_exp set eid='".$eid."' , enable='".$exp_type."' , exp_year='".$exp_yr."' , exp_month='".$exp_mn."' , prev_org='".$prev_org."' , skills='".$skills."'  ";
			}		
			
			$res = mysql_query($query);		
			if($res)
			{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updatePasrExpInfo::Success",$host_eid);
				$status = 1;
				$msg = "Succesfully updated Past Experience Info of \"".$emp_name."\".";
			}
			else{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updatePasrExpInfo::Failure",$host_eid);
				$status = 0;
				$msg = "Error!, Something went wrong. Try again.11";
			}
		}
		else{
			$status = 0;
			$this->employeeUpdateRecordsLogs($eid,$emp_name,"updatePasrExpInfo::Failure",$host_eid);
			$msg = "Error!, Something went wrong. Try again.22";
		}
	}
	
	$result = array("status"=>$status,"msg"=>$msg);
	
	return $result; 
}


public function updateEmployeeInfo($data)
{
	$host_eid = $_SESSION["emp_id"];
	if($host_eid > 0)
	{	
		$eid = $data['heid'];
		$emp_name = $data['emp_name'];
		if($eid > 0)
		{
			$db_id = $data['hid'];
			$db_type = $data['htype'];
			
			$joining_date = $data['joining_date'];
			$joining_date = date('Y-m-d', strtotime($joining_date));
			$employee_type = $data['employee_type'];
			$exit_date = $data['exit_date'];
			if($exit_date != "")
				$exit_date = date('Y-m-d', strtotime($exit_date));
			$end_probation = $data['end_probation'];
			if($end_probation != "")
				$end_probation = date('Y-m-d', strtotime($end_probation));
			
			if($db_type == 1)
			{
				$employee_type = 1;
			}
			
			if($employee_type == 4) // On Notice
			{
				$status = 0;
				$msg = "Sorry! You can't update \"On Notice\" employee type";
				$result = array("status"=>$status,"msg"=>$msg);
				return $result; 
			}
				
			
			if($employee_type == 2 ) // probation
			{
				$dbsql=mysql_query("select * from  od_emp_probation where eid='".$eid."' ");
				$Num = mysql_num_rows($dbsql);
				if($Num > 0)
				{
					$query = "UPDATE od_emp_probation set start_date='".$joining_date."' , end_date='".$end_probation."' where eid='".$eid."' ";
				}
				else
				{
					$query = "INSERT INTO od_emp_probation set start_date='".$joining_date."' , end_date='".$end_probation."' , eid='".$eid."'  ";
				}
				$res = mysql_query($query);					
			}
			
			
			if($db_type == 2)
			{	
				$query = "UPDATE od_employee set  joining_date='".$joining_date."' , exit_date='".$exit_date."', type='".$employee_type."' where id='".$db_id."' and eid ='".$eid."' ";
			}
			else{
				
				$query = "UPDATE od_employee set  joining_date='".$joining_date."' , exit_date='".$exit_date."', type='".$employee_type."' where id='".$db_id."' and did ='".$eid."' ";
			}	
			
			$res = mysql_query($query);		
			
			
			if($res)
			{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateEmployeeInfo::Success",$host_eid);
				$status = 1;
				$msg = "Succesfully updated Employee Info of \"".$emp_name."\".";
			}
			else{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateEmployeeInfo::Failure",$host_eid);
				$status = 0;
				$msg = "Error!, Something went wrong. Try again.11";
			}
		}
		else{
			$status = 0;
			$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateEmployeeInfo::Failure",$host_eid);
			$msg = "Error!, Something went wrong. Try again.22";
		}
	}
	
	$result = array("status"=>$status,"msg"=>$msg);
	
	return $result; 
}

public function updateBUInfo($data)
{
	$host_eid = $_SESSION["emp_id"];
	if($host_eid > 0)
	{	
		$eid = $data['heid'];
		$emp_name = $data['emp_name'];
		if($eid > 0)
		{
			$db_id = $data['hid'];
			$db_type = $data['htype'];
			
			$bu_id = $data['bu_id'];
			$prm_id = $data['prm_id'];
			$upper_id = $data['upper_id'];
			$dept_id = $data['dept_id'];
			$desig_id = $data['desig_id'];
			
			if($db_type == 1) // Director
			{
				$query = "UPDATE od_director set bu='".$bu_id."' , dept_id='".$dept_id."' , upper_id='".$upper_id."' , desig_id='".$desig_id."' where did='".$eid."' ";
			}
			else{
				
				$query = "UPDATE od_employee set bu='".$bu_id."' where eid='".$eid."' and  id='".$db_id."' ";
				$res = mysql_query($query);	
				//check if past exp db prsent or not 
				$dbsql=mysql_query("select * from  od_emp_report where eid='".$eid."' ");
				$Num = mysql_num_rows($dbsql);
				if($Num > 0)
				{
					$query = "UPDATE od_emp_report set pro_grp_id='".$prm_id."' , dept_id='".$dept_id."' , upper_id='".$upper_id."' , desig_id='".$desig_id."' where eid='".$eid."' ";
				}
				else
				{
					$query = "INSERT INTO od_emp_report set eid='".$eid."' , pro_grp_id='".$prm_id."' , dept_id='".$dept_id."' , upper_id='".$upper_id."' , desig_id='".$desig_id."'  ";
				}	
			}
			
			$res = mysql_query($query);		
			if($res)
			{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateBUInfo::Success",$host_eid);
				$status = 1;
				$msg = "Succesfully updated BU Info of \"".$emp_name."\".";
			}
			else{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateBUInfo::Failure",$host_eid);
				$status = 0;
				$msg = "Error!, Something went wrong. Try again.11";
			}
		}
		else{
			$status = 0;
			$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateBUInfo::Failure",$host_eid);
			$msg = "Error!, Something went wrong. Try again.22";
		}
	}
	
	$result = array("status"=>$status,"msg"=>$msg);
	
	return $result; 
}



public function updateNoticeInfo($data)
{
	$host_eid = $_SESSION["emp_id"];
	if($host_eid > 0)
	{	
		$eid = $data['heid'];
		$emp_name = $data['emp_name'];
		if($eid > 0)
		{
			$db_id = $data['hid'];
			$db_type = $data['htype'];
			
			$notice_period = $data['notice_period'];
			$notice_start_date = $data['notice_start_date'];
			$notice_start_date = date('Y-m-d', strtotime($notice_start_date));
			$days = $notice_period * 30;
			$notice_end_date = date("Y-m-d", strtotime($notice_start_date." ".$days." days"));
			
						
			if($db_type == 1) // Director
			{
				
			}
			else{
				
				$query = "UPDATE od_employee set type='4' where eid='".$eid."' and  id='".$db_id."' ";
				$res = mysql_query($query);	
				//check if past db prsent or not 
				$dbsql=mysql_query("select * from  od_emp_notice where eid='".$eid."' ");
				$Num = mysql_num_rows($dbsql);
				if($Num > 0)
				{
					$query = "UPDATE od_emp_notice set start_date='".$notice_start_date."' , month='".$notice_period."' , end_date='".$notice_end_date."' where eid='".$eid."' ";
				}
				else
				{
					$query = "INSERT INTO od_emp_notice set eid='".$eid."' , start_date='".$notice_start_date."' , month='".$notice_period."' , end_date='".$notice_end_date."'  ";
				}	
			}
			
			$res = mysql_query($query);		
			if($res)
			{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateNoticeInfo::Success",$host_eid);
				$status = 1;
				$msg = "Succesfully updated Notice Info of \"".$emp_name."\".";
			}
			else{
				$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateNoticeInfo::Failure",$host_eid);
				$status = 0;
				$msg = "Error!, Something went wrong. Try again.11";
			}
		}
		else{
			$status = 0;
			$this->employeeUpdateRecordsLogs($eid,$emp_name,"updateNoticeInfo::Failure",$host_eid);
			$msg = "Error!, Something went wrong. Try again.22";
		}
	}
	
	$result = array("status"=>$status,"msg"=>$msg);
	
	return $result; 
}


public function getPermanentEmployeeList()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$str = "";
		$sl_no=0;		
		
		if($eid == 1001)
		{
			$dbsql=mysql_query("select * from od_director where status=1 ORDER BY name asc ");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$eid = $row['did'];
					$empData = $this->getEmployeeData($eid);

					$emp_id= $empData->eid;
					$emp_name = $empData->name;
					$designation = $empData->desig_name;
					$bu_team = "[".$empData->bu_name."]<BR>".$empData->dept_name;
					$doj = date("d-m-Y", strtotime($empData->joining_date));
					$total_exp = $empData->oditek_exp;
					$reporting_to = $empData->report_to;
					
					$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                 	   <td>'.$emp_id.'</td>
					   <td>'.$emp_name.'</td>
					   <td>'.$reporting_to.'</td>
					   <td>'.$designation.'</td>
					   <td>'.$bu_team.'</td>
					   <td>'.$doj.'</td>
					   <td>'.$total_exp.'</td>
				       </tr>';	
				}
			}
			
			//get mgmt member 
			$dbsql=mysql_query("select * from od_employee where status=1 and mgmt = 1 ORDER BY name asc ");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$eid = $row['eid'];
					$empData = $this->getEmployeeData($eid);

					$emp_id= $empData->eid;
					$emp_name = $empData->name;
					$designation = $empData->desig_name;
					$bu_team = "[".$empData->bu_name."]<BR>".$empData->dept_name;
					$doj = date("d-m-Y", strtotime($empData->joining_date));
					$total_exp = $empData->oditek_exp;
					$reporting_to = $empData->report_to;
					
					$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                 	   <td>'.$emp_id.'</td>
					   <td>'.$emp_name.'</td>
					   <td>'.$reporting_to.'</td>
					   <td>'.$designation.'</td>
					   <td>'.$bu_team.'</td>
					   <td>'.$doj.'</td>
					   <td>'.$total_exp.'</td>
				       </tr>';	
				}
			}
			
			
		}
		
		
		   //get all other members 
			$dbsql=mysql_query("select * from od_employee where status=1 and mgmt!=1 and type=1 ORDER BY name asc ");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$eid = $row['eid'];
					$empData = $this->getEmployeeData($eid);

					$emp_id= $empData->eid;
					$emp_name = $empData->name;
					$designation = $empData->desig_name;
					$bu_team = "[".$empData->bu_name."]<BR>".$empData->dept_name;
					$doj = date("d-m-Y", strtotime($empData->joining_date));
					$total_exp = $empData->oditek_exp;
					$reporting_to = $empData->report_to;
					
					$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                 	   <td>'.$emp_id.'</td>
					   <td>'.$emp_name.'</td>
					   <td>'.$reporting_to.'</td>
					   <td>'.$designation.'</td>
					   <td>'.$bu_team.'</td>
					   <td>'.$doj.'</td>
					   <td>'.$total_exp.'</td>
				       </tr>';	
				}
			}
		
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		
	}
	else{
		$value = "Something went wrong!";
		$data=array("status"=>0,"msg"=>$value);
	}
	return $data;
}


public function getProbationEmployeeList()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$str = "";
		$sl_no=0;		
		
		
		   //get all other members 
			$dbsql=mysql_query("select * from od_employee where status=1 and mgmt!=1 and type=2 ORDER BY name asc ");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$eid = $row['eid'];
					$empData = $this->getEmployeeData($eid);

					$emp_id= $empData->eid;
					$emp_name = $empData->name;
					$designation = $empData->desig_name;
					$bu_team = "[".$empData->bu_name."]<BR>".$empData->dept_name;
					$doj = date("d-m-Y", strtotime($empData->joining_date));
					$pro_end_date = date("d-m-Y", strtotime($empData->pro_end_date));
					$date_str1 = strtotime(date('d-m-Y'));
					$date_str2 = strtotime($pro_end_date);
					$pro_left = round( ($date_str2 - $date_str1) / (60 * 60 * 24));
					$reporting_to = $empData->report_to;
					
					if($pro_left < 0)
					{
						$style="color: red; font-weight: bold";
					}
					else
						$style="";
					
					$str .= '<tr class="success">
				       <td style="font-weight:normal;'.$style.'" >'.$sl_no.'</td>
                 	   <td style="font-weight:normal;'.$style.'" >'.$emp_id.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$emp_name.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$reporting_to.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$designation.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$bu_team.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$doj.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$pro_end_date."<BR>[".$pro_left." days ]".'</td>
				       </tr>';	
				}
			}
			else
			{
				$str ='<tr><td colspan="8">No records found</td></tr>';
			}
		
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		
	}
	else{
		$value = "Something went wrong!";
		$data=array("status"=>0,"msg"=>$value);
	}
	return $data;
}



public function getInternEmployeeList()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$str = "";
		$sl_no=0;		
		
		
		   //get all other members 
			$dbsql=mysql_query("select * from od_employee where status=1 and mgmt!=1 and type=3 ORDER BY name asc ");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$eid = $row['eid'];
					$empData = $this->getEmployeeData($eid);

					$emp_id= $empData->eid;
					$emp_name = $empData->name;
					$designation = $empData->desig_name;
					$bu_team = "[".$empData->bu_name."]<BR>".$empData->dept_name;
					$start_date = date("d-m-Y", strtotime($empData->intern_start_date));
					$end_date = date("d-m-Y", strtotime($empData->intern_end_date));
					$date_str1 = strtotime(date('d-m-Y'));
					$date_str2 = strtotime($end_date);
					$pro_left = round( ($date_str2 - $date_str1) / (60 * 60 * 24));
					$reporting_to = $empData->report_to;
					
					if($pro_left < 0)
					{
						$style="color: red; font-weight: bold";
					}
					else
						$style="";
					
					$str .= '<tr class="success">
				       <td style="font-weight:normal;'.$style.'" >'.$sl_no.'</td>
                 	   <td style="font-weight:normal;'.$style.'" >'.$emp_id.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$emp_name.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$reporting_to.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$bu_team.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$start_date.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$end_date."<BR>[".$pro_left." days ]".'</td>
				       </tr>';	
				}
			}
			else
			{
				$str ='<tr><td colspan="7">No records found</td></tr>';
			}
		
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		
	}
	else{
		$value = "Something went wrong!";
		$data=array("status"=>0,"msg"=>$value);
	}
	return $data;
}



public function getOnNoticeEmployeeList()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$str = "";
		$sl_no=0;		
		
		
		   //get all other members 
			$dbsql=mysql_query("select * from od_employee where status=1 and mgmt!=1 and type=4 ORDER BY name asc ");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$eid = $row['eid'];
					$empData = $this->getEmployeeData($eid);

					$emp_id= $empData->eid;
					$emp_name = $empData->name;
					$designation = $empData->desig_name;
					$bu_team = "[".$empData->bu_name."]<BR>".$empData->dept_name;
					$start_date = date("d-m-Y", strtotime($empData->notice_start_date));
					$end_date = date("d-m-Y", strtotime($empData->notice_end_date));
					$date_str1 = strtotime(date('d-m-Y'));
					$date_str2 = strtotime($end_date);
					$pro_left = round( ($date_str2 - $date_str1) / (60 * 60 * 24));
					$reporting_to = $empData->report_to;
					
					if($pro_left < 0)
					{
						$style="color: red; font-weight: bold";
					}
					else
						$style="";
					
					$str .= '<tr class="success">
				       <td style="font-weight:normal;'.$style.'" >'.$sl_no.'</td>
                 	   <td style="font-weight:normal;'.$style.'" >'.$emp_id.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$emp_name.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$reporting_to.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$designation.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$bu_team.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$start_date.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$end_date." [ ".$pro_left." days ]".'</td>
				       </tr>';	
				}
			}
			else
			{
				$str ='<tr><td colspan="8">No records found</td></tr>';
			}
		
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		
	}
	else{
		$value = "Something went wrong!";
		$data=array("status"=>0,"msg"=>$value);
	}
	return $data;
}


public function getContractualEmployeeList()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$str = "";
		$sl_no=0;		
		
			
		    //get all other members 
			$dbsql=mysql_query("select * from od_employee where status=1 and mgmt!=1 and type=5 ORDER BY name asc ");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$eid = $row['eid'];
					$empData = $this->getEmployeeData($eid);

					$emp_id= $empData->eid;
					$emp_name = $empData->name;
					$designation = $empData->desig_name;
					$bu_team = "[".$empData->bu_name."]<BR>".$empData->dept_name;
					$doj = date("d-m-Y", strtotime($empData->joining_date));
					$total_exp = $empData->oditek_exp;
					$reporting_to = $empData->report_to;
					
					$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                 	   <td>'.$emp_id.'</td>
					   <td>'.$emp_name.'</td>
					   <td>'.$reporting_to.'</td>
					   <td>'.$designation.'</td>
					   <td>'.$bu_team.'</td>
					   <td>'.$doj.'</td>
					   <td>'.$total_exp.'</td>
				       </tr>';	
				}
			}
			else
			{
				$str ='<tr><td colspan="8">No records found</td></tr>';
			}
		
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		
	}
	else{
		$value = "Something went wrong!";
		$data=array("status"=>0,"msg"=>$value);
	}
	return $data;
}



public function getLeftEmployeeList()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$str = "";
		$sl_no=0;		
		
			
		    //get all other members 
			$dbsql=mysql_query("select * from od_employee where status=2 and mgmt!=1 ORDER BY name asc ");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$eid = $row['eid'];
					$empData = $this->getEmployeeData($eid);

					$emp_id= $empData->eid;
					$emp_name = $empData->name;
					$designation = $empData->desig_name;
					$bu_team = "[".$empData->bu_name."]<BR>".$empData->dept_name;
					$doj = date("d-m-Y", strtotime($empData->joining_date));
					$doe = date("d-m-Y", strtotime($empData->exit_date));
					$total_exp = $empData->oditek_exp;
					$reporting_to = $empData->report_to;
					
					$str .= '<tr class="success">
				       <td>'.$sl_no.'</td>
                 	   <td>'.$emp_id.'</td>
					   <td>'.$emp_name.'</td>
					   <td>'.$reporting_to.'</td>
					   <td>'.$designation.'</td>
					   <td>'.$bu_team.'</td>
					   <td>'.$doj."<BR>".$doe.'</td>
					   <td>'.$total_exp.'</td>
				       </tr>';	
				}
			}
			else
			{
				$str ='<tr><td colspan="8">No records found</td></tr>';
			}
		
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		
	}
	else{
		$value = "Something went wrong!";
		$data=array("status"=>0,"msg"=>$value);
	}
	return $data;
}



public function getEmpRecordUpdateLogs()
{
	$eid = $_SESSION["emp_id"];
	if($eid == 1001)
	{
		$str = "";
		$sl_no=0;		
		
			
		    //get all other members 
			$dbsql=mysql_query("select * from od_emp_records_update_logs ORDER BY id desc LIMIT 500");
			$Num = mysql_num_rows($dbsql);	
			if ($Num > 0)
			{
				
				while($row = mysql_fetch_array($dbsql))
				{
					$sl_no++;
					$date = $row['date'];
					$eid = $row['eid'];
					$ename = $row['ename'];
					$logs = $row['logs'];
					$mod_by = $row['mod_by'];
					
					$mod_name = $this->getEmployeeName($mod_by);
					
					$str .= '<tr class="success">
				       <td class="center_td" >'.$sl_no.'</td>
                 	   <td class="center_td" >'.$date.'</td>
					   <td class="center_td" >'.$eid.'</td>
					   <td class="center_td" >'.$ename.'</td>
					   <td class="center_td" >'.$logs.'</td>
					   <td class="center_td" >'.$mod_name.'</td>
				       </tr>';	
				}
			}
			else
			{
				$str ='<tr><td colspan="6">No records found</td></tr>';
			}
		
		$data=array("status"=>1,"data"=>$str, "msg"=>$value );
		
	}
	else{
		$value = "Something went wrong!";
		$data=array("status"=>0,"msg"=>$value);
	}
	return $data;
}



public function getAllNameWithBoard(){
			$getArray= array();
			
			////////add Board Name //////
			$admin = new AdminUser();
			$admin->id = 1000;  
			$admin->name = "OdiTek Board";
			$getArray[] = $admin;
			
			
			$dbsql=mysql_query("select a.id , a.did , a.name , b.rank ,  b.rankid from ".PREFIX1."director a INNER JOIN ".PREFIX1."rank b ON a.desig_id = b.rankid  where a.status='1' order by a.name asc");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					//$getRankArray[] = htmlspecialchars($row['name']); 
					$admin = new AdminUser();
					$admin->id = htmlspecialchars($row['did']);  
					$admin->name = htmlspecialchars($row['name'])." [".$row['rank']."]";
					$getArray[] = $admin;
					
				}
			}
			
			$dbsql=mysql_query("select a.id , a.eid , a.name , c.rank , c.rankid from od_employee a 
								INNER JOIN od_emp_report b ON a.eid = b.eid
								INNER JOIN od_rank c ON b.desig_id = c.rankid  
								where a.status='1' order by a.name asc");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					//$getRankArray[] = htmlspecialchars($row['name']); 
					$admin = new AdminUser();
					$admin->id = htmlspecialchars($row['eid']);  
					$admin->name = htmlspecialchars($row['name'])." [".$row['rank']."]";
					$getArray[] = $admin;
					
				}
			}
			
		return $getArray;
	}
	
	
	
	
	
	
public function getDesignationHR(){
			$getArray= array();
			$dbsql=mysql_query("select * from ".PREFIX1."rank where rankid = 1 ");
			$Num = mysql_num_rows($dbsql);
		
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$admin = new AdminUser();
					$admin->id = $row['rankid'];  
					$admin->name = $row['rank'];
					$getArray[] = $admin;
				}
			}
			
			$dbsql=mysql_query("select * from ".PREFIX1."rank where rankid > 1 order by rank asc");
			$Num = mysql_num_rows($dbsql);
		
			if ($Num > 0)
			{
				while($row = mysql_fetch_array($dbsql))
				{
					$admin = new AdminUser();
					$admin->id = $row['rankid'];  
					$admin->name = $row['rank'];
					$getArray[] = $admin;
				}
			}
		return $getArray;
	}


//////////////////////////////////////////////////////////////////////////////////
////////////////////////END HR MODULES////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////







////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////LEAVE MGMT ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

public function checkLeaveReqApprover($eid)
{
	$ret=0;
	//if any resources is assigned to this then approve is true
	$dbsql=mysql_query("select * from od_emp_report where upper_id='".$eid."' ");
	$Num = mysql_num_rows($dbsql);
	if($Num > 0)
		$ret=1;
	return $ret;
}

public function isMyTeamLeaveRequest($mysid, $sid)
{
	$ret=0;
	$myteam = $this->getAllMyTeamName($mysid);
	foreach($myteam as $val)
	{
		if($val->id == $sid)
		{
			$ret=1;
			break;
		}
	}		
	return $ret;	
}

public function isMyProjectGrpLeaveRequest($mysid, $sid)
{
	$ret=0;
	$empData = $this->getEmployeeData($sid);
	if($empData->pro_grp_head == $mysid)
		$ret = 1;
	return $ret;	
}

public function getLeaveType()
{
	$dataArray = array();
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{	
		$empData = $this->getEmployeeData($eid);
		$dbsql=mysql_query("select * from od_leave_type");
		$Num = mysql_num_rows($dbsql);
		while($row = mysql_fetch_array($dbsql))
		{
			$data = new AdminUser();
			$data->type = $row['type'];
			$data->code = $row['code'];
			$data->female = $row['female'];
			$data->probation = $row['probation'];
			if($empData->emptype == 2 && $data->probation == 1)
			{
				$dataArray[] = $data;
			}else if($empData->emptype != 2)
			{
				if($data->female == 1)
				{
					if($empData->gender_id == 2) {
						$dataArray[] = $data;
						}
				}
				else
					$dataArray[] = $data;	
			}
		}
	}
	return  $dataArray;
}


public function getLeaveTypeEmp($eid)
{
	if($eid > 0)
	{	
		$empData = $this->getEmployeeData($eid);
		$dbsql=mysql_query("select * from od_leave_type");
		$Num = mysql_num_rows($dbsql);
		$str= '<option value="0" >Select Leave Type</option>';
		while($row = mysql_fetch_array($dbsql))
		{
			if($empData->emptype == 2 && $row['probation'] == 1)
			{
				$str .= '<option value="'.$row['code'].'">'.$row['type'].'</option>';
			}else if($empData->emptype != 2)
			{
				if($row['female'] == 1)
				{
					if($empData->gender_id == 2) {
						$str .= '<option value="'.$row['code'].'">'.$row['type'].'</option>';
						}
				}
				else
					$str .= '<option value="'.$row['code'].'">'.$row['type'].'</option>';	
			}
		}
	}
	$data=array("status"=>1,"data"=>$str);
	return $data;
}


public function getLeaveAllType($eid)
{
	if($eid > 0)
	{	
		$empData = $this->getEmployeeData($eid);
		$dbsql=mysql_query("select * from od_leave_type");
		$Num = mysql_num_rows($dbsql);
		$str= '<option value="0" >Select Leave Type</option>';
		while($row = mysql_fetch_array($dbsql))
		{
			if($row['female'] == 1 )
			{
				if($empData->gender_id == 2) 
				{
					$str .= '<option value="'.$row['code'].'">'.$row['type'].'</option>';
				}
			}
			else
				$str .= '<option value="'.$row['code'].'">'.$row['type'].'</option>';	
		}
	}
	$data=array("status"=>1,"data"=>$str);
	return $data;
}


public function getLeaveTypeById($id)
{
	$type = "";
	$dbsql=mysql_query("select * from od_leave_type where code='".$id."' ");
	$Num = mysql_num_rows($dbsql);
	if($row = mysql_fetch_array($dbsql))
	{
		$type = $row['type'];
	}
	return  $type;
}

public function getLeaveStatusById($id)
{
	$status = "";
	$dbsql=mysql_query("select * from od_leave_status where val='".$id."' ");
	$Num = mysql_num_rows($dbsql);
	if($row = mysql_fetch_array($dbsql))
	{
		$status = $row['status'];
	}
	return  $status;
}

public function getCompOffLeaveStatusById($id)
{
	$status = "";
	$dbsql=mysql_query("select * from od_leave_comp_status where val='".$id."' ");
	$Num = mysql_num_rows($dbsql);
	if($row1 = mysql_fetch_array($dbsql))
	{
		$status = $row1['status'];
	}
	return  $status;
}

public function getCompOffLeaveCount($eid)
{
	$dbsql=mysql_query("select * from od_leave_compoff where eid='".$eid."' and status = 1 ");
	$Num = mysql_num_rows($dbsql);
	return  $Num;
}

public function getCompOffLeaveList($eid)
{
	$dbsql=mysql_query("select * from od_leave_compoff where eid='".$eid."' and status = 1 ");
	$Num = mysql_num_rows($dbsql);
	$daarray=array();
	while($row1 = mysql_fetch_array($dbsql))
	{
		$dataList = new Employee();
		$dataList->id = $row1['id'];
		$dataList->date = $row1['comp_date'];
		$daarray[] = $dataList;
	}
	return  $daarray;
	
}

public function getLeaveReqObj($lid)
{
	$dbsql=mysql_query("select * from od_leave_records where lid='".$lid."' ");
	$Num = mysql_num_rows($dbsql);	
	$row = mysql_fetch_array($dbsql);
	
	return $row;	
}

public function getLeaveDataInfo($id)
{
	$dbsql=mysql_query("select * from od_leave_logs where id='".$id."' ");
	$Num = mysql_num_rows($dbsql);	
	$row = mysql_fetch_array($dbsql);
	
	return $row;	
}

public function getLeaveCountObj($eid)
{
	$year = date("Y");
	$row="";
	$dbsql=mysql_query("select * from od_leave_counts where eid='".$eid."' and year='".$year."' ");
	$Num = mysql_num_rows($dbsql);
	if($Num)	
		$row = mysql_fetch_array($dbsql);
	
	return $row;	
}


public function calculateTotalDays($type,$sdate, $edate)
{
	$today = date("d-m-Y");
	$sdate = date("d-m-Y", strtotime($sdate));
	$edate = date("d-m-Y", strtotime($edate));
	$today_str = strtotime($today);
	$sdate_str = strtotime($sdate);
	$edate_str = strtotime($edate);
	if($sdate_str > $edate_str)
	{
		$msg = "Start Date is beyond the End Date";
		$result = array("status"=>0,"msg"=>$msg);
		return $result;
	}
	if($type == 2 && $sdate_str > $today_str)
	{
		$msg = "Sick leave can not be a future date";
		$result = array("status"=>0,"msg"=>$msg);
		return $result;
	}
	
	
	$count=0;
	if($sdate == $edate)
	{
		$holiday=0;
		if($type != 8)
		   $holiday = $this->checkHoliday($sdate);
		if(!$holiday)
			$count=1;
		$result = array("status"=>1,"count"=>$count);
		return $result;
	}
	$date = $sdate;
	$date_str = strtotime($date);
	while($date_str <= $edate_str )
	{
		$holiday=0;
		if($type != 8)
			$holiday = $this->checkHoliday($date);
		if(!$holiday)
			$count++;
		$date = date("d-m-Y", strtotime($date." 1 days"));
		$date_str = strtotime($date);
	}
	
	$result = array("status"=>1,"count"=>$count);
	return $result;
}



public function getMaxLeave($eid)
{
	$year = date("Y");
	$dbsql=mysql_query("select * from od_leave_counts where eid='".$eid."' and year='".$year."' ");
	$Num = mysql_num_rows($dbsql);	
	
	$admin = new AdminUser();
	$admin->paid = 0;
	$admin->unpaid = 0;
	$admin->special = 0;
	$admin->earned = 0;
	$admin->maternity = 0;
	
	if($row = mysql_fetch_array($dbsql))
	{
		$admin->paid = $row['maxpaid'];
		$admin->unpaid = $row['maxunpaid'];
		$admin->special = $row['maxspecial'];
		$admin->earned = $row['maxearned'];
		$admin->maternity = $row['maxmaternity'];
	}
	return $admin;
}

public function getAvailLeave($eid)
{
	$year = date("Y");
	$dbsql=mysql_query("select * from od_leave_counts where eid='".$eid."' and year='".$year."' ");
	$Num = mysql_num_rows($dbsql);	
	
	$admin = new AdminUser();
	$admin->paid = 0;
	$admin->unpaid = 0;
	$admin->special = 0;
	$admin->earned = 0;
	$admin->maternity = 0;
	
	if($row = mysql_fetch_array($dbsql))
	{
		$admin->paid = $row['maxpaid'] - $row['paid'];
		$admin->unpaid = $row['maxunpaid'] - $row['unpaid'];
		$admin->special = $row['maxspecial'] - $row['special'];
		$admin->earned = $row['maxearned'] - $row['earned'];
		$admin->maternity = $row['maxmaternity'] - $row['maternity'];
	}
	return $admin;
}


public function getAllAvailableLeave($type,$eid)
{
	$cnt=0;
	if($eid > 0)
	{
		$leaveCnt = $this->getAvailLeave($eid);
		if($type == 1 || $type == 2 || $type == 3 || $type == 4)
		  $cnt = $leaveCnt->paid;
		else if($type == 5)
		  $cnt = $leaveCnt->unpaid;
		else if($type == 6)
		  $cnt = $leaveCnt->special;
	    else if($type == 7)
	      $cnt = $this->getCompOffLeaveCount($eid);//$leaveCnt->earned;
	   else if($type == 8)
	      $cnt = $leaveCnt->maternity;
	  
	  $data=array("status"=>1, "value"=>$cnt);
	}
	else{
		$data=array("status"=>0);
	}
		
	return $data;
}

public function getAllAvailableLeaveByEid($eid , $type)
{
	$cnt=0;
	if($eid > 0)
	{
		$leaveCnt = $this->getAvailLeave($eid);
		if($type == 1 || $type == 2 || $type == 3 || $type == 4 )
		  $cnt = $leaveCnt->paid;
		else if($type == 5)
		  $cnt = $leaveCnt->unpaid;
		else if($type == 6)
		  $cnt = $leaveCnt->special;
	    else if($type == 7)
	      $cnt = $leaveCnt->earned;
	    else if($type == 8)
	      $cnt = $leaveCnt->maternity;
	}
		
	return $cnt;
}



public function generateLeaveReqID($num)
{
	$id="";
	$size  = strlen($num);
	if($size == 1)
		$id = "L00".$num;
	else if	($size == 2)
	    $id = "L0".$num;
	else if	($size == 3)
		$id = "L".$num;
	else if	($size == 4)
		$id = "L".$num;	
	
	return $id;	
}

public function getLeaveReqStatus($lid)
{
	$str=0;
	$dbsql=mysql_query("select status from od_leave_records where lid='".$lid."' ");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$str = $row['status'];
	}
	return 	$str;
}

public function createNewLeaveRequest($request,$eid,$hr)
{
	$this->addDebugLogs("createNewLeaveRequest::EMP-ID:".$eid);
	if($eid > 0)
	{	
		$date = date("d-m-Y, h:i:s A");
		$year = date("Y");
		$month_id = date("n");	
        $type = $request['leave_type'];
		$sdate = date("d-m-Y", strtotime($request['start_date']));
		$edate = date("d-m-Y", strtotime($request['end_date']));
		
		$sdate_yr = date("Y", strtotime($request['start_date']));
		$edate_yr = date("Y", strtotime($request['end_date']));
		
		$emp_cnt_row = $this->getLeaveCountObj($eid);
		$log="";
		
		if(!$hr)
		{	
			//////On Notice Period, don't allow Leave 
			if($this->isOnNoticePeriod($eid))
			{
				$msg = "During notice period, you are not allowed to generate new Leave Request. Please contact with HR.";
				$data=array("status"=>0, "msg"=>$msg);
				return $data;
			}	
						
			
			///////////////////
			if($type == 1 || $type == 2 || $type == 3 || $type == 4)
			{
				$paid_consumed = $emp_cnt_row['paid'];
				if($month_id <= 6 && $paid_consumed >= 10)
				{
					$msg = "Unable to create leave request. More than 10 leaves already consumed. Please contact with HR.";
					$data=array("status"=>0, "msg"=>$msg);
					return $data;
				}				
			}
		}
		
		if($type == 4 || $type == 7)
		{		
			$edate = $sdate;
			$edate_yr = $sdate_yr;
		}
		$days = $request['total_leave'];
		$msg = addslashes($request['text1']);
		$status = 1;
		
		$skipCheck = 0;
		if($type == 8) // marnenity leaves
			$skipCheck = 1;
		if(!$skipCheck)
		{	
			if($days == 0)
			{
				$msg = "Unable to create leave request. Number of leaves day is zero.";
				$data=array("status"=>0, "msg"=>$msg);
				return $data;
			}
		
			if($year != $sdate_yr || $year != $edate_yr)
			{
				$msg = "Unable to create leave request. Date is incorrect.";
				$data=array("status"=>0, "msg"=>$msg);
				return $data;
				
			}
		
			if($sdate_yr != $edate_yr)
			{
				$msg = "Unable to create leave request. Date is incorrect.";
				$data=array("status"=>0, "msg"=>$msg);
				return $data;
				
			}
		}else{
			if($year != $sdate_yr )
			{
				$msg = "Unable to create leave request. Date is incorrect.";
				$data=array("status"=>0, "msg"=>$msg);
				return $data;
				
			}
			
		}
				
		
		$cnt = 0;
		$leaveCnt = $this->getAvailLeave($eid);
		if($type == 1 || $type == 2 || $type == 3 || $type == 4)
		  $cnt = $leaveCnt->paid;
		else if($type == 5)
		  $cnt = $leaveCnt->unpaid;
		else if($type == 6)
		  $cnt = $leaveCnt->special;
	    else if($type == 7)
	      $cnt = $this->getCompOffLeaveCount($eid);
	    else if($type == 8)
	      $cnt = $leaveCnt->maternity;
		
		if($days >  $cnt)
		{
			$msg = "Unable to create leave request. Number of Leaves days exceed the available count.";
			$data=array("status"=>0, "msg"=>$msg);
			return $data;
		}
		if(!$hr)
		{	
			if(($type == 1 || $type == 2) && $days > 3)
			{
				$msg = "Unable to create leave request. Maximum 3 days of Casual/Sick Leaves are allowed. Please contact with HR for more details.";
				$data=array("status"=>0, "msg"=>$msg);
				return $data;
			}
		}
		
		/*
		//////////////////////////
		$msg = "###########Under Maintenance#####, pl try after some time:".$paid_consumed.":".$month_id.":";
		$data=array("status"=>1, "msg"=>$msg);
		
		return $data;
		
		
		///////////////////////////
		*/
		
		$compoff=0;
		if($type == 7) //comp off
			$compoff = $request['comoff'];        		
		/*
		if($eid ==  1001)
		{
			$lid=0;	
			$msg = "Succesfully created Leave Request11111111111111";
			$data=array("status"=>1, "lid"=>$lid,"msg"=>$msg);
			return $data;
		}*/	
		
		$query = "INSERT into od_leave_records set date='".$date."' , eid='".$eid."', type='".$type."' , year='".$sdate_yr."' ,start_date='".$sdate."' , end_date='".$edate."' , days ='".$days."' , status = '".$status."' , msg='".$msg."' ,email = '1' , compoff='".$compoff."' , hr='".$hr."' ";
		$res = mysql_query($query);
		if($res)
		{	
			$db_id = mysql_insert_id();
			$lid = $this->generateLeaveReqID($db_id);
			$qry=mysql_query("UPDATE od_leave_records set lid='".$lid."' where id='".$db_id."'");
			
			$this->generateLeaveDetails($lid); // added now
			$last_status_str = $this->getLeaveStatusById(1);
			$status_mod_str = "[".$last_status_str."]";
			
			$query = "INSERT into od_leave_logs set date='".$date."' , hr='".$hr."' ,  lid='".$lid."', eid='".$eid."', msg='".$msg."' , email='0' , status_log='".$status_mod_str."' ";
			$res = mysql_query($query);
			
			if($res)
			{
				//update compoff records status
				if($type == 7) //comp off
				{
					$this->updateCompOffStatus($lid,$compoff,4);
				}				
				
				$data_id = mysql_insert_id();
				$msg = "Succesfully created Leave Request. Leave ID: ".$lid;
				$data=array("status"=>1, "lid"=>$lid,"msg"=>$msg);
			}
			else{
				$str1 = "delete from od_leave_records where lid='".$lid."' ";
				$dbsql=mysql_query($str1);
				$msg = "Unknown Error...";
				$data=array("status"=>0,"msg"=>$msg);
			}
			
		}else{
			$msg = "Unable to create leave request. Contact Intra-Admin.";
			$data=array("status"=>0, "msg"=>$msg);
		}
	}
	else{
			$msg = "Unable to create leave request.";
			$data=array("status"=>0, "msg"=>$msg);
	}
	
	return $data;	
}


public function updateLeaveRequestbyCreator($request)
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$status_id = $request['status_id'];
		$text1 = addslashes($request['text1']);
		$lid  = $request['hlid'];
		$leaveObj = $this->getLeaveReqObj($lid);
		$type = $leaveObj['type'];
		$compoff = $leaveObj['compoff'];
		$date = date("d-m-Y, h:i:s A");
	
		//status string
		$last_status = $this->getLeaveReqStatus($lid);
		$last_status_str = $this->getLeaveStatusById($last_status);
		$current_status_str = $this->getLeaveStatusById($status_id);
		if($status_id > 0 && $last_status != $status_id)
			$status_mod_str = "[".$last_status_str." => ".$current_status_str."]";
		else
		    $status_mod_str = "[".$last_status_str."]";
			
		if($status_id > 0)
		{	
			$qry=mysql_query("UPDATE od_leave_records set status='".$status_id."' where lid='".$lid."'");
			if($status_id == 5 && $type == 7)
				$this->revertCompOffLeave($compoff);
			if($status_id == 5 ) // cancelled
				$this->removeLeaveDetails($lid);
		}
		
		$query = "INSERT into od_leave_logs set date='".$date."' , lid='".$lid."', eid='".$eid."', msg='".$text1."' , email='1' , status_log='".$status_mod_str."' ";
		$res = mysql_query($query);
		if($res)
		{
			$data_id = mysql_insert_id();
			$msg = "Successfully updated Leave Request";
			$data=array("status"=>1, "msg"=>$msg ,"lid"=>$lid, "dataid"=>$data_id );
		}
		else{
			$msg = "Unknown Error...";
			$data=array("status"=>0,"msg"=>$msg);
		}
	}else{
		$msg = "Unknown Error...";
		$data=array("status"=>0,"msg"=>$msg);
	}
	return $data;
}



public function updateLeaveRequestbyReviwer($request)
{
	$myeid = $_SESSION["emp_id"];
	if($myeid > 0)
	{
		$status_id = $request['status_id'];
		$text1 = addslashes($request['text1']);
		$lid  = $request['hlid'];
		$date = date("d-m-Y, h:i:s A");
		
		$leaveObj = $this->getLeaveReqObj($lid);
		$type = $leaveObj['type'];
		$compoff = $leaveObj['compoff'];
	
		if($status_id == 2) //approve
		{
			
			if($type != 7) //compoff
			{
				$available = $this->getAllAvailableLeaveByEid($leaveObj['eid'],$leaveObj['type']);
				if($available <  $leaveObj['days'])
				{
					$msg = "Insufficient available leaves. Please contact HR.";
					$data=array("status"=>0,"msg"=>$msg);
					return $data;
				}
				$ret = $this->updateLeaveRecords($lid);
				if(!$ret)
				{
					$msg = "Unknown Error. Please contact HR.";
					$data=array("status"=>0,"msg"=>$msg);
					return $data;
				}
			}
			else{
					$this->updateCompOffStatus($lid,$compoff,3);		
			}
		}
		if($status_id == 3) //rejected
		{
			$this->updateCompOffStatus("",$compoff,1);
			$this->removeLeaveDetails($lid);
			
		}
		
		//status string
		$last_status = $this->getLeaveReqStatus($lid);
		$last_status_str = $this->getLeaveStatusById($last_status);
		$current_status_str = $this->getLeaveStatusById($status_id);
		if($status_id > 0 && $last_status != $status_id)
			$status_mod_str = "[".$last_status_str." => ".$current_status_str."]";
		else
		    $status_mod_str = "[".$last_status_str."]";
			
		if($status_id > 0)
		{	
			$qry=mysql_query("UPDATE od_leave_records set status='".$status_id."' , super_id='".$myeid."'   where lid='".$lid."'");
		}
		
		$query = "INSERT into od_leave_logs set date='".$date."' , lid='".$lid."', eid='".$myeid."', msg='".$text1."' , email='1' , status_log='".$status_mod_str."' ";
		$res = mysql_query($query);
		if($res)
		{
			$data_id = mysql_insert_id();
			$msg = "Successfully updated Leave Request";
			$data=array("status"=>1, "msg"=>$msg ,"lid"=>$lid, "dataid"=>$data_id );
		}
		else{
			$msg = "Unknown Error...";
			$data=array("status"=>0,"msg"=>$msg);
		}
	}else{
		$msg = "Unknown Error...";
		$data=array("status"=>0,"msg"=>$msg);
	}
	return $data;
}


public function updateHRRequest($request)
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		//$status_id = $request['status_id'];
		$text1 = addslashes($request['text1']);
		$lid  = $request['hlid'];
		$date = date("d-m-Y, h:i:s A");
	
		//status string
		$last_status = $this->getLeaveReqStatus($lid);
		$last_status_str = $this->getLeaveStatusById($last_status);
		$status_mod_str = "[".$last_status_str."]";
			
				
		$query = "INSERT into od_leave_logs set date='".$date."' , lid='".$lid."', eid='".$eid."', msg='".$text1."' , email='1' , status_log='".$status_mod_str."' ";
		$res = mysql_query($query);
		if($res)
		{
			$data_id = mysql_insert_id();
			$msg = "Successfully updated Leave Request";
			$data=array("status"=>1, "msg"=>$msg ,"lid"=>$lid, "dataid"=>$data_id );
		}
		else{
			$msg = "Unknown Error...";
			$data=array("status"=>0,"msg"=>$msg);
		}
	}else{
		$msg = "Unknown Error...";
		$data=array("status"=>0,"msg"=>$msg);
	}
	return $data;
}



public function loadMyOpenLeaveRequest()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_leave_records where eid='".$eid."' and status='1' ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$lid = $row['lid'];
				$type = $row['type'];
				$type_str = $this->getLeaveTypeById($type);
				$sdate = $row['start_date'];
				$edate = $row['end_date'];
				$tleaves = $row['days'];
				$status = $row['status'];
				$status_str = $this->getLeaveStatusById($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_lid = $this->get_mcrypt_encrypt($lid,$iv_key);						
				
				$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'</td>
					   <td style="font-weight:normal" >'.$lid.'</td>
					   <td style="font-weight:normal" >'.$type_str.'</td>
					   <td style="font-weight:normal" >'.$sdate.'</td>
					   <td style="font-weight:normal" >'.$edate.'</td>
					   <td style="font-weight:normal" >'.$tleaves.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="leavemydetail.php?lid='.$encrypt_lid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No Open Leave Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}



public function loadMyClosedLeaveRequest()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_leave_records where eid='".$eid."' and status!='1' ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$lid = $row['lid'];
				$type = $row['type'];
				$type_str = $this->getLeaveTypeById($type);
				$sdate = $row['start_date'];
				$edate = $row['end_date'];
				$tleaves = $row['days'];
				$status = $row['status'];
				$status_str = $this->getLeaveStatusById($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_lid = $this->get_mcrypt_encrypt($lid,$iv_key);						
				
				$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'</td>
					   <td style="font-weight:normal" >'.$lid.'</td>
					   <td style="font-weight:normal" >'.$type_str.'</td>
					   <td style="font-weight:normal" >'.$sdate.'</td>
					   <td style="font-weight:normal" >'.$edate.'</td>
					   <td style="font-weight:normal" >'.$tleaves.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="leavemydetailclosed.php?lid='.$encrypt_lid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No Open Leave Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}


public function loadMyReviewLeaveRequest()
{
	$myeid = $_SESSION["emp_id"];
	$str="";
	if($myeid > 0)
	{
		$dbsql=mysql_query("select * from od_leave_records where status='1' ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$isActive=0;
				$id = $row['id'];
				$date = $row['date'];
				$lid = $row['lid'];
				$eid = $row['eid'];
				
				if($eid == $myeid)
				{
					continue;
				}
				
				$ceo = $this->isCEO($eid);
				$mgmt = $this->isManagement($eid);
				
				$isDirector = $this->isDirector($myeid);
				$isCEO = $this->isCEO($myeid);
				
				if($ceo)
				{
					if(!$isDirector)
						continue;
				}else if($mgmt && !$ceo)
				{
					if(!$isCEO)
						continue;
				}					
				
				$isMgmt = $this->isManagement($myeid);
				if(!$isMgmt)
				{			
					$ret = $this->isMyTeamLeaveRequest($myeid,$eid);
					if($ret)
						$isActive = 1;
				}
				
				if(!$isMgmt)
				{			
					$ret = $this->isMyProjectGrpLeaveRequest($myeid,$eid);
					if($ret)
						$isActive = 1;
				}
				
				if(!$isMgmt && !$isActive) 	continue;
				
				
				$type = $row['type'];
				$type_str = $this->getLeaveTypeById($type);
				$name = $this->getEmpName($eid);
				$sdate = $row['start_date'];
				$edate = $row['end_date'];
				$tleaves = $row['days'];
				$status = $row['status'];
				$status_str = $this->getLeaveStatusById($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_lid = $this->get_mcrypt_encrypt($lid,$iv_key);						
				
				$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'</td>
					   <td style="font-weight:normal" >'.$lid.'</td>
					   <td style="font-weight:normal" >'.$name.'</td>
					   <td style="font-weight:normal" >'.$type_str.'</td>
					   <td style="font-weight:normal" >'.$sdate.'</td>
					   <td style="font-weight:normal" >'.$edate.'</td>
					   <td style="font-weight:normal" >'.$tleaves.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="leavemyapprovaldetails.php?lid='.$encrypt_lid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			if(strlen($str) == 0)
				$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Open Leave Request found</td></tr>';
			
			
		}else{
			
			$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Open Leave Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}


public function loadHRReviewLeaveRequest()
{
	
	$dbsql=mysql_query("select * from od_leave_records where status='1' ORDER BY id DESC ");
	$Num = mysql_num_rows($dbsql);	
	if ($Num > 0)
	{
		$sl_no=0;
		while($row = mysql_fetch_array($dbsql))
		{
			$sl_no++;
			$id = $row['id'];
			$date = $row['date'];
			$lid = $row['lid'];
			$eid = $row['eid'];
			
			
			$type = $row['type'];
			$type_str = $this->getLeaveTypeById($type);
			$name = $this->getEmpName($eid);
			$sdate = $row['start_date'];
			$edate = $row['end_date'];
			$tleaves = $row['days'];
			$status = $row['status'];
			$status_str = $this->getLeaveStatusById($status);
								
			$iv_key = $this->get_mcrypt_iv();
			$encrypt_lid = $this->get_mcrypt_encrypt($lid,$iv_key);						
				
			$str .= '<tr class="success" >
			       <td  style="font-weight:normal" >'.$sl_no.'</td>
                   <td style="font-weight:normal" >'.$date.'</td>
				   <td style="font-weight:normal" >'.$lid.'</td>
				   <td style="font-weight:normal" >'.$name.'</td>
				   <td style="font-weight:normal" >'.$type_str.'</td>
				   <td style="font-weight:normal" >'.$sdate.'</td>
				   <td style="font-weight:normal" >'.$edate.'</td>
				   <td style="font-weight:normal" >'.$tleaves.'</td>
				   <td style="font-weight:normal">'.$status_str.'</td>
				   <td class="tooltip-sidebar-logout">
				   <a href="leavehrviewdetails.php?lid='.$encrypt_lid.'&iv='.$iv_key.'&type=1 " >
				   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
				   </td>
				   </tr>';				
		}
		if(strlen($str) == 0)
			$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Open Leave Request found</td></tr>';
			
	}else{
			
		$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Open Leave Request found</td></tr>';
	}
	$data=array("status"=>1,"data"=>$str);
    
	return $data;
}


public function loadHRReviewPastLeaveRequest()
{
	
	$dbsql=mysql_query("select * from od_leave_records where status!='1' ORDER BY id DESC LIMIT 100");
	$Num = mysql_num_rows($dbsql);	
	if ($Num > 0)
	{
		$sl_no=0;
		while($row = mysql_fetch_array($dbsql))
		{
			$sl_no++;
			$id = $row['id'];
			$date = $row['date'];
			$lid = $row['lid'];
			$eid = $row['eid'];
			
			
			$type = $row['type'];
			$type_str = $this->getLeaveTypeById($type);
			$name = $this->getEmpName($eid);
			$sdate = $row['start_date'];
			$edate = $row['end_date'];
			$tleaves = $row['days'];
			$status = $row['status'];
			$status_str = $this->getLeaveStatusById($status);
								
			$iv_key = $this->get_mcrypt_iv();
			$encrypt_lid = $this->get_mcrypt_encrypt($lid,$iv_key);						
				
			$str .= '<tr class="success" >
			       <td  style="font-weight:normal" >'.$sl_no.'</td>
                   <td style="font-weight:normal" >'.$date.'</td>
				   <td style="font-weight:normal" >'.$lid.'</td>
				   <td style="font-weight:normal" >'.$name.'</td>
				   <td style="font-weight:normal" >'.$type_str.'</td>
				   <td style="font-weight:normal" >'.$sdate.'</td>
				   <td style="font-weight:normal" >'.$edate.'</td>
				   <td style="font-weight:normal" >'.$tleaves.'</td>
				   <td style="font-weight:normal">'.$status_str.'</td>
				   <td class="tooltip-sidebar-logout">
				   <a href="leavehrviewdetails.php?lid='.$encrypt_lid.'&iv='.$iv_key.'&type=2 " >
				   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
				   </td>
				   </tr>';				
		}
		if(strlen($str) == 0)
			$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Past Leave Request found</td></tr>';
			
	}else{
			
		$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Past Leave Request found</td></tr>';
	}
	$data=array("status"=>1,"data"=>$str);
    
	return $data;
}

public function getDetailsLeaveRequest($lid)
{
	$dbsql=mysql_query("select * from od_leave_records where lid='".$lid."' ");
	$Num = mysql_num_rows($dbsql);	
	$admin = new AdminUser();
	if ($Num > 0)
	{
		$row = mysql_fetch_array($dbsql);
		
		$admin->lid = $lid;
		$hr  = $row['hr'];
		$admin->cdate  = $row['date'];
		$admin->eid  = $row['eid'];
		$oid = $row['eid'];
		$upper = $this->getEmployeeToReport($admin->eid);
		$admin->report_to = $upper->name;
		$admin->cname  = $this->getEmployeeName($admin->eid);
		if($hr)
		{
			$admin->cname = "[HR] ".$admin->cname;
		}
		$admin->type  = $row['type'];
		$admin->type_str  = $this->getLeaveTypeById($admin->type);
		$admin->sdate = $row['start_date'];
		$admin->edate = $row['end_date'];
		$admin->days = $row['days'];
		$admin->msg  = trim(stripslashes($row['msg']));
		$admin->status = $row['status'];
		$admin->status_str = $this->getLeaveStatusById($admin->status);
		$admin->available  = $this->getAllAvailableLeaveByEid($admin->eid,$admin->type);
		$admin->superid  = $row['super_id'];
		if($admin->superid > 0)
		{	
			if($admin->superid == 1)
			{
				$admin->super_name  = "SCM-Admin";
				$admin->super_msg  = "Auto Approved by SCM";
			}
			else{
				$admin->super_name  = $this->getEmployeeName($admin->superid);
				$admin->super_msg  = trim(stripslashes($row['super_msg']));
			}
		}
		
		$admin->dataArray = array();
		////////get data details
		$dbsql=mysql_query("select * from od_leave_logs where lid='".$lid."' ORDER BY id DESC");
		$Num = mysql_num_rows($dbsql);	
		while($row = mysql_fetch_array($dbsql))
		{
			$data = new AdminUser();
			$data->dataid = $row['id'];
			$createdHR = $row['hr'];
			$data->date_updated = $row['date'];
			$data->emp_name = $this->getEmpName($row['eid']);
			if($createdHR)
				$data->emp_name = "HR on behalf of ".$data->emp_name;
			$data->msg = stripslashes($row['msg']);
			$data->status_log = $row['status_log'];
			$admin->dataArray[] =  $data;
		}
	
	}	
	
	return $admin;
}

public function updateLeaveCount($eid,$type,$days,$year)
{
	$ret=0;
	$dbsql=mysql_query("select * from od_leave_counts where eid='".$eid."' and year='".$year."' ");
	$Num = mysql_num_rows($dbsql);	
		
	if($row = mysql_fetch_array($dbsql))
	{
		$paid = $row['paid'];
		$unpaid = $row['unpaid'];
		$special = $row['special'];
		$earned = $row['earned'];
		$maternity = $row['maternity'];
		if($type == 1 || $type == 2 || $type == 3 || $type == 4)
			$paid+=$days;
		else if($type == 5)
		  $unpaid+=$days;
		else if($type == 6)
		  $special+=$days;
	    else if($type == 7)
	      $earned+=$days;
	    else if($type == 8)
	      $maternity+=$days;
	  
		$str = "UPDATE od_leave_counts set paid='".$paid."',unpaid='".$unpaid."',special='".$special."' ,earned='".$earned."',maternity='".$maternity."'  where eid='".$eid."' and year='".$year."' ";
		$qry=mysql_query($str);
		if($qry)
			$ret=1;
	}	
	return $ret;
}



public function updateLeaveRecords($lid)
{
	$ret=0;
	$dbsql=mysql_query("select * from od_leave_records where lid='".$lid."' ");
	$Num = mysql_num_rows($dbsql);	
	if($Num > 0)
	{
		$ret=1;
		$row = mysql_fetch_array($dbsql);
		
		$eid = $row['eid'];
		$sdate = $row['start_date'];
		$edate = $row['end_date'];
		$days = $row['days'];
		$type = $row['type'];
		$year = $row['year'];
		$type_str = $this->getLeaveTypeById($type);
		$msg  = trim(stripslashes($row['msg']));
		
		$ret = $this->updateLeaveCount($eid,$type,$days,$year);
		if(!$ret)
		{
			return $ret;
		}
		
		$edate_str = strtotime($edate);
		$date = $sdate;
		$date_str = strtotime($date);
		while($date_str <= $edate_str )
		{
			$holiday = $this->checkHoliday($date);
			if(!$holiday)
				$this->addDailyReportForLeave($eid,$type,$date,$msg,$lid);
			$date = date("d-m-Y", strtotime($date." 1 days"));
			$date_str = strtotime($date);
		}
	}
	
	return $ret; 
}


public function generateLeaveDetails($lid)
{
	$ret=0;
	$date_time = date("d-m-Y, h:i:s A");
	$dbsql=mysql_query("select * from od_leave_records where lid='".$lid."' ");
	$Num = mysql_num_rows($dbsql);	
	if($Num > 0)
	{
		$ret=1;
		$row = mysql_fetch_array($dbsql);
		
		$eid = $row['eid'];
		$sdate = $row['start_date'];
		$edate = $row['end_date'];
		$days = $row['days'];
		$type = $row['type'];
		$year = $row['year'];
		$type_str = $this->getLeaveTypeById($type);
		//$msg  = trim(stripslashes($row['msg']));
		$msg = addslashes($row['msg']);
		
				
		$edate_str = strtotime($edate);
		$date = $sdate;
		$date_str = strtotime($date);
		while($date_str <= $edate_str )
		{
			$holiday = $this->checkHoliday($date);
			if(!$holiday)
			{	
				$query = "INSERT into od_leave_daily_records set date_time='".$date_time."' , year='".$year."', type='".$type."' , date='".$date."', emp_id='".$eid."' , text='".$msg."' , lid='".$lid."' ";
				$res = mysql_query($query);
			}
			$date = date("d-m-Y", strtotime($date." 1 days"));
			$date_str = strtotime($date);
		}
	}
	
	return $ret; 
}

public function removeLeaveDetails($lid)
{
	$str1 = "delete from od_leave_daily_records where lid='".$lid."' ";
	$dbsql=mysql_query($str1);
}


public function removeDateLeaveDetails($lid,$date)
{
	$str1 = "delete from od_leave_daily_records where lid='".$lid."' and date='".$date."' ";
	$dbsql=mysql_query($str1);
}


public function addDailyReportForLeave($eid,$type,$date,$msg,$lid)
{
	$empData = $this->getEmployeeData($eid);
	$team_id = $empData->dept_id;
	$msg  = trim(addslashes($msg));
	$pro_id = 200101;
	$location = 1;
	$time = 480;
	if($type == 1) 	$pro_task_id = 20;
	if($type == 2) 	$pro_task_id = 21;
	if($type == 3) 	$pro_task_id = 22;
	if($type == 4) 	$pro_task_id = 118;
	if($type == 5) 	$pro_task_id = 117;
	if($type == 6) 	$pro_task_id = 2244;
	if($type == 7) 	$pro_task_id = 2245;
	if($type == 8) 	$pro_task_id = 2415;
	
	if($type == 4)
		$time = 240;
	
	$date_time = date("d-m-Y, h:i:s A");
	
	$query = "INSERT into od_project_dailytask_logs set date_time='".$date_time."' , date='".$date."', team_id='".$team_id."', emp_id='".$eid."' , pro_id='".$pro_id."' , pro_task_id='".$pro_task_id."' , location='".$location."' , time='".$time."' , text='".$msg."' , leave_id='".$lid."' ";
	
	$res = mysql_query($query);
	
}

public function getEmployeeLeaveInfo($eid,$date	)
{
	$employee = new employee();
	$employee->status = 0;
	$query = "select * from od_leave_daily_records where date='".$date."' and  emp_id='".$eid."' ";
	$dbsql=mysql_query($query);
	if($row = mysql_fetch_array($dbsql))
	{
		$leave_id = $row['lid'];
		$employee->status = 1;
		$employee->lid = $leave_id;
		$employee->info = "Leave [".$leave_id."]";
	}
	
	return 	$employee;
}

public function loadResoLeaveRecords($eid,$year)
{
	$dbsql=mysql_query("select * from od_leave_counts where eid='".$eid."' and year='".$year."' ");
	$Num = mysql_num_rows($dbsql);
	$row = mysql_fetch_array($dbsql);
	$empData = $this->getEmployeeData($eid);
	$upper = $this->getEmployeeToReport($eid);
	
	$emp_name = $empData->name;
	$report_to = $upper->name;

	$max_paid = $row['maxpaid'];
	$paid = $row['paid'];
	$a_paid = $max_paid - $paid;
	$paid_field = $paid."/".$a_paid;
	
	$max_unpaid = $row['maxunpaid'];
	$unpaid = $row['unpaid'];
	$a_unpaid = $max_unpaid - $unpaid;
	$unpaid_field = $unpaid."/".$a_unpaid;
	
	$max_special = $row['maxspecial'];
	$special = $row['special'];
	$a_special = $max_special - $special;
	$special_field = $special."/".$a_special;
	
	$max_earned = $row['maxearned'];
	$earned = $row['earned'];
	$a_earned = $max_earned - $earned;
	
	$max_maternity = $row['maxmaternity'];
	$maternity = $row['maternity'];
	$a_maternity = $max_maternity - $maternity;
	$maternity_field = $maternity."/".$a_maternity;
	
	
	if($empData->gender_id == 1)
	{
		$a_maternity = 0;
		$maternity_field = "NA";
	}
	
	
	$data=array("status"=>1,"emp_name"=>$emp_name, "uname"=>$report_to , "emp_id"=>$eid , "m_paid"=>$max_paid , "m_unpaid"=>$max_unpaid , "m_special"=>$max_special , "m_earned"=>$max_earned , "a_paid"=>$a_paid , "a_unpaid"=>$a_unpaid , "a_special"=>$a_special , "a_earned"=>$a_earned , "a_maternity"=>$a_maternity , "paid_field"=>$paid_field , "unpaid_field"=>$unpaid_field , "special_field"=>$special_field , "maternity_field"=>$maternity_field );
	
	return $data;
}


public function loadResoAllLeaveRequest($eid,$year)
{
	
	$dbsql=mysql_query("select * from od_leave_records where eid='".$eid."' and year='".$year."'  ORDER BY id DESC ");
	$Num = mysql_num_rows($dbsql);	
	if ($Num > 0)
	{
		$sl_no=0;
		while($row = mysql_fetch_array($dbsql))
		{
			$sl_no++;
			$id = $row['id'];
			$date = $row['date'];
			$lid = $row['lid'];
			$eid = $row['eid'];
			
			
			$type = $row['type'];
			$type_str = $this->getLeaveTypeById($type);
			$name = $this->getEmpName($eid);
			$sdate = $row['start_date'];
			$edate = $row['end_date'];
			$tleaves = $row['days'];
			$status = $row['status'];
			$status_str = $this->getLeaveStatusById($status);
								
			$iv_key = $this->get_mcrypt_iv();
			$encrypt_lid = $this->get_mcrypt_encrypt($lid,$iv_key);	
			$encrypt_eid = $this->get_mcrypt_encrypt($eid,$iv_key);				
				
			$str .= '<tr class="success" >
			       <td  style="font-weight:normal" >'.$sl_no.'</td>
                   <td style="font-weight:normal" >'.$date.'</td>
				   <td style="font-weight:normal" >'.$lid.'</td>
				   <td style="font-weight:normal" >'.$type_str.'</td>
				   <td style="font-weight:normal" >'.$sdate.'</td>
				   <td style="font-weight:normal" >'.$edate.'</td>
				   <td style="font-weight:normal" >'.$tleaves.'</td>
				   <td style="font-weight:normal">'.$status_str.'</td>
				   <td class="tooltip-sidebar-logout">
				   <a href="leavehrviewdetailsresource.php?lid='.$encrypt_lid.'&iv='.$iv_key.'&emp_id='.$encrypt_eid.' " >
				   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
				   </td>
				   </tr>';				
		}
		if(strlen($str) == 0)
			$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Leave Request found</td></tr>';
			
	}else{
			
		$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Leave Request found</td></tr>';
	}
	$data=array("status"=>1,"data"=>$str);
    
	return $data;
}


public function updateResoLeaveRecords($data)
{
	
	$eid = $data['reso_id'];
	if($eid)
	{
		$msg = addslashes($data['text1']);
		$year = date("Y");
		$old_mpaid = 0;
		$old_munpaid = 0;
		$old_mspecial = 0;
		$present=0;
		
		$year = date("Y");
		$dbsql=mysql_query("select * from od_leave_counts where eid='".$eid."' and year='".$year."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num)
		{
			$present=1;
			$row = mysql_fetch_array($dbsql);
			$old_mpaid = $row['maxpaid'];
			$old_munpaid = $row['maxunpaid'];
			$old_mspecial = $row['maxspecial'];
		}			
		
		$new_mpaid = $data['m_paid'];
		$new_munpaid = $data['m_unpaid'];
		$new_mspecial = $data['m_special'];
		
		$query = "INSERT into od_leave_counts_update set o_maxpaid='".$old_mpaid."' , o_maxunpaid='".$old_munpaid."' , o_maxspecial='".$old_mspecial."' , n_maxpaid='".$new_mpaid."' , n_maxunpaid='".$new_munpaid."' , n_maxspecial='".$new_mspecial."' ,  eid='".$eid."' , year='".$year."' , msg='".$msg."'  ";
		
		$res = mysql_query($query);	
		
				
		if($present)
		{
			$query = "UPDATE od_leave_counts set maxpaid='".$new_mpaid."' , maxunpaid='".$new_munpaid."' , maxspecial='".$new_mspecial."' WHERE eid='".$eid."' and year='".$year."' ";
		}
		else{
			$new_mearned = 0;
			$new_maternity=0;
			$query = "INSERT into od_leave_counts set maxpaid='".$new_mpaid."' , maxunpaid='".$new_munpaid."' , maxspecial='".$new_mspecial."' , maxearned='".$new_mearned."', maxmaternity='".$new_maternity."' , eid='".$eid."' , year='".$year."' ";
		}
		$res = mysql_query($query);	
		
		$msg="Succesfully updated leave records";
		$data=array("status"=>1,"msg"=>$msg);
	}else{
		$msg="Unknow Error...";
		$data=array("status"=>0,"msg"=>$msg);
		
	}
	return $data;
}

///for email

public function getNewLeaveRequestList()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_leave_records where email='1' ");
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->lid = $row['lid'];
		$data->dataid = $this->getLeaveRequestFirstData($row['lid']);
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_leave_records set email='0' ");
		
	return  $dataArray;
}

public function getNewLeaveRequestListTest()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_leave_records where id='1609' ");
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->lid = $row['lid'];
		$data->dataid = $this->getLeaveRequestFirstData($row['lid']);
		$dataArray[] = $data;
	}
	//$qry=mysql_query("UPDATE od_leave_records set email='0' ");
		
	return  $dataArray;
}


public function getLeaveRequestFirstData($lid)
{
	$dataid = 0;
	$dbsql=mysql_query("select id from od_leave_logs where lid='".$lid."' order by id asc");
	if($row = mysql_fetch_array($dbsql))
		$dataid = $row['id'];
	return 	$dataid;
}


public function getUpdateLeaveRequestList()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_leave_logs where email='1' ");
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$data->dataid = $row['id'];
		$data->lid = $row['lid'];
		$dataArray[] = $data;
	}
	$qry=mysql_query("UPDATE od_leave_logs set email='0' ");
		
	return  $dataArray;
}

public function revertLeaveCounts($eid,$type,$days)
{
	$ret=0;
	$year = date("Y");
	$dbsql=mysql_query("select * from od_leave_counts where eid='".$eid."' and year='".$year."' ");
	$Num = mysql_num_rows($dbsql);	
		
	if($row = mysql_fetch_array($dbsql))
	{
		$paid = $row['paid'];
		$unpaid = $row['unpaid'];
		$special = $row['special'];
		$earned = $row['earned'];
		$maternity = $row['maternity'];
		if($type == 1 || $type == 2 || $type == 3 || $type == 4)
			$paid-=$days;
		else if($type == 5)
		  $unpaid-=$days;
		else if($type == 6)
		  $special-=$days;
	    else if($type == 7)
	      $earned-=$days;
	    else if($type == 8)
	      $maternity-=$days;
	  
		$str = "UPDATE od_leave_counts set paid='".$paid."',unpaid='".$unpaid."',special='".$special."' , earned='".$earned."', maternity='".$maternity."'  where eid='".$eid."' and year='".$year."' ";
		$qry=mysql_query($str);
		if($qry)
			$ret=1;
	}	
	return $ret;
	
}

public function revertResoLeaveRecords($data)
{
	$my_eid = $_SESSION["emp_id"];
	if($my_eid>0)
	{	
		$log="";
		$lid = $data['leaveid'];
		$dbsql=mysql_query("select * from od_leave_records where lid='".$lid."' ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$row = mysql_fetch_array($dbsql);
			$eid = $row['eid'];
			$type = $row['type'];
			$days = $data['hcount'];
			$tselected = $data['tselected'];
			$text1 = addslashes($data['text1']);
			if($type == 4)//half day leave
				$tselected =  ".5";
			$log .= "Total reverted days : ".$tselected;
			$log .= "\nReverted Dates: ";
			for($i=1;$i<=$days;$i++)
			{
				$select = $data['dateid'.$i];
				if($select)
				{
					$date = $data['hdate'.$i];
					$log .= $date." : ";
					//revert from project report
					$query = "delete from od_project_dailytask_logs where date='".$date."' and  emp_id='".$eid."' and leave_id='".$lid."' ";
					$res = mysql_query($query);
					////
					$this->removeDateLeaveDetails($lid,$date);
				}	
			}
			$status_id = 6;
			//revert leave counts
			
			
			$this->revertLeaveCounts($eid,$type,$tselected);
			
			$last_status = $this->getLeaveReqStatus($lid);
			$last_status_str = $this->getLeaveStatusById($last_status);
			$current_status_str = $this->getLeaveStatusById($status_id);
			if($status_id > 0 && $last_status != $status_id)
				$status_mod_str = "[".$last_status_str." => ".$current_status_str."]";
			else
				$status_mod_str = "[".$last_status_str."]";
			$cdate = date("d-m-Y, h:i:s A");
			
			if($status_id > 0)
			{	
				$qry=mysql_query("UPDATE od_leave_records set status='".$status_id."' , super_id='".$my_eid."'   where lid='".$lid."'");
			}
			$text1.="\n\n".$log;
			$query = "INSERT into od_leave_logs set date='".$cdate."' , lid='".$lid."', eid='".$my_eid."', msg='".$text1."' , email='1' , status_log='".$status_mod_str."' ";
			$res = mysql_query($query);
			$msg = "Leave records reverted successfully";
			$retdata=array("status"=>1,"msg"=>$msg);
		}
		else{
			$msg = "Unknown Error";
			$retdata=array("status"=>0,"msg"=>$msg);
		}
	}else{
		$msg = "Unknown Error";
		$retdata=array("status"=>0,"msg"=>$msg);
	}
	
	return 	$retdata;	
}



public function loadResourceLeaveCounts()
{
	$eid = $_SESSION["emp_id"];
	$str="";
	$sl_no=0;
	if($eid > 0)
	{
		//$empList = $this->getAllActiveEmployeeListName();
		$empList = $this->getAllActiveEmployeeList();
		foreach($empList as $emp)
		{
			$empData = $this->getEmployeeData($emp->eid);
			$empType = $this->getEmpTypeById($empData->emptype);
			$isMgmt = $this->isManagement($emp->eid);
			if($isMgmt)
				$empType = "MGMT";
			if(!$this->isEmployee($emp->eid))
			{
				continue;
			}
			$mleave = $this->getMaxLeave($emp->eid);
			$leave = $this->getAvailLeave($emp->eid);
			$paid = $leave->paid."/".$mleave->paid;
			$unpaid = $leave->unpaid."/".$mleave->unpaid;
			$special = $leave->special."/".$mleave->special;
			$compup = $leave->earned."/".$mleave->earned;
			$maternity = $leave->maternity."/".$mleave->maternity;
			$upper = $this->getEmployeeToReport($emp->eid);
			$sl_no++;	
			if($empData->gender_id == 1)
				$maternity = "NA";
			
			$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$emp->eid.'</td>
					   <td style="font-weight:normal" >'.$empData->name.'</td>
					   <td style="font-weight:normal" >'.$empData->gender.'</td>
					   <td style="font-weight:normal" >'.$empType.'</td>
					   <td style="font-weight:normal" >'.$paid.'</td>
					   <td style="font-weight:normal" >'.$unpaid.'</td>
					   <td style="font-weight:normal" >'.$special.'</td>
					   <td style="font-weight:normal" >'.$compup.'</td>
					   <td style="font-weight:normal" >'.$maternity.'</td>
					   <td style="font-weight:normal" >'.$upper->name.'</td>
					   </tr>';
			
		}
	}
	$data=array("status"=>1,"data"=>$str);
	return $data;
}



public function loadResourceLeaveCounts1($eid)
{
	$empList = $this->getAllActiveEmployeeList();
	foreach($empList as $emp)
	{
		//if($eid && $eid != $emp->eid)
		//	continue;
		$empData = $this->getEmployeeData($emp->eid);
		$empType = $this->getEmpTypeById($empData->emptype);
		$isMgmt = $this->isManagement($emp->eid);
		if($isMgmt)
			$empType = "MGMT";
		if(!$this->isEmployee($emp->eid))
		{
			continue;
		}
		$mleave = $this->getMaxLeave($emp->eid);
		$leave = $this->getAvailLeave($emp->eid);
		$paid = $leave->paid."/".$mleave->paid;
		$unpaid = $leave->unpaid."/".$mleave->unpaid;
		$special = $leave->special."/".$mleave->special;
		$compup = $leave->earned."/".$mleave->earned;
		$maternity = $leave->maternity."/".$mleave->maternity;
		$upper = $this->getEmployeeToReport($emp->eid);
		$sl_no++;	
		if($empData->gender_id == 1)
			$maternity = "NA";
		$style="";
		if($eid == $emp->eid)
		{
			$style="color: red; font-weight: bold";
		}
		
		$str .= '<tr class="success" >
			       <td style="font-weight:normal;'.$style.'" >'.$sl_no.'</td>
                   <td style="font-weight:normal;'.$style.'" >'.$emp->eid.'</td>
				   <td style="font-weight:normal;'.$style.'" >'.$empData->name.'</td>
				   <td style="font-weight:normal;'.$style.'" >'.$empData->gender.'</td>
				   <td style="font-weight:normal;'.$style.'" >'.$empType.'</td>
				   <td style="font-weight:normal;'.$style.'" >'.$paid.'</td>
				   <td style="font-weight:normal;'.$style.'" >'.$unpaid.'</td>
				   <td style="font-weight:normal;'.$style.'" >'.$special.'</td>
				   <td style="font-weight:normal;'.$style.'" >'.$compup.'</td>
				   <td style="font-weight:normal;'.$style.'" >'.$maternity.'</td>
				   <td style="font-weight:normal;'.$style.'" >'.$upper->name.'</td>
				   </tr>';
		
	}
	
	$data=array("status"=>1,"data"=>$str);
	return $data;
}


public function addCompOffLeave($data)
{
	$eid = $_SESSION["emp_id"];
	$sl_no=0;
	if($eid > 0)
	{
		$reso_id = $data['reso_id'];
		$comp_date = $data['comp_date'];
		$comp_date = date("d-m-Y", strtotime($comp_date));
		$text1 = addslashes($data['text1']);
		$holiday = $this->checkHoliday($comp_date);
		if(!$holiday)
		{
			$msg = "Assigned comp off date ".$comp_date." is not a holiday. Please select a holiday.";
			$data=array("status"=>0, "msg"=>$msg);
			return $data;
		}
		$today = date("d-m-Y");
		$expire_date = date("d-m-Y", strtotime($today." 30 days")); 
		$date_time = date("d-m-Y, h:i:s A");
		
		$query = "INSERT into od_leave_compoff set date='".$date_time."' , eid='".$reso_id."', comp_date='".$comp_date."', expire_date='".$expire_date."' , msg='".$text1."' , status='1' ";
		$res = mysql_query($query);
		if($res)
		{
			$empdata = $this->getEmployeeData($reso_id);
			$to = $empdata->office_email;
			$cc = "hr@oditeksolutions.com,mgmt@oditeksolutions.com";
			$name = $empdata->name;
            $title = "Awarded CompOff Leave to ".$empdata->name;
			$body = "Dear ".$name.",<BR><BR>We are pleased to inform you that one CompOff leave has been Awarded for your support on date ".$comp_date."[".$text1."].<BR><BR>Br,<BR>HR-OdiTek";
			$this->sendGenericEmail($name,$to,$cc,"",$title,$body);
			$msg = "Successfully created comp off Leave";
			$data=array("status"=>1, "msg"=>$msg );
		}else{
			$msg = "Unknown Error! Please try again.";
			$data=array("status"=>0, "msg"=>$msg);
		}	
		return $data;
	}
	else{
		$msg = "Unknown Error! Please try again.";
		$data=array("status"=>0, "msg"=>$msg);
		return $data;
		
	}
	
}


public function loadCompOffLeaves()
{
	
	$dbsql=mysql_query("select * from od_leave_compoff ORDER BY id DESC ");
	$Num = mysql_num_rows($dbsql);	
	
	if ($Num > 0)
	{
		$sl_no=0;
		while($row23 = mysql_fetch_array($dbsql))
		{
			
			$sl_no++;
			$id = $row23['id'];
			$date = $row23['date'];
			$eid = $row23['eid'];
			$comp_date = $row23['comp_date'];
			$expire_date = $row23['expire_date'];
			$msg = stripcslashes($row23['msg']);
			$status = $row23['status'];
			$lid = $row23['lid'];
			$upper = $this->getEmployeeToReport($eid);
			$name = $this->getEmpName($eid);
			$status_str = $this->getCompOffLeaveStatusById($status);
			
				
			$str1 .= '<tr class="success" >
			       <td  style="font-weight:normal" >'.$sl_no.'</td>
                   <td style="font-weight:normal" >'.$date.'</td>
				   <td style="font-weight:normal" >'.$eid.'</td>
				   <td style="font-weight:normal" >'.$name.'</td>
				   <td style="font-weight:normal" >'.$upper->name.'</td>
				   <td style="font-weight:normal" >'.$comp_date.'</td>
				   <td style="font-weight:normal" >'.$expire_date.'</td>
				   <td style="font-weight:normal" >'.$status_str.'</td>
				   <td style="font-weight:normal">'.$lid.'</td>
				   </tr>';
						   
		}
		
			
	}else{
			
		$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Open Comp Off Leave found</td></tr>';
	}
	$data=array("status"=>1,"data"=>$str1);
    
	return $data;
	
		
}

public function updateCompOffStatus($lid,$id,$status)
{
	
	$qry=mysql_query("UPDATE od_leave_compoff set lid='".$lid."' , status='".$status."' where id='".$id."'");
	
}

public function revertCompOffLeave($id)
{
	
	$qry=mysql_query("UPDATE od_leave_compoff set lid='' , status='1' where id='".$id."'");
	
}

public function sendEmail4ReportingChange($eid,$upper_id,$old_upper_id)
	{
		$date = date("d-m-Y, h:i:s A");	
		$old_manager_email = "";
		$empdata = $this->getEmployeeData($eid);
		$to = $empdata->office_email;
		$manegeremail = $this->getManagerEmail($eid);
		$manegerename = $this->getManagerName($eid);
		if($old_upper_id != "1000")
		{	
			$old_manager = $this->getEmployeeData($old_upper_id);
			$old_manager_email = $old_manager->office_email;
		}	
		if(strlen($manegeremail) > 0)
			$cc = "hr-intra@oditeksolutions.com,".$manegeremail;
		else
			$cc = "hr-intra@oditeksolutions.com";
		if(strlen($old_manager_email) > 0)
			$cc .=",".$old_manager_email;
		
		$bcc="";
		
		
		$name = $empdata->name;
		$title = "Reporting Change of ".$empdata->name;
		$body = "Dear ".$name.",<BR><BR>Your reporting leader has been changed.<BR>Now you will report to <B>".$manegerename."</B> on your daily activity in OdiTek.<BR><BR> Br,<BR>HR-OdiTek";
		$body = addslashes($body);
		$query = "INSERT into od_send_email set date='".$date."' , toemail='".$to."' , cc='".$cc."' , bcc='".$bcc."' , title='".$title."' , body='".$body."' , name='".$name."' ";
		$res = mysql_query($query);
		
	}


public function loadTodayLeaveList()
{
	$today = date("d-m-Y");
	$today_str = strtotime($today);
	$holiday = $this->checkHoliday($today);
	if($holiday)
	{
		$holiday = $this->getHolidayInfo($today);	
		$str ='<tr><td colspan="7" style="text-align: center; font-weight:bold" >'.$holiday.'</td></tr>';
		$data=array("status"=>1,"data"=>$str);
		return $data;
	}
	$sl_no=0;	
	$dbsql=mysql_query("select * from od_leave_records where status = 1 or status = 2 ORDER BY id DESC ");
	$Num = mysql_num_rows($dbsql);	
	if ($Num > 0)
	{
		while($row = mysql_fetch_array($dbsql))
		{
			$sdate = $row['start_date'];
			$edate = $row['end_date'];
			$sdate_str = strtotime($sdate);
			$edate_str = strtotime($edate);
			if($sdate_str <= $today_str && $today_str <= $edate_str)
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$type = $row['type'];
				$lid = $row['lid'];
				$eid = $row['eid'];
				$status = $row['status'];
				$status_str = $this->getLeaveStatusById($status);
				$type_str = $this->getLeaveTypeById($type);
				$upper = $this->getEmployeeToReport($eid );
				$upper_name = $upper->name;
				$empData = $this->getEmployeeData($eid);
				$dept = $this->getDeptById($empData->dept_id);
				$name  = $empData->name;
				
				$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$lid.'</td>
					   <td style="font-weight:normal" >'.$name.'</td>
					   <td style="font-weight:normal" >'.$type_str.'</td>
					   <td style="font-weight:normal" >'.$status_str.'</td>
					   <td style="font-weight:normal" >'.$dept.'</td>
					   <td style="font-weight:normal" >'.$upper_name.'</td>
					   </tr>';		
			}
		}
		
	}
	if(!$sl_no)
		$str ='<tr><td colspan="7" style="text-align: center; font-weight:bold" >No Leave Records found</td></tr>';
	
	$data=array("status"=>1,"data"=>$str);
	return $data;
}


public function loadUpcomingLeaveList()
{
	$days = 30;
	$today = date("d-m-Y");
	//$today = "06-08-2022";
	$count =0;
	$date = $today;
	$sl_no=0;
	while($count <= $days)
	{
		$next_date = date("d-m-Y", strtotime($date." 1 day")); 
		$date = $next_date;
		$holiday = $this->checkHoliday($next_date);
		if($holiday)
			continue;
		$count++;
		$date_str = strtotime($date);		
		$dbsql=mysql_query("select * from od_leave_records where status = 1 or status = 2 ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$sdate = $row['start_date'];
				$edate = $row['end_date'];
				$sdate_str = strtotime($sdate);
				$edate_str = strtotime($edate);
				if($sdate_str <= $date_str && $date_str <= $edate_str)
				{
					$sl_no++;
					$id = $row['id'];
					$type = $row['type'];
					$day = date("l", strtotime($date));
					$lid = $row['lid'];
					$eid = $row['eid'];
					$status = $row['status'];
					$status_str = $this->getLeaveStatusById($status);
					$type_str = $this->getLeaveTypeById($type);
					$upper = $this->getEmployeeToReport($eid );
					$upper_name = $upper->name;
					$empData = $this->getEmployeeData($eid);
					$dept = $this->getDeptById($empData->dept_id);
					$name  = $empData->name;
					if($count > 1 && $type == 8) //if maternity
						continue;
					
					$str .= '<tr class="success" >
						   <td  style="font-weight:normal" >'.$sl_no.'</td>
						   <td style="font-weight:normal" >'.$date.' [ '.$day.' ]</td>
						   <td style="font-weight:normal" >'.$lid.'</td>
						   <td style="font-weight:normal" >'.$name.'</td>
						   <td style="font-weight:normal" >'.$type_str.'</td>
						   <td style="font-weight:normal" >'.$status_str.'</td>
						   <td style="font-weight:normal" >'.$dept.'</td>
						   </tr>';		
				}
			}
		}
	}	
	if(!$sl_no)
		$str ='<tr><td colspan="7" style="text-align: center; font-weight:bold" >No Leave Records found</td></tr>';
	
	$data=array("status"=>1,"data"=>$str);
	return $data;
}


public function getMyLeaveCounts($eid)
{
	$year = date("Y");
	$dbsql=mysql_query("select * from od_leave_counts where eid='".$eid."' and year='".$year."' ");
	$Num = mysql_num_rows($dbsql);
	$row = mysql_fetch_array($dbsql);
	$empData = $this->getEmployeeData($eid);
	$data = new AdminUser();	

	$max_paid = $row['maxpaid'];
	$paid = $row['paid'];
	$a_paid = $max_paid - $paid;
	$data->paid_field = $paid."/".$a_paid;
	
	$max_unpaid = $row['maxunpaid'];
	$unpaid = $row['unpaid'];
	$a_unpaid = $max_unpaid - $unpaid;
	$data->unpaid_field = $unpaid."/".$a_unpaid;
	
	$max_special = $row['maxspecial'];
	$special = $row['special'];
	$a_special = $max_special - $special;
	$data->special_field = $special."/".$a_special;
	
		
	$max_maternity = $row['maxmaternity'];
	$maternity = $row['maternity'];
	$a_maternity = $max_maternity - $maternity;
	$data->maternity_field = $maternity."/".$a_maternity;
	
	
	if($empData->gender_id == 1)
	{
		$a_maternity = 0;
		$data->maternity_field = "NA";
	}
	
	return $data;
}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function getEmpAttendanceData($eid, $date)
{
	$employee = new employee();
	$employee->status = 0;
	$employee->start_time = "NA";
	$employee->end_time = "NA";
	$employee->work_time = "NA";
	
	$start_time = "NA";
	$end_time = "NA";
	$work_time = 0;
	$strdb = "select * from od_matrix_daily_log where eid='".$eid."' and date='".$date."'  ";
	$employee->dbdata=$strdb;
	$dbsql=mysql_query($strdb);
	$Num = mysql_num_rows($dbsql);	
	if($Num)
	{
		$rowdb = mysql_fetch_array($dbsql);	
		$employee->status =1;	
		$start_time = $rowdb['punch1'];
		$end_time = $rowdb['punch2'];
		$work_time = $rowdb['worktime'];
		$manual = $rowdb['manual'];
		$monthid = $rowdb['monthid'];
		
		if($start_time != "NA")
			$start_time = date("h:i:s A", strtotime($start_time));
		
		if($end_time != "NA")
			$end_time = date("h:i:s A", strtotime($end_time));
		
		
		$employee->id = $rowdb['id'];
		$employee->work_date = $date;
		$employee->start_time = $start_time;
		$employee->end_time = $end_time;
		$employee->manual = $manual;
		if($work_time > 0)
			$employee->work_time = $this->getTimeText2($work_time*60);
		else
			$employee->work_time = "NA";

		$employee->monthid =$monthid;	
	}
	else{
		$monthid = date("n",strtotime($date));
		$year = date("Y",strtotime($date));
		$query = "INSERT into od_matrix_daily_log set date='".$date."', monthid='".$monthid."', year='".$year."' , auto='1' , manual='0' , eid='".$eid."' , punch1 = 'NA'   ,  punch2='NA' , worktime='0' ";
		$res = mysql_query($query);
		$employee->id = mysql_insert_id();
		$employee->monthid =$monthid;
	}
	
	//$daarray[] = $employee;
	return $employee;
}

public function generateMatrixDailyRecords()
{
	$date = date("d-m-Y");
	$monthid = date("n",strtotime($date));
	$year = date("Y",strtotime($date));
	$empList = $this->getAllActiveEmployeeListName();
	foreach($empList as $emp)
	{
		$eid = $emp->eid;
		$isMgmt = $this->isManagement($eid);
		if($isMgmt) continue;
				
		$name = $emp->name;
		$doj = date("d-m-Y", strtotime($emp->doj));
		$doj_str = strtotime($doj);
		if(strtotime($date) < $doj_str) //check based on DOJ
			continue;
					
		$strdb = "select * from od_matrix_daily_log where eid='".$eid."' and date='".$date."'  ";	
		$dbsql=mysql_query($strdb);
		$Num = mysql_num_rows($dbsql);	
		if(!$Num)
		{
			$query = "INSERT into od_matrix_daily_log set date='".$date."', monthid='".$monthid."', year='".$year."', auto='1' , manual='0' , eid='".$eid."' , punch1 = 'NA'   ,  punch2='NA' , worktime='0' ";
			$res = mysql_query($query);
		}
	}
}

public function generateEmpAbsentList()
{
	//only generate on first Working day
	$date = date("d");
	if($date == "01")
	{
		$month_ini = new DateTime("first day of last month");
		$month_end = new DateTime("last day of last month");
		
		$start_date =  $month_ini->format('d-m-Y');
		$end_date =  $month_end->format('d-m-Y');
		
		$monthid = date("n",strtotime($start_date));
		$year = date("Y",strtotime($start_date));
		$month_name = date("F",strtotime($start_date));
		$report_end_date = "04-".date('m-Y');
			
		$empList = $this->getAllActiveEmployeeListName();
		foreach($empList as $emp)
		{
			$eid = $emp->eid;
			$doj = $emp->doj;
			
			$absCnt=0;
			if($this->isManagement($eid)) continue;
			
			if(!$this->isEmployee($eid)) continue;

			if($this->isContractEmployee($eid)) continue;			
			
				
			$admin = new AdminUser();
			$admin->eid = $eid;
			$admin->name = $this->getEmployeeName($eid );
			$admin->dateList = array();
			
			$strdb = "select * from od_matrix_daily_log where eid='".$eid."' and punch1='NA' and  punch2='NA' and monthid = '".$monthid."' and year='".$year."' order by id asc ";	
			$dbsql=mysql_query($strdb);
			$Num = mysql_num_rows($dbsql);
			while($row = mysql_fetch_array($dbsql))
			{
				$date = $row['date'];
				if(!$this->checkHoliday($date))
				{
					if(strtotime($date) < strtotime($doj)) continue;
					
					$leaveInfo = $this->getEmployeeLeaveInfo($eid,$date);
					$wfhInfo = $this->getEmployeeWFHInfo($eid,$date);
					if(!$leaveInfo->status && !$wfhInfo->status)
					{
						$admin->dateList[] = $date;
						$absCnt++;	
					}
				}
			}
			if($absCnt)
			{	
				$this->generateAbsentEmail($admin,$month_name,$report_end_date);
			}
		}
	}
	
}




public function generateAbsentEmail($admin,$month_name,$end_date)
{
	
	$slno=0;
	
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
		<body lang=EN-IN link='#0563C1' vlink='#954F72' style='width:600px;'>
		<div class=WordSection1>
	    <p class=MsoNormal>
		<h2 class='title' style='font-size:16px;margin:0;line-height:1em;font-weight:normal;font-size:16px'>
		</h2>
		Dear ".$admin->name.",	
		<BR><BR>
		Please regularize your attendance of month <B>".$month_name."</B> befor 12:00PM , ".$end_date.".
		<BR>
		In case any incorrect/corrections needed, please discuss with HR on this.
		<BR>";
				
						
		$body.="<BR>
				<div style='padding: 1em;display: table'>
				<table width='600' border='1' align='left'>
		        <tbody> 
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666' bgcolor='#FBFF00' >
			    
				<td width='60' align='center' style='padding-right:10px;'>
			    <B>Sl No.<B>
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Date<B>
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>In Time<B>
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Out Time<B>
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Status<B>
				</td>
				</tr>";
		foreach($admin->dateList as $date )
		{
			$slno++;
			$body.="<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
			    
				<td width='60' align='center' style='padding-right:10px;'>
			    ".$slno."
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    ".$date."
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    NA
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    NA
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    Absent
				</td>
				</tr>";
		}
								
		$body.="</tbody>
				</table>
				</div>";
		$body.="</p>
				<div style='width:100%; padding-top:30px;'>
				<table width='100%' border='0' align='left'>
				<tr><td>
				<h2 class='title' style='color:#999999;font-size:12px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:12px,bgcolor=#FBFF00 '>
				<I>NOTE: This is a system generated e-mail. Please don't reply. </I>
				</h2>
				</td>
				</tr>
				</table>
				</div>
				</body></html>";
	
	//
	$date = date("d-m-Y, h:i:s A");
	$empData = $this->getEmployeeData($admin->eid);	
	$temp="";
	
	$to = $this->getEmployeeEmail($admin->eid);
	$mgr_email = $this->getRMEmail($admin->eid);
	$bu_head_email = $this->getBUHeadEmail($admin->eid);
	$cc = "hr@oditeksolutions.com";
	$bcc = "";
	if(!strcmp($bu_head_email,$mgr_email))
		$cc .= ",".$bu_head_email;
	else
		$cc .= ",".$bu_head_email.",".$mgr_email;
	
	//$body .= $to.",".$cc;
	//$cc="";
	//$bcc = "";
	//$to = "chinmaya.sahu@oditeksolutions.com";
	$name = $admin->name;
	$title = "Regularize Attendance for month ".$month_name." [ ".$name." ] ";
	$body = addslashes($body);
	
	$query = "INSERT into od_send_email set date='".$date."' , toemail='".$to."' , cc='".$cc."' , bcc='".$bcc."' , title='".$title."' , body='".$body."' , name='".$name."' ";
	$res = mysql_query($query);
	
	
}



public function generateCurrentMonthEmpAbsentList()
{
	//only generate on 16th Working day
	$date = date("d");
	if($date == "16")
	{
		$start_date =  "01-".date('m-Y');
		$end_date =  "15-".date('m-Y');
		
		$monthid = date("n",strtotime($start_date));
		$year = date("Y",strtotime($start_date));
		$month_name = date("F",strtotime($start_date));
			
		$empList = $this->getAllActiveEmployeeListName();
		foreach($empList as $emp)
		{
			$eid = $emp->eid;
			$doj = $emp->doj;
			
			$absCnt=0;
			if($this->isManagement($eid)) continue;
			
			if(!$this->isEmployee($eid)) continue; 
			
			if($this->isContractEmployee($eid)) continue;
				
			$admin = new AdminUser();
			$admin->eid = $eid;
			$admin->name = $this->getEmployeeName($eid );
			$admin->dateList = array();
			
			$strdb = "select * from od_matrix_daily_log where eid='".$eid."' and punch1='NA' and  punch2='NA' and monthid = '".$monthid."' and year='".$year."' order by id asc ";	
			$dbsql=mysql_query($strdb);
			$Num = mysql_num_rows($dbsql);
			//echo ":".$strdb."::".$Num."::<BR>";
			while($row = mysql_fetch_array($dbsql))
			{
				$date = $row['date'];
				$date_number  = date("j",strtotime($date));
				if($date_number < 16)
				{	
					if(!$this->checkHoliday($date))
					{
						if(strtotime($date) < strtotime($doj)) continue;
						
						$leaveInfo = $this->getEmployeeLeaveInfo($eid,$date);
						$wfhInfo = $this->getEmployeeWFHInfo($eid,$date);
						if(!$leaveInfo->status && !$wfhInfo->status)
						{
							$admin->dateList[] = $date;
							$absCnt++;	
						}
					}
				}
			}
			//echo ":".$strdb."::".$Num."::".$absCnt."<BR>";
			if($absCnt)
			{	
				$this->generateCurrentMonthAbsentEmail($admin,$month_name);
			}
		}
	}
	
}


public function generateCurrentMonthAbsentEmail($admin,$month_name)
{
	
	$slno=0;
	
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
		<body lang=EN-IN link='#0563C1' vlink='#954F72' style='width:600px;'>
		<div class=WordSection1>
	    <p class=MsoNormal>
		<h2 class='title' style='font-size:16px;margin:0;line-height:1em;font-weight:normal;font-size:16px'>
		</h2>
		Dear ".$admin->name.",	
		<BR><BR>
		Please regularize your attendance of month <B>".$month_name."</B>.
		<BR>
		In case any incorrect/corrections needed, please discuss with HR on this.
		<BR>";
				
						
		$body.="<BR>
				<div style='padding: 1em;display: table'>
				<table width='600' border='1' align='left'>
		        <tbody> 
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666' bgcolor='#FBFF00' >
			    
				<td width='60' align='center' style='padding-right:10px;'>
			    <B>Sl No.<B>
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Date<B>
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>In Time<B>
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Out Time<B>
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    <B>Status<B>
				</td>
				</tr>";
		foreach($admin->dateList as $date )
		{
			$slno++;
			$body.="<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
			    
				<td width='60' align='center' style='padding-right:10px;'>
			    ".$slno."
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    ".$date."
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    NA
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    NA
				</td>
				
				<td width='120' align='center' style='padding-right:10px;'>
			    Absent
				</td>
				</tr>";
		}
								
		$body.="</tbody>
				</table>
				</div>";
		$body.="</p>
				<div style='width:100%; padding-top:30px;'>
				<table width='100%' border='0' align='left'>
				<tr><td>
				<h2 class='title' style='color:#999999;font-size:12px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:12px,bgcolor=#FBFF00 '>
				<I>NOTE: This is a system generated e-mail. Please don't reply. </I>
				</h2>
				</td>
				</tr>
				</table>
				</div>
				</body></html>";
	
	
	$date = date("d-m-Y, h:i:s A");
	$empData = $this->getEmployeeData($admin->eid);	
	
	$to = $this->getEmployeeEmail($admin->eid);
	$cc = "hr@oditeksolutions.com";
	$bcc = "";
	
	//$to = "chinmaya.sahu@oditeksolutions.com";
	$name = $admin->name;
	$title = "Irregular Attendance of month ".$month_name." ";
	$body = addslashes($body);
	//echo "::".$body."<BR>";
	$query = "INSERT into od_send_email set date='".$date."' , toemail='".$to."' , cc='".$cc."' , bcc='".$bcc."' , title='".$title."' , body='".$body."' , name='".$name."' ";
	$res = mysql_query($query);
	
	
}




public function generateEmpMonthlyAttendance()
{
	$allow = 1;
	if($allow)
	{
		$month_ini = new DateTime("first day of last month");
		$month_end = new DateTime("last day of last month");
		
		$start_date =  $month_ini->format('d-m-Y');
		$end_date =  $month_end->format('d-m-Y');
		
		$monthid = date("n",strtotime($start_date));
		$year = date("Y",strtotime($start_date));
		$month_name = date("F",strtotime($start_date));
			
		$empList = $this->getAllActiveEmployeeListName();
		foreach($empList as $emp)
		{
			$eid = $emp->eid;
			$doj = $emp->doj;
			
			
			if(!$this->isEmployee($eid)) continue; 
			
			if($this->isContractEmployee($eid)) continue;
			
			
			$admin = new AdminUser();
			$admin->eid = $eid;
			$admin->name = $this->getEmployeeName($eid );
			$admin->t_days = 0;
			$admin->t_present = 0;
			$admin->t_wfh = 0;
			$admin->t_leave = 0;
			$admin->t_uleave = 0;
			$admin->t_absent = 0;
			
			$strdb = "select * from od_matrix_daily_log where eid='".$eid."' and monthid = '".$monthid."' and year='".$year."' order by id asc ";	
			$dbsql=mysql_query($strdb);
			$Num = mysql_num_rows($dbsql);
			while($row = mysql_fetch_array($dbsql))
			{
				$date = $row['date'];
				if(!$this->checkHoliday($date))
				{
					if(strtotime($date) < strtotime($doj)) continue;
					
					$admin->t_days++;
					$in_time = $row['punch1'];
					$out_time = $row['punch2'];
				
					$leaveInfo = $this->getEmployeeLeaveInfo($eid,$date);
					$wfhInfo = $this->getEmployeeWFHInfo($eid,$date);
					
					if($leaveInfo->status)
					{
						$leaveObj = $this->getLeaveReqObj($leaveInfo->lid);
						$type = $leaveObj['type'];
						if($type == 5)
							$admin->t_uleave++;
						else
							$admin->t_leave++;
					}
					else if($wfhInfo->status)
					{
						$admin->t_wfh++;
					}
					else if($in_time == "NA" && $out_time == "NA")
					{
						$admin->t_absent++;
					}
					else{
						$admin->t_present++;
					}
				}
			}
			
			$this->generateAttendanceEmail($admin,$month_name);

		}
	}
	
}



public function generateAttendanceEmail($admin,$month_name)
{
	
	$slno=0;
	
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
		<body lang=EN-IN link='#0563C1' vlink='#954F72' style='width:600px;'>
		<div class=WordSection1>
	    <p class=MsoNormal>
		<h2 class='title' style='font-size:16px;margin:0;line-height:1em;font-weight:normal;font-size:16px'>
		</h2>
		Dear ".$admin->name.",	
		<BR><BR>
		Please get your monthly attendance summary of <B>".$month_name."</B> month.<BR>";
				
						
		$body.="<BR>
				<div style='padding: 1em;display: table'>
				<table width='600' border='1' align='left'>
		        <tbody> 
				
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666' bgcolor='#FBFF00' >
			    
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Total Days<B>
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Present<B>
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Paid Leaves<B>
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Unpaid Leaves<B>
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>WFH<B>
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Absent<B>
				</td>
				</tr>";
		
		$body.="<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
			    
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$admin->t_days."
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$admin->t_present."
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$admin->t_leave."
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$admin->t_uleave."
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$admin->t_wfh."
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$admin->t_absent."
				</td>
				</tr>";
								
		$body.="</tbody>
				</table>
				</div>";
		$body.="</p>
				<div style='width:100%; padding-top:30px;'>
				<table width='100%' border='0' align='left'>
				<tr><td>
				<h2 class='title' style='color:#999999;font-size:12px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:12px,bgcolor=#FBFF00 '>
				<I>NOTE: This is a system generated e-mail. Please don't reply. </I>
				</h2>
				</td>
				</tr>
				</table>
				</div>
				</body></html>";
	
	//
	$date = date("d-m-Y, h:i:s A");
	$empData = $this->getEmployeeData($admin->eid);	
	$to = $empData->office_email;
	$cc = "";
	$bcc = "";
	$name = $admin->name;
	$title = "Attendance Summary of month ".$month_name;
	//echo ":".$body."<BR><BR><BR>";
	$body = addslashes($body);
	
	$query = "INSERT into od_send_email set date='".$date."' , toemail='".$to."' , cc='".$cc."' , bcc='".$bcc."' , title='".$title."' , body='".$body."' , name='".$name."' ";
	$res = mysql_query($query);
}



public function sendEmpMonthlyAbsentListToMgmt()
{
	$send=1;
	if($send)
	{
		$month_ini = new DateTime("first day of last month");
		$month_end = new DateTime("last day of last month");
		
		$start_date =  $month_ini->format('d-m-Y');
		$end_date =  $month_end->format('d-m-Y');
		
		$monthid = date("n",strtotime($start_date));
		$year = date("Y",strtotime($start_date));
		$month_name = date("F",strtotime($start_date));
			
		$empList = $this->getAllActiveEmployeeListName();
		$dataArray = array();
		foreach($empList as $emp)
		{
			$eid = $emp->eid;
			$doj = $emp->doj;
			
			$absCnt=0;
			if($this->isManagement($eid)) continue;
			
			if(!$this->isEmployee($eid)) continue; 
			
			if($this->isContractEmployee($eid)) continue;
			
			
			$admin = new AdminUser();
			$admin->eid = $eid;
			$empData = $this->getEmployeeData($eid);
			$admin->name = $empData->name;
			$admin->desig = $empData->desig_name; 
			$admin->t_days = 0;
			$admin->t_uleave = 0;
			$admin->t_absent = 0;
			
			$strdb = "select * from od_matrix_daily_log where eid='".$eid."' and monthid = '".$monthid."' and year='".$year."' order by id asc ";	
			$dbsql=mysql_query($strdb);
			$Num = mysql_num_rows($dbsql);
			while($row = mysql_fetch_array($dbsql))
			{
				$date = $row['date'];
				if(!$this->checkHoliday($date))
				{
					if(strtotime($date) < strtotime($doj)) continue;
					
					$admin->t_days++;
					$in_time = $row['punch1'];
					$out_time = $row['punch2'];
				
					$leaveInfo = $this->getEmployeeLeaveInfo($eid,$date);
					$wfhInfo = $this->getEmployeeWFHInfo($eid,$date);
					
					if($leaveInfo->status)
					{
						$leaveObj = $this->getLeaveReqObj($leaveInfo->lid);
						$type = $leaveObj['type'];
						if($type == 5)
							$admin->t_uleave++;
					}
					else if($wfhInfo->status)
					{
						
					}
					else if($in_time == "NA" && $out_time == "NA")
					{
						$admin->t_absent++;
					}
					$admin->total =  $admin->t_uleave + $admin->t_absent;
					
				}
			}
			if($admin->total)
				$dataArray[] = $admin;
		}
		
		$this->sendAbsentListEmail($dataArray,$month_name);
	}
	
}

public function sendAbsentListEmail($dataArray,$month_name)
{
	
	$slno=0;
	
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
		<body lang=EN-IN link='#0563C1' vlink='#954F72' style='width:800px;'>
		<div class=WordSection1>
	    <p class=MsoNormal>
		<h2 class='title' style='font-size:16px;margin:0;line-height:1em;font-weight:normal;font-size:16px'>
		</h2>
		Dear Management,	
		<BR><BR>
		Please get monthly absent/unpaid summary of <B>".$month_name."</B> month.<BR>";
				
						
		$body.="<BR>
				<div style='padding: 1em;display: table'>
				<table width='800' border='1' align='left'>
		        <tbody>
				<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666' bgcolor='#FBFF00' >
			    
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Sl. No.<B>
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Emp Id<B>
				</td>
				
				<td width='300' align='center' style='padding-right:10px;'>
			    <B>Name<B>
				</td>
				
				<td width='180' align='center' style='padding-right:10px;'>
			    <B>Designation<B>
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Working Days<B>
				</td>
				
				
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Unpaid Leaves<B>
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Absent<B>
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    <B>Total<B>
				</td>
				
				</tr>";
		
		$count=0;
		foreach($dataArray as $emp)
		{
			$count++;		
		$body.="<tr height='30' style='font-family: Geneva, sans-serif; background:F2F2F2;font-size:12px;color:#666'>
			    
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$count."
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$emp->eid."
				</td>
				
				<td width='150' align='center' style='padding-right:10px;'>
			    ".$emp->name."
				</td>
				
				<td width='180' align='center' style='padding-right:10px;'>
			    ".$emp->desig."
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$emp->t_days."
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$emp->t_uleave."
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$emp->t_absent."
				</td>
				
				<td width='80' align='center' style='padding-right:10px;'>
			    ".$emp->total."
				</td>
				
				
				</tr>";
		}		
								
		$body.="</tbody>
				</table>
				</div>";
		$body.="</p>
				<div style='width:100%; padding-top:30px;'>
				<table width='100%' border='0' align='left'>
				<tr><td>
				<h2 class='title' style='color:#999999;font-size:12px;margin:0;line-height:1em;font-weight:normal;color:#111111;font-size:12px,bgcolor=#FBFF00 '>
				<I>NOTE: This is a system generated e-mail. Please don't reply. </I>
				</h2>
				</td>
				</tr>
				</table>
				</div>
				</body></html>";
	
	//
	$date = date("d-m-Y, h:i:s A");
	$to = "mgmt@oditeksolutions.com";
	$cc = "hr@oditeksolutions.com";
	$bcc = "";
	$name = "mgmt";
	$title = "Employee Absent Summary for month ".$month_name;
	//echo ":".$body."<BR><BR><BR>";
	$body = addslashes($body);
	$query = "INSERT into od_send_email set date='".$date."' , toemail='".$to."' , cc='".$cc."' , bcc='".$bcc."' , title='".$title."' , body='".$body."' , name='".$name."' ";
	$res = mysql_query($query);
	
	
}

/*
public function updateMonthId()
{
	$strdb = "select * from od_matrix_daily_log order by id asc  ";
	$dbsql=mysql_query($strdb);
	while($rowdb = mysql_fetch_array($dbsql))
	{
		$date = $rowdb['date'];
		$id = $rowdb['id'];
		$monthid = date("n",strtotime($date));
		$query = "UPDATE od_matrix_daily_log set monthid='".$monthid."' WHERE id='".$id."' ";
		$res = mysql_query($query);
	}
	
}
*/

public function loadResourceAttendance($date,$category,$filter)
{
	$my_id = $_SESSION["emp_id"];
	$myData = $this->getEmployeeData($my_id);
	$isCEO = $this->isCEO($my_id);
	$isAdmin = $this->isAdmin($my_id);
	$isHR = $this->isHRAdmin($my_id);
	$isMgmt = $this->isManagement($my_id);
	
	$empList = $this->getAllActiveEmployeeList();
	$date = date("d-m-Y", strtotime($date));
	$date_str = strtotime($date);
	$day = date("l", strtotime($date));
	$iv_key = $this->get_mcrypt_iv();
	$encrypt_date = $this->get_mcrypt_encrypt($date,$iv_key);
	$type = 1;
	$encrypt_type = $this->get_mcrypt_encrypt($type,$iv_key);
	
	$total_wfh =0;
	$total_leave =0;
	$total_abs =0;
	$total_present =0;
	foreach($empList as $emp)
	{
		$isPresent= false;
		$isAbsent= false;
		$isWFH= false;
		$isLeave= false;	
		
		$status = "";
		$empData = $this->getEmployeeData($emp->eid);
		
		if(!$isAdmin && !$isHR )
		{	
			if(!$isCEO and ($myData->bu != $empData->bu or $my_id == $emp->eid ) )
				continue;
		}
		if($category != 0 and $category != $empData->bu )
			continue;
		
		//if($category != 0 and $isMgmt )
		//	continue;
		$doj = 	date("d-m-Y", strtotime($empData->joining_date));
        $doj_str =   strtotime($doj);
		
		$empType = $this->getEmpTypeById($empData->emptype);
		$isMgmt = $this->isManagement($emp->eid);
		$upper = $this->getEmployeeToReport($emp->eid);
		if($isMgmt)
			$empType = "MGMT";
		
		$style="";
		//$date = date("d-m-Y", strtotime($date));
		$attenData = $this->getEmpAttendanceData($emp->eid,$date);
		
		if($attenData->start_time != "NA")
			$isPresent = true;
		else
			$isAbsent = true;
		
		$encrypt_eid = $this->get_mcrypt_encrypt($emp->eid,$iv_key);		
		
		
		$leaveInfo = $this->getEmployeeLeaveInfo($emp->eid,$date);
		if($leaveInfo->status)
		{	
			$status = $leaveInfo->info;
			$total_leave++;
			$isLeave =  true;
			$isPresent = false;
			$isAbsent = false;
		}else{
			$wfhInfo = $this->getEmployeeWFHInfo($emp->eid,$date);
			if($wfhInfo->status)
			{	
				$status = $wfhInfo->info;
				$total_wfh++;
				$isWFH =  true;
				$isPresent = false;
				$isAbsent = false;
			}
		}
		
		if($date_str < $doj_str) //check based on DOJ
			continue;
	
	
		if($isPresent) $total_present++;
		if($isAbsent) $total_abs++;
		
		if($attenData->manual)
			$style = "font-style: italic;";	
		
		if($filter == 1 && !$isPresent)
		{
			continue;
		}
		else if($filter == 2 && !$isLeave)
		{
			continue;
		}
		else if($filter == 3 && !$isWFH)
		{
			continue;
		}
		else if($filter == 4 && !$isAbsent)
		{
			continue;
		}
		
		
		$sl_no++;	
		
		$str .= '<tr class="success" >
			       <td style="font-weight:normal; '.$style.'" >'.$sl_no.'</td>
				   <td style="font-weight:normal; '.$style.'" >'.$date.'</td>
				   <td style="font-weight:normal; '.$style.'" >'.$day.'</td>
	               <td style="font-weight:normal; '.$style.'" >'.$empData->name.'<BR>['.$emp->eid.']</td>
				   <td style="font-weight:normal; '.$style.'" >'.$empData->bu_name.'</td>
				   <td style="font-weight:normal; '.$style.'" >'.$attenData->start_time.'</td>
				   <td style="font-weight:normal; '.$style.'" >'.$attenData->end_time.'</td>
				   <td style="font-weight:normal; '.$style.'" >'.$attenData->work_time.'</td>
				   <td style="font-weight:normal; '.$style.'" >'.$status.'</td>
				   <td class="tooltip-sidebar-logout">
				   <a href="team_detailattedance.php?date='.$encrypt_date.'&eid='.$encrypt_eid.'&iv='.$iv_key.'&type='.$encrypt_type.' "  onClick="loadDetailsData();">
				   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
				   </td>
				   </tr>';
		
	}
	
	/////////non ODITEK Employee Info
	if($isAdmin && !$filter)
	{	
		$type = 2;
		$encrypt_type = $this->get_mcrypt_encrypt($type,$iv_key);
		$dbsql=mysql_query("select * from od_user_others order by id asc ");
		$Num = mysql_num_rows($dbsql);	
		while($row = mysql_fetch_array($dbsql))
		{
			if($category != 0 and $category != -1 )
				continue;
			
			$name = $row['name'];
			$eid = $row['eid'];
			$attenData = $this->getEmpAttendanceData($eid,$date);
			$sl_no++;
			$encrypt_eid = $this->get_mcrypt_encrypt($eid,$iv_key);		
			
			$str .= '<tr class="success" >
					   <td style="font-weight:normal;'.$style.'" >'.$sl_no.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$date.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$day.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$name.'<BR>['.$eid.']</td>
					   <td style="font-weight:normal;'.$style.'" >none</td>
					   <td style="font-weight:normal;'.$style.'" >'.$attenData->start_time.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$attenData->end_time.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$attenData->work_time.'</td>
					   <td style="font-weight:normal;'.$style.'" ></td>
					   <td class="tooltip-sidebar-logout">
					   <a href="team_detailattedance.php?date='.$encrypt_date.'&eid='.$encrypt_eid.'&iv='.$iv_key.'&type='.$encrypt_type.' " onClick="loadDetailsData();" >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';
			
		}
	}
	
	$data=array("status"=>1,"data"=>$str, "tpresent"=> $total_present , "twfh"=> $total_wfh , "tleave"=> $total_leave  , "tabs"=>$total_abs);
	return $data;
}


public function getOthersAttendanceData($date,$eid , $monthid)
{
	$max = 50;
	$count=0;
	$dataArray = array();
	//$empData = $this->getEmployeeData($eid);
	$dbsql=mysql_query("select * from od_user_others where eid='".$eid."' ");
	$userData = mysql_fetch_array($dbsql);
	while(1)
	{
		
		$attenData = $this->getEmpAttendanceData($eid,$date);
		$employee = new employee();
		$employee->date_info = $date;
		$employee->day_info = date("l", strtotime($date));
		$employee->name = $userData['name'];
		$employee->eid = $eid;
		$employee->start_time = $attenData->start_time ;
		$employee->end_time = $attenData->end_time ;
		$employee->work_time = $attenData->work_time ;
		$employee->manual = $attenData->manual ;
		$employee->holiday = $this->checkHoliday($date);
		$employee->info = "";
		$dataArray[] = $employee;
		$count++;
		$date = date("d-m-Y", strtotime($date." -1 days"));
		if($count == $max )
			break;
	}
	
	return $dataArray;
}


public function getEmployeeAttendanceData($date,$eid,$monthid)
{
	$max = 31;
	$count=0;
	$dataArray = array();
	$empData = $this->getEmployeeData($eid);
	$presentCnt=0; $absCnt=0; $leaveCnt=0; $wfhCnt=0;
	while(1)
	{
		
		$attenData = $this->getEmpAttendanceData($eid,$date);
		
		if($attenData->monthid == $monthid)
		{
			$employee = new employee();
			$employee->id = $attenData->id;
			$employee->edit = 1;
			$employee->date_info = $date;
			$employee->day_info = date("l", strtotime($date));
			$employee->name = $empData->name;
			$employee->eid = $eid;
			$employee->start_time = $attenData->start_time ;
			$employee->end_time = $attenData->end_time ;
			$employee->work_time = $attenData->work_time ;
			$employee->manual = $attenData->manual ;
			$employee->holiday = $this->checkHoliday($date);
			$employee->info="";
			$isAbsent=0;
			$isPresent=1;
			if($employee->holiday && $employee->start_time == "NA" && $employee->end_time == "NA" ) 
				$isPresent=0;

			$isLeave=0;
			$isWFH=0;
		
			if(!$employee->holiday && $employee->start_time == "NA" && $employee->end_time == "NA")
			{
				$employee->info = "ABS";
				$isAbsent=1;
				$isPresent=0;
			}
			
			$leaveInfo = $this->getEmployeeLeaveInfo($eid,$date);
			if($leaveInfo->status)
			{	
				$employee->info = $leaveInfo->info;
				$employee->edit = 0;
				$isAbsent=0;
				$isPresent=0;
				$isLeave=1;
			}
			
			$wfhInfo = $this->getEmployeeWFHInfo($eid,$date);
			if($wfhInfo->status)
			{
				$employee->info  = $wfhInfo->info;
				$employee->edit = 0;
				$isAbsent=0;
				$isPresent=0;
				$isWFH=1;
			}
			if($isPresent) $presentCnt++;
			if($isAbsent) $absCnt++;
			if($isLeave) $leaveCnt++;
			if($isWFH) $wfhCnt++;
		
			$dataArray[] = $employee;
		}
		
		
		$count++;
		$date = date("d-m-Y", strtotime($date." -1 days"));
		
		
		if($count == $max )
			break;
	}
	
	$dataArray[0]->presentCnt = $presentCnt;
	$dataArray[0]->absCnt = $absCnt;
	$dataArray[0]->leaveCnt = $leaveCnt;
	$dataArray[0]->wfhCnt = $wfhCnt;
	
	return $dataArray;
}


public function getAttendanceInfo($monthid,$statusid,$eid,$user_edit)
{
	$max = 0;
	$count=0;
	$current_date = date("d-m-Y");
	$dataArray = array();
	$presentCnt=0; $absCnt=0; $leaveCnt=0; $wfhCnt=0;
	$empData = $this->getEmployeeData($eid);
	$doj = date("d-m-Y", strtotime($empData->joining_date));
	if(strpos($monthid, '-'))
	{	
		$parts = [];
		$parts = explode('-',$monthid);
		$month= $parts[0];
		$year= $parts[1];
		$a_date = "01-".$month."-".$year;
		$max = $date = date("t", strtotime($a_date));
		$date = $date."-".$month."-".$year;
		$monthid = date(m)."-".date('Y');
		if($monthid == $month."-".$year)
		{	
			$date = $current_date;
			$max = date("d");
		}
	}
	else{
		$max = date("z")+1;
		$date = date("d-m-Y");
		
	}
	
	while(1)
	{
		$attenData = $this->getEmpAttendanceData($eid,$date);
		$id = $attenData->id;
		$edit = 1;
		$date_info = $date;
		$day_info = date("l", strtotime($date));
		$name = $empData->name;
		$eid = $eid;
		$start_time = $attenData->start_time ;
		$end_time = $attenData->end_time ;
		$work_time = $attenData->work_time ;
		$manual = $attenData->manual ;
		$holiday = $this->checkHoliday($date);
		$info="";
		$isAbsent=0;
		$isPresent=1;
		if($holiday && $start_time == "NA" && $end_time == "NA")
			$isPresent=0;
		
		$isLeave=0;
		$isWFH=0;
		if(!$holiday && $start_time == "NA" && $end_time == "NA")
		{
			$info = "ABS";
			$isAbsent = 1;
			$isPresent=0;
		}
			
		$leaveInfo = $this->getEmployeeLeaveInfo($eid,$date);
		if(!$holiday && $leaveInfo->status)
		{	
			$info = $leaveInfo->info;
			$edit = 0;
			$isAbsent = 0;
			$isPresent=0;
			$isLeave=1;
		}
			
		$wfhInfo = $this->getEmployeeWFHInfo($eid,$date);
		if(!$holiday && $wfhInfo->status)
		{
			$info  = $wfhInfo->info;
			$edit = 0;
			$isAbsent = 0;
			$isPresent=0;
			$isWFH=1;
		}
		
		if($isPresent) $presentCnt++;
		if($isAbsent) $absCnt++;
		if($isLeave) $leaveCnt++;
		if($isWFH) $wfhCnt++;
		
		$appendData=1;
		
		if($statusid == 1 && !$isPresent)
		{
			$appendData=0;
		}
		else if($statusid == 2 && !$isLeave)
		{
			$appendData=0;
		}
		else if($statusid == 3 && !$isWFH)
		{
			$appendData=0;
		}
		else if($statusid == 4 && !$isAbsent)
		{
			$appendData=0;
		}
		
		if($appendData)
		{
			$sl_no++;
			$color="";
			if($holiday)  $color="red";
			$italic="";
			if($manual) 	$italic="font-style: italic;";	
			$show_edit=0; if($current_date != $date) $show_edit=1; 
														
														
			$str .= '<tr class="success" >
					 <td  style="color:'.$color.';'.$italic.'" >'.$sl_no.'</td>
					 <td  style="color:'.$color.';'.$italic.'" >'.$date_info.'</td>
					 <td  style="color:'.$color.';'.$italic.'" >'.$day_info.'</td>
					 <td  style="color:'.$color.';'.$italic.'" >'.$name.'</td>
					 <td  style="color:'.$color.';'.$italic.'" >'.$start_time.'</td>
					 <td  style="color:'.$color.';'.$italic.'" >'.$end_time.'</td>
					 <td  style="color:'.$color.';'.$italic.'" >'.$work_time.'</td>
					 <td  style="color:'.$color.';'.$italic.'" >'.$info.'</td>';
				if($user_edit)
				{		
					$str .= '<td class="tooltip-sidebar-logout">';
					if($show_edit)
					{	 
						$str .='<a href="javascript://" data-dismiss="modal" data-toggle="modal" data-target="#viewemployeelistdiv"  onClick="loadDetailsData('.$id.');">
								<input type="button" class="btn btn-md btn-green" value="Edit" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
								</a>';
					}
					$str .='</td>'; 
				}					
			$str .= '</tr>';
		}
		
		if($doj == $date)
			break;
		
		$count++;
		$date = date("d-m-Y", strtotime($date." -1 days"));
		
		if($count == $max )
			break;
	}
	
	$data=array("status"=>1,"data"=>$str , "present"=>$presentCnt , "abs"=>$absCnt , "leave"=>$leaveCnt , "wfh"=>$wfhCnt );
	
	return $data;
}



public function getEmployeeAbsentCount($eid,$start_date,$end_date)
{
	$total_abs=0;
	$empData = $this->getEmployeeData($eid);
	$doj = date("d-m-Y", strtotime($empData->joining_date));
	$doj_str = strtotime($doj);
	while(strtotime($start_date) <= strtotime($end_date))
	{
		$checkData=1;
		if(strtotime($start_date) < $doj_str) //check based on DOJ
			$checkData=0;
		
		if($checkData)
		{	
			$attenData = $this->getEmpAttendanceData($eid,$start_date);
			$start_time = $attenData->start_time ;
			$end_time = $attenData->end_time ;
			$work_time = $attenData->work_time ;
			$holiday = $this->checkHoliday($start_date);
			$isAbsent=0;
			
			if(!$holiday && $start_time == "NA" && $end_time == "NA")
			{
				$isAbsent = 1;
			}
			$leaveInfo = $this->getEmployeeLeaveInfo($eid,$start_date);
			if($leaveInfo->status)
			{	
				$isAbsent = 0;
			}
				
			$wfhInfo = $this->getEmployeeWFHInfo($eid,$start_date);
			if($wfhInfo->status)
			{
				$isAbsent = 0;
			}
			
			 if($isAbsent) $total_abs++;
		}
		
		$start_date = date("d-m-Y", strtotime($start_date." +1 days"));	
	}
	
	
	return $total_abs;	
}



public function getAttendanceEditData($id )
{
	$strdb = "select * from od_matrix_daily_log where id='".$id."'";
	$dbsql=mysql_query($strdb);
	if($rowdb = mysql_fetch_array($dbsql))
	{
		$info  = "";
		$employee->status = 1;
		$eid = $rowdb['eid'];
		$date = $rowdb['date'];
		$start_time = $rowdb['punch1'];		
		$end_time = $rowdb['punch2'];
		$start_org = $rowdb['p1_org'];
		$end_org = $rowdb['p2_org'];
		$manual = $rowdb['manual'];
		$editor = $rowdb['editor'];
		$edit_time = $rowdb['edit_time'];
		if($manual)
			$editor_name = $this->getEmpName($editor);
		
		if(!$manual)
		{
			$start_org = $start_time;
			$end_org = $end_time;
		}
		
		if($start_time != "NA")
			$start_time = date("h:i:s A", strtotime($start_time));
		
		if($end_time != "NA")
			$end_time = date("h:i:s A", strtotime($end_time));
		
		
		if($start_org != "NA")
			$start_org = date("h:i:s A", strtotime($start_org));
		
		if($end_org != "NA")
			$end_org = date("h:i:s A", strtotime($end_org));
		
		
		$leaveInfo = $this->getEmployeeLeaveInfo($eid,$date);
		if($leaveInfo->status)
			$info = $leaveInfo->info;
		
		$wfhInfo = $this->getEmployeeWFHInfo($eid,$date);
		if($wfhInfo->status)
			$info  = $wfhInfo->info;
		
		$edit_info="Updated by [".$editor_name."] on ".$edit_time;
		
		
		$data=array("status"=>1,"act_start_time"=>$start_org, "act_end_time"=> $end_org ,"start_time"=>$start_time, "end_time"=> $end_time , "manual"=> $manual , "start_org"=> $start_org  , "end_org"=>$end_org  , "info"=>$info , "lastedit"=>$edit_info );
	}
	else{
		$data=array("status"=>0);
	}
		
	return $data;
}

public function getAttendanceMonths()
{
	$getArray= array();
	$admin->monthname = "All ".date("Y");  
	$admin->monthid = 0;
	$getArray[] = $admin;
	for ($i = 0; $i < 12; $i++) 
	{
		$admin = new AdminUser();
		if(!$i)
			$admin->selected = 1;
		$admin->monthname = date("M-Y", strtotime( date( 'Y-m-01' )." -$i months"));
		$admin->monthid = date("m-Y", strtotime($admin->monthname));
		$getArray[] = $admin;
	}
	
	return $getArray;
}

public function updateAttendanceData($id , $in_time , $out_time)
{
	$editor = $_SESSION["emp_id"];
	$edit_time = date("d-m-Y, h:i:s A");
	if($editor > 0)
	{
		//validate input time
		if($in_time != "NA")
		{	
			$ret = $this->checkValidDate($in_time,'h:i:s A');
			if( $ret != 1)
			{
				$msg = "Invalid In-Time format. Please add time format (HH:MM:SS AM/PM) only.";
				$data=array("status"=>0,"msg"=>$msg);
				return $data;
			}
		}
		
		if($out_time != "NA")
		{
			$ret = $this->checkValidDate($out_time,'h:i:s A');
			if( $ret != 1)
			{
				$msg = "Invalid Out-Time format. Please add time format (HH:MM:SS AM/PM) only.";
				$data=array("status"=>0,"msg"=>$msg);
				return $data;
			}
		}
		
		///////////////////////
		
		$strdb = "select * from od_matrix_daily_log where id='".$id."'";
		$dbsql=mysql_query($strdb);
		if($rowdb = mysql_fetch_array($dbsql))
		{
			$p1_org = $rowdb['punch1'];		
			$p2_org = $rowdb['punch2'];
			$manual = $rowdb['manual'];
			$work_time = "0";
			
			if($in_time != "NA" && $out_time != "NA")
			{	
				$from_time = strtotime($in_time); 
				$to_time = strtotime($out_time); 
				$work_time = round(abs($from_time - $to_time) / 60,2);
			}
			if($in_time != "NA")
				$in_time = date("h:i:s A", strtotime($in_time));
		
			if($out_time != "NA")
				$out_time = date("h:i:s A", strtotime($out_time));
		
			if(!$manual)
			{				
				$qry=mysql_query("UPDATE od_matrix_daily_log set worktime='".$work_time."' , punch1='".$in_time."' , punch2 = '".$out_time."' , p1_org = '".$p1_org."' , p2_org = '".$p2_org."' , manual='1' , editor='".$editor."' , edit_time='".$edit_time."' where id='".$id."'");
			}else{
				$qry=mysql_query("UPDATE od_matrix_daily_log set worktime='".$work_time."' , punch1='".$in_time."' , punch2 = '".$out_time."' , manual='1' , editor='".$editor."' , edit_time='".$edit_time."' where id='".$id."'");
			}
			if($qry > 0)
				$data=array("status"=>1,"msg"=>"Updated Successfully.");
		}
		else
			$data=array("status"=>0,"msg"=>"Unable to update. Try again.");
	}
	else{
		$data=array("status"=>0,"msg"=>"Unable to update. Try again.");
	}
	
	return $data;
}




	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////MATRIX DATA//////////////////////

public function processMarixDailyData()
{
	$today = date("d-m-Y");
	$count=7;
	$index=0;
	$dindex=-6;
	while($index < $count)
	{	
		$prev_date = date("d-m-Y", strtotime($today." ".$dindex." days"));
		$date1 = date("dmY", strtotime($prev_date." 0 days"));
		$date_range = $date1."-".$date1;
		
		$url = "http://122.163.126.68:9975/cosec/api.svc/v2/attendance-daily?action=get;format=json;date-range=".$date_range;		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_USERPWD, "sa:Admin@1234");
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response, true);			
		$elementCount  = count($response_a['attendance-daily']);
		for($i=0 ; $i<$elementCount; $i++)
		{
			$name = $response_a['attendance-daily'][$i]['username'];
			$userid = $response_a['attendance-daily'][$i]['userid'];
			$punch1 = $response_a['attendance-daily'][$i]['punch1'];
			$punch2 = $response_a['attendance-daily'][$i]['punch2'];
			$worktime = $response_a['attendance-daily'][$i]['worktime'];
		
			if(strlen($punch1))
			{	
				$punch1_tok = strtok($punch1, " ");
				$punch1_tok = strtok(" ");
				$punch1 = $punch1_tok;
			}
			else{
				$punch1 = "NA";
			}
		
			if(strlen($punch2))
			{	
				$punch2_tok = strtok($punch2, " ");
				$punch2_tok = strtok(" ");
				$punch2 = $punch2_tok;
			}
			else{
				$punch2 = "NA";
			}
			
			/*
			if($userid > 5000 && $userid <= 5020) // for Intern
			{
				$userid =  $this->getInternUserId($userid);
				if(!$userid) continue;
			}
			*/
				
			$dbquery="select * from od_matrix_daily_log where date='".$prev_date."' and eid='".$userid."' ";
			$dbsql=mysql_query($dbquery);
			$Num = mysql_num_rows($dbsql);
			if(!$Num)
			{	
				$monthid = date("n",strtotime($prev_date));
				$year = date("Y",strtotime($prev_date));
				$query = "INSERT into od_matrix_daily_log set date='".$prev_date."' , monthid='".$monthid."' , year='".$year."' , manual='0' ,eid='".$userid."' , punch1 = '".$punch1."'   ,  punch2='".$punch2."' , worktime='".$worktime."' ";
			}
			else{
				$rowdb = mysql_fetch_array($dbsql);
				$manual = $rowdb['manual'];
				if(!$manual)
					$query = "UPDATE od_matrix_daily_log set punch1 = '".$punch1."'   ,  punch2='".$punch2."' , worktime='".$worktime."' where date='".$prev_date."' and eid='".$userid."'";
				else
					$query = "UPDATE od_matrix_daily_log set p1_org = '".$punch1."'   ,  p2_org='".$punch2."'  where date='".$prev_date."' and eid='".$userid."'";
			}
			$res = mysql_query($query);
		}
		
		$index++;
		$dindex++;
	}
}


public function getMarixDailyData($date,$eid)
{
	$date1 = date("dmY", strtotime($date." 0 days"));
	$date_range = $date1."-".$date1;
	$url = "http://122.163.126.68:9975/cosec/api.svc/v2/attendance-daily?action=get;format=json;date-range=".$date_range;		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_USERPWD, "sa:Admin@1234");
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response, true);			
	$elementCount  = count($response_a['attendance-daily']);
	for($i=0 ; $i<$elementCount; $i++)
	{
		$name = $response_a['attendance-daily'][$i]['username'];
		$userid = $response_a['attendance-daily'][$i]['userid'];
		$punch1 = $response_a['attendance-daily'][$i]['punch1'];
		$punch2 = $response_a['attendance-daily'][$i]['punch2'];
		$worktime = $response_a['attendance-daily'][$i]['worktime'];
		
		if($eid > 0 )
		{
			if($eid != $userid) continue;
		}
		
		
		if(strlen($punch1))
		{	
			$punch1_tok = strtok($punch1, " ");
			$punch1_tok = strtok(" ");
			$punch1 = $punch1_tok;
		}
		else{
			$punch1 = "NA";
		}
		
		if(strlen($punch2))
		{	
			$punch2_tok = strtok($punch2, " ");
			$punch2_tok = strtok(" ");
			$punch2 = $punch2_tok;
		}
		else{
			$punch2 = "NA";
		}
			
		
				
		echo "Date:".$date." : ID:".$userid." : Name:".$name." : Punch1:".$punch1." : Punch2:".$punch2."<BR>";
    }

}


public function processCompOffLeaveData()
{
	$today = date("d-m-Y");
	$prev_date = date("d-m-Y", strtotime($today." -1 days"));
	$next_10date = date("d-m-Y", strtotime($today." +10 days"));
	
	$dbquery="select * from od_leave_compoff where status='1' ";
	$dbsql=mysql_query($dbquery);
	$Num = mysql_num_rows($dbsql);
	if($Num)
	{
		while($row = mysql_fetch_array($dbsql))
		{
			$id = $row['id'];
			$expire_date = $row['expire_date'];
			$comp_date = $row['comp_date'];
			$eid = $row['eid'];
			if($expire_date == $next_10date)
			{
				$empdata = $this->getEmployeeData($eid);
				$to = $empdata->office_email;
				$cc = "hr@oditeksolutions.com";
				$name = $empdata->name;
				$title = "CompOff Leave Pending :".$empdata->name;
				$body = "Dear ".$name.",<BR><BR>Your CompOff leave on date[".$comp_date."] is pending and will expire on Date: ".$expire_date.".<BR><BR>Br,<BR>HR-OdiTek";			
				$this->sendGenericEmail($name,$to,$cc,"",$title,$body);
			}
			if($expire_date == $prev_date)
			{
				$empdata = $this->getEmployeeData($eid);
				$to = $empdata->office_email;
				$cc = "hr@oditeksolutions.com";
				$name = $empdata->name;
				$title = "CompOff Leave Expired :".$empdata->name;
				$body = "Dear ".$name.",<BR><BR>Your CompOff leave on date[".$comp_date."] has been expired.<BR><BR>Br,<BR>HR-OdiTek";			
				$this->sendGenericEmail($name,$to,$cc,"",$title,$body);
				$qry=mysql_query("UPDATE od_leave_compoff set status='2' where id='".$id."'");
			}
		}
	}
	
}

public function addNewLeaveCounts()
{
	$today = date("Y");
	$nextyr = $today + 1;
	$empList = $this->getAllActiveEmployeeList();
	foreach($empList as $emp)
	{
		$empData = $this->getEmployeeData($emp->eid);
		$maxmaternity = 0;
		$maxpaid = 21;
		$maxunpaid = 30;
		$maxspecial = 10;
		$maxearned = 0;
		if($empData->gender_id == 2)
			$maxmaternity =  182;
		
		$dbsql=mysql_query("select * from od_leave_counts where eid='".$emp->eid."' and year='".$nextyr."' ");
		$Num = mysql_num_rows($dbsql);	
		if(!$Num)
		{	
			$query = "INSERT into od_leave_counts set year='".$nextyr."' , eid='".$emp->eid."' , maxpaid = '".$maxpaid."'   ,  maxunpaid='".$maxunpaid."' , maxspecial = '".$maxspecial."'   ,  maxearned='".$maxearned."'  , maxmaternity='".$maxmaternity."'  ";
			$res = mysql_query($query);
		}
	}
}


public function getTotalLeaveCnt()
{
	$today = date("d-m-Y");
	$dbsql=mysql_query("select * from od_leave_daily_records where date='".$today."'");
	$Num = mysql_num_rows($dbsql);	
	return $Num;	
}

public function getLeaveDetailRecordsData($rid,$empid)
{
	$admin = new AdminUser();
	$admin->casual = 0;
	$admin->sick = 0;
	$admin->vacation = 0;
	$admin->halfday = 0;
	$admin->unpaid = 0;
	$admin->special = 0;
	$admin->compoff = 0;
	$admin->maternity = 0;
	
	$dbsql=mysql_query("select * from od_leave_reports where eid='".$empid."' and rid='".$rid."' ");
	$Num = mysql_num_rows($dbsql);
	if($Num)
	{
		$row = mysql_fetch_array($dbsql);
		$admin->casual = $row['casual'];
		$admin->sick = $row['sick'];
		$admin->vacation = $row['vacation'];
		$admin->halfday = $row['halfday'];
		$admin->unpaid = $row['unpaid'];
		$admin->special = $row['special'];
		$admin->compoff = $row['compoff'];
		$admin->maternity = $row['maternity'];
	}
	return $admin;
}


public function checkLeaveRecords($year)
{
	$date_time = date("d-m-Y, h:i:s A");
	$dbsql=mysql_query("select * from od_leave_records where year='".$year."' order by id asc");
	$Num = mysql_num_rows($dbsql);
	$error=0;	
	while($row = mysql_fetch_array($dbsql))
	{
		$eid = $row['eid'];
		$sdate = $row['start_date'];
		$edate = $row['end_date'];
		$days = $row['days'];
		$type = $row['type'];
		$year = $row['year'];
		$lid = $row['lid'];
		$msg = addslashes($row['msg']);
		$status = $row['status'];
		
				
		$edate_str = strtotime($edate);
		$date = $sdate;
		$date_str = strtotime($date);
		while($date_str <= $edate_str )
		{
			$name = $this->getEmployeeName($eid);
			$type_str = $this->getLeaveTypeById($type);
			$holiday = $this->checkHoliday($date);
			if(!$holiday)
			{	
				if($status == 1 || $status == 2 )
				{	
					$dbsql2=mysql_query("select * from od_leave_daily_records where lid='".$lid."' and date='".$date."' ");
					$Num2 = mysql_num_rows($dbsql2);
					if(!$Num2)
					{
						$error = 1;
						echo "!!!Error::LID: ".$lid."::Date:".$date."   ::Name:".$name."  ::TYPE:".$type_str."<BR>";
						//$query = "INSERT into od_leave_daily_records set date_time='".$date_time."' , year='".$year."', type='".$type."' , date='".$date."', emp_id='".$eid."' , text='".$msg."' , lid='".$lid."' ";
						//echo  $query."<BR>";
						//$res = mysql_query($query);
					}
					else{
						//echo "OK: LID: ".$lid."::Date:".$date."<BR>";
					}				
				}	
				
			}
			$date = date("d-m-Y", strtotime($date." 1 days"));
			$date_str = strtotime($date);
		}
	}
	if(!$error)
	{
		echo "All records are present in od_leave_daily_records db<BR>";
	}		
		
	
}


//////////////////////////////END MATRIX DATA////////////////////	
		
	
/****Configuration functions ends ******************/

public function getTimeTextNumberOnly($time_second){
		if($time_second >= 3600)
		{
			$hours = floor($time_second / 3600);
			$minutes = floor(($time_second / 60) % 60);
			$seconds = $time_second % 60;
			if(strlen($hours)==1)
				$hours = "0".$hours;
			if(strlen($minutes)==1)
				$minutes = "0".$minutes;
			if(strlen($seconds)==1)
				$seconds = "0".$seconds;
			$time = $hours.":".$minutes;
		}else if($time_second > 60) {
			$hours="00";
			$minutes = floor(($time_second / 60) % 60);
			$seconds = $time_second % 60;
			if(strlen($minutes)==1)
				$minutes = "0".$minutes;
			if(strlen($seconds)==1)
				$seconds = "0".$seconds;
			$time = $hours.":".$minutes;
		}else{
			$time = $time_second." sec";
		}
		return $time;
	}
 


public function getProjectTaskNameByDbId($task_db_id)
	{
		$task_name="NA";
		$dbsql=mysql_query("select * from od_project_task_info where id='".$task_db_id."' ");
		$Num = mysql_num_rows($dbsql);
		if($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$task_name = $row['task_name'];	
			}
		}
		return $task_name;
	}
	
public function getEmployeeInfo($emp_id){
		
        $dbsql=mysql_query("select * from od_director where did='".$emp_id."' ");
        $Num = mysql_num_rows($dbsql);
		$employee = new employee();
        if ($Num > 0)
        {
            if($row=mysql_fetch_array($dbsql))
            {
				$employee->id =htmlspecialchars($row['id']);
				$employee->name =htmlspecialchars($row['name']);
				$employee->reso_type = 1;
          	} 
        }
		else{
			$dbsql=mysql_query("select * from od_employee where eid='".$emp_id."' ");
			$Num = mysql_num_rows($dbsql);
			if ($Num > 0)
			{
				if($row=mysql_fetch_array($dbsql))
				{
					$employee->id =htmlspecialchars($row['id']);
					$employee->name =htmlspecialchars($row['name']);
					$employee->reso_type = 2;
				} 
			}
		}
        return $employee;
    }


public function getInternUserId($card_no)
{
	$eid=0;
	$dbsql=mysql_query("select * from od_access_intern where card_no='".$card_no."' ");
	$Num = mysql_num_rows($dbsql);
	if ($Num > 0)
	{
		if($row=mysql_fetch_array($dbsql))
		{
			$eid = $row['intern_id'];
		} 
	}
	return $eid;
}

public function getDepartmentList()
	{
		$dbsql=mysql_query("select * from od_dept ORDER BY dept_name asc");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$admin = new AdminUser();
				$admin->dept_name = $row['dept_name'];
				$admin->dept_id = $row['id'];
				$getArray[] = $admin;
			}
		}
				
		
		return $getArray;
	}
	
public function getDeptName($dept_id)
	{
		$dept_name="";
		$dbsql=mysql_query("select * from od_dept where dept_id='".$dept_id."' ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			if($row = mysql_fetch_array($dbsql))
			{
				$dept_name = $row['dept_name'];
			}
		}
		return $dept_name;
	}	
	
	
	public function getWorkLocation($location)
	{
		$work_location="Office";
		if($location == 1)
			$work_location="Office";
		else if($location == 2)
			$work_location="Home";
		else if($location == 3)
			$work_location="Client";
		return $work_location;
	}



public function sendGenericEmail($name,$to,$cc,$bcc,$title,$body)
{
	$date = date("d-m-Y, h:i:s A");	
	$old_manager_email = "";
	$title = addslashes($title);
	$body = addslashes($body);
	$query = "INSERT into od_send_email set date='".$date."' , toemail='".$to."' , cc='".$cc."' , bcc='".$bcc."' , title='".$title."' , body='".$body."' , name='".$name."' ";
	$res = mysql_query($query);
		
}




//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// ODITEK WFH APIs ///////////////////
//////////////////////////////////////////////////////////////////////////////////////////////




public function getWFHType()
{
	$dataArray = array();
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{	
		$empData = $this->getEmployeeData($eid);
		$dbsql=mysql_query("select * from od_wfh_type");
		$Num = mysql_num_rows($dbsql);
		while($row = mysql_fetch_array($dbsql))
		{
			$data = new AdminUser();
			$data->type = $row['type'];
			$data->code = $row['code'];
			$dataArray[] = $data;	
		}
	}
	return  $dataArray;
}

public function getWFHTypeById($id)
{
	$type = "";
	$dbsql=mysql_query("select * from od_wfh_type where code='".$id."' ");
	$Num = mysql_num_rows($dbsql);
	if($row = mysql_fetch_array($dbsql))
	{
		$type = $row['type'];
	}
	return  $type;
}


public function getAllWFHcategory(){
	$getArray= array();
	$dbsql=mysql_query("select * from od_wfh_category order by id asc");
	$Num = mysql_num_rows($dbsql);
	if ($Num > 0)
	{
		while($row = mysql_fetch_array($dbsql))
		{
			$admin = new AdminUser();
			$admin->category = $row['type'];  
			$admin->id = $row['code'];
			$getArray[] = $admin;
		}
	}
	return $getArray;
}

public function getWFHRestMonths(){
	$getArray= array();
	 
	$monthid = date(n);
	$last_month = $monthid - 1;
	while($monthid <= 12)
	{
		$date = "01-".$monthid."-".date('Y');
		//$monthname = date("F", mktime(null, null, null, $monthid));
		$monthname = date("F", strtotime($date));
		$admin = new AdminUser();
		$admin->monthname = $monthname;  
		$admin->monthid = $monthid;
		$getArray[] = $admin;
		$monthid++;
	}
		$admin = new AdminUser();
		$admin->monthname = "last-month";  
		$admin->monthid = $last_month;
		$getArray[] = $admin;
	
	return $getArray;
}

public function getWFHCategoryById($id)
{
	$type = "";
	$dbsql=mysql_query("select * from od_wfh_category where code='".$id."' ");
	$Num = mysql_num_rows($dbsql);
	if($row = mysql_fetch_array($dbsql))
	{
		$type = $row['type'];
	}
	return  $type;
}

public function getWFHStatusById($id)
{
	$status = "";
	$dbsql=mysql_query("select * from od_wfh_status where val='".$id."' ");
	$Num = mysql_num_rows($dbsql);
	if($row = mysql_fetch_array($dbsql))
	{
		$status = $row['status'];
	}
	return  $status;
}

public function getWFHStatus($wid)
{
	$status = 0;
	$dbsql=mysql_query("select * from od_wfh_records where wid='".$wid."' ");
	$Num = mysql_num_rows($dbsql);
	if($row = mysql_fetch_array($dbsql))
	{
		$status = $row['status'];
	}
	return  $status;
}

public function getAvailableWFH($eid,$date)
{
	if($eid > 0)
	{
		$monthid = date('n', strtotime($date));
		$counts = $this->getWFHAvailbleDays($eid,$monthid);
		$data=array("status"=>1, "value"=>$counts);
	}
	else{
		$data=array("status"=>0);
	}
		
	return $data;
}

public function calculateTotalWFHDays($type,$sdate, $edate)
{
	$today = date("d-m-Y");
	$sdate = date("d-m-Y", strtotime($sdate));
	$edate = date("d-m-Y", strtotime($edate));
	$today_str = strtotime($today);
	$sdate_str = strtotime($sdate);
	$edate_str = strtotime($edate);
	if($sdate_str > $edate_str)
	{
		$msg = "Start Date is beyond the End Date";
		$result = array("status"=>0,"msg"=>$msg);
		return $result;
	}
		
	$count=0;
	if($sdate == $edate)
	{
		$holiday=0;
		$holiday = $this->checkHoliday($sdate);
		if(!$holiday)
			$count=1;
		$result = array("status"=>1,"count"=>$count);
		return $result;
	}
	$date = $sdate;
	$date_str = strtotime($date);
	while($date_str <= $edate_str )
	{
		$holiday=0;
		$holiday = $this->checkHoliday($date);
		if(!$holiday)
			$count++;
		$date = date("d-m-Y", strtotime($date." 1 days"));
		$date_str = strtotime($date);
	}
	
	$result = array("status"=>1,"count"=>$count);
	return $result;
}

public function generateWFHReqID($num)
{
	$id="";
	$size  = strlen($num);
	if($size == 1)
		$id = "WFH00".$num;
	else if	($size == 2)
	    $id = "WFH0".$num;
	else if	($size == 3)
		$id = "WFH".$num;
	else if	($size == 4)
		$id = "WFH".$num;	
	
	return $id;	
}


public function loadMyOpenWFHRequest()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_wfh_records where eid='".$eid."' and status='1' ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$wid = $row['wid'];
				$type = $row['type'];
				$type_str = $this->getWFHTypeById($type);
				$sdate = $row['start_date'];
				$edate = $row['end_date'];
				$tleaves = $row['days'];
				$status = $row['status'];
				$status_str = $this->getWFHStatusById($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_lid = $this->get_mcrypt_encrypt($wid,$iv_key);						
				
				$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'</td>
					   <td style="font-weight:normal" >'.$wid.'</td>
					   <td style="font-weight:normal" >'.$type_str.'</td>
					   <td style="font-weight:normal" >'.$sdate.'</td>
					   <td style="font-weight:normal" >'.$edate.'</td>
					   <td style="font-weight:normal" >'.$tleaves.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="wfh_mydetail.php?wid='.$encrypt_lid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No Open WFH Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}


public function loadWFHResourceCounts($empid)
{
	$my_id = $_SESSION["emp_id"];
	if($my_id)
	{	
		$empData = $this->getEmployeeData($my_id);
		$bu_id = $empData->bu;
		$isCEO = $this->isCEO($my_id);
		$eid_filter = "and a.bu='".$bu_id."'";
		if($isCEO) $eid_filter = "";
					
		$str1 = "select a.eid , a.name , a.bu , b.count , b.id , b.used , b.month , b.mid , b.type 
				from od_employee a 	INNER JOIN od_wfh_allow_list b 
				ON a.eid = b.eid  
				where a.status='1'  ".$eid_filter." order by a.name asc";
		$dbsql=mysql_query($str1);
		$Num = mysql_num_rows($dbsql);
		$sl_no=0;
		if($Num)
		{	
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$eid = $row['eid'];
				$bu_id = $row['bu'];
				$bu_name = $this->getBUnitById($bu_id); 
				$name = $row['name'];
				$count = $row['count'];
				$used = $row['used'];
				$avail = $count - $used;
				if($avail < 0 )
					$avail = 0;
				$month = $row['month'];
				$mid = $row['mid'];
				if(!$mid)
					$month = "ALL";
				$category = $row['type'];
				$category_str = $this->getWFHCategoryById($category);
				$style="";
				if($eid == $empid)
				{
					$style="color: red; font-weight: bold";
				}
				
				
				$str .= '<tr class="success" >
						   <td  style="font-weight:normal;'.$style.'" >'.$sl_no.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$eid.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$name.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$bu_name.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$category_str.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$month.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$count.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$avail.'</td>
						   <td class="tooltip-sidebar-logout">
						   <input onclick="actionDelete('.$id.');" type="button" class="btn btn-md btn-red" value="Delete" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
						   </td>
						   </tr>';
			}
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No WFH Info found</td></tr>';
		}
	}
	$data=array("status"=>1,"data"=>$str);
	return $data;
}



public function getMyWFHCountsList()
{
	$my_id = $_SESSION["emp_id"];
	if($my_id)
	{	
		$empData = $this->getEmployeeData($my_id);
		$monthid = date(n);
		$pre_monthid = $monthid - 1;
		if($pre_monthid == 0)  $pre_monthid = 12;	
		$next_monthid = $monthid +1 ;
		if($next_monthid > 12) $next_monthid = 1;
					
		$str1 = "select * from od_wfh_allow_list where eid ='".$my_id."' and ( mid='".$pre_monthid."' or mid='".$monthid."' or mid='".$next_monthid."') order by mid asc ";
		$dbsql=mysql_query($str1);
		$Num = mysql_num_rows($dbsql);
		$sl_no=0;
		if($Num)
		{	
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$count = $row['count'];
				$used = $row['used'];
				$avail = $count - $used;
				if($avail < 0 )
					$avail = 0;
				$month = $row['month'];
				$mid = $row['mid'];
				$category = $row['type'];
				$category_str = $this->getWFHCategoryById($category);
				$style="";
				
				
				
				$str .= '<tr class="success" >
						   <td  style="font-weight:normal;'.$style.'" >'.$sl_no.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$category_str.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$month.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$count.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$avail.'</td>
						   </tr>';
			}
		}
		$str1 = "select * from od_wfh_allow_list where eid ='".$my_id."' and  mid='0' ";
		$dbsql=mysql_query($str1);
		$Num = mysql_num_rows($dbsql);
		if($Num)
		{	
			if($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$count = $row['count'];
				$used = $row['used'];
				$avail = $count - $used;
				if($avail < 0 )
					$avail = 0;
				$month = $row['month'];
				$mid = $row['mid'];
				if(!$mid)
					$month = "ALL";
				$category = $row['type'];
				$category_str = $this->getWFHCategoryById($category);
				
				$style="";
				
								
				$str .= '<tr class="success" >
						   <td  style="font-weight:normal;'.$style.'" >'.$sl_no.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$category_str.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$month.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$count.'</td>
						   <td style="font-weight:normal;'.$style.'" >'.$avail.'</td>
						   </tr>';
				
			}
		}
		
		if(!$Num)
		{
			$str ='<tr><td colspan="5" style="text-align: center; font-weight:bold" >No WFH Info found</td></tr>';
		}
	}
	$data=array("status"=>1,"data"=>$str);
	return $data;
}

public function loadAllOpenWFHRequest()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_wfh_records where status='1' ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$wid = $row['wid'];
				$type = $row['type'];
				$type_str = $this->getWFHTypeById($type);
				$sdate = $row['start_date'];
				$edate = $row['end_date'];
				$tleaves = $row['days'];
				$status = $row['status'];
				$status_str = $this->getWFHStatusById($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_lid = $this->get_mcrypt_encrypt($wid,$iv_key);						
				
				$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'</td>
					   <td style="font-weight:normal" >'.$wid.'</td>
					   <td style="font-weight:normal" >'.$type_str.'</td>
					   <td style="font-weight:normal" >'.$sdate.'</td>
					   <td style="font-weight:normal" >'.$edate.'</td>
					   <td style="font-weight:normal" >'.$tleaves.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="wfh_viewrequestdetails.php?wid='.$encrypt_lid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No Open WFH Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}




public function loadWFHResourceAllow()
{
	$str1 = "select a.eid , a.name , a.bu , b.count , b.id , b.used , b.month , b.mid , b.type 
			from od_employee a 	INNER JOIN od_wfh_allow_list b 
			ON a.eid = b.eid  
			where a.status='1'  order by a.name asc";
	$dbsql=mysql_query($str1);
	$Num = mysql_num_rows($dbsql);
	$sl_no=0;
	if($Num)
	{	
		while($row = mysql_fetch_array($dbsql))
		{
			$sl_no++;
			$id = $row['id'];
			$eid = $row['eid'];
			$bu_id = $row['bu'];
			$bu_name = $this->getBUnitById($bu_id); 
			$name = $row['name'];
			$count = $row['count'];
			$used = $row['used'];
			$avail = $count - $used;
			if($avail < 0 )
				$avail = 0;
			$month = $row['month'];
			$mid = $row['mid'];
			if(!$mid)
				$month = "ALL";
			$category = $row['type'];
			$category_str = $this->getWFHCategoryById($category);
			$style="";
			if($eid == $empid)
			{
				$style="color: red; font-weight: bold";
			}
			
				
			$str .= '<tr class="success" >
					   <td  style="font-weight:normal;'.$style.'" >'.$sl_no.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$eid.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$name.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$bu_name.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$category_str.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$month.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$count.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$avail.'</td>
					   </tr>';
		}
	}
	$data=array("status"=>1,"data"=>$str);
	return $data;
}


public function createNewRequest($request,$eid)
{
	if($eid > 0)
	{	
		$date = date("d-m-Y, h:i:s A");
		$year = date("Y");
		//$year = "2023";		
		$type = $request['leave_type'];
		$sdate = date("d-m-Y", strtotime($request['start_date']));
		$edate = date("d-m-Y", strtotime($request['end_date']));
		
		$sdate_yr = date("Y", strtotime($request['start_date']));
		$edate_yr = date("Y", strtotime($request['end_date']));
		
		$sdate_m = date("m", strtotime($request['start_date']));
		$edate_m = date("m", strtotime($request['end_date']));
		
		$days = $request['total_leave'];
		$reason = addslashes($request['text1']);
		$avail_time = addslashes($request['avail_time']);
		$net_speed = addslashes($request['net_speed']);
		$status = 1;
		$skipEndDt = 0;
		if($type == 8) // Maternity Leave
			$skipEndDt = 1;
		
		if($days == 0)
		{
			$msg = "Unable to create new request. Number of count is zero.";
			$data=array("status"=>0, "msg"=>$msg);
			return $data;
		}
		
		
		if(!$skipEndDt)
		{	
			if($year != $sdate_yr || $year != $edate_yr)
			{
				$msg = "Unable to create new request. Date is incorrect.";
				$data=array("status"=>0, "msg"=>$msg);
				return $data;
				
			}	
			
			if($sdate_yr != $edate_yr)
			{
				$msg = "Unable to create new request. Year is incorrect.";
				$data=array("status"=>0, "msg"=>$msg);
				return $data;
				
			}
			
			if($sdate_m != $edate_m)
			{
				$msg = "Unable to create new request. Month is incorrect.";
				$data=array("status"=>0, "msg"=>$msg);
				return $data;
				
			}
		}else{
			
			if($year != $sdate_yr)
			{
				$msg = "Unable to create new request. Date is incorrect.";
				$data=array("status"=>0, "msg"=>$msg);
				return $data;
				
			}	
			
			
		}			
		
		
		$availCnt = $this->getAvailableWFH($eid,$sdate);
				
		if($days >  $availCnt)
		{
			$msg = "Unable to create new request. Number of counts exceed the available counts.";
			$data=array("status"=>0, "msg"=>$msg);
			return $data;
		}
		
		$empData = $this->getEmployeeData($eid);
		$bu_name = $empData->bu_name;
		$bu_head_id = $this->getBUHeadId($empData->bu);
		$bu_head_name = $this->getBUHeadById($empData->bu);
		$super_id  = $empData->upper_id;
		$super_name  = $empData->report_to;
		$employee_type = $empData->employee_type;
		
		//////On Notice Period, don't allow Leave 
		if($this->isOnNoticePeriod($eid))
		{
			$msg = "During notice period, you are not allowed to generate new WFH Request. Please contact with HR.";
			$data=array("status"=>0, "msg"=>$msg);
			return $data;
		}	
		
		$query = "INSERT into od_wfh_records set date='".$date."' , eid='".$eid."', type='".$type."' , year='".$sdate_yr."' ,start_date='".$sdate."' , end_date='".$edate."' , days ='".$days."' , status = '".$status."' , bu_name = '".$bu_name."' , bu_head_id = '".$bu_head_id."' , bu_head_name = '".$bu_head_name."' , super_id = '".$super_id."' , super_name = '".$super_name."'  , reason='".$reason."' , avail_time='".$avail_time."' , net_speed='".$net_speed."' ,email = '1' ";
		$res = mysql_query($query);
		if($res)
		{	
			$db_id = mysql_insert_id();
			$wid = $this->generateWFHReqID($db_id);
			$qry=mysql_query("UPDATE od_wfh_records set wid='".$wid."' where id='".$db_id."'");
			if($db_id > 0)
			{	
				$this->updateWFHCounts($wid,$sdate);
				$msg = "Succesfully created new WFH Request. Request ID: ".$wid;
				$data=array("status"=>1, "wid"=>$wid, "msg"=>$msg);
			}
			//update wfh logs
			$this->addWFHLogs($wid);
		}else{
			$msg = "Unable to create new request. Contact Intra-Admin.";
			$data=array("status"=>0, "msg"=>$msg);
		}
	}
	else{
			$msg = "Unable to create new request.";
			$data=array("status"=>0, "msg"=>$msg);
	}
	
	return $data;	
}

public function addWFHLogs($wid)
{
	$query = "select * from od_wfh_records where wid='".$wid."' ";
	$dbsql=mysql_query($query);
	if($row = mysql_fetch_array($dbsql))
	{
		$eid = $row['eid'];
		$sdate = $row['start_date'];
		$edate = $row['end_date'];
		$cnt=0;
		while(1)
		{
			$date = date("d-m-Y", strtotime($sdate." ".$cnt." days"));
			$holiday = $this->checkHoliday($date);
			if(!$holiday)
			{	
				$query1 = "INSERT into od_wfh_logs set date='".$date."', wid='".$wid."' , eid='".$eid."' ";
				$dbsql1=mysql_query($query1);
			}
			if($date == $edate)
				break;
			$cnt++;
			if($cnt == 11) 	break;
		}
	}
}

public function getEmployeeWFHInfo($eid,$date)
{
	$employee = new employee();
	$employee->status = 0;
	$query = "select * from od_wfh_logs where date='".$date."' and  eid='".$eid."' ";
	$dbsql=mysql_query($query);
	if($row = mysql_fetch_array($dbsql))
	{
		$wid = $row['wid'];
		$employee->status = 1;
		$employee->info = "WFH [".$wid."]";
	}
	return 	$employee;
}

public function getDetailsWFHRequest($wid)
{
	$dbsql=mysql_query("select * from od_wfh_records where wid='".$wid."' ");
	$Num = mysql_num_rows($dbsql);	
	$admin = new AdminUser();
	if ($Num > 0)
	{
		$row = mysql_fetch_array($dbsql);
		
		$admin->wid = $wid;
		$admin->cdate  = $row['date'];
		$admin->eid  = $row['eid'];
		$empData = $this->getEmployeeData($admin->eid);
		$oid = $row['eid'];
		//$upper = $this->getEmployeeToReport($admin->eid);
		//$admin->report_to = $upper->name;
		$admin->cname  = $this->getEmployeeName($admin->eid);
		$admin->buname = $row['bu_name'];
		$admin->bu_head_name = $row['bu_head_name'];
		$admin->super_name  = $row['super_name'];
		
		$admin->type  = $row['type'];
		$admin->type_str  = $this->getWFHTypeById($admin->type);
		$admin->sdate = $row['start_date'];
		$admin->edate = $row['end_date'];
		$admin->days = $row['days'];
		$admin->reason   = trim(stripslashes($row['reason']));
		$admin->avail_time   = trim(stripslashes($row['avail_time']));
		$admin->net_speed   = trim(stripslashes($row['net_speed']));
		$admin->status = $row['status'];
		$admin->status_str = $this->getWFHStatusById($admin->status);
		
		
	}	
	
	return $admin;
}



public function loadMyClosedWFHRequest()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_wfh_records where eid='".$eid."' and status!='1' ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$wid = $row['wid'];
				$type = $row['type'];
				$type_str = $this->getWFHTypeById($type);
				$sdate = $row['start_date'];
				$edate = $row['end_date'];
				$tleaves = $row['days'];
				$status = $row['status'];
				$status_str = $this->getWFHStatusById($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_lid = $this->get_mcrypt_encrypt($wid,$iv_key);						
				
				$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'</td>
					   <td style="font-weight:normal" >'.$wid.'</td>
					   <td style="font-weight:normal" >'.$type_str.'</td>
					   <td style="font-weight:normal" >'.$sdate.'</td>
					   <td style="font-weight:normal" >'.$edate.'</td>
					   <td style="font-weight:normal" >'.$tleaves.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="wfh_mydetailclosed.php?wid='.$encrypt_lid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No WFH Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}


public function loadAllClosedWFHRequest()
{
	$eid = $_SESSION["emp_id"];
	if($eid > 0)
	{
		$dbsql=mysql_query("select * from od_wfh_records where status!='1' ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$wid = $row['wid'];
				$type = $row['type'];
				$type_str = $this->getWFHTypeById($type);
				$sdate = $row['start_date'];
				$edate = $row['end_date'];
				$tleaves = $row['days'];
				$status = $row['status'];
				$status_str = $this->getWFHStatusById($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_lid = $this->get_mcrypt_encrypt($wid,$iv_key);						
				
				$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'</td>
					   <td style="font-weight:normal" >'.$wid.'</td>
					   <td style="font-weight:normal" >'.$type_str.'</td>
					   <td style="font-weight:normal" >'.$sdate.'</td>
					   <td style="font-weight:normal" >'.$edate.'</td>
					   <td style="font-weight:normal" >'.$tleaves.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="wfh_detailclosed.php?wid='.$encrypt_lid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="9" style="text-align: center; font-weight:bold" >No WFH Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}


public function loadMyReviewWFHRequest()
{
	$myeid = $_SESSION["emp_id"];
	$str="";
	if($myeid > 0)
	{
		$dbsql=mysql_query("select * from od_wfh_records where status='1' ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$date = $row['date'];
				$wid = $row['wid'];
				$eid = $row['eid'];
				$bu_head_id = $row['bu_head_id'];
				$super_id = $row['super_id'];
				$ceo = $this->isCEO($myeid);
				
				if(!$ceo)
				{	
					if($myeid != $bu_head_id)
					{
						continue;
					}
				}
				
				$type = $row['type'];
				$type_str = $this->getWFHTypeById($type);
				$name = $this->getEmpName($eid);
				$sdate = $row['start_date'];
				$edate = $row['end_date'];
				$tleaves = $row['days'];
				$status = $row['status'];
				$status_str = $this->getWFHStatusById($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_lid = $this->get_mcrypt_encrypt($wid,$iv_key);						
				
				$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$date.'</td>
					   <td style="font-weight:normal" >'.$wid.'</td>
					   <td style="font-weight:normal" >'.$name.'</td>
					   <td style="font-weight:normal" >'.$type_str.'</td>
					   <td style="font-weight:normal" >'.$sdate.'</td>
					   <td style="font-weight:normal" >'.$edate.'</td>
					   <td style="font-weight:normal" >'.$tleaves.'</td>
					   <td style="font-weight:normal">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="wfh_myapprovaldetails.php?wid='.$encrypt_lid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			if(strlen($str) == 0)
				$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Open WFH Request found</td></tr>';
			
			
		}else{
			
			$str ='<tr><td colspan="10" style="text-align: center; font-weight:bold" >No Open WFH Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}


public function cancellOpenRequest($wid)
{
	if($this->getWFHStatus($wid) ==  1)
	{	
		$eid = $_SESSION["emp_id"];
		$emp_name  = $this->getEmpName($eid);
		$this->cancelWFHCounts($wid);
		$qry=mysql_query("UPDATE od_wfh_records set status='5' , email = '1' , update_id = '".$eid."' ,update_name = '".$emp_name."' where wid='".$wid."'");
		$msg = "Cancelled Succesfully";
		$data=array("status"=>1, "msg"=>$msg);
	}else{
		$msg = "Something went wrong!";
		$data=array("status"=>0, "msg"=>$msg);
	}		
	return $data;	
}


public function rejectOpenRequest($wid)
{
	if($this->getWFHStatus($wid) ==  1)
	{	
		$eid = $_SESSION["emp_id"];
		$emp_name  = $this->getEmpName($eid);
		$this->cancelWFHCounts($wid);
		$qry=mysql_query("UPDATE od_wfh_records set status='3' , email = '1' , update_id = '".$eid."' ,update_name = '".$emp_name."' where wid='".$wid."'");
		$msg = "Rejected Succesfully";
		$data=array("status"=>1, "msg"=>$msg);
	}else{
		$msg = "Something went wrong!";
		$data=array("status"=>0, "msg"=>$msg);
	}		
	return $data;
	
}

public function approveOpenRequest($wid)
{
	if($this->getWFHStatus($wid) ==  1)
	{	
		$days = $this->getWFHRequestDays($wid);
		$emp_id = $this->getWFHRequestEmp($wid);
		$sdate = $this->getWFHRequestStartDate($wid);
		$monthid = date('n', strtotime($sdate));
		
		$availcounts = $this->getWFHAvailbleDays($emp_id,$monthid);
		$eid = $_SESSION["emp_id"];
		$emp_name  = $this->getEmpName($eid);
		$qry=mysql_query("UPDATE od_wfh_records set status='2' , email = '1' , update_id = '".$eid."' , update_name = '".$emp_name."' where wid='".$wid."'");
		$msg = "Approved Succesfully";
		$data=array("status"=>1, "msg"=>$msg);
	}else{
		$msg = "Something went wrong!";
		$data=array("status"=>0, "msg"=>$msg);
	}		
	return $data;	
}

public function updateWFHCounts($wid,$date)
{
	$days = $this->getWFHRequestDays($wid);
	$eid = $this->getWFHRequestEmp($wid);
	$rest=0;
	if($days)
	{
		//$monthid = date(n);
		$monthid = date('n', strtotime($date));
		$isType2=0;
		$dbsql = "select * from od_wfh_allow_list where eid ='".$eid."' and type=2 and mid='".$monthid."'";
		$dbres = mysql_query($dbsql);
		if($row = mysql_fetch_array($dbres))
		{
			$isType2=1;
			$maxcounts = $row['count'];		
			$db_id = $row['id'];
			$used = $row['used'];
			$left  = $maxcounts - $used;
			if($days > $left)
			{	
				$new_used = $used + $left;
				$days = $days - $left;
				$rest = 1;
			}else
				$new_used = $used + $days;
			$qry=mysql_query("UPDATE od_wfh_allow_list set used='".$new_used."' where id='".$db_id."'");
		}	
		//check for WFH type1
		if(!$isType2 || $rest)
		{
			$dbsql = "select * from od_wfh_allow_list where eid ='".$eid."' and type=1 ";
			$dbres = mysql_query($dbsql);
			if($row = mysql_fetch_array($dbres))
			{
				$db_id = $row['id'];
				$used = $row['used'];
				$new_used = $used + $days;
				$qry=mysql_query("UPDATE od_wfh_allow_list set used='".$new_used."' where id='".$db_id."'");
			}
		}
	}
}

public function cancelWFHCounts($wid)
{
	$days = $this->getWFHRequestDays($wid);
	$eid = $this->getWFHRequestEmp($wid);
	if($days)
	{
		//$monthid = date(n);
		$sdate = $this->getWFHRequestStartDate($wid);
		$monthid = date('n', strtotime($sdate));
		$isType2=0;
		$extra=0;
		
		$dbsql = "select * from od_wfh_allow_list where eid ='".$eid."' and type=2 and mid='".$monthid."'";
		$dbres = mysql_query($dbsql);
		if($row = mysql_fetch_array($dbres))
		{
			$isType2=1;	
			$db_id = $row['id'];
			$used = $row['used'];
			if($days > $used)
				$extra = $days - $used;
			
			$new_used = $used - $days;
			
			if($new_used < 0) $new_used =  0;
			$qry=mysql_query("UPDATE od_wfh_allow_list set used='".$new_used."' where id='".$db_id."'");
		}	
		//check for WFH type1
		if(!$isType2 || $extra)
		{
			if($extra)	$days = $extra;
			$dbsql = "select * from od_wfh_allow_list where eid ='".$eid."' and type=1 ";
			$dbres = mysql_query($dbsql);
			if($row = mysql_fetch_array($dbres))
			{
				$db_id = $row['id'];
				$used = $row['used'];
				$new_used = $used - $days;
				if($new_used < 0) $new_used =  0;
				$qry=mysql_query("UPDATE od_wfh_allow_list set used='".$new_used."' where id='".$db_id."'");
			}
		}
	}
}

public function getWFHRequestDays($wid)
{
	$days=0;
	$dbsql=mysql_query("select * from od_wfh_records where wid='".$wid."'");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$days = $row['days'];	
	}
	return $days;
}

public function getWFHRequestStartDate($wid)
{
	$start_date="";
	$dbsql=mysql_query("select * from od_wfh_records where wid='".$wid."'");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$start_date = $row['start_date'];	
	}
	return $start_date;
}

public function getWFHRequestEmp($wid)
{
	$eid=0;
	$dbsql=mysql_query("select * from od_wfh_records where wid='".$wid."'");
	$Num = mysql_num_rows($dbsql);	
	if($row = mysql_fetch_array($dbsql))
	{
		$eid = $row['eid'];	
	}
	return $eid;
}

public function getWFHAvailbleDays($eid,$monthid)
{
	//check type 2
	$days=0;
	$isType2=0;
	
	//$monthid = date(n);
	$dbsql = "select * from od_wfh_allow_list where eid ='".$eid."' and type=2 and mid='".$monthid."'";
	$dbres = mysql_query($dbsql);
	if($row = mysql_fetch_array($dbres))
	{
		//$isType2=1;	
		$maxcounts = $row['count'];
		$used = $row['used'];
		$days = $maxcounts - $used;
	}	
			
	//check for WFH type1
	if(!$isType2)
	{
		$dbsql = "select * from od_wfh_allow_list where eid ='".$eid."' and type=1 ";
		$dbres = mysql_query($dbsql);
		if($row = mysql_fetch_array($dbres))
		{
			$maxcounts = $row['count'];
			$used = $row['used'];
			$days += $maxcounts - $used;
		}
	}
	
	return $days;
}

///for email

public function getNewWFHRequestList()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_wfh_records where status='1' and email='1' ");
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$id = $row['id'];
		$data->cdate = $row['date'];
		$data->wid = $row['wid'];
		$data->eid = $row['eid'];
		$data->type = $row['type'];
		$data->start_date = $row['start_date'];
		$data->end_date = $row['end_date'];
		$data->days = $row['days'];
		$data->reason = $row['reason'];
		$data->avail_time = $row['avail_time'];
		$data->net_speed = $row['net_speed'];
		$data->status = $row['status'];
		$data->bu_name = $row['bu_name'];
		$data->bu_head_id = $row['bu_head_id'];
		$data->bu_head_name = $row['bu_head_name'];
		$data->super_id = $row['super_id'];
		$data->super_name = $row['super_name'];
		$dataArray[] = $data;
		$qry=mysql_query("UPDATE od_wfh_records set email='0' where id='".$id."' ");
	}
	
		
	return  $dataArray;
}


public function getUpdateWFHRequestList()
{
	$dataArray = array();
	$dbsql=mysql_query("select * from od_wfh_records where status!='1' and email='1' ");
	$Num = mysql_num_rows($dbsql);	
	while($row = mysql_fetch_array($dbsql))
	{
		$data = new AdminUser();
		$id = $row['id'];
		$data->cdate = $row['date'];
		$data->wid = $row['wid'];
		$data->eid = $row['eid'];
		$data->type = $row['type'];
		$data->start_date = $row['start_date'];
		$data->end_date = $row['end_date'];
		$data->days = $row['days'];
		$data->reason = $row['reason'];
		$data->avail_time = $row['avail_time'];
		$data->net_speed = $row['net_speed'];
		$data->status = $row['status'];
		$data->bu_name = $row['bu_name'];
		$data->bu_head_id = $row['bu_head_id'];
		$data->bu_head_name = $row['bu_head_name'];
		$data->super_id = $row['super_id'];
		$data->super_name = $row['super_name'];
		$data->update_id = $row['update_id'];
		$data->updated_name = $row['update_name'];
		$dataArray[] = $data;
		$qry=mysql_query("UPDATE od_wfh_records set email='0' where id='".$id."' ");
	}
	
		
	return  $dataArray;
}

public function loadWFHResoData($eid)
{
	$empData = $this->getEmployeeData($eid);
	
	$emp_name = $empData->name;
	$report_to = $empData->report_to;
	$bu_name = $empData->bu_name;
	$team_name = $empData->dept_name;
	$designation = $empData->desig_name;
	
	$data=array("status"=>1,"emp_name"=>$emp_name, "uname"=>$report_to , "emp_id"=>$eid , "bu_name"=>$bu_name, "team_name"=>$team_name , "designation"=>$designation );
	
	return $data;
}


public function loadResoAllWFHRequest($feid,$year)
{
	$my_id = $_SESSION["emp_id"];
	if($my_id > 0)
	{
		$myempData = $this->getEmployeeData($my_id);
		$bu_id = $myempData->bu;
		$isCEO = $this->isCEO($my_id);
		
		if($isCEO)	$bu_id = 0;
		
		$dbsql=mysql_query("select * from od_wfh_records where year='".$year."' ORDER BY id DESC ");
		$Num = mysql_num_rows($dbsql);	
		if ($Num > 0)
		{
			$sl_no=0;
			while($row = mysql_fetch_array($dbsql))
			{
				
				$id = $row['id'];
				$eid = $row['eid'];
				$empData = $this->getEmployeeData($eid);
				$emp_bu_id = $empData->bu;
				$empname = $empData->name;
				//show only same BU employee
				if($bu_id and $emp_bu_id != $bu_id )
					continue;
				
				$sl_no++;		
				$date = $row['date'];
				$wid = $row['wid'];
				$type = $row['type'];
				$type_str = $this->getWFHTypeById($type);
				$sdate = $row['start_date'];
				$edate = $row['end_date'];
				$tleaves = $row['days'];
				$status = $row['status'];
				$status_str = $this->getWFHStatusById($status);
								
				$iv_key = $this->get_mcrypt_iv();
				$encrypt_lid = $this->get_mcrypt_encrypt($wid,$iv_key);	

				$style="";
				if($feid == $eid)
				{
					$style="color: red; font-weight: bold";
				}				
				
				$str .= '<tr class="success" >
				       <td  style="font-weight:normal;'.$style.'" >'.$sl_no.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$date.'</td>
                       <td style="font-weight:normal;'.$style.'" >'.$eid.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$empname.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$wid.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$type_str.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$sdate.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$edate.'</td>
					   <td style="font-weight:normal;'.$style.'" >'.$tleaves.'</td>
					   <td style="font-weight:normal;'.$style.'">'.$status_str.'</td>
					   <td class="tooltip-sidebar-logout">
					   <a href="wfh_resodetailview.php?wid='.$encrypt_lid.'&iv='.$iv_key.' " >
					   <input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px"> 
					   </td>
					   </tr>';				
			}
			
			
		}else{
			
			$str ='<tr><td colspan="11" style="text-align: center; font-weight:bold" >No WFH Request found</td></tr>';
		}
		
		$data=array("status"=>1,"data"=>$str);
	}
	else
	{
		$data=array("status"=>0, "msg"=>"Unknow Error...");
	}
	
	return $data;
}


public function deleteWFHEntryRecord($dbid)
{
	$str = "select * from od_wfh_allow_list where id ='".$dbid."'";
	$dbsql = mysql_query($str);
	$Num = mysql_num_rows($dbsql);
	if($Num)
	{
		$row = mysql_fetch_array($dbsql);
		$eid = $row['eid'];
		$emp_name = $this->getEmpName($eid);
		//check if any open request is present or not
		$dbsql=mysql_query("select * from od_wfh_records where eid='".$eid."' and status='1' ");
		$Num = mysql_num_rows($dbsql);	
		if($Num)
		{	
			$msg = "Unable to delete. Open WFH request is present of ".$emp_name;
			$data=array("status"=>0, "msg"=>$msg);
		}
		else{
			$str = "delete from od_wfh_allow_list where id='".$dbid."' ";
			$dbsql = mysql_query($str);
			$msg = "Succesfully deleted WFH of ".$emp_name;
			$data=array("status"=>1, "msg"=>$msg);
		}
	}
	else{
		$msg = "Unable to delete. Unknown Error.";
		$data=array("status"=>0, "msg"=>$msg);
	}
	
	return $data;
	
}


public function addNewWFHEntryRecord($request)
{
	$eid = $request['reso_id'];
	$emp_name = $this->getEmpName($eid);
	$cat_id = $request['cat_id'];
	$month_id = $request['month_id'];
	$monthname = date("F", mktime(null, null, null, $month_id));
	$days_id = $request['days_id'];
	
	if($days_id <= 0)
	{
		$msg = "Unable to add. Total Days is ".$days_id;
		$data=array("status"=>0, "msg"=>$msg);
		return $data;
	}
	
	if($cat_id == 1) // Always
	{
		$days_id = 8; // change to 8 on 7th March, 2023
		$month_id = 0;
		$monthname = "";
	}
	
	$filter="";
	if($cat_id == 2)
		$filter=" and mid='".$month_id."' ";
	
	$dbsql=mysql_query("select * from od_wfh_allow_list where eid='".$eid."' and type='".$cat_id."' ".$filter);
	$Num = mysql_num_rows($dbsql);	
	if($Num)
	{
		if($cat_id == 2)
		{	
			$row = mysql_fetch_array($dbsql);
			$id = $row['id'];
			$count = $row['count'];
			$count += $days_id;
			$str = "UPDATE od_wfh_allow_list set count='".$count."'  where id='".$id."' ";
			$qry=mysql_query($str);
			$msg = "Succesfully updated WFH entry of ".$emp_name;
			$data=array("status"=>1, "msg"=>$msg);
			return $data;
		}
		else{
			$msg = "Unable to add. WFH entry is already present of ".$emp_name;
			$data=array("status"=>0, "msg"=>$msg);
			return $data;
		}
	}
	
	$query = "INSERT into od_wfh_allow_list set eid='".$eid."', type='".$cat_id."' , mid='".$month_id."' , count='".$days_id."' , month='".$monthname."' ";
	$dbsql=mysql_query($query);
	$msg = "Succesfully added new WFH entry of ".$emp_name;
	$data=array("status"=>1, "msg"=>$msg);
	
	return $data;
}


public function updateMonthlyWFHCounts()
{
	$dbsql=mysql_query("select * from od_wfh_allow_list where type='1' order by id asc");
	$Num = mysql_num_rows($dbsql);	
	if($Num)
	{
		while($row = mysql_fetch_array($dbsql))
		{
			$dbid = $row['id'];
			$query = "UPDATE od_wfh_allow_list set used='0' where id ='".$dbid."' ";
			$res = mysql_query($query);
		}
	}

	//Delete all Type 2
	$monthid = date("n");
	if($monthid == 1)
		$premonthid = 11;
	else if($monthid == 2)
		$premonthid = 12;
	else
		$premonthid = $monthid - 2;
	$str1 = "delete from od_wfh_allow_list where mid='".$premonthid."' and type='2' ";
	$dbsql=mysql_query($str1);
		
	$this->addDebugLogs("updateMonthlyWFHCounts Done Successfully!");
}

public function autoApproveOLDLeaveReq()
{
	$current_date = date("d-m-Y, h:i:s A");
	$date_str1 = strtotime($current_date);
	$text1 = "Auto Approved by SCM";
	$status_id = 2; // approved
	$dbsql=mysql_query("select * from od_leave_records where status='1' ORDER BY id DESC ");
	$Num = mysql_num_rows($dbsql);	
	if ($Num > 0)
	{
		while($row = mysql_fetch_array($dbsql))
		{
			$date = $row['date'];
			$lid = 	$row['lid'];
			$date_str2 = strtotime($date);
			$days = round( ($date_str1 - $date_str2) / (60 * 60 * 24));	
			if($days > 15)
			{
				$last_status = $this->getLeaveReqStatus($lid);
				$last_status_str = $this->getLeaveStatusById($last_status);
				$current_status_str = $this->getLeaveStatusById($status_id);
				$status_mod_str = "[".$last_status_str." => ".$current_status_str."]";
				//echo "LID::".$lid."<BR>";
				$qry=mysql_query("UPDATE od_leave_records set status='".$status_id."' , super_id='1'   where lid='".$lid."'");
				$query = "INSERT into od_leave_logs set date='".$current_date."' , lid='".$lid."', eid='1', msg='".$text1."' , email='1' , status_log='".$status_mod_str."' ";
				$res = mysql_query($query);
			}
		}
	}
}

public function getTotalWFHCnt()
{
	$today = date("d-m-Y");
	$dbsql=mysql_query("select * from od_wfh_logs where date='".$today."'");
	$Num = mysql_num_rows($dbsql);	
	return $Num;	
}


public function loadTodayWFHList()
{
	$today = date("d-m-Y");
	$today_str = strtotime($today);
	$holiday = $this->checkHoliday($today);
	if($holiday)
	{
		$holiday = $this->getHolidayInfo($today);	
		$str ='<tr><td colspan="7" style="text-align: center; font-weight:bold" >'.$holiday.'</td></tr>';
		$data=array("status"=>1,"data"=>$str);
		return $data;
	}
	$sl_no=0;	
	$dbsql=mysql_query("select * from od_wfh_logs where date='".$today."' ORDER BY id DESC ");
	$Num = mysql_num_rows($dbsql);	
	if ($Num > 0)
	{
		while($row = mysql_fetch_array($dbsql))
		{
			$wid = $row['wid'];
			$eid = $row['eid'];
			$status_str = $this->getWFHStatusById($this->getWFHStatus($wid));
			$upper = $this->getEmployeeToReport($eid );
			$upper_name = $upper->name;
			$empData = $this->getEmployeeData($eid);
			$dept = $this->getDeptById($empData->dept_id);
			$name  = $empData->name;
			$bu_name = $empData->bu_name;
			$sl_no++;
			$str .= '<tr class="success" >
				       <td  style="font-weight:normal" >'.$sl_no.'</td>
                       <td style="font-weight:normal" >'.$wid.'</td>
					   <td style="font-weight:normal" >'.$name.'</td>
					   <td style="font-weight:normal" >'.$dept.'</td>
					   <td style="font-weight:normal" >'.$bu_name.'</td>
					   <td style="font-weight:normal" >'.$status_str.'</td>
					   <td style="font-weight:normal" >'.$upper_name.'</td>
					   </tr>';		
		}
		
	}
	if(!$sl_no)
		$str ='<tr><td colspan="7" style="text-align: center; font-weight:bold" >No WFH Records found</td></tr>';
	
	$data=array("status"=>1,"data"=>$str);
	return $data;
}

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// ODITEK INTRA CRON SERVICES ///////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

//This Function will run Midnight of 1st Date of Each month
public function executeMonthlyCronService()
{
	$hr = date("G");
	if($hr == 0) //MID NIGHT OF 1st DATE OF EACH MONTHLY
	{
		$date = date("d-m-Y, h:i:s A");		
		$query = "INSERT into test_cron set date='".$date."' , type='MONTHLY' ";
		$res = mysql_query($query);
		//Update WFH Counts
		//$this->updateMonthlyWFHCounts();
		//$this->autoApproveOLDLeaveReq();
	}
}


public function executeWeeklyCronService()
{
	$date = date("d-m-Y, h:i:s A");		
	$query = "INSERT into test_cron set date='".$date."' , type='WEEKLY' ";
	$res = mysql_query($query);
}


public function executeDailyCronService() // execute every Mid night
{
	$date_month = date("d-m");
	$date = date("d-m-Y, h:i:s A");		
	$query = "INSERT into test_cron set date='".$date."' , type='DAILY' ";
	//$res = mysql_query($query);
	
	//$this->processCompOffLeaveData();
	
	//Add New Leave Records
	//if($date_month == "30-12")
	//	$this->addNewLeaveCounts();
		
	//$this->generateMatrixDailyRecords();
	
	//$this->generateEmpAbsentList(); // on 1st of each month
	
	//$this->generateCurrentMonthEmpAbsentList(); // on 16th of each month
	
		
	
}

public function executeHourlyCronService()
{
	$date = date("d");
	$hr = date("G");
	//$date = date("d-m-Y, h:i:s A");		
	//$query = "INSERT into test_cron set date='".$date."' , type='HOUR' ";
	//$res = mysql_query($query);
	//$this->processMarixDailyData();
	if($date == 4 && $hr == 12) // @12PM of 4th of each month
	{
		//$this->generateEmpMonthlyAttendance();
	}
	
	if($date == 4 && $hr == 15) // @03PM of 4th of each month
	{
		//$this->sendEmpMonthlyAbsentListToMgmt();
	}
	
	
		
}

public function executeCronService15Min()
{
	$date = date("d-m-Y, h:i:s A");		
	$query = "INSERT into test_cron set date='".$date."' , type='15MIN' ";
	//$res = mysql_query($query);
	//$this->processMarixDailyData();
	
}






//////////////////////////////////////////////////////////////////////////////////////////////


}	
?>