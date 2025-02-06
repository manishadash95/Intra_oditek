<?php
	function ajaxpaginate($page, $totalRecords, $recordsperpage, $noofpagelinks)
	{
		$startResults = ($page - 1) * $recordsperpage;
		$noofpages=ceil($totalRecords/$recordsperpage);
		$page=($page>$noofpages || $page < 1)?1:$page;

		if($noofpagelinks % 2 == 0){
			$middlepage=($noofpagelinks/2)+1;
			$noofpagelinks++;
		}else{
			$middlepage=($noofpagelinks+1)/2;
		}
		
		$startpage=($page < $middlepage)?1 : $page-$middlepage+1;
		$endpage=$startpage+$noofpagelinks-1;
		$endpage = ($noofpages < $endpage) ? $noofpages : $endpage;
		$prev = $page - 1;
		$next = $page + 1;
		if($page > 1)
			echo '<li><a href="javascript:ajaxpagination('.$prev.')">«</a></li>';

		for($i=$startpage; $i<=$endpage; $i++) 
		{
			if($i == $page)
				echo '<li class="active"><a href="javascript:void(0)">'.$i.'</a></li>';
			else
				echo '<li><a href="javascript:ajaxpagination('.$i.')">'.$i.'</a></li>';
		}
		
		if ($page < $noofpages)
			echo '<li><a href="javascript:ajaxpagination('.$next.')">»</a></li>';
	}
?>

	

