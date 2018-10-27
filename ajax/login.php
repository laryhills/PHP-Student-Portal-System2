<?php 
session_start(); 
include_once('../conn/db_connect.php');

function login_submit(){
	global $db_connect;
	// if (isset($_POST['$("loginStudent")'])) {
	if (isset($_GET['login']) && $_GET['login'] == 'true') {

		$stud_reg_no = $_POST['student_reg_no'];
		$stud_pass = $_POST['student_password'];

				//Created template with placeholder
		$query = "SELECT * FROM `students` WHERE student_reg_no=? and password=?";

		//Create a prepared statement
		$stmt = mysqli_stmt_init($db_connect);

		//Prepare the prepared statement
		if(!mysqli_stmt_prepare($stmt, $query)) {

			echo "SQL statement failed";//internal viewing error
		}
		else{

			//Bind parameters to the placeholder
			mysqli_stmt_bind_param($stmt, "ss", $stud_reg_no, $stud_pass);
			//Run parameters inside database
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$count = mysqli_num_rows($result);
		}
			// user found
			if ($count == 1){
				
				// check if user is admin or student
				$logged_in_user = mysqli_fetch_assoc($result);

					if ($logged_in_user['user_type'] == 'admin') {

						// user is admin
						$_SESSION['username'] = $stud_reg_no;

						$_SESSION['timestamp']=time();

						
						echo "Welcome Admin";

						echo json_encode(['outcome' => 'success', 'redirect' => 'studpage.php']);

					}else{

						// user is student
						$_SESSION['username'] = $stud_reg_no;

						$_SESSION['timestamp']=time();

						// echo json_encode(['outcome' => 'success', 'redirect' => 'studpage.php']);
						echo json_encode(array('outcome'=> 'success', 'redirect' => 'studpage.php'));
						
					}
				
			}else{
				echo json_encode(['outcome' => 'failed']);

			}
	}
}


login_submit();


function check_student_reg_no(){

	global $db_connect;
	if (isset($_GET['login']) && $_GET['login'] == 'check') {
		$stud_reg_no = $_POST['check_student'];
		$query = "SELECT * FROM `students` WHERE student_reg_no=?";
		$stmt = mysqli_stmt_init($db_connect);
		if(!mysqli_stmt_prepare($stmt, $query)) {
		echo "SQL statement failed";//internal viewing error
		}
		else{
			//Bind parameters to the placeholder
			mysqli_stmt_bind_param($stmt, "s", $stud_reg_no);
			//Run parameters inside database
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$count = mysqli_num_rows($result);
		}
		if ($count == 1){
			echo json_encode(array('result' => 'success'));	
		}else{
			echo json_encode(array('result'=> 'failed', 'message' => 'Student Record Not Found !!!'));
		}  

	}
}
check_student_reg_no();

?>

<?php 

// if (isset($_POST['student_reg_no']) and isset($_POST['student_password'])){
	
// 	// Assigning POST values to variables.
// 	$stud_reg_no = $_POST['student_reg_no'];
// 	$stud_pass = $_POST['student_password'];

	
// 	//Created template with placeholder
// 	$query = "SELECT * FROM `students` WHERE student_reg_no=? and password=?";

// 	//Create a prepared statement
// 	$stmt = mysqli_stmt_init($db_connect);

// 	//Prepare the prepared statement
// 	if(!mysqli_stmt_prepare($stmt, $query)) {

// 		echo "SQL statement failed";//internal viewing error
// 	}
// 	else{

// 		//Bind parameters to the placeholder
// 		mysqli_stmt_bind_param($stmt, "ss", $stud_reg_no, $stud_pass);
// 		//Run parameters inside database
// 		mysqli_stmt_execute($stmt);
// 		$result = mysqli_stmt_get_result($stmt);
// 		$count = mysqli_num_rows($result);
		

	
// 	}
// 		// user found
// 		if ($count == 1){
			
// 			// check if user is admin or student
// 			$logged_in_user = mysqli_fetch_assoc($result);

// 				if ($logged_in_user['user_type'] == 'admin') {

// 					// user is admin
// 					$_SESSION['username'] = $stud_reg_no;

// 					$_SESSION['timestamp']=time();

// 					echo "<script type='text/javascript'>";
// 					echo "alert('Login Credentials verified');";
// 					echo "window.location='admin/dashboard.php';";
// 					echo "</script>";

// 				}else{

// 					// user is student
// 					$_SESSION['username'] = $stud_reg_no;

// 					$_SESSION['timestamp']=time();

// 					echo "<script type='text/javascript'>";
// 					echo "alert('Login Credentials verified');";
// 					echo "window.location='studpage.php';";
// 					echo "</script>";

// 				}
			
// 		}else{
// 			 echo "<script type='text/javascript'>alert('Invalid Login Credentials');";
// 			 echo "window.location='index.php';";
// 			 echo "</script>";
// 		}
// }
?>