<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$eid = $_SESSION["emp_id"];
	
	$iv = $_REQUEST['iv'];
	if($eid == 1001 || $eid == 230803)
		$empList = $dbobj->getAllEmployeeListName();
	else
		$empList = $dbobj->getAllEmployeeListNameHR();
	
		
	
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>
<?php include 'imageupload/popimageupload.php' ?>
<div id="page-wrapper">
	<div class="page-content">

		<!-- begin PAGE TITLE AREA -->
		<!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
		<div class="row">
			
			<div class="col-lg-12">
				<div class="page-title">
					<ol class="breadcrumb">
						<li class="active">Edit Employee Data</li>
					</ol>

				</div>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<!-- end PAGE TITLE AREA -->
	   
	   <!--main_heading_div-->
		<!--search_filed_div-->
		
		<!--end_search_field_div-->
		<!-- /.row -->
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4> Update Employee Records</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="editdata" id="editdata" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
			
			
									<div class="col-md-12">
										
									<div class="col-md-12">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Select Resource :</span>
									<select id="reso_id" name="reso_id" class="form-control chosen-select"  >
									<option value="0" >Select Resource</option>
									<?php foreach($empList as $emp){ 
									?>
									<option value="<?php echo $emp->eid; ?>" > [<?php echo $emp->eid; ?>]: <?php echo $emp->name; ?></option>
									<?php } ?>
									</select>
									</div>
									</div>
																				
									</div>
									
									<input type="hidden" id="heid" name="heid" value="">
									<input type="hidden" id="hid" name="hid" value="">
									<input type="hidden" id="htype" name="htype" value="">
									
									<div class="col-md-12">
									<div class="bpaddingdiv1 text-center">
									<button type="button" class="btn btn-default " name="btnsubmit" onclick="loadResourceData();" id="btnsubmit">View</button> 
									</div>
									</div>

									<div class="col-md-2">
									<div class="bpaddingdiv1 text-center">
											
									
									<img src="img/male.jpg" id="bigimage2_1" name="bigimage2_1" border="0" width="140" height="160" style="border:#666 1px solid">		
									</div>
							
									</div>		

									<div class="col-md-10">
									
									
									<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Emp. Name :</span>
									<input type="text" readOnly id="emp_name"  name="emp_name" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Emp. Id :</span>
									<input type="text" readOnly id="emp_id" name="emp_id" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">OdiTek Exp :</span>
									<input type="text" readOnly id="emp_exp" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Current Status :</span>
									<input type="text" readOnly id="emp_status" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Joining Date :</span>
									<input type="text" readOnly id="emp_doj" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Exit Date :</span>
									<input type="text" readOnly id="emp_dol" class="form-control" placeholder="" value="">
									</div>
									</div>
									
									
									</div>
									
									
									
									
									
									<div class="col-md-12" id="emp_data_block" style="display:none;">
									
									
									
									
									<div class="portlet portlet-blue">
									<div class="portlet-heading">
									<div class="portlet-title toplistviewtab">
									<ul id="myTab111" class="nav nav-tabs" style="margin-bottom:0px; border-bottom:0px">
									<li class="active"><a href="#basic1" data-toggle="tab">Basic Info</a></li>
									<li><a href="#family1" data-toggle="tab">Family Info</a></li>
									<li><a href="#education1" data-toggle="tab">Education Info</a></li>
									<li><a href="#pastexp1" data-toggle="tab">Past Exp. Info</a></li>
									<li><a href="#empinfo1" data-toggle="tab">Employee Info</a></li>
									<li><a href="#buinfo1" data-toggle="tab">BU Info</a></li>
									<li><a href="#notice1" data-toggle="tab">On-Notice</a></li>
									<li><a href="#imageinfo1" data-toggle="tab">Image Info</a></li>
									
									<!--
									<li class="dropdown">
									<a href="#" id="myTabDrop11" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
									<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop11">
										<li><a href="#dropdown11" tabindex="-1" data-toggle="tab">@fat</a>
										</li>
										<li><a href="#dropdown21" tabindex="-1" data-toggle="tab">@mdo</a>
										</li>
									</ul>
									</li>
									-->
									</ul>
									</div>
									<div class="clearfix"></div>
									</div>
					
					
					<div class="portlet-body">
						
						<div id="myTabContent1" class="tab-content">
							
							<div class="tab-pane fade in active" id="basic1">
							<?php include_once 'hr_editemployee_basic.php'; ?>			
							</div>
							
							<div class="tab-pane fade" id="family1">
							<?php include_once 'hr_editemployee_family.php'; ?>
							</div>
							
							<div class="tab-pane fade" id="education1">
							<?php include_once 'hr_editemployee_education.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="pastexp1">
							<?php include_once 'hr_editemployee_pexp.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="empinfo1">
							<?php include_once 'hr_editemployee_office.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="buinfo1">
							<?php include_once 'hr_editemployee_bu.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="notice1">
							<?php include_once 'hr_editemployee_notice.php'; ?>	
							</div>
							<div class="tab-pane fade" id="imageinfo1">
							<?php include_once 'hr_editemployee_image.php'; ?>	
							</div>
							<!--
							<div class="tab-pane fade" id="dropdown11">
								<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
								<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
							</div>
							<div class="tab-pane fade" id="dropdown21">
								<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
								<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
							</div>
							-->
						</div>
					</div>

				</div>
									
									
									
									
									
									

									</div>
									
									
									
									
									
																		
									
									<!--end_total_employee_div-->
									<!--login_informations_div-->
							
									<!--end_login_information_div-->
									
									
									<!--permission_informations_div-->
					
									
									<!--end_permission_information_div-->
									<!--allowances_deduction_div-->
			
									<!--end_allowances_deduction_div-->
                                    <!--final_deduction_div-->
                            
                                    <!--end_final_deduction_div-->
									<!--netpay_information_div-->
				
									<!--end_netpay_information_div-->
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                       	</form>
						</div>
					</div>
					<!-- /.col-lg-12 -->

				</div>
			</div>
		</div>

	</div>
	<!-- /.page-content -->

