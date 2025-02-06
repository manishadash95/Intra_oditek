<?php 
ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	$newAdmintobj = $dbobj;	
	$editAdmintobj = $dbobj;
	
	//$teamlist= $dbobj->getDepartmentList();
	//$allname_array = $dbobj->getAllName();
	//$categoryobj = $dbobj->getHolidayCategory();
	//$custArray = $dbobj->getCustomerGrp();
	//$doccat_array = $dbobj->getDocCategory();
	
	$dataArray = $dbobj->getLinkDocumentList();
	

	//$holidayObj = $dbobj->getHolidayList();
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>
        <!-- begin MAIN PAGE CONTENT -->
        <div id="page-wrapper">

            <div class="page-content">

                <!-- begin PAGE TITLE AREA -->
                <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                <div class="row">
                	
                    <div class="col-lg-12">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="active">Important Document Link</li>
                            </ol>

                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE AREA -->
               
			   <!--main_heading_div-->
			   
               <!--search_filed_div-->
               
                <div class="clearfix"></div>
               	<!--end_search_field_div-->
				<?php echo $msg;?>
                <!-- /.row -->
             
                
                <!--row_div-->
                
                <div class="row">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> Document Link List</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#employeeliststatus"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->
									<?php 
									foreach($dataArray as $data)
									{
									?>	
									
									<div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-6">
									<span class="input-group-addon ndrftextwidth text-center" style="width:200px" ><b><?php echo $data->cat_name;?> Documents:</b></span>
									</div>
									</div>
									
									<?php 
									foreach($data->doc_array as $docObj)
									{
									?>
										<div class="col-md-12">
										<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-left doclinkstyle" style="width:100px">
										<?php echo $docObj->str; ?>
										</span>
										</div>
										</div>
									<?php 
									}
									?>
									
									<div class="col-md-12">
									<div class="input-group bmargindiv1 col-md-12">
									
									</div>
									</div>									
									 
									<?php 
									}
									?>
									
									 <div class="clearfix"></div>		
									
                                    
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
        
<!--view_employee_details_div-->
<div class="modal fade" id="viewemployeelistdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
  <form name="editfrm" id="editfrm" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Edit Employee List</h3>
      </div>
      <div class="modal-body">
        <div class="totalaligndiv">
            <div class="col-md-6">
                <div class="input-group bmargindiv1 col-md-12">
                    <span class="input-group-addon ndrftextwidth text-left">IRLA/Force No :</span>
                    <input type="text" class="form-control" placeholder="IRLA/Force No" name="edtirla" id="edtirla" readonly="true" style="background:#FFFFFF;">
                </div>
                <div class="input-group bmargindiv1 col-md-12">
                    <span class="input-group-addon ndrftextwidth text-left">Name :</span>
                    <input type="text" class="form-control" placeholder="Name" name="editname" id="editname" readonly="true" style="background:#FFFFFF;">
                </div>
                <div class="input-group bmargindiv1 col-md-12">
                    <span class="input-group-addon ndrftextwidth text-left">Password :</span>
                    <input type="password" class="form-control" placeholder="Password" name="editpass" id="editpass" maxlength="16">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group bmargindiv1 col-md-12">
                    <span class="input-group-addon ndrftextwidth text-left">Rank :</span>
                    <input type="text" class="form-control" placeholder="Rank" id="edtrank" name="edtrank" readonly="true" style="background:#FFFFFF;">
                </div>
                <div class="input-group bmargindiv1 col-md-12">
                    <span class="input-group-addon ndrftextwidth text-left">Status :</span>
                    <select class="form-control" id="edtstatus" name="edtstatus">
                        <option value="">Select Status</option>
                        <option value="1" >Enable</option>
						<option value="0" >Disable</option>
                    </select>
                </div>
                <div class="input-group bmargindiv1 col-md-12">
                    <span class="input-group-addon ndrftextwidth text-left">Retype Password :</span>
                    <input type="password" class="form-control" placeholder="Retype Password" name="editrepass" id="editrepass" maxlength="16">
                </div>
            </div>
            <div class="clearfix"></div>
        </div>	  
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" name="edtsubmit" id="edtsubmit">Update</button> <button type="button" class="btn btn-default btn-gray" data-dismiss="modal"><i class="fa fa-times"></i>CLOSE</button>
      </div>
    </div>
	<input type="hidden" class="form-control"  id="hidadminid" name="hidadminid">
	</form>
  </div>
