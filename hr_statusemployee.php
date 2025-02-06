<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	
		
		
	
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
						<li class="active">Employee Status</li>
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
									
							
					<form name="editdata" id="editdata" method="post" enctype="multipart/form-data" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
			
								
									
									
									<div class="col-md-12" id="emp_data_block" style="display:block;">
									
									
									
									
									<div class="portlet portlet-green">
									<div class="portlet-heading">
									<div class="portlet-title toplistviewtab">
									<ul id="myTab111" class="nav nav-tabs" style="margin-bottom:0px; border-bottom:0px">
									<li class="active"><a href="#status1" data-toggle="tab">Permanent</a></li>
									<li><a href="#status2" data-toggle="tab">Probation</a></li>
									<li><a href="#status3" data-toggle="tab">Intern</a></li>
									<li><a href="#status4" data-toggle="tab">On-Notice</a></li>
									<li><a href="#status5" data-toggle="tab">Contractual</a></li>
									<li><a href="#status6" data-toggle="tab">Left</a></li>
									
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
							
							<div class="tab-pane fade in active" id="status1">
							<?php include_once 'hr_statusemployee_1.php'; ?>			
							</div>
							
							<div class="tab-pane fade" id="status2">
							<?php include_once 'hr_statusemployee_2.php'; ?>
							</div>
							
							<div class="tab-pane fade" id="status3">
							<?php include_once 'hr_statusemployee_3.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="status4">
							<?php include_once 'hr_statusemployee_4.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="status5">
							<?php include_once 'hr_statusemployee_5.php'; ?>	
							</div>

							<div class="tab-pane fade" id="status6">
							<?php include_once 'hr_statusemployee_6.php'; ?>	
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
	
			loadPermanentEmpList();
			loadProbationEmpList();
			loadInternEmpList();
			loadOnNoticeEmpList();
			loadContractualEmpList();
			loadLeftEmpList();
		
	};
	

function loadPermanentEmpList()
{
	
	var dataString = "act=getPermanentEmployeeList";
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#DATAFIELD1").html(dobj.data);
			}
			else{
				alert(dobj.msg);		
			}
		} 
		});
	
	
}


function loadProbationEmpList()
{
	
	var dataString = "act=getProbationEmployeeList";
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#DATAFIELD2").html(dobj.data);
			}
			else{
				alert(dobj.msg);		
			}
		} 
		});
	
	
}

function loadInternEmpList()
{
	
	var dataString = "act=getInternEmployeeList";
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#DATAFIELD3").html(dobj.data);
			}
			else{
				alert(dobj.msg);		
			}
		} 
		});

}


function loadOnNoticeEmpList()
{
	
	var dataString = "act=getOnNoticeEmployeeList";
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#DATAFIELD4").html(dobj.data);
			}
			else{
				alert(dobj.msg);		
			}
		} 
		});
	
	
}


function loadContractualEmpList()
{
	
	var dataString = "act=getContractualEmployeeList";
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#DATAFIELD5").html(dobj.data);
			}
			else{
				alert(dobj.msg);		
			}
		} 
		});
	
	
}


function loadLeftEmpList()
{
	
	var dataString = "act=getLeftEmployeeList";
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			if(dobj.status==1)
			{
				$("#DATAFIELD6").html(dobj.data);
			}
			else{
				alert(dobj.msg);		
			}
		} 
		});
	
	
}


</script>

<style>

</style>