<?php
ini_set("display_errors",0);
 
require_once 'dbcon/config.php';
include_once 'dbcon/DBConnection.php';
require_once 'admin/phpexcel/Classes/PHPExcel.php';
date_default_timezone_set('Asia/Kolkata');
ini_set("display_errors",0);
$dbobj = new DBConnection();
$db =  $dbobj->connect();
	
class PHPExcelGenerator{
	private $conn;
		
	public function __construct($dbobj)
	{
		$this->dbObj=$dbobj;
	}
	
	public function __destruct() {
        // $this->close();
    }
	
	
  
	
	public function getCurrentDateTime(){
		return $date=date("d-m-Y h:i A");
	}
	

 
	public function generateHRProjectReport($cus_id,$grp_id,$pro_id,$task_id,$reso_id,$start_date,$end_date){
		
		$objPHPExcel = new PHPExcel();
		$day_str = date('h:i A - l, d M Y');
		
		$start_date_ptr = strtotime($start_date);
		$end_date_prt = strtotime($end_date);
		if($start_date_ptr > $end_date_prt)
		{
			$msg = "Invalid End date...";	
			$data = array("status" => 0 , "msg" => $msg);
			return $data;
		}
		
		$proArray= array();
		$project_name  = "";
		
		if($grp_id == 0 && $pro_id == 0 )// Means only Customer ID is present
		{
			//find all active project of customer
			$dbsql=mysql_query("select * from od_project_info where cus_id='".$cus_id."' and status='1' ");
 			$Num1 = mysql_num_rows($dbsql);
			while($row1 = mysql_fetch_array($dbsql))
			{
				$proArray[] = $row1['pid'];
			}	
			$project_name  = "All Projects";
		}else if($pro_id == 0)// Means only Customer ID as well as group id is present
		{
			//find all active project of customer in that group
			$dbsql=mysql_query("select * from od_project_info where cus_id='".$cus_id."' and grpid='".$grp_id."' and status='1' ");
 			$Num1 = mysql_num_rows($dbsql);
			while($row1 = mysql_fetch_array($dbsql))
			{
				$proArray[] = $row1['pid'];
			}
			$project_name  = "All Projects";
		}
		else{
			//pro_id is must present
			$proArray[] = $pro_id;
			$project_name  = $this->dbObj->getProjectName($pro_id);
		}
		
		$customer_name = $this->dbObj->getCustomerName($cus_id);
				
		
		
		
		
		
		$objPHPExcel->getProperties()->setCreator("OdiTek Admin")
							 ->setLastModifiedBy("OdiTek Admin")
							 ->setTitle("OdiTek Project Report")
							 ->setSubject("OdiTek Project HR Report")
							 ->setDescription("OdiTek Project HR Report")
							 ->setKeywords("")
							 ->setCategory("");
							 
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Project Hour Report: Customer ['.$customer_name.']');
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setSize(16);
		
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:D2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C3:D3');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Project Name: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Period: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', $project_name);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $start_date.' to '.$end_date);
		$objPHPExcel->getActiveSheet()->getStyle("A2:C2")->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle("A3:C3")->getFont()->setSize(14);	
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Sl NO')
            ->setCellValue('B4', 'Date')
			->setCellValue('C4', 'Project Name')
			->setCellValue('D4', 'Group Name')
            ->setCellValue('E4', 'Task Name')
            ->setCellValue('F4', 'Comments')
			->setCellValue('G4', 'Resource')
			->setCellValue('H4', 'Time[HH:MM]');
			
		$objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('A4:H4');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		
		//$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);
		//$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true);		
	
	
		$styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '2F4F4F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray1 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray2 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
		);
		
		
		//$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle('A2:A2')->applyFromArray($styleArray2);
		$objPHPExcel->getActiveSheet()->getStyle('A3:A3')->applyFromArray($styleArray2);
		$objPHPExcel->getActiveSheet()->getStyle('C2:C2')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle('C3:C3')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->setAutoFilter('A1:L1');
		
		///////////////////////////////////////////
		
		//date("d-m-Y");
		$date=$start_date;
		$count=5;
		$sl_no=0;
		$task_db_id = 0;
		if($task_id > 0)
			$task_db_id = $this->dbObj->getTaskDbId($task_id);
		$total_hrs=0;
		//echo "::".$task_id.":::".$task_db_id."::<BR>";
		
		while(strtotime($date) <= strtotime($end_date))
		{
			//echo "Date:".$date."<BR>";
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
						//echo "Time:".$time."<BR>";
						//$time_str = $this->dbObj->getTimeText($time* 60);
						$grp_id = $this->dbObj->getProjectTaskGroupIdByDbId($pro_task_db_id);
						$grp_name = $this->dbObj->getGroupName($grp_id);
						$time_str = $this->dbObj->getTimeTextNumberOnly($time* 60);
						$time_str = PHPExcel_Calculation_DateTime::TIMEVALUE($time_str);
						$location = $row1['location'];
						$text = $row1['text'];
						$project_name123  = $this->dbObj->getProjectName($pro_obj);
						$task_name = $this->dbObj->getProjectTaskNameByDbId($pro_task_db_id);
						$employee = $this->dbObj->getEmployeeInfo($emp_id);
						$employee_name = $employee->name;
						//echo "::".$pro_task_db_id.":::".$task_db_id."::<BR>";
						$holiday = $this->dbObj->getHolidayInfo($date);
						if($task_db_id > 0 && $task_db_id == $pro_task_db_id)
						{
							$sl_no++;
							$total_hrs += $time;
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
							$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$date);
							$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$project_name123);
							$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$grp_name);
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$task_name);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$text);
							
							//$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME4);
							$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$employee_name);
							$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$time_str);
							$objPHPExcel->getActiveSheet()->getStyle('A'.$count)->applyFromArray($styleArray1);
							$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleArray1);
							$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleArray1);
							$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleArray1);
							$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->applyFromArray($styleArray1);
							if(strlen($holiday) > 0)
							{
								$objPHPExcel->getActiveSheet()->getComment('B'.$count)
															  ->getText()->createTextRun($holiday);
							}
							$count++;
						}else if(!$task_id){
							$sl_no++;
							$total_hrs += $time;
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
							$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$date);
							$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$project_name123);
							$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$grp_name);
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$task_name);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$text);
							
							//$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME4);
							$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$employee_name);
							$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$time_str);
							$objPHPExcel->getActiveSheet()->getStyle('A'.$count)->applyFromArray($styleArray1);
							$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleArray1);
							$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleArray1);
							$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleArray1);
							$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->applyFromArray($styleArray1);
							if(strlen($holiday) > 0)
							{
								$objPHPExcel->getActiveSheet()->getComment('B'.$count)
															  ->getText()->createTextRun($holiday);
							}
							$count++;						
						}
					}
				}
			}
			$date = date("d-m-Y", strtotime($date." +1 days"));
		}
		
		$objPHPExcel->getActiveSheet()->getStyle('H5:H'.$count)
									->getNumberFormat()
									->setFormatCode("[HH]:MM");
	
		//echo "TTime:".$total_hrs."<BR>";
		$total_time_str = $this->dbObj->getTimeText($total_hrs* 60);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,"Total Hrs[HH:MM]");
		//$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$total_time_str);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,"=SUM(H5:H".($count-1).")");
		$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':H'.$count)->applyFromArray($styleArray);
		
		//////////////////////////////////////////
		$objPHPExcel->setActiveSheetIndex(0);		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						
		$file_path = EXCEL_PATH;
		$file_download_path = ROOT_DIR."admin/excel_files/";
				
		$day_str_name = date('d-m-Y_h-i-s');
		$file_download_name = $customer_name."-".$project_name."_Report_".$day_str_name.".xlsx";
		$file_name = $file_path.$file_download_name;
		$file_download_path= $file_download_path.$file_download_name;		
		
		if(file_exists($file_name))
		{
			$cmd = "rm -rf  ".$file_name."  > /dev/null 2>&1 ";
			exec($cmd);
		}
		//echo "FileName:".$file_name;
		$objWriter->setPreCalculateFormulas();
		$objWriter->save($file_name);
		$msg = "Success";
		$data = array("status" => 1 , "msg" => $msg ,"file_path" => $file_download_path , "file_name" => $file_download_name);

		return $data;
		
	}
	
	
	
	
	
	
	public function generateResoProjectReport($team_id,$pro_id,$task_id,$reso_id,$start_date,$end_date){
		
		$objPHPExcel = new PHPExcel();
		$day_str = date('h:i A - l, d M Y');
		
		$start_date_ptr = strtotime($start_date);
		$end_date_prt = strtotime($end_date);
		if($start_date_ptr > $end_date_prt)
		{
			$msg = "Invalid End date...";	
			$data = array("status" => 0 , "msg" => $msg);
			return $data;
		}
		
		if($reso_id == 0)
		{
			$employee_name = $this->dbObj->getDeptName($team_id)." Team";
		}
		else{
			$employee = $this->dbObj->getEmployeeInfo($reso_id);
			$employee_name = $employee->name;
		}		
					
		$project_name = "ALL";
		if($pro_id > 0)
			$project_name  = $this->dbObj->getProjectName($pro_id);
		
		
		$objPHPExcel->getProperties()->setCreator("OdiTek Admin")
							 ->setLastModifiedBy("OdiTek Admin")
							 ->setTitle("OdiTek Resource Report")
							 ->setSubject("OdiTek Resource HR Report")
							 ->setDescription("OdiTek Resource HR Report")
							 ->setKeywords("")
							 ->setCategory("");
							 
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Resource Hour Report: ');
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setSize(16);
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:B4');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:D2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C3:D3');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C4:D4');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Resources: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Project: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'Period: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', $employee_name);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $project_name);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', $start_date.' to '.$end_date);
		$objPHPExcel->getActiveSheet()->getStyle("A2:C2")->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle("A3:C3")->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle("A4:C4")->getFont()->setSize(14);		
		
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', 'Sl NO')
            ->setCellValue('B5', 'Date')
            ->setCellValue('C5', 'Resource')
            ->setCellValue('D5', 'Project Name')
			->setCellValue('E5', 'Task Name')
			->setCellValue('F5', 'Time')
			->setCellValue('G5', 'Location')
			->setCellValue('H5', 'Comments');
		
		$objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('A5:H5');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(50);
	
	
		$styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '2F4F4F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray1 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray2 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
		);
		
		//$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle('A2:A2')->applyFromArray($styleArray2);
		$objPHPExcel->getActiveSheet()->getStyle('A3:A3')->applyFromArray($styleArray2);
		$objPHPExcel->getActiveSheet()->getStyle('A4:A4')->applyFromArray($styleArray2);
		
		$objPHPExcel->getActiveSheet()->getStyle('C2:C2')->applyFromArray($styleArray1);
		$objPHPExcel->getActiveSheet()->getStyle('C3:C3')->applyFromArray($styleArray1);
		$objPHPExcel->getActiveSheet()->getStyle('C4:C4')->applyFromArray($styleArray1);
		
		$objPHPExcel->getActiveSheet()->getStyle('A5:H5')->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->setAutoFilter('A1:L1');
		
		///////////////////////////////////////////
		
		//date("d-m-Y");
		$date=$start_date;
		$count=6;
		$sl_no=0;
		$task_db_id = 0;
		if($task_id > 0)
			$task_db_id = $this->dbObj->getTaskDbId($task_id);
		$total_hrs=0;
				
		while(strtotime($date) <= strtotime($end_date))
		{
			//echo "Date:".$date."<BR>";
			if($reso_id > 0)
			{
				if($pro_id > 0)
					$dbquery="select * from od_project_dailytask_logs where date='".$date."' and pro_id='".$pro_id."' and emp_id='".$reso_id."' ";
				else
					$dbquery="select * from od_project_dailytask_logs where date='".$date."' and emp_id='".$reso_id."' ";
 			}
			else{
				
				if($pro_id > 0)
					$dbquery="select * from od_project_dailytask_logs where date='".$date."' and pro_id='".$pro_id."' and team_id='".$team_id."' ";
				else
					$dbquery="select * from od_project_dailytask_logs where date='".$date."' and team_id='".$team_id."' ";
			}
			
			//echo $dbquery."<BR>";
			$dbsql1=mysql_query($dbquery);
			$Num1 = mysql_num_rows($dbsql1);
			//echo "Records:".$Num1."<BR>";	
			if ($Num1 > 0)
			{
				while($row1 = mysql_fetch_array($dbsql1))
				{
					$db_emp_id = $row1['emp_id'];
					$reso_pro_id = $row1['pro_id'];
					$pro_name = $this->dbObj->getProjectName($reso_pro_id);
					$pro_task_db_id = $row1['pro_task_id'];
					$time = $row1['time'];
					$time_str = $this->dbObj->getTimeText($time* 60);
					$location = $row1['location'];
					$task_name = $this->dbObj->getProjectTaskNameByDbId($pro_task_db_id);
					$work_location = $this->dbObj->getWorkLocation($row1['location']);
					$comment = $row1['text'];
					$holiday = $this->dbObj->getHolidayInfo($date);
					//echo "Date:".$date."<BR>";
					//echo "Pro_Name:".$pro_name."<BR>";
					//echo "task_name:".$task_name."<BR>";
					$employee = $this->dbObj->getEmployeeInfo($db_emp_id);
					$employee_name1 = $employee->name;
					
					if($task_db_id > 0 && $task_db_id == $pro_task_db_id)
					{
						$sl_no++;
						$total_hrs += $time;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$date);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$employee_name1);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$pro_name);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$task_name);
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$time_str);
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$work_location);
						$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$comment);
						$objPHPExcel->getActiveSheet()->getStyle('A'.$count)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleArray1);
						if(strlen($holiday) > 0)
						{
							$objPHPExcel->getActiveSheet()->getComment('B'.$count)
														  ->getText()->createTextRun($holiday);
						}
						$count++;
					}else if(!$task_id){
						$sl_no++;
						$total_hrs += $time;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$date);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$employee_name1);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$pro_name);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$task_name);
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$time_str);
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$work_location);
						$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$comment);
						$objPHPExcel->getActiveSheet()->getStyle('A'.$count)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleArray1);
						if(strlen($holiday) > 0)
						{
							$objPHPExcel->getActiveSheet()->getComment('B'.$count)
														  ->getText()->createTextRun($holiday);
						}
						$count++;						
					}
				}
			}
			$date = date("d-m-Y", strtotime($date." +1 days"));
		}
		//echo "TTime:".$total_hrs."<BR>";
		$total_time_str = $this->dbObj->getTimeText($total_hrs* 60);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,"Total Hrs");
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$total_time_str);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':H'.$count)->applyFromArray($styleArray);
		
		//////////////////////////////////////////
		$objPHPExcel->setActiveSheetIndex(0);		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						
		$file_path = EXCEL_PATH;
		$file_download_path = ROOT_DIR."admin/excel_files/";
				
		$day_str_name = date('d-m-Y_h-i-s');
		$file_download_name = "Resource-Report_".$employee_name."_".$day_str_name.".xlsx";
		$file_name = $file_path.$file_download_name;
		$file_download_path= $file_download_path.$file_download_name;		
		
		if(file_exists($file_name))
		{
			$cmd = "rm -rf  ".$file_name."  > /dev/null 2>&1 ";
			exec($cmd);
		}
		//echo "FileName:".$file_name;
		$objWriter->save($file_name);
		$msg = "Success";
		$data = array("status" => 1 , "msg" => $msg ,"file_path" => $file_download_path , "file_name" => $file_download_name);

		return $data;
		
	}
	
	
	
	
	public function generateProjectTaskReport($pro_id,$grp_id)
	{
		
		$objPHPExcel = new PHPExcel();
		$day_str = date('h:i A - l, d M Y');
		
		$project_name="";			
		if($pro_id > 0)
			$project_name  = $this->dbObj->getProjectName($pro_id);
		
		
		$objPHPExcel->getProperties()->setCreator("OdiTek Admin")
							 ->setLastModifiedBy("OdiTek Admin")
							 ->setTitle("OdiTek Project Task Report")
							 ->setSubject("OdiTek Project Task Report")
							 ->setDescription("OdiTek Project Task Report")
							 ->setKeywords("")
							 ->setCategory("");
							 
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Project Task Report of "'.$project_name.'" Project');
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setSize(16);
		
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Sl NO')
            ->setCellValue('B2', 'Group Name')
            ->setCellValue('C2', 'Task Name')
			->setCellValue('D2', 'Estimated Time')
            ->setCellValue('E2', 'Actual Time')
			->setCellValue('F2', 'Work %')
			->setCellValue('G2', 'Status');
			
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
		
	
	
		$styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '2F4F4F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray1 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		
		//$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->setAutoFilter('A1:L1');
		
		///////////////////////////////////////////
		
		//date("d-m-Y");
		$count=3;
		$sl_no=0;
		$task_db_id = 0;
		if($task_id > 0)
			$task_db_id = $this->dbObj->getTaskDbId($task_id);
		$total_hrs=0;
		
		if($grp_id > 0)
			$dbquery="select * from od_project_task_info where project_id='".$pro_id."' and grp_id='".$grp_id."' order by id desc";
		else
			$dbquery="select * from od_project_task_info where project_id='".$pro_id."' order by id desc";
		$dbsql=mysql_query($dbquery);
		$Num1 = mysql_num_rows($dbsql);
		if ($Num1 > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$task_id = $row['task_id'];
				$task_name = $row['task_name'];
				$time = $row['task_time'];
				$grp_id1 = $row['grp_id'];
				$grp_name = $this->dbObj->getGroupName($grp_id1);
				$time_str = $this->dbObj->getTimeText($time*60);
				$status = $this->dbObj->getStatusText($row['status']);
				$actual_time = $this->dbObj->getTaskProjectTime($pro_id,$id);
				$actual_time_str = $this->dbObj->getTimeText($actual_time*60);
				$work_percentage = round($actual_time/$time,2)*100;
				$status = $this->dbObj->getStatusText($row['status']);				
			
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$grp_name);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$task_name);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$time_str);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$actual_time_str);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$work_percentage."%");
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$status);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleArray1);
				//$objPHPExcel->getActiveSheet()->getStyle('C'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleArray1);
				$count++;
			}
		}
		//echo "TTime:".$total_hrs."<BR>";
		//$total_time_str = $this->dbObj->getTimeText($total_hrs* 60);
		//$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,"Total Hrs");
		//$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$total_time_str);
		//$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':I'.$count)->applyFromArray($styleArray);
		
		//////////////////////////////////////////
		$objPHPExcel->setActiveSheetIndex(0);		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						
		$file_path = EXCEL_PATH;
		$file_download_path = ROOT_DIR."admin/excel_files/";
				
		$day_str_name = date('d-m-Y_h-i-s');
		$file_download_name = "Project Task Report_".$project_name."_".$day_str_name.".xlsx";
		$file_name = $file_path.$file_download_name;
		$file_download_path= $file_download_path.$file_download_name;		
		
		if(file_exists($file_name))
		{
			$cmd = "rm -rf  ".$file_name."  > /dev/null 2>&1 ";
			exec($cmd);
		}
		//echo "FileName:".$file_name;
		$objWriter->save($file_name);
		$msg = "Success";
		$data = array("status" => 1 , "msg" => $msg ,"file_path" => $file_download_path , "file_name" => $file_download_name);

		return $data;
		
	}
	
	
	
