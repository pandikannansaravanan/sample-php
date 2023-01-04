<?php
	$link=mysqli_connect("localhost","root","","sample");

	if(!$link){
		echo" connection field: mysqli_connect_error($link)";
	}
?>