<?php 
session_start(); 

// //Set config ext file
// define('__CONFIG__', true);
// //Require ext file(s)
require_once('../conn/db_connect.php');

function login_submit(){
	global $db_connect;
	// if (isset($_POST['$("loginStudent")'])) {
	if (isset($_GET['login']) && $_GET['login'] == 'true') {

		$admin_loginid = $_POST['admin_loginid'];
		$admin_password = $_POST['admin_password'];

				//Created template with placeholder
		$query = "SELECT * FROM `admin` WHERE admin_loginid=? and password=?";

		//Create a prepared statement
		$stmt = mysqli_stmt_init($db_connect);

		//Prepare the prepared statement
		if(!mysqli_stmt_prepare($stmt, $query)) {

			echo "SQL statement failed";//internal viewing error
		}
		else{

			//Bind parameters to the placeholder
			mysqli_stmt_bind_param($stmt, "ss", $admin_loginid, $admin_password);
			//Run parameters inside database
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$count = mysqli_num_rows($result);
		}
			// user found
			if ($count == 1){
				
				// check if admin is allowed
				$logged_in_user = mysqli_fetch_assoc($result);

					if ($logged_in_user['status'] == 'disallowed') {

						echo json_encode(array('outcome'=> 'wrong'));

					}else{

						
						$_SESSION['username'] = $admin_loginid;

						$_SESSION['timestamp']=time();

						// echo json_encode(['outcome' => 'success', 'redirect' => 'studpage.php']);
						echo json_encode(array('outcome'=> 'success', 'redirect' => 'admin/dashboard.php'));
						
					}
				
			}else{
				echo json_encode(['outcome' => 'failed']);

			}
	}
}


login_submit();


function check_adminId(){

	global $db_connect;
	if (isset($_GET['login']) && $_GET['login'] == 'check') {
		$admin_loginid = $_POST['check_admin_loginid'];
		$query = "SELECT * FROM `admin` WHERE admin_loginid=?";
		$stmt = mysqli_stmt_init($db_connect);
		if(!mysqli_stmt_prepare($stmt, $query)) {
		echo "SQL statement failed";//internal viewing error
		}
		else{
			//Bind parameters to the placeholder
			mysqli_stmt_bind_param($stmt, "s", $admin_loginid);
			//Run parameters inside database
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$count = mysqli_num_rows($result);
		}
		if ($count == 1){
			echo json_encode(array('result' => 'success'));	
		}else{
			echo json_encode(array('result'=> 'failed', 'message' => 'Admin Login ID Not Found !!!'));
		}  

	}
}
check_adminId();

?>