<?php
include 'include/init.php';
include_once 'dbcon/DBConnection.php';
include 'include/pagination.php';
$dbobj = new DBConnection();
$dbobj->connect();
$rkid = $_GET['rkid'];
$deptid = $_GET['deptid'];
$status = $_GET['status'];
$emptype = $_GET['emptype'];
$page = (int) $_GET['page'];

if ($page < 1) 
	$page = 1;

$recordsperpage=100;
$noofpagelinks=10;
$startResults = ($page - 1) * $recordsperpage;

$Chkrkid = ($rkid != '0')?"and desig_id='".$rkid."'":"";
$Chkcoyid = ($deptid != '0')?"and dept_id='".$deptid."'":"";
$Chkstatus = ($status != '0')?"and status='".$status."'":"";
		
		
$totalRecords=mysql_num_rows(mysql_query("select * from ".PREFIX1."employee where eid > 0  ".$Chkrkid."  ".$Chkcoyid."   ".$Chkstatus." order by id desc"));

$rankemployee =$dbobj->getEmployee_hr($rkid, $deptid , $status, $emptype ,$startResults, $recordsperpage);

$rank_array=$dbobj->getDesignation();
$dept_array=$dbobj->getDepartment();

?>

 <div class="col-lg-12">
										<div class="bpaddingdiv1 text-center">
										<input type="button" name="register" id="register" class="btn btn-red btn" value="Download" onClick="generateEmployeeData()" >
										</div>
									</div>
									
<div class="totalaligndiv">

				<div class="bpaddingdiv1 bordertopgraydiv">
				<div class="text-right"><?php echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?></div>
				<div class="clearfix"></div>
                </div>
                                     
     <div class="clearfix"></div>                         
	<div class="tpaddingdiv1">
		<div class="bs-docs-example table-responsive">
		<table class="table table-bordered table-striped">
			<colgroup>
				                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-1">
													<col class="col-md-1 col-sm-1">
                                                    <col class="col-md-3 col-sm-3">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-1 col-sm-1">
			</colgroup>
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th>
					<select class="form-control"  style="width:200px; padding-left:0px; padding-right:0px;" id="rank_id" name="rank_id" onchange="showRank(this.value)">
						<option value="0">All Designation</option>
						 <?php
						foreach( $rank_array as $val)
						{
							$selected = ($val->id == $rkid)?'selected':'';
							echo '<option value="'.$val->id.'" '.$selected.'>'.$val->name.'</option>';
						}			
					?>	
					</select>
					</th>
                     <th>
                     <select class="form-control"  style="width:200px; padding-left:0px; padding-right:0px;" id="dept_id" name="dept_id" onchange="showDept(this.value)">
                     <option selected value="0"  > All Department </option>
                      <?php
						foreach( $dept_array as $val)
						{
							$selected = ($val->id == $deptid)?'selected':'';
							echo '<option value="'.$val->id.'" '.$selected.'>'.$val->name.'</option>';
						}			
					?>								
					 </select>
                     </th>
                     <th>
						<select class="form-control" style="width:100%; padding-left:0px; padding-right:0px;" id="emptype" name="emptype" onchange="showEmpType(this.value)">
							<option value="0">All</option>
							<option value="1" <?php echo ($emptype == 1)?'selected':''?>>Permanent</option>
							<option value="2" <?php echo ($emptype == 2)?'selected':''?>>Probation</option>
							<option value="3" <?php echo ($emptype == 3)?'selected':''?>>Contractual</option>
						</select>
					</th>
					<th>
						<select class="form-control" style="width:100%; padding-left:0px; padding-right:0px;" id="status" name="status" onchange="showStatus(this.value)">
							<option value="0">All</option>
							<option value="1" <?php echo ($status == 1)?'selected':''?>>Present</option>
							<option value="2" <?php echo ($status == 2)?'selected':''?>>Left</option>
							<option value="3" <?php echo ($status == 3)?'selected':''?>>With Held</option>
						</select>
					</th>
					<th>&nbsp;</th>
				</tr>
				<tr>
                                                        <th class="center_td">Sl. No.</th>
														<th class="center_td">Image</th>
                                                        <th class="center_td">Employee Id</th>
                                                        <th class="center_td">Name</th>
                                                        <th class="center_td">Designation</th>
                                                        <th class="center_td">Department</th>
														<th class="center_td">Type</th>
                                                        <th class="center_td">Status</th>
                                                        <th class="center_td">Action</th>
                                                    </tr>
			</thead>
			<tbody>
				<?php
				 $i=1 + ($page - 1)*$recordsperpage;
			  foreach($rankemployee as $rankval)
			  {
				  
				 ?>
				<tr class="success">
                                                        <td class="center_td"><?php echo $i ?></td>
														<td class="center_td" >
														<div class="employeeimage" align="center">
														<?php
														$image = $dbobj->getImage($rankval->eid);
														 if(strlen($image)  > 0) {
															echo '<img class="img-circle" src="'.$image.'" alt="">';
															}
														else{ 
														?>
															<img class="img-circle" src="img/profile-pic-blank.png" alt="">
														<?php } ?>
														</div>
														</td>
                                                        <td class="center_td"><?php echo $rankval->eid; ?></td>
                                                        <td class="center_td"><?php echo $rankval->name ?></td>
                                                        <td class="center_td"><?php echo $rankval->desig ?></td>
                                                        <td class="center_td"><?php echo $rankval->dept ?></td>
														<td class="center_td"><?php echo $rankval->emptype?></td>
														<td class="center_td"><?php echo $rankval->status_str?></td>
                                                        
                                                        <td class="tooltip-sidebar-logout">
														<?php if($rankval->type == 2){ ?>
														<a href="employeedetail.php?eid=<?php echo $rankval->eid; ?> " >
														<input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px">
														</a>
														<?php }else{ ?>
														<a href="directordetail.php?ret=2&did=<?php echo $rankval->eid; ?> " >
														<input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px">
														</a>
														<?php } ?>
														
														</td>
                                                    </tr>
			   <?php 
					 $i++;
			  } 
				?>
			</tbody>
		</table>
		
		<div class="bpaddingdiv1 bordertopgraydiv">
		<div class="text-right"><?php echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?></div>
		<div class="clearfix"></div>
        </div>
									 
	</div>
	<div class="tpaddingdiv1 bordertopgraydiv">
		
		<div class="clear-both"></div>
	</div>
</div>
</div>



