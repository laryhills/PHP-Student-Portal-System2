<?php
session_start();
require_once('db_connect.php');

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db_connect, "DELETE FROM students WHERE student_reg_no='$id'");
	
	$_SESSION["SuccessMessage"]="Student Record Deleted Successful!!!";
	header('location:students.php');
	exit;

	

}else{

	die("An Error Occured: ".mysqli_error($db_connect));
}



?>