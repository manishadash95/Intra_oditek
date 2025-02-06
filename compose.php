<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	
	$page = (int) $_GET['page'];
	if ($page < 1) $page = 1;
		$recordsperpage=100;
	$noofpagelinks=10;
	$startResults = ($page - 1) * $recordsperpage;
	$totalRecords=mysql_num_rows(mysql_query("select * from ".PREFIX1."employee where status='Present' order by id desc"));
	
    $rankemployee =$dbobj->getEmployee(0 , 0, "1", $startResults, $recordsperpage);
    
	$rank_array=$dbobj->getDesignation();
	$dept_array=$dbobj->getDepartment();
	$iv_key = $dbobj->get_mcrypt_iv();

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
                                <li><i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                                </li>
                                <li class="active">View Employee</li>
                            </ol>

                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE AREA -->
               
			   <!--main_heading_div-->
                <!--row_div-->
                <div class="row">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> View Employee</h4>
                                </div>
                                
                               
                                
                                
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#viewemployeedetails"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            
                           
                                        
                                        
                            <div id="viewemployeedetails" class="panel-collapse collapse in">
                            	<div class="portlet-body" id="showEmployee">
                                	<!--total_left_side_div-->
									 
									 
                                    <div class="totalaligndiv">
									  
                                     <div class="bpaddingdiv1 bordertopgraydiv">
										 <div class="text-right"><?php echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?></div>
										 <div class="clearfix"></div>
                                     </div>
                                     
									
                                    
                                        <div class="clearfix"></div>
										<div class="tpaddingdiv1">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped" align="center">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-2 col-sm-2">
													<col class="col-md-2 col-sm-2">
                                                    <col class="col-md-3 col-sm-3">
                                                    <col class="col-md-1 col-sm-1">
                                                </colgroup>
                                                <thead>
                                                	<tr>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;
                                                        </th>
                                                        <th>&nbsp;</th>
                                                        <th>
                                                        
                                                        </th>
                                                        <th>
                                                        
                                                        
                                                        </th>
                                                        <th>
                                                        &nbsp;
														</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="center_td">SL</th>
                                                        <th class="center_td">Image</th>
                                                        <th class="center_td">Name</th>
                                                        <th class="center_td">Designation</th>
                                                        <th class="center_td">Department</th>
														<th class="center_td">Mobile</th>
                                                        <th class="center_td">Email</th>
                                                        <th class="center_td">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                  $i=1;
                                                  foreach($rankemployee as $rankval)
												  {
                                                 	  
                                                     ?>
                                                    <tr class="success" >
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
                                                        <td class="center_td" ><?php echo $rankval->name ?></td>
                                                        <td class="center_td" ><?php echo $rankval->desig ?></td>
                                                        <td class="center_td"><?php echo $rankval->dept ?></td>
														<td class="center_td"><?php echo $rankval->mobile ?></td>
														<td class="center_td"><?php echo $rankval->office_email?></td>
                                                        
                                                        <td class="tooltip-sidebar-logout center_td">
														<?php 
															$encrypt_id = $dbobj->get_mcrypt_encrypt($rankval->eid,$iv_key);
														?>
														<a href="employeedetail.php?eid=<?php echo $encrypt_id."&iv=".$iv_key; ?> " >
														<input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px">
														</a>
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
                                    <!--end_total_left_side_div-->
									
                                </div>
                            </div>                            
                        </div>
                    <!--end_left_div-->
                  </div>
                  <div class="clearfix"></div>
                </div> <!--end_row_div-->
                
            </div>
            <!-- /.page-content -->

        </div>
		
    <!--view_employee_div-->
    <div class="modal fade" id="viewemployeedetailsdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              
            <h3 class="modal-title" id="myModalLabel">View Employee</h3>
          </div>
          <div class="modal-body">
			<div class="totalaligndiv">
                <!--1st_div-->
                <div class="col-md-6">
                  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Sl. No :</span>
                    <input type="text" readonly class="form-control bgcolorwhitediv" placeholder="Sl. No" name="slno" id="slno" value=""> 
                  </div>
                  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">IRLA/Force No :</span>
                    <input type="text" readonly class="form-control bgcolorwhitediv" placeholder="IRLA/Force No" name="forceno" id="forceno"  value="">
                  </div>
                  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Name :</span>
                    <input type="text" readonly class="form-control bgcolorwhitediv" placeholder="Name" name="name" id="name">
                  </div>
                  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Rank :</span>
                    <input type="text" readonly class="form-control bgcolorwhitediv" placeholder="Rank" name="rank" id="rank">
                  </div>
                  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">DOB :</span>
                    <input type="text" readonly class="form-control bgcolorwhitediv" placeholder="Date of Birth" name="dob" id="dob">
                  </div>
                </div>
                <!--end_1st_div-->
                <!--2nd_div-->
                <div class="col-md-6">
                  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Pan No :</span>
                    <input type="text" readonly class="form-control bgcolorwhitediv" placeholder="Pan No" id="panno" name="panno">
                  </div>
                  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Mobile No :</span>
                    <input type="text" readonly class="form-control bgcolorwhitediv" placeholder="Mobile No" name="mobileno" id="mobileno" >
                  </div>
                  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Force Joining :</span>
                    <input type="text" readonly class="form-control bgcolorwhitediv" placeholder="Force Joining" name="fjoin" id="fjoin">
                  </div>
                  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">NDRF Joining :</span>
                    <input type="text" readonly class="form-control bgcolorwhitediv" placeholder="NDRF Joining" name="ndrfjoin" id="ndrfjoin">
                  </div>
                  <div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">10th Btn. Joining :</span>
                    <input type="text" readonly class="form-control bgcolorwhitediv" placeholder="10th Btn. Joining" name="btjoin" id="btjoin">
                  </div>
                </div>
                <!--end_2nd_div-->
                <div class="clearfix"></div>
             </div>	  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-gray" data-dismiss="modal"><i class="fa fa-times"></i>CLOSE</button>
          </div>
        </div>
      </div>
    </div>
    <!--end_view_employee_div-->

<input type="hidden"  name="hidpage" id="hidpage" value="1">
	 
<?php include 'include/footer.php' ?>

<script>

function ajaxpagination(page)
{
	document.getElementById("hidpage").value=page;
	dv = document.getElementById('showEmployee');
	//alert("::"+page);
	var status=$("#status").val();
	var rank=$("#rank_id").val();
	var coy=$("#coy_id").val();
	$("#showEmployee").load("ajaxforce.php?status="+status+"&rkid="+rank+"&coy="+coy+"&page="+page);
}

function showDept(par)      
{
	var rank=$("#rank_id").val();
	dv = document.getElementById('showEmployee');
	$("#showEmployee").load("ajaxforce.php?status="+status+"&rkid="+rank+"&deptid="+par);
}
	
	
</script>

