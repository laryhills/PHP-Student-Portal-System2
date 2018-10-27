<?php 
session_start();
require_once('../db_connect.php');
require_once('../functions/functions.php');
?>

<?php

if (isset($_POST['addStudentBtn'])) {

	$stud_fname=mysqli_real_escape_string($db_connect, ucwords($_POST['student_fname']));
	$stud_mname=mysqli_real_escape_string($db_connect, $_POST['student_mname']); 
	$stud_lname=mysqli_real_escape_string($db_connect, $_POST['student_lname']); 
	$stud_dept=mysqli_real_escape_string($db_connect, $_POST['student_dept']);
	$stud_level=mysqli_real_escape_string($db_connect, ucwords($_POST['student_level']));
	$stud_reg=mysqli_real_escape_string($db_connect, ucwords($_POST['student_reg_no']));

	$stud_password= randomPassword();

	$rand1 = rand(100, 999);
	$stud_reg= $stud_reg.$rand1;

	// Fetch Data for Student Registration Number Check //
	$regcheck = "SELECT * FROM students WHERE student_reg_no='$stud_reg'";
			$regcheckresult =mysqli_query($db_connect, $regcheck) or die(mysqli_error($db_connect));
			$rowcount=mysqli_num_rows($regcheckresult);

	// Test Student Registration Number for RCCGSS prefix//
	// $findstr  = 'RCCG';
	// $searchstr = strpos($stud_reg, $findstr);
	
	// 	if ($searchstr === false){

	// 		$_SESSION["ErrorMessage"]="Student Registration Number Invalid";
 	//        	header('location:addstudent.php');
 	//        		exit;
	
	

	if ($rowcount>0) {

		$_SESSION["ErrorMessage"]="Student Registration Number Taken";
        	header('location:addstudent.php');
        	exit;
			
	}else{

			$sql = "INSERT INTO students (student_reg_no,password,f_name,m_name,l_name,level,dept_fk,comment) VALUES ('$stud_reg','$stud_password','$stud_fname','$stud_mname','$stud_lname','$stud_level','$stud_dept','$stud_password')";
                $result = mysqli_query($db_connect, $sql) or die(mysqli_error($db_connect));

            $_SESSION["SuccessMessage"]="Student Record Added!!!";
            header('location:addstudent.php');
            exit;
		}
	



}

?>

<!DOCTYPE>


<html>
	<head>
		<meta charset = "utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		 <meta name = "viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 4 Changes -->
<!--     	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
		<title>Add Students</title>
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
					 <!-- <ul class="nav navbar-nav navbar-right">
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
						<li><a href="dashboard.php"><span class="glyphicon glyphicon-home"> </span> Dashboard</a></li>
						<li><a href="courses.php"><span class="glyphicon glyphicon-book"> </span> Courses</a></li>
						<!-- <li><a href="#"><span class="glyphicon glyphicon-print"> </span> Print Result</a></li> -->
						<li >
            <a href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-user"></span> Students &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-caret-down"></i></a>
				<ul  class="nav nav-pills nav-stacked" id="studentSubmenu">
                    <li  class="active">
                        <a href="addstudent.php"><span class="fa fa-user-plus"></span> Add Student</a>
                    </li>
                    <li>
                        <a href="students.php"><span class="fa fa-users"></span> Manage Students</a>
                    </li>
                </ul>
            </li>

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
						<li><a href="../logout.php"><span class="glyphicon
glyphicon-log-out"></span> Logout</a></li>

					</ul>
				</div> <!-- Ending of Side Area -->
				<div class="col-sm-10">
					<h1>Admin Add Students</h1>
					
						<div>
							<!-- notification message -->
								<?php
									echo ErrorMessage();
								?>
								<?php
									echo SuccessMessage();
									?>

						<form method="post" action="addstudent.php">
								<fieldset>
									
									<div class="form-row">
										<div class="form-group col-sm-4">	
											<label class="FieldInfo" for="student_fname">Student First Name:</label>
							<input style="text-transform: capitalize;" class="form-control" type="text" name="student_fname" id="student_fname" placeholder="Student First Name" required>
										</div>
										<div class="form-group col-sm-4">	
											<label class="FieldInfo" for="student_mname">Student Middle Name:</label>
							<input style="text-transform: capitalize;" class="form-control" type="text" name="student_mname" id="student_mname" placeholder="Student Middle Name" required>
										</div>
										<div class="form-group col-sm-4">	
											<label class="FieldInfo" for="student_lname">Student Last Name:</label>
							<input style="text-transform: capitalize;" class="form-control" type="text" name="student_lname" id="student_lname" placeholder="Student Last Name" required><!-- <small id="passwordHelpBlock" class="form-text text-muted">
  Your password must be 8-20 characters long
</small> -->
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-8">
											<label class="FieldInfo" for="student_dept">Department</label>
											<select class="form-control" name="student_dept" id="student_dept" required>				  
	<?php 

		 $option = "SELECT DISTINCT CONCAT(`dept_title`,' (',`fac_title`,')') AS DeptFac,`dept_code` FROM `department`";
			        $optionresult= mysqli_query($db_connect, $option) or die(mysqli_error($db_connect));

			            while ($row=mysqli_fetch_array($optionresult)) {
			            	?>
				       		<option value="<?php echo $row['dept_code']; ?>">
				        	<?php echo $row['DeptFac'];?></option>
				            
				            <?php
				             }
				            ?>


  												</select>

										</div>
										<div class="form-group col-sm-4">	
											<label class="FieldInfo" for="student_level">Level:</label>
							<select class="form-control" name="student_level" id="student_level"> 
								<option value="100">100</option>
								<!-- <option value="200">200</option>
								<option value="300">300</option>
								<option value="400">400</option>
								<option value="500">500</option> -->
											</select>
										</div>
									</div>
									<div class="form-group col-sm-8">
											<label class="FieldInfo" for="student_reg_no">Faculty:</label>
											<select class="form-control" name="student_reg_no" id="student_reg_no" required>				  
	<?php 

		 $option = "SELECT DISTINCT fac_title,`fac_prefix` FROM `department`";
			        $optionresult= mysqli_query($db_connect, $option) or die(mysqli_error($db_connect));

			            while ($row=mysqli_fetch_array($optionresult)) {
			            	?>
				       		<option value="<?php echo $row['fac_prefix']; ?>">
				        	<?php echo $row['fac_title'];?></option>
				            
				            <?php
				             }
				            ?>


  												</select>

										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-10">
											<input class="btn btn-success btn-block" type="submit" name="addStudentBtn" value="Add New Student">
					
										</div>
	
									</div>
									

								</fieldset>
							</form>



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



	   <script src="../js/addstudent.js"></script>
	</body>
	<!--Bootstrap 4 changes-->
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</html>