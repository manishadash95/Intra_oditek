<?php 
	ini_set("display_errors",0);
	error_reporting(E_ALL);
	include 'include/init.php';
	include_once 'dbcon/ITAdminMgmt.php';
	$dbobj = new ITAdminMgmt();
	$dbobj->connect();
	
	$deviceType_array = $dbobj->getAllDeviceType();
	$today = date("d-m-Y");	
	$iv = $_REQUEST['iv'];
	$id = $_REQUEST['id'];
	$device = $_REQUEST['device'];
	$type = $_REQUEST['type'];
	
	
	$id_input = trim($dbobj->get_mcrypt_decrypt($id,$iv));
	$device_input = $eid = trim($dbobj->get_mcrypt_decrypt($device,$iv));
	$type_input = $eid = trim($dbobj->get_mcrypt_decrypt($type,$iv));
	//echo "ID::".$id_input."::".$device_input."::".$type_input;
	//exit();
	$device_view_page = "viewmyprofile.php?device=".$device."&iv=".$iv;
	
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
					<li>View Allocate Device</li>
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
									<h4> Allocate Device </h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
							<div class="col-lg-12" id="div_add"  style="display:none" >
                           <div class="bpaddingdiv1 text-center">
                          <!-- <input type="button" name="register1" id="register1" class="btn btn-green btn-md" value="Update" onClick="updateLaptopDevice();"> -->

                          </div>
                          </div>
						  
						  

					<form name="newdata" id="newdata" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
								
								<a href="<?php echo $device_view_page;?>" >
								<input type="button" class="btn btn-md btn-red " value="Back" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
								</a>
									
									<!--total_employee_div-->
									<div class="totalaligndiv">
										<!--1st_div-->
																
										
										<div class="clearfix"></div>
									</div>
									<!--end_total_employee_div-->
												
									<div id="div_laptop" style="display:none">			
									<?php include_once 'itadmin_editlaptop.php'; ?>
									</div>
									<div id="div_desktop" style="display:none">			
									<?php include_once 'itadmin_editdesktop.php'; ?>
									</div>
									<div id="div_mobile" style="display:none">			
									<?php include_once 'itadmin_editmobile.php'; ?>
									</div>			
									<div id="div_other" style="display:none">			
									<?php include_once 'itadmin_editother.php'; ?>
									</div>
									
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	<input type="hidden" name="hdevice" id="hdevice"  value="<?php echo $device_input;?>">
							<input type="hidden" name="hdbid" id="hdbid"  value="<?php echo $id_input;?>" >
							<input type="hidden" name="htype" id="htype"  value="<?php echo $type_input;?>">
					
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
    var htype = document.getElementById('htype').value;
    var div_laptop = document.getElementById('div_laptop');
    var div_desktop = document.getElementById('div_desktop');
    var div_mobile = document.getElementById('div_mobile');
	var div_other = document.getElementById('div_other');
    var div_add = document.getElementById('div_add');

    if (htype == 1) {
        div_laptop.style.display = 'block';    
        div_add.style.display = 'block';
        loadDeviceDetails();
    } else if (htype == 2) {
       div_desktop.style.display = 'block';
        div_add.style.display = 'block';
        loadDeviceDetailsDesktop();
    }else if (htype == 3) {
       div_mobile.style.display = 'block';
        div_add.style.display = 'block';
        loadMobileDetails();
    }else if (htype == 4) {
       div_other.style.display = 'block';
        div_add.style.display = 'block';
        loadOtherDetails();
    }
};

