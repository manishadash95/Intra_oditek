<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	$emp_id = 	$_SESSION["emp_id"];
	
	
	if(isset($_POST["btnsubmit"]))
	{
		//$mobile =$_POST["mobile_no"];
		//$email =$_POST["email"];
		//$password =$_POST["password"];
		//$forceno = 	$_SESSION["forceno"];
		$ret = $dbobj->updateMyData($emp_id,$_POST);
		//$msg ='<div style="color:#16a085; text-align:center; padding-bottom:10px;">Data Updated Successfully.</div>';
		$msg = '<script>alert("Profile Updated Successfully.");  </script>';
	}
	
	
	$dbsql=mysql_query("select * from od_employee where eid='".$emp_id."' ");
	$Num = mysql_num_rows($dbsql);
	$daarray=array();
	if ($Num > 0)
	{
		if($row = mysql_fetch_array($dbsql))
		{
			$name=$row['name'];
			$rank=$row['rank'];
			$rank = $dbobj->getRankTypeName($rank);
			$coy=$row['coy'];
		}
	}
	
	$employee = $dbobj->getEmployeeData($emp_id);
	$rankobj = $dbobj->getRank();
	$allname_array = $dbobj->getAllName();
	$designation_array = $dbobj->getDesignation();
	$department_array = $dbobj->getDepartment();
	
	
	if(!isset($_GET["page"]) || $_GET["page"]=="" || $_GET["page"]<1){
		$page = 1;
	}else{
		$page = (int) $_GET['page'];
	}
	$categoryarr=array();
?>
<?php include 'include/header.php' ?>
<script>

