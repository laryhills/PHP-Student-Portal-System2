<?php


//Test for __CONFIG__ constant
// if(!defined('__CONFIG__')){
// 	exit('Page/File rquested not found');
// }



	$dbServername = "localhost";
	$dbUsername = "root";
	$dbPassword = "okoh";
	$dbName = "phpcms";

	$db_connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);



/* or alternatively for deployment

$connect_error="Sorry we're experiencing connection problems.";
error_reporting(0);
$db_connect=mysql_connect("localhost","root","okoh");
		if(!$db_connect){
			die($connect_error);
		}

	$db_select=mysql_select_db("voter_info");
		if(!$db_select){
			die($connect_error);
		}
		*/



?>
