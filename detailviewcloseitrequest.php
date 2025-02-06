<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	ini_set("display_errors",0);
	//$session_rank = $_SESSION["admin_rank"];
	
	$readonly = "readonly";
	$disabled = "disabled";
		
	$eid = $_REQUEST['eid'];
	$iv = $_REQUEST['iv'];
	$eid = trim($dbobj->get_mcrypt_decrypt($eid,$iv));

	//$eid = 160701;
	$sid = $_REQUEST['sid'];
	$sid = trim($dbobj->get_mcrypt_decrypt($sid,$iv));
	$serviceObj = $dbobj->getITRequestDetails($sid);
	
	
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
						<li class="active">IT Support</li>
						
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		<a href="closeitrequest.php" >
			<input type="button" class="btn btn-md btn-red " value="Back" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
			</a>
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4 style="font-size: 14px"><B> [<?php echo $serviceObj->status_str;?>] <?php echo $serviceObj->sid_str;?> 
									</h4>
								</div>
							
								<div class="clearfix"></div>
							</div>
							
					<div class="portlet-body">
							
							
							
							
							<div class="col-md-12">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Title :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->title;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Created Date :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->date_created;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Priority :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->priority;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Created By :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->creator;?>" >
							</div>
							</div>
		
							
							</div>			
					
					<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
																	
									
									
									<?php $cout=0; foreach($serviceObj->dataArray as $data)
									{
										$cout++;
										$line_cnt = substr_count( trim($data->msg), "\n" );
										$line_cnt+=3;
										if($cout == 1)
											echo '<div class="col-md-12">';
										else 
											echo '<div class="col-md-12 toppadding">';										
									?>	
										
											<div class="input-group  col-md-12">
											<span class="input-group-addon ndrftextwidth text-left" style="border-left: 1px solid #CCCCCC;
											border-right: 1px solid #CCCCCC; font-size: 14px;" >
											<B><?php echo $data->status_log.' :: '.$data->emp_name?> on <?php echo $data->date_updated?> </B>
											</span>
											</div>
											<div class="input-group col-md-12">
											<textarea disabled  class="form-control text-left" maxlength="1000" rows="<?php echo $line_cnt;?>" style="margin: 0px -0.5px 0px 0px; height: auto;resize: none"><?php echo trim($data->msg); ?></textarea>
											
											</div>
											<?php if($data->attachment > 0){ ?>
											<div class="input-group  col-md-12">
											<span class="input-group-addon ndrftextwidth text-left" style="border-left: 1px solid #CCCCCC;
											border-right: 1px solid #CCCCCC;" >
											<img src="img/attach2.png" width="20" height="20" alt=""  />
											<?php if(strlen($data->file1) > 0){ ?>
											<span style="cursor:pointer;" onClick="downloadFile(<?php echo $sid.",".$data->dataid.",'".$data->file1."'"?> )" >
											<B><?php echo $data->file1; ?> </B>
											</span>
											<?php }	?>											
											
											
											<?php if(strlen($data->file2) > 0){ ?>
											<span style="cursor:pointer;" onClick="downloadFile(<?php echo $sid.",".$data->dataid.",'".$data->file2."'"?> )" >
											<B><?php echo $data->file2; ?> </B>
											</span>
											<?php }	?>
											
											
											<?php if(strlen($data->file3) > 0){ ?>
											<span style="cursor:pointer;" onClick="downloadFile(<?php echo $sid.",".$data->dataid.",'".$data->file3."'"?> )" >
											<B><?php echo $data->file3; ?> </B>
											</span>
											<?php }	?>
											
											</span>
											</div>
											
											<?php }	?>
											
									</div>
									
									<?php }	?>		
									
																	
										
										
										
										
										
										<!--end_1st_div-->
										<!--2nd_div-->
										
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									<!--end_total_employee_div-->
									<!--login_informations_div-->
									
									
									
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
<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee.js"></script>

<script>

