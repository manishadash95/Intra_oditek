<?php 

	ini_set("display_errors",0);
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
	$imprid = $_REQUEST['imprid'];
	$imprid = trim($dbobj->get_mcrypt_decrypt($imprid,$iv));
	$dbobj->updateIMPReadStatus($imprid,0);
	$dbobj->updateIMPRReadStatus($imprid,0);
	$serviceObj = $dbobj->getIMPRecordDetails($imprid);
	
	
	
	
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
						<li class="active">Improve Ideas</li>
						
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		<a href="Improvementrequest.php" >
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
									<h4 style="font-size: 14px"><B> [<?php echo $serviceObj->imprid;?>]:[<?php echo $serviceObj->status_str;?>] 
									Created on <?php echo $serviceObj->date_created;?> </B>
									</h4>
								</div>
							
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
							
							
							<div class="portlet-body">
							
							
							
							
							<div class="col-md-12">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Title :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->title;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Reported By :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->reported;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Type :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->type;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Responsible :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->responsible;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Assign To :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->assign;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Priority :</span>
							<input readonly type="text" class="form-control" value="<?php echo $serviceObj->priority;?>" >
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
											<textarea readOnly  class="form-control text-left" maxlength="1000" rows="<?php echo $line_cnt;?>" style="margin: 0px -0.5px 0px 0px; height: auto;resize: none"><?php echo trim($data->msg); ?></textarea>
											
											</div>
											<?php if($data->attachment > 0){ ?>
											<div class="input-group  col-md-12">
											<span class="input-group-addon ndrftextwidth text-left" style="border-left: 1px solid #CCCCCC;
											border-right: 1px solid #CCCCCC;" >
											<img src="img/attach2.png" width="20" height="20" alt=""  />
											<?php if(strlen($data->file1) > 0){ ?>
											<span style="cursor:pointer;" onClick="downloadFile(<?php echo $imprid.",".$data->dataid.",'".$data->file1."'"?> )" >
											<B><?php echo $data->file1; ?> </B>
											</span>
											<?php }	?>											
											
											
											<?php if(strlen($data->file2) > 0){ ?>
											<span style="cursor:pointer;" onClick="downloadFile(<?php echo $imprid.",".$data->dataid.",'".$data->file2."'"?> )" >
											<B><?php echo $data->file2; ?> </B>
											</span>
											<?php }	?>
											
											
											<?php if(strlen($data->file3) > 0){ ?>
											<span style="cursor:pointer;" onClick="downloadFile(<?php echo $imprid.",".$data->dataid.",'".$data->file3."'"?> )" >
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
        <h4 class="modal-title " id="myModalLabel">Update Message [<?php echo $serviceObj->imprid;?>]</h4>
      </div>
      
	  <div class="modal-body">
	  
	 
	   
	   
        <div class="totalaligndiv">
			
		<div class="col-md-6">											
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">Status :</span>
		<select id="status_id" name="status_id" class="form-control" Onchange="UpdateField();">
		<option value="0">Unchanged</option>
		<?php
        //Creator
		
		if($serviceObj->reportedby == $eid && $serviceObj->status == 1  )
		{ 		
		    echo '<option value="5">CLOSED</option>' ;
		}
		else if($serviceObj->reportedby == $eid && $serviceObj->status == 2  )
		{ 		
		    echo '<option value="5">CLOSED</option>' ;
		}
	  	else if($serviceObj->reportedby == $eid && $serviceObj->status == 3  )
		{ 		
	        echo '<option value="7">Open</option>' ;
			echo '<option value="5">CLOSED</option>' ;
		}
		else if($serviceObj->reportedby == $eid && $serviceObj->status == 4  )
		{ 
	        echo '<option value="6">RE-OPEN</option>' ;
		}
		else if($serviceObj->reportedby == $eid && $serviceObj->status == 7  ) 
		{
			echo '<option value="5">CLOSED</option>' ;
		}
				
		?>
		
		<?php 
		//others
		if($serviceObj->reportedby != $eid && $serviceObj->status == 3)
		{
			echo '<option value="7">OPEN</option>' ;
			echo '<option value="4">Rejected</option>' ;
		}
		else if($serviceObj->reportedby != $eid && $serviceObj->status == 7)
		{
			echo '<option value="5">PR-CLOSED</option>' ;
		}
		else if($serviceObj->reportedby != $eid)
		{
			echo '<option value="3">Assigned</option>' ;
			echo '<option value="4">Rejected</option>' ;
		}
		
		?>		
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

function UpdateField()
{
	var status_id = document.getElementById('status_id').value;
	
	if(status_id == 7)
	{
		
	}else{
		
	}
	
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
			if(fsize > 3072)
			{
				alert(file.name+" : File size should not more than 3 MB.");
				return;
			}
			if (form_data) {
				var index=i+1;
				//alert("Index:"+index);
				form_data.append("file"+index, file);
			}
		}
		
		var status = document.getElementById( 'status_id').value;
		
		if(status == 7 && act_cost == "" )
		{
			alert("Please add actual cost...");
			return;
		}
		
		if(status == 7 && len == 0)
		{
			alert("Must attach a Purchased Invoice...");
			return;
		}
		
		
				
		//////////////////////////////////////////////////////////////////////////
		
		
		if(status == 6)
		{
			if(!confirm("Are you sure want to Close this Purchase Request?"))
				return;
		}
		
		if(status == 4)
		{
			if(!confirm("Are you sure want to Reject this Purchase Request?"))
				return;
		}
		
		if(status == 3)
		{
			if(!confirm("Are you sure want to Approve this Purchase Request?"))
				return;
		}
		
		
		document.getElementById('istatus').innerHTML= ""
		var dataString = "action=updateIMPRIdeas&";
		dataString +=$( "#editfrmmess" ).serialize();
		document.getElementById('istatus').innerHTML= "Please wait..."; 
		document.getElementById('loading_data').style.display="block";
		document.getElementById('btnsubmit').disabled = true;
		alert("dataString:"+dataString);
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				alert("dataid:"+dobj.status);
				if(dobj.status==1)
				{
					var status = dobj.msg;
					var imprid = dobj.imprid;
					var dataid = dobj.dataid;
					
					if(len > 0)
					{
						form_data.append("imprid", ""+dobj.imprid);
						form_data.append("imprid", ""+dobj.imprid);
						//alert("form_data:"+form_data);
						$.ajax({
							url: 'uploadPSFiles.php', // point to server-side PHP script 
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                         
							type: 'post',
							success: function(html){
								var dobj=jQuery.parseJSON(html);
								document.getElementById('loading_data').style.display="none";
								//updateEmailFlag(dataid);
								alert(status);
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
											updateEmailFlag(dataid);
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
						updateEmailFlag(dataid);
						//alert(status);
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

	

messagestatus2(<?php echo $msg.$employeeid ?> );

</script>

