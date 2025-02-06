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
	
	

	$card_image = $dbobj->getICardImage($eid);
	
	
	$isMGMT = $dbobj->isManagement($eid);
	
	$show = false;
	if($isMGMT)
		$show = true;
	
	$isHR = $dbobj->isHRAdmin($eid);
	if($isHR)
		$show = true;
		
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
						<li class="active">Uplaod Image for I-Card</li>
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
									<h4>My I-Card Details </h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					 <form name="editfrmmess" id="editfrmmess" method="post">
						<div id="SHOWDATA">
						
						
					
					
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
									
									<div class="col-lg-12">
					<div class="bpaddingdiv1 text-center">
					<a href="viewicardimages.php" >
					<input type="button" class="btn btn-md btn-red " value="View Images" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
					</a>
					
					</div>
					</div>
					
					
										<!--1st_div-->
										<div class="col-md-4">
										
										
										<input type="file" id="file-upload" />
										
										<div class="bpaddingdiv1 text-center">
										<?php if(strlen($card_image) > 0 ) {  $img_path = $card_image; ?>
										<img src="<?php echo $img_path; ?>" id="bigimage1" name="Employee Photo" border="0" width="220" height="220" style="border:#666 1px solid">
										<?php }else{ if($employee->gender_id == 1){?>			
										<img src="img/male.jpg" id="bigimage1" name="Employee Photo" border="0" width="220" height="220" style="border:#666 1px solid">
										<?php }else{ ?>
										<img src="img/female.jpg" id="bigimage1" name="Employee Photo" border="0" width="220" height="220" style="border:#666 1px solid">

										<?php }} ?>										
	                     				</div>
										<div class="clearfix"></div>
										<div class="bpaddingdiv1 text-center">
										<label for="file-upload" style="cursor:pointer;" >
										<img src="img/upload.png" width="40" height="40" alt="" style="cursor:pointer;" />
										</label>
										</div>
										<input type="hidden" id="hdfilename" name="hdfilename" value="">
										<input type="hidden" id="hdfileupload" name="hdfileupload" value="0">
										
											
																			
										
										</div>
										
										<div class="col-md-8">
										<div class="input-group bmargindiv1 col-md-8">
										<span class="input-group-addon ndrftextwidth text-right" style="width:200px;" >Name :</span>
										<input disabled type="text" class="form-control" value="<?php echo $employee->name;?>" style="width:300px;" >
										</div>
										
										<div class="input-group bmargindiv1 col-md-8">
										<span class="input-group-addon ndrftextwidth text-right" style="width:200px;">Employee Id :</span>
										<input disabled type="text" class="form-control" value="<?php echo $employee->eid;?>" style="width:300px;" >
										</div>
										
										<div class="input-group bmargindiv1 col-md-8">
										<span class="input-group-addon ndrftextwidth text-right" style="width:200px;">Blood Group :</span>
										<input disabled type="text" class="form-control" value="<?php echo $employee->blood_grp;?>" style="width:300px;" >
										</div>
										
										<div class="input-group bmargindiv1 col-md-8">
										<span class="input-group-addon ndrftextwidth text-right" style="width:200px;">Emergency Contact No. :</span>
										<input disabled type="text" class="form-control" value="<?php echo $employee->emergency;?>" style="width:300px;" >
										</div>
										
										
										
																				
										
										</div>
										
										
										
										<div class="col-lg-12">
										
										
										
										<div class="bpaddingdiv1 text-center" style="padding-top:20px;">
										<span class="input-group-addon ndrftextwidth text-left" >
										<B>NOTE:</B><BR><BR>1. Image should be straight and white/light color background. <BR><BR>2. Image size should not mora than 3 MB and less than 256 KB.<BR><BR>3. If above information is incorrect, please contact HR or update in your profile section before uploading image. 
										</span>
										<button style="margin-top:20px;" type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndAddData();" id="btnsubmit">Update</button> 
										</div>
										<div class="clearfix"></div>	
										</div>
																		
											
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
					<?php if($show){?>
					
					<?php } ?>
		</div>
		

	</div>
	<!-- /.page-content -->

</div>
<?php include 'include/footer.php' ?>
<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee.js"></script>

<script>



var input = document.getElementById( 'file-upload' );
	input.addEventListener( 'change', showFileName);
	function showFileName( event ) 
	{
		if (this.files.length != 0)
		{
			var tgtImg = document.getElementById('bigimage1');
			var curFile = this.files[0];
			var input = event.srcElement;
			var fileName = input.files[0].name;
			var fsize = Math.round(input.files[0].size / 1024);
			var allowedExtensions = 
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i;
			if (!allowedExtensions.exec(fileName)) 
			{
				alert("Invalid Image file. Please select a valid JPG or PNG file only.");
				return;
			}
		    if(fsize > (3 * 1024))
			{
				alert("Image size should not more than 2 MB.");
				return;
			}
			if(fsize < 256)
			{
				alert("Image size should not less than 256 KB.");
				return;
			}			
			document.getElementById('hdfilename').value = fileName;
			document.getElementById('hdfileupload').value = 1;
			loadImgFromFile(curFile, tgtImg);
		}
	}

	function loadImgFromFile(fileVar, imgElem)
	{
		var fileReader = new FileReader();
		fileReader.onload = onFileLoaded;
		fileReader.readAsBinaryString(fileVar);
		function onFileLoaded(fileLoadedEvent)
		{
			var result,data;
			data = fileLoadedEvent.target.result;
			result = "data:";
			result += fileVar.type;
			result += ";base64,";
			result += btoa(data);
			imgElem.src = result;
			imgElem.origType = fileVar.type;    // unnecessary for loading the image, used by a current project.
		}
	}


	function checkAndAddData()
	{
			
		var imageAdd = document.getElementById('hdfileupload').value;
		document.getElementById('loading_data').style.display="block";
		if(imageAdd == "1" )
		{	
			var filedata = document.getElementById( 'file-upload');
			var form_data = new FormData(); 
			var file = filedata.files[0];
			if (form_data) {
					form_data.append("imagefile", file);
				}
		}
		else{
			alert("Add Image first...");
			document.getElementById('loading_data').style.display="none";
			return;
		}
		var dataString = "action=updateICARDImage&";
		dataString +=$( "#frmemployee" ).serialize();
		//alert("dataString:"+dataString);
		document.getElementById('btnsubmit').disabled = true;
		$.ajax({
				url: 'uploadICardImage.php', // point to server-side PHP script 
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
				success: function(html){
				var dobj=jQuery.parseJSON(html);
				//alert("2222222");
				var status1 = dobj.msg;
				if(dobj.status==1)
					updateIcardImage(dobj.filename);
					document.getElementById('loading_data').style.display="none";
					alert(status1);
					location.reload();
				},
				xhr: function(){
					var xhr = new XMLHttpRequest();
					xhr.upload.addEventListener('progress', function(e){
					if(e.lengthComputable){
						//var uploadPercent = e.loaded / e.total;
						//uploadPercent = (uploadPercent * 100);
						//uploadPercent = parseFloat(uploadPercent).toFixed(2);
						//document.getElementById('istatus').innerHTML= "Please wait... Files uploading ["+uploadPercent+"%]"; 
						//document.getElementById('loading_data').style.display="block";
									
						}
					}, false);
						return xhr;
					}
							
							
			});
						
		
		
		
					
	}
	
	
	
function updateIcardImage(filename)
{
	var dataString = "action=updateICardImage&filename="+filename;
	$.ajax({ 
		type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
		success: function(html)
		{
			
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

