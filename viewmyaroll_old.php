<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	$session_forceno = 	$_SESSION["forceno"];
	
	$curdate=date("Y-m-d");
	$curmonth=date("m");
	$curyear=date("Y");
	$dadata= new Configurations();
	
	$id=$_REQUEST["id"];
	$employeeid=$_REQUEST["empid"];
	
	//echo is_numeric($id)."<BR>";
	//echo ctype_alnum($id)."<BR>";
	//echo is_numeric($employeeid)."<BR>";
	//echo ctype_alnum($employeeid)."<BR>";
	
	if(!is_numeric($id) || !ctype_alnum($id) )
		return false;
	if(!is_numeric($employeeid) || !ctype_alnum($employeeid) )
		return false;	
		
	
	
	$dbsql=mysql_query("select * from ".PREFIX."salary_status where id='$id' ");
	$Num = mysql_num_rows($dbsql);
	$daarray=array();
	if ($Num > 0)
	{
		if($row1 = mysql_fetch_array($dbsql))
		{
			$mod_date=$row1['timestamp'];
			$data1=$row1['monthyear'];
			$data2=$row1['info'];
			$modby=$row1['mod_by'];
		}
	}
	
	$dbsql=mysql_query("select * from ".PREFIX."salary where id='$employeeid' ");
	$Num = mysql_num_rows($dbsql);
	$daarray=array();
	if ($Num > 0)
	{
		if($row = mysql_fetch_array($dbsql))
		{
			$name=$row['name'];
			$forceno=$row['forceno'];
			$aroll_id=$row['aroll_id'];
			$rank=$row['rank'];
			$rank = $dbobj->getRankTypeName($rank);
			$coy=$row['coy'];
			$category=$row['category'];
			$pension_opt=$row['pension_opt'];
			$bank_ac=$row['bank_ac'];
	
		}
	}
	
	if($aroll_id != $id)
	{
		return;
	}
	
	
	if($forceno != $session_forceno)
	{
		return;
	}
	
	////////////////////////////////////////////////////
	$loan = $dbobj->getMonthLoanAmount($forceno,$data1);
	$banker = $row['paid'] - $loan;
	$remark = $dbobj->getMonthMessage($forceno, $data1);
	
	///////////////////////////////////////////////////
	
	
	
	$dbsql=mysql_query("select * from ".PREFIX."employee where forceno='$forceno' and latest='1' ");
	$Num = mysql_num_rows($dbsql);
	if ($Num > 0)
	{
		if($row2 = mysql_fetch_array($dbsql))
		{
			$panno=$row2['pan_no'];
			$mobileno=$row2['mobile_no'];
		}
	}
	
	
	
	if(isset($_POST["btnsubmit"]))
	{
		$rank=$_POST["txtrank"];
		$rankid=$_POST["cmbrank"];
		if($_POST['hidaddedit']=="add"){
				$ret = $dbobj->addnewrank($rank,$rankid);
				if($ret == 1)
						$msg ='<div style="color:#16a085; text-align:center; padding-bottom:10px;">Data Inserted Successfully</div>';
				else
						$msg ='<div style="color:#16a085; text-align:center; padding-bottom:10px;">Rank Already Exist...</div>';
			
		}else if($_POST['hidaddedit']=="edit"){
			if($_POST['hideditid']>0){
				$dbobj->updateoldrank($_POST['hideditid'],$rank,$rankid);
				//$str= $_POST['hideditid']."::".$rank."::".$rankid;
				$msg ='<div style="color:#16a085; text-align:center; padding-bottom:10px;">Data Updated Successfully.</div>';
				//$msg =  $str;
			}
		}
		
	}
	
	
	if(!isset($_GET["page"]) || $_GET["page"]=="" || $_GET["page"]<1){
		$page = 1;
	}else{
		$page = (int) $_GET['page'];
	}
	$categoryarr=array();