</div>





<?php include 'include/footer.php' ?>


<script>


window.onload = function() {
	
	
		
	};
	


function loadResourceData()
{
	var reso_id = document.getElementById( 'reso_id').value;
	
	if(reso_id == 0)
	{
		alert("Please select Resource");
		return false;
	}
	//display block
	var emp_data_block = document.getElementById( 'emp_data_block');
	
	var emp_name = document.getElementById('emp_name');
	var emp_id = document.getElementById('emp_id');
	var emp_exp = document.getElementById('emp_exp');
	var emp_status = document.getElementById('emp_status');
	var emp_doj = document.getElementById('emp_doj');
	var emp_dol = document.getElementById('emp_dol');
	var heid = document.getElementById('heid');
	var hid = document.getElementById('hid');
	var htype = document.getElementById('htype');
	var bigimage2_1 = document.getElementById('bigimage2_1');
	
	
	
	//Basic Info
	var name_first = document.getElementById('name_first');
	var gender = document.getElementById('gender');
	var blood_grp = document.getElementById('blood_grp');
	var date_of_birth = document.getElementById('date_of_birth');
	var mobile_no = document.getElementById('mobile_no');
	var emergency_no = document.getElementById('emergency_no');
	var email1 = document.getElementById('email1');
	var skype = document.getElementById('skype');
	var pan_no = document.getElementById('pan_no');
	var passport_no = document.getElementById('passport_no');
	var aadhar_no = document.getElementById('aadhar_no');
	var mrg_status = document.getElementById('mrg_status');
			
	//family info
	var father_name = document.getElementById('father_name');
	var emer_name = document.getElementById('emer_name');	
	var addr1 = document.getElementById('addr1');
	var mother_name = document.getElementById('mother_name');
	var emer_mobile = document.getElementById('emer_mobile');
	var emer_rela = document.getElementById('emer_rela');
	
	//education info
	var cuname1 = document.getElementById('cuname1');
	var degree1 = document.getElementById('degree1');
	var eduyear1 = document.getElementById('eduyear1');
	var eduper1 = document.getElementById('eduper1');
	var cuname2 = document.getElementById('cuname2');
	var degree2 = document.getElementById('degree2');
	var eduyear2 = document.getElementById('eduyear2');
	var eduper2 = document.getElementById('eduper2');
	var cuname3 = document.getElementById('cuname3');
	var degree3 = document.getElementById('degree3');
	var eduyear3 = document.getElementById('eduyear3');
	var eduper3 = document.getElementById('eduper3');
	
	//Pre Exp Info
	var exp_type = document.getElementById('exp_type');
	var prev_org = document.getElementById('prev_org');
	var exp_yr = document.getElementById('exp_yr');
	var exp_mn = document.getElementById('exp_mn');
	var skills = document.getElementById('skills');
	
	//office info
	var joining_date = document.getElementById('joining_date');
	var exit_date = document.getElementById('exit_date');
	var employee_type = document.getElementById('employee_type');
	var prob_dura = document.getElementById('prob_dura');
	var end_probation = document.getElementById('end_probation');
	
	//BU INfo
	var bu_id = document.getElementById('bu_id');
	var prm_id = document.getElementById('prm_id');
	var upper_id = document.getElementById('upper_id');
	var dept_id = document.getElementById('dept_id');
	var bu_head = document.getElementById('bu_head');
	var prm_head = document.getElementById('prm_head');
	var desig_id = document.getElementById('desig_id');
	
	
	//Notice INfo
	var notice_start_date = document.getElementById('notice_start_date');
	var notice_end_date = document.getElementById('notice_end_date');
	var notice_period = document.getElementById('notice_period');
		
	
	var dataString = "act=getemployeedata&eid="+reso_id;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				//$("#DATAFIELD").html(dobj.data);
				emp_name.value = dobj.emp_name;
				emp_id.value = dobj.emp_id;
				emp_exp.value = dobj.emp_exp;
				emp_status.value = dobj.emp_status;
				emp_doj.value = dobj.emp_doj;
				emp_dol.value = dobj.emp_dol;
				heid.value = dobj.emp_id;
				hid.value = dobj.db_id;	
				htype.value = dobj.db_type;
				bigimage2_1.src =dobj.emp_image;
	            bigimage2_2.src =dobj.emp_image;	
				
				//Basic Info
				name_first.value = dobj.emp_name
				for(i=0;i<document.getElementById("gender").length;i++){
					if(document.getElementById("gender").options[i].value==dobj.gender_id){
						document.getElementById("gender").options[i].selected=true;
						break;
					}
				}
				for(i=0;i<document.getElementById("blood_grp").length;i++){
					if(document.getElementById("blood_grp").options[i].value==dobj.blood_grp){
						document.getElementById("blood_grp").options[i].selected=true;
						break;
					}
				}
				for(i=0;i<document.getElementById("mrg_status").length;i++){
					if(document.getElementById("mrg_status").options[i].value==dobj.mrg_status){
						document.getElementById("mrg_status").options[i].selected=true;
						break;
					}
				}
				date_of_birth.value = dobj.date_of_birth;
				mobile_no.value = dobj.mobile;
				emergency_no.value = dobj.emergency;
				email1.value = dobj.email;
				skype.value = dobj.skype_id;
				pan_no.value = dobj.pan_no;
				passport_no.value = dobj.passport_no;
				aadhar_no.value = dobj.aadhar_no;				
				
				//family info
				father_name.value = dobj.father_name;
				mother_name.value = dobj.mother_name;
				emer_name.value = dobj.emer_name;
				emer_mobile.value = dobj.emer_mobile;
				emer_rela.value = dobj.emer_rela;
				addr1.innerHTML = dobj.addr1;
				
				//education info
				cuname1.value = dobj.cuname1;
				degree1.value = dobj.degree1;
				eduyear1.value = dobj.eduyear1;
				eduper1.value = dobj.eduper1;
				cuname2.value = dobj.cuname2;
				degree2.value = dobj.degree2;
				eduyear2.value = dobj.eduyear2;
				eduper2.value = dobj.eduper2;
				cuname3.value = dobj.cuname3;
				degree3.value = dobj.degree3;
				eduyear3.value = dobj.eduyear3;
				eduper3.value = dobj.eduper3;
				
				//Pre Exp Info
				for(i=0;i<document.getElementById("exp_type").length;i++){
					if(document.getElementById("exp_type").options[i].value==dobj.pre_exp){
						document.getElementById("exp_type").options[i].selected=true;
						break;
					}
				}
				//alert(dobj.pre_exp);
				if(dobj.pre_exp == 0)
				{
					prev_org.disabled = true;
					exp_yr.disabled = true;
					exp_mn.disabled = true;
					skills.disabled = true;
				}
				else{
					prev_org.disabled = false;
					exp_yr.disabled = false;
					exp_mn.disabled = false;
					skills.disabled = false;
				}
				prev_org.value = dobj.prev_org;
				exp_yr.value = dobj.exp_year;
				exp_mn.value = dobj.exp_month;
				skills.value = dobj.skills;
				
				//office info
				//alert("::"+dobj.pro_end_date);
				joining_date.value = dobj.joining_date;
				exit_date.value = dobj.exit_date;
				end_probation.value = dobj.pro_end_date;
				prob_dura.value = dobj.pro_duration;
				if(exit_date.value=="")
					exit_date.disabled = true;
				else
					exit_date.disabled = false;
				
				if(dobj.emp_type == 2)
				{
					end_probation.disabled = false;
					prob_dura.disabled = true;
				}
				else{
					end_probation.disabled = true;
					prob_dura.disabled = true;
				}
				
				for(i=0;i<document.getElementById("employee_type").length;i++){
					if(document.getElementById("employee_type").options[i].value==dobj.emp_type){
						document.getElementById("employee_type").options[i].selected=true;
						break;
					}
				}
				
				//BU header
				bu_head.value = dobj.bu_head;
				prm_head.value = dobj.prm_head;
				
				for(i=0;i<document.getElementById("bu_id").length;i++){
					if(document.getElementById("bu_id").options[i].value==dobj.bu_id){
						document.getElementById("bu_id").options[i].selected=true;
						break;
					}
				}

				for(i=0;i<document.getElementById("prm_id").length;i++){
					if(document.getElementById("prm_id").options[i].value==dobj.prm_id){
						document.getElementById("prm_id").options[i].selected=true;
						break;
					}
				}

				for(i=0;i<document.getElementById("upper_id").length;i++){
					if(document.getElementById("upper_id").options[i].value==dobj.upper_id){
						document.getElementById("upper_id").options[i].selected=true;
						break;
					}
				}

				for(i=0;i<document.getElementById("dept_id").length;i++){
					if(document.getElementById("dept_id").options[i].value==dobj.dept_id){
						document.getElementById("dept_id").options[i].selected=true;
						break;
					}
				}

				for(i=0;i<document.getElementById("desig_id").length;i++){
					if(document.getElementById("desig_id").options[i].value==dobj.desig_id){
						document.getElementById("desig_id").options[i].selected=true;
						break;
					}
				}

				//Notice Info
				notice_start_date.value = dobj.notice_start_date;
				notice_end_date.value = dobj.notice_end_date;				
				for(i=0;i<document.getElementById("notice_period").length;i++){
					if(document.getElementById("notice_period").options[i].value==dobj.notice_period){
						document.getElementById("notice_period").options[i].selected=true;
						break;
					}
				}
				
				emp_data_block.style.display = "block";
			}
			else{
				//alert(dobj.msg);
				//location.reload();
			}
		} 
	});
	
				
}	