public function generateEmployeeData($rank, $dept_id, $status, $bu_id_input, $type)


	{
		
		$objPHPExcel = new PHPExcel();
		$day_str = date('h:i A - l, d M Y');
		
		/*$text="All Employee [Present]";
		if($rank > 0)
		{
			$rank_name = $this->dbObj->getDesigById($rank);
			$text= "[".$rank_name."] ";
		}
		if($dept_id > 0)
		{
			$dept_name = $this->dbObj->getDeptById($dept_id);
			$text.= "[".$dept_name."] ";
		}
		if($status > 0)
		{
			$status_name = $this->dbObj->getStatusStr($status);
			$text.= "[".$status_name."]";
		}else
		{
			$text.= "[All]";
		}*/
		
		
		$objPHPExcel->getProperties()->setCreator("OdiTek Admin")
							 ->setLastModifiedBy("OdiTek Admin")
							 ->setTitle("OdiTek Resource Data")
							 ->setSubject("OdiTek Resource Data")
							 ->setDescription("OdiTek Resource HR Data")
							 ->setKeywords("")
							 ->setCategory("");
							 
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:T1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Employee Data as on  "'.$day_str.'" ');
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setSize(16);
		
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Sl NO')
            ->setCellValue('B2', 'Emp. Id')
            ->setCellValue('C2', 'Emp. Name')
            ->setCellValue('D2', 'Gender')
            ->setCellValue('E2', 'DOJ')
            ->setCellValue('F2', 'OdiTek Exp.')
            ->setCellValue('G2', 'Status')
            ->setCellValue('H2', 'Email')
            ->setCellValue('I2', 'Mobile')
            ->setCellValue('J2', 'Designation')
            ->setCellValue('K2', 'Department')
            ->setCellValue('L2', 'Report To')
            ->setCellValue('M2', 'Other Email')
            ->setCellValue('N2', 'DOB')
            ->setCellValue('O2', 'Blood Grp')
            ->setCellValue('P2', 'Emergency No')
            ->setCellValue('Q2', 'Skype Id')
            ->setCellValue('R2', 'PAN No')
            ->setCellValue('S2', 'Passport No')
            ->setCellValue('T2', 'Type');

			
		$objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('A2:T2');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(9);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(22);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
	    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
		
		
	
	
		$styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '2F4F4F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray1 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		
		//$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle('A2:T2')->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->setAutoFilter('A1:L1');
		
		///////////////////////////////////////////
		
		//date("d-m-Y");
		$count=3;
		$sl_no=0;
		
		$Chkrkid = ($rank != '0')?"and desig_id='".$rank."'":"";
		$Chkcoyid = ($dept_id != '0')?"and dept_id='".$dept_id."'":"";
		$Chkstatus = ($status != '0')?"and status='".$status."'":"";
		$Chkbu_id = ($bu_id_input != '0') ? "and bu ='".$bu_id_input."'" : "";
        $Chktype = ($type != '0') ? "and type ='".$type."'" : "";
		$dbquery = "select * from od_director
                WHERE did > 0 ".$Chkrkid." ".$Chkcoyid." ".$Chkstatus." ".$Chkbu_id." ".$Chktype."
                order by name asc";
		//echo $dbquery."<BR>";	
		
		$dbsql=mysql_query($dbquery);
		$Num1 = mysql_num_rows($dbsql);
		if ($Num1 > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$eid = $row['did'];
				$DOJ = $row['joining_date'];
				$name = $row['name'];
				//$status = $row['status'];
				//$status_str = $this->dbObj->getStatusStr($status);
				$oditek_exp = $this->dbObj->getEmpExp($DOJ);//"NA"; // need to calculate
				$gender = $row['gender'];
				$gender_str = $this->dbObj->getGender($gender);
				$dob = $row['date_of_birth'];
				$pan_no = $row['pan_no'];
				$passport_no = $row['passport_no'];
				$blood_grp = $row['blood_grp'];
				$mobile = $row['mobile'];
				$emergency = $row['emergency'];
				$email = $row['email'];
				$office_email = $row['office_email'];
				$skype_id = $row['skype_id'];
				$bu_id = $row['bu'];
				$bu_name = $this->dbObj->getAllBUHead($bu_id);
				$upper_id = $row['upper_id']; 
                $upper_name = $this->dbObj->getEmployeeName($upper_id);

				$dept_id1 = $row['dept_id'];
				$dept_name = $this->dbObj->getDeptById($dept_id1);
				$desig_id = $row['desig_id'];
				$desig_name = $this->dbObj->getDesigById($desig_id);
			    $type = $row['type'];
				$type_name = $this->dbObj->getEmpTypeeById($type);
				$status = $row['status'];
				$status_name = $this->dbObj->getStatusById($status);		
				
						
			
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$eid);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$name);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$gender_str);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$DOJ);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$oditek_exp);
				//$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$status_str);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$status_name);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$office_email);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$count,$mobile);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$count,$desig_name);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$count,$dept_name);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$count,$upper_name);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$count,$email);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$count,$dob);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$count,$blood_grp);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$count,$emergency);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$count,$skype_id);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$count,$pan_no);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$count,$passport_no);
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$count,$type_name);
				
				
				
				
				
				
				
				
				
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('R'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('S'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('T'.$count)->applyFromArray($styleArray1);
				$count++;
			} 
		}
		
		
		
		$Chkrkid = ($rank != '0')?"and b.desig_id='".$rank."'":"";
		$Chkcoyid = ($dept_id != '0')?"and b.dept_id='".$dept_id."'":"";
		$Chkstatus = ($status != '0')?"and a.status='".$status."'":"";
		$Chkbu_id = ($bu_id_input != '0') ? "and bu ='".$bu_id_input."'" : "";
		$Chktype = ($type != '0') ? "and type ='".$type."'" : "";
		$dbquery="select a.*,b.* from od_employee a
						inner join od_emp_report b on a.eid = b.eid
						where a.eid > 0 ".$Chkrkid." ".$Chkcoyid." ".$Chkstatus." ".$Chkbu_id." ".$Chktype."
						order by a.name asc";
						
						
		$dbsql=mysql_query($dbquery);
		
		//echo $dbquery."<BR>";
		
		$Num1 = mysql_num_rows($dbsql);
		if ($Num1 > 0)
		{
			while($row = mysql_fetch_array($dbsql))
			{
				$sl_no++;
				$id = $row['id'];
				$eid = $row['eid'];
				$DOJ = $row['joining_date'];
				$name = $row['name'];
				//$status1 = $row['status'];
				//$status_str = $this->dbObj->getStatusStr($status1);
				$oditek_exp = $this->dbObj->getEmpExp($DOJ);//"NA"; // need to calculate
				$gender = $row['gender'];
				$gender_str = $this->dbObj->getGender($gender);
				$dob = $row['date_of_birth'];
				$pan_no = $row['pan_no'];
				$passport_no = $row['passport_no'];
				$blood_grp = $row['blood_grp'];
				$mobile = $row['mobile'];
				$emergency = $row['emergency'];
				$email = $row['email'];
				$office_email = $row['office_email'];
				$skype_id = $row['skype_id'];
				$upper_id = $row['upper_id']; 
                $upper_name = $this->dbObj->getEmployeeName($upper_id);
				//echo $name."::".$upper_id."::".$upper_name."<BR>";
				$bu_id = $row['bu'];
				$bu_name = $this->dbObj->getAllBUHead($bu_id);
				$dept_id = $row['dept_id'];
				$dept_name = $this->dbObj->getDeptById($dept_id);
				$desig_id = $row['desig_id'];
				$desig_name = $this->dbObj->getDesigById($desig_id);
				$type = $row['type'];
				$type_name = $this->dbObj->getEmpTypeeById($type);
				$status = $row['status'];
				$status_name = $this->dbObj->getStatusById($status);		
			
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$eid);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$name);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$gender_str);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$DOJ);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$oditek_exp);
				//$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$status_str);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$status_name);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$office_email);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$count,$mobile);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$count,$desig_name);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$count,$dept_name);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$count,$upper_name);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$count,$email);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$count,$dob);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$count,$blood_grp);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$count,$emergency);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$count,$skype_id);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$count,$pan_no);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$count,$passport_no);
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$count,$type_name);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('R'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('S'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('T'.$count)->applyFromArray($styleArray1);
				$count++;
			}
		}
		
				
		//////////////////////////////////////////
		$objPHPExcel->setActiveSheetIndex(0);		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						
		$file_path = EXCEL_PATH;
		$file_download_path = ROOT_DIR."admin/excel_files/";
				
		$day_str_name = date('d-m-Y_h-i-s');
		$file_download_name = "Employee_HR_Records_".$day_str_name.".xlsx";
		$file_name = $file_path.$file_download_name;
		$file_download_path= $file_download_path.$file_download_name;		
		
		if(file_exists($file_name))
		{
			$cmd = "rm -rf  ".$file_name."  > /dev/null 2>&1 ";
			exec($cmd);
		}
		//echo "FileName:".$file_name;
		$objWriter->save($file_name);
		$msg = "Success";
		$data = array("status" => 1 , "msg" => $msg ,"file_path" => $file_download_path , "file_name" => $file_download_name);

		return $data;
		
	}
	
	
	
	
	
	
	public function generateImprovementReport($pro, $type, $res, $start_date, $end_date)
{
   
    $objPHPExcel = new PHPExcel();

   
    $day_str = date('h:i A - l, d M Y');

    
    $objPHPExcel->getProperties()->setCreator("OdiTek Admin")
                                   ->setLastModifiedBy("OdiTek Admin")
                                   ->setTitle("OdiTek Improvement Data")
                                   ->setSubject("OdiTek Improvement Data")
                                   ->setDescription("OdiTek Improvement Data")
                                   ->setKeywords("")
                                   ->setCategory("");

   
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Improvement Data as on "' . $day_str . '"');
    $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);

    
     $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A2', 'Sl NO')
                ->setCellValue('B2', 'DATE')
                ->setCellValue('C2', 'IMPR.ID')
                ->setCellValue('D2', 'REPORTED.BY')
                 ->setCellValue('E2', 'TITLE')
                ->setCellValue('F2', 'TYPE')
                ->setCellValue('G2', 'RESPONSIBLE')
                ->setCellValue('H2', 'PRIORITY')
                ->setCellValue('I2', 'ASSIGN.TO')
               
                ->setCellValue('J2', 'STATUS');

   $styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '2F4F4F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray1 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
    $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($styleArray);

    // Set column widths
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    

    // Fetch data from database
    
    	
    $sql_conditions = " WHERE 1=1";

    if ($type != 0) { 
        $sql_conditions .= " AND type = '$type'";
    }
    if ($res != 0) {
        $sql_conditions .= " AND responsible = '$res'";
    }
    if ($pro != 0) {
        $sql_conditions .= " AND priority = '$pro'";
    }
    $start_date_str = date("Y-m-d", strtotime($start_date));
    $end_date_str = date("Y-m-d", strtotime($end_date));

    
	$qry = "SELECT * FROM od_impr_record" . $sql_conditions . " ORDER BY id DESC ";
   
    $dbsql = mysql_query($qry);
   $num_rows = mysql_num_rows($dbsql); 
   
   //echo $qry."::<BR>";
   //echo $num_rows."::<BR>";//imp

    // Initialize variables
	
    $count = 3; 
    $sl_no = 0; 
 if ($num_rows > 0) {
        while ($row = mysql_fetch_array($dbsql)) {
            $sl_no++;

            
            $assign_name =  $this->dbObj->getEmpName($row['assignto']);
            $type_name =  $this->dbObj->getImprtype($row['type']);
            $reported_name = $row['reportedby'] == 0 ? "Anonymous" : $this->dbObj->getEmpName($row['reportedby']);
            $responsible_name =  $this->dbObj->getImprresponsible($row['responsible']);
            $priority_name = $this->dbObj->getImprPriority($row['priority']);
			$status = $row['status'];
            $status_str =$this->dbObj->getIMPRStatusString($status);
            $title = $row['title'];
			//echo $row['reportedby']."::NAME:".$reported_name."<BR>";imp

            // Set cell values
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $count, $sl_no);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $count, $row['date']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $count, $row['imprid']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $count, $reported_name);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $count, $title);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $count, $type_name);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $count, $responsible_name);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $count, $priority_name);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $count, $assign_name);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $count, $status_str);
          
             $objPHPExcel->getActiveSheet()->getStyle('A'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->applyFromArray($styleArray1);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$count)->applyFromArray($styleArray1);




            // Increment row counter
            $count++;
        }
    }

    // Save the Excel file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $file_path = EXCEL_PATH;
    $file_download_path = ROOT_DIR."admin/excel_files/";
    $day_str_name = date('d-m-Y_h-i-s');
    $file_download_name = "Employee_HR_Records_".$day_str_name.".xlsx";
    $file_name = $file_path.$file_download_name;
    $file_download_path = $file_download_path.$file_download_name;

 
    if(file_exists($file_name)) {
        $cmd = "rm -rf  ".$file_name."  > /dev/null 2>&1 ";
        exec($cmd);
    }

    // Save Excel file
    $objWriter->save($file_name);

    // Prepare response
    $msg = "Success";
    $data = array("status" => 1, "msg" => $msg, "file_path" => $file_download_path, "file_name" => $file_download_name);
    return $data;
}
	

