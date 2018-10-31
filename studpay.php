<!-- <?php 
session_start();
//Set config ext file
define('__CONFIG__', true);
//Require ext file(s)
require_once('conn/db_connect.php');
require_once('functions/functions.php');

if(!$_SESSION['username']){
	$_SESSION["LoginErrorMessage"]="Access Denied, Login Required!!!";
	header('location:index.php');
	exit;
}
?>

<?php

if (isset($_POST['addCourseBtn'])) {

	$course_title=mysqli_real_escape_string($db_connect, ucwords($_POST['course_title']));
	$course_code=mysqli_real_escape_string($db_connect, $_POST['course_code']); 
	$course_credit=mysqli_real_escape_string($db_connect, $_POST['course_credit']); 
	$course_dept=mysqli_real_escape_string($db_connect, $_POST['course_dept']); 

	
	// if(empty($course_name) || empty($course_code)){

	// 	$_SESSION["ErrorMessage"]="All fields must be field";
 	//        header('location:addcourses.php');
 	//        exit;
	// }
	
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

			$sql = "INSERT INTO courses (course_title,course_code,course_dept_fk,course_credit) VALUES ('$course_title','$course_code','$course_dept','$course_credit')";
                $result = mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

            $_SESSION["SuccessMessage"]="Course Added!!!";
            header('location:courses.php');
            exit;
		}
	



}

?> -->

<!DOCTYPE>


<html>
	<head>
		<meta charset = "utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		 <meta name = "viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 4 Changes -->
<!--     	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
		<title>Payments</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<script src="js/solid.js" ></script>
    	<script src="js/fontawesome.js"></script>


	</head>
	<body>
		<div style="height: 5px; background: #1ab394;"></div>
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<!-- <span class="sr-only">Toogle Navigation</span> -->
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Logo -->
					<a class="navbar-brand" href="dashboard.php">
					<!-- <img style="margin-top: -12px;" src="" width=""; height=";"> -->
						SCHOOL LOGO
					</a>
				</div>

				<!-- Menu Items -->
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Portal</a></li>
						<li><a href="#">Latest News</a></li>
						<li><a href="#">Courses</a></li>
						<li ><a href="#">About Us</a></li>
						<li><a href="#">Contact Us</a></li>
					</ul>
					<!-- <form action="dashboard.php" class="navbar-form navbar-right">
						<div class="form-group">
							<input class="form-control" type="text" name="search" placeholder="Search">
						</div>
						<button class="btn btn-default">
        <i class="fa fa-search"></i></button>
					</form> -->
			<!--		 <ul class="nav navbar-nav navbar-right">
					 	<br>
					 	<li style="color: white; align-content: center;"><?php echo $DateTime1; ?></li>
         <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> 
      </ul> -->
				</div>
				
			</div>
			
		</nav>
		<div class="line" style="height: 10px; background: #1ab394;"></div>
			
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2">
					<br><br>
					<ul id="side_menu" class="nav nav-pills nav-stacked">
						<li><a href="studpage.php"><span class="glyphicon glyphicon-home"> </span> Dashboard</a></li>
						<li><a href="studcourses.php"><span class="glyphicon glyphicon-book"> </span> My Courses</a></li>
						<!-- <li class="active">
                        <a href="studtest.php"><span class="fa fa-edit"></span> Take Tests</a>
                    	</li> -->
                    	<li>
                        <a href="studupdate.php"><span class="fa fa-edit"></span> Edit Profile</a>
                    	</li>
						<li><a href="studpay.php"><span class="glyphicon glyphicon-credit-card"> </span> Payments</a></li>
						<li><a href="logout.php"><span class="glyphicon
glyphicon-log-out"></span> Logout</a></li>
						
					</ul>
				</div> <!-- Ending of Side Area -->
				<div class="col-sm-10">
					<!-- <h1>Manage Courses</h1>
					-->
						<div> 
							<!-- notification message -->
								<!-- <?php
									echo ErrorMessage();
								?>
								<?php
									echo SuccessMessage();
									?> -->

							<div class="col-sm-12">
								<br><br><br><br><br><br>
								<h1 style="font-size: 8.9em">COMING SOON</h1>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>
						
				</div> <!-- Ending of Main Area -->

				
		</div> <!-- Ending of Container-Row -->
		</div> <!-- Ending of Container-Fluid -->
		</div>	<div class="footer">
	    	<div class="container">
		    	<div class="row">

		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="footer-copyright">Copyright &copy; 2018 School Name. All rights reserved.</div>
		    		</div>
		    	</div>
		    </div>
	    </div> <!-- Ending of Footer -->



	   
	</body>
	<!--Bootstrap 4 changes-->
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</html>