function updatePastExp()
{
	var exp_type = document.getElementById('exp_type');
	var prev_org = document.getElementById('prev_org');
	var exp_yr = document.getElementById('exp_yr');
	var exp_mn = document.getElementById('exp_mn');
	var skills = document.getElementById('skills');
	
	if(exp_type.value == 1)
	{
		prev_org.disabled = false;
		exp_yr.disabled = false;
		exp_mn.disabled = false;
		skills.disabled = false;
	}
	else{
		prev_org.disabled = true;
		exp_yr.disabled = true;
		exp_mn.disabled = true;
		skills.disabled = true;
	}
	
}	

function actionEmpType()
{
	var employee_type = document.getElementById('employee_type');
	var prob_dura = document.getElementById('prob_dura');
	var end_probation = document.getElementById('end_probation');
	
	if(employee_type.value == 2) //mean probation
	{
		prob_dura.disabled = true;
		end_probation.disabled = false;
	}
	else
	{
		prob_dura.disabled = true;
		end_probation.disabled = true;
	}
	
}	

function actionNotice()
{
	var notice_start_date = document.getElementById('notice_start_date');
	var notice_end_date = document.getElementById('notice_end_date');
	var notice_period = document.getElementById('notice_period');
	
	var dataString = "act=getEndDate&sdate="+notice_start_date.value+"&period="+notice_period.value;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			//alert(dobj.end_date);
			if(dobj.status==1)
			{
				notice_end_date.value = dobj.end_date;
			}
			else{
				
			}
		} 
	});
	
	
}