function loadDeviceDetails() {
    var hdbid = document.getElementById('hdbid').value;

    // Laptop
    var tagid = document.getElementById('tagid');
    var hostname = document.getElementById('hostname');
    var manifacture = document.getElementById('manifacture');
    var model = document.getElementById('model');
    var serialno = document.getElementById('serialno');
    var expressno = document.getElementById('expressno');
    var dop = document.getElementById('dop');
    var doe = document.getElementById('doe');
    var processor = document.getElementById('processor');
    var hdd = document.getElementById('hdd');
    var ramsize = document.getElementById('ramsize');
    var ostype = document.getElementById('ostype');
    var osname = document.getElementById('osname');

    var dataString = "action=getDeviceDetails&dbid=" + hdbid;
    // alert(dataString);
    $.ajax({
        type: "POST",
        url: "ajaxITAdmin.php",
        data: dataString,
        cache: false,
        success: function(html) {
            var dobj = jQuery.parseJSON(html);
            // alert(dobj.msg);
            // alert("Hname:"+dobj.hostname);
            if (dobj.status == 1) {
                if (dobj.type == 1) {
                    tagid.value = dobj.tid;
                    hostname.value = dobj.hostname;
                    model.value = dobj.model;
                    serialno.value = dobj.serial;
                    expressno.value = dobj.express;
                    dop.value = dobj.dop;
                    doe.value = dobj.dow;
                    osname.value = dobj.osname

                    for (i = 0; i < document.getElementById("manifacture").length; i++) {
                        if (document.getElementById("manifacture").options[i].value == dobj.manifacture) {
                            document.getElementById("manifacture").options[i].selected = true;
                            break;
                        }
                    }

                    for (i = 0; i < document.getElementById("processor").length; i++) {
                        if (document.getElementById("processor").options[i].value == dobj.processor) {
                            document.getElementById("processor").options[i].selected = true;
                            break;
                        }
                    }

                    for (i = 0; i < document.getElementById("hdd").length; i++) {
                        if (document.getElementById("hdd").options[i].value == dobj.hdd) {
                            document.getElementById("hdd").options[i].selected = true;
                            break;
                        }
                    }

                    for (i = 0; i < document.getElementById("ramsize").length; i++) {
                        if (document.getElementById("ramsize").options[i].value == dobj.ram) {
                            document.getElementById("ramsize").options[i].selected = true;
                            break;
                        }
                    }

                    for (i = 0; i < document.getElementById("ostype").length; i++) {
                        if (document.getElementById("ostype").options[i].value == dobj.ostype) {
                            document.getElementById("ostype").options[i].selected = true;
                            break;
                        }
                    }

                    // Set all input fields to read-only
                    var inputs = document.getElementsByTagName('input');
                    for (var i = 0; i < inputs.length; i++) {
                        inputs[i].readOnly = true;
                    }
                    // Set all select fields to read-only
                    var selects = document.getElementsByTagName('select');
                    for (var i = 0; i < selects.length; i++) {
                        selects[i].disabled = true;
                    }
                }
            } else {

            }
        }
    });

}

function loadDeviceDetailsDesktop()
{
	var hdbid = document.getElementById('hdbid').value;
	
	//desktop
	var dtagid = document.getElementById('dtagid');
	var dhostname = document.getElementById('dhostname');
	var dmanifacture = document.getElementById('dmanifacture');
	var dmodel = document.getElementById('dmodel');
	var dserialno = document.getElementById('dserialno');
	var dexpressno = document.getElementById('dexpressno');
	var ddop = document.getElementById('ddop');
	var ddoe = document.getElementById('ddoe');
	var dprocessor = document.getElementById('dprocessor');
	var dhdd = document.getElementById('dhdd');
	var dramsize = document.getElementById('dramsize');
	var dostype = document.getElementById('dostype');
	var dosname = document.getElementById('dosname');
	
	
	
	var dataString = "action=getDeviceDetails&dbid="+hdbid;
	//alert(dataString);
	$.ajax({ 
	type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		//alert(dobj.msg);
		//alert("Hname:"+dobj.hostname);
		if(dobj.status==1)
		{
			if(dobj.type==2)
			{
				dtagid.value = dobj.tid;
				dhostname.value = dobj.hostname;
				dmodel.value = dobj.model;
				dserialno.value = dobj.serial;
				dexpressno.value = dobj.express;
				ddop.value = dobj.dop;
				ddoe.value = dobj.dow;
			    dosname.value = dobj.osname
				
				for(i=0;i<document.getElementById("dmanifacture").length;i++){
				if(document.getElementById("dmanifacture").options[i].value==dobj.manifacture){
					document.getElementById("dmanifacture").options[i].selected=true;
					break;
				}}
				
				for(i=0;i<document.getElementById("dprocessor").length;i++){
				if(document.getElementById("dprocessor").options[i].value==dobj.processor){
					document.getElementById("dprocessor").options[i].selected=true;
					break;
				}}
				
				for(i=0;i<document.getElementById("dhdd").length;i++){
				if(document.getElementById("dhdd").options[i].value==dobj.hdd){
					document.getElementById("dhdd").options[i].selected=true;
					break;
				}}
				
				for(i=0;i<document.getElementById("dramsize").length;i++){
				if(document.getElementById("dramsize").options[i].value==dobj.ram){
					document.getElementById("dramsize").options[i].selected=true;
					break;
				}}
				
				for(i=0;i<document.getElementById("dostype").length;i++){
				if(document.getElementById("dostype").options[i].value==dobj.ostype){
					document.getElementById("dostype").options[i].selected=true;
					break;
				}}


                     var inputs = document.getElementsByTagName('input');
                    for (var i = 0; i < inputs.length; i++) {
                        inputs[i].readOnly = true;
                    }
                    // Set all select fields to read-only
                    var selects = document.getElementsByTagName('select');
                    for (var i = 0; i < selects.length; i++) {
                        selects[i].disabled = true;
                    }


			}		
			
		}
		else{
			
		}
	} 
	});
	
}		
function loadMobileDetails()
{
	var hdbid = document.getElementById('hdbid').value;
	
	//mobile
	var ctagid = document.getElementById('ctagid');
	var chostname = document.getElementById('chostname');
	var cmanifacture = document.getElementById('cmanifacture');
	var cmodel = document.getElementById('cmodel');
	var cdop = document.getElementById('cdop');
	var cprocessor = document.getElementById('cprocessor');
	var storage = document.getElementById('storage');
	var cramsize = document.getElementById('cramsize');
	
	
	var dataString = "action=getDeviceDetails&dbid="+hdbid;
	//alert(dataString);
	$.ajax({ 
	type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		//alert(dobj.msg);
		//alert("Hname:"+dobj.hostname);
		if(dobj.status==1)
		{
			if(dobj.type==3)
			{
				ctagid.value = dobj.tid;
				chostname.value = dobj.hostname;
				cmodel.value = dobj.model;
				cdop.value = dobj.dop;
			   				
				for(i=0;i<document.getElementById("cmanifacture").length;i++){
				if(document.getElementById("cmanifacture").options[i].value==dobj.manifacture){
					document.getElementById("cmanifacture").options[i].selected=true;
					break;
				}}
				
				for(i=0;i<document.getElementById("cprocessor").length;i++){
				if(document.getElementById("cprocessor").options[i].value==dobj.processor){
					document.getElementById("cprocessor").options[i].selected=true;
					break;
				}}
				
				for(i=0;i<document.getElementById("storage").length;i++){
				if(document.getElementById("storage").options[i].value==dobj.storage){
					document.getElementById("storage").options[i].selected=true;
					break;
				}}
				
				for(i=0;i<document.getElementById("cramsize").length;i++){
				if(document.getElementById("cramsize").options[i].value==dobj.ram){
					document.getElementById("cramsize").options[i].selected=true;
					break;
				}}
				
				    var inputs = document.getElementsByTagName('input');
                    for (var i = 0; i < inputs.length; i++) {
                        inputs[i].readOnly = true;
                    }
                    // Set all select fields to read-only
                    var selects = document.getElementsByTagName('select');
                    for (var i = 0; i < selects.length; i++) {
                        selects[i].disabled = true;
                    }

			}		
			
		}
		else{
			
		}
	} 
	});
	
}

