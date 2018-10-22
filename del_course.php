<?php
session_start();
require_once('db_connect.php');

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