function updateProbationDuration()
{
	var joining_date = document.getElementById('joining_date');
	var end_probation = document.getElementById('end_probation');
	var prob_dura = document.getElementById('prob_dura');
	
	var dataString = "act=getProbationDuration&sdate="+joining_date.value+"&edate="+end_probation.value;
	//alert(dataString);
	$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				prob_dura.value = dobj.duration;
			}
			else{
				
			}
		} 
	});
	
	
	
}


function updateBasicInfo()
{
	var emp_name = document.getElementById('emp_name');
	var name_first = document.getElementById('name_first');
	var gender = document.getElementById('gender');
	var blood_grp = document.getElementById('blood_grp');
	var date_of_birth = document.getElementById('date_of_birth');
	var mobile_no = document.getElementById('mobile_no');
	var emergency_no = document.getElementById('emergency_no');
	var email1 = document.getElementById('email1');
	var mrg_status = document.getElementById('mrg_status');
	
	if(name_first.value == "")
	{
		alert("Please add Name");
		return false;
	}
	else if(gender.value == 0)
	{
		alert("Please select Gender");
		return false;
	}
	else if(blood_grp.value == 0)
	{
		alert("Please select Blood Group");
		return false;
	}
	else if(date_of_birth.value == "")
	{
		alert("Please add Date of Birth");
		return false;
	}
	else if(mobile_no.value == "")
	{
		alert("Please add Mobile Number");
		return false;
	}
	else if(emergency_no.value == "")
	{
		alert("Please add Emergency Number");
		return false;
	}
	else if(email1.value == "")
	{
		alert("Please add Personal Email");
		return false;
	}
	else if(mrg_status.value == 0)
	{
		alert("Please select Marriage Status");
		return false;
	}
	
	
	if(confirm("Are you sure want to update Basic Info of \""+emp_name.value+"\"?"))
	{
		var dataString = "act=updateBasicInfo&";
		dataString +=$( "#editdata" ).serialize();
		//alert(dataString);
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				loadResourceData();
			}
			else{
				
			}
		} 
		});
	}	
}

