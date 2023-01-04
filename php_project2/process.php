<?php
$numpage = 05;

if(isset($_GET["page"])){
	$page=$_GET["page"];
}else{
	$page=1;
}
$start_from_page=($page-1)*05;

			include("config.php");
			$output='';
				if(isset($_POST['input'])){
				$filter= $_POST['input'];
				$result=mysqli_query($link,"select * from table1 where CONCAT(id,sname,num,edu) LIKE '%$filter%' LIMIT $start_from_page,$numpage");
			}else{
				$result=mysqli_query($link,"select * from table1 LIMIT $start_from_page,$numpage");
			}

			if($result->num_rows>0){
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
		}else{
			$output.="<span>No Record Founded..</span>";
		}
		echo $output;
?>