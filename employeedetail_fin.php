<?php 
//ini_set("display_errors",0);

	//include 'include/init.php';
	//include_once 'dbcon/DBConnection.php';
	//$dbobj = new DBConnection();
	//include_once 'dbcon/ITAdminMgmt.php';
	//$dbobj = new ITAdminMgmt();
	
//$dbobj->connect();
		
	//$iv = $_REQUEST['iv'];
	//$device = $_REQUEST['device'];
	
	//$device_input = $eid = trim($dbobj->get_mcrypt_decrypt($device,$iv));

	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/ITAdminMgmt.php';
	$dbobj = new ITAdminMgmt();
	$dbobj->connect();
	
	$session_eid = $_SESSION["emp_id"];
	$deviceType_array = $dbobj->getAllDeviceType();
	$today = date("d-m-Y");	
		
	$eid = $_REQUEST['eid'];
	$iv = $_REQUEST['iv'];
	$eid = trim($dbobj->get_mcrypt_decrypt($eid,$iv));
	$empData = $dbobj->getEmployeeData($eid);
	$emp_eid = $eid;
	
	//echo "::".$eid;
	//exit();
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
						<li class="active">View Employee Details</li>
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		
		<?php echo $msg1111;?>
		<div class="row">
		
					<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="portlet portlet-blue">
									<div class="portlet-heading">
									<div class="portlet-title toplistviewtab">
									<ul id="myTab111" class="nav nav-tabs" style="margin-bottom:0px; border-bottom:0px">
									<li class="active"><a href="#bas1" data-toggle="tab">Basic Info</a></li>
									<li><a href="#empinfo1" data-toggle="tab">Employee Info</a></li>
									<li><a href="#finance1" data-toggle="tab">Finance Info</a></li>
									
									</ul>
									</div>
									<div class="clearfix"></div>
									</div>
					
					
					<div class="portlet-body">
						
						<div id="myTabContent1" class="tab-content">
							
							<div class="tab-pane fade in active" id="bas1">
							<?php include_once 'viewmyprofile_bas.php'; ?>			
							</div>
							
							<div class="tab-pane fade" id="empinfo1">
							<?php include_once 'viewemployee_emp.php'; ?>	
							</div>
							
							<div class="tab-pane fade" id="finance1">
							<?php include_once 'viewemployee_fin.php'; ?>	
							</div>
														
							</div>
							
						</div>
					</div>

				</div>
						
					</div>
                      		<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	
							<input type="hidden" name="update" id="update"  value="1">
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
<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee111.js"></script>

<script>
    function checkValidation() {
        var pan_no = document.getElementById('pan_no').value;
        var aadhar_no = document.getElementById('aadhar_no').value;
        var passport_no = document.getElementById('passport_no').value;
        var bnk_no = document.getElementById('bnk_no').value;
        var bnk_inf = document.getElementById('bnk_inf').value;
        var ifsc_co = document.getElementById('ifsc_co').value;
        var uan_no = document.getElementById('uan_no').value;
       return true; 
        
    }

   function checkAndAddData() {
    var ret = checkValidation();
    if (!ret)
        return false;

    var dataString = "action=updateEmpFinInfo&" + $( "#frmemployee" ).serialize();
    alert("dataString:"+dataString);
    document.getElementById('register').disabled = true;
    $.ajax({
        type: "POST",
        url: "ajaxprojectemployee.php",
        data: dataString,
        cache: false,
        success: function (html) {
            var response = jQuery.parseJSON(html);
            alert(response.msg);
            if (response.status == 1) {
                window.location.reload();
            }
        }
    });
}
</script>


