	<div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
				
							<div class="portlet portlet-green">
							<div class="portlet-heading">
								<div class="portlet-title">
									<h4><i class="fa fa-exchange fa-fw"></i> Daily Report Summary</h4>
								</div>
								<div class="portlet-widgets">
									<a data-toggle="collapse" data-parent="#accordion" href="#transactionsPortlet"><i class="fa fa-chevron-down"></i></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div id="transactionsPortlet" class="panel-collapse collapse in">
								<div class="portlet-body">
									<div class="table-responsive dashboard-demo-table">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Sl. No</th>
                                                    <th>Date</th>
													<th>Day</th>
                                                    <th>IN Time</th>
													<th>OUT Time</th>
													<th>Actual Work Time</th>
													<th>Actual Effort</th>
													<th>View</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
											$i=0;
											foreach($summaryData as $value)
											{
												$i++;
												$color="";
												if($value->holiday)
													$color="red";	
											?>
												<tr>
													<td style="color:<?php echo $color?>;"><?php echo $i ?></td>
                                                    <td style="color:<?php echo $color?>;"><?php echo $value->work_date ?></td>
                                                    <td style="color:<?php echo $color?>;"><?php echo $value->day ?></td>
													<td style="color:<?php echo $color?>;"><?php echo $value->start_time ?></td>
													<td style="color:<?php echo $color?>;"><?php echo $value->end_time ?></td>
													<td style="color:<?php echo $color?>;"><?php echo $value->work_time ?></td>
													<td style="color:<?php echo $color?>;"><?php echo $value->total_time ?></td>
													<td style="color:<?php echo $color?>;" class="tooltip-sidebar-logout">
													<?php 
															$encrypt_id = $dbobj->get_mcrypt_encrypt($value->work_date,$iv_key);
													?>
													<a href="mydailyhrreport.php?dt=<?php echo $encrypt_id."&iv=".$iv_key; ?> " >
													<input type="button" class="btn btn-md btn-green" value="View" style="height:20px;width:50px; padding:1px 5px; font-size:12px">
													</a>
													</td>
												</td>
                                             <?php
											}
											 ?>
												</tr>
												
											</tbody>
										</table>
									</div>
									
								</div>
							</div>
						</div>
				
					</div>
					<!-- /.col-lg-12 -->

				</div>
			</div>
		</div>