public function generatePurchaseReport($bu_head, $pr_head, $start_date, $end_date)
{
    $objPHPExcel = new PHPExcel();

    $day_str = date('h:i A - l, d M Y');

    $objPHPExcel->getProperties()->setCreator("OdiTek Admin")
                                   ->setLastModifiedBy("OdiTek Admin")
                                   ->setTitle("OdiTek Purchase Data")
                                   ->setSubject("OdiTek Purchase Data")
                                   ->setDescription("OdiTek Purchase Data")
                                   ->setKeywords("")
                                   ->setCategory("");

    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Purchase Data as on "' . $day_str . '"');
    $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A2', 'Sl NO')
                ->setCellValue('B2', 'DATE')
                ->setCellValue('C2', 'PR.ID')
                ->setCellValue('D2', 'TITLE')
                ->setCellValue('E2', 'BU_HEAD')
                ->setCellValue('F2', 'PR_HEAD')
                ->setCellValue('G2', 'COST')
                ->setCellValue('H2', 'CREATED.BY')
                ->setCellValue('I2', 'STATUS');

    $styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '2F4F4F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    
    $styleArray1 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray);

    // Set column widths
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);

    // Fetch data from database
    $sql_conditions = " WHERE 1=1";

    if ($bu_head != "0") { 
        $sql_conditions .= " AND bu = '$bu_head'";
    }
    if ($pr_head != "0") {
        $sql_conditions .= " AND head = '$pr_head'";
    }

    $start_date_str = date("Y-m-d", strtotime($start_date));
    $end_date_str = date("Y-m-d", strtotime($end_date));

    $dbsql = mysql_query("SELECT * FROM od_pr_request" . $sql_conditions . " ORDER BY id DESC ");

    $Num = mysql_num_rows($dbsql);

    // Initialize variables
    $count = 3; 
    $sl_no = 0; 

    if ($Num > 0) {
        while ($row = mysql_fetch_array($dbsql)) {
            $sl_no++;

            $title = stripslashes($row['title']);
            $bu = $row['bu'];
            $bu_name =  $this->dbObj->getBUnitById($bu);
            $head = $row['head'];
            $head_name =  $this->dbObj->getPRHeadString($head);
            $created_eid = $row['eid'];
            $created_by =  $this->dbObj->getEmpName($created_eid);
            $cost = $row['cost'];
            $status = $row['status'];
            $status_str =  $this->dbObj->getPRStatusString($status);

           
            $date_str = date("Y-m-d", strtotime($row['date']));
            if ($date_str >= $start_date_str && $date_str <= $end_date_str) {
                // Set cell values
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $count, $sl_no);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $count, $row['date']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $count, $row['sid']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $count, $title);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $count, $bu_name);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $count, $head_name);
                $formatted_cost = '₹' . number_format($cost);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $count, $formatted_cost);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $count, $created_by);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $count, $status_str);
              
                // Apply styles
                $objPHPExcel->getActiveSheet()->getStyle('A'.$count.':I'.$count)->applyFromArray($styleArray1);

                // Increment row counter
                $count++;
            }
        }
    }

    // Save the Excel file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $file_path = EXCEL_PATH;
    $file_download_path = ROOT_DIR."admin/excel_files/";
    $day_str_name = date('d-m-Y_h-i-s');
    $file_download_name = "Purchase_Report_".$day_str_name.".xlsx";
    $file_name = $file_path.$file_download_name;
    $file_download_path = $file_download_path.$file_download_name;

    if(file_exists($file_name)) {
        $cmd = "rm -rf  ".$file_name."  > /dev/null 2>&1 ";
        exec($cmd);
    }

    // Save Excel file
    $objWriter->save($file_name);

    // Prepare response
    $msg = "Success";
    $data = array("status" => 1, "msg" => $msg, "file_path" => $file_download_path, "file_name" => $file_download_name);
    return $data;
}



