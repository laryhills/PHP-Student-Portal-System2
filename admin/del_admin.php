<?php
session_start();
//Set config ext file
define('__CONFIG__', true);
//Require ext file(s)
require_once('../conn/db_connect.php');



if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db_connect, "DELETE FROM admin WHERE admin_id='$id'");
	
	$_SESSION["SuccessMessage"]="Admin Account Deleted Successful!!!";
	header('location:admins.php');
	exit;
}elseif (isset($_GET['disable']) && $_GET['disable'] != ""){
	$id = $_GET['disable'];
	mysqli_query($db_connect, "UPDATE admin SET status='disallowed' WHERE admin_id='$id'");
	$_SESSION["SuccessMessage"]="Admin Disabled Successful!!!";
	header('location:admins.php');
	exit;
}elseif (isset($_GET['enable']) && $_GET['enable'] != ""){
	$id = $_GET['enable'];
	mysqli_query($db_connect, "UPDATE admin SET status='allowed' WHERE admin_id='$id'");
	$_SESSION["SuccessMessage"]="Admin Enabled Successful!!!";
	header('location:admins.php');
	exit;
}elseif (isset($_GET['test_del']) && $_GET['test_del'] != ""){
	$id = $_GET['test_del'];
	mysqli_query($db_connect, "DELETE FROM tests WHERE test_id='$id'");
	$_SESSION["SuccessMessage"]="Test Record Deleted Successful!!!";
	header('location:addtest.php');
	exit;
}elseif (isset($_GET['que_del']) && $_GET['que_del'] != ""){
	$id = $_GET['que_del'];
	mysqli_query($db_connect, "DELETE FROM questions WHERE que_id='$id'");
	$_SESSION["SuccessMessage"]="Question Record Deleted Successful!!!";
	header('location:addtest.php');
	exit;
}else{
	
	die("An Error Occured: ".mysqli_error($db_connect));
}
?>