function validation(){
		var passwd = document.getElementById('password').value;
		var rtpasswd = document.getElementById('rpassword').value;
		
		//if(passwd.length == 0)
		//{
		//	alert("Password field should not empty...");
		//	return false;
		//}
		if(passwd.length > 0 && passwd != rtpasswd )
		{
			alert("Password field mismatch...");
			return false;
		}
		
		var email = document.getElementById('email1').value;
		var etest=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!etest.test(email))
	    {
	    	alert("Invalid Email Id");
	    	return false;
	    }
		return true;
	}



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
                	
                    <div class="col-lg-12">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-user"></i>  <a href="dashboard.php">My Profile</a></li>
                                
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
                                    <h4><i class="fa fa-exchange fa-fw"></i> <?php echo $name?> [ Employee Id: <?php echo $emp_id?> ]</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#employeeliststatus"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->
									 
                                       
                                   <form name="frmemployee" id="frmemployee" method="post" onSubmit="imgupload()">
                                    <div class="totalaligndiv" style="margin-top:30px;">
										<!--1st_div-->
									
							        
									
									<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Name :</span>
												<input type="text" readonly name="name_first" id="name_first" class="form-control" placeholder="Employee Name" value="<?php echo $employee->name ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Gender :</span>
													<select id="gender" readonly disabled name="gender" class="form-control" >
														<option value="0">Select Gender</option>
														<option value="1" <?php echo ($employee->gender == 1 )?'selected':'' ?> >Male</option>
														<option value="2" <?php echo ($employee->gender == 2 )?'selected':'' ?> >Female</option>		
													</select>
											</div>
											
											
											
											
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Birth :</span>
												<input type="text" name="date_of_birth" id="date_of_birth" class="form-control tcal" placeholder="Date of Birth" value="<?php echo $employee->date_of_birth ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Mobile No :</span>
												<input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No" maxlength="10" value="<?php echo $employee->mobile ?>">
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Emergency No :</span>
												<input type="text" name="emergency_no" id="emergency_no" class="form-control" placeholder="Emergency No" maxlength="10" value="<?php echo $employee->emergency ?>" >
											</div>

											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Email Id :</span>
											<input type="text" name="email1" id="email1" class="form-control" placeholder="Email id" value="<?php echo $employee->email ?>">
											</div>	

											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Skype Id :</span>
											<input type="text" name="skype" id="skype" class="form-control" placeholder="Skype id" value="<?php echo $employee->skype_id ?>" >
											</div>	
											
											
											
										
											
											
											
											
										</div>
										<!--end_1st_div-->
										<!--2nd_div-->
										<div class="col-md-6">
										<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Date of Joining :</span>
												<input type="text" name="oditek_joining_date" id="oditek_joining_date" readonly class="form-control" placeholder="Joining Date" value="<?php echo $employee->joining_date ?>" >
											</div>
											
											 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Bank Name :</span>
													<select id="bank_name" readonly disabled name="bank_name" class="form-control" >
														<option value="0">Select Bank</option>
														<option value="1" <?php echo ($employee->bank_name == 1 )?'selected':'' ?> >SBI</option>
														<option value="2" <?php echo ($employee->bank_name == 2 )?'selected':'' ?> >ICICI</option>
														<option value="3" <?php echo ($employee->bank_name == 3 )?'selected':'' ?> >Other</option>														
													</select>
											</div>
											
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Bank A/c No :</span>
												<input type="text" readonly name="bank_account_no" id="bank_account_no" class="form-control" placeholder="Bank A/c No" maxlength="20" value="<?php echo $employee->bank_account_no ?>">
											</div>
											
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Branch Name :</span>
												<input type="text" readonly  name="branch_name" id="branch_name" class="form-control" placeholder="Branch Name" class="form-control" maxlength="20" value="<?php echo $employee->branch_name ?>" >
											</div>
											
                                            <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">PAN No :</span>
												<input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="PAN No" maxlength="10" value="<?php echo $employee->pan_no ?>">
											</div>
											
											 <div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Passport No :</span>
												<input type="text" name="passport_no" id="passport_no" class="form-control" placeholder="Passport No" value="<?php echo $employee->passport_no ?>">
											</div>
											
											
											
                                            
                                            <div class="input-group bmargindiv1 col-md-12" id="divtptcity">
												<span class="input-group-addon ndrftextwidth text-right">Employee Status :</span>
												<select id="employee_status" readonly disabled name="employee_status" class="form-control" onchange="checkStatus()"  >
												<option value="" >Select Status</option>
												<option value="Present" <?php echo ($employee->status == "Present" )?'selected':'' ?>  >Present</option>
												<option value="Left" <?php echo ($employee->status == "Left" )?'selected':'' ?> >Left</option>
												<option value="Held" <?php echo ($employee->status == "Held" )?'selected':'' ?> >With Held</option>
												</select>
											</div>
											
											
										</div>
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									
                                    
                                                     
                                    

										<div class="col-lg-12">
										<div class="portlet portlet-blue" style="margin-bottom:12px;">
											<div class="portlet-heading">
												<div class="portlet-title">
													<h4><i class="fa fa-angle-double-right"></i> Login Information</h4>
												</div>
												<div class="portlet-widgets">
													<a data-toggle="collapse" data-parent="#accordion" href="#logininformation"><i class="fa fa-chevron-down"></i></a>
												</div>
												<div class="clearfix"></div>
											</div>
											<div id="logininformation" class="panel-collapse collapse in">
												<div class="portlet-body">
													
													
													
													<div class="col-md-6">
													
													<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Office Email :</span>
															<input type="text" readonly disabled name="email_office" id="email_office" class="form-control" placeholder="Email" maxlength="30" onChange="updateLoginId()" value="<?php echo $employee->office_email."@oditeksolutions.com" ?>" >
															
													</div>
													
													
													<div class="input-group bmargindiv1 col-md-12">
													<span class="input-group-addon ndrftextwidth text-right">Report To :</span>
													<select id="upper_id" readonly disabled name="upper_id" class="form-control" ">
														<option value="">Select Name</option>
														<?php
															foreach($allname_array as $val)
															{
																$selected = ( $employee->upper_id == $val->id)?'selected':'';
																echo '<option value="'.$val->id.'"   '.$selected.' >'.$val->name.'</option>';
															}			
														?>														
													</select>
													</div>
													
													
													<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-right">Department :</span>
													<select id="dept_id" readonly disabled name="dept_id" class="form-control" ">
														<option value="">Select Department</option>
														<?php
															foreach($department_array as $val)
															{
																$selected = ( $employee->dept_id == $val->id)?'selected':'';
																echo '<option value="'.$val->id.'"  '.$selected.' >'.$val->name.'</option>';
															}			
														?>														
													</select>
												</div>
												
														
												
												
														
													</div>
													
													
													
													
													<div class="col-md-6">
													
												
													<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Employee Id :</span>
															<input type="text" name="employeeid" id="employeeid" class="form-control" placeholder="Employee Id" value="<?php echo $employee->eid ?>" readonly>
															
														</div>
														
													<div class="input-group bmargindiv1 col-md-12">
													<span class="input-group-addon ndrftextwidth text-right">Designation :</span>
													<select id="desig_id" readonly disabled name="desig_id" class="form-control" ">
														<option value="">Select Designation</option>
														<?php
															foreach($designation_array as $val)
															{
																$selected = ( $employee->desig_id == $val->id)?'selected':'';
																echo '<option value="'.$val->id.'"  '.$selected.' >'.$val->name.'</option>';
															}			
														?>														
													</select>
													</div>

														<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">Login Id :</span>
															<input type="text" name="userid" id="userid" class="form-control" placeholder="User Id" readonly value="<?php echo $employee->office_email ?>">
														</div>													
														
												
														
													</div>
													
													
													
													
													<div class="col-md-6">
													
												
													<div class="input-group bmargindiv1 col-md-12">
															<span class="input-group-addon ndrftextwidth text-right">New Password :</span>
															<input type="password" name="password" id="password" class="form-control" placeholder="New Password" value="" >
															
														</div>
														
													
														
												
														
													</div>
													
													<div class="col-md-6">
													
												
													
														
													<div class="input-group bmargindiv1 col-md-12">
													<span class="input-group-addon ndrftextwidth text-right">Retype Password :</span>
													<input type="password" name="rpassword" id="rpassword" class="form-control" placeholder="Confirm Password " value="" >
													</div>	
														
												
														
													</div>
													
													
													
													
													
													<div class="clearfix"></div>
												</div>
												
												
												
											</div>
										</div>
									</div>

									</div>									
                                    
                                 			
                                       
                                       
                                       
                                       <div class="col-lg-12">
										<div class="bpaddingdiv1 text-center">
										<input type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-green btn-lg" onclick="return validation();" value="Update">
										</div>
									</div>
                                       
                                       
                                       <div class="clearfix"></div>
                                       
								
                                    </div>
                                    
                                    </form>
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
