			
			
function masterValidation(){
				
		var obj=document.getElementById('name_first').value;
		var name  = obj;
		if(obj == ""){
			alert("Enter Employee Name...");
			return false;
		}
		obj=document.getElementById('gender').value;
		if(obj == "0"){
			alert("Select Gender...");
			return false;
		}
		
		obj=document.getElementById('date_of_birth').value;
		if(obj == ""){
			alert("Add date of birth...");
			return false;
		}
		
		obj=document.getElementById('blood_grp').value;
		if(obj == "0"){
			alert("Select Blood Group...");
			return false;
		}
		
		
		obj=document.getElementById('mobile_no').value;
		if(obj == ""){
			alert("Add mobile no...");
			return false;
		}
		
		obj=document.getElementById('email1').value;
		if(obj == ""){
			alert("Add email id...");
			return false;
		}
		
		
		obj=document.getElementById('oditek_joining_date').value;
		if(obj == ""){
			alert("Add date of joining...");
			return false;
		}
		 obj = document.getElementById('ifsc_code').value;
        if (obj == "") {
          alert("Add IFSC Code...");
          return false;
            }
         obj = document.getElementById('uan_number').value;
          if (obj == "") {
            alert("Add UAN Number...");
            return false;
            }

		obj=document.getElementById('mrg_status').value;
		if(obj == 0){
			alert("Select Marriage Status...");
			return false;
		}
		
		////////////////////////////////////////////////
		////////////////////////////////////////////////
		obj=document.getElementById('fname').value;
		if(obj == ""){
			alert("Add Father's Name...");
			return false;
		}
		
		obj=document.getElementById('mname').value;
		if(obj == ""){
			alert("Add Mother's Name...");
			return false;
		}
		
		obj=document.getElementById('addr1').value;
		if(obj == ""){
			alert("Add Address...");
			return false;
		}
		////////////////////////////////////////////////
		////////////////////////////////////////////////
			
		
		
		obj=document.getElementById('ename').value;
		if(obj == ""){
			alert("Add emergency contact name...");
			return false;
		}
		
		obj=document.getElementById('emobile').value;
		if(obj == ""){
			alert("Add emergency contact number...");
			return false;
		}
		
		obj=document.getElementById('erelationship').value;
		if(obj == ""){
			alert("Add Relationship...");
			return false;
		}
		
		////////////////////////////////////////////////
		////////////////////////////////////////////////
		
		var exp_type=document.getElementById('exp_type').value;
		
		obj=document.getElementById('employee_type').value;
		if(obj == "0"){
			alert("Select  Employee Type...");
			return false;
		}
		//alert("employee_type:"+obj);
		if(obj == "2"){//probation
			obj=document.getElementById('probation_period').value;
			if(obj == "0"){
				alert("Select  Probation Period...");
				return false;
			}
		}
		
		if(exp_type == "1"){
			
			obj=document.getElementById('exp_yr').value;
			if(obj == ""){
				alert("Add Experiance Year...");
				return false;
			}
			
			obj=document.getElementById('exp_mn').value;
			if(obj == ""){
				alert("Add Experiance Month...");
				return false;
			}
			
			obj=document.getElementById('prev_org').value;
			if(obj == ""){
				alert("Add Prev. Org....");
				return false;
			}
			
			obj=document.getElementById('skills').value;
			if(obj == ""){
				alert("Add skills....");
				return false;
			}
			
		}
		
		
		obj=document.getElementById('email_office').value;
		if(obj == ""){
			alert("Add office email id...");
			return false;
		}
		
		obj=document.getElementById('bu_id').value;
		if(obj == "0"){
			alert("Select Business Unit Name...");
			return false;
		}
		
		
		obj=document.getElementById('upper_id').value;
		if(obj == "0"){
			alert("Select Reporting Name...");
			return false;
		}
		
		
		
		obj=document.getElementById('dept_id').value;
		if(obj == "0"){
			alert("Select Department...");
			return false;
		}
		obj=document.getElementById('desig_id').value;
		if(obj == "0"){
			alert("Select Designation...");
			return false;
		}
		
		
		var employee_id =document.getElementById('employeeid').value;
		if(employee_id == ""){
			alert("Add Employee Id...");
			return false;
		}
		obj=document.getElementById('userid').value;
		if(obj == ""){
			alert("Add Login Id...");
			return false;
		}
		
		return true;
	}
	

