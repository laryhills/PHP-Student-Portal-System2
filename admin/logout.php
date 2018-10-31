<?php
	session_start();
	$admin_loginid=$_SESSION['username'];
	unset($_SESSION['username']);
	session_destroy();
	header('location:../admin.php');
	exit();
		
	?>