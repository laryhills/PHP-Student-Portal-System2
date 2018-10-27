<?php 
session_start(); 
include_once('../conn/db_connect.php');
include_once"../functions/functions.php";

function update_submit(){
	global $db_connect;
	// if (isset($_POST['$("loginStudent")'])) {
	if (isset($_GET['update']) && $_GET['update'] == 'true') {

		$stud_reg_no = $_POST['student_reg_no'];
		$stud_password1= mysqli_real_escape_string($db_connect, ($_POST['student_password1']));
		$stud_password2= mysqli_real_escape_string($db_connect, ($_POST['student_password2']));


		$sql = "UPDATE students SET password='$stud_password2' WHERE student_reg_no='$stud_reg_no'";
 		$result = mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));
		
 		
 		$_SESSION["SuccessMessage"]="Password Updated!!!";
 	    // exit;
		echo json_encode(array('outcome'=> 'success', 'redirect' => 'studpage.php'));

 	}
			
}


update_submit();


function check_student_password(){

	global $db_connect;
	if (isset($_GET['update']) && $_GET['update'] == 'check') {
		$stud_reg_no = $_POST['student_reg_no'];
		$stud_password1= $_POST['check_password'];

		$query = "SELECT password FROM `students` WHERE password='$stud_password1' AND student_reg_no='$stud_reg_no' ";
		$result = mysqli_query($db_connect, $query) or die(mysqli_error($db_connect));
		$count = mysqli_num_rows($result);
		if ($count == 1){
			echo json_encode(['result' => 'success']);	
		}else{
			echo json_encode(array('result'=> 'failed', 'message' => 'Wrong Old Password !!!'));
		}
	}  

}
check_student_password();

?>