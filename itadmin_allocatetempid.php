<?php 

	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/ITAdminMgmt.php';
	$dbobj = new ITAdminMgmt();
	$dbobj->connect();
	$deviceType_array = $dbobj->getAllDeviceTypeTemp();
	$empList = $dbobj->getAllEmployeeListNameIT();

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
					<li>Allocate Temporary ID Card</li>
					</ol>

				</div>
			
		<?php echo $msg1111;?>
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4> Allocate IT Device </h4>
								</div>
								
								<div class="clearfix"></div>
							</div>
					<form name="newdata" id="newdata" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
										<!--1st_div-->
										<div class="col-md-4" >
										<div class="input-group bmargindiv1 col-md-12" >
										<span class="input-group-addon ndrftextwidth text-right" style="width:153px;">Select Resource :</span>
										<select id="reso_id" name="reso_id" class="form-control chosen-select"   onChange="loadITDevices()">
										<option value="0" >All Resource</option>
										<?php foreach($empList as $emp){ 
										if($resoid_input == $emp->eid){	
										?>
										<option selected value="<?php echo $emp->eid; ?>" > [<?php echo $emp->eid; ?>]: <?php echo $emp->name; ?></option>
										<?php }else{ ?>
											<option value="<?php echo $emp->eid; ?>" > [<?php echo $emp->eid; ?>]: <?php echo $emp->name; ?></option>
										<?php }  } ?>
										</select>
										</div>
										</div>
										
										
										<div class="col-md-4">
																						
											<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-right">Select Temp Card :</span>
											<select id="device" name="device" class="form-control" onchange="loadITDevices();" >
											<option value="0">Select Card</option>
											<?php
											foreach($deviceType_array as $val)
											{
												echo '<option value="'.$val->id.'">'.$val->name.'</option>';
											}			
											?>		
											</select>
											</div>
										</div>
										
										
										
										<div class="col-lg-4" id="div_add"  style="display:block" >
										<div class="bpaddingdiv1 text-stright">
										<input type="button" name="register1" id="register1" class="btn btn-green btn-md" value="Assign" onClick="addTempDevice();">
										</div>
									</div>
										
										<div class="clearfix"></div>
									</div>
									
									
									<div class="totalaligndiv">
									<!--1st_div-->
										
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
												</colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th class="center_td" >ID</th>
														<th class="center_td" >Date</th>
														<th class="center_td" >Emp_ID</th>
														<th class="center_td" >Emp_Name</th>
														<th class="center_td" >Crad_No</th>
														<th class="center_td" >Delete</th>
							                        </tr>
                                                </thead>
                                                <tbody id="DATAFIELD" class="tablefont">
                                                 
									            </tbody>

                                            </table>
                                        </div>
                                       
                                    </div>


									
										
									<!--end_3rd_div-->
									<div class="clearfix"></div>
									</div>
									
									
														
									<div class="clearfix"></div>
									<!--end_total_employee_div-->
						            <div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	<input type="hidden" name="hdevice" id="hdevice"  value="" >
						
					
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
	
	loadTempCardDetails();
	
	
	};

	function loadTempCardDetails()
	{
		
		// Perform AJAX request
		$.ajax({
			type: "POST",
			url: "ajaxITAdmin.php",
			data: {
				action: "getTempCardDetails"
			},
			success: function(response) {
				var dobj = jQuery.parseJSON(response);
				if (dobj.status == 1) {
					$("#DATAFIELD").html(dobj.data);
				} else {
					alert("Failed to assign device. Error: " + dobj.msg);
				}
			}
		});
	

	}

    function addTempDevice() {
    var device = document.getElementById('device').value;
    var reso_id = document.getElementById('reso_id').value;

    if (reso_id === "0") {
        alert("Please select a resource.");
        return false;
    }
    if (device === "0") {
        alert("Please select a card.");
        return false;
    }

    // Perform AJAX request
    $.ajax({
        type: "POST",
        url: "ajaxITAdmin.php",
        data: {
            action: "addTempDevice",
            device: device,
            reso_id: reso_id
        },
        success: function(response) {
            var dobj = jQuery.parseJSON(response);
            if (dobj.status == 1) {
                alert("Device assigned successfully.");
				location.reload();
                 
            } else {
                alert("" + dobj.msg);
				location.reload();
            }
        }
    });

    
   
}
function actionDelete(id) {
    if (confirm("Are you sure want to delete?")) {
        var dataString = "action=actionDelete&id=" + id;
        $.ajax({
            type: "POST",
            url: "ajaxITAdmin.php",
            data: dataString,
            cache: false,
            success: function (html) {
                var dobj = jQuery.parseJSON(html);
                if (dobj.status == 1) {
                    alert(dobj.msg);
                    location.reload();
                } else {
                    alert("Error during deletion: " + dobj.msg);
                    console.log(dobj); // Log the response for debugging
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + error);
                location.reload();
            }
        });
    }
}

	
</script>



