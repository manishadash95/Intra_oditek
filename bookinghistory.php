<?php 

    ini_set("display_errors",0);
	error_reporting(E_ALL);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	
	$dbobj = new DBConnection();
	$dbobj->connect();
	$eid = 	$_SESSION["emp_id"];
	
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>


<style>

		
		
		
<!--
.slotmr-booking {
  display: grid;
  grid-template-columns: repeat(7, 1fr); /* 1fr for each day of the week */
  gap: revert-layer; /* Adjust this value for more or less space between boxes */
  margin-bottom: 10px;
}

.slotmr-booking-box {
  box-shadow: 3px 3px 10px 0px rgba(0, 0, 0, 0.07);
  background-color: #fff;
  border-radius: 4px;
  border: 1px solid #CCCCCC;
  padding: 1px 12px;
  margin: 0 5px; /* Add margin to add more space around each box */
  display: flex;
  align-items: center; /* Center items vertically */
}

.slotmr-booking input[type=checkbox] {
  position: relative;
  border: 1px solid #ccc;
  border-radius: 4px;
  background: none;
  cursor: pointer;
  line-height: 0;
  margin: 0 7px 0 0;
  outline: 0;
  padding: 0 !important;
  vertical-align: text-top;
  height: 20px;
  width: 20px;
  -webkit-appearance: none;
  opacity: 1;
}

.slotmr-booking input[type=checkbox]:hover {
  opacity: 1;
}

.slotmr-booking input[type=checkbox]:checked {
  background-color: #16A085;
  border: 2px solid #16A085;
}

.slotmr-booking input[type=checkbox]:before {
  content: '';
  position: absolute;
  right: 50%;
  top: 50%;
  width: 4px;
  height: 10px;
  border: solid #FFF;
  border-width: 0 2px 2px 0;
  margin: -0px -0px 0 -0px;
  transform: rotate(45deg) translate(-50%, -50%);
  z-index: 2;
}

.slotmr-booking label {
  outline: none !important;
}

.slotmr-booking input[type=checkbox]:checked::after {
  content: '✔'; /* Unicode checkmark */
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-size: 16px;
}

@media only screen and (min-width: 768px) and (max-width: 1200px) {
  .slotmr-booking {
    grid-template-columns: repeat(4, 1fr); /* Adjust the number of columns for medium screens */
    gap: 10px;
  }
}

@media only screen and (max-width: 767px) {
  .slotmr-booking {
    grid-template-columns: 1fr;
    gap: 10px;
  }
}

-->
.fc-event {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    margin-bottom: 2px; /* Adds space between events */
    background-color: #FFF;
    color: #919191;
    font-size: 12px;
    cursor: default;
}

.fc-event-inner {
	width: 100%;
	height: 100%;
	overflow: hidden;
	line-height: 15px;
	event-gap: 50px;
	}
	
	
	/* Custom styles for event hover effect */
.event-tooltip {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 5px;
	  border-radius: 4px;
    box-shadow: 1 2 10px rgba(0,0,0,0.2);
    z-index: 1000;
    display: none; /* Hidden by default */
}



.calendar-header {
    position: relative;
    padding: 10px 0px; /* Reduced padding to bring items closer */
    border-bottom: 1px solid #ccc;
    display: flex;
    justify-content: space-between; /* Align title and button */
    align-items: center; /* Vertically center items */
}

.calendar-header-title {
    font-weight: 600;
}

.calendar-header-title i {
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #16a085;
    color: #fff;
    border-radius: 5px;
    margin-right: 5px;
}

.new-meeting a {
    display: inline-block;
    background-color: #16a085;
    color: #fff;
    border-radius: 5px;
    padding: 8px 10px;
    text-decoration: none !important;
}

.new-meeting a:hover {
    background-color: #2c3e50;
    color: #fff;
    text-decoration: none !important;
}

.calendar-modalframe button.close {
    color: #34495e;
    opacity: 1;
}

.calendar-modalframe .modal-footer {
    text-align: center;
    border: none;
    padding: 0px 0px 40px 0px;
}

