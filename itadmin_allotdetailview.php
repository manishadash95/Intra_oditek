 <?php 
	ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/ITAdminMgmt.php';
	$dbobj = new ITAdminMgmt();
	$dbobj->connect();
	
	//$session_rank = $_SESSION["admin_rank"];
	
	$readonly = "readonly";
	$disabled = "disabled";
	$emp_id = 	$_SESSION["emp_id"];
	
	$iv = $_REQUEST['iv'];
	$id = $_REQUEST['id'];
	$device = $_REQUEST['device'];
	$type = $_REQUEST['type'];
	$service = $_REQUEST['service'];
	$status = $_REQUEST['status'];
	$resoid = $_REQUEST['resoid'];
	
	//echo "#####".$status."##";
	//exit();
	$id_input = trim($dbobj->get_mcrypt_decrypt($id,$iv));
	$device_input = $eid = trim($dbobj->get_mcrypt_decrypt($device,$iv));
	$type_input = $eid = trim($dbobj->get_mcrypt_decrypt($type,$iv));
	//echo "ID::".$id_input."::".$device_input."::".$type_input;
	//exit();
	$device_view_page = "itadmin_allotdevice.php?device=".$device."&iv=".$iv."&service=".$service."&status=".$status."&resoid=".$resoid;
	
	$deviceInfo = $dbobj->getAllotDeviceDetails($id_input);
	
	$empList = $dbobj->getAllEmployeeListNameIT();
	
	$itreqList = $dbobj->getAllOpenITReq();
	
	$device = $dbobj->getLaptopDeviceInfo($tid);
	$device = $dbobj->getDesktopDeviceInfo($tid);
	$device = $dbobj->getMobileDeviceInfo($tid);
	$device = $dbobj->getOtherDeviceInfo($tid);
	
	
	
	
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
						<li class="active">Allot IT Device</li>
						
					</ol>

				</div>
			</div>
			
			<!-- /.col-lg-12 -->
		</div>
		<a href="<?php echo $device_view_page;?>" >
		<input type="button" class="btn btn-md btn-red " value="Back" style="height:30px; width:100px; padding:2px 5px; font-size:16px;margin-bottom:20px;">
		</a>
		
		<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4 style="font-size: 14px"><B> <?php echo $deviceInfo->type_str." [ ".$deviceInfo->tid." ]" ;?>   
									</h4>
								</div>
							
								<div class="clearfix"></div>
							</div>
							
							<div class="portlet-body">
							
							
							
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Device Type :</span>
							<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->type_str;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Service :</span>
							<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->service_str;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Status :</span>
							<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->status_str;?>" >
							</div>
							</div>
							
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Device Id :</span>
							<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->tid;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Manufacture :</span>
							<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->manifacture_str;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Model :</span>
							<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->model;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Assigned To :</span>
							<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->assignedTo;?>" >
							</div>
							</div>
							
							<div class="col-md-4">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Open IT Req. :</span>
							<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->openitreq;?>" >
							</div>
							</div>
							
		                    <div class="col-md-5">
							<div class="input-group bmargindiv1 col-md-12">
                            <span class="input-group-addon ndrftextwidth text-right">Info :</span>
                            <?php
                            if ($deviceInfo->type == 1 || $deviceInfo->type == 2) { // Desktop, Laptop
                            echo '<input readonly type="text" class="form-control" value="P:' . $deviceInfo->processor . ', HDD:' . $deviceInfo->hdd . ', RAM:' . $deviceInfo->ram . '" >';
                            }
	                        elseif ($deviceInfo->type == 3) { // Mobile
                            echo '<input readonly type="text" class="form-control" value="P:' . $deviceInfo->processor . ', Storage:' . $deviceInfo->storage . ', RAM:' . $deviceInfo->ram . '">';
                            } 
	                        elseif ($deviceInfo->type == 4) { // Other
                             echo '<input readonly type="text" class="form-control" value="Storage:' . $deviceInfo->storage . '">';
                           }
                           ?>
                          </div>




						  
						  
						 </div>
							
							
					<form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();" >
						<div id="SHOWDATA">
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<!--total_employee_div-->
									<div class="totalaligndiv">
																	
									<div class="col-md-12">
									<a href="javascript://" data-dismiss="modal" data-toggle="modal" data-target="#viewemployeelistdiv" >
									<input type="button" class="btn btn-md btn-blue1 " value="Update" style="height:30px; width:100px; padding:2px 5px; font-size:14px;margin-bottom:10px;" onClick="getUpdateInfo();" )>
									</a>
									<a href="javascript://" data-dismiss="modal" data-toggle="modal" data-target="#viewemployeeInfodiv" >
									<input type="button" class="btn btn-md btn-red " value="View Device Info" style="height:30px; width:120px; padding:2px 5px; font-size:14px;margin-bottom:10px;" )>
									</a>
									</div>
									
									<?php $cout=0; foreach($deviceInfo->dataArray as $data)
									{
										$cout++;
										$line_cnt = substr_count( trim($data->msg), "\n" );
										$line_cnt+=3;
										if($cout == 1)
											echo '<div class="col-md-12">';
										else 
											echo '<div class="col-md-12 toppadding">';										
									?>	
										
											<div class="input-group  col-md-12">
											<span class="input-group-addon ndrftextwidth text-left" style="border-left: 1px solid #CCCCCC;
											border-right: 1px solid #CCCCCC; font-size: 14px;" >
											<B><?php echo $data->status_log.' :: '.$data->emp_name?> on <?php echo $data->date_updated?> </B>
											</span>
											</div>
											<div class="input-group col-md-12">
											<textarea id="msgarea" disabled  rows="<?php echo $line_cnt;?>" class="form-control text-left" maxlength="1000" style="height=auto;margin: 0px -0.5px 0px 0px;resize: none;"><?php echo trim($data->msg); ?></textarea>
											
											</div>
											
											
									</div>
									
									<?php }	?>		
										
										<!--end_1st_div-->
										<!--2nd_div-->
										
										<!--end_2nd_div-->
										<!--3rd_div-->
										
										<!--end_3rd_div-->
										<div class="clearfix"></div>
									</div>
									<!--end_total_employee_div-->
									<!--login_informations_div-->
									
									
									
									<!--end_netpay_information_div-->
									
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						
							<input type="hidden" name="htid" id="htid" value="<?php echo $deviceInfo->tid; ?>">
							<input type="hidden" name="hstatus" id="hstatus" value="<?php echo $deviceInfo->status; ?>">
							
							
                        	
							</form>
						</div>
					</div>
					

				</div>
			</div>
		</div>

	</div>
	<!-- /.page-content -->

