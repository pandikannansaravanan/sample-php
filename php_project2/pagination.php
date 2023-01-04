<?php
include("config.php");
$output='';
$page='';
$numpage = 05;

if(isset($_POST["page"])){
	$page=$_POST["page"];
}else{
	$page=1;
}
$start_from_page=($page-1)*05;

	$result=mysqli_query($link,"select * from table1 limit $start_from_page,$numpage ");
	$output="<thead>
				<tr>
				<th>ID</th>
				<th>NAME</th>
				<th>MOBILE NO</th>
				<th>DEGREE</th>
				</tr>
				</thead>
				<tbody>";
		while($row=mysqli_fetch_row($result)){
				$output .="
				<tr>
				<td>".$row[0]."</td>
				<td>".$row[1]."</td>
				<td>".$row[2]."</td>
				<td>".$row[3]."</td>
				</tr>";
			}
			$output.="</tbody>";

		// $res_result=mysqli_query($link,"select * from table1");
		// $total_record=mysqli_num_rows($res_result);
		// $total_page=ceil($total_record/$numpage);
		// if($page>1){
		// 	$output.="<a href='index.php?page=".($page-1)."'>prev</a>";
		// }else{
		// 	$output.="<small>Reached First Page..</small>";
		// }

		// if($page<$total_page){
		// 	$output.="<a href='index.php?page=".($page+1)."'>next</a>";
		// }else{
		// 	$output.="<small>Reached Last Page..</small>";
		// }


		$output. = '
	<div align="center">
  		<ul class="pagination">
	';

	$total_links = ceil($total_data/$limit);

	$previous_link = '';

	$next_link = '';

	$page_link = '';

	if($total_links > 4)
	{
		if($page < 5)
		{
			for($count = 1; $count <= 5; $count++)
			{
				$page_array[] = $count;
			}
			$page_array[] = '...';
			$page_array[] = $total_links;
		}
		else
		{
			$end_limit = $total_links - 5;

			if($page > $end_limit)
			{
				$page_array[] = 1;

				$page_array[] = '...';

				for($count = $end_limit; $count <= $total_links; $count++)
				{
					$page_array[] = $count;
				}
			}
			else
			{
				$page_array[] = 1;

				$page_array[] = '...';

				for($count = $page - 1; $count <= $page + 1; $count++)
				{
					$page_array[] = $count;
				}

				$page_array[] = '...';

				$page_array[] = $total_links;
			}
		}
	}
	else
	{
		for($count = 1; $count <= $total_links; $count++)
		{
			$page_array[] = $count;
		}
	}

	for($count = 0; $count < count($page_array); $count++)
	{
		if($page == $page_array[$count])
		{
			$page_link .= '
			<li class="page-item active">
	      		<a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
	    	</li>
			';

			$previous_id = $page_array[$count] - 1;

			if($previous_id > 0)
			{
				$previous_link = '<li class="page-item"><a class="page-link" href="javascript:load_data(`'.$_POST["query"].'`, '.$previous_id.')">Previous</a></li>';
			}
			else
			{
				$previous_link = '
				<li class="page-item disabled">
			        <a class="page-link" href="#">Previous</a>
			    </li>
				';
			}

			$next_id = $page_array[$count] + 1;

			if($next_id >= $total_links)
			{
				$next_link = '
				<li class="page-item disabled">
	        		<a class="page-link" href="#">Next</a>
	      		</li>
				';
			}
			else
			{
				$next_link = '
				<li class="page-item"><a class="page-link" href="javascript:load_data(`'.$_POST["query"].'`, '.$next_id.')">Next</a></li>
				';
			}

		}
		else
		{
			if($page_array[$count] == '...')
			{
				$page_link .= '
				<li class="page-item disabled">
	          		<a class="page-link" href="#">...</a>
	      		</li>
				';
			}
			else
			{
				$page_link .= '
				<li class="page-item">
					<a class="page-link" href="javascript:load_data(`'.$_POST["query"].'`, '.$page_array[$count].')">'.$page_array[$count].'</a>
				</li>
				';
			}
		}
	}

	$output. .= $previous_link . $page_link . $next_link;


	$output. .= '
		</ul>
	</div>
	';
		echo $output;

	?>



	<!-- model for newadd

	if(isset($_POST['b1'])){
		extract($_POST);
		include("config.php");
		$r=mysqli_query($link,"select * from table1");
		$row=mysqli_fetch_row($r);
		if($name != $row[1]){
		$result=mysqli_query($link," insert into table1 (sname,num,edu) values('$name','$number','$edu')");	
		if($result){
			echo"<br><p>Record added...</p>";
		}else{
			echo"<br>".mysqli_error($result);
		}
	}else{
		echo"<br><p id='p'>name alreay exists..<b>Please</b></p>";
	}
}
		
	?> -->