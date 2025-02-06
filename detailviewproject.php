<?php
    ini_set("display_errors", 0);
    error_reporting(E_ALL);
    include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
    $id = $_REQUEST['id'];
	$iv = $_REQUEST['iv'];
   
    $id = $dbobj->get_mcrypt_decrypt($id, $iv);
     $empData = $dbobj->getEmployeeData($eid);
	$emp_eid = $eid;
   
    $serviceObj = $dbobj->getProjectDetails($id);
	$empList = $dbobj->getAllActiveEmployeeListName();
?>
<?php include 'include/header.php'; ?>
<?php include 'include/leftsidebar.php'; ?>
<?php include 'imageupload/popimageupload.php'; ?>
<div id="page-wrapper">
    <div class="page-content">
        <!-- begin PAGE TITLE AREA -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="active">Project Details</li>
                    </ol>
                </div>
            </div>
        </div>
        <a href="createprojectgroup.php">
            <input type="button" class="btn btn-md btn-red" value="Back" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
        </a>
        <?php echo $msg1111; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title" id="SHOWINFO">
                                    <h4 style="font-size: 14px"><b>Created on <?php echo $serviceObj->date; ?></b></h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="portlet-body">
                                <div class="col-md-6">                                            
                                    <div class="input-group bmargindiv1 col-md-12">
                                        <span class="input-group-addon ndrftextwidth text-right">Grp-Name :</span>
                                        <input readonly type="text" class="form-control" value="<?php echo $serviceObj->pr_name; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">                                            
                                    <div class="input-group bmargindiv1 col-md-12">
                                        <span class="input-group-addon ndrftextwidth text-right">Prm-Name :</span>
                                        <input readonly type="text" class="form-control" value="<?php echo $serviceObj->eid; ?>">
                                    </div>
                                </div>
							<div class="col-md-12 text-center"> <!-- Centering the button -->
					<a href="javascript://" data-dismiss="modal" data-toggle="modal" data-target="#viewemployeelistdiv">
						<input type="button" class="btn btn-md btn-blue1" value="Update" style="height:30px; width:100px; padding:2px 5px; font-size:14px;margin-bottom:10px;">
					</a>
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
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-4 col-sm-4">
													<col class="col-md-3 col-sm-3">
													<col class="col-md-2 col-sm-2">
                                                 	
									              </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>Emp Id</th>
														<th>Emp<BR>Name</th>
														<th>Designation</th>
														<th>Department</th>
		                                              	<th>Remove</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody id="PROLISTDISPLAYID" class="tablefont" >
												
                                                </tbody>
                                            </table>
                                        </div>
                                       
                                    </div>
                                    </div>
                                   
                                </div>
                            </div>                            
                        </div>
                    <!--end_left_div-->
                  </div>		
				
								
								<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						       <div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
																	
									
									
									<?php $cout=0; foreach($serviceObj->dataArray as $data)
									{
										$cout++;
										$line_cnt = substr_count( trim($data->msg), "\n" );
										$line_cnt+=3;
										if($cout == 1)
											echo '<div class="col-md-12">';
										else 
											echo '<div class="col-md-12 toppadding">';										
									?>	
										
											
											
											<?php if($data->attachment > 0){ ?>
											<div class="input-group  col-md-12">
											<span class="input-group-addon ndrftextwidth text-left" style="border-left: 1px solid #CCCCCC;
											border-right: 1px solid #CCCCCC;" >
											<img src="img/attach2.png" width="20" height="20" alt=""  />
											<?php if(strlen($data->file1) > 0){ ?>
											<span style="cursor:pointer;" onClick="downloadFile(<?php echo $sid.",".$data->dataid.",'".$data->file1."'"?> )" >
											<B><?php echo $data->file1; ?> </B>
											</span>
											<?php }	?>											
											
											<?php if(strlen($data->file3) > 0){ ?>
											
											<?php }	?>
											
											</span>
											</div>
											
											<?php }	?>
											
									</div>
									
									<?php }	?>		
									
										<div class="clearfix"></div>
									</div>
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                        	
							</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
</div>
<div class="modal fade" id="viewemployeelistdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <form name="editfrmmess" id="editfrmmess" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Update Project Group </h4>
        </div>
        <div class="modal-body">
          <div class="portlet-body">
            <div class="col-md-6">											
              <div class="input-group bmargindiv1 col-md-12">
                <span class="input-group-addon ndrftextwidth text-right">Grp-Name :</span>
                <!-- Added an input field for grp_name -->
                <input type="text" class="form-control" id="grp_name" value="<?php echo $serviceObj->pr_name; ?>">
              </div>
            </div>
            <div class="col-md-6">											
              <div class="input-group bmargindiv1 col-md-12">
                <span class="input-group-addon ndrftextwidth text-right">Prm-Name :</span>
                <select id="reso_id" name="reso_id" class="form-control">
                  <option value="0">All Select</option>
                  <?php
                  foreach ($empList as $emp) {
                    if ($serviceObj->pr_head ==  $emp->eid)
                      echo '<option selected value="' . $emp->eid . '">' . $emp->name . '</option>';
                    else
                      echo '<option value="' . $emp->eid . '">' . $emp->name . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
			 <input type="hidden" name="hid" id="hid" value="<?php echo $id;?>">
             <input type="hidden" name="heid" id="heid"  value="<?php echo $emp_eid;?>">
            <div class="clearfix"></div>
            <div class="modal-footer">
              <span style="font-size:14px; float:left" id="istatus"></span>
              <button type="button" class="btn btn-default" name="btnsubmit" onclick="UpdateProjectGroup();" id="btnsubmit">Update</button> 
              <button type="button" class="btn btn-default btn-gray" data-dismiss="modal" onclick="resetSelection();"><i class="fa fa-times"></i>CLOSE</button>
            </div>
          </div>
        </div>
        </div>
    </form>
  </div>
</div>

<?php include 'include/footer.php'; ?>

<script>
window.onload = function() {
 loadUpdateGroup();
};

  function UpdateProjectGroup() {
    var grp_name = document.getElementById('grp_name').value;
    var reso_id = document.getElementById('reso_id').value;
    var id = document.getElementById('hid').value; // Retrieve the id value
    
    var dataString = "action=UpdateProjectGroup&grp_name=" + grp_name + "&reso_id=" + reso_id + "&id=" + id; 
    
    $.ajax({ 
        type: "POST",
        url: "ajaxprojectemployee.php",
        data: dataString,
        cache: false,
        success: function(html) {    
            var dobj = jQuery.parseJSON(html);
            alert(dobj.msg);
            if (dobj.status == 1) {
                // Reload the page after successful update
                location.reload();
            } else {
                // Handle failure
            }
        } 
    });
}

function loadUpdateGroup() {
    var grp_name = document.getElementById('grp_name').value;
    var reso_id = document.getElementById('reso_id').value;
    var pro_grp_id = document.getElementById('hid').value;

    var dataString = "action=loadUpdateGroup&grp_name=" + grp_name + "&reso_id=" + reso_id+"&pro_grp_id="+pro_grp_id;
    alert(dataString);
    $.ajax({
        type: "POST",
        url: "ajaxprojectemployee.php",
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


</script>