</div>



<div class="modal fade" id="viewemployeelistdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
  <form name="editfrmmess" id="editfrmmess" method="post">
    <div class="modal-content">
      
	  
	  <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title " id="myModalLabel">Update Device</h4>
      </div>
      
	  <div class="modal-body">
	  
	 
	   
	   
        <div class="totalaligndiv">
		
		<div class="col-md-4">											
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">Device Id :</span>
		<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->tid;?>" >
		</div>
		</div>

		<div class="col-md-4">											
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">Current Status :</span>
		<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->status_str;?>" >
		</div>
		</div>

		<div class="col-md-4">											
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">Current Service :</span>
		<input readonly type="text" class="form-control" value="<?php echo $deviceInfo->service_str;?>" >
		</div>
		</div>

		<div class="col-md-12" style="display: none" id="reso_name_block">
		<div class="input-group bmargindiv1 col-md-12" >
		<span class="input-group-addon ndrftextwidth text-right">Allocated To :</span>
		<input readonly id="allocate_id" name="allocate_id" type="text" class="form-control" value="<?php echo $deviceInfo->assignedTo;?>" >
		</div>
		</div>	

		
		<div class="col-md-4">											
		<div class="input-group bmargindiv1 col-md-12">
		<span class="input-group-addon ndrftextwidth text-right">Status :</span>
		<select id="status_id" name="status_id" class="form-control"  onChange="actionStatus();" >
		
		</select>
		</div>
		</div>
		
		<div class="col-md-12" style="display: none" id="reso_block">
		<div class="input-group bmargindiv1 col-md-12" >
		<span class="input-group-addon ndrftextwidth text-right">Select Resource :</span>
		<select id="reso_id" name="reso_id" class="form-control"  onChange="writeAllocateMsg()">
		<option value="0" >Select Resource</option>
		<?php foreach($empList as $emp){ 
		?>
		<option value="<?php echo $emp->eid; ?>" > [<?php echo $emp->eid; ?>]: <?php echo $emp->name; ?></option>
		<?php } ?>
		</select>
		</div>
		</div>
		
		<div class="col-md-12" style="display: none" id="itr_block">
		<div class="input-group bmargindiv1 col-md-12" >
		<span class="input-group-addon ndrftextwidth text-right">Select ITRequest. :</span>
		<select id="itr_id" name="itr_id" class="form-control"  onChange="writeITRMsg()">
		<option value="0" >Select IT Request</option>
		<?php foreach($itreqList as $itr){ 
		?>
		<option value="<?php echo $itr->sid; ?>" > <?php echo $itr->info; ?></option>
		<?php } ?>
		</select>
		</div>
		</div>
		
		
		
		<div class="col-md-12">
		<div class="input-group bmargindiv1 col-md-12">
		<span  class="input-group-addon ndrftextwidth text-right">Description :</span>
		<textarea id="text1" <?php echo $read;?> class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
		</div>
		</div>										
											
		
		
     			
      </div>
	  <div class="clearfix"></div>
      <div class="modal-footer">
	   <span style="font-size:14px; float:left" id="istatus">
         
          </span>
        <button type="button" class="btn btn-default" name="btnsubmit" onclick="checkAndAddData();" id="btnsubmit">Update</button> 
		
		<button type="button" class="btn btn-default btn-gray" data-dismiss="modal" onclick="resetSelection();" ><i class="fa fa-times"></i>CLOSE</button>
      </div>
	</div>
    </div>
	<input type="hidden" class="form-control"  id="messageid" name="messageid" value="">
	</form>
  </div>
