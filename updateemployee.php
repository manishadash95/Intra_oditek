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
						<li class="active">Update Employee Data</li>
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
									
									
									
									<div class="portlet portlet-blue">
									<div class="portlet-heading">
									<div class="portlet-title toplistviewtab">
									<ul id="myTab111" class="nav nav-tabs" style="margin-bottom:0px; border-bottom:0px">
									<li class="active"><a href="#basic1" data-toggle="tab">Basic Info</a></li>
									<li><a href="#family1" data-toggle="tab">Family Info</a></li>
									<li><a href="#education1" data-toggle="tab">Education Info</a></li>
									<li><a href="#office1" data-toggle="tab">Office Info</a></li>
									
									<!--
									<li class="dropdown">
									<a href="#" id="myTabDrop11" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
									<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop11">
										<li><a href="#dropdown11" tabindex="-1" data-toggle="tab">@fat</a>
										</li>
										<li><a href="#dropdown21" tabindex="-1" data-toggle="tab">@mdo</a>
										</li>
									</ul>
									</li>
									-->
									</ul>
									</div>
									<div class="clearfix"></div>
									</div>
					
					
					<div class="portlet-body">
						
						<div id="myTabContent1" class="tab-content">
							<div class="tab-pane fade in active" id="basic1">
							
							<?php include_once 'updateemployee_basic.php'; ?>			
								
							</div>
							
							<div class="tab-pane fade" id="family1">
							
							
							</div>
							
							<div class="tab-pane fade" id="education1">

								
							</div>
							
							<div class="tab-pane fade" id="office1">

								
							</div>
							
							<!--
							<div class="tab-pane fade" id="dropdown11">
								<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
								<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
							</div>
							<div class="tab-pane fade" id="dropdown21">
								<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
								<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
							</div>
							-->
						</div>
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

<style>
<!--
.toplistviewtab .nav-tabs>li>a:hover {
    border-color: transparent;
    color: #555555;
}
.toplistviewtab .nav-tabs>li.open>a, .toplistviewtab .nav-tabs>li.open>a:hover, .toplistviewtab .nav-tabs>li.open>a:focus {
    color: #555555;
    background-color: #ffffff;
    border: 1px solid #dddddd;
    border-bottom-color: transparent;
    cursor: default;
}
.toplistviewtab .dropdown-menu>li>a{color: #555555;}
.toplistviewtab .dropdown-menu>li.active>a{color: #ffffff;}
.toplistviewtab .dropdown-menu>li>a:hover, .toplistviewtab .dropdown-menu>li>a:focus {
    text-decoration: none;
    color: #262626;
    background-color: #f5f5f5;
}
-->
</style>