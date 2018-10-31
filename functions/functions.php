<?php

// if(!defined('__CONFIG__')){
// 	exit('Page/File rquested not found');
// }



if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
function ErrorMessage(){

	if (isset($_SESSION["ErrorMessage"])){

		$output="<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
		$output.=htmlentities($_SESSION["ErrorMessage"]);
		$output.="</div>";
		$_SESSION["ErrorMessage"]=null;
		return $output;
	}
}

function LoginErrorMessage(){

    if (isset($_SESSION["LoginErrorMessage"])){

        $output="<div class=\"alert alert-danger\" style=\"width: 66%;\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
        $output.=htmlentities($_SESSION["LoginErrorMessage"]);
        $output.="</div>";
        $_SESSION["LoginErrorMessage"]=null;
        return $output;
    }
}

function SuccessMessage(){

	if (isset($_SESSION["SuccessMessage"])){

		$output="<div class=\"alert alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
		$output.=htmlentities($_SESSION["SuccessMessage"]);
		$output.="</div>";
		$_SESSION["SuccessMessage"]=null;
		return $output;
	}
}




function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function randomTMAID() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $id = array(); //remember to declare $id as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $alphaLength);
        $id[] = $alphabet[$n];
    }
    return implode($id); //turn the array into a string
}

?>