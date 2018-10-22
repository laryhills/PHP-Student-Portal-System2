<?php
require_once('db_connect.php');
require_once('functions/functions.php');

?>


<?php

if (isset($_POST['updateStudentBtn'])) {
	$stud_fname=mysqli_real_escape_string($db_connect, ($_POST['student_fname']));
	$stud_mname=mysqli_real_escape_string($db_connect, $_POST['student_mname']); 
	$stud_lname=mysqli_real_escape_string($db_connect, $_POST['student_lname']); 
	$stud_dept=mysqli_real_escape_string($db_connect, $_POST['student_dept']);
	$stud_level=mysqli_real_escape_string($db_connect, ($_POST['student_level']));
	$stud_reg=mysqli_real_escape_string($db_connect, ($_POST['student_reg_no']));
	$stud_password= mysqli_real_escape_string($db_connect, ($_POST['student_password']));


	
	$sql = "UPDATE students SET password='$stud_password', f_name='$stud_fname',m_name='$stud_mname',l_name='$stud_lname',dept_fk='$stud_dept',level='$stud_level' WHERE student_reg_no='$stud_reg'";
                $result = mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

            $_SESSION["SuccessMessage"]="Student Record Updated!!!";
            header('location:students.php');
            exit;
		}
	





?>