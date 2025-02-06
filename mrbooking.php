<?php 

    ini_set("display_errors",0);
	include 'include/init.php';
	include_once 'dbcon/DBConnection.php';
	include 'include/pagination.php';
	
	$dbobj = new DBConnection();
	$dbobj->connect();
	$read="";
	$mrRoom = $dbobj->getAllMeeting();
	$bookList= $dbobj->getAllBooking();
?>
<?php include 'include/header.php' ?>
<?php include 'include/leftsidebar.php' ?>
<style>
<!--
.slotmr-booking{display: grid;grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr; gap:20px; margin-bottom:10px;}
.slotmr-booking-box{box-shadow: 3px 3px 10px 0px rgba(0,0,0,.07); background-color: #fff; border-radius: 4px; border: 1px solid #CCCCCC; padding: 15px 12px;}
 
 
.slotmr-booking input[type=checkbox] {position: relative;border: 1px solid #ccc;border-radius: 4px;background: none;cursor: pointer;line-height: 0;margin: 0 7px 0 0;outline: 0;padding: 0 !important;vertical-align: text-top;height: 20px;width: 20px;-webkit-appearance: none;opacity: 1;}
.slotmr-booking input[type=checkbox]:hover {opacity: 1;}
.slotmr-booking input[type=checkbox]:checked {background-color: #16A085;opacity: 1;border: 1px solid #16A085;}
.slotmr-booking input[type=checkbox]:before {content: '';position: absolute;right: 50%;top: 50%;width: 4px;height: 10px;border: solid #FFF;border-width: 0 2px 2px 0;margin: -0px -0px 0 -0px;transform: rotate(45deg) translate(-50%, -50%);z-index: 2;}
.slotmr-booking label{outline:none !important;}
/*.slotmr-booking-box.checked_class{background-color: #16A085;}
.slotmr-booking-box.checked_class label{ color: #fff; outline:none;}
.slotmr-booking-box.checked_class input[type=checkbox]:checked {background-color: #fff;opacity: 1;border: 1px solid #fff;}

.slotmr-booking-box.checked_class input[type=checkbox]:before {content: '';position: absolute;right: 50%;top: 50%;width: 4px;height: 10px;border: solid #16A085;border-width: 0 2px 2px 0;margin: -0px -0px 0 -0px;transform: rotate(45deg) translate(-50%, -50%);z-index: 2;}*/

.slotmr-booking-box.checked_class input[type=checkbox]:checked:after{display:none !important;}
 
@media only screen and (min-width:768px) and (max-width:1200px) {.slotmr-booking{grid-template-columns: 1fr 1fr 1fr 1fr; gap:10px;}}
@media only screen and (max-width:767px) {.slotmr-booking{grid-template-columns: 1fr; gap:10px;}}
-->
</style>
        <!-- begin MAIN PAGE CONTENT -->
        <div id="page-wrapper">

            <div class="page-content">

                <!-- begin PAGE TITLE AREA -->
                <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                <div class="row">
                	
                    <div class="col-lg-12">
                        <div class="page-title">
                            <ol class="breadcrumb">
                               <li class="active">MR BOOKING</li>
                            </ol>

                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
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
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> MR BOOKING</h4>
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
												<select class="form-control" id="mr" name="mr" onChange="loadMeetingGroup()">
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
                                                    <option value="0">Select</option>
                                                   <option value ="1">One_Time</option>
												   <option value ="2">Recurring</option>
												 </select>		
                                            </div>
                                        </div>
										
										 
									
									<Div class="col-md-6">
                                            <div class="input-group bmargindiv1 col-md-12">
                                                <span class="input-group-addon ndrftextwidth text-left">Start Date :</span>
												<input type="date" id="bookdate" name="bookdate" class="form-control" onChange="loadMeetingGroup()">
                                                    
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
												<span class="input-group-addon ndrftextwidth text-left">Duration :</span>
												<select id="tp" class="form-control" >

													    <option value="0">Select</option>
													    <option value="15"  >15 Mins</option>
														<option value="30"  >30 Mins</option>
														<option value="45"  >45 Mins</option>
														<option value="60"  >1 HR</option>
														<option value="120"  >2 HRs</option>
														<option value="180"  >3 HRs</option>
														<option value="240"  >4 HRs</option>
														<option value="300"  >5 HRs</option>
														<option value="360"  >6 HRs</option>
														<option value="420"  >7 HRs</option>
														<option value="480"  >8 HRs</option>
												</select>
											</div>
										</div>
											
                                        <div class="col-md-12">
											<div class="slotmr-booking" id="days" style="display: none;">
											<div class="slotmr-booking-box"><input id="sunday" name="sunday" type="checkbox" value="sunday"> <label for="sunday">Sunday</label></div>
											<div class="slotmr-booking-box"><input id="monday" name="monday" type="checkbox" value="monday"> <label for="monday">Monday</label></div>
											<div class="slotmr-booking-box"><input id="tuesday" name="tuesday" type="checkbox" value="tuesday"> <label for="tuesday">Tuesday</label></div>
											<div class="slotmr-booking-box"><input id="wednesday" name="wednesday" type="checkbox" value="wednesday"> <label for="wednesday">Wednesday</label></div>
											<div class="slotmr-booking-box"><input id="thursday" name="thursday" type="checkbox" value="thursday"> <label for="thursday">Thursday</label></div>
											<div class="slotmr-booking-box"><input id="friday" name="friday" type="checkbox" value="friday"> <label for="friday">Friday</label></div>
											<div class="slotmr-booking-box"><input id="saturday" name="saturday" type="checkbox" value="saturday"> <label for="saturday">Saturday</label></div>
											</div>
											<!--<p id="days" style="display: none; flex-direction:row;justify-content: space-around;">
											<span style="margin-right: 10px;"><input type="checkbox" class="checkid" value="mon"> Sun </span>
											<span style="margin-right: 10px;"><input type="checkbox" class="checkid" value="mon"> Mon </span>
											<span style="margin-right: 10px;"><input type="checkbox" class="checkid" value="tue"> Tue </span>
											<span style="margin-right: 10px;"><input type="checkbox" class="checkid" value="wed"> Wed </span>
											<span style="margin-right: 10px;"><input type="checkbox" class="checkid" value="thu"> Thu </span>
											<span style="margin-right: 10px;"><input type="checkbox" class="checkid" value="fri"> Fri </span>
											<span style="margin-right: 10px;"><input type="checkbox" class="checkid" value="sat"> Sat </span>
                                            </p> -->
										</div>

										<div class="col-md-12">
										<div class="input-group bmargindiv1 col-md-12">
										<span  class="input-group-addon ndrftextwidth text-right">INFO :</span>
										<textarea id="text1" <?php echo $read;?> class="form-control" maxlength="1000" rows="4" name="text1" style="margin: 0px -0.5px 0px 0px; height: 100px;"></textarea>
										</div>
										</div>
										
										 <div class="clearfix"></div>
										  
										<input type="hidden" name="hidaddedit" id="hidaddedit" value="add" />
										<input type="hidden" name="heid" id="heid"  value="<?php echo $emp_eid;?>">
										
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="tpaddingdiv1 text-center">
                                                <button type="button" class="btn btn-default" name="btnsubmit" id="btnsubmit" onClick="return actionMeetingBooking()">Save</button>
												
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
                </div> <!-- end_row_div -->
                </form>
                
                <!--row_div-->
				<!--end_row_div-->
				<div class="row">
                  <div class="col-md-12">
                  	<!--left_div-->
                    <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><i class="fa fa-exchange fa-fw"></i> BOOKING</h4>
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
													<col class="col-md-2 col-sm-2">
													<col class="col-md-1 col-sm-1">
													<col class="col-md-2 col-sm-2">
													<col class="col-md-3 col-sm-3">
													<col class="col-md-2 col-sm-2">
                                                 	
											    </colgroup>
                                                <thead class="tablefont">
                                                    <tr>
                                                        <th class="center_td">Sl No</th>
														<th class="center_td">Date</th>
                                                        <th class="center_td">MR Name</th>
														<th class="center_td">Type</th>
														<th class="center_td">Booking Date</th>
														<th class="center_td">Start Time</th>
														<th class="center_td">Time Duration</th>
														<th class="center_td">End Time</th>
														<th class="center_td">Person Name</th>
														<th class="center_td">Delete</th>
														
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
                  </div>
                  <div class="clearfix"></div>
                </div> <!--end_row_div-->
				
				
				<!--row_div-->
            </div>
            <!-- /.page-content -->
        </div>
        
<!--view_employee_details_div-->

  
<?php include 'include/footer.php' ?>
<script>

window.onload = function() {
	
  loadMeetingGroup();
};



function loadDays() {
    var book = document.getElementById("book");
    var days = document.getElementById("days");
	var enDate = document.getElementById("edate");
    
    if (book.value == "1") {
		
        days.style.display = "none";
		endDate.style.display = "none";
		
    } else if (book.value == "2") {
        days.style.display = "grid";
		endDate.style.display = "grid";
    } else {
        days.style.display = "none";
		endDate.style.display = "none";
    }

}


function loadMeetingGroup() {
    var mr = document.getElementById('mr').value;
    var book = document.getElementById('book').value;
	var bookdate =  document.getElementById('bookdate').value;
	
	var stime = document.getElementById('stime').value;
	var tp =  document.getElementById('tp').value;
	
	 
    var dataString = "action=loadMeetingGroup&mr=" + mr + "&book=" + book + "&bookdate=" +bookdate+ "&stime=" +stime+ "&tp="+ tp;
    //alert(dataString);
    $.ajax({
        type: "POST",
        url: "ajaxproject.php",
        data: dataString,
        cache: false,
        success: function(html) {
            var dobj = jQuery.parseJSON(html);
           // alert(dobj.msg);
            if (dobj.status == 1) {
                $("#PROLISTDISPLAYID").html(dobj.data);
            }
        }
    });
}
 
function checkValidation() {
    var mr = document.getElementById('mr').value;
    var book = document.getElementById('book').value;
    var bookdate = document.getElementById('bookdate').value;
    var edate = document.getElementById('edate').value;
    var stime = document.getElementById('stime').value;
    var tp = document.getElementById('tp').value;
    var text1 = document.getElementById('text1').value;
     var days = document.querySelectorAll('.slotmr-booking input[type="checkbox"]');
    
    if (mr == 0) {
        alert("Meeting...");
        return false;
    }

    if (book == 0) {
        alert("Booking...");
        return false;
    }

    if (bookdate.length == 0) {
        alert("Enter date...");
        return false;
    }

    if (book == 2) {
        if (edate.length == 0) {
            alert("Enter end date...");
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
            alert("Please select at least one day...");
            return false;
        }
    }

    if (stime == 0) {
        alert("Enter Start Time....");
        return false;
    }

    if (tp == 0) {
        alert("Enter Time Duration....");
        return false;
    }

    if (text1 == 0) {
        alert("Please Add some info...");
        return false;
    }
    return true;
}


function factorial($n) { 
    if ($n == 0 || $n == 1) { 
        return 1; 
    } else { 
        return $n * factorial($n - 1); 
    } 
} 
  
// Function to calculate permutations 
function nPr($n, $r) { 
    if ($n < $r) { 
	
	        return "Invalid input"; 
    } 
  
    return factorial($n) / factorial($n - $r); 
} 
  

function actionMeetingBooking() {
    if (!checkValidation()) {
        return false;
    }

    var mr = document.getElementById('mr').value;
    var book = document.getElementById('book').value;
    var bookdate = document.getElementById('bookdate').value;
    var stime = document.getElementById('stime').value;
    var tp = document.getElementById('tp').value;
    var text1 = document.getElementById('text1').value;
	var days = document.getElementById('days').value;
	var edate = document.getElementById('edate').value;

   var days = document.querySelectorAll('.slotmr-booking input[type="checkbox"]');
    var Days = [];
    for (var i = 0; i < days.length; i++) {
        if (days[i].checked) {
            Days.push(days[i].value);
        }
    }
    var days = Days.join(',');

    
    
	$n = 5; 
    $r = 6; 

    if (mr == 'MR1' && nPr($n, 1) < $r) {
        //alert('Booking in MR2 is allowed');
    }

    var dataString = "action=MeetingBooking&mr=" + mr + "&book=" + book + "&bookdate=" + bookdate + "&stime=" + stime + "&tp=" + tp + "&text1=" + text1 + "&days="+days+ "&edate="+ edate;
	alert(dataString);
	

    $.ajax({ 
        type: "POST",
        url: "ajaxproject.php",
        data: dataString,
        cache: false,
        success: function(html) {    
            var dobj = jQuery.parseJSON(html);
            alert(dobj.msg);
            if (dobj.status == 1) {
                location.reload(); 
            } else {
                // Handle failure case
            }
        } 
    });
}

 

function actionDelete(id) {
    if (confirm("Are you sure want to delete?")) {
        var dataString = "action=actionDelete&id=" + id;
        $.ajax({
            type: "POST",
            url: "ajaxproject.php",
            data: dataString,
            cache: false,
            success: function (html) {
                var dobj = jQuery.parseJSON(html);
                if (dobj.status == 1) {
                    alert(dobj.msg);
                    location.reload();
                } else {
                    alert("Error during deletion: " + dobj.msg);
                    console.log(dobj); 
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


 
	var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if (month < 10) 
        month = '0' + month.toString();
    if (day < 10) 
        day = '0' + day.toString();

    var minDate = year + '-' + month + '-' + day;

    document.getElementById('bookdate').setAttribute('min', minDate);
    document.getElementById('edate').setAttribute('min', minDate);

</script>

<script>
$(document).on('change','.slotmr-booking input[type=checkbox]',function(){
   if($(this).is(':checked')){
     $(this).closest('.slotmr-booking-box').addClass('checked_class')
   }else{
     $(this).closest('.slotmr-booking-box').removeClass('checked_class')
   }
})
</script>
