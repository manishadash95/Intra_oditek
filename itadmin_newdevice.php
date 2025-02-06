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
					<li>Add New IT Device</li>
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
									
									<div id="div_desktop" style="display:none">			
										<?php include_once 'itadmin_newdesktop.php'; ?>
									</div>
									<div id="div_mobile" style="display:none">			
										<?php include_once 'itadmin_newmobile.php'; ?>
									</div>
									<div id="div_other" style="display:none">			
										<?php include_once 'itadmin_other.php'; ?>
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
	var div_desktop = document.getElementById('div_desktop');
	var div_mobile = document.getElementById('div_mobile');
	var div_other = document.getElementById('div_other');
	var hdevice = document.getElementById('hdevice');
	//alert(device);
	div_laptop.style.display = 'none';
	div_desktop.style.display = 'none';
	div_mobile.style.display = 'none';
	div_other.style.display = 'none';
	
	if(device == 1)
	{
		
		div_laptop.style.display = 'block';	
		hdevice.value = 1;
	}
	else if(device == 2)
	{
		div_desktop.style.display = 'block';
		hdevice.value = 2;
	}
	else if(device == 3)
	{
		div_mobile.style.display = 'block';
		hdevice.value = 3;
	}
	else if(device == 4)
	{
		div_other.style.display = 'block';
		hdevice.value = 4;
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

function checkTagIdDesktop()
{
    //alert("aaa");
	var hostename="";	
	var tag_add = document.getElementById('dtagid').value;
	tag_add = "IT/DT/"+tag_add;
	//alert("bbb:"+tag_add);
	document.getElementById('htagid').value = tag_add;
	hostename = tag_add.replaceAll("/", "");
	//alert(hostename);
	document.getElementById('dhostname').value = hostename;
	//alert("ccc:"+hostename);
	
}
function checkTagIdMobile()
{
	//alert("hii");
	var hostename="";	
	var tag_add = document.getElementById('ctagid').value;
	tag_add = "IT/MD/"+tag_add;
	//alert("ccc:"+tag_add);
	document.getElementById('htagid').value = tag_add;
	hostename = tag_add.replaceAll("/", "");
	document.getElementById('chostname').value = hostename;
	//alert("eee:"+hostename);
	
}

function checkTagIdOther()
{
	//alert("hii");
	var hostename="";	
	var tag_add = document.getElementById('ftagid').value;
	tag_add = "IT/OD/"+tag_add;
	//alert("ccc:"+tag_add);
	document.getElementById('htagid').value = tag_add;
	hostename = tag_add.replaceAll("/", "");
	document.getElementById('fhostname').value = hostename;
	//alert("eee:"+hostename);
	
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
		alert("Please select Manufacture option");
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


function checkForDesktopDevice()
{
	var dtagid = document.getElementById('dtagid').value;
	var dmanifacture = document.getElementById('dmanifacture').value;
	var dmodel = document.getElementById('dmodel').value;
	var dserialno = document.getElementById('dserialno').value;
	var ddop = document.getElementById('ddop').value;
	var ddoe = document.getElementById('ddoe').value;
	var dprocessor = document.getElementById('dprocessor').value;
	var dhdd = document.getElementById('dhdd').value;
	var dramsize = document.getElementById('dramsize').value;
	var dostype = document.getElementById('dostype').value;
	var dosname = document.getElementById('dosname').value;
	
	if(dtagid == "")
	{
		alert("Please add Desktop Tagid");
		return false;	
	}
	
	if(dmanifacture == 0)
	{
		alert("Please select Manufacture option");
		return false;
	}
	if(dmodel == "")
	{
		alert("Please add model");
		return false;
	}
	if(dserialno == "")
	{
		alert("Please add serialno");
		return false;
	}
	if(ddop == "")
	{
		alert("Please add Date of Purchase");
		return false;
	}

	if(dprocessor == 0)
	{
		alert("Please select processor type");
		return false;
	}
	if(dhdd == 0)
	{
		alert("Please select HDD Drive type");
		return false;
	}
	if(dramsize == 0)
	{
		alert("Please select RAM Size type");
		return false;
	}
	if(dostype == 0)
	{
		alert("Please select OS Type");
		return false;
	}
	if(dosname == "")
	{
		alert("Please add OS Name");
		return false;
	}
	
	
	return true;
}

function checkForMobileDevice() {
	
    var ctagid = document.getElementById('ctagid').value;
    var cmanifacture = document.getElementById('cmanifacture').value;
    var cmodel = document.getElementById('cmodel').value;
    var cdop = document.getElementById('cdop').value;
    var cprocessor = document.getElementById('cprocessor').value;
    var storage = document.getElementById('storage').value;
    var cramsize = document.getElementById('cramsize').value;
    

    if (ctagid == "") {
        alert("Please add Mobile Tagid");
        return false;
    }

    if (cmanifacture == 0) {
        alert("Please select Manufacture option");
        return false;
    }
    if (cmodel == "") {
        alert("Please add model");
        return false;
    }
    
    if (cdop == "") {
        alert("Please add Date of Purchase");
        return false;
    }

    if (cprocessor == 0) {
        alert("Please select processor type");
        return false;
    }
    if (storage == 0) {
        alert("Please select Storage Capacity");
        return false;
    }
    if (cramsize == 0) {
        alert("Please select RAM Size type");
        return false;
    }
    
    return true;
}

function checkForOtherDevice() {
	
    var ftagid = document.getElementById('ftagid').value;
    var fmanifacture = document.getElementById('fmanifacture').value;
    var fmodel = document.getElementById('fmodel').value;
    var fdop = document.getElementById('fdop').value;
    var fstorage = document.getElementById('fstorage').value;
   
    if (ftagid == "") {
        alert("Please add Other Tagid");
        return false;
    }

    if (fmanifacture == 0) {
        alert("Please select Manufacture option");
        return false;
    }
    if (fmodel == "") {
        alert("Please add model");
        return false;
    }
    
    if (fdop == "") {
        alert("Please add Date of Purchase");
        return false;
    }

    if (fstorage == 0) {
        alert("Please select Storage Capacity");
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


function addDesktopDevice()
{
	if(!checkForDesktopDevice())
		return false;
	
	
	var dataString = "action=addDesktopDevice&";
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

function addMobileDevice()
{
	if(!checkForMobileDevice())
		return false;
	
	
	var dataString = "action=addMobileDevice&";
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
function addOtherDevice()
{
	if(!checkForOtherDevice())
		return false;
	
	
	var dataString = "action=addOtherDevice&";
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