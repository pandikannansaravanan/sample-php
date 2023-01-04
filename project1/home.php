<html>
<head>
<title>Welcome Home</title>
<link rel="stylesheet" href="bootstrap-5.2.2-dist\css\bootstrap.min.css">
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['uid'])){
header("location:index.php");
}
$link=mysqli_connect("localhost","root","","sample1");
$b=mysqli_query($link,"select * from login where uname='$_SESSION[uid]' or
email='$_SESSION[uid]' ");
while($r=mysqli_fetch_row($b)){
//foreach($r as $rr){
echo"<div class='row'><div class='col-sm-8'>";
echo"<h1><br>Welcome,MR/Mrs.$r[1] $r[2]</h1>";
echo"</div>";}
echo"<div class='col-sm-4'>";echo"<p align='right'><a href='logout.php'>Signout</a></p>";
echo"</div></div>";
?>
<style>
p a{
font-size: xx-large;
padding-right: 15px;
margin-right: 10%;
}
h1{
text-align: right;
padding-right: 10px;
margin-top: 5%;
}
body{
background-image: url('com.gif');
background-attachment: fixed;
background-position: center;
}
</style>
</body>
<script src="jquery-3.6.1.min.js"></script>
<script src="bootstrap-5.2.2-dist\js\bootstrap.min.js"></script>
</html>