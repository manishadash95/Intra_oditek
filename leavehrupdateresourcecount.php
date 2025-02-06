<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
	$iv = $_REQUEST['iv'];
	
	$empList = $dbobj->getAllActiveEmployeeListName();
	
		
	
	
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
						<li class="active">Update Resource Leave Status</li>
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
									<h4> Update Resource Leaves Status</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="editdata" id="editdata" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
			
			
									<div class="col-md-12">
										
									<div class="col-md-12">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Select Resource :</span>
									<select id="reso_id" name="reso_id" class="form-control chosen-select"  >
									<option value="0" >Select Resource</option>
									<?php foreach($empList as $emp){ 
									$select="";
									if($emp_id > 0 && $emp->eid == $emp_id)
										$select = "selected";
									?>
									<option value="<?php echo $emp->eid; ?>" <?php echo $select;?> > <?php echo $emp->name; ?></option>
									<?php } ?>
									</select>
									</div>
									</div>
																				
									</div>
									
									<input type="hidden" id="heid" value="<?php echo $emp_id; ?>">
									
									<div class="col-md-12">
									<div class="bpaddingdiv1 text-center">
									<button type="button" class="btn btn-default " name="btnsubmit" onclick="loadResourceData();" id="btnsubmit">View</button> 
									</div>
									</div>	

									<div class="col-md-12">
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Emp. Name :</span>
									<input type="text" readOnly id="emp_name" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Emp. Id :</span>
									<input type="text" readOnly id="emp_id" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Reporting Mgr. :</span>
									<input type="text" readOnly id="uname" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>


									</div>
									
									
									<div class="col-md-12">
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Max Paid :</span>
									<input type="text"  id="m_paid" name="m_paid" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Max Unpaid :</span>
									<input type="text"  id="m_unpaid" name="m_unpaid" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Max Special :</span>
									<input type="text"  id="m_special" name="m_special" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
																		

									</div>
									
									<div class="col-md-12">
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Available Paid :</span>
									<input type="text" readOnly id="a_paid" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Available Unpaid :</span>
									<input type="text" readOnly id="a_unpaid" class="form-control" placeholder="" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									
									<div class="col-md-4">
									<div class="input-group bmargindiv1 col-md-12" >
									<span class="input-group-addon ndrftextwidth text-right">Available Special :</span>
									<input type="text" readOnly id="a_special" class="form-control" placeholder="0" value="<?php echo $leaveObj->lid; ?>">
									</div>
									</div>
									
									

									</div>
									
									
									<div class="col-md-12" id="notediv" style="display:none;" >
		
									<div class="col-md-12" >
									<div class="input-group bmargindiv1 col-md-12">
									<span  class="input-group-addon ndrftextwidth text-right">Note :</span>
									<textarea id="text1" class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
									</div>
									</div>
																											
									</div>
									
									
									<div class="col-md-12" id="updatediv" style="display:none;">
									<div class="bpaddingdiv1 text-center">
									<button type="button" class="btn btn-default " onclick="updateResourceData();" >Update</button> 
									</div>
									</div>	
									
									
									<!--end_total_employee_div-->
									<!--login_informations_div-->
							
									<!--end_login_information_div-->
									
									
									<!--permission_informations_div-->
					
									
									<!--end_permission_information_div-->
									<!--allowances_deduction_div-->
			
									<!--end_allowances_deduction_div-->
                                    <!--final_deduction_div-->
                            
                                    <!--end_final_deduction_div-->
									<!--netpay_information_div-->
				
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


<script>


window.onload = function() {
	
	
		
	};
	


function loadResourceData()
{
	var reso_id = document.getElementById( 'reso_id').value;
	
	if(reso_id == 0)
	{
		alert("Please select Resource");
		return false;
	}
	var emp_name = document.getElementById( 'emp_name');
	var emp_id = document.getElementById( 'emp_id');
	
	var uname = document.getElementById( 'uname');
	var m_paid = document.getElementById( 'm_paid');
	var m_unpaid = document.getElementById( 'm_unpaid');
	var m_special = document.getElementById( 'm_special');
	
	var a_paid = document.getElementById( 'a_paid');
	var a_unpaid = document.getElementById( 'a_unpaid');
	var a_special = document.getElementById( 'a_special');
	
	var updatediv = document.getElementById( 'updatediv');
	var notediv = document.getElementById( 'notediv');
	
		
	var dataString = "action=loadResoLeaveRecords&eid="+reso_id;
	$.ajax({ 
		type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				//$("#DATAFIELD").html(dobj.data);
				emp_name.value = dobj.emp_name;
				emp_id.value = dobj.emp_id;
				uname.value = dobj.uname;
				//leave counts
				m_paid.value = dobj.m_paid;
				m_unpaid.value = dobj.m_unpaid;
				m_special.value = dobj.m_special;
				a_paid.value = dobj.a_paid;
				a_unpaid.value = dobj.a_unpaid;
				a_special.value = dobj.a_special;
				
				updatediv.style.display = "block";
				notediv.style.display = "block";
				
			}
			else{
				//alert(dobj.msg);
				//location.reload();
			}
		} 
	});
	
				
}	


function updateResourceData()
{
	var reso_id = document.getElementById( 'reso_id').value;
	var m_paid = document.getElementById('m_paid').value;
	var m_unpaid = document.getElementById('m_unpaid').value;
	var m_special = document.getElementById('m_special').value;
	var desc = document.getElementById('text1').value;
	
	if(m_paid =="" || m_unpaid =="" || m_special =="")
	{
		alert("Field value should not null!");
		return false;
	}
	
	if(desc == "" )
	{
		alert("Please add Description...");
		return false;
	}
		
	var dataString = "action=updateResoLeaveRecords&";
		dataString +=$( "#editdata" ).serialize();
		
	//alert(dataString);
	
	$.ajax({ 
		type: "POST",url: "ajaxLeave.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				document.getElementById('text1').value="";
				loadResourceData();
				
			}
			else{
				
			}
		} 
	});
	
}		
	

</script>