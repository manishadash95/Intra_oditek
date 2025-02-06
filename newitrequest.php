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
			   <a href="viewopenitrequest.php" >
			<input type="button" class="btn btn-md btn-red " value="Back" style="height:40px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
			</a>
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
                                    <h4> New IT Request</h4>
                                </div>
                                
                                <div class="clearfix"></div>
                            </div>
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv3">
										
										
										<form name="myformdata" id="myformdata" method="post" ">
										
										
                                            <div class="bs-docs-example table-responsive">
                                            
											
												
											
                                            
											<Div class="col-md-12">
                                            
											<div class="input-group bmargindiv1 col-md-12">
												<span  class="input-group-addon ndrftextwidth text-right">Title :</span>
												<input type="text" name="title" id="title" class="form-control" placeholder="subject" >
											</div>
											
											</div>
										
										
														
											
											
											
											
											<div class="col-md-12">
											
											<div class="input-group bmargindiv1 col-md-12">
											<span  class="input-group-addon ndrftextwidth text-right">Description :</span>
											<textarea id="text1" <?php echo $read;?> class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 200px;"></textarea>
											
											</div>
											
											
											</div>
											
											<div class="col-md-12">
											  <input type="file" id="file-upload" multiple required />
											  <label for="file-upload" style="cursor:pointer;" >
											  <img src="img/attach.png" width="20" height="20" alt="" style="cursor:pointer;" />Attach file
											  </label>
											  [Maximum 3 files]<BR>
											  <img   class="file-remove" id="remove1" src="img/remove.png" width="20" height="20"  onClick="removeFile('1')"/>
											  <div class="file-upload" id="file1"></div> 
											  <BR>
										      <img   class="file-remove" id="remove2" src="img/remove.png" width="20" height="20"  onClick="removeFile('2')"/>
											  <div class="file-upload" id="file2"> </div>
											  <BR>
											  <img   class="file-remove"  id="remove3" src="img/remove.png" width="20" height="20"  onClick="removeFile('3')"/>
											  <div class="file-upload" id="file3"> </div>
											  <input type="hidden" name="hfilecnt" id="hfilecnt" value="">
											  <input type="hidden" name="hfile1" id="hfile1" value="">
											  <input type="hidden" name="hfile2" id="hfile2" value="">
											  <input type="hidden" name="hfile3" id="hfile3" value="">
											 
											</div>
											
											<div class="clearfix"></div>
										
										<div class="col-md-12" name="holiday_div" id="holiday_div" style="display:none">
										<div class="input-group bmargindiv1 col-md-12">
										<span name="holiday" id="holiday" class="input-group-addon ndrftextwidth text-left" style="width:300px;color:red"></span>
												
										</div>
										</div>
											
										<?php if($read =="") { ?>									
											
										<div class="col-lg-12">
										<div class="bpaddingdiv1 text-center">
										<input type="hidden" name="htype" id="htype" value="0">
										
										<input type="button" name="btnsubmit" id="btnsubmit" class="btn btn-green btn" onclick="checkAndAddData();" value="Submit">
										
										<input type="button" name="" id="" class="btn btn-red btn" onclick="resetSelection();" value="Cancel">
										</div>
										</div>
										
										<?php }	?>	
											
										<div class="clearfix"></div>	
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
		
		var dataString = "action=addNewITSupportTask&";
		dataString +=$( "#myformdata" ).serialize();
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
								//loadOpenITRequest();
								window.location.href = "viewopenitrequest.php";
							}
						});
					}
					else{
						alert(status);
						resetSelection();
						window.location.href = "viewopenitrequest.php";
						//loadOpenITRequest();
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
		
	document.getElementById('title').value="";
	document.getElementById('text1').value="";
	document.getElementById('hfilecnt').value=0;
	document.getElementById( 'file'+1 ).textContent="";
	document.getElementById( 'file'+2 ).textContent="";
	document.getElementById( 'file'+3 ).textContent="";
	document.getElementById( 'remove'+1 ).style.display="none";
	document.getElementById( 'remove'+2 ).style.display="none";
	document.getElementById( 'remove'+3 ).style.display="none";
	
	}


   		
	
	
	
	 </script>
<?php include 'include/footer.php' ?>
