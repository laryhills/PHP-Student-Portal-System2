<?php
session_start();
require_once('db_connect.php');

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