<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/ITAdminMgmt.php';
	$dbobj = new ITAdminMgmt();
	$dbobj->connect();
	
	$deviceType_array = $dbobj->getAllDeviceType();
	$today = date("d-m-Y");	
	$param = $_REQUEST['param'];
	
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
					<li>Enroll New IT Device</li>
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
									<h4> Add New Device </h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="newdata" id="newdata" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-6">
																						
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Select Device Type :</span>
											<select id="device" name="device" class="form-control" onchange="loadDiv();" >
											<option value="0">Select Device Type</option>
											<?php
											foreach($deviceType_array as $val)
											{
											echo '<option value="'.$val->id.'">'.$val->name.'</option>';
											}			
											?>		
											</select>
											</div>
										</div>
										
										
										<div class="clearfix"></div>
									</div>
									<!--end_total_employee_div-->
												
									<div id="div_laptop" style="display:none">			
									<?php include_once 'itadmin_newlaptop.php'; ?>
									</div>
									
												
									
									
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	<input type="hidden" name="hdevice" id="hdevice"  value="">
							<input type="hidden" name="htagid" id="htagid"  value="">
							<input type="hidden" name="hparam" id="hparam"  value="<?php echo $param;?>">
					
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
	
		var hparam = document.getElementById('hparam').value;
		//alert(hparam);
		if(hparam)
		{	
			for(i=0;i<document.getElementById("device").length;i++)
			{
				if(document.getElementById("device").options[i].value==hparam)
				{
					document.getElementById("device").options[i].selected=true;
					break;
				}
			}
			loadDiv();
		}
		
};
	
	

function loadDiv()
{
	//alert("1111");	
	var device = document.getElementById('device').value;
	var div_laptop = document.getElementById('div_laptop');
	var div_add = document.getElementById('div_add');
	var hdevice = document.getElementById('hdevice');
	//alert(device);
	div_laptop.style.display = 'none';
	div_add.style.display = 'none';
	if(device == 1)
	{
		div_laptop.style.display = 'block';	
		div_add.style.display = 'block';
		hdevice.value = 1;
	}
	else{
		
		hdevice.value = 0;
	}
	
	
}

function checkTagId()
{
	//var hostename = "ITLP"+tag_add;
	var hostename="";	
	var tag_add = document.getElementById('tagid').value;
	tag_add = "IT/LP/"+tag_add;
	document.getElementById('htagid').value = tag_add;
	hostename = tag_add.replaceAll("/", "");
	//alert(hostename);
	document.getElementById('hostname').value = hostename;
	
}


function checkForLaptopDevice()
{
	var tagid = document.getElementById('tagid').value;
	var manifacture = document.getElementById('manifacture').value;
	var model = document.getElementById('model').value;
	var serialno = document.getElementById('serialno').value;
	var dop = document.getElementById('dop').value;
	var doe = document.getElementById('doe').value;
	var processor = document.getElementById('processor').value;
	var hdd = document.getElementById('hdd').value;
	var ramsize = document.getElementById('ramsize').value;
	var ostype = document.getElementById('ostype').value;
	var osname = document.getElementById('osname').value;
	
	if(tagid == "")
	{
		alert("Please add Laptop Tagid");
		return false;	
	}
	
	if(manifacture == 0)
	{
		alert("Please select manifacture option");
		return false;
	}
	if(model == "")
	{
		alert("Please add model");
		return false;
	}
	if(serialno == "")
	{
		alert("Please add serialno");
		return false;
	}
	if(dop == "")
	{
		alert("Please add Date of Purchase");
		return false;
	}

	if(processor == 0)
	{
		alert("Please select processor type");
		return false;
	}
	if(hdd == 0)
	{
		alert("Please select HDD Drive type");
		return false;
	}
	if(ramsize == 0)
	{
		alert("Please select RAM Size type");
		return false;
	}
	if(ostype == 0)
	{
		alert("Please select OS Type");
		return false;
	}
	if(osname == "")
	{
		alert("Please add OS Name");
		return false;
	}
	
	
	return true;
}

function addLaptopDevice()
{
	if(!checkForLaptopDevice())
		return false;
	
	
	var dataString = "action=addLaptopDevice&";
	dataString +=$( "#newdata" ).serialize();
	//alert(dataString);
	$.ajax({ 
	type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		alert(dobj.msg);
		if(dobj.status==1)
		{
			refreshPage();
		}
		else{
			
		}
	} 
	});
	
	
}


function refreshPage()
{
	var device = document.getElementById('device').value;
	var hparam = document.getElementById('hparam').value;
	if(hparam)
		window.location.reload();	
	else	
		window.location.search += 'param='+device;
}


</script>