function updateFamilyInfo()
{
	var emp_name = document.getElementById('emp_name');
	var father_name = document.getElementById('father_name');
	var emer_name = document.getElementById('emer_name');	
	var addr1 = document.getElementById('addr1');
	var mother_name = document.getElementById('mother_name');
	var emer_mobile = document.getElementById('emer_mobile');
	var emer_rela = document.getElementById('emer_rela');
	
	if(father_name.value == "")
	{
		alert("Please add Father's Name");
		return false;
	}
	else if(mother_name.value == "")
	{
		alert("Please add Mother's Name");
		return false;
	}
	else if(emer_name.value == "")
	{
		alert("Please add Emergency Contact Name ");
		return false;
	}
	else if(emer_mobile.value == "")
	{
		alert("Please add Emergency Mobile Name ");
		return false;
	}
	else if(addr1.value == "")
	{
		alert("Please add Address...");
		return false;
	}
	else if(emer_rela.value == "")
	{
		alert("Please add Relationship");
		return false;
	}
	
	if(confirm("Are you sure want to update Family Info of \""+emp_name.value+"\"?"))
	{
		var dataString = "act=updateFamilyInfo&";
		dataString +=$( "#editdata" ).serialize();
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				loadResourceData();
			}
			else{
				
			}
		} 
		});
	}	
	
}


