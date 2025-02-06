<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	ini_set("display_errors",0);
	//$session_rank = $_SESSION["admin_rank"];
	
	$readonly = "readonly";
	$disabled = "disabled";
	$emp_id = 	$_SESSION["emp_id"];
	//$eid = $_REQUEST['eid'];
	$iv = $_REQUEST['iv'];
	//$eid = trim($dbobj->get_mcrypt_decrypt($eid,$iv));

	//$eid = 160701;
	$sid = $_REQUEST['sid'];
	$sid = trim($dbobj->get_mcrypt_decrypt($sid,$iv));
	$dbobj->updateReadStatus($sid,0);
	$serviceObj = $dbobj->getITRequestDetails($sid);
	
	//Open only if IT team
	$obj_emp = $dbobj->getEmployeeAccess($emp_id);
	//$str  = $emp_id."::".$obj_emp->type.":::".$obj_emp->itadmin;
	//$dbobj->addDebugLogs($str);
	if($obj_emp->type == 2 && $obj_emp->itadmin == 1)
		$dbobj->updateNewITStatus($sid);
	
	
	
	
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
						<li class="active">IT Admin</li>
						
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		<a href="itadmin_itreqview.php" >
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
																	
									<div class="col-md-12">
									<a href="javascript://" data-dismiss="modal" data-toggle="modal" data-target="#viewemployeelistdiv" >
									<input type="button" class="btn btn-md btn-blue1 " value="Update" style="height:30px; width:100px; padding:2px 5px; font-size:14px;margin-bottom:10px;">
									</a>
									</div>
									
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
											<textarea id="msgarea" disabled  rows="<?php echo $line_cnt;?>" class="form-control text-left" maxlength="1000" style="height=auto;margin: 0px -0.5px 0px 0px;resize: none;"><?php echo trim($data->msg); ?></textarea>
											
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



<div class="modal fade" id="viewemployeelistdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
  <form name="editfrmmess" id="editfrmmess" method="post">
    <div class="modal-content">
      
	  
	  <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title " id="myModalLabel">Update Message</h4>
      </div>
      
	  <div class="modal-body">
	  
	 
	   
	   
        <div class="totalaligndiv">
			
		<div class="col-md-4">											
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">Status :</span>
		<select id="status_id" name="status_id" class="form-control" >
		<option value="0">Select Status</option>
		<option value="3">Rejected</option>
		<option value="5">Resolved</option>
		</select>
		</div>
		</div>
		
		<div class="col-md-12">
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right">Description :</span>
		<textarea id="text1" <?php echo $read;?> class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
		</div>
		</div>										
											
		<div class="col-md-12">
		<input type="file" id="file-upload" multiple required />
		<label for="file-upload" style="cursor:pointer;" >
		<img src="img/attach.png" width="20" height="20" alt="" style="cursor:pointer;" />Attach file
		</label>
		[Maximum 3 files]<BR>
		<div>
		<img   class="file-remove" id="remove1" src="img/remove.png" width="20" height="20"  onClick="removeFile('1')"/>
		<div class="file-upload" id="file1"></div>
		</div>
		<div>		
		<img   class="file-remove" id="remove2" src="img/remove.png" width="20" height="20"  onClick="removeFile('2')"/>
		<div class="file-upload" id="file2"> </div>
		</div>
		<div>
		<img   class="file-remove"  id="remove3" src="img/remove.png" width="20" height="20"  onClick="removeFile('3')"/>
		<div class="file-upload" id="file3"> </div>
		</div>
		<input type="hidden" name="hfilecnt" id="hfilecnt" value="">
		<input type="hidden" name="hfile1" id="hfile1" value="">
		<input type="hidden" name="hfile2" id="hfile2" value="">
		<input type="hidden" name="hfile3" id="hfile3" value="">
		<input type="hidden" name="hsid" id="hsid" value="<?php echo $sid;?>">
		</div>		
		
     			
      </div>
	  <div class="clearfix"></div>
      <div class="modal-footer">
	   <span style="font-size:14px; float:left" id="istatus">
         
          </span>
        <button type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndAddData();" id="btnsubmit">Update</button> 
		<button type="button" class="btn btn-default btn-gray" data-dismiss="modal" onclick="resetSelection();" ><i class="fa fa-times"></i>CLOSE</button>
      </div>
	</div>
    </div>
	<input type="hidden" class="form-control"  id="messageid" name="messageid" value="">
	</form>
  </div>
</div>

							
											


<?php include 'include/footer.php' ?>
<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee.js"></script>

<script>
window.onload = function(e){ 
	
}

function auto_scale(element)
{
	alert("element.scrollHeight:"+element.scrollHeight);
}

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
		
		var status = document.getElementById( 'status_id').value;
		if(status == 3)
		{
			if(!confirm("Are you sure want to Reject this IT request?"))
				return;
		}
		if(status == 4)
		{
			if(!confirm("Are you sure want to Close this IT request?"))
				return;
		}
		
		document.getElementById('istatus').innerHTML= "";
		var dataString = "action=updateAdminITSupportTask&";
		dataString +=$( "#editfrmmess" ).serialize();
		document.getElementById('istatus').innerHTML= "Please wait..."; 
		document.getElementById('loading_data').style.display="block";
		document.getElementById('btnsubmit').disabled = true;
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				var sid = dobj.sid;
				var dataid = dobj.dataid;
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
								document.getElementById('loading_data').style.display="none";
								alert(status);
								updateEmailFlag(dataid);
								resetSelection();
								location.reload();
							},
							xhr: function(){
								var xhr = new XMLHttpRequest();
								xhr.upload.addEventListener('progress', function(e){
									if(e.lengthComputable){
										var uploadPercent = e.loaded / e.total;
										uploadPercent = (uploadPercent * 100);
										uploadPercent = parseFloat(uploadPercent).toFixed(2);
										document.getElementById('istatus').innerHTML= "Please wait... Files uploading ["+uploadPercent+"%]"; 
										//document.getElementById('loading_data').style.display="block";
		
										if(uploadPercent == 100){
											document.getElementById('istatus').innerHTML= "Completed";
										}
									}
								}, false);
								return xhr;
							}
						});
					}
					else{
						document.getElementById('istatus').innerHTML= "Completed";
						document.getElementById('loading_data').style.display="none";
						alert(status);
						updateEmailFlag(dataid);
						resetSelection();
						location.reload();
					}
				}
				else{
					document.getElementById('loading_data').style.display="none";
					alert(dobj.msg);
					location.reload();
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
					
	}
	


function updateEmailFlag(dataid)
{
		var dataString = "action=updateOldITEmailFlag&dataid="+dataid+"&value=0";
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{
				
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
	document.getElementById('btnsubmit').disabled = false;
	document.getElementById('istatus').innerHTML= "";
	
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