</div>

							
<div class="modal fade" id="viewemployeeInfodiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form name="editfrmmess" id="editfrmmess" method="post">
      <div class="modal-content">
        
        
         <div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title" id="SHOWINFO">
									<h4 style="font-size: 14px"><B> <?php echo $deviceInfo->type_str." [ ".$deviceInfo->tid." ]" ;?>   
									</h4>
								</div>
							
								<div class="clearfix"></div>
							</div>
							
							<div class="portlet-body">
        </div>

        <div class="totalaligndiv">
        
          <?php foreach (['tid', 'hostname', 'manifacture_str', 'model', 'serial', 'express', 'dop', 'dow', 'processor', 'hdd', 'ram', 'ostype', 'osname'] as $field): ?>   <!-- Loop through each field and display only if it has a value -->
            <?php if (isset($deviceInfo->$field)): ?>
              <div class="col-md-12">
                <div class="input-group bmargindiv1 col-md-12">
                  <span class="input-group-addon ndrftextwidth text-right"><?= strtoupper(str_replace('_', ' ', $field)) ?>: </span>
                  <input readonly type="text" class="form-control" value="<?php echo $deviceInfo->$field; ?>" >
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>

        <div class="clearfix"></div>

       <div class="tpaddingdiv1 text-center">
                                               
												 <button type="submit" class="btn btn-red" id="btnsubmit">Ok</button>
								            </div>
      </div>
    </form>
  

<input type="hidden" class="form-control" id="messageid" name="messageid" value="">
								


<?php include 'include/footer.php' ?>
<script src="<?php echo ADMIN_SITE_URL;?>jsoditek/addemployee.js"></script>

<script>
window.onload = function(e){ 
	
}

function auto_scale(element)
{
	alert("element.scrollHeight:"+element.scrollHeight);
}


