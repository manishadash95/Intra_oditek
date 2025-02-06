<?php 
ini_set("display_errors",1);
	//set_time_limit(1);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	//$_SESSION["pageid"]= "";
	
	//$emp_name	= $_SESSION["emp_name"];
	//$emp_id = 	$_SESSION["emp_id"];

	
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>

<?php
    $leaveCnt =  $dbobj->getTotalLeaveCnt();
	$wfhCnt =  $dbobj->getTotalWFHCnt();
	$teamCnt =  $dbobj->getMyTeamCnt($emp_id);
	$todayHrs =  $dbobj->getMyTodayHrs();
	
	
?>

  
<div id="page-wrapper">
	<div class="page-content">
		<!-- begin PAGE TITLE AREA -->
		<!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
		<div class="row">
			<div class="col-lg-12">
				<div class="page-title">
					
					<ol class="breadcrumb">
						<li class="active">Dashboard</li>
					</ol>

				</div>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		
		<div class="row" style="display:visible" id="ID2">
			<div class="col-lg-3 col-sm-6">
				<div class="circle-tile">
					<a href="leavedashboard.php"  >
						<div class="circle-tile-heading dark-blue">
							<i class="fa fa-users fa-fw fa-3x"></i>
						</div>
					</a>
					<div class="circle-tile-content dark-blue">
						<div class="circle-tile-description text-faded">
							Leave Info
						</div>
						<div class="circle-tile-number text-faded">
							<?php echo $leaveCnt ; ?>
							<span id="sparklineA"></span>
						</div>
						<a  href="leavedashboard.php"  class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="circle-tile">
					<a href="wfh_dashboard.php">
						<div class="circle-tile-heading green">
							<i class="fa fa-users fa-fw fa-3x"></i>
						</div>
					</a>
					<div class="circle-tile-content green">
						<div class="circle-tile-description text-faded">
							WFH Info
						</div>
						<div class="circle-tile-number text-faded">
							<?php echo $wfhCnt ; ?>
							<span id="sparklineA"></span>
						</div>
						<a href="wfh_dashboard.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 col-sm-6">
				<div class="circle-tile">
					<a href="#">
						<div class="circle-tile-heading purple">
							<i class="fa fa-user fa-fw fa-3x"></i>
						</div>
					</a>
					<div class="circle-tile-content purple">
						<div class="circle-tile-description text-faded">
							My Team
						</div>
						<div class="circle-tile-number text-faded">
							<?php echo $teamCnt ; ?>
							<span id="sparklineD"></span>
						</div>
						<a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
			
			
			
			
			<div class="col-lg-3 col-sm-6">
				<div class="circle-tile">
					<a href="mydailyhrslist.php">
						<div class="circle-tile-heading red">
							<i class="fa fa-clock-o fa-fw fa-3x"></i>
						</div>
					</a>
					<div class="circle-tile-content red">
						<div class="circle-tile-description text-faded">
							Daily HRs
						</div>
						<div class="circle-tile-number text-faded">
						<?php echo $todayHrs; ?>
						</div>
						<a href="mydailyhrslist.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
			
			
			
		</div>
		
		
	

	</div>
	<!-- /.page-content -->
</div>


    
<?php include 'include/footer.php' ?>

<script type="text/javascript">



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