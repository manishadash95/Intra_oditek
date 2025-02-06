<?php 
	echo "aaaaaaaaaa"; 
	include 'include/init.php';
	echo "bbbbbbbbbbbbb";
	include_once 'dbcon/DBConnection.php';
	
	$dbobj = new DBConnection();
	echo "cccccccccccccc";
	$dbobj->connect();

	$id = $_SESSION["user_id"];
	$username	= $_SESSION["username"];
	$forceno = 	$_SESSION["forceno"];
	echo "bbbbbbbbbbbbb";
	$msgdataobj = $dbobj->getAlertMessages($forceno);
	echo "cccccccccccccc";
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>
<div id="page-wrapper">
	<div class="page-content">
		<!-- begin PAGE TITLE AREA -->
		<!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
		<div class="row">
			<div class="col-lg-12">
				<div class="page-title">
					<h1>Dashboard</h1>
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
					</ol>

				</div>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<!-- end PAGE TITLE AREA -->

		<!--show_employee_div-->
		
		<!--end_show_employee_div-->
		
		<!-- /.row -->

		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title">
									<h4><i class="fa fa-exchange fa-fw"></i> Salary Transactions </h4>
								</div>
								<div class="portlet-widgets">
									<a data-toggle="collapse" data-parent="#accordion" href="#transactionsPortlet"><i class="fa fa-chevron-down"></i></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									
                                    
                                    <div class="totalaligndiv" id="SHOWADMINLIST">
										<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-1">
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>Date / Time</th>
                                                        <th>Month/Year</th>
                                                        <th>Gross Sal.</th>
                                                        <th>Deduction1</th>
                                                        <th>Net Sal.</th>
                                                        <th>Deduction2</th>
                                                        <th>Paid Sal.</th>
                                                        <th>View</th>
                                                        <th>Print</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
								<?php		$slno=1;
											$dadetails=$dbobj->getSalaryList($forceno);
											if($size=sizeof($dadetails)>0)
											{
												foreach($dadetails as $val)
												{
													$ranktype = $dbobj->getRankTypeFromId($val->rankid);
								?>
                                
                                                    <tr class="success">
                                                        <td><?php echo $slno ?></td>
                                                        <td><?php echo $val->timestamp ?></td>
                                                        <td><?php echo $val->formonth.",".$val->foryear ?></td>
                                                        <td><?php echo $val->gross_salary ?></td>
                                                        <td><?php echo $val->deduction1 ?></td>
                                                        <td><?php echo $val->net_salary ?></td>
                                                        <td><?php echo $val->deduction2 ?></td>
                                                        <td><?php echo $val->paid_salary ?></td>
                                                        <td class="tooltip-sidebar-logout">
														<a href="viewmyaroll.php?id=<?php echo $val->aroll_id; ?>&empid=<?php echo $val->id ?>" >
                                                        <button class="btn btn-xs btn-green outlinedivnone" >View</button> 
														</a>
														</td>
                                                        <td class="tooltip-sidebar-logout">
														<a target="_blank"   href="pdfpayslip.php?arollid=<?php echo $val->aroll_id; ?>&forceno=<?php echo $val->forceno ?>" >
                                                        <button class="btn btn-xs btn-red outlinedivnone" >Print</button> 
														</a>
														</td>
                                                        
                                                    </tr>
								<?php 				$slno++;
												}
											}else{echo '<tr><td colspan="10">No records found</td></tr>';}	?>
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
                                   	</div>
							</div>
						</div>
					</div>
					<!-- /.col-lg-12 -->

				</div>
			</div>
		</div>

	</div>
	<!-- /.page-content -->
</div>


<form name="frmuserlogin" id="frmuserlogin" method="post">
      	<input type="hidden" data-toggle="modal" href="#loginwindow" id="alertid" >
        <input type="hidden"  id="forceid" name="forceid" value="<?php echo $forceno; ?>">
         <input type="hidden"  id="modalid" name="modalid" value="1">
     					
		<div class="modal fade" id="loginwindow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		  <div class="modal-dialog" id="USERDETAILS" style="width:700px;">
		    <div class="modal-content" >
		      <div class="modal-header">
		       <h3 class="modal-title" id="myModalLabel">Alerts</h3>
                
		      </div>
		      <div class="text-center">
                  	<img src="../images/bannerlogin.png" border="0" name="national" width="400px" height="auto">
                  </div>
		       <div class="modal-body">
               <table border="0">
               <?php
			   	$cnt=0;
				foreach($msgdataobj as $val)
				{
				$cnt++;	
				?>	
				<TR>
               	<TD width="20" valign="top" style="border-bottom:1px dashed #666"> <?php echo $cnt ?>.</TD>
               	<TD width="150" valign="top" style="border-bottom:1px dashed #666"> <?php echo $val->datetime ?></TD>
                <TD width="20" valign="top" style="border-bottom:1px dashed #666"> ::</TD>
               	<TD width="500" valign="top" style="border-bottom:1px dashed #666"> <?php echo $val->msg ?></TD>
               	</TR>
             	<?php
                }			
				?>	
               <table>
               </div>
              <div class="modal-footer">
              	<span style="font-size:14px; float:left ; margin-left:-20px;" id="istatus">
                <input type="checkbox"  id="checkbox1" name="checkbox1" onChange="checkBoxEvent('0'); " >  Yes, I have read all the messages!
                </span> 
		        <button type="button" class="btn btn-default btn-gray"  onClick="logout();"><i class="fa fa-times"></i>Log Out</button>
                <button type="button" class="btn btn-default btn-blue" data-dismiss="modal" disabled id="okbutton" onClick="updateMessage();">OK</button>
		      </div>

		    </div>

		  </div>
		</div>
	</form>
    
<?php include 'include/footer.php' ?>

<script type="text/javascript">


window.onload = function () { 
		checkAlertMessages();
    }
	

function checkAlertMessages(){

		var forceno = document.getElementById('forceid').value; 
		//alert("ForceNo:"+forceno);
		var dataString = "type=getdata&forceno="+forceno;
		//alert(""+dataString);
		$.ajax({ 
		type: "POST",url: "ajaxCheckAlerts.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			var alertmessage=1;
			var  value = parseInt(html);
			//alert(""+value);
			if(value > 0)
				$("#alertid").trigger('click');
		} 
		});
}

function checkBoxEvent(id){
	//alert("::"+id);
	 	var value = document.getElementById("checkbox1").checked;
		if(value)
			document.getElementById('okbutton').disabled = false;
		else
			document.getElementById('okbutton').disabled = true;
	}
	
function logout(){
			//alert("logout");
		 	location.href = 'logout.php';
	}
	
function updateMessage(){
	
		document.getElementById('modalid').value=0;;
		var forceno = document.getElementById('forceid').value; 
		var dataString = "type=updatedata&forceno="+forceno;
		$.ajax({ 
		type: "POST",url: "ajaxCheckAlerts.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			
		} 
		});
	
	}	


</script>