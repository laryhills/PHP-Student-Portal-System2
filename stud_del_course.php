<?php
session_start();
//Set config ext file
define('__CONFIG__', true);
//Require ext file(s)
require_once('conn/db_connect.php');

$stud_reg_no=$_SESSION['username'];
if (isset($_GET['del'])) {
	$id = $_GET['del'];
mysqli_query($db_connect, "DELETE FROM student_courses WHERE student_fk='$stud_reg_no' AND course_fk='$id'");
	$_SESSION["SuccessMessage"]="Course Removed Successful!!!";
	header('location:studcourses.php');
	exit;

}else{

	die("An Error Occured: ".mysqli_error($db_connect));
}



?>