</div>
<!--end_view_employee_details_div-->
        
<?php include 'include/footer.php' ?>
<script>

window.onload = function() {
		loadDocumentList();
	};
	
function editClose()
{
	document.getElementById('loading_data').style.display="block";
	window.location.reload();
}


function checkValidation()
{
	var cat_id =  document.getElementById('cat_id').value;
	var link_text =  document.getElementById('link_text').value;
	var weblink =  document.getElementById('weblink').value;
	
	if(cat_id == 0) {
		alert("Please select category...");
		return false;
	}
	
	
	if(link_text.length == 0) {
		alert("Please add Link Text...");
		return false;
	}
	
	if(weblink.length == 0) {
		alert("Please add weblink...");
		return false;
	}
	
			
	return true;
}

function addDocumentLink()
{
	var ret = checkValidation();
	if(!ret)
		return false;
	
	var pid = document.getElementById("hideditid").value;
	var team_id =  document.getElementById('team_id').value;
	var emp_id =  document.getElementById('emp_id').value;
	var cat_id =  document.getElementById('cat_id').value;
	var link_text =  document.getElementById('link_text').value;
	var weblink =  document.getElementById('weblink').value;
	
	var dataString = "act=adddocumentlink&team_id="+team_id+"&emp_id="+emp_id+"&link_text="+link_text+"&weblink="+weblink+"&pid="+pid+"&cat="+cat_id;
	//alert("dataString:"+dataString);
		
	$.ajax({ 
		type: "POST",url: "ajaxadmin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				loadDocumentList();
				alert(dobj.msg);
				resetform();
			}
			else{
				alert(dobj.msg);
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
	
	
}


function loadDocumentList()
{
	var dataString = "act=loaddocumentlist";
	//alert("dataString:"+dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxadmin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#TASKLISTDISPLAYID").html(dobj.data);
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
}

function resetform(){
	document.getElementById("hideditid").value=0;
	document.getElementById('weblink').value="";
	document.getElementById('link_text').value="";
	document.getElementById('cat_id').options[0].selected=true;
	document.getElementById('emp_id').options[0].selected=true;
	document.getElementById('team_id').options[0].selected=true;

}

function removeDocumentLink(id)
{
	var status = confirm("Are you sure want to delete?");
	if(status)
	{
		var dataString = "act=removedoclink&id="+id;
		//alert("dataString:"+dataString);
	
		$.ajax({ 
			type: "POST",url: "ajaxadmin.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				if(dobj.status==1)
				{
					loadDocumentList();
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
	}
	
}

function showDocLinkEdit(pid){
	document.getElementById("hideditid").value=pid;
	var dataString = "act=getdoclinkeditdata&id="+pid;
	//alert("dataString:"+dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxadmin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				
				for(i=0;i<document.getElementById("team_id").length;i++){
				if(document.getElementById("team_id").options[i].value==dobj.team_id){
					document.getElementById("team_id").options[i].selected=true;
					break;
					}
				}
				
				//////////////////////////////
					var team_id =  dobj.team_id;
					var dataString = "action=loadresource&team_id="+team_id;
										
					$.ajax({ 
						type: "POST",url: "ajaxproject.php" ,data: dataString,cache: false,
						success: function(html)
						{	 
							var dobj1=jQuery.parseJSON(html);
							if(dobj1.status==1)
							{
								$("#emp_id").html(dobj1.data);
								for(i=0;i<document.getElementById("emp_id").length;i++){
									if(document.getElementById("emp_id").options[i].value==dobj.emp_id){
										document.getElementById("emp_id").options[i].selected=true;
										break;
										}
									}
								
							}
							//document.getElementById('loading_data').style.display="none";
						} 
					});
				
				
				
				//////////////////////////////
						
				
				for(i=0;i<document.getElementById("cat_id").length;i++){
				if(document.getElementById("cat_id").options[i].value==dobj.cat){
					document.getElementById("cat_id").options[i].selected=true;
					break;
					}
				}
				document.getElementById("link_text").value = dobj.link_text;
				document.getElementById("weblink").value = dobj.weblink;
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
		
	return false;
}

function loadResourceList(){
	var team_id =  document.getElementById('team_id').value;
	var dataString = "action=loadresource&team_id="+team_id;
	//alert("dataString:"+dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxproject.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#emp_id").html(dobj.data);
			}
			//document.getElementById('loading_data').style.display="none";
		} 
	});
	
}

</script>
