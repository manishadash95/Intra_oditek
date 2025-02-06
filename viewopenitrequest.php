<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
		
	$curdate=date("Y-m-d");
	$curmonth=date("m");
	$curyear=date("Y");
	$dadata= new Configurations();
	
	$emp_id = 	$_SESSION["emp_id"];
	$iv_key = $dbobj->get_mcrypt_iv();

	$myDevice = $dbobj->getMyAllocatedDevices();
?>
<?php include 'include/header.php' ?>

<?php include 'include/leftsidebar.php' ?>
<?php include 'imageupload/popimageupload.php' ?>
        <!-- begin MAIN PAGE CONTENT -->
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
                <!-- /.row -->
                <!-- end PAGE TITLE AREA -->
               
			   <!--main_heading_div-->
				<?php echo $msg;?>
                <!-- /.row -->
				<form name="frmdarate" id="frmdarate" method="post">
				<div class="row" id="load_subadmin">
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
                                    <h4 > Active IT Request</h4>
                                </div>
                                							 
				
				
                                <div class="clearfix"></div>
                            </div>
							
				
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                               <div class="totalaligndiv" id="SHOWADMINLIST">
																		
									
					
								<div class="portlet-body">
									
									<a href="javascript://" data-dismiss="modal" data-toggle="modal" data-target="#viewemployeelistdiv" >
									<input type="button" class="btn btn-md btn-red " value="New Request" style="height:30px; width:100px; padding:2px 5px; font-size:14px;margin-bottom:10px;">
									</a>
								
                                    
                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-4 col-sm-4">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Date</th>
														<th>Service Id</th>
                                                        <th>Title</th>
														<th>Priority</th>
														<th>Status</th>
														<th>View</th>
						                            </tr>
                                                </thead>
                                                <tbody id="DATAFIELD" class="tablefont">
									            </tbody>

                                            </table>
                                        </div>
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											<ul class="pagination pull-right margintopzerodiv">
												 <?php //echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?>
											</ul>  
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    </div>
									
									<a href="closeitrequest.php" >
								<input type="button" class="btn btn-md btn-silver " value="Closed Request" style="height:30px; width:120px; padding:2px 3px; font-size:14px;margin-bottom:5px;">
								</a>
                                   	</div>
									
									
									
									
							
										
						<div class="clearfix"></div>				
										
										
									
										
										
										
										
										</form>
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											<ul class="pagination pull-right margintopzerodiv">
												 <?php //echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?>
											</ul>  
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    </div>
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
   
<div class="modal fade" id="viewemployeelistdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
  <form name="editfrmmess" id="editfrmmess" method="post">
    <div class="modal-content">
      
	  
	  <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title " id="myModalLabel">New IT Request</h4>
      </div>
      
	  <div class="modal-body">
	  
	 
	   
	   
        <div class="totalaligndiv">
			
		<div class="col-md-12">											
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right">Title :</span>
		<input type="text" name="title" id="title" class="form-control" placeholder="subject" >
		</div>
		</div>
		<div class="col-md-12">											
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-center">If New Support is linked with your allocated device, then please select Device id from 'My Devices' list.</span>
		</div>
		</div>
		<div class="col-md-6">											
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">Priority :</span>
		<select id="priority" name="priority" class="form-control" >
		<option value="2">Normal</option>
		<option value="1">High</option>
		<option value="3">Low</option>
		</select>
		</div>
		</div>
		
		<div class="col-md-6">											
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">My Devices :</span>
		<select id="device" name="device" class="form-control" >
		<option value="">General</option>
		<?php foreach($myDevice as $itr){ 
		?>
		<option value="<?php echo $itr->tid; ?>" > <?php echo $itr->info; ?></option>
		<?php } ?>
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
        <button type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndAddData();" id="btnsubmit">Create</button> 
		<button type="button" class="btn btn-default btn-gray" data-dismiss="modal" onclick="resetSelection();" ><i class="fa fa-times"></i>CLOSE</button>
      </div>
	</div>
    </div>
	<input type="hidden" class="form-control"  id="messageid" name="messageid" value="">
	</form>
  </div>
</div>   
	
	
	
    <!--end_view_employee_div-->
    <script type="text/javascript"> 
	

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
	
	

	function checkValidation()
	{
		
		var title = document.getElementById('title').value;
		var desc = document.getElementById('text1').value;
		var priority = document.getElementById('priority').value;
		
		if(title == "" )
		{
			alert("Please add Title...");
			return false;
		}
		
		if(desc == "" )
		{
			alert("Please select Description...");
			return false;
		}
		if(priority == 1)
		{
			if(!confirm("Are you sure your want to create a High priority request?"))
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
		//var len = filedata.files.length;
		var len = document.getElementById( 'hfilecnt').value;
		//alert("FILE CNT:"+len);
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
		document.getElementById('istatus').innerHTML= "";
		var dataString = "action=addNewITSupportTask&";
		dataString +=$( "#editfrmmess" ).serialize();
		//alert("dataString:"+dataString);
		document.getElementById('istatus').innerHTML= "Please wait..."; 
		document.getElementById('loading_data').style.display="block";
		document.getElementById('btnsubmit').disabled = true;
		
		
		
		
		
		
		
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				
				if(dobj.status==1)
				{
					var status = dobj.msg;
					var sid = dobj.sid;
					var dataid = dobj.dataid;
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
								resetSelection();
								updateEmailFlag(sid);
								window.location.href = "viewopenitrequest.php";
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
						updateEmailFlag(sid);
						resetSelection();
						window.location.href = "viewopenitrequest.php";
						//loadOpenITRequest();
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
	
	function updateEmailFlag(sid)
	{
		//alert("sid:"+sid);
		var dataString = "action=updateNewITEmailFlag&sid="+sid+"&value=0";
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{
				
			} 
		});
		
	}
	
	function resetSelection(){
		
	document.getElementById('title').value="";
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

	
	
	window.onload = function() {
		loadOpenITRequest();
	};

	
	
	function loadOpenITRequest()
	{
		
		var dataString = "action=loadOpenITSupportTask";
		$.ajax({ 
			type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					$("#DATAFIELD").html(dobj.data);
					
				}
				else{
					alert(dobj.msg);
					location.reload();
				}
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
