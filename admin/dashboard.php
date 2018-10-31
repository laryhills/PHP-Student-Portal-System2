<?php 
session_start();
//Set config ext file
define('__CONFIG__', true);
//Require ext file(s)
require_once('../conn/db_connect.php');
require_once('../functions/functions.php');

if(!$_SESSION['username']){
	$_SESSION["LoginErrorMessage"]="Access Denied, Login Required!!!";
	header('location:../admin.php');
	exit;
}
?>
<?php

$admin_loginid=$_SESSION['username'];

		$stud_reg_no=$_SESSION['username'];
        $ViewQuery = "SELECT * FROM admin WHERE `admin_loginid` = '$admin_loginid'";
        $ViewQueryResult= mysqli_query($db_connect, $ViewQuery) or die(mysqli_error($db_connect));
        $count = mysqli_num_rows($ViewQueryResult);
       
?>
<!DOCTYPE>

<html>
	<head>
		<meta charset = "utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		 <meta name = "viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 4 Changes -->
<!--     	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
		<title>Dashboard</title>
				<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery-3.3.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../css/style.css">
		<script src="../js/solid.js" ></script>
    <script src="../js/fontawesome.js"></script>


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
						<li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-home"> </span> Dashboard</a></li>
						<li><a href="courses.php"><span class="glyphicon glyphicon-book"> </span> Courses</a></li>
						<!-- <li><a href="#"><span class="glyphicon glyphicon-print"> </span> Print Result</a></li> -->
						<li>
            <a href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-user"></span> Students &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-caret-down"></i></a>
				<ul  class="collapse nav nav-pills nav-stacked" id="studentSubmenu">
                    <li>
                        <a href="addstudent.php"><span class="fa fa-user-plus"></span> Add Student</a>
                    </li>
                    <li>
                        <a href="students.php"><span class="fa fa-users"></span> Manage Students</a>
                    </li>
                </ul>
            </li>
            <li>
            <a href="#tmaSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> TMA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-caret-down"></i></a>
				<ul  class="collapse nav nav-pills nav-stacked" id="tmaSubmenu">
                    <li>
                        <a href="addtest.php"><span class="fa fa-plus"></span> Add Tests</a>
                    </li>
                    <li>
                        <a href="addquestion.php"><span class="fa fa-plus"></span> Add Q & A</a>
                    </li>
                </ul>
            </li>

             <?php
            if ($count == 1){
				
				// check if admin is allowed
				$logged_in_user = mysqli_fetch_assoc($ViewQueryResult);

					if ($logged_in_user['admin_type'] == 'master') {

			?>
					
					<li>
            <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-user"></span> Admins &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-caret-down"></i></a>
				<ul  class="collapse nav nav-pills nav-stacked" id="adminSubmenu">
                    <li>
                        <a href="#"><span class="fa fa-user-plus"></span> Add Admin</a>
                    </li>
                    <li>
                        <a href="admins.php"><span class="fa fa-users"></span> Manage Admin</a>
                    </li>
                </ul>
            </li>
						

			<?php
					}
				}

            ?>

						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						<!-- <li><a href="courses.php">Courses</a></li>
						<li><a href="result.php">Check Result</a></li>
						<li><a href="payment.php">Payment</a></li>
						<li><a href="logout.php">Logout</a></li> -->

					</ul>
				</div> <!-- Ending of Side Area -->
				<div class="col-sm-10">
					<h1>Student Dashboard</h1>
					<h4>Matt 6:33</h4>
					<p>But seek ye first the kingdom of <em>God</em>.
					and its righteousness and all other things will be added to you.</p><h4>Matt 6:33</h4>
					<p>But seek ye first the kingdom of <em>God</em>.
					and its righteousness and all other things will be added to you.</p><h4>Matt 6:33</h4>
					<p>But seek ye first the kingdom of <em>God</em>.
					and its righteousness and all other things will be added to you.</p><h4>Matt 6:33</h4>
					<p>But seek ye first the kingdom of <em>God</em>.
					and its righteousness and all other things will be added to you.</p><h4>Matt 6:33</h4>
					<p>But seek ye first the kingdom of <em>God</em>.
					and its righteousness and all other things will be added to you.</p><h4>Matt 6:33</h4>
					<p>But seek ye first the kingdom of <em>God</em>.
					and its righteousness and all other things will be added to you.</p><h4>Matt 6:33</h4>
					<p>But seek ye first the kingdom of <em>God</em>.
					and its righteousness and all other things will be added to you.</p><h4>Matt 6:33</h4>
					<p>But seek ye first the kingdom of <em>God</em>.
					and its righteousness and all other things will be added to you.</p><h4>Matt 6:33</h4>
					<p>But seek ye first the kingdom of <em>God</em>.
					and its righteousness and all other things will be added to you.</p><h4>Matt 6:33</h4>
					<p>But seek ye first the kingdom of <em>God</em>.
					and its righteousness and all other things will be added to you.</p>

				</div> <!-- Ending of Main Area -->

				


			</div> <!-- Ending of Row -->

		</div> <!-- Ending of Container-Fluid -->
		<div class="footer">
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