.calendar-modalframe h4.modal-title i {
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #16a085;
    color: #fff;
    border-radius: 5px;
    margin-right: 5px;
    font-size: 20px;
}


/* Hide the dropdown arrow */
.readonly-select{
    -webkit-appearance: none;  /* For Chrome */
    -moz-appearance: none;     /* For Firefox */
    appearance: none;          /* For other browsers */
    background-color: transparent;
    background-image: none;    /* Remove the arrow icon */
}


    </style>
  
  
 <div id="page-wrapper">
    <div class="page-content">
        <!-- PAGE TITLE AREA -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="calendar-header">
                        <div class="calendar-header-title">
                            <i class="fa fa-calendar"></i> Calendar
                        </div>
                        <div class="new-meeting text-right">
                            <a href="#" data-toggle="modal" data-target="#myModal">
                                <i class="glyphicon glyphicon-plus"></i> New Meeting
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="calendar-frame">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                <!-- /.row -->
                <!-- end PAGE TITLE AREA -->
               
			   <!--main_heading_div-->
			   
               <!--search_filed_div-->
               
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
					 <div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg calendar-modalframe">
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> BOOKING</h4>
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
                                                <span class="input-group-addon ndrftextwidth text-left">Meeting :</span>
												<select class="form-control" id="mr" name="mr"  >
                                                    <option value="0">Select</option>
                                                    <option value ="1">MR1(5th floor)</option>
                                                    <option value ="2">MR2(6th floor)</option>
												 </select>		
                                            </div>
                                            
                                    </div>
									
									
									<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Booking Type :</span>
												<select class="form-control" id="book" name="book" onChange="loadDays()">
                                                  <option value ="1">One_Time</option>
												   <option value ="2">Recurring</option>
												 </select>		
                                            </div>
                                        </div>
										
										 
									<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Start Date :</span>
												<input type="date" id="bookdate" name="bookdate" class="form-control">
                                                    
                                            </div>
                                            
                                        </div>
										
										<div class="col-md-6" id="endDate" style="display: none;">
										
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">End Date :</span>
												<input type="date" id="edate" name="edate" class="form-control">
                                              
                                            </div>
                                            
                                        </div>
										
											<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-left">Start Time :</span>
												<select name="stime" id="stime" class="form-control">
												<option value="0">Select</option>
												<option value="09:00 AM">09:00 AM</option>
												<option value="09:30 AM">09:30 AM</option>
												<option value="10:00 AM">10:00 AM</option>
												<option value="10:30 AM">10:30 AM</option>
												<option value="11:00 AM">11:00 AM</option>
												<option value="11:30 AM">11:30 AM</option>
												<option value="12:00 PM">12:00 PM</option>
												<option value="12:30 PM">12:30 PM</option>
												<option value="01:00 PM">01:00 PM</option>
												<option value="01:30 PM">01:30 PM</option>
												<option value="02:00 PM">02:00 PM</option>
												<option value="02:30 PM">02:30 PM</option>
												<option value="03:00 PM">03:00 PM</option>
												<option value="03:30 PM">03:30 PM</option>
												<option value="04:00 PM">04:00 PM</option>
												<option value="04:30 PM">04:30 PM</option>
												<option value="05:00 PM">05:00 PM</option>
												<option value="05:30 PM">05:30 PM</option>
												<option value="06:00 PM">06:00 PM</option>
												<option value="06:30 PM">06:30 PM</option>
												<option value="07:00 PM">07:00 PM</option>
												<option value="07:30 PM">07:30 PM</option>
												<option value="08:00 PM">08:00 PM</option>
												<option value="08:30 PM">08:30 PM</option>
												<option value="09:00 PM">09:00 PM</option>
												</select>
												   </div>
												 </div>
										 
										 
										   <div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-left">End Time :</span>
												<select name="etime" id="etime" class="form-control">
												<option value="0">Select</option>
												<option value="09:00 AM">09:00 AM</option>
												<option value="09:30 AM">09:30 AM</option>
												<option value="10:00 AM">10:00 AM</option>
												<option value="10:30 AM">10:30 AM</option>
												<option value="11:00 AM">11:00 AM</option>
												<option value="11:30 AM">11:30 AM</option>
												<option value="12:00 PM">12:00 PM</option>
												<option value="12:30 PM">12:30 PM</option>
												<option value="01:00 PM">01:00 PM</option>
												<option value="01:30 PM">01:30 PM</option>
												<option value="02:00 PM">02:00 PM</option>
												<option value="02:30 PM">02:30 PM</option>
												<option value="03:00 PM">03:00 PM</option>
												<option value="03:30 PM">03:30 PM</option>
												<option value="04:00 PM">04:00 PM</option>
												<option value="04:30 PM">04:30 PM</option>
												<option value="05:00 PM">05:00 PM</option>
												<option value="05:30 PM">05:30 PM</option>
												<option value="06:00 PM">06:00 PM</option>
												<option value="06:30 PM">06:30 PM</option>
												<option value="07:00 PM">07:00 PM</option>
												<option value="07:30 PM">07:30 PM</option>
												<option value="08:00 PM">08:00 PM</option>
												<option value="08:30 PM">08:30 PM</option>
												<option value="09:00 PM">09:00 PM</option>
												</select>
												   </div>
												 </div>
										 

										<div class="col-md-6">
											<div class="input-group bmargindiv1 col-md-12">
												<span class="input-group-addon ndrftextwidth text-left">Duration :</span>
												 <select id="tp"  class="form-control readonly-select" disabled>

													    <option value=""></option>
													    <option value="15"   >15 Mins</option>
														<option value="30"   >30 Mins</option>
														<option value="45"   >45 Mins</option>
														<option value="60"   >1 HR</option>
														<option value="90"   >1h 30m</option>
														<option value="120"  >2 HRs</option>
														<option value="150"  >2h 30m</option>
														<option value="180"  >3 HRs</option>
														<option value="210"  >3h 30m</option>
														<option value="240"  >4 HRs</option>
														<option value="270"  >4h 30m</option>
														<option value="300"  >5 HRs</option>
														<option value="330"  >5h 30m</option>
														<option value="360"  >6 HRs</option>
														<option value="390"  >6h 30m</option>
														<option value="420"  >7 HRs</option>
														<option value="450"  >7h 30m</option>
														<option value="480"  >8 HRs</option>
														<option value="510"  >8h 30m</option>
														<option value="540"  >9 HRs</option>
														<option value="570"  >9h 30m</option>
														<option value="600"  >10 HRs</option>
														<option value="630"  >10h 30m</option>
														<option value="660"  >11 HRs</option>
														<option value="690"  >11h 30m</option>
												</select>
											</div>
										</div>
											
                                        <div class="col-md-12">
											<div class="slotmr-booking" id="days" style="display: none;">
                                            <div class="slotmr-booking-box"><input id="sunday" name="sunday" type="checkbox" value="sunday"> <label for="sunday">Sunday</label></div>
                                             <div class="slotmr-booking-box"><input id="monday" name="monday" type="checkbox" value="monday"> <label for="monday">Monday</label></div>
                                            <div class="slotmr-booking-box"><input id="tuesday" name="tuesday" type="checkbox" value="tuesday"> <label for="tuesday">Tuesday</label></div>
                                           <div class="slotmr-booking-box"><input id="wednesday" name="wednesday" type="checkbox" value="wednesday"> <label for="wednesday">Wednesday</label></div>
                                           <div class="slotmr-booking-box"><input id="thursday" name="thursday" type="checkbox" value="thursday">    <label for="thursday">Thursday</label></div>
                                           <div class="slotmr-booking-box"><input id="friday" name="friday" type="checkbox" value="friday"> <label for="friday">Friday</label></div>
                                          <div class="slotmr-booking-box"><input id="saturday" name="saturday" type="checkbox" value="saturday"> <label for="saturday">Saturday</label></div>
                                        </div>
									
										</div>


										<div class="col-md-12">
										<div class="input-group bmargindiv1 col-md-12">
										<span  class="input-group-addon ndrftextwidth text-right">INFO :</span>
										<textarea id="text1" <?php echo $read;?> class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
										</div>
										</div>
										
											
										 <div class="clearfix"></div>
										  
										
										<input type="hidden" name="heid" id="heid"  value="<?php echo $emp_eid;?>">
										
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="tpaddingdiv1 text-center">
                                                <button type="submit" class="btn btn-orange" id="btnsubmit">Create Meeting</button>
												 <button type="submit" class="btn btn-red" id="btnsubmit">Cancel</button>
								            </div>
											
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!--end_total_left_side_div-->
                                </div>
                            </div>                            
                        </div>
                    <!--end_left_div-->
                  </div>
                  <div class="clearfix"></div>
                </div> 
				
				<!-- end_row_div -->
                </form>
				
                
	<div id="myData" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg calendar-modalframe">
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> BOOKING</h4>
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
								


                            <div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Info :</span>
							<input readonly type="text" id="info" class="form-control">
							</div>
							</div>
													
                     	
							   <div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Name :</span>
							<input readonly type="text" id="name" class="form-control">
							</div>
							</div>
							
							
							<div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Booking Id :</span>
							<input readonly type="text" id="bookid" class="form-control">
							</div>
							</div>
							
							<div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">ROOM :</span>
							<input readonly type="text" id="room" class="form-control">
							</div>
							</div>
			
					
							<div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">TYPE :</span>
							<input readonly type="text" id="book" class="form-control">
							</div>
							</div>
			
				
				         
							<div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Start Date :</span>
							<input readonly type="text" id="date" class="form-control">
							</div>
							</div>

                            <div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">End Date :</span>
							<input readonly type="text" id="edate" class="form-control">
							</div>
							</div>
							
							<div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span class="input-group-addon ndrftextwidth text-right">Start Time  :</span>
							<input readonly type="text" id="stime" class="form-control">
							</div>
							</div>
							
							
							<div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">End Time :</span>
							<input readonly type="text" id="etime" class="form-control">
							</div>
							</div>
							
							<div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">Duration :</span>
							<input readonly type="text" id="duration" class="form-control">
							</div>
							</div>
								<div class="col-md-6">											
							<div class="input-group bmargindiv1 col-md-12">
							<span  class="input-group-addon ndrftextwidth text-right">DAY :</span>
							<input readonly type="text" id="days" class="form-control">
							</div>
							</div>
													
                   
                            
                       
											
											 <div class="clearfix"></div>
											  
											<input type="hidden" name="hid" id="hid"  value="<?php echo $id;?>">
											
											
											
										
										
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="tpaddingdiv1 text-center">
                                               <button type="submit" class="btn btn-green" id="btnCancel">Cancel</button>
                                               <button type="submit" class="btn btn-red" id="btnDelete">Delete</button>
											  <button type="submit" class="btn btn-default" id="btnDeleteAll">Delete All</button> <!-- Delete All Recurring -->
                                               </div>

                                            
								            </div>
										
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!--end_total_left_side_div-->
                                </div>
                            </div>                            
                        </div>
                    <!--end_left_div-->
                  </div>
                  <div class="clearfix"></div>
                </div> 
				<!-- Modal for showing event details -->

										
										
