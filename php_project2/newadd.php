	<?php
	if(isset($_POST['b1'])){
		extract($_POST);
		include("config.php");
		$r=mysqli_query($link,"select * from table1");
		$row=mysqli_fetch_row($r);
		if($name != $row[1]){
		$result=mysqli_query($link," insert into table1 (sname,num,edu) values('$name','$number','$edu')");	
		if($result){
			echo"<br><p>Record added...<b>Press back to view</b></p>";
		}else{
			echo"<br>".mysqli_error($result);
		}
	}else{
		echo"<br><p id='p'>name alreay exists..<b>Please Re-Enter</b></p>";
	}
}
		
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Add New User</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<a class="a3" href='index.php'>Back</a><br>
	<form action="newadd.php" method="post" >
	<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">Name :</label>
    <div class="col-sm-8">
   	<input type="text" class="form-control" name="name" autofocus>
    </div>
  	</div>

  <div class="mb-3 row">
    <label class="col-sm-2 col-form-label">Mobile No :</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="number">
    </div>
  	</div>

  	<div class="mb-3 row">
    <label  class="col-sm-2 col-form-label">Education :</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="edu">
    </div>
  	</div>
  	<div>
  	<button type="submit" name="b1" class="btn btn-primary">Submit</button>
  	</div>
	</form>
</body>
<style type="text/css" media="screen">
form{
	margin-top:10%;
}	
label{
	margin-left:2%;
	font-weight:bold;
}
a{
		background-color: #1a75ff;
		color: white;
		text-decoration: none;
		border-radius: 20px;
		text-align: center;
		display: flex;
		float: right;
		margin-top: 2%;
		padding: 8px 4%;
		margin-right: 5%;
	}
a:hover{
	color: white;
}
button{
	display: flex;
	float: right;
	margin-right: 15%;
	margin-top: 2%;
}
body{
	background-color: #80bfff;
}
p{
	display: flex;
	justify-content: center;
	align-items: center;
	clear: both;
	font-weight:bolder;
	color: green;
}
#p{
	color: red;
}
</style>
</html>