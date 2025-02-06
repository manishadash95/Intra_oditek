<?php 

    ini_set("display_errors",1);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
		
	$dbobj = new DBConnection();
	$dbobj->connect();
	$read="";
	if($eid == 1001)
		$empList = $dbobj->getAllEmployeeListName();
	else
		$empList = $dbobj->getAllEmployeeListNameHR();
	
$bnk_Array = $dbobj->getAllBankinfo();
	
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
                               <li class="active">BANK INFORMATION</li>
                            </ol>

                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
               
                <div class="clearfix"></div>
               	<!--end_search_field_div-->
				<?php
				//echo $msg;
				?>
                <!-- /.row -->
               <form name="myformdata" id="myformdata" method="post" enctype="multipart/form-data"  >
                <div class="row" id="load_subadmin">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> BANK INFO</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#manageadmin"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="manageadmin" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->
                                    <div class="totalaligndiv">
									
									
									
									<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Select Resource :</span>
													<select id="name" name="name" class="form-control chosen-select"  >
									<option value="0" >Select Resource</option>
									<?php foreach($empList as $emp){ 
									?>
									<option value="<?php echo $emp->eid; ?>" > [<?php echo $emp->eid; ?>]: <?php echo $emp->name; ?></option>
									<?php } ?>
									</select>	
                                            </div>
                                           
                                    </div>
											
										<div class="col-md-6">
										<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-left">IFSC Code :</span>
											<input type="text" id="ifc" name="ifc" class="form-control" onChange="checkBankInfo()">
											<span class="input-group-addon ndrftextwidth text-center" style="cursor: pointer" onClick="getBankInfo()">Get</span>
										</div>
									</div>

								
									<div class="col-md-6" id="bank-info" style="display: none;">
										<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-left">Bank :</span>
											<input type="text" id="bnk" name="bnk" class="form-control">
										</div>
									</div>

									<div class="col-md-6" id="branch-info" style="display: none;">
										<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-left">Branch :</span>
											<input type="text" id="branch" name="branch" class="form-control">
										</div>
									</div>

								
									<div class="col-md-6" id="address-info" style="display: none;">
										<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-left">Address :</span>
											<input type="text" id="adr" name="adr" class="form-control">
										</div>
									</div>

									<div class="col-md-6" id="micr-info" style="display: none;">
										<div class="input-group bmargindiv1 col-md-12">
											<span class="input-group-addon ndrftextwidth text-left">MICR :</span>
											<input type="text" id="mic" name="mic" class="form-control">
										</div>
									</div>
									<Div class="col-md-6">
									<div class="input-group bmargindiv1 col-md-12">
										<span class="input-group-addon ndrftextwidth text-left">Account No :</span>
											<input type="text" id="acn" name="acn" class="form-control">
												</div>
											</div>
														
										
										 <div class="clearfix"></div>
										  
										
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="tpaddingdiv1 text-center">
                                                <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return actionBankInfo()">Save</button>
											
								            </div>
											
                                        </div>
                                        <div class="clearfix"></div>
										<input type="hidden" name="hidaddedit" id="hidaddedit" value="add" />
										<input type="hidden" name="hideditid" id="hideditid" value="" />
										
                                    </div>
                                
				  <div class="clearfix"></div>
                </div> <!-- end_row_div -->
                </form>
				
				<!--row_div-->
            </div>
            <!-- /.page-content -->
        </div>
        	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> BANKING</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#employeeliststatus"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

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
													<col class="col-md-1 col-sm-1">
													
											    </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th class="center_td">Sl No</th>
												       <th class="center_td">Name</th>
														<th class="center_td">Bank</th>
														<th class="center_td">Account</th>
														<th class="center_td">IFSC</th>
									
														<th class="center_td">Action</th>
														
                                                    </tr>
                                                </thead>
                                                <tbody id="PROLISTDISPLAYID" class="tablefont" >
												
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											 
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    </div>
                                    <!--end_total_left_side_div-->
                                </div>
                            </div>                            
                        </div>
                    <!--end_left_div-->
<!--view_employee_details_div-->

 

<?php include 'include/footer.php' ?>
<script>



function checkBankInfo() {
    document.getElementById("bank-info").style.display = "none";
    document.getElementById("branch-info").style.display = "none";
    document.getElementById("address-info").style.display = "none";
    document.getElementById("micr-info").style.display = "none";
}