?>
<?php include 'include/header.php' ?>
<script>
function resetform(){
	document.getElementById("txtcity").value="";
	document.getElementById("hidaddedit").value="add";
	document.getElementById("hideditid").value="";
	document.getElementById("cmbcity").options[0].selected=true;
	document.getElementById("hidbaseid").value="0";
}

function showdaedit(id,rank,rankid){
	document.getElementById("txtrank").value=rank;
	document.getElementById("hidaddedit").value="edit";
	document.getElementById("hideditid").value=id;
	
	for(i=0;i<document.getElementById("cmbrank").length;i++){
		if(document.getElementById("cmbrank").options[i].value==rankid){
			document.getElementById("cmbcity").options[i].selected=true;
			return false;
		}
	}
	return false;
}
</script>
<?php include 'include/leftsidebar.php' ?>
        <!-- begin MAIN PAGE CONTENT -->
        <div id="page-wrapper">

            <div class="page-content">

                <!-- begin PAGE TITLE AREA -->
                <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                <div class="row">
                	<div class="tpaddingdiv2">
                        <div class="col-lg-12 text-center">
                            <div class="text-center"><img src="img/bannerlogin.png" border="0" name="national" class="borderradiusdiv2"></div>
                       </div>
                       <div class="clearfix"></div>
                	</div>
                    <div class="col-lg-12">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="dashboard.php">My Salary</a></li>
                                <li class="active">A-Roll of <?php echo $name?> [ F.No: <?php echo $forceno?> ] of <?php echo $data1?> </li>
                            </ol>
                             
                        </div>
                    </div>
                     
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE AREA -->
               
			   <!--main_heading_div-->
				<?php echo $msg;?>
                <!-- /.row -->
				<form name="frmdarate" id="frmdarate" method="post">
				<div class="row" id="load_subadmin">
				<div class="col-md-12">
					<!--left_div-->
					
					<!--end_left_div-->
				</div>
				<div class="clearfix"></div>
				</div> <!-- end_row_div -->
				</form>
                
                <!--row_div-->
                
                <div class="row">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> A-Roll View   of  <?php echo $name?> [ Force No: <?php echo $forceno?> ]</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#employeeliststatus"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->
									 
                                        <a href="dashboard.php" >
                                        <button class="btn btn-xs btn-green outlinedivnone" >Back</button>
                                        </a>
                                   
                                    <div class="totalaligndiv" style="margin-top:30px;">
										<!--1st_div-->
										<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-left">IRLA/Force No :</span>
												<input type="text" name="forceno" id="forceno" class="form-control"  readonly onkeyup="getforceno()" value="<?php echo $forceno; ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-left">Name :</span>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name" readonly class="form-control" value="<?php echo $name?>">
											</div>
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-left">Rank :</span>
											<input type="text" name="rank" id="rank" class="form-control"  onkeyup="getforceno()" readonly value="<?php echo $rank; ?>" >
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-left">Bank A/c No :</span>
												<input type="text" name="bank_account_no" id="bank_account_no" class="form-control" readonly value="<?php echo $bank_ac ?>">
											</div>
                                            
                                            	
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-left">Mobile No :</span>
												<input type="text" name="mobile_no" id="mobile_no" class="form-control" readonly value="<?php echo  $mobileno?>">
											</div>
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-left">PAN No :</span>
												<input type="text" name="pan_no" id="pan_no" class="form-control"  readonly value="<?php echo $panno?>">
											</div>
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-left">Category :</span>
												<input type="text" name="category" id="category" class="form-control"  readonly value="<?php echo $category ?>">													
											</div>
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-left">Pension Opt :</span>
											<input type="text" name="pension" id="category" class="form-control"  readonly value="<?php echo $pension_opt ?>">														
											</div>
                                           
											
											
										</div>
										<!--end_2nd_div-->
										
										<div class="clearfix"></div>
									
                                    
                                    
                                    
                                    
                                    
                                 			<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4><i class="fa fa-angle-double-right"></i> Allowances / Deductions1 / Deductions2</h4>
												</div>
                                                
												<div class="portlet-widgets">
													<a data-toggle="collapse" data-parent="#accordion" href="#allowancesdeductionstab"><i class="fa fa-chevron-down"></i></a>
												</div>
												<div class="clearfix"></div>
											</div>
											
											<div id="allowancesdeductionstab" class="panel-collapse in">
												<div class="portlet-body">
													<div class="portlet-body newtabbgcolor">
														<div class="totalaligndiv">
															<ul id="myTab" class="nav nav-tabs">
																<li class="active"><a href="#allowancestab" data-toggle="tab">Allowances</a></li>
																<li><a href="#deductionstab" data-toggle="tab">Deductions1</a></li>
                                                                <li><a href="#finaldeductionstab" data-toggle="tab">Deductions2</a></li>
                                                                <li>
                                                                <div class="input-group bmargindiv1 col-md-12" style="margin-left:20px;">
																
                                                                <span class="input-group-addon ndrftextwidth text-left" style="height:42px;">Month :</span>
																<input type="text" name="pension" id="category" class="form-control" style="height:42px;" readonly value="<?php echo $data1 ?>">														
																</div>
                                            					</li>
																</ul>
														</div>
                                                        
														<div id="myTabContent" class="tab-content">
															<div class="tab-pane fade in active" id="allowancestab">
																<div class="totalaligndiv" id="allowancesinner">
																	<!--1st_div-->
																	<div class="col-md-4 newpadding-left-zero">
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left" >Basic Pay :</span>
																		<input readonly type="text" class="form-control"  name="basic_pay" id="basic_pay" onchange="calcsalary()" value="<?php echo $row['basic_pay'] ?>"> 
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Special Pay :</span>
																		<input readonly type="text" class="form-control" placeholder="Special Pay" name="special_pay" id="special_pay" value="<?php echo $row['special_pay'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Grade Pay :</span>
																		<input readonly type="text" class="form-control" placeholder="Grade Pay" name="grade_pay" id="grade_pay" onchange="calcsalary()" value="<?php echo $row['grade_pay'] ?>">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Personal Pay :</span>
																		<input readonly type="text" class="form-control" placeholder="Personal Pay" name="personal_pay" id="personal_pay" value="<?php echo $row['personal_pay'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Deputation Pay :</span>
																		<input readonly type="text" class="form-control" placeholder="Deputation Pay" name="deputation_pay" id="deputation_pay" onchange="calcsalary()" value="<?php echo $row['dep_pay'] ?>">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">D.A :</span>
																		<input readonly type="text" class="form-control" placeholder="D.A" name="da" id="da" value="<?php echo $row['da'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">M.A :</span>
																		<input readonly type="text" class="form-control" placeholder="Medal All" name="medal_all" id="medal_all" value="<?php echo $row['ma'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">C.A :</span>
																		<input readonly type="text" class="form-control" placeholder="CA" name="ca" id="ca" value="<?php echo $row['ca'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">SDA :</span>
																		<input readonly type="text" class="form-control" placeholder="SDA" name="sda" id="sda" value="<?php echo $row['sda'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">TPT All :</span>
																		<input readonly type="text" class="form-control" placeholder="TPT All" name="tpt_all" id="tpt_all" value="<?php echo $row['tpt_all'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">TPT Arr :</span>
																		<input readonly type="text" class="form-control" placeholder="TPT Arr" name="tpt_arr" id="tpt_arr" value="<?php echo $row['tpt_arr'] ?>" onchange="calcsalary()">
																	  </div>
																	</div>
																	<!--end_1st_div-->
																	<!--2nd_div-->
																	<div class="col-md-4">
																	<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Training :</span>
																		<input readonly type="text" class="form-control" placeholder="Training All" name="training_all" id="training_all" value="<?php echo $row['training'] ?>" onchange="calcsalary()">
																	  </div>
																		<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">NPA :</span>
																		<input readonly type="text" class="form-control" placeholder="NPA" name="npa" id="npa" value="<?php echo $row['npa'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">FPA :</span>
																		<input readonly type="text" class="form-control" placeholder="FPA" name="fpa" id="fpa" value="<?php echo $row['fpa'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">SUMPTORY :</span>
																		<input readonly type="text" class="form-control" placeholder="SUMPTORY" name="sumptuary_all" id="sumptuary_all" value="<?php echo $row['sumptory'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">PGA Arr :</span>
																		<input readonly type="text" class="form-control" placeholder="PGA Arr" name="pga_arr" id="pga_arr" value="<?php echo $row['pga_arr'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left" id="hralevel" name="hralevel">HRA (HRA) :</span>
																		<input readonly type="text" class="form-control" placeholder="HRA" name="hra" id="hra" value="<?php echo $row['hra'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">CEA :</span>
																		<input readonly type="text" class="form-control" placeholder="CEA" name="cea" id="cea" value="<?php echo $row['cea'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Ration All :</span>
																		<input readonly type="text" class="form-control" placeholder="Ration All" name="ration_all" id="ration_all" value="<?php echo $row['ration'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">W.A :</span>
																		<input readonly type="text" class="form-control" placeholder="WA" name="washing_all" id="washing_all" value="<?php echo $row['wa'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">COB/Risk :</span>
																		<input readonly type="text" class="form-control" placeholder="COB/Risk" name="cobrisk_all" id="cobrisk_all" value="<?php echo $row['cob_risk'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">RM Arr :</span>
																		<input readonly type="text" class="form-control" placeholder="RM Arr" name="rm_arr" id="rm_arr" value="<?php echo $row['rm_arr'] ?>" onchange="calcsalary()">
																	  </div>
																	</div>
																	<!--end_2nd_div-->
																	<!--3rd_div-->
																	<div class="col-md-4 newpadding-right-zero">
																		<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">SCA/HCA :</span>
																		<input readonly type="text" class="form-control" placeholder="SCA/HCA" name="sca_hca" id="sca_hca" value="<?php echo $row['sca'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Other All :</span>
																		<input readonly type="text" class="form-control" placeholder="Other All" name="other_all" id="other_all" value="<?php echo $row['other_all'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">QA 1 :</span>
																		<input readonly type="text" class="form-control" placeholder="QA 1" name="qa1" id="qa1" value="<?php echo $row['qa1'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">QA 2 :</span>
																		<input readonly type="text" class="form-control" placeholder="QA 2" name="qa2" id="qa2" value="<?php echo $row['qa2'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">QA 3 :</span>
																		<input readonly type="text" class="form-control" placeholder="QA 3" name="qa3" id="qa3" value="<?php echo $row['qa3'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">QA 4 :</span>
																		<input readonly type="text" class="form-control" placeholder="QA 4" name="qa4" id="qa4" value="<?php echo $row['qa4'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">DA Arr :</span>
																		<input readonly type="text" class="form-control" placeholder="DA Arr" name="da_arr" id="da_arr" value="<?php echo $row['da_arr'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">DEP Arr :</span>
																		<input readonly type="text" class="form-control" placeholder="DEP Arr" name="dep_arr" id="dep_arr" value="<?php echo $row['dep_arr'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">NCA :</span>
																		<input readonly type="text" class="form-control" placeholder="NCA" name="nca" id="nca" value="<?php echo $row['nca'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">PCA :</span>
																		<input readonly type="text" class="form-control" placeholder="PCA" name="pca" id="pca" value="<?php echo $row['pca'] ?>" onchange="calcsalary()">
																	  </div>
																		<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Gross :</span>
																		<input readonly type="text" class="form-control" placeholder="Gross" name="gross" id="gross" value="<?php echo $row['gross_pay'] ?>" readonly>
																	  </div>
																	</div>
																	<!--end_3rd_div-->
																	<div class="clearfix"></div>
																	<!--4th_div
																	<div class="col-md-6 pull-right newpadding-right-zero">
																		<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Gross :</span>
																			<input type="text" class="form-control" placeholder="Gross" name="gross" id="gross">
																		  </div>
																	</div>
																	<div class="clearfix"></div>-->
																	<!--end_4th_div--> 
																	<!--show_changes_div-->
																	<!--<div class="col-lg-12">
																		<div class="tbpaddingdiv2">
																		  <button class="btn btn-default" data-toggle="modal" data-target="#allowancespreview">Show Changes</button>
																		</div>
																	  </div>-->
																	  <div class="clearfix"></div>
																	<!--end_show_changes_div-->                               
																  </div>
															</div>
															<div class="tab-pane fade" id="deductionstab">
																<div class="totalaligndiv"  id="deductioninner">
																	<!--1st_div-->
																	<div class="col-md-4 newpadding-left-zero">
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left" id="dedgpglevel">GPF :</span>
																		<input readonly type="text" class="form-control" placeholder="GPF/DCPS" name="gpf_dcps" id="gpf_dcps"value="<?php echo $row['gpf_dcps'] ?>" onchange="calcsalary()" > 
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">GPF Arr :</span>
																		<input readonly type="text" class="form-control" placeholder="GPF Arr" name="gpf_arr" id="gpf_arr" value="<?php echo $row['gpf_arr'] ?>" onchange="calcsalary()">
																	  </div>
                                                                      
                                                                      <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">GPF Adv :</span>
																		<input readonly type="text" class="form-control" placeholder="PFA" name="pfa" id="pfa" value="<?php echo $row['gpf_adv'] ?>" onchange="calcsalary()">
																	  </div>
                                                                      
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">HRR :</span>
																		<input readonly type="text" class="form-control" placeholder="HRR" name="hrr" id="hrr" value="<?php echo $row['hrr'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">PLI :</span>
																		<input readonly type="text" class="form-control" placeholder="PLI" name="pli" id="pli" value="<?php echo $row['pli'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">WC :</span>
																		<input readonly type="text" class="form-control" placeholder="ITX" name="wc" id="wc" value="<?php echo $row['wc'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">FAN :</span>
																		<input readonly type="text" class="form-control" placeholder="GIS" name="fan" id="fan" value="<?php echo $row['fan'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">CYA :</span>
																		<input readonly type="text" class="form-control" placeholder="CYA" name="cya" id="cya" value="<?php echo $row['cya'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">CGHS :</span>
																		<input readonly type="text" class="form-control" placeholder="CGHS" name="cghs" id="cghs" value="<?php echo $row['cghs'] ?>" onchange="calcsalary()">
																	  </div>
																	 
																	</div>
																	<!--end_1st_div-->
																	<!--2nd_div-->
																	<div class="col-md-4">
                                                                     <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">ITX :</span>
																		<input readonly type="text" class="form-control" placeholder="ITX" name="itx" id="itx" value="<?php echo $row['itx'] ?>" onchange="calcsalary()">
																	  </div>
                                                                      
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">CESS P :</span>
																		<input readonly type="text" class="form-control" placeholder="CESS P" name="cess_p" id="cess_p" value="<?php echo $row['cess_p'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">CESS S :</span>
																		<input readonly type="text" class="form-control" placeholder="CESS S" name="cess_s" id="cess_s" value="<?php echo $row['cess_s'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">GIS :</span>
																		<input readonly type="text" class="form-control" placeholder="GIS" name="gis" id="gis" value="<?php echo $row['gis'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">GIS Ar :</span>
																		<input readonly type="text" class="form-control" placeholder="GIS Ar" name="gis_arr" id="gis_arr" value="<?php echo $row['gis_arr'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">INS :</span>
																		<input readonly type="text" class="form-control" placeholder="INS" name="ins" id="ins" value="<?php echo $row['ins'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">PAY A :</span>
																		<input readonly type="text" class="form-control" placeholder="PAY A" name="pay_a" id="pay_a" value="<?php echo $row['pay_a'] ?>" onchange="calcsalary()">
																	  </div>
																      
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">CON :</span>
																		<input readonly type="text" class="form-control" placeholder="CON" name="con" id="con" value="<?php echo $row['con'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">HBL :</span>
																		<input readonly type="text" class="form-control" placeholder="HBL" name="hbl" id="hbl" value="<?php echo $row['hbl'] ?>" onchange="calcsalary()">
																	  </div>
																	</div>
																	<!--end_2nd_div-->
																	<!--3rd_div-->
																	<div class="col-md-4 newpadding-right-zero">
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">FES :</span>
																		<input readonly type="text" class="form-control" placeholder="FES" name="fes" id="fes" value="<?php echo $row['fes'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">N ADV :</span>
																		<input readonly type="text" class="form-control" placeholder="N ADV" name="n_adv" id="n_adv" value="<?php echo $row['n_adv'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">L FEE :</span>
																		<input readonly type="text" class="form-control" placeholder="L FEE" name="l_fee" id="l_fee" value="<?php echo $row['l_fee'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">RM Recovery :</span>
																		<input readonly type="text" class="form-control" placeholder="TERM GRATY" name="term_graty" id="term_graty" value="<?php echo $row['rm_recovery'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">COMP A :</span>
																		<input readonly type="text" class="form-control" placeholder="COMP A" name="comp_a" id="comp_a" value="<?php echo $row['comp_a'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">LS A :</span>
																		<input readonly type="text" class="form-control" placeholder="LS A" name="lsa" id="lsa" value="<?php echo $row['ls_a'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">R055 :</span>
																		<input readonly type="text" class="form-control" placeholder="R055" name="r055" id="r055" value="<?php echo $row['r055'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12" style="display:none"> <span class="input-group-addon ndrftextwidth text-left">PENS :</span>
																		<input readonly type="text" class="form-control" placeholder="PENS" name="pens" id="pens" value="0" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">R255 :</span>
																		<input readonly type="text" class="form-control" placeholder="R255" name="r255" id="r255" value="<?php echo $row['r255'] ?>" onchange="calcsalary()">
																	  </div>
                                                                      <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Tot Ded :</span>
																				<input readonly type="text" class="form-control" placeholder="Tot Ded" readonly name="totded" id="totded" value="<?php echo $row['deduction1'] ?>">
																			  </div>
                                                                              
																	</div>
																	<!--end_3rd_div-->
																	<div class="clearfix"></div>
																	<!--4th_div-->
																	
																	<!--end_4th_div-->  
																	<!--show_deductions_div-->
																	<!--<div class="col-lg-12">
																		<div class="tpaddingdiv2">
																		  <button class="btn btn-default" data-toggle="modal" data-target="#deductionpreview">Show Changes</button>
																		</div>
																	  </div>-->
																	  <div class="clearfix"></div>
																	<!--end_show_deductions_div-->                              
																  </div>
															</div>
                                                            
                                                                                                           
                                                    <div class="tab-pane fade" id="finaldeductionstab">
													<div class="totalaligndiv"  id="finaldeductioninner">
                                                                
														<!--1st_div-->
														<div class="col-md-6">
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">RPS :</span>
                                                            <input readonly type="text" class="form-control" placeholder="RPS" name="rps" id="rps" value="<?php echo $row['rps'] ?>"> 
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">PROF / TAX :</span>
                                                            <input readonly type="text" class="form-control" placeholder="PROF / TAX" name="prof_tax" id="prof_tax" value="<?php echo $row['pro_tax'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">CWF :</span>
                                                            <input readonly type="text" class="form-control" placeholder="CWF" name="cwf" id="cwf" value="<?php echo $row['cwf'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">CSF :</span>
                                                            <input readonly type="text" class="form-control" placeholder="CSF" name="csf" id="csf" value="<?php echo $row['csf'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">OTH/INS/LIC :</span>
                                                            <input readonly type="text" class="form-control" placeholder="OTH/INS/LIC" name="oth_ins_lic" id="oth_ins_lic" value="<?php echo $row['other'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">GIA :</span>
                                                            <input readonly type="text" class="form-control" placeholder="GIA" name="gia" id="gia" value="<?php echo $row['gia'] ?>">
                                                          </div>
                                                        </div>
														<!--end_1st_div-->
														<!--2nd_div-->
														<div class="col-md-6">
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">NDRF (CWF) :</span>
                                                            <input readonly type="text" class="form-control" placeholder="NDRF (CWF)" name="ndrf_cwf" id="ndrf_cwf" value="<?php echo $row['ndrf_cwf'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">REG/PED :</span>
                                                            <input readonly type="text" class="form-control" placeholder="REG/PED" name="reg_ded" id="reg_ded" value="<?php echo $row['reg_ped'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">EDU/FUND :</span>
                                                            <input readonly type="text" class="form-control" placeholder="EDU/FUND" name="edu_fund" id="edu_fund" value="<?php echo $row['edu_fund'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">CTD :</span>
                                                            <input readonly type="text" class="form-control" placeholder="CTD" name="ctd" id="ctd" value="<?php echo $row['ctd'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">RELIEF :</span>
                                                            <input readonly type="text" class="form-control" placeholder="RELIEF" name="relief" id="relief" value="<?php echo $row['relief'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Final Deduction :</span>
                                                            <input readonly type="text" class="form-control" placeholder="Final Deduction" name="finalded" id="finalded" readonly value="<?php echo $row['deduction2'] ?>">
                                                          </div>
                                                        </div>
														<!--end_2nd_div-->
														<div class="clearfix"></div>
													  </div>
												</div>
											
                                                            
                                                            
														</div>
													</div>
												</div>
											</div>
                                       </div>
                                       
                                       
                                       <div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4><i class="fa fa-angle-double-right"></i>  NetPay</h4>
												</div>
												<div class="portlet-widgets">
													<a data-toggle="collapse" data-parent="#accordion" href="#netpayinformation"><i class="fa fa-chevron-down"></i></a>
												</div>
												<div class="clearfix"></div>
											</div>
											<div id="netpayinformation" class="panel-collapse in">
												<div class="portlet-body">
													<div class="totalaligndiv">
														<!--1st_div-->
														<div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Gross Pay :</span>
															<input type="text" class="form-control" readonly placeholder="Gross Pay" name="grosspay" id="grosspay"value="<?php echo $row['gross_pay'] ?>"> 
														  </div>
														</div>
                                                        <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Deduction1 :</span>
															<input type="text" class="form-control" readonly placeholder="Gross Pay" name="grosspay" id="grosspay"value="<?php echo $row['deduction1'] ?>"> 
														  </div>
														</div>
                                                        
                                                        <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Net Pay :</span>
															<input type="text" class="form-control" readonly placeholder="Net Pay" name="netpay" id="netpay" value="<?php echo $row['net_pay'] ?>">
														  </div>
														</div>
                                                        
                                                        <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Deduction2 :</span>
															<input type="text" class="form-control" readonly placeholder="Gross Pay" name="grosspay" id="grosspay"value="<?php echo $row['deduction2'] ?>"> 
														  </div>
														</div>
													
														<div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">PAID :</span>
															<input type="text" class="form-control" readonly placeholder="PAID" name="paid" id="paid" value="<?php echo $row['paid'] ?>">
														  </div>
														</div>
                                                        <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Loan :</span>
															<input type="text" class="form-control" readonly placeholder="LOAN" name="loan" id="loan" value="<?php echo $loan ?>">
														  </div>
														</div>
                                                        <div class="col-md-6">
														  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Banker :</span>
															<input type="text" class="form-control" readonly placeholder="BANKER" name="banker" id="banker" value="<?php echo $banker ?>">
														  </div>
														</div>
														<!--end_3rd_div-->
														<div class="clearfix"></div>
														<!--4th_div-->
														<div class="totalaligndiv">
															<div class="col-md-12 vertsizetextarea">
																<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Remarks :</span>
																	<textarea readonly id="textareaMax" class="form-control" maxlength="225" rows="2" name="remarks" style="margin: 0px -0.5px 0px 0px; height: 150px;"><?php echo $remark ?></textarea>
																  </div>
															</div>
															<div class="clearfix"></div>
														</div>
														<!--end_4th_div-->                                
													  </div>
												</div>
											</div>
										</div>
                                       
                                       
                                       
                                       
                                       
								
                                    </div>
                                   
                                    
                                    <!--end_total_left_side_div-->
                                </div>
                            </div>                            
                        </div>
                    <!--end_left_div-->
                  </div>
                  <div class="clearfix"></div>
                </div> <!--end_row_div-->
                
            </div>
            <!-- /.page-content -->

        </div>
        
         <!--view_employee_div-->
    <div class="modal fade" id="viewemployeedetailsdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              
            <h3 class="modal-title" id="myModalLabel">Are you sure want to generate January 2005 A-Roll ? </h3>
          </div>
          <div class="modal-body">
			<div class="totalaligndiv">
                <!--1st_div-->
                <div class="col-md-12">
                <span style="font-size:18px">
                COY [ <span id="icoy" name="icoy">ALL</span> ] 
                <BR>
                Category [ <span id="icategory" name="icategory">ALL</span> ] 
                <BR>
                Pension Type [ <span id="ipension" name="ipension">ALL</span> ]  
                </span>
                </div>
                <!--end_1st_div-->
                <!--2nd_div-->
                <!--end_2nd_div-->
                <div class="clearfix"></div>
             </div>	  
          </div>
          <div class="modal-footer">
          <span style="font-size:14px; float:left" id="istatus">
         
          </span>
            <button type="button" class="btn btn-default btn-gray" data-dismiss="modal" onClick="updatepage();"><i class="fa fa-times"></i>CLOSE</button>
            <button type="submit" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="generateSalary()" disabled >Generate</button>
          </div>
        </div>
      </div>
    </div>
    <!--end_view_employee_div-->
    <script type="text/javascript"> 
	var reload=0;
     function showAROLLData()
    {
		document.getElementById('btnsubmit').disabled = false;
		document.getElementById('istatus').innerHTML= ""; 
		var monthyear = document.getElementById('monthyear').value;
		var coy = document.getElementById('coy').value;
		var category = document.getElementById('category').value;
		var pension_opt = document.getElementById('pension_opt').value;
		document.getElementById('myModalLabel').innerHTML= "Are you sure want to generate "+monthyear+" A-Roll ?";
		document.getElementById('icoy').innerHTML= ""+coy;
		document.getElementById('icategory').innerHTML= ""+category;
		document.getElementById('ipension').innerHTML= ""+pension_opt;
    }
	function generateSalary()
	{
		//alert("generate Salary");
		document.getElementById('istatus').innerHTML= "Generating A-Roll...Please wait..."; 
		var monthyear = document.getElementById('monthyear').value;
		var coy = document.getElementById('coy').value;
		var category = document.getElementById('category').value;
		var pension_opt = document.getElementById('pension_opt').value;
		document.getElementById('btnsubmit').disabled = true;
		
		var dataString = "monthyear="+monthyear+"&coy="+coy+"&category="+category+"&pension="+pension_opt;
		//alert(""+dataString);
		$.ajax({ 
		type: "POST",url: "ajaxgenerateAROLL.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			//alert("Done");
			reload = 1;
			document.getElementById('istatus').innerHTML= "Done..."; 
			document.getElementById('btnsubmit').disabled = true;
			//$("#SHOWDATA").html(html);
			//calcsalary();
		} 
		});
		
	}
	function updatepage()
	{
		if(reload)
			window.location.reload();
	}
	
	
	 </script>
<?php include 'include/footer.php' ?>