var input = document.getElementById( 'file-upload' );
	input.addEventListener( 'change', showFileName );

	function showFileName( event ) 
	{
		// the change event gives us the input it occurred in 
		var input = event.srcElement;
	  
		// the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
		var index=0;
		while(true)
		{
			var fileName = input.files[index].name;
			var fsize = Math.round(input.files[index].size / 1024)+" KB";
			if(fileName=="")
				break;
			if(index==3)
			{
				alert("Maximum 3 files allow to attach...");
				break;
			}				
			var count = index+1;	
			var infoArea = document.getElementById( 'file'+count );
			var remove = document.getElementById( 'remove'+count );
			remove.style.display= "inline-block";
			infoArea.textContent = fileName +" [ "+fsize+" ] ";
			index++;
			document.getElementById('hfile'+count).value = fileName;
			document.getElementById('hfilecnt').value = index;
		}
		
	}

	function removeFile(id)
	{
		var infoArea = document.getElementById( 'file'+id );
		var remove = document.getElementById( 'remove'+id );
		var hfile = document.getElementById( 'hfile'+id );
		infoArea.textContent="";
		remove.style.display= "none";
		hfile.value = "";
		
		if(id==1)
		{
			var file2 = document.getElementById( 'file'+2 );
			var remove2 = document.getElementById( 'remove'+2 );
			var hfile2 = document.getElementById( 'hfile'+2 );
			
			var file3 = document.getElementById( 'file'+3 );
			var remove3 = document.getElementById( 'remove'+3 );
			var hfile3 = document.getElementById( 'hfile'+3 );
			
			if(file2.textContent.length > 1)
			{
				infoArea.textContent=file2.textContent;
				remove.style.display= "inline-block";
				hfile.value = hfile2.value;
				file2.textContent="";
				hfile2.value = "";
				remove2.style.display= "none";
			}
			if(file3.textContent.length > 1)
			{
				file2.textContent=file3.textContent;
				remove2.style.display= "inline-block";
				hfile2.value = hfile3.value;
				file3.textContent="";
				hfile3.value = "";
				remove3.style.display= "none";
			}
		}
		
		if(id==2)
		{
			var file3 = document.getElementById( 'file'+3 );
			var remove3 = document.getElementById( 'remove'+3 );
			var hfile3 = document.getElementById( 'hfile'+3 );
			
			if(file3.textContent.length > 1)
			{
				infoArea.textContent=file3.textContent;
				remove.style.display= "inline-block";
				hfile.value = hfile3.value;
				file3.textContent="";
				hfile3.value="";
				remove3.style.display= "none";
			}
		}
		var file_cnt = document.getElementById( 'hfilecnt').value;
		file_cnt--;
		document.getElementById( 'hfilecnt').value = file_cnt;
		
	}

$(window).load(function () {
//alert("aaaaa");
//calcsalary();
});


function checkValidation()
{
		alert("aaaaa");
		var desc = document.getElementById('text1').value;
		
		if(desc == "" )
		{
			alert("Please select Description...");
			return false;
		}
		
		
		return true;
}
	
function checkAndAddData()
{
		
		var ret = checkValidation();
		if(!ret)
			return false;
		
		var filedata = document.getElementById( 'file-upload');
		var len = document.getElementById( 'hfilecnt').value;
		var form_data = new FormData(); 
		var i = 0,file;		
		for (; i < len; i++) {
			file = filedata.files[i];
			var fsize = Math.round(file.size / 1024);
			if(fsize > 2048)
			{
				alert(file.name+" : File size should not more than 2 MB.");
				return;
			}
			if (form_data) {
				var index=i+1;
				//alert("Index:"+index);
				form_data.append("file"+index, file);
			}
		}
		
		alert("aaaaa");			
		var dataString = "action=updateITSupportTask&";
		dataString +=$( "#editfrmmess" ).serialize();
		//alert("dataString:"+dataString);
		//document.getElementById('loading_data').style.display="block";
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					var status = dobj.msg;
					if(len > 0)
					{
						form_data.append("sid", ""+dobj.sid);
						form_data.append("dataid", ""+dobj.dataid);
						//alert("form_data:"+form_data);
						$.ajax({
							url: 'uploadITFiles.php', // point to server-side PHP script 
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                         
							type: 'post',
							success: function(html){
								var dobj=jQuery.parseJSON(html);
								alert(status);
								resetSelection();
								location.reload();
							}
						});
					}
					else{
						alert(status);
						resetSelection();
						location.reload();
					}
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
					
	}
	

function resetSelection(){
		
	document.getElementById('text1').value="";
	document.getElementById('hfilecnt').value=0;
	document.getElementById( 'file'+1 ).textContent="";
	document.getElementById( 'file'+2 ).textContent="";
	document.getElementById( 'file'+3 ).textContent="";
	document.getElementById( 'remove'+1 ).style.display="none";
	document.getElementById( 'remove'+2 ).style.display="none";
	document.getElementById( 'remove'+3 ).style.display="none";
	
	}

	
function downloadFile(sid,dataid,filename)
{
	
   var dataString = "action=downloaditfile&sid="+sid+"&dataid="+dataid+"&filename="+filename;
	//alert("dataString:"+dataString);		
   $.ajax({ 
	type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
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
messagestatus2(<?php echo $msg.$employeeid ?> );
</script>