// Fetch bank details using the IFSC API
function getBankInfo() {
    var ifc = document.getElementById("ifc").value;

    if (ifc.length == 0) {
        alert("Please enter the IFSC code.");
        return;
    }

    $.ajax({
        type: "GET",
        url: "https://ifsc.razorpay.com/" + ifc,   // Call IFSC API
        success: function(response) {
            if (response.BANK) {
                // Fill in the retrieved details
                document.getElementById("bnk").value = response.BANK;
                document.getElementById("branch").value = response.BRANCH;
                document.getElementById("adr").value = response.ADDRESS;
                document.getElementById("mic").value = response.MICR;

                // Show bank-related fields
                document.getElementById("bank-info").style.display = "block";
                document.getElementById("branch-info").style.display = "block";
                document.getElementById("address-info").style.display = "block";
                document.getElementById("micr-info").style.display = "block";
            } else {
                alert("Invalid IFSC code. Please try again.");
            }
        },
        error: function() {
            alert("Error fetching IFSC details. Please try again later.");
        }
    });
}

function checkValidation() {
    var name = document.getElementById('name').value;
    var bnk = document.getElementById('bnk').value;
    var acn = document.getElementById('acn').value;
    var ifc = document.getElementById('ifc').value;
    var branch = document.getElementById('branch').value;
   var	adr = document.getElementById('adr').value;
   var mic = document.getElementById('mic').value;
    if (name == 0) {
        alert("Enter name...");
        return false;
    }

   

    if (acn.length == 0) {
        alert("Enter account no...");
        return false;
    }

    var reg = /^[A-Za-z]{4}[0-9]{6,7}$/;
    if (ifc.length == 0) {
        alert("Enter IFSC code...");
        return false;
    } else if (!reg.test(ifc)) {
        alert("Invalid IFSC code. It should be 11 characters long, starting with 4 letters, followed by '0', and ending with 6 alphanumeric characters.");
        return false;
    }

    return true;
}

function actionBankInfo(){

	var ret = checkValidation();
	if(!ret)
		return false;
	
	var action_type = document.getElementById("hidaddedit").value;
	
	if(action_type == "add")
	{
		var dataString = "action=BankInfo&";
		dataString +=$( "#myformdata" ).serialize();
		//alert("dataString:"+dataString);
		
		$.ajax({ 
			type: "POST",url: "ajaxproject.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				alert(dobj.msg);
				if(dobj.status==1)
				{
				 location.reload();	
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
	}else if(action_type == "edit")
	{
		
		//document.getElementById('loading_data').style.display="block";
		var dataString = "action=updateBankInfo&";
		dataString +=$( "#myformdata" ).serialize();
		//alert("dataString:"+dataString);
		
		$.ajax({ 
			type: "POST",url: "ajaxproject.php" ,data: dataString,cache: false,
			success: function(html)
			{	 
				var dobj=jQuery.parseJSON(html);
				alert(dobj.msg);
				if(dobj.status==1)
				{
					 location.reload();
				}
				//document.getElementById('loading_data').style.display="none";
			} 
		});
		
	}
	
}



function loadBankGroup() {
        var name = document.getElementById('name').value;
        var bnk = document.getElementById('bnk').value;
        var acn = document.getElementById('acn').value;
        var ifc = document.getElementById('ifc').value;

        var dataString = "action=loadBankGroup&name=" + name + "&bnk=" + bnk + "&acn=" + acn;
        $.ajax({
            type: "POST",
            url: "ajaxproject.php",
            data: dataString,
            cache: false,
            success: function(html) {
                var dobj = jQuery.parseJSON(html);
                if (dobj.status == 1) {
                    $("#PROLISTDISPLAYID").html(dobj.data);
                }
            }
        });
    }

    window.onload = function() {
        loadBankGroup();
    };


function showdEdit(emp_id, bnk_id, acn, ifc, id) {
    console.log("Editing data:", { emp_id, bnk_id, acn, ifc });
    
    // Set hidden fields for edit operation
    document.getElementById("hidaddedit").value = "edit";
	 document.getElementById("hideditid").value = id;
  $("#btnsubmit").html("Update");
    // Loop through options in the employee dropdown (id="name")
    let select = document.getElementById("name");
    for (let i = 0; i < select.options.length; i++) {
        if (select.options[i].value == emp_id) {  // Match emp_id with the option's value
            select.options[i].selected = true;    // Set the selected option
            break;  // Exit loop after finding the match
        }
    }

    // Update the Chosen dropdown if using the Chosen plugin
    $('.chosen-select').trigger("chosen:updated");

    // Set the other fields (bank, account number, IFSC)
    document.getElementById("bnk").value = bnk_id;
    document.getElementById("acn").value = acn;
    document.getElementById("ifc").value = ifc;

    return false; // Prevent form submission
}



</script>
