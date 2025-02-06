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
	$buheadData =$dbobj->getAllBUHead();
    
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
                                <li class="active">View BU Head</li>
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
                                    <h4> View BU Head</h4>
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
										            <col class="col-md-2 col-sm-2">
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
														<th class="center_td">Business Unit</th>
														<th class="center_td">Mobile</th>
                                                        <th class="center_td">Email</th>
                                                    	<th class="center_td">Report To</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                  $i=1;
                                                  foreach($buheadData as $rankval)
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
                                                        <td class="center_td" ><?php echo $rankval->bu_head_name ?></td>
                                                        <td class="center_td" ><?php echo $rankval->bu_name ?></td>
														<td class="center_td"><?php echo $rankval->mobile ?></td>
                                                        <td class="center_td"><?php echo $rankval->office_email ?></td>
														<td class="center_td"><?php echo $rankval->reportTo ?></td>
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

