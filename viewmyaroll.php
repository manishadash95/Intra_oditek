<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$forceno = 	$_SESSION["forceno"];
	
	$curdate=date("Y-m-d");
	$curmonth=date("m");
	$curyear=date("Y");
	$dadata= new Configurations();
	
	$aroll_id=$_REQUEST["id"];
	$force_id=$_REQUEST["forceid"];
	$key=$_REQUEST["key"];
	
	$key = $dbobj->hexToStr($key);
	
	//echo "::".$force_id."::<BR>";
	
	$aroll_id = $dbobj->hexToStr($aroll_id);
	$aroll_id = $dbobj->getDecryptedString($aroll_id,$key);
	$aroll_id = trim($aroll_id);
	
	$force_id = $dbobj->hexToStr($force_id);
	$force_id = $dbobj->getDecryptedString($force_id,$key);
	$force_id = trim($force_id);
	
	
	//echo ":::".$force_id."::<BR>";

	
	//echo is_numeric($id)."<BR>";
	//echo ctype_alnum($id)."<BR>";
	//echo is_numeric($employeeid)."<BR>";
	//echo ctype_alnum($employeeid)."<BR>";
	
	if(!is_numeric($aroll_id) )
	{
		return false;
	}
	
	if(!is_numeric($force_id) )
	{
		//echo "aaaaaaa";
		return false;	
	}
	
	
	$dbsql=mysql_query("select * from ".PREFIX."salary_status where id='$aroll_id' ");
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
	
	$dbsql=mysql_query("select * from ".PREFIX."salary where id='$force_id' ");
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
	
	
	////////////////////////////////////////////////////
	$loan = $dbobj->getMonthLoanAmount($forceno,$data1);
	$banker = $row['paid'] - $loan;
	$remark = $dbobj->getMonthMessage($forceno, $data1);
	
	///////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	//FORCE ORDER RECOVERY
	/////////////////////////////////////////////////////
	//////////////ALLOWANCES//////////////////////////
	$spl_pay_label = "Special Pay :";
	$per_pay_label = "Personal Pay :";
	$deppay_label = "Deputation Pay :";
	$calctpt_label = "TPT All :";
	$tpt_arr_label = "TPT Arr :";
	$ma_label = "M.A :";
	$ca_label = "C.A :";
	$training_label = "Training :";
	$npa_label="NPA :";
	$fpa_label = "FPA :";
	$hralevel="HRA (HRA) :";
	$cea_label = "CEA :";
	$calcration_label="Ration All :";
	$wa_label="W.A :";
	$crisk_label = "COB/Risk :";
	$rm_arr_label = "RM Arr :";
	$oth_all_label = "Other All :";
	$oa1_label = "OA 1 :";
	$oa2_label = "OA 2 :";
	$oa3_label = "OA 3 :";
	$oa4_label = "OA 4 :";
	$da_arr_label = "DA Arr :";
	$dep_arr_label = "DEP Arr :";
	$hpca_label = "HPCA :";
	$hair_label = "HAIR C/ALLW. :";
	$soap_label = "SOAPT T/ALLW. :";
	$rum_label = "RUM ALLW. :";

	/////////////DEDUCTION1////////////////////////////////
	if( $pension_opt == "GPF" )
	{
		$gpflevel = "GPF :";
		$gpf_arr_label = "GPF Arr :";
		$gpf_adv_label = "GPF Adv :";
	}
	else
	{
		$gpflevel = "DCPS :";
		$gpf_arr_label = "DCPS Arr :";
		$gpf_adv_label = "DCPS Adv :";
	}
	
	$hrr_label = "HRR :";
	$pli_label = "PLI :";
	$itx_a_label="ITX :";
	$cessp_label="CESS P :";
	$cesss_label="CESS S :";
	$pay_a_label = "PAY ADV :";
	$hba_p_label = "HBA(P) :";
	$hba_i_label = "HBA(I) :";
	$fes_a_label = "FES ADV :";
	$con_a_label = "CON ADV :";
	$l_fee_label = "L FEE :";
	$rm_r_label = "RM Recovery :";
	$comp_a_label = "COMP A :";
	$lsa_label = "LS ADV :";
	$r055_label = "R055 :";
	$r255_label = "R255 :";
	$cghs_label = "CGHS :";
	$gis_label="GIS :";
	$gis_arr_label = "GIS Ar :";
	$ins_label = "INS :";
	/////////////DEDUCTION2////////////////////////////////
	$rps_label="RPS :";
	$pro_tax_label = "PROF / TAX :";
	$cwf_label="CWF :";
	$csf_label = "CSF :";
	$oth_ins_label = "OTH/INS/LIC :";
	$gia_label="GIA :";
	$ndrf_cwf_label = "NDRF WF :";
	$reg_ded_label="REG/RED :";
	$edn_label="EDN/FUND :";
	$relief_label = "PM RELIEF :";
	
	
	/////////////////////////////////////////////////////////////////////////
	$dataArray  = $dbobj->getForceOrderAllRecovery($forceno, $data1);
	$size  = count($dataArray);
	$man_remark="";
	foreach($dataArray as $forceOrderRecovery)
	{
		if(strlen($forceOrderRecovery->remark) > 0)
			$man_remark .= ":".$forceOrderRecovery->remark."\n";
				
		///////////////////////////////////////////////////
		if($forceOrderRecovery->name == "Special Pay")
		{  $spl_pay_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "Personal Pay")
		{  $per_pay_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "Deputation Pay")
		{  $deppay_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "M.A")
		{  $ma_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "C.A")
		{  $ca_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "TPT All")
		{  $calctpt_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "TPT Arr")
		{  $tpt_arr_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "Training")
		{  $training_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "NPA")
		{  $npa_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "FPA")
		{  $fpa_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "HRA")
		{  $hralevel .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "CEA")
		{  $cea_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "Ration All")
		{  $calcration_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "W.A")
		{  $wa_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "COB/Risk")
		{  $crisk_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "RM Arr")
		{  $rm_arr_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "Other All")
		{  $oth_all_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "OA 1")
		{  $oa1_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "OA 2")
		{  $oa2_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "OA 3")
		{  $oa3_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "OA 4")
		{  $oa4_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "DA Arr")
		{  $da_arr_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "DEP Arr")
		{  $dep_arr_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "HPCA")
		{  $hpca_label .= $forceOrderRecovery->label; }
		
		///////////////////////////////////////////////////////////////////////////////////////////////
		else if($forceOrderRecovery->name == "GPF")
		{  $gpflevel .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "GPF Arr")
		{  $gpf_arr_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "GPF Adv")
		{  $gpf_adv_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "HRR")
		{	 $hrr_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "PLI")
		{	 $pli_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "ITX")
		{	 $itx_a_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "CESS P")
		{	 $cessp_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "CESS S")
		{	 $cesss_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "CGHS")
		{	 $cghs_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "GIS")
		{	 $gis_label .= $forceOrderRecovery->label;	} 
		else if($forceOrderRecovery->name == "GIS Ar")
		{	 $gis_arr_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "INS")
		{	 $ins_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "PAY ADV")
		{	 $pay_a_label .= $forceOrderRecovery->label; }	
		else if($forceOrderRecovery->name == "HBA(P)")
		{	 $hba_p_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "HBA(I)")
		{	 $hba_i_label .= $forceOrderRecovery->label;	 }
		else if($forceOrderRecovery->name == "FES ADV")
		{	 $fes_a_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "CON ADV")
		{	 $con_a_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "L FEE")
		{	 $l_fee_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "RM Recovery")
		{	 $rm_r_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "COMP A")
		{	 $comp_a_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "LS ADV")
		{	 $lsa_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "R055")
		{	 $r055_label .= $forceOrderRecovery->label; }
		else if($forceOrderRecovery->name == "R255")
		{	 $r255_label .= $forceOrderRecovery->label;	}
		/////////////////////////////////////////////////////////////////////////////////////////
		else if($forceOrderRecovery->name == "RPS")
		{	 $rps_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "PROF / TAX")
		{	 $pro_tax_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "CWF")
		{	 $cwf_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "CSF")
		{	 $csf_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "OTH/INS/LIC")
		{	 $oth_ins_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "GIA")
		{	 $gia_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "NDRF WF")
		{	 $ndrf_cwf_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "REG/RED")
		{	 $reg_ded_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "EDN/FUND")
		{	 $edn_label .= $forceOrderRecovery->label;	}
		else if($forceOrderRecovery->name == "PM RELIEF")
		{	 $relief_label .= $forceOrderRecovery->label;	}
			
	}
	////////////////////////////////////////////////////////////
	//$config_obj = $dbobj->getConfiguration();
	//if($config_obj->cwf == 0)
	//{
	//	$cwf_label='CWF :'.'<a target="blank" style="color:#D2322D;" " href="configuration.php" > [0] </a>';
	//}
	////////////////////////////////////////////////////////////
	
	
	
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
																		<input type="text" class="form-control"  readonly name="basic_pay" id="basic_pay" onChange="calcsalary()" value="<?php echo $row['basic_pay'] ?>"> 
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $spl_pay_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="Special Pay" name="special_pay" id="special_pay" value="<?php echo $row['special_pay'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div style="display:none" class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Grade Pay :</span>
																		<input type="text" class="form-control" readonly placeholder="Grade Pay" name="grade_pay" id="grade_pay" onChange="calcsalary()" value="<?php echo $row['grade_pay'] ?>">
																	  </div>
																	  <div style="display:none" class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $per_pay_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="Personal Pay" name="personal_pay" id="personal_pay" value="<?php echo $row['personal_pay'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $deppay_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="Deputation Pay" name="deputation_pay" id="deputation_pay" onChange="calcsalary()" value="<?php echo $row['dep_pay'] ?>">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">D.A :</span>
																		<input type="text" class="form-control" readonly placeholder="D.A" name="da" id="da" value="<?php echo $row['da'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $ma_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="Medal All" name="medal_all" id="medal_all" value="<?php echo $row['ma'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $ca_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="CA" name="ca" id="ca" value="<?php echo $row['ca'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12" style="display:none"> <span class="input-group-addon ndrftextwidth text-left">SDA :</span>
																		<input type="text" class="form-control" readonly placeholder="SDA" name="sda" id="sda" value="<?php echo $row['sda'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $calctpt_label; ?></span>
																		<input type="text" class="form-control"readonly  placeholder="TPT All" name="tpt_all" id="tpt_all" value="<?php echo $row['tpt_all'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $tpt_arr_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="TPT Arr" name="tpt_arr" id="tpt_arr" value="<?php echo $row['tpt_arr'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $training_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="Training All" name="training_all" id="training_all" value="<?php echo $row['training'] ?>" onChange="calcsalary()">
																	  </div>
																	  
																	</div>
																	<!--end_1st_div-->
																	<!--2nd_div-->
																	<div class="col-md-4">
																	
																		<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $npa_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="NPA" name="npa" id="npa" value="<?php echo $row['npa'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div style="display:none" class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $fpa_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="FPA" name="fpa" id="fpa" value="<?php echo $row['fpa'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12" style="display:none"> <span class="input-group-addon ndrftextwidth text-left">SUMPTORY :</span>
																		<input type="text" class="form-control" readonly placeholder="SUMPTORY" name="sumptuary_all" id="sumptuary_all" value="<?php echo $row['sumptory'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12" style="display:none"> <span class="input-group-addon ndrftextwidth text-left">PGA Arr :</span>
																		<input type="text" class="form-control" readonly placeholder="PGA Arr" name="pga_arr" id="pga_arr" value="<?php echo $row['pga_arr'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left" id="hralevel" name="hralevel"><?php echo $hralevel; ?></span>
																		<input type="text" class="form-control" readonly placeholder="HRA" name="hra" id="hra" value="<?php echo $row['hra'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $cea_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="CEA" name="cea" id="cea" value="<?php echo $row['cea'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $calcration_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="Ration All" name="ration_all" id="ration_all" value="<?php echo $row['ration'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $wa_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="WA" name="washing_all" id="washing_all" value="<?php echo $row['wa'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div style="display:none" class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $crisk_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="COB/Risk" name="cobrisk_all" id="cobrisk_all" value="<?php echo $row['cob_risk'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $rm_arr_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="RM Arr" name="rm_arr" id="rm_arr" value="<?php echo $row['rm_arr'] ?>" onChange="calcsalary()">
																	  </div>
                                                                      <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $oth_all_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="Other All" name="other_all" id="other_all" value="<?php echo $row['other_all'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $da_arr_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="DA Arr" name="da_arr" id="da_arr" value="<?php echo $row['da_arr'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $dep_arr_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="DEP Arr" name="dep_arr" id="dep_arr" value="<?php echo $row['dep_arr'] ?>" onChange="calcsalary()">
																	  </div>
                                                                      
																	</div>
																	<!--end_2nd_div-->
																	<!--3rd_div-->
																	<div class="col-md-4 newpadding-right-zero">
																		<div class="input-group bmargindiv1 col-md-12" style="display:none"> <span class="input-group-addon ndrftextwidth text-left">SCA/HCA :</span>
																		<input type="text" class="form-control" readonly placeholder="SCA/HCA" name="sca_hca" id="sca_hca" value="<?php echo $row['sca'] ?>" onChange="calcsalary()">
																	  </div>
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $oa1_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="QA 1" name="qa1" id="qa1" value="<?php echo $row['qa1'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $oa2_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="QA 2" name="qa2" id="qa2" value="<?php echo $row['qa2'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $oa3_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="QA 3" name="qa3" id="qa3" value="<?php echo $row['qa3'] ?>" onChange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $oa4_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="QA 4" name="qa4" id="qa4" value="<?php echo $row['qa4'] ?>" onChange="calcsalary()">
																	  </div>
																	  
																	  <div class="input-group bmargindiv1 col-md-12"  style="display:none"> <span class="input-group-addon ndrftextwidth text-left">NCA :</span>
																		<input type="text" class="form-control" readonly  placeholder="NCA" name="nca" id="nca" value="<?php echo $row['nca'] ?>" onChange="calcsalary()">
																	  </div>																	  
                                                                      <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $hpca_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="PCA" name="pca" id="pca" value="<?php echo $row['pca'] ?>" onChange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $hair_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="PCA" name="pca" id="pca" value="<?php echo $row['hcallow'] ?>" onChange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $soap_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="PCA" name="pca" id="pca" value="<?php echo $row['stallow'] ?>" onChange="calcsalary()">
																	  </div>
																	  
																	   <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $rum_label; ?></span>
																		<input type="text" class="form-control" readonly placeholder="PCA" name="pca" id="pca" value="<?php echo $row['rumallow'] ?>" onChange="calcsalary()">
																	  </div>
																	  
																		<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left fontweightbold">Gross :</span>
																		<input type="text" class="form-control" readonly placeholder="Gross" name="gross" id="gross" value="<?php echo $row['gross_pay'] ?>" readonly>
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
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left" id="dedgpglevel"><?php echo $gpflevel; ?></span>
																		<input readonly type="text" class="form-control" placeholder="GPF/DCPS" name="gpf_dcps" id="gpf_dcps"value="<?php echo $row['gpf_dcps'] ?>" onchange="calcsalary()" > 
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $gpf_arr_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="GPF Arr" name="gpf_arr" id="gpf_arr" value="<?php echo $row['gpf_arr'] ?>" onchange="calcsalary()">
																	  </div>
                                                                      
                                                                      <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $gpf_adv_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="PFA" name="pfa" id="pfa" value="<?php echo $row['gpf_adv'] ?>" onchange="calcsalary()">
																	  </div>
                                                                      
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $hrr_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="HRR" name="hrr" id="hrr" value="<?php echo $row['hrr'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $pli_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="PLI" name="pli" id="pli" value="<?php echo $row['pli'] ?>" onchange="calcsalary()">
																	  </div>
                                                                      <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $itx_a_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="ITX" name="itx" id="itx" value="<?php echo $row['itx'] ?>" onchange="calcsalary()">
																	  </div>
                                                                      
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $cessp_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="CESS P" name="cess_p" id="cess_p" value="<?php echo $row['cess_p'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $cesss_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="CESS S" name="cess_s" id="cess_s" value="<?php echo $row['cess_s'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12" style="display:none"> <span class="input-group-addon ndrftextwidth text-left">WC :</span>
																		<input readonly type="text" class="form-control" placeholder="ITX" name="wc" id="wc" value="<?php echo $row['wc'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12" style="display:none"> <span class="input-group-addon ndrftextwidth text-left">FAN :</span>
																		<input readonly type="text" class="form-control" placeholder="GIS" name="fan" id="fan" value="<?php echo $row['fan'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12" style="display:none"> <span class="input-group-addon ndrftextwidth text-left">CYA :</span>
																		<input readonly type="text" class="form-control" placeholder="CYA" name="cya" id="cya" value="<?php echo $row['cya'] ?>" onchange="calcsalary()">
																	  </div>
																	 
																	 
																	</div>
																	<!--end_1st_div-->
																	<!--2nd_div-->
																	<div class="col-md-4">
                                                                     <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $cghs_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="CGHS" name="cghs" id="cghs" value="<?php echo $row['cghs'] ?>" onchange="calcsalary()">
																	  </div>
                                                                     
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $gis_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="GIS" name="gis" id="gis" value="<?php echo $row['gis'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $gis_arr_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="GIS Ar" name="gis_arr" id="gis_arr" value="<?php echo $row['gis_arr'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $ins_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="INS" name="ins" id="ins" value="<?php echo $row['ins'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $pay_a_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="PAY A" name="pay_a" id="pay_a" value="<?php echo $row['pay_a'] ?>" onchange="calcsalary()">
																	  </div>
																      
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $hba_p_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="CON" name="con" id="con" value="<?php echo $row['con'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $hba_i_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="HBL" name="hbl" id="hbl" value="<?php echo $row['hbl'] ?>" onchange="calcsalary()">
																	  </div>
                                                                      <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $fes_a_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="FES" name="fes" id="fes" value="<?php echo $row['fes'] ?>" onchange="calcsalary()">
																	  </div>
																	</div>
																	<!--end_2nd_div-->
																	<!--3rd_div-->
																	<div class="col-md-4 newpadding-right-zero">
																	  
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $con_a_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="N ADV" name="n_adv" id="n_adv" value="<?php echo $row['n_adv'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $l_fee_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="L FEE" name="l_fee" id="l_fee" value="<?php echo $row['l_fee'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $rm_r_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="TERM GRATY" name="term_graty" id="term_graty" value="<?php echo $row['rm_recovery'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $comp_a_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="COMP A" name="comp_a" id="comp_a" value="<?php echo $row['comp_a'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $lsa_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="LS A" name="lsa" id="lsa" value="<?php echo $row['ls_a'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $r055_label; ?></span>
																		<input readonly type="text" class="form-control" placeholder="R055" name="r055" id="r055" value="<?php echo $row['r055'] ?>" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12" style="display:none"> <span class="input-group-addon ndrftextwidth text-left">PENS :</span>
																		<input readonly type="text" class="form-control" placeholder="PENS" name="pens" id="pens" value="0" onchange="calcsalary()">
																	  </div>
																	  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $r255_label; ?></span>
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
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $rps_label; ?></span>
                                                            <input readonly type="text" class="form-control" placeholder="RPS" name="rps" id="rps" value="<?php echo $row['rps'] ?>"> 
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $pro_tax_label; ?></span>
                                                            <input readonly type="text" class="form-control" placeholder="PROF / TAX" name="prof_tax" id="prof_tax" value="<?php echo $row['pro_tax'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $cwf_label; ?></span>
                                                            <input readonly type="text" class="form-control" placeholder="CWF" name="cwf" id="cwf" value="<?php echo $row['cwf'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $csf_label; ?></span>
                                                            <input readonly type="text" class="form-control" placeholder="CSF" name="csf" id="csf" value="<?php echo $row['csf'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $oth_ins_label; ?></span>
                                                            <input readonly type="text" class="form-control" placeholder="OTH/INS/LIC" name="oth_ins_lic" id="oth_ins_lic" value="<?php echo $row['other'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $gia_label; ?></span>
                                                            <input readonly type="text" class="form-control" placeholder="GIA" name="gia" id="gia" value="<?php echo $row['gia'] ?>">
                                                          </div>
                                                        </div>
														<!--end_1st_div-->
														<!--2nd_div-->
														<div class="col-md-6">
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $ndrf_cwf_label; ?></span>
                                                            <input readonly type="text" class="form-control" placeholder="NDRF (CWF)" name="ndrf_cwf" id="ndrf_cwf" value="<?php echo $row['ndrf_cwf'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $reg_ded_label; ?></span>
                                                            <input readonly type="text" class="form-control" placeholder="REG/PED" name="reg_ded" id="reg_ded" value="<?php echo $row['reg_ped'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $edn_label; ?></span>
                                                            <input readonly type="text" class="form-control" placeholder="EDU/FUND" name="edu_fund" id="edu_fund" value="<?php echo $row['edu_fund'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12" style="display:none"> <span class="input-group-addon ndrftextwidth text-left">CTD :</span>
                                                            <input readonly type="text" class="form-control" placeholder="CTD" name="ctd" id="ctd" value="<?php echo $row['ctd'] ?>">
                                                          </div>
                                                          <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left"><?php echo $relief_label; ?></span>
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
