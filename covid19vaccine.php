<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	ini_set("display_errors",0);
	$eid = $_SESSION["emp_id"];

	//$_SESSION["pageid"]= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
	
	//$eid = 160701;
	$employee = $dbobj->getEmployeeData($eid);
	//echo $eid;
	//exit();
	//$employee->type=1;
	
	//$rankobj = $dbobj->getRank();
	$allname_array = $dbobj->getAllName();
	$designation_array = $dbobj->getDesignation();
	$department_array = $dbobj->getDepartment();

	$vaccineInfo = $dbobj->getVaccineInfo($eid);
	
	$show = true;
	
	$isMGMT = $dbobj->isManagement($eid);
		
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
						<li class="active">My Covid-19 Vaccine</li>
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4>My Covid-19 Vaccine </h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					 <form name="editfrmmess" id="editfrmmess" method="post">
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12" id="divtptcity">
										<span class="input-group-addon ndrftextwidth text-right"> Vaccine Name :</span>
										<?php if(!$vaccineInfo->status){?>
										<select id="vac_type" name="vac_type" class="form-control" >
											<option value="">Select Vaccine</option>
											<option value="Covaxin">Covaxin</option>
											<option value="Covishield">Covishield</option>
										</select>
										<?php }else{ ?>
										<input disabled type="text" id="vac_type" name="vac_type" class="form-control"  value="<?php echo $vaccineInfo->vaccine;?>">
										<?php } ?>
										
										</div>
										</div>
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">Date of 1st dose :</span>
										<?php if(strlen($vaccineInfo->dose1) > 0){?>
										<input disabled type="text" name="vac_dose1" id="vac_dose1" class="form-control" value="<?php echo $vaccineInfo->dose1;?>">
										<?php }else{ ?>
										<input type="text" name="vac_dose1" id="vac_dose1" class="form-control tcal" placeholder="Date of 1st dose" value="">
										<?php } ?>
										</div>
										</div>
										
										<div class="col-md-4">
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-right">Date of 2nd dose :</span>
										<?php if(strlen($vaccineInfo->dose2) > 0)
										{
											$show = false;
										?>
										<input disabled type="text" name="vac_dose2" id="vac_dose2" class="form-control" value="<?php echo $vaccineInfo->dose2;?>">
										<?php }else{ ?>
										<input type="text" name="vac_dose2" id="vac_dose2" class="form-control tcal" placeholder="Date of 2nd dose" value="">
										<?php } ?>
										</div>
										</div>										
											
										<?php if($show){?>
										<div class="col-lg-12">
										<div class="bpaddingdiv1 text-center" style="padding-top:20px;">
										<button type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndAddData();" id="btnsubmit">Update</button> 
										</div>
										<div class="clearfix"></div>	
										</div>
										<?php } ?>										
											
										</div>
										
									<div class="clearfix"></div>
									
									
									
									
									
									
									
									
								</div>	
									<div class="clearfix"></div>
								</div>
							</div>
					                  	<input type="hidden" name="hdloan" id="hdloan"  value="">
							<input type="hidden" name="update" id="update"  value="1">
							</form>
						</div>
					</div>	
								<!-- /.col-lg-12 -->
					<?php if($isMGMT){?>
					<div class="col-lg-12">
					<div class="bpaddingdiv1 text-center">
					<input type="button" name="covid" id="covid" class="btn btn-red btn" value="Report" onClick="generateEmployeeCovidReport()" >
					</div>
					</div>
					<?php } ?>
		</div>
		

	</div>
	<!-- /.page-content -->

</div>
<?php include 'include/footer.php' ?>
<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee.js"></script>

<script>


function updateImage(){
 var obj=document.getElementById('btnupload');
 if(obj.files && obj.files[0]){
 	var reader = new FileReader();
	reader.onload = function (e) {		            	
		$('#bigimage1').attr('src', e.target.result);
	}
	reader.readAsDataURL(obj.files[0]);
 }

}


function masterValidation()
{
	var obj=document.getElementById('date_of_birth').value;
	if(obj == ""){
		alert("Add date of birth...");
		return false;
	}
		
	obj=document.getElementById('mobile_no').value;
	if(obj == ""){
		alert("Add mobile no...");
		return false;
	}
	obj=document.getElementById('emergency_no').value;
	if(obj == ""){
		alert("Add emergency contact no...");
		return false;
	}
	
	obj=document.getElementById('email1').value;
	if(obj == ""){
		alert("Add email id...");
		return false;
	}
	
	var passwd1 = document.getElementById("password1").value;
	var passwd2 = document.getElementById("password2").value;
	if(passwd1.length > 0)
	{
		if(passwd1.length < 8)
		{
			alert("Password length should be 8");
			return false;
		}
		if(passwd1 !=  passwd2)
		{
			alert("Password mismatch");
			return false;
		}
	}
		
	return true;
	
}

$(window).load(function () {
//alert("aaaaa");
calcsalary();
});

messagestatus2(<?php echo $msg ?> );

function messagestatus2(steid_int)
{
	var steid = ""+steid_int;
	var a = parseInt(steid);
	switch(a)
	{
		case 1:
		{
			alert("Data Updated Successfully");
			document.location.href="viewmyprofile.php";
			break;
		}
		case 3:
		{
			alert("Session Expired. Please login again.");
			//document.location.href="viewmyprofile.php";
			break;
		}		
		case 0:
		{
			alert("Unable to Add, Try Again");
			break;
		}
	}
	
}

	function checkValidation()
	{
		var vac_type = document.getElementById('vac_type').value;
		var vac_dose1 = document.getElementById('vac_dose1').value;
		var vac_dose2 = document.getElementById('vac_dose2').value;
		
		if(vac_type == "" )
		{
			alert("Please select Vaccine Type...");
			return false;
		}
		
		if(vac_dose1 == "" )
		{
			alert("Please add first dose date");
			return false;
		}
				
		return true;
	}

	function checkAndAddData()
	{
		
		var ret = checkValidation();
		if(!ret)
			return false;
		
		var dataString = "action=updateCovidVaccine&";
		dataString +=$( "#editfrmmess" ).serialize();
		//alert("dataString:"+dataString);
		//document.getElementById('loading_data').style.display="block";
		//document.getElementById('btnsubmit').disabled = true;
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					var status = dobj.msg;
					alert(status);
					location.reload();
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
					
	}
	
	
	function generateEmployeeCovidReport()
	{
			var dataString = "action=generateEmployeeCovidReport";
			//alert("dataString:"+dataString);
		
			$.ajax({ 
				type: "POST",url: "ajaxphpexcel.php" ,data: dataString,cache: false,
				success: function(html)
				{	 
					var dobj=jQuery.parseJSON(html);
					if(dobj.status==1)
					{
						var dpath=dobj.file_name;
						var a = document.createElement("a");
						document.body.appendChild(a);
						a.href = dobj.file_path;
						a.download =dpath;
						a.target='_blank';
						a.click();
				
					}
					else{
						alert(dobj.msg);
					}
					//document.getElementById('loading_data').style.display="none";
				} 
			});
		
	}
	
</script>

