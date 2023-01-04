<?php
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
	<title>own development</title>
	<link rel="stylesheet" href="">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
	<script src="jquery-3.6.1.min.js"></script>
</head>
<body>
	<div class="row">
		<div style="margin: 15px" class="col-md-9">
	<input type="search" class="form-control" name="search" placeholder="search hear.." id="searchbox" autofocus>
	</div>
	<div class="col-md-2">
	<a class="a3" href='newadd.php'>ADD</a>
</div>
	</div>
	

		<?php
			include("config.php");
				$result=mysqli_query($link,"select * from table1 limit $start_from_page,$numpage");
				?>
				<table id="table-data" class="table table-striped table-hover">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">NAME</th>
				<th scope="col">MOBILE NO</th>
				<th scope="col">DEGREE</th>
			</tr>
		</thead>
		<tbody>
			<?php
				while($row=mysqli_fetch_row($result)){
			?>
				<tr>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td>
				<td><?php echo $row[2]; ?></td>
				<td><?php echo $row[3]; ?></td>
				</tr>
				<?php } ?>
</tbody>
	</table>
<script>
	$(document).ready(function(){
		$("#searchbox").keyup(function(){
			var input = $(this).val();
			//alert(input);
				$.ajax({
					url:"process.php",
					method:"post",
					data:{input:input},
					success:function(response){
						$("#table-data").html(response);
					}
				});
		});
	});

	// $(document).ready(function(){
	// 	function loaddata (page) {
	// 		$.ajax({
	// 				url:"pagination.php",
	// 				method:"post",
	// 				data:{page:page},
	// 				success:function(data){
	// 					$("#table-data").html(data);
	// 				}
	// 			}); 
	// 		}
	// 	});
</script>

<?php
if(!isset($_POST['input'])){
		$res_result=mysqli_query($link,"select * from table1");
		$total_record=mysqli_num_rows($res_result);
		$total_page=ceil($total_record/$numpage);
		if($page>1){
			echo"<a class='a1' href='index.php?page=".($page-1)."'>prev</a>";
		}else{
			echo"<small class='a1'>Reached First Page..</small>";
		}

		if($page<$total_page){
			echo"<a class='a2' href='index.php?page=".($page+1)."'>next</a>";
		}else{
			echo"<small class='a2'>Reached Last Page..</small>";
		}
	}
	?>
</body>
<style type="text/css" media="screen">
	span{
		color: red;
		font-weight: bold;
		display: flex;
		justify-content: center;
	}
	a{
		background-color: lightgray;
		color: black;
		padding: 8px 14px;
		text-decoration: none;
		border-radius: 20px;
		text-align: center;
	}
	a:hover{
		color: black;
	}
	.a1{
		margin-left: 10px;
	}
	.a2{
		display: flex;
		float: right;
		margin-right: 10px;
	}
	.a3{
		display: flex;
		float: right;
		margin-top: 14px;
		padding: 8px 20%;
	}
</style>
</html>