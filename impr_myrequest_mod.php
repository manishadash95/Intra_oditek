<?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$pro_Array = $dbobj->getAllPriority();
	$res_Array = $dbobj->getAllResponsible();
	$typ_Array = $dbobj->getAllType();
	$eid = 	$_SESSION["emp_id"];
	$emp_name = $dbobj->getEmpName($eid);
	$allname_array = $dbobj->getAllNameWithBoard();

	
	$defaultData =  $dbobj->getDefaultImprovementInfo();
	
	
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>
<?php include 'imageupload/popimageupload.php' ?>
<div id="page-wrapper">
	<div class="page-content">

		<div class="row">
			
			<div class="col-lg-12">
				<div class="page-title">
					<ol class="breadcrumb">
						<li class="active">Improvement Ideas</li>
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
									<h4> View My Improvement</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="dataform" id="dataform" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
								
								
								<a href="javascript://" data-dismiss="modal" data-toggle="modal" data-target="#viewemployeelistdiv" >
									<input type="button" class="btn btn-md btn-red " value="New Improvement" style="height:30px; width:130px; padding:2px 5px; font-size:14px;margin-bottom:10px;">
									</a>
									
									
									
									
									<div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
                                                </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
														<th>Date</th>
														<th>IMPR Id</th>
														<th>Reported By</th>
														<th>Type<br>Responsible</th>
														<th>Assign To</th>
														<th>Priority</th>
														<th>Trgate Date</th>
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
									
									
								<input type="button" class="btn btn-md btn-silver " value="Closed Request" style="height:30px; width:120px; padding:2px 3px; font-size:14px;margin-bottom:5px;">
								</a>
                                   	</div>
									
									
									<div class="clearfix"></div>
								
									<!--total_employee_div-->
									<div class="totalaligndiv">
									
									<div class="clearfix"></div>
									
									
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									
									
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
  <form name="frmemployee" id="frmemployee" method="post">
    <div class="modal-content">
      
	  
	  <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title " id="myModalLabel">New Improvement Ideas</h4>
      </div>
      
	  <div class="modal-body">
	  
	 
	   
	   
        <div class="totalaligndiv">
			
		
		<div class="col-md-12">
		
		<div class="col-md-12">											
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right">Title :</span>
		<input type="text" name="title" id="title" class="form-control" placeholder="subject" >
		</div>
		</div>
		
<div class="col-md-6">
    <div class="input-group bmargindiv1 col-md-12">
        <span class="input-group-addon ndrftextwidth text-right">Type :</span>
        <select id="typ" name="typ" class="form-control" onChange="onChangeType()">
            <option value="0">Select Type</option>
            <?php
            foreach ($typ_Array as $val) {
                echo '<option value="' . $val->id . '">' . $val->name . '</option>';
            }
            ?>
        </select>
    </div>
</div>

    <div class="col-md-6">
    <div class="input-group bmargindiv1 col-md-12">
        <span class="input-group-addon ndrftextwidth text-right">Responsible :</span>
        <select id="res" name="res" class="form-control">
            <option value="0">Select Type</option>
            <?php
            foreach ($res_Array as $val) {
				if($defaultData->default_responsible ==  $val->id)
					echo '<option selected value="' . $val->id . '">' . $val->name . '</option>';
				else
					echo '<option value="' . $val->id . '">' . $val->name . '</option>';
            }
            ?>
        </select>
    </div>
</div>
								
		</div>
		
		<div class="col-md-12">
		
		
<div class="col-md-6">
    <div class="input-group bmargindiv1 col-md-12">
        <span class="input-group-addon ndrftextwidth text-right">Priority :</span>
        <select id="pro" name="pro" class="form-control">
            <option value="0">Select Type</option>
            <?php
            foreach ($pro_Array as $val) {
                echo '<option value="' . $val->id . '">' . $val->name . '</option>';
            }
            ?>
        </select>
    </div>
</div>

							
		</div>
		
		<div class="col-md-12">
		
	<div class="col-md-12">
    <div class="input-group bmargindiv1 col-md-12">
        <span class="input-group-addon ndrftextwidth text-right">Reported By :</span>
          <select id="rep" name="rep" class="form-control" >
           <option value="<?php echo $eid; ?>">[<?php echo $eid; ?>]: <?php echo $emp_name; ?></option>
           <option value="0">Anonymous</option>
        </select>
    </div>
</div>

		<div class="col-md-12" >
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right">Improvement Ideas :</span>
		<textarea id="text1" class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
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
		<input type="hidden" name="himprid" id="himprid" value="<?php echo $imprid;?>">
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
	  



<?php include 'include/footer.php' ?>


<script>
window.onload = function() {
		loadOpenImproveRequest();
	};




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
	
	
	
 function onChangeType() {
        var typ = document.getElementById('typ').value;
        var reportedBy = document.getElementById('rep');
        // Clear existing options
       if (typ == 3) {
			reportedBy.disabled =  false;
	   }
	   else{
		   reportedBy.options.selectedIndex = 0;
		   reportedBy.disabled =  true;
		   
	   }	
        
		
    }

function checkValidation() {
	var title = document.getElementById('title').value;
    var typ = document.getElementById('typ').value;
	var res = document.getElementById('res').value;
    var pro = document.getElementById('pro').value;
    var text1 = document.getElementById('text1').value;
	


     if(title == "" ){
	    alert("Please add Title...");
		return false;
	 }
    if (typ == "0") {
        alert("Please add Type...");
        return false;
    }
	if (res == "0") {
        alert("Please add Responsible...");
        return false;
    }

    if (pro == "0") {
        alert("Please select Priority...");
        return false;
    }

    return true;
}


function checkAndAddData() {
    // Call the validation function
    if (!checkValidation()) {
        return false;
    }
	
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
	   document.getElementById('istatus').innerHTML= "Please wait..."; 
	   document.getElementById('loading_data').style.display="block";
	   document.getElementById('btnsubmit').disabled = true;
	   
	
    // Retrieve values using jQuery
	var title =  $('#title').val();
    var typ = $('#typ').val();
	var res = $('#res').val();
    var pro = $('#pro').val();
    var rep = $('#emp_name').val();
	 
    var text1 = $('#text1').val();

    // Create data object to be sent to the server
    var dataString = "action=createNewImprovement&";
		dataString +=$( "#frmemployee" ).serialize();
	//alert(dataString);

	$.ajax({ 
		type: "POST",url: "ajaxprojectemployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				var status = dobj.msg;
				var imprid = dobj.imprid;
				var dataid = dobj.dataid;
				if(len > 0)
						{
							form_data.append("imprid", ""+dobj.imprid);
							form_data.append("dataid", ""+dobj.dataid);
							alert("form_data:"+form_data);
							$.ajax({
								url: 'uploadIMPRFiles.php', // point to server-side PHP script 
								cache: false,
								contentType: false,
								processData: false,
								data: form_data,                         
								type: 'post',
								success: function(html){
									var dobj=jQuery.parseJSON(html);
									document.getElementById('loading_data').style.display="none";
									alert(status);
									//resetSelection();
									window.location.href = "impr_myrequest.php";
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
							//updateEmailFlag(sid);
							alert(status);
							//resetSelection();
							window.location.href = "impr_myrequest.php";
						}
			}
			else{
				document.getElementById('loading_data').style.display="none";
				alert(dobj.msg);
				location.reload();
			}
		}
		
	});
   
   
}


	
	
	function loadOpenImproveRequest()
	{
		
		var dataString = "action=loadMyOpenImprovementIdeas";
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

</script>