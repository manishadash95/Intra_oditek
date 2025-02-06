<?php
ini_set("display_errors",0);
require_once 'dbcon/config.php';
include_once 'dbcon/DBConnection.php';
require_once 'admin/phpexcel/Classes/PHPExcel.php';
date_default_timezone_set('Asia/Kolkata');

$dbobj = new DBConnection();
$db =  $dbobj->connect();

ini_set("display_errors",0);
	
class LeaveRecordExcelGenerator{
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
	

 
	public function generateLeaveSummaryReport($start_date,$end_date,$emp_id){
		
		$start_date = date("d-m-Y", strtotime($start_date)); 
		$end_date = date("d-m-Y", strtotime($end_date)); 
		
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
		
				
		$emp_name = "All";
		
		if($emp_id > 0)
		{
			$emp_name = $this->dbObj->getEmployeeName($emp_id);
		}
		
		
		
		
		$objPHPExcel->getProperties()->setCreator("OdiTek Admin")
							 ->setLastModifiedBy("OdiTek Admin")
							 ->setTitle("OdiTek Attendance Report")
							 ->setSubject("Leave Summary")
							 ->setDescription("Leave Summary")
							 ->setKeywords("")
							 ->setCategory("");
							 
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Attendance Report');
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setSize(16);
		
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:D2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C3:D3');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Record Type');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Period: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Leave Summary Report");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $start_date.' to '.$end_date);
		$objPHPExcel->getActiveSheet()->getStyle("A2:C2")->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle("A3:C3")->getFont()->setSize(14);	
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Sl NO')
            ->setCellValue('B4', 'Emp-Id')
			->setCellValue('C4', 'Emp-Name')
			->setCellValue('D4', 'Casual')
            ->setCellValue('E4', 'Sick')
            ->setCellValue('F4', 'Vacation')
			->setCellValue('G4', 'Half-day')
			->setCellValue('H4', 'Unpaid')
			->setCellValue('I4', 'Special')
			->setCellValue('J4', 'CompOff')
			->setCellValue('K4', 'Maternity')
			->setCellValue('L4', 'Total')
			->setCellValue('M4', 'Absent');
			
		$objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('A4:M4');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		
		
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
		$objPHPExcel->getActiveSheet()->getStyle('A4:M4')->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->setAutoFilter('A1:L1');
		
		///////////////////////////////////////////
	
		//date("d-m-Y");
		$date=$start_date;
		$count=5;
		$sl_no=0;
		
		$rid = rand(100000,999999);
			
		while(strtotime($date) <= strtotime($end_date))
		{
			//check if holiday or not
			if($this->dbObj->checkHoliday($date))
			{	
				$date = date("d-m-Y", strtotime($date." +1 days"));
				continue;
			}
			
			$dbsql=mysql_query("select * from od_leave_daily_records where date='".$date."' order by id asc");
			$Num1 = mysql_num_rows($dbsql);
			if ($Num1 > 0)
			{
				while($row1 = mysql_fetch_array($dbsql))
				{
					$eid = $row1['emp_id'];
					$lid = $row1['lid'];
					$type = $row1['type'];
					$casual=0; $sick=0; $vacation=0;$halfday=0;$unpaid=0;$special=0;$compoff=0;$maternity=0;
					
					$lobj = $this->dbObj->getLeaveReqObj($lid);
					$status = $lobj['status'];
					
					if($status == 1 || $status == 2 || $status == 6 )
					{	
						$dbsql2=mysql_query("select * from od_leave_reports where rid='".$rid."' and eid='".$eid."' ");
						$Num2 = mysql_num_rows($dbsql2);
						if(!$Num2)
						{
							if($type == 1) $casual++; if($type == 2) $sick++; if($type == 3) $vacation++; if($type == 4) $halfday++;
							if($type == 5) $unpaid++; if($type == 6) $special++; if($type == 7) $compoff++;	if($type == 8) $maternity++;
							$query2 = "INSERT into od_leave_reports set rid='".$rid."' , eid='".$eid."', casual='".$casual."', sick='".$sick."' , vacation='".$vacation."' , halfday='".$halfday."'  , unpaid='".$unpaid."' , special='".$special."' , compoff='".$compoff."' , maternity	='".$maternity."'";
							$res = mysql_query($query2);
							
						}
						else{
							$row2 = mysql_fetch_array($dbsql2);
							$id2 = $row2['id']; 
							$casual = $row2['casual']; $sick = $row2['sick']; $vacation = $row2['vacation']; $halfday = $row2['halfday'];
							$unpaid = $row2['unpaid']; $special = $row2['special']; $compoff = $row2['compoff']; $maternity = $row2['maternity'];
							
							if($type == 1) $casual++; if($type == 2) $sick++; if($type == 3) $vacation++; if($type == 4) $halfday++;
							if($type == 5) $unpaid++; if($type == 6) $special++; if($type == 7) $compoff++;	if($type == 8) $maternity++;
							$query2 = "UPDATE od_leave_reports set rid='".$rid."' , eid='".$eid."', casual='".$casual."', sick='".$sick."' , vacation='".$vacation."' , halfday='".$halfday."'  , unpaid='".$unpaid."' , special='".$special."' , compoff='".$compoff."' , maternity='".$maternity."' where id='".$id2."' ";
							$res = mysql_query($query2);
						}
					}
					
				}
					
			}
			$date = date("d-m-Y", strtotime($date." +1 days"));
			
		}