function loadOtherDetails()
{
	var hdbid = document.getElementById('hdbid').value;
	
	//other
	var ftagid = document.getElementById('ftagid');
	var fhostname = document.getElementById('fhostname');
	var fmanifacture = document.getElementById('fmanifacture');
	var fmodel = document.getElementById('fmodel');
	var fdop = document.getElementById('fdop');
	var fstorage = document.getElementById('fstorage');
	
	
	var dataString = "action=getDeviceDetails&dbid="+hdbid;
	//alert(dataString);
	$.ajax({ 
	type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		//alert(dobj.msg);
		//alert("Hname:"+dobj.hostname);
		if(dobj.status==1)
		{
			if(dobj.type==4)
			{
				ftagid.value = dobj.tid;
				fhostname.value = dobj.hostname;
				fmodel.value = dobj.model;
				fdop.value = dobj.dop;
			   				
				for(i=0;i<document.getElementById("fmanifacture").length;i++){
				if(document.getElementById("fmanifacture").options[i].value==dobj.manifacture){
					document.getElementById("fmanifacture").options[i].selected=true;
					break;
				}}
				
				
				for(i=0;i<document.getElementById("fstorage").length;i++){
				if(document.getElementById("fstorage").options[i].value==dobj.storage){
					document.getElementById("fstorage").options[i].selected=true;
					break;
				}}
				    var inputs = document.getElementsByTagName('input');
                    for (var i = 0; i < inputs.length; i++) {
                        inputs[i].readOnly = true;
                    }
                    // Set all select fields to read-only
                    var selects = document.getElementsByTagName('select');
                    for (var i = 0; i < selects.length; i++) {
                        selects[i].disabled = true;
                    }
			}		
			
		}
		else{
			
		}
	} 
	});
	
}


function loadDiv() {
    var device = document.getElementById('device').value;
    var div_laptop = document.getElementById('div_laptop');
    var div_desktop = document.getElementById('div_desktop');
	var div_mobile = document.getElementById('div_mobile');
	var div_other = document.getElementById('div_other');
    var div_add = document.getElementById('div_add');
    var hdevice = document.getElementById('hdevice');

    div_laptop.style.display = 'none';
    div_desktop.style.display = 'none';
	div_mobile.style.display = 'none';
	div_other.style.display = 'none';
    div_add.style.display = 'none';

    if (device == 1) {
        div_laptop.style.display = 'block';    
        div_add.style.display = 'block';
        hdevice.value = 1;
		
    } else if (device == 2) {  
        div_desktop.style.display = 'block';
        div_add.style.display = 'block';
        hdevice.value = 2;
		
    } else if (device == 3) {  
        div_mobile.style.display = 'block';
        div_add.style.display = 'block';
        hdevice.value = 3;
		
    } else if (device == 4) {  
        div_other.style.display = 'block';
        div_add.style.display = 'block';
        hdevice.value = 4;
    } 
	else {
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








</script>