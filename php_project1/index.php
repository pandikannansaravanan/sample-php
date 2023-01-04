<?php
$link=mysqli_connect("localhost","root","","sample");

$numpage = 05;

if(isset($_GET["page"])){
	$page=$_GET["page"];
}else{
	$page=1;
}
$start_from_page=($page-1)*05;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>pagination and search</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="index.php" method="get" accept-charset="utf-8" name="form">
		<input type="search" name="search" placeholder="search hear.." value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
		<input type="submit" name="submit" value="Search">
	</form>
	<table style="border-collapse: collapse; margin-left: 30%">
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>
				<th>MOBILE NO</th>
				<th>DEGREE</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(isset($_GET['search'])){
				$filter= $_GET['search'];
				$result=mysqli_query($link,"select * from table1 where CONCAT(id,sname,num,edu) LIKE '%$filter%'");
				}else{
				$result=mysqli_query($link,"select * from table1 limit $start_from_page,$numpage ");
				}
				while($row=mysqli_fetch_row($result)){
				?>
				<tr>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td>
				<td><?php echo $row[2]; ?></td>
				<td><?php echo $row[3]; ?></td>
				</tr>
				<?php
			};
			?>
		</tbody>
	</table><br>
	<?php
		$res_result=mysqli_query($link,"select * from table1");
		$total_record=mysqli_num_rows($res_result);
		$total_page=ceil($total_record/$numpage);
		if($page>1){
			echo"<a href='index.php?page=".($page-1)."'>prev</a>";
		}else{
			echo"<small>Reached First Page..</small>";
		}

		if($page<$total_page){
			echo"<a href='index.php?page=".($page+1)."'>next</a>";
		}else{
			echo"<small>Reached Last Page..</small>";
		}
	?>
</body>
<style type="text/css" media="screen">
body{
	font-family: sans-serif;
}
table, td, th{
	border: 1px solid;
	width: 30%;
	padding: 10px;
}
form{
	margin-left: 30%;
	margin-bottom: 8px;
}
input{
	padding: 10px;
}
a{
	text-decoration: none;
	font-size: 15px;
	border-collapse: collapse;
	background-color: lightgray;
	color: black;
	border-radius: 5px;
	border: 1px solid;
	padding: 10px 15px;
	margin-left: 25%
}
small{
	margin-left: 25%;
	font-weight: bold;
	color: green;
}
</style>
</html>