<?php
session_start();
if(isset($_SESSION['name'])){
	session_unset();
	$msg="You have successfully logged out.";
	header("Location:loginPage.php?msg=$msg");
}
?>
