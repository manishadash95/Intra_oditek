</div>
    <!-- /#wrapper -->

    <!-- GLOBAL SCRIPTS -->
    
    <script src="<?php echo ADMIN_SITE_URL;?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo ADMIN_SITE_URL;?>js/jquery.popupoverlay.js"></script>
    <script src="<?php echo ADMIN_SITE_URL;?>js/defaults.js"></script>
    <script src="<?php echo ADMIN_SITE_URL;?>js/logout.js"></script>
    <!-- HISRC Retina Images -->

    <!-- THEME SCRIPTS -->
    <script src="<?php echo ADMIN_SITE_URL;?>js/flex.js"></script>
    <script src="<?php echo ADMIN_SITE_URL;?>js/dashboard-demo.js"></script>
	<script src="<?php echo ADMIN_SITE_URL;?>js/chosen.jquery.js" type="text/javascript"></script>
    <script src="<?php echo ADMIN_SITE_URL;?>js/prism.js" type="text/javascript"></script>
    <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
	function getforceno()
	{
		document.getElementById('userid').value=document.getElementById('forceno').value;
	}
    function showviewdata(num,fnumber,name,rank,panno,mobno,dob,fjoin,ndjoin,btjoin)
    {
        document.getElementById('slno').value=num;
        document.getElementById('forceno').value=fnumber;
        document.getElementById('name').value=name;
        document.getElementById('rank').value=rank;
        document.getElementById('dob').value=dob;
        document.getElementById('panno').value=panno;
        document.getElementById('mobileno').value=mobno;
        document.getElementById('fjoin').value=fjoin;
        document.getElementById('ndrfjoin').value=ndjoin;
        document.getElementById('btjoin').value=btjoin;
    }
	function showmeditdata(id, msg)
	{
        document.getElementById('editmessage').value=msg;	
		document.getElementById('messageid').value=id;
	}
	function searchforse()
	{
		if(document.getElementById('searchno').value == '')
		{
			alert("Enter Force No In Search Box");
			return false;
		}
		else{
			var fr_no=document.getElementById('searchno').value;
			dv = document.getElementById('load_subadmin');
			$("#load_subadmin").load("ajaxadmin.php?act=admindata&fr_no="+fr_no);	
		}
	}
    function showeditdata(ids,fnum,name,rank,status)
    {
        document.getElementById('hidadminid').value=ids;
        document.getElementById('edtirla').value=fnum;
        document.getElementById('editname').value=name;
        document.getElementById('edtrank').value=rank;
        document.getElementById('edtstatus').value=status;
    }
	function AlertMessage(val)
	{
		if(val == 'Selected'){
			document.getElementById('selectemails').style.visibility = 'visible';
		}else{
			document.getElementById('selectemails').style.visibility = 'hidden';
		}
	}
	function msgdelete(id)
	{
		if(confirm('Are you sure to delete this record?'))
		{
			dv = document.getElementById('SHOWMESSLIST');
			$("#SHOWMESSLIST").load("ajaxadmin.php?act=messagedata&str=delete&id="+id);	
		}	
	}
	function adminstatus(par, aid)
	{
		dv = document.getElementById('SHOWADMINLIST');
		$("#SHOWADMINLIST").load("ajaxadmin.php?act=adminlist&sta="+par+"&aid="+aid);	
	}
	function admindelete(aid)
	{
		if(confirm('Are you sure to delete this record?'))
		{
			dv = document.getElementById('SHOWADMINLIST');
			$("#SHOWADMINLIST").load("ajaxadmin.php?act=adminlist&str=delete&aid="+aid);	
		}	
	}
	function EmpSearch()
	{
		if(document.getElementById('empsearch').value == '')
		{
			alert("Enter Force No In Search Box");
			return false;
		}
		else{
			var fcno = document.getElementById('empsearch').value; 
			$("#SHOWHISTORY").load("ajaxadmin.php?act=showhistory&forceno="+fcno);
			
		var dataString = "forceno="+fcno;
		$.ajax({ 
		type: "POST",url: "ajaxemployee.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			$("#SHOWDATA").html(html);
			calcsalary();
		} 
		});
		
			//updateGPFLevel();
		}
	}
	function ModSearch(id)
	{
		dv = document.getElementById('SHOWDATA');
		var forceno = document.getElementById('empsearch').value;
		//$("#SHOWDATA").load("ajaxemployee.php?id="+id);
		var dataString = "id="+id;
		$.ajax({ 
		type: "POST",url: "ajaxemployee.php" ,data: dataString,cache: false,
		success: function(html)
		{ 
			$("#SHOWDATA").html(html);
			calcsalary();
		} 
		});
		
	}
	function showForceNo(par)      
	{
	    dv = document.getElementById('showEmployee');
		$("#showEmployee").load("ajaxforce.php?fnum="+par);
	}
	function showRank(par)      
	{
		dv = document.getElementById('showEmployee');
		$("#showEmployee").load("ajaxforce.php?rkid="+par);
	}
	function showCoy(par)      
	{
		dv = document.getElementById('showEmployee');
		$("#showEmployee").load("ajaxforce.php?coy="+par);
	}
	function showStatus(par)      
	{
		dv = document.getElementById('showEmployee');
		$("#showEmployee").load("ajaxforce.php?status="+par);
	}
	function ajaxpagination(page)
	{
		$("#showEmployee").load("ajaxforce.php?page="+page);	
		$("#SHOWADMINLIST").load("ajaxadmin.php?act=adminlist&page="+page);	
		$("#SHOWMESSLIST").load("ajaxadmin.php?act=messagedata&page="+page);	
	}
	function imgupload()
	{
		var str = document.frmemployee;
		var flag = true;
		document.getElementById('image').value=document.getElementById('bigimage1').src;
		
		if(flag == false)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function generateEmployeeData() {
    var rank = $("#deg_id").val();
    var dept_id = $("#dep_id").val();
    var status = $("#status").val();
    var bu = $("#bu_id").val(); 
	var type = $("#type").val();

    var dataString = "action=generateEmployeeData&deg_id=" + rank + "&dep_id=" + dept_id + "&status=" + status + "&bu_id=" + bu+ "&type="+ type; // Corrected variable name
    alert("dataString:" + dataString);


    $.ajax({
        type: "POST",
        url: "ajaxphpexcel.php",
        data: dataString,
        cache: false,
        success: function(html) {
            var dobj = jQuery.parseJSON(html);
            if (dobj.status == 1) {
                var dpath = dobj.file_name;
                var a = document.createElement("a");
                document.body.appendChild(a);
                a.href = dobj.file_path;
                a.download = dpath;
                a.target = '_blank';
                a.click();

            } else {
                alert(dobj.msg);
            }
            //document.getElementById('loading_data').style.display="none";
        }
    });

}

 function generateImprovementReport() {
        var type = $("#typ").val();
        var res = $("#res").val();
        var pro = $("#pro").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var dataString = "action=generateImprovementReport&typ=" + type + "&res=" + res + "&pro=" + pro + "&start_date=" + start_date + "&end_date=" + end_date;
         alert("dataString:" + dataString);
        $.ajax({
            type: "POST",
            url: "ajaxphpexcel.php",
            data: dataString,
            cache: false,
            success: function(html) {
                var dobj = jQuery.parseJSON(html);
                if (dobj.status == 1) {
                    var dpath = dobj.file_name;
                    var a = document.createElement("a");
                    document.body.appendChild(a);
                    a.href = dobj.file_path;
                    a.download = dpath;
                    a.target = '_blank';
                    a.click();
                } else {
                    alert(dobj.msg);
                }
            }
        });
    }
	
function generatePurchaseReport() {
        var bu = $("#bu_head").val();
        var pr = $("#pr_head").val();
        var sdate = $("#start_date").val();
        var edate = $("#end_date").val();

        var dataString = "action=generatePurchaseReport&bu_head=" + bu + "&pr_head=" + pr + "&start_date=" + sdate + "&end_date=" + edate;
       // alert("dataString:" + dataString);
        $.ajax({
            type: "POST",
            url: "ajaxphpexcel.php",
            data: dataString,
            cache: false,
            success: function(html) {
                var dobj = jQuery.parseJSON(html);
                if (dobj.status == 1) {
                    var dpath = dobj.file_name;
                    var a = document.createElement("a");
                    document.body.appendChild(a);
                    a.href = dobj.file_path;
                    a.download = dpath;
                    a.target = '_blank';
                    a.click();
                } else {
                    alert(dobj.msg);
                }
            }
        });
    }
	
	function generateITReport() {
        var pro = $("#pro").val();
        var sdate = $("#start_date").val();
        var edate = $("#end_date").val();

        var dataString = "action=generateITReport&pro=" + pro +"&start_date=" + sdate + "&end_date=" + edate;
       alert("dataString:" + dataString);
        $.ajax({
            type: "POST",
            url: "ajaxphpexcel.php",
            data: dataString,
            cache: false,
            success: function(html) {
                var dobj = jQuery.parseJSON(html);
                if (dobj.status == 1) {
                    var dpath = dobj.file_name;
                    var a = document.createElement("a");
                    document.body.appendChild(a);
                    a.href = dobj.file_path;
                    a.download = dpath;
                    a.target = '_blank';
                    a.click();
                } else {
                    alert(dobj.msg);
                }
            }
        });
    }
	
    </script>
</body>
</html>
