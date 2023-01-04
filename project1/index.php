<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Login form</title>
<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
<div class="container">
<?php
if(isset($_POST['b1'])){
extract($_POST);
$link=mysqli_connect("localhost","root","","sample1");
$b=mysqli_query($link,"select * from login where uname='$uid' or email ='$uid' ");
if(mysqli_num_rows($b)>0){
$row=mysqli_fetch_row($b);
if($row[4]==$pwd){
$_SESSION['uid']=$uid;
header("location:home.php");
}else{$error[]='Invalid login credentials, Please Try Again.';}
}else{
$error[]='Invalid login credentials, Please Try Again.';}
mysqli_close($link);
}
?>
<?php
if(isset($error)){
foreach($error as $err)
{
echo"<p id='dd' class='errmsg'>&#x26A0;".$err."</p>";
}
}
?>
<div class="header">
<h2>LOGIN</h2>
</div>
<form class="form" name="form" method="post">
<div class="form-control">
<lable>Username or email:</lable>
<input type="text" name="uid" required autofocus></div>
<div class="form-control">
<lable>Password:</lable>
<input type="password" name="pwd" required></div>
<div class="form-control" id="a">
<a href="Reg.php">Create New Account</a>
<button name="b1">Login</button></div>
</form>
</div>
</body>
<script src="jquery-3.6.1.min.js"></script>
<script>
$(document).ready(function(){
$("input[name=uid],input[name=pwd]").keyup(function(){
$("#dd").hide()
})})
</script>
</html>