		//get all active employee list
		$empList = $this->dbObj->getAllActiveEmployeeListName();
		foreach($empList as $emp)
		{
			
			$name = $emp->name;
			$eid = $emp->eid;
			$isMgmt = $this->dbObj->isManagement($eid);
			if($isMgmt) continue;
			
			if($emp_id > 0)
			{
				if($emp_id != $eid)
					continue;	
			}
			$sl_no++;
			$abs=0;
			$abs = $this->dbObj->getEmployeeAbsentCount($eid,$start_date,$end_date);
			$leaveObj = $this->dbObj->getLeaveDetailRecordsData($rid, $eid);
			$casual = $leaveObj->casual;
			$sick = $leaveObj->sick;
			$vacation = $leaveObj->vacation;
			$halfday = $leaveObj->halfday;
			$unpaid = $leaveObj->unpaid;
			$special = $leaveObj->special;
			$compoff = $leaveObj->compoff;
			$maternity = $leaveObj->maternity;
			$total = $casual + $sick + $vacation + ($halfday/2) + $unpaid + $special + $compoff + $maternity;
			
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$eid);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$name);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$casual);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$sick);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$vacation);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$halfday);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$unpaid);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$count,$special);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$count,$compoff);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$count,$maternity);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$count,$total);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$count,$abs);
			
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
			$objPHPExcel->getActiveSheet()->getStyle('K'.$count)->applyFromArray($styleArray1);
			$objPHPExcel->getActiveSheet()->getStyle('L'.$count)->applyFromArray($styleArray1);
			$objPHPExcel->getActiveSheet()->getStyle('M'.$count)->applyFromArray($styleArray1);
			
			
			$count++;
		}
		

		//delete records
		$str1 = "delete from od_leave_reports where rid='".$rid."' ";
		$dbsql=mysql_query($str1);		
		
		/////////////////////////////////////////
		$objPHPExcel->setActiveSheetIndex(0);		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						
		$file_path = EXCEL_PATH;
		$file_download_path = ROOT_DIR."admin/excel_files/";
				
		$day_str_name = date('d-m-Y_h-i-s');
		$emp_name = str_replace(' ', '', $emp_name);
		$file_download_name = "HR-LeaveSummaryReport-".$emp_name."-".$day_str_name.".xlsx";
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
	
	
	
	public function generateLeaveDetailsReport($start_date,$end_date,$emp_id){
		
		$start_date = date("d-m-Y", strtotime($start_date)); 
		$end_date = date("d-m-Y", strtotime($end_date)); 
		
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
		
				
		$emp_name = "All";
		
		if($emp_id > 0)
		{
			$emp_name = $this->dbObj->getEmployeeName($emp_id);
		}
		
		
		
		
		$objPHPExcel->getProperties()->setCreator("OdiTek Admin")
							 ->setLastModifiedBy("OdiTek Admin")
							 ->setTitle("OdiTek Leave Details Report")
							 ->setSubject("Leave Details")
							 ->setDescription("Leave Details")
							 ->setKeywords("")
							 ->setCategory("");
							 
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Attendance Report');
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setSize(16);
		
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:D2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C3:D3');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Record Type');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Period: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Leave Details Report");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $start_date.' to '.$end_date);
		$objPHPExcel->getActiveSheet()->getStyle("A2:C2")->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle("A3:C3")->getFont()->setSize(14);	
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Sl NO')
            ->setCellValue('B4', 'Date')
			->setCellValue('C4', 'Emp-Id')
			->setCellValue('D4', 'Emp-Name')
			->setCellValue('E4', 'Emp-Type')
			->setCellValue('F4', 'Emp-Desig.')
            ->setCellValue('G4', 'Leave Type')
			->setCellValue('H4', 'Leave Id')
            ->setCellValue('I4', 'Status')
			->setCellValue('J4', 'RM-Name');
			
		$objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('A4:J4');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
		
		
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
		$objPHPExcel->getActiveSheet()->getStyle('A4:L4')->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->setAutoFilter('A1:L1');
		
		///////////////////////////////////////////
	
		//date("d-m-Y");
		$date=$start_date;
		$count=5;
		$sl_no=0;
		
					
		while(strtotime($date) <= strtotime($end_date))
		{
			//check if holiday or not
			if($this->dbObj->checkHoliday($date))
			{	
				$date = date("d-m-Y", strtotime($date." +1 days"));
				continue;
			}
			
			$dbsql=mysql_query("select * from od_leave_daily_records where date='".$date."' order by id asc");
			$Num1 = mysql_num_rows($dbsql);
			if ($Num1 > 0)
			{
				while($row1 = mysql_fetch_array($dbsql))
				{
					$eid = $row1['emp_id'];
					$isMgmt = $this->dbObj->isManagement($eid);
					if($isMgmt) continue;
					
					if($emp_id > 0)
					{
						if($emp_id != $eid)
						continue;	
					}
					
					$emp_type = "";
					if($this->dbObj->isEmployee($eid))
						$emp_type = "Employee";
					else
						$emp_type = "Intern";
					
					$sl_no++;
					$lid = $row1['lid'];
					$type = $row1['type'];
					$type_str = $this->dbObj->getLeaveTypeById($type);
					$lobj = $this->dbObj->getLeaveReqObj($lid);
					$status = $lobj['status'];
					$status_str = $this->dbObj->getLeaveStatusById($status);
					
					$empname = $this->dbObj->getEmpName($eid);
					$emp_rank = $this->dbObj->getDesigByEid($eid);
					$rm_id = $this->dbObj->getEmployeeToReport($eid);
					$rm_name = $rm_id->name;
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$date);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$eid);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$empname);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$emp_type);
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$emp_rank);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,$type_str);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$lid);
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$count,$status_str);
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$count,$rm_name);
					
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
					$count++;
				}
			}
			
			$date = date("d-m-Y", strtotime($date." +1 days"));
		}
			
		
		/////////////////////////////////////////
		$objPHPExcel->setActiveSheetIndex(0);		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						
		$file_path = EXCEL_PATH;
		$file_download_path = ROOT_DIR."admin/excel_files/";
				
		$day_str_name = date('d-m-Y_h-i-s');
		$emp_name = str_replace(' ', '', $emp_name);
		$file_download_name = "HR-LeaveDetailsReport-".$emp_name."-".$day_str_name.".xlsx";
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
	
	
	public function generateAbsentDetailsReport($start_date,$end_date,$emp_id){
		
		$start_date = date("d-m-Y", strtotime($start_date)); 
		$end_date = date("d-m-Y", strtotime($end_date)); 
		
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
		
				
		$emp_name = "All";
		
		if($emp_id > 0)
		{
			$emp_name = $this->dbObj->getEmployeeName($emp_id);
		}
		
		
		
		
		$objPHPExcel->getProperties()->setCreator("OdiTek Admin")
							 ->setLastModifiedBy("OdiTek Admin")
							 ->setTitle("OdiTek Absent Details Report")
							 ->setSubject("Absent Details")
							 ->setDescription("Absent Details")
							 ->setKeywords("")
							 ->setCategory("");
							 
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'OdiTek Attendance Report');
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setBold( true );
		$objPHPExcel->getActiveSheet()->getStyle("A1:A1")->getFont()->setSize(16);
		
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:D2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C3:D3');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Record Type');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Period: ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', "Absent Details Report");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $start_date.' to '.$end_date);
		$objPHPExcel->getActiveSheet()->getStyle("A2:C2")->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle("A3:C3")->getFont()->setSize(14);	
		
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Sl NO')
            ->setCellValue('B4', 'Date')
			->setCellValue('C4', 'Emp-Id')
			->setCellValue('D4', 'Emp-Name')
			->setCellValue('E4', 'Emp-Type')
			->setCellValue('F4', 'Emp-Desig.')
            ->setCellValue('G4', 'Type')
			->setCellValue('H4', 'IN-Time')
            ->setCellValue('I4', 'OUT-Time')
			->setCellValue('J4', 'RM-Name');
			
		$objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('A4:J4');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
		
		
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
		$objPHPExcel->getActiveSheet()->getStyle('A4:L4')->applyFromArray($styleArray);
		//$objPHPExcel->getActiveSheet()->setAutoFilter('A1:L1');
		
		///////////////////////////////////////////
	
		//date("d-m-Y");
		$date=$start_date;
		$count=5;
		$sl_no=0;
		
		//$empList = $this->dbObj->getAllActiveEmployeeInternListName();			
		while(strtotime($date) <= strtotime($end_date))
		{
			//check if holiday or not
			if($this->dbObj->checkHoliday($date))
			{	
				$date = date("d-m-Y", strtotime($date." +1 days"));
				continue;
			}
			
			$dbsql=mysql_query("select * from od_matrix_daily_log where date='".$date."' order by id asc");
			$Num1 = mysql_num_rows($dbsql);
			if ($Num1 > 0)
			{
				while($row1 = mysql_fetch_array($dbsql))
				{
					$eid = $row1['eid'];
					if($eid > 1000) //emp id start YYMMXX
					{
						$emp_type = "";
						if($this->dbObj->isEmployee($eid))
							$emp_type = "Employee";
						else
							$emp_type = "Intern";
						
						if($this->dbObj->isManagement($eid)) continue;
						
						$in_time = $row1['punch1'];
						$out_time = $row1['punch2'];
						if($in_time == "NA" && $out_time == "NA")
						{
							$abs=1;
							$empData = $this->dbObj->getEmployeeData($eid);
							$doj_str = strtotime(date("d-m-Y", strtotime($empData->joining_date)));
							if(strtotime($date) < $doj_str) //check based on DOJ
								$abs=0;
							if($abs)
							{	
								$leaveInfo = $this->dbObj->getEmployeeLeaveInfo($eid,$date);
								if($leaveInfo->status) 	$abs=0;
								$wfhInfo = $this->dbObj->getEmployeeWFHInfo($eid,$date);
								if($wfhInfo->status) 	$abs=0;
							}
							
							if($abs)
							{
								$name = $empData->name;
								$desig_name = $empData->desig_name;
								$rm_name = $empData->report_to;
								$sl_no++;
								$objPHPExcel->getActiveSheet()->setCellValue('A'.$count,$sl_no);
								$objPHPExcel->getActiveSheet()->setCellValue('B'.$count,$date);
								$objPHPExcel->getActiveSheet()->setCellValue('C'.$count,$eid);
								$objPHPExcel->getActiveSheet()->setCellValue('D'.$count,$name);
								$objPHPExcel->getActiveSheet()->setCellValue('E'.$count,$emp_type);
								$objPHPExcel->getActiveSheet()->setCellValue('F'.$count,$desig_name);
								$objPHPExcel->getActiveSheet()->setCellValue('G'.$count,"ABS");
								$objPHPExcel->getActiveSheet()->setCellValue('H'.$count,$in_time);
								$objPHPExcel->getActiveSheet()->setCellValue('I'.$count,$out_time);
								$objPHPExcel->getActiveSheet()->setCellValue('J'.$count,$rm_name);
								
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
								$count++;
								
							}
						}
					}
				}
			}
						
			$date = date("d-m-Y", strtotime($date." +1 days"));
		}
			
		
		/////////////////////////////////////////
		$objPHPExcel->setActiveSheetIndex(0);		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						
		$file_path = EXCEL_PATH;
		$file_download_path = ROOT_DIR."admin/excel_files/";
				
		$day_str_name = date('d-m-Y_h-i-s');
		$emp_name = str_replace(' ', '', $emp_name);
		$file_download_name = "HR-AbsentDetailsReport-".$emp_name."-".$day_str_name.".xlsx";
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
	
	
	
	
	
	
	
}
?>