public function generateITReport($pro, $start_date, $end_date)
{
    $objPHPExcel = new PHPExcel();

    $day_str = date('h:i A - l, d M Y');

    $objPHPExcel->getProperties()->setCreator("OdiTek Admin")
                                   ->setLastModifiedBy("OdiTek Admin")
                                   ->setTitle("OdiTek IT Report")
                                   ->setSubject("OdiTek IT Report")
                                   ->setDescription("OdiTek IT Report")
                                   ->setKeywords("")
                                   ->setCategory("");

    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek IT Report Data as on "' . $day_str . '"');
    $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A2', 'Sl NO')
                ->setCellValue('B2', 'DATE')
                ->setCellValue('C2', 'SERVICE.ID')
                ->setCellValue('D2', 'CREATED.BY')
                ->setCellValue('E2', 'TITLE')
                ->setCellValue('F2', 'PRIORITY')
                ->setCellValue('G2', 'STATUS');
               
    $styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '2F4F4F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    
    $styleArray1 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray);

    // Set column widths
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
   
    

    // Fetch data from database
    $sql_conditions = " WHERE 1=1";

        if ($pro != "0") {
            $sql_conditions .= " AND priority = '$pro'";
        }

    $start_date_str = date("Y-m-d", strtotime($start_date));
    $end_date_str = date("Y-m-d", strtotime($end_date));

    $dbsql = mysql_query("SELECT * FROM od_it_request" . $sql_conditions . " ORDER BY id DESC ");

    $Num = mysql_num_rows($dbsql);

    // Initialize variables
    $count = 3; 
    $sl_no = 0; 

    if ($Num > 0) {
        while ($row = mysql_fetch_array($dbsql)) {
            $sl_no++;

            
                $sid = $row['sid'];
                $eid = $row['eid'];
                $emp_name = $this->dbObj->getEmpName($eid);
                $title = stripslashes($row['title']);
                $status = $row['status'];
                $priority = $row['priority'];
			    $priority = $this->dbObj->getITReqPriority($priority);
                $status_str = $this->dbObj->getITStatusString($status);
           
            $date_str = date("Y-m-d", strtotime($row['date']));
            if ($date_str >= $start_date_str && $date_str <= $end_date_str) {
                // Set cell values
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $count, $sl_no);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $count, $row['date']);
               $objPHPExcel->getActiveSheet()->setCellValue('C' . $count, '#' . $row['sid']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $count, $emp_name);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $count, $title);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $count, $priority);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $count, $status_str);
                
			  
                // Apply styles
                $objPHPExcel->getActiveSheet()->getStyle('A'.$count.':I'.$count)->applyFromArray($styleArray1);

                // Increment row counter
                $count++;
            }
        }
    }

    // Save the Excel file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $file_path = EXCEL_PATH;
    $file_download_path = ROOT_DIR."admin/excel_files/";
    $day_str_name = date('d-m-Y_h-i-s');
    $file_download_name = "Purchase_Report_".$day_str_name.".xlsx";
    $file_name = $file_path.$file_download_name;
    $file_download_path = $file_download_path.$file_download_name;

    if(file_exists($file_name)) {
        $cmd = "rm -rf  ".$file_name."  > /dev/null 2>&1 ";
        exec($cmd);
    }

    // Save Excel file
    $objWriter->save($file_name);

    // Prepare response
    $msg = "Success";
    $data = array("status" => 1, "msg" => $msg, "file_path" => $file_download_path, "file_name" => $file_download_name);
    return $data;
}






	
	public function generateInvoiceReport($cus_id,$pro_id,$inv_type,$inv_status,$start_date,$end_date)
	{
		
		$objPHPExcel = new PHPExcel();
		$day_str = date('h:i A - l, d M Y');
		$start_date_ptr = strtotime($start_date);
		$end_date_prt = strtotime($end_date);
		if($start_date_ptr > $end_date_prt)
		{
			$msg = "Invalid End date...";	
			$data = array("status" => 0 , "msg" => $msg);
			return $data;
		}
		
		
		//////////////////////////////////////////////////////////////
		
		$customer_name = "All";
		if($cus_id > 0)
			$customer_name = $this->dbObj->getCustomerName($cus_id);	
		
		$objPHPExcel->getProperties()->setCreator("OdiTek Admin")
							 ->setLastModifiedBy("OdiTek Admin")
							 ->setTitle("OdiTek Invoice Report")
							 ->setSubject("OdiTek Invoice Report")
							 ->setDescription("OdiTek Invoice Report")
							 ->setKeywords("")
							 ->setCategory("");
							 
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Invoice Report: ');
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setSize(16);
		
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:E2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C3:E3');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Customer Name: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Period: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', $customer_name);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $start_date.' to '.$end_date);
		$objPHPExcel->getActiveSheet()->getStyle("A2:C2")->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle("A3:C3")->getFont()->setSize(14);	
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Sl NO')
            ->setCellValue('B4', 'Invoice Date')
			->setCellValue('C4', 'Invoice Id')
			->setCellValue('D4', 'Customer Name')
            ->setCellValue('E4', 'Project Name')
            ->setCellValue('F4', 'Type')
			->setCellValue('G4', 'Status')
			->setCellValue('H4', 'Currency')
			->setCellValue('I4', 'Billed Amt.')
			->setCellValue('J4', 'GST')
			->setCellValue('K4', '[₹]INR Amt.')
			->setCellValue('L4', '[₹]GST Amt.')
			->setCellValue('M4', '[₹]Total Amt.')
			->setCellValue('N4', 'Due Date')
			->setCellValue('O4', '[₹]Received Amt.')
		    ->setCellValue('P4', 'Note');
			
			
		$objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('A4:P4');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(50);
		
		
			
		$styleCenterBold = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '2F4F4F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleCenter = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleRight = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
		);
		
				
		$styleRightBold = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'FF0000')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
		);
		
		
		//$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle('A2:A2')->applyFromArray($styleRight);
		$objPHPExcel->getActiveSheet()->getStyle('A3:A3')->applyFromArray($styleRight);
		$objPHPExcel->getActiveSheet()->getStyle('C2:C2')->applyFromArray($styleCenterBold);
		$objPHPExcel->getActiveSheet()->getStyle('C3:C3')->applyFromArray($styleCenterBold);
		$objPHPExcel->getActiveSheet()->getStyle('A4:P4')->applyFromArray($styleCenterBold);
		//$objPHPExcel->getActiveSheet()->setAutoFilter('A1:L1');
		
		///////////////////////////////////////////
		
		//date("d-m-Y");
		$date=$start_date;
		$count=5;
		$sl_no=0;
				
		//echo "::".$task_id.":::".$task_db_id."::<BR>";
		$chk_cus_id = ($cus_id != '0')?"and cus_id='".$cus_id."'":"";
		$chk_pro_id = ($pro_id != '0')?"and pro_id='".$pro_id."'":"";
		$chk_inv_type = ($inv_type != '0')?"and inv_type='".$inv_type."'":"";
		$chk_inv_status = ($inv_status != '0')?"and bill_status='".$inv_status."'":"";
		
		$t_inr=0;
		$t_gst=0;
		$t_total=0;
		$t_received=0;
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
						$cus_name = $this->dbObj->getCustomerName($db_cus_id);
						$db_pro_id  = $row['pro_id'];
						$pro_name = $this->dbObj->getProjectName($db_pro_id);
						$inv_date  = $row['inv_date'];
						$inv_id  = $row['inv_id'];
						$db_inv_type  = $row['inv_type'];
						$inv_type_str = $this->dbObj->getInvoiceTypeById($db_inv_type);
						$bill_status  = $row['bill_status'];
						$bill_status_str = $this->dbObj->getInvoiceStatusById($bill_status);
						$gst_str = "NO"; $gst  = $row['gst']; if($gst == 1) $gst_str = "YES";
						$bill_amt  = $row['bill_amt'];
						$bill_inr  = $row['bill_inr'];
						$bill_inr_int = number_format($bill_inr);
						$t_inr += $bill_inr;
						$bill_gst  = $row['bill_gst'];
						$t_gst += $bill_gst;
						$bill_curr = $row['bill_curr'];
						$bill_curr_str = $this->dbObj->getBiiledCurrencyById($bill_curr);
						$bill_total  = $row['bill_total'];
						$t_total += $bill_total;
						$due_date  = $row['due_date'];
						$inv_note  = $row['inv_note'];
						$received_amt = $this->dbObj->getInvoiceReceivedAmount($cus_id,$inv_id);
						$t_received += $received_amt;
						
						
						
						$objPHPExcel->getActiveSheet()->getStyle('K'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						$objPHPExcel->getActiveSheet()->getStyle('L'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						$objPHPExcel->getActiveSheet()->getStyle('M'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						$objPHPExcel->getActiveSheet()->getStyle('O'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				
						
						
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$inv_date);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$inv_id);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$cus_name);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$pro_name);
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$inv_type_str);
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$bill_status_str);
						$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$bill_curr_str);
						$objPHPExcel->getActiveSheet()->setCellValue('I'.$count,$bill_curr_str." ".$bill_amt);
						$objPHPExcel->getActiveSheet()->setCellValue('J'.$count,$gst_str);
						$objPHPExcel->getActiveSheet()->setCellValue('K'.$count,$bill_inr);
						$objPHPExcel->getActiveSheet()->setCellValue('L'.$count,$bill_gst);
						$objPHPExcel->getActiveSheet()->setCellValue('M'.$count,$bill_total);
						$objPHPExcel->getActiveSheet()->setCellValue('N'.$count,$due_date);
						$objPHPExcel->getActiveSheet()->setCellValue('O'.$count,$received_amt);
						$objPHPExcel->getActiveSheet()->setCellValue('P'.$count,$inv_note);
							
					    $objPHPExcel->getActiveSheet()->getStyle('A'.$count)->applyFromArray($styleCenter);
						$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleCenter);
						$objPHPExcel->getActiveSheet()->getStyle('C'.$count)->applyFromArray($styleCenter);
						$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleCenter);
						$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->applyFromArray($styleCenter);
						$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleCenter);
						$objPHPExcel->getActiveSheet()->getStyle('J'.$count)->applyFromArray($styleCenter);
						$objPHPExcel->getActiveSheet()->getStyle('N'.$count)->applyFromArray($styleCenter);
						$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->applyFromArray($styleCenter);
						
						$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->applyFromArray($styleRight);
						$objPHPExcel->getActiveSheet()->getStyle('K'.$count)->applyFromArray($styleRight);
						$objPHPExcel->getActiveSheet()->getStyle('L'.$count)->applyFromArray($styleRight);
						$objPHPExcel->getActiveSheet()->getStyle('M'.$count)->applyFromArray($styleRight);
						$objPHPExcel->getActiveSheet()->getStyle('O'.$count)->applyFromArray($styleRight);
						
													
						$count++;
				}
			}
			$date = date("d-m-Y", strtotime($date." +1 days"));
		}
		
		
		
		$objPHPExcel->getActiveSheet()->getStyle('K'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle('O'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		
		$objPHPExcel->getActiveSheet()->getStyle('K'.$count)->applyFromArray($styleRightBold);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$count)->applyFromArray($styleRightBold);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$count)->applyFromArray($styleRightBold);
		$objPHPExcel->getActiveSheet()->getStyle('O'.$count)->applyFromArray($styleRightBold);
		
		$objPHPExcel->getActiveSheet()->setCellValue('K'.$count,$t_inr);
		$objPHPExcel->getActiveSheet()->setCellValue('L'.$count,$t_gst);
		$objPHPExcel->getActiveSheet()->setCellValue('M'.$count,$t_total);
		$objPHPExcel->getActiveSheet()->setCellValue('O'.$count,$t_received);
	
		
		//$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$total_time_str);
		//$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,"=SUM(H5:H".($count-1).")");
		//$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':H'.$count)->applyFromArray($styleArray);
		
		//////////////////////////////////////////
		$objPHPExcel->setActiveSheetIndex(0);		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						
		$file_path = EXCEL_PATH;
		$file_download_path = ROOT_DIR."admin/excel_files/";
				
		$day_str_name = date('d-m-Y_h-i-s');
		$file_download_name = "OdiTek_Invoice_".$start_date."-".$end_date."_Report_".$day_str_name.".xlsx";
		$file_name = $file_path.$file_download_name;
		$file_download_path= $file_download_path.$file_download_name;		
		
		if(file_exists($file_name))
		{
			$cmd = "rm -rf  ".$file_name."  > /dev/null 2>&1 ";
			exec($cmd);
		}
		//echo "FileName:".$file_name;
		$objWriter->setPreCalculateFormulas();
		$objWriter->save($file_name);
		$msg = "Success";
		$data = array("status" => 1 , "msg" => $msg ,"file_path" => $file_download_path , "file_name" => $file_download_name);

		return $data;
		
	}
	
	
	
	
	
	
	public function generateReceivedReport($cus_id,$pro_id,$start_date,$end_date)
	{
		
		$objPHPExcel = new PHPExcel();
		$day_str = date('h:i A - l, d M Y');
		
		$start_date_ptr = strtotime($start_date);
		$end_date_prt = strtotime($end_date);
		if($start_date_ptr > $end_date_prt)
		{
			$msg = "Invalid End date...";	
			$data = array("status" => 0 , "msg" => $msg);
			return $data;
		}
		
		
		//////////////////////////////////////////////////////////////
		
		$customer_name = "All";
		if($cus_id > 0)
			$customer_name = $this->dbObj->getCustomerName($cus_id);	
		
		$objPHPExcel->getProperties()->setCreator("OdiTek Admin")
							 ->setLastModifiedBy("OdiTek Admin")
							 ->setTitle("OdiTek Payment Received Report")
							 ->setSubject("OdiTek Payment Received Report")
							 ->setDescription("OdiTek Payment Received Report")
							 ->setKeywords("")
							 ->setCategory("");
							 
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Payment Received Report: ');
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setSize(16);
		
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:E2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C3:E3');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Customer Name: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Period: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', $customer_name);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $start_date.' to '.$end_date);
		$objPHPExcel->getActiveSheet()->getStyle("A2:C2")->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle("A3:C3")->getFont()->setSize(14);	
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Sl NO')
            ->setCellValue('B4', 'Received Date')
			->setCellValue('C4', 'Invoice Id')
			->setCellValue('D4', 'Inv. Date')
            ->setCellValue('E4', 'Customer Name')
            ->setCellValue('F4', 'Project Name')
			->setCellValue('G4', '[₹]Billed Amount')
			->setCellValue('H4', '[₹]Received Amount')
			->setCellValue('I4', 'Received Mode')
			->setCellValue('J4', 'Note');
			
			
		$objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('A4:J4');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(50);
		
		
		
			
		$styleCenterBold = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '2F4F4F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleCenter = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleRight = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
		);
		
				
		$styleRightBold = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'FF0000')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
		);
		
		$styleRightBoldBlack = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '000000')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
		);
		
		
		//$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle('A2:A2')->applyFromArray($styleRight);
		$objPHPExcel->getActiveSheet()->getStyle('A3:A3')->applyFromArray($styleRight);
		$objPHPExcel->getActiveSheet()->getStyle('C2:C2')->applyFromArray($styleCenterBold);
		$objPHPExcel->getActiveSheet()->getStyle('C3:C3')->applyFromArray($styleCenterBold);
		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->applyFromArray($styleCenterBold);
		//$objPHPExcel->getActiveSheet()->setAutoFilter('A1:L1');
		
		///////////////////////////////////////////
		
		//date("d-m-Y");
		$date=$start_date;
		$count=5;
		$sl_no=0;
				
		//echo "::".$task_id.":::".$task_db_id."::<BR>";
		$chk_cus_id = ($cus_id != '0')?"and cus_id='".$cus_id."'":"";
		
		$t_total=0;
		$t_received=0;
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
					
						$t_received += $recv_amt;	
						$cus_name = $this->dbObj->getCustomerName($db_cus_id);
						$invRow = $this->dbObj->getInvoiceRow($inv_id);
						$db_pro_id  = $invRow['pro_id'];
						$inv_date  = $invRow['inv_date'];
						$bill_total  = $invRow['bill_total'];
						$t_total += $bill_total;
						$pro_name = $this->dbObj->getProjectName($db_pro_id);
						$recv_mod_str = $this->dbObj->getInvoiceReceivedModeById($recv_mod);
						$add= true;
						if($pro_id > 0 && $pro_id != $db_pro_id)
							$add= false;
					
										
						if($add)
						{
							$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
							$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
												
							
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
							$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$recv_date);
							$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$inv_id);
							$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$inv_date);
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$cus_name);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$pro_name);
							$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$bill_total);
							$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$recv_amt);
							$objPHPExcel->getActiveSheet()->setCellValue('I'.$count,$recv_mod_str);
							$objPHPExcel->getActiveSheet()->setCellValue('J'.$count,$recv_note);
							
							
							$objPHPExcel->getActiveSheet()->getStyle('A'.$count)->applyFromArray($styleCenter);
							$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleCenter);
							$objPHPExcel->getActiveSheet()->getStyle('C'.$count)->applyFromArray($styleCenter);
							$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleCenter);
							$objPHPExcel->getActiveSheet()->getStyle('E'.$count)->applyFromArray($styleCenter);
							$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->applyFromArray($styleCenter);
							$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->applyFromArray($styleCenter);
							
							$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleRight);
							$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->applyFromArray($styleRight);
							
														
							$count++;
						}
				}
			}
			$date = date("d-m-Y", strtotime($date." +1 days"));
		}
		
		
		
		$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		
		
		$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleRightBold);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->applyFromArray($styleRightBold);
				
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$t_total);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$t_received);
		
		$count++;
		$count++;
		$count++;
		
		$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleRightBoldBlack);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->applyFromArray($styleRightBold);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,"Total Billed Amount[₹]:");
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$t_total);
		
		$count++;
		
		$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleRightBoldBlack);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->applyFromArray($styleRightBold);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,"Total Recvd. Amount[₹]:");
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$t_received);
		
		$count++;
		
		$t_diff = $t_total - $t_received;
		$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleRightBoldBlack);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->applyFromArray($styleRightBold);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$count)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,"Balance[₹]:");
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$t_diff);
		
		
				
		//////////////////////////////////////////
		$objPHPExcel->setActiveSheetIndex(0);		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						
		$file_path = EXCEL_PATH;
		$file_download_path = ROOT_DIR."admin/excel_files/";
				
		$day_str_name = date('d-m-Y_h-i-s');
		$file_download_name = "OdiTek_Payment_Received_".$start_date."-".$end_date."_Report_".$day_str_name.".xlsx";
		$file_name = $file_path.$file_download_name;
		$file_download_path= $file_download_path.$file_download_name;		
		
		if(file_exists($file_name))
		{
			$cmd = "rm -rf  ".$file_name."  > /dev/null 2>&1 ";
			exec($cmd);
		}
		//echo "FileName:".$file_name;
		$objWriter->setPreCalculateFormulas();
		$objWriter->save($file_name);
		$msg = "Success";
		$data = array("status" => 1 , "msg" => $msg ,"file_path" => $file_download_path , "file_name" => $file_download_name);

		return $data;
		
	}
	
	
	public function generateEmployeeCovidReport()
	{
		
		$objPHPExcel = new PHPExcel();
		$day_str = date('h:i A - l, d M Y');
		
				
		$objPHPExcel->getProperties()->setCreator("OdiTek Admin")
							 ->setLastModifiedBy("OdiTek Admin")
							 ->setTitle("OdiTek Covid-19 Vaccination Data")
							 ->setSubject("OdiTek Covid-19 Vaccination Data")
							 ->setDescription("OdiTek Covid-19 Vaccination Data")
							 ->setKeywords("")
							 ->setCategory("");
							 
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Employee Covid-19 Vaccination Data as on  "'.$day_str.'" ');
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setSize(16);
		
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', 'Sl NO')
            ->setCellValue('B5', 'Emp. Id')
            ->setCellValue('C5', 'Emp. Name')
			->setCellValue('D5', 'Gender')
			->setCellValue('E5', 'Vaccine Name')
			->setCellValue('F5', 'Date of 1st dose')
			->setCellValue('G5', 'Date of 2nd dose');
			
		$objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('A5:G5');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(22);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(22);
		
	
	
		$styleArray = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '2F4F4F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray1 = array(
		'font' => array(
            'bold' => false,
            'color' => array('rgb' => '27AE60')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray2 = array(
		'font' => array(
            'bold' => false,
            'color' => array('rgb' => 'F4D03F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray3 = array(
		'font' => array(
            'bold' => false,
            'color' => array('rgb' => 'EE0000')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray2dg = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '27AE60')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
		);
		
		$styleArray3dg = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => '27AE60')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray2o = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'F4D03F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
		);
		
		$styleArray3o = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'F4D03F')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		$styleArray2r = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'EE0000')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
		);
		
		$styleArray3r = array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'EE0000')
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
		);
		
		//$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle('A5:G5')->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->setAutoFilter('A1:L1');
		
		///////////////////////////////////////////
		
		//date("d-m-Y");
		$count=6;
		$sl_no=0;
		
		$fully_vaccinated=0;
		$partially_vaccinated=0;
		$not_vaccinated=0;
		
		$allEmpList = $this->dbObj->getAllActiveEmployeeList();
				
		foreach($allEmpList as $emp)
		{
			$sl_no++;
			$eid = 	$emp->eid;
			$emp_data = $this->dbObj->getEmployeeData($eid);
			$name = $emp_data->name;
			$gender = $emp_data->gender;
			$vaccine_name="NA";
			$vaccine1="NA";
			$vaccine2="NA";
			
			$dbquery="select * from od_covid_info where emp_id='".$eid."' ";
			$dbsql=mysql_query($dbquery);
			if($row = mysql_fetch_array($dbsql))
			{
				$vaccine_name = $row['vaccine'];
				$vaccine1 = $row['vac_dose1'];
				$vaccine2 = $row['vac_dose2'];
				if($vaccine2=="")
				{	
					$vaccine2="NA";
					$partially_vaccinated++;
					$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':G'.$count)->applyFromArray($styleArray2);
				}	
				else{
					$fully_vaccinated++;
					$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':G'.$count)->applyFromArray($styleArray1);
				}
			}else{
				
				$not_vaccinated++;
				$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':G'.$count)->applyFromArray($styleArray3);
			}	
										
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$eid);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$name);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$gender);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$vaccine_name);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$vaccine1);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$vaccine2);
				
			//$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':G'.$count)->applyFromArray($styleArray1);
			//$objPHPExcel->getActiveSheet()->getStyle('B'.$count)->applyFromArray($styleArray1);
			//$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleArray1);
			//$objPHPExcel->getActiveSheet()->getStyle('D'.$count)->applyFromArray($styleArray1);
			//$objPHPExcel->getActiveSheet()->getStyle('E'.$count)->applyFromArray($styleArray1);
			//$objPHPExcel->getActiveSheet()->getStyle('F'.$count)->applyFromArray($styleArray1);
			//$objPHPExcel->getActiveSheet()->getStyle('G'.$count)->applyFromArray($styleArray1);
				
			$count++;
		}
		
		$objPHPExcel->getActiveSheet()->setCellValue('C2',"Fully Vaccinated:");
		$objPHPExcel->getActiveSheet()->setCellValue('D2',$fully_vaccinated);
		$objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($styleArray2dg);
		$objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($styleArray3dg);
		
		$objPHPExcel->getActiveSheet()->setCellValue('C3',"Partially Vaccinated:");
		$objPHPExcel->getActiveSheet()->setCellValue('D3',$partially_vaccinated);
		$objPHPExcel->getActiveSheet()->getStyle('C3')->applyFromArray($styleArray2o);
		$objPHPExcel->getActiveSheet()->getStyle('D3')->applyFromArray($styleArray3o);
		
		$objPHPExcel->getActiveSheet()->setCellValue('C4',"Not Vaccinated Yet:");
		$objPHPExcel->getActiveSheet()->setCellValue('D4',$not_vaccinated);
		$objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($styleArray2r);
		$objPHPExcel->getActiveSheet()->getStyle('D4')->applyFromArray($styleArray3r);
		
		//////////////////////////////////////////
		$objPHPExcel->setActiveSheetIndex(0);		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						
		$file_path = EXCEL_PATH;
		$file_download_path = ROOT_DIR."admin/excel_files/";
				
		$day_str_name = date('d-m-Y_h-i-s');
		$file_download_name = "Employee_Covid19_Vaccine_Records_".$day_str_name.".xlsx";
		$file_name = $file_path.$file_download_name;
		$file_download_path= $file_download_path.$file_download_name;		
		
		if(file_exists($file_name))
		{
			$cmd = "rm -rf  ".$file_name."  > /dev/null 2>&1 ";
			exec($cmd);
		}
		//echo "FileName:".$file_name;
		$objWriter->save($file_name);
		$msg = "Success";
		$data = array("status" => 1 , "msg" => $msg ,"file_path" => $file_download_path , "file_name" => $file_download_name);

		return $data;
		
	}
	
	
	
	
}
?>