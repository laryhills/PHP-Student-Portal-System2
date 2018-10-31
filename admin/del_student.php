<?php
session_start();
//Set config ext file
define('__CONFIG__', true);
//Require ext file(s)
require_once('../conn/db_connect.php');

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