<?php
$pname=trim(basename($_SERVER['REQUEST_URI']));
$path_parts = pathinfo($_SERVER['REQUEST_URI']);
$pname= $path_parts['filename'];

function isSalarySection($page)
{
	$ret=0;
	if( $page == "dashboard" )
		$ret=1;
	else if( $page == "viewmyaroll" )
		$ret=1;
		
		
		
	return $ret;
}

function isEmployeeFile($page)
{
	$ret=0;
	if( $page == "addemployee" )
		$ret=1;
	else if( $page == "viewemployee" )
		$ret=1;
			
	return $ret;
}

function isGenerateSalary($page)
{
	$ret=0;
	if( $page == "aroll" || $page == "viewaroll" || $page == "viewemployeearoll")
		$ret=1;
		
		
	return $ret;
}

function isProjectReport($page)
{
	$ret=0;
	if( $page == "mydailyreport" )
		$ret=1;
	
			
	return $ret;
}


?>
<nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <div class="profileimage">
                        <?php
							$eid = $_SESSION["emp_id"];
							$image = $dbobj->getImage($eid);
						?>
                        <?php if(strlen($image)  > 0) {
                        	echo '<img class="img-circle" src="'.$image.'" alt="">';
                        }
						else{ 
						?>
                        <img class="img-circle" src="img/profile-pic-blank.png" alt=""></div>
                        <?php } ?>
                        <p class="welcome">
                            
                        </p>
                        <p class="name tooltip-sidebar-logout">
                           
                            <span class="last-name"><?php echo $_SESSION["emp_name"];?></span> <a style="color: inherit; outline:none;" class="logout_open outlinedivnone" href="logout.php" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <div class="clearfix"></div>
                    </li>
                   
                    <!--end_update_record_div-->
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>