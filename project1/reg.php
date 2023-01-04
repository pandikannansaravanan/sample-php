<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style.css" />
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Validatation</title>
</head>
<body>
<div class="container">
<?php
$username = $firstname = $lastname = $email = $password = $cpassword = "";
if(isset($_POST['b1'])){
extract($_POST);
$link=mysqli_connect("localhost","root","","sample1");
$c=mysqli_query($link,"select * from login where uname='$username' or email='$email'");
$row = mysqli_num_rows($c);
if($row == 0){$b=mysqli_query($link,"insert into login (uname,fname,lname,email,password,cpassword)
values('$username','$firstname','$lastname','$email','$password','$cpassword')");
if($b) $success[]='Registration success...Please Login';
$username = $firstname = $lastname = $email = $password = $cpassword = "";
}else{
$error[]='User name already exist..!';
$_POST['b1']='false';
}
mysqli_close($link);
}
?>
<div class="header">
<h2>Registration</h2>
</div>
<div>
<?php
if(isset($error))
{
foreach($error as $err)
{
echo"<b><p class='errmsg'>&#x26A0; ".$err."</p></b>";
}
}
if(isset($success))
{
foreach($success as $suc)
{
echo"<b><p class='successmsg'>&#10003; ".$suc."</p></b>";
}
}
?>
</div><form class="form" name="form" id="form" method="post" onsubmit="return checkInput()">
<div class="form-control" style="float:left">
<lable>First Name :</lable>
<input type="text" name="firstname" id="firstname" autofocus value="<?php echo
$firstname; ?>">
<i class="fa fa-check"></i>
<small>Error message</small></div>
<div class="form-control" style="float:right">
<lable>Last Name :</lable>
<input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>">
<i class="fa fa-check"></i>
<small>Error message</small></div>
<div class="form-control" style="clear:both">
<lable>User Name :</lable>
<input type="text" name="username" id="username" value="<?php echo $username; ?>">
<i class="fa fa-check"></i>
<small>Error message</small></div>
<div class="form-control">
<lable>Email :</lable>
<input type="text" name="email" id="email" value="<?php echo $email; ?>">
<i class="fa fa-check"></i>
<small>Error message</small></div>
<div class="form-control">
<lable>Password :</lable>
<input type="password" name="password" id="password" value="<?php echo $password;
?>">
<i class="fa fa-check"></i>
<small>Error message</small></div><div class="form-control">
<lable>Confirm Password :</lable>
<input type="password" name="cpassword" id="cpassword" value="<?php echo $cpassword;
?>">
<i class="fa fa-check"></i>
<small>Error message</small></div>
<input type="submit" name="b1" value="Submit">
<a href="index.php" id="anchor">Login Here..</a>
</form>
</div>
</body>
<script>
// const form = document.getElementById("form");
// const fname= document.getElementById("firstname");
// const lname= document.getElementById("lastname");
// const uname= document.getElementById("username");
// const email= document.getElementById("email");
// const password= document.getElementById("password");
// const cpassword= document.getElementById("cpassword");
// form.addEventListener('submit', e => {
// e.preventDefault();
// checkInput();
// })
function checkInput() {
const form = document.getElementById("form");
const fname= document.getElementById("firstname");const lname= document.getElementById("lastname");
const uname= document.getElementById("username");
const email= document.getElementById("email");
const password= document.getElementById("password");
const cpassword= document.getElementById("cpassword");
const fnamevalue = fname.value.trim();
const lnamevalue = lname.value.trim();
const unamevalue = uname.value.trim();
const emailvalue = email.value.trim();
const pwdvalue = password.value.trim();
const cpwdvalue = cpassword.value.trim();
var status = false;
P1=/^[a-zA-Z ]+$/;
P2=/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])[a-zA-Z\d].{6,}$/;
var len1 = fnamevalue.length;
var len2 = lnamevalue.length;
var len3 = unamevalue.length;
if (fnamevalue === '') {
setError(fname, "First Name can't be empty");
status=false;
} else if(!P1.test(fnamevalue)){
setError(fname, "Only letter should be allowed");
status=false;
} else if(len1 < 3){
setError(fname, "Atleast 3 character");status=false;
} else{
setSuccess(fname);
status = true;
}
if (lnamevalue === '') {
setError(lname, "Last Name can't be empty");
status=false;
} else if(!P1.test(lnamevalue)){
setError(lname, "Only letter should be allowed");
status=false;
} else if(len2 < 3){
setError(lname, "Atleast 3 character");
status=false;
} else{
setSuccess(lname);
status = true;
}
if (unamevalue === '') {
setError(uname, "User Name can't be empty");
status=false;
} else if(len3 < 5){
setError(uname, "Atleast 5 character");
status=false;
} else{
setSuccess(uname);
status = true;
}if (emailvalue === '') {
setError(email, "Email can't be empty");
status=false;
} else{
setSuccess(email);
status = true;
}
if (pwdvalue === '') {
setError(password, "Password can't be empty");
status=false;
// } else if(!P2.test(pwdvalue)){
// setError(password, "Minimum 6 character with (one uppercase letter, one lowercase letter,one number and one specialcharacter)");
//return false;
} else{
setSuccess(password);
status = true;
}
if (cpwdvalue === '') {
setError(cpassword, "Confirm Password can't be empty");
status=false;
} else if(pwdvalue !== cpwdvalue){
setError(cpassword, "Password doesn't match");
status=false;
} else{
setSuccess(cpassword);
status = true;
}return status;
}
function setError(input, message) {
const formControl= input.parentElement;
const small = formControl.querySelector('small');
formControl.className = 'form-control error';
small.innerText = message;
}
function setSuccess(input) {
const formControl= input.parentElement;
formControl.className = 'form-control success';
return true;
}
</script>
</html>