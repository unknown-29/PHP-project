<?php
	require_once "config.php";
	$uname = base64_decode(urldecode($_GET["uname"]));
	if(isset($_GET["signUp"])){
		echo "HEY<br/>";
	}
	//$sql="INSERT INTO `users`(`username`, `password`) VALUES ($uname,'[value-2]','[value-3]')"
?>