function checkValidation()
{
		var status_id = document.getElementById( 'status_id').value;
		var desc = document.getElementById('text1').value;
		var reso_id = document.getElementById('reso_id').value;
		var itr_id = document.getElementById('itr_id').value;
		
		if(status_id == 3 && reso_id == 0) // allocate
		{
			alert("Please select resource name...");
			return false;
		}
		if(status_id == 8 && itr_id == 0) // repaired
		{
			alert("Please select IT Request...");
			return false;
		}
		if(desc == "" )
		{
			alert("Please add Description...");
			return false;
		}
				
		
		return true;
}
	
function checkAndAddData()
{
		
		var ret = checkValidation();
		if(!ret)
			return false;
		
		var tid = document.getElementById( 'htid').value;
		var status_id = document.getElementById( 'status_id').value;
		var desc = document.getElementById('text1').value;
		var reso_id = document.getElementById('reso_id').value;
		var itr_id = document.getElementById('itr_id').value;
		
		
		var dataString = "action=updateDeviceStatus&tid="+tid+"&status="+status_id+"&reso_id="+reso_id+"&desc="+desc+"&itr_id="+itr_id;
		//alert("dataString:"+dataString);		
		$.ajax({ 
		type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
		success: function(html)
		{	 
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status==1)
			{
				window.location.reload();
			}
			else{
				
			}
		} 
	   });
	
					
	}
	


function resetSelection(){
		
	document.getElementById('text1').value="";
	document.getElementById('hfilecnt').value=0;
	document.getElementById( 'file'+1 ).textContent="";
	document.getElementById( 'file'+2 ).textContent="";
	document.getElementById( 'file'+3 ).textContent="";
	document.getElementById( 'remove'+1 ).style.display="none";
	document.getElementById( 'remove'+2 ).style.display="none";
	document.getElementById( 'remove'+3 ).style.display="none";
	document.getElementById('btnsubmit').disabled = false;
	document.getElementById('istatus').innerHTML= "";
	
	}

	



function getUpdateInfo()
{
	var tid = document.getElementById( 'htid').value;
	var status_id = document.getElementById( 'hstatus').value;
	var reso_name_block = document.getElementById( 'reso_name_block');
	
	if(status_id == 4) //Allocated
		reso_name_block.style.display = "block";
	else
		reso_name_block.style.display = "none";
	
	
	
	var dataString = "action=getDeviceUpdateStatus&tid="+tid;
	//alert("dataString:"+dataString);		
    $.ajax({ 
	type: "POST",url: "ajaxITAdmin.php" ,data: dataString,cache: false,
	success: function(html)
	{	 
		var dobj=jQuery.parseJSON(html);
		if(dobj.status==1)
		{
			$("#status_id").html(dobj.data);
	
		}
		else{
			
		}
	} 
  });
	
	
}

function actionStatus()
{
	var status_id = document.getElementById( 'status_id').value;
	var reso_block = document.getElementById( 'reso_block');
	var itr_block = document.getElementById( 'itr_block');
	var allocate_id = document.getElementById( 'allocate_id');
	
	reso_block.style.display = "none";
	itr_block.style.display = "none";
	
	if(status_id == 3) //Allocate
	{
		reso_block.style.display = "block";
	}
	else if(status_id == 8)
	{	
		itr_block.style.display  = "block";
	}
	
	if(status_id == 7)
	{
		var msg = "Deallocated Device from "+allocate_id.value;
		document.getElementById('text1').value= msg;
	}
	
	
}

function writeAllocateMsg()
{
	var reso_id = document.getElementById('reso_id');
	if(reso_id.value > 0)
	{
		var msg = "Allocated Device to "+reso_id.options[reso_id.selectedIndex].text;
		document.getElementById('text1').value= msg;
	}
	
}

function writeITRMsg()
{
	var itr_id = document.getElementById('itr_id');
	if(itr_id.value > 0)
	{
		var msg = itr_id.options[itr_id.selectedIndex].text;
		document.getElementById('text1').value= msg;
	}
	
}

	
messagestatus2(<?php echo $msg.$employeeid ?> );
</script>

