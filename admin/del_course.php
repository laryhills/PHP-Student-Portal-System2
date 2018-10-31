<?php
session_start();
//Set config ext file
define('__CONFIG__', true);
//Require ext file(s)
require_once('../conn/db_connect.php');

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db_connect, "DELETE FROM courses WHERE course_id=$id");
	
	$_SESSION["SuccessMessage"]="Course Deleted Successful!!!";
	header('location:courses.php');
	exit;

	

}else{

	die("An Error Occured: ".mysqli_error($db_connect));
}



?>