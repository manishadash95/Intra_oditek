<?php 
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	$dbobj = new DBConnection();
	$dbobj->connect();
	$rankforceno = $dbobj->getForceno();
	
	$forceno = $_SESSION["forceno"];
	
	if(isset($_POST['btnsubmit']))
	{
		$newMessobj->usertype =$_POST['usertype'];
		$newMessobj->fnumber =$_POST['fnumber'];
		$newMessobj->message =$_POST['message'];
		$result = $dbobj->saveMessage($newMessobj);		
		if($result == 1)
			$msg = '<div style="color:#16a085; text-align:center; padding-bottom:10px;">Data Inserted Successfully</div>';
		else
			$msg = '<div style="color:#FF0000; text-align:center; padding-bottom:10px;">Unable to Update</div>'; 
	}
	
	if(isset($_POST['edtsubmit']))
	{
		$editMessobj->message =$_POST['message'];
		$editMessobj->id =$_POST['messageid'];
		$result = $dbobj->updateMessage($editMessobj);		
		if($result == 1)
			$msg = '<div style="color:#16a085; text-align:center; padding-bottom:10px;">Data Updated Successfully</div>';
		else
			$msg = '<div style="color:#FF0000; text-align:center; padding-bottom:10px;">Unable to Update</div>'; 
	}

	$page = (int) $_GET['page'];
	if ($page < 1) $page = 1;
	$recordsperpage=10;
	$noofpagelinks=5;
	$startResults = ($page - 1) * $recordsperpage;
	$totalRecords=mysql_num_rows(mysql_query("select * from ".PREFIX."message GROUP BY messageid ORDER BY id DESC "));
	$showmessage = $dbobj->getMessageByForceNo($startResults, $recordsperpage,$forceno);
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
                                <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                </li>
                                <li class="active">Alert Message</li>
                            </ol>

                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="clearfix"></div>
               	<!--end_search_field_div-->
				<?php echo $msg;?>
                <!-- /.row -->
               <form name="frmmessage" id="frmmessage" method="post">
                <div class="row">
                  
                  <div class="clearfix"></div>
                </div> <!-- end_row_div -->
                </form>
                
                <!--row_div-->
                
                <div class="row">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> Message List</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#employeeliststatus"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="employeeliststatus" class="panel-collapse collapse in">
                            	<div class="portlet-body">
                                	<!--total_left_side_div-->

                                    <div class="totalaligndiv" id="SHOWMESSLIST">
										<div class="tpaddingdiv3">
                                            <div class="bs-docs-example table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-md-1 col-sm-1">
                                                    <col class="col-md-3 col-sm-3">
                                                    <col class="col-md-2 col-sm-2">
                                                    <col class="col-md-7 col-sm-7">
                                                    <col class="col-md-2 col-sm-2">
                                        
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th>Sl. No.</th>
                                                        <th>Date / Time</th>
                                                        <th>Type</th>
                                                        <th>Message</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												$slno=1;
												if($size=sizeof($showmessage)>0)
												{
													foreach($showmessage as $val)
													{
														 
												?>
                                                    <tr class="success">
                                                        <td><?php echo $slno ?></td>
                                                        <td><?php echo $val->date_added ?></td>
                                                        <td><?php echo $val->usertype ?></td>
                                                        <td><?php echo $val->message ?></td>
                                                        
											<?php 
												$slno++;
												} 
											}
											?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tpaddingdiv1 bordertopgraydiv">
											<ul class="pagination pull-right margintopzerodiv">
												 <?php echo ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks);?>
											</ul>  
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
        
<!--view_employee_details_div-->
<div class="modal fade" id="viewemployeelistdiv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
  <form name="editfrmmess" id="editfrmmess" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel">Edit Message</h3>
      </div>
      <div class="modal-body">
        <div class="totalaligndiv">
			<div class="col-md-12 vertsizetextarea">
				<div class="input-group bmargindiv1 col-md-12"> <span class="input-group-addon ndrftextwidth text-left">Message :</span>
					<textarea id="editmessage" class="form-control" maxlength="250" rows="2" name="message" style="margin: 0px -0.5px 0px 0px; height: 150px;"></textarea>
				</div>
			</div>						
        </div>			
      </div>
	  <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" name="edtsubmit" id="edtsubmit">Update</button> <button type="button" class="btn btn-default btn-gray" data-dismiss="modal"><i class="fa fa-times"></i>CLOSE</button>
      </div>
    </div>
	<input type="hidden" class="form-control"  id="messageid" name="messageid" value="">
	</form>
  </div>
</div>
<!--end_view_employee_details_div-->
        
<?php include 'include/footer.php' ?>
