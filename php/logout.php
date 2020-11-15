<?php 
	session_start();
	$_SESSION['phone'] = "";
	$_SESSION['auth'] = FALSE;
	session_destroy();
	setcookie('phone', '', time(), "/"); 
	setcookie('cookie_key', '', time(), "/"); 
	header("Location: ../index.php");
?>