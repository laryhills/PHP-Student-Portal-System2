<?php
	session_start();
	$stud_reg_no=$_SESSION['username'];
	unset($_SESSION['username']);
	session_destroy();
	header('location:index.php');
	exit();
		
	?>