<?php 
ini_set("display_errors",0);
	//set_time_limit(1);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	//$_SESSION["pageid"]= "";
	
	$emp_name	= $_SESSION["emp_name"];
	$emp_id = 	$_SESSION["emp_id"];
	$summaryData = $dbobj->getMyDailySummaryData();
	
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>

<script type="text/javascript">
    $(window).load(function(){
        $('#loadingMessage').modal({
            backdrop: 'static'
        });
    });
	setTimeout(function(){
    $('#loadingMessage').modal('hide')
    }, 1000);
</script>

<style type="text/css">
	
	
</style>


  
  
<div id="page-wrapper">
	<div class="page-content">
		<!-- begin PAGE TITLE AREA -->
		<!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
		<div class="row">
			<div class="col-lg-12">
				<div class="page-title">
					
					<ol class="breadcrumb">
						<li class="active"> My Daily Report Summary</li>
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
									<h4> Daily Report Summary</h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<div class="table-responsive dashboard-demo-table">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Sl. No</th>
                                                    <th>Date</th>
													<th>Day</th>
                                                    <th>Total HR</th>
													<th>Work Percentage</th>
													<th>View</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
											$i=0;
											foreach($summaryData as $value)
											{
												$i++;
												$color="";
												if($value->holiday)
													$color="red";	
											?>
												<tr>
													<td style="color:<?php echo $color?>;"><?php echo $i ?></td>
                                                    <td style="color:<?php echo $color?>;"><?php echo $value->work_date ?></td>
                                                    <td style="color:<?php echo $color?>;"><?php echo $value->day ?></td>
													<td style="color:<?php echo $color?>;"><?php echo $value->total_time ?></td>
													<td style="color:<?php echo $color?>;"><?php echo $value->work_percentage ?></td>
													<td style="color:<?php echo $color?>;" class="tooltip-sidebar-logout">
													<a href="mydailyhrreport.php?dt=<?php echo $value->work_date; ?> " >
													<input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px">
													</a>
													</td>
												</td>
                                             <?php
											}
											 ?>
												</tr>
												
											</tbody>
										</table>
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
		
		/*$('#loadingMessage').modal({
            backdrop: 'static'
        });
*/
    }

function closeModal(){
	//$('#loadingMessage').hide();
	//$('.modal-backdrop').hide();
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