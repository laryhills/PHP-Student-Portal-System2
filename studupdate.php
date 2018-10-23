<?php 
session_start();
require_once('db_connect.php');
require_once('functions/functions.php');
require_once('dateTime.php');
?>
<!DOCTYPE>

<html>
	<head>
		<meta charset = "utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		 <meta name = "viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 4 Changes -->
<!--     	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
		<title>Edit Profile</title>
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
						<li>
                        <a href="studtest.php"><span class="fa fa-edit"></span> Take Tests</a>
                    	</li>
						<li  class="active">
                        <a href="studupdate.php"><span class="fa fa-edit"></span> Edit Profile</a>
                    	</li><li><a href="studpay.php"><span class="glyphicon glyphicon-credit-card"> </span> Payments</a></li>
						<li><a href="logout.php"><span class="glyphicon
glyphicon-log-out"></span> Logout</a></li>
						
					</ul>
				</div> <!-- Ending of Side Area -->
				<div class="col-sm-10">
					<h2>&nbsp;Update Profile</h2>
						<div>
							
							<!-- notification message -->
								<?php
									echo ErrorMessage();
								?>
								<?php
									echo SuccessMessage();
									?>


	<?php 
		$stud_reg_no=$_SESSION['username'];
        $ViewQuery = "SELECT CONCAT (f_name,' ',m_name,' ',l_name) AS Name, password FROM students WHERE `student_reg_no` = '$stud_reg_no'";
        $ViewQueryResult= mysqli_query($db_connect, $ViewQuery) or die(mysqli_error($db_connect));
       
       while ($row=mysqli_fetch_array($ViewQueryResult)) {

		                    $name = ($row['Name']);
		                    $stud_pass = ($row['password']);

		                }
    ?>			
    <?php

  if (isset($_POST['updateStudentBtn'])){

		$stud_password1= mysqli_real_escape_string($db_connect, ($_POST['student_password1']));
		$stud_password2= mysqli_real_escape_string($db_connect, ($_POST['student_password2']));

		if (strlen($stud_password2) < 8) {
			echo "<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>New Password Must Be At Least 8 Characters</div>";
			
		}elseif (!($stud_pass == $stud_password1)) {
			echo "<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Old Password Not Correct</div>";
		}else{
			
			if ($stud_password2 == $stud_pass) {
				echo "<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Please Choose A Different Password</div>";
			}else{

					$sql = "UPDATE students SET password='$stud_password2' WHERE student_reg_no='$stud_reg_no'";
                $result = mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

            echo "<div class=\"alert alert-success\">Password Changed!!!</div>";
			}
		}

	}

		?>	
			<form method="post" action="studupdate.php">
                <!-- <tbody style="font-size: 1.2em;"> -->
                	<fieldset>
									
									<div class="form-row">
										<div class="form-group col-sm-7">	
											<label class="FieldInfo" for="student_reg_no">Student Registration Number:</label>
							<input style="text-transform: uppercase;" class="form-control" type="text" name="student_reg_no" id="student_reg_no" placeholder="Student Registration Number" value="<?php echo $stud_reg_no; ?>" readonly="0"><small id="passwordHelpBlock" class="form-text text-muted">
  								Cannot change student registration number after creation.
							</small>
										</div>
									</div>
									<div class="form-row">
											<div class="form-group col-sm-6">	
											<label class="FieldInfo" for="student_password1">Old Password:</label>
							<input class="form-control" type="password" name="student_password1" id="student_password1" placeholder="Old Password" required>
										</div>
										<div class="form-group col-sm-6">	
											<label class="FieldInfo" for="student_password2">New Password:</label>
							<input class="form-control" type="password" name="student_password2" id="student_password2" placeholder="New Password" required><small id="passwordHelpBlock" class="form-text text-muted">
  								Password must be at least 8 characters long.
							</small>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-10">
											<input class="btn btn-success btn-block" type="submit" name="updateStudentBtn" value="Update Profile">
					
										</div>
	
									</div>
								</fieldset>
							</form>	
                  


	</div>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
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