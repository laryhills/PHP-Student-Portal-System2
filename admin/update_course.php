<?php
//Set config ext file
define('__CONFIG__', true);
//Require ext file(s)
require_once('../conn/db_connect.php');
require_once('../functions/functions.php');

?>


<?php

if (isset($_POST['updateCourseBtn'])) {

	$course_title=mysqli_real_escape_string($db_connect, ucwords($_POST['course_title']));
	$course_code=mysqli_real_escape_string($db_connect, $_POST['course_code']); 
	$course_credit=mysqli_real_escape_string($db_connect, $_POST['course_credit']); 
	$course_dept=mysqli_real_escape_string($db_connect, $_POST['course_dept']); 
	$course_id=mysqli_real_escape_string($db_connect, $_POST['course_id']); 

	
	if (strlen($course_code) <> 6) {

		$_SESSION["ErrorMessage"]="Course Code Must be Six Characters";
        header('location:courses.php');
        exit;

	}elseif(!(preg_match("/^[A-Z]{3}[0-9]{3}$/",$course_code))) {

			$_SESSION["ErrorMessage"]="Course Code Wrong";
        	header('location:courses.php');
        	exit;
	
	}elseif ($course_credit < 2 || $course_credit > 6) {

		$_SESSION["ErrorMessage"]="Course Credit Is Invalid";
        header('location:courses.php');
        exit;
	}else{

			$sql = "UPDATE courses SET course_title='$course_title', course_code='$course_code',course_dept_fk='$course_dept',course_credit='$course_credit' WHERE course_id=$course_id";
                $result = mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

            $_SESSION["SuccessMessage"]="Course Updated!!!";
            header('location:courses.php');
            exit;
		}
	



}

?>