function addEmployee()
{
	var ret = masterValidation();
	if(!ret)
	{
		return false;
	}
	
	if(confirm("Are you sure want to add new employee?"))
	{	
	
	var dataString = "act=addemployee&";
		dataString +=$( "#frmemployee" ).serialize();
		
		//alert(dataString);
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			//alert(html);
			var dobj=jQuery.parseJSON(html);
			alert(dobj.msg);
			if(dobj.status == 1)
				location.reload();
		} 
		});
	
	}
}



function actionExperiance()
{
	
	var exp_type=document.getElementById('exp_type').value;
	if(exp_type == 1) //experiance
	{
		document.getElementById('expe_div').style.display="block";
	}
	else
		document.getElementById('expe_div').style.display="none";
	
}

function actionEmpType()
{
	
	var emp_type=document.getElementById('employee_type').value;
	if(emp_type == 2) //probation
	{
		document.getElementById('probationid').style.display="block";
	}
	else
		document.getElementById('probationid').style.display="none";
	/*
	if(emp_type == 4) //intern
	{
		var desig_id = document.getElementById('desig_id');
		var intern = 20;
		for (var i = 0; i < desig_id.options.length; i++) {
			if(desig_id.options[i].value == intern)
			{
				desig_id.options[i].selected = true;
				break;
			}				
		}
		$('#desig_id').prop('disabled', true);
	}else{
		var desig_id = document.getElementById('desig_id');
		desig_id.options[0].selected = true;
		$('#desig_id').prop('disabled', false);
	}
	*/
	
}

	
function checkEmployeeId123(employee_id){
		
		var dataString = "act=checkemployee&employee_id="+employee_id;
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			//alert(html);
			var dobj=jQuery.parseJSON(html);
			var result = dobj.result;
			alert(":::"+result);
		} 
		});
	}
	
function onChange(){
	
	var obj=document.getElementById('forceno').value;
	var dataString = "act=checkforceno&forceno="+obj;
		$.ajax({ 
		type: "POST",url: "ajaxadmin.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			var val = html.trim();
			if(val == 1)
				duplicate_forceno = 1;
			else
				duplicate_forceno = 0;
		} 
		});
	
	}	

function validation(){
		var passwd = document.getElementById('password').value;
		var rtpasswd = document.getElementById('rpassword').value;
		
		if(passwd.length == 0)
		{
			alert("Password field should not empty...");
			return false;
		}
		else if(passwd != rtpasswd )
		{
			alert("Password field mismatch...");
			return false;
		}
		
		var email = document.getElementById('email').value;
		if(email != "")
		{
			var etest=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!etest.test(email))
	    	{
	    		alert("Invalid Email Id");
	    		return false;
	    	}
		}
		return true;
	}


	

	function getEmpyeeId(){
		
		var obj=document.getElementById('oditek_joining_date').value;
		if(obj == '')
		{
			alert("Please select date of joining...");
			return;
		}	
		var dataString = "act=employeeid&joindate="+obj;
		$.ajax({ 
		type: "POST",url: "ajaxhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			//alert(html);
			var dobj=jQuery.parseJSON(html);
			document.getElementById('employeeid').value = dobj.id;
		} 
		});
	}
	
	function checkEmployeeId(){
		
		var obj=document.getElementById('employeeid').value;
		if(obj == '')
		{
			return;
		}	
		var dataString = "act=checkemployee&employee_id="+obj;
		$.ajax({ 
		type: "POST",url: "addhremployee.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			var dobj=jQuery.parseJSON(html);
			if(dobj.result != 1)
			{
				alert(obj+" Employee Id is already exists...");
				document.getElementById('employeeid').value = "";
			}
			//document.getElementById('userid').value = dobj.id;;
		} 
		});
		
	}
	
	function updateLoginId(){
		//alert(aaa);
		var obj=document.getElementById('email_office').value;
		document.getElementById('userid').value = obj;
	}

function messagestatus(st)
{
	
	switch(st)
	{
		case 1:
		{
			alert("Data Added Successfully");
			document.location.href="addemployee.php";
			break;
		}	
		case 2:
		{
			alert("Employee Id is already present...");
			break;
		}	
		case 0:
		{
			alert("Unable to Add, Try Again");
			break;
		}
	}

}


function messagestatus2(steid_int)
{
	var steid = ""+steid_int;
	var st = steid.substring(0,1);
	var eid = steid.substring(1,steid.length);
	var a = parseInt(st);
	switch(a)
	{
		case 1:
		{
			alert("Data Updated Successfully");
			//alert();
			document.location.href="employeedetail.php?eid="+eid;
			break;
		}	
		case 0:
		{
			alert("Unable to Add, Try Again");
			break;
		}
	}

}