function updateEducationInfo()
{
	var emp_name = document.getElementById('emp_name');
	
	
	if(confirm("Are you sure want to update Education Info of \""+emp_name.value+"\"?"))
	{
		var dataString = "act=updateEducationInfo&";
		dataString +=$( "#editdata" ).serialize();
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				loadResourceData();
			}
			else{
				
			}
		} 
		});
	}	
	
}


function updatePastExpInfo()
{
	var emp_name = document.getElementById('emp_name');
	
	var exp_type = document.getElementById('exp_type');
	var prev_org = document.getElementById('prev_org');
	var exp_yr = document.getElementById('exp_yr');
	var exp_mn = document.getElementById('exp_mn');
	var skills = document.getElementById('skills');
	
	if(exp_type.value == 1)
	{
		if(exp_yr.value == "")
		{
			alert("Please add number of Year...");
			return false;
		}
		if(exp_mn.value == "")
		{
			alert("Please add number of Month...");
			return false;
		}
		if(prev_org.value == "")
		{
			alert("Please add Previous Organization name...");
			return false;
		}
		if(skills.value == "")
		{
			alert("Please add Skills...");
			return false;
		}
		
	}
	
	if(confirm("Are you sure want to update Past Experience Info of \""+emp_name.value+"\"?"))
	{
		var dataString = "act=updatePastExpInfo&";
		dataString +=$( "#editdata" ).serialize();
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				loadResourceData();
			}
			else{
				
			}
		} 
		});
	}	
	
}


function updateOfficeInfo()
{
	var emp_name = document.getElementById('emp_name');

	var joining_date = document.getElementById('joining_date');
	var employee_type = document.getElementById('employee_type');
	var end_probation = document.getElementById('end_probation');
		
	if(joining_date.value == "")
	{
		alert("Please select Date of Join...");
		return false;
	}
	
	if(employee_type.value == 0)
	{
		alert("Please select Employee Type...");
		return false;
	}
	if(employee_type.value == 2 && end_probation.value == "") // 2 mean Probation
	{
		alert("Please select End of Probation date...");
		return false;
	}
	
	
	if(confirm("Are you sure want to update Employee Info of \""+emp_name.value+"\"?"))
	{
		var dataString = "act=updateEmployeeInfo&";
		dataString +=$( "#editdata" ).serialize();
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				loadResourceData();
			}
			else{
				
			}
		} 
		});
	}	
	
}

function updateBUInfo()
{
	var emp_name = document.getElementById('emp_name');

	var bu_id = document.getElementById('bu_id');
	var upper_id = document.getElementById('upper_id');
	var dept_id = document.getElementById('dept_id');
	var desig_id = document.getElementById('desig_id');
	
	if(bu_id.value == 0)
	{
		alert("Please select Business Unit...");
		return false;
	}
	if(upper_id.value == 0)
	{
		alert("Please select Report To...");
		return false;
	}
	if(dept_id.value == 0)
	{
		alert("Please select Department...");
		return false;
	}
	if(desig_id.value == 0)
	{
		alert("Please select Designation...");
		return false;
	}
	
	if(confirm("Are you sure want to update BU Info of \""+emp_name.value+"\"?"))
	{
		var dataString = "act=updateBUInfo&";
		dataString +=$( "#editdata" ).serialize();
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				loadResourceData();
			}
			else{
				
			}
		} 
		});
	}	
	
	
}


function updateNoticeInfo()
{
	var emp_name = document.getElementById('emp_name');

	var notice_start_date = document.getElementById('notice_start_date');
	var notice_end_date = document.getElementById('notice_end_date');
	var notice_period = document.getElementById('notice_period');
		
	if(notice_start_date.value == "")
	{
		alert("Please select start date...");
		return false;
	}
	if(notice_period.value == 0)
	{
		alert("Please select Notice Period...");
		return false;
	}
		
	if(confirm("Are you sure want to update Notice Info of \""+emp_name.value+"\"?"))
	{
		var dataString = "act=updateNoticeInfo&";
		dataString +=$( "#editdata" ).serialize();
		//alert(dataString);
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				loadResourceData();
			}
			else{
				
			}
		} 
		});
	}	
	
	
}


</script>

<style>

</style>