<!--view_employee_details_div-->

  
<?php include 'include/footer.php' ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


<script>

function loadDays() {
	
    var book = document.getElementById("book");
    var days = document.getElementById("days");
	var enDate = document.getElementById("edate");
   
    if (book.value == "1") {
		
        days.style.display = "none";
		endDate.style.display = "none";
		Delete.style.display = "none";
    } else if (book.value == "2") {
        days.style.display = "grid";
		endDate.style.display = "grid";
		Delete.style.display = "grid";
    } else {
        days.style.display = "none";
		endDate.style.display = "none";
    }

}


$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
		 
        axisFormat: 'H',
        columnFormat: {
            week: 'd <br> dddd',
        },
        titleFormat: {
            week: "MMMM yyyy",
        },
        editable: true,
        firstDay: 1,
        selectable: true,
        defaultView: 'agendaWeek',
        allDaySlot: false,
        selectHelper: true,
        minTime: '09:00:00',
        maxTime: '23:00:00',
        slotDuration: '00:15:00',
        slotLabelInterval: '00:15',
        slotEventOverlap: false,
        select: function(start, end) {
            var today = moment().startOf('day');
			if(moment(start).isSameOrAfter(today,'day')){

            $('#myModal').modal('show');
            $('#bookdate').val(moment(start).format('YYYY-MM-DD')); 
            $('#edate').val(moment(end).format('YYYY-MM-DD'));
            $('#stime').val(moment(start).format('hh:mm A'));
            $('#etime').val(moment(end).format('hh:mm A'));
			}
            calculateDuration(); 
        },
		
        droppable: true,
        drop: function(date, allDay) {
            var originalEventObject = $(this).data('eventObject');
            var copiedEventObject = $.extend({}, originalEventObject);
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
            if ($('#drop-remove').is(':checked')) {
                $(this).remove();
            }
        },
        eventRender: function(event, element) {
           console.log("Event details:", event);
    console.log("Event end time:", event.etime);
            if (event.mr === 'mr2') {
                element.addClass('event-mr2');
            } else if (event.mr === 'mr1') {
                element.addClass('event-mr1');
            }

            element.css('margin-top', '5px');
        },

eventClick: function(event) {
    console.log("Event clicked:", event);
    $.ajax({
        type: 'POST',
        url: 'ajaxproject.php',
        data: { action: 'getMeetingBook', id: event.id },
        dataType: 'json',
        success: function(data) {
            console.log("AJAX request successful. Data received:", data);
            if (data && data.length > 0) {
                var eventData = data.find(item => item.id == event.id); //find() method, which returns the first element data array contains elements, where the id matches the event id id matches the id of the clicked event event.id
                if (eventData) {
                    console.log("Event details fetched:", eventData);

                    // Populate fields
                    $('#myData #room').val(eventData.room);
                    $('#myData #bookid').val(eventData.bookid);
                    $('#myData #date').val(eventData.date);
                    $('#myData #stime').val(eventData.stime);
                    $('#myData #etime').val(eventData.etime);
                    $('#myData #name').val(eventData.eid);
                    $('#myData #duration').val(eventData.duration);
                    $('#myData #days').val(eventData.days);
                    $('#myData #book').val(eventData.book);
                    $('#myData #info').val(eventData.info);
                    $('#myData #edate').val(eventData.enddate);
                    $('#heid').val(event.id); // Update this to reflect the correct id

                    
                    console.log("Event book type:", eventData.book);

                   if (eventData.book == 'One_Time') {
                        $('#myData #days').closest('.input-group').hide();
                        $('#myData #edate').closest('.input-group').hide();
                        $('#btnDeleteAll').hide();
                      
                    } else {
                        $('#myData #days').closest('.input-group').show();
                        $('#myData #edate').closest('.input-group').show();
                        $('#btnDeleteAll').show(); 
                      
                    }

                    $('#myData').modal('show');
                } else {
                    alert('No data found for this event.');
                }
            } else {
                alert('No data found for this event.');
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error:', error);
        }
    });

},
eventMouseover: function(event) {
    var startDate = moment(event.start).format('DD MMMM YYYY');
    var startTime = moment(event.start, 'YYYY-MM-DDTHH:mm:ss').format('hh:mm A'); //moment(event.start): Creates a Moment.js object from the event's start time  Formats the date as day month year event's start time into a human-readable time format
    var endTime = moment(event.end, 'YYYY-MM-DDTHH:mm:ss').format('hh:mm A');

    var tooltip = $('<div class="event-tooltip"></div>')
        .html('From ' + startDate + ' at ' + startTime + ' to ' + endTime)
        .appendTo('body')
        .fadeIn('500');

            $(this).on('mousemove', function(e) {
                tooltip.css({
                    top: e.pageY + 10, //Moves the tooltip so that it follows the mouse cursor offset by 10 pixels from the cursor’s position.
                    left: e.pageX + 10
                });
            });
        },
        eventMouseout: function(event) {
            $('.event-tooltip').remove();
        }
    });

    $('.new-meeting a').click(function() {
        $('#myModal select').prop('selectedIndex', 0);
        $('#myModal input[type="text"]').val('');
        $('#myModal input[type="checkbox"]').prop('checked', false); //Return the value of a property
        $('#One_Time').css('display', 'none');

        var now = moment();
        var oneHourLater = now.clone().add(1, 'hours');

        $('#bookdate').val(now.format('YYYY-MM-DD'));
        $('#edate').val(now.format('YYYY-MM-DD'));

        var minutes = oneHourLater.minutes();
        var roundedMinutes = Math.round(minutes / 60) * 60;
        if (roundedMinutes === 60) {
            oneHourLater.add(1, 'hours');
            oneHourLater.minutes(0);
        } else {
            oneHourLater.minutes(roundedMinutes);
        }
        var timeValue = oneHourLater.format('hh:mm A');

        $('#stime').val(timeValue);
        $('#myModal').modal('show');
        loadDays();
    });

    function calculateDuration() {
        var startTime = $('#stime').val(); //retrive the value of inpt field
        var endTime = $('#etime').val();
   //  console.log("Start time:",startTime);
	// console.log("ende time:",endTime);
        if (startTime !== '0' && endTime !== '0') { //Checks if both startTime and endTime are not equal to '0'
            var startMoment = moment(startTime, 'hh:mm A'); //Parses the startTime string into a moment object using the format 'hh:mm A'. moment is a library for parsing, validating, manipulating, and formatting dates and times.
            var endMoment = moment(endTime, 'hh:mm A'); //Calculates the duration between endMoment and startMoment. endMoment.diff(startMoment)
            var duration = moment.duration(endMoment.diff(startMoment)); //oment.duration() converts it to a duration object.
            var minutes = duration.asMinutes();//get the length of the duration minutes momentjs is a javascript library manipulating and displaying date and time in a very easy 
            $('#tp').val(minutes);
        }
    }

   $('#stime, #etime').change(function() {
   // console.log('Input changed');
    calculateDuration();
});


    function checkValidation() {
        var mr = document.getElementById('mr').value;
        var book = document.getElementById('book').value;
        var bookdate = document.getElementById('bookdate').value;
        var edate = document.getElementById('edate').value;
        var stime = document.getElementById('stime').value;
        var etime = document.getElementById('etime').value;
        var tp = document.getElementById('tp').value;
        var text1 = document.getElementById('text1').value;
        var days = document.querySelectorAll('.slotmr-booking input[type="checkbox"]');
        
        if (mr == 0) {
            alert("Meeting required.");
            return false;
        }

        if (etime == 0) {
            alert("Enter end time");
            return false;
        }

        var startMoment = moment(stime, 'hh:mm A');
        var endMoment = moment(etime, 'hh:mm A');

        if (startMoment.isSameOrAfter(endMoment)) {
            alert('Start time must be before end time.');
            return false;
        }

        if (book == 2) {
            if (edate.length == 0) {
                return false;
            }

            var daySelected = false;
            for (var i = 0; i < days.length; i++) {
                if (days[i].checked) {
                    daySelected = true;
                    break;
                }
            }

            if (!daySelected) {
                alert("Please select at least one day.");
                return false;
            }
        }

        if (text1 == 0) {
            alert("Please add some information.");
            return false;
        }

        return true;
    }

  function CreateMeeting(event) {
    event.preventDefault();
    
    console.log("CreateMeeting function called");
    
    if (!checkValidation()) {
        return;
    }

    var mr = document.getElementById('mr').value;
    var book = document.getElementById('book').value;
    var bookdate = document.getElementById('bookdate').value;
    var stime = document.getElementById('stime').value;
    var etime = document.getElementById('etime').value;
    var tp = document.getElementById('tp').value;
    var text1 = document.getElementById('text1').value;
    var edate = document.getElementById('edate').value;


    var days = $('.slotmr-booking input[type="checkbox"]:checked').map(function() { // select all checkbox within element with the class slotmr_booking 
        return $(this).val(); // iterates over selected checkbox it retrive its value using $(this).val(),the map function() creates an array of these value
    }).get(); // convert the jquery object returned by map  into a plain array of values 
    var daysString = days.join(','); // join the array of chcekbox values into a single string with each value separated  by a comma 

    var dataString = "action=CreateMeeting&mr=" + mr + "&book=" + book + "&bookdate=" + bookdate + "&stime=" + stime + "&etime=" + etime + "&tp=" + tp + "&text1=" + text1 + "&days=" + daysString + "&edate=" + edate;

    console.log("Data to be sent:", dataString);

    $.ajax({
        type: "POST",
        url: "ajaxproject.php",
        data: dataString,
        cache: false,
        success: function(html) {
            console.log("CreateMeeting success response:", html);
            var dobj = jQuery.parseJSON(html);
            alert(dobj.msg);
            if (dobj.status == 1) {
                $('#myModal').modal('hide');
				
                $('#calendar').fullCalendar('refetchEvents');  
                getMeetingBook(); // Refresh events on calendar
            } else {
                alert('Failed to create meeting.');
            }
        },
        error: function(xhr, status, error) {
            console.log('CreateMeeting AJAX Error:', error);
        }
    });
}


 function getMeetingBook() {
    $.ajax({
        type: 'POST',
        url: 'ajaxproject.php',
        data: { action: 'getMeetingBook' },
        dataType: 'json',
      success: function(data) {
    console.log("Received data:", data); 

    $('#calendar').fullCalendar('removeEvents'); //This method removes all events from the calendar. It's a way to clear out any events that are currently displayed.
    $('#calendar').fullCalendar('removeEventSources'); //This method removes all event sources from the calendar 

    var events = data.map(function(event) {
    return {
        id: event.id,
        bookid: event.bookid,
          title: event.room + ' - ' + event.eid, // Show room and employee name
       
        start: moment(event.date + ' ' + event.stime, 'DD-MM-YYYY hh:mm A').toDate(), //Creates a Moment.js object from the combined event.date and event.stime string, using the specified format 'DD-MM-YYYY hh:mm A'Moment.js to parse the date and time string into a Moment object, which makes it easier to manipulate and format dates in JavaScript.
        end: moment(event.date + ' ' + event.etime, 'DD-MM-YYYY hh:mm A').toDate(),
        description: event.info,
        date: event.date,
        days: event.days,
        book: event.book,
        info: event.info,
        enddate: event.enddate,
        allDay: false
    };
});
            $('#calendar').fullCalendar('addEventSource', events);
        },
        error: function(xhr, status, error) {
            console.error('getMeetingBook AJAX Error:', error);
        }
    });
}


  

    $('#btnsubmit').on('click', CreateMeeting);
    getMeetingBook();
});



 function deleteMeeting(deleteAll) {
    var eventId = $('#heid').val(); // Get the event ID from the hidden field

    var confirmMessage = deleteAll ? 
        "Are you sure you want to delete all occurrences of this event?" :
        "Are you sure you want to delete this event?";

    if (confirm(confirmMessage)) {
        $.ajax({
            type: "POST",
            url: "ajaxproject.php",
            data: {
                action: 'deleteMeetingHistory',
                id: eventId,
                deleteAll: deleteAll // Pass the deleteAll flag to the server
            },
            cache: false,
            success: function(response) {
                var dobj = jQuery.parseJSON(response);
                if (dobj.status == 1) {
                    alert(dobj.msg);
                    $('#myData').modal('hide');
                    location.reload(); // Refresh events on calendar
                } else {
                    alert('Failed to delete the event: ' + dobj.msg);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + error);
                console.log('xhr response:', xhr.responseText);
                console.log('status:', status);
            }
        });
    }
}

// Attach event handler to delete button
$('#btnDelete').on('click', function(event) {
    event.preventDefault();
    deleteMeeting(false); // Call with false to delete only this event
});

// Attach event handler to delete all button
$('#btnDeleteAll').on('click', function(event) {
    event.preventDefault();
    deleteMeeting(true); // Call with true to delete